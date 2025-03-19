
<!-- candidates/show.blade.php -->
@extends("candidates.layouts.app")

@section("title")
   Job Board - {{ $candidate->name }}
@endsection

@section("main")
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $candidate->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="candidate_details_area my-10 " style="padding-top:30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="candidate_profile" style="height:85%">
                     <div class="" style="width:90%; height:100%">
                        <img class="img-full w-100 h-100" src="{{ $candidate->image ? asset('storage/' . $candidate->image) : asset('img/candiateds/default.png') }}" alt="{{ $candidate->name }}">
                       </div> <h4>{{ $candidate->name }}</h4>
                        <p>{{ $candidate->profile->job_title ?? '' }}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="candidate_details h-100">
                        <h4>Contact Information</h4>
                        <p>Email: {{ $candidate->email }}</p>
                        <p>Phone: {{ $candidate->profile->phone_number ?? 'N/A' }}</p>
                        <p>LinkedIn: <a href="{{ $candidate->profile->linkedin_url }}" target="_blank">{{ $candidate->profile->linkedin_url }}</a></p>
                        <h4>Skills</h4>
                        <p>{{ $candidate->profile->skills ?? 'No skills listed' }}</p>
                        <h4>Certifications</h4>
                        <p>{{ $candidate->profile->certifications ?? 'No Certification listed' }}</p>
                        <h4>Experience</h4>
                        <p>{{ $candidate->profile->experiences ?? 'No experience listed' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
