<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacred Invoice #{{ $order->order_number }} | {{ setting('site_name', 'AstroStore') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
            padding: 30px;
        }
        .invoice-box {
            max-width: 850px;
            margin: 0 auto;
            background: #ffffff;
            border: 2px solid #d4af37;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
        }
        .cinzel-font {
            font-family: 'Cinzel', serif;
        }
        .seal-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.04;
            font-size: 20rem;
            pointer-events: none;
        }
        @media print {
            body { background: #fff; padding: 0; }
            .invoice-box { box-shadow: none; border: 1px solid #d4af37; padding: 20px; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="seal-watermark">🕉️</div>

    <!-- Header Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4 no-print pb-3 border-bottom">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Return Back
        </a>
        <button onclick="window.print()" class="btn btn-warning text-dark btn-sm fw-bold">
            <i class="bi bi-printer me-1"></i> Print / Save as PDF
        </button>
    </div>

    <!-- Invoice Header -->
    <div class="row align-items-center mb-4">
        <div class="col-sm-6">
            <div class="d-flex align-items-center gap-2">
                <span style="font-size: 2.2rem;">✨</span>
                <div>
                    <h2 class="cinzel-font mb-0 text-dark fw-bold">{{ setting('site_name', 'ASTROSTORE') }}</h2>
                    <small class="text-muted">Vedic Astrological Sanctuary & Kendra</small>
                </div>
            </div>
            <div class="mt-2 text-muted small" style="line-height: 1.5;">
                {{ setting('address', '108 Cosmic Enclave, Mandir Road, Varanasi, UP - 221001') }}<br>
                Email: {{ setting('email', 'blessings@astrostore.com') }} | Ph: {{ setting('phone', '+91 98765 43210') }}
            </div>
        </div>

        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <h3 class="cinzel-font text-warning mb-1">TAX INVOICE</h3>
            <div class="small"><strong>Invoice No:</strong> INV-{{ $order->id }}-{{ date('Y') }}</div>
            <div class="small"><strong>Order Number:</strong> {{ $order->order_number }}</div>
            <div class="small"><strong>Date of Booking:</strong> {{ $order->created_at->format('d/m/Y') }}</div>
            <div class="small"><strong>Payment Status:</strong> <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : 'warning text-dark' }}">{{ ucfirst($order->payment_status) }}</span></div>
        </div>
    </div>

    <hr style="border-color: #d4af37;" class="my-4">

    <!-- Billed To -->
    <div class="row mb-4">
        <div class="col-sm-6">
            <h6 class="cinzel-font text-warning fw-bold mb-2">DEVOTEE RECIPIENT:</h6>
            <div class="fw-bold">{{ $order->shipping_name }}</div>
            <div class="text-muted small">{{ $order->address }}</div>
            <div class="text-muted small">{{ $order->city }}, {{ $order->state }} - {{ $order->pincode }}</div>
            <div class="text-muted small">Phone: {{ $order->phone }}</div>
            <div class="text-muted small">Devotee ID: #USR-{{ $order->user_id }}</div>
        </div>

        <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">
            <h6 class="cinzel-font text-warning fw-bold mb-2">PAYMENT DISPATCH:</h6>
            <div class="small"><strong>Method:</strong> {{ strtoupper($order->payment->method ?? 'COD') }}</div>
            <div class="small"><strong>Transaction ID:</strong> {{ $order->payment->transaction_id ?? 'N/A' }}</div>
            <div class="small"><strong>Fulfillment:</strong> Insured Vedic Postal Express</div>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">#</th>
                    <th>Sanctified Vedic Item</th>
                    <th style="width: 15%;" class="text-end">Unit Price</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 15%;" class="text-end">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->name }}</strong>
                            <div class="text-muted small">Includes Varanasi Prana Pratishtha Consecration</div>
                        </td>
                        <td class="text-end">₹{{ number_format($item->price, 2) }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-end fw-bold">₹{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Calculation Totals -->
    <div class="row justify-content-end mb-4">
        <div class="col-sm-6 col-md-5">
            <div class="d-flex justify-content-between mb-1 small">
                <span>Subtotal:</span>
                <strong>₹{{ number_format($order->subtotal, 2) }}</strong>
            </div>
            @if($order->discount > 0)
                <div class="d-flex justify-content-between mb-1 small text-danger">
                    <span>Coupon Discount ({{ $order->coupon_code }}):</span>
                    <strong>-₹{{ number_format($order->discount, 2) }}</strong>
                </div>
            @endif
            <div class="d-flex justify-content-between mb-1 small">
                <span>Insured Postal Shipping:</span>
                <strong>{{ $order->shipping == 0 ? 'FREE' : '₹'.number_format($order->shipping, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between mb-2 small">
                <span>Taxes:</span>
                <strong>₹{{ number_format($order->tax, 2) }}</strong>
            </div>
            <div class="d-flex justify-content-between py-2 border-top border-bottom border-warning fs-5 fw-bold text-dark">
                <span>Grand Total:</span>
                <span>₹{{ number_format($order->total, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="p-3 bg-light rounded text-center small text-muted">
        <strong>Vedic Certificate of Consecration:</strong> All natural ratnas and rudraksha beads are sanctified according to classical Parashari scriptures. For inquiries regarding wearing muhurats, contact our temple desk.
        <div class="mt-1">May the planetary devatas bless your household with peace and abundance.</div>
    </div>
</div>

</body>
</html>
