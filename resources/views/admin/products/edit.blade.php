@extends('layouts.admin')

@section('title', 'Edit Product: ' . $product->name)
@section('page_title', 'Edit Consecrated Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Edit: {{ $product->name }}</h4>
                <a href="{{ route('admin.products.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Info -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                        @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Sacred Category <span class="text-danger">*</span></label>
                        <select name="category_id" class="form-select cosmic-input @error('category_id') is-invalid @enderror" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Slug</label>
                        <input type="text" name="slug" class="form-control cosmic-input @error('slug') is-invalid @enderror" value="{{ old('slug', $product->slug) }}">
                        @error('slug') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">SKU Code</label>
                        <input type="text" name="sku" class="form-control cosmic-input @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}">
                        @error('sku') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Pricing & Stock -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label text-gold small">Regular Price (₹) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="price" class="form-control cosmic-input @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                        @error('price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Sale / Offer Price (₹)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control cosmic-input @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price) }}">
                        @error('sale_price') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label text-gold small">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" name="stock" class="form-control cosmic-input @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="mb-3">
                    <label class="form-label text-gold small">Short Summary Description</label>
                    <textarea name="short_description" class="form-control cosmic-input" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Detailed Astrological Description & Vidhi <span class="text-danger">*</span></label>
                    <textarea name="description" class="form-control cosmic-input" rows="6" required>{{ old('description', $product->description) }}</textarea>
                    @error('description') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>

                <!-- Images Section -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Primary Main Image</label>
                        @if($product->main_image)
                            <div class="mb-2">
                                @php $src = file_exists(public_path('storage/' . $product->main_image)) ? asset('storage/' . $product->main_image) : $product->main_image; @endphp
                                <img src="{{ $src }}" class="rounded-3 border border-warning" style="width: 80px; height: 80px; object-fit: cover;" alt="current">
                            </div>
                        @endif
                        <input type="file" name="main_image" class="form-control cosmic-input @error('main_image') is-invalid @enderror" accept="image/*">
                        @error('main_image') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Upload More Gallery Images</label>
                        <input type="file" name="gallery_images[]" class="form-control cosmic-input" multiple accept="image/*">
                    </div>
                </div>

                <!-- Existing Gallery Images -->
                @if($product->images->isNotEmpty())
                    <div class="mb-4 p-3 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                        <label class="form-label text-gold small mb-2 d-block">Current Gallery Images (Click trash icon to remove)</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($product->images as $gImg)
                                <div class="position-relative d-inline-block">
                                    @php $gSrc = file_exists(public_path('storage/' . $gImg->image_path)) ? asset('storage/' . $gImg->image_path) : $gImg->image_path; @endphp
                                    <img src="{{ $gSrc }}" class="rounded-3 border border-secondary" style="width: 75px; height: 75px; object-fit: cover;" alt="gallery">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 p-0 rounded-circle d-flex align-items-center justify-content-center" style="width: 22px; height: 22px; transform: translate(30%, -30%);" onclick="document.getElementById('delGImg{{ $gImg->id }}').submit();" title="Delete image">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Status & Featured -->
                <div class="row g-3 mb-4 p-3 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="1" id="prodStatus" {{ $product->status ? 'checked' : '' }} style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
                            <label class="form-check-label text-light" for="prodStatus">Product Active & Visible on Store</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="prodFeatured" {{ $product->is_featured ? 'checked' : '' }} style="background-color: #3d1d6b; border-color: var(--cosmic-accent-gold);">
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
                            <input type="text" name="meta_title" class="form-control cosmic-input" value="{{ old('meta_title', $product->meta_title) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted-cosmic small">Meta Description</label>
                            <input type="text" name="meta_description" class="form-control cosmic-input" value="{{ old('meta_description', $product->meta_description) }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-save me-1"></i> Update Consecrated Product
                </button>
            </form>

            @foreach($product->images as $gImg)
                <form action="{{ route('admin.product-images.delete', $gImg->id) }}" method="POST" id="delGImg{{ $gImg->id }}" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
