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

        <div class="carousel-inner" style="border-radius: var(--card-radius); overflow: hidden; max-height: 500px; box-shadow: var(--shadow-md);">
            @foreach($sliders as $index => $slider)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} position-relative">
                    <img src="{{ $slider->image }}" class="d-block w-100" alt="{{ $slider->title }}" style="object-fit: cover; height: 500px; filter: brightness(0.65);">
                    <div class="carousel-caption text-start d-flex flex-column justify-content-center h-100" style="bottom: 0; left: 8%; right: 8%; max-width: 650px;">
                        <span class="badge badge-gold mb-3 d-inline-block align-self-start">
                            <i class="fa-solid fa-om me-1"></i> VEDIC CONSECRATION GUARANTEED
                        </span>
                        <h1 class="text-white display-5 fw-bold mb-3" data-aos="fade-up" data-aos-delay="100" style="text-shadow: 0 2px 8px rgba(0,0,0,0.5);">
                            {{ $slider->title }}
                        </h1>
                        <p class="text-white mb-4" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.05rem; line-height: 1.6; text-shadow: 0 1px 4px rgba(0,0,0,0.6); max-width: 540px;">
                            {{ $slider->subtitle }}
                        </p>
                        @if($slider->button_link)
                            <div data-aos="fade-up" data-aos-delay="300" class="d-flex flex-wrap gap-2">
                                <a href="{{ url($slider->button_link) }}" class="btn btn-cosmic-gold btn-lg">
                                    {{ $slider->button_text ?: 'Explore Collection' }} <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                                <a href="{{ route('shop') }}" class="btn btn-outline-light btn-lg">
                                    View Products
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon p-3 rounded-circle" style="background-color: rgba(26,26,26,0.6);" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon p-3 rounded-circle" style="background-color: rgba(26,26,26,0.6);" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Feature Badges -->
<section class="container mb-5">
    <div class="row g-4">
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-4 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center text-primary fs-4 flex-shrink-0" style="width: 50px; height: 50px; background: var(--accent-light);">
                    <i class="fa-solid fa-certificate" style="color: var(--accent);"></i>
                </div>
                <div>
                    <h6 class="mb-1" style="font-weight: 600;">100% Gov-Lab Certified</h6>
                    <small class="text-muted">Authentic test report included</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-4 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="width: 50px; height: 50px; background: #fef3c7;">
                    <i class="fa-solid fa-fire-flame-curved" style="color: #b45309;"></i>
                </div>
                <div>
                    <h6 class="mb-1" style="font-weight: 600;">Prana Pratishtha Siddh</h6>
                    <small class="text-muted">Energized at Varanasi</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-4 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="width: 50px; height: 50px; background: var(--accent-light);">
                    <i class="fa-solid fa-truck-fast" style="color: var(--accent);"></i>
                </div>
                <div>
                    <h6 class="mb-1" style="font-weight: 600;">Free Insured Shipping</h6>
                    <small class="text-muted">Free delivery above ₹{{ setting('free_shipping_above', 999) }}</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="cosmic-card p-4 d-flex align-items-center gap-3 h-100">
                <div class="rounded-circle d-flex align-items-center justify-content-center fs-4 flex-shrink-0" style="width: 50px; height: 50px; background: #fef3c7;">
                    <i class="fa-solid fa-user-tie" style="color: #b45309;"></i>
                </div>
                <div>
                    <h6 class="mb-1" style="font-weight: 600;">Jyotish Guidance</h6>
                    <small class="text-muted">Consultation with scholars</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Offer Banner (if configured) -->
