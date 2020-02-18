<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Super-admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    
    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
   
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/my-extra.css">

    <style>
        .profile-dropdown-items {
            width: 200px;
        }

        .content-page {
            margin: 50px 0px !important;

        }
        #event-info:hover{
        color: #43d39e!important;
        fill: #fff;
        }
        .event-option.show{
        top:25%!important;
        right:2%!important;
        width: 150px;
        }
/* css for event co-ordinator list in index page */
        .cod-option{
            display: none!important;
        }
        .cod-card:hover{
            background-color: #35bbca14;
            border-radius: .3rem;
            
        }
        .cod-card:hover .cod-option{
            display: flex!important;
        } 
        .cod-name:hover{
            color: #35bbca!important;
        }

        /* right inbox sidebar */
        /* .new-msg{
            transition: transform .3s cubic-bezier(.34,2,.6,1),box-shadow .2s ease,-webkit-transform .3s cubic-bezier(.34,2,.6,1);
        }
       .new-msg:hover{
           -webkit-transform: translateY(-3px);
           transform: translateY(-3px);
           box-shadow: 0 4px 8px 0 rgba(0,0,0,.12), 0 2px 4px 0 rgba(0,0,0,.08);
       } */
        .right-bar-enabled .right-bar {
            right: 0;
            min-width: 450px;
        }
        .notification-list .noti-icon-badge{
            position: relative;
            top:-4px;
            right: 12px;
        }
        @media(max-width: 600px){
        .right-bar-enabled .right-bar {
            right: 0;
            min-width: 100%;
            }
        }
        
        /* end right inbox sidebar */
    </style>
</head>

