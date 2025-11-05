@extends('layouts.app')

@section('title', $data['name'] . ' - WebCourse')

@section('content')
    <div class="container mt-5">
        {{-- Course Card --}}
        <div class="card shadow-sm mb-4 border-0 rounded-3">
            <div class="card-body">
                <h2 class="fw-bold mb-1">{{ $data['name'] }}</h2>
                <p>{{ $data['desc'] }}</p>
                <p class="text-muted mb-0">
                    Dibuat pada {{ \Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}
                </p>
            </div>
        </div>

        {{-- Subcourses --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-semibold mb-0">Subcourse</h4>
                    <small class="text-muted">
                        Total: {{ count($data['subcourse'] ?? []) }}
                    </small>
                </div>

                @if (!empty($data['subcourse']))
                    <div class="list-group list-group-flush">
                        @foreach ($data['subcourse'] as $sub)
                            <div
                                class="list-group-item d-flex justify-content-between align-items-center flex-wrap py-3 px-2 border-0 border-bottom">
                                <div class="me-auto">
                                    <h6 class="mb-1 fw-semibold">{{ $sub['name'] }}</h6>
                                    <small class="text-muted">
                                        Dibuat pada {{ \Carbon\Carbon::parse($sub['created_at'])->format('d M Y') }}
                                    </small>
                                </div>
                                <a href="{{ route('course.details', ['id' => $sub['subcourse_id']]) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye me-1"></i> Detail
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">Belum ada subcourse yang tersedia.</p>
                @endif
            </div>
        </div>
    </div>
@endsection