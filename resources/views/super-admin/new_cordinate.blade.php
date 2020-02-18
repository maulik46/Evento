<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create Co-ordinator</title>
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
        .form-group select option{
            border: none!important;
            outline: none!important;
            padding: 30px 0px!important;
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
                <div class="container-fluid col-lg-6">
                    <div class="card new-shadow rounded-lg" style="margin-top: 80px;">
                        <div class="card-body px-lg-4">
                            <a href="index.html" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <h3 class="my-4 text-center text-dark">
                                <img src="../assets/images/svg-icons/co-ordinate/writing.svg" height="25px" alt="">
                                <span> Create Co-ordinator</span>
                            </h3>
                            <form action="#">
                                    <div class="form-group mt-2">
                                        <label class="col-form-label font-size-14">Co-ordinator Name</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control"
                                                placeholder="Enter Co-ordinator Name..." />
                                        </div>
                                    </div>

                                <div class="form-group mt-4 row">
                                    <div class="col-lg-6">
                                        <label class="col-form-label font-size-14">Event Catagory</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                               <select class="form-control custom-select custom-select-lg">
                                                   <option hidden>Select Event Catagory</option>
                                                   <option value="Sport">Sport</option>
                                                   <option value="Cultural">Cultural</option>
                                                   <option value="IT">IT</option>
                                               </select>
                                        </div>
                                     
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="col-form-label font-size-14">Password</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="key" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" style="letter-spacing: 5px;"
                                                value="A1be4TY" readonly />
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="mt-4 mb-3 row justify-content-start align-items-center">
                                    &nbsp;
                                    <button type="submit"
                                        class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-4 font-size-15
                                        font-weight-bold ml-2" style="background-color: #35bbca;">
                                        <span>Create</span>
                                        <i data-feather="check-square" height="20px"></i>
                                    </button>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- optional plugins -->
    <script src="../assets/libs/moment/moment.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
</body>

</html>