@extends('layouts.admin')

@section('title', 'Add Sacred Category')
@section('page_title', 'Add New Sacred Category')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Create Category</h4>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Categories
                </a>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-gold small">Category Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g. Gemstones, Rudraksha...">
                    @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Slug (Optional - auto generated from name)</label>
                    <input type="text" name="slug" class="form-control cosmic-input @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="e.g. gemstones">
                    @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Banner / Category Image</label>
                    <input type="file" name="image" class="form-control cosmic-input @error('image') is-invalid @enderror" accept="image/*">
                    @error('image') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Description</label>
                    <textarea name="description" class="form-control cosmic-input" rows="3" placeholder="Brief cosmic explanation of this category...">{{ old('description') }}</textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control cosmic-input" value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="col-md-6 d-flex align-items-center pt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="statusSwitch" checked style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                            <label class="form-check-label text-light" for="statusSwitch">Category Active & Visible</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Save Sacred Category
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
