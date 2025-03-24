    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Categories
@endsection
@section('customeCss')
<style>
    body{
        background-color:rgb(245,247,250);
        font-family: "Open Sans", sans-serif !important;
    }
    #navbar{
        background-color:#fff !important;
        height:unset;
        
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


    <!-- featured_categories_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
                            @php
                            $storagePath = public_path('storage/' . $category->image);
                            $publicPath = public_path( 'img/' . $category->image);
                            if (!empty($category->image) && file_exists($storagePath)) {
                                $imageUrl = asset('storage/' . $category->image);
                            } elseif (!empty($category->image) && file_exists($publicPath)) {
                                $imageUrl = asset( 'img/' .$category->image);
                            }else {
                                $imageUrl =asset('img/category/It_and_software.webp' );
                            }      
                        @endphp
                        <img src="{{ $imageUrl }}" class="img-full w-100 h-100" alt="{{ $category->name }}">
                            </div>
                            {{-- when press on single categories show jobs page with filter that where show jobs that belongs only to this category --}}
                            <a href="{{ route('user.job.index', ['category' => $category->id]) }}">
                                <h4>{{ $category->name }}</h4>
                            </a>

                            
                            <p>{{ $category->profile->bio ?? 'No bio available' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_categories_area_end  -->
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