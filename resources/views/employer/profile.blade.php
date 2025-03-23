@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Profile Picture & Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="position-relative">
                        <img id="profileImage" 
                             src="{{ $user->image ? asset('storage/' . $user->image) : asset('default-avatar.png') }}" 
                             class="rounded-circle img-fluid border shadow-sm" width="130" alt="Profile Picture">
                        <form method="POST" action="{{ route('employer.profile.updateImage') }}" enctype="multipart/form-data" class="mt-3">
                            @csrf
                            <input type="file" id="profilePictureInput" name="image" class="d-none" accept="image/*" onchange="previewProfileImage(event)">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('profilePictureInput').click();">
                                <i class="bi bi-camera"></i> Change
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </form>
                    </div>
                    <h5 class="mt-3 fw-bold">{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h6 class="text-primary fw-bold mb-0">Account Settings</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="#" class="text-decoration-none d-block">Dashboard</a></li>
                        <li class="list-group-item"><a href="#" class="text-decoration-none d-block">Manage Jobs</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}" class="text-decoration-none d-block text-danger">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Profile Information -->
        <div class="col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="fw-bold mb-0">Employer Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('employer.profile.update') }}" enctype="multipart/form-data">
                        @csrf

                        <h5 class="fw-bold text-primary">Personal Information</h5>
                        <hr>

                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <h5 class="fw-bold text-primary mt-4">Profile Information</h5>
                        <hr>

                        <div class="row">
                            <!-- Job Title -->
                            <div class="col-md-6 mb-3">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $profile->job_title ?? '') }}" required>
                                @error('job_title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 mb-3">
                                <label for="phone_number" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $profile->phone_number ?? '') }}" required>
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $profile->bio ?? '') }}</textarea>
                            @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <h5 class="fw-bold text-primary mt-4">Company Information</h5>
                        <hr>

                        <div class="row">
                            <!-- Company Name -->
                            <div class="col-md-6 mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company->name ?? '') }}" required>
                                @error('company_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Website -->
                            <div class="col-md-6 mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" value="{{ old('website', $company->website ?? '') }}">
                                @error('website') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Company Logo -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            @if ($company->logo_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $company->logo_path) }}" class="rounded shadow-sm" width="100" alt="Company Logo">
                                </div>
                            @endif
                            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success fw-bold"><i class="bi bi-save"></i> Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS: Live Profile Image Preview -->
<script>
    function previewProfileImage(event) {
        const image = document.getElementById('profileImage');
        image.src = URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection
