@extends('layouts.app')

@section('title', 'Refund & Return Policy | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Refund Policy</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-light" style="line-height: 1.8;">
        <h1 class="cinzel-font text-gold mb-4">Refund & Return Policy</h1>
        <p class="text-muted-cosmic">Our commitment to your spiritual contentment</p>

        <h5 class="cinzel-font text-gold mt-4">1. 7-Day Hassle-Free Replacement</h5>
        <p class="small text-muted-cosmic">
            If your consecrated parcel arrives physically damaged during transit, or if an incorrect item has been dispatched, you may initiate a replacement request within 7 calendar days of receipt.
        </p>

        <h5 class="cinzel-font text-gold mt-4">2. Lifetime Authenticity Guarantee</h5>
        <p class="small text-muted-cosmic">
            Every gemstone sold carries a 100% lifetime buyback/refund guarantee if proved non-natural by any recognized gemological testing institution.
        </p>

        <h5 class="cinzel-font text-gold mt-4">3. Personalized Kundli & Video Consultations</h5>
        <p class="small text-muted-cosmic">
            Because Janam Kundli charts and live Acharya video sessions involve dedicated personal scholarly labor and customization, fees for performed consultations and printed bespoke charts are non-refundable once delivered.
        </p>

        <h5 class="cinzel-font text-gold mt-4">4. How to Request Return</h5>
        <p class="small text-muted-cosmic">
            Contact us at <strong>{{ setting('email', 'blessings@astrostore.com') }}</strong> or message our WhatsApp desk at <strong>{{ setting('whatsapp_number', '+91 98765 43210') }}</strong> with your Order Number and photos of the package.
        </p>
    </div>
</div>
@endsection
