@extends('layouts.app')

@section('title', setting('site_name', 'AstroStore') . ' | Vedic Astrological Sanctuary & Certified Remedies')

@section('content')
<!-- Hero Slider -->
<section class="hero-slider-section mb-5 position-relative">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner" style="border-radius: var(--cosmic-radius); overflow: hidden; max-height: 520px; box-shadow: 0 10px 30px rgba(11, 44, 90, 0.12);">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} position-relative">
                    <img src="{{ $slider->image }}" class="d-block w-100" alt="{{ $slider->title }}" style="object-fit: cover; height: 520px; filter: brightness(0.68);">
                    <div class="carousel-caption text-start d-flex flex-column justify-content-center h-100" style="bottom: 0; left: 8%; right: 8%; max-width: 680px;">
                        <span class="badge badge-saffron mb-3 d-inline-block align-self-start" data-aos="fade-down" style="font-size: 0.85rem; letter-spacing: 1px;">
                            <i class="fa-solid fa-om me-1"></i> VEDIC CONSECRATION GUARANTEED
                        </span>
                        <h1 class="cinzel-font text-white display-5 fw-bold mb-3" data-aos="fade-up" data-aos-delay="100" style="text-shadow: 0 2px 10px rgba(0,0,0,0.6);">
                            {{ $slider->title }}
                        </h1>
                        <p class="text-white mb-4 fs-6" data-aos="fade-up" data-aos-delay="200" style="line-height: 1.7; text-shadow: 0 1px 6px rgba(0,0,0,0.7); max-width: 580px;">
                            {{ $slider->subtitle }}
                        </p>
                        @if($slider->button_link)
                            <div data-aos="fade-up" data-aos-delay="300" class="d-flex flex-wrap gap-2">
                                <a href="{{ url($slider->button_link) }}" class="btn btn-cosmic-gold btn-lg">
                                    <i class="fa-solid fa-sparkles me-2"></i>{{ $slider->button_text ?: 'Explore Collection' }}
                                </a>
                                <a href="{{ route('shop') }}" class="btn btn-cosmic-outline btn-lg text-white" style="border-color: rgba(255,255,255,0.7);">
                                    <i class="fa-solid fa-gem me-2"></i>View All Products
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-3 rounded-circle" style="background-color: rgba(11,44,90,0.6); border: 1px solid var(--cosmic-card-border);" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-3 rounded-circle" style="background-color: rgba(11,44,90,0.6); border: 1px solid var(--cosmic-card-border);" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Trust & Feature Badges -->
<section class="container mb-5">
    <div class="row g-3">
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-primary fs-3" style="width: 54px; height: 54px; background: rgba(13, 110, 253, 0.1); border: 1px solid rgba(13, 110, 253, 0.2);">
                    <i class="fa-solid fa-certificate text-gold"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-primary mb-1">100% Gov-Lab Certified</h6>
                    <small class="text-muted">Authentic test report included with every gem</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3" style="width: 54px; height: 54px; background: rgba(230, 81, 0, 0.1); border: 1px solid rgba(230, 81, 0, 0.2);">
                    <i class="fa-solid fa-fire-flame-curved"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-primary mb-1">Prana Pratishtha Siddh</h6>
                    <small class="text-muted">Energized with Vedic mantras at Varanasi</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-primary fs-3" style="width: 54px; height: 54px; background: rgba(13, 110, 253, 0.1); border: 1px solid rgba(13, 110, 253, 0.2);">
                    <i class="fa-solid fa-truck-fast text-gold"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-primary mb-1">Free Insured Shipping</h6>
                    <small class="text-muted">Free insured delivery above ₹{{ setting('free_shipping_above', 999) }}</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="cosmic-card p-3 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3" style="width: 54px; height: 54px; background: rgba(230, 81, 0, 0.1); border: 1px solid rgba(230, 81, 0, 0.2);">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <h6 class="cinzel-font text-primary mb-1">Revered Jyotish Guidance</h6>
                    <small class="text-muted">Direct consultation with Vedic scholars</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Auspicious Offer Banner (if configured) -->
