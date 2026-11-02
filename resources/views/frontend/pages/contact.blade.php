@extends('layouts.app')

@section('title', 'Connect with Revered Acharyas | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down">
        <span class="badge badge-gold mb-2"><i class="fa-solid fa-headset me-1"></i> DEVOTEE SUPPORT</span>
        <h1 class="display-5 fw-bold mb-2">Connect with Our Sacred Ashram</h1>
        <p class="text-muted mb-0" style="max-width: 650px; margin: 0 auto;">Seek personal guidance on gemstone recommendations, planetary puja, or your order dispatch.</p>
    </div>

    <div class="row g-5">
        <!-- Contact Form -->
        <div class="col-lg-7" data-aos="fade-right">
            <div class="cosmic-card p-4 p-md-5">
                <h3 class="fw-bold mb-4">Send a Sacred Query</h3>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control cosmic-input" placeholder="e.g. Ramesh Sharma" required value="{{ old('name') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control cosmic-input" placeholder="ramesh@example.com" required value="{{ old('email') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number (WhatsApp)</label>
                            <input type="text" name="phone" class="form-control cosmic-input" placeholder="+91 9876543210" value="{{ old('phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Query Subject *</label>
                            <select name="subject" class="form-select cosmic-input" required>
                                <option value="Gemstone Recommendation">Gemstone Recommendation</option>
                                <option value="Kundli / Consultation Doubt">Kundli / Consultation Doubt</option>
                                <option value="Order Tracking & Consecration">Order Tracking & Consecration</option>
                                <option value="Rudraksha Authenticity Query">Rudraksha Authenticity Query</option>
                                <option value="General Inquiry">General Inquiry</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Your Message or Birth Details *</label>
                            <textarea name="message" rows="5" class="form-control cosmic-input" placeholder="Mention your query or DOB, Time and Place of birth for gemstone guidance..." required>{{ old('message') }}</textarea>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-cosmic-gold btn-lg w-100">
                                Submit Query to Acharya <i class="fa-solid fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Ashram Contact Details -->
        <div class="col-lg-5" data-aos="fade-left">
            <div class="cosmic-card p-4 p-md-5 h-100 d-flex flex-column justify-content-between">
                <div>
                    <h4 class="fw-bold mb-4">Vedic Ashram Details</h4>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fs-5 flex-shrink-0" style="width: 44px; height: 44px; background: var(--accent-light); color: var(--accent);">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Sacred Head Office & Mandir</h6>
                            <p class="text-muted small mb-0">{{ setting('office_address', 'Dashashwamedh Ghat Road, Sacred Kashi (Varanasi), UP 221001') }}</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fs-5 flex-shrink-0" style="width: 44px; height: 44px; background: var(--accent-light); color: var(--accent);">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Direct Astrologer Helpline</h6>
                            <p class="text-muted small mb-0">{{ setting('support_phone', '+91 98765 43210') }} (10:00 AM – 7:00 PM IST)</p>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="rounded-circle d-flex align-items-center justify-content-center fs-5 flex-shrink-0" style="width: 44px; height: 44px; background: var(--accent-light); color: var(--accent);">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold">Celestial Support Email</h6>
                            <p class="text-muted small mb-0">{{ setting('support_email', 'acharyaji@astrostore.com') }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-3 rounded-3 bg-white border mt-4">
                    <h6 class="fw-bold mb-1" style="color: var(--accent);"><i class="fa-solid fa-comments me-2"></i>Instant WhatsApp Guidance</h6>
                    <small class="text-muted d-block mb-2">Speak directly with our Vedic pandits on WhatsApp.</small>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number', '919876543210')) }}" class="btn btn-outline-success btn-sm w-100" target="_blank">
                        <i class="fa-brands fa-whatsapp me-1"></i> Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
