@extends('layouts.app')

@section('title', 'Order #' . $order->order_number . ' | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Devotee Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.orders') }}">My Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page">#{{ $order->order_number }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <!-- Header Card -->
            <div class="cosmic-card p-4 mb-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h4 class="cinzel-font text-gold mb-0">Order #{{ $order->order_number }}</h4>
                            @php
                                $statusClasses = [
                                    'pending' => 'badge-saffron',
                                    'processing' => 'badge-gold',
                                    'shipped' => 'badge-cosmic',
                                    'delivered' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white',
                                ];
                            @endphp
                            <span class="badge {{ $statusClasses[$order->status] ?? 'badge-cosmic' }} fs-6">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <small class="text-muted-cosmic">Placed on {{ $order->created_at->format('F d, Y - h:i A') }}</small>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.orders.invoice', $order->order_number) }}" class="btn btn-cosmic-outline btn-sm" target="_blank">
                            <i class="bi bi-printer me-1"></i> Print Invoice
                        </a>

                        @if($order->status === 'pending')
                            <form action="{{ route('user.orders.cancel', $order->order_number) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this consecrated order? Inventory will be released.');">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-x-circle me-1"></i> Cancel Order
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="cosmic-card p-4 mb-4">
                <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-gem me-2"></i>Ordered Celestial Remedies
                </h5>

                <div class="table-responsive">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th class="text-end">Line Total</th>
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
                                                @if($item->product)
                                                    <a href="{{ route('product.show', $item->product->slug) }}" class="text-light text-decoration-none fw-bold">
                                                        {{ $item->name }}
                                                    </a>
                                                @else
                                                    <strong class="text-light">{{ $item->name }}</strong>
                                                @endif
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

                <div class="row g-4 mt-3">
                    <div class="col-md-6">
                        @if($order->notes)
                            <div class="p-3 rounded" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                                <strong class="text-gold small d-block mb-1">Astrological Notes & Instructions:</strong>
                                <p class="text-muted-cosmic small mb-0">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 rounded" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
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
                                <span>Shipping:</span>
                                <span class="text-light">₹{{ number_format($order->shipping, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-1 small text-muted-cosmic">
                                <span>Taxes:</span>
                                <span class="text-light">₹{{ number_format($order->tax, 2) }}</span>
                            </div>
                            <hr style="border-color: rgba(212,175,55,0.2);" class="my-2">
                            <div class="d-flex justify-content-between fs-5 text-gold fw-bold">
                                <span>Total:</span>
                                <span>₹{{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address and Payment details -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="cosmic-card p-4 h-100">
                        <h6 class="cinzel-font text-gold mb-3"><i class="bi bi-geo-alt-fill me-2"></i>Delivery Sanctuary</h6>
                        <p class="text-light fw-bold mb-1">{{ $order->shipping_name }}</p>
                        <p class="text-muted-cosmic small mb-1">{{ $order->address }}</p>
                        <p class="text-muted-cosmic small mb-1">{{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</p>
                        <p class="text-muted-cosmic small mb-0"><i class="bi bi-telephone-fill me-1 text-gold"></i>{{ $order->phone }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="cosmic-card p-4 h-100">
                        <h6 class="cinzel-font text-gold mb-3"><i class="bi bi-credit-card-fill me-2"></i>Payment Information</h6>
                        <div class="mb-2">
                            <span class="text-muted-cosmic small d-block">Method:</span>
                            <strong class="text-light text-uppercase">{{ $order->payment->method ?? 'COD' }}</strong>
                        </div>
                        <div class="mb-2">
                            <span class="text-muted-cosmic small d-block">Payment Status:</span>
                            <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'badge-saffron' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        @if($order->payment && $order->payment->transaction_id)
                            <div>
                                <span class="text-muted-cosmic small d-block">Transaction ID:</span>
                                <code class="text-gold">{{ $order->payment->transaction_id }}</code>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
