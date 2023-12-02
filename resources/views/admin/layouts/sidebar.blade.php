<body id="toggle-dark">
    <div id="app" >


<div id="sidebar" class="active">


    <div class="sidebar-wrapper  active">

            <div class=" d-flex justify-content-center m-4 " >
                    <a href="{{ route('admin.dashboard') }}"><img height="50vh" src="{{asset('assets/images/logo/'. $gnl->favicon )}}" alt="Logo" srcset=""></a>
            </div>

                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>


        <div class="sidebar-menu">
            <ul class="menu">


                <li
                    class="sidebar-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>



            </ul>
        </div>
    </div>

</div>
