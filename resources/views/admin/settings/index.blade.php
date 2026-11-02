@extends('layouts.admin')

@section('title', 'Cosmic Store Settings')
@section('page_title', 'Configuration & Celestial Settings')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="cosmic-card p-4 p-md-5">
            <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <i class="bi bi-sliders me-2"></i>Store Configurations
            </h4>

            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Settings Tabs -->
                <ul class="nav nav-pills mb-4 pb-2 border-bottom" style="border-color: var(--cosmic-card-border) !important;" id="settingsTabs" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active text-light fw-bold" id="gen-tab" data-bs-toggle="pill" data-bs-target="#gen-pane" type="button" role="tab">
                            <i class="bi bi-gear-fill me-1"></i> General
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-light fw-bold" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact-pane" type="button" role="tab">
                            <i class="bi bi-telephone-fill me-1"></i> Contact
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-light fw-bold" id="shipping-tab" data-bs-toggle="pill" data-bs-target="#shipping-pane" type="button" role="tab">
                            <i class="bi bi-truck me-1"></i> Shipping & Taxes
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-light fw-bold" id="payment-tab" data-bs-toggle="pill" data-bs-target="#payment-pane" type="button" role="tab">
                            <i class="bi bi-credit-card-2-front-fill me-1"></i> Payment Gateways
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-light fw-bold" id="social-tab" data-bs-toggle="pill" data-bs-target="#social-pane" type="button" role="tab">
                            <i class="bi bi-share-fill me-1"></i> Social Media
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link text-light fw-bold" id="seo-tab" data-bs-toggle="pill" data-bs-target="#seo-pane" type="button" role="tab">
                            <i class="bi bi-search me-1"></i> SEO
                        </button>
                    </li>
                </ul>

                <div class="tab-content mb-4" id="settingsTabsContent">
                    <!-- Tab 1: General -->
                    <div class="tab-pane fade show active" id="gen-pane" role="tabpanel">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Store Name</label>
                                <input type="text" name="site_name" class="form-control cosmic-input" value="{{ $settings['site_name'] ?? 'AstroStore' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Tagline</label>
                                <input type="text" name="site_tagline" class="form-control cosmic-input" value="{{ $settings['site_tagline'] ?? '' }}" placeholder="Sacred Vedic Astrological Sanctuary">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Store Logo</label>
                                @if(!empty($settings['logo']))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['logo']) }}" class="rounded border border-warning" style="max-height: 50px;" alt="logo">
                                    </div>
                                @endif
                                <input type="file" name="logo" class="form-control cosmic-input" accept="image/*">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Favicon</label>
                                @if(!empty($settings['favicon']))
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $settings['favicon']) }}" class="rounded" style="width: 32px; height: 32px;" alt="favicon">
                                    </div>
                                @endif
                                <input type="file" name="favicon" class="form-control cosmic-input" accept="image/*">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Contact -->
                    <div class="tab-pane fade" id="contact-pane" role="tabpanel">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Support Email</label>
                                <input type="email" name="email" class="form-control cosmic-input" value="{{ $settings['email'] ?? 'blessings@astrostore.com' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Helpline Phone</label>
                                <input type="text" name="phone" class="form-control cosmic-input" value="{{ $settings['phone'] ?? '+91 98765 43210' }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-gold small">Temple Kendra Address</label>
                            <textarea name="address" class="form-control cosmic-input" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Tab 3: Shipping & Taxes -->
                    <div class="tab-pane fade" id="shipping-pane" role="tabpanel">
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label text-gold small">Standard Shipping Fee (₹)</label>
                                <input type="number" step="0.01" name="shipping_charge" class="form-control cosmic-input" value="{{ $settings['shipping_charge'] ?? 70 }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-gold small">Free Shipping Above Threshold (₹)</label>
                                <input type="number" step="0.01" name="free_shipping_above" class="form-control cosmic-input" value="{{ $settings['free_shipping_above'] ?? 999 }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-gold small">Tax Percent (%)</label>
                                <input type="number" step="0.01" name="tax_percent" class="form-control cosmic-input" value="{{ $settings['tax_percent'] ?? 3 }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 4: Payment Gateways -->
                    <div class="tab-pane fade" id="payment-pane" role="tabpanel">
                        <div class="alert alert-warning text-dark mb-4 small">
                            <i class="bi bi-shield-lock-fill me-1"></i> These credentials connect your checkout directly to Razorpay's live/sandbox transaction processor.
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Razorpay Key ID</label>
                                <input type="text" name="razorpay_key_id" class="form-control cosmic-input" value="{{ $settings['razorpay_key_id'] ?? '' }}" placeholder="rzp_test_xxxx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Razorpay Key Secret</label>
                                <input type="password" name="razorpay_key_secret" class="form-control cosmic-input" value="{{ $settings['razorpay_key_secret'] ?? '' }}" placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 5: Social Media -->
                    <div class="tab-pane fade" id="social-pane" role="tabpanel">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Facebook Page URL</label>
                                <input type="url" name="facebook_url" class="form-control cosmic-input" value="{{ $settings['facebook_url'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">Instagram Profile URL</label>
                                <input type="url" name="instagram_url" class="form-control cosmic-input" value="{{ $settings['instagram_url'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">YouTube Channel URL</label>
                                <input type="url" name="youtube_url" class="form-control cosmic-input" value="{{ $settings['youtube_url'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-gold small">WhatsApp Support Number (With Country Code)</label>
                                <input type="text" name="whatsapp_number" class="form-control cosmic-input" value="{{ $settings['whatsapp_number'] ?? '+919876543210' }}">
                            </div>
                        </div>
                    </div>

                    <!-- Tab 6: SEO -->
                    <div class="tab-pane fade" id="seo-pane" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label text-gold small">Default Meta Title</label>
                            <input type="text" name="meta_title" class="form-control cosmic-input" value="{{ $settings['meta_title'] ?? '' }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-gold small">Default Meta Description</label>
                            <textarea name="meta_description" class="form-control cosmic-input" rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-cosmic-gold px-4 py-2">
                    <i class="bi bi-check-circle me-1"></i> Save All Configurations
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
