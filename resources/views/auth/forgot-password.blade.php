@extends('layouts.app')

@section('title', 'Forgot Secret Password | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card cosmic-card p-4 p-md-5" data-aos="zoom-in">
                <div class="text-center mb-4">
                    <span style="font-size: 2.5rem;">🔮</span>
                    <h3 class="cinzel-font text-gold mt-2">Recover Access</h3>
                    <p class="text-muted-cosmic" style="font-size: 0.9rem;">Enter your email to receive a celestial reset link</p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label text-gold" style="font-size: 0.88rem;">Registered Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input id="email" type="email" class="form-control cosmic-input border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="name@email.com">
                        </div>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100 py-2 mb-3">
                        <i class="bi bi-send me-2"></i> Send Password Reset Link
                    </button>

                    <div class="text-center text-muted-cosmic" style="font-size: 0.9rem;">
                        Remember your password? 
                        <a href="{{ route('login') }}" class="text-gold fw-bold text-decoration-none">Back to Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
