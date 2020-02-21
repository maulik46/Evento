@extends('super-admin/s_admin_layout')

@section('title','Super Admin dashboard')

@section('head-tag-links')
    <style>
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
            border-radius: .3rem;
            border-color:transparent!important;
        }
        .cod-card:hover .cod-option{
            display: flex!important;
        } 
        .cod-card:hover .cod-name{
            color: #35bbca!important;
        }

        .notification-list .noti-icon-badge{
            position: relative;
            top:-4px;
            right: 12px;
        }
        .btn-about-cod:hover{
            background-color: rgba(37,194,227,.15);
            color: var(--info);
        }
        .btn-delete-cod:hover{
            background-color:rgba(255,92,117,.15);
            color: var(--danger);
        }
        .btn-update-cod:hover{
            background-color:rgba(255,190,11,.15);
            color: var(--warning);
        }
        #menu-list a{
            display:flex;
            align-items:center;
            flex-wrap:wrap;
            
        }
        #menu-list{
            border-radius: 7px;
            bottom: 78px;
            right:25px;
            z-index:999;
            width:auto;
            height:auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: start;
            padding: 10px;
            background:rgba(255,255,255,0.5);
        }
        #menu-list:hover{
            background:#fff;
        }
        #menu-list a{
            margin-top: 4px;
        }
        #menu-list a span{
            margin-left:3px;
            margin-top:2px;
        }
        .badge-soft-orange{
            background:rgba(247, 126, 83, 0.22)!important;
            color:var(--orange)!important;
        }
    </style>
