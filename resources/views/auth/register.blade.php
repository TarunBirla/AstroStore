@extends('layouts.app')

@section('title', 'Register Devotee Account | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card cosmic-card p-4 p-md-5" data-aos="zoom-in">
                <div class="text-center mb-4">
                    <span style="font-size: 2.5rem;">✨</span>
                    <h3 class="cinzel-font text-gold mt-2">Create Devotee Account</h3>
                    <p class="text-muted-cosmic" style="font-size: 0.9rem;">Join thousands of seekers receiving personalized astrological guidance</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-gold" style="font-size: 0.88rem;">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                <i class="bi bi-person"></i>
                            </span>
                            <input id="name" type="text" class="form-control cosmic-input border-start-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="e.g. Aarav Sharma">
                        </div>
                        @error('name')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label text-gold" style="font-size: 0.88rem;">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input id="email" type="email" class="form-control cosmic-input border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@email.com">
                            </div>
                            @error('email')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label text-gold" style="font-size: 0.88rem;">WhatsApp / Mobile</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                    <i class="bi bi-phone"></i>
                                </span>
                                <input id="phone" type="text" class="form-control cosmic-input border-start-0 @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="+91 9876543210">
                            </div>
                            @error('phone')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="password" class="form-label text-gold" style="font-size: 0.88rem;">Password (Min. 6)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input id="password" type="password" class="form-control cosmic-input border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label text-gold" style="font-size: 0.88rem;">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                                <input id="password_confirmation" type="password" class="form-control cosmic-input border-start-0" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100 py-2 mb-3">
                        <i class="bi bi-person-check me-2"></i> Register Celestial Account
                    </button>

                    <div class="text-center text-muted-cosmic" style="font-size: 0.9rem;">
                        Already registered? 
                        <a href="{{ route('login') }}" class="text-gold fw-bold text-decoration-none">Sign In Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
