<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Wuzzefny</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- font google links -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@100;200;300;400;500;600;700;800;900&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Noto+Sans+Arabic:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <!-- bootstarp style -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />

    <link rel="stylesheet" href="/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/css/magnific-popup.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/themify-icons.css" />
    <link rel="stylesheet" href="/css/nice-select.css" />
    <link rel="stylesheet" href="/css/flaticon.css" />
    <link rel="stylesheet" href="/css/jquery-ui.css">

    <link rel="stylesheet" href="/css/gijgo.css" />
    <link rel="stylesheet" href="/css/animate.min.css" />
    <link rel="stylesheet" href="/css/slicknav.css" />

    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/home.css" />


    <!-- nav style -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/navbar.css" />
    <!-- header style -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/header.css" />
    <!-- categories area style -->
    <link rel="stylesheet" type="text/css" media="screen" href="/css/category_area.css" />

    <!-- Styles -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"> -->

    <link href="{{ asset('../../../css/app.css') }}" rel="stylesheet">

  @yield('customeCss')
  </head>
  <body >
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->
    <nav class="navbar navbar-expand-lg fixed-top py-0" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ route('candidates.home') }}">WUZZEFNY</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <i size="22" class="css-yb1q05 efou2fk0"
            ><svg
            class="light"

              width="22"
              height="22"
              preserveAspectRatio="none"
              viewBox="0 0 24 24"
            >
              <path
                fill="#ffffff"
                d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"
              ></path>
            </svg>
            <svg
              class="dark"
              style="display:none"
              width="22"
              height="22"
              preserveAspectRatio="none"
              viewBox="0 0 24 24"
            >
              <path
                fill="#000000"
                d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"
              ></path>
            </svg>
          </i>
        </button>
        <div class="collapse navbar-collapse w-75" id="navbarNav">
          <ul class="navbar-nav">
            
           <li class="nav-item">
            <li><a class="hide-employeer nav-link" href="{{ route('user.job.index') }}">Browse Job</a>
            </li>
             @auth
              @if(Auth::user()->role == 'candidate')
                <li class="nav-item"><a class="nav-link"  href="{{ route('candidate.application.index') }}">Applications</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Saved</a></li>
              @elseif(Auth::user()->role == 'employer')
                <li class="show-employeer-menu nav-item"><a class="nav-link" href="{{ route('user.job.index') }}">Jobs</a></li>
              @endif
            @endauth
            <li class="hide-employeer text-white c-ptr hover:text-green-[400] nav-item" style="cursor:pointer" @click="showEmployeerPage()"><a class="nav-link" href="javascript:void(0);">For Employers</a></li>
            <li class="nav-item li-post-btn" >
              <a class="nav-link post-btn" href="{{route('employer.jobs.create')}}">
                <svg
                  width="25"
                  height="25"
                  preserveAspectRatio="none"
                  viewBox="0 0 24 24"
                >
                  <path
                  fill="#ffffff"
                  d="M10.5 4.875V3.375H7.5V4.875H10.5ZM3 7.125V13.875C3 14.2875 3.3375 14.625 3.75 14.625H14.25C14.6625 14.625 15 14.2875 15 13.875V7.125C15 6.7125 14.6625 6.375 14.25 6.375H3.75C3.3375 6.375 3 6.7125 3 7.125ZM15 4.875C15.8325 4.875 16.5 5.5425 16.5 6.375V14.625C16.5 15.4575 15.8325 16.125 15 16.125H3C2.1675 16.125 1.5 15.4575 1.5 14.625L1.5075 6.375C1.5075 5.5425 2.1675 4.875 3 4.875H6V3.375C6 2.5425 6.6675 1.875 7.5 1.875H10.5C11.3325 1.875 12 2.5425 12 3.375V4.875H15Z"
                  ></path>
                </svg>
               
                <span class="">Post Job</span>
              </a>
            </li>
            <span class="separtor"> </span>
           

            @auth
                    <!-- User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('default-avatar.png') }}"
                                alt="Profile" class="rounded-circle "  style="padding-right: 5px;" width="40" height="40">
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                <li class="nav-item">
                  <a class="nav-link login-btn {{ request()->routeIs('login') ? 'active' : '' }}"   href="{{ route('login') }}">Login</a>
                </li>

                @endauth
          </ul>
        </div>
      </div>
    </nav>
         <section>
         @yield("main")


         </section>

    <!-- footer start -->
    <footer class="footer">
      <div class="footer_top">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-md-6 col-lg-3">
              <div
                class="footer_widget wow fadeInUp"
                data-wow-duration="1s"
                data-wow-delay=".3s"
              >
                <div class="footer_logo">
                  <a href="#" class="navbar-brand" style="color:white; font-size:">
                    WUZZEFNY
                  </a>
                </div>
                <p>
                  finloan@support.com <br />
                  +10 873 672 6782 <br />
                  600/D, Green road, NewYork
                </p>
                <div class="socail_links">
                  <ul>
                    <li>
                      <a href="#">
                        <i class="ti-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-google-plus"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <i class="fa fa-instagram"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-xl-2 col-md-6 col-lg-2">
              <div
                class="footer_widget wow fadeInUp"
                data-wow-duration="1.1s"
                data-wow-delay=".4s"
              >
                <h3 class="footer_title">Company</h3>
                <ul>
                  <li><a href="#">About </a></li>
                  <li><a href="#"> Pricing</a></li>
                  <li><a href="#">Carrier Tips</a></li>
                  <li><a href="#">FAQ</a></li>
                </ul>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 col-lg-3">
              <div
                class="footer_widget wow fadeInUp"
                data-wow-duration="1.2s"
                data-wow-delay=".5s"
              >
                <h3 class="footer_title">Category</h3>
                <ul>
                @foreach($popularCategories->slice(0,4) as $category)
               
                  <li> <a href="{{ route('user.job.index', ['category' => $category->id]) }}">
                      {{ $category->name }}
                  </a></li>
                @endforeach
                </ul>
              </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4">
              <div
                class="footer_widget wow fadeInUp"
                data-wow-duration="1.3s"
                data-wow-delay=".6s"
              >
                <h3 class="footer_title">Subscribe</h3>
                <form action="#" class="newsletter_form">
                  <input type="text" placeholder="Enter your mail" />
                  <button type="submit">Subscribe</button>
                </form>
                <p class="newsletter_text">
                  Esteem spirit temper too say adieus who direct esteem esteems
                  luckily.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        class="copy-right_text wow fadeInUp"
        data-wow-duration="1.4s"
        data-wow-delay=".3s"
      >
        <div class="container">
          <div class="footer_border"></div>
          <div class="row">
            <div class="col-xl-12">
              <p class="copy_right text-center">
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved | This template is made with
                <i class="fa fa-heart-o" aria-hidden="true"></i> by
                <a href="https://iti-team.com" target="_blank">ITITeam</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--/ footer end  -->
        <!-- link that opens popup -->
    <!-- JS here-->
    <script src="/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/isotope.pkgd.min.js"></script>
    <script src="/js/ajax-form.js"></script>
    <script src="/js/waypoints.min.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>
    <script src="/js/imagesloaded.pkgd.min.js"></script>
    <script src="/js/scrollIt.js"></script>
    <script src="/js/jquery.scrollUp.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/nice-select.min.js"></script>
    <script src="/js/jquery.slicknav.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->

      <!--contact js-->
    <script src="/js/jquery.ajaxchimp.min.js"></script>
    <script src="/js/jquery.form.js"></script>
    <script src="/js/jquery.validate.min.js"></script>


    <script src="/js/main.js"></script>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('../../../js/app.js') }}" defer></script>
    @yield('customJs')
    <script>

      function showEmployeerMenu() {
        document.querySelector('.show-employeer').classList.toggle('show-employeer-menu');
        
        // Hide the "Browse Job" menu item
        document.querySelector(".hide-employeer").style.display = "none";
        document.querySelector(".show-employeer").style.display = "block";
      }
      // $(document).ready(function () {
      //   $('.nice-select').niceSelect(); // Initialize nice select
        
      //   $('.nice-select').on('click', function () {
      //     $('.nice-select .list').css({
      //       top: $(this).outerHeight() + 'px', // Ensures the dropdown appears below
      //       bottom: 'auto'
      //     });
      //   });
      // });

    </script>

  </body>
</html>
