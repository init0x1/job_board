@extends("candidates.layouts.app")

@section("title")
   Job Board - Applications
@endsection

@section("customeCss")
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

    footer{
        display:none;
    }

    .tabs-section ul {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 15px;
    }
    .tabs-section ul li {
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 5px;
        font-weight: bold;
        transition: background 0.3s;
    }
    .tabs-section ul li.active {
        background: #0055d9;
        color: white;
    }
    .application-card {
        background: white;
        padding: 15px;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
    }
    .application-card h3 {
        font-size: 18px;
        margin-bottom: 5px;
    }
    .application-card .badge {
        font-size: 14px;
    }
    .tabs-section ul {

    gap: 0px;
    }

    .tabs-section ul li {
    /* padding: 10px 0; */
    border-radius: 0;
    margin: 10px 0 25px 25px;
}
    .tabs-section ul li:first-of-type {
    padding: 10px 0;
    border-radius: 0;
    margin: 10px 0 25px 0;
}
    .nav-bills .nav-item a.nav-link{
        font-weight:400;
        font-style:normal;
        color:rgb(0, 20, 51);
        font-size:14px;
        line-height:normal;
        padding: 10px 0;        text-align: left;
        position:relative;


    }

    .nav-bills .nav-item a.nav-link.active{
        font-weight:700;
        font-style:normal;
        color:rgb(0,20,51);
        font-size:14px;
        line-height:normal;
        position:relative;
        padding: 10px 13px;
        text-align: left;


    }
    .nav-bills .nav-item a.nav-link.active:after{
        content:"";
        width:100%;
        height:1px;
        background-color:rgb(0,85,217);
        position:absolute;
        bottom:0;
        left:0;
        right:0
    }
    .nav-bills .nav-item{
        position:relative;

    }
    .nav-bills .nav-item:not(:last-of-type):before {
        content: "";
    width: 1.5px;
    height: 58%;
    background-color: #ccc;
    position: absolute;
    bottom: -8px;
    top: 14px;
    right: 0;
    left: 127px;
    /* margin-left: 2px;*/
     }

    .nav-bills .nav-item a.nav-link:hover{
        font-weight:400;
        font-style:normal;
        color:rgb(0,85,217);
        font-size:14px;
        line-height:normal;
    }
    .application-active{
        border: 1px solid rgb(38, 123, 255);
    box-shadow: rgb(204, 224, 255) 0px 0px 0px 3px;
    background-color: rgb(255, 255, 255);
        position: relative;
        z-index:999999;
    }
    .application-active::before{
        content: "";
        top: 15px;
        border-radius: 2px;
        position: absolute;
        border-top: 1px solid rgb(38, 123, 255);
        border-right: 1px solid rgb(38, 123, 255);
        box-shadow: 3px -3px 0 rgba(204, 224, 255, 1);
        background-color: rgb(255, 255, 255);
        right: -8px;
        width: 16px;
        height: 16px;
        transform: rotateZ(45deg);

    }
    .job-info .badge{
        font-family:"Open Sans", sans-serif !important;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        -webkit-box-align: center;
        align-items: center;
        min-height: 20px;
        max-width: 196px;
        white-space: nowrap;
        overflow: hidden;
        cursor: default;
        text-overflow: ellipsis;
        padding: 2px 4px;
        background-color: rgb(235, 237, 240);
        color: rgb(0, 20, 51);
        margin-right: 8px;
        border-radius: 4px;
    }
    .css-mo6ioo {
       display: flex;
       margin-right: 8px;
    } 
    .css-1e1wln7 {
        width: 4px;
        height: 16px;
        margin-left: 2px;
        background-color: rgb(128, 178, 255);
    }
    .css-49jpk6 {
    min-height: 62px;
    padding: 8px;
    background-color: rgb(250, 250, 251);
    color: rgb(128, 142, 165);
    font-size: 15px;
    border: 1px solid rgb(217, 221, 228);
    border-radius: 2px;
}
</style>
@endsection
@section("main")
<div class="container" style="margin-top: 82px">
    @if(Auth::check())
        @if($applications &&$applications->count())
            @php
                $pendingCount = count(array_filter($applications->toArray(), fn($app) => $app['status'] === 'pending'));
                $acceptedCount = count(array_filter($applications->toArray(), fn($app) => $app['status'] === 'approved'));
                $notSelectedCount = count(array_filter($applications->toArray(), fn($app) => $app['status'] === 'rejected'));
            @endphp
            <div class="row tabs-section justify-content-start"> 
                <div class="col-md-7">
                    <ul class="nav nav-bills">
                        <li class="nav-item">
                            <a class="nav-link active" data-filter="all">Applications ({{ $applications->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-filter="pending">Pending ({{ $pendingCount }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-filter="accepted">Accepted ({{ $acceptedCount }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-filter="not-selected">Not Selected ({{ $notSelectedCount }})</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between">
                <!-- Applications List -->
                <div class="col-md-6">
                    <div id="applications">
                        @foreach($applications as $index => $application)
                            @if($application->user_id == Auth::id())
                            <div class="application-card" 
                                data-index="{{ $index }}" 
                                data-title="{{ $application->job->title }}" 
                                data-company="{{ $application->job->company->name }}" 
                                data-location="{{ $application->job->location }}"
                                data-id="{{ $application->id }}"
                                data-cv="{{ $application->resume_path }}" 
                                data-cover="{{ $application->cover_letter }}" 
                                data-website="{{ $application->website }}" 
                                data-posted="{{$application->created_at}}"

                                onclick="openApplicationReview(this)">
                                <div class="d-flex align-items-center">
                                    <div class="img-cont  col-sm-2">
                                        
                                       @if($application->job && $application->job->company)
                                       @php
                                            $storagePath = public_path('storage/' .   $application->job->company->logo_path);
                                            $publicPath = public_path( 'img/' .   $application->job->company->logo_path);
                                            if (!empty(  $application->job->company->logo_path) && file_exists($storagePath)) {
                                                $imageUrl = asset('storage/' .   $application->job->company->logo_path);
                                            } elseif (!empty(  $application->job->company->logo_path) && file_exists($publicPath)) {
                                                $imageUrl = asset( 'img/' .  $application->job->company->logo_path);
                                            }else {
                                                $imageUrl =asset('img/' .'company_logos/company_defualt_logo.svg' );
                                            }      
                                          @endphp
                                          <img src="{{ $imageUrl }}" class="img-full w-100 h-100">
                                        @else
                                          <img src="{{asset('img/' .'company_logos/company_defualt_logo.svg' )}}" class="img-full w-100 h-100">

                                        @endif
                                    </div>
                                    <div class="col-sm-10">
                                        <h3
                                        style="font-size:16px;line-height:24px;color:rgb(0,20,51);font-weight:600;font-style:normal;"
                                        >{{ $application->job->title }}</h3>
                                        <div class="comp-info d-flex align-items-center">

                                            <span class="" 
                                            style="font-size:12px;line-height:19px;color:rgb(0,20,51);font-weight:600;font-style:normal;">{{ $application->job->company->name }}&nbsp;-&nbsp;</span>
                                            <span class="ms-2 text-secondary" 
                                            style="font-size:11px;line-height:18px;color:rgb(77,97,130);font-weight:600;font-style:normal;"> {{ $application->job->location }}</span>
                                        </div>
                                        <div class="job-info mt-2">
                                            <span class="badge 
                                                @if($application->status == 'accepted') bg-success 
                                                @elseif($application->status == 'pending') bg-light 
                                                @elseif($application->status == 'not-selected') bg-danger 
                                                @endif">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                            <span class="ms-2 text-secondary"
                                            style="font-size:11px;line-height:normal;color:rgb(128,142,165);font-weight:600;font-style:normal;"
                                            >2 months ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Application Details Preview -->
                <div class="col-md-6">
                    <div id="application-preview" class="px-4 pt-3 pb-2" style="display: none;    background: rgb(255, 255, 255);
                        border: 1px solid rgb(217, 221, 228);
                        cursor: auto;
                    
                        width: 484px;
                        box-shadow: rgba(0, 0, 0, 0.14) 0px 3px 4px 0px, rgba(0, 0, 0, 0.12) 0px 3px 3px -2px, rgba(0, 0, 0, 0.2) 0px 1px 8px 0px;
                        border-radius: 3px; 
                    ">
                    <h2  id="preview-title" style="font-size:24px;line-height:34px;color:rgb(0,85,217);font-style:normal;font-weight:700">
                        
                        - <span   id="preview-type" ></span></h2>
                        {{--example
                            posted 1 day ago
                        --}}
                        <p
                        style="font-size:12px;line-height:19px;color:rgb(128,142,165);font-weight:400;font-style:normal;">
                        Posted <span   id="preview-posted" ></span> ago</p>
                        <div class="comp-info d-flex align-items-center">
                         <span    id="preview-company" class="" 
   
                            style="font-size:12px;line-height:19px;color:rgb(0,20,51);font-weight:600;font-style:normal;">
                            </span>&nbsp;-&nbsp;
                            <span    id="preview-location" class="ms-2 text-secondary" 
                            style="font-size:11px;line-height:18px;color:rgb(77,97,130);font-weight:600;font-style:normal;">
                            </span>
                        </div>
                        <div class="d-flex justify-content-between" style="margin-top:0.25rem">
                            <p class="text-muted "
                            style="font-size:14px;line-height:22px;color:rgb(0, 20, 51) !important;font-weight:600;font-style:normal;">
                            Screening Questions</p>
                            <div class="d-flex"
                                style="justify-content: center;align-items: center;font-size:12px;line-height:19px;color:rgb(0, 20, 51) !important;font-weight:400;font-style:normal;">
                                <div class="css-mo6ioo">
                                    <div class="css-1e1wln7"></div>
                                    <div class="css-1e1wln7"></div>
                                    <div class="css-1e1wln7"></div>
                                </div>
                                <p class="m-0"> Answered 3 out of 3</p>
                            </div>
                        </div>
                        <div class="questions">
                            <form  method="POST" action="#"
                            enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="" style="">
                                        <label for="website" class="form-label">Website</label> 
                                            <p id="preview-website" class="w-100"  style="border: 1px solid #ccc; padding: 5px 9px; font-size: 14px; background: #e9ecef"
                                            ></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <div class="d-flex justify-content-between">
                                            <label for="resume" class="form-label">Resume/CV</label> 
                                            {{--href="{{ asset('storage/' . $application->resume_path?? '') }}" --}}
                                            <a
                                                   id="preview-cv"
                                                   href=""
                                                target="_blank" class="text-info text-decoration-underline"
                                                style="text-decoration-line: underline;"
                                            >
                                                View Uploaded Resume
                                            </a>
                                        </div>
                                        <div class="css49jpk6">
                                        <input  type="file" class="form-control w-100" id="resume" name="resume" accept=".pdf,.doc,.docx" readonly >

                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="csss49jpk6">
                                        <label for="cover_letter" class="form-label">Cover Letter</label> 
                                            <p id="preview-cover" class="w-100" style="min-height:150px;border: 1px solid #ccc; padding: 5px 9px; font-size: 14px; background: #e9ecef"></p>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                @if(($application->status == 'pending' && $application->job->application_deadline >= now()))
                                <a href="{{ route('candidate.application.edit', $application->id) }}" 
                                style="display: block;width: 62px;"
                                class="ml-auto btn btn-primary btn-sm">Edit</a>
                                @endif
                            </form>
                        
                            </div>

                                            
                    </div>
                </div>
            </div>
        @else
          <div class="alert alert-info text-center">You have not applied for any jobs yet.</div>
        @endif
    @else
      <div class="alert alert-warning text-center">You need to be logged in to view your applications.</div>
    @endif
</div>
@endsection

@section("customJs")
<script>
document.addEventListener("DOMContentLoaded", function () {
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
    const applications = document.querySelectorAll(".application-card");

    // Ensure there are applications before trying to set one as active
    if (applications.length > 0) {
        openApplicationReview(applications[0]); // Set the first application as active
    }

    // Your existing tab functionality
    const tabs = document.querySelectorAll(".nav-bills .nav-item .nav-link");
    tabs.forEach(tab => {
        tab.addEventListener("click", function () {
            const filter = this.getAttribute("data-filter");

            // Remove active class from all tabs
            tabs.forEach(tab => tab.classList.remove("active"));
            this.classList.add("active");

            applications.forEach(app => {
                if (filter === "all" || app.getAttribute("data-status") === filter) {
                    app.style.display = "block";
                } else {
                    app.style.display = "none";
                }
            });

            // If no application is selected after filtering, activate the first visible one
            const firstVisibleApp = document.querySelector(".application-card[style='display: block;']");
            if (firstVisibleApp) {
                openApplicationReview(firstVisibleApp);
            }
        });
    });
});


// Move this function outside so it's globally accessible
function openApplicationReview(element,id) {
    const applications = document.querySelectorAll(".application-card");
    applications.forEach(app => {
        app.classList.remove("application-active");
    });
    element.classList.add("application-active");
    // Get application data
    const title = element.getAttribute("data-title");
    const company = element.getAttribute("data-company");
    const location = element.getAttribute("data-location");
    // const status = element.getAttribute("data-status");

    const posted = element.getAttribute("data-posted");
    const website = element.getAttribute("data-website");
    const resumePath = element.getAttribute("data-cv");
    const cover_letter = element.getAttribute("data-cover");

    // Update preview section
    document.getElementById("preview-title").textContent = title;
    document.getElementById("preview-company").textContent = company;
    document.getElementById("preview-location").textContent = location;
    document.getElementById("preview-posted").textContent = posted;

    document.getElementById("preview-website").textContent = website;
    document.getElementById("preview-cover").textContent  = cover_letter;


    // Update the Resume/CV field
    var resumeInput = document.getElementById("resume");
    var viewResumeBtn = document.getElementById("preview-cv");

    if (resumePath) {
        viewResumeBtn.href = "/storage/" + resumePath; // Update the link
        viewResumeBtn.style.display = "inline-block"; // Show the button
    } else {
        viewResumeBtn.style.display = "none"; // Hide the button if no CV exists
    }
    // Show the preview panel
    document.getElementById("application-preview").style.display = "block";
}
</script>
@endsection
