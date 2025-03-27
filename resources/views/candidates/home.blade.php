@extends("candidates.layouts.app")

@section("title")
WUZZEFNY
@endsection
@section("customeCss")

<link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
            integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
            integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="stylesheet" href="./main.css" />

<style>
      .navbar .navbar-nav .nav-item{
      padding:  0 14px;
    }
    .navbar .navbar-nav .nav-link {
        padding: 0.25rem 0;
        text-transform:upperCase;
        position: relative;
        transition: color 0.3s ease-in-out;
    }

    .navbar .navbar-nav .nav-link.active, 
    .navbar .navbar-nav .nav-link:hover {
        color: #0055d9 !important; 
    }

    .navbar .navbar-nav .nav-link.active::after {
        content: "";
        width: 100%;
        height: 2px;
        background-color: #0055d9        ; 
        position: absolute;
        bottom: -3px;
        left: 0;
    }
  .catagory_area {
     border-radius: 3px;
    background-color: rgba(0,0,0,0.3);
   

    border: 1px solid rgba(255,255,255,0.2);
    padding: 20px 0;
    margin: 40px 0;

}
.slick-dots {
    display: none !important;
}

  .catagory_area select , .category_ares input {
    color:#666;  
}

.justify-content-center {
    justify-content: center !important;
}
  .catagory_area .cat_search .single_input select.wide {
    height: 50px !important;
    border: 1px solid #e8e8e8 !important;  
    width: 100%;
    padding: 15px;
    outline: 0;
    border: 0;
    border-radius: 5px;
}

.nice-select .list {

  z-index: 9999999 !important;
  height:200px
}

.slick-prev,
.slick-next {
   
    position: absolute;
    top: 13% !important;
}
/* Remove default font-based arrows */
.slick-prev:before,
.slick-next:before {
    display: none !important;
}
.slick-slide{
  
  border: 1px solid #EBEDF0 !important;
}
.text-wrapper{
  
  display: flex !important;
}
.slider-section{
  width:940px 
}
.top-slider .text-wrapper{
  border: 1px solid #EBEDF0;
  border-right:none !important;
  border-bottom:none;
  border-top: none;
    cursor: pointer;
    padding: 16px;
    width: 230px;
    max-height: 120px !important;
}
.top-slider {
  
  border: 1px solid #EBEDF0;border-bottom: none;
}
.middle-slider {

  border: 1px solid #EBEDF0;  border-top: none;
  border-bottom: none;

}
.middle-slider .text-wrapper{
  border-right:none;

}
.slick-next {
    right: -45px;
}
.slick-prev {
    left: -45px;
}
 .slick-slide {
    display: block;
}
h2.last-jobs {
  position:relative;
  margin: 0 0 36px;

}
h2.last-jobs::after {
   content:"";
    position: absolute;
    width: 55%;
    height: 4px;
    background: #001E4C;
    bottom: -12px;
    left: 1px;
}
</style>
@endsection


