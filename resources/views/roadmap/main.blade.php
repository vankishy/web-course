@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">My Roadmaps</h2>

    {{-- Kalau user belum punya roadmap --}}
    @if($roadmaps->isEmpty())
        <div class="alert alert-info">
            You are not following any roadmap yet.
        </div>
    @else
        <div class="list-group">
            @foreach($roadmaps as $roadmap)
                <a href="#" class="list-group-item list-group-item-action">
                    {{ $roadmap->name }}
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection
