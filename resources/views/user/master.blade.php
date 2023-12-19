<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{ asset('assets/images/logo/'.$gnl->favicon) }}" rel="icon" />
<title>{{ $gnl->site_name }}- {{$page_title?? ''}}</title>
<meta name="description" content="This professional design html template is for build a Money Transfer and online payments website.">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
============================================= -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

<!-- Stylesheet
============================================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/fontawesome/css/all.min.css') }}" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/stylesheet.css') }}" />
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#" />

</head>
@if(session()->has('toastr'))
        {!! session('toastr') !!}
        @endif
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
          <div class="logo me-3"> <a class="d-flex" href="{{ route('user.home') }}"><img src="{{ asset('assets/images/logo/'.$gnl->logo) }}"  /></a> </div>
          <!-- Logo end -->
          <!-- Collapse Button
          ============================== -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav"> <span></span> <span></span> <span></span> </button>
          <!-- Collapse Button end -->

          <!-- Primary Navigation
          ============================== -->
          <nav class="primary-menu navbar navbar-expand-lg">
            <div id="header-nav" class="collapse navbar-collapse">
              <ul class="navbar-nav me-auto">
                <li class="{{ Route::is('user.home') ? 'active' : '' }}"><a href="{{ route('user.home') }}">Dashboard</a></li>
                <li class="{{ Route::is('user.transections') ? 'active' : '' }}"><a href="{{ route('user.transections') }}">Transactions</a></li>
                <li class="{{ Str::startsWith(request()->route()->getName(), 'user.ownbank') ? 'active' : '' }}"><a href="{{ route('user.ownbank.sendmoney') }}">Send/Request</a></li>
                <li><a href="{{ route('index') }}">Help</a></li>
                <li class="{{ Route::is('user.account') ? 'active' : '' }}"><a href="{{ route('user.account') }}">Accounts</a></li>
                <li class="{{ Route::is('user.requests') ? 'active' : '' }}"><a href="{{ route('user.requests') }}">Requests</a></li>



              </ul>
            </div>
          </nav>
          <!-- Primary Navigation end -->
        </div>
        <div class="header-column justify-content-end">
          <!-- My Profile
          ============================== -->
          <nav class="login-signup navbar navbar-expand">
            <ul class="navbar-nav">
              <li class="dropdown language"> <a class="dropdown-toggle" href="#">En</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">English</a></li>
                  <li><a class="dropdown-item" href="#">French</a></li>
                  <li><a class="dropdown-item" href="#">Русский</a></li>
                  <li><a class="dropdown-item" href="#">简体中文</a></li>
                  <li><a class="dropdown-item" href="#">Türkçe</a></li>
                </ul>
              </li>

              <li class="dropdown profile ms-2"> <a class="px-0 dropdown-toggle" href="#"><img class="rounded-circle" src="https://harnishdesign.net/demo/html/payyed/images/profile-thumb-sm.jpg" alt=""></a>
                <ul class="dropdown-menu">
                  <li class="text-center text-3 py-2">Hi, {{ auth()->user()->name }}</li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="https://harnishdesign.net/demo/html/payyed/settings-profile.html"><i class="fas fa-user"></i>My Profile</a></li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="{{ route('index') }}"><i class="fas fa-life-ring"></i>Need Help?</a></li>
                  <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Sign Out</a></li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- My Profile end -->
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->

  @yield('content')

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
            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
            <li class="social-icons-twitter"><a data-bs-toggle="tooltip" href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
            <li class="social-icons-google"><a data-bs-toggle="tooltip" href="http://www.google.com/" target="_blank" title="Google"><i class="fab fa-google"></i></a></li>
            <li class="social-icons-youtube"><a data-bs-toggle="tooltip" href="http://www.youtube.com/" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a></li>
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

<!-- Script -->
<!-- Script -->
<script src="{{ asset('assets/frontend/jquery/jquery.min.js') }}" ></script>
<script src="{{ asset('assets/frontend/js/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}" ></script>
<!-- Style Switcher -->
<script src="{{ asset('assets/frontend/js/switcher.min.js') }}" ></script>
<script src="{{ asset('assets/frontend/js/theme.js') }}" ></script>
@stack('js')
<script src="{{ asset('assets/frontend/bootstrap-notify-master/bootstrap-notify.js') }}"></script>
<script src="{{ asset('assets/frontend/bootstrap-notify-master/bootstrap-notify.min.js') }}}"></script>


@if (session()->has('success'))
    <script>
        var content = {};

        content.message = '{{session('success')}}';
        content.title = 'Success!!';
        content.icon = 'fa fa-bell';

        $.notify(content, {
            type: 'success',
            placement: {
                from: 'top',
                align: 'right'
            },

            time: 1000,
            delay: 4000,
        });
    </script>
@endif

@if (session()->has('warning'))
        <script>
            var content = {};

            content.message = '{{session('warning')}}';
            content.title = 'Warning!!';
            content.icon = 'fa fa-bell';

            $.notify(content, {
                type: 'warning',
                placement: {
                    from: 'top',
                    align: 'right'
                },

                time: 1000,
                delay: 40000,
            });
        </script>
@endif


@if ($errors->any())
    <script>
            @foreach ($errors->all() as $error)
        var content = {};

        content.message = '{{ $error }}';
        content.title = 'Error!!';
        content.icon = 'fa fa-bell';

        $.notify(content, {
            type: 'danger',
            placement: {
                from: 'top',
                align: 'right'
            },

            time: 500,
            delay: 4000,
        });
        @endforeach

    </script>
@endif
</body>

</html>

