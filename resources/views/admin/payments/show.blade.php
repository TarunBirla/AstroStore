@extends('layouts.admin')

@section('title', 'Payment Detail: ' . $payment->transaction_id)
@section('page_title', 'Transaction Audit Record')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h4 class="cinzel-font text-gold mb-0">Transaction #{{ $payment->transaction_id ?: $payment->id }}</h4>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back to Payments
                </a>
            </div>

            <!-- Transaction Summary -->
            <div class="p-3 rounded mb-4" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <small class="text-muted-cosmic d-block">Transaction ID:</small>
                        <code class="text-gold fs-6">{{ $payment->transaction_id ?: 'MANUAL-COD' }}</code>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <small class="text-muted-cosmic d-block">Amount Paid:</small>
                        <span class="cinzel-font text-gold fs-4 fw-bold">₹{{ number_format($payment->amount, 2) }}</span>
                    </div>
                    <div class="col-sm-6">
                        <small class="text-muted-cosmic d-block">Payment Method:</small>
                        <span class="badge badge-gold text-uppercase">{{ $payment->method }}</span>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <small class="text-muted-cosmic d-block">Timestamp:</small>
                        <span class="text-light small">{{ $payment->created_at->format('F d, Y - h:i:s A') }}</span>
                    </div>
                </div>
            </div>

            <!-- Manage Status Form -->
            <div class="p-3 rounded mb-4" style="background: rgba(61, 29, 107, 0.3); border: 1px dashed rgba(212,175,55,0.4);">
                <h6 class="cinzel-font text-gold mb-3"><i class="bi bi-shield-check me-2"></i>Override Payment Status</h6>
                <form action="{{ route('admin.payments.updateStatus', $payment->id) }}" method="POST" class="d-flex align-items-center gap-2">
                    @csrf
                    <select name="status" class="form-select cosmic-input form-select-sm" style="max-width: 220px;">
                        <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="success" {{ $payment->status === 'success' ? 'selected' : '' }}>Success / Settled</option>
                        <option value="failed" {{ $payment->status === 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ $payment->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                    <button type="submit" class="btn btn-cosmic-gold btn-sm">Update Status</button>
                </form>
            </div>

            <!-- Linked Order Information -->
            @if($payment->order)
                <div class="p-3 rounded" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h6 class="cinzel-font text-gold mb-2"><i class="bi bi-box-seam me-2"></i>Linked Order Details</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Order #{{ $payment->order->order_number }}</strong><br>
                            <small class="text-muted-cosmic">Recipient: {{ $payment->order->shipping_name }} ({{ $payment->order->phone }})</small>
                        </div>
                        <a href="{{ route('admin.orders.show', $payment->order->id) }}" class="btn btn-cosmic-outline btn-sm">
                            Inspect Order <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
