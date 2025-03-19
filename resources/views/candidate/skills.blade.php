@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Professional Profile</h4>
                </div>

                <div class="card-body">
                    <p class="mb-3 text-muted text-center">Please provide information about your skills and professional background.</p>

                    <form method="POST" action="{{ route('candidate.skills.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                            @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="linkedin_url" class="form-label">LinkedIn Profile (Optional)</label>
                            <input type="url" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url') }}">
                            @error('linkedin_url') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="resume" class="form-label">Resume/CV (PDF)</label>
                            <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">
                            @error('resume') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="skills" class="form-label">Skills (Separate with commas)</label>
                            <input type="text" class="form-control" id="skills" name="skills" value="{{ old('skills') }}" placeholder="e.g. PHP, Laravel, JavaScript, MySQL" required>
                            @error('skills') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Professional Summary</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4" required>{{ old('bio') }}</textarea>
                            @error('bio') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Complete Registration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection