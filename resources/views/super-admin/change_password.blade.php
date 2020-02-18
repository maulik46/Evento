<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Change Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">


    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/my-extra.css">
    <style>
        .profile-dropdown-items {
            width: 200px;
        }

        .content-page {
            margin: 50px 0px !important;

        }

        #event-info p {
            margin: 22px 0px;
        }

        #close-btn:hover {
            color: #ff5c75;
        }

        .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 10px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 50px;
            cursor: text !important;
        }

        /* box-shadow: 0 0 2px black; */

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }

        .border-form {
            border: 1px solid #d1d1d152;
            border-radius: .5rem;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid gainsboro;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #43d39e;
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
                <a href="index.html" class="navbar-brand mx-2">
                    <span class="logo-lg">
                        <img src="../assets/images/logo.png" alt="" height="24" />
                        <span class="d-inline h3 font-weight-bold">Evento</span>
                        <h6 class="my-0 text-muted font-size-12 d-sm-none d-md-none" style="margin-left: 30px;">
                            Super-admin</h6>
                    </span>
                </a>

                <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list align-self-center profile-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <div class="media user-profile ">
                                <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image"
                                    class="align-self-center" />
                                <div class="media-body text-left d-none d-sm-block">
                                    <h6 class="ml-2 my-0">
                                        <span>Mr.Yash Parmar</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Super-admin
                                        </span>
                                    </h6>
                                </div>
                                <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                            <div class="media dropdown-item d-sm-none d-md-none">
                                <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image"
                                    height="40px" class="align-self-center" />
                                <div class="media-body text-left">
                                    <h6 class="ml-2 my-0">
                                        <span>Mr.Yash Parmar</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Co-ordinator
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="dropdown-divider d-sm-none d-md-none"></div>
                            <a href="newindex.html" class="dropdown-item notify-item mb-2">
                                <i data-feather="home" class="icon-dual-primary icon-xs mr-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="newevent.html" class="dropdown-item notify-item my-2">
                                <i data-feather="user-plus" class="icon-dual-success icon-xs mr-2"></i>
                                <span>Add Co-ordinator</span>
                            </a>
                            <a href="new_notice.html" class="dropdown-item notify-item my-2">
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
                <div class="container-fluid pt-3 col-lg-5 col-md-8 col-sm-8">
                    <div class="card mt-4 new-shadow rounded-lg px-1">
                        <div class="card-body px-lg-4">
                            <a href="index.html" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <h4 class="my-4 text-center text-dark">
                                <img src="../assets/images/svg-icons/co-ordinate/lock.svg" height="22px" alt="">
                                <span> Change Password</span>
                            </h4>
                           <form method="post" action="change_pass" onsubmit="return check()">
                           @csrf
                           <p id="error" class="text-center text-danger">{{Session::get('error')}}</p>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Current Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" name="current_pass" id="curpass" class="form-control"
                                            placeholder="Enter Your Current Password..." />
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">New Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="unlock" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" class="form-control" name="npass" id="npass"
                                            placeholder="Enter New Password..." />
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Confirm Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="check-circle" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" class="form-control" name="cpass" id="cpass"
                                            placeholder="Enter Password Again..." />
                                    </div>
                                </div>
                                <button type="submit"
                                    class="hover-me-sm btn btn-info rounded-sm new-shadow-sm font-weight-bold px-3 mt-2 mb-3" style="background-color: #35bbca;">
                                    Change Password
                                    <i data-feather="check-square" height="20px"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    function check()
    {
        if($('#curpass').val()=="")
        {
            $('#error').html("Plese Enter your current password");
            return false;
        }
        if($('#npass').val()=="")
        {
            $('#error').html("Plese Enter your New password");
            return false;
        }
        else if($('#npass').val().length <= 6)
        {
            $('#error').html("New password length must be greater then 6 character");
            return false;
        }
        if($('#cpass').val()=="")
        {
            $('#error').html("Please Re-Enter your New password");
            return false;
        }
    }
</script>
    <script src="../assets/js/jquery.min.js"></script>
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- optional plugins -->
    <script src="../assets/libs/moment/moment.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
</body>

</html>