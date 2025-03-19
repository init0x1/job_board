@extends("candidates.layouts.app")

@section("title")
   Job Board
@endsection



@section("main")
   
    <!-- slider_area_start -->
    <div class="slider_area">
      <div class="single_slider d-flex align-items-center slider_bg_1">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 col-md-6">
              <div class="slider_text">
                <h5
                  class="wow fadeInLeft"
                  data-wow-duration="1s"
                  data-wow-delay=".2s"
                >
                  4536+ Jobs listed
                </h5>
                <h3
                  class="wow fadeInLeft"
                  data-wow-duration="1s"
                  data-wow-delay=".3s"
                >
                  Find your Dream Job
                </h3>
                <p
                  class="wow fadeInLeft"
                  data-wow-duration="1s"
                  data-wow-delay=".4s"
                >
                  We provide online instant cash loans with quick approval that
                  suit your term length
                </p>
                <div
                  class="sldier_btn wow fadeInLeft"
                  data-wow-duration="1s"
                  data-wow-delay=".5s"
                >
                  <a href="#" class="boxed-btn3">Explore Now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="ilstration_img wow fadeInRight d-none d-lg-block text-right"
        data-wow-duration="1s"
        data-wow-delay=".2s"
      >
        <img src="img/banner/illustration.png" alt="" />
      </div>
    </div>
    <!-- slider_area_end -->

    <!-- catagory_area -->
    <div class="catagory_area">
      <div class="container">
        <div class="row cat_search">
          <div class="col-lg-3 col-md-4">
            <div class="single_input">
              <input type="text" placeholder="Search keyword" />
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="single_input">
              <select class="wide overflow-x-scroll" style="height:50px">
                <option data-display="Location">Location</option>
                @foreach($locations as $location)
                <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="single_input">
              <select class="wide">
                <option  disabled selected>-- Select Category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-3 col-md-12">
            <div class="job_btn">
            
              <a href="{{ route('user.job.index') }}" class="boxed-btn3">Find Job</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="popular_search d-flex align-items-center">
              <span>Popular Search:</span>
              <ul>
                @foreach($popularCategories->slice(0, 7) as $category)
                {{-- show jobs page and filter jobs in it where show only jobs that belong to this category --}}
                
                <li><a href="{{ route('user.job.index', ['category' => $category->id]) }}">
                 {{ $category->name }}
              </a></li> 
                @endforeach
               
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ catagory_area -->

    <!-- popular_catagory_area_start  -->
    <div class="popular_catagory_area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section_title mb-40">
              <h3>Popolar Categories</h3>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach($popularCategories as $category)
            <div class="col-lg-4 col-xl-3 col-md-6">
              <div class="single_catagory">
              <a href="{{ route('user.job.index', ['category' => $category->id]) }}">
                  <h4>{{ $category->name }}</h4>
              </a>
               
                {{--calc  available postions from count jobs  in single category and filter them where
                  application_deadline >= now and status == 'approved'--}}
                  <p>
                  <span>
                    {{ $category->jobs->count() }}
                  </span> Available positions
                </p>

              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
    <!-- popular_catagory_area_end  -->
    <!-- job_listing_area_start  -->
       <div class="job_listing_area">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="section_title">
              <h3>Job Listing</h3>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="brouse_job text-right">
              <a href="{{ route('user.job.index') }}" class="boxed-btn4">Browse More Job</a>
            </div>
          </div>
        </div>
        <div class="job_lists">
          <div class="row">
          @foreach($popularJobs as $job)

            <div class="col-lg-12 col-md-12">
              <div class="single_jobs white-bg d-flex justify-content-between">
                <div class="jobs_left d-flex align-items-center">
                <div class="thumb">
                    <img src="{{ asset($job->company && $job->company->logo_path ? $job->company->logo_path : 'img/svg_icon/1.png') }}" 
                        alt="{{ $job->company->name ?? 'Company Logo' }}" />
                </div>

                  <div class="jobs_conetent">
                 
                    <a href="{{ route('user.job.show', $job->id) }}"><h4>{{$job->title}}</h4></a>
                    <div class="links_locat d-flex align-items-center">
                      <div class="location">
                        <p><i class="fa fa-map-marker"></i>{{$job->location}}</p>
                      </div>
                      <div class="location">
                        <p><i class="fa fa-clock-o"></i> {{$job->work_type}}</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="jobs_right">
                  <div class="apply_now">
                    <a class="heart_mark" href="#">
                      <i class="ti-heart"></i>
                    </a>

                    <a href="{{ route('user.job.show', $job->id) }}" class="boxed-btn3">Apply Now</a>
                  </div>
                  <div class="date">
                    <p>Date line: {{$job->application_deadline}}</p>
                  </div>
                </div>
              </div>
            </div>
            @endforeach

          </div>
        </div>
      </div>
    </div>
    <!-- job_listing_area_end  -->
    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area">
      <div class="container">
      <div class="row align-items-center mb-40">
          <div class="col-lg-6 col-md-6">
            <div class="section_title">
              <h3>Featured Candidates</h3>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="brouse_job text-right">
              <a  href="{{ route('user.candidate.index') }}" class="boxed-btn4">Browse More Candidates</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="candidate_active owl-carousel">
            @foreach($jobCandidates as $candidate)

              <div class="single_candidates text-center">
                <div class="thumb">
                  <!-- image from profile -->
                  <img src="{{ asset( $candidate? $candidate->image : '/img/candiateds/1.png') }}" alt="" />
                  </div>
                <a href="{{ route('user.candidate.show',$candidate->id) }}"><h4>{{$candidate->name}}</h4></a>
                <p>{{ $candidate->profile ? $candidate->profile->job_title : 'Not Provided' }}</p>
               
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- featured_candidates_area_end  -->

     <div class="top_companies_area">
      <div class="container">
        <div class="row align-items-center mb-40">
          <div class="col-lg-6 col-md-6">
            <div class="section_title">
              <h3>Top Companies</h3>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="brouse_job text-right">
              <a  href="{{ route('user.job.index') }}" class="boxed-btn4">Browse More Companies</a>
            </div>
          </div>
        </div>
        <div class="row">
        @foreach($topCompanies as $company)

          <div class="col-lg-4 col-xl-3 col-md-6">
            <div class="single_company">
              <div class="thumb">
         

              @if ($company->logo_path)
                        <img src="{{ asset('storage/' . $company->logo_path) }}" class="rounded mb-3" width="150">
                    @else
                        <img src="{{ asset('/img/svg_icon/1.svg') }}" class="rounded mb
                        -3" width="150">
                    @endif
              </div>
              <a href="{{ route('user.company.show', $company) }}">
              <h3>{{ $company->name }}</h3></a>
              
              <p><span>
                    {{ $company->jobs->count() }}
                  </span> Available position</p>
            </div>
          </div>   
          @endforeach
        </div>
      </div>
    </div>

@endsection
