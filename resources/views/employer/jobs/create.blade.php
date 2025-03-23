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

                            <!-- Job Title -->
                            <div class="mb-3">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Job Description -->
                            <div class="mb-3">
                                <label class="form-label">Job Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Responsibilities -->
                            <div class="mb-3">
                                <label class="form-label">Responsibilities</label>
                                <textarea name="responsibilities" class="form-control @error('responsibilities') is-invalid @enderror" rows="3">{{ old('responsibilities') }}</textarea>
                                @error('responsibilities')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Requirements -->
                            <div class="mb-3">
                                <label class="form-label">Requirements</label>
                                <textarea name="requirements" class="form-control @error('requirements') is-invalid @enderror" rows="3">{{ old('requirements') }}</textarea>
                                @error('requirements')
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
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
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
                                            <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
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
                                        <option value="remote" {{ old('work_type') == 'remote' ? 'selected' : '' }}>Remote</option>
                                        <option value="hybrid" {{ old('work_type') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                        <option value="onsite" {{ old('work_type') == 'onsite' ? 'selected' : '' }}>On-site</option>
                                    </select>
                                    @error('work_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Application Deadline</label>
                                    <input type="date" name="application_deadline" class="form-control @error('application_deadline') is-invalid @enderror" min="{{ date('Y-m-d', strtotime('+1 day')) }}" value="{{ old('application_deadline') }}">
                                    @error('application_deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Salary Range -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Minimum Salary</label>
                                    <input type="number" name="salary_min" class="form-control @error('salary_min') is-invalid @enderror" step="0.01" min="0" value="{{ old('salary_min') }}">
                                    @error('salary_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Maximum Salary</label>
                                    <input type="number" name="salary_max" class="form-control @error('salary_max') is-invalid @enderror" step="0.01" min="0" value="{{ old('salary_max') }}">
                                    @error('salary_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Post Job</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
