


@extends("candidates.layouts.app")
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
@section("title")
   Job Board - applications
@endsection
@section("main")
 
<div class="container mt-5" style="margin-top: 120px !important;">
    @if(Auth::check())
        <h2 class="mb-4 text-center">My Job Applications</h2>
        <div class="row">
         
                @foreach($applications as $application)
                    @if($application->user_id == Auth::id())
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $application->job->title }}</h5>
                                    <p class="card-text"><strong>Company:</strong> {{ $application->job->company->name }}</p>
                                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'accepted' ? 'success' : 'danger') }}">{{ ucfirst($application->status) }}</span></p>
                                    <a href="{{ route('candidate.application.show', $application->id) }}" class="btn btn-info btn-sm">View</a>
                                    @if(($application->status == 'pending' && $application->job->application_deadline >= now()))
                                    <a href="{{ route('candidate.application.edit', $application->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('candidate.application.destroy', $application->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($applications->isEmpty())
            <div class="alert alert-info text-center">You have not applied for any jobs yet.</div>
        @endif
        </div>
          @else
                <div class="alert alert-warning text-center">You need to be logged in to view your applications.</div>
            @endif
     
    </div>
@endsection