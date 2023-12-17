<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $gnl->site_name }} - {{ $page_title }} </title>

    <link rel="stylesheet" href="{{ asset('assets/admin/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/' .$gnl->favicon)}}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/shared/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fontawesome-5.15.4/css/all.min.css') }}">
    @stack('css_link')


    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/toastr/css/toastr.css') }}">

</head>

@include('admin.layouts.sidebar')
    <div id="main">
        <header class='mb-3'>
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <a href="#" class="burger-btn d-block">
                        <i class="bi bi-justify fs-3"></i>
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <div class=" navbar-nav ms-auto mb-lg-0 dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">

                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('assets/admin/images/profile/'.auth()->guard('admin')->user()->image) }}">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                <li>
                                    <h6 class="text-center" > {{auth()->guard('admin')->user()->name}} </h6>
                                    <h6 class="dropdown-header"> {{auth()->guard('admin')->user()->email}} </h6>
                                    <hr class="dropdown-divider">

                                </li>
                                <li><a class="dropdown-item" href="{{  route('admin.profile') }}"><i class="icon-mid bi bi-person me-2"></i> My
                                        Profile</a></li>
                                <li><a class="dropdown-item" href="{{  route('admin.password') }}"><i class="icon-mid bi bi-gear me-2"></i>
                                        Change Password</a></li>

                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i
                                            class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="page-heading">
            <div class="page-title mb-4">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">

                    @if ($page_title == 'Dashboard')
                    <h3>Welcome back, Admin!</h3>
                    @else
                    <h3>{{ $page_title }}</h3>
                    @endif

                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        @stack('button')
                    </nav>
                </div>
            </div>
            </div>

@yield('content')



<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; {{ $gnl->site_name }}</p>
        </div>

    </div>
</footer>
</div>
</div>
<script src="{{ asset('assets/admin/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/admin/extensions/jquery/jquery.min.js') }}"></script>



<script src="{{ asset('assets/admin/toastr/js/toastr.js') }}"></script>


    <script>
        @if (Session::has('success'))
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.success("{{ Session('success') }}");
        @endif
    </script>
    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)

                toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{ $error }}");

            @endforeach

        </script>
    @endif


@stack('datatable')
@stack('js')
@stack('reward')
@stack('ref')
@stack('nicEdit')

</body>

</html>
