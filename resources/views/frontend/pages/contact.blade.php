@extends('layouts.app')

@section('title', 'Contact Our Sacred Kendra | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down" style="background: radial-gradient(circle at center, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.95) 100%);">
        <span class="badge badge-gold mb-2">✦ WE ARE HERE TO SERVE ✦</span>
        <h1 class="cinzel-font text-gold display-5 fw-bold mb-2">Reach Out to Our Acharyas</h1>
        <p class="text-muted-cosmic mb-0">Have queries about gemstone suitability, Rudraksha mukhi selection or order dispatch? Write to us.</p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Contact Info Cards -->
        <div class="col-lg-4" data-aos="fade-right">
            <div class="cosmic-card p-4 mb-4">
                <h5 class="cinzel-font text-gold mb-4"><i class="bi bi-geo-alt-fill me-2"></i>Temple Kendra</h5>
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fs-4" style="width: 44px; height: 44px; background: rgba(212,175,55,0.15); flex-shrink: 0;">
                        <i class="bi bi-pin-map"></i>
                    </div>
                    <div>
                        <strong class="text-light d-block mb-1">Sacred Address:</strong>
                        <span class="text-muted-cosmic small">{{ setting('address', '108 Cosmic Enclave, Mandir Road, Varanasi, UP - 221001') }}</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-saffron fs-4" style="width: 44px; height: 44px; background: rgba(255,153,51,0.15); flex-shrink: 0;">
                        <i class="bi bi-telephone-inbound"></i>
                    </div>
                    <div>
                        <strong class="text-light d-block mb-1">Direct Helplines:</strong>
                        <span class="text-muted-cosmic small">{{ setting('phone', '+91 98765 43210') }}</span><br>
                        <span class="text-muted-cosmic small">Mon - Sat: 9:00 AM - 7:00 PM IST</span>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fs-4" style="width: 44px; height: 44px; background: rgba(212,175,55,0.15); flex-shrink: 0;">
                        <i class="bi bi-envelope-at"></i>
                    </div>
                    <div>
                        <strong class="text-light d-block mb-1">Celestial Email:</strong>
                        <span class="text-muted-cosmic small">{{ setting('email', 'blessings@astrostore.com') }}</span>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Direct Card -->
            <div class="cosmic-card p-4 text-center" style="background: rgba(34, 197, 94, 0.1); border-color: rgba(34, 197, 94, 0.4);">
                <i class="bi bi-whatsapp text-success display-4 mb-2 d-block"></i>
                <h5 class="cinzel-font text-gold mb-1">Instant WhatsApp Support</h5>
                <p class="text-muted-cosmic small mb-3">Chat directly with our gemstone consultation desk</p>
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('whatsapp_number', '919876543210')) }}" target="_blank" class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-chat-dots-fill me-2"></i> Start WhatsApp Chat
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-lg-8" data-aos="fade-left">
            <div class="cosmic-card p-4 p-md-5">
                <h4 class="cinzel-font text-gold mb-3"><i class="bi bi-envelope-paper-heart-fill me-2"></i>Send Sacred Message</h4>
                <p class="text-muted-cosmic small mb-4">Please fill in your particulars. Our Vedic Acharyas review every inquiry with utmost devotion.</p>

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Your Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control cosmic-input @error('name') is-invalid @enderror" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" required placeholder="e.g. Ramesh Chandra">
                            @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control cosmic-input @error('email') is-invalid @enderror" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required placeholder="ramesh@email.com">
                            @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">WhatsApp / Mobile Number</label>
                            <input type="text" name="phone" class="form-control cosmic-input @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->check() ? auth()->user()->phone : '') }}" placeholder="+91 9876543210">
                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Subject of Inquiry</label>
                            <input type="text" name="subject" class="form-control cosmic-input @error('subject') is-invalid @enderror" value="{{ old('subject') }}" placeholder="e.g. Gemstone recommendation query">
                            @error('subject') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-gold small">Your Message / Birth Chart Details <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control cosmic-input @error('message') is-invalid @enderror" rows="5" placeholder="Share your birth date, time, city of birth or questions regarding products..." required>{{ old('message') }}</textarea>
                        @error('message') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                        <i class="bi bi-send-fill me-2"></i> Transmit Sacred Query
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
