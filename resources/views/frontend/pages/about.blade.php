@extends('layouts.app')

@section('title', 'About Our Sacred Lineage | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>

    <!-- Hero Card -->
    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down" style="background: radial-gradient(circle at center, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.95) 100%);">
        <span class="badge badge-gold mb-2">✦ SACRED TRADITION & INTEGRITY ✦</span>
        <h1 class="cinzel-font text-gold display-5 fw-bold mb-3">Our Sacred Heritage & Acharyas</h1>
        <p class="text-light mb-0 fs-5" style="max-width: 750px; margin: 0 auto; line-height: 1.8;">
            Bridging ancient Vedic sciences of Varanasi with rigorous contemporary gemological standards to illuminate your life path.
        </p>
    </div>

    <!-- Section 1: Who We Are -->
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6" data-aos="fade-right">
            <span class="badge badge-saffron mb-2">✦ THE GENESIS ✦</span>
            <h2 class="cinzel-font text-gold display-6 mb-3">Varanasi's Trusted Astrological Sanctuary</h2>
            <p class="text-light" style="line-height: 1.8;">
                Founded on the banks of sacred River Ganga in Varanasi, <strong>{{ setting('site_name', 'AstroStore') }}</strong> was created with a solemn mission: to eliminate fake, synthetic, heated, and radiation-treated gemstones and unauthentic plastic rudrakshas from the sacred domain of astrology.
            </p>
            <p class="text-muted-cosmic" style="line-height: 1.8;">
                In the classical scriptures of Parashara, a gemstone is effective only when it possesses natural crystalline perfection and is consecrated (Prana Pratishtha) under an auspicious astrological Muhurat. Every item delivered by us undergoes triple verification: Govt Lab certification, microscopic inclusion checks, and traditional Sanskrit Vedic chanting.
            </p>
            <div class="row g-3 mt-2">
                <div class="col-6">
                    <div class="p-3 rounded" style="background: rgba(61, 29, 107, 0.4); border: 1px solid var(--cosmic-card-border);">
                        <div class="cinzel-font text-gold fs-3 fw-bold">15,000+</div>
                        <small class="text-muted-cosmic">Satisfied Devotees Worldwide</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded" style="background: rgba(61, 29, 107, 0.4); border: 1px solid var(--cosmic-card-border);">
                        <div class="cinzel-font text-saffron fs-3 fw-bold">100%</div>
                        <small class="text-muted-cosmic">Lab-Certified Earth Mined Ratnas</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80" alt="Vedic Acharyas" class="img-fluid rounded-4 shadow-lg" style="border: 1px solid var(--cosmic-accent-gold); max-height: 400px; width: 100%; object-fit: cover;">
        </div>
    </div>

    <!-- Section 2: Core Pillars -->
    <div class="cosmic-card p-4 p-md-5 mb-5" data-aos="fade-up">
        <h3 class="cinzel-font text-gold text-center mb-5">Our Three Sacred Pillars</h3>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-gold fs-2 mb-3" style="width: 65px; height: 65px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-shield-shaded"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Purity & Certification</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    Each gemstone arrives with an independent government-accredited gem lab test report confirming optical density, refractive index, and unheated status.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-saffron fs-2 mb-3" style="width: 65px; height: 65px; background: rgba(255,153,51,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-flower2"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Prana Pratishtha Rituals</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    Our Acharyas perform Panchamrit Abhishek, sacred Hawan and 108 Beej Mantra japas invoking planetary deities with your birth chart particulars.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-gold fs-2 mb-3" style="width: 65px; height: 65px; background: rgba(212,175,55,0.15); border: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-chat-heart"></i>
                </div>
                <h5 class="cinzel-font text-gold mb-2">Devotee Care Always</h5>
                <p class="text-muted-cosmic small" style="line-height: 1.7;">
                    We support your journey long after delivery—providing exact wearing muhurats, finger recommendations, mantra audio clips and lifetime guidance.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
