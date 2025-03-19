
@extends("candidates.layouts.app")
@section('customeCss')
  <style>
    .owl-carousel .owl-nav div {
       left: 0;
    }
    .owl-carousel .owl-nav div.owl-next {
      left: auto;
      right: 0;
    }
  </style>
@endsection
@section("title")
   Job Board - {{ $job ? $job->title : 'Job Details' }}
@endsection
@section("main")
    @if($job)
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $job->title }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                @if ($job->company->logo_path ?? false)
                                <img src="{{ asset('storage/' . $job->company->logo_path) }}" class="mt-3 rounded" width="100">
                            @endif                                </div>
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
                                <div class="apply_now">
                                <div class="row jobs_content">
                              
                              </div>  <div class="pt-3 text-end">
                              @if (Auth::check())
                                  @if(!$job->isAppliedByUser())
                                          <form class="
                                          
                                              " action="{{ route('user.applyJob', ['id' => $job->id]) }}" method="POST">
                                              @csrf
                                              <button type="submit" class="btn btn-success">
                                              Apply Now
                                              </button>
                                          </form>
                                          @else
                                              <button class="applied text-success disabled btn-light btn">
                                                  Already Applied
                                              </button>
                                              @endif
                              @else
                                  <button  class="btn btn-success disabled">Login to Apply</button>
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

                        <!-- <div class="apply_job_form white-bg">
                        <h4>Apply for the job</h4>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input_field">
                                        <input type="text" placeholder="Your name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input_field">
                                        <input type="text" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <input type="text" placeholder="Website/Portfolio link">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button type="button" id="inputGroupFileAddon03"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                          </button>
                                        </div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03">
                                          <label class="custom-file-label" for="inputGroupFile03">Upload CV</label>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input_field">
                                        <textarea name="#" id="" cols="30" rows="10" placeholder="Coverletter"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit_btn">
                                        <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                   
                   
                    </div> -->
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
