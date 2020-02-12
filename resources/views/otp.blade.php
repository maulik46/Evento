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
        height: 50px;
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
    <script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
    </script>
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
    <div class=" vh-100 d-flex justify-content-center align-items-center" style="position:relative;z-index:9999;">
        <div class="container col-xl-5 col-lg-6 col-md-8 ">
                    <div class="card shadow rounded-lg">
                        <div class="card-body">
                                <div class="pb-4 pt-2 px-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center">
                                            <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                                            <h2 class="ml-1">Evento</h3>
                                    </a>
                                    <p class="font-size-12 text-muted font-weight-bold text-center mt-2 mb-4">Select your College and Enter Your Enrollment number</p>
                                    
                                    <form action="{{url('/otp_check')}}/{{$senrl}}/{{$clgcode}}/{{$check}}" class="authentication-form" method="post">
                                    @csrf
                                    
                                        <div class="form-group" style="margin-top:30px;">
                                            <label class="form-control-label">Enter OTP</label>

                                            <div class="s-group has-icon d-flex align-items-center">
                                                <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">

                                                <input type="text" class="form-control" id="otp" placeholder="Enter OTP Number" onblur="this.value=this.value.toUpperCase()" name="otp">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span>Didn't get a security code? We can <a href="" class="font-weight-bold" style="color:#1582b3;">resend it</a>
                                            </span>
                                            <span style="color:#1582b3;" class="font-weight-bold" id="demo">
                                                
                                            </span>
                                        </div>
                                        <?php echo Session::get('otp') ?>
                                        @error('otp')
                                        <h6>{{$message}}</h6>
                                        @enderror
                                        @if(Session::get('error'))
                                        <h6>Invalid OTP Number</h6>
                                        @endif
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
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
        
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
        
    // Time calculations for days, hours, minutes and seconds
    
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = minutes + "m " + seconds + "s ";
        
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
</script>
    
</body>


</html>
