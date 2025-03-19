@extends('layouts.app')

@section('header')
    <h2 class="font-weight-bold text-dark">Pending Job Listings</h2>
@endsection

@section('content')
    <style>
        .table-container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .table th, .table td {
            white-space: normal;
            overflow: hidden;
            padding: 14px 12px;
            font-size: 16px;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #f8f9fa;
            text-transform: uppercase;
            font-weight: bold;
            text-align: left;
            border: none;
        }

        .table tbody tr {
            background-color: #ffffff;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: background-color 0.3s ease-in-out;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody tr td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .table tbody tr td:last-child {
            border-radius: 0 10px 10px 0;
        }

        /* Buttons Styling */
        .btn {
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s ease-in-out;
            border: none;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            transition: transform 0.2s ease-in-out, background-color 0.3s ease-in-out;
        }

        .btn-approve:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            transition: transform 0.2s ease-in-out, background-color 0.3s ease-in-out;
        }

        .btn-reject:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .badge {
            font-size: 1rem;
            padding: 6px 10px;
            border-radius: 6px;
        }

        /* Improved Badge Colors */
        .badge.bg-primary {
            background-color: #007bff;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table th, .table td {
                font-size: 14px;
                padding: 10px 5px;
                word-break: break-word;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>

    <div class="container py-4">
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0">Pending Job Listings</h5>
            </div>
            <div class="card-body">
                @if ($pendingJobs->isEmpty())
                    <p class="text-center text-muted">No pending job listings found.</p>
                @else
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Work Type</th>
                                    <th>Posted On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingJobs as $job)
                                    <tr>
                                        <td>{{ $job->title }}</td>
                                        <td>{{ $job->company->name }}</td>
                                        <td>{{ $job->location }}</td>
                                        <td>
                                            <span class="badge {{ $job->work_type == 'remote' ? 'bg-primary' : 'bg-secondary' }}">
                                                {{ ucfirst($job->work_type) }}
                                            </span>
                                        </td>
                                        <td>{{ $job->created_at->format('M d, Y') }}</td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <form action="{{ route('admin.jobs.approve', $job->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-approve">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.jobs.reject', $job->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-reject">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $pendingJobs->links('pagination::bootstrap-4') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
