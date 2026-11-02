@extends('layouts.app')

@section('title', '404 - Planetary Locus Not Found | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="cosmic-card p-5" data-aos="zoom-in" style="border: 2px solid var(--cosmic-accent-gold);">
                <div style="font-size: 5rem; filter: drop-shadow(0 0 20px rgba(212,175,55,0.6));">🪐</div>
                <h1 class="cinzel-font text-gold display-3 fw-bold mb-2">404</h1>
                <h3 class="cinzel-font text-light mb-3">Celestial Locus Not Found</h3>
                <p class="text-muted-cosmic mb-4" style="line-height: 1.8;">
                    The astrological coordinates or celestial page you are attempting to traverse has moved out of alignment.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-cosmic-gold px-4">
                        <i class="bi bi-house-door me-2"></i> Return to Sacred Home
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-cosmic-outline px-4">
                        <i class="bi bi-compass me-2"></i> Explore Store
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
