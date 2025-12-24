@extends('layouts.app') 

@section('title', $roadmap->name . ' - Course List')

@section('content')
<div class="container py-5">
    
    <a href="{{ route('roadmap.index') }}" 
       class="text-primary hover:text-blue-700 mb-4 d-inline-block font-weight-bold">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke My Roadmaps
    </a>
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h1 class="h4 mb-0"><i class="fas fa-route me-2"></i> {{ $roadmap->name }}</h1>
        </div>
        
        <div class="card-body">
            
            <p class="text-muted mb-4">{{ $roadmap->description }}</p>
            
            <h2 class="h5 font-weight-bold mb-3 border-bottom pb-2">
                Daftar Kursus ({{ $roadmap->courses->count() }})
            </h2>
            
            @if($roadmap->courses->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Roadmap ini belum memiliki kursus yang ditambahkan.
                </div>
            <!-- Menambahkan daftar course yang sesuai dengan roadmap dipilih user -->
            @else
                <ul class="list-group list-group-flush">
                    @foreach($roadmap->courses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h5 class="mb-1">{{ $course->name }}</h5>
                                <small class="text-muted">
                                    {{ $course->desc ?? 'Deskripsi kursus tidak tersedia.' }} 
                                </small>
                            </div>
                            <!-- Mengarahkan ke halaman course yang dipilih berdasarkan roadmap -->
                            <a href="{{ route('course.details', ['id' => $course->course_id]) }}" class="btn btn-sm btn-outline-success">
                                Mulai <i class="fas fa-chevron-right ms-1"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection