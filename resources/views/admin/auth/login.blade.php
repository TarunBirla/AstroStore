<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Acharya Admin Access | {{ setting('site_name', 'AstroStore') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <style>
        body {
            background-color: #0b0314;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(61, 29, 107, 0.7) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(212, 175, 55, 0.2) 0%, transparent 40%),
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160' viewBox='0 0 160 160'%3E%3Cg fill='%23d4af37' fill-opacity='0.08'%3E%3Ccircle cx='20' cy='20' r='1.5'/%3E%3Ccircle cx='80' cy='40' r='1'/%3E%3Ccircle cx='140' cy='30' r='1.8'/%3E%3Ccircle cx='110' cy='110' r='1.5'/%3E%3C/g%3E%3C/svg%3E");
            padding: 1.5rem;
        }
        .admin-login-box {
            max-width: 440px;
            width: 100%;
            background: rgba(26, 11, 46, 0.88);
            border: 1px solid var(--cosmic-accent-gold);
            border-radius: 16px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.8), 0 0 25px rgba(212, 175, 55, 0.35);
            backdrop-filter: blur(14px);
            padding: 2.5rem 2rem;
        }
    </style>
</head>
<body>

<div class="admin-login-box text-center">
    <!-- Emblem -->
    <div style="font-size: 2.8rem; filter: drop-shadow(0 0 12px rgba(212,175,55,0.7));">🪐</div>
    <h3 class="cinzel-font text-gold mt-2 mb-1">Astro Admin Command</h3>
    <p class="text-muted-cosmic mb-4" style="font-size: 0.85rem;">Master portal for inventory, orders, devotees & analytics</p>

    @include('partials.alerts')

    <form method="POST" action="{{ route('admin.login.submit') }}" class="text-start">
        @csrf

        <div class="mb-3">
            <label for="adminEmail" class="form-label text-gold" style="font-size: 0.85rem;">Admin Identity (Email)</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                    <i class="bi bi-shield-lock-fill"></i>
                </span>
                <input id="adminEmail" type="email" class="form-control cosmic-input border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email', 'admin@astro.com') }}" required autofocus placeholder="admin@astro.com">
            </div>
            @error('email')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="adminPassword" class="form-label text-gold" style="font-size: 0.85rem;">Master Security Key (Password)</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0" style="border-color: var(--cosmic-card-border); color: var(--cosmic-accent-gold);">
                    <i class="bi bi-key-fill"></i>
                </span>
                <input id="adminPassword" type="password" class="form-control cosmic-input border-start-0 @error('password') is-invalid @enderror" name="password" value="Admin@123" required placeholder="••••••••">
            </div>
            @error('password')
                <span class="text-danger small mt-1 d-block">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="adminRemember" checked style="background-color: #150824; border-color: var(--cosmic-accent-gold);">
            <label class="form-check-label text-muted-cosmic" for="adminRemember" style="font-size: 0.85rem;">
                Keep Administrative Session Active
            </label>
        </div>

        <button type="submit" class="btn btn-cosmic-gold w-100 py-2 mb-3">
            <i class="bi bi-unlock-fill me-2"></i> Enter Master Admin Control
        </button>

        <div class="text-center">
            <a href="{{ url('/') }}" class="text-muted-cosmic" style="font-size: 0.85rem; text-decoration: none;">
                <i class="bi bi-arrow-left me-1"></i> Return to Public Store
            </a>
        </div>
    </form>
</div>

</body>
</html>
