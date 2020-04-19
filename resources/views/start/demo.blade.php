<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Get demo | Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/demopage.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .btn{
            border-width:0.069rem;
        }
        
        ::placeholder{
            color:#000!important;
        }
        label{
            color:var(--dark);
        }
        form .form-group{
            margin-bottom:5px!important;
        }
        @media(max-width:576px){
                label{
                margin-bottom:0px!important;
            }
        }
    </style>
</head>

<body class="pb-0 body-scroll">
@if(Session::has('success') || Session::has('error'))
    @if(Session::has('success'))
    <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed w-75"
        style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true"
        data-toggle="toast">
    @else
    <div class="toast bg-danger fade show border-0 new-shadow rounded position-fixed w-75"
        style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true"
        data-toggle="toast">
    @endif
        <div class="toast-body text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle" id="close-btn" height="18px"></i>
            </a>
            <div class="mt-2 font-weight-bold font-size-14">
                {{Session::get('success')}}
                {{Session::get('error')}}
            </div>

        </div>
    </div>
    @endif
    <!-- NAVBAR START -->
    <nav class="navbar navbar-expand-lg sticky-top px-1 new-shadow-sm" style="z-index: 9999;" id="nav-menu">
        <div class="container-fluid px-0 px-md-5">
            <!-- logo -->
            <a href="#" class="ml-2 navbar-brand mr-lg-5 font-size-24 font-weight-bold text-dark">
                <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-dark" height="24" /> Evento
            </a>
            <ul class="text-right nav font-weight-bold  font-size-16 d-flex align-items-center">
                <div class="nav d-md-flex d-none mr-md-3 my-nav">
                    <li class="nav-item"><a href="#home" class="nav-link text-dark active">Home</a></li>
                    <li class="nav-item"><a href="#feature" class="nav-link text-dark">Features</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link text-dark">About</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link text-dark">Contact</a></li>
                </div>
                
                <li class="nav-item d-flex d-md-none">
                    <span id="menu-btn" href="#" class="nav-link text-dark" style="cursor:pointer;">
                        <i data-feather="menu"></i>
                    </span>
                    
                </li>
            </ul>
        </div>
        <div class="d-block d-md-none">
            <div id="left-menu" class="position-fixed w-50 bg-white new-shadow-2"
                style="height:100%;top:0;left:0;z-index:2;display: none;">
                <ul class="nav flex-column font-size-16 font-weight-bold mt-5 text-center">
                    <li class="nav-item">
                        <a href="#home" class="nav-link text-dark py-3">
                            <i data-feather="home" class="mb-1 text-primary" height="16px"></i>
                            Home
                        </a></li>
                    <li class="nav-item">
                        <a href="#feature" class="nav-link text-dark py-3">
                            <i data-feather="package" class="mb-1 text-warning" height="16px"></i>    
                            Features
                        </a></li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link text-dark py-3">
                            <i data-feather="users" class="mb-1 text-info" height="16px"></i>
                            About
                        </a></li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link text-dark py-3">
                            <i data-feather="phone" class="mb-1 text-success" height="16px"></i>
                            Contact
                        </a></li>
                </ul>
                
            </div>
            <div id="overlay-bg" class="position-fixed w-100"
                style="height:100%;top:0;left:0;z-index:1;background:rgba(0,0,0,0.5);display: none;">
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- START HERO -->
    <section id="home" class="hero-section position-relative overflow-hidden text-dark pt-5 pb-0">
        <ul class="circles">
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

        <div class="container-fluid row align-items-center">
            
                <div class="col text-center">
                    <div class="py-5">
                        <h1 class="mb-4 text-white">
                            Manage your events with Evento
                        </h1>

                        <p class="mb-4 font-size-16 text-center font-weight-bold">
                            Evento is a fully featured event management system for <br> your Institute to design and manage various kinds of event.
                        </p>

                        <p class="pt-4">
                            <button  class="new-shaodw-sm hover-me-sm btn font-weight-bold badge-pill btn-danger px-4 font-size-15 m-2 demo-btn">
                                Get Started
                                <i data-feather="arrow-right-circle" class="ml-1 align-middle" height="20px"></i>
                            </button>
                        </p>
                    </div>
                </div>
           
            
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="curve-container__curve curve-three" style="position: relative;bottom: -1px;left: 0px;background:rgba(0,0,0,0);" viewBox="0 0 1440 68" enable-background="new 0 0 1440 68">
            <path d="m1622.3 1937.7c0 0-410.7 169.1-913.4 75.5-502.7-93.6-977.7 56.3-977.7 56.3v440h1891.1v-571.8" fill="#fff" transform="translate(0-1977)"></path>
        </svg>
    </section>
    <!-- END HERO -->
    

    <!-- START features -->
    <section id="feature" class="pt-5 bg-white border-bottom border-light border">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="text-center ">
                        <h3 class="position-relative " style="z-index: 1;bottom: -30px;left:0px;">
                            <span class="bg-white px-4">Our Features</span>
                        </h3>
                        <hr>
                        <p class="text-muted mt-2">
                            Here are features of our system to easily manage your events
                        </p>
                    </div>
                </div>
            </div><!-- end row -->

            <div class="mx-0 row mt-5 mb-3 justify-content-around align-items-start">
                <div class="col-lg-5">
                    <div>
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-danger"></i>
                           Easily manage events
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            It is easy to manage all your events with various functionality in Evento
                        </p>
                    </div>

                   
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-success "></i>
                            Differnet Co-ordinator for every event catagory
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            All event catagories has various co-ordinator to manageevents
                        </p>
                    </div>
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-primary "></i>
                           Separate dashboard for Student,Co-ordinator & Admin
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            Student,Co-ordinator & Admin gets their saperate minimal designed dashboard
                        </p>
                    </div>
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-warning "></i>
                            Security and Authentication 24x7
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            Security & Email Authentications is available for all the time
                        </p>
                    </div>

                </div>
                <!--/col-lg-5 -->

                <div class="col-lg-5">
                    <!-- Question/Answer -->
                    <div>
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-danger "></i>
                            Charts for participation analysis</h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            Beautiful charts to analysis participation data
                        </p>
                    </div>

                    <!-- Question/Answer -->
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-success "></i>
                            Excelsheet through student data-entry
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            All the data of students are entered through Excelsheet
                        </p>
                    </div>
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-primary "></i>
                            Manage notice of Admin & co-ordinator
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            Admin and Co-ordinator can create and manage notice
                    </div>
                    <div class="pt-3">
                        <h4 class="faq-question text-body font-size-17">
                            <i data-feather="box" class="icon-dual-warning "></i>
                            Mail service for every event activity
                        </h4>
                        <p class="faq-answer mb-4 pb-1 text-muted font-size-15">
                            Mail service is available for every update of event
                        </p>
                    </div>

                </div>
                <!--/col-lg-5-->
            </div>
            <!-- end row -->
        </div> <!-- end container-->
    </section>
    <!-- END features -->
    <!-- START features -->
    <section id="about" class="pt-5 bg-white ">
        <div class="container-fluid about-us">
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="text-center container">
                        <h3 class="position-relative " style="z-index: 1;bottom: -30px;left:0px;">
                            <span class="bg-white px-4">About Evento</span>
                        </h3>
                        <hr>
                        <p class="text-muted mt-2">
                            Let's clear the actual meaning of Evento!
                        </p>
                    </div>
                </div>
            </div><!-- end row -->
            <div class="container d-flex  align-items-end my-5 my-md-3 ">
                <div class="card d-none d-sm-flex" style="width: 20rem;">
                    <img src="{{asset('assets/images/about/i1.svg')}}" class="new-shadow-2 p-3 rounded" alt="">
                </div>
                <div class="card new-shadow-2 rounded-lg position-relative card-content" style="left:-40px;bottom:20px;width: 30rem;z-index: 1;">
                    <div class="card-body">
                        <h4 class="card-title">Why Evento?</h4>
                        <h6 class="card-subtitle mb-2 text-muted">Is this new way to manage events? </h6>
                        <p class="card-text py-2">
                            In School/College there is no proper way or method to create an event. Sometimes it is complicated to manage all these events.<br><br>
                            It takes manpower and lots of time to manage work but <b>Evento</b> reduce all of these things
                        </p>
                    </div>
                </div>
                
                
            </div>
             <div class="container d-flex justify-content-center  align-items-end my-5 my-md-3">
                 
                 <div class="card new-shadow-2 rounded-lg position-relative card-content"
                     style="right:-40px;bottom:20px;width: 30rem;z-index: 1;">
                     <div class="card-body">
                         <h4 class="card-title">Our Purpose</h4>
                         <h6 class="card-subtitle mb-2 text-muted">
                            Easy to use,Easy to manage
                        </h6>
                        <p class="card-text py-2">
                            The main aim is 'anyone can easily use and manage their events'.Evento gives one user interface in which user can explore the functionalities and manage events.
                            <br><br> 
                            By reducing time and manpower Evento directly connect with students and Co-ordinators.
                        </p>
                     </div>
                 </div>
                 <div class="card d-none d-sm-flex" style="width: 20rem;">
                     <img src="{{asset('assets/images/about/i2.svg')}}" class="new-shadow-2 p-3 rounded" alt="">
                 </div>

             </div>
            

        
        </div> <!-- end container-->
            <div class="text-center font-size-18 text-dark my-5 font-weight-bold">
               Want Evento In Your Institute?<br>
               Get started from here <br>
               <button
                   class="mt-4 new-shaodw-sm hover-me-sm btn font-weight-bold badge-pill btn-danger px-4 font-size-15 m-2 demo-btn">
                   Get Started
                   <i data-feather="arrow-right-circle" class="ml-1 align-middle" height="20px"></i>
               </button>

           </div>
        <svg xmlns="http://www.w3.org/2000/svg" class="curve-container__curve curve-three"
            style="position: relative;bottom: -1px;left: 0px;background:rgba(0,0,0,0);" viewBox="0 0 1440 70"
            enable-background="new 0 0 1440 68">
            <path d="m1622.3 1937.7c0 0-410.7 169.1-913.4 75.5-502.7-93.6-977.7 56.3-977.7 56.3v440h1891.1v-571.8"
                fill="#baf3ff" transform="translate(0-1977)"></path>
        </svg>
    </section>
    <!-- END features -->
    <!-- START FOOTER -->
    <footer id="contact" class="pt-2 pb-3 position-relative" style="background: linear-gradient(to bottom,#baf3ff 10%,#0ED2F7) ;">
       
        <div class="container">
            <div class="row mx-0  align-items-start justify-content-center">
                <div class="col-md-5 my-3 text-center text-md-left">
                    <a href="#" class="navbar-brand font-size-22 font-weight-bold text-dark">
                        <img src="{{asset('assets/images/logo.png')}}" alt="" class="logo-dark" height="36" /> 
                        <span class="h1 text-dark">Evento</span>
                    </a>
                    <p class="font-size-15 text-dark mt-3">
                        Evento makes it easier to Create and manage <br> events with
                         great functionality and user interface. 
                    </p>
                </div>

                <div class="col-md-4 my-3 text-center text-md-left">
                    <div class="h5">Contact us</div>
                    <br>
                    <h6>
                        <i data-feather="mail" class="mr-2 icon-dual-danger" height="20px"></i>
                        <span class="text-dark">eventoitsol@gmail.com</span>
                    </h6>
                    <h6>
                        <i data-feather="phone" class="mr-2 icon-dual-dark" height="20px"></i>
                        <span class="text-dark">852-014-7963</span>
                    </h6>
                    <h6>
                        <i data-feather="map-pin" class="mr-2 icon-dual-primary" height="20px"></i>
                        <span class="text-dark">Identify info-tech, Surat</span>
                    </h6>
                </div>
                <div class="col-md-3 my-3 text-center text-md-left">
                    <div class="h5 mb-3 text-center">Follow us</div><br>
                    <div class="d-flex align-items-center justify-content-center mt-0 mt-md-5">
                        <a href="#" class="badge-pill btn bg-white p-2 mx-1 hover-me-sm">
                            <i data-feather="facebook" class="text-primary"></i>
                        </a>
                        <a href="#" class="badge-pill btn bg-white p-2 mx-1  hover-me-sm">
                            <i data-feather="instagram" class="text-danger"></i>
                        </a>
                        <a href="#" class="badge-pill btn bg-white p-2 mx-1  hover-me-sm">
                            <i data-feather="twitter" class="text-info"></i>
                        </a>
                        <a href="#" class="badge-pill btn bg-white p-2 mx-1  hover-me-sm">
                            <i data-feather="linkedin" class="text-blue"></i>
                        </a>
                    </div>
                </div>
            </div>

            
        </div>
    </footer>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card mb-0 p-1">
                <p class="text-dark text-center mb-0 font-weight-bold">
                    Made with <i data-feather="heart" height="15px" class="icon-dual-danger"></i>
                </p>
            </div>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- form start -->
    <div>
        <div class="d-flex align-items-center justify-content-center">
            <div id="demo-form" class="py-sm-2 position-fixed col-lg-8 col-md-10 col-sm-10 col-11 card rounded-lg new-shadow-2 rounded-lg px-0 ">
                <div class="navbar pt-2 pb-0 flex-nowrap">
                    <div class="h6 ml-sm-3 ml-1 text-muted" >
                    <i data-feather="info" height="16px" class="icon-dual-info mb-1"></i>
                    Fill up these fields and send us. We'll contact you
                    </div>
                    <a href="javascript:location.reload()" class="text-dark mr-sm-3 mr-1" id="close-btn">
                        <i data-feather="x-circle" height="18px"></i>
                    </a>
                </div>
                
            <form action="{{url('demo_req')}}" onsubmit="return valid()" method="post" class="py-2 px-1 px-sm-4">
            @csrf
                <div class="row mx-0">
                    <div class=" col-sm-5 my-0">
                        <label>Admin Name</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" id="aname" name="aname" class="form-control" placeholder="Enter Admin name" />
                        </div>
                        <span class="text-danger font-weight-bold"></span>
                    </div>
                    <div class=" col-sm-7 my-0">
                        <label>Email</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <span class="text-danger font-weight-bold"></span>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column mb-0">
                    <label>Institute Name</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/clg1.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" id="iname" name="iname" class="form-control" placeholder="Enter Your Institute Name">
                    </div>
                    <span class="text-danger font-weight-bold"></span>
                    <!--  -->
                </div>
                <div class="row mx-0">
                    <div class="form-group col-6 mb-0">
                        <label>Contact no</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" id="mobile" name="contact" class="form-control" placeholder="Enter Contact no">
                        </div>
                        <span class="text-danger font-weight-bold"></span>
                        <!--  -->
                    </div>
                    <div class="form-group col-6 mb-0">
                        <label>City</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" id="city" name="city" class="form-control" placeholder="Enter Your City">
                        </div>
                        <span class="text-danger font-weight-bold"></span>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column mb-0">
                    <label>Address</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="home" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="addr" name="addr" class="form-control" placeholder="Enter Your Institute Address">
                    </div>
                    <span class="text-danger font-weight-bold"></span>
                    <!--  -->
                </div>
                <div class="row form-group col-12 mx-0 mb-0">
                    <label>Message</label>
                    <div class="form-group has-icon d-flex align-items-start w-100">
                    <i data-feather="message-square" class="form-control-icon ml-2" style="margin-top: 10px;" height="19px"></i>
                    <input type="text" id="msg" name="msg" class="form-control" placeholder="Enter Your Message" />
                    </div>
                    <span class="text-danger font-weight-bold"></span>
                </div>
                <div class="my-2 ml-3 navbar p-0">
                    <div class="action-button">
                        <button type="submit"  class="hover-me-sm btn btn-sm btn-success new-shadow-sm font-weight-bold px-3 rounded-sm mr-1">
                            <span class="font-size-15">Send</span>
                            <i data-feather="send" class="mb-1" height="18px"></i>
                        </button>
                        <button type="reset"  class="hover-me-sm btn btn-sm btn-danger new-shadow-sm font-weight-bold px-3 rounded-sm ml-1">
                            <span class="font-size-15">Clear</span>
                            <i data-feather="rotate-ccw" class="mb-1" height="18px"></i>
                        </button>
                    </div>
                    <div class="mr-3 d-none d-sm-block">
                        <img src="{{asset('assets/images/logo.png')}}" height="24px"  alt="Evento">
                        <span class="h3">Evento</span>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div id="overlay-bg-2" class="position-fixed w-100"
            style="height:100%;top:0;left:0;z-index:9999;background:rgba(0,0,0,0.5);display: none;">
        </div>
    </div>
    <!-- form end -->

    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".link-demos").click(function () {
                $('html, body').animate({
                    scrollTop: $("#demos").offset().top
                }, 1000);
            });

            // make the navbar stikcy
            var nav = $("#nav-menu");
            $(window).on('scroll', function (e) {
                if (window.scrollY > 20) {
                    nav.addClass('bg-white');
                    nav.addClass('shadow');
                } else {
                    nav.removeClass('bg-white');
                    nav.removeClass('shadow');
                }
            });
            
        });

        $(document).ready(function () {
            $('#left-menu,#overlay-bg').hide();
            $('#menu-btn').click(function(){
                $('#left-menu,#overlay-bg').show();

            });
            $('#overlay-bg').click(function(){
                
                $('#left-menu,#overlay-bg').hide();
                 
            })
        });
        $(document).ready(function () {
            $('#demo-form').hide();
            $('.demo-btn').click(function(){
                $('#demo-form').fadeIn(180);
                $('#overlay-bg-2').show();

            });
            $('#close-btn,#overlay-bg-2').click(function(){
                $('#demo-form,#overlay-bg-2').fadeOut(150);
                location.reload();
            })
        });
    </script>
