<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'unauthenticated',
                'message' => 'Please login to manage your wishlist.'
            ]);
        }

        $productId = $request->input('product_id');
        $product = Product::findOrFail($productId);

        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $action = 'removed';
            $message = 'Item removed from your Sacred Wishlist.';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            $action = 'added';
            $message = '✦ ' . $product->name . ' saved to your Sacred Wishlist!';
        }

        $count = Wishlist::where('user_id', Auth::id())->count();

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'message' => $message,
            'wishlist_count' => $count
        ]);
    }
}
