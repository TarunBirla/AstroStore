@extends('layouts.app')

@section('title', 'Reset Secret Password | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card cosmic-card p-4 p-md-5" data-aos="zoom-in">
                <div class="text-center mb-4">
                    <span style="font-size: 2.5rem;">🔑</span>
                    <h3 class="cinzel-font text-gold mt-2">Reset Password</h3>
                    <p class="text-muted-cosmic" style="font-size: 0.9rem;">Set a new secure password for your devotee account</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <label for="email" class="form-label text-gold" style="font-size: 0.88rem;">Email Address</label>
                        <input id="email" type="email" class="form-control cosmic-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autofocus readonly>
                        @error('email')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-gold" style="font-size: 0.88rem;">New Password</label>
                        <input id="password" type="password" class="form-control cosmic-input @error('password') is-invalid @enderror" name="password" required placeholder="••••••••">
                        @error('password')
                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label text-gold" style="font-size: 0.88rem;">Confirm New Password</label>
                        <input id="password_confirmation" type="password" class="form-control cosmic-input" name="password_confirmation" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100 py-2 mb-3">
                        <i class="bi bi-check-circle me-2"></i> Update Password & Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
