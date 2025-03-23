
@extends('layouts.app')

@section('content')
@include('layouts.employer_navbar') <!-- Include the employer navbar -->

<div class="container py-5">
    <div class="row">
        <!-- Welcome Section -->
        <div class="col-12 text-center mb-4">
            <h1 class="fw-bold text-primary">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="text-muted">Manage your jobs, view applications, and grow your company with Job Board.</p>
        </div>
    </div>

    <div class="row">
        <!-- Quick Actions -->
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-primary">View All Jobs</h5>
                    <p class="text-muted">See all the jobs you’ve posted and manage them easily.</p>
                    <a href="{{ route('employer.dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-briefcase-fill"></i> Go to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-success">Create a New Job</h5>
                    <p class="text-muted">Post a new job to attract top talent for your company.</p>
                    <a href="{{ route('employer.jobs.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle-fill"></i> Create Job
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="fw-bold text-warning">View Applications</h5>
                    <p class="text-muted">Review applications submitted by candidates for your jobs.</p>
                    <a href="{{ route('employer.applications') }}" class="btn btn-warning text-white">
                        <i class="bi bi-file-earmark-text-fill"></i> View Applications
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Job Listings Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="fw-bold text-primary">Recent Job Listings</h3>
            @if($jobs->isEmpty())
                <div class="alert alert-info mt-3">
                    Your company hasn’t posted any jobs yet.
                </div>
            @else
                <div class="list-group mt-3">
                    @foreach($jobs as $job)
                        <a href="{{ route('employer.jobs.show', $job->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">{{ $job->title }}</h5>
                                <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-0 text-muted">{{ Str::limit($job->description, 100) }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection