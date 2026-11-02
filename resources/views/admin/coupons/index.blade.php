@extends('layouts.admin')

@section('title', 'Manage Coupons & Offers')
@section('page_title', 'Auspicious Coupons & Offers')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-ticket-perforated-fill me-2"></i>Active Coupons & Discount Codes</h4>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-cosmic-gold btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Create New Coupon
        </a>
    </div>

    <!-- Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.coupons.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search coupon code..." value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-search"></i> Search</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($coupons->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Type & Value</th>
                        <th>Min Order</th>
                        <th>Max Disc.</th>
                        <th>Usage / Limit</th>
                        <th>Validity Period</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coup)
                        <tr>
                            <td>
                                <span class="badge badge-gold fs-6 px-3 py-1">{{ $coup->code }}</span>
                            </td>
                            <td>
                                @if($coup->type === 'percent')
                                    <strong class="text-light">{{ (int)$coup->value }}% OFF</strong>
                                @else
                                    <strong class="text-light">₹{{ number_format($coup->value) }} FLAT</strong>
                                @endif
                            </td>
                            <td>₹{{ number_format($coup->min_order) }}</td>
                            <td>{{ $coup->max_discount ? '₹'.number_format($coup->max_discount) : 'Unlimited' }}</td>
                            <td>
                                <strong class="text-gold">{{ $coup->used_count }}</strong>
                                <span class="text-muted-cosmic">/ {{ $coup->usage_limit ?: '∞' }}</span>
                            </td>
                            <td class="small text-muted-cosmic">
                                @if($coup->start_date && $coup->end_date)
                                    {{ $coup->start_date->format('M d') }} - {{ $coup->end_date->format('M d, Y') }}
                                @else
                                    Perpetual
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.coupons.toggle', $coup->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $coup->status ? 'bg-success' : 'bg-secondary' }} border-0 text-white" style="cursor: pointer;">
                                        {{ $coup->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.coupons.edit', $coup->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.coupons.destroy', $coup->id) }}" method="POST" id="delCoup{{ $coup->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delCoup{{ $coup->id }}', 'Delete coupon {{ $coup->code }}?')">
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
            {{ $coupons->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-ticket-perforated fs-1 d-block mb-2 text-gold"></i>
            <h5>No coupons registered yet.</h5>
        </div>
    @endif
</div>
@endsection
