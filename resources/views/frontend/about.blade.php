@extends('frontend.master')
@section('content')

<!-- Preloader -->
<div id="preloader">
    <div data-loader="dual-ring"></div>
  </div>
  <!-- Preloader End -->

  <!-- Document Wrapper
  ============================================= -->
  <div id="main-wrapper">

@include('frontend.include.header')



    <!-- Content
    ============================================= -->
    <div id="content">

      <!-- Who we are
      ============================================= -->
      <section class="section">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 d-flex">
              <div class="my-auto px-0 px-lg-5 mx-2">
                <h2 class="text-9 mb-4">{{ $gnl_extra->about_title }}</h2>
                <p class="text-4">{!! $gnl_extra->about_des !!}</p>
              </div>
            </div>
            <div class="col-lg-6 my-auto text-center"> <img class="img-fluid shadow-lg rounded-3" src="{{ asset('assets/images/about/'.$gnl_extra->about_image) }}" alt=""> </div>
          </div>
        </div>
      </section>
      <!-- Who we are end -->



      <!-- Testimonial
      ============================================= -->
      <section class="section">
        <div class="container">
          <h2 class="text-9 text-center">What people are saying about {{ $gnl->site_name }}</h2>
          <p class="lead text-center mb-4">{{ $testimonial_title->sub_title }}</p>
          <div class="owl-carousel owl-theme" data-autoplay="true" data-nav="true" data-loop="true" data-margin="30" data-slideby="2" data-stagepadding="5" data-items-xs="1" data-items-sm="1" data-items-md="2" data-items-lg="2">
            @foreach ($testimonials as $testimonial)
            <div class="item">
                <div class="testimonial rounded text-center p-4">
                  <p class="text-9 text-muted opacity-2 mb-0"><i class="fa fa-quote-left"></i></p>
                  <p class="text-4">“{{ $testimonial->quote }}”</p>
                  <strong class="d-block fw-500">{{ $testimonial->author }}</strong> <span class="text-muted">{{ $testimonial->designation }}</span> </div>
              </div>
            @endforeach

          </div>
        </div>
      </section>
      <!-- Testimonial end -->


    </div>
    <!-- Content end -->
    @include('frontend.include.footer')
</div>
@endsection
