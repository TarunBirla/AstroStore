@extends('layouts.app')

@section('title', 'Vedic Astrology Blogs & Insights | ' . setting('site_name', 'AstroStore'))

@section('content')
<div class="container py-3">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-cosmic">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Astrology Insights</li>
        </ol>
    </nav>

    <div class="cosmic-card p-4 p-md-5 mb-5 text-center" data-aos="fade-down" style="background: radial-gradient(circle at center, rgba(61,29,107,0.7) 0%, rgba(15,5,29,0.95) 100%);">
        <span class="badge badge-gold mb-2">✦ SACRED JYOTISH DISCOURSES ✦</span>
        <h1 class="cinzel-font text-gold display-5 fw-bold mb-2">Astrological Insights & Wisdom</h1>
        <p class="text-muted-cosmic mb-0" style="max-width: 680px; margin: 0 auto;">In-depth guides on planetary transits, gemstone science, sacred rudraksha identification, and practical Vedic remedies.</p>
    </div>

    <div class="row g-4 mb-4">
        @foreach($blogs as $blog)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
                <div class="cosmic-card h-100 d-flex flex-column">
                    <a href="{{ route('blog.show', $blog->slug) }}" class="overflow-hidden d-block" style="height: 220px;">
                        <img src="{{ $blog->image ?: 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $blog->title }}" class="w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
                    </a>
                    <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                        <div>
                            <div class="d-flex align-items-center justify-content-between text-muted-cosmic mb-2" style="font-size: 0.8rem;">
                                <span><i class="bi bi-person text-gold me-1"></i>{{ $blog->author }}</span>
                                <span><i class="bi bi-eye text-saffron me-1"></i>{{ $blog->views }} views</span>
                            </div>
                            <h5 class="cinzel-font mb-2" style="font-size: 1.1rem; line-height: 1.4;">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-light">
                                    {{ $blog->title }}
                                </a>
                            </h5>
                            <p class="text-muted-cosmic small mb-3" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $blog->excerpt }}
                            </p>
                        </div>
                        <div class="pt-2" style="border-top: 1px solid rgba(212,175,55,0.15);">
                            <a href="{{ route('blog.show', $blog->slug) }}" class="text-gold fw-bold text-decoration-none small d-flex align-items-center justify-content-between">
                                <span>Read Full Article</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center pagination-cosmic">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
