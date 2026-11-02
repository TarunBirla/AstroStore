@extends('layouts.app')

@section('title', 'Frequently Asked Vedic Questions | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Vedic FAQs</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down" style="background: radial-gradient(circle at center, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.95) 100%);">
        <span class="badge badge-gold mb-2">✦ KNOWLEDGE BASE ✦</span>
        <h1 class="cinzel-font text-gold display-5 fw-bold mb-2">Frequently Asked Questions</h1>
        <p class="text-muted-cosmic mb-0">Answers to common astrological doubts regarding gemstone testing, energizing, Rudraksha wearing, and consultations.</p>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="accordion cosmic-card p-3" id="astroFaqAccordion">
                <!-- Q1 -->
                <div class="accordion-item mb-3 rounded overflow-hidden" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed cinzel-font text-gold" style="background: rgba(26, 11, 46, 0.9); box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                            1. How do I know the gemstone I receive is 100% natural and unheated?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#astroFaqAccordion">
                        <div class="accordion-body text-light small" style="line-height: 1.8;">
                            Every single ratna dispatched by AstroStore is sent alongside an official government-accredited Gemological Laboratory Certificate. The report contains a high-resolution photograph of your exact stone, its refractive index, specific gravity, microscopic natural inclusion patterns, and explicitly certifies that the stone is <strong>100% Natural, Unheated and Untreated</strong>.
                        </div>
                    </div>
                </div>

                <!-- Q2 -->
                <div class="accordion-item mb-3 rounded overflow-hidden" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed cinzel-font text-gold" style="background: rgba(26, 11, 46, 0.9); box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                            2. What does "Prana Pratishtha Consecration" mean?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#astroFaqAccordion">
                        <div class="accordion-body text-light small" style="line-height: 1.8;">
                            Prana Pratishtha is the sacred Vedic ritual of invoking celestial life energy into an inanimate object. Our Acharyas in Varanasi wash your ordered gem or rudraksha in Panchamrit and Gangajal, place it upon a consecrated yantra, and recite 108 Beej Mantras accompanied by sacred fire oblation (Hawan) to activate its subtle electromagnetic vibration.
                        </div>
                    </div>
                </div>

                <!-- Q3 -->
                <div class="accordion-item mb-3 rounded overflow-hidden" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed cinzel-font text-gold" style="background: rgba(26, 11, 46, 0.9); box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                            3. Can anyone wear Rudraksha regardless of gender, diet, or zodiac sign?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#astroFaqAccordion">
                        <div class="accordion-body text-light small" style="line-height: 1.8;">
                            Yes. The Shiva Purana expressly declares that Rudraksha beads are universal blessings from Lord Shiva for all humanity. There are zero malefic or negative side-effects of wearing genuine Rudraksha beads. You may wear them during daily routine activities with love and reverence.
                        </div>
                    </div>
                </div>

                <!-- Q4 -->
                <div class="accordion-item mb-3 rounded overflow-hidden" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed cinzel-font text-gold" style="background: rgba(26, 11, 46, 0.9); box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                            4. What if I do not know my exact birth time for Kundli Consultation?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#astroFaqAccordion">
                        <div class="accordion-body text-light small" style="line-height: 1.8;">
                            If your exact birth time is uncertain, our senior scholars perform Prashna Kundli (Horary Astrology) or evaluate your palm photographs through Hasta Rekha Shastra to provide accurate astrological insights and remedies.
                        </div>
                    </div>
                </div>

                <!-- Q5 -->
                <div class="accordion-item rounded overflow-hidden" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed cinzel-font text-gold" style="background: rgba(26, 11, 46, 0.9); box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                            5. What is the return or replacement policy?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#astroFaqAccordion">
                        <div class="accordion-body text-light small" style="line-height: 1.8;">
                            We offer a 7-day hassle-free replacement guarantee if an item arrives damaged or does not match specifications. Furthermore, every gemstone carries a 100% lifetime authenticity guarantee against synthetic substitutes.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
