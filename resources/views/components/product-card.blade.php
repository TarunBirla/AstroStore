@props(['product'])

@php
    $isInWishlist = false;
    if(auth()->check()){
        $isInWishlist = \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
    }
    $discountPercent = 0;
    if($product->sale_price && $product->sale_price < $product->price) {
        $discountPercent = round((($product->price - $product->sale_price) / $product->price) * 100);
    }
@endphp

<div class="card cosmic-card product-card position-relative h-100" data-aos="fade-up">
    <!-- Badges -->
    <div class="badge-overlay d-flex flex-column gap-1">
        @if($product->sale_price && $product->sale_price < $product->price)
            <span class="badge badge-saffron">{{ $discountPercent }}% OFF</span>
        @endif
        @if($product->is_featured)
            <span class="badge badge-gold">⭐ FEATURED</span>
        @endif
    </div>

    <!-- Wishlist Button -->
    <button type="button" class="wishlist-overlay-btn {{ $isInWishlist ? 'active' : '' }}" onclick="toggleWishlist({{ $product->id }}, this)" title="Add to Wishlist">
        <i class="bi {{ $isInWishlist ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
    </button>

    <!-- Product Image -->
    <a href="{{ route('product.show', $product->slug) }}" class="card-img-wrapper d-block text-decoration-none">
        @if($product->main_image && file_exists(public_path('storage/' . $product->main_image)))
            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" loading="lazy">
        @elseif($product->main_image && Str::startsWith($product->main_image, 'http'))
            <img src="{{ $product->main_image }}" alt="{{ $product->name }}" loading="lazy">
        @else
            <!-- Cosmic Placeholder Image SVG -->
            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center" style="background: radial-gradient(circle, #3d1d6b 0%, #150824 100%);">
                <i class="bi bi-gem text-gold" style="font-size: 3.5rem;"></i>
                <span class="cinzel-font text-gold mt-2" style="font-size: 0.8rem; letter-spacing: 1px;">SACRED VEDIC</span>
            </div>
        @endif
    </a>

    <!-- Card Body -->
    <div class="card-body p-3 d-flex flex-column justify-content-between">
        <div>
            @if($product->category)
                <div class="mb-1">
                    <a href="{{ route('category.show', $product->category->slug) }}" class="text-decoration-none text-muted-cosmic" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.8px;">
                        <i class="bi bi-stars text-gold me-1"></i>{{ $product->category->name }}
                    </a>
                </div>
            @endif

            <h5 class="cinzel-font mb-2" style="font-size: 0.98rem; font-weight: 700;">
                <a href="{{ route('product.show', $product->slug) }}" class="text-decoration-none text-light" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; min-height: 2.6rem;">
                    {{ $product->name }}
                </a>
            </h5>

            <!-- Ratings -->
            <div class="d-flex align-items-center gap-1 mb-2 text-gold" style="font-size: 0.82rem;">
                @php
                    $avgRating = $product->reviews_avg_rating ?? ($product->reviews()->avg('rating') ?: 5);
                @endphp
                @for($i = 1; $i <= 5; $i++)
                    <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                @endfor
                <span class="text-muted-cosmic ms-1" style="font-size: 0.75rem;">({{ $product->reviews_count ?? $product->reviews()->count() }})</span>
            </div>
        </div>

        <div>
            <!-- Price and Stock -->
            <div class="d-flex align-items-baseline justify-content-between mb-3">
                <div>
                    @if($product->sale_price && $product->sale_price < $product->price)
                        <span class="text-gold fw-bold fs-5">₹{{ number_format($product->sale_price) }}</span>
                        <span class="text-muted-cosmic text-decoration-line-through ms-1" style="font-size: 0.85rem;">₹{{ number_format($product->price) }}</span>
                    @else
                        <span class="text-gold fw-bold fs-5">₹{{ number_format($product->price) }}</span>
                    @endif
                </div>

                @if($product->stock > 0)
                    <span class="badge" style="background: rgba(34, 197, 94, 0.2); color: #86efac; border: 1px solid rgba(34, 197, 94, 0.4); font-size: 0.72rem;">In Stock</span>
                @else
                    <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.4); font-size: 0.72rem;">Out of Stock</span>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="d-grid gap-2">
                @if($product->stock > 0)
                    <button type="button" class="btn btn-cosmic-gold btn-sm d-flex align-items-center justify-content-center gap-2" onclick="addToCart({{ $product->id }})">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                @else
                    <button type="button" class="btn btn-secondary btn-sm" disabled style="border-radius: 30px; opacity: 0.6;">
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
