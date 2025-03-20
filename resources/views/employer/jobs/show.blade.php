@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Job Details</h1>
    
    <div class="mb-4">
        <a href="{{ route('employer.jobs') }}" class="btn btn-secondary">Back to Jobs</a>
    </div>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ $job->title }}</h3>
            <span class="badge {{ $job->status == 'approved' ? 'bg-success' : ($job->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                {{ ucfirst($job->status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Location:</strong> {{ $job->location }}</p>
                    <p><strong>Work Type:</strong> {{ $job->work_type }}</p>
                    <p><strong>Salary Range:</strong> ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Posted:</strong> {{ $job->created_at->format('M d, Y') }}</p>
                    <p><strong>Deadline:</strong> 
                        @if(is_string($job->application_deadline))
                            {{ date('M d, Y', strtotime($job->application_deadline)) }}
                        @else
                            {{ $job->application_deadline->format('M d, Y') }}
                        @endif
                    </p>
                </div>
            </div>
            
            <h4>Description</h4>
            <div class="mb-4">
                {!! nl2br(e($job->description)) !!}
            </div>
            
            @if($job->responsibilities)
            <h4>Responsibilities</h4>
            <div class="mb-4">
                {!! nl2br(e($job->responsibilities)) !!}
            </div>
            @endif
            
            @if($job->requirements)
            <h4>Requirements</h4>
            <div class="mb-4">
                {!! nl2br(e($job->requirements)) !!}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection