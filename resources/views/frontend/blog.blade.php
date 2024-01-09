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

<section class="hero-wrap section">
    <div class="hero-mask opacity-9 bg-primary"></div>
    <div class="hero-bg" style="background-image:url('./images/bg/image-2.jpg');"></div>
    <div class="hero-content">
      <div class="container">
        <div class="row align-items-center text-center">
          <div class="col-12">
            <h1 class="text-11 text-white mb-4">{{ $blog_title->title }}</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-6 mx-auto">
            <h1 class="text-4 text-white mb-4">{{ $blog_title->sub_title }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>

 <!-- Content
  ============================================= -->
  <div id="content">
    <div class="container">
      <div class="row">

        <!-- Middle Panel
        ============================================= -->
        <div class="col-lg-8 col-xl-9">
          <div class="row gy-4">
            @foreach ($blogs  as $blog)
            <div class="col-12">
                <div class="blog-post card shadow-sm border-0"> <a class="d-flex" href=""><img class="card-img-top" src="{{ asset('assets/images/blog/'.$blog->image) }}" alt=""></a>
                  <div class="card-body p-4">
                    <h4 class="title-blog"><a href="">{{ $blog->title }}</a></h4>

                    <p>{!! $blog->description !!}</p>
                     </div>
                </div>
              </div>
            @endforeach


        </div>

        </div>
        <!-- Middle Panel End -->

        <!-- Right Sidebar
        ============================================= -->
        <aside class="col-lg-4 col-xl-3">
          <!-- Search
		  =============================== -->
          <div class="input-group shadow-sm mb-4">
            <input class="form-control shadow-none border-0 pe-0" type="search" id="search-input" placeholder="Search" value="">
            <span class="input-group-text bg-white border-0 p-0">
              <button class="btn text-muted shadow-none px-3 border-0" type="button"><i class="fa fa-search"></i></button>
            </span>
          </div>


          <!-- Recent Posts
          =============================== -->
          <div class="bg-white shadow-sm rounded p-3 mb-4">
            <h4 class="text-5 fw-400">Recent Posts</h4>
            <hr class="mx-n3">
            <div class="side-post">
                @foreach ($blogs as $blog)
                <div class="item-post">
                    <div class="img-thumb"><a href=""><img class="rounded" src="{{ asset('assets/images/blog/'.$blog->image) }}" height="60px" title="" alt=""></a></div>
                    <div class="caption"> <a href="">{{ $blog->title }}</a>
                      <p class="date-post">{{ \Carbon\Carbon::parse($blog->created_at)->format('Y-m-d') }}</p>
                    </div>
                  </div>
                @endforeach

            </div>
          </div>


        </aside>
        <!-- Right Sidebar End -->

      </div>
    </div>
  </div>
  <!-- Content end -->
    @include('frontend.include.footer')
</div>
@endsection
