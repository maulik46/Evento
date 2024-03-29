
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

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

    </style>
    <script>
      <?php       
      if(Session::get('change') == 1) {
        session()->put('change',2);
          ?>
      sessionStorage.setItem("counter",120)
      location.reload();
      <?php
      
      }else{
        session()->put('change',3);
      }
      ?>
      location
      </script>
</head>

<body class="authentication-bg bg-white" >
    
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
                        <div class="card-body pt-0">
                                <div class="py-2 px-3">
                                    <a href="#" class="d-flex justify-content-center align-items-center">
                                            <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                                            <h2 class="ml-1">Evento</h3>
                                    </a>
                                    <p class="font-size-12 text-dark font-weight-bold text-center mb-4">
                                      <span class="font-weight-light">Check your email for an OTP</span>
                                      <br>
                                      <?php 
                                      function partially_email($email)
                                      {
                                          $em   = explode("@",$email);
                                          $name = implode(array_slice($em, 0, count($em)-1),"@");
                                          $len  = floor(strlen($name)/2);
                                          return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
                                      }
                                  
                                      $email = 'hardikdayani1@gmail.com';
                                      echo partially_email(Session::get('email'));
                                      ?>
                                  </p>
    
                                    <form action="{{url('/otp_check')}}/{{$senrl}}/{{$clgcode}}/{{$check}}" class="authentication-form" method="post">
                                    @csrf
                                        <div class="form-group" style="margin-top:30px;">
                                            <label class="form-control-label text-dark">Enter OTP</label>

                                            <div class="s-group has-icon d-flex align-items-center">
                                                <i data-feather="key" class="ml-2 form-control-icon" height="19px"></i>
                                                <!-- <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}" class="ml-2 form-control-icon" height="20px" alt=""> -->

                                                <input type="text" class="form-control" id="otp" placeholder="Enter OTP Number" onblur="this.value=this.value.toUpperCase()" name="otp">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="text-dark">Didn't get a security code? We can <a  href="{{url('/resend_otp')}}/{{$senrl}}/{{$clgcode}}/{{$check}}" class="font-weight-bold" style="color:#1582b3;">resend it</a>
                                            </span>
                                            <span style="color:#1582b3;" class="font-weight-bold counter" id="demo" >
                                                
                                            </span>
                                        </div>
                                        <?php 
                                        $otp=Session::get('otps');
                                        // echo $otp;
                                        ?>
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
<script type="text/javascript">
<?php
$otp=Session::get('otps');
if (isset($otp)) {
?>   
    if (sessionStorage.getItem("counter")) {
      if (sessionStorage.getItem("counter") == "EXPIRED") {
        var value = "EXPIRED";
      } else {
        var value = sessionStorage.getItem("counter");
      }
    } else {
      var value =120;
    }
    if(value=="EXPIRED")
      {
        document.getElementById('demo').innerHTML = value;
      }
      else
      {
      document.getElementById('demo').innerHTML = value + ' s';
      }

    var counter = function () {
      if (value == 0) {
        sessionStorage.setItem("counter", "EXPIRED");
        value = "EXPIRED";
      } else {
          if(value != "EXPIRED")
          {
        value = parseInt(value) - 1;
        sessionStorage.setItem("counter", value);
            }
            else{
                sessionStorage.setItem("counter", value);
            }
      }
      if(value=="EXPIRED")
      {
        document.getElementById('demo').innerHTML = value;
      }
      else
      {
      document.getElementById('demo').innerHTML = value + ' s';
      }
    };

    var interval = setInterval(counter, 1000);
    <?php
}
?>
  </script>
<script>
  
    $('.counter').on('DOMSubtreeModified',function(){
        var timer=document.getElementById("demo").innerHTML;
       var xyz=sessionStorage.getItem("counter");
       if(xyz == "EXPIRED")
       {
        sessionStorage.setItem("counter", 120);
                $.ajax({
                    url:'/timers',
                    method:'GET',
                    dataType:'json',
                    data:{'timer':xyz},
                    success:function(data)
                    {
                        console.log(data)
                    }
            })
       }
})
</script>

</body>


</html>
