<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'status' => 'active',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // Merge any guest cart items
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

        return redirect()->route('user.dashboard')->with('success', 'Your sacred devotee account has been created successfully!');
    }
}
