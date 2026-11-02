@extends('layouts.admin')

@section('title', 'Edit Category: ' . $category->name)
@section('page_title', 'Edit Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Edit Category: {{ $category->name }}</h4>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-gold small">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Slug</label>
                    <input type="text" name="slug" class="form-control cosmic-input @error('slug') is-invalid @enderror" value="{{ old('slug', $category->slug) }}">
                    @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Category Image</label>
                    @if($category->image)
                        <div class="mb-2">
                            @php $src = file_exists(public_path('storage/' . $category->image)) ? asset('storage/' . $category->image) : $category->image; @endphp
                            <img src="{{ $src }}" class="rounded-3 border border-warning" style="width: 80px; height: 80px; object-fit: cover;" alt="current">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control cosmic-input @error('image') is-invalid @enderror" accept="image/*">
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Description</label>
                    <textarea name="description" class="form-control cosmic-input" rows="3">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control cosmic-input" value="{{ old('sort_order', $category->sort_order) }}">
                    </div>

                    <div class="col-md-6 d-flex align-items-center pt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" {{ $category->status ? 'checked' : '' }} style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                            <label class="form-check-label text-light" for="statusSwitch">Category Active & Visible</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Update Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