<script>
function valid()
{
    var f=0;
        var regex = /^[A-Za-z\.\s]+$/;
        $('*').removeClass('border border-danger');
        if(!regex.test($('#aname').val())){
            $('#aname').parent().next().html("Please enter valid Admin name.");
            $('#aname').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#aname').parent().next().html("");
        }

        regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test($('#email').val()))
        {
            $('#email').parent().next().html("Please enter valid email Address.");
            $('#email').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#email').parent().next().html("");
        }

        if($('#iname').val()=="")
        {
            $('#iname').parent().next().html("Please enter Instistution name.");
            $('#iname').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#iname').parent().next().html("");
        }

        regex = /^\d*(?:\.\d{1,2})?$/;
        var mo= $('#mobile').val();
        if(!(regex.test($('#mobile').val()) && mo.length == 10))
        {
            $('#mobile').parent().next().html("Please enter valid contact");
            $('#mobile').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#mobile').parent().next().html("");
        }

        if($('#city').val()=="")
        {
            $('#city').parent().next().html("Please enter City name.");
            $('#city').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#city').parent().next().html("");
        }
        if($('#addr').val()=="")
        {
            $('#addr').parent().next().html("Please enter address of instistute.");
            $('#addr').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#addr').parent().next().html("");
        }

    if(f==1)
    {
        return false;
    }

}
</script>
</body>

</html>
