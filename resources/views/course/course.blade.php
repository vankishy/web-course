@extends('layouts.app')

@section('title', 'Dashboard - WebCourse')

@section('content')
    <div class="container mt-4">
        <h2 class="fw-bold mb-4">Daftar Course</h2>

        <div class="row">
            @forelse ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        @if ($course->image_path)
                            <img src="{{ asset($course->image_path) }}" class="card-img-top" alt="{{ $course->name }}"
                                style="height: 200px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                        @else
                            <img src="{{ asset('default_courses.jpg') }}" class="card-img-top" alt="Default image"
                                style="height: 200px; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $course->name }}</h5>
                            <p class="card-text text-muted" style="flex-grow: 1;">
                                {{ Str::limit($course->desc, 100) }}
                            </p>
                            <a href="{{ route('course.subcourse', ['id' => $course->course_id]) }}"
                                class="btn btn-primary mt-auto w-100">
                                Lihat Subcourse
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Belum ada course tersedia.</div>
                </div>
            @endforelse
        </div>
    </div>

@endsection