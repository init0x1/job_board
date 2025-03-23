    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Candidates
@endsection

@section("main")
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
<div class="container mt-5" style="margin-top: 120px !important;">
    @if(Auth::check() && Auth::user()->id == $application->user_id)
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Application Details</h3>
            </div>
            <div class="card-body">
                <h5 class="card-title">Job Title: {{ $application->job->title }}</h5>
                <p class="card-text"><strong>Company:</strong> {{ $application->job->company->name }}</p>
                <p class="card-text"><strong>Application Date:</strong> {{ $application->created_at->format('d M Y') }}</p>
                <p class="card-text"><strong>Status:</strong> {{ $application->status }}</p>
                <p class="card-text"><strong>Cover Letter:</strong> {{ $application->cover_letter }}</p>
                <a href="{{ route('candidate.application.index') }}" class="btn btn-secondary">Back to Applications</a>
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            You are not authorized to view this application.
        </div>
    @endif
</div>
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
        link.style.color = "rgb(64, 86, 120)";        });
</script>
@endsection