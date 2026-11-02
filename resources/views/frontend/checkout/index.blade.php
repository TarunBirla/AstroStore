@extends('layouts.app')

@section('title', 'Divine Checkout | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">Sacred Cart</a></li>
            <li class="breadcrumb-item active" aria-current="page">Divine Checkout</li>
        </ol>
    </nav>

    <div class="mb-4">
        <h2 class="cinzel-font text-gold display-6 mb-1"><i class="bi bi-shield-check me-2"></i>Divine Checkout</h2>
        <p class="text-muted-cosmic mb-0">Provide your consecrated shipping destination and select preferred payment channel</p>
    </div>

    <form action="{{ route('checkout.placeOrder') }}" method="POST" id="checkoutForm">
        @csrf

        <div class="row g-4">
            <!-- Left: Shipping Address & Details -->
            <div class="col-lg-7">
                <div class="cosmic-card p-4 p-md-5 mb-4">
                    <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                        <i class="bi bi-geo-alt-fill me-2"></i>Delivery Sanctuary Destination
                    </h4>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-gold small">Recipient Devotee Name <span class="text-danger">*</span></label>
                            <input type="text" name="shipping_name" class="form-control cosmic-input @error('shipping_name') is-invalid @enderror" value="{{ old('shipping_name', $user->name) }}" required placeholder="e.g. Aarav Sharma">
                            @error('shipping_name') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-gold small">Contact WhatsApp / Mobile <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control cosmic-input @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required placeholder="+91 9876543210">
                            @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-gold small">Complete Street Address (House / Flat / Temple Landmark) <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control cosmic-input @error('address') is-invalid @enderror" rows="3" required placeholder="Flat 402, Shanti Heights, Near Mandir Marg...">{{ old('address', $user->address) }}</textarea>
                        @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-gold small">City <span class="text-danger">*</span></label>
                            <input type="text" name="city" class="form-control cosmic-input @error('city') is-invalid @enderror" value="{{ old('city', $user->city) }}" required placeholder="Mumbai">
                            @error('city') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-gold small">State <span class="text-danger">*</span></label>
                            <input type="text" name="state" class="form-control cosmic-input @error('state') is-invalid @enderror" value="{{ old('state', $user->state) }}" required placeholder="Maharashtra">
                            @error('state') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-gold small">Postal PIN Code <span class="text-danger">*</span></label>
                            <input type="text" name="pincode" class="form-control cosmic-input @error('pincode') is-invalid @enderror" value="{{ old('pincode', $user->pincode) }}" required placeholder="400064">
                            @error('pincode') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="save_address" value="1" id="saveAddress" checked style="background-color: #150824; border-color: var(--cosmic-accent-gold);">
                        <label class="form-check-label text-muted-cosmic small" for="saveAddress">
                            Save this address to my Devotee Profile for future orders
                        </label>
                    </div>

                    <div class="mb-2">
                        <label class="form-label text-gold small">Special Astrological Instructions / Gotra Details (Optional)</label>
                        <textarea name="notes" class="form-control cosmic-input" rows="2" placeholder="Mention Gotra, Nakshatra, or specific energization requests for our Acharyas...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div class="cosmic-card p-4 p-md-5 mb-4">
                    <h4 class="cinzel-font text-gold mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                        <i class="bi bi-credit-card-2-front me-2"></i>Select Payment Channel
                    </h4>

                    <div class="d-flex flex-column gap-3">
                        <!-- Razorpay -->
                        <div class="p-3 rounded-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <div>
                                    <input class="form-check-input" type="radio" name="payment_method" id="payRazorpay" value="razorpay" checked style="border-color: var(--cosmic-accent-gold);">
                                    <label class="form-check-label text-light fw-bold ms-2" for="payRazorpay">
                                        Online Cards / NetBanking / Razorpay
                                    </label>
                                    <small class="d-block text-muted-cosmic ms-2 mt-1">Instant confirmation, debit/credit cards, and digital banking</small>
                                </div>
                                <span class="badge badge-gold">FAST & SECURE</span>
                            </div>
                        </div>

                        <!-- Direct UPI -->
                        <div class="p-3 rounded-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <div>
                                    <input class="form-check-input" type="radio" name="payment_method" id="payUPI" value="upi" style="border-color: var(--cosmic-accent-gold);">
                                    <label class="form-check-label text-light fw-bold ms-2" for="payUPI">
                                        Google Pay / PhonePe / Paytm / BHIM UPI
                                    </label>
                                    <small class="d-block text-muted-cosmic ms-2 mt-1">Seamless 1-click mobile UPI transfer</small>
                                </div>
                                <i class="bi bi-qr-code text-saffron fs-4"></i>
                            </div>
                        </div>

                        <!-- COD -->
                        <div class="p-3 rounded-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                            <div class="form-check d-flex align-items-center justify-content-between">
                                <div>
                                    <input class="form-check-input" type="radio" name="payment_method" id="payCOD" value="cod" style="border-color: var(--cosmic-accent-gold);">
                                    <label class="form-check-label text-light fw-bold ms-2" for="payCOD">
                                        Cash on Delivery (COD)
                                    </label>
                                    <small class="d-block text-muted-cosmic ms-2 mt-1">Pay with cash when courier delivers the blessed package</small>
                                </div>
                                <i class="bi bi-cash text-gold fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Order Summary Sidebar -->
            <div class="col-lg-5">
                <div class="cosmic-card p-4 sticky-top" style="top: 90px;">
                    <h4 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                        Consecrated Order Review
                    </h4>

                    <!-- Items Quick List -->
                    <div class="d-flex flex-column gap-2 mb-3" style="max-height: 240px; overflow-y: auto;">
                        @foreach($cartItems as $c)
                            <div class="d-flex justify-content-between align-items-center py-2" style="border-bottom: 1px dashed rgba(212,175,55,0.15);">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge badge-cosmic">{{ $c->qty }}x</span>
                                    <span class="text-light small text-truncate" style="max-width: 200px;">{{ $c->product->name }}</span>
                                </div>
                                <span class="text-gold small fw-bold">₹{{ number_format($c->product->active_price * $c->qty, 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Breakdown -->
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted-cosmic">Subtotal:</span>
                        <span class="text-light fw-bold">₹{{ number_format($subtotal, 2) }}</span>
                    </div>

                    @if($discount > 0)
                        <div class="d-flex justify-content-between mb-2 small text-saffron">
                            <span>Coupon Discount ({{ $couponData['code'] }}):</span>
                            <span class="fw-bold">-₹{{ number_format($discount, 2) }}</span>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted-cosmic">Vedic Shipping:</span>
                        @if($shipping == 0)
                            <span class="text-success fw-bold">FREE</span>
                        @else
                            <span class="text-light fw-bold">₹{{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mb-3 small">
                        <span class="text-muted-cosmic">Vedic Taxes ({{ setting('tax_percent', 3) }}%):</span>
                        <span class="text-light fw-bold">₹{{ number_format($tax, 2) }}</span>
                    </div>

                    <hr style="border-color: rgba(212,175,55,0.25);" class="my-3">

                    <div class="d-flex justify-content-between mb-4">
                        <span class="cinzel-font text-gold fs-5 fw-bold">Total Due:</span>
                        <span class="cinzel-font text-gold fs-4 fw-bold">₹{{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn btn-cosmic-gold w-100 py-3 fs-6 d-flex align-items-center justify-content-center gap-2" id="placeOrderBtn">
                        <i class="bi bi-lock-fill"></i>
                        <span>Place Consecrated Order</span>
                    </button>

                    <div class="text-center text-muted-cosmic small mt-3">
                        <i class="bi bi-shield-lock-fill text-gold me-1"></i> 256-Bit SSL Encrypted & Protected
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Razorpay Script CDN -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.getElementById('checkoutForm').addEventListener('submit', function (e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;
        const submitBtn = document.getElementById('placeOrderBtn');

        if (paymentMethod === 'razorpay') {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Preparing Sacred Payment...';

            const formData = new FormData(this);
            fetch("{{ route('checkout.placeOrder') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'initiate_razorpay') {
                    const options = {
                        "key": data.key,
                        "amount": data.amount,
                        "currency": data.currency,
                        "name": data.name,
                        "description": data.description,
                        "prefill": data.prefill,
                        "theme": { "color": "#1a0b2e" },
                        "handler": function (response) {
                            // Append payment ID and submit
                            const form = document.getElementById('checkoutForm');
                            const hiddenInput = document.createElement('input');
                            hiddenInput.type = 'hidden';
                            hiddenInput.name = 'razorpay_payment_id';
                            hiddenInput.value = response.razorpay_payment_id;
                            form.appendChild(hiddenInput);
                            form.submit();
                        },
                        "modal": {
                            "ondismiss": function() {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = '<i class="bi bi-lock-fill"></i> <span>Place Consecrated Order</span>';
                            }
                        }
                    };
                    const rzp = new Razorpay(options);
                    rzp.open();
                } else {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="bi bi-lock-fill"></i> <span>Place Consecrated Order</span>';
                }
            })
            .catch(err => {
                console.error(err);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="bi bi-lock-fill"></i> <span>Place Consecrated Order</span>';
                Swal.fire({
                    title: 'Notice',
                    text: 'Proceeding with standard checkout authorization.',
                    icon: 'info',
                    background: '#1a0b2e',
                    color: '#f5f0e6'
                }).then(() => {
                    document.getElementById('checkoutForm').submit();
                });
            });
        }
    });
</script>
@endsection
