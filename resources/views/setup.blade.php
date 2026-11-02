<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup & Initializer | AstroStore</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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
            padding: 2rem 1rem;
        }
        .setup-card {
            max-width: 780px;
            width: 100%;
            background: rgba(26, 11, 46, 0.9);
            border: 1px solid var(--cosmic-accent-gold);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.8), 0 0 25px rgba(212,175,55,0.3);
            padding: 2.5rem;
        }
    </style>
</head>
<body>

<div class="setup-card text-center" data-aos="zoom-in">
    <div style="font-size: 3rem;">✨</div>
    <h2 class="cinzel-font text-gold mb-2">Vedic Database Setup & Consecration</h2>
    <p class="text-muted-cosmic mb-4">Cosmic database migration, seeding & system initialization result</p>

    @if($status === 'success')
        <div class="alert alert-success d-flex align-items-center justify-content-center gap-2 mb-4" style="background: rgba(34, 197, 94, 0.15); border: 1px solid #22c55e; color: #86efac; border-radius: 12px; font-size: 1.1rem;">
            <i class="bi bi-patch-check-fill fs-4"></i>
            <strong>All Celestial Migrations & Seeders Completed Successfully!</strong>
        </div>
    @else
        <div class="alert alert-danger d-flex align-items-center justify-content-center gap-2 mb-4" style="background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #fca5a5; border-radius: 12px;">
            <i class="bi bi-exclamation-octagon-fill fs-4"></i>
            <strong>Setup completed with errors. Please check the logs below.</strong>
        </div>
    @endif

    <!-- Tables Created Badges -->
    @if(count($tables) > 0)
        <div class="text-start mb-4">
            <h6 class="cinzel-font text-gold mb-2"><i class="bi bi-table me-2"></i>Active Database Tables ({{ count($tables) }}):</h6>
            <div class="d-flex flex-wrap gap-2">
                @foreach($tables as $tbl)
                    <span class="badge" style="background: rgba(61, 29, 107, 0.8); border: 1px solid rgba(212,175,55,0.3); color: #f3e5ab; font-size: 0.85rem; padding: 6px 12px; border-radius: 20px;">
                        <i class="bi bi-check2 text-success me-1"></i>{{ $tbl }}
                    </span>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Execution Logs Accordion / Box -->
    <div class="text-start mb-4">
        <h6 class="cinzel-font text-gold mb-2"><i class="bi bi-terminal me-2"></i>Execution Logs:</h6>
        <div class="p-3 rounded text-light" style="background: rgba(10, 3, 20, 0.85); border: 1px solid rgba(212,175,55,0.2); font-family: monospace; font-size: 0.82rem; max-height: 220px; overflow-y: auto;">
            @foreach($logs as $log)
                <div class="text-info mb-1">> {{ $log }}</div>
            @endforeach
            @foreach($errors as $err)
                <div class="text-danger mb-1">> ERROR: {{ $err }}</div>
            @endforeach
        </div>
    </div>

    <!-- Credentials Card -->
    <div class="p-3 mb-4 rounded text-start" style="background: rgba(61, 29, 107, 0.3); border: 1px dashed rgba(212,175,55,0.4);">
        <div class="fw-bold text-gold mb-1"><i class="bi bi-key-fill me-2"></i>Default Master Credentials:</div>
        <div class="row g-2" style="font-size: 0.88rem;">
            <div class="col-md-6">
                <span class="text-muted-cosmic">Admin Email:</span> <strong class="text-light">admin@astro.com</strong><br>
                <span class="text-muted-cosmic">Admin Password:</span> <strong class="text-light">Admin@123</strong>
            </div>
            <div class="col-md-6">
                <span class="text-muted-cosmic">Demo User Email:</span> <strong class="text-light">user@astro.com</strong><br>
                <span class="text-muted-cosmic">Demo User Password:</span> <strong class="text-light">User@123</strong>
            </div>
        </div>
        <div class="mt-2 text-warning" style="font-size: 0.8rem;">
            <i class="bi bi-shield-exclamation me-1"></i> For security on live hosting, remember to set <code>SETUP_LOCKED=true</code> in your <code>.env</code> file.
        </div>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('admin.login') }}" class="btn btn-cosmic-gold px-4">
            <i class="bi bi-speedometer2 me-2"></i>Go to Admin Panel
        </a>
        <a href="{{ url('/') }}" class="btn btn-cosmic-outline px-4">
            <i class="bi bi-house-door me-2"></i>Visit Frontend Store
        </a>
    </div>
</div>

</body>
</html>
