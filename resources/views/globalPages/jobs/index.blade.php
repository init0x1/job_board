@extends("candidates.layouts.app")

@section("title")
   Job Board - Jobs
@endsection
@section("main")
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $jobs->count() }}+ Jobs Available</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
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
                
                <div class="col-lg-9">
                    <div class="row align-items-center">
                      
                        <div class="col-md-12">                  
                           @if(request()->has('category') && $categories->where('id', request('category'))->first())
                                <h3>Showing jobs for category: {{ $categories->where('id', request('category'))->first()->name }}</h3>
                            @endif
                            @if(session('error'))
                                <p class="alert alert-danger">{{ session('error') }}</p>
                            @endif
                        </div>
                      
                    </div>
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Job Listing</h4>
                                </div>
                            </div>
                        </div> 

                    </div>
                    <div class="job_lists m-0">
                        @if($jobs->isEmpty())
                            <p>No Jobs are available</p>
                        @else
                            <div class="row">
                                @foreach($jobs as $job)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="single_jobs white-bg d-flex justify-content-between">
                                            <div class="jobs_left d-flex align-items-center">
                                                <div class="thumb">
                                                    <img src="/img/svg_icon/1.svg" alt="">
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
