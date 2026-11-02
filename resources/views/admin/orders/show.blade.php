@extends('layouts.admin')

@section('title', 'Manage Order #' . $order->order_number)
@section('page_title', 'Order Management: #' . $order->order_number)

@section('content')
<div class="row g-4">
    <!-- Left: Status Update & Details -->
    <div class="col-lg-8">
        <!-- Status Update Card -->
        <div class="cosmic-card p-4 mb-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-arrow-repeat me-2"></i>Update Order & Payment Status
            </h5>

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-gold small">Fulfillment Status</label>
                        <select name="status" class="form-select cosmic-input">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending Consecration</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing / In Puja</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dispatched / Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered to Devotee</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Restores Stock)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-gold small">Payment Status</label>
                        <select name="payment_status" class="form-select cosmic-input">
                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid / Verified</option>
                            <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-gold small">Admin / Astrological Notes</label>
                    <textarea name="notes" class="form-control cosmic-input" rows="2" placeholder="Record tracking airway bill (AWB) or priest consecration notes...">{{ old('notes', $order->notes) }}</textarea>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4">
                    <i class="bi bi-check-circle me-1"></i> Update Status
                </button>
                <a href="{{ route('admin.orders.invoice', $order->id) }}" class="btn btn-cosmic-outline ms-2" target="_blank">
                    <i class="bi bi-printer me-1"></i> Print Invoice
                </a>
            </form>
        </div>

        <!-- Items Table -->
        <div class="cosmic-card p-4 mb-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-gem me-2"></i>Consecrated Items in this Order
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
                                            <img src="{{ $src }}" class="rounded-2" style="width: 45px; height: 45px; object-fit: cover;" alt="thumb">
                                        @endif
                                        <div>
                                            <strong class="text-light">{{ $item->name }}</strong>
                                            @if($item->product && $item->product->sku)
                                                <small class="text-muted-cosmic d-block">SKU: {{ $item->product->sku }}</small>
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

            <div class="row justify-content-end mt-4">
                <div class="col-md-5">
                    <div class="p-3 rounded" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                        <div class="d-flex justify-content-between mb-1 small text-muted-cosmic">
                            <span>Subtotal:</span>
                            <span class="text-light">₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="d-flex justify-content-between mb-1 small text-saffron">
                                <span>Coupon ({{ $order->coupon_code }}):</span>
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
                            <span>Grand Total:</span>
                            <span>₹{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Devotee & Payment Particulars -->
    <div class="col-lg-4">
        <!-- Devotee Details -->
        <div class="cosmic-card p-4 mb-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-person-badge-fill me-2"></i>Devotee Profile
            </h5>
            <div class="mb-3">
                <label class="text-muted-cosmic small d-block">Recipient Name:</label>
                <strong class="text-light fs-6">{{ $order->shipping_name }}</strong>
            </div>
            <div class="mb-3">
                <label class="text-muted-cosmic small d-block">Contact Phone:</label>
                <a href="tel:{{ $order->phone }}" class="text-gold fw-bold text-decoration-none">
                    <i class="bi bi-telephone-fill me-1"></i>{{ $order->phone }}
                </a>
            </div>
            @if($order->user)
                <div class="mb-3">
                    <label class="text-muted-cosmic small d-block">Account Email:</label>
                    <span class="text-light">{{ $order->user->email }}</span>
                </div>
            @endif
            <div>
                <label class="text-muted-cosmic small d-block">Delivery Address:</label>
                <p class="text-light small mb-0">
                    {{ $order->address }}<br>
                    {{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}
                </p>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="cosmic-card p-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-credit-card me-2"></i>Payment Record
            </h5>
            <div class="mb-2">
                <label class="text-muted-cosmic small d-block">Method:</label>
                <strong class="text-light text-uppercase">{{ $order->payment->method ?? 'COD' }}</strong>
            </div>
            <div class="mb-2">
                <label class="text-muted-cosmic small d-block">Payment Status:</label>
                <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success' : 'badge-saffron' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
            @if($order->payment && $order->payment->transaction_id)
                <div class="mb-2">
                    <label class="text-muted-cosmic small d-block">Transaction ID:</label>
                    <code class="text-gold">{{ $order->payment->transaction_id }}</code>
                </div>
            @endif
            <div>
                <label class="text-muted-cosmic small d-block">Booked At:</label>
                <small class="text-light">{{ $order->created_at->format('M d, Y - h:i A') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
