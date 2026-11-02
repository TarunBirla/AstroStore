<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['order', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('order', function($oq) use ($search) {
                      $oq->where('order_number', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->latest()->paginate(12)->withQueryString();

        $totalCollected = Payment::where('status', 'success')->sum('amount');
        $totalPending = Payment::where('status', 'pending')->sum('amount');
        $totalRefunded = Payment::where('status', 'refunded')->sum('amount');

        return view('admin.payments.index', compact(
            'payments',
            'totalCollected',
            'totalPending',
            'totalRefunded'
        ));
    }

    public function show($id)
    {
        $payment = Payment::with(['order.items', 'user'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,success,failed,refunded',
        ]);

        $payment = Payment::with('order')->findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        if ($payment->order) {
            if ($request->status === 'success') {
                $payment->order->payment_status = 'paid';
                $payment->order->save();
            } elseif ($request->status === 'failed') {
                $payment->order->payment_status = 'failed';
                $payment->order->save();
            }
        }

        return back()->with('success', 'Payment status updated successfully.');
    }
}
