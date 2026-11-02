@extends('layouts.app')

@section('title', setting('site_name', 'AstroStore') . ' | Sacred Vedic Astrological Sanctuary')

@section('content')
<!-- Hero Slider -->
<section class="hero-slider-section mb-5 position-relative">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner" style="border-radius: var(--cosmic-radius); overflow: hidden; max-height: 540px; box-shadow: 0 10px 40px rgba(0,0,0,0.7);">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} position-relative">
                    <img src="{{ $slider->image }}" class="d-block w-100" alt="{{ $slider->title }}" style="object-fit: cover; height: 540px; filter: brightness(0.42);">
                    <div class="carousel-caption text-start d-flex flex-column justify-content-center h-100" style="bottom: 0; left: 8%; right: 8%; max-width: 650px;">
                        <span class="badge badge-saffron mb-3 d-inline-block align-self-start" data-aos="fade-down" style="font-size: 0.85rem; letter-spacing: 1px;">
                            ✦ VEDIC CONSECRATION GUARANTEED ✦
                        </span>
                        <h1 class="cinzel-font text-gold display-5 fw-bold mb-3" data-aos="fade-up" data-aos-delay="100" style="text-shadow: 0 0 20px rgba(212,175,55,0.4);">
                            {{ $slider->title }}
                        </h1>
                        <p class="text-light mb-4 fs-6" data-aos="fade-up" data-aos-delay="200" style="line-height: 1.7; text-shadow: 0 2px 4px rgba(0,0,0,0.8);">
                            {{ $slider->subtitle }}
                        </p>
                        @if($slider->button_link)
                            <div data-aos="fade-up" data-aos-delay="300">
                                <a href="{{ url($slider->button_link) }}" class="btn btn-cosmic-gold btn-lg me-3">
                                    {{ $slider->button_text ?: 'Explore Collection' }} <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                                <a href="{{ route('shop') }}" class="btn btn-cosmic-outline btn-lg">
                                    View All
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-3 rounded-circle" style="background-color: rgba(26,11,46,0.6); border: 1px solid var(--cosmic-card-border);" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-3 rounded-circle" style="background-color: rgba(26,11,46,0.6); border: 1px solid var(--cosmic-card-border);" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Features Bar -->
<section class="container mb-5">
    <div class="row g-3">
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fs-3" style="width: 54px; height: 54px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-gold mb-1">100% Gov-Lab Certified</h6>
                    <small class="text-muted-cosmic">Authentic test report included with every gem</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3" style="width: 54px; height: 54px; background: rgba(255,153,51,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-fire"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-gold mb-1">Prana Pratishtha Siddh</h6>
                    <small class="text-muted-cosmic">Consecrated with Vedic mantras at Varanasi</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fs-3" style="width: 54px; height: 54px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-truck"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-gold mb-1">Auspicious Safe Shipping</h6>
                    <small class="text-muted-cosmic">Free insured delivery above ₹{{ setting('free_shipping_above', 999) }}</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3" style="width: 54px; height: 54px; background: rgba(255,153,51,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-person-video3"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-gold mb-1">Revered Jyotish Guidance</h6>
                    <small class="text-muted-cosmic">Direct consultation with Vedic scholars</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sacred Categories -->
<section class="container mb-5">
    <div class="text-center mb-4" data-aos="fade-up">
        <span class="badge badge-gold mb-2">✦ AUSPICIOUS SANCTUARY ✦</span>
        <h2 class="cinzel-font text-gold display-6">Explore Sacred Categories</h2>
        <p class="text-muted-cosmic" style="max-width: 600px; margin: 0 auto;">Select from our six divine spheres of planetary balance, spiritual elevation and Vedic wisdom</p>
    </div>

    <div class="row g-4">
        @foreach($categories as $cat)
            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 80 }}">
                <a href="{{ route('category.show', $cat->slug) }}" class="text-decoration-none">
                    <div class="cosmic-card position-relative overflow-hidden" style="height: 240px;">
                        <img src="{{ $cat->image ?: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $cat->name }}" class="w-100 h-100" style="object-fit: cover; filter: brightness(0.45); transition: transform 0.6s ease;">
                        <div class="position-absolute bottom-0 start-0 w-100 p-4" style="background: linear-gradient(to top, rgba(15,5,29,0.95), transparent);">
                            <span class="badge badge-saffron mb-2" style="font-size: 0.72rem;">{{ $cat->products_count }} Sacred Items</span>
                            <h4 class="cinzel-font text-gold mb-1">{{ $cat->name }}</h4>
                            <p class="text-muted-cosmic mb-0 small" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $cat->description }}
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

