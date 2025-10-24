@extends('layouts.app')

@section('title', $currentDetail->name . ' - WebCourse')

@section('content')
    <div class="container my-5">
        <div class="row">
            {{-- Kiri: Konten Utama --}}
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        @php
                            $current = $currentDetail;
                        @endphp

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">{{ $current->name ?? 'Pilih materi untuk mulai belajar' }}</h4>

                            @if ($current)
                                @if ($statuscourse)
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-check-circle me-1"></i> Done
                                    </button>
                                @else
                                    <form action="{{ route('course.markdone', ['id' => $current['detail_course_id']]) }}"
                                        method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-check2-square me-1"></i> Mark as Done
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        @if ($current)
                            @if ($current->type === 'PDF')
                                @if ($current->path)
                                    <iframe src="{{ asset($current->path) }}" width="100%" height="600px" style="border:none;"></iframe>
                                @else
                                    <div class="alert alert-secondary">File PDF belum diunggah.</div>
                                @endif
                            @elseif ($current->type === 'Video')
                                @if ($current->path)
                                    <video width="100%" controls>
                                        <source src="{{ asset($current->path) }}" type="video/mp4">
                                        Browser kamu tidak mendukung video.
                                    </video>
                                @else
                                    <div class="alert alert-secondary">File video belum diunggah.</div>
                                @endif
                            @endif
                        @else
                            <p class="text-muted">Belum ada materi di subcourse ini.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Kanan: List Materi --}}
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3">{{ $data->name }}</h5>
                        <p class="text-muted mb-3"><small>Course: {{ $data->course->name }}</small></p>

                        @if ($data->detailcourse->isEmpty())
                            <div class="alert alert-warning">Belum ada materi.</div>
                        @else
                            <div class="list-group">
                                @foreach ($data->detailcourse as $detail)
                                    <a href="{{ route('course.details', ['id' => $data->subcourse_id, 'detail' => $detail->detail_course_id]) }}"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ isset($currentDetail) && $currentDetail->detail_course_id === $detail->detail_course_id ? 'active' : '' }}">
                                        <div>
                                            <div class="fw-semibold">{{ $detail->name }}</div>
                                            <small class="text-muted">{{ $detail->type }}</small>
                                        </div>
                                        <span class="badge bg-secondary">{{ $detail->type }}</span>
                                    </a>
                                @endforeach
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection