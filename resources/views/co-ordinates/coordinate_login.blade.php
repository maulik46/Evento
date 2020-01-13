<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log-in</title>
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
        
        body{
           background-color: #43d39e;
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
            height: 50px;
            cursor: text !important;
        }
        #see-pass:hover,
        #hide-pass:hover{
            color: #333;
        }
        .form-control:focus {
            background-color: #f3f4f79a !important;
        }
        .color-black{
            color: #232323;
        }
       
    </style>
</head>

<body data-layout="topnav" class="body-scroll" style="height: 90vh!important;">
   
    <div class="wrapper">

        <div class="navbar navbar-expand flex-column flex-md-row navbar-custom position-fixed w-100 new-shadow-sm" style="height: 60px;">
            <div class="container-fluid">
             
                <a href="#" class="navbar-brand mx-auto">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo.png')}}" alt="Evento" height="24" />
                        <span class="d-inline h2 text-dark font-weight-bold">Evento</span>
                    </span>
                </a>
            </div>

        </div>

        <div class="content-page">
            <div class="content d-flex justify-content-center">
                <div class="container-fluid pt-3 col-xl-4 col-lg-5 col-md-8 col-sm-10">
                    <div class="card mt-5 shadow rounded-lg px-1">
                       <div class="card-body px-xl-4">
                           
                           <h4 class="my-4 text-center text-dark d-flex flex-column">
                              <img src="{{asset('assets/images/svg-icons/co-ordinate/man.svg')}}" alt="user" height="45px">
                               <span>Log-in</span>
                               <span class="font-size-12 text-muted">for Co-ordinator</span>
                           </h4>
                           <form action="#">
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Co-ordinator ID</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                       <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="text" class="form-control" placeholder="Enter Your ID..." />
                                   </div>
                               </div>
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Password</label>
                                   <div class="form-group has-icon d-flex align-items-center" >
                                       <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="password" class="form-control"
                                           placeholder="Enter Your Password..."  style="padding-right: 2.375rem;" id="my-password">
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
                            
                               <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow font-weight-bold px-4 mt-1 mb-3">
                                    <span class="font-size-14">Log-in</span>
                                    <i data-feather="log-in" height="20px"></i>
                               </button>
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
    })
    </script>
</body>

</html>