<!-- Featured Divine Products -->
<section class="container mb-5">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" data-aos="fade-up">
        <div>
            <span class="badge badge-gold mb-2">✦ HEAVENLY SELECTION ✦</span>
            <h2 class="cinzel-font text-gold display-6 mb-0">Featured Planetary Remedies</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-cosmic-outline mt-3 mt-md-0">
            View All Sacred Store <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($featuredProducts as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
</section>

<!-- Auspicious Offer Banner -->
@if($offerBanner)
<section class="container mb-5" data-aos="fade-up">
    <div class="cosmic-card position-relative overflow-hidden p-4 p-md-5" style="background: linear-gradient(135deg, rgba(61,29,107,0.85) 0%, rgba(26,11,46,0.95) 100%); border: 2px solid var(--cosmic-accent-gold);">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge badge-gold mb-2">✦ SPECIAL CONSECRATED OFFER ✦</span>
                <h2 class="cinzel-font text-gold display-5 fw-bold mb-3">{{ $offerBanner->title }}</h2>
                <p class="text-light fs-5 mb-4" style="line-height: 1.7;">
                    {{ $offerBanner->subtitle }}
                </p>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url($offerBanner->button_link ?: '/shop') }}" class="btn btn-cosmic-gold btn-lg">
                        {{ $offerBanner->button_text ?: 'Shop Now' }} <i class="bi bi-stars ms-2"></i>
                    </a>
                    <span class="text-saffron fw-bold"><i class="bi bi-clock-history me-1"></i> Auspicious Muhurat Offer</span>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ $offerBanner->image }}" alt="{{ $offerBanner->title }}" class="img-fluid rounded-4 shadow-lg pulse-glow" style="max-height: 320px; object-fit: cover; border: 1px solid var(--cosmic-card-border);">
            </div>
        </div>
    </div>
</section>
@endif

<!-- New Celestial Arrivals -->
<section class="container mb-5">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" data-aos="fade-up">
        <div>
            <span class="badge badge-saffron mb-2">✦ FRESHLY ENERGISED ✦</span>
            <h2 class="cinzel-font text-gold display-6 mb-0">New Cosmic Arrivals</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn btn-cosmic-outline mt-3 mt-md-0">
            Explore All <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($newArrivals as $product)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5 mb-5" style="background: rgba(15, 5, 29, 0.7); border-top: 1px solid var(--cosmic-card-border); border-bottom: 1px solid var(--cosmic-card-border);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-gold mb-2">✦ THE VEDIC PROMISE ✦</span>
            <h2 class="cinzel-font text-gold display-6">Why Seekers Trust AstroStore</h2>
            <p class="text-muted-cosmic" style="max-width: 650px; margin: 0 auto;">Rooted in the eternal traditions of Varanasi, preserving sacred integrity in every gem and bead</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4 text-center p-3" data-aos="fade-up" data-aos-delay="100">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-gold fs-2 mb-3" style="width: 70px; height: 70px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-accent-gold);">
                    <i class="bi bi-gem"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Zero Treated / Fake Stones</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    We never sell glass-filled, synthetic, or radiation-treated stones. Every single ratna is 100% natural, earth-mined, and certified by recognized gem testing laboratories.
                </p>
            </div>

            <div class="col-md-4 text-center p-3" data-aos="fade-up" data-aos-delay="200">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-saffron fs-2 mb-3" style="width: 70px; height: 70px; background: rgba(255,153,51,0.15); border: 1px solid var(--cosmic-accent-saffron);">
                    <i class="bi bi-moon-stars"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Individualized Mantra Japa</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    Before dispatch, our scholarly pandits energize your items with specific planetary beej mantras chanted with your Gotra and birth name during auspicious hora timings.
                </p>
            </div>

            <div class="col-md-4 text-center p-3" data-aos="fade-up" data-aos-delay="300">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-gold fs-2 mb-3" style="width: 70px; height: 70px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-accent-gold);">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Lifetime Authenticity Assurance</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    Experience complete peace of mind with 100% money-back guarantee against non-natural stones, accompanied by tamper-proof holographic test certificates.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Insights from Acharyas (Blogs) -->
