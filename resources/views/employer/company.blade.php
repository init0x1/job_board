@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-black p-4 border-0">
                    <h3 class="mb-0 fw-bold text-center">Company Profile</h3>
                </div>
                <div class="card-body p-4">
                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Please correct the following errors:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employer.company') }}" enctype="multipart/form-data" class="needs-validation">
                        @csrf

                        <div class="row g-4">
                            {{-- Company Logo --}}
                            <div class="col-12 text-center mb-3">
                                <div class="mb-3">
                                    @if ($company->logo_path ?? false)
                                        <img src="{{ asset('storage/' . $company->logo_path) }}" class="img-thumbnail rounded-circle mb-3" width="120" height="120" alt="Company Logo">
                                    @else
                                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px;">
                                            <i class="bi bi-building fs-1 text-secondary"></i>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        <div class="btn btn-primary btn-sm position-relative overflow-hidden">
                                            <i class="bi bi-upload me-2"></i>Upload Logo
                                            <input type="file" name="logo" class="position-absolute top-0 start-0 opacity-0 w-100 h-100 cursor-pointer">
                                        </div>
                                    </div>
                                    @error('logo')
                                        <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Company Name --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           id="companyName" placeholder="Company Name"
                                           value="{{ old('name', $company->name ?? '') }}" required>
                                    <label for="companyName">Company Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Website --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="website" class="form-control @error('website') is-invalid @enderror"
                                           id="website" placeholder="Website"
                                           value="{{ old('website', $company->website ?? '') }}">
                                    <label for="website">Website</label>
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Industry --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="industry" class="form-control @error('industry') is-invalid @enderror" 
                                           id="industry" placeholder="Industry"
                                           value="{{ old('industry', $company->industry ?? '') }}">
                                    <label for="industry">Industry</label>
                                    @error('industry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Established Year --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="number" name="established_year" class="form-control @error('established_year') is-invalid @enderror" 
                                           id="establishedYear" placeholder="Established Year"
                                           value="{{ old('established_year', $company->established_year ?? '') }}">
                                    <label for="establishedYear">Established Year</label>
                                    @error('established_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Company Description --}}
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                              id="description" placeholder="Company Description" style="height: 120px">{{ old('description', $company->description ?? '') }}</textarea>
                                    <label for="description">Company Description</label>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Brand Images --}}
                            <div class="col-12">
                                <label for="brands_images" class="form-label">Brand Images</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="bi bi-images"></i></span>
                                    <input type="file" class="form-control @error('brands_images.*') is-invalid @enderror" 
                                           id="brands_images" name="brands_images[]" multiple>
                                    @error('brands_images.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($company->brands_images ?? false)
                                    <div class="row g-2 mt-2">
                                        @foreach (json_decode($company->brands_images) as $image)
                                            <div class="col-md-3 col-6">
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail" alt="Brand Image">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Job Title --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="job_title" class="form-control @error('job_title') is-invalid @enderror" 
                                           id="jobTitle" placeholder="Job Title"
                                           value="{{ old('job_title', $profile->job_title ?? '') }}" required>
                                    <label for="jobTitle">Job Title</label>
                                    @error('job_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone Number --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" 
                                           id="phoneNumber" placeholder="Phone Number"
                                           value="{{ old('phone_number', $profile->phone_number ?? '') }}" required>
                                    <label for="phoneNumber">Phone Number</label>
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" placeholder="Bio" style="height: 120px">{{ old('bio', $profile->bio ?? '') }}</textarea>
                                    <label for="bio">Bio</label>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-save me-2"></i>Save Company Information
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection