@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<div class="hero-section bg-light">
    <div class="container-fluid px-0">
        <div class="row align-items-center g-0">
            <!-- Left Content -->
            <div class="col-md-6 text-center text-md-start p-5">
                <h1 class="fw-bold display-4 text-primary">Welcome, {{ Auth::user()->name }}!</h1>
                <h2 class="fw-bold text-primary mt-4">The Best Platform to Manage Your Jobs</h2>
                <p class="lead text-muted">Manage your jobs, view applications, and grow your company with Job Board.</p>
                <p class="text-muted">"Our mission is to help employers find the best talent and grow their businesses with ease."</p>
                <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="bi bi-plus-circle-fill"></i> Post a Job
                </a>
            </div>

            <!-- Right Image -->
            <div class="col-md-6 text-center">
                <img src="https://www.iseazy.com/wp-content/uploads/2023/09/banner-girl.png" alt="Hero Image" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="container py-5">
    <h3 class="fw-bold text-primary text-center mb-5">Quick Actions</h3>
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 quick-action-card">
                <div class="card-body">
                    <h5 class="fw-bold text-primary">View All Jobs</h5>
                    <p class="text-muted">See all the jobs you’ve posted and manage them easily.</p>
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-briefcase-fill"></i> Go to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 quick-action-card">
                <div class="card-body">
                    <h5 class="fw-bold text-success">Create a New Job</h5>
                    <p class="text-muted">Post a new job to attract top talent for your company.</p>
                    <a href="{{ route('employer.jobs.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle-fill"></i> Create Job
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100 quick-action-card">
                <div class="card-body">
                    <h5 class="fw-bold text-warning">View Applications</h5>
                    <p class="text-muted">Review applications submitted by candidates for your jobs.</p>
                    <a href="#" class="btn btn-warning text-white">
                        <i class="bi bi-file-earmark-text-fill"></i> View Applications
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Job Listings Section -->
<div class="container py-5">
    <h3 class="fw-bold text-primary text-center mb-4">Recent Job Listings</h3>
    @if($jobs->isEmpty())
        <div class="alert alert-info text-center">
            Your company hasn’t posted any jobs yet.
        </div>
    @else
        <ul class="list-group">
            @foreach($jobs as $job)
                <li class="list-group-item d-flex justify-content-between align-items-center bg-light text-dark">
                    <div>
                        <h5 class="fw-bold mb-1">
                            <a href="{{ route('employer.jobs.show', $job->id) }}" class="text-dark text-decoration-none">
                                {{ $job->title }}
                            </a>
                        </h5>
                        <p class="text-muted mb-0">{{ Str::limit($job->description, 100) }}</p>
                    </div>
                    <a href="{{ route('employer.jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm">
                        View Job
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<!-- About Us Section -->
<div class="container py-5">
    <div class="row align-items-center">
        <!-- Left Image -->
        <div class="col-md-6 text-center">
            <img src="https://fiverr-res.cloudinary.com/images/t_main1,q_auto,f_auto,q_auto,f_auto/gigs2/355350646/original/6c5d5b4850c10de2990daf7f962775119a6ca97f/set-client-appointment-reservation-and-booking.png" alt="About Us Image" class="img-fluid rounded">
        </div>

        <!-- Right Content -->
        <div class="col-md-6">
            <h3 class="fw-bold text-primary mb-4">About Us</h3>
            <p class="text-muted">
                At Job Board, we are dedicated to connecting employers with the best talent in the industry. Our platform is designed to simplify the hiring process, making it easier for companies to find the right candidates and for job seekers to discover their dream jobs.
            </p>
            <p class="text-muted">
                With a focus on innovation and user experience, we provide tools that empower businesses to grow and succeed. Whether you're posting jobs, reviewing applications, or managing your hiring pipeline, Job Board is here to support you every step of the way.
            </p>
            <a href="#" class="btn btn-outline-primary btn-lg mt-3">
                Learn More
            </a>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .hero-section {
        margin-top: -3rem;
        padding-top: 0;
    }

    .hero-section img {
        height: auto;
        object-fit: cover;
    }

    .hero-section .p-5 {
        padding: 3rem;
    }

    .card {
        border-radius: 0.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card.quick-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
    }

    .btn {
        font-size: 0.9rem;
        font-weight: 600;
    }

    .alert {
        border-radius: 0.5rem;
    }

    .container h3 {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem 1rem;
        background-color: #f8f9fa;
        color: #343a40;
    }

    .list-group-item:last-child {
        border-bottom: none;
    }

    .list-group-item h5 {
        font-size: 1.2rem;
    }

    .list-group-item p {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .list-group-item a.text-dark:hover {
        text-decoration: underline;
    }
</style>
@endsection