@endsection
@section('my-content')

    <div class="container-fluid">
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
                                     
                                    <h5 class="card-title mb-0 header-title">Revenue</h5>

                                    <div id="revenue-chart" class="apex-charts mt-3" dir="ltr"></div>
                                 </div>
                             </div>
                         </div>

                     </div>
                     <!-- row -->

                     <!-- products -->
                     <div class="row">
                         <div class="col-xl-4">
                             <div class="card new-shadow-sm">
                                 <div class="card-body px-0">
                                     <h5 class="card-title mt-0 mb-0 header-title px-4">Participation by class</h5>
                                     <div id="sales-by-category-chart" class="apex-charts mb-0 mt-3" dir="ltr"></div>
                                 </div> <!-- end card-body-->
                             </div> <!-- end card-->
                         </div> <!-- end col-->
                         <div class="col-xl-8">
                             <div class="card new-shadow-sm" >
                                <h5 class="card-title mt-4 px-4 mb-1 header-title">Recent Event</h5>
                                 <div class="card-body">
                                     <div class="table-responsive overflow-auto my-scroll" style="max-height: 300px;">
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
                                                          @if($e['edate'] <= date('Y-m-d') && $e['enddate'] >= date('Y-m-d'))
                                                            <span class="badge badge-soft-success badge-pill px-3 py-1">Running</span>
                                                            @elseif($e['edate'] > date('Y-m-d'))
                                                            <span class="badge badge-soft-warning badge-pill px-3 py-1">Upcoming</span>
                                                            @elseif($e['edate'] < date('Y-m-d')) 
                                                            <span class="badge badge-soft-info badge-pill px-3 py-1">Finished</span>
                                                            @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                                 
                                             </tbody>
                                         </table>
                                     </div> <!-- end table-responsive-->
                                 </div> <!-- end card-body-->
                             </div> <!-- end card-->
                         </div> <!-- end col-->
                     </div>
                     <!-- end row -->

                     <!-- widgets -->
                      <div class="bg-white d-flex justify-content-between align-items-center flex-wrap mt-2 mb-2 py-2 rounded">
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
                                 <div class="row justify-content-around card-body pt-2 my-scroll overflow-auto">
                                     @foreach($cods as $cod)
                                     <div class="hover-me-sm col-lg-5 col-md-6 col-sm-12 cod-card media rounded-lg mt-1 py-2 align-items-end" style="border: 1px solid #3333331f;">
                                        <img src="../assets/images/users/avatar-7.jpg" class="mr-3 rounded-lg" style="height:4.5rem;width:4.5rem;">
                                        <div class="media-body">
                                             <a href="#">
                                             <h6 class="mt-1 mb-0 font-size-18 cod-name">{{ucfirst($cod['cname'])}}</h6>
                                             <h5 class="text-muted font-size-15 font-weight-normal mt-1 mb-3">{{ucfirst($cod['category'])}} Events</h5>
                                             </a>
                                        </div>

                                        <div class="d-flex flex-row flex-wrap mb-1">
                                            <a href="#" class="btn-rounded p-1 btn-update-cod text-warning" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i data-feather="edit-3" height="18px"></i>
                                             </a>
                                            <a href="#" class="btn-rounded p-1 btn-delete-cod text-danger" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i data-feather="trash-2" height="18px"></i>
                                            </a>
                                            <a href="#" class="btn-rounded p-1 btn-about-cod text-info" data-toggle="tooltip" data-placement="top" title="About">
                                                <i data-feather="info" height="18px"></i>
                                            </a>
                                        </div>
                                     </div>
                                     @endforeach
                                    <!-- 
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
                     <!-- end row -->

                     <!-- side rounded button for create notice and co-ordinator -->
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
                            
                                <a  href="{{url('snotice')}}" data-toggle="tooltip" data-placement="left" title="Create Notice">
                                    <div class="btn btn-success new-shadow-sm" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="edit" height="20px"></i> 
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-success badge-pill px-3 py-2 font-size-13 new-shadow-sm mb-2">Add Notice</span>
                                </a>
                                <a  href="{{url('new_cod')}}" data-toggle="tooltip" data-placement="left" title="Create Co-ordinator">
                                    <div class="btn btn-warning new-shadow-sm mt-2" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="user-plus" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-warning badge-pill px-3 py-2 font-size-13 new-shadow-sm">Add Co-ordinator</span> 
                                </a>
                                <a  href="{{url('new_cod')}}" data-toggle="tooltip" data-placement="left" title="Create Co-ordinator">
                                    <div class="btn btn-info new-shadow-sm mt-2" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="file-text" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-info badge-pill px-3 py-2 font-size-13 new-shadow-sm">Check Logs</span> 
                                </a>
                                <a  href="{{url('new_cod')}}" data-toggle="tooltip" data-placement="left" title="Create Co-ordinator">
                                    <div class="btn btn-primary new-shadow-sm mt-2" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="user-plus" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-primary badge-pill px-3 py-2 font-size-13 new-shadow-sm">Add Student</span> 
                                </a>
                                <a  href="{{url('new_cod')}}" data-toggle="tooltip" data-placement="left" title="Create Co-ordinator">
                                    <div class="btn btn-danger new-shadow-sm mt-2" style="border-radius: 30px;padding: 5px;">
                                        <i data-feather="check-square" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-danger badge-pill px-3 py-2 font-size-13 new-shadow-sm">Approve Events</span> 
                                </a>
                                <a  href="{{url('new_cod')}}" data-toggle="tooltip" data-placement="left" title="Create Co-ordinator">
                                    <div class="btn new-shadow-sm mt-2 text-white" style="border-radius: 30px;padding: 5px;background:var(--orange);">
                                        <i data-feather="bar-chart-2" height="20px"></i>
                                    </div>
                                    <span class="hover-me-sm badge badge-soft-orange badge-pill px-3 py-2 font-size-13 new-shadow-sm" >Filter Records</span> 
                                </a>
                        </div>
                    </div>
                    <div id="menu-overlay" class="w-100 vh-100 position-fixed" style="top:0;left:0;z-index:99;">
                    
                    </div>
                    <!--end side rounded button for create notice and co-ordinator -->

                 </div> <!-- end container fluid-->
             

    
@endsection
@section('extra-scripts')
<script>

    $(document).ready(function(){
        $('#menu-list,#menu-overlay,#close').hide();
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
@endsection

 
