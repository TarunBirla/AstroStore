@extends('layouts.admin')

@section('title', 'Devotee: ' . $user->name)
@section('page_title', 'Devotee Dossier: ' . $user->name)

@section('content')
<div class="row g-4">
    <!-- User Profile Card -->
    <div class="col-lg-4">
        <div class="cosmic-card p-4 text-center mb-4">
            <div class="mb-3">
                @if($user->avatar && file_exists(public_path('storage/' . $user->avatar)))
                    <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle border border-warning" style="width: 90px; height: 90px; object-fit: cover;" alt="avatar">
                @else
                    <div class="rounded-circle border border-warning d-flex align-items-center justify-content-center text-gold mx-auto" style="width: 90px; height: 90px; background: rgba(61,29,107,0.7); font-size: 2.5rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <h4 class="cinzel-font text-gold mb-1">{{ $user->name }}</h4>
            <p class="text-muted-cosmic small mb-2">{{ $user->email }}</p>
            <div class="d-flex justify-content-center gap-2 mb-3">
                <span class="badge {{ $user->role === 'admin' ? 'badge-gold' : 'badge-cosmic' }}">{{ ucfirst($user->role) }}</span>
                <span class="badge {{ $user->status === 'active' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($user->status) }}</span>
            </div>

            <div class="p-3 rounded text-start" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border); font-size: 0.88rem;">
                <div class="mb-2"><span class="text-muted-cosmic">Phone:</span> <strong class="text-light">{{ $user->phone ?: 'N/A' }}</strong></div>
                <div class="mb-2"><span class="text-muted-cosmic">City:</span> <strong class="text-light">{{ $user->city ?: 'N/A' }}, {{ $user->state }}</strong></div>
                <div class="mb-2"><span class="text-muted-cosmic">Address:</span> <span class="text-light">{{ $user->address ?: 'Not provided' }}</span></div>
                <div><span class="text-muted-cosmic">Joined:</span> <span class="text-light">{{ $user->created_at->format('M d, Y') }}</span></div>
            </div>

            <div class="mt-3">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-cosmic-gold btn-sm w-100">
                    <i class="bi bi-pencil-square me-1"></i> Edit Account
                </a>
            </div>
        </div>
    </div>

    <!-- Orders History by this User -->
    <div class="col-lg-8">
        <div class="cosmic-card p-4">
            <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-box-seam me-2"></i>Orders Booked by this Devotee ({{ $user->orders->count() }})
            </h5>

            @if($user->orders->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-cosmic align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders as $ord)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="text-gold fw-bold text-decoration-none">
                                            {{ $ord->order_number }}
                                        </a>
                                    </td>
                                    <td class="small text-muted-cosmic">{{ $ord->created_at->format('M d, Y') }}</td>
                                    <td>{{ $ord->items->count() }} items</td>
                                    <td class="text-gold fw-bold">₹{{ number_format($ord->total, 2) }}</td>
                                    <td>
                                        <span class="badge badge-gold">{{ ucfirst($ord->status) }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.orders.show', $ord->id) }}" class="btn btn-cosmic-outline btn-sm py-1 px-2">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted-cosmic text-center py-4 mb-0">This devotee has not placed any orders yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
