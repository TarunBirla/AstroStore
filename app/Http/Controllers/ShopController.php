<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('status', 1)->with(['category', 'reviews']);

        // Search Keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category Filter (array or single)
        if ($request->filled('category')) {
            $catParam = $request->category;
            if (is_array($catParam)) {
                $query->whereHas('category', function ($q) use ($catParam) {
                    $q->whereIn('slug', $catParam);
                });
            } else {
                $query->whereHas('category', function ($q) use ($catParam) {
                    $q->where('slug', $catParam);
                });
            }
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float)$request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float)$request->max_price);
        }

        // Stock Filter
        if ($request->filled('in_stock') && $request->in_stock == 1) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        switch ($request->get('sort', 'latest')) {
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', 1)->withCount('products')->get();
        $maxPrice = Product::where('status', 1)->max('price') ?: 25000;

        return view('frontend.shop', compact('products', 'categories', 'maxPrice'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 1)->firstOrFail();

        $products = Product::where('status', 1)
            ->where('category_id', $category->id)
            ->with(['category', 'reviews'])
            ->latest()
            ->paginate(12);

        $categories = Category::where('status', 1)->withCount('products')->get();

        return view('frontend.category', compact('category', 'products', 'categories'));
    }
}
