@extends('layouts.admin')

@section('title', 'Sales & Consecration Analytics')
@section('page_title', 'Vedic Financial & Remedial Analytics')

@section('content')
<!-- Filter & Export Toolbar -->
<div class="cosmic-card p-4 mb-4">
    <form action="{{ route('admin.analytics') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-4 col-sm-6">
            <label class="form-label text-gold small">Start Date</label>
            <input type="date" name="start_date" class="form-control cosmic-input" value="{{ $startDate }}">
        </div>

        <div class="col-md-4 col-sm-6">
            <label class="form-label text-gold small">End Date</label>
            <input type="date" name="end_date" class="form-control cosmic-input" value="{{ $endDate }}">
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-cosmic-gold flex-grow-1">
                <i class="bi bi-funnel me-1"></i> Apply Filter
            </button>
            <a href="{{ route('admin.analytics.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-cosmic-outline text-nowrap">
                <i class="bi bi-download me-1"></i> Export CSV
            </a>
        </div>
    </form>
</div>

<!-- Metrics Overview -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-6">
        <div class="cosmic-card p-3 text-center">
            <div class="text-gold fs-4 mb-1"><i class="bi bi-cash-coin"></i></div>
            <h3 class="cinzel-font text-gold mb-0 fw-bold">₹{{ number_format($totalRevenue, 2) }}</h3>
            <small class="text-muted-cosmic">Period Net Revenue</small>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="cosmic-card p-3 text-center">
            <div class="text-saffron fs-4 mb-1"><i class="bi bi-cart-check-fill"></i></div>
            <h3 class="cinzel-font text-saffron mb-0 fw-bold">{{ $totalOrders }}</h3>
            <small class="text-muted-cosmic">Completed Orders</small>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="cosmic-card p-3 text-center">
            <div class="text-gold fs-4 mb-1"><i class="bi bi-receipt"></i></div>
            <h3 class="cinzel-font text-gold mb-0 fw-bold">₹{{ number_format($averageOrderValue, 2) }}</h3>
            <small class="text-muted-cosmic">Avg. Order Value (AOV)</small>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="cosmic-card p-3 text-center">
            <div class="text-success fs-4 mb-1"><i class="bi bi-boxes"></i></div>
            <h3 class="cinzel-font text-success mb-0 fw-bold">{{ $totalUnits }}</h3>
            <small class="text-muted-cosmic">Remedial Units Dispatched</small>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Products in Period -->
    <div class="col-lg-7">
        <div class="cosmic-card p-4 h-100">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-trophy-fill text-gold me-2"></i>Top Performing Celestial Remedies
            </h5>

            @if($topProducts->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Remedy Name</th>
                                <th>Units Sold</th>
                                <th class="text-end">Revenue Generated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topProducts as $tp)
                                <tr>
                                    <td>
                                        <strong class="text-light">{{ $tp->name }}</strong>
                                    </td>
                                    <td><span class="badge badge-gold">{{ $tp->total_qty }} pcs</span></td>
                                    <td class="text-gold fw-bold text-end">₹{{ number_format($tp->total_sales, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted-cosmic text-center py-4 mb-0">No item sales recorded within selected dates.</p>
            @endif
        </div>
    </div>

    <!-- Coupon Usages in Period -->
    <div class="col-lg-5">
        <div class="cosmic-card p-4 h-100">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-ticket-perforated-fill text-saffron me-2"></i>Recent Coupon Redemptions
            </h5>

            @if($couponUsages->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Coupon</th>
                                <th>Devotee</th>
                                <th>Order #</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($couponUsages as $cu)
                                <tr>
                                    <td><span class="badge badge-saffron">{{ $cu->coupon->code ?? 'N/A' }}</span></td>
                                    <td class="small">{{ $cu->user->name ?? 'Devotee' }}</td>
                                    <td>
                                        @if($cu->order)
                                            <a href="{{ route('admin.orders.show', $cu->order_id) }}" class="text-gold small fw-bold text-decoration-none">
                                                {{ $cu->order->order_number }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted-cosmic text-center py-4 mb-0">No coupon redemptions in this date range.</p>
            @endif
        </div>
    </div>
</div>
@endsection
