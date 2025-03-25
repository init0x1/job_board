    
@extends("candidates.layouts.app")

@section("title")
   WUZZEFNY - Candidates
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

    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">

            <div class="recent_joblist_wrap pl-3 text-black text-bold" style="    max-width: 640px;
    margin-bottom: 12px;">
    <p style="font-weight:700; font-style:normal; color: rgb(0,20,51); font-size:20px; line-height:20px">Explore New Career Opportunities</p>
</div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg"  style="border: 1px solid rgb(217, 221, 228);">
                        <div class="form_inner white-bg">
                            <h3>Filter</h3>
                            <form method="GET" action="{{ route('user.job.index') }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" name="keyword" placeholder="Search keyword" value="{{ request('keyword') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="category">
                                                <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="location">
                                                <!-- <option value="">Select Location</option> -->
                                            <option data-display="Location"value="">Location</option>
                                            @foreach($locations as $location)
                                                <option value="{{$location->name}}" {{ request('location') == $location->name ? 'selected' : '' }}>{{$location->name}}</option>
                                            @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="experience">
                                                <option value="">Select Experience</option>
                                                <!-- 
                                                ['intern','fresh', 'junior', 'senior', 'expert', 'lead', 'manager']
                                                -->
                                                <option value="intern" {{ request('experience') == 'intern Level' ? 'selected' : '' }}>Intern Level</option>
                                                <option value="fresh" {{ request('experience') == 'fresh Level' ? 'selected' : '' }}>Fresh Level</option>
                                                <option value="junior" {{ request('experience') == 'junior Level' ? 'selected' : '' }}>Junior Level</option>

                                                <option value="senior" {{ request('experience') == 'senior Level' ? 'selected' : '' }}>Senior Level</option>
                                                <option value="expert" {{ request('experience') == 'expert Level' ? 'selected' : '' }}>Expert Level</option>
                                                <option value="lead" {{ request('experience') == 'lead Level' ? 'selected' : '' }}>Lead Level</option>
                                                <option value="manager" {{ request('experience') == 'manager Level' ? 'selected' : '' }}>Manager Level</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="job_nature">
                                            <option value="">Select Job Nature</option>

                                            <option value="full-time" {{ request('job_nature') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                            <option value="part-time" {{ request('job_nature') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                            <option value="hybrid" {{ request('job_nature') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single_field">
                                            <label>Min Salary</label>
                                            <select class="wide" name="min_salary">
                                            <!-- <option value="">Min Salary</option> -->

                                                @for ($i = 0; $i <= 25000; $i += 500)
                                                    <option value="{{ $i }}" {{ request('min_salary') == $i ? 'selected' : '' }}>${{ number_format($i) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single_field">
                                            <label>Max Salary</label>
                                            <select class="wide" name="max_salary">
                                            <option value="25000">$25000</option>

                                                @for ($i = 500; $i <= 25000; $i += 500)
                                                    <option value="{{ $i }}" {{ request('max_salary') == $i ? 'selected' : '' }}>${{ number_format($i) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <label>Date Posted</label>
                                            <select class="wide" name="date_posted">
                                                <option value="">All Jobs</option>
                                                <option value="24_hours" {{ request('date_posted') == '24_hours' ? 'selected' : '' }}>Past 24 hours</option>
                                                <option value="week" {{ request('date_posted') == 'week' ? 'selected' : '' }}>Past week</option>
                                                <option value="month" {{ request('date_posted') == 'month' ? 'selected' : '' }}>Past month</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="boxed-btn3 w-100">Apply Filters</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9"
>
                    <div class="row align-items-center" >
                      
                        <div class="col-md-12">                  
                           @if(request()->has('category') && $categories->where('id', request('category'))->first())
                                <h3>Showing jobs for category: {{ $categories->where('id', request('category'))->first()->name }}</h3>
                            @endif
                            @if(session('error'))
                                <p class="alert alert-danger">{{ session('error') }}</p>
                            @endif
                        </div>
                      
                    </div>

                    <div class="job_lists m-0" style="border: 1px solid rgb(217, 221, 228);">
                        @if($jobs->isEmpty())
                            <p>No Jobs are available</p>
                        @else
                            <div class="row">
                                @foreach($jobs as $job)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="single_jobs white-bg d-flex justify-content-between">
                                            <div class="jobs_left d-flex align-items-center">
                                                <div class="thumb">
                                                    
                                                    @if($job->company && $job->company->logo_path)
                                                        @php
                                                        $storagePath = public_path('storage/' . $job->company->logo_path);
                                                        $publicPath = public_path('img/'.$job->company->logo_path);

                                                        if (!empty($$job->company->logo_path) && file_exists($storagePath)) {
                                                            $imageUrl = asset('storage/' . $job->company->logo_path);
                                                        } elseif (!empty($job->company->logo_path) && file_exists($publicPath)) {
                                                            $imageUrl = asset('img/' .$job->company->logo_path);
                                                        }else {
                                                            $imageUrl =asset('img/' .'company_logos/company_defualt_logo.svg' );
                                                        }      
                                                        @endphp
                                            
                                                    <img src="{{ $imageUrl }}" class=" w-100 h-100">
                                                    @else 
                                                    <img src="{{asset('img/' .'company_logos/company_defualt_logo.svg' )}}" alt="company logo"  class=" w-100 h-100"/>
                                                    @endif
                                                </div>
                                                <div class="jobs_conetent">
                                                    <a href="{{ route('user.job.show', $job->id) }}"><h4>{{ $job->title }}</h4></a>
                                                    <div class="links_locat d-flex align-items-center">
                                                        <div class="location">
                                                            <p><i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                                        </div>
                                                        <div class="location">
                                                            <p><i class="fa fa-clock-o"></i> {{ $job->job_nature }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="jobs_right">
                                                <div class="apply_now">
                                                    <a href="{{ route('user.job.show', $job->id) }}" class="boxed-btn3">Apply Now</a>
                                                </div>
                                                <div class="date">
                                                    <p>Date line: {{ date("j M Y", strtotime($job->application_deadline)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
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