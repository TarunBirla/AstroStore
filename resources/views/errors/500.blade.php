@extends('layouts.app')

@section('title', '500 - Planetary Disturbance | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="cosmic-card p-5" data-aos="zoom-in" style="border: 2px solid #ef4444;">
                <div style="font-size: 5rem; filter: drop-shadow(0 0 20px rgba(239,68,68,0.6));">⚡</div>
                <h1 class="cinzel-font text-danger display-3 fw-bold mb-2">500</h1>
                <h3 class="cinzel-font text-light mb-3">Planetary Disturbance Encountered</h3>
                <p class="text-muted-cosmic mb-4" style="line-height: 1.8;">
                    An unexpected cosmic alignment error occurred while communicating with our sanctuary servers. Our Acharyas are attending to the ritual balance.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-cosmic-gold px-4">
                        <i class="bi bi-house-door me-2"></i> Return Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
