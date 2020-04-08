<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Evento</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet">
    @section('head-tag-links')
    
    @show
    <link href="{{asset('assets/css/system_admin_css.css')}}" rel="stylesheet">
</head> 

<body class="body-scroll pb-0">

    <!-- Begin page -->
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
           
           <div class="toast bg-{{$msg}} fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:9999999;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
               <div class="toast-body text-white alert mb-1">
                   <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                       <i data-feather="x-circle" id="close-btn" height="18px" ></i>
                   </a>
                   <div class="mt-2 font-weight-bold font-size-14">
                       {{Session::get('alert-' . $msg)}}
                   </div> 
                   
               </div>
           </div>
    @endif
    @if($errors->first('photo-upload'))
        
        <div class="toast bg-danger fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
            <div class="toast-body text-white alert mb-1">
                <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                    <i data-feather="x-circle" height="18px" ></i>
                </a>
                <div class="mt-2 font-weight-bold font-size-14">
                {{$errors->first('photo-upload')}}
                </div> 
                
            </div>
        </div>
@endif
    @endforeach
    <div id="wrapper">
            <nav class="navbar position-fixed w-100 shadow-none" style="z-index:99!important;">
                <a href="/index" class="navbar-brand logo-position">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                    <span class="d-inline h2 text-dark font-weight-bold">Evento</span>
                </a>
                <div>
                    <a href="#" class="right-bar-toggle text-dark">
                        <i data-feather="grid" height="19px"></i>
                        <!-- <span class="noti-icon-badge"></span> -->
                    </a>
                    <a href="#" class="btn btn-default button-menu-mobile open-left text-dark mr-0">
                        <i data-feather="menu" class="menu-icon"></i>
                    </a>
                </div>
            </nav>
            <div class="left-side-menu bg-transparent shadow-none" style="top:10px;z-index:100!important;">
                    <div class="media user-profile d-flex flex-column align-items-center mt-5">
                    @if(Session::get('syspropic')=="")
                        <img src="{{asset('assets/images/avatars/man.svg')}}" class="avatar-xl border rounded-circle bg-white d-block mx-auto" alt="User" />
                    @else
                    <img src="{{asset('profile_pic/admin_pro_pic/')}}/{{Session::get('syspropic')}}" class="avatar-xl border rounded-circle bg-white d-block mx-auto" alt="User" />
                    @endif
                        <div class="media-body mx-auto mt-3 font-weight-bold text-center">
                            <a href="#" class="pro-user-name text-dark user-link font-size-16">
                                {{ucfirst(Session::get('sysadmin'))}}
                            </a>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <ul class="metismenu" id="menu-bar">

                                <li class="my-2">
                                    <a href="{{url('/system')}}">
                                        <i class="text-dark uil uil-home-alt h6"></i>
                                        <span class="font-weight-bold font-size-14">Dashboard</span>
                                    </a>
                                </li>
                                <li class="my-2">
                                    <a href="{{url('/s_add_college')}}">
                                        <i class="text-dark uil uil-plus-circle h6"></i>
                                        <span class="font-weight-bold font-size-14">Add College</span>
                                    </a>
                                </li>
                                <li class="my-2">
                                    <a href="{{url('/s_demo_request')}}">
                                        <i class="text-dark uil uil-envelope-add h6"></i>
                                        <span class="font-weight-bold font-size-13">Subscription Requests</span>
                                    </a>
                                </li>
                                <li class="my-2">
                                    <a href="{{url('/s_send_notice')}}">
                                        <i class="text-dark uil uil-envelope-edit h6"></i>
                                        <span class="font-weight-bold font-size-14">Create Notice</span>
                                    </a>
                                </li>
                                
                                <li class="mt-2">
                                    <a href="{{url('syslogout')}}" class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="text-dark uil uil-exit h6"></i>
                                        <span class="font-weight-bold font-size-14">Log Out</span>
                                    </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Sidebar -->
                    </div>
                    <!-- Sidebar -left -->

            </div>


        <div class="content-page bg-white" style="border-radius:30px 0px 0px 0px;margin-top:63px;min-height:90vh;">
            <div class="content">
                @yield('my-content')
            </div>
        </div> <!-- content-page -->
    <div class="right-bar">
            <a href="#" class="d-flex d-sm-none float-right text-dark pr-2 position-relative" style="top:14px;" id="close-btn" onclick="window.location.reload()">
                <i data-feather="x-circle" height="18px"></i>
            </a>
        <div class="rightbar-title">
            
            <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                
                <li class="nav-item">
                    <a class="nav-link active px-0" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="uil uil-user-square h5 text-muted"></i>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-0" id="pills-password-tab" data-toggle="pill" href="#pills-password" role="tab" aria-controls="pills-password"aria-selected="true">
                        <i class="uil  uil-shield-check h5 text-muted"></i>
                        Change Password
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
            
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                
                <form class="mt-2" method="post" onsubmit="return valid()" action="{{url('system/update_profile')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sid" class="form-control" value="{{ucfirst(Session::get('sid'))}}" />
                    <div class="text-center d-flex justify-content-center align-items-start">
                        <img src="{{asset('profile_pic/admin_pro_pic/')}}/{{Session::get('syspropic')}}" class="avatar-xl rounded-circle bg-soft-success border" alt="user image">
                        <label data-toggle="tooltip" data-placement="top" title="Upload Picture" for="photo-upload" class="custom-file-upload w-auto overflow-auto border-0 position-relative btn-profile p-1 btn-rounded" style="left:-15px;" >
                        <i id="camera" height="16px" class="icon-dual-primary" data-feather="edit" ></i>
                        <!-- <span id="up" class="mx-2">Upload Picture</span> -->
                        </label>
                        <input id="photo-upload" name="photo-upload" type="file" />
                    </div>
                    
                    <label class="col-form-label font-size-14">Name</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i class="uil uil-user form-control-icon ml-2 font-size-16"></i>
                        <input type="text" id="sname" value="{{ucfirst(Session::get('sysadmin'))}}" name="user_name" class="form-control" value="" />
                    </div>
                    <div id="name-err" class="text-danger font-weight-bold"></div>
                    <label class="col-form-label font-size-14">Email</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i class="uil uil-envelope form-control-icon ml-2 font-size-16"></i>
                        <input type="text" id="semail" value="{{Session::get('sysemail')}}" name="user_email" class="form-control" value="" />
                    </div>
                    <div id="email-err" class="text-danger font-weight-bold"></div>
                    <label class="col-form-label font-size-14">Mobile No</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i class="uil uil-phone-alt form-control-icon ml-2 font-size-16"></i>
                        <input type="text" id="smobile" value="{{Session::get('sysmobile')}}" name="user_mobile" class="form-control" value="" />
                    </div>
                    <div id="mobile-err" class="text-danger font-weight-bold"></div>
                    

                    <button type="submit" class="mt-2 btn  rounded-sm hover-me-sm px-3 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13 text-white" style="background-color: var(--success);">
                        Save Details
                        <i data-feather="check-square" height="18px"></i>
                    </button>
                </form>
            </div>
            <div class="tab-pane fade  active" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                
                <form method="post" action="{{url('system/update_pass')}}" onsubmit="return check()">
                @csrf
                <p id="error" class="text-center text-danger font-weight-bold"></p>
                    <div class="form-group mt-2">
                        <label class="col-form-label font-size-14">Current Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i class="uil uil-padlock font-size-17 form-control-icon ml-2"></i>
                            <input type="password" id="curpass" name="current_pass"  class="form-control" placeholder="Enter Current Password..." />
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label font-size-14">New Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i class="uil uil-lock-open-alt font-size-17 form-control-icon ml-2"></i>
                            <input type="password" id="npass" name="npass" class="form-control" placeholder="Enter New Password..." />
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label font-size-14">Confirm Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i class="uil uil-padlock font-size-17 form-control-icon ml-2"></i>
                            <input type="password" id="cpass" name="cpass" class="form-control" placeholder="Enter Confirm Password..." />
                        </div>
                    </div>
                    <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow-sm font-weight-bold px-3 mt-2 mb-1">
                        Change
                        <i data-feather="check-square" height="20px"></i>
                    </button>
                </form>
            </div>

            </div>

        </div>
    </div>
    <div class="rightbar-overlay"></div>



    </div> <!-- end wrapper tag -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
function valid()
{
    var f=0;
    var regex = /^[A-Za-z\s]+$/;
    if(!regex.test($('#sname').val()))
    {
        $('#name-err').text("Please valid enter name");
        f=1;
    }
    else{
        $('#name-err').text("");
    }
    regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   if(!regex.test($('#semail').val()))
    {
        
        $('#email-err').text("Invalid email Address");
        f=1;
    }
    else{
        $('#email-err').text("");
    }

    regex = /^\d*(?:\.\d{1,2})?$/; 
    var mo= $('#smobile').val();
    if(!(regex.test($('#smobile').val()) && mo.length == 10))
    {
        $('#mobile-err').text("Please valid Mobile no.");
        f=1;
    }
    else{
        $('#mobile-err').text("");
    }
    if(f==1)
    {
        return false;
    }
}
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
    @section('extra-scripts')

    @show
</body>
</html>
