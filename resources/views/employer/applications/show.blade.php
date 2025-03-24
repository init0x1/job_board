@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a href="{{ route('employer.applications') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Applications
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Application Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h4>{{ $application->job->title }}</h4>
                            <p class="text-muted">Applied on: {{ $application->created_at->format('F d, Y') }}</p>

                            <div class="badge bg-{{ $application->status == 'approved' ? 'success' : ($application->status == 'rejected' ? 'danger' : 'warning') }} mb-3">
                                {{ ucfirst($application->status) }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5>Cover Letter</h5>
                            <div class="p-3 bg-light rounded">
                                {!! nl2br(e($application->cover_letter)) !!}
                            </div>
                        </div>

                        @if($application->resume_path)
                            <div class="mb-4">
                                <h5>Resume</h5>
                                <a href="{{ asset('storage/' . $application->resume_path) }}" class="btn btn-outline-primary" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View Resume
                                </a>
                            </div>
                        @endif

                        @if($application->website)
                            <div class="mb-4">
                                <h5>Website/Portfolio</h5>
                                <a href="{{ $application->website }}" class="btn btn-outline-info" target="_blank">
                                    <i class="fas fa-globe"></i> Visit Website
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('employer.applications.candidate', $application->user_id) }}" class="btn btn-info">
                                <i class="fas fa-user"></i> View Candidate Profile
                            </a>

                            @if($application->status == 'pending')
                                <div>
                                    <form action="{{ route('employer.applications.approve', $application->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('employer.applications.reject', $application->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Candidate Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if($application->user->profile && $application->user->profile->avatar)
                                <img src="{{ asset('storage/' . $application->user->profile->avatar) }}"
                                     class="rounded-circle img-thumbnail"
                                     style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 100px; height: 100px;">
                                    <span class="text-white" style="font-size: 2rem;">{{ substr($application->user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>

                        <h5 class="text-center mb-3">{{ $application->user->name }}</h5>

                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-envelope me-2"></i> Email</span>
                                <span>{{ $application->user->email }}</span>
                            </li>

                            @if($application->user->profile && $application->user->profile->phone_number)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-phone me-2"></i> Phone</span>
                                    <span>{{ $application->user->profile->phone_number }}</span>
                                </li>
                            @endif

                            @if($application->user->profile && $application->user->profile->address)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-map-marker-alt me-2"></i> Location</span>
                                    <span>{{ $application->user->profile->address }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('employer.applications.candidate', $application->user_id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-user"></i> View Full Profile
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Job Details</h5>
                    </div>
                    <div class="card-body">
                        <h5>{{ $application->job->title }}</h5>
                        <p class="text-muted">{{ $application->job->location }}</p>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Work Type</span>
                                <span class="badge bg-info">{{ ucfirst($application->job->work_type) }}</span>
                            </li>

                            @if($application->job->salary_min && $application->job->salary_max)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span>Salary Range</span>
                                    <span>${{ number_format($application->job->salary_min) }} - ${{ number_format($application->job->salary_max) }}</span>
                                </li>
                            @endif

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Deadline</span>
                                <span>{{ \Carbon\Carbon::parse($application->job->application_deadline)->format('M d, Y') }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('employer.jobs.show', $application->job_id) }}" class="btn btn-secondary w-100">
                            <i class="fas fa-briefcase"></i> View Job Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
