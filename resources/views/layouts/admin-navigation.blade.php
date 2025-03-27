<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-top" width="30" height="30" />
        </a>

        <!-- Hamburger Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navigation Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>

                <!-- Jobs Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/jobs*') ? 'active' : '' }}"
                       href="#" id="jobsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Jobs') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="jobsDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/jobs/all') ? 'active' : '' }}"
                               href="{{ url('/admin/jobs/all') }}">
                                All Jobs
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/jobs/approved') ? 'active' : '' }}"
                               href="{{ url('/admin/jobs/approved') }}">
                                Approved Jobs
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item {{ request()->is('admin/jobs/pending') ? 'active' : '' }}"
                               href="{{ url('/admin/jobs/pending') }}">
                                Pending Jobs
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/jobs/rejected') ? 'active' : '' }}"
                               href="{{ url('/admin/jobs/rejected') }}">
                                rejected Jobs
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/categories*') ? 'active' : '' }}"
                       href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Categories') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/categories') ? 'active' : '' }}"
                               href="{{ url('/admin/categories') }}">
                                All Categories
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/categories/create') ? 'active' : '' }}"
                               href="{{ url('/admin/categories/create') }}">
                                Create New Category
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('admin/users*') ? 'active' : '' }}"
                       href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Users') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/users/all') ? 'active' : '' }}"
                               href="{{ url('/admin/users/all') }}">
                                All Users
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/users/candidate') ? 'active' : '' }}"
                               href="{{ url('/admin/users/candidate') }}">
                                Candidates
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/users/employer') ? 'active' : '' }}"
                               href="{{ url('/admin/users/employer') }}">
                                Employers
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->is('admin/users/admin') ? 'active' : '' }}"
                               href="{{ url('/admin/users/admin') }}">
                                Admins
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- User Dropdown -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                <i class="bi bi-person me-2"></i>{{ __('Profile') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
