

    
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
@section("title")
   Job Board - applications
@endsection
@section("main")
 
<div class="container mt-5" style="margin-top: 120px !important;">
    @if(Auth::check())
        <h2 class="mb-4 text-center">My Job Applications</h2>
        <div class="row">
         
                @foreach($applications as $application)
                    @if($application->user_id == Auth::id())
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $application->job->title }}</h5>
                                    <p class="card-text"><strong>Company:</strong> {{ $application->job->company->name }}</p>
                                    <p class="card-text"><strong>Status:</strong> <span class="badge bg-{{ $application->status == 'pending' ? 'warning' : ($application->status == 'accepted' ? 'success' : 'danger') }}">{{ ucfirst($application->status) }}</span></p>
                                    <a href="{{ route('candidate.application.show', $application->id) }}" class="btn btn-info btn-sm">View</a>
                                    @if(($application->status == 'pending' && $application->job->application_deadline >= now()))
                                    <a href="{{ route('candidate.application.edit', $application->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($applications->isEmpty())
            <div class="alert alert-info text-center">You have not applied for any jobs yet.</div>
        @endif
        </div>
          @else
                <div class="alert alert-warning text-center">You need to be logged in to view your applications.</div>
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
        // navbar.style.boxShadow =
        //     "0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19)";
    if (postBtn && jobsIcon) {
                jobsIcon.setAttribute("fill", "rgb(131,145,167)"); // Change color when scrolled
                jobsIcon.fill="rgb(131,145,167)"
    }
    navLinks.forEach((link) => {
        link.style.color = "rgb(64, 86, 120)";        });
</script>
@endsection