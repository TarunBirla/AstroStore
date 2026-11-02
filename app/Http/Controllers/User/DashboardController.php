<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $deliveredOrders = Order::where('user_id', $user->id)->where('status', 'delivered')->count();
        $totalSpent = Order::where('user_id', $user->id)->where('status', '!=', 'cancelled')->sum('total');
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();

        $recentOrders = Order::where('user_id', $user->id)
            ->with(['items.product', 'payment'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'user',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'totalSpent',
            'wishlistCount',
            'recentOrders'
        ));
    }

    public function wishlist()
    {
        $user = Auth::user();
        $wishlistItems = Wishlist::where('user_id', $user->id)
            ->with('product.category')
            ->latest()
            ->paginate(12);

        return view('user.wishlist', compact('wishlistItems'));
    }
}
