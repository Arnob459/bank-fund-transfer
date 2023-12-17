

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
                    <h1 class="text-11 text-white mb-4">Welcome back!</h1>
                    <p class="text-4 text-white lh-base mb-5">We are glad to see you again! </p>
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
                  <h3 class="fw-400 mb-4">Log In</h3>
                  <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" name="username" class="form-control @error('username') is-invalid @enderror" id="username" required placeholder="Enter Your Username">
                      @error('username')
                      <span >
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>


                    <div class="mb-3">
                      <label for="loginPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" name="password" class="form-control @error('password') is-invalid @enderror" id="loginPassword" required placeholder="Enter Password">
                      @error('password')
                      <span >
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>


                    <div class="row mb-3">
                      <div class="col-sm">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" id="remember-me" name="remember" type="checkbox">
                          <label class="form-check-label" for="remember-me">Remember Me</label>
                        </div>
                      </div>
                      @if (Route::has('password.request'))
                      <div class="col-sm text-end"><a class="btn-link" href="{{ route('password.request') }}">Forgot Password ?</a></div>
                      @endif

                    </div>
                    <div class="d-grid mb-3"><button class="btn btn-primary" type="submit">Login</button></div>
                  </form>
                  <p class="text-3 text-center text-muted">Don't have an account? <a class="btn-link" href="{{ route('register') }}">Sign Up</a></p>
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
