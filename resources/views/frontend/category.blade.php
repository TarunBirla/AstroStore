@extends('layouts.app')

@section('title', $category->name . ' | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Vedic Store</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <!-- Category Header Card -->
    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down">
        <span class="badge badge-gold mb-2"><i class="fa-solid fa-gem me-1"></i> CATEGORY COLLECTION</span>
        <h1 class="display-6 fw-bold mb-2">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-muted mb-0" style="max-width: 650px; margin: 0 auto;">{{ $category->description }}</p>
        @endif
    </div>

    <!-- Product Grid -->
    @if($products->count() > 0)
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>
    @else
        <div class="cosmic-card p-5 text-center">
            <i class="fa-solid fa-box-open fs-1 text-muted mb-3"></i>
            <h4 class="fw-bold mb-2">No Items in this Category</h4>
            <p class="text-muted mb-4">We are currently consecrating new items for this category.</p>
            <a href="{{ route('shop') }}" class="btn btn-cosmic-gold">Browse Full Store</a>
        </div>
    @endif
</div>
@endsection
