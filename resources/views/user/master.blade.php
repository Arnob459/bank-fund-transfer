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
                <li class="{{ Route::is('user.contact') ? 'active' : '' }}"><a href="{{ route('user.contact') }}">Help</a></li>
                <li class="{{ Route::is('user.account') ? 'active' : '' }}"><a href="{{ route('user.account') }}">Accounts & Cards</a></li>
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
              {{-- <li class="dropdown language"> <a class="dropdown-toggle" href="#">En</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">English</a></li>
                  <li><a class="dropdown-item" href="#">French</a></li>
                  <li><a class="dropdown-item" href="#">Русский</a></li>
                  <li><a class="dropdown-item" href="#">简体中文</a></li>
                  <li><a class="dropdown-item" href="#">Türkçe</a></li>
                </ul>
              </li> --}}

              <li class="dropdown notifications"> <a class="dropdown-toggle" href="#"><span class="text-5"><i class="far fa-bell"></i></span></a>
                <ul class="dropdown-menu">
                  <li class="text-center text-3 py-2">Notifications</li>
                  <li class="dropdown-divider mx-n3"></li>
                  @foreach ($notifications as $notification)
                  <li><a class="dropdown-item" href="#"><i class="fas fa-bell"></i>{{ $notification->details }} Amount: {{formatter_money($notification->amount) }} {{ $gnl->cur_sym }}<span class="text-1 text-muted d-block">{{ $notification->created_at }}</span></a></li>
                  @endforeach

                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item text-center text-primary px-0" href="{{ route('user.notifications') }}">See all Notifications</a></li>
                </ul>
              </li>

              <li class="dropdown profile ms-2"> <a class="px-0 dropdown-toggle" href="#">
                @if (auth()->user()->avatar == null)
                <img class="avatar-img rounded-circle" src="{{asset('assets/images/users/2.jpg')}}" alt="" height="40px">
                @else
                <img class="avatar-img rounded-circle" src="{{asset('assets/images/users/'.auth()->user()->avatar)}}" alt="" height="40px">
                @endif

            </a>
                <ul class="dropdown-menu">
                  <li class="text-center text-3 py-2">Hi, {{ auth()->user()->name }}</li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user"></i>My Profile</a></li>
                  <li class="dropdown-divider mx-n3"></li>
                  <li><a class="dropdown-item" href="{{ route('user.contact') }}"><i class="fas fa-life-ring"></i>Need Help?</a></li>
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
            @foreach ($socials as $item)
            <li class="social-icons-facebook"><a data-bs-toggle="tooltip" href="{{ $item->url }}" target="_blank" ><i class="{{ $item->icon }}"></i></a></li>
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