@if($offerBanner)
<section class="container mb-5" data-aos="fade-up">
    <div class="cosmic-card p-4 p-md-5" style="background: var(--bg-soft-gray); border: 1px solid var(--border-color);">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge badge-gold mb-2"><i class="fa-solid fa-tag me-1"></i> SPECIAL OFFER</span>
                <h2 class="display-6 fw-bold mb-3">{{ $offerBanner->title }}</h2>
                <p class="text-muted fs-5 mb-4" style="line-height: 1.7;">
                    {{ $offerBanner->subtitle }}
                </p>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ url($offerBanner->button_link ?: '/shop') }}" class="btn btn-cosmic-gold btn-lg">
                        {{ $offerBanner->button_text ?: 'Shop Now' }} <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                    <span class="text-muted fw-medium"><i class="fa-solid fa-clock me-1 text-primary"></i> Limited Muhurat Offer</span>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <img src="{{ $offerBanner->image }}" alt="{{ $offerBanner->title }}" class="img-fluid rounded-3 shadow-sm" style="max-height: 300px; object-fit: cover; border: 1px solid var(--border-color);">
            </div>
        </div>
    </div>
</section>
@endif

<!-- ABOUT US SECTION -->
<section class="container mb-5">
    <div class="cosmic-card p-4 p-lg-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge badge-gold mb-2"><i class="fa-solid fa-om me-1"></i> ABOUT OUR SANCTUARY</span>
                <h2 class="display-6 fw-bold mb-3">Vedic Astrological Sanctuary & Purity Heritage</h2>
                <p style="font-size: 1.05rem; line-height: 1.8; color: var(--text-body);">
                    Founded on the holy banks of sacred River Ganga in Varanasi, <strong>{{ setting('site_name', 'AstroStore') }}</strong> provides authentic, untouched, lab-certified planetary remedies and personalized Vedic astrology consultation to spiritual seekers worldwide.
                </p>
                <p class="text-muted" style="line-height: 1.8;">
                    In classical Parashari Jyotish, an astrological gemstone acts as an optical prism—transmitting beneficial cosmic rays into your auric field. We eliminate commercial duplicates with an unwavering pledge: <strong>100% naturally earth-mined, unheated gemstones</strong>, energized with authentic Sanskrit mantra japas dedicated in your birth gotra and rashi.
                </p>

                <!-- Statistics counter grid -->
                <div class="row g-3 mt-3 pt-3" style="border-top: 1px solid var(--border-color);">
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="fs-2 fw-bold" style="color: var(--accent);">25,000+</div>
                        <small class="text-muted">Happy Devotees</small>
                    </div>
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="fs-2 fw-bold" style="color: #b45309;">100%</div>
                        <small class="text-muted">Govt Lab Certified</small>
                    </div>
                    <div class="col-sm-4 text-center text-sm-start">
                        <div class="fs-2 fw-bold" style="color: var(--accent);">18+ Yrs</div>
                        <small class="text-muted">Vedic Lineage</small>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('about') }}" class="btn btn-cosmic-gold me-3">
                        Read Our Story <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-cosmic-outline">
                        Speak to Acharya
                    </a>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=900&q=80" alt="Vedic Acharyas" class="img-fluid rounded-3 shadow-sm w-100" style="object-fit: cover; max-height: 440px; border: 1px solid var(--border-color);">
                    <div class="position-absolute bottom-0 start-0 m-3 p-3 rounded-3 shadow-sm bg-white border" style="max-width: 270px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-certificate fs-3" style="color: var(--accent);"></i>
                            <div>
                                <h6 class="mb-0" style="font-size: 0.95rem; font-weight: 600;">Govt. Lab Certified</h6>
                                <small class="text-muted" style="font-size: 0.78rem;">IGI-GTL / ISO Tested Ratnas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CONSECRATION PROCESS -->
