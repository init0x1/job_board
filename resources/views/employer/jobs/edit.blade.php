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
                    <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Job Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <select name="location_id" class="form-select" required>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ $job->location_id == $location->id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Work Type</label>
                                <select name="work_type" class="form-select" required>
                                    <option value="remote" {{ $job->work_type == 'remote' ? 'selected' : '' }}>Remote</option>
                                    <option value="on-site" {{ $job->work_type == 'on-site' ? 'selected' : '' }}>On-site</option>
                                    <option value="hybrid" {{ $job->work_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Minimum Salary</label>
                                <input type="number" name="salary_min" class="form-control" value="{{ old('salary_min', $job->salary_min) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Maximum Salary</label>
                                <input type="number" name="salary_max" class="form-control" value="{{ old('salary_max', $job->salary_max) }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Job Description</label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $job->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Responsibilities</label>
                            <textarea name="responsibilities" class="form-control" rows="5" required>{{ old('responsibilities', $job->responsibilities) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Requirements</label>
                            <textarea name="requirements" class="form-control" rows="5" required>{{ old('requirements', $job->requirements) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Application Deadline</label>
                            <input type="date" name="application_deadline" class="form-control" 
                                   value="{{ old('application_deadline', is_string($job->application_deadline) ? $job->application_deadline : $job->application_deadline->format('Y-m-d')) }}" required>
                        </div>

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