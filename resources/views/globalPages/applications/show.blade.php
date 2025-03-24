    
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
   Job Board - application Form
@endsection
@section("main")
@if(Auth::check() && Auth::user()->id == $application->user_id)
    @if(isset($job) && $job )
        <div class="job_details_area" style="margin-top: 140px !important;">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="apply_job_form white-bg  p-0 rounded-md" style="padding-top: 50px;
                        margin: 0px auto 40px;
                        width: 640px;    border: 1px solid rgb(217, 221, 228);
                        border-radius: 4px; ">
                        @if (session('success'))
                          <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                           <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif

                        @if(Auth::check() && $application->user_id == Auth::id())
                        <h4  style="padding:10px 5px; width:100%; background: rgb(0, 30, 76); color:white;  
                          border-radius: 5px 5px 0 0; padding-left:5px;">Review Application </h4>  
                        <form  style="padding:10px 20px; "  method="POST" action="{{ route('candidate.application.update', ['id' => $application->id]) }}"
                            enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-8 name-desc">
                                           <p style=" font-size:24px;line-height:34px; color:rgb(0,20,51); font-weight:600"><span class="name">Front-End Developer (Next.js)</span> - <span class="type">Remote</span></p>                                       
                                    </div>
                                    <div class="col-md-4">
                                       <div class="img " style="width:100px;height:50px">
                                            <img src="{{asset('/img/company_logos/axios.png')}}" class="w-100 h-100" alt="">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="font-style:normal; font-weight:400; color:rgb(77, 97, 130); line-height:20px; font-size:13px">

                                            The hiring team at Guestna requires you to answer the below questions.
                                            </p>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <input type="text" placeholder="Website/Portfolio link" 
                                            value="{{ old('website', $application->website ?? '') }}"
                                            name="website"
                                            readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="resume" class="form-label">Resume/CV</label>
                                            <a
                                                href="{{ asset('storage/' . $application->resume_path?? '') }}" 
                                                target="_blank" class="text-info text-decoration-underline"
                                                style="text-decoration-line: underline;"
                                            >
                                                View Uploaded Resume
                                            </a>
                                        </div>

                                        <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx" readonly>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <textarea name="cover_letter" id="" cols="30" rows="10" placeholder="Coverletter" readonly>{{ old('cover_letter', $application->cover_letter) }}</textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        @else
                        <div class="alert alert-warning text-center">You need to be logged in and the application must belong to you to update.</div>
                        @endif
                  
            </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="alert alert-danger">Job not found</div>
            </div>
        </div>
    </div>
    @endif
    @else
        <div class="alert alert-danger" role="alert">
            You are not authorized to view this application.
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
        link.style.color = "rgb(64, 86, 120)";        });
</script>
@endsection