<section class="container mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge badge-gold mb-2">SACRED PROCESS</span>
        <h2 class="display-6 fw-bold">How Your Vedic Remedy Is Consecrated</h2>
        <p class="text-muted" style="max-width: 650px; margin: 0 auto;">Every stone, bead and yantra passes through a rigorous four-stage spiritual and scientific purification.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-4 h-100">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: var(--accent-light); color: var(--accent);">
                    <i class="fa-solid fa-microscope"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">1. Lab Authentication</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Refractive index and spectral density testing ensure zero heating, zero glass filling, and 100% natural earth-mined origin.
                </p>
            </div>
        </div>

        <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-4 h-100">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: #fef3c7; color: #b45309;">
                    <i class="fa-solid fa-water"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">2. Gangajal Shuddhi</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Purified with authentic Varanasi Gangajal, raw milk, curd, honey, and Panchamrit to clear negative handling vibrations.
                </p>
            </div>
        </div>

        <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-4 h-100">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: var(--accent-light); color: var(--accent);">
                    <i class="fa-solid fa-fire-burner"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">3. Prana Pratishtha</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Vedic Pandits conduct hawan reciting 108 Beej Mantras dedicated to your specific name, gotra, and birth rashi.
                </p>
            </div>
        </div>

        <div class="col-md-3 text-center" data-aos="fade-up" data-aos-delay="400">
            <div class="cosmic-card p-4 h-100">
                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fs-3 mb-3" style="width: 60px; height: 60px; background: #fef3c7; color: #b45309;">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
                <h5 class="mb-2" style="font-weight: 600;">4. Sacred Packaging</h5>
                <p class="text-muted small mb-0" style="line-height: 1.7;">
                    Sealed in tamper-evident spiritual packaging along with certified lab report, Ganga Jal vial, and wearing Muhurat guide.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- FREQUENTLY ASKED QUESTIONS (FAQS) -->
