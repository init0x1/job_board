    
@extends("candidates.layouts.app")
@section("title")
   WUZZEFNY -application Form
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
    footer{
        display:none;
    }

</style>

@endsection

@section("main")
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
                        @if(Auth::check()) 

                        <h4  style="padding:10px 5px; width:100%; background: rgb(0, 30, 76); color:white;  
                          border-radius: 5px 5px 0 0; padding-left:5px;">Application Form </h4>
                        <form  style="padding:10px 20px; " method="POST" action="{{ route('candidate.storeApplication', ['job_id' => $job->id]) }}"
                            enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 name-desc">
                                        {{--show job name and company logo--}}
                                           <p style=" font-size:24px;line-height:34px; color:rgb(0,20,51); font-weight:600">
                                            <span class="name">{{$job->title}}</span> - 
                                            <span class="type">{{$job->work_type}}</span></p>                                       
                                    </div>
                                    <div class="col-md-4">
                                       <div class="img " style="width:100px;height:50px">
                                        @if($job && $job->company)
                                       @php
                                            $storagePath = public_path('storage/' .  $job->company->logo_path);
                                            $publicPath = public_path( 'img/' .  $job->company->logo_path);
                                            if (!empty( $job->company->logo_path) && file_exists($storagePath)) {
                                                $imageUrl = asset('storage/' .  $job->company->logo_path);
                                            } elseif (!empty( $job->company->logo_path) && file_exists($publicPath)) {
                                                $imageUrl = asset( 'img/' . $job->company->logo_path);
                                            }else {
                                                $imageUrl =asset('img/' .'company_logos/company_defualt_logo.svg' );
                                            }      
                                          @endphp
                                          <img src="{{ $imageUrl }}" class="img-full w-100 h-100">
                                        @else
                                          <img src="{{asset('img/' .'company_logos/company_defualt_logo.svg' )}}" class="img-full w-100 h-100">

                                        @endif
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
                                            value="{{ old('website', $application->user->website ?? '') }}"
                                            name="website"
                                            required
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="resume_path" class="form-label">Resume/CV</label>
                                            <a
                                                href="{{ asset('storage/' . Auth::user()->profile->resume_path) }}" 
                                                target="_blank" class="text-info text-decoration-underline"
                                                style="text-decoration-line: underline;"
                                            >
                                                View previous Resume
                                            </a>
                                        </div>

                                        <input type="file" class="form-control" id="resume_path" name="resume_path" accept=".pdf,.doc,.docx">
                                        
                                        @if(optional(Auth::user()->profile)->resume_path)
                                            <div class="mt-2">
                                                
                                            </div>
                                        @endif
                                        @error('resume_path') <small class="text-danger">{{ $message }}</small> @enderror
   
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <textarea name="cover_letter" id="" cols="30" rows="10" placeholder="Coverletter"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 justify-content-end row g-5">
                                        <div class="col-md-3 submit_btn">
                                          <button class=" w-100 text-white " style="background-color: rgb(0, 30, 76);padding: 5px;
                                            border-radius: 5px;
                                            font-size: 13px;" type="submit">Submit Application</button>
                                        </div>
                                        <div class="col-md-3 reset_btn p-0">
                                          <a class="boxed-btn3 w-100  bg-secondary text-light"  href="{{ route('user.job.index') }}">cancel </a>
                                        </div>
                                    </div>
                                    </div>
                                  
                                </div>
                            </form>
                        @else
                          <div class="alert alert-warning text-center">You need to be logged in and the job must belong to you to apply.</div>
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