@if($offerBanner)
<section class="container mb-5" data-aos="fade-up">
    <div class="cosmic-card position-relative overflow-hidden p-4 p-md-5" style="background: linear-gradient(135deg, #e3f2fd 0%, #f0f7ff 100%); border: 2px solid var(--cosmic-accent-gold);">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge badge-gold mb-2"><i class="fa-solid fa-star me-1"></i> SPECIAL CONSECRATED OFFER</span>
                <h2 class="cinzel-font text-primary display-5 fw-bold mb-3">{{ $offerBanner->title }}</h2>
                <p class="text-secondary fs-5 mb-4" style="line-height: 1.7;">
                    {{ $offerBanner->subtitle }}
                </p>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url($offerBanner->button_link ?: '/shop') }}" class="btn btn-cosmic-gold btn-lg">
                        {{ $offerBanner->button_text ?: 'Shop Now' }} <i class="fa-solid fa-bag-shopping ms-2"></i>
                    </a>
                    <span class="text-saffron fw-bold"><i class="fa-solid fa-clock me-1"></i> Auspicious Muhurat Offer</span>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ $offerBanner->image }}" alt="{{ $offerBanner->title }}" class="img-fluid rounded-4 shadow" style="max-height: 320px; object-fit: cover; border: 1px solid var(--cosmic-card-border);">
            </div>
        </div>
    </div>
</section>
@endif

<!-- DETAILED ABOUT US & SANCTUARY SECTION -->
<section class="container mb-5">
    <div class="cosmic-card p-4 p-lg-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge badge-gold mb-2"><i class="fa-solid fa-hands-praying me-1"></i> SACRED HERITAGE & MISSION</span>
                <h2 class="cinzel-font text-primary display-6 fw-bold mb-3">Welcome to Varanasi's Divine Astrological Sanctuary</h2>
                <p class="text-secondary" style="line-height: 1.9; font-size: 1.02rem;">
                    Founded on the holy banks of sacred River Ganga in Kashi (Varanasi), <strong>{{ setting('site_name', 'AstroStore') }}</strong> is dedicated to bringing authentic, untouched, lab-certified planetary remedies and personalized Vedic astrology consultation to spiritual seekers across India and the globe.
                </p>
                <p class="text-muted" style="line-height: 1.8;">
                    In classical Parashari Jyotish, an astrological gemstone or spiritual remedy acts as a celestial optical prism—attracting beneficial cosmic rays into your auric body. However, nearly 90% of stones sold in generic commercial markets are synthetic, heat-treated, glass-filled, or un-energized plastic. We break this cycle with an unwavering pledge: <strong>100% naturally earth-mined, unheated gemstones</strong>, blessed with authentic Sanskrit mantra japas specifically in your birth gotra and rashi.
                </p>

                <!-- Statistics counter grid -->
                <div class="row g-3 mt-3 pt-3" style="border-top: 1px solid var(--cosmic-card-border);">
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="cinzel-font text-primary fs-2 fw-bold">25,000+</div>
                        <small class="text-muted"><i class="fa-solid fa-users text-gold me-1"></i> Happy Devotees</small>
                    </div>
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="cinzel-font text-saffron fs-2 fw-bold">100%</div>
                        <small class="text-muted"><i class="fa-solid fa-gem text-gold me-1"></i> Govt Lab Certified</small>
                    </div>
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="cinzel-font text-primary fs-2 fw-bold">18+ Yrs</div>
                        <small class="text-muted"><i class="fa-solid fa-clock-rotate-left text-gold me-1"></i> Vedic Lineage</small>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('about') }}" class="btn btn-cosmic-gold me-3">
                        Read Full Sacred Lineage <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-cosmic-outline">
                        <i class="fa-solid fa-phone me-1"></i> Speak to Acharya
                    </a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=900&q=80" alt="Vedic Acharyas" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; max-height: 480px; border: 3px solid rgba(212, 175, 55, 0.4);">
                    <div class="position-absolute bottom-0 start-0 m-3 p-3 rounded-3 shadow bg-white border" style="max-width: 290px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-certificate text-gold fs-3"></i>
                            <div>
                                <h6 class="cinzel-font mb-0 text-primary" style="font-size: 0.95rem;">Govt. Lab Certified</h6>
                                <small class="text-muted" style="font-size: 0.75rem;">IGI-GTL / ISO Tested Ratnas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SACRED PILLARS & PURITY PROCESS -->
