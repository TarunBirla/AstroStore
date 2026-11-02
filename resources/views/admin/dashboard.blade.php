@extends('layouts.admin')

@section('title', 'Cosmic Admin Dashboard')
@section('page_title', 'Master Astrologer Command Dashboard')

@section('content')
<!-- 6 Stat Cards -->
<div class="row g-3 mb-4">
    <!-- Card 1: Total Revenue -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Gross Revenue</span>
                <span class="badge rounded-circle p-2 badge-gold"><i class="bi bi-currency-rupee"></i></span>
            </div>
            <h4 class="cinzel-font text-gold mb-0 fw-bold">₹{{ number_format($totalRevenue) }}</h4>
            <small class="text-success" style="font-size: 0.72rem;"><i class="bi bi-arrow-up-right"></i> All Time Blessed</small>
        </div>
    </div>

    <!-- Card 2: Total Orders -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Total Orders</span>
                <span class="badge rounded-circle p-2 badge-saffron"><i class="bi bi-box-seam"></i></span>
            </div>
            <h4 class="cinzel-font text-light mb-0 fw-bold">{{ $totalOrders }}</h4>
            <small class="text-muted-cosmic" style="font-size: 0.72rem;">Customer Bookings</small>
        </div>
    </div>

    <!-- Card 3: Pending Orders -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100" style="border-color: rgba(255, 153, 51, 0.4);">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Pending Rites</span>
                <span class="badge rounded-circle p-2 bg-warning text-dark"><i class="bi bi-hourglass-split"></i></span>
            </div>
            <h4 class="cinzel-font text-saffron mb-0 fw-bold">{{ $pendingOrders }}</h4>
            <small class="text-warning" style="font-size: 0.72rem;">Awaiting Consecration</small>
        </div>
    </div>

    <!-- Card 4: Total Products -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Active Items</span>
                <span class="badge rounded-circle p-2 badge-cosmic"><i class="bi bi-gem"></i></span>
            </div>
            <h4 class="cinzel-font text-gold mb-0 fw-bold">{{ $totalProducts }}</h4>
            <small class="text-muted-cosmic" style="font-size: 0.72rem;">Across 6 Categories</small>
        </div>
    </div>

    <!-- Card 5: Devotees -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Devotees</span>
                <span class="badge rounded-circle p-2 badge-gold"><i class="bi bi-people"></i></span>
            </div>
            <h4 class="cinzel-font text-light mb-0 fw-bold">{{ $totalUsers }}</h4>
            <small class="text-muted-cosmic" style="font-size: 0.72rem;">Registered Users</small>
        </div>
    </div>

    <!-- Card 6: Low Stock Alert -->
    <div class="col-xl-2 col-md-4 col-6">
        <div class="cosmic-card p-3 h-100" style="border-color: {{ $lowStockCount > 0 ? 'rgba(239,68,68,0.5)' : 'var(--cosmic-card-border)' }};">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="text-muted-cosmic small">Low Stock (≤5)</span>
                <span class="badge rounded-circle p-2 bg-danger text-white"><i class="bi bi-exclamation-triangle"></i></span>
            </div>
            <h4 class="cinzel-font text-danger mb-0 fw-bold">{{ $lowStockCount }}</h4>
            <small class="text-danger" style="font-size: 0.72rem;">Needs Restock</small>
        </div>
    </div>
</div>

<!-- Charts Row 1: Sales Trend + Status Breakdown -->
<div class="row g-4 mb-4">
    <!-- Chart 1: 12-Month Sales History -->
    <div class="col-lg-8">
        <div class="cosmic-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="cinzel-font text-gold mb-0"><i class="bi bi-graph-up me-2"></i>12-Month Blessed Revenue Trajectory</h5>
                <span class="badge badge-gold">₹ INR</span>
            </div>
            <div style="height: 290px;">
                <canvas id="monthlySalesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 2: Order Status Doughnut -->
    <div class="col-lg-4">
        <div class="cosmic-card p-4 h-100">
            <h5 class="cinzel-font text-gold mb-3"><i class="bi bi-pie-chart-fill me-2"></i>Orders by State</h5>
            <div style="height: 240px; position: relative;">
                <canvas id="ordersStatusChart"></canvas>
            </div>
            <div class="d-flex justify-content-around text-center mt-3 pt-2 small text-muted-cosmic" style="border-top: 1px solid rgba(212,175,55,0.15);">
                <div>Pending: <strong class="text-warning">{{ $ordersByStatus['pending'] }}</strong></div>
                <div>Shipped: <strong class="text-info">{{ $ordersByStatus['shipped'] }}</strong></div>
                <div>Delivered: <strong class="text-success">{{ $ordersByStatus['delivered'] }}</strong></div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row 2: Category Distribution + 7-Days Sparkline -->
<div class="row g-4 mb-4">
    <!-- Chart 3: Category Distribution -->
    <div class="col-lg-6">
        <div class="cosmic-card p-4 h-100">
            <h5 class="cinzel-font text-gold mb-3"><i class="bi bi-bar-chart-fill me-2"></i>Category Inventory Volumes</h5>
            <div style="height: 220px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart 4: Last 7 Days Revenue -->
    <div class="col-lg-6">
        <div class="cosmic-card p-4 h-100">
            <h5 class="cinzel-font text-gold mb-3"><i class="bi bi-lightning-charge-fill text-saffron me-2"></i>Last 7 Days Revenue Inflow</h5>
            <div style="height: 220px;">
                <canvas id="last7DaysChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Tables Row: Recent Orders & Top Selling / Devotees -->
