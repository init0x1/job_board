    
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
                                @php
                                    $storagePath = public_path('storage/' . $company->logo_path);
                                    $publicPath = public_path( 'img/' . $company->logo_path);
                                    if (!empty($company->logo_path) && file_exists($storagePath)) {
                                        $imageUrl = asset('storage/' . $company->logo_path);
                                    } elseif (!empty($company->logo_path) && file_exists($publicPath)) {
                                        $imageUrl = asset( 'img/' .$company->logo_path);
                                    }else {
                                        $imageUrl =asset('img/' .'company_logos/company_defualt_logo.svg' );
                                    }      
                                @endphp
                                <img src="{{ $imageUrl }}" class="rounded mb-3 w-100 h-100">
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