<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Event Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">


    <!-- App css -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/my-extra.css')}}">
    <style>
        .profile-dropdown-items {
            width: 200px;
        }

        .content-page {
            margin: 50px 0px !important;

        }
        #event-info p{
            margin: 22px 0px;
        }
        #close-btn:hover{
            color: #ff5c75;
        }
    </style>
</head>

<body data-layout="topnav" class="body-scroll">
    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
        <div class="navbar navbar-expand flex-column flex-md-row navbar-custom position-fixed w-100 new-shadow-sm">
            <div class="container-fluid">
                <!-- LOGO -->
                <a href="newindex.html" class="navbar-brand mx-2">
                    <span class="logo-lg">
                        <img src="/assets/images/logo.png" alt="" height="24" />
                        <span class="d-inline h3 font-weight-bold">Evento</span>
                    </span>
                </a>

                <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list align-self-center profile-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <div class="media user-profile ">
                                <img src="{{asset('/assets/images/svg-icons/co-ordinate/man.svg')}}" alt="user-image"
                                    class="align-self-center" />
                                <div class="media-body text-left">
                                    <h6 class="ml-2 my-0">
                                        <span>Dr.Akki Maniya</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Co-ordinate
                                        </span>
                                    </h6>
                                </div>
                                <span data-feather="chevron-down" class="ml-3 align-self-center"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                            <a href="newindex.html" class="dropdown-item notify-item my-2">
                                <i data-feather="home" class="icon-dual-primary icon-xs mr-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="newevent.html" class="dropdown-item notify-item my-2">
                                <i data-feather="calendar" class="icon-dual-success icon-xs mr-2"></i>
                                <span>Create Event</span>
                            </a>
                            <a href="create_notice.html" class="dropdown-item notify-item my-2">
                                <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                <span>Create Notice</span>
                            </a>
                            <a href="#" class="dropdown-item notify-item my-2">
                                <i data-feather="key" class="icon-dual-info icon-xs mr-2"></i>
                                <span>Change Password</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual-danger icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
        <!-- end Topbar -->

        <div class="content-page">
            <div class="content d-flex justify-content-center">
                <div class="container-fluid col-lg-6">
                    <div class="card mt-5 new-shadow rounded-lg">
                        <div class="card-body px-5">
                            <a href="{{url('co-ordinate')}}" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <br>
                            <div class="text-center mt-4">
                              <h2 class="font-weight-light"> {{ucfirst($einfo['ename'])}}</h2>
                             <span>{{ucfirst(Session::get('clgname'))}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">{{ucfirst(Session::get('cname'))}}</span>(Co-ordinate)
                            </p>
                            </div>
                            <hr>
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold text-right">Event time</span>
                                    <span>{{date('h:i A',strtotime($einfo['etime']))}}</span>
                                </p>
                                 <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion start date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_start_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion last date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_end_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Type</span>
                                    <span>{{ucfirst($einfo['e_type'])}}</span>
                                </p>
                                @if($einfo['e_type']=="team")
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Team Size</span>
                                    <span>{{$einfo['tsize']}}</span>
                                </p>
                                @endif
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Catagory</span>
                                    <span>{{ucfirst($einfo['category'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event For</span>
                                    <span>{{ucfirst($einfo['gallow'])}}</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>{{ucfirst($einfo['place'])}}</span>
                                </p>
                                <p class="mx-5 text-muted font-size-13">
                                    <br>
                                    <span>
                                        **All the team members have to reach at the {{ucfirst($einfo['place'])}} on {{date('h:i A',strtotime($einfo['etime']))}}  without being late
                                    </span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <!-- <button class="btn btn-success new-shadow rounded-sm font-weight-bold font-size-15 px-4">
                        <span>Print Details </span>
                        <i data-feather="printer" height="20px"></i>
                    </button> -->
                    <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left" title="Print">
                        <a href="#">
                            <img src="{{asset('/assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
    <!-- Vendor js -->
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>

    <!-- optional plugins -->
    <script src="{{asset('/assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('/assets/js/app.min.js')}}"></script>
</body>

</html>
