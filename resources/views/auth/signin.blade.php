@extends('layouts.auth')

@section('title', 'Sign In')

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .form-panel-angled {
        background-color: #f8f9fa; /* bg-light */
    }
    @media (min-width: 992px) {
        .form-panel-angled {
            clip-path: polygon(10% 0, 100% 0, 100% 100%, 0% 100%);
        }
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
                <p class="lead mt-3">Welcome back to your learning journey!</p>
            </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center form-panel-angled">
            
            <div class="col-md-9 col-lg-9 col-xl-8 p-4 p-sm-5 form-content-wrapper">
                
                <div class="text-center d-lg-none mb-4">
                    <i class="fas fa-graduation-cap fa-3x text-primary"></i>
                    <h1 class="h3 mt-2 fw-bold">WebCourse</h1>
                </div>
                
                <h2 class="h3 fw-bold text-start mb-4">Sign In</h2>
                <p class="text-muted text-start mb-4">Welcome back! Please enter your details.</p>

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg" 
                               placeholder="your.email@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" 
                               placeholder="••••••••" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            Sign In
                        </button>
                    </div>
                </form>

                <p class="text-center text-muted small mt-4">
                    Belum punya akun?
                    <a href="{{ route('signup') }}" class="fw-medium">Buat AKun</a>
                </p>
            </div>
        </div>
        
    </div>
</div>
@endsection