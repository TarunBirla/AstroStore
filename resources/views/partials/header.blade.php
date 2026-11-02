<header class="sticky-top">
    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg cosmic-navbar">
        <div class="container">
            <!-- Brand Logo -->
            <a class="navbar-brand py-1" href="{{ url('/') }}">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 38px; height: 38px; background: var(--accent); box-shadow: var(--shadow-sm);">
                        <i class="fa-solid fa-om fs-5"></i>
                    </div>
                    <div class="d-flex flex-column lh-1">
                        <span class="fw-bold" style="font-size: 1.25rem; letter-spacing: -0.02em; color: var(--text-heading);">
                            ASTRO<span style="color: var(--accent);">STORE</span>
                        </span>
                        <span class="text-muted" style="font-size: 0.68rem; font-weight: 500; letter-spacing: 0.05em; text-transform: uppercase;">Vedic Sanctuary</span>
                    </div>
                </div>
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#cosmicNavbar" aria-controls="cosmicNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list fs-2" style="color: var(--text-heading);"></i>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="cosmicNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('shop*') ? 'active' : '' }}" href="{{ route('shop') }}">Vedic Store</a>
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- Actions: Wishlist, Cart, User -->
                <div class="d-flex align-items-center gap-3 py-2 py-lg-0">
                    <!-- Wishlist Icon -->
                    <a href="{{ route('user.wishlist') }}" class="position-relative text-secondary fs-5 text-decoration-none p-1" title="Wishlist">
                        <i class="bi bi-heart" style="color: var(--text-heading);"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="wishlist-count" style="font-size: 0.65rem;">
                            {{ auth()->check() ? \App\Models\Wishlist::where('user_id', auth()->id())->count() : 0 }}
                        </span>
                    </a>

                    <!-- Cart Icon -->
                    <a href="{{ route('cart.index') }}" class="position-relative text-secondary fs-5 text-decoration-none p-1 me-2" title="Shopping Cart">
                        <i class="bi bi-bag" style="color: var(--text-heading);"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" id="cart-count" style="font-size: 0.65rem; background: var(--accent);">
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
                                    <i class="bi bi-person-circle" style="color: var(--accent);"></i>
                                @endif
                                <span class="fw-medium">{{ Str::limit(auth()->user()->name, 12) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end cosmic-dropdown shadow-sm" aria-labelledby="userMenu">
                                @if(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item fw-bold" href="{{ route('admin.dashboard') }}" style="color: var(--accent);"><i class="bi bi-speedometer2 me-2"></i> Admin Panel</a></li>
                                    <li><hr class="dropdown-divider my-1"></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="bi bi-grid me-2 text-muted"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}"><i class="bi bi-box-seam me-2 text-muted"></i> My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.wishlist') }}"><i class="bi bi-heart me-2 text-muted"></i> Wishlist</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="bi bi-person me-2 text-muted"></i> Profile Settings</a></li>
                                <li><hr class="dropdown-divider my-1"></li>
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