<section class="py-5 mb-5" style="background: linear-gradient(180deg, #edf6fc 0%, #ffffff 100%); border-top: 1px solid var(--cosmic-card-border); border-bottom: 1px solid var(--cosmic-card-border);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge badge-gold mb-2"><i class="fa-solid fa-shield-halved me-1"></i> SACRED PROCESS</span>
            <h2 class="cinzel-font text-primary display-6 fw-bold">How Your Vedic Remedy Is Consecrated</h2>
            <p class="text-muted" style="max-width: 680px; margin: 0 auto;">Every stone, bead and yantra passes through a rigorous four-stage spiritual and scientific purification.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="cosmic-card p-4 h-100">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-primary fs-3 mb-3" style="width: 65px; height: 65px; background: rgba(13, 110, 253, 0.1); border: 1px solid rgba(13, 110, 253, 0.25);">
                        <i class="fa-solid fa-microscope text-gold"></i>
                    </div>
                    <h5 class="cinzel-font text-primary mb-2">1. Lab Authentication</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Microscopic inclusion checks, refractive index, and spectral density testing ensure zero heating, zero glass filling, and 100% natural earth-mined origin.
                    </p>
                </div>
            </div>

            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="cosmic-card p-4 h-100">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3 mb-3" style="width: 65px; height: 65px; background: rgba(230, 81, 0, 0.1); border: 1px solid rgba(230, 81, 0, 0.25);">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <h5 class="cinzel-font text-primary mb-2">2. Gangajal Shuddhi</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        The holy remedy is purified with authentic Varanasi Gangajal, raw cow milk, curd, honey, and sacred Panchamrit to clear negative handling vibrations.
                    </p>
                </div>
            </div>

            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="cosmic-card p-4 h-100">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-primary fs-3 mb-3" style="width: 65px; height: 65px; background: rgba(13, 110, 253, 0.1); border: 1px solid rgba(13, 110, 253, 0.25);">
                        <i class="fa-solid fa-fire-burner text-gold"></i>
                    </div>
                    <h5 class="cinzel-font text-primary mb-2">3. Prana Pratishtha</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Vedic Pandits conduct a full hawan reciting 108 Beej Mantras associated with the ruling deity and planet, dedicated specifically to your name and birth star.
                    </p>
                </div>
            </div>

            <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="cosmic-card p-4 h-100">
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-saffron fs-3 mb-3" style="width: 65px; height: 65px; background: rgba(230, 81, 0, 0.1); border: 1px solid rgba(230, 81, 0, 0.25);">
                        <i class="fa-solid fa-box-archive"></i>
                    </div>
                    <h5 class="cinzel-font text-primary mb-2">4. Sacred Packaging</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.7;">
                        Sealed in tamper-evident spiritual packaging along with certified lab report, Ganga Jal vial, sacred red thread, and exact wearing Muhurat guide.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FREQUENTLY ASKED QUESTIONS (FAQS) -->
