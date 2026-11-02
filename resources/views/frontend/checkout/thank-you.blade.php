@extends('layouts.app')

@section('title', 'Order Blessed & Placed #' . $order->order_number . ' | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Thank You Hero Card -->
            <div class="cosmic-card p-4 p-md-5 text-center mb-4" data-aos="zoom-in" style="background: radial-gradient(circle at center, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.95) 100%); border: 2px solid var(--cosmic-accent-gold);">
                <div style="font-size: 3.5rem; filter: drop-shadow(0 0 15px rgba(212,175,55,0.7));">✨🕉️✨</div>
                <h1 class="cinzel-font text-gold display-5 fw-bold mb-2">Sacred Order Placed & Consecrated</h1>
                <p class="text-light fs-5 mb-3">Namaste <strong class="text-gold">{{ $order->shipping_name }}</strong>, your order has been received with deep celestial reverence.</p>

                <div class="d-inline-flex align-items-center gap-2 p-2 px-4 rounded-pill mb-4" style="background: rgba(15,5,29,0.8); border: 1px dashed var(--cosmic-accent-gold);">
                    <span class="text-muted-cosmic">Blessed Order Number:</span>
                    <strong class="text-gold fs-5">{{ $order->order_number }}</strong>
                </div>

                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('user.orders.show', $order->order_number) }}" class="btn btn-cosmic-gold">
                        <i class="bi bi-box-seam me-2"></i> Track in Devotee Panel
                    </a>
                    <a href="{{ route('user.orders.invoice', $order->order_number) }}" class="btn btn-cosmic-outline" target="_blank">
                        <i class="bi bi-printer me-2"></i> Print Sacred Invoice
                    </a>
                </div>
            </div>

            <!-- Sacred Consecration Timeline -->
            <div class="cosmic-card p-4 mb-4" data-aos="fade-up">
                <h5 class="cinzel-font text-gold mb-3"><i class="bi bi-hourglass-split me-2"></i>Sacred Consecration & Dispatch Stages</h5>
                <div class="row text-center g-3">
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e;">
                            <i class="bi bi-check2-circle text-success fs-3 d-block mb-1"></i>
                            <strong class="text-light small d-block">1. Order Placed</strong>
                            <small class="text-muted-cosmic" style="font-size: 0.75rem;">Received at Kendra</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: rgba(61, 29, 107, 0.4); border: 1px solid var(--cosmic-card-border);">
                            <i class="bi bi-fire text-saffron fs-3 d-block mb-1"></i>
                            <strong class="text-light small d-block">2. Prana Pratishtha</strong>
                            <small class="text-muted-cosmic" style="font-size: 0.75rem;">Mantra Japa & Puja</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: rgba(61, 29, 107, 0.4); border: 1px solid var(--cosmic-card-border);">
                            <i class="bi bi-box2-heart text-gold fs-3 d-block mb-1"></i>
                            <strong class="text-light small d-block">3. Sacred Packing</strong>
                            <small class="text-muted-cosmic" style="font-size: 0.75rem;">With Gangajal & Prasad</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 rounded-3" style="background: rgba(61, 29, 107, 0.4); border: 1px solid var(--cosmic-card-border);">
                            <i class="bi bi-truck text-light fs-3 d-block mb-1"></i>
                            <strong class="text-light small d-block">4. Doorstep Delivery</strong>
                            <small class="text-muted-cosmic" style="font-size: 0.75rem;">Insured express transit</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items & Financial Summary -->
            <div class="cosmic-card p-4 p-md-5 mb-4" data-aos="fade-up">
                <h4 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    Order Details & Sanctified Items
                </h4>

                <div class="table-responsive mb-4">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->product && $item->product->main_image)
                                                @php $src = file_exists(public_path('storage/' . $item->product->main_image)) ? asset('storage/' . $item->product->main_image) : $item->product->main_image; @endphp
                                                <img src="{{ $src }}" class="rounded-2" style="width: 50px; height: 50px; object-fit: cover;" alt="thumb">
                                            @endif
                                            <div>
                                                <strong class="text-light">{{ $item->name }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-gold">₹{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td class="text-gold fw-bold text-end">₹{{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row g-4">
                    <!-- Delivery Address Box -->
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 h-100" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                            <h6 class="cinzel-font text-gold mb-2"><i class="bi bi-geo-alt me-1"></i>Destination Sanctuary:</h6>
                            <p class="text-light small mb-1"><strong>{{ $order->shipping_name }}</strong></p>
                            <p class="text-muted-cosmic small mb-1">{{ $order->address }}</p>
                            <p class="text-muted-cosmic small mb-1">{{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</p>
                            <p class="text-muted-cosmic small mb-0"><i class="bi bi-phone me-1"></i>{{ $order->phone }}</p>
                        </div>
                    </div>

                    <!-- Payment Summary Box -->
                    <div class="col-md-6">
                        <div class="p-3 rounded-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                            <div class="d-flex justify-content-between mb-1 small text-muted-cosmic">
                                <span>Subtotal:</span>
                                <span class="text-light">₹{{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            @if($order->discount > 0)
                                <div class="d-flex justify-content-between mb-1 small text-saffron">
                                    <span>Coupon Discount ({{ $order->coupon_code }}):</span>
                                    <span>-₹{{ number_format($order->discount, 2) }}</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between mb-1 small text-muted-cosmic">
                                <span>Vedic Shipping:</span>
                                <span class="text-light">₹{{ number_format($order->shipping, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted-cosmic">
                                <span>Taxes:</span>
                                <span class="text-light">₹{{ number_format($order->tax, 2) }}</span>
                            </div>
                            <hr style="border-color: rgba(212,175,55,0.2);" class="my-2">
                            <div class="d-flex justify-content-between fs-5 text-gold fw-bold mb-2">
                                <span>Total Paid/Due:</span>
                                <span>₹{{ number_format($order->total, 2) }}</span>
                            </div>
                            <div class="small text-muted-cosmic">
                                Payment Channel: <strong class="text-light text-uppercase">{{ $order->payment->method ?? 'COD' }}</strong> 
                                (<span class="badge {{ $order->payment_status === 'paid' ? 'badge-gold' : 'badge-saffron' }}">{{ ucfirst($order->payment_status) }}</span>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('shop') }}" class="btn btn-cosmic-outline px-4">
                    <i class="bi bi-bag-plus me-2"></i> Explore More Remedies
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
