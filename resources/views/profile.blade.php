@extends('layouts.app')

{{-- Set the page title dynamically --}}
@section('title', $user->name . "'s Profile")

{{-- Custom styles for the profile page --}}
@push('styles')
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            border-radius: .5rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .stat-number {
            font-size: 1.75rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        /* ▼▼▼ NEW STYLE FOR SCROLLING ▼▼▼ */
        .history-scroll-area {
            max-height: 250px;
            /* Adjust this value to show exactly 3-4 items */
            overflow-y: auto;
        }
        /* ▲▲▲ END NEW STYLE ▲▲▲ */

    </style>
@endpush

{{-- Main content section --}}
@section('content')
    <div class="container mt-4">

        <!-- Profile Header -->
        <div class="profile-header mb-4 p-4 text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    {{-- UPDATED: Use $profileData array --}}
                    <img src="{{ $profileData['avatar_url'] ?? 'https://placehold.co/150x150/667eea/white?text=' . substr($user->name, 0, 1) }}"
                        alt="{{ $user->name }}'s Avatar" class="profile-avatar">
                </div>
                <div class="col-md-9">
                    {{-- This is fine, it comes from the $user object --}}
                    <h1 class="display-5 mb-0">{{ $user->name }}</h1>
                    <p class="lead mb-1">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{-- UPDATED: Use $profileData array --}}
                        {{ $profileData['location'] ?? 'Location not set' }}
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{-- This is fine, it comes from the $user object --}}
                        Joined: {{ $user->created_at->format('F Y') }}
                    </p>

                    {{-- This logic is correct for your "static user" setup --}}
                    @if($user->user_id == 1)
                        <a href="#" class="btn btn-light mt-2">
                            <i class="fas fa-pencil-alt me-2"></i>Edit Profile
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Profile Content Grid -->
        <div class="row">
            <!-- Left Column (About & Stats) -->
            <div class="col-lg-8">
                <!-- About Me Card -->
                <div class="card card-hover mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>About Me</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            {{-- UPDATED: Use $profileData array --}}
                            {{ $profileData['bio'] ?? 'No biography provided.' }}
                        </p>
                        <hr>
                        <h6 class="mb-3">Learning Goals</h6>
                        <p class="card-text">
                            {{-- UPDATED: Use $profileData array --}}
                            {{ $profileData['learning_goals'] ?? 'No learning goals set.' }}
                        </p>

                        {{-- UPDATED: Use $profileData array --}}
                        @if(!empty($profileData['website_url']))
                            <a href="{{ $profileData['website_url'] }}" class="btn btn-outline-primary mt-2" target="_blank">
                                <i class="fas fa-globe me-2"></i>Personal Website
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Stats Card (Placeholder) -->
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card stat-card card-hover h-100" style="border-left-color: #667eea;">
                            <div class="card-body">
                                <i class="fas fa-book stat-icon text-primary"></i>
                                <div class="stat-number">...</div>
                                <div class="stat-label">Enrolled Courses</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card stat-card card-hover h-100" style="border-left-color: #17a2b8;">
                            <div class="card-body">
                                <i class="fas fa-check-circle stat-icon text-info"></i>
                                <div class="stat-number">...</div>
                                <div class="stat-label">Completed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card stat-card card-hover h-100" style="border-left-color: #ffc107;">
                            <div class="card-body">
                                <i class="fas fa-hourglass-half stat-icon text-warning"></i>
                                <div class="stat-number">...</div>
                                <div class="stat-label">Learning Hours</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column (Recent Activity - Placeholder) -->
            <div class="col-lg-4">
            <div class="card card-hover">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Activity</h5>
                </div>
                
                {{-- ▼▼▼ WRAPPER ADDED FOR SCROLLING ▼▼▼ --}}
                <div class="history-scroll-area"> 
                    <div class="list-group list-group-flush">
                        @forelse($recentActivityFormatted as $activity)
                            {{-- ... existing list item content ... --}}
                            <a href="{{ route('course.subcourse', ['id' => $activity->subcourse_id]) }}" class="list-group-item list-group-item-action">
                                <h6 class="mb-1">{{ $activity->course_name }}</h6>
                                <small class="text-muted">
                                    <i class="fas fa-circle text-primary me-1 small"></i>
                                    {{ $activity->action_description }} &middot; {{ $activity->time_ago }}
                                </small>
                            </a>
                        @empty
                            <div class="list-group-item">
                                <p class="text-muted mb-0">No recent learning activity found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                {{-- ▲▲▲ END WRAPPER ▲▲▲ --}}
            </div>
        </div>
    </div>
</div>
@endsection