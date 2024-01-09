<body id="toggle-dark">
    <div id="app" >


<div id="sidebar" class="active">


    <div class="sidebar-wrapper  active">

            <div class=" d-flex justify-content-center m-4 " >
                    <a href="{{ route('admin.dashboard') }}"><img height="50vh" src="{{asset('assets/images/logo/'. $gnl->logo )}}" alt="Logo" srcset=""></a>
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
                class="sidebar-item {{ Route::is('admin.accounts') ? 'active' : '' }}">
                <a href="{{ route('admin.accounts') }}" class="sidebar-link">
                    <i class="fas fa-university"></i>
                    <span>accounts</span>
                </a>
            </li>

                <li
                class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="far fa-arrow-alt-circle-left"></i>
                    <span>Requests</span>
                </a>
                <ul class="submenu ">

                    <li class="submenu-item {{ Route::is('admin.ownbank.request.pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.request.pending') }}">Pending Requests</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.request.approved') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.request.approved') }}">Approved Requests</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.request.rejected') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.request.rejected') }}">Rejected Requests</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.request.log') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.request.log') }}">All Requests</a>
                    </li>
                </ul>
                </li>

                <li
                class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fas fa-random"></i>
                    <span>Send Money</span>
                </a>
                <ul class="submenu ">

                    <li class="submenu-item {{ Route::is('admin.ownbank.transfer.pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.transfer.pending') }}">Pending transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.transfer.approved') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.transfer.approved') }}">Approved transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.transfer.rejected') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.transfer.rejected') }}">Rejected transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.ownbank.transfer.log') ? 'active' : '' }}">
                        <a href="{{ route('admin.ownbank.transfer.log') }}">All transfers</a>
                    </li>
                </ul>
                </li>
                <li class="sidebar-item {{ Route::is('admin.banks.index') ? 'active' : '' }}">
                <a href="{{ route('admin.banks.index') }}" class="sidebar-link">
                    <i class="fas fa-university"></i>
                    <span> Banks</span>
                </a>
                </li>

                <li class="sidebar-item {{ Route::is('admin.branches') ? 'active' : '' }}">
                <a href="{{ route('admin.branches') }}" class="sidebar-link">
                    <i class="fas fa-code-branch"></i>
                    <span> Branch</span>
                </a>
                </li>

                <li class="sidebar-item {{ Route::is('admin.card.types') ? 'active' : '' }}">
                    <a href="{{ route('admin.card.types') }}" class="sidebar-link">
                        <i class="fas fa-credit-card"></i>
                        <span> Card Type</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Route::is('admin.cards') ? 'active' : '' }}">
                    <a href="{{ route('admin.cards') }}" class="sidebar-link">
                        <i class="fas fa-address-card"></i>
                        <span> Cards</span>
                    </a>
                </li>

                <li
                class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fas fa-random"></i>
                    <span>Transfer/Other Banks</span>
                </a>
                <ul class="submenu ">

                    <li class="submenu-item {{ Route::is('admin.transfer.pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.transfer.pending') }}">Pending transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.transfer.approved') ? 'active' : '' }}">
                        <a href="{{ route('admin.transfer.approved') }}">Approved transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.transfer.rejected') ? 'active' : '' }}">
                        <a href="{{ route('admin.transfer.rejected') }}">Rejected transfers</a>
                    </li>
                    <li class="submenu-item {{ Route::is('admin.transfer.log') ? 'active' : '' }}">
                        <a href="{{ route('admin.transfer.log') }}">All transfers</a>
                    </li>
                </ul>
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



                <li class="sidebar-title">Home Management</li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-book"></i>
                        <span>Home Page</span>
                    </a>
                    <ul class="submenu ">

                         <li class="submenu-item {{ Route::is('admin.slider') ? 'active' : '' }}">
                            <a href="{{ route('admin.slider') }}">Slider</a>
                        </li>



                       <li class="submenu-item {{ Route::is('admin.about') ? 'active' : '' }}">
                            <a href="{{ route('admin.about') }}">About Us</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.counter') ? 'active' : '' }}">
                            <a href="{{ route('admin.counter') }}">Counter Section</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.work') ? 'active' : '' }}">
                            <a href="{{ route('admin.work') }}">How it's Work</a>
                        </li>
                         <li class="submenu-item {{ Route::is('admin.faq') ? 'active' : '' }}">
                            <a href="{{ route('admin.faq') }}">Faq </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.choose') ? 'active' : '' }}">
                            <a href="{{ route('admin.choose') }}">Why Choose Us </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.testimonial') ? 'active' : '' }}">
                            <a href="{{ route('admin.testimonial') }}">Testimonial</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.blog') ? 'active' : '' }}">
                            <a href="{{ route('admin.blog') }}">Blog</a>
                        </li>

                        <li class="submenu-item {{ Route::is('admin.privacy') ? 'active' : '' }}">
                            <a href="{{ route('admin.privacy') }}">Privacy </a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.terms') ? 'active' : '' }}">
                            <a href="{{ route('admin.terms') }}">Terms</a>
                        </li>

                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-envelope"></i>
                        <span>Email Manager</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item {{ Route::is('admin.global-template') ? 'active' : '' }}">
                            <a href="{{ route('admin.global-template') }}">Global Templete</a>
                        </li>
                        <li class="submenu-item {{ Route::is('admin.email-template') ? 'active' : '' }}">
                            <a href="{{ route('admin.email-template') }}">Email Templetes</a>
                        </li>
                         <li class="submenu-item {{ Route::is('admin.email-template-setting') ? 'active' : '' }}">
                            <a href="{{ route('admin.email-template-setting') }}">Email Configure</a>
                        </li>

                    </ul>
                </li>
                {{-- <li
                    class="sidebar-item {{ Route::is('admin.language-manage') ? 'active' : '' }} ">
                    <a href="{{ route('admin.language-manage') }}" class="sidebar-link">
                        <i class="fas fa-language"></i>
                        <span>Language Manager </span>
                    </a>
                </li> --}}



            </ul>
        </div>
    </div>

</div>