<section class="container mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge badge-gold mb-2">KNOWLEDGE BASE</span>
        <h2 class="display-6 fw-bold">Frequently Asked Questions</h2>
        <p class="text-muted" style="max-width: 620px; margin: 0 auto;">Answers to essential questions regarding gemstone testing, wearing muhurat, Rudraksha purity, and Astrological remedies.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="accordion" id="homeFaqAccordion">
                <!-- FAQ 1 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq1" aria-expanded="true">
                            1. How do I know the gemstone I receive is 100% natural and unheated?
                        </button>
                    </h2>
                    <div id="cHomeFaq1" class="accordion-collapse collapse show" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            Every single ratna dispatched by {{ setting('site_name', 'AstroStore') }} is accompanied by an independent government-accredited Gemological Laboratory Certificate. The report contains a high-resolution color photograph of your exact stone, its refractive index, specific gravity, microscopic natural inclusion patterns, and explicitly certifies that the stone is <strong>100% Natural, Unheated and Untreated</strong>.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq2">
                            2. What is "Prana Pratishtha Consecration" and why is it mandatory?
                        </button>
                    </h2>
                    <div id="cHomeFaq2" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            In Vedic Jyotish, a gemstone directly extracted from the earth is dormant. Prana Pratishtha is the sacred ritual of invoking celestial life energy into the stone. Our Acharyas in Varanasi place the gemstone on a consecrated Yantra and recite 108 planetary Beej Mantras during an auspicious hora, attuning its vibration to your birth chart.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq3">
                            3. Can anyone wear Rudraksha regardless of zodiac sign, gender, or diet?
                        </button>
                    </h2>
                    <div id="cHomeFaq3" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            Yes, absolutely. The ancient scriptures like <em>Shiva Purana</em> and <em>Padma Purana</em> declare that Rudraksha beads are universal divine blessings from Lord Shiva for all humanity. Unlike gemstones which require precise planetary alignment, genuine Rudraksha has <strong>zero negative side effects</strong> and can be worn by anyone seeking peace and protection.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq4">
                            4. What if I do not know my exact birth time for Kundli Consultation?
                        </button>
                    </h2>
                    <div id="cHomeFaq4" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            If your exact birth time is not known, our senior scholars use two classical Vedic techniques: <strong>Prashna Kundli (Horary Astrology)</strong> and <strong>Hasta Rekha Shastra (Palmistry)</strong>. By examining clear photographs of your palms along with the exact time you ask your question, highly accurate life readings and remedies are provided.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq5">
                            5. How long does delivery take and how is the gemstone shipped?
                        </button>
                    </h2>
                    <div id="cHomeFaq5" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            Consecration rituals take 24–48 hours to complete during auspicious muhurat timings. Once energized, your parcel is packed in a tamper-proof insured box and dispatched via express courier (BlueDart/Delhivery). Delivery takes 3–5 working days anywhere in India.
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="accordion-item shadow-sm">
                    <h2 class="accordion-header" id="hFaqSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cHomeFaq6">
                            6. What is the return and money-back authenticity policy?
                        </button>
                    </h2>
                    <div id="cHomeFaq6" class="accordion-collapse collapse" data-bs-parent="#homeFaqAccordion">
                        <div class="accordion-body">
                            We offer a <strong>100% Lifetime Money-Back Guarantee</strong> on the authenticity of our gemstones. If any government-recognized lab certifies that our natural stone is synthetic or heat-treated, we provide a full refund no questions asked. Additionally, we provide a 7-day return window for transit damage.
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('faq') }}" class="btn btn-cosmic-outline me-2">
                    View All FAQs
                </a>
                <a href="{{ route('contact') }}" class="btn btn-cosmic-gold">
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="container mb-5">
    <div class="text-center mb-5" data-aos="fade-up">
        <span class="badge badge-gold mb-2">TESTIMONIALS</span>
        <h2 class="display-6 fw-bold">Words of Gratitude</h2>
        <p class="text-muted" style="max-width: 600px; margin: 0 auto;">Read how our certified remedies and astrological guidance have touched lives across India.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="cosmic-card p-4 h-100">
                <div class="mb-3 text-warning">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="small fst-italic mb-3" style="line-height: 1.8; color: var(--text-body);">
                    "The Ceylon Yellow Sapphire (Pukhraj) I received has brought tremendous mental clarity and career advancement within 45 days. The Govt lab certificate gave me 100% confidence."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--border-color);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--accent);">RK</div>
                    <div>
                        <h6 class="mb-0" style="font-weight: 600;">Rajesh K.</h6>
                        <small class="text-muted">Bengaluru, Karnataka</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="cosmic-card p-4 h-100">
                <div class="mb-3 text-warning">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="small fst-italic mb-3" style="line-height: 1.8; color: var(--text-body);">
                    "Purchased a 7 Mukhi Nepal Rudraksha. The vibration was tangible from day one. Shipped safely on time with Ganga Jal, sacred vibhuti and complete wearing muhurat guide."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--border-color);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: #b45309;">PS</div>
                    <div>
                        <h6 class="mb-0" style="font-weight: 600;">Priya Sharma</h6>
                        <small class="text-muted">New Delhi</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="cosmic-card p-4 h-100">
                <div class="mb-3 text-warning">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p class="small fst-italic mb-3" style="line-height: 1.8; color: var(--text-body);">
                    "The personalized Kundli report was eye-opening. Every Dasha prediction aligned with past milestones. Acharya ji's recommended remedies were practical and spiritually uplifting."
                </p>
                <div class="d-flex align-items-center gap-3 pt-3" style="border-top: 1px solid var(--border-color);">
                    <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background: var(--accent);">VM</div>
                    <div>
                        <h6 class="mb-0" style="font-weight: 600;">Vikram Malhotra</h6>
                        <small class="text-muted">Pune, Maharashtra</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CALL TO ACTION BANNER -->
<section class="container mb-5" data-aos="fade-up">
    <div class="p-5 text-center rounded-3 shadow-sm" style="background: var(--bg-soft-gray); border: 1px solid var(--border-color);">
        <span class="badge badge-gold mb-3"><i class="fa-solid fa-om me-1"></i> START YOUR SPIRITUAL JOURNEY</span>
        <h2 class="display-6 fw-bold mb-3">Discover the Power of Genuine Vedic Remedies</h2>
        <p class="text-muted fs-5 mb-4" style="max-width: 600px; margin: 0 auto;">Explore lab-certified natural gemstones, original Nepal Rudraksha, energized Yantras, or book your personalized Kundli consultation today.</p>
        <div class="d-flex justify-content-center flex-wrap gap-3">
            <a href="{{ route('shop') }}" class="btn btn-cosmic-gold btn-lg">
                Visit Store <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
            <a href="{{ route('contact') }}" class="btn btn-cosmic-outline btn-lg">
                Contact Our Astrologers
            </a>
        </div>
    </div>
</section>
@endsection
