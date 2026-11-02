@extends('layouts.app')

@section('title', 'Terms & Conditions | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-light" style="line-height: 1.8;">
        <h1 class="cinzel-font text-gold mb-4">Terms & Conditions of Sacred Service</h1>
        <p class="text-muted-cosmic">Last Updated: January 1, 2026</p>

        <h5 class="cinzel-font text-gold mt-4">1. Agreement to Terms</h5>
        <p class="small text-muted-cosmic">
            By browsing, ordering from, or engaging with {{ setting('site_name', 'AstroStore') }}, you acknowledge and consent to these terms and conditions in full.
        </p>

        <h5 class="cinzel-font text-gold mt-4">2. Astrological Guidance Disclaimer</h5>
        <p class="small text-muted-cosmic">
            Vedic astrology and gemstone remedies are based on centuries-old spiritual traditions and classical astrological texts. They are intended as celestial aids and spiritual harmonizers. Astrological predictions do not substitute for professional medical, legal, or psychological counsel.
        </p>

        <h5 class="cinzel-font text-gold mt-4">3. Product Descriptions & Weights</h5>
        <p class="small text-muted-cosmic">
            Because our gemstones and rudrakshas are 100% natural and earth-mined, minor variations in internal inclusions, coloration, and grain shape are normal markers of authenticity. All carat and ratti measurements are certified by lab testing.
        </p>

        <h5 class="cinzel-font text-gold mt-4">4. Shipping & Delivery</h5>
        <p class="small text-muted-cosmic">
            All domestic shipments are fulfilled through reputed insured express courier partners. Standard delivery turnaround is 3 to 7 business days following custom Vedic Prana Pratishtha consecration.
        </p>
    </div>
</div>
@endsection
