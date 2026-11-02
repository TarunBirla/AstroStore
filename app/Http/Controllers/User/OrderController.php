<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Order::where('user_id', $user->id)->with(['items', 'payment']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('user.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', $user->id)
            ->with(['items.product', 'payment'])
            ->firstOrFail();

        return view('user.orders.show', compact('order'));
    }

    public function cancel(Request $request, $orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', $user->id)
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return back()->with('error', 'Only orders in pending status can be cancelled. Once consecrated or shipped, cancellation is not possible.');
        }

        try {
            DB::beginTransaction();

            // Restore stock
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->qty);
                }
            }

            $order->status = 'cancelled';
            $order->notes = ($order->notes ? $order->notes . "\n" : "") . "Cancelled by devotee on " . now()->toDateTimeString();
            $order->save();

            // If payment was recorded, mark as refunded / cancelled
            if ($order->payment) {
                $order->payment->status = 'refunded';
                $order->payment->save();
            }

            DB::commit();
            return back()->with('success', 'Order #' . $order->order_number . ' has been cancelled successfully and product inventory has been restored.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Cancellation failed: ' . $e->getMessage());
        }
    }

    public function invoice($orderNumber)
    {
        $user = Auth::user();
        $order = Order::where('order_number', $orderNumber)
            ->where(function($q) use ($user) {
                if ($user->role === 'admin') {
                    // Admin can view any invoice
                } else {
                    $q->where('user_id', $user->id);
                }
            })
            ->with(['items.product', 'payment', 'user'])
            ->firstOrFail();

        return view('user.orders.invoice', compact('order'));
    }

    public function transactions()
    {
        $user = Auth::user();
        $payments = Payment::where('user_id', $user->id)
            ->with('order')
            ->latest()
            ->paginate(12);

        return view('user.transactions', compact('payments'));
    }
}
