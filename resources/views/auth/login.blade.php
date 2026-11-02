@extends('layouts.app')

@section('title', 'Devotee Login | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card cosmic-card p-4 p-md-5" data-aos="zoom-in">
                <div class="text-center mb-4">
                    <span style="font-size: 2.5rem;">✨</span>
                    <h3 class="cinzel-font text-gold mt-2">Devotee Portal</h3>
                    <p class="text-muted-cosmic" style="font-size: 0.9rem;">Sign in to view your orders, horoscope consults & wishlist</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-gold" style="font-size: 0.88rem;">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control cosmic-input border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="devotee@astro.com">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label text-gold mb-0" style="font-size: 0.88rem;">Secret Password</label>
                            <a href="{{ route('password.request') }}" class="text-muted-cosmic" style="font-size: 0.8rem; text-decoration: none;">Forgot Key?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                            <input id="password" type="password" class="form-control cosmic-input border-start-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                        </div>
                        @error('password')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="background-color: #150824; border-color: var(--cosmic-accent-gold);">
                        <label class="form-check-label text-muted-cosmic" for="remember" style="font-size: 0.88rem;">
                            Remember my celestial device
                        </label>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100 py-2 mb-3">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Sign In to Sacred Account
                    </button>

                    <div class="text-center text-muted-cosmic" style="font-size: 0.9rem;">
                        New to AstroStore? 
                        <a href="{{ route('register') }}" class="text-gold fw-bold text-decoration-none">Create Devotee Account</a>
                    </div>

                    <hr style="border-color: rgba(212,175,55,0.2);" class="my-4">

                    <div class="p-2 rounded text-center" style="background: rgba(61, 29, 107, 0.3); font-size: 0.82rem; border: 1px dashed rgba(212,175,55,0.3);">
                        <span class="text-muted-cosmic">Demo User:</span> <strong class="text-gold">user@astro.com</strong> | <span class="text-muted-cosmic">Pass:</span> <strong class="text-light">User@123</strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
