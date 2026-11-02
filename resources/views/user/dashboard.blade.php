@extends('layouts.app')

@section('title', 'Devotee Sanctuary Dashboard | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Devotee Dashboard</li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <!-- Main Dashboard View -->
        <div class="col-lg-9">
            <!-- Welcome Banner -->
            <div class="cosmic-card p-4 mb-4" data-aos="fade-down" style="background: linear-gradient(135deg, rgba(61,29,107,0.7) 0%, rgba(26,11,46,0.95) 100%); border-left: 4px solid var(--cosmic-accent-gold);">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h3 class="cinzel-font text-gold mb-1">Namaste, {{ $user->name }}! ✨</h3>
                        <p class="text-muted-cosmic mb-0 small">Welcome to your personal astrological portal. Track consecrated remedies and consults.</p>
                    </div>
                    <a href="{{ route('shop') }}" class="btn btn-cosmic-gold btn-sm">
                        <i class="bi bi-compass me-1"></i> Explore Store
                    </a>
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="cosmic-card p-3 text-center">
                        <div class="text-gold fs-4 mb-1"><i class="bi bi-box-seam"></i></div>
                        <h4 class="cinzel-font text-gold mb-0 fw-bold">{{ $totalOrders }}</h4>
                        <small class="text-muted-cosmic">Total Orders</small>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="cosmic-card p-3 text-center">
                        <div class="text-saffron fs-4 mb-1"><i class="bi bi-hourglass-split"></i></div>
                        <h4 class="cinzel-font text-saffron mb-0 fw-bold">{{ $pendingOrders }}</h4>
                        <small class="text-muted-cosmic">Pending Rites</small>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="cosmic-card p-3 text-center">
                        <div class="text-success fs-4 mb-1"><i class="bi bi-check2-circle"></i></div>
                        <h4 class="cinzel-font text-success mb-0 fw-bold">{{ $deliveredOrders }}</h4>
                        <small class="text-muted-cosmic">Blessed & Delivered</small>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="cosmic-card p-3 text-center">
                        <div class="text-gold fs-4 mb-1"><i class="bi bi-currency-rupee"></i></div>
                        <h4 class="cinzel-font text-gold mb-0 fw-bold">₹{{ number_format($totalSpent) }}</h4>
                        <small class="text-muted-cosmic">Sacred Spent</small>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="cosmic-card p-4 mb-4" data-aos="fade-up">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <h5 class="cinzel-font text-gold mb-0"><i class="bi bi-clock-history me-2"></i>Recent Consecrated Orders</h5>
                    <a href="{{ route('user.orders') }}" class="text-gold small text-decoration-none">View All Orders</a>
                </div>

                @if($recentOrders->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-cosmic align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('user.orders.show', $order->order_number) }}" class="text-gold fw-bold text-decoration-none">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td class="small text-muted-cosmic">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge badge-cosmic">{{ $order->items->count() }} Items</span>
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
                                            <a href="{{ route('user.orders.show', $order->order_number) }}" class="btn btn-cosmic-outline btn-sm py-1 px-2" title="View Order">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-4 text-center text-muted-cosmic">
                        <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                        No orders placed yet. Begin your celestial journey by browsing our certified ratnas.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
