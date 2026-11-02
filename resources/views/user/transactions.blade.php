@extends('layouts.app')

@section('title', 'Payment & Transaction History | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Devotee Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment History</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-3">
            @include('user.partials.sidebar')
        </div>

        <div class="col-lg-9">
            <div class="cosmic-card p-4">
                <h4 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-credit-card-2-front me-2"></i>Payment & Transaction History
                </h4>

                @if($payments->isNotEmpty())
                    <div class="table-responsive mb-4">
                        <table class="table table-cosmic align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Order #</th>
                                    <th>Channel</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $pay)
                                    <tr>
                                        <td>
                                            <code class="text-gold">{{ $pay->transaction_id ?: 'N/A' }}</code>
                                        </td>
                                        <td>
                                            @if($pay->order)
                                                <a href="{{ route('user.orders.show', $pay->order->order_number) }}" class="text-light text-decoration-none fw-bold">
                                                    {{ $pay->order->order_number }}
                                                </a>
                                            @else
                                                <span class="text-muted-cosmic">N/A</span>
                                            @endif
                                        </td>
                                        <td class="text-uppercase small">{{ $pay->method }}</td>
                                        <td class="text-gold fw-bold">₹{{ number_format($pay->amount, 2) }}</td>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'success' => 'bg-success text-white',
                                                    'pending' => 'badge-saffron',
                                                    'failed' => 'bg-danger text-white',
                                                    'refunded' => 'bg-secondary text-white',
                                                ][$pay->status] ?? 'badge-cosmic';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ ucfirst($pay->status) }}
                                            </span>
                                        </td>
                                        <td class="small text-muted-cosmic">{{ $pay->created_at->format('M d, Y - h:i A') }}</td>
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
                        <h5>No payment transactions recorded yet.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
