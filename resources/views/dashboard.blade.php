@extends('layouts.app')

@section('title', 'Dashboard - WebCourse')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Welcome back, {{ $user->name }}! 👋</h1>
                    <p class="lead">Continue your learning journey. Pick up where you left off or explore new topics.</p>
                    <div class="mt-4">
                        <button class="btn btn-light btn-lg me-3">
                            <i class="fas fa-play me-2"></i>Continue Learning
                        </button>
                        <button class="btn btn-outline-light btn-lg">
                            <i class="fas fa-compass me-2"></i>Explore Courses
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-graduation-cap display-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card stat-card border-left-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-book-open text-primary fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $stats['enrolled_courses'] }}</h4>
                                    <p class="text-muted mb-0">Enrolled Courses</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-left-success h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $stats['completed_courses'] }}</h4>
                                    <p class="text-muted mb-0">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-left-warning h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-clock text-warning fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $stats['watch_later'] }}</h4>
                                    <p class="text-muted mb-0">Watch Later</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card border-left-info h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-hourglass-half text-info fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $stats['learning_hours'] }}h</h4>
                                    <p class="text-muted mb-0">Learning Hours</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Left Column - Courses & Roadmaps -->
            <div class="col-lg-8">
                <!-- Featured Courses -->
                <div class="card mb-4" id="courses">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-star text-warning me-2"></i>Featured Courses
                        </h3>
                        <a href="#courses" class="btn btn-sm btn-outline-primary">View All Courses</a>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($featuredCourses as $course)
                            <div class="col-md-6">
                                <div class="card card-hover h-100">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary rounded p-2 text-white">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="card-title mb-1">{{ $course->name }}</h5>
                                                <p class="card-text text-muted small">{{ $course->description }}</p>
                                            </div>
                                        </div>

                                        <!-- Roadmap Tags -->
                                        @if(isset($course->roadmaps) && count($course->roadmaps) > 0)
                                        <div class="mb-3">
                                            <small class="text-muted">Part of: </small>
                                            @foreach($course->roadmaps as $roadmap)
                                                <span class="badge bg-light text-dark border me-1">{{ $roadmap->name }}</span>
                                            @endforeach
                                        </div>
                                        @endif

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="badge bg-primary">{{ $course->level }}</span>
                                                <span class="badge bg-secondary">{{ $course->duration }}</span>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-outline-primary">View Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Learning Paths -->
                <div class="card" id="roadmaps">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-road text-success me-2"></i>Learning Paths
                        </h3>
                        <a href="#roadmaps" class="btn btn-sm btn-outline-success">View All Paths</a>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($popularRoadmaps as $roadmap)
                            <div class="col-md-4">
                                <div class="card card-hover h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $roadmap->name }}</h5>
                                        <p class="card-text">
                                            <small class="text-muted">
                                                {{ $roadmap->course_count }} courses • {{ $roadmap->duration }}
                                            </small>
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <small class="text-muted">
                                                <i class="fas fa-users me-1"></i>
                                                {{ $roadmap->enrollments_count }} students
                                            </small>
                                        </div>
                                        <div class="progress mb-3" style="height: 6px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <button class="btn btn-success btn-sm w-100">
                                            <i class="fas fa-play me-1"></i>Start Path
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Activity & Quick Actions -->
            <div class="col-lg-4">
                <!-- Recent Activity -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-history me-2"></i>Recent Activity
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($recentActivity as $activity)
                            <div class="list-group-item px-0 border-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $activity->course_name }}</h6>
                                    <small class="text-muted">{{ $activity->time }}</small>
                                </div>
                                <p class="mb-1 text-muted">
                                    <i class="fas fa-circle text-success me-1 small"></i>
                                    {{ $activity->action }}
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="#courses" class="btn btn-outline-primary btn-sm text-start">
                                <i class="fas fa-search me-2"></i>Browse Courses
                            </a>
                            <a href="#roadmaps" class="btn btn-outline-success btn-sm text-start">
                                <i class="fas fa-road me-2"></i>View Roadmaps
                            </a>
                            <a href="#watchlater" class="btn btn-outline-warning btn-sm text-start">
                                <i class="fas fa-clock me-2"></i>Watch Later
                            </a>
                            <a href="/leaderboard" class="btn btn-outline-info btn-sm text-start">
                                <i class="fas fa-trophy me-2"></i>Leaderboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
