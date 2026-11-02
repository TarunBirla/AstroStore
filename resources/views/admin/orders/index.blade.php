@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('page_title', 'Sacred Orders & Consultations')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-box-seam-fill me-2"></i>Consecrated Orders List</h4>
        <span class="badge badge-gold">{{ $orders->total() }} Total Bookings</span>
    </div>

    <!-- Filter Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search order # or devotee..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select cosmic-input">
                    <option value="">All Fulfillment Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="payment_status" class="form-select cosmic-input">
                    <option value="">All Payment Status</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control cosmic-input" value="{{ request('date') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-funnel"></i> Filter</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($orders->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Devotee Name</th>
                        <th>Phone & City</th>
                        <th>Amount</th>
                        <th>Fulfillment</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $ord)
                        <tr>
                            <td>
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="text-gold fw-bold text-decoration-none">
                                    {{ $ord->order_number }}
                                </a>
                                <small class="text-muted-cosmic d-block">{{ $ord->items->count() }} items</small>
                            </td>
                            <td>
                                <strong class="text-light">{{ $ord->shipping_name }}</strong>
                                @if($ord->user)
                                    <small class="text-muted-cosmic d-block">{{ $ord->user->email }}</small>
                                @endif
                            </td>
                            <td>
                                <span class="text-light">{{ $ord->phone }}</span><br>
                                <small class="text-muted-cosmic">{{ $ord->city }}, {{ $ord->state }}</small>
                            </td>
                            <td class="text-gold fw-bold">₹{{ number_format($ord->total, 2) }}</td>
                            <td>
                                @php
                                    $stClass = [
                                        'pending' => 'badge-saffron',
                                        'processing' => 'badge-gold',
                                        'shipped' => 'badge-cosmic',
                                        'delivered' => 'bg-success text-white',
                                        'cancelled' => 'bg-danger text-white',
                                    ][$ord->status] ?? 'badge-cosmic';
                                @endphp
                                <span class="badge {{ $stClass }}">
                                    {{ ucfirst($ord->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $ord->payment_status === 'paid' ? 'bg-success text-white' : 'badge-saffron' }}">
                                    {{ ucfirst($ord->payment_status) }}
                                </span>
                            </td>
                            <td class="small text-muted-cosmic">{{ $ord->created_at->format('M d, Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Manage Status & View Details">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('admin.orders.invoice', $ord->id) }}" class="btn btn-cosmic-outline btn-sm py-1 px-2" target="_blank" title="Invoice">
                                    <i class="bi bi-printer"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $ord->id) }}" method="POST" id="delOrd{{ $ord->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delOrd{{ $ord->id }}', 'Delete order {{ $ord->order_number }}?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center pagination-cosmic">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-box2-heart fs-1 d-block mb-2 text-gold"></i>
            <h5>No orders found matching criteria.</h5>
        </div>
    @endif
</div>
@endsection
