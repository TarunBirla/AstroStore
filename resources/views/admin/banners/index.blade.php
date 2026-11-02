@extends('layouts.admin')

@section('title', 'Manage Banners & Sliders')
@section('page_title', 'Banners & Sliders Control')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-images me-2"></i>Store Banners & Sliders</h4>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-cosmic-gold btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add New Banner
        </a>
    </div>

    <!-- Filter by Position -->
    <div class="mb-4">
        <div class="d-flex gap-2">
            <a href="{{ route('admin.banners.index') }}" class="btn btn-sm {{ !request('position') ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">All Positions</a>
            <a href="{{ route('admin.banners.index', ['position' => 'home_slider']) }}" class="btn btn-sm {{ request('position') == 'home_slider' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Home Slider</a>
            <a href="{{ route('admin.banners.index', ['position' => 'offer']) }}" class="btn btn-sm {{ request('position') == 'offer' ? 'btn-cosmic-gold' : 'btn-cosmic-outline' }}">Special Offer</a>
        </div>
    </div>

    @if($banners->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Title & Subtitle</th>
                        <th>Position</th>
                        <th>Button Link</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $ban)
                        <tr>
                            <td>
                                @php
                                    $imgSrc = file_exists(public_path('storage/' . $ban->image)) ? asset('storage/' . $ban->image) : $ban->image;
                                @endphp
                                <img src="{{ $imgSrc }}" class="rounded-3 border border-warning" style="width: 100px; height: 50px; object-fit: cover;" alt="banner">
                            </td>
                            <td>
                                <strong class="text-light d-block">{{ $ban->title }}</strong>
                                <small class="text-muted-cosmic">{{ Str::limit($ban->subtitle, 45) }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $ban->position === 'home_slider' ? 'badge-gold' : 'badge-saffron' }}">
                                    {{ $ban->position === 'home_slider' ? 'Home Slider' : 'Offer Banner' }}
                                </span>
                            </td>
                            <td>
                                @if($ban->button_link)
                                    <a href="{{ $ban->button_link }}" target="_blank" class="text-gold small text-decoration-none">
                                        {{ $ban->button_text ?: 'Link' }} <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                @else
                                    <span class="text-muted small">None</span>
                                @endif
                            </td>
                            <td>{{ $ban->sort_order }}</td>
                            <td>
                                <form action="{{ route('admin.banners.toggle', $ban->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $ban->status ? 'bg-success' : 'bg-secondary' }} border-0 text-white" style="cursor: pointer;">
                                        {{ $ban->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.banners.edit', $ban->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.banners.destroy', $ban->id) }}" method="POST" id="delBan{{ $ban->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delBan{{ $ban->id }}', 'Delete this banner?')">
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
            {{ $banners->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-images fs-1 d-block mb-2 text-gold"></i>
            <h5>No banners configured yet.</h5>
        </div>
    @endif
</div>
@endsection
