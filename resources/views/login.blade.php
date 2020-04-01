<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/login_background.css')}}" rel="stylesheet" type="text/css" />
    
    <style>
        form h6{
            color:#f8435f;
        }
        .custom-control-input:checked~.custom-control-label::before {
        color: #fff;
        border-color: #1bb1dc;
        background-color: #1bb1dc;
        }
        .form-control{
        border-radius: .15rem;
        background-color: #f3f4f7!important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7;
        font-size: 1.1em;
        color:#333!important;
        height: 45px;
        }


        .form-control:focus{
        border: 1px solid #d1d1d1!important;
        background-color: #f3f4f7!important;
        }
        .custom-select{
            background: none;
        }
        .nice-select .list{
            width:100%;
            border-radius: 2px;
            box-shadow:none; 
            border: 1px solid #d1d1d1;
            
        }
        .nice-select .option.selected.focus {
            background-color: #f3f4f7;
        }
        .nice-select:after {
        border-bottom: 3px solid #999;
        border-right: 3px solid #999;
        height: 8px;
        right: 15px;
        width: 8px;
        }

    </style>
    <!-- <script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
    </script> -->
</head>

<body class="authentication-bg bg-white">
 
    
    <div class="waveWrapper waveAnimation">

      <div class="waveWrapperInner bgTop">
        <div class="wave waveTop" style="background-image: url('{{asset('assets/images/wave-top1.png')}}')"></div>
      </div>

      <div class="waveWrapperInner bgMiddle">
        <div class="wave waveMiddle" style="background-image: url('{{asset('assets/images/wave-mid2.png')}}')"></div>
        
      </div>

      <div class="waveWrapperInner bgBottom">
        <div class="wave waveBottom" style="background-image: url('{{asset('assets/images/wave-bot3.png')}}')"></div>
      </div>

    </div>
    <div style="z-index:999;position:relative;">
        <div class=" vh-100 d-flex justify-content-center align-items-center">
            <div class="container col-xl-5 col-lg-6 col-md-8 ">
                        <div class="card shadow rounded-lg">
                            <div class="card-body pt-0">
                                    <div class=" py-2 px-3">
                                        <a href="#" class="d-flex justify-content-center align-items-center">
                                                <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                                                <h2 class="ml-1">Evento</h3>
                                        </a>
                                        <p class="font-size-12 text-muted font-weight-bold text-center mt-2 mb-4">Select your College and Enter Your Enrollment number</p>

                                        <form action="{{ url('checklogin') }}" class="authentication-form" method="post">
                                        @csrf
                                            <div class="form-group">
                                            <label class="col-form-label font-size-15 text-dark">Select College</label>
                                            <div class="form-group has-icon d-flex align-items-center">
                                                <img src="{{asset('assets/images/svg-icons/student-dash/clg1.svg')}}" class="form-control-icon ml-2" height="20px" alt="">
                                                <select class="form-control w-100 py-0" name="clgcode" style="cursor:pointer!important;">
                                                    <option data-display="Select College" value="">Select College</option>
                                                    @foreach($clg as $c)
                                                    <option value="{{$c->clgcode}}">
                                                        {{ucfirst($c->clgname)}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                
                                            </div>
                                            @error('clgcode')
                                            <h6>{{$message}}</h6>
                                            @enderror
                                            <div class="form-group" style="margin-top:30px;">
                                                <label class="form-control-label text-dark">Enrollment number</label>

                                                <div class="s-group has-icon d-flex align-items-center">
                                                    <img src="assets/images/svg-icons/student-dash/id.svg" class="ml-2 form-control-icon" height="20px" alt="">

                                                    <input type="text" class="form-control" id="password" placeholder="Enter your Enrollment number" onblur="this.value=this.value.toUpperCase()" name="senrl">
                                                </div>
                                            </div>
                                            @error('senrl')
                                            <h6>{{$message}}</h6>
                                            @enderror
                                            @if(Session::get('error'))
                                            <h6>Invalid College name or Enrollment Number</h6>
                                            @endif
                                            <div class="form-group" style="margin-top:20px;">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="remainder" value="1" id="checkbox-signin"
                                                        checked>
                                                    <label class="custom-control-label text-dark" for="checkbox-signin">Remember me</label>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 mb-0">
                                                <button class="hover-me-sm btn btn-info  rounded-sm new-shadow font-size-15 px-3" type="submit"> 
                                                <span class="font-weight-bold">Login</span>
                                                <i data-feather="log-in" height="20px"></i>
                                                </button>
                                            </div>
                                        </form>
                                        
                                    
                                    </div> 
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    </div>

    <!-- jquery -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>   

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>

    <script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>   
    
    <script>
    $(document).ready(function() {
        $('select').niceSelect();
    });
    </script>

    
</body>


</html>
