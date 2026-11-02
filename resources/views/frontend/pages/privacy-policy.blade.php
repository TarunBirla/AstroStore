@extends('layouts.app')

@section('title', 'Privacy Policy | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-light" style="line-height: 1.8;">
        <h1 class="cinzel-font text-gold mb-4">Celestial Privacy Policy</h1>
        <p class="text-muted-cosmic">Effective Date: January 1, 2026</p>

        <h5 class="cinzel-font text-gold mt-4">1. Information We Collect</h5>
        <p class="small text-muted-cosmic">
            We collect personal information such as your name, shipping address, email, phone number, and astrological birth particulars (date, time, and location of birth) exclusively to deliver physical orders and compile horoscope consultation reports.
        </p>

        <h5 class="cinzel-font text-gold mt-4">2. Sacred Confidentiality of Birth Data</h5>
        <p class="small text-muted-cosmic">
            Your Janam Kundli and personal birth details are treated with divine confidentiality. They are accessible solely by the assigned consulting Acharya and are never sold, rented, or distributed to any third parties.
        </p>

        <h5 class="cinzel-font text-gold mt-4">3. Payment Security</h5>
        <p class="small text-muted-cosmic">
            All digital payments through UPI, Cards, and NetBanking are securely processed via PCI-DSS compliant payment gateways (such as Razorpay). We never record, process, or store raw credit/debit card numbers or bank passwords on our servers.
        </p>

        <h5 class="cinzel-font text-gold mt-4">4. Cookies & Celestial Analytics</h5>
        <p class="small text-muted-cosmic">
            We utilize standard cookies to preserve your cart session across devices and optimize user preferences. You can disable cookies via your browser settings at any time.
        </p>

        <h5 class="cinzel-font text-gold mt-4">5. Contact Our Privacy Officer</h5>
        <p class="small text-muted-cosmic">
            For questions regarding your personal information, reach out to our team at <strong>{{ setting('email', 'blessings@astrostore.com') }}</strong>.
        </p>
    </div>
</div>
@endsection
