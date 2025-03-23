
<!-- companies/show.blade.php -->
@extends("candidates.layouts.app")
@section("title")
   Job Board - {{ $company->name }}
@endsection
@section('customeCss')
<style>
    body{
        background-color:rgb(245,247,250)
    }
    .owl-carousel .owl-nav div {
       left: -35px;
    }
    .owl-carousel .owl-nav div.owl-next {
      left: auto;
      right: -35px;
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
    <div class="company_details_area my-10 mt-10" style="padding-top:100px;padding-bottom:100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="company_profile" style="height:85%">
                     <div class="" style="width:90%; height:100%">
                       @php
                            $storagePath = public_path('storage/' . $company->logo_path);
                            $publicPath = public_path( 'img/' . $company->logo_path);
                            if (!empty($company->logo_path) && file_exists($storagePath)) {
                                $imageUrl = asset('storage/' . $company->logo_path);
                            } elseif (!empty($company->logo_path) && file_exists($publicPath)) {
                                $imageUrl = asset( 'img/' .$company->logo_path);
                            }else {
                                $imageUrl =asset('img/' .'company_logos/company_defualt_logo.svg' );
                            }      
                        @endphp
                        <img src="{{ $imageUrl }}" class="img-full w-100 h-100">

                     </div> <h4>{{ $company->name }}</h4>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="company_details h-100">
                       
                        <h4>website</h4>

                        <p>{{ $company->website ?? 'No website provide' }}</p>
                        <h4>description</h4>
                        <p>{{ $company->description ?? 'No description provide' }}</p>
                        <h4>industry</h4>
                        <p>{{ $company->industry ?? 'No industry provide' }}</p>
                        <h4>established_year</h4>
                        <p>{{ $company->established_year ?? 'No established_year provide' }}</p>
                    </div>
                </div>
            </div>
            @php
                $brandsImages = is_array($company->brands_images) ? $company->brands_images : json_decode($company->brands_images, true);
            @endphp

            @if ($brandsImages)
            <div class="row">
                <div class="col-lg-12">
                    <div class="company_active owl-carousel">
                    @foreach($brandsImages as $image)
                    <div class="single_candidates text-center">
                            <div class="thumb">
                            <img class="img-full w-100 h-100" style="    height: 150px !important;" src="{{ $image ? asset('storage/' . $image) : asset('/img/svg_icon/1.svg') }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

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
        // navbar.style.boxShadow =
        //     "0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19)";
    if (postBtn && jobsIcon) {
                jobsIcon.setAttribute("fill", "rgb(131,145,167)"); // Change color when scrolled
                jobsIcon.fill="rgb(131,145,167)"
    }
    navLinks.forEach((link) => {
        link.style.color = "rgb(64, 86, 120)";
        });
</script>
@endsection
