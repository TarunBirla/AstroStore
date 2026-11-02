@extends('layouts.app')

@section('title', 'My Sacred Wishlist | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Devotee Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sacred Wishlist</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="cosmic-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-suit-heart-fill text-danger me-2"></i>My Saved Celestial Items</h4>
                    <span class="badge badge-gold">{{ $wishlistItems->total() }} Items Saved</span>
                </div>

                @if($wishlistItems->isNotEmpty())
                    <div class="row g-4 mb-4">
                        @foreach($wishlistItems as $item)
                            @if($item->product)
                                <div class="col-xl-4 col-md-6 col-sm-6">
                                    <x-product-card :product="$item->product" />
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center pagination-cosmic">
                        {{ $wishlistItems->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="p-5 text-center text-muted-cosmic">
                        <i class="bi bi-heartbreak fs-1 d-block mb-2 text-danger"></i>
                        <h5>Your Sacred Wishlist is currently empty.</h5>
                        <p class="small">Tap the heart icon on any product to save remedies for future consideration.</p>
                        <a href="{{ route('shop') }}" class="btn btn-cosmic-gold btn-sm mt-2">Explore Sacred Store</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
