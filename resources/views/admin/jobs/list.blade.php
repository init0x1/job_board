@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">{{ ucfirst($status) }} Jobs</h3>

        <!-- Search and Filters -->
        <div class="card shadow-lg p-4 bg-white rounded mb-4">
            <form action="{{ route('admin.jobs.list', ['status' => $status]) }}" method="GET">
                <div class="row g-3">
                    <!-- Search by Title -->
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Search by job title" value="{{ request('search') }}">
                    </div>

                    <!-- Filter by Work Type -->
                    <div class="col-md-3">
                        <select name="work_type" class="form-control">
                            <option value="">All Work Types</option>
                            <option value="remote" {{ request('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            <option value="on-site" {{ request('work_type') == 'on-site' ? 'selected' : '' }}>On-site</option>
                            <option value="hybrid" {{ request('work_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>

                    <!-- Filter by Location -->
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control" placeholder="Filter by location" value="{{ request('location') }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Job List -->
        <div class="card shadow-lg p-4 bg-white rounded">
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Location</th>
                    <th>Work Type</th>
                    @if ($status === 'approved') <!-- Show Applications column only for approved jobs -->
                    <th>Applications</th>
                    @endif
                    <th>Posted On</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->company->name }}</td>
                        <td>{{ $job->location }}</td>
                        <td>
                <span class="badge {{ $job->work_type == 'remote' ? 'bg-primary' : ($job->work_type == 'on-site' ? 'bg-secondary' : 'bg-info') }}">
                    {{ ucfirst($job->work_type) }}
                </span>
                        </td>
                        @if ($status === 'all') <!-- Show status badge only when listing all jobs -->
                        <td>
                    <span class="badge
                        @if ($job->status === 'pending') bg-warning
                        @elseif ($job->status === 'approved') bg-success
                        @elseif ($job->status === 'rejected') bg-danger
                        @endif">
                        {{ ucfirst($job->status) }}
                    </span>
                        </td>
                        @endif
                        @if ($status === 'approved') <!-- Show Applications count only for approved jobs -->
                        <td>{{ $job->applications_count }}</td>
                        @endif
                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $status === 'all' ? 8 : ($status === 'approved' ? 7 : 6) }}" class="text-center">No jobs found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-4 d-flex justify-content-center">
                {{ $jobs->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection
