<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/my-extra.css')}}">
    @section('head-tag-links')

    @show
    <style>
    .profile-dropdown-items {
    width: 200px;
    }

    .content-page {
        margin: 50px 0px !important;
    }

    .notification-list .noti-icon-badge {
        position: relative;
        top: -4px;
        right: 12px;
    }

    .left-red-border {
        border-left: 4px solid #ff5c75;
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
                <a href="{{url('sindex')}}" class="navbar-brand mx-2">
                    <span class="logo-lg">
                        <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                        <span class="d-inline h3 font-weight-bold">Evento</span>
                        <h6 class="my-0 text-muted font-size-12 d-sm-none d-md-none" style="margin-left: 30px;">
                            Super-admin</h6>
                    </span>
                </a>

                <ul
                    class="navbar-nav align-items-center flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list align-self-center profile-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <div class="media user-profile ">
                               <img src="{{asset('profile_pic/admin_pro_pic')}}/{{Session::get('adminprofile')}}" style="height:35px;width:35px" alt="user-image" class="align-self-center rounded-circle" />
                                <div class="media-body text-left d-none d-sm-block">
                                    <h6 class="ml-2 my-0" id="nav-menu-btn">
                                        <span>{{ucfirst(Session::get('aname'))}}</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Super-admin
                                        </span>
                                    </h6>
                                </div>
                                <span data-feather="chevron-down" class="ml-2 align-self-center"
                                    id="nav-menu-btn"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                            <div class="media dropdown-item d-sm-none d-md-none align-items-center">
                                <img src="{{asset('profile_pic/admin_pro_pic')}}/{{Session::get('adminprofile')}}" alt="user-image" height="50px" width="50px" class="align-self-center rounded-circle" />
                                <div class="media-body text-left">
                                    <h6 class="ml-2 my-0">
                                        <span>{{ucfirst(Session::get('aname'))}}</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Super-admin
                                        </span>
                                    </h6>
                                </div>
                            </div>

                            <div class="dropdown-divider d-sm-none d-md-none"></div>
                            <a href="{{url('sindex')}}" class="dropdown-item notify-item mb-2">
                                <i data-feather="home" class="icon-dual-primary icon-xs mr-2"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{url('admin_profile')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="user" class="icon-dual-success icon-xs mr-2"></i>
                                <span>My Profile</span>
                            </a>
                            <a href="{{url('s_change_pass')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="key" class="icon-dual-info icon-xs mr-2"></i>
                                <span>Change Password</span>
                            </a>
                            <a href="{{url('backup')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="book" class="icon-dual-info icon-xs mr-2"></i>
                                <span>Back up</span>
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="{{url('alogout')}}" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual-danger icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                        <?php
                            $notice = \DB::table('tblnotice')->where([['receiver','LIKE', '%admin%'], ['clgcode','LIKE','%'.Session::get('aclgcode').'%']])->orderby('nid', 'desc')->get()->toarray();
                            $lastnoti = App\admin::select('last_noti')->where('aid', Session::get('aid'))->first();
                            if ($lastnoti) {
                                $count = \DB::table('tblnotice')->select('nid')->where([['nid', '>', $lastnoti->last_noti], ['receiver', 'LIKE', '%admin%'], ['clgcode', 'LIKE', '%' . Session::get('aclgcode') . '%']])->count();

                            } else {
                                $count = 0;
                            }

 
                        ?>
                    <li class="nav-item notification-list" data-toggle="tooxltip" data-placement="bottom" title="Inbox">
                        <span  class="text-dark right-bar-toggle" id="mail">
                            <i data-feather="mail" height="19px" id="nav-menu-btn"></i>
                            @if($count>0)
                            <span class="noti-icon-badge" id="noti"></span>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- end Topbar -->

        <div class="content-page">
            <div class="content">
                <div class="my-5">
                    @yield('my-content')
                </div> <!-- end container fluid-->
            </div>

        </div>
    </div>
    <!-- end wrapper -->

    <!-- inbox Right Sidebar -->

    <div class="right-bar bg-light overflow-auto my-scroll">
        <div class="rightbar-title navbar py-2" style="border-bottom: 1px solid #d3d3d36b;">
            <div class="navbar p-0 m-0">
                <i data-feather="mail" class="icon-dual-danger" height="22px"></i>
                <span class="h4 mt-2 ml-1">Inbox</span>
            </div>
            <a href="#" class="right-bar-toggle text-dark" id="close-btn" onclick="window.location.reload()">
                <i data-feather="x-circle" height="20px"></i>
            </a>
        </div>                       
        <div class="my-scroll px-2">
            <?php $c = 0;
                 $lastnotice=0;
            ?>
            @foreach($notice as $nt)
            <?php $c++;
            if ($c == 1) {
                $lastnotice = $nt->nid;
            }
            ?>
            @if($c<=$count) 
            <div class="card new-shadow-sm my-2"
                style="border-left: 3px solid #ff5c75;border-radius:0px 10px 10px 0px;">
            @else
            <div class="card new-shadow-sm my-2" style="border-left: 3px solid #1AE1AC;border-radius:0px 10px 10px 0px;">
            @endif
            <div class="card-body py-1 px-2">
                <div class="navbar px-1">
                    <div>
                        <span class="badge badge-primary px-2 py-1">{{date('d/m/Y',strtotime($nt->ndate))}}
                        </span>
                        <span class="badge badge-soft-primary px-2 py-1">{{date('h:i A',strtotime($nt->ntime))}}
                        </span>
                    </div>
                    @if($nt->sender=='System' || $nt->sender=='system')
                    <div class="badge badge-success text-white badge-pill px-3">
                        <span>{{ucfirst($nt->sender)}}</span>
                    </div>
                    @else
                    <div class="badge badge-warning text-white badge-pill px-3">
                        <span>{{ucfirst($nt->sender)}}</span>
                    </div>
                    @endif
                    
                </div>
                    <div>
                        <h5 class="mt-1 mb-0">{{ucfirst($nt->topic)}}</h5>
                        <div class="rounded mb-1 ml-3">
                            <div class="notice-msg">{!! ucfirst($nt->message) !!}</div>
                        </div>
                            @if($nt->attechment)
                                <?php $att = explode(';',$nt->attechment);
                                    $c=count($att);
                                    $a=0;
                                ?>
                                <div class="card-action">
                                @foreach($att as $attachment)
                                    <?php $a++;?>
                                    @if($a<$c)  
                                        <a href="{{asset('attachment')}}/{{$attachment}}" class="btn badge badge-soft-info badge-pill font-weight-bold py-1 pl-2 pr-3 m-1 hover-me-sm" download="{{substr($attachment, 10)}}">
                                        <i data-feather="download" height="16px"></i>
                                        {{substr($attachment, 10)}}</a> 
                                    @endif
                                @endforeach
                                </div>
                            @endif
                    </div>
            </div>
            </div>
            @endforeach
            @if($c==0)
            <div class="d-flex align-items-center justify-content-center flex-column" style="height:70vh;">
                <img src="{{asset('assets/images/empty.svg')}}" height="40px" alt="">
                <h6>Inbox is empty..!</h6>
            </div>
            @endif    
            </div>
        </div>
       
    </div>
    <!-- inbox Right-bar -->

    <!-- Right bar overlay-->

    <div class="rightbar-overlay"></div>

    <!-- end Right bar overlay-->
    <!-- side rounded button for quick apps -->
                    <div>
                        <span id="menu-btn" class="text-white btn btn-info new-shadow position-fixed" data-toggle="tooltip" data-placement="left" title="Quick Apps"
                                style="border-radius: 30px;padding: 15px;bottom: 10px;right:15px;z-index:999;cursor:pointer;">
                                <i data-feather="grid"></i>
                                
                        </span>
                        <span id="close" class="text-white btn btn-info new-shadow position-fixed" 
                                style="border-radius: 30px;padding: 15px;bottom: 10px;right:15px;z-index:999;cursor:pointer;">
                                <i data-feather="x"></i>
                                
                        </span>
                        <div id="menu-list" class="position-fixed new-shadow-2">
                                
                                <a  href="{{url('approval')}}">
                                    <div class="btn btn-danger new-shadow-sm my-1" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="trash-2" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-danger badge-pill px-3 py-2 font-size-13 ">Delete Events</span> 
                                </a>
                                <a  href="{{url('add_student')}}">
                                    <div class="btn btn-primary new-shadow-sm my-1" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="users" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-primary badge-pill px-3 py-2 font-size-13 ">Add Student</span> 
                                </a>
                                <a  href="{{url('new_cod')}}">
                                    <div class="btn btn-warning new-shadow-sm my-1" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="user-plus" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-warning badge-pill px-3 py-2 font-size-13 ">Add Co-ordinator</span> 
                                </a>
                                <a  href="{{url('check_logs')}}">
                                    <div class="btn btn-info new-shadow-sm my-1" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="list" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-info badge-pill px-3 py-2 font-size-13 ">Check Logs</span> 
                                </a>
                                <a  href="{{url('event_reports')}}">
                                    <div class="btn new-shadow-sm my-1 text-white" style="border-radius: 30px;padding: 5px;background:var(--pink);">
                                        <i data-feather="calendar" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-pink badge-pill px-3 py-2 font-size-13">Event Reports</span> 
                                </a>
                                <a  href="{{url('student_records')}}">
                                    <div class="btn new-shadow-sm my-1 text-white" style="border-radius: 30px;padding: 5px;background:var(--orange);">
                                        <i data-feather="bar-chart-2" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-orange badge-pill px-3 py-2 font-size-13 " >Student Records</span> 
                                </a>
                                <a  href="{{url('snotice')}}">
                                    <div class="btn btn-success new-shadow-sm my-1" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="file-text" height="20px"></i> 
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-success badge-pill px-3 py-2 font-size-13">Send Notice</span>
                                </a>
                                <a  href="{{url('view_students')}}">
                                    <div class="btn new-shadow-sm my-1 text-white" style="border-radius: 30px;padding: 5px;background:var(--indigo);">
                                        <i data-feather="eye" height="20px"></i> 
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-indigo badge-pill px-3 py-2 font-size-13">View Students</span>
                                </a>
                                <a  href="{{url('/admin/winner-list')}}">
                                    <div class="btn new-shadow-sm my-1 text-white" style="border-radius: 30px;padding: 5px;background-color:#18a4e0;">
                                        <i data-feather="award" height="20px"></i> 
                                    </div>
                                    <span class="hover-me-sm badge bg-soft-info badge-pill px-3 py-2 font-size-13" style="color:#18a4e0;">Winners list</span>
                                </a>
                        </div>
                    </div>
                    <div id="menu-overlay" class="w-100 vh-100 position-fixed" style="top:0;left:0;z-index:99;">
                    
                    </div>
                    <!--end side rounded button for quick apps -->


    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <!-- Vendor js -->
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>

    @section('extra-scripts')

    @show
    <!-- App js -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script>
        $('#mail').click(function () {
            var last = <?php echo $lastnotice; ?>;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: 'alastnotice',
                data: {
                    "lastnote": last
                },
                success: function (data) {
                    $("#noti").removeClass('noti-icon-badge');
                },
                error: function (data) {
                    console.log(data);
                }
            })
        });
    </script>
    <script>
        $('.rightbar-overlay').click(function () {
            window.location.reload();
        });
        $('.notice-msg').find('p').css({'margin-bottom':'0px'});
    </script>

    <script>

    $(document).ready(function(){
        $('#menu-overlay,#close').hide();
        $('#menu-btn').click(function(){
            $('#menu-list').fadeIn(200);

            $('#menu-overlay,#close').show();
        });
        $('#menu-overlay,#close').click(function(){
            $('#menu-list,#menu-overlay').fadeOut(200);
            $('#close').hide();
        })
        
    });
    </script>
</body>

</html>
