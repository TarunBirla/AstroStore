<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private function getCartQuery()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id());
        }
        return Cart::where('session_id', Session::getId());
    }

    public function index()
    {
        $cartItems = $this->getCartQuery()->with('product')->get();

        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->active_price * $item->qty;
            }
        }

        // Coupon calculation
        $couponData = Session::get('coupon', null);
        $discount = 0;
        if ($couponData) {
            $coupon = Coupon::find($couponData['id']);
            if ($coupon) {
                $check = $coupon->isValidForAmount($subtotal);
                if ($check['valid']) {
                    $discount = $coupon->calculateDiscount($subtotal);
                    Session::put('coupon', [
                        'id' => $coupon->id,
                        'code' => $coupon->code,
                        'discount' => $discount,
                    ]);
                } else {
                    Session::forget('coupon');
                    $couponData = null;
                }
            } else {
                Session::forget('coupon');
                $couponData = null;
            }
        }

        // Shipping calculation
        $freeShippingAbove = (float) setting('free_shipping_above', 999);
        $shippingRate = (float) setting('shipping_charge', 70);
        $shipping = ($subtotal >= $freeShippingAbove || $subtotal == 0) ? 0 : $shippingRate;

        // Tax calculation
        $taxPercent = (float) setting('tax_percent', 3);
        $taxableAmount = max(0, $subtotal - $discount);
        $tax = round(($taxableAmount * $taxPercent) / 100, 2);

        $total = max(0, $subtotal - $discount + $shipping + $tax);

        return view('frontend.cart.index', compact(
            'cartItems',
            'subtotal',
            'discount',
            'shipping',
            'tax',
            'total',
            'couponData',
            'freeShippingAbove'
        ));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Requested consecrated quantity exceeds available stock (' . $product->stock . ' left).'
            ]);
        }

        $cartQuery = $this->getCartQuery()->where('product_id', $product->id);
        $cartItem = $cartQuery->first();

        if ($cartItem) {
            $newQty = $cartItem->qty + $quantity;
            if ($newQty > $product->stock) {
                $cartItem->qty = $product->stock;
            } else {
                $cartItem->qty = $newQty;
            }
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::check() ? Auth::id() : null,
                'session_id' => Auth::check() ? null : Session::getId(),
                'product_id' => $product->id,
                'qty' => $quantity,
            ]);
        }

        $count = getCartCount();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => '✦ ' . $product->name . ' added to your Sacred Cart!',
                'cart_count' => $count
            ]);
        }

        return back()->with('success', $product->name . ' added to your Sacred Cart!');
    }

    public function update(Request $request)
    {
        $cartId = $request->input('cart_id');
        $qty = (int) $request->input('qty', 1);

        $cart = $this->getCartQuery()->where('id', $cartId)->first();

        if ($cart) {
            if ($qty <= 0) {
                $cart->delete();
            } else {
                $product = $cart->product;
                if ($product && $qty > $product->stock) {
                    $cart->qty = $product->stock;
                } else {
                    $cart->qty = $qty;
                }
                $cart->save();
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'success', 'cart_count' => getCartCount()]);
        }

        return back()->with('success', 'Sacred cart updated successfully.');
    }

    public function remove(Request $request)
    {
        $cartId = $request->input('cart_id');
        $this->getCartQuery()->where('id', $cartId)->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart.',
                'cart_count' => getCartCount()
            ]);
        }

        return back()->with('info', 'Item removed from sacred cart.');
    }

    public function clear()
    {
        $this->getCartQuery()->delete();
        Session::forget('coupon');
        return back()->with('info', 'Sacred cart cleared.');
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $code = strtoupper(trim($request->code));

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return back()->with('error', 'Invalid celestial coupon code.');
        }

        // Calculate current subtotal
        $cartItems = $this->getCartQuery()->with('product')->get();
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if ($item->product) {
                $subtotal += $item->product->active_price * $item->qty;
            }
        }

        $check = $coupon->isValidForAmount($subtotal);
        if (!$check['valid']) {
            return back()->with('error', $check['message']);
        }

        // Check if user already used this coupon once
        if (Auth::check()) {
            $alreadyUsed = CouponUsage::where('user_id', Auth::id())
                ->where('coupon_id', $coupon->id)
                ->exists();
            if ($alreadyUsed) {
                return back()->with('error', 'You have already utilized this sacred coupon previously.');
            }
        }

        $discount = $coupon->calculateDiscount($subtotal);

        Session::put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'discount' => $discount,
        ]);

        return back()->with('success', 'Auspicious Coupon ' . $coupon->code . ' applied! You saved ₹' . number_format($discount, 2));
    }

    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('info', 'Coupon removed.');
    }
}
