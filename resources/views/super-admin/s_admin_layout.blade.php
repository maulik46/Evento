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
                                <img src="{{asset('assets/images/svg-icons/super-admin/man1.svg')}}" alt="user-image"
                                    class="align-self-center" />
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
                            <div class="media dropdown-item d-sm-none d-md-none">
                                <img src="{{asset('assets/images/svg-icons/super-admin/man1.svg')}}" alt="user-image"
                                    height="40px" class="align-self-center" />
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
                                <span>Home</span>
                            </a>
                            <a href="{{url('new_cod')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="user-plus" class="icon-dual-success icon-xs mr-2"></i>
                                <span>Add Co-ordinator</span>
                            </a>
                            <a href="{{url('snotice')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                <span>Create Notice</span>
                            </a>
                            <a href="{{url('s_change_pass')}}" class="dropdown-item notify-item my-2">
                                <i data-feather="key" class="icon-dual-info icon-xs mr-2"></i>
                                <span>Change Password</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="{{url('alogout')}}" class="dropdown-item notify-item">
                                <i data-feather="log-out" class="icon-dual-danger icon-xs mr-2"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                        <?php
                            $notice = \DB::table('tblnotice')->where([['receiver','LIKE', '%admin%'], ['clgcode', Session::get('clgcode')]])->orderby('nid', 'desc')->get()->toarray();
                            $lastevent = App\admin::select('last_noti')->where('aid', Session::get('aid'))->first();
                            $count = \DB::table('tblnotice')->select('nid')->where([['nid', '>', $lastevent->last_noti], ['receiver','LIKE', '%admin%'], ['clgcode', Session::get('clgcode')]])->count();
                        ?>
                    <li class="nav-item notification-list" data-toggle="tooxltip" data-placement="bottom" title="Inbox">
                        <a href="#" class="text-dark right-bar-toggle" id="mail">
                            <i data-feather="mail" height="19px" id="nav-menu-btn"></i>
                            @if($count>0)
                            <span class="noti-icon-badge" id="noti"></span>
                            @endif
                        </a>
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
        <div class="rightbar-title" style="border-bottom: 1px solid #d3d3d36b;">
            <a href="#" class="right-bar-toggle float-right text-dark" id="close-btn"
                onclick="window.location.reload()">
                <i data-feather="x-circle" height="20px"></i>
            </a>
            <h4 class="m-0">Inbox</h4>
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
            <div class="card new-shadow-sm my-2 hover-me-sm"
                style="border-left: 4px solid #ff5c75;border-radius:0px 10px 10px 0px;">
                @else
                <div class="card new-shadow-sm my-2 hover-me-sm" style="border-left: 4px solid #1AE1AC;border-radius:0px 10px 10px 0px;">
                    @endif
                    <div class="card-body py-0" >
                        <div class="d-flex justify-content-between align-items-center flex-wrap" style="margin:-10px 0px;">
                            <span
                                class="badge badge-soft-primary px-3 py-1 badge-pill">{{date('d/m/Y',strtotime($nt->ndate))}}
                            </span>
                            <div class="d-flex align-items-end flex-column flex-wrap">
                                <h6>{{ucfirst($nt->sender)}}</h6>
                                <span class="badge badge-warning text-white badge-pill" style="padding: 0.3em 0.6rem">Admin</span>
                            </div>    
                        </div>
                        <div>
                            <h5 class="mt-0">{{ucfirst($nt->topic)}}</h5>
                            <div class="card-text mb-2">
                                {!! ucfirst($nt->message) !!}
                            </div>
                            @if($nt->attechment)
                            <?php $att = explode('-',$nt->attechment);
                                $c=count($att);
                                $a=0;
                            ?>

                            <div class="card-action my-2">
                                @foreach($att as $attachment)
                                <?php $a++;?>
                                @if($a<$c) <a href="{{asset('attachment')}}/{{$attachment}}"
                                    class="btn badge badge-info badge-pill p-2 new-shadow-sm font-weight-bold px-3 mr-1"
                                    download="{{substr($attachment, strpos($attachment, 'N') + 1)}}">
                                    {{substr($attachment, strpos($attachment, "N") + 1)}}</a>
                                    @endif
                                    @endforeach
                            </div>

                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
    <!-- inbox Right-bar -->

    <!-- Right bar overlay-->

    <div class="rightbar-overlay"></div>

    <!-- end Right bar overlay-->



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
    </script>
</body>

</html>