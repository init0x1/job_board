@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Company Information</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('employer.company') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website</label>
                            <input type="text" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Industry</label>
                            <input type="text" name="industry" class="form-control" value="{{ old('industry', $company->industry ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Established Year</label>
                            <input type="number" name="established_year" class="form-control" value="{{ old('established_year', $company->established_year ?? '') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Description</label>
                            <textarea name="description" class="form-control">{{ old('description', $company->description ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Company Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if ($company->logo_path ?? false)
                                <img src="{{ asset('storage/' . $company->logo_path) }}" class="mt-3 rounded" width="100">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Save Company Info</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
