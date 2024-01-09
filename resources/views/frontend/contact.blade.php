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
            <h1 class="text-11 text-white mb-4">Awesome Customer Support</h1>
          <p class="text-4 text-white mb-4">Have you any query? Don't worry. We have great people ready to help you whenever you need it.</p>

          </div>

        </div>
      </div>
    </div>
  </section>
  <br>
  <!-- Page Header end -->

<!-- Content
  ============================================= -->
  <div id="content">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="bg-white shadow-md rounded h-100 p-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-map-marker-alt"></i></div>
              <h3>{{ $gnl->site_name }}</h3>
              <p>{{ $gnl_extra->contact_address }} </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-white shadow-md rounded h-100 p-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-phone"></i> </div>
              <h3>Telephone</h3>
              <p class="mb-0">{{ $gnl_extra->contact_phone }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="bg-white shadow-md rounded h-100 p-3">
            <div class="featured-box text-center">
              <div class="featured-box-icon text-primary mt-4"> <i class="fas fa-envelope"></i> </div>
              <h3>Business Inquiries</h3>
              <p>{{ $gnl_extra->contact_email }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center py-5">
            <h2 class="text-8">Get in touch</h2>
            <div class="d-flex flex-column">
              <ul class="social-icons social-icons-lg social-icons-colored justify-content-center">
                @foreach ($socials as $item)
                <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="{{ $item->url }}" target="_blank" ><i class="{{ $item->icon }}"></i></a></li>

                @endforeach
              </ul>
            </div>
          </div>
    </div>

    <!-- Content end -->

    @include('frontend.include.footer')
</div>
@endsection
