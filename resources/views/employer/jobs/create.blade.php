@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4>Post a New Job</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employer.jobs.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Requirements</label>
                            <textarea name="requirements" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <select name="location_id" class="form-select" required>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Work Type</label>
                                <select name="work_type" class="form-select" required>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="onsite">On-site</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Application Deadline</label>
                                <input type="date" name="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                @error('application_deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Minimum Salary</label>
                                <input type="number" name="salary_min" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maximum Salary</label>
                                <input type="number" name="salary_max" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Post Job</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection