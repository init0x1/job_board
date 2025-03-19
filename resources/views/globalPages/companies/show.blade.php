
<!-- companies/show.blade.php -->
@extends("candidates.layouts.app")

@section("title")
   Job Board - {{ $company->name }}
@endsection

@section("main")
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3>{{ $company->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="company_details_area my-10 " style="padding-top:30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="company_profile" style="height:85%">
                     <div class="" style="width:90%; height:100%">
                        <img class="img-full w-100 h-100" src="{{ $company->image ? asset('storage/' . $company->image) : asset('/img/svg_icon/1.svg') }}" alt="{{ $company->name }}">
                        <img >

                     </div> <h4>{{ $company->name }}</h4>
                        <p>{{ $company->website ?? '' }}</p>
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
            @if ($company->brands_images)
            <div class="row">
                <div class="col-lg-12">
                    <div class="company_active owl-carousel">
                    @foreach(json_decode($company->brands_images, true) as $image)
                    <div class="single_candidates text-center">
                            <div class="thumb">
                                <img src="{{ asset('storage/' . $image) }}" alt="" />
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
