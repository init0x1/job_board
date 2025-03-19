    
@extends("candidates.layouts.app")

@section("title")
   Job Board - Categories
@endsection

@section("main")
    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>Categories</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- featured_categories_area_start  -->
    <div class="featured_candidates_area candidate_page_padding">
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-md-6 col-lg-3">
                        <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('img/candiateds/default.png') }}" alt="{{ $candidate->name }}">
                            </div>
                            {{-- when press on single categories show jobs page with filter that where show jobs that belongs only to this category --}}
                            <a href="{{ route('user.job.index', ['category' => $category->id]) }}">
                                <h4>{{ $category->name }}</h4>
                            </a>

                            
                            <p>{{ $category->profile->bio ?? 'No bio available' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- featured_categories_area_end  -->
@endsection