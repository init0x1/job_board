@extends("candidates.layouts.app")

@section("title")
    WUZZEFNY - Candidates
@endsection


@section('customeCss')
    <style>
        body{
            background-color:rgb(245,247,250)
        }
        #navabr{
            box-shadow:0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19) !important;
            background-color:#fff !important;
        }
        nav.navbar .navbar-brand{
            color :#0055d9 !important;
        }
        .separtor {
            background-color:rgb(131,145,167) !important;
        }
        .navbar .navbar-nav a.nav-link.post-btn{
            background-color :rgb(235, 237, 240);
            color :rgb(131,145,167);
        }
        .navbar .navbar-nav a.nav-link.post-btn span{
            color:rgb(131,145,167) !important;
        }
        .navbar .navbar-nav a.nav-link.login-btn{
            border-color:rgb(131,145,167);

        }
        .navbar .navbar-nav a.nav-link.login-btn:hover{
            background:rgb(230, 239, 255);
        }
        .navbar .navbar-nav a.nav-link.login-btn:focus{
            border-color:rgb(128, 178, 255)
        }
        .navbar .navbar-nav a.nav-link.post-btn svg path{


        }
        .navbar .navbar-toggler i .light{
            display:none !important;
        }
        .navbar .navbar-toggler i .dark{
            display:block !important;

        }

        .navbar .navbar-nav a.nav-link.register-btn{

        }
        footer{
            display:none;
        }

    </style>
@endsection
@section('main')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Profile Picture & Account Settings -->
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img id="profileImage"
                             src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('default-avatar.png') }}"
                             class="rounded-circle img-fluid" width="120" alt="Profile Picture">

                        <form method="POST" action="{{ route('candidate.profile.updateImage') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="profilePictureInput" name="image" class="d-none" accept="image/*"
                                   onchange="previewProfileImage(event)">

                            <button type="button" class="btn btn-success btn-sm mt-2"
                                    onclick="document.getElementById('profilePictureInput').click();">
                                Change Profile Picture
                            </button>

                            <button type="submit" class="btn btn-primary btn-sm mt-2">Save Picture</button>
                        </form>

                        <h5 class="mt-3">{{ Auth::user()->name }}</h5>
                        <h6 class="text-muted">{{ Auth::user()->profile->job_title ?? 'Not Set' }}</h6>

                    </div>
                </div>

                <!-- Account Settings Section -->
                <div class="card mt-3">
                    <div class="card-header bg-light">
                        <h5 class="text-primary">Account Settings</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">

                            <li class="list-group-item"><a href="{{ route('user.job.index') }}" >Jobs </a></li>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Profile Information Form -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header  text-black text-center">
                        <h4>Candidate Profile</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('candidate.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                       value="{{ old('phone_number', optional(Auth::user()->profile)->phone_number) }}">
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{ old('address', optional(Auth::user()->profile)->address) }}">
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="linkedin_url" class="form-label">LinkedIn Profile (Optional)</label>
                                <input type="url" class="form-control" id="linkedin_url" name="linkedin_url"
                                       value="{{ old('linkedin_url', optional(Auth::user()->profile)->linkedin_url) }}">
                                @error('linkedin_url') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Professional Summary</label>
                                <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', optional(Auth::user()->profile)->bio) }}</textarea>
                                @error('bio') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="skills" class="form-label">Skills (Separate with commas)</label>
                                <input type="text" class="form-control" id="skills" name="skills"
                                       value="{{ old('skills', Auth::user()->profile->skills->pluck('name')->implode(', ')) }}" required>
                                @error('skills') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="resume" class="form-label">Resume/CV</label>
                                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">

                                @if(optional(Auth::user()->profile)->resume_path)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . Auth::user()->profile->resume_path) }}" target="_blank" class="btn btn-primary">
                                            <i class="fas fa-file-alt"></i> View Current Resume
                                        </a>
                                    </div>
                                @endif

                                @error('resume') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewProfileImage(event) {
            const image = document.getElementById('profileImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection


@section("customJs")
    <script>
        const navLinks = document.querySelectorAll(".nav-link");
        const navbar = document.getElementById("navbar");

        const postBtn = document.querySelector(
            ".navbar .navbar-nav a.nav-link.post-btn"
        );
        const postBtnspan = document.querySelector(
            ".navbar .navbar-nav a.nav-link.post-btn span"
        );
        const jobsIcon = document.querySelector(
            ".navbar .navbar-nav a.nav-link.post-btn svg path"
        );
        navbar.style.backgroundColor = "#fff";
        navbar.style.border = "1px solid rgba(0, 0, 0, 0.19)";

        if (postBtn && jobsIcon) {
            jobsIcon.setAttribute("fill", "rgb(131,145,167)");
            jobsIcon.fill="rgb(131,145,167)"
        }
        navLinks.forEach((link) => {
            link.style.color = "rgb(64, 86, 120)";
            link.style.textTransform="uppercase"      });
    </script>
@endsection
