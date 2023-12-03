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
                <li
                class="sidebar-item {{ Route::is('admin.banks.index') ? 'active' : '' }}">
                <a href="{{ route('admin.banks.index') }}" class="sidebar-link">
                    <i class="fas fa-university"></i>
                    <span>Banks</span>
                </a>
            </li>

                <li class="sidebar-title">MANAGE USERS</li>

                <li
                    class="sidebar-item has-sub">
                    <a href="" class='sidebar-link'>
                        <i class="fas fa-users-cog"></i>
                        <span>Users Management</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.allusers') ? 'active' : '' }} ">
                            <a href="{{ route('admin.allusers') }}">All Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.activeusers') ? 'active' : '' }} ">
                            <a href="{{ route('admin.activeusers') }}">Active Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.pendingusers') ? 'active' : '' }}">
                            <a href="{{ route('admin.pendingusers') }}">Pending Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.blockedusers') ? 'active' : '' }}">
                            <a href="{{ route('admin.blockedusers') }}">Block Users</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.kycunverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.kycunverified') }}">Kyc Unverified</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.kycverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.kycverified') }}">Kyc Verified</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.emailunverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.emailunverified') }}">Email Unverified</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.smsunverified') ? 'active' : '' }}">
                            <a href="{{ route('admin.smsunverified') }}">Sms Unverified</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-title">BASIC SETTINGS</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-cogs"></i>
                        <span>Basic Settings</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.settings') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings') }}">Basic</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.logo') ? 'active' : '' }}">
                            <a href="{{ route('admin.logo') }}">Logo & favicon</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.contact') ? 'active' : '' }}">
                            <a href="{{ route('admin.contact') }}">Contact</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.social.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.social.create') }}">Social</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.footer') ? 'active' : '' }}">
                            <a href="{{ route('admin.footer') }}">Footer Section</a>
                        </li>

                    </ul>
                </li>



            </ul>
        </div>
    </div>

</div>
