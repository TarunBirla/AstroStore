@extends('layouts.app')

@section('title', 'Vedic Astrological Store | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vedic Store</li>
        </ol>
    </nav>

    <!-- Header Banner -->
    <div class="cosmic-card p-4 mb-4 text-center" data-aos="fade-down" style="background: radial-gradient(circle at center, rgba(61,29,107,0.6) 0%, rgba(26,11,46,0.9) 100%); border-color: rgba(212,175,55,0.4);">
        <h2 class="cinzel-font text-gold display-6 mb-2">Sacred Celestial Marketplace</h2>
        <p class="text-muted-cosmic mb-0">Discover authentic gemstones, blessed rudrakshas, divine yantras & expert consultations</p>
    </div>

    <div class="row g-4">
        <!-- Filter Sidebar -->
        <div class="col-lg-3">
            <div class="cosmic-card p-4 sticky-top" style="top: 90px; z-index: 10;">
                <div class="d-flex align-items-center justify-content-between mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <h5 class="cinzel-font text-gold mb-0"><i class="bi bi-funnel me-2"></i>Refine Remedies</h5>
                    <a href="{{ route('shop') }}" class="text-muted-cosmic small text-decoration-none">Reset All</a>
                </div>

                <form action="{{ route('shop') }}" method="GET" id="shopFilterForm">
                    <!-- Search Input -->
                    <div class="mb-4">
                        <label class="form-label text-gold small fw-bold">Search Keywords</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control cosmic-input" placeholder="e.g. Sapphire, Rudraksha..." value="{{ request('search') }}">
                            <button class="btn btn-cosmic-gold" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="form-label text-gold small fw-bold mb-2">Sacred Categories</label>
                        <div class="d-flex flex-column gap-2" style="max-height: 220px; overflow-y: auto;">
                            @foreach($categories as $cat)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="category[]" value="{{ $cat->slug }}" id="cat_{{ $cat->id }}"
                                        {{ (is_array(request('category')) && in_array($cat->slug, request('category'))) || request('category') == $cat->slug ? 'checked' : '' }}
                                        onchange="document.getElementById('shopFilterForm').submit()">
                                    <label class="form-check-label text-light small d-flex justify-content-between align-items-center w-100" for="cat_{{ $cat->id }}">
                                        <span>{{ $cat->name }}</span>
                                        <span class="badge badge-cosmic" style="font-size: 0.7rem;">{{ $cat->products_count }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="mb-4">
                        <label class="form-label text-gold small fw-bold mb-2">Price Range (₹)</label>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <input type="number" name="min_price" class="form-control cosmic-input form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                            <span class="text-muted-cosmic">-</span>
                            <input type="number" name="max_price" class="form-control cosmic-input form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn btn-cosmic-outline btn-sm w-100 mt-2">Filter Price</button>
                    </div>

                    <!-- In Stock Only -->
                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" name="in_stock" value="1" id="inStockCheck" {{ request('in_stock') == '1' ? 'checked' : '' }} onchange="document.getElementById('shopFilterForm').submit()">
                        <label class="form-check-label text-light small" for="inStockCheck">
                            In-Stock Items Only
                        </label>
                    </div>

                    <!-- Retain Sort in Form -->
                    <input type="hidden" name="sort" value="{{ request('sort', 'latest') }}">

                    <div class="d-grid">
                        <button type="submit" class="btn btn-cosmic-gold btn-sm">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Grid & Toolbar -->
        <div class="col-lg-9">
            <!-- Toolbar -->
            <div class="cosmic-card p-3 mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="text-muted-cosmic small">
                    Showing <strong class="text-gold">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong> of <strong class="text-gold">{{ $products->total() }}</strong> Sacred Items
                </div>

                <div class="d-flex align-items-center gap-2">
                    <label class="text-gold small mb-0 d-none d-sm-inline">Sort By:</label>
                    <select class="form-select cosmic-input form-select-sm" style="width: 190px;" onchange="location = this.value;">
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Consecrated</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low_high']) }}" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high_low']) }}" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'name_asc']) }}" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A to Z</option>
                    </select>
                </div>
            </div>

            <!-- Products List -->
            @if($products->count() > 0)
                <div class="row g-4 mb-4">
                    @foreach($products as $product)
                        <div class="col-xl-4 col-md-6 col-sm-6">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center pagination-cosmic">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="cosmic-card p-5 text-center my-4">
                    <span style="font-size: 3rem;">🔮</span>
                    <h4 class="cinzel-font text-gold mt-3">No Celestial Items Match Your Criteria</h4>
                    <p class="text-muted-cosmic">Try adjusting your filters or search keywords to discover matching astrological remedies.</p>
                    <a href="{{ route('shop') }}" class="btn btn-cosmic-gold mt-2">Clear All Filters</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
