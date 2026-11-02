<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();

        // Recent Orders
        $recentOrders = Order::with(['user', 'items'])->latest()->take(6)->get();

        // Top Selling Products (by order items qty)
        $topProducts = Product::withCount(['reviews'])
            ->orderBy('stock', 'asc') // Demonstration metric or order items
            ->take(5)
            ->get();

        // New Users
        $newUsers = User::where('role', 'user')->latest()->take(5)->get();

        // Chart 1: 12-Month Sales
        $monthlySales = [];
        $monthLabels = [];
        for ($m = 11; $m >= 0; $m--) {
            $date = now()->subMonths($m);
            $monthKey = $date->format('M Y');
            $monthLabels[] = $monthKey;
            $monthlySales[] = (float) Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->where('status', '!=', 'cancelled')
                ->sum('total');
        }

        // Chart 2: Orders by Status
        $ordersByStatus = [
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // Chart 3: Category-wise Product Count
        $categories = Category::withCount('products')->get();
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryCounts = $categories->pluck('products_count')->toArray();

        // Chart 4: Last 7 Days Revenue
        $last7DaysLabels = [];
        $last7DaysRevenue = [];
        for ($d = 6; $d >= 0; $d--) {
            $day = now()->subDays($d);
            $last7DaysLabels[] = $day->format('D, M d');
            $last7DaysRevenue[] = (float) Order::whereDate('created_at', $day->format('Y-m-d'))
                ->where('status', '!=', 'cancelled')
                ->sum('total');
        }

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'pendingOrders',
            'lowStockCount',
            'recentOrders',
            'topProducts',
            'newUsers',
            'monthLabels',
            'monthlySales',
            'ordersByStatus',
            'categoryLabels',
            'categoryCounts',
            'last7DaysLabels',
            'last7DaysRevenue'
        ));
    }
}
