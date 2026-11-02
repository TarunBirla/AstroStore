<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'payment', 'items']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('shipping_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $orders = $query->latest()->paginate(12)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'payment', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order = Order::with('items.product')->findOrFail($id);
        $oldStatus = $order->status;
        $newStatus = $request->status;

        try {
            DB::beginTransaction();

            // If changing to cancelled and was not cancelled before: restore stock!
            if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->increment('stock', $item->qty);
                    }
                }
            }

            // If changing from cancelled to active: decrement stock back if available
            if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
                foreach ($order->items as $item) {
                    if ($item->product) {
                        $item->product->decrement('stock', $item->qty);
                    }
                }
            }

            $order->status = $newStatus;
            $order->payment_status = $request->payment_status;
            if ($request->filled('notes')) {
                $order->notes = $request->notes;
            }
            $order->save();

            // Also update payment record status if present
            if ($order->payment) {
                if ($request->payment_status === 'paid') {
                    $order->payment->status = 'success';
                } elseif ($newStatus === 'cancelled') {
                    $order->payment->status = 'refunded';
                }
                $order->payment->save();
            }

            DB::commit();
            return back()->with('success', 'Order #' . $order->order_number . ' status updated successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Status update failed: ' . $e->getMessage());
        }
    }

    public function invoice($id)
    {
        $order = Order::with(['user', 'payment', 'items.product'])->findOrFail($id);
        return view('user.orders.invoice', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
