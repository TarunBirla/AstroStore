@extends('layouts.admin')

@section('title', 'Manage Sacred Categories')
@section('page_title', 'Sacred Categories Directory')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-tags-fill me-2"></i>Categories List</h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-cosmic-gold btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add New Category
        </a>
    </div>

    <!-- Search Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search by name..." value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-search"></i> Search</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($categories->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Order</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td>
                                @if($cat->image && file_exists(public_path('storage/' . $cat->image)))
                                    <img src="{{ asset('storage/' . $cat->image) }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: cover;" alt="{{ $cat->name }}">
                                @elseif($cat->image && Str::startsWith($cat->image, 'http'))
                                    <img src="{{ $cat->image }}" class="rounded-3" style="width: 48px; height: 48px; object-fit: cover;" alt="{{ $cat->name }}">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center text-gold" style="width: 48px; height: 48px; background: rgba(61,29,107,0.6);">
                                        <i class="bi bi-tags"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong class="text-light">{{ $cat->name }}</strong>
                            </td>
                            <td><code class="text-gold small">{{ $cat->slug }}</code></td>
                            <td>{{ $cat->sort_order }}</td>
                            <td>
                                <span class="badge badge-cosmic">{{ $cat->products_count }} items</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.categories.toggle', $cat->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $cat->status ? 'bg-success' : 'bg-secondary' }} border-0 text-white" style="cursor: pointer;">
                                        {{ $cat->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Edit Category">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" id="delCat{{ $cat->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delCat{{ $cat->id }}', 'Delete category {{ $cat->name }}? Associated products will have category unassigned.')">
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
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-tags fs-1 d-block mb-2 text-gold"></i>
            <h5>No categories found.</h5>
        </div>
    @endif
</div>
@endsection
