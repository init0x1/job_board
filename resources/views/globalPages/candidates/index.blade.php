    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Candidates
@endsection

@section("main")
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Candidates</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- featured_candidates_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($candidates as $candidate)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{ $candidate->image ? asset('storage/' . $candidate->image) : asset('img/candiateds/default.png') }}" alt="{{ $candidate->name }}">
                            </div>
                            <a href="{{ route('user.candidate.show', $candidate->id) }}">
                                <h4>{{ $candidate->name }}</h4>
                            </a>
                            <p>{{ $candidate->profile->job_title ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_candidates_area_end  -->
@endsection