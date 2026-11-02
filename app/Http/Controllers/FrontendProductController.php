<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FrontendProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 1)
            ->with(['category', 'images', 'reviews.user'])
            ->firstOrFail();

        $relatedProducts = Product::where('status', 1)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['category', 'reviews'])
            ->take(4)
            ->get();

        $avgRating = $product->reviews->avg('rating') ?: 5;
        $reviewsCount = $product->reviews->count();

        return view('frontend.product-detail', compact('product', 'relatedProducts', 'avgRating', 'reviewsCount'));
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5|max:1000',
        ]);

        $product = Product::findOrFail($id);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'status' => 'approved', // Auto-approved or managed in admin
            ]
        );

        return back()->with('success', 'Thank you! Your sacred review and rating has been submitted.');
    }
}
