@extends('frontend.master')
@section('content')

<body>

<!-- Preloader -->
<div id="preloader">
  <div data-loader="dual-ring"></div>
</div>
<!-- Preloader End -->

<!-- Document Wrapper
============================================= -->
<div id="main-wrapper">

  <!-- Header
  ============================================= -->
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start">
          <!-- Logo
          ============================= -->
          <div class="logo me-3"> <a class="d-flex" href="index.html" title="Payyed - HTML Template"><img src="https://harnishdesign.net/demo/html/payyed/images/logo.png" width="121" height="33"  alt="Payyed" /></a> </div>
          <!-- Logo end -->
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav"> <span></span> <span></span> <span></span> </button>
          <!-- Collapse Button end -->

          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              {{-- <ul class="navbar-nav me-auto">
                <li><a href="https://harnishdesign.net/demo/html/payyed/landing-page-send.html">Send</a></li>
                <li><a href="https://harnishdesign.net/demo/html/payyed/landing-page-receive.html">Receive</a></li>
                <li><a href="https://harnishdesign.net/demo/html/payyed/about-us.html">About Us</a></li>
                <li><a href="https://harnishdesign.net/demo/html/payyed/fees.html">Fees</a></li>
                <li><a href="https://harnishdesign.net/demo/html/payyed/help.html">Help</a></li>

              </ul> --}}
            </div>
          </nav>
          <!-- Primary Navigation end -->
        </div>
        <div class="header-column justify-content-end">
          <!-- Login & Signup Link
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <li><a href="{{ route('login') }}">Login</a> </li>
              <li class="align-items-center h-auto ms-sm-3"><a class="btn btn-primary" href="{{ route('register') }}">Sign Up</a></li>
            </ul>
          </nav>
          <!-- Login & Signup Link end -->
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->

  <!-- Content
  ============================================= -->
  <div id="content">

    <!-- Slideshow
    ============================================= -->
	<div class="owl-carousel owl-theme single-slideshow" data-autoplay="true" data-loop="true" data-autoheight="true" data-nav="true" data-items="1">
        @foreach ($sliders as $slider)
        <div class="item">
            <section class="hero-wrap">
              <div class="hero-mask opacity-7 bg-dark"></div>
              <div class="hero-bg" style="background-image:url('https://harnishdesign.net/demo/html/payyed/images/bg/image-1.jpg');"></div>
              <div class="hero-content d-flex fullscreen-with-header py-5">
                <div class="container my-auto text-center">
                  <h2 class="text-16 text-white">{{ $slider->title }}</h2>
                  <p class="text-5 text-white mb-4">{{$slider->sub_title}}</p>
                  <a href="{{ route('register') }}" class="btn btn-primary m-2">Open a Free Account</a> <a class="btn btn-outline-light video-btn m-2" href="#" data-src="https://www.youtube.com/embed/7e90gBu4pas" data-bs-toggle="modal" data-bs-target="#videoModal"><span class="text-2 me-3"><i class="fas fa-play"></i></span>See How it Works</a> </div>
              </div>
            </section>
          </div>

        @endforeach

    </div>
    <!-- Slideshow end -->

    <!-- Why choose
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">{{ $choose_title->title }}</h2>
        <p class="lead text-center mb-5">{{ $choose_title->sub_title }}</p>
        <div class="row gy-5">
            @foreach ($chooses as $choose)
            <div class="col-sm-6 col-lg-3">
                <div class="featured-box">
                  <div class="featured-box-icon text-primary"> <i class="{{ $choose->icon }}"></i> </div>
                  <h3>{{ $choose->title }}</h3>
                  <p class="text-3">{{ $choose->short_text }}</p>
                 </div>
              </div>
            @endforeach

        </div>
      </div>
    </section>
    <!-- Why choose end -->



    <!-- What can you do
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">{{ $counter_title->title }}</h2>
        <p class="lead text-center mb-5">{{ $counter_title->sub_title }}</p>
        <div class="row g-4">
            @foreach ($counters as $counter)

          <div class="col-sm-6 col-lg-3">
            <div class="featured-box style-5 rounded">
              <div class="featured-box-icon text-primary"> <i class="{{ $counter->icon }}"></i> </div>
              <h3>{{ $counter->title }}</h3>
            </div>
            </div>
            @endforeach

        </div>
        <div class="text-center mt-5"><a href="#" class="btn-link text-4">See more can you do<i class="fas fa-chevron-right text-2 ms-2"></i></a></div>
      </div>
    </section>
    <!-- What can you do end -->

    <!-- How work
    ============================================= -->
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card bg-dark-3 shadow-sm border-0"> <img class="card-img img-fluid opacity-8" src="https://harnishdesign.net/demo/html/payyed/images/how-work.jpg" width="570" height="362"  alt="banner">
              <div class="card-img-overlay p-0"> <a class="d-flex h-100 video-btn" href="#" data-src="https://www.youtube.com/embed/7e90gBu4pas" data-bs-toggle="modal" data-bs-target="#videoModal"> <span class="playButton playButton-pulsing bg-white m-auto"><i class="fas fa-play"></i></span> </a> </div>
            </div>
          </div>
          <div class="col-lg-6 mt-5 mt-lg-0">
            <div class="ms-4">
			  <h2 class="text-9">{{ $work_title->title }}</h2>
              <p class="text-4">{{ $work_title->sub_title }}</p>
              <ul class="list-unstyled text-3 lh-lg">
                @foreach ($works as $work)
                <li><i class="{{ $work->icon }} me-2"></i>{{ $work->title }}</li>

                @endforeach
              </ul>
              <a href="{{ route('register') }}" class="btn btn-outline-primary shadow-none mt-2">Open a Free Account</a>
          </div>
		  </div>
        </div>
      </div>
    </section>
    <!-- How work end -->

    <!-- Testimonial
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">{{ $testimonial_title->title }}</h2>
        <p class="lead text-center mb-4">{{ $testimonial_title->sub_title }}</p>
        <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-slideby="2" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="2">
            @foreach ($testimonials as $testimonial)
            <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-9 text-muted opacity-2 lh-base mb-0"><i class="fa fa-quote-left"></i></p>
                  <p class="text-4">“{{ $testimonial->quote }}”</p>
                  <strong class="d-block fw-500">{{ $testimonial->author }}</strong> <span class="text-muted">{{ $testimonial->designation }}</span> </div>
              </div>
            @endforeach
        </div>
        <div class="text-center mt-4"><a href="#" class="btn-link text-4">See more people review<i class="fas fa-chevron-right text-2 ms-2"></i></a></div>
      </div>
    </section>
    <!-- Testimonial end -->

    <!-- Customer Support
    ============================================= -->
    <section class="hero-wrap section shadow-md">
      <div class="hero-mask opacity-9 bg-primary"></div>
      <div class="hero-bg" style="background-image:url('https://harnishdesign.net/demo/html/payyed/images/bg/image-2.jpg');"></div>
      <div class="hero-content py-5">
        <div class="container text-center">
          <h2 class="text-9 text-white">Awesome Customer Support</h2>
          <p class="lead text-white mb-4">Have you any query? Don't worry. We have great people ready to help you whenever you need it.</p>
          <a href="#" class="btn btn-light">Find out more</a> </div>
      </div>
    </section>
    <!-- Customer Support end -->

    <!-- Mobile App
    ============================================= -->
    <section class="section py-5">
      <div class="container">
        <div class="justify-content-center text-center">
          <h2 class="text-9">Get the app</h2>
          <p class="lead mb-4">Download our app for the fastest, most convenient way to send & get Payment.</p>
          <a class="d-inline-flex mx-3" href="#"><img alt="" width="168" height="49"  src="https://harnishdesign.net/demo/html/payyed/images/app-store.png"></a> <a class="d-inline-flex mx-3" href="#"><img alt="" width="166" height="49"  src="https://harnishdesign.net/demo/html/payyed/images/google-play-store.png"></a>
		</div>
      </div>
    </section>
    <!-- Mobile App end -->

  </div>
  <!-- Content end -->

  <!-- Footer
  ============================================= -->
  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg d-lg-flex align-items-center">
          <ul class="nav justify-content-center justify-content-lg-start text-3">
            <li class="nav-item"> <a class="nav-link active" href="#">About Us</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Support</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Help</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Careers</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Affiliate</a></li>
            <li class="nav-item"> <a class="nav-link" href="#">Fees</a></li>
          </ul>
        </div>
        <div class="col-lg d-lg-flex justify-content-lg-end mt-3 mt-lg-0">
          <ul class="social-icons justify-content-center">
            @foreach ($socials as $social)
            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="{{ $social->url }}" target="_blank" ><i class="{{ $social->icon }}"></i></a></li>

            @endforeach

          </ul>
        </div>
      </div>
      <div class="footer-copyright pt-3 pt-lg-2 mt-2">
        <div class="row">
          <div class="col-lg">
            <p class="text-center text-lg-start mb-2 mb-lg-0">Copyright &copy; 2022 <a href="#">Payyed</a>. All Rights Reserved.</p>
          </div>
          <div class="col-lg d-lg-flex align-items-center justify-content-lg-end">
            <ul class="nav justify-content-center">
              <li class="nav-item"> <a class="nav-link active" href="#">Security</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Terms</a></li>
              <li class="nav-item"> <a class="nav-link" href="#">Privacy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end -->

</div>
<!-- Document Wrapper end -->

<!-- Back to Top
============================================= -->
<a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>

<!-- Video Modal
============================================= -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0">
	  <button type="button" class="btn-close btn-close-white ms-auto me-n3" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="modal-body p-0">
        <div class="ratio ratio-16x9">
		  <iframe id="video" src="#" allow="autoplay;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Video Modal end -->



@endsection

