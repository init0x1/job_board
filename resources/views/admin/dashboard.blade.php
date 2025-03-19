@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- User Statistics -->
        <div class="card shadow-lg p-4 bg-white rounded mb-5">
            <h3 class="text-center mb-4">User Statistics</h3>

            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.list', ['role' => 'all']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Total Users</h5>
                            <p class="display-6 text-primary">{{ $userStats['total'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.list', ['role' => 'employer']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Employers</h5>
                            <p class="display-6 text-success">{{ $userStats['employers'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.list', ['role' => 'candidate']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Candidates</h5>
                            <p class="display-6 text-warning">{{ $userStats['candidates'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.users.list', ['role' => 'admin']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Admins</h5>
                            <p class="display-6 text-danger">{{ $userStats['admins'] }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Job Statistics -->
        <div class="card shadow-lg p-4 bg-white rounded">
            <h3 class="text-center mb-4">Job Statistics</h3>

            <div class="row text-center">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.jobs.list', ['status' => 'all']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Total Jobs</h5>
                            <p class="display-6 text-primary">{{ $jobStats['total'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.jobs.list', ['status' => 'pending']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Pending Jobs</h5>
                            <p class="display-6 text-warning">{{ $jobStats['pending'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.jobs.list', ['status' => 'approved']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Approved Jobs</h5>
                            <p class="display-6 text-success">{{ $jobStats['approved'] }}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('admin.jobs.list', ['status' => 'rejected']) }}" class="text-decoration-none">
                        <div class="card bg-light p-3 h-100">
                            <h5 class="card-title">Rejected Jobs</h5>
                            <p class="display-6 text-danger">{{ $jobStats['rejected'] }}</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
