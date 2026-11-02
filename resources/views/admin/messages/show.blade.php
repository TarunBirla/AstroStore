@extends('layouts.admin')

@section('title', 'Inquiry from ' . $message->name)
@section('page_title', 'Devotee Inquiry Detail')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="cosmic-card p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                <div>
                    <h4 class="cinzel-font text-gold mb-0">{{ $message->subject ?: 'Sacred Inquiry' }}</h4>
                    <small class="text-muted-cosmic">Received {{ $message->created_at->format('F d, Y - h:i A') }}</small>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-cosmic-outline btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>

            <!-- Sender Info Card -->
            <div class="p-3 rounded mb-4" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                <div class="row g-2" style="font-size: 0.9rem;">
                    <div class="col-sm-6">
                        <span class="text-muted-cosmic">Sender:</span> <strong class="text-light">{{ $message->name }}</strong>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <span class="text-muted-cosmic">Email:</span> <a href="mailto:{{ $message->email }}" class="text-gold">{{ $message->email }}</a>
                    </div>
                    <div class="col-sm-6">
                        <span class="text-muted-cosmic">Phone:</span> <a href="tel:{{ $message->phone }}" class="text-light">{{ $message->phone ?: 'Not provided' }}</a>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <span class="text-muted-cosmic">Status:</span> <span class="badge bg-success">Read</span>
                    </div>
                </div>
            </div>

            <!-- Message Body -->
            <div class="mb-4">
                <label class="form-label text-gold small fw-bold">Message Content / Birth Chart Particulars:</label>
                <div class="p-3 rounded text-light" style="background: rgba(61, 29, 107, 0.25); border: 1px solid var(--cosmic-card-border); line-height: 1.8; font-size: 1rem; white-space: pre-line;">
                    {{ $message->message }}
                </div>
            </div>

            <!-- Actions -->
            <div class="d-flex gap-2">
                <a href="mailto:{{ $message->email }}?subject={{ urlencode('Re: ' . ($message->subject ?: 'Your inquiry at AstroStore')) }}" class="btn btn-cosmic-gold">
                    <i class="bi bi-reply-fill me-1"></i> Reply via Celestial Email
                </a>
                @if($message->phone)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="btn btn-success">
                        <i class="bi bi-whatsapp me-1"></i> Chat on WhatsApp
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
