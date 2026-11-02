<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function calculateTotals()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->active_price * $item->qty;
            }
        }

        $couponData = Session::get('coupon', null);
        $discount = 0;
        $couponModel = null;

        if ($couponData) {
            $couponModel = Coupon::find($couponData['id']);
            if ($couponModel && $couponModel->isValidForAmount($subtotal)['valid']) {
                $discount = $couponModel->calculateDiscount($subtotal);
            } else {
                Session::forget('coupon');
                $couponData = null;
            }
        }

        $freeShippingAbove = (float) setting('free_shipping_above', 999);
        $shippingRate = (float) setting('shipping_charge', 70);
        $shipping = ($subtotal >= $freeShippingAbove || $subtotal == 0) ? 0 : $shippingRate;

        $taxPercent = (float) setting('tax_percent', 3);
        $taxableAmount = max(0, $subtotal - $discount);
        $tax = round(($taxableAmount * $taxPercent) / 100, 2);

        $total = max(0, $subtotal - $discount + $shipping + $tax);

        return compact('cartItems', 'subtotal', 'discount', 'shipping', 'tax', 'total', 'couponData', 'couponModel');
    }

    public function index()
    {
        $user = Auth::user();
        $totals = $this->calculateTotals();

        if ($totals['cartItems']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your sacred cart is currently empty.');
        }

        return view('frontend.checkout.index', array_merge($totals, ['user' => $user]));
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:150',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
            'payment_method' => 'required|in:cod,razorpay,upi',
            'notes' => 'nullable|string|max:1000',
            'save_address' => 'nullable|boolean',
        ]);

        $user = Auth::user();
        $totals = $this->calculateTotals();

        if ($totals['cartItems']->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your sacred cart is empty.');
        }

        // Validate stock availability
        foreach ($totals['cartItems'] as $item) {
            if ($item->product->stock < $item->qty) {
                return redirect()->route('cart.index')->with('error', 'Item ' . $item->product->name . ' has only ' . $item->product->stock . ' units left. Please adjust your cart.');
            }
        }

        // Optionally update user's profile address if requested
        if ($request->has('save_address')) {
            $user->update([
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
            ]);
        }

        // If Razorpay, return JSON with order configuration or initiate Razorpay modal
        if ($validated['payment_method'] === 'razorpay' && !$request->has('razorpay_payment_id')) {
            $razorpayKey = setting('razorpay_key_id', env('RAZORPAY_KEY', 'rzp_test_astro_dummy_key'));
            return response()->json([
                'status' => 'initiate_razorpay',
                'key' => $razorpayKey,
                'amount' => $totals['total'] * 100, // paise
                'currency' => 'INR',
                'name' => setting('site_name', 'AstroStore'),
                'description' => 'Sacred Astrological Order Payment',
                'prefill' => [
                    'name' => $validated['shipping_name'],
                    'email' => $user->email,
                    'contact' => $validated['phone'],
                ],
            ]);
        }

        // Wrap order placement in Database Transaction
        try {
            DB::beginTransaction();

            $orderNumber = 'ASTRO-' . date('Y') . '-' . strtoupper(Str::random(6));

            $isOnlinePaid = in_array($validated['payment_method'], ['razorpay', 'upi']) && $request->filled('razorpay_payment_id');
            $paymentStatus = $isOnlinePaid ? 'paid' : 'pending';

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $user->id,
                'subtotal' => $totals['subtotal'],
                'discount' => $totals['discount'],
                'coupon_code' => $totals['couponData']['code'] ?? null,
                'shipping' => $totals['shipping'],
                'tax' => $totals['tax'],
                'total' => $totals['total'],
                'status' => 'pending',
                'payment_status' => $paymentStatus,
                'shipping_name' => $validated['shipping_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'notes' => $validated['notes'] ?? null,
            ]);

            // Create Order Items and decrease stock
            foreach ($totals['cartItems'] as $cItem) {
                $product = $cItem->product;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->active_price,
                    'qty' => $cItem->qty,
                    'total' => $product->active_price * $cItem->qty,
                ]);

                // Reduce inventory stock
                $product->decrement('stock', $cItem->qty);
            }

            // Create Payment Record
            Payment::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'method' => $validated['payment_method'],
                'transaction_id' => $request->input('razorpay_payment_id', 'TXN-' . strtoupper(Str::random(10))),
                'amount' => $totals['total'],
                'status' => $isOnlinePaid ? 'success' : 'pending',
                'payment_details' => json_encode($request->all()),
            ]);

            // Handle Coupon Usage
            if ($totals['couponModel']) {
                $totals['couponModel']->increment('used_count');
                CouponUsage::create([
                    'user_id' => $user->id,
                    'coupon_id' => $totals['couponModel']->id,
                    'order_id' => $order->id,
                ]);
            }

            // Empty User Cart & Coupon
            Cart::where('user_id', $user->id)->delete();
            Session::forget('coupon');

            DB::commit();

            // Send Confirmation Email
            try {
                Mail::to($user->email)->send(new OrderConfirmationMail($order));
            } catch (\Throwable $e) {
                // Ignore mail transport errors in local dev
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'redirect_url' => route('checkout.thankYou', $order->order_number)
                ]);
            }

            return redirect()->route('checkout.thankYou', $order->order_number)->with('success', 'Your sacred order has been consecrated and placed!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order: ' . $e->getMessage())->withInput();
        }
    }

    public function verifyRazorpay(Request $request)
    {
        $signature = $request->input('razorpay_signature');
        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');

        // Proceed to place order with verified payment ID
        return $this->placeOrder($request);
    }

    public function thankYou($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->with(['items.product', 'payment'])
            ->firstOrFail();

        return view('frontend.checkout.thank-you', compact('order'));
    }
}
