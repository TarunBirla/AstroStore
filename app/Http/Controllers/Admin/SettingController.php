<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $rawSettings = Setting::all();
        $settings = [];
        foreach ($rawSettings as $s) {
            $settings[$s->key] = $s->value;
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'site_name',
            'site_tagline',
            'email',
            'phone',
            'address',
            'currency',
            'currency_symbol',
            'shipping_charge',
            'free_shipping_above',
            'tax_percent',
            'facebook_url',
            'instagram_url',
            'youtube_url',
            'whatsapp_number',
            'razorpay_key_id',
            'razorpay_key_secret',
            'meta_title',
            'meta_description',
        ];

        foreach ($keys as $k) {
            if ($request->has($k)) {
                Setting::updateOrCreate(['key' => $k], ['value' => $request->input($k)]);
                Cache::forget('setting_' . $k);
            }
        }

        // Logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
            Cache::forget('setting_logo');
        }

        // Favicon upload
        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::updateOrCreate(['key' => 'favicon'], ['value' => $path]);
            Cache::forget('setting_favicon');
        }

        return back()->with('success', 'Cosmic store settings updated and cache refreshed.');
    }
}
