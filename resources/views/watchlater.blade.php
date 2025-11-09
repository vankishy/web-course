@extends('layouts.app')

@section('title', 'Watch Later')

@section('content')
    <section class="hero-section text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">
                        Watch Later 🕒💾
                    </h1>
                    
                    <p class="lead"> Access all the materials you saved for later and continue your learning journey.</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-clock display-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    {{-- Sorting Form --}}
                <div class="d-flex justify-content-end mb-3">
                        <form action="{{ route('watchlater.index') }}" method="GET" class="d-flex align-items-center">
                            <label for="sort" class="form-label me-2 mb-0 fw-bold"><small>Urutkan:</small></label>
                            <select name="sort" id="sort" class="form-select form-select-sm"
                                style="width: 200px;" onchange="this.form.submit()">

                                {{-- Opsi "Terbaru" --}}
                                <option value="newest" {{ $currentSort == 'newest' ? 'selected' : '' }}>
                                    Terbaru Ditambahkan
                                </option>

                                {{-- Opsi "Terlama" --}}
                                <option value="oldest" {{ $currentSort == 'oldest' ? 'selected' : '' }}>
                                    Terlama Ditambahkan
                                </option>

                                {{-- Opsi "Abjad" --}}
                                <option value="alphabetical" {{ $currentSort == 'alphabetical' ? 'selected' : '' }}>
                                    Abjad (A-Z)
                                </option>
                            </select>
                        </form>
                    </div>
                    {{-- Loop melalui item watch later --}}
                    @forelse ($watchLaterItems as $item)
                        {{-- Memastikan semua relasi data --}}
                        @if ($item->detailCourse && $item->detailCourse->subcourse && $item->detailCourse->subcourse->course)
                            <div class="card mb-3 shadow-sm card-hover">
                                <div class="row g-0">
                                    <div class="col-md-3">
                                        {{-- Gambar Course --}}
                                        <img src="{{ asset($item->detailCourse->subcourse->course->image_path) }}"
                                            class="img-fluid rounded-start"
                                            alt="{{ $item->detailCourse->subcourse->course->name }}"
                                            style="height: 100%; object-fit: cover;">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    {{-- Judul Course & Subcourse --}}
                                                    <h6 class="card-subtitle mb-1 text-muted">
                                                        {{ $item->detailCourse->subcourse->course->name }} /
                                                        {{ $item->detailCourse->subcourse->name }}
                                                    </h6>
                                                    {{-- Judul Materi (Detail Course) --}}
                                                    <h5 class="card-title mb-2">
                                                        {{ $item->detailCourse->name }}
                                                    </h5>
                                                    <p class="card-text">
                                                        <span
                                                            class="badge bg-{{ $item->detailCourse->type == 'Video' ? 'danger' : 'primary' }}">
                                                            <i
                                                                class="fas fa-{{ $item->detailCourse->type == 'Video' ? 'play-circle' : 'file-pdf' }} me-1"></i>
                                                            {{ $item->detailCourse->type }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div>
                                                    {{-- Tombol Hapus --}}
                                                    <form
                                                        action="{{ route('watchlater.destroy', $item->watchlater_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            title="Remove">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- Tombol Tonton Sekarang --}}
                                            <a href="{{ url('course/subcourse/details/' . $item->detailCourse->subcourse_id . '?detail=' . $item->detailCourse->detail_course_id) }}"
                                                class="btn btn-success mt-2">
                                                <i class="fas fa-play me-1"></i> Go There!
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center p-5 bg-light rounded">
                            <i class="fas fa-clock fa-3x text-muted mb-3"></i>
                            <h4 class="mb-3">Daftar tonton nanti Anda kosong.</h4>
                            <p class="text-muted">Tambahkan materi ke daftar Anda untuk ditonton nanti.</p>
                            <a href="{{ route('course.index') }}" class="btn btn-primary">Telusuri Course</a>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
@endsection