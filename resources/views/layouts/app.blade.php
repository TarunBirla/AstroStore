<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', setting('site_name', 'AstroStore') . ' | Cosmic Vedic Astrology & Gemstones')</title>
    <meta name="description" content="@yield('meta_description', setting('meta_description', 'Premium Vedic Astrological Store: Certified Gemstones, Rudraksha, Yantras, Pooja Essentials & Consultations'))">
    <link rel="icon" type="image/x-icon" href="{{ setting('favicon') ? asset('storage/'.setting('favicon')) : 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>✨</text></svg>' }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons & Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Custom Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main class="py-4 flex-grow-1">
        <div class="container">
            @include('partials.alerts')
        </div>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });

        // Global Toast definition
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#1a0b2e',
            color: '#f5f0e6',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Helper for AJAX Add to Cart
        function addToCart(productId, quantity = 1) {
            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const cartBadge = document.getElementById('cart-count');
                    if (cartBadge) cartBadge.innerText = data.cart_count;
                    Toast.fire({
                        icon: 'success',
                        title: data.message || 'Product added to cart'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message || 'Failed to add product'
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong!'
                });
            });
        }

        // Helper for Wishlist Toggle
        function toggleWishlist(productId, btnElement) {
            fetch("{{ route('wishlist.toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'unauthenticated') {
                    window.location.href = "{{ route('login') }}";
                    return;
                }
                if (data.status === 'success') {
                    const wishBadge = document.getElementById('wishlist-count');
                    if (wishBadge) wishBadge.innerText = data.wishlist_count;
                    
                    if (btnElement) {
                        if (data.action === 'added') {
                            btnElement.classList.add('active');
                            btnElement.innerHTML = '<i class="bi bi-heart-fill text-danger"></i>';
                        } else {
                            btnElement.classList.remove('active');
                            btnElement.innerHTML = '<i class="bi bi-heart"></i>';
                        }
                    }
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                }
            })
            .catch(err => console.error(err));
        }
    </script>

    @stack('scripts')
</body>
</html>
