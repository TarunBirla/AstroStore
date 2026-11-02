@extends('layouts.admin')

@section('title', 'Manage Payments')
@section('page_title', 'Payments & Transactions Vault')

@section('content')
<!-- Financial Summary Counters -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="cosmic-card p-3 text-center">
            <div class="text-success fs-4 mb-1"><i class="bi bi-check-circle-fill"></i></div>
            <h4 class="cinzel-font text-success mb-0 fw-bold">₹{{ number_format($totalCollected, 2) }}</h4>
            <small class="text-muted-cosmic">Total Successfully Collected</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cosmic-card p-3 text-center">
            <div class="text-saffron fs-4 mb-1"><i class="bi bi-clock-history"></i></div>
            <h4 class="cinzel-font text-saffron mb-0 fw-bold">₹{{ number_format($totalPending, 2) }}</h4>
            <small class="text-muted-cosmic">Pending Realization / COD</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="cosmic-card p-3 text-center">
            <div class="text-muted-cosmic fs-4 mb-1"><i class="bi bi-arrow-counterclockwise"></i></div>
            <h4 class="cinzel-font text-light mb-0 fw-bold">₹{{ number_format($totalRefunded, 2) }}</h4>
            <small class="text-muted-cosmic">Refunded / Reversal Amount</small>
        </div>
    </div>
</div>

<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-cash-stack me-2"></i>All Transactions</h4>
        <span class="badge badge-gold">{{ $payments->total() }} Records</span>
    </div>

    <!-- Filter Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.payments.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search txn id or order #..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="method" class="form-select cosmic-input">
                    <option value="">All Methods</option>
                    <option value="razorpay" {{ request('method') == 'razorpay' ? 'selected' : '' }}>Razorpay (Cards/NetBanking)</option>
                    <option value="upi" {{ request('method') == 'upi' ? 'selected' : '' }}>UPI / QR</option>
                    <option value="cod" {{ request('method') == 'cod' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select cosmic-input">
                    <option value="">All Status</option>
                    <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success / Settled</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($payments->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Order #</th>
                        <th>Devotee</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $pay)
                        <tr>
                            <td><code class="text-gold">{{ $pay->transaction_id ?: 'N/A' }}</code></td>
                            <td>
                                @if($pay->order)
                                    <a href="{{ route('admin.orders.show', $pay->order->id) }}" class="text-light fw-bold text-decoration-none">
                                        {{ $pay->order->order_number }}
                                    </a>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>{{ $pay->user->name ?? ($pay->order->shipping_name ?? 'Guest') }}</td>
                            <td>
                                <span class="badge badge-cosmic text-uppercase">{{ $pay->method }}</span>
                            </td>
                            <td class="text-gold fw-bold">₹{{ number_format($pay->amount, 2) }}</td>
                            <td>
                                @php
                                    $stClass = [
                                        'success' => 'bg-success text-white',
                                        'pending' => 'badge-saffron',
                                        'failed' => 'bg-danger text-white',
                                        'refunded' => 'bg-secondary text-white',
                                    ][$pay->status] ?? 'badge-cosmic';
                                @endphp
                                <span class="badge {{ $stClass }}">{{ ucfirst($pay->status) }}</span>
                            </td>
                            <td class="small text-muted-cosmic">{{ $pay->created_at->format('M d, Y - h:i A') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.payments.show', $pay->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2">
                                    <i class="bi bi-eye"></i> Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center pagination-cosmic">
            {{ $payments->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-wallet2 fs-1 d-block mb-2 text-gold"></i>
            <h5>No transactions found matching this filter.</h5>
        </div>
    @endif
</div>
@endsection
