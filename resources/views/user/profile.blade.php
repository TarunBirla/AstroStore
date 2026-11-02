@extends('layouts.app')

@section('title', 'Devotee Profile & Address | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Devotee Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <!-- Profile Info Form -->
            <div class="cosmic-card p-4 p-md-5 mb-4">
                <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-person-lines-fill me-2"></i>Personal & Shipping Particulars
                </h4>

                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Full Devotee Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-gold small">Email Address (Locked)</label>
                            <input type="email" class="form-control cosmic-input" value="{{ $user->email }}" disabled style="opacity: 0.7;">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Contact WhatsApp / Mobile</label>
                            <input type="text" name="phone" class="form-control cosmic-input @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" placeholder="+91 9876543210">
                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-gold small">Update Profile Picture</label>
                            <input type="file" name="avatar" class="form-control cosmic-input @error('avatar') is-invalid @enderror" accept="image/*">
                            @error('avatar') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-gold small">Default Postal Street Address</label>
                        <textarea name="address" class="form-control cosmic-input @error('address') is-invalid @enderror" rows="3" placeholder="Enter house number, building, street or landmark...">{{ old('address', $user->address) }}</textarea>
                        @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-gold small">City</label>
                            <input type="text" name="city" class="form-control cosmic-input @error('city') is-invalid @enderror" value="{{ old('city', $user->city) }}">
                            @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-gold small">State</label>
                            <input type="text" name="state" class="form-control cosmic-input @error('state') is-invalid @enderror" value="{{ old('state', $user->state) }}">
                            @error('state') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-gold small">PIN Code</label>
                            <input type="text" name="pincode" class="form-control cosmic-input @error('pincode') is-invalid @enderror" value="{{ old('pincode', $user->pincode) }}">
                            @error('pincode') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold px-4">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </form>
            </div>

            <!-- Change Password Form -->
            <div class="cosmic-card p-4 p-md-5 mb-4">
                <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-shield-lock me-2"></i>Change Secret Password
                </h4>

                <form action="{{ route('user.password.change') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label text-gold small">Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="current_password" class="form-control cosmic-input @error('current_password') is-invalid @enderror" required placeholder="••••••••">
                        @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">New Password (Min. 6) <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control cosmic-input @error('password') is-invalid @enderror" required placeholder="••••••••">
                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-gold small">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control cosmic-input" required placeholder="••••••••">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold px-4">
                        <i class="bi bi-key me-1"></i> Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
