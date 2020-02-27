<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/my-extra.css')}}">

    <style>
        form h6{
            color:#f8435f;
        }
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
    <div class="wrapper ">
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
                <div class="container-fluid pt-2 col-xl-4 col-lg-5 col-md-8 col-sm-10">
                    <div class="card mt-5 shadow rounded-lg px-1">
                       <div class="card-body px-xl-4">
                           <h4 class="my-4 text-center text-dark d-flex flex-column">
                              <img src="{{asset('assets/images/svg-icons/co-ordinate/man.svg')}}" alt="user" height="45px">
                               <span>Log-in</span>
                               <span class="font-size-12 text-muted">for Co-ordinator</span>
                           </h4>
                           <form action="{{url('/send_otp')}}" onsubmit="return valid()" method="post" id="myform">
                           @csrf
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Enter your registered email id</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                       <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="text" class="form-control" placeholder="Enter Your Email..." name="cuser"  id="cuser" />
                                   </div>
                                   <span class="text-danger font-weight-bold" id="cuser-label"></span>
                               </div>
                               
                               <div class="form-group mt-2" id="content-otp" style="display: none;">
                                   <label class="col-form-label font-size-14">Enter OTP</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                       <i data-feather="external-link" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="text" class="form-control" placeholder="Enter Your OTP..." name="otp" id="otp"/>
                                   </div>
                                   <span class="text-dark font-weight-bold"></span><br/>
                                   <div class="d-flex justify-content-between align-items-center">
                                   <span>Didn't get a security code? We can <a  href="#" class="font-weight-bold" style="color:#1582b3;" id="resend">resend it</a>
                                    </span>
                                    <span style="color:#1582b3;" class="font-weight-bold counter" id="demo" ></span>
                                    </div>
                                    <div id="otp-label">
                                    {{Session::get('otps')}}
                                    </div> 
                                    
                               </div>
                               
                               <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow font-weight-bold px-4 mt-1 mb-3" id="submitotp">
                                    <span class="font-size-14">Confirm</span>
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
         
    </script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <!-- optional plugins -->
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
        $("#resend").click(function(){
            var cuser=$('#cuser').val();
            $.ajaxSetup({
                     headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
             $.ajax({
                    url:'/cresend_otp',
                    method:'POST',
                    dataType:'json',
                    data:{'cuser':cuser},
                    success:function(otp)
                    {
                        console.log(otp)
                        $("#otp-label").html(otp);
                        sessionStorage.setItem("otps",otp);
                        sessionStorage.setItem("c",1);
                        if(sessionStorage.getItem("c")==1)
                                {
                                    
                                    var countdown = 2 * 60 * 1000;
                                    var timerId = setInterval(function(){
                                    countdown -= 1000;
                                    var min = Math.floor(countdown / (60 * 1000));
                                    //var sec = Math.floor(countdown - (min * 60 * 1000));  // wrong
                                    var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct
                                    if (countdown <= 0) {
                                        $("#demo").html("EXPIRED");
                                        var otplabel=sessionStorage.getItem("otps");
                                        $.ajaxSetup({
                                                headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url:'/ctimers',
                                            method:'POST',
                                            dataType:'json',
                                            data:{'otpcode':otplabel},
                                            success:function(data2)
                                            {
                                               // console.log(data2)
                                                sessionStorage.setItem("otps",data2);
                                            }                                       
                                        })
                                        clearInterval(timerId);                                        
                                    } else {
                                        $("#demo").html(min + " : " + sec + " Min ");
                                    }
                                    }, 1000);
                                    sessionStorage.setItem("c",0);
                                }
                        }                                       
                    })
        });
        </script>
        <script>
       $(document).ready(function(){
        sessionStorage.setItem("c",1);
        $( "#submitotp" ).click(function() {
            document.getElementById("submitotp").id = "submitpass";  
            var cuser=$('#cuser').val();
            var otp=$('#otp').val();
            $.ajaxSetup({
                headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url:'/csend_otp',
                    method:'POST',
                    dataType:'json',
                    data:{'cuser':cuser},
                        success:function(data)
                        {
                            sessionStorage.setItem("otps",data);
                            if(data.length > 6)
                            {
                            $('#cuser-label').html(data);
                            }
                            else{
                                $('#cuser-label').html();
                            }
                            //console.log(data)
                            document.getElementById("myform").action = "{{url('/confirm_pass')}}";
                            if(data!="Invalid Email Id..")
                            {
                                $('#content-otp').fadeIn("slow");
                                $('#cuser-label').html("");
                                document.getElementById("cuser").readOnly = true;                                
                                $('#otp-label').html(data);
                                sessionStorage.setItem("otps",data);
                                if(sessionStorage.getItem("c")==1)
                                {
                                    
                                    var countdown = 2 * 60 * 1000;
                                    var timerId = setInterval(function(){
                                    countdown -= 1000;
                                    var min = Math.floor(countdown / (60 * 1000));
                                    //var sec = Math.floor(countdown - (min * 60 * 1000));  // wrong
                                    var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  //correct
                                    if (countdown <= 0) {
                                        $("#demo").html("EXPIRED");
                                        var otplabel=sessionStorage.getItem("otps");;
                                        $.ajaxSetup({
                                                headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url:'/ctimers',
                                            method:'POST',
                                            dataType:'json',
                                            data:{'otpcode':otplabel},
                                            success:function(data2)
                                            {
                                                //console.log(data2)
                                                sessionStorage.setItem("otps",data2);
                                            }                                       
                                        })
                                        clearInterval(timerId);                                        
                                    } else {
                                        $("#demo").html(min + " : " + sec + " Min ");
                                    }
                                    }, 1000);
                                    sessionStorage.setItem("c",0);
                                }
                            }
                        }
                    })
                    
        });
       })
        function valid()
        {
            var cuser=$('#cuser').val();
            var otp=$('#otp').val();
            var f=0;
            var otps=$('#otp-label').val();
            
            if ($('#cuser').val() == "") {
                $('#cuser').parent().next().text("Please Enter User ID...");
                return false;
            } 
            if ($('#otp').val() == "") {
                    $('#otp').parent().next().text("Please Enter Your OTP...");
                    f=1;
                }
                else if ($('#otp').val() != sessionStorage.getItem("otps")) {
                    $('#otp').parent().addClass('border border-danger');
                    $('#otp').parent().next().text("Invalid OTP..");
                    f=1;
                }
                else{
                    $('#otp').parent().next().text("");
                }
                if (f == 1) {
                        return false;
                }    
        }
    </script>
</body>
</html>
