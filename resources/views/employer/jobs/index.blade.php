@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Company Job Listings</h1>
    
    <div class="mb-4">
        <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        <a href="{{ route('employer.jobs.create') }}" class="btn btn-primary">Create New Job</a>
        <div class="mb-4">
            <form action="{{ route('employer.jobs') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search jobs..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>
    @if($jobs->isEmpty())
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
                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $jobs->links() }}
        </div>
    @endif
</div>
@endsection