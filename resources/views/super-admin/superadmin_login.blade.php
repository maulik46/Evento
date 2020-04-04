<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Log-in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">


    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/my-extra.css')}}">
    <style>
        body {
            background-image:url('../assets/images/super_admin_bg.png');
        }

        .content-page {
            margin: 50px 0px !important;

        }

        .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 10px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 45px;
            cursor: text !important;
        }

        .form-control:focus {
            background-color: #f3f4f79a !important;
        }
        #see-pass:hover,
        #hide-pass:hover{
            color: #333;
        }
        .f-pass a:hover{
            color:var(--info)!important;
        }
    </style>
</head>

<body data-layout="topnav" class="body-scroll" style="height: 90vh!important;">
    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
        <div class="navbar navbar-expand flex-column flex-md-row navbar-custom position-fixed w-100 new-shadow-sm"
            style="height: 60px;">
            <div class="container-fluid">
                <!-- LOGO -->
                <a href="superadmin_login.html" class="navbar-brand mx-auto">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo.png')}}" alt="Evento" height="24" />
                        <span class="d-inline h2 text-dark font-weight-bold">Evento</span>
                    </span>
                </a>
            </div>

        </div>
        <!-- end Topbar -->

        <div class="content-page">
            <div class="content d-flex justify-content-center">
                <div class="container-fluid pt-3 col-xl-4 col-lg-5 col-md-8 col-sm-10">
                    <div class="card mt-5 shadow rounded-lg px-1">
                        <div class="card-body px-xl-4">

                            <h4 class="my-4 text-center text-dark d-flex flex-column">
                                <img src="{{asset('assets/images/svg-icons/super-admin/man1.svg')}}" alt="user" height="45px">
                                <span>Log-in</span>
                                <span class="font-size-12 text-muted mt-1">for Admin</span>
                            </h4>
                            <form action="{{ url('a_checklogin') }}" onsubmit="return check()" method="post">
                                @csrf
                                <p id="error" class="text-center text-danger font-weight-bold">{{Session::get('error')}}</p>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Email</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="text" name="auser" id="uid" class="form-control" placeholder="Enter Your Email" />
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" name="password" id="my-password" class="form-control"
                                           placeholder="Enter Your Password"  style="padding-right: 2.375rem;">
                                        <div class="position-relative" style="right:40px;bottom: 10px;">
                                        <a href="#">
                                            <i data-feather="eye" class="ml-2 form-control-icon" height="19px" id="see-pass"></i> 
                                        </a>
                                        <a href="#">      
                                            <i data-feather="eye-off" class="ml-2 form-control-icon" height="19px" id="hide-pass"></i>
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-start">
                                <button type="submit"
                                    class="hover-me-sm btn btn-info rounded-sm new-shadow font-weight-bold px-3 mt-1 mb-3" style="background-color: #35bbca;">
                                    <span class="font-size-14">Log-in</span>
                                    <i data-feather="log-in" height="20px"></i>
                                </button>
                                <div class="text-right font-weight-bold f-pass">
                                    <a href="{{url('/a_resetpassword')}}" class="text-muted">Forgot Password?</a>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <!-- optional plugins -->
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $('#hide-pass').hide(); 
        $('#see-pass').click(function() {
            $('#my-password').attr('type', 'text');
            $('#hide-pass').show();
            $('#see-pass').hide();
        });
        $('#hide-pass').click(function() {
            $('#my-password').attr('type', 'password');
            $('#hide-pass').hide();
            $('#see-pass').show();
        });
    });
    function check()
    {
        if($('#uid').val()=="")
        {
            $('#error').html("Plese Enter your ID or Email...");
            return false;
        }
        if($('#my-password').val()=="")
        {
            $('#error').html("Plese Enter your password...");
            return false;
        }
    }
    </script>
</body>

</html>
