@extends('layouts.app')

@section('title', 'About Our Sacred Lineage | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol>
    </nav>

    <!-- Hero Card -->
    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down">
        <span class="badge badge-gold mb-2"><i class="fa-solid fa-om me-1"></i> SACRED TRADITION & INTEGRITY</span>
        <h1 class="display-5 fw-bold mb-3">Our Sacred Heritage & Acharyas</h1>
        <p class="text-muted mb-0 fs-5" style="max-width: 720px; margin: 0 auto; line-height: 1.7;">
            Bridging ancient Vedic sciences of Varanasi with rigorous contemporary gemological standards to illuminate your life path.
        </p>
    </div>

    <!-- Section 1: Who We Are -->
    <div class="row g-5 align-items-center mb-5">
        <div class="col-lg-6" data-aos="fade-right">
            <span class="badge badge-gold mb-2"><i class="fa-solid fa-landmark me-1"></i> THE GENESIS</span>
            <h2 class="display-6 fw-bold mb-3">Varanasi's Trusted Astrological Sanctuary</h2>
            <p style="line-height: 1.8; color: var(--text-body);">
                Founded on the banks of sacred River Ganga in Varanasi, <strong>{{ setting('site_name', 'AstroStore') }}</strong> was created with a solemn mission: to eliminate fake, synthetic, heated, and radiation-treated gemstones and unauthentic plastic rudrakshas from the sacred domain of astrology.
            </p>
            <p class="text-muted" style="line-height: 1.8;">
                In the classical scriptures of Parashara, a gemstone is effective only when it possesses natural crystalline perfection and is consecrated (Prana Pratishtha) under an auspicious astrological Muhurat. Every item delivered by us undergoes triple verification: Govt Lab certification, microscopic inclusion checks, and traditional Sanskrit Vedic chanting.
            </p>
            <div class="row g-3 mt-3">
                <div class="col-6">
                    <div class="p-3 rounded-3 bg-white border">
                        <div class="fs-3 fw-bold" style="color: var(--accent);">15,000+</div>
                        <small class="text-muted">Satisfied Devotees Worldwide</small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3 bg-white border">
                        <div class="fs-3 fw-bold" style="color: #b45309;">100%</div>
                        <small class="text-muted">Lab-Certified Earth Mined Ratnas</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=800&q=80" alt="Vedic Acharyas" class="img-fluid rounded-3 shadow-sm w-100" style="border: 1px solid var(--border-color); max-height: 400px; object-fit: cover;">
        </div>
    </div>

    <!-- Section 2: Core Pillars -->
    <div class="cosmic-card p-4 p-md-5 mb-5" data-aos="fade-up">
        <h3 class="text-center fw-bold mb-5">Our Three Sacred Pillars</h3>
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: var(--accent-light); color: var(--accent);">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">Purity & Certification</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Each gemstone arrives with an independent government-accredited gem lab test report confirming optical density, refractive index, and unheated status.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: #fef3c7; color: #b45309;">
                    <i class="fa-solid fa-fire"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">Prana Pratishtha Rituals</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Our Acharyas perform Panchamrit Abhishek, sacred Hawan and 108 Beej Mantra japas invoking planetary deities with your birth chart particulars.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: var(--accent-light); color: var(--accent);">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">Devotee Care Always</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    We support your journey long after delivery—providing exact wearing muhurats, finger recommendations, mantra audio clips and lifetime guidance.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
