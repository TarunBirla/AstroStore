@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)
@section('page_title', 'Edit User Account')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Edit: {{ $user->name }}</h4>
                <a href="{{ route('admin.users.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control cosmic-input @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Phone / WhatsApp</label>
                        <input type="text" name="phone" class="form-control cosmic-input" value="{{ old('phone', $user->phone) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Reset Password (Leave blank to keep current)</label>
                        <input type="password" name="password" class="form-control cosmic-input @error('password') is-invalid @enderror" placeholder="••••••••">
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Access Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select cosmic-input" required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Devotee (Customer / User)</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Account Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select cosmic-input" required>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="blocked" {{ old('status', $user->status) == 'blocked' ? 'selected' : '' }}>Blocked / Deactivated</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Update Avatar</label>
                    @if($user->avatar)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle border border-warning" style="width: 50px; height: 50px; object-fit: cover;" alt="current">
                        </div>
                    @endif
                    <input type="file" name="avatar" class="form-control cosmic-input" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Street Address</label>
                    <textarea name="address" class="form-control cosmic-input" rows="2">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">City</label>
                        <input type="text" name="city" class="form-control cosmic-input" value="{{ old('city', $user->city) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-gold small">State</label>
                        <input type="text" name="state" class="form-control cosmic-input" value="{{ old('state', $user->state) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-gold small">PIN Code</label>
                        <input type="text" name="pincode" class="form-control cosmic-input" value="{{ old('pincode', $user->pincode) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Update User Account
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
