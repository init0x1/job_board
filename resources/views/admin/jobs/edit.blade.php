@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Edit Job: {{ $job->title }}</h3>

        <div class="card shadow-lg p-4 bg-white rounded">
            <!-- Job Details -->
            <div class="mb-4">
                <h5>Job Details</h5>
                <p><strong>Title:</strong> {{ $job->title }}</p>
                <p><strong>Company:</strong> {{ $job->company->name }}</p>
                <p><strong>Status:</strong>
                    <span class="badge
                        @if ($job->status === 'pending') bg-warning
                        @elseif ($job->status === 'approved') bg-success
                        @elseif ($job->status === 'rejected') bg-danger
                        @endif">
                        {{ ucfirst($job->status) }}
                    </span>
                </p>
                <p><strong>Description:</strong> {{ $job->description }}</p>
                <p><strong>Location:</strong> {{ $job->location }}</p>
                <p><strong>Work Type:</strong>
                    <span class="badge {{ $job->work_type == 'remote' ? 'bg-primary' : 'bg-secondary' }}">
                        {{ ucfirst($job->work_type) }}
                    </span>
                </p>
                <p><strong>Posted On:</strong> {{ $job->created_at->format('M d, Y') }}</p>
                @if ($job->status === 'approved') <!-- Show Applications count only for approved jobs -->
                <p><strong>Applications:</strong> {{ $job->applications_count }}</p>
                @endif
            </div>

            <!-- Accept/Reject Job Forms -->
            <div class="mb-4">
                <h5>Change Job Status</h5>
                <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm"
                            @if ($job->status === 'approved') disabled @endif>
                        <i class="fas fa-check"></i> Approve Job
                    </button>
                </form>

                <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm"
                            @if ($job->status === 'rejected') disabled @endif>
                        <i class="fas fa-times"></i> Reject Job
                    </button>
                </form>
            </div>

            <!-- Delete Job Form -->
            <div class="mb-4">
                <h5>Delete Job</h5>
                <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this job?')">
                        <i class="fas fa-trash"></i> Delete Job
                    </button>
                </form>
            </div>

            <!-- Back to Job List -->
            <div class="text-end">
                <a href="{{ route('admin.jobs.list', ['status' => 'all']) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Job List
                </a>
            </div>
        </div>
    </div>
@endsection
