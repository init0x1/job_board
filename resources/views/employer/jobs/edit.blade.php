@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4>Edit Job: {{ $job->title }}</h4>
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

                        <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Job Title -->
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $job->title) }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category and Location -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Location</label>
                                    <select name="location_id" class="form-select @error('location_id') is-invalid @enderror" required>
                                        <option value="">Select Location</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" {{ old('location_id', $job->location_id) == $location->id ? 'selected' : '' }}>
                                                {{ $location->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('location_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Work Type and Application Deadline -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Work Type</label>
                                    <select name="work_type" class="form-select @error('work_type') is-invalid @enderror" required>
                                        <option value="">Select Work Type</option>
                                        <option value="remote" {{ old('work_type', $job->work_type) == 'remote' ? 'selected' : '' }}>Remote</option>
                                        <option value="on-site" {{ old('work_type', $job->work_type) == 'on-site' ? 'selected' : '' }}>On-site</option>
                                        <option value="hybrid" {{ old('work_type', $job->work_type) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    </select>
                                    @error('work_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Application Deadline</label>
                                    <input type="date" name="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror"
                                           value="{{ old('application_deadline', is_string($job->application_deadline) ? $job->application_deadline : $job->application_deadline->format('Y-m-d')) }}" required>
                                    @error('application_deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Salary Range -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Minimum Salary</label>
                                    <input type="number" name="salary_min" class="form-control @error('salary_min') is-invalid @enderror" step="0.01" min="0"
                                           value="{{ old('salary_min', $job->salary_min) }}">
                                    @error('salary_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Maximum Salary</label>
                                    <input type="number" name="salary_max" class="form-control @error('salary_max') is-invalid @enderror" step="0.01" min="0"
                                           value="{{ old('salary_max', $job->salary_max) }}">
                                    @error('salary_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Job Description -->
                            <div class="mb-3">
                                <label class="form-label">Job Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Responsibilities -->
                            <div class="mb-3">
                                <label class="form-label">Responsibilities</label>
                                <textarea name="responsibilities" class="form-control @error('responsibilities') is-invalid @enderror" rows="5">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                                @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Requirements -->
                            <div class="mb-3">
                                <label class="form-label">Requirements</label>
                                <textarea name="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="5">{{ old('requirements', $job->requirements) }}</textarea>
                                @error('requirements')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                                <a href="{{ route('employer.jobs') }}" class="btn btn-secondary mt-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
