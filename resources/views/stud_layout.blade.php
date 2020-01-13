<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet">
    @section('head-tag-links')

    <!-- this section is for extra css links in some particuler page but not in all page -->

    @show
</head>

<body class="body-scroll">

    <!-- Begin page -->
    <div id="wrapper">
            <div class="navbar navbar-expand flex-column align-items-center flex-md-row navbar-custom new-shadow-sm">
                    <div class="container-fluid">
                        <!-- LOGO -->
                        <a href="/index" class="navbar-brand mr-0 mr-md-2 logo">
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                                <span class="d-inline h2 font-weight-bold">Evento</span>
                            </span>
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/logo.png')}}" alt="" height="24">
                            </span>
                        </a>
                        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
                            <li class="nav-item">
                                <button class="button-menu-mobile open-left disable-btn">

                                    <i data-feather="menu" class="menu-icon"></i>
                                    <!-- <i data-feather="x" class="close-icon"></i> -->

                                </button>

                            </li>
                        </ul>
                        <ul class="navbar-nav  ml-auto list-unstyled topnav-menu mb-0 d-lg-none d-sm-flex">
                            <li class="mr-5">
                                <img src="{{asset('assets/images/logo.png')}}" height="20px" alt="Evento" />
                                <span class="d-inline h4 font-weight-bold">Evento</span>
                            </li>
                        </ul>

                        
                        <ul class="navbar-nav  ml-auto list-unstyled topnav-menu mb-0">
                            <li data-toggle="tooltip" data-placement="bottom" title="Log-out" class="nav-item">
                                <a href="/logout" class="nav-link">
                                    <i data-feather="log-out"></i>
                                    <span class="d-none d-md-inline-flex d-lg-inline-flex">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>

            </div>

            <div class="left-side-menu">
                    <div class="media user-profile d-flex flex-column align-items-center mt-2 mb-2">
                    @if(Session::get('gender')=='male')
                        <img src="{{asset('assets/images/avatars/man.svg')}}" class="avatar-md d-block mx-auto" alt="User" />
                        @else
                        <img src="{{asset('assets/images/avatars/woman.svg')}}" class="avatar-md d-block mx-auto" alt="User" />
                    @endif

                        <div class="media-body mx-auto mt-3" data-toggle="tooltip" data-placement="bottom" title="Profile">
                            <a href="#" class="pro-user-name text-dark user-link font-size-16">
                                {{ucfirst(Session::get('sname'))}}
                            </a>
                            <div class="text-muted mt-1 text-center pro-user-name">Student</div>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <ul class="metismenu" id="menu-bar">

                                <li class="my-3">
                                    <a href="{{url('/index')}}">
                                        <i data-feather="home"></i>
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/profile')}}">
                                        <i data-feather="user"></i>
                                        <span> My Profile </span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/winner-list')}}">
                                        <i data-feather="award"></i>
                                        <span> Winner List </span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/notice')}}">
                                        <i data-feather="clipboard"></i>
                                        <span> Notice </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Sidebar -->
                    </div>
                    <!-- Sidebar -left -->

            </div>


        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('my-content')
                </div>
            </div>
        </div> <!-- content-page -->

    </div> <!-- end wrapper tag -->


    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <script src="{{asset('assets/js/vendor.min.js')}}"></script>


    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>


    <script src="{{asset('assets/js/app.min.js')}}"></script>

    @section('extra-scripts')

    <!-- this section is for extra scripts links in some particuler page but not in all page -->

    @show
</body>
</html>
