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

 <!-- Page Header
  ============================================= -->
  <section class="hero-wrap section">
    <div class="hero-mask opacity-9 bg-primary"></div>
    <div class="hero-bg" ></div>
    <div class="hero-content">
      <div class="container">
        <div class="row align-items-center text-center">
          <div class="col-12">
            <h1 class="text-11 text-white mb-4">How can we help you?</h1>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Page Header end -->

  <!-- Content
  ============================================= -->
  <div id="content">



    <!-- Popular Topics
    ============================================= -->
    <section class="section bg-white">
      <div class="container">
        <h2 class="text-9 text-center">{{ $faq_title->title }}</h2>
        <p class="text-4 text-center mb-5">{{ $faq_title->sub_title }}</p>
        <div class="row">
          <div class="col-md-10 mx-auto">
            <div class="row gx-5">
              <div class="col-md-12">
				<div class="accordion accordion-flush" id="popularTopics">
                    @foreach ($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading1">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse1">{{ $faq->question }}</button>
                        </h2>
                        <div id="collapse{{$faq->id}}" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#popularTopics">
                          <div class="accordion-body"> {{ $faq->answer }} </div>
                        </div>
                      </div>
                    @endforeach


                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Popular Topics end -->

    <!-- Can't find
    ============================================= -->
    <section class="section py-4 my-4 py-sm-5 my-sm-5">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-12">
            <div class="bg-white shadow-sm rounded ps-4 ps-sm-0 pe-4 py-4">
              <div class="row g-0">
                <div class="col-12 col-sm-auto text-13 text-light d-flex align-items-center justify-content-center"> <span class="px-4 ms-3 me-2 mb-4 mb-sm-0"><i class="far fa-envelope"></i></span> </div>
                <div class="col text-center text-sm-start">
                  <div class="">
                    <h5 class="text-3 text-body">Can't find what you're looking for?</h5>
                    <p class="text-muted mb-0">We want to answer all of your queries. Get in touch and we'll get back to you as soon as we can. <a class="btn-link" href="{{ route('contact') }}">Contact us<span class="text-1 ms-1"><i class="fas fa-chevron-right"></i></span></a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Can't find end -->

  </div>
  <!-- Content end -->

    @include('frontend.include.footer')
</div>
@endsection
