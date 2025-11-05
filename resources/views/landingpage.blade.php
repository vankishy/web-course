@extends('layouts.landing') {{-- Menggunakan layout landing --}}

@section('title', 'Selamat Datang di WebCourse')

@push('styles')
{{-- Link Google Font Poppins (jika belum ada di layouts.landing) --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* == TERAPKAN FONT MODERN == */
    body, .btn, h1, h2, h3, h4, h5, h6, .navbar-brand span {
        font-family: 'Poppins', sans-serif;
    }

    /* == PERBAIKI HERO SECTION == */
    .hero-section {
        padding: 8rem 0;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        overflow: hidden;
        color: #ffffff;
    }
    .hero-section .display-4 { font-weight: 700; line-height: 1.3; }
    .hero-tagline { font-weight: 600; margin-bottom: 1rem; opacity: 0.9; letter-spacing: 0.5px; }
    .hero-section .lead { opacity: 0.85; margin-bottom: 3rem; max-width: 90%; }

    /* Styling Tombol Hero */
    .hero-section .btn { padding: 0.8rem 2rem; font-weight: 600; border-radius: 50rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); }
    .hero-section .btn-light { color: #667eea; }
    .hero-section .btn-light:hover { background-color: #f8f9fa; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); }
    .hero-section .btn-outline-light:hover { background-color: rgba(255, 255, 255, 0.1); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); }

    /* Container untuk Gambar Hero (bukan placeholder lagi) */
    .hero-image-container { /* Ganti nama class jika perlu */
        min-height: 450px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        /* Hapus background, border, shadow dari placeholder */
    }

    /* === CSS UNTUK MEMBUAT GAMBAR MENYATU === */
    .hero-image-container img {
        display: block; /* Hapus spasi bawah */
        width: 100%; /* Isi container */
        height: auto;
        border-radius: 0.75rem; /* Sedikit rounded corner untuk gambar */

        /* Masking untuk efek pudar di tepi */
        -webkit-mask-image: radial-gradient(ellipse at center, black 70%, transparent 100%);
        mask-image: radial-gradient(ellipse at center, black 70%, transparent 100%);
        /* Anda bisa sesuaikan angka 70% untuk mengatur seberapa cepat pudarnya */
    }
    /* === AKHIR CSS GAMBAR MENYATU === */

    /* == SOCIAL PROOF SECTION == */
    .social-proof { padding: 6rem 0; }
    .social-proof h3 { text-align: center; margin-bottom: 4rem; color: #495057; font-weight: 600; font-size: 1.5rem; }
    .client-logos img { max-height: 45px; filter: grayscale(100%) brightness(1.2); opacity: 0.5; transition: all 0.3s ease; margin: 0.75rem 1.75rem; }
    .client-logos img:hover { filter: grayscale(0%) brightness(1); opacity: 1; transform: scale(1.05); }
</style>
@endpush

@section('content')

    <section class="hero-section text-white">
        <div class="container">
            <div class="row align-items-center g-5">
                {{-- Kiri: Teks --}}
                <div class="col-lg-6">
                    <p class="hero-tagline">#SPIRITTOLEARNING</p>
                    <h1 class="display-4 mb-3">Your Dream Career Starts With Us</h1>
                    <p class="lead">
                        WebCourse menyediakan kelas UI/UX design, Web Development, dan Freelancer untuk pemula.
                    </p>
                    <a href="#" class="btn btn-light me-3 mb-3 mb-sm-0">
                        <i class="fas fa-book-open me-2"></i> Alur Belajar
                    </a>
                    <a href="#" class="btn btn-outline-light mb-3 mb-sm-0">
                        <i class="fas fa-briefcase me-2"></i> Panduan Karir
                    </a>
                </div>

                {{-- Kanan: Gambar --}}
                <div class="col-lg-6">
                    {{-- Ganti class div pembungkus --}}
                    <div class="hero-image-container">
                        <img src="{{ asset('img/belajar.jpeg') }}"
                             {{-- Hapus class shadow/rounded dari img jika sudah diatur di CSS --}}
                             class="img-fluid"
                             alt="Ilustrasi Belajar Online">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="social-proof bg-light">
        <div class="container">
            <h3>Alumni WebCourse Bekerja Pada Perusahaan Besar dan Terkenal</h3>
            {{-- Tambahkan div untuk logos jika hilang --}}
        </div>
    </section>

    {{-- Footer akan muncul dari layouts.landing --}}

@endsection