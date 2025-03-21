@extends('candidates.layouts.app')
@section('customeCss')
  <style>
    /* Custom CSS 
     hide footer when show applications and change navbar color
    */
    .header-area {
        background: radial-gradient(black, transparent);
    }
    .footer {
        display: none;
    }
  </style>
@endsection

@section('main')
<div class="container mt-5" style="margin-top: 120px !important;">
    @if(Auth::check() && Auth::user()->id == $application->user_id)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Application Details</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Job Title: {{ $application->job->title }}</h5>
                <p class="card-text"><strong>Company:</strong> {{ $application->job->company->name }}</p>
                <p class="card-text"><strong>Application Date:</strong> {{ $application->created_at->format('d M Y') }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $application->status }}</p>
                <p class="card-text"><strong>Cover Letter:</strong> {{ $application->cover_letter }}</p>
                <a href="{{ route('candidate.application.index') }}" class="btn btn-secondary">Back to Applications</a>
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            You are not authorized to view this application.
        </div>
    @endif
</div>
@endsection
{{--
    make beautiful bootsrap design for thi page that show cingle application data when user is logged and show this applicaton to its user that has user_id of it only

    and show alert message if user is not authorized to view this application
    --}}