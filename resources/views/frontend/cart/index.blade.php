@extends('layouts.app')

@section('title', 'Your Sacred Cart | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}">Vedic Store</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sacred Cart</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="cinzel-font text-gold display-6 mb-1"><i class="bi bi-bag-check me-2"></i>Your Sacred Cart</h2>
            <p class="text-muted-cosmic mb-0">Review your selected celestial items before consecration and dispatch</p>
        </div>
        @if($cartItems->isNotEmpty())
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Clear all items from your sacred cart?')">
                    <i class="bi bi-trash3 me-1"></i> Empty Cart
                </button>
            </form>
        @endif
    </div>

    @if($cartItems->isNotEmpty())
        <!-- Free Shipping Meter -->
        @php
            $diffForFree = max(0, $freeShippingAbove - $subtotal);
            $freePercent = min(100, round(($subtotal / $freeShippingAbove) * 100));
        @endphp
        <div class="cosmic-card p-3 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2 small">
                @if($diffForFree > 0)
                    <span class="text-light"><i class="bi bi-truck text-gold me-2"></i>Add <strong>₹{{ number_format($diffForFree, 2) }}</strong> more to unlock <strong>Free Vedic Shipping</strong>!</span>
                @else
                    <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Congratulations! You have unlocked FREE Insured Shipping!</span>
                @endif
                <span class="text-gold fw-bold">{{ $freePercent }}%</span>
            </div>
            <div class="progress" style="height: 8px; background-color: rgba(15, 5, 29, 0.8);">
                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $freePercent }}%;"></div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Cart Items List -->
            <div class="col-lg-8">
                <div class="cosmic-card p-3 p-md-4 mb-4">
                    <div class="table-responsive">
                        <table class="table table-cosmic align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    @php $prod = $item->product; @endphp
                                    @if($prod)
                                        <tr>
                                            <td style="min-width: 240px;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="{{ route('product.show', $prod->slug) }}">
                                                        @if($prod->main_image && file_exists(public_path('storage/' . $prod->main_image)))
                                                            <img src="{{ asset('storage/' . $prod->main_image) }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" alt="{{ $prod->name }}">
                                                        @elseif($prod->main_image && Str::startsWith($prod->main_image, 'http'))
                                                            <img src="{{ $prod->main_image }}" class="rounded-3" style="width: 60px; height: 60px; object-fit: cover;" alt="{{ $prod->name }}">
                                                        @else
                                                            <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; background: #3d1d6b; color: #d4af37;">
                                                                <i class="bi bi-gem fs-4"></i>
                                                            </div>
                                                        @endif
                                                    </a>
                                                    <div>
                                                        <h6 class="cinzel-font mb-1" style="font-size: 0.95rem;">
                                                            <a href="{{ route('product.show', $prod->slug) }}" class="text-light text-decoration-none">
                                                                {{ $prod->name }}
                                                            </a>
                                                        </h6>
                                                        @if($prod->category)
                                                            <small class="text-muted-cosmic"><i class="bi bi-stars text-gold me-1"></i>{{ $prod->category->name }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-gold fw-bold">
                                                ₹{{ number_format($prod->active_price, 2) }}
                                            </td>

                                            <td>
                                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center" style="width: 120px;">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                    <div class="input-group input-group-sm">
                                                        <button class="btn btn-cosmic-outline px-2" type="button" onclick="let q = this.nextElementSibling; if(q.value > 1) { q.value--; this.form.submit(); }">-</button>
                                                        <input type="number" name="qty" class="form-control cosmic-input text-center px-1" value="{{ $item->qty }}" min="1" max="{{ $prod->stock }}" readonly>
                                                        <button class="btn btn-cosmic-outline px-2" type="button" onclick="let q = this.previousElementSibling; if(q.value < {{ $prod->stock }}) { q.value++; this.form.submit(); }">+</button>
                                                    </div>
                                                </form>
                                            </td>

                                            <td class="text-gold fw-bold">
                                                ₹{{ number_format($prod->active_price * $item->qty, 2) }}
                                            </td>

                                            <td class="text-end">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-link text-danger p-0" title="Remove item">
                                                        <i class="bi bi-x-circle fs-5"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Coupon Box -->
                <div class="cosmic-card p-4">
                    <h5 class="cinzel-font text-gold mb-2"><i class="bi bi-ticket-perforated me-2"></i>Have an Auspicious Coupon?</h5>
                    <p class="text-muted-cosmic small mb-3">Apply Vedic discount coupons (e.g. <strong>WELCOME10</strong>, <strong>ASTRO20</strong>, <strong>FLAT200</strong>)</p>

                    @if($couponData)
                        <div class="alert alert-success d-flex align-items-center justify-content-between py-2 px-3 mb-0" style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #86efac; border-radius: 10px;">
                            <div>
                                <i class="bi bi-check-circle-fill me-2"></i> Coupon <strong>{{ $couponData['code'] }}</strong> applied (-₹{{ number_format($couponData['discount'], 2) }})
                            </div>
                            <form action="{{ route('coupon.remove') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">Remove</button>
                            </form>
                        </div>
                    @else
                        <form action="{{ route('coupon.apply') }}" method="POST" class="d-flex gap-2">
                            @csrf
                            <input type="text" name="code" class="form-control cosmic-input" placeholder="ENTER COUPON CODE" style="text-transform: uppercase;" required>
                            <button type="submit" class="btn btn-cosmic-gold px-4 text-nowrap">Apply Coupon</button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-4">
                <div class="cosmic-card p-4 sticky-top" style="top: 90px;">
                    <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                        Order Summary
                    </h4>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted-cosmic">Subtotal:</span>
                        <span class="text-light fw-bold">₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="d-flex justify-content-between mb-3 text-saffron">
                            <span>Auspicious Discount:</span>
                            <span class="fw-bold">-₹{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted-cosmic">Vedic Shipping:</span>
                        @if($shipping == 0)
                            <span class="text-success fw-bold">FREE</span>
                        @else
                            <span class="text-light fw-bold">₹{{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted-cosmic">Estimated Tax ({{ setting('tax_percent', 3) }}%):</span>
                        <span class="text-light fw-bold">₹{{ number_format($tax, 2) }}</span>
                    </div>

                    <hr style="border-color: rgba(212,175,55,0.25);" class="my-3">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="cinzel-font text-gold fs-5 fw-bold">Grand Total:</span>
                        <span class="cinzel-font text-gold fs-4 fw-bold">₹{{ number_format($total, 2) }}</span>
                    </div>

                    @auth
                        <a href="{{ route('checkout.index') }}" class="btn btn-cosmic-gold w-100 py-3 fs-6 d-flex align-items-center justify-content-center gap-2">
                            <span>Proceed to Divine Checkout</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}?redirect={{ urlencode(route('checkout.index')) }}" class="btn btn-cosmic-gold w-100 py-3 fs-6 d-flex align-items-center justify-content-center gap-2">
                            <span>Login to Proceed Checkout</span>
                            <i class="bi bi-box-arrow-in-right"></i>
                        </a>
                        <small class="text-muted-cosmic text-center d-block mt-2">Devotee login is required to secure your birth chart & shipping address</small>
                    @endauth

                    <div class="mt-4 pt-3 text-center" style="border-top: 1px solid rgba(212,175,55,0.15);">
                        <a href="{{ route('shop') }}" class="text-muted-cosmic small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Continue Sacred Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cosmic-card p-5 text-center my-4" data-aos="zoom-in">
            <span style="font-size: 3.5rem;">🛍️</span>
            <h3 class="cinzel-font text-gold mt-3 mb-2">Your Sacred Cart is Empty</h3>
            <p class="text-muted-cosmic mb-4">You have not added any celestial gemstones, rudraksha or pooja items yet.</p>
            <a href="{{ route('shop') }}" class="btn btn-cosmic-gold px-4 py-2">
                <i class="bi bi-compass me-2"></i> Explore Sacred Store
            </a>
        </div>
    @endif
</div>
@endsection
