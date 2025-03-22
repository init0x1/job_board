@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    <!-- Left Column - Welcome Section -->
                    <div class="col-md-5 bg-primary text-white d-flex flex-column justify-content-center p-5">
                        <div class="welcome-content">
                            <h2 class="fw-bold mb-4">Welcome to Our Job Board</h2>
                            <p class="lead mb-4">Join thousands of professionals finding their dream careers and opportunities.</p>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                    <span>Access to thousands of job listings</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                    <span>Connect with top employers</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                                    <span>Build your professional profile</span>
                                </div>
                            </div>
                            <p class="mt-4">Already have an account? <a href="{{ route('login') }}" class="text-white fw-bold">Sign in</a></p>
                        </div>
                    </div>
                    
                    <!-- Right Column - Registration Form -->
                    <div class="col-md-7">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">Create Your Account</h3>
                                <p class="text-muted">Fill in your details to get started</p>
                            </div>
                            
                            {{-- Display Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Enter your full name">
                                    </div>
                                    @error('name')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Create a password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirm your password">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Profile Image</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-image"></i></span>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                    </div>
                                    <div class="form-text">Optional: Upload a profile picture (JPG, PNG, max 2MB)</div>
                                    @error('image')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Create Account</button>
                                
                                <div class="text-center mt-4">
                                    <p class="text-muted">By registering, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-content {
        max-width: 400px;
    }
    
    .input-group-text {
        background-color: transparent;
        border-right: none;
    }
    
    .form-control {
        border-left: none;
    }
    
    .input-group:focus-within {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #86b7fe;
    }
</style>
@endsection