@section("main")
   
    <!-- header_area_end -->
    <header>
        <div class="position-relative">
      <div class="">
        <img
          style="width: 100%; height: 100%"
          src="/img/hero.webp"
          alt=""
        />
        <div class="header-overlay postion-relative"></div>
        <div class="content text-left">
          <div class="container " style="padding-left: 112px;
    padding-right: 112px;">
          <div class="paragrphs " style="padding-top:150px">
            <h1 class="main-title" style="opacity: 1">
              Find the Best Jobs in Egypt
            </h1>
            <h2 class="">
              Searching for vacancies & career opportunities? WUZZEFNY helps you
              in your job search in Egypt
            </h2>
          </div>
          <div class=" catagory_area banner-content">
            <!-- catagory_area -->
            <div class="container">
              <form method="GET" action="{{ route('user.job.index') }}">

                  <div class="row cat_search mb-0">
                    <div class="col-lg-3 col-md-4">
                      <div class="single_input">
                        <input type="text" name="keyword" placeholder="Search keyword">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                      <div class="single_input">
                        <select class="wide" name="category">
                          <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                      <div class="single_input">
                        <select class="wide" name="location">
                          <!-- <option value="">Select Location</option> -->
                        <option data-display="Location"value="">Location</option>
                        @foreach($locations as $location)
                          <option value="{{$location->name}}" {{ request('location') == $location->name ? 'selected' : '' }}>{{$location->name}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                      <div class="job_btn">
                        <button type="submit" class="w-100" style="
                        border-color: #80B2FF;
                        background-color:rgb(0, 85, 217);
                        font-family:'Open Sans', sans-serif ;
                        font-style:normal;
                        font-weight:400;
                        color:#fff;
                        font-size:18px;
                        line-height: 32px;
                        padding: 10px 24px;
                        outline: none;
                        border: none;
                        cursor: pointer;
                        ">Search Jobs</button>
                      </div>
                  </div>
                </div>
              </form>    
           
            </div>
           </div>
          </div>

          </div>
        </div>
      </div>
    </div>
      </header>
    <!-- header_area_end -->

    <div class="top_companies_area bg-white" style="    padding-top: 40px;  padding-bottom: 80px;">
      <div class=" mx-auto" style="width:940px;">
        <div class="row align-items-center mb-40 justify-content-center">
          <div class="col-lg-6 col-md-6">
            <div class="section_title">
              <h3 style="text-align:center; font-weight:300;font-size:30px; font-style:normal;color:rgb(77,97,130);line-height:normal">Join Egypt's Top Companies</h3>
            </div>
          </div>
        </div>
        <div class="row">
        <section class="slider-section  col-md-12">
            <div class="top-slider m-0">
                <div class="slides">
                    @foreach($topCompanies->slice(0,10) as $company)
                      <div class="text-wrapper" style="
                          display: flex !important;
                          flex-direction: column;
                          justify-content: center;
                          align-items: center;
                          padding: 16px;
                          width: 230px;
                        height: 150px;
                      ">
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
                          <a href="#" style="
                          display: flex !important;
                          flex-direction: column;
                          justify-content: center;
                          align-items: center;width:100%;height:100%;text-decoration:none;text-decoration-line:none"><img src="{{ $imageUrl }}" class=" w-50 h-50"></a>

                      </div>
                    @endforeach
                </div>
            </div>
              <div class="middle-slider col-md-12">
                  <div class="slides"> 
                      @foreach($topCompanies->slice(11,20) as $company)
                          <div class="text-wrapper"  style="
                              display: flex !important;
                              flex-direction: column;
                              justify-content: center;
                              align-items: center;    padding: 16px;
                              width: 115px;
                              height: 80px;
                          ">
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
                            <a href="{{ route('user.company.show', $company) }}" style="display:block;width:100%;height:100%;text-decoration:none;text-decoration-line:none"><img src="{{ $imageUrl }}" class=" w-100 h-100"></a>
                        
                          </div>
                      @endforeach
                  </div>
              </div>
          </section>
      </div>
    </div>
  </div>

    <!-- companies_area_end -->
   <!-- start  what out website provide -->
    <div class="our-provide py-5" style="background:rgb(245,246,247)">
      <div class="mx-auto" style="width:940px">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-8">
            <h2 style="line-height:45px; font-size:30px;font-weight:100;color:#001433">Explore the Right Jobs 
              <p style="line-height:45px; font-size:30px;font-weight:100;color:#001433">and Career opportunities</p>
            </h2>
            <p style="line-height:28px; font-size:16px;font-weight:400;color:rgb(77, 97, 130)">Explore feed knows what you need, based on your career interests, will find you what you are searching for. And don't worry about too many opportunities, you can always save them for later.</p>
            <a class="boxed-btn3 " href="{{ route('register') }}">Get Started Now</a>
          </div>
          <div class="col-md-4">
            <div class="img" style="width:100%;height: 313px;">
              <img src="https://static.wuzzuf-data.net/934da6cedfd8bf68a599053f359dd42e.webp?height=313&width=565" alt="" style=""
              class="w-100 h-100"/>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end what our website provide -->
    <div class="latest-jobs bg-white" style="padding:56px 0 104px">
      <div class="container">
        <div class="row">
          <h2 class="last-jobs" 
          style="font-size:30px;line-height:45px;font-weight:300;color:rgb(0, 20, 51);font-style:normal;">Latest Jobs
          </h2>

        </div>
        <div class="row g-2">
          @foreach($popularJobs as $job)
            <div class="col-md-4 col-sm-6 col-lg-3 d-flex align-items-start flex-column" 

                style=" padding: 6px 6px;">
                <a  href="{{ route('user.job.show', $job->id) }}" style="padding:16px; background: #ffffff;display:block;
                    border-radius: 4px;
                    border: 1px solid #D9DDE4;
                    height: 113px;
                    width: 276px;">  
                  <h4 style="font-size:16px;line-height:24px;font-weight:400;color:rgb(0, 85, 217);font-style:normal">{{$job->title}}</h4>
                  <p style="font-size:14px;line-height:22px;font-weight:400;color:#4d6182;font-style:normal"><span>{{$job->company->name}}</span> - <span>{{$job->location}}</span></p>
                  <p style="font-size:12px;line-height:19px;font-weight:400;color:rgb(102, 120, 147);font-style:normal">{{ $job->created_at->diffForHumans() }}</p>
                              </a>
              </div> 
          @endforeach 
        </div>
          <div class="row  justify-content-end align-items-center">
                  <div class="col-md-3 d-flex flex-row justify-content-end align-items-center">
                    <a href="{{ route('user.job.index')}}"><p class="m-0"style="font-size:16px;line-height:24px;font-weight:400;color:rgb(0, 85, 217);font-style:normal">See other jobs on WUZZUF</p>
                    <div class="image" style="width:50px; height:20px">
                      
                      <img src="/img/svg_icon/right-arrow.svg" alt="" class="w-100 h-100">
                     </a></div>
                  </div>
        </div>
      </div>
    </div>
     <!-- get ready section to start -->
      <div class="get-ready py-5"style="background:rgb(245,246,247)">
        <div class="mx-auto" style="width:940px">
          <div class="content d-flex justify-content-center align-items-center flex-column">
             <h2 style="line-height:normal; font-size:30px;font-weight:300;color:#4d6182">Get ready for more opportunities! </h2>
             <p style="line-height:normal; font-size:16px;font-weight:300;color:#4d6182;margin-bottom: 1rem;margin-top: 1rem;">You are minutes away from the right job.</p>
             <a  style="line-height:32px; font-size:18px;font-weight:400;color:#fff ; padding:12px 40px; margin-top:20px; margin-bottom:20px"
              class="boxed-btn3" href="{{ route('register') }}">Join Now</a>
          </div>
        </div>
      </div>
      <!-- get category by category start -->
      <div class="category-jobs bg-white" style="padding:56px 0 104px">
      <div class="container">
        <div class="row">
          <h2 class="last-jobs" 
          style="font-size:30px;line-height:45px;font-weight:300;color:rgb(0, 20, 51);font-style:normal;">Browse Jobs by Categories

          </h2>

        </div>
        <div class="row g-2">
         
          @foreach($popularCategories->slice(0,4) as $category)
            <div class="col-md-4 col-sm-6 col-lg-3 d-flex align-items-start flex-column" style="border-raduis:5px;padding:5px 24px 5px 0">
              <a class="inner " href="{{ route('user.job.index', ['category' => $category->id]) }}" style="display:block;border-raduis:5px;position:relative;">
                 <div class="image" style="width:100%;height:100%">
                <!-- public\img\category\It_and_software.webp -->
                 
                @php
                            $storagePath = public_path('storage/' . $category->image);
                            $publicPath = public_path( 'img/' . $category->image);
                            if (!empty($category->image) && file_exists($storagePath)) {
                                $imageUrl = asset('storage/' . $category->image);
                            } elseif (!empty($category->image) && file_exists($publicPath)) {
                                $imageUrl = asset( 'img/' .$category->image);
                            }else {
                                $imageUrl =asset('img/category/It_and_software.webp' );
                            }      
                        @endphp
                        <img src="{{ $imageUrl }}" class="img-full w-100 h-100" alt="{{ $category->name }}">
                {{--<img src="{{asset('img/'.$category->image)}}" alt="{{$category->name}}" class="w-100 h-100">--}}
              </div>
              <div class="overlay" style="background:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));position:absolute;top:0;left:0;bottom:0;right:0;">
                  <div class="content "style="
                      height: 100%;
                      display: flex;
                      align-items: flex-start;
                      justify-content: flex-end;
                      flex-direction: column;
                      padding: 0 12px">
                    <p class="text-white"><span>{{$category->name}}</span> Jobs</p>
                  </div>
              </div>
                              </a>
             
                
              </div> 
          @endforeach 
        </div>
          <div class="row  justify-content-end align-items-center">
                  <div class="col-md-3 d-flex flex-row justify-content-end align-items-center">
                    <a href="{{ route('user.category.index')}}">
                      <p class="m-0"
                      style="font-size:16px;line-height:24px;font-weight:400;
                      color:rgb(0, 85, 217);font-style:normal">Browse All Categories</p>
                    <div class="image" style="width:50px; height:20px">
                      <img src="/img/svg_icon/right-arrow.svg" alt="" class="w-100 h-100">
                     
                      </a></div>
                  </div>
        </div>
      </div>
    </div>
    <!-- get job by categories end -->
    <!-- get job by experince level start -->
    <div class="experince-jobs" style="padding:56px 0 104px; background:rgb(245,246,247)">
      <div class="container">
        <div class="row">
          <h2 class="last-jobs" 
          style="font-size:30px;line-height:45px;font-weight:300;color:rgb(0, 20, 51);font-style:normal;">Browse Jobs by Career Level

          </h2>

        </div>
        <div class="row g-2">
         
          @foreach($experiences_level as $type)
            <div class="col-md-4 col-sm-6 col-lg-3 d-flex align-items-start flex-column" style="border-raduis:5px;padding:5px 24px 5px 0">
            <a class="inner " href="{{ route('user.job.index', ['experience' => $type['name']]) }}" style="display:block;border-radius:10px;position:relative;">
            <div class="image" style="width:100%;height:100%">
                <!-- public\img\category\It_and_software.webp -->
                <img src="{{ asset('img/' . $type['image']) }}" alt="{{ $type['name'] }}" class="w-100 h-100">
                </div>
              <div class="overlay" style="background:linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));position:absolute;top:0;left:0;bottom:0;right:0;">
                  <div class="content "style="
                      height: 100%;
                      display: flex;
                      align-items: flex-start;
                      justify-content: flex-end;
                      flex-direction: column;
                      padding: 0 12px">
                    <p class="text-white"><span>{{ $type['name'] }}</span> Level Jobs</p>
                    </div>
              </div>
                              </a>
             
                
              </div> 
          @endforeach 
        </div>
          <div class="row  justify-content-end align-items-center">
                  <div class="col-md-3 d-flex flex-row justify-content-end align-items-center">
                    <a href="{{ route('user.job.index')}}">
                      <p class="m-0"
                      style="font-size:16px;line-height:24px;font-weight:400;
                      color:rgb(0, 85, 217);font-style:normal">Browse All Jobs in WUZZEF</p>
                    <div class="image" style="width:50px; height:20px">
                      <img src="/img/svg_icon/right-arrow.svg" alt="" class="w-100 h-100">
                     
                    </a></div>
                  </div>
        </div>
      </div>
    </div>
    <!-- get job by categories end -->

   
@endsection
@section("customJs")
<script>
  document.addEventListener("DOMContentLoaded", function () {

    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add("active");
        }
    });
  });