<section class="container mb-5">
    <div class="text-center mb-4" data-aos="fade-up">
        <span class="badge badge-gold mb-2"><i class="fa-solid fa-circle-question me-1"></i> CLEAR YOUR CONFUSIONS</span>
        <h2 class="cinzel-font text-primary display-6 fw-bold">Frequently Asked Vedic Questions</h2>
        <p class="text-muted" style="max-width: 650px; margin: 0 auto;">Answers to essential questions regarding gemstone testing, wearing muhurat, Rudraksha purity, and Astrological remedies.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="homeFaqAccordion">
                <!-- FAQ 1 -->
                <div class="accordion-item mb-3 rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqOne">
                        <button class="accordion-button cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq1" aria-expanded="true">
                            <i class="fa-solid fa-gem text-gold me-2"></i> 1. How do I know the gemstone I receive is 100% natural and unheated?
                        </button>
                    </h2>
                    <div id="cHomeFaq1" class="accordion-collapse collapse show" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            Every single ratna dispatched by {{ setting('site_name', 'AstroStore') }} is accompanied by an independent government-accredited Gemological Laboratory Certificate. The report contains a high-resolution color photograph of your exact stone, its refractive index, specific gravity, microscopic natural inclusion patterns, and explicitly certifies that the stone is <strong>100% Natural, Unheated and Untreated</strong>. You can verify the report online anytime via QR code.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item mb-3 rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqTwo">
                        <button class="accordion-button collapsed cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq2">
                            <i class="fa-solid fa-fire text-saffron me-2"></i> 2. What is "Prana Pratishtha Consecration" and why is it mandatory?
                        </button>
                    </h2>
                    <div id="cHomeFaq2" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            In Vedic Jyotish, a gemstone directly extracted from the earth is considered dormant or in a state of deep cosmic sleep. Prana Pratishtha is the sacred Vedic ritual of invoking celestial life energy into the stone. Our Acharyas in Varanasi place the gemstone on a consecrated Yantra and recite 108 planetary Beej Mantras during an auspicious hora, attuning its molecular vibration to your unique birth chart.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item mb-3 rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqThree">
                        <button class="accordion-button collapsed cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq3">
                            <i class="fa-solid fa-circle-dot text-gold me-2"></i> 3. Can anyone wear Rudraksha regardless of zodiac sign, gender, or diet?
                        </button>
                    </h2>
                    <div id="cHomeFaq3" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            Yes, absolutely. The ancient scriptures like <em>Shiva Purana</em> and <em>Padma Purana</em> declare that Rudraksha beads are universal divine blessings from Lord Shiva for all humanity. Unlike gemstones which require precise planetary alignment, genuine Rudraksha has <strong>zero negative side effects</strong> and can be worn by anyone seeking health, mental peace, spiritual elevation, and protection from negative energies.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item mb-3 rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqFour">
                        <button class="accordion-button collapsed cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq4">
                            <i class="fa-solid fa-compass text-saffron me-2"></i> 4. What if I do not know my exact birth time for Kundli Consultation?
                        </button>
                    </h2>
                    <div id="cHomeFaq4" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            If your exact birth time is not known, our senior scholars use two classical Vedic techniques: <strong>Prashna Kundli (Horary Astrology)</strong> and <strong>Hasta Rekha Shastra (Palmistry)</strong>. By examining clear photographs of your palms along with the exact time you ask your question, highly accurate life readings, planetary positions, and remedies can be provided.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item mb-3 rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqFive">
                        <button class="accordion-button collapsed cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq5">
                            <i class="fa-solid fa-truck text-gold me-2"></i> 5. How long does delivery take and how is the gemstone shipped?
                        </button>
                    </h2>
                    <div id="cHomeFaq5" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            Consecration rituals take 24–48 hours to complete during auspicious muhurat timings. Once energized, your parcel is packed in a tamper-proof insured box and dispatched via premium express courier (BlueDart/Delhivery/SpeedPost). Delivery takes 3–5 working days anywhere in India. Real-time SMS and tracking links are shared instantly.
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="accordion-item rounded-3 overflow-hidden shadow-sm border">
                    <h2 class="accordion-header" id="hFaqSix">
                        <button class="accordion-button collapsed cinzel-font text-primary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq6">
                            <i class="fa-solid fa-rotate-left text-saffron me-2"></i> 6. What is the return and money-back authenticity policy?
                        </button>
                    </h2>
                    <div id="cHomeFaq6" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body text-secondary" style="line-height: 1.8;">
                            We offer a <strong>100% Lifetime Money-Back Guarantee</strong> on the authenticity of our gemstones. If any government-recognized gemological lab certifies that our natural stone is synthetic or heat-treated, we provide a full refund no questions asked. Additionally, we provide a 7-day return/replacement window for transit damage.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted mb-2">Have a question not listed here?</p>
                <a href="{{ route('faq') }}" class="btn btn-cosmic-outline me-2">
                    <i class="fa-solid fa-book-open me-1"></i> View All FAQs
                </a>
                <a href="{{ route('contact') }}" class="btn btn-cosmic-gold">
                    <i class="fa-solid fa-headset me-1"></i> Contact Astro Support
                </a>
            </div>
        </div>
    </div>
