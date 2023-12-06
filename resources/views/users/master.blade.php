<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $gnl->site_name }} | {{ $page_title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">


    {{-- <link rel="stylesheet" href="{{ asset('assets/frontend/bootstrap5/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/fontawesome-5.15.4/css/all.min.css') }}">
    <!-- Toastr CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/toastr/css/toastr.css') }}"> --}}



    <link rel="shortcut icon" href="{{ asset('assets/images/logo/'.$gnl->favicon) }}" type="image/x-icon">
</head>
        @if(session()->has('toastr'))
        {!! session('toastr') !!}
        @endif

<body>
    <div class="main--body dashboard-bg">
        <!--========== Preloader ==========-->
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <!--========== Preloader ==========-->


        <!--=======SideHeader-Section Starts Here=======-->
        <div class="notify-overlay"></div>
        <section class="dashboard-section">
            <div class="side-header oh">
                <div class="cross-header-bar d-xl-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="site-header-container">
                    <div class="side-logo mt-2">
                        <a href="">
                            <img src="{{ asset('assets/images/logo/'.$gnl->logo) }}" alt="logo">
                        </a>
                    </div>
                    <ul class="dashboard-menu">

                        <li class="nav-item">Request Money
                        </li>
                        <li class="nav-item"><a class="nav-link {{  Route::is('user.ownbank.requestmoney') ? 'active' : ''  }}"href="{{route('user.ownbank.requestmoney')}}"><i class="flaticon-atm"></i>Request Money</a>
                        <li class="nav-item">Send Money
                        </li>
                        <li class="nav-item"><a class="nav-link {{  Route::is('user.ownbank.sendmoney') ? 'active' : ''  }}"href="{{route('user.ownbank.sendmoney')}}"><i class="flaticon-atm"></i>Own Bank</a>
                        </li>

                        <li class="nav-item"><a class="nav-link {{  Route::is('user.sendmoney') ? 'active' : ''  }}"href="{{route('user.sendmoney')}}"><i class="flaticon-atm"></i>Others Bank</a>
                        </li>


                    </ul>
                </div>
            </div>


            <div class="dasboard-body">
                <div class="dashboard-hero">
                    <div class="header-top">
                        <div class="container">
                            <div class="mobile-header d-flex justify-content-between d-lg-none align-items-center">
                                <div class="author">
                                    <img src="" alt="dashboard">
                                </div>
                                <div class="cross-header-bar">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                            <div class="mobile-header-content d-lg-flex flex-wrap justify-content-lg-between align-items-center">
                                <ul class="support-area">
                                    <li>
                                        {{-- <a href="{{ route('user.support') }}"><i class="flaticon-support"></i>Support</a> --}}
                                    </li>
                                    <li>
                                        <a href="Mailto:{{$gnl_extra->contact_email}}"><i class="flaticon-email"></i><span class="__cf_email__" data-cfemail="f49d9a929bb49c8d9d8498959a90da979b99">[email&#160;protected]</span> </a>
                                    </li>
                                    <li>
                                        <i class="flaticon-globe"></i>
                                        <div class="select-area">
                                            <select class="select-bar" style="display: none;">
                                                <option value="en">English</option>
                                                <option value="bn">Bangla</option>
                                                <option value="sp">Spanish</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                                <div class="dashboard-header-right d-flex flex-wrap justify-content-center justify-content-sm-between justify-content-lg-end align-items-center">

                                    <ul class="dashboard-right-menus">
                                        <li>
                                            <a href="#0" class="author nav-link">
                                                <div class="thumb">
                                                        @if (auth()->user()->avatar == null)
                                                        <img  src="{{asset('assets/images/user.png')}}" alt="">
                                                        @else
                                                            <img src="{{asset('assets/images/users/'.auth()->user()->avatar)}}" >
                                                        @endif
                                                    <span class="checked">
                                                        <i class="flaticon-checked"></i>
                                                    </span>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title">{{ auth()->user()->name}}</h6>
                                                </div>
                                            </a>
                                            <div class="notification-area">
                                                <div class="author-header">
                                                    <div class="thumb">
                                                        @if (auth()->user()->avatar == null)
                                                        <img  src="{{asset('assets/images/user.png')}}" alt="">
                                                        @else
                                                            <img src="{{asset('assets/images/users/'.auth()->user()->avatar)}}" >
                                                        @endif
                                                    </div>
                                                    <h6 class="title">{{ auth()->user()->name}}</h6>
                                                    <span class="__cf_email__">{{ auth()->user()->email }}</span>
                                                </div>
                                                <div class="author-body">
                                                    <ul>
                                                        <li>
                                                            <a href="{{route('user.profile')}}"><i class="far fa-user"></i>Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('user.profile.edit')}}"><i class="fas fa-user-edit"></i>Edit Profile</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{route('user.change.password')}}"><i class="fas fa-lock"></i>Change Password</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt"></i>Log Out</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                        @yield('content')

                        <div class="container-fluid sticky-bottom">
                            <div class="footer-bottom">
                                <div class="footer-bottom-area">
                                    <div >
                                        <p>{{__($gnl->copy_section)}}</p>
                                    </div>
                                    <ul class="social-icons">
                                        @foreach ($socials as $social)
                                        <li>
                                            <a href="{{$social->url}}">
                                                <i class="{{$social->icon}}"></i>
                                            </a>
                                        </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <script src="{{ asset('assets/admin/extensions/jquery/jquery.min.js') }}"></script> --}}

                        <script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/modernizr-3.6.0.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
                        {{-- <script src="{{ asset('assets/frontend/bootstrap5/js/bootstrap.min.js') }}"></script> --}}

                        <script src="{{ asset('assets/frontend/js/magnific-popup.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/wow.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/odometer.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/viewport.jquery.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/nice-select.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/owl.min.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/paroller.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/chart.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/circle-progress.js') }}"></script>
                        <script src="{{ asset('assets/frontend/js/main.js') }}"></script>


                        {{-- <script src="{{ asset('assets/admin/toastr/js/toastr.js') }}"></script> --}}
                        <script src="{{ asset('assets/frontend/bootstrap-notify-master/bootstrap-notify.js') }}"></script>
                        <script src="{{ asset('assets/frontend/bootstrap-notify-master/bootstrap-notify.min.js') }}}"></script>


                        @stack('js')

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

                        {{-- <script>
                            @if (Session::has('success'))
                                toastr.options = {
                                    "progressBar": true,
                                    // "closeButton": true,
                                }
                                toastr.success("{{ Session('success') }}");
                            @endif
                            @if (Session::has('error'))
                                toastr.options = {
                                    "progressBar": true,
                                    // "closeButton": true,
                                }
                                toastr.error("{{ Session('error') }}");
                            @endif
                        </script> --}}

                    </body>


                    <!-- Mirrored from pixner.net/hyipland/demo/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Sep 2023 12:11:00 GMT -->
                    </html>
