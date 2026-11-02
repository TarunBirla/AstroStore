<?php

use App\Models\Setting;
use App\Models\Cart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

if (!function_exists('setting')) {
    /**
     * Get or set settings with caching
     */
    function setting($key, $default = null) {
        try {
            return Cache::remember('setting_' . $key, 86400, function () use ($key, $default) {
                $setting = Setting::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Throwable $e) {
            return $default;
        }
    }
}

if (!function_exists('getCartCount')) {
    /**
     * Get current cart item count for user or guest
     */
    function getCartCount() {
        try {
            if (auth()->check()) {
                return (int) Cart::where('user_id', auth()->id())->sum('qty');
            } else {
                $sessionId = Session::getId();
                return (int) Cart::where('session_id', $sessionId)->sum('qty');
            }
        } catch (\Throwable $e) {
            return 0;
        }
    }
}

if (!function_exists('formatPrice')) {
    /**
     * Format currency price with ₹ symbol
     */
    function formatPrice($amount) {
        return '₹' . number_format((float)$amount, 2);
    }
}
