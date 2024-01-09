  <!-- Header
  ============================================= -->
  <header id="header">
    <div class="container">
      <div class="header-row">
        <div class="header-column justify-content-start">
          <!-- Logo
          ============================= -->
          <div class="logo me-3"> <a class="d-flex" href="{{ route('index') }}" title="{{ $gnl->site_name }}"><img src="{{ asset('assets/images/logo/'.$gnl->logo) }}" width="121" height="33"  alt="Payyed" /></a> </div>
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
                    <li><a href="{{ route('aboutus') }}">About Us</a></li>
                    <li><a href="{{ route('blog') }}">blog</a></li>
                    <li><a href="{{ route('help') }}">Help</a></li>

                  </ul>
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
