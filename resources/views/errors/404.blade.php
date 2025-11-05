{{-- resources/views/errors/404.blade.php --}}
@extends('layouts.errorapp')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div class="d-flex flex-column align-items-center justify-content-center" style="height: 70vh;">
        <h1 class="fw-bold text-danger mb-3">404</h1>
        <h3>Halaman Tidak Ditemukan</h3>
        <p class="text-muted">Maaf, halaman yang kamu cari tidak tersedia atau sudah dihapus.</p>
        <a href="{{ route('course.index') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection