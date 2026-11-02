@extends('layouts.app')

@section('title', $blog->title . ' | ' . setting('site_name', 'AstroStore'))
@section('meta_description', $blog->excerpt)

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('blogs') }}">Astrology Insights</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 35) }}</li>
        </ol>
    </nav>

    <div class="row g-4 mb-5">
        <!-- Main Blog Post -->
        <div class="col-lg-8">
            <article class="cosmic-card p-4 p-md-5" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 text-muted-cosmic mb-3" style="font-size: 0.85rem;">
                    <span><i class="bi bi-person-fill text-gold me-1"></i>{{ $blog->author }}</span>
                    <span>•</span>
                    <span><i class="bi bi-calendar3 me-1"></i>{{ $blog->created_at->format('F d, Y') }}</span>
                    <span>•</span>
                    <span><i class="bi bi-eye text-saffron me-1"></i>{{ $blog->views }} Reads</span>
                </div>

                <h1 class="cinzel-font text-gold display-6 fw-bold mb-4" style="line-height: 1.3;">
                    {{ $blog->title }}
                </h1>

                @if($blog->image)
                    <div class="mb-4 rounded-4 overflow-hidden" style="max-height: 420px; border: 1px solid var(--cosmic-card-border);">
                        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                @endif

                <div class="blog-lead text-gold fst-italic mb-4 p-3 rounded" style="background: rgba(61,29,107,0.3); border-left: 4px solid var(--cosmic-accent-gold); line-height: 1.7;">
                    {{ $blog->excerpt }}
                </div>

                <div class="blog-content text-light" style="line-height: 1.9; font-size: 1.05rem;">
                    {!! nl2br(e($blog->content)) !!}
                </div>

                <hr style="border-color: rgba(212,175,55,0.2);" class="my-4">

                <!-- Author Bio Box -->
                <div class="p-3 rounded d-flex align-items-center gap-3" style="background: rgba(15, 5, 29, 0.7); border: 1px solid var(--cosmic-card-border);">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-gold fs-3" style="width: 55px; height: 55px; background: rgba(212,175,55,0.15);">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <h6 class="cinzel-font text-gold mb-1">Authored by {{ $blog->author }}</h6>
                        <small class="text-muted-cosmic">Senior Vedic Astrologer & Gemologist at AstroStore Research Wing, Varanasi.</small>
                    </div>
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Consult an Astrologer Card -->
            <div class="cosmic-card p-4 mb-4 text-center" style="background: radial-gradient(circle, rgba(61,29,107,0.8), rgba(26,11,46,0.95)); border-color: var(--cosmic-accent-gold);">
                <span style="font-size: 2.5rem;">🔮</span>
                <h4 class="cinzel-font text-gold mt-2 mb-2">Speak to an Acharya</h4>
                <p class="text-muted-cosmic small mb-3">Facing planetary obstacles in career or marriage? Get your birth chart evaluated today.</p>
                <a href="{{ route('category.show', 'kundli-and-consultation') }}" class="btn btn-cosmic-gold btn-sm w-100">
                    Book Consultation Session
                </a>
            </div>

            <!-- Recent Articles -->
            <div class="cosmic-card p-4">
                <h5 class="cinzel-font text-gold mb-3 pb-2" style="border-bottom: 1px solid var(--cosmic-card-border);">
                    <i class="bi bi-newspaper me-2"></i>Recent Guides
                </h5>
                <div class="d-flex flex-column gap-3">
                    @foreach($recentBlogs as $rb)
                        <div class="d-flex gap-3 align-items-center">
                            @if($rb->image)
                                <img src="{{ $rb->image }}" class="rounded-2" style="width: 65px; height: 60px; object-fit: cover;" alt="thumb">
                            @endif
                            <div>
                                <h6 class="cinzel-font mb-1" style="font-size: 0.88rem; line-height: 1.3;">
                                    <a href="{{ route('blog.show', $rb->slug) }}" class="text-decoration-none text-light">
                                        {{ Str::limit($rb->title, 45) }}
                                    </a>
                                </h6>
                                <small class="text-muted-cosmic" style="font-size: 0.72rem;">{{ $rb->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
