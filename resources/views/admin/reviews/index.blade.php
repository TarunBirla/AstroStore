@extends('layouts.admin')

@section('title', 'Product Reviews & Ratings')
@section('page_title', 'Devotee Reviews Moderation')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-star-half me-2"></i>Product Reviews Moderation</h4>

        <!-- Status Filter -->
        <div class="d-flex gap-2">
            <a href="{{ route('admin.reviews.index') }}" class="btn btn-sm {{ !request('status') ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">All Reviews</a>
            <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Pending Approval</a>
            <a href="{{ route('admin.reviews.index', ['status' => 'approved']) }}" class="btn btn-sm {{ request('status') == 'approved' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Approved</a>
        </div>
    </div>

    @if($reviews->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Devotee</th>
                        <th>Rating</th>
                        <th style="width: 35%;">Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $rev)
                        <tr>
                            <td>
                                @if($rev->product)
                                    <a href="{{ route('product.show', $rev->product->slug) }}" target="_blank" class="text-light fw-bold text-decoration-none">
                                        {{ Str::limit($rev->product->name, 35) }}
                                    </a>
                                @else
                                    <span class="text-muted">Item deleted</span>
                                @endif
                            </td>
                            <td>{{ $rev->user->name ?? 'Devotee' }}</td>
                            <td>
                                <span class="text-gold">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi {{ $i <= $rev->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </span>
                            </td>
                            <td>
                                <span class="small text-muted-cosmic" style="line-height: 1.5;">{{ $rev->comment }}</span>
                            </td>
                            <td>
                                <span class="badge {{ $rev->status === 'approved' ? 'bg-success' : 'badge-saffron' }}">
                                    {{ ucfirst($rev->status) }}
                                </span>
                            </td>
                            <td class="small text-muted-cosmic">{{ $rev->created_at->diffForHumans() }}</td>
                            <td class="text-end">
                                @if($rev->status === 'pending')
                                    <form action="{{ route('admin.reviews.status', $rev->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="btn btn-sm btn-outline-success py-1 px-2" title="Approve Review">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.reviews.status', $rev->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="btn btn-sm btn-outline-warning py-1 px-2" title="Unapprove">
                                            <i class="bi bi-pause"></i> Unapprove
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.reviews.destroy', $rev->id) }}" method="POST" id="delRev{{ $rev->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delRev{{ $rev->id }}', 'Delete this review?')">
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
            {{ $reviews->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-star fs-1 d-block mb-2 text-gold"></i>
            <h5>No customer reviews found.</h5>
        </div>
    @endif
</div>
@endsection
