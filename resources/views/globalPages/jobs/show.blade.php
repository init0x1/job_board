
@extends("candidates.layouts.app")

@section("title")
   Job Board - {{ $job ? $job->title : 'Job Details' }}
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
    @if($job)
    <div class="job_details_area">

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
                    <div class="job_details_header">
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
                            
                                    <img src="{{ $imageUrl }}" class=" w-100 h-100 mt-3 rounded">
                                    @else 
                                        <img class="mt-3 rounded w-100 h-100 " src="{{asset('img/' .'company_logos/company_defualt_logo.svg' )}}" alt="company logo" />
                                    @endif
                        
                        </div>
                                <div class="jobs_conetent row">
                                    <div class="col-md-12">
                                        <a href="#"><h4>{{ $job->title }}</h4></a>
                                        <div class="links_locat d-flex align-items-center">
                                            <div class="location">
                                                <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->work_type }}</p>
                                            </div>
                                            <div class="location">
                                                <p> <i class="fa fa-clock-o"></i> {{ $job->job_nature }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                               
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now ">
                                 <div class="pt-3 text-end">
                              @if (Auth::check())
                                  @if(!$job->isAppliedByUser())
                                  <a href="{{ route('candidate.createApplication', ['job_id' => $job->id]) }}" class="btn boxed-btn3">
                                        Apply Now
                                    </a>

                                          @else
                                              <button class="applied  btn btn-primary disabled text-light">
                                                  Already Applied
                                              </button>
                                              @endif
                              @else
                                  <button  class="btn btn-primary disabled text-light">Login to Apply</button>
                              @endif
                          </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Job Description</h4>
                            <p>{{ $job->description ?: 'No description found' }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Responsibilities</h4>
                            {{--
                              should show resposiblities into list
                            --}}
                            <p>{{ $job->responsibilities ?: 'No responsibilities found' }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Requirements</h4>
                            {{--
                              should show Requirements into list
                            --}}
                            <p>{{ $job->requirements ?: 'No requirements found' }}</p>
                        </div>
                        <div class="single_wrap">
                            <h4>Benefits</h4>
                            {{--
                              should show Benefits into list
                            --}}
                            <p>{{ $job->benefits ?: 'No benefits found' }}</p>                        </div>
                    </div>
                    @php
                        $brandsImages = is_array($job->company->brands_images) ? $job->company->brands_images : json_decode($job->company->brands_images, true);
                    @endphp

                    @if ($brandsImages)
                    <div class="row mt-5">
                        <div class="col-lg-12">
                            <div class="company_job_active owl-carousel">
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
                <div class="col-lg-4">
                    <div class="job_sumary">
                        <div class="summery_header">
                            <h3>Job Summery</h3>
                        </div>
                        <div class="job_content">
                            <ul>
                                <li>Published on: <span> {{ date("d M, Y", strtotime($job->created_at))}}</span></li>
                                <li>Vacancy: <span>{{ $job->availble_vacancies }} Position</span></li>
                                <li>Salary: <span> {{(int) $job->salary_min}}$ - {{(int)$job->salary_max}}$ per year</span></li>
                                <li>Location: <span>{{ $job->location }}</span></li>
                                <li>Job Type: <span>{{ $job->work_type }}</span></li>
                                <li>Job Nature: <span>{{ $job->job_nature }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Company Details</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Name: <span>{{ $job->company->name }}</span></li>

                                @if (!empty($job->company->description))
                                    <li>description: <span>{{ $job->company->description }}</span></li>
                                @endif

                                @if (!empty($job->company->website))
                                 <li >Webite: <span><a class="text-success" href="{{ $job->company->website }}" target="_blank">{{ $job->company_website }}</a></span></li>
                                @endif
                                
                                @if (!empty($job->company->industry))
                                    <li>Industry: <span>{{ $job->company->industry }}</span></li>
                                @endif

                                @if (!empty($job->company->established_year))
                                <li>Established Year: <span>{{  date("d M, Y", strtotime($job->company->established_year)) }}</span></li>
                                @endif
                              
                            </ul>
                        </div>
                    </div>
                </div>
                </div>
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
        link.style.color = "rgb(64, 86, 120)";
        });
</script>
@endsection