<body data-layout="topnav" class="body-scroll">
    <!-- Begin page -->
    <div class="wrapper">
    @if(Session::has('success'))
           
           <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:9999999;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
               <div class="toast-body text-white alert mb-1">
                   <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                       <i data-feather="x-circle" id="close-btn" height="18px" ></i>
                   </a>
                   <div class="mt-2 font-weight-bold font-size-14">
                       {{Session::get('success')}}
                   </div> 
                   
               </div>
           </div>
    @endif
    <!-- Topbar Start -->
        <div class="navbar navbar-expand flex-column flex-md-row navbar-custom position-fixed w-100 new-shadow-sm">
            <div class="container-fluid">
                <!-- LOGO -->
                <a href="index.html" class="navbar-brand mx-2">
                    <span class="logo-lg">
                        <img src="../assets/images/logo.png" alt="" height="24" />
                        <span class="d-inline h3 font-weight-bold">Evento</span>
                        <h6 class="my-0 text-muted font-size-12 d-sm-none d-md-none" style="margin-left: 30px;">Super-admin</h6>
                    </span>
                </a>

                <ul class="navbar-nav align-items-center flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list align-self-center profile-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false" >
                            <div class="media user-profile ">
                                <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image"
                                    class="align-self-center" />
                                <div class="media-body text-left d-none d-sm-block">
                                    <h6 class="ml-2 my-0" id="nav-menu-btn">
                                        <span>{{ucfirst(Session::get('aname'))}}</span>
                                        <span class="text-muted d-block font-size-12 mt-1">
                                            Super-admin
                                        </span>
                                    </h6>
                                </div>
                                <span data-feather="chevron-down" class="ml-2 align-self-center" id="nav-menu-btn"></span>
                            </div>
                        </a>
                        <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                            <div class="media dropdown-item d-sm-none d-md-none">
                                <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image" height="40px"
                                    class="align-self-center" />
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
                            <a href="sindex" class="dropdown-item notify-item mb-2">
                                <i data-feather="home" class="icon-dual-primary icon-xs mr-2"></i>
                                <span>Home</span>
                            </a>
                            <a href="new_cordinate.html" class="dropdown-item notify-item my-2">
                                <i data-feather="user-plus" class="icon-dual-success icon-xs mr-2"></i>
                                <span>Add Co-ordinator</span>
                            </a>
                            <a href="snotice" class="dropdown-item notify-item my-2">
                                <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                <span>Create Notice</span>
                            </a>
                            <a href="s_change_pass" class="dropdown-item notify-item my-2">
                                <i data-feather="key" class="icon-dual-info icon-xs mr-2"></i>
                                <span>Change Password</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="alogout" class="dropdown-item notify-item">
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
             <div class="content mt-5">
                 <div class="container-fluid">
                     <!-- content -->
                   

                     <!-- stats + charts -->
                     <div class="row">
                         <div class="col-xl-4 col-md-4">
                             <div class="card new-shadow-sm">
                                 <div class="card-body p-0">
                                     <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>
                                     <!-- stat 1 -->
                                     <?php 
                                        $tot_event=\DB::table('tblevents')->where('clgcode',Session::get('clgcode'))->count();
                                     ?>
                                     <div class="media px-3 py-4 border-bottom">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_event}}</h4>
                                             <span class="text-muted">Total Events</span>
                                         </div>
                                         <i data-feather="calendar" class="align-self-center icon-dual icon-lg"></i>
                                     </div>
                                     <?php 
                                        $tot_part=0;
                                     ?>
                                     @foreach($events as $e)
                                        <?php
                                            $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                                                $tot_part=($e['tsize'] * $p)+$tot_part;
                                        ?>
                                     @endforeach
                                     <!-- stat 2 -->
                                     <div class="media px-3 py-4 border-bottom">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_part}}</h4>
                                             <span class="text-muted">Total Participator student</span>
                                         </div>
                                         <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>
                                     </div>
                                    <?php 
                                        $tot_co=\DB::table('tblcoordinaters')->where('clgcode',Session::get('clgcode'))->count();
                                    ?>
                                     <!-- stat 3 -->
                                     <div class="media px-3 py-4">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_co}}</h4>
                                             <span class="text-muted">Total Co-ordinator</span>
                                         </div>
                                         <i data-feather="user-check" class="align-self-center icon-dual icon-lg"></i>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="col-xl-8 col-md-8">
                             <div class="card new-shadow-sm">
                                 <div class="card-body pb-0">
                                     <ul class="nav card-nav float-right">
                                         <li class="nav-item">
                                             <a class="nav-link text-muted" href="#">Today</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link text-muted" href="#">7d</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link active" href="#">15d</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link text-muted" href="#">1m</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link text-muted" href="#">1y</a>
                                         </li>
                                     </ul>
                                     <h5 class="card-title mb-0 header-title">Revenue</h5>

                                     <div id="revenue-chart" class="apex-charts mt-3" dir="ltr"></div>
                                 </div>
                             </div>
                         </div>

                     </div>
                     <!-- row -->

                     <!-- products -->
                     <div class="row">
                         <div class="col-xl-5">
                             <div class="card new-shadow-sm">
                                 <div class="card-body px-0">
                                     <h5 class="card-title mt-0 mb-0 header-title px-4">Participation by class</h5>
                                     <div id="sales-by-category-chart" class="apex-charts mb-0 mt-3" dir="ltr"></div>
                                 </div> <!-- end card-body-->
                             </div> <!-- end card-->
                         </div> <!-- end col-->
                         <div class="col-xl-7 ">
                             <div class="card new-shadow-sm" style="max-height: 350px;">
                                <h5 class="card-title mt-4 px-4 mb-1 header-title">Recent Event</h5>
                                 <div class="card-body overflow-auto my-scroll">
                                     <div class="table-responsive overflow-auto my-scroll">
                                         <table class="table table-hover table-nowrap mb-0">
                                             <thead>
                                                 <tr>
                                                     <th scope="col">#</th>
                                                     <th scope="col">Event</th>
                                                     <th scope="col">Total Participator</th>
                                                     <th scope="col">Date</th>
                                                     <th scope="col">Co-ordinator</th>
                                                     <th scope="col">Status</th>
                                                 </tr>
                                             </thead>
                                             <tbody><?php $c=0 ?>
                                                @foreach($events as $e)
                                                <?php $c++;
                                                    $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                                                    $co=\DB::table('tblcoordinaters')->select('cname')->where('cid',$e['cid'])->first();
                                                ?>
                                                <tr>
                                                    <td>#{{$c}}</td>
                                                    <td>{{ucfirst($e['ename'])}} compition</td>
                                                    <td>{{$p}}</td> <!--total Participator -->
                                                    <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                                                    <td>{{ucfirst($co->cname)}}</td>
                                                    <td>
                                                        @if($e['edate'] == date('Y-m-d'))
                                                        <span class="badge badge-soft-success badge-pill px-3 py-1">Running</span>
                                                        @elseif($e['edate'] > date('Y-m-d'))
                                                        <span class="badge badge-soft-warning badge-pill px-3 py-1">Upcoming</span>
                                                        @elseif($e['edate'] < date('Y-m-d')) 
                                                        <span class="badge badge-soft-info badge-pill px-3 py-1">Finished</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                 <!-- <tr>
                                                     <td>#1</td>
                                                     <td>Cricket compititon</td>
                                                     <td>5</td>
                                                     <td>20/12/2019</td>
                                                     <td>
                                                         <span class="badge badge-soft-success badge-pill px-2">Running</span>
                                                     </td>
                                                 </tr >
                                                  

                                                 <tr>
                                                     <td>#2</td>
                                                     <td>PHP Quiz compititon</td>
                                                     <td>12</td>
                                                     <td>28/12/2019</td>
                                                     <td>
                                                         <span class="badge badge-soft-warning badge-pill px-2">Upcoming</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>#3</td>
                                                     <td>Drawing compititon</td>
                                                     <td>16</td>
                                                     <td>12/12/2019</td>
                                                     <td>
                                                         <span class="badge badge-soft-info badge-pill px-2">Finished</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>#2</td>
                                                     <td>PHP Quiz compititon</td>
                                                     <td>12</td>
                                                     <td>28/12/2019</td>
                                                     <td>
                                                         <span
                                                             class="badge badge-soft-warning badge-pill px-2">Upcoming</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>#3</td>
                                                     <td>Drawing compititon</td>
                                                     <td>16</td>
                                                     <td>12/12/2019</td>
                                                     <td>
                                                         <span
                                                             class="badge badge-soft-info badge-pill px-2">Finished</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>#2</td>
                                                     <td>PHP Quiz compititon</td>
                                                     <td>12</td>
                                                     <td>28/12/2019</td>
                                                     <td>
                                                         <span
                                                             class="badge badge-soft-warning badge-pill px-2">Upcoming</span>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>#3</td>
                                                     <td>Drawing compititon</td>
                                                     <td>16</td>
                                                     <td>12/12/2019</td>
                                                     <td>
                                                         <span
                                                             class="badge badge-soft-info badge-pill px-2">Finished</span>
                                                     </td>
                                                 </tr> -->
                                             </tbody>
                                         </table>
                                     </div> <!-- end table-responsive-->
                                 </div> <!-- end card-body-->
                             </div> <!-- end card-->
                         </div> <!-- end col-->
                     </div>
                     <!-- end row -->

                     <!-- widgets -->
                      <div class="bg-white d-flex justify-content-between align-items-center flex-wrap mt-2 mb-2 py-2">
                          <div class="h4 d-flex align-items-center ml-4">
                              <i data-feather="users"></i>
                              <span class="ml-1">Event Co-ordinators</span>
                          </div>

                          <a href="new_cordinate.html" class="text-success d-none d-sm-block ">
                              <div class="hover-me-sm d-flex align-items-center badge badge-soft-info badge-pill pr-3 py-2 mr-3">
                                  <i data-feather="plus-circle" height="18px"></i>
                                  <span class="font-size-13">Add Co-ordinator</span>
                              </div>
                          </a>
                      </div>
                     <div class="row">
                         <div class="col-xl-12">
                             <div class="card new-shadow-sm" style="max-height: 300px;">
                                 <div class="row card-body pt-2 my-scroll overflow-auto">
                                     @foreach($cods as $cod)
                                     <div class="hover-me-sm col-lg-4 col-md-6 cod-card media mt-1 py-2">
                                         <img src="../assets/images/users/avatar-7.jpg" class="avatar rounded mr-3"
                                             alt="shreyu">
                                         <div class="media-body">
                                             <a href="#">
                                             <h6 class="mt-1 mb-0 font-size-15 cod-name">{{ucfirst($cod['cname'])}}</h6>
                                             <h6 class="text-muted font-weight-normal mt-1 mb-3">{{ucfirst($cod['category'])}} Events</h6>
                                             </a>
                                         </div>
                                        <div class="cod-option d-flex flex-column">
                                            <a href="#" class="text-warning mb-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                 <i data-feather="edit-3" height="18px"></i>
                                             </a>
                                            <a href="#" class="text-danger mt-1" data-toggle="tooltip" data-placement="left" title="Delete">
                                                 <i data-feather="trash-2" height="18px"></i>
                                            </a>
                                        </div>
                                     </div>
                                     @endforeach
                                     <!-- <div class="hover-me-sm col-lg-4 col-md-6 cod-card media mt-1 py-2">
                                         <img src="../assets/images/users/avatar-9.jpg" class="avatar rounded mr-3"
                                             alt="shreyu">
                                         <div class="media-body">
                                             <a href="#">
                                             <h6 class="mt-1 mb-0 font-size-15 cod-name">Parth Patthar</h6>
                                             <h6 class="text-muted font-weight-normal mt-1 mb-3">Cultural Events</h6>
                                             </a>
                                         </div>
                                         <div class="cod-option d-flex flex-column">
                                             <a href="#" class="text-warning mb-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                 <i data-feather="edit-3" height="18px"></i>
                                             </a>
                                             <a href="#" class="text-danger mt-1" data-toggle="tooltip" data-placement="left" title="Delete">
                                                 <i data-feather="trash-2" height="18px"></i>
                                             </a>
                                         </div>
                                     </div>
                                     <div class="hover-me-sm col-lg-4 col-md-6 cod-card media mt-1 py-2">
                                         <img src="../assets/images/users/avatar-4.jpg" class="avatar rounded mr-3"
                                             alt="shreyu">
                                         <div class="media-body">
                                             <a href="#">
                                             <h6 class="mt-1 mb-0 font-size-15 cod-name">Parth Patthar</h6>
                                             <h6 class="text-muted font-weight-normal mt-1 mb-3">IT Events</h6>
                                             </a>
                                         </div>
                                         <div class="cod-option d-flex flex-column">
                                             <a href="#" class="text-warning mb-1" data-toggle="tooltip" data-placement="left" title="Edit">
                                                 <i data-feather="edit-3" height="18px"></i>
                                             </a>
                                             <a href="#" class="text-danger mt-1" data-toggle="tooltip" data-placement="left" title="Delete">
                                                 <i data-feather="trash-2" height="18px"></i>
                                             </a>
                                         </div>
                                     </div>
                                      <div class="hover-me-sm col-lg-4 col-md-6 cod-card media mt-1 py-2">
                                          <img src="../assets/images/users/avatar-4.jpg" class="avatar rounded mr-3"
                                              alt="shreyu">
                                          <div class="media-body">
                                              <a href="#">
                                                  <h6 class="mt-1 mb-0 font-size-15 cod-name">Parth Patthar</h6>
                                                  <h6 class="text-muted font-weight-normal mt-1 mb-3">IT Events</h6>
                                              </a>
                                          </div>
                                          <div class="cod-option d-flex flex-column">
                                              <a href="#" class="text-warning mb-1" data-toggle="tooltip"
                                                  data-placement="left" title="Edit">
                                                  <i data-feather="edit-3" height="18px"></i>
                                              </a>
                                              <a href="#" class="text-danger mt-1" data-toggle="tooltip"
                                                  data-placement="left" title="Delete">
                                                  <i data-feather="trash-2" height="18px"></i>
                                              </a>
                                          </div>
                                      </div> -->
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!-- end row -->

                     <!-- side rounded button for create notice and co-ordinator -->
                    <div>
                        <a href="new_cordinate.html" class="hover-me btn btn-info new-shadow-sm position-fixed" data-toggle="tooltip"
                            data-placement="left" title="Add Co-ordinator"
                            style="border-radius: 30px;padding: 15px;bottom: 75px;right:12px; background-color: #35bbca;">
                            <i data-feather="user-plus"></i>
                        </a>
                        <a href="snotice" class="hover-me btn btn-success new-shadow-sm position-fixed" data-toggle="tooltip" data-placement="left" title="Create Notice"
                            style="border-radius: 30px;padding: 15px;bottom: 10px;right:12px;">
                            <i data-feather="edit"></i>
                        </a>
                    </div>
                    <!--end side rounded button for create notice and co-ordinator -->

                 </div> <!-- end container fluid-->
             </div>

    </div>
