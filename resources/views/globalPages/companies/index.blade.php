    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Companies
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

</style>

@endsection
@section('customeCss')
<style>
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
    <!-- featured_companies_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($companies as $company)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
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
                                <img src="{{ $imageUrl }}" class="rounded mb-3 w-100 h-100">
                            </div>

                            <a href="{{ route('user.company.show', $company) }}">
                                <h4>{{ $company->name }}</h4>
                            </a>
                            <p>{{ $company->description ?? 'No description available' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_companies_area_end  -->
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