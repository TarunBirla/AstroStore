<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Banner::where('position', 'home_slider')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        $offerBanner = Banner::where('position', 'offer')
            ->where('status', 1)
            ->orderBy('sort_order', 'asc')
            ->first();

        $categories = Category::where('status', 1)
            ->withCount('products')
            ->orderBy('sort_order', 'asc')
            ->get();

        $featuredProducts = Product::where('status', 1)
            ->where('is_featured', 1)
            ->with(['category', 'reviews'])
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::where('status', 1)
            ->with(['category', 'reviews'])
            ->latest()
            ->take(8)
            ->get();

        $latestBlogs = Blog::where('status', 1)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.home', compact(
            'sliders',
            'offerBanner',
            'categories',
            'featuredProducts',
            'newArrivals',
            'latestBlogs'
        ));
    }
}
