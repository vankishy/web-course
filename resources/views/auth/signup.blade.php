@extends('layouts.auth')

@section('title', 'Sign Up')

@push('styles')
<style>
    /* 1. Terapkan gradien ke .gradient-bg */
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* 2. Ini adalah panel form putih */
    .form-panel-angled {
        background-color: #f8f9fa; /* Warna bg-light */
    }

    /* 3. Terapkan 'clip-path' hanya di layar besar (desktop) */
    @media (min-width: 992px) {
        .form-panel-angled {
            /* Ini adalah trik CSS untuk "flow"
               Membuat sisi kiri miring seperti ini: /
               Format: polygon(X1 Y1, X2 Y2, X3 Y3, X4 Y4) */
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
        }
        
        /* 4. Kita butuh padding ekstra di kiri form agar tidak terpotong */
        .form-content-wrapper {
            padding-left: 5rem !important;
        }
    }
</style>
@endpush


@section('content')
<div class="container-fluid g-0">
    <div class="row g-0 min-vh-100 gradient-bg">

        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
            <div class="text-center text-white p-5">
                <i class="fas fa-graduation-cap fa-5x mb-4"></i>
                <h1 class="display-4 fw-bold">WebCourse</h1>
                <p class="lead mt-3">Start your learning journey here. Master new skills with structured roadmaps.</p>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center form-panel-angled">
            
            <div class="col-md-9 col-lg-9 col-xl-8 p-4 p-sm-5 form-content-wrapper">
                
                <div class="text-center d-lg-none mb-4">
                    <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                    <h1 class="h3 mt-2 fw-bold">WebCourse</h1>
                </div>
                
                <h2 class="h3 fw-bold text-start mb-4">Create Your Account</h2>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.process') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" 
                               placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" 
                               placeholder="your.email@example.com" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" 
                               placeholder="Minimal 6 karakter" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control form-control-lg" placeholder="Ulangi password" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            Sign Up
                        </button>
                    </div>
                </form>

                <p class="text-center text-muted small mt-4">
                    Sudah punya akun?
                    <a href="{{ route('signin') }}" class="fw-medium">Masuk</a>
                </p>
            </div>
        </div>
        
    </div>
</div>
@endsection