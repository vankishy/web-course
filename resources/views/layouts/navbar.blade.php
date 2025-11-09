<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <!-- Brand logo links to landing page -->
        <a class="navbar-brand" href="{{ route('landing') }}">
            <i class="fas fa-graduation-cap me-2"></i>
            WebCourse
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                <!-- These links only show if user is logged in -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Updated to link to Course Index page -->
                    <a class="nav-link {{ request()->routeIs('course.index') ? 'active' : '' }}"
                        href="{{ route('course.index') }}">
                        <i class="fas fa-book me-1"></i>Courses
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Updated to use route() helper -->
                    <a class="nav-link {{ request()->routeIs('roadmap.index') ? 'active' : '' }}"
                        href="{{ route('roadmap.index') }}">
                        <i class="fas fa-road me-1"></i>Roadmaps
                    </a>
                </li>
                <li class="nav-item">
                    <!-- Updated to use route() helper -->
                    <a class="nav-link {{ request()->routeIs('leaderboard') ? 'active' : '' }}"
                        href="{{ route('leaderboard') }}">
                        <i class="fas fa-trophy me-1"></i>Leaderboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('watchlater.index') ? 'active' : '' }}"
                        href="{{ route('watchlater.index') }}">
                        <i class="fas fa-clock me-1"></i>Watch Later
                    </a>
                </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                <!-- User is logged in, show dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                    class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <!-- User is a guest, show Sign In button -->
                <li class="nav-item">
                    <a class="btn btn-outline-success" href="{{ route('signin') }}">
                        <i class="fas fa-sign-in-alt me-1"></i>Sign In
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>