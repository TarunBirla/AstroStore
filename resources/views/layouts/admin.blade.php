<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') | {{ setting('site_name', 'AstroStore') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @stack('styles')
</head>
<body style="background-color: #0b0314;">

    <!-- Left Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Sidebar Brand -->
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span style="font-size: 1.5rem;">✨</span>
            <div>
                <span class="text-gold">ASTRO</span><span class="text-saffron">ADMIN</span>
                <div style="font-size: 0.65rem; color: var(--cosmic-muted-text); font-family: var(--font-body); font-weight: normal; letter-spacing: 0;">Cosmic Control Center</div>
            </div>
        </a>

        <!-- Sidebar Navigation -->
        <ul class="nav flex-column py-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-tags-fill"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                    <i class="bi bi-gem"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Orders</span>
                    @php $pendingOrders = \App\Models\Order::where('status', 'pending')->count(); @endphp
                    @if($pendingOrders > 0)
                        <span class="badge badge-saffron ms-auto" style="font-size: 0.7rem;">{{ $pendingOrders }}</span>
                    @endif
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}" href="{{ route('admin.payments.index') }}">
                    <i class="bi bi-cash-stack"></i>
                    <span>Payments</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}" href="{{ route('admin.coupons.index') }}">
                    <i class="bi bi-ticket-perforated-fill"></i>
                    <span>Coupons & Offers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Users & Devotees</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}" href="{{ route('admin.banners.index') }}">
                    <i class="bi bi-images"></i>
                    <span>Banners & Sliders</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" href="{{ route('admin.reviews.index') }}">
                    <i class="bi bi-star-half"></i>
                    <span>Product Reviews</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
                    <i class="bi bi-chat-left-dots-fill"></i>
                    <span>Contact Queries</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}" href="{{ route('admin.analytics') }}">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Sales Analytics</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="bi bi-sliders"></i>
                    <span>Settings</span>
                </a>
            </li>

            <li class="nav-item mt-3 pt-3" style="border-top: 1px solid rgba(212,175,55,0.15);">
                <a class="nav-link text-warning" href="{{ url('/') }}" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Live Website</span>
                </a>
            </li>

            <li class="nav-item">
                <form action="{{ route('admin.logout') }}" method="POST" id="adminLogoutForm">
                    @csrf
                    <button type="submit" class="nav-link text-danger border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-power"></i>
                        <span>Admin Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="admin-main-wrapper">
        <!-- Admin Topbar -->
        <nav class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-warning d-lg-none" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <div class="d-none d-md-block">
                    <span class="cinzel-font text-gold fs-5">@yield('page_title', 'Admin Dashboard')</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Fullscreen Toggle -->
                <button class="btn btn-cosmic-outline py-1 px-2" onclick="toggleFullScreen()" title="Toggle Fullscreen">
                    <i class="bi bi-arrows-fullscreen"></i>
                </button>

                <!-- Admin Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-cosmic-outline dropdown-toggle d-flex align-items-center gap-2 py-1 px-3" type="button" data-bs-toggle="dropdown">
                        <span class="badge rounded-circle badge-gold p-2"><i class="bi bi-shield-lock-fill"></i></span>
                        <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end cosmic-dropdown">
                        <li><span class="dropdown-item-text text-muted-cosmic" style="font-size: 0.8rem;">Role: Master Astrologer / Admin</span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}" target="_blank"><i class="bi bi-eye me-2"></i> View Site</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item text-danger" href="javascript:void(0);" onclick="document.getElementById('adminLogoutForm').submit()">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Body -->
        <main class="p-4 flex-grow-1">
            @include('partials.alerts')
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="p-3 text-center text-muted-cosmic" style="border-top: 1px solid rgba(212,175,55,0.15); font-size: 0.85rem; background: #0c0418;">
            © {{ date('Y') }} <span class="text-gold">{{ setting('site_name', 'AstroStore') }}</span> Admin Portal. Built with Vedic Precision.
        </footer>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Fullscreen toggle
        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        // Global SweetAlert Toast
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#1a0b2e',
            color: '#f5f0e6'
        });

        // Global Delete confirmation function
        function confirmDelete(formId, message = 'Are you sure you want to delete this record? This action cannot be reversed.') {
            Swal.fire({
                title: 'Confirm Deletion',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3d1d6b',
                confirmButtonText: 'Yes, Delete!',
                cancelButtonText: 'Cancel',
                background: '#1a0b2e',
                color: '#f5f0e6'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
