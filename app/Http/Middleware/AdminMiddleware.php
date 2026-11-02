<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the Admin Panel.');
        }

        $user = Auth::user();

        if ($user->status === 'blocked') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('admin.login')->with('error', 'Your account has been deactivated. Please contact support.');
        }

        if ($user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access! Admin privileges required.');
        }

        return $next($request);
    }
}
