@extends('layouts.app')

@section('title', 'My Consecrated Orders | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Devotee Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="cosmic-card p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-box-seam me-2"></i>My Orders & Consultations</h4>

                    <!-- Filter Status -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="text-muted-cosmic small mb-0">Status:</label>
                        <select class="form-select cosmic-input form-select-sm" style="width: 150px;" onchange="location = this.value;">
                            <option value="{{ route('user.orders') }}" {{ !request('status') ? 'selected' : '' }}>All Status</option>
                            <option value="{{ route('user.orders', ['status' => 'pending']) }}" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="{{ route('user.orders', ['status' => 'processing']) }}" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="{{ route('user.orders', ['status' => 'shipped']) }}" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="{{ route('user.orders', ['status' => 'delivered']) }}" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="{{ route('user.orders', ['status' => 'cancelled']) }}" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>

                @if($orders->isNotEmpty())
                    <div class="table-responsive mb-4">
                        <table class="table table-cosmic align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('user.orders.show', $order->order_number) }}" class="text-gold fw-bold text-decoration-none">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td class="small text-muted-cosmic">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge badge-cosmic">{{ $order->items->count() }} items</span>
                                        </td>
                                        <td class="text-gold fw-bold">₹{{ number_format($order->total, 2) }}</td>
                                        <td>
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'badge-saffron',
                                                    'processing' => 'badge-gold',
                                                    'shipped' => 'badge-cosmic',
                                                    'delivered' => 'bg-success text-white',
                                                    'cancelled' => 'bg-danger text-white',
                                                ];
                                            @endphp
                                            <span class="badge {{ $statusClasses[$order->status] ?? 'badge-cosmic' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $order->payment_status === 'paid' ? 'bg-success text-white' : 'badge-saffron' }}" style="font-size: 0.72rem;">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('user.orders.show', $order->order_number) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="View Order">
                                                <i class="bi bi-eye"></i> Details
                                            </a>
                                            <a href="{{ route('user.orders.invoice', $order->order_number) }}" class="btn btn-cosmic-outline btn-sm py-1 px-2" target="_blank" title="Print Invoice">
                                                <i class="bi bi-printer"></i>
                                            </a>
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
                        <i class="bi bi-bag-x fs-1 d-block mb-2 text-gold"></i>
                        <h5>No orders found matching this filter.</h5>
                        <a href="{{ route('shop') }}" class="btn btn-cosmic-gold btn-sm mt-2">Explore Sacred Store</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
