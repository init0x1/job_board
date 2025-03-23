    
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

</style>

@endsection
@section("main")

    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($candidates as $candidate)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{ $candidate->image ? asset('storage/' . $candidate->image) : asset('img/candiateds/default.png') }}" alt="{{ $candidate->name }}">
                            </div>
                            <a href="{{ route('user.candidate.show', $candidate->id) }}">
                                <h4>{{ $candidate->name }}</h4>
                            </a>
                            <p>{{ $candidate->profile->job_title ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->
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
            link.style.color = "rgb(131,145,167)";
        });
</script>
@endsection