<?php date_default_timezone_set("Asia/Kolkata"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <style>
    .btn-logout{
        color:#000;
    }
    .btn-logout:hover{
        background:#ff5c751a;
        color: #e34960!important;
    }
    .btn-logout:focus{
        background:#ff5c75;
        color: #fff!important;
    }
    .button-menu-mobile:hover{
        color: gray!important;
    }
    @media (max-width: 767.98px){
        .pro-user-name {
            display: block;
        }
    }
    </style>
</head> 

<body class="body-scroll">

    <!-- Begin page -->
    <div id="wrapper">
            <div class="navbar navbar-expand flex-column align-items-center flex-md-row navbar-custom new-shadow-sm">
                     <div class="container-fluid">
                      <ul class="list-unstyled  mb-0">
                            <li class="nav-item">
                                <button class="button-menu-mobile open-left mr-4 text-dark position-fixed" style="top:0;left:10px;">
                                    <i data-feather="menu" class="menu-icon"></i>
                                </button>

                            </li>
                            <li class="nav-item">
                                <a href="/index" class="navbar-brand logo align-items-center pb-0">
                                    <span class="position-fixed" style="top:20px;left:75px;">
                                        <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                                        <span class="d-inline h2 text-dark font-weight-bold">Evento</span>
                                    </span>
                                    <!-- <span class="logo-sm mt-1 mr-3">
                                        <img src="{{asset('assets/images/logo.png')}}" alt="" height="24">
                                    </span> -->
                                </a>
                            </li>
                            
                        </ul>
                        <!-- LOGO -->
                        
                      
                        <ul class="ml-auto list-unstyled topnav-menu d-lg-none d-sm-flex align-items-center">
                            <li class="ml-5" style="margin-top:20px;">
                                <img src="{{asset('assets/images/logo.png')}}" height="22px" alt="Evento" />
                                <span class="d-inline h3 font-weight-bold">Evento</span>
                            </li>
                        </ul>

                        
                        <ul class="ml-auto list-unstyled mb-0">
                            <li class="nav-item">
                                <a href="/logout" class="nav-link btn btn-logout  p-2 btn-rounded px-md-3">
                                    <i data-feather="log-out" height="18px"></i>
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

                        <div class="media-body mx-auto mt-3 font-weight-bold text-center">
                            <span href="#" class="pro-user-name text-dark user-link font-size-14">
                                {{ucfirst(Session::get('sname'))}}
                            </span>
                            <div class="text-muted mt-1 text-center pro-user-name font-size-13">Student</div>
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
                                        <span>Winner List </span>
                                    </a>
                                </li>
                                <?php
                                    $lastevent=App\tblstudent::select('last_noti')->where('senrl',Session::get('senrl'))->first();
                                    $count=\DB::table('tblnotice')->select('nid')->where([['nid','>',$lastevent->last_noti],['receiver','like','%student%'],['clgcode',Session::get('clgcode')]])->count();
                                ?>
                                <li class="mt-3">
                                    <a href="{{url('/notice')}}" class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i data-feather="clipboard"></i>
                                        <span>Notice </span>
                                    </div>
                                    @if($count>0)
                                        <span class="badge badge-danger rounded-lg">{{$count}}</span>
                                    @endif
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
