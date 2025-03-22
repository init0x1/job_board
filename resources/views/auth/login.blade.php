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
                            <h2 class="fw-bold mb-4">Welcome Back!</h2>
                            <p class="lead mb-4">Sign in to access your account and continue your job search journey.</p>
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-briefcase-fill me-3 fs-5"></i>
                                    <span>Browse the latest job opportunities</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-bell-fill me-3 fs-5"></i>
                                    <span>Get personalized job alerts</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-chat-dots-fill me-3 fs-5"></i>
                                    <span>Connect with employers directly</span>
                                </div>
                            </div>
                            <p class="mt-4">Don't have an account? <a href="{{ route('register') }}" class="text-white fw-bold">Sign up now</a></p>
                        </div>
                    </div>
                    
                    <!-- Right Column - Login Form -->
                    <div class="col-md-7">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h3 class="fw-bold">Sign In</h3>
                                <p class="text-muted">Enter your credentials to access your account</p>
                            </div>
                            
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-4">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Enter your password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-4 form-check">
                                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold mb-3">Sign In</button>
                                
                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
                                    </div>
                                @endif
                            </form>
                            
                            <div class="text-center mt-4">
                                <p class="text-muted">Or sign in with</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="#" class="btn btn-outline-secondary rounded-circle p-2">
                                        <i class="bi bi-google"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary rounded-circle p-2">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-secondary rounded-circle p-2">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                </div>
                            </div>
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
    
    .btn-outline-secondary {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection
