@extends('layouts.admin')

@section('title', 'Manage Celestial Products')
@section('page_title', 'Remedial Products Directory')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-gem me-2"></i>Consecrated Products</h4>
        <a href="{{ route('admin.products.create') }}" class="btn btn-cosmic-gold btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Add New Product
        </a>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.products.index') }}" method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search title or SKU..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-select cosmic-input">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="stock_status" class="form-select cosmic-input">
                    <option value="">All Stock Levels</option>
                    <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock (>0)</option>
                    <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock (≤5)</option>
                    <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock (0)</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($products->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Product & SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $prod)
                        <tr>
                            <td>
                                @if($prod->main_image && file_exists(public_path('storage/' . $prod->main_image)))
                                    <img src="{{ asset('storage/' . $prod->main_image) }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;" alt="thumb">
                                @elseif($prod->main_image && Str::startsWith($prod->main_image, 'http'))
                                    <img src="{{ $prod->main_image }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;" alt="thumb">
                                @else
                                    <div class="rounded-3 d-flex align-items-center justify-content-center text-gold" style="width: 50px; height: 50px; background: rgba(61,29,107,0.6);">
                                        <i class="bi bi-gem"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong class="text-light d-block">{{ $prod->name }}</strong>
                                <small class="text-muted-cosmic">SKU: <code class="text-gold">{{ $prod->sku ?: 'N/A' }}</code></small>
                            </td>
                            <td>
                                @if($prod->category)
                                    <span class="badge badge-cosmic">{{ $prod->category->name }}</span>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-gold fw-bold">₹{{ number_format($prod->active_price, 2) }}</div>
                                @if($prod->sale_price && $prod->sale_price < $prod->price)
                                    <small class="text-muted-cosmic text-decoration-line-through">₹{{ number_format($prod->price, 2) }}</small>
                                @endif
                            </td>
                            <td>
                                @if($prod->stock <= 0)
                                    <span class="badge bg-danger">0 (Out)</span>
                                @elseif($prod->stock <= 5)
                                    <span class="badge bg-warning text-dark">{{ $prod->stock }} (Low)</span>
                                @else
                                    <span class="badge bg-success">{{ $prod->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.products.featured', $prod->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $prod->is_featured ? 'badge-gold' : 'bg-secondary' }} border-0" style="cursor: pointer;">
                                        {{ $prod->is_featured ? '⭐ Yes' : 'No' }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.products.toggle', $prod->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $prod->status ? 'bg-success' : 'bg-secondary' }} border-0 text-white" style="cursor: pointer;">
                                        {{ $prod->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('product.show', $prod->slug) }}" class="btn btn-outline-info btn-sm py-1 px-2" target="_blank" title="View in Frontend">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $prod->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Edit Product">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" id="delProd{{ $prod->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delProd{{ $prod->id }}', 'Delete item {{ $prod->name }}?')">
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
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-box-seam fs-1 d-block mb-2 text-gold"></i>
            <h5>No products found matching your search.</h5>
        </div>
    @endif
</div>
@endsection
