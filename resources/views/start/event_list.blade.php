<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Explore Events | Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link href="{{asset('assets/css/demopage.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/libs/owl/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/owl/owl.theme.default.css')}}">
    <style>
        body {
            background: #AAFFA9;
            background: -webkit-linear-gradient(to right, #11FFBD, #AAFFA9);
            background: linear-gradient(to right, #11FFBD, #AAFFA9);
        }

        ::placeholder {
            color: #000 !important;
        }
        .participate:hover span{
            color: var(--success)!important;
        }
    </style>
</head>

<body class="body-scroll">

    <main>
        <nav class="row justify-content-between align-items-center position-fixed" style="z-index: 999;width: 100%;top:0px;left:0px;">
            <a href="#" class="mt-1 mt-sm-3 mx-4 mx-sm-5 navbar-brand  font-size-24 font-weight-bold text-dark">
                <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-dark mr-1" height="24" /> <span
                    class="text-dark">Evento</span>
            </a>
            <div class="btn-group">
                <a href="#"
                    class="bg-white btn badge-pill py-1 text-danger font-weight-bold font-size-15 mt-1 mt-sm-3 mx-2 mx-sm-4 dropdown-toggle pl-3 pr-2 hover-me-sm new-shadow-sm"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Log in
                    <i data-feather="chevron-down" height="18px"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right mr-3 mt-2 rounded-lg">
                    <a class="dropdown-item text-red" href="#">
                        <i data-feather="user" height="19px" class="mb-1"></i>
                        I'm Student
                    </a>
                    <a class="dropdown-item text-blue" href="#">
                        <i data-feather="user" height="19px" class="mb-1"></i>
                        I'm Co-ordinator
                    </a>
                    <a class="dropdown-item text-orange" href="#">
                        <i data-feather="user" height="19px" class="mb-1"></i>
                        I'm Admin
                    </a>
                </div>
            </div>
        </nav>

        <div>
            <ul class="circles" style="z-index: -10;">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

        <div class="container position-relative" style="top:80px;left:0px;">
            <div class="card new-shadow-2">
                <h5 class="text-center mb-4 mt-2 p-2">
                    Sutex Bank College Of Computer Applications & Science
                </h5>
                <div class="card-body p-2">
                    <h4 class="ml-2">Recent Events</h4>
                    <hr class="mt-1">
                    <div class="row owl-carousel owl-theme mx-0">
                        <div class="col-md-12 item">
                            <div class="card new-shadow-sm rounded-sm text-dark" style="background-color: #83d7e93d;">
                                <div class="d-flex justify-content-between align-items-center px-3" style="background-color: #a3e5f3!important;">
                                <h5 class="text-center">Rangoli making competition</h5>
                                </div>
                                <div class="card-text p-2 px-3">
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Date</span>
                                        <span class="text-dark">12/03/2020</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Time</span>
                                        <span class="text-dark">10:45 AM</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between align-items-center">
                                        <span class="font-weight-bold">Type</span>
                                        <span class="text-dark badge badge-soft-primary badge-pill px-3">Team</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center px-3 py-1">
                                    <a href="#" class="hover-me-sm badge badge-primary badge-pill px-3">
                                        View Details
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Participate Now">
                                        <i data-feather="arrow-right-circle" class="icon-dual-primary" height="20px"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12 item">
                            <div class="card new-shadow-sm rounded-sm text-dark" style="background-color: #83d7e93d;">
                                <div class="d-flex justify-content-between align-items-center px-3" style="background-color: #a3e5f3!important;">
                                    <h5 class="text-center">IT Quiz competition</h5>
                                </div>
                                <div class="card-text p-2 px-3">
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Date</span>
                                        <span class="text-dark">12/03/2020</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Time</span>
                                        <span class="text-dark">10:45 AM</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between align-items-center">
                                        <span class="font-weight-bold">Type</span>
                                        <span class="text-dark badge badge-soft-primary badge-pill px-3">Team</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center px-3 py-1">
                                    <a href="#" class="hover-me-sm badge badge-primary badge-pill px-3">
                                        View Details
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Participate Now">
                                        <i data-feather="arrow-right-circle" class="icon-dual-primary" height="20px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 item">
                            <div class="card new-shadow-sm rounded-sm text-dark" style="background-color: #83d7e93d;">
                                <div class="d-flex justify-content-between align-items-center px-3" style="background-color: #a3e5f3!important;">
                                    <h5 class="text-center">PHP &web designing competition</h5>
                                </div>
                                <div class="card-text p-2 px-3">
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Date</span>
                                        <span class="text-dark">12/03/2020</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Time</span>
                                        <span class="text-dark">10:45 AM</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between align-items-center">
                                        <span class="font-weight-bold">Type</span>
                                        <span class="text-dark badge badge-soft-primary badge-pill px-3">Team</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center px-3 py-1">
                                    <a href="#" class="hover-me-sm badge badge-primary badge-pill px-3">
                                        View Details
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Participate Now">
                                        <i data-feather="arrow-right-circle" class="icon-dual-primary" height="20px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 item">
                            <div class="card new-shadow-sm rounded-sm text-dark" style="background-color: #83d7e93d;">
                                <div class="d-flex justify-content-between align-items-center px-3"style="background-color: #a3e5f3!important;">
                                    <h5 class="text-center">Kho-Kho competition</h5>
                                </div>
                                <div class="card-text p-2 px-3">
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Date</span>
                                        <span class="text-dark">12/03/2020</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between">
                                        <span class="font-weight-bold">Time</span>
                                        <span class="text-dark">10:45 AM</span>
                                    </div>
                                    <div class="row mx-0 justify-content-between align-items-center">
                                        <span class="font-weight-bold">Type</span>
                                        <span class="text-dark badge badge-soft-primary badge-pill px-3">Team</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center px-3 py-1">
                                    <a href="#" class="hover-me-sm badge badge-primary badge-pill px-3">
                                        View Details
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Participate Now">
                                        <i data-feather="arrow-right-circle" class="icon-dual-primary" height="20px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card new-shadow-2">
                <div class="card-body">
                    <div class="float-right pl-0 col-md-5 col-sm-12">
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="search" class="form-control-icon text-dark ml-2" height="19px"></i>
                            <input type="text" id="myInput" class="form-control p-3 px-5 font-size-15 rounded"
                                placeholder="Search Events..">
                        </div>
                    </div>
                    <h4 class="ml-2">Other Events</h4>
                    <hr>
                    <div class="row mx-0 justify-content-between" id="other-events">
                        <div class="col-lg-6 col-12 px-0 card bg-light new-shadow-sm  rounded-sm text-dark hover-me-sm event-card">
                            <div class="d-flex justify-content-between align-items-center px-3" style="background-color: #60ffd475!important">
                                <h5 class="text-center text-dark">Rangoli making competition</h5>
                                <a href="#" class="mr-1" data-toggle="tooltip" title="View Details">
                                    <i data-feather="info" class="text-dark" height="20px"></i>
                                </a>
                            </div>
                            <div class="card-text p-2 px-3">
                                <div class="row mx-0 justify-content-between">
                                    <span class="font-weight-bold">Date</span>
                                    <span class="text-dark">12/03/2020</span>
                                </div>
                                <div class="row mx-0 justify-content-between">
                                    <span class="font-weight-bold">Time</span>
                                    <span class="text-dark">10:45 AM</span>
                                </div>
                                <div class="row mx-0 justify-content-between align-items-center">
                                    <span class="font-weight-bold">Type</span>
                                    <span class="text-dark badge badge-soft-primary badge-pill px-3">Team</span>
                                </div>
                            </div>
                            <a href="#" class="participate btn btn-sm rounded-0"  style="border-top:1px solid #e9e9e9;">
                                <span class="text-dark font-size-13 font-weight-bold">Participate Now</span>
                                <i data-feather="arrow-right-circle" class="text-success" height="20px"></i>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/libs/owl/owl.carousel.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#other-events .event-card").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                });
            });
        });
    </script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop:false,
            margin:0,
            nav:false,
            items:1,
            responsive:{
                0:{
                    items:1
                },
                576:{
                    items:1
                },
                768:{
                    items:2
                },
                992:{
                    items:3
                }
            }
        })
    </script>

</body>

</html>