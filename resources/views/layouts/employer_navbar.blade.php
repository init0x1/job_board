<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-0">
    <div class="container-fluid">
        <!-- Brand Name -->
        <a class="navbar-brand fw-bold text-primary" href="{{ route('employer.dashboard') }}">
            <i class="bi bi-briefcase-fill"></i> Job Board
        </a>

        <!-- Toggle Button for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <!-- Home Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ route('employer.home') }}">
                        <i class="bi bi-house-door-fill"></i> Home
                    </a>
                </li>

                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('employer/dashboard') ? 'active' : '' }}" href="{{ route('employer.dashboard') }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>

                <!-- Create a New Job Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('employer/jobs/create') ? 'active' : '' }}" href="{{ route('employer.jobs.create') }}">
                        <i class="bi bi-plus-circle-fill"></i> Create a New Job
                    </a>
                </li>

                <!-- View Applications Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('employer/applications') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text-fill"></i> View Applications
                    </a>
                </li>

                <!-- Company Profile Link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('employer/company') ? 'active' : '' }}" href="{{ route('employer.company') }}">
                        <i class="bi bi-building"></i> Company Profile
                    </a>
                </li>
            </ul>

            <!-- User Profile Dropdown -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('default-avatar.png') }}" 
                             class="rounded-circle me-2" width="40" height="40" alt="User Image">
                        <span class="fw-bold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- Profile Link -->
                        <li>
                            <a class="dropdown-item" href="{{ route('employer.profile') }}">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <!-- Logout Link -->
                        <li>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Custom Styles for Navbar -->
<style>
    .navbar {
        margin-bottom: 0; /* Remove space below the navbar */
        background-color: #ffffff; /* White background for navbar */
        border-bottom: 1px solid #e9ecef; /* Subtle border for separation */
        padding: 0.8rem 2rem; /* Adjust padding for a compact look */
    }

    .navbar-brand {
        font-size: 1.8rem; /* Larger font size for brand */
        font-weight: bold;
        color: #0d6efd; /* Primary color for brand */
    }

    .navbar-brand:hover {
        color: #084298; /* Darker shade on hover */
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem; /* Slightly larger font size for links */
        font-weight: 500;
        color: #6c757d; /* Default text color */
        transition: color 0.3s ease;
        padding: 0.8rem 1rem; /* Increased padding for better spacing */
    }

    .navbar-nav .nav-link:hover {
        color: #0d6efd; /* Hover color */
    }

    .navbar-nav .nav-link.active {
        color: #0d6efd !important; /* Active link color */
        font-weight: bold;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        font-size: 1rem; /* Slightly larger font size for dropdown items */
        font-weight: 500;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .dropdown-item.text-danger:hover {
        background-color: #f8d7da;
        color: #dc3545;
    }

    .rounded-circle {
        border: 2px solid #e9ecef; /* Light border around profile image */
    }
</style>