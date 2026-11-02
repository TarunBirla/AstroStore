@extends('layouts.admin')

@section('title', 'Edit Banner: ' . $banner->title)
@section('page_title', 'Edit Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Edit: {{ $banner->title }}</h4>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-gold small">Banner Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control cosmic-input @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" required>
                    @error('title') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Subtitle / Tagline</label>
                    <textarea name="subtitle" class="form-control cosmic-input" rows="2">{{ old('subtitle', $banner->subtitle) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Banner Image</label>
                    <div class="mb-2">
                        @php
                            $imgSrc = file_exists(public_path('storage/' . $banner->image)) ? asset('storage/' . $banner->image) : $banner->image;
                        @endphp
                        <img src="{{ $imgSrc }}" class="rounded-3 border border-warning" style="width: 140px; height: 70px; object-fit: cover;" alt="current">
                    </div>
                    <input type="file" name="image" class="form-control cosmic-input @error('image') is-invalid @enderror" accept="image/*">
                    @error('image') <span class="text-danger small d-block">{{ $message }}</span> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Position <span class="text-danger">*</span></label>
                        <select name="position" class="form-select cosmic-input" required>
                            <option value="home_slider" {{ old('position', $banner->position) == 'home_slider' ? 'selected' : '' }}>Home Top Hero Slider</option>
                            <option value="offer" {{ old('position', $banner->position) == 'offer' ? 'selected' : '' }}>Middle Auspicious Offer Banner</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control cosmic-input" value="{{ old('sort_order', $banner->sort_order) }}">
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Button Call-To-Action Text</label>
                        <input type="text" name="button_text" class="form-control cosmic-input" value="{{ old('button_text', $banner->button_text) }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Button Link Target</label>
                        <input type="text" name="button_link" class="form-control cosmic-input" value="{{ old('button_link', $banner->button_link) }}">
                    </div>
                </div>

                <div class="form-check form-switch mb-4 p-3 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                    <input class="form-check-input ms-0 me-3" type="checkbox" name="status" value="1" id="banStatus" {{ $banner->status ? 'checked' : '' }} style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                    <label class="form-check-label text-light" for="banStatus">Banner Active & Displayed</label>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Update Banner
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
