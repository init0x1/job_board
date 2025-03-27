@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <!-- Candidate Profile Card -->
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if($candidate->image)
                            <img src="{{ asset('storage/' . $candidate->image) }}"
                                 alt="Profile Image"
                                 class="rounded-circle mb-3"
                                 width="150" height="150">
                        @else
                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mb-3"
                                 style="width: 150px; height: 150px; margin: 0 auto;">
                                <span class="text-white display-4">{{ strtoupper(substr($candidate->name, 0, 1)) }}</span>
                            </div>
                        @endif

                        <h3 class="card-title">{{ $candidate->name }}</h3>
                        <h5 class="text-muted">{{ $profile->job_title ?? 'No job title specified' }}</h5>

                        <div class="d-flex justify-content-center mt-3">
                            @if($profile->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank" class="btn btn-outline-primary mx-1">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="bi bi-envelope me-2"></i> {{ $candidate->email }}
                        </li>
                        @if($profile->phone_number)
                            <li class="list-group-item">
                                <i class="bi bi-telephone me-2"></i> {{ $profile->phone_number }}
                            </li>
                        @endif
                        @if($profile->address)
                            <li class="list-group-item">
                                <i class="bi bi-geo-alt me-2"></i> {{ $profile->address }}
                            </li>
                        @endif
                    </ul>

                    @if($profile->resume_path)
                        <div class="card-body">
                            <a href="{{ asset('storage/' . $profile->resume_path) }}"
                               target="_blank"
                               class="btn btn-primary w-100">
                                <i class="bi bi-download me-2"></i> Download Resume
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <!-- About Section -->
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h4 class="mb-0">About</h4>
                    </div>
                    <div class="card-body">
                        @if($profile->bio)
                            <p class="card-text">{{ $profile->bio }}</p>
                        @else
                            <p class="text-muted">No bio provided</p>
                        @endif
                    </div>
                </div>

                <!-- Experience Section -->
                @if(count($experiences) > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h4 class="mb-0">Experience</h4>
                        </div>
                        <div class="card-body">
                            @foreach($experiences as $experience)
                                <div class="mb-3">
                                    <h5>{{ $experience->title ?? '' }}</h5>
                                    <h6 class="text-muted">{{ $experience->company ?? '' }}</h6>
                                    <small class="text-muted">
                                        {{ $experience->start_date ?? '' }} - {{ $experience->end_date ?? 'Present' }}
                                    </small>
                                    @if(isset($experience->description))
                                        <p class="mt-2">{{ $experience->description }}</p>
                                    @endif
                                </div>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Certifications Section -->
                @if(count($certifications) > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-white">
                            <h4 class="mb-0">Certifications</h4>
                        </div>
                        <div class="card-body">
                            @foreach($certifications as $certification)
                                <div class="mb-3">
                                    <h5>{{ $certification->name ?? '' }}</h5>
                                    <h6 class="text-muted">{{ $certification->issuing_organization ?? '' }}</h6>
                                    <small class="text-muted">
                                        {{ $certification->issue_date ?? '' }}
                                        @if(isset($certification->expiration_date))
                                            - {{ $certification->expiration_date }}
                                        @endif
                                    </small>
                                </div>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
