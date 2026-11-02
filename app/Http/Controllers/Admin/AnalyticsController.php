<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\CouponUsage;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $ordersQuery = Order::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->where('status', '!=', 'cancelled');

        $totalRevenue = (float) $ordersQuery->sum('total');
        $totalOrders = $ordersQuery->count();
        $averageOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;

        $totalUnits = (int) OrderItem::whereHas('order', function($q) use ($startDate, $endDate) {
            $q->whereDate('created_at', '>=', $startDate)
              ->whereDate('created_at', '<=', $endDate)
              ->where('status', '!=', 'cancelled');
        })->sum('qty');

        $newCustomers = User::where('role', 'user')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->count();

        // Top Selling Products in period
        $topProducts = OrderItem::select('product_id', 'name', \DB::raw('SUM(qty) as total_qty'), \DB::raw('SUM(total) as total_sales'))
            ->whereHas('order', function($q) use ($startDate, $endDate) {
                $q->whereDate('created_at', '>=', $startDate)
                  ->whereDate('created_at', '<=', $endDate)
                  ->where('status', '!=', 'cancelled');
            })
            ->groupBy('product_id', 'name')
            ->orderByDesc('total_sales')
            ->take(6)
            ->get();

        // Coupon Usages in period
        $couponUsages = CouponUsage::with(['coupon', 'order', 'user'])
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->latest()
            ->take(10)
            ->get();

        return view('admin.analytics.index', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'totalUnits',
            'newCustomers',
            'topProducts',
            'couponUsages'
        ));
    }

    public function exportCsv(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $orders = Order::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->with(['user', 'items'])
            ->latest()
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"astro_sales_report_{$startDate}_{$endDate}.csv\"",
        ];

        $callback = function () use ($orders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Order Number', 'Date', 'Devotee Name', 'Devotee Email', 'Phone', 'City', 'Subtotal', 'Discount', 'Shipping', 'Tax', 'Total Amount', 'Status', 'Payment Status']);

            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->shipping_name,
                    $order->user->email ?? 'Guest',
                    $order->phone,
                    $order->city,
                    $order->subtotal,
                    $order->discount,
                    $order->shipping,
                    $order->tax,
                    $order->total,
                    $order->status,
                    $order->payment_status,
                ]);
            }
            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
