<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->status === 'blocked') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with('error', 'Your account has been deactivated. Please contact customer support.')->withInput();
            }

            $request->session()->regenerate();

            // Merge guest cart items into user's cart in database
            $sessionId = $request->session()->getId();
            $guestCarts = Cart::where('session_id', $sessionId)->get();
            foreach ($guestCarts as $guestCart) {
                $userCart = Cart::where('user_id', $user->id)
                    ->where('product_id', $guestCart->product_id)
                    ->first();
                if ($userCart) {
                    $userCart->qty += $guestCart->qty;
                    $userCart->save();
                    $guestCart->delete();
                } else {
                    $guestCart->user_id = $user->id;
                    $guestCart->session_id = null;
                    $guestCart->save();
                }
            }

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Welcome to Cosmic Admin Panel, ' . $user->name);
            }

            return redirect()->intended(route('user.dashboard'))->with('success', 'Namaste ' . $user->name . '! Welcome to AstroStore.');
        }

        return back()->withErrors([
            'email' => 'The provided celestial credentials do not match our sacred records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'You have been logged out safely. May celestial blessings follow you.');
    }
}