</section>

<!-- DEVOTEE EXPERIENCES & TESTIMONIALS -->
<section class="container mb-5">
    <div class="text-center mb-4" data-aos="fade-up">
        <span class="badge badge-saffron mb-2"><i class="fa-solid fa-heart me-1"></i> DEVOTEE EXPERIENCES</span>
        <h2 class="cinzel-font text-primary display-6 fw-bold">Words of Gratitude & Blessings</h2>
        <p class="text-muted" style="max-width: 600px; margin: 0 auto;">Read how our certified remedies and astrological guidance have touched lives across India.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary small fst-italic mb-3" style="line-height: 1.8;">
                    "The Ceylon Yellow Sapphire (Pukhraj) I received from AstroStore has brought tremendous mental clarity, peace, and career advancement within 45 days. The Govt lab certificate and consecration video gave me 100% peace of mind."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--cosmic-card-border);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #0b2c5a;">RK</div>
                    <div>
                        <h6 class="cinzel-font text-primary mb-0">Rajesh K.</h6>
                        <small class="text-muted"><i class="fa-solid fa-location-dot text-gold me-1"></i> Bengaluru, Karnataka</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary small fst-italic mb-3" style="line-height: 1.8;">
                    "Purchased a 7 Mukhi Nepal Rudraksha. The vibration of the bead was tangible from day one. Shipped safely on time with beautiful Ganga Jal, sacred vibhuti and complete wearing muhurat guide."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--cosmic-card-border);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #e65100;">PS</div>
                    <div>
                        <h6 class="cinzel-font text-primary mb-0">Priya Sharma</h6>
                        <small class="text-muted"><i class="fa-solid fa-location-dot text-gold me-1"></i> New Delhi</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-4 h-100">
                <div class="text-gold mb-3 fs-5">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="text-secondary small fst-italic mb-3" style="line-height: 1.8;">
                    "The personalized 50-page Kundli report was eye-opening. Every Dasha prediction aligned with my past milestones. Acharya ji's recommended remedies were practical and spiritually uplifting."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--cosmic-card-border);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: #0b2c5a;">VM</div>
                    <div>
                        <h6 class="cinzel-font text-primary mb-0">Vikram Malhotra</h6>
                        <small class="text-muted"><i class="fa-solid fa-location-dot text-gold me-1"></i> Pune, Maharashtra</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="container mb-5" data-aos="fade-up">
    <div class="p-5 text-center rounded-4 shadow-sm" style="background: linear-gradient(135deg, #0b2c5a 0%, #154580 100%); color: #ffffff;">
        <span class="badge badge-gold mb-3"><i class="fa-solid fa-om me-1"></i> START YOUR SPIRITUAL JOURNEY</span>
        <h2 class="cinzel-font text-white display-5 fw-bold mb-3">Discover the Power of Genuine Vedic Remedies</h2>
        <p class="text-white-50 fs-5 mb-4" style="max-width: 650px; margin: 0 auto;">Explore lab-certified natural gemstones, original Nepal Rudraksha, energized Yantras, or book your personalized Kundli consultation today.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="{{ route('shop') }}" class="btn btn-cosmic-gold btn-lg">
                <i class="fa-solid fa-bag-shopping me-2"></i>Visit Vedic Store
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="fa-solid fa-envelope me-2"></i>Contact Our Astrologers
            </a>
        </div>
    </div>
</section>
@endsection
