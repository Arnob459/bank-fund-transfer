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
            <div class="col-lg-12 d-flex">
              <div class="my-auto px-0 px-lg-5 mx-2">
                <h2 class="text-9 mb-4">{{ $terms->title }}</h2>
                <p class="text-4">{!! $terms->sub_title !!}</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Who we are end -->






    </div>
    <!-- Content end -->
    @include('frontend.include.footer')
</div>
@endsection