<section class="container mb-5">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4" data-aos="fade-up">
        <div>
            <span class="badge badge-gold mb-2">✦ SACRED WISDOM ✦</span>
            <h2 class="cinzel-font text-gold display-6 mb-0">Astrology & Spiritual Insights</h2>
        </div>
        <a href="{{ route('blogs') }}" class="btn btn-cosmic-outline mt-3 mt-md-0">
            Read All Articles <i class="bi bi-book ms-1"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach($latestBlogs as $blog)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="cosmic-card h-100 d-flex flex-column">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="overflow-hidden d-block" style="height: 200px;">
                        <img src="{{ $blog->image ?: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $blog->title }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
                    </a>
                    <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between text-muted-cosmic mb-2" style="font-size: 0.78rem;">
                                <span><i class="bi bi-person text-gold me-1"></i>{{ $blog->author }}</span>
                                <span><i class="bi bi-calendar3 me-1"></i>{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            <h5 class="cinzel-font mb-2" style="font-size: 1.05rem;">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-light">
                                    {{ $blog->title }}
                                </a>
                            </h5>
                            <p class="text-muted-cosmic small mb-3" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $blog->excerpt }}
                            </p>
                        </div>
                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-gold fw-bold text-decoration-none small">
                            Read Divine Guidance <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Celestial Testimonials -->
<section class="container mb-5">
    <div class="text-center mb-4" data-aos="fade-up">
        <span class="badge badge-saffron mb-2">✦ DEVOTEE EXPERIENCES ✦</span>
        <h2 class="cinzel-font text-gold display-6">Words of Gratitude</h2>
    </div>

    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">★★★★★</div>
                <p class="text-light small fst-italic mb-3" style="line-height: 1.7;">
                    "The Ceylon Pukhraj I received from AstroStore has transformed my mental clarity and career growth. The Vedic certificate gave me 100% confidence. Truly blessed!"
                </p>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">RK</div>
                    <div>
                        <h6 class="cinzel-font text-gold mb-0">Rajesh K.</h6>
                        <small class="text-muted-cosmic">Bangalore, Karnataka</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">★★★★★</div>
                <p class="text-light small fst-italic mb-3" style="line-height: 1.7;">
                    "Purchased a 7 Mukhi Nepal Rudraksha. The energy of the bead was tangible from day one. Shipped on time with beautiful Ganga Jal and Prasad."
                </p>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">PS</div>
                    <div>
                        <h6 class="cinzel-font text-gold mb-0">Priya Sharma</h6>
                        <small class="text-muted-cosmic">New Delhi</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">★★★★★</div>
                <p class="text-light small fst-italic mb-3" style="line-height: 1.7;">
                    "The personalized 50-page Kundli report was eye-opening. Every Dasha prediction aligned with my past milestones. Acharya's remedies were simple yet powerful."
                </p>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-warning text-dark fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">VM</div>
                    <div>
                        <h6 class="cinzel-font text-gold mb-0">Vikram Malhotra</h6>
                        <small class="text-muted-cosmic">Pune, Maharashtra</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
