@extends('layouts.admin')

@section('title', 'Edit Coupon: ' . $coupon->code)
@section('page_title', 'Edit Coupon')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Edit Coupon: {{ $coupon->code }}</h4>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Coupon Code <span class="text-danger">*</span></label>
                        <input type="text" name="code" class="form-control cosmic-input @error('code') is-invalid @enderror" value="{{ old('code', $coupon->code) }}" required style="text-transform: uppercase;">
                        @error('code') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Discount Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-select cosmic-input @error('type') is-invalid @enderror" required>
                            <option value="percent" {{ old('type', $coupon->type) == 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                            <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹)</option>
                        </select>
                        @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">Value (% or ₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="value" class="form-control cosmic-input @error('value') is-invalid @enderror" value="{{ old('value', $coupon->value) }}" required>
                        @error('value') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Min Order Amount (₹)</label>
                        <input type="number" step="0.01" name="min_order" class="form-control cosmic-input" value="{{ old('min_order', $coupon->min_order) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Max Discount Cap (₹)</label>
                        <input type="number" step="0.01" name="max_discount" class="form-control cosmic-input" value="{{ old('max_discount', $coupon->max_discount) }}">
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">Usage Limit Total</label>
                        <input type="number" name="usage_limit" class="form-control cosmic-input" value="{{ old('usage_limit', $coupon->usage_limit) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Start Date</label>
                        <input type="date" name="start_date" class="form-control cosmic-input" value="{{ old('start_date', $coupon->start_date ? $coupon->start_date->format('Y-m-d') : '') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">End Date</label>
                        <input type="date" name="end_date" class="form-control cosmic-input" value="{{ old('end_date', $coupon->end_date ? $coupon->end_date->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="form-check form-switch mb-4 p-3 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                    <input class="form-check-input ms-0 me-3" type="checkbox" name="status" value="1" id="coupStatus" {{ $coupon->status ? 'checked' : '' }} style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                    <label class="form-check-label text-light" for="coupStatus">Coupon Active & Redeemable</label>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Update Coupon
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
