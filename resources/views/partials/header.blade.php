<header class="sticky-top">
    <!-- Top Announcement Bar -->
    <div class="py-1 px-3 text-center text-sm" style="background: linear-gradient(90deg, #1a0b2e, #3d1d6b, #1a0b2e); border-bottom: 1px solid rgba(212,175,55,0.2); font-size: 0.85rem;">
        <span class="text-gold">✦ Free Vedic Astro Shipping on orders above ₹{{ setting('free_shipping_above', 999) }} | Use Code <span class="badge badge-gold">ASTRO20</span> for 20% OFF ✦</span>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg cosmic-navbar py-3">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="font-size: 1.8rem; filter: drop-shadow(0 0 8px rgba(212,175,55,0.8));">✨</span>
                <span class="brand-text">
                    <span class="text-gold">{{ setting('site_name', 'ASTRO') }}</span><span style="color: var(--cosmic-accent-saffron);">STORE</span>
                </span>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler text-gold border-0" type="button" data-bs-toggle="collapse" data-bs-target="#cosmicNavbar" aria-controls="cosmicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2 text-gold"></i>
            </button>

            <!-- Navbar Links & Search -->
            <div class="collapse navbar-collapse" id="cosmicNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-link-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-link-item">
                        <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }}" href="{{ route('shop') }}">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="catDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu cosmic-dropdown" aria-labelledby="catDropdown">
                            @php
                                $navCategories = \App\Models\Category::where('status', 1)->orderBy('sort_order', 'asc')->get();
                            @endphp
                            @forelse($navCategories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category.show', $cat->slug) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @empty
                                <li><a class="dropdown-item" href="{{ route('shop') }}">Gemstones</a></li>
                                <li><a class="dropdown-item" href="{{ route('shop') }}">Rudraksha</a></li>
                                <li><a class="dropdown-item" href="{{ route('shop') }}">Yantras</a></li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-link-item">
                        <a class="nav-link {{ request()->is('blogs*') ? 'active' : '' }}" href="{{ route('blogs') }}">Blogs</a>
                    </li>
                    <li class="nav-link-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-link-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- Search Bar -->
                <form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center me-3 mb-2 mb-lg-0 search-form position-relative">
                    <input type="text" name="search" class="form-control cosmic-input pe-5" placeholder="Search cosmic items..." value="{{ request('search') }}" style="border-radius: 20px; font-size: 0.88rem; width: 220px;">
                    <button type="submit" class="btn position-absolute end-0 top-50 translate-middle-y text-gold me-1" style="border:none; background:transparent;">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- Actions: Wishlist, Cart, User -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Wishlist Icon -->
                    <a href="{{ route('user.wishlist') }}" class="position-relative text-gold fs-5 text-decoration-none" title="Wishlist">
                        <i class="bi bi-suit-heart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-saffron" id="wishlist-count" style="font-size: 0.65rem;">
                            {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }}
                        </span>
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="position-relative text-gold fs-5 text-decoration-none" title="Shopping Cart">
                        <i class="bi bi-bag"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-gold" id="cart-count" style="font-size: 0.65rem;">
                            {{ getCartCount() }}
                        </span>
                    </a>

                    <!-- User Auth Dropdown -->
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-cosmic-outline dropdown-toggle d-flex align-items-center gap-2 py-1 px-3" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 0.88rem;">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle" width="24" height="24" alt="avatar">
                                @else
                                    <i class="bi bi-person-circle"></i>
                                @endif
                                <span>{{ Str::limit(auth()->user()->name, 12) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end cosmic-dropdown" aria-labelledby="userMenu">
                                @if(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item text-gold fw-bold" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="bi bi-grid me-2"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}"><i class="bi bi-box-seam me-2"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.wishlist') }}"><i class="bi bi-heart me-2"></i> Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2"></i> Profile Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-cosmic-outline py-1 px-3" style="font-size: 0.88rem;">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-cosmic-gold py-1 px-3" style="font-size: 0.88rem;">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
