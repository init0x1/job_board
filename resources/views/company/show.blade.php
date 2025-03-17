@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-dark text-white">
                    <h4>{{ $company->name }}</h4>
                </div>
                <div class="card-body text-center">
                    @if ($company->logo_path)
                        <img src="{{ asset('storage/' . $company->logo_path) }}" class="rounded mb-3" width="150">
                    @endif
                    <p><strong>Industry:</strong> {{ $company->industry }}</p>
                    <p><strong>Established Year:</strong> {{ $company->established_year }}</p>
                    <p><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></p>
                    <p>{{ $company->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
