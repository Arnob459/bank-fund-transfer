

@extends('frontend.master')
@section('content')

<body>

    <!-- Preloader -->
    <div id="preloader">
      <div data-loader="dual-ring"></div>
    </div>
    <!-- Preloader End -->

    <div id="main-wrapper">
      <div class="container-fluid px-0">
        <div class="row g-0 min-vh-100">
          <!-- Welcome Text
          ============================================= -->
          <div class="col-md-6">
            <div class="hero-wrap d-flex align-items-center h-100">
              <div class="hero-mask opacity-8 bg-primary"></div>
              <div class="hero-bg hero-bg-scroll" style="background-image:url('https://harnishdesign.net/demo/html/payyed/images/bg/image-3.jpg');"></div>
              <div class="hero-content mx-auto w-100 h-100 d-flex flex-column">
                <div class="row g-0">
                  <div class="col-10 col-lg-9 mx-auto">
                    <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex" href="{{ route('index') }}" ><img src="{{ asset('assets/images/logo/'.$gnl->logo) }}"  ></a> </div>
                  </div>
                </div>
                <div class="row g-0 my-auto">
                  <div class="col-10 col-lg-9 mx-auto">
                    <h1 class="text-11 text-white mb-4">Verify Your Account!</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Welcome Text End -->

          <!-- Login Form
          ============================================= -->
          <div class="col-md-6 d-flex align-items-center">
            <div class="container my-4">
              <div class="row g-0">
                <div class="col-11 col-lg-9 col-xl-8 mx-auto">
                  <h3 class="fw-400 mb-4">Verify Your Account</h3>
                  @if(!$user->email_verify)
                  <form class="account-form" action="{{ route('user.verify_email') }}" method="post" id="recaptchaForm">
                      @csrf
                      <div class="row">
                          <div class="form-group">
                              <input type="text" class="form-control" name="email_verified_code" placeholder="Email verification">
                          </div>
                          <div class=" form-group text-center">
                              <button type="submit" id="recaptcha" class="btn btn-success mt-2 mb-2">Verify Code</button>
                          </div>
                          <div class="form-group ">
                              <p><a class="nav-link" href="{{route('user.send_verify_code')}}?type=email">Send Email Code</a></p>
                          </div>
                      </div>
                  </form>

              @elseif(!$user->sms_verify)
                  <form class="account-form" action="{{ route('user.verify_sms') }}" method="post" id="recaptchaForm">
                      @csrf
                      <div class="row">
                          <div class="form-group">
                              <input type="text" class="form-control" name="sms_verified_code" placeholder="SMS verification" >
                          </div>
                          <div class="form-group text-center">
                              <button type="submit" id="recaptcha"  class="btn btn-success mt-2 mb-2">Verify Code</button>
                          </div>

                          <div class="form-group">
                              <p><a class="nav-link" href="{{route('user.send_verify_code')}}?type=phone">Send Verification Code</a></p>
                          </div>
                      </div>
                  </form>

              @elseif(!$user->tv)
                  <form class="account-form" action="{{ route('user.go2fa.verify') }}" method="POST" id="recaptchaForm">
                      @csrf
                      <div class="row">
                          <div class="form-group">
                              <input type="text" name="code" id="pincode-input">
                          </div>

                          <div class="form-group text-center">
                              <button type="submit" id="recaptcha" class="mt-2 mb-2">@lang('Verify Code')</button>
                          </div>
                      </div>
                  </form>
              @endif
                </div>
              </div>
            </div>
          </div>
          <!-- Login Form End -->
        </div>
      </div>
    </div>

    <!-- Back to Top
    ============================================= -->
    <a id="back-to-top" data-bs-toggle="tooltip" title="Back to Top" href="javascript:void(0)"><i class="fa fa-chevron-up"></i></a>

    <!-- Styles Switcher -->
    <div id="styles-switcher" class="left">
      <h2 class="text-3">Color Switcher</h2>
      <hr>
      <ul>
        <li class="blue" data-bs-toggle="tooltip" title="Blue" data-path="https://harnishdesign.net/demo/html/payyed/css/color-blue.css"></li>
        <li class="indigo" data-bs-toggle="tooltip" title="Indigo" data-path="https://harnishdesign.net/demo/html/payyed/css/color-indigo.css"></li>
        <li class="purple" data-bs-toggle="tooltip" title="Purple" data-path="https://harnishdesign.net/demo/html/payyed/css/color-purple.css"></li>
        <li class="pink" data-bs-toggle="tooltip" title="Pink" data-path="https://harnishdesign.net/demo/html/payyed/css/color-pink.css"></li>
        <li class="red" data-bs-toggle="tooltip" title="Red" data-path="https://harnishdesign.net/demo/html/payyed/css/color-red.css"></li>
        <li class="orange" data-bs-toggle="tooltip" title="Orange" data-path="https://harnishdesign.net/demo/html/payyed/css/color-orange.css"></li>
        <li class="yellow" data-bs-toggle="tooltip" title="Yellow" data-path="https://harnishdesign.net/demo/html/payyed/css/color-yellow.css"></li>
        <li class="teal" data-bs-toggle="tooltip" title="Teal" data-path="https://harnishdesign.net/demo/html/payyed/css/color-teal.css"></li>
        <li class="cyan" data-bs-toggle="tooltip" title="Cyan" data-path="https://harnishdesign.net/demo/html/payyed/css/color-cyan.css"></li>
        <li class="brown" data-bs-toggle="tooltip" title="Brown" data-path="https://harnishdesign.net/demo/html/payyed/css/color-brown.css"></li>
      </ul>
      <button class="btn btn-dark btn-sm border-0 fw-400 rounded-0 shadow-none" data-bs-toggle="tooltip" title="Green" id="reset-color">Reset Default</button>
      <button class="btn switcher-toggle"><i class="fas fa-cog"></i></button>
    </div>
    <!-- Styles Switcher End -->

@endsection

