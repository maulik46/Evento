<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet" />
    <style>
        body{
            background: #AAFFA9;
            background: -webkit-linear-gradient(to left, #11FFBD, #AAFFA9);
            background: linear-gradient(to left, #11FFBD, #AAFFA9);
        }
        .form-control:focus{
            border:1px solid var(--success);

        }
        .auth-page-sidebar{
            background:url('../assets/images/system_login.svg');
            background-size:400px;
            background-position:center;
            background-repeat:no-repeat;
        }
        .btn-ripple {
        position: relative;
        overflow: hidden;
        }

        .btn-ripple .me-child {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.3);
        width: 100px;
        height: 100px;
        margin-top: -50px;
        margin-left: -50px;
        animation: ripple 1s;
        opacity: 0;
        }

        @keyframes ripple {
        from {
            opacity: 1;
            transform: scale(0);
        }
        to {
            opacity: 0;
            transform: scale(10);
        }
        }
    </style>
</head>

<body class="body-scroll pb-0">

    <!-- Begin page -->
    <div id="wrapper">
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center align-items-center vh-100">
                    <div class="col-xl-10">
                        <div class="card new-shadow-2 rounded-lg">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-md-6 p-5">
                                        <div class="text-center mb-3">
                                            <a href="#">
                                                <img src="assets/images/logo.png" alt="" height="24" />
                                                <h3 class="my-0 d-inline text-dark ml-1">Evento</h3>
                                            </a>
                                        </div>
                                        <h6 class="h5 mb-0 mt-4 text-dark">Welcome back!</h6>
                                        <p class="text-muted mt-1 mb-4">Enter your email address and password to access
                                            Evento</p>
                                        <form>
                                        <div class="form-group mb-1">
                                            <label>Admin Name</label>
                                            <div class="form-group has-icon d-flex align-items-center">
                                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                                <input type="text"  class="form-control" placeholder="Enter Admin Name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <div class="form-group has-icon d-flex align-items-center">
                                                <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                                <input type="email" class="form-control" placeholder="Enter Admin Email">
                                            </div>
                                        </div> 
                                        <br>
                                        <button type="submit" class="btn btn-block btn-success font-weight-bold rounded-sm new-shadow-sm btn-ripple">
                                            Get Started
                                        </button>  
                                        </form>
                                    </div>
                                    <div class="col-lg-6 d-none d-md-inline-block">
                                        <div class="auth-page-sidebar">
                                            <div class="overlay" style="border-radius:0px .5rem .5rem 0px;"></div>
                                            <div class="auth-user-testimonial">
                                                <p class="font-size-24 font-weight-bold text-white mb-1">Evento</p>
                                                <p class="lead">
                                                    Keep it easy. Keep it simple!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div> <!-- end wrapper tag -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
        $("html").on("click", ".btn-ripple", function(evt) {
            var btn = $(evt.currentTarget);
            var x = evt.pageX - btn.offset().left;
            var y = evt.pageY - btn.offset().top;
            
            $("<span class='me-child'/>").appendTo(btn).css({
                left: x,
                top: y
            });
        });
    </script>
</body>

</html>