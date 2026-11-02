@extends('layouts.app')

@section('title', $category->name . ' | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Vedic Store</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header Card -->
    <div class="cosmic-card p-4 p-md-5 mb-4 position-relative overflow-hidden" data-aos="fade-down" style="background: linear-gradient(135deg, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.9) 100%);">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="badge badge-gold mb-2">✦ SACRED CATEGORY ✦</span>
                <h1 class="cinzel-font text-gold display-5 fw-bold mb-2">{{ $category->name }}</h1>
                <p class="text-light mb-3" style="line-height: 1.7; max-width: 650px;">
                    {{ $category->description }}
                </p>
                <span class="badge badge-saffron">{{ $products->total() }} Consecrated Items Available</span>
            </div>
            @if($category->image)
                <div class="col-lg-4 text-center">
                    <img src="{{ $category->image }}" alt="{{ $category->name }}" class="img-fluid rounded-4 shadow-lg" style="max-height: 180px; object-fit: cover; border: 1px solid var(--cosmic-card-border);">
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Category Switcher Pills -->
    <div class="d-flex flex-wrap gap-2 mb-4 pb-2" style="overflow-x: auto;">
        @foreach($categories as $cat)
            <a href="{{ route('category.show', $cat->slug) }}" class="btn btn-sm {{ $cat->id === $category->id ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }} rounded-pill px-3">
                {{ $cat->name }} ({{ $cat->products_count }})
            </a>
        @endforeach
    </div>

    <!-- Category Products Grid -->
    @if($products->count() > 0)
        <div class="row g-4 mb-4">
            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center pagination-cosmic">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="cosmic-card p-5 text-center my-4">
            <span style="font-size: 3rem;">✨</span>
            <h4 class="cinzel-font text-gold mt-3">No Items Found in this Category</h4>
            <p class="text-muted-cosmic">Our Acharyas are consecrating new sacred items for this sphere. Please check back shortly.</p>
            <a href="{{ route('shop') }}" class="btn btn-cosmic-gold mt-2">Browse All Products</a>
        </div>
    @endif
</div>
@endsection
