@extends('layouts.admin')

@section('title', 'Manage Devotees & Users')
@section('page_title', 'Devotees & Users Registry')

@section('content')
<div class="cosmic-card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <h4 class="cinzel-font text-gold mb-0"><i class="bi bi-people-fill me-2"></i>Devotee Profiles</h4>
        <a href="{{ route('admin.users.create') }}" class="btn btn-cosmic-gold btn-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Register New User
        </a>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="mb-4">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control cosmic-input" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="role" class="form-select cosmic-input">
                    <option value="">All Roles</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Devotees (user)</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrators (admin)</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select cosmic-input">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="blocked" {{ request('status') == 'blocked' ? 'selected' : '' }}>Blocked / Deactivated</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-cosmic-gold"><i class="bi bi-filter"></i> Filter</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-cosmic-outline ms-1">Reset</a>
            </div>
        </form>
    </div>

    @if($users->isNotEmpty())
        <div class="table-responsive mb-4">
            <table class="table table-cosmic align-middle mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Phone</th>
                        <th>City / State</th>
                        <th>Role</th>
                        <th>Orders</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($u->avatar && file_exists(public_path('storage/' . $u->avatar)))
                                        <img src="{{ asset('storage/' . $u->avatar) }}" class="rounded-circle border border-warning" style="width: 40px; height: 40px; object-fit: cover;" alt="avatar">
                                    @else
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fw-bold" style="width: 40px; height: 40px; background: rgba(61,29,107,0.7); font-size: 0.95rem;">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <strong class="text-light">{{ $u->name }}</strong>
                                        <small class="text-muted-cosmic d-block">{{ $u->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $u->phone ?: 'N/A' }}</td>
                            <td>{{ $u->city ? $u->city . ', ' . $u->state : 'Not set' }}</td>
                            <td>
                                <span class="badge {{ $u->role === 'admin' ? 'badge-gold' : 'badge-cosmic' }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-saffron">{{ $u->orders_count }} orders</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.users.toggle', $u->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="badge {{ $u->status === 'active' ? 'bg-success' : 'bg-danger' }} border-0 text-white" style="cursor: pointer;">
                                        {{ ucfirst($u->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.show', $u->id) }}" class="btn btn-outline-info btn-sm py-1 px-2" title="View Orders & Profile">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-cosmic-gold btn-sm py-1 px-2" title="Edit User">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                @if($u->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" id="delUser{{ $u->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="confirmDelete('delUser{{ $u->id }}', 'Delete user account {{ $u->name }}?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center pagination-cosmic">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="p-5 text-center text-muted-cosmic">
            <i class="bi bi-people fs-1 d-block mb-2 text-gold"></i>
            <h5>No devotees found matching this query.</h5>
        </div>
    @endif
</div>
@endsection