</div>
<!-- end wrapper -->

 <!-- inbox Right Sidebar -->

 <div class="right-bar bg-light overflow-auto my-scroll">
             <div class="rightbar-title" style="border-bottom: 1px solid #d3d3d36b;">
                 <a href="#" class="right-bar-toggle float-right text-dark" id="close-btn" onclick="window.location.reload()">
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
            <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #ff5c75;">
            @else
            <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #1AE1AC;">
            @endif
                           <div class="card-body py-2">
                               <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <span class="badge badge-soft-primary px-3 py-1 badge-pill">{{date('d/m/Y',strtotime($nt->ndate))}}</span>
                                    <h6>{{ucfirst($nt->sender)}}</h6>
                               </div>
                               <div>
                                    <h5 class="mt-0">{{ucfirst($nt->topic)}}</h5>
                                    <div class="card-text mb-1">
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
                                            @if($a<$c)
                                                    <a href="{{asset('attachment')}}/{{$attachment}}" class="btn btn-soft-danger rounded-sm new-shadow-sm font-weight-bold px-3 mr-1" download="{{substr($attachment, strpos($attachment, 'N') + 1)}}">{{substr($attachment, strpos($attachment, "N") + 1)}}</a> 
                                            @endif
                                            @endforeach    
                                                </div> 
                                            
                                    @endif
                               </div>
                           </div>
                       </div>
            @endforeach
                 <!-- <div class="card new-shadow-sm my-2  hover-me-sm rounded-0">
                     <div class="card-body py-2">
                         <div class="d-flex justify-content-between align-items-center flex-wrap">
                             <span class="badge badge-soft-primary px-3 py-1 badge-pill">28/12/2019</span>
                             <h6>Dr.Rohit Radadiya</h6>
                         </div>
                         <div>
                             <h5 class="mt-0">Picnic Notice</h5>
                             <div class="card-text">
                                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Non tenetur possimus
                                 adipisci?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis
                                 explicabo itaque fugit pariatur adipisci. Quod, pariatur corrupti, laborum eius
                                 quaerat eos vero, necessitatibus inventore nihil provident ut consequuntur
                                 soluta magnam.
                             </div>
                             <div class="card-action my-2">
                                 <a href="#"
                                     class="btn btn-soft-success rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">XYZ.txt</a>

                                 <a href="#"
                                     class="btn btn-soft-success rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">XYZ.pdf</a>
                             </div>
                         </div>

                     </div>
                 </div> -->
             </div>
         </div>
 <!-- inbox Right-bar -->

 <!-- Right bar overlay-->

 <div class="rightbar-overlay"></div>

 <!-- end Right bar overlay-->



    <script src="../assets/js/jquery.min.js"></script>
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/libs/moment/moment.min.js"></script>
     <script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
     <script src="../assets/libs/flatpickr/flatpickr.min.js"></script>
      <script src="../assets/js/pages/dashboard.init.js"></script>

    <!-- optional plugins -->
    <script src="../assets/js/app.min.js"></script>
    <script>
        $('#mail').click(function(){
            var last=<?php echo $lastnotice; ?>;
            $.ajaxSetup({
                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
            $.ajax({
                type:'POST',
                url:'alastnotice',
                data:{"lastnote":last},
                success:function(data) {
                    $("#noti").removeClass('noti-icon-badge');
                },
                error:function(data){
                console.log(data);
                }
                })
        });
    </script>
<script>
$('.rightbar-overlay').click(function(){
    window.location.reload();
});
</script>
</body>

</html>
