@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Employer Dashboard</h1>
    
    <div class="mb-4">
        <a href="{{ route('employer.jobs') }}" class="btn btn-primary">View All Company Jobs</a>
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-success">Create New Job</a>
    </div>

    <h3>Recent Company Job Listings</h3>
    
    @if(!isset($jobs) || $jobs->isEmpty())
        <div class="alert alert-info">Your company hasn't posted any jobs yet.</div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Posted By</th>
                        <th>Posted Date</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ ucfirst($job->status) }}</td>
                            <td>{{ $job->user ? $job->user->name : 'Unknown' }}</td>
                            <td>{{ $job->created_at->format('M d, Y') }}</td>
                            <td>
                                @if(is_string($job->application_deadline))
                                    {{ date('M d, Y', strtotime($job->application_deadline)) }}
                                @else
                                    {{ $job->application_deadline->format('M d, Y') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employer.jobs.show', $job->id) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
