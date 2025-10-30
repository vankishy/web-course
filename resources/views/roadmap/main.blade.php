@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4"><i class="fas fa-road text-success me-2"></i>My Learning Paths</h2>

    {{-- Kalau user belum punya roadmap --}}
    @if($roadmaps->isEmpty())
        <div class="alert alert-info">
            You are not following any roadmap yet. Explore the dashboard to find one!
        </div>
    @else
        {{-- Menggunakan struktur Grid dan Card dari Dashboard --}}
        <div class="row g-4">
            @foreach($roadmaps as $roadmap)
                <div class="col-md-4">
                    <div class="card card-hover h-100">
                        <div class="card-body d-flex flex-column"> 
                            
                            {{-- Judul Roadmap --}}
                            <h5 class="card-title">{{ $roadmap->name }}</h5>
                            
                            {{-- Info Ringkas --}}
                            <p class="card-text">
                                <small class="text-muted">
                                    {{-- Menampilkan jumlah course saja --}}
                                    {{ $roadmap->course_count ?? $roadmap->courses->count() }} courses • {{ $roadmap->duration ?? 'N/A' }}
                                </small>
                            </p>
                            
                            {{-- Tombol Aksi (Menuju Detail Course List) --}}
                            <a href="{{ route('roadmap.show', $roadmap->slug) }}" class="btn btn-success btn-sm w-100 mt-auto">
                                <i class="fas fa-play me-1"></i>Start Path
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <hr class="my-5">

    {{-- BAGIAN 2: ROADMAP REKOMENDASI --}}
    <h2 class="mb-4"><i class="fas fa-star me-2 text-warning"></i>Recommended Paths</h2>

    @if($recommendedRoadmaps->isEmpty())
        <div class="alert alert-secondary">
            You are currently following all available roadmaps! Great job!
        </div>
    @else
        <div class="row g-4">
            @foreach($recommendedRoadmaps as $roadmap)
                <div class="col-md-4">
                    <div class="card card-hover h-100 border-warning"> 
                        <div class="card-body d-flex flex-column"> 
                            
                            {{-- Label Rekomendasi --}}
                            <span class="badge bg-warning text-dark mb-2 float-end">Rekomendasi</span>

                            <h5 class="card-title">{{ $roadmap->name }}</h5>
                            <p class="card-text">
                                <small class="text-muted">
                                    {{ $roadmap->courses->count() }} courses • {{ $roadmap->duration ?? 'N/A' }}
                                </small>
                            </p>
                            
                            {{-- Tombol Aksi: Arahkan ke Detail Roadmap --}}
                            <a href="{{ route('roadmap.show', $roadmap->slug) }}" class="btn btn-outline-warning btn-sm w-100 mt-auto">
                                <i class="fas fa-search me-1"></i>View Details
                            </a>
                            
                            <!-- {{-- Opsional: Tambahkan tombol untuk langsung "Follow" --}}
                            {{-- <form method="POST" action="{{ route('user.roadmap.follow', $roadmap->roadmap_id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning w-100 mt-2">Follow Path</button>
                            </form> --}} -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection