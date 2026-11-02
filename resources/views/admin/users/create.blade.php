@extends('layouts.admin')

@section('title', 'Register New User')
@section('page_title', 'Register New User / Admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Create User Record</h4>
                <a href="{{ route('admin.users.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Users
                </a>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g. Anand Prakash">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control cosmic-input @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="anand@email.com">
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Phone / WhatsApp</label>
                        <input type="text" name="phone" class="form-control cosmic-input" value="{{ old('phone') }}" placeholder="+91 9876543210">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Initial Password (Min. 6) <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control cosmic-input @error('password') is-invalid @enderror" required placeholder="••••••••">
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Access Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select cosmic-input" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Devotee (Customer / User)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Account Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select cosmic-input" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="blocked" {{ old('status') == 'blocked' ? 'selected' : '' }}>Blocked / Deactivated</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Profile Photo (Avatar)</label>
                    <input type="file" name="avatar" class="form-control cosmic-input" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Postal Street Address</label>
                    <textarea name="address" class="form-control cosmic-input" rows="2" placeholder="House, street, landmark...">{{ old('address') }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">City</label>
                        <input type="text" name="city" class="form-control cosmic-input" value="{{ old('city') }}" placeholder="City">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-gold small">State</label>
                        <input type="text" name="state" class="form-control cosmic-input" value="{{ old('state') }}" placeholder="State">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-gold small">PIN Code</label>
                        <input type="text" name="pincode" class="form-control cosmic-input" value="{{ old('pincode') }}" placeholder="PIN">
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-person-check me-1"></i> Register Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
