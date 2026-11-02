<footer class="cosmic-footer pt-5 pb-4">
    <div class="container">
        <div class="row g-4 mb-4">
            <!-- Col 1: Brand & Bio -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center text-white" style="width: 34px; height: 34px; background: var(--accent);">
                        <i class="fa-solid fa-om fs-6"></i>
                    </div>
                    <span class="fs-4 fw-bold" style="color: var(--text-heading); letter-spacing: -0.02em;">
                        ASTRO<span style="color: var(--accent);">STORE</span>
                    </span>
                </div>
                <p class="text-muted" style="font-size: 0.92rem; line-height: 1.7;">
                    Your sacred celestial sanctuary for 100% authentic, energised gemstones, blessed certified Rudraksha, sacred yantras, pooja essentials, and personalized Vedic consultations by revered astrologers.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="{{ setting('facebook_url', '#') }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" target="_blank"><i class="bi bi-facebook"></i></a>
                    <a href="{{ setting('instagram_url', '#') }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" target="_blank"><i class="bi bi-instagram"></i></a>
                    <a href="{{ setting('youtube_url', '#') }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" target="_blank"><i class="bi bi-youtube"></i></a>
                    <a href="{{ setting('whatsapp_number', '#') }}" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" target="_blank"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-title">Sacred Links</h5>
                <ul class="list-unstyled d-flex flex-column gap-2" style="font-size: 0.9rem;">
                    <li><a href="{{ route('shop') }}">Vedic Store</a></li>
                    <li><a href="{{ route('blogs') }}">Astrology Insights</a></li>
                    <li><a href="{{ route('about') }}">About Our Acharyas</a></li>
                    <li><a href="{{ route('contact') }}">Contact & Support</a></li>
                    <li><a href="{{ route('faq') }}">Vedic FAQs</a></li>
                </ul>
            </div>

            <!-- Col 3: Customer Care & Policies -->
            <div class="col-lg-3 col-md-6 col-6">
                <h5 class="footer-title">Divine Trust</h5>
                <ul class="list-unstyled d-flex flex-column gap-2" style="font-size: 0.9rem;">
                    <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('refund.policy') }}">Refund & Return Policy</a></li>
                    <li><a href="{{ route('user.orders') }}">Track Vedic Order</a></li>
                    <li><a href="{{ route('contact') }}">Certifications & Lab Reports</a></li>
                </ul>
            </div>

            <!-- Col 4: Newsletter -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-title">Cosmic Newsletter</h5>
                <p class="text-muted" style="font-size: 0.88rem;">
                    Receive auspicious muhurat alerts, planetary transit insights & exclusive astrological offers.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Your email..." required>
                        <button class="btn btn-cosmic-gold" type="submit">Join</button>
                    </div>
                </form>
                <div class="mt-3 text-muted" style="font-size: 0.82rem;">
                    <i class="fa-solid fa-certificate text-primary me-1"></i> 100% Vedic Lab Certified Products
                </div>
            </div>
        </div>

        <hr style="border-color: var(--border-color);">

        <div class="row align-items-center py-2" style="font-size: 0.85rem;">
            <div class="col-md-6 text-center text-md-start text-muted">
                © {{ date('Y') }} <span class="fw-semibold" style="color: var(--text-heading);">{{ setting('site_name', 'AstroStore') }}</span>. All Rights Reserved.
            </div>
            <div class="col-md-6 text-center text-md-end text-muted mt-2 mt-md-0">
                <span>Secure Payments: <i class="fa-solid fa-credit-card ms-1 text-primary"></i> UPI / Cards / NetBanking / COD</span>
            </div>
        </div>
    </div>
</footer>
