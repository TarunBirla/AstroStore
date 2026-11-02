@extends('layouts.app')

@section('title', 'Vedic Astrological Store | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vedic Store</li>
        </ol>
    </nav>

    <!-- Header Banner -->
    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down">
        <span class="badge badge-gold mb-2"><i class="fa-solid fa-gem me-1"></i> SACRED COLLECTION</span>
        <h1 class="display-6 fw-bold mb-2">Vedic Astrological Marketplace</h1>
        <p class="text-muted mb-0" style="max-width: 650px; margin: 0 auto;">Discover 100% authentic gemstones, energized Nepal Rudraksha, divine brass yantras & personalized consultations.</p>
    </div>

    <div class="row g-4">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="cosmic-card p-4 mb-4" style="background: var(--bg-white);">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--border-color);">
                    <h5 class="mb-0 fs-6 fw-bold"><i class="fa-solid fa-filter me-2 text-primary"></i>Filters</h5>
                    <a href="{{ route('shop') }}" class="text-muted small text-decoration-none">Reset</a>
                </div>

                <form action="{{ route('shop') }}" method="GET" id="shopFilterForm">
                    <!-- Search Input -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Search Products</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control cosmic-input" placeholder="Search gems, rudraksha..." value="{{ request('search') }}">
                            <button class="btn btn-cosmic-gold" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold mb-2">Categories</label>
                        <div class="d-flex flex-column gap-2" style="max-height: 240px; overflow-y: auto;">
                            @foreach($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="category[]" value="{{ $cat->slug }}" id="cat_{{ $cat->id }}"
                                        {{ (is_array(request('category')) && in_array($cat->slug, request('category'))) || request('category') == $cat->slug ? 'checked' : '' }}
                                        onchange="document.getElementById('shopFilterForm').submit()">
                                    <label class="form-check-label small d-flex justify-content-between align-items-center w-100" for="cat_{{ $cat->id }}">
                                        <span>{{ $cat->name }}</span>
                                        <span class="badge rounded-pill bg-light text-muted border">{{ $cat->products_count }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sort -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold mb-2">Sort By</label>
                        <select name="sort" class="form-select cosmic-input" onchange="document.getElementById('shopFilterForm').submit()">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Featured First</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Product Listing Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">Showing <strong>{{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }}</strong> of {{ $products->total() }} sacred items</span>
            </div>

            @if($products->count() > 0)
                <div class="row g-4">
                    @foreach($products as $product)
                        <div class="col-md-4 col-sm-6">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-5">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="cosmic-card p-5 text-center">
                    <i class="fa-solid fa-box-open fs-1 text-muted mb-3"></i>
                    <h4 class="fw-bold mb-2">No Items Found</h4>
                    <p class="text-muted mb-4">No sacred products matched your search or filters.</p>
                    <a href="{{ route('shop') }}" class="btn btn-cosmic-gold">Clear Filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
