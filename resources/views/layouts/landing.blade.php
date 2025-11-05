<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WebCourse')</title>

    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    {{-- Bootstrap Icons (Opsional, jika dibutuhkan elemen lain) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    {{-- Google Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Terapkan Font Poppins & style dasar */
        body, .btn {
            font-family: 'Poppins', sans-serif;
        }

        /* Styling Ikon Search Hover */
        .nav-icon-hover {
            transition: color 0.2s ease-in-out;
        }
        .nav-icon-hover:hover {
            color: #764ba2  !important; /* Biru saat hover */
        }

        /* Styling Tombol Navbar */
        .navbar .btn-custom {
            font-size: 0.9rem;
            padding-top: 0.4rem;
            padding-bottom: 0.4rem;
            font-weight: 500; /* fw-medium */
        }
        .navbar .btn.rounded-pill {
            border-radius: 50rem !important;
        }
    </style>
    
    {{-- Tempat untuk CSS tambahan dari view --}}
    @stack('styles')
</head>

<body>
    {{-- Navbar Landing Page (Logo + Sign In/Up) --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-5 d-flex align-items-center" href="{{ route('landing') }}">
                <i class="fas fa-graduation-cap text-primary me-2 fs-4"></i>
                <span style="font-family: 'Poppins', sans-serif;">WebCourse</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavLandingSimple" aria-controls="navbarNavLandingSimple" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavLandingSimple">
                <ul class="navbar-nav align-items-center ms-auto">
                    {{-- <li class="nav-item me-3">
                        <a class="nav-link text-muted nav-icon-hover" href="#">
                            <i class="fas fa-search fs-5"></i>
                        </a>
                    </li> --}} {{-- Ikon search dikomentari, bisa dihapus jika tidak perlu --}}
                    <li class="nav-item me-2">
                         <a class="btn btn-outline-primary btn-sm px-3 rounded-pill btn-custom" href="{{ route('signin') }}">Sign In</a>
                    </li>
                    <li class="nav-item">
                         <a class="btn btn-primary btn-sm px-3 rounded-pill btn-custom" href="{{ route('signup') }}">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Utama Halaman --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer (Pastikan layouts.footer ada) --}}
    @include('layouts.footer')

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Tempat untuk JS tambahan dari view --}}
    @stack('scripts')
</body>

</html>