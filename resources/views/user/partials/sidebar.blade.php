<div class="user-sidebar mb-4">
    <!-- User Avatar & Details -->
    <div class="text-center pb-3 mb-3" style="border-bottom: 1px solid var(--cosmic-card-border);">
        <div class="position-relative d-inline-block mb-2">
            @if(auth()->user()->avatar && file_exists(public_path('storage/' . auth()->user()->avatar)))
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle border border-warning" style="width: 80px; height: 80px; object-fit: cover;" alt="avatar">
            @else
                <div class="rounded-circle border border-warning d-flex align-items-center justify-content-center text-gold mx-auto" style="width: 80px; height: 80px; background: rgba(61, 29, 107, 0.6); font-size: 2.2rem;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif
        </div>
        <h5 class="cinzel-font text-gold mb-0" style="font-size: 1.1rem;">{{ auth()->user()->name }}</h5>
        <small class="text-muted-cosmic">{{ auth()->user()->email }}</small>
        <div class="mt-2">
            <span class="badge badge-gold">✦ Sacred Devotee ✦</span>
        </div>
    </div>

    <!-- Navigation Links -->
    <nav class="d-flex flex-column">
        <a href="{{ route('user.dashboard') }}" class="user-nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('user.orders') }}" class="user-nav-link {{ request()->routeIs('user.orders*') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill"></i>
            <span>My Orders & Consults</span>
        </a>
        <a href="{{ route('user.transactions') }}" class="user-nav-link {{ request()->routeIs('user.transactions') ? 'active' : '' }}">
            <i class="bi bi-credit-card-fill"></i>
            <span>Payment History</span>
        </a>
        <a href="{{ route('user.wishlist') }}" class="user-nav-link {{ request()->routeIs('user.wishlist') ? 'active' : '' }}">
            <i class="bi bi-suit-heart-fill"></i>
            <span>Sacred Wishlist</span>
        </a>
        <a href="{{ route('user.profile') }}" class="user-nav-link {{ request()->routeIs('user.profile') ? 'active' : '' }}">
            <i class="bi bi-person-fill-gear"></i>
            <span>Profile & Addresses</span>
        </a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="user-nav-link text-warning mt-2" style="background: rgba(212,175,55,0.15);">
                <i class="bi bi-speedometer2"></i>
                <span>Admin Master Panel</span>
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-3 pt-2" style="border-top: 1px solid rgba(212,175,55,0.15);">
            @csrf
            <button type="submit" class="user-nav-link text-danger border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </button>
        </form>
    </nav>
</div>