<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="cosmic-card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <h5 class="cinzel-font text-gold mb-0"><i class="bi bi-clock-history me-2"></i>Latest Consecrated Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-cosmic-outline btn-sm">View All Orders</a>
            </div>

            @if($recentOrders->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Devotee</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $ro)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $ro->id) }}" class="text-gold fw-bold text-decoration-none">
                                            {{ $ro->order_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="text-light fw-bold">{{ $ro->shipping_name }}</span><br>
                                        <small class="text-muted-cosmic">{{ $ro->phone }}</small>
                                    </td>
                                    <td class="text-gold fw-bold">₹{{ number_format($ro->total, 2) }}</td>
                                    <td>
                                        @php
                                            $stClass = [
                                                'pending' => 'badge-saffron',
                                                'processing' => 'badge-gold',
                                                'shipped' => 'badge-cosmic',
                                                'delivered' => 'bg-success text-white',
                                                'cancelled' => 'bg-danger text-white',
                                            ][$ro->status] ?? 'badge-cosmic';
                                        @endphp
                                        <span class="badge {{ $stClass }}">
                                            {{ ucfirst($ro->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $ro->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted-cosmic text-center py-4 mb-0">No orders registered in the system yet.</p>
            @endif
        </div>
    </div>

    <!-- Right: New Devotees -->
    <div class="col-lg-4">
        <div class="cosmic-card p-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-person-check-fill me-2"></i>New Devotees
            </h5>

            <div class="d-flex flex-column gap-3">
                @forelse($newUsers as $nu)
                    <div class="d-flex align-items-center justify-content-between p-2 rounded" style="background: rgba(15, 5, 29, 0.6); border: 1px solid var(--cosmic-card-border);">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fw-bold" style="width: 38px; height: 38px; background: rgba(61,29,107,0.7); font-size: 0.9rem;">
                                {{ strtoupper(substr($nu->name, 0, 1)) }}
                            </div>
                            <div>
                                <strong class="text-light small d-block">{{ $nu->name }}</strong>
                                <small class="text-muted-cosmic" style="font-size: 0.75rem;">{{ $nu->email }}</small>
                            </div>
                        </div>
                        <span class="badge badge-gold" style="font-size: 0.65rem;">Active</span>
                    </div>
                @empty
                    <p class="text-muted-cosmic small mb-0">No new devotees registered yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // 1. Monthly Sales Chart
    const ctxMonthly = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(ctxMonthly, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthLabels) !!},
            datasets: [{
                label: 'Monthly Revenue (₹)',
                data: {!! json_encode($monthlySales) !!},
                borderColor: '#d4af37',
                backgroundColor: 'rgba(212, 175, 55, 0.15)',
                borderWidth: 2,
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#ff9933',
                pointBorderColor: '#ffffff',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(212, 175, 55, 0.1)' },
                    ticks: { color: '#c0b3d6', font: { size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(212, 175, 55, 0.1)' },
                    ticks: { color: '#c0b3d6', font: { size: 11 } }
                }
            }
        }
    });

    // 2. Orders by Status Doughnut
    const ctxStatus = document.getElementById('ordersStatusChart').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'],
            datasets: [{
                data: [
                    {{ $ordersByStatus['pending'] }},
                    {{ $ordersByStatus['processing'] }},
                    {{ $ordersByStatus['shipped'] }},
                    {{ $ordersByStatus['delivered'] }},
                    {{ $ordersByStatus['cancelled'] }}
                ],
                backgroundColor: ['#ff9933', '#d4af37', '#582b99', '#22c55e', '#ef4444'],
                borderWidth: 2,
                borderColor: '#1a0b2e'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { color: '#f5f0e6', boxWidth: 12 } }
            }
        }
    });

    // 3. Category Bar Chart
    const ctxCategory = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCategory, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoryLabels) !!},
            datasets: [{
                label: 'Item Count',
                data: {!! json_encode($categoryCounts) !!},
                backgroundColor: 'rgba(88, 43, 153, 0.75)',
                borderColor: '#d4af37',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#c0b3d6', font: { size: 10 } }
                },
                y: {
                    grid: { color: 'rgba(212, 175, 55, 0.1)' },
                    ticks: { color: '#c0b3d6', stepSize: 1 }
                }
            }
        }
    });

    // 4. Last 7 Days Revenue Bar Chart
    const ctx7Days = document.getElementById('last7DaysChart').getContext('2d');
    new Chart(ctx7Days, {
        type: 'bar',
        data: {
            labels: {!! json_encode($last7DaysLabels) !!},
            datasets: [{
                label: 'Daily Sales (₹)',
                data: {!! json_encode($last7DaysRevenue) !!},
                backgroundColor: 'rgba(255, 153, 51, 0.7)',
                borderColor: '#ff9933',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#c0b3d6', font: { size: 10 } }
                },
                y: {
                    grid: { color: 'rgba(212, 175, 55, 0.1)' },
                    ticks: { color: '#c0b3d6' }
                }
            }
        }
    });
</script>
@endpush
