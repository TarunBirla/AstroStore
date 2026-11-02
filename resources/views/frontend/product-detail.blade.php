@extends('layouts.app')

@section('title', ($product->meta_title ?: $product->name) . ' | ' . setting('site_name', 'AstroStore'))
@section('meta_description', $product->meta_description ?: $product->short_description)

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Vedic Store</a></li>
            @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->name, 35) }}</li>
        </ol>
    </nav>

    <!-- Product Overview Card -->
    <div class="cosmic-card p-4 p-md-5 mb-5" data-aos="fade-up">
        <div class="row g-4 g-lg-5">
            <!-- Product Images Gallery -->
            <div class="col-lg-6">
                <div class="position-relative mb-3 overflow-hidden rounded-4" style="background: rgba(15, 5, 29, 0.85); border: 1px solid var(--cosmic-card-border); aspect-ratio: 1/1;">
                    @php
                        $mainImg = $product->main_image;
                        $displaySrc = ($mainImg && file_exists(public_path('storage/' . $mainImg)))
                            ? asset('storage/' . $mainImg)
                            : ($mainImg ?: 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80');
                    @endphp
                    <img id="mainProductImage" src="{{ $displaySrc }}" alt="{{ $product->name }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.4s ease;">
                    
                    @if($product->sale_price && $product->sale_price < $product->price)
                        <div class="badge-overlay">
                            <span class="badge badge-saffron fs-6">
                                {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Gallery Thumbnails -->
                <div class="d-flex gap-2 overflow-x-auto pb-2">
                    <img src="{{ $displaySrc }}" class="rounded-3 border border-warning" style="width: 72px; height: 72px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('mainProductImage').src = this.src" alt="thumb">
                    @foreach($product->images as $img)
                        @php
                            $thumbSrc = file_exists(public_path('storage/' . $img->image_path)) ? asset('storage/' . $img->image_path) : $img->image_path;
                        @endphp
                        <img src="{{ $thumbSrc }}" class="rounded-3 border border-secondary" style="width: 72px; height: 72px; object-fit: cover; cursor: pointer;" onclick="document.getElementById('mainProductImage').src = this.src" alt="thumb">
                    @endforeach
                </div>
            </div>

            <!-- Product Info & Actions -->
            <div class="col-lg-6 d-flex flex-column justify-content-between">
                <div>
                    @if($product->category)
                        <div class="mb-2">
                            <a href="{{ route('category.show', $product->category->slug) }}" class="badge badge-cosmic text-decoration-none px-3 py-1">
                                <i class="bi bi-tag-fill text-gold me-1"></i>{{ $product->category->name }}
                            </a>
                        </div>
                    @endif

                    <h1 class="cinzel-font text-gold fs-2 fw-bold mb-2">{{ $product->name }}</h1>

                    <!-- Ratings & SKU -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <div class="d-flex align-items-center text-gold fs-6">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= round($avgRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                            <span class="text-light ms-2 small">({{ $reviewsCount }} devotee ratings)</span>
                        </div>
                        @if($product->sku)
                            <div class="text-muted-cosmic small" style="border-left: 1px solid rgba(212,175,55,0.3); padding-left: 12px;">
                                SKU: <strong class="text-light">{{ $product->sku }}</strong>
                            </div>
                        @endif
                    </div>

                    <!-- Price Block -->
                    <div class="p-3 rounded-3 mb-4" style="background: rgba(61, 29, 107, 0.3); border: 1px dashed rgba(212,175,55,0.35);">
                        <div class="d-flex align-items-baseline gap-3">
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="cinzel-font text-gold display-6 fw-bold">₹{{ number_format($product->sale_price, 2) }}</span>
                                <span class="text-muted-cosmic fs-5 text-decoration-line-through">₹{{ number_format($product->price, 2) }}</span>
                                <span class="badge badge-saffron">Save ₹{{ number_format($product->price - $product->sale_price, 2) }}</span>
                            @else
                                <span class="cinzel-font text-gold display-6 fw-bold">₹{{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        <div class="text-muted-cosmic small mt-1">
                            <i class="bi bi-shield-check text-gold me-1"></i> Inclusive of all Vedic consecration charges and taxes
                        </div>
                    </div>

                    <!-- Short Description -->
                    <p class="text-light mb-4" style="line-height: 1.7;">
                        {{ $product->short_description }}
                    </p>

                    <!-- Stock Status -->
                    <div class="mb-4">
                        @if($product->stock > 0)
                            <span class="badge" style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #86efac; font-size: 0.85rem; padding: 6px 14px; border-radius: 20px;">
                                <i class="bi bi-check-circle-fill me-1"></i> In Stock ({{ $product->stock }} consecrated units available)
                            </span>
                        @else
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #fca5a5; font-size: 0.85rem; padding: 6px 14px; border-radius: 20px;">
                                <i class="bi bi-x-circle-fill me-1"></i> Currently Out of Consecrated Stock
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div>
                    @if($product->stock > 0)
                        <div class="row g-3 align-items-center mb-4">
                            <div class="col-auto">
                                <label class="text-gold small fw-bold me-2">Qty:</label>
                                <div class="input-group" style="width: 130px;">
                                    <button class="btn btn-cosmic-outline px-2" type="button" onclick="let q = document.getElementById('prodQty'); if(q.value > 1) q.value--;">-</button>
                                    <input type="number" id="prodQty" class="form-control cosmic-input text-center" value="1" min="1" max="{{ $product->stock }}" readonly>
                                    <button class="btn btn-cosmic-outline px-2" type="button" onclick="let q = document.getElementById('prodQty'); if(q.value < {{ $product->stock }}) q.value++;">+</button>
                                </div>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-cosmic-gold w-100 py-2 fs-6 d-flex align-items-center justify-content-center gap-2" onclick="addToCart({{ $product->id }}, parseInt(document.getElementById('prodQty').value))">
                                    <i class="bi bi-cart-plus-fill fs-5"></i> Add to Sacred Cart
                                </button>
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-cosmic-outline py-2 px-3" onclick="toggleWishlist({{ $product->id }}, this)" title="Add to Wishlist">
                                    <i class="bi bi-heart fs-5"></i>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning text-dark mb-4" role="alert">
                            <i class="bi bi-bell-fill me-2"></i> This sacred item is momentarily unavailable. Our scholars are performing fresh rituals.
                        </div>
                    @endif

                    <!-- Trust Icons Grid -->
                    <div class="p-3 rounded-3" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border); font-size: 0.85rem;">
                        <div class="row g-2 text-muted-cosmic">
                            <div class="col-6"><i class="bi bi-award-fill text-gold me-2"></i>Govt-Approved Lab Test</div>
                            <div class="col-6"><i class="bi bi-fire text-saffron me-2"></i>Prana Pratishtha Puja</div>
                            <div class="col-6"><i class="bi bi-box2-heart-fill text-gold me-2"></i>Free Auspicious Shipping</div>
                            <div class="col-6"><i class="bi bi-arrow-repeat text-saffron me-2"></i>7-Day Replacement Trust</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Details Tabs -->
    <div class="cosmic-card p-4 p-md-5 mb-5" data-aos="fade-up">
        <ul class="nav nav-tabs border-bottom" style="border-color: var(--cosmic-card-border) !important;" id="prodTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-gold fw-bold px-4 py-3" style="background: transparent; border: none; border-bottom: 3px solid var(--cosmic-accent-gold);" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc-pane" type="button" role="tab">
                    <i class="bi bi-book-half me-2"></i>Sacred Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-light fw-bold px-4 py-3" style="background: transparent; border: none;" id="vidhi-tab" data-bs-toggle="tab" data-bs-target="#vidhi-pane" type="button" role="tab">
                    <i class="bi bi-flower1 me-2"></i>Wearing & Energizing Vidhi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-light fw-bold px-4 py-3" style="background: transparent; border: none;" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab">
                    <i class="bi bi-stars me-2"></i>Devotee Reviews ({{ $reviewsCount }})
                </button>
            </li>
        </ul>

        <div class="tab-content pt-4" id="prodTabsContent">
            <!-- Tab 1: Sacred Description -->
            <div class="tab-pane fade show active text-light" id="desc-pane" role="tabpanel" style="line-height: 1.8;">
                <h5 class="cinzel-font text-gold mb-3">Celestial Significance & Benefits</h5>
                <div style="font-size: 0.95rem;">
                    {!! nl2br(e($product->description)) !!}
                </div>
            </div>

            <!-- Tab 2: Wearing Vidhi -->
            <div class="tab-pane fade text-light" id="vidhi-pane" role="tabpanel" style="line-height: 1.8;">
                <h5 class="cinzel-font text-gold mb-3">Vedic Energization & Wearing Guidelines</h5>
                <ol class="ps-3" style="font-size: 0.95rem;">
                    <li class="mb-2"><strong>Auspicious Timing:</strong> Wear on the designated planetary day during morning sunrise hora after taking a cleansing bath.</li>
                    <li class="mb-2"><strong>Purification Process:</strong> Dip the item in a clean bowl containing raw cow milk and sacred Gangajal for 15 minutes.</li>
                    <li class="mb-2"><strong>Incense & Lamp:</strong> Light pure Ghee Diya and natural dhoop in your prayer temple facing East.</li>
                    <li class="mb-2"><strong>Mantra Chanting:</strong> Recite the designated Beej Mantra 108 times with a clear and devout mind.</li>
                    <li class="mb-2"><strong>Touch & Wear:</strong> Touch the item to your forehead and wear on the recommended finger or neck with deep reverence.</li>
                </ol>
            </div>

            <!-- Tab 3: Devotee Reviews -->
            <div class="tab-pane fade text-light" id="reviews-pane" role="tabpanel">
                <div class="row g-4">
                    <!-- Reviews List -->
                    <div class="col-lg-7">
                        <h5 class="cinzel-font text-gold mb-3">Devotee Feedback</h5>
                        @forelse($product->reviews as $rev)
                            <div class="p-3 mb-3 rounded-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong class="text-gold">{{ $rev->user->name ?? 'Devotee' }}</strong>
                                    <div class="text-gold small">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $rev->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-muted-cosmic mb-1 small">{{ $rev->comment }}</p>
                                <small class="text-muted" style="font-size: 0.75rem;">Verified Devotee • {{ $rev->created_at->diffForHumans() }}</small>
                            </div>
                        @empty
                            <p class="text-muted-cosmic">No reviews yet for this consecrated item. Be the first devotee to share your spiritual experience!</p>
                        @endforelse
                    </div>

                    <!-- Review Form -->
                    <div class="col-lg-5">
                        <div class="p-4 rounded-3" style="background: rgba(61, 29, 107, 0.3); border: 1px solid var(--cosmic-card-border);">
                            <h5 class="cinzel-font text-gold mb-2">Share Your Experience</h5>
                            @auth
                                <form action="{{ route('product.review', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label text-gold small">Rating (1 to 5 Stars)</label>
                                        <select name="rating" class="form-select cosmic-input form-select-sm" required>
                                            <option value="5">★★★★★ (5 Stars - Highly Blessed)</option>
                                            <option value="4">★★★★☆ (4 Stars - Auspicious)</option>
                                            <option value="3">★★★☆☆ (3 Stars - Satisfactory)</option>
                                            <option value="2">★★☆☆☆ (2 Stars - Neutral)</option>
                                            <option value="1">★☆☆☆☆ (1 Star - Needs Improvement)</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-gold small">Your Sacred Review</label>
                                        <textarea name="comment" class="form-control cosmic-input" rows="4" placeholder="Describe the energy, packaging, and planetary effect..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-cosmic-gold btn-sm w-100">Submit Review</button>
                                </form>
                            @else
                                <p class="text-muted-cosmic small mb-3">Please sign in to leave a review and rating for this celestial item.</p>
                                <a href="{{ route('login') }}" class="btn btn-cosmic-outline btn-sm w-100">Login to Review</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mb-5">
            <h3 class="cinzel-font text-gold mb-4"><i class="bi bi-stars me-2"></i>Related Planetary Remedies</h3>
            <div class="row g-4">
                @foreach($relatedProducts as $rel)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <x-product-card :product="$rel" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
