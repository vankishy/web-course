@extends('layouts.app')

@section('title', 'Leaderboard - WebCourse')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">🏆 Leaderboard</h1>
                    <p class="lead">See how you rank among top learners. Keep learning to climb the ranks!</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-trophy display-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card stat-card border-left-primary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-users text-primary fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ number_format($statistics['total_learners']) }}</h4>
                                    <p class="text-muted mb-0">Total Learners</p>
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
                                    <i class="fas fa-user-check text-success fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $statistics['active_today'] }}</h4>
                                    <p class="text-muted mb-0">Active Today</p>
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
                                    <i class="fas fa-graduation-cap text-warning fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0">{{ $statistics['courses_completed_today'] }}</h4>
                                    <p class="text-muted mb-0">Completed Today</p>
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
                                    <i class="fas fa-star text-info fa-2x"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4 class="mb-0 small">{{ $statistics['top_performer_this_week']->name ?? 'N/A' }}</h4>
                                    <p class="text-muted mb-0 small">Top This Week</p>
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
            <!-- Leaderboard Table -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-crown text-warning me-2"></i>Top 10 Learners
                        </h3>

                        <!-- 🔥 Added Refresh & Filter -->
                        <div class="d-flex align-items-center">
                            <form method="GET" action="{{ route('leaderboard') }}" class="me-2">
                                <select name="filter" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All Time</option>
                                    <option value="week" {{ request('filter') == 'week' ? 'selected' : '' }}>This Week</option>
                                    <option value="month" {{ request('filter') == 'month' ? 'selected' : '' }}>This Month</option>
                                </select>
                            </form>
                            <a href="{{ route('leaderboard') }}" class="btn btn-outline-secondary btn-sm" title="Refresh">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center" style="width: 80px;">Rank</th>
                                        <th>Name</th>
                                        <th class="text-center">Points</th>
                                        <th class="text-center">Completed</th>
                                        <th>Badges</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leaderboard as $entry)
                                    <tr class="{{ $entry->is_current_user ? 'table-primary' : '' }}">
                                        <td class="text-center align-middle">
                                            @if($entry->rank == 1)
                                                <span class="badge bg-warning text-dark fs-5">
                                                    <i class="fas fa-crown"></i> 1
                                                </span>
                                            @elseif($entry->rank == 2)
                                                <span class="badge bg-secondary fs-5">
                                                    <i class="fas fa-medal"></i> 2
                                                </span>
                                            @elseif($entry->rank == 3)
                                                <span class="badge bg-danger fs-5">
                                                    <i class="fas fa-award"></i> 3
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark fs-6">{{ $entry->rank }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($entry->name, 0, 1)) }}
                                                </div>
                                                <strong>{{ $entry->name }}</strong>
                                                @if($entry->is_current_user)
                                                    <span class="badge bg-primary ms-2 small">You</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-success">{{ number_format($entry->points) }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="text-muted">{{ $entry->completed_courses }} courses</span>
                                        </td>
                                        <td class="align-middle">
                                            @foreach($entry->badges as $badge)
                                                <span class="badge bg-light text-dark border me-1 small">
                                                    <i class="fas fa-trophy text-warning me-1"></i>{{ $badge }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Your Rank (if not in top 10) -->
                @if($userStats)
                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>Your Ranking
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr class="table-primary">
                                        <td class="text-center align-middle" style="width: 80px;">
                                            <span class="badge bg-light text-dark fs-6">{{ $userStats->rank }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($userStats->name, 0, 1)) }}
                                                </div>
                                                <strong>{{ $userStats->name }}</strong>
                                                <span class="badge bg-primary ms-2 small">You</span>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-success">{{ number_format($userStats->points) }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="text-muted">{{ $userStats->completed_courses }} courses</span>
                                        </td>
                                        <td class="align-middle">
                                            @foreach($userStats->badges as $badge)
                                                <span class="badge bg-light text-dark border me-1 small">
                                                    <i class="fas fa-trophy text-warning me-1"></i>{{ $badge }}
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <p class="text-muted mb-0">Keep learning to improve your ranking!</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar (unchanged) -->
            <div class="col-lg-4">
                <!-- How Points Work -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>How Points Work
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i><strong>100 points</strong> per completed course</li>
                            <li class="mb-3"><i class="fas fa-road text-primary me-2"></i><strong>50 points</strong> per enrolled roadmap</li>
                            <li class="mb-3"><i class="fas fa-trophy text-warning me-2"></i><strong>Bonus points</strong> for earning badges</li>
                            <li class="mb-0"><i class="fas fa-clock text-info me-2"></i>Rankings updated <strong>daily</strong></li>
                        </ul>
                    </div>
                </div>

                <!-- Achievement Badges -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-award me-2"></i>Available Badges
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3"><span class="badge bg-warning text-dark me-2 mb-2"><i class="fas fa-trophy me-1"></i>Master Learner</span><small class="text-muted d-block">Complete 15+ courses</small></div>
                        <div class="mb-3"><span class="badge bg-primary text-white me-2 mb-2"><i class="fas fa-medal me-1"></i>Dedicated</span><small class="text-muted d-block">Complete 10+ courses</small></div>
                        <div class="mb-3"><span class="badge bg-success text-white me-2 mb-2"><i class="fas fa-star me-1"></i>Quick Start</span><small class="text-muted d-block">Complete 5+ courses</small></div>
                        <div class="mb-0"><span class="badge bg-info text-white me-2 mb-2"><i class="fas fa-bolt me-1"></i>Speed Runner</span><small class="text-muted d-block">Complete course in record time</small></div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="/leaderboard" class="btn btn-outline-primary btn-sm text-start"><i class="fas fa-home me-2"></i>Back to Dashboard</a>
                            <a href="#courses" class="btn btn-outline-success btn-sm text-start"><i class="fas fa-book me-2"></i>Start Learning</a>
                            <a href="#roadmaps" class="btn btn-outline-warning btn-sm text-start"><i class="fas fa-road me-2"></i>View Roadmaps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
    </style>
@endsection
