<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class PageController extends Controller
{
    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you! Your sacred query has been transmitted to our Acharyas. We will respond within 24 auspicious hours.');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function refundPolicy()
    {
        return view('frontend.pages.refund-policy');
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        return back()->with('success', 'Blessed! You are now subscribed to sacred celestial newsletters.');
    }
}
