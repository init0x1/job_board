
<!-- companies/show.blade.php -->
@extends("candidates.layouts.app")
@section('customeCss')
  <style>
    .owl-carousel .owl-nav div {
       left: -35px;
    }
    .owl-carousel .owl-nav div.owl-next {
      left: auto;
      right: -35px;
    }
  </style>
@endsection
@section("title")
   Job Board - {{ $company->name }}
@endsection

@section("main")
    <div class="bradcam_area bradcam_bg_1">
      
    </div>

    <div class="company_details_area my-10 mt-10" style="padding-top:30px;padding-bottom:30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="company_profile" style="height:85%">
                     <div class="" style="width:90%; height:100%">
                        <img class="img-full w-100 h-100" src="{{ $company->logo_path ? asset('storage/' . $company->logo_path) : asset('/img/svg_icon/1.svg') }}" alt="{{ $company->name }}">

                     </div> <h4>{{ $company->name }}</h4>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="company_details h-100">
                       
                        <h4>website</h4>
                       {{--
                           $table->string('website')->nullable();
                           $table->text('description')->nullable();
                           $table->string('industry')->nullable();
                           $table->integer('established_year')->nullable();
                         --}}
                        <p>{{ $company->website ?? 'No website provide' }}</p>
                        <h4>description</h4>
                        <p>{{ $company->description ?? 'No description provide' }}</p>
                        <h4>industry</h4>
                        <p>{{ $company->industry ?? 'No industry provide' }}</p>
                        <h4>established_year</h4>
                        <p>{{ $company->established_year ?? 'No established_year provide' }}</p>
                    </div>
                </div>
            </div>
            @php
                $brandsImages = is_array($company->brands_images) ? $company->brands_images : json_decode($company->brands_images, true);
            @endphp

            @if ($brandsImages)
            <div class="row">
                <div class="col-lg-12">
                    <div class="company_active owl-carousel">
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
    </div>
@endsection
