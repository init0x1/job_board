    
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
    @if(isset($job) && $job )
        <div class="job_details_area" style="margin-top: 80px !important;">
            <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb " class=" rounded-3 p-3 text-bold" >
                        <ol class="breadcrumb mb-0"style="background-color:transparent; color: green ">
                            <li class="breadcrumb-item"><a class=" text-bold text-info" href="{{ route('user.job.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp;Back to Jobs</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                   <div class="apply_job_form white-bg">
                        @if (session('success'))
                          <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <h4>Update Job Application</h4>
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
                            <form method="POST" action="{{ route('candidate.application.update', ['id' => $application->id]) }}"
                            enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <input type="text" placeholder="Website/Portfolio link" 
                                            value="{{ old('website', $application->website) }}"
                                            name="website"
                                            required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile03" name="resume_path" aria-describedby="inputGroupFileAddon03">

                                                <label class="custom-file-label" for="inputGroupFile03" name="resume_path">Upload Resume</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input_field">
                                            <textarea name="cover_letter" id="" cols="30" rows="10" placeholder="Coverletter">{{ old('cover_letter', $application->cover_letter) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="submit_btn">
                                            <button class="boxed-btn3 w-100" type="submit">Update Application</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                        <div class="alert alert-warning text-center">You need to be logged in and the application must belong to you to update.</div>
                        @endif
                    </div>
                </div>
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