</script>
    <script src="/js/header_scroll.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
            crossorigin="anonymous"
        ></script>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
            integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>
        <script>
            $(".top-slider .slides").slick({
                dots: false,
                arrows: false,
                infinite: true,
                loop: true,
                speed: 1000,
                autoplay: true,
                focusOnSelect: false,
                autoplaySpeed: 3000,
                centerMode: true,
                slidesToShow: 4,
                slidesToScroll:4,
                asNavFor: ".middle-slider .slides",
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 1,
                        },
                    },
                ],
            });
            $(".middle-slider .slides").slick({
                dots: true,
                arrows: true,
                infinite: true,
                loop: true,
                speed: 1000,
                autoplay: true,
                focusOnSelect: true,
                autoplaySpeed: 3000,
                centerMode: true,
                slidesToShow: 8,
                slidesToScroll: 8,
                asNavFor: ".top-slider .slides",

                prevArrow:
                    '<button class="slick-prev"><i size="16" class="css-b80bsd efou2fk0"><svg width="16" height="16" preserveAspectRatio="none" viewBox="0 0 24 24"><path fill="#0055D9" d="M14.787 19l1.713-1.645L10.937 12 16.5 6.645 14.787 5 7.5 12z"></path></svg></i></button>',
                nextArrow:
                    '<button class="slick-next"><i size="16" class="css-b80bsd efou2fk0"><i><svg width="16" height="16" preserveAspectRatio="none" viewBox="0 0 24 24"><path fill="#0055D9" d="M9.213 5L7.5 6.645 13.063 12 7.5 17.355 9.213 19l7.287-7z"></path></svg></i></button>',
                responsive: [
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 2,
                        },
                    },
                ],
            });
        </script>
    @endsection

