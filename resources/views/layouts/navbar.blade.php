<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-graduation-cap me-2"></i>
            WebCourse
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="fas fa-home me-1"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#courses">
                        <i class="fas fa-book me-1"></i>Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#roadmaps">
                        <i class="fas fa-road me-1"></i>Roadmaps
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/leaderboard">
                        <i class="fas fa-trophy me-1"></i>Leaderboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#watchlater">
                        <i class="fas fa-clock me-1"></i>Watch Later
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                {{-- PLACEHOLDER VERSION - CURRENTLY ACTIVE --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i> {{ $user->name ?? 'Guest' }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
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
            </ul>
        </div>
    </div>
</nav>
