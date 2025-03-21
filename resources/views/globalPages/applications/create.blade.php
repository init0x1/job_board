@extends("candidates.layouts.app_normal")
@section('customeCss')
  <style>
    /* Custom CSS 
     hide footer when show applications and change navbar color
    */
    .header-area {
        background: radial-gradient(black, transparent);
    }
    .footer {
        display: none;
    }
  </style>
@endsection
@section("title")
   Job Board - application Form
@endsection
@section("main")
@if($job)
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Job Application</h3>
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
   <div class="apply_job_form white-bg">

    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h4>Apply for the job</h4>

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
        <form method="POST" action="{{ route('candidate.storeApplication', ['job_id' => $job->id]) }}"
        enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="input_field">
                        <input type="text" placeholder="Website/Portfolio link" 
                        value="{{ old('website', $application->user->website ?? '') }}"
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
                            <input type="file" class="custom-file-input" id="inputGroupFile03" name="resume_path" required aria-describedby="inputGroupFileAddon03">

                            <label class="custom-file-label" for="inputGroupFile03" name="resume_path">Upload Resume</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input_field">
                        <textarea name="cover_letter" id="" cols="30" rows="10" placeholder="Coverletter"></textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="submit_btn">
                        <button class="boxed-btn3 w-100" type="submit">Apply Now</button>
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