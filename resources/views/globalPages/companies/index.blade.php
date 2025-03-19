    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Companies
@endsection

@section("main")
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Companies</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- featured_companies_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($companies as $company)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{ $company->logo_path ? asset('storage/' . $company->logo_path) : asset('/img/svg_icon/1.svg') }}" alt="{{ $company->name }}">
                            </div>

                            <a href="{{ route('user.company.show', $company) }}">
                                <h4>{{ $company->name }}</h4>
                            </a>
                            <p>{{ $company->description ?? 'No description available' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_companies_area_end  -->
@endsection