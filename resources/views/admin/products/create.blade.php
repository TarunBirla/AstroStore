@extends('layouts.admin')

@section('title', 'Add Consecrated Product')
@section('page_title', 'Create Consecrated Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Add Sacred Item to Inventory</h4>
                <a href="{{ route('admin.products.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Products
                </a>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Basic Info -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="e.g. Ceylon Natural Yellow Sapphire - 4.5 Ratti">
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Sacred Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select cosmic-input @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Slug (Optional - auto generated)</label>
                        <input type="text" name="slug" class="form-control cosmic-input @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="ceylon-natural-yellow-sapphire">
                        @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">SKU Code</label>
                        <input type="text" name="sku" class="form-control cosmic-input @error('sku') is-invalid @enderror" value="{{ old('sku') }}" placeholder="e.g. GEM-PUK-001">
                        @error('sku') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">Regular Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control cosmic-input @error('price') is-invalid @enderror" value="{{ old('price') }}" required placeholder="15000">
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Sale / Offer Price (₹)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control cosmic-input @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}" placeholder="12999">
                        @error('sale_price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control cosmic-input @error('stock') is-invalid @enderror" value="{{ old('stock', 10) }}" required>
                        @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="mb-3">
                    <label class="form-label text-gold small">Short Summary Description</label>
                    <textarea name="short_description" class="form-control cosmic-input" rows="2" placeholder="Brief 1-2 sentence preview for cards...">{{ old('short_description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Detailed Astrological Description & Vidhi <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control cosmic-input" rows="6" required placeholder="Full description of planetary benefits, lab certification details, wearing guidelines...">{{ old('description') }}</textarea>
                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Images -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Primary Main Image <span class="text-danger">*</span></label>
                        <input type="file" name="main_image" class="form-control cosmic-input @error('main_image') is-invalid @enderror" accept="image/*">
                        @error('main_image') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Additional Gallery Images (Multiple)</label>
                        <input type="file" name="gallery_images[]" class="form-control cosmic-input" multiple accept="image/*">
                    </div>
                </div>

                <!-- Status & Featured -->
                <div class="row g-3 mb-4 p-3 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="prodStatus" checked style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                            <label class="form-check-label text-light" for="prodStatus">Product Active & Visible on Store</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="prodFeatured" style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                            <label class="form-check-label text-gold fw-bold" for="prodFeatured">⭐ Showcase in Featured Carousel</label>
                        </div>
                    </div>
                </div>

                <!-- SEO Meta -->
                <div class="mb-4">
                    <h6 class="cinzel-font text-gold mb-3"><i class="bi bi-search me-1"></i>Search Engine Optimization (SEO)</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted-cosmic small">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control cosmic-input" value="{{ old('meta_title') }}" placeholder="Custom meta title for Google...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-cosmic small">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control cosmic-input" value="{{ old('meta_description') }}" placeholder="Brief meta description...">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-plus-circle me-1"></i> Consecrate & Publish Product
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
