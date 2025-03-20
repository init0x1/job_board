@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Employer Dashboard</h3>
        </div>
        <div class="card-body text-center">
            <p>Welcome, {{ Auth::user()->name }}!</p>
            <p>Your email: {{ Auth::user()->email }}</p>
            <a href="{{ route('employer.company') }}" class="btn btn-primary">Manage Company</a>
            <a href="{{ route('employer.jobs.create') }}" class="btn btn-success mt-3">Post a New Job</a>
        </div>
    </div>
</div>
@endsection
