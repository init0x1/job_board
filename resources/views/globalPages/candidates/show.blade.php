
<!-- candidates/show.blade.php -->
@extends("candidates.layouts.app")

@section("title")
   Job Board - {{ $candidate->name }}
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

    .navbar .navbar-nav .nav-item{
      padding:  0 14px;
    }
    .navbar .navbar-nav .nav-link {
        padding: 0.25rem 0;
        text-transform:upperCase;
        position: relative;
        transition: color 0.3s ease-in-out;
    }

    .navbar .navbar-nav .nav-link.active, 
    .navbar .navbar-nav .nav-link:hover {
        color: #0055d9 !important; 
    }

    .navbar .navbar-nav .nav-link.active::after {
        content: "";
        width: 100%;
        height: 2px;
        background-color: #0055d9        ; 
        position: absolute;
        bottom: -3px;
        left: 0;
    }
</style>

@endsection
@section("main")


    <div class="candidate_details_area my-10 " style="padding-top:30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="candidate_profile" style="height:85%">
                     <div class="" style="width:90%; height:100%">
                        <img class="img-full w-100 h-100" src="{{ $candidate->image ? asset('storage/' . $candidate->image) : asset('img/candiateds/default.png') }}" alt="{{ $candidate->name }}">
                       </div> <h4>{{ $candidate->name }}</h4>
                        <p>{{ $candidate->profile->job_title ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="candidate_details h-100">
                        <h4>Contact Information</h4>
                        <p>Email: {{ $candidate->email }}</p>
                        <p>Phone: {{ $candidate->profile->phone_number ?? 'N/A' }}</p>
                        <p>LinkedIn: <a href="{{ $candidate->profile->linkedin_url }}" target="_blank">{{ $candidate->profile->linkedin_url }}</a></p>
                        <h4>Skills</h4>
                        <p>{{ $candidate->profile->skills ?? 'No skills listed' }}</p>
                        <h4>Certifications</h4>
                        <p>{{ $candidate->profile->certifications ?? 'No Certification listed' }}</p>
                        <h4>Experience</h4>
                        <p>{{ $candidate->profile->experiences ?? 'No experience listed' }}</p>
                    </div>
                </div>
            </div>
        </div>
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
        jobsIcon.setAttribute("fill", "rgb(131,145,167)"); // Change color when scrolled
        jobsIcon.fill="rgb(131,145,167)"
    }
    navLinks.forEach((link) => {
        link.style.color = "rgb(64, 86, 120)"; 
    });
    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add("active");
        }
    });
</script>
@endsection