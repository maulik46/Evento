<?php
    use \App\Http\Controllers\co_ordinate;
    co_ordinate::remain_result();
?>
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
        .btn-p-about:hover{
            background-color:rgba(37,194,227,.15);
        }
        .btn-p-result:hover{
            background-color:rgba(67,211,158,.15);
        }
        .btn-p-candidates:hover{
            background-color:rgba(83,105,248,.15);
        }
        .btn-about-cod:hover{
            background-color: rgba(37,194,227,.15);
            color: var(--info);
        }
        .btn-delete-cod:hover{
            background-color:rgba(255,92,117,.15);
            color: var(--danger);
        }
        @media(max-width:576px){
            .avatar-xxl{
                height:6rem;
                width:6rem;
            }
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
                        <div class="col-xl-4">
                            <div class="card new-shadow-sm">
                                <div class="card-body px-0">
                                    <h5 class="card-title mt-0 mb-0 header-title px-4">Participation by class</h5>
                                    <div id="sales-by-category-chart" class="apex-charts mb-0 mt-3" dir="ltr"></div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                         

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
                    <div class="col-xl-12 px-0">
                            <div class="card new-shadow-sm">
                            <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>
                                <div class="card-body p-0 d-flex flex-wrap">
                                     <!-- stat 1 -->
                                     <?php 
                                        $tot_event=\DB::table('tblevents')->where('clgcode',Session::get('clgcode'))->count();
                                     ?>
                                     <div class="col-md-4 media px-3 py-4 border-right border-bottom">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_event}}</h4>
                                             <span class="text-muted font-weight-bold">Total Events</span>
                                         </div>
                                         <i data-feather="calendar" class="align-self-center icon-dual-success icon-lg"></i>
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
                                     <div class="col-md-4 media px-3 py-4 border-right border-bottom">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_part}}</h4>
                                             <span class="text-muted font-weight-bold">Total Participator</span>
                                         </div>
                                         <i data-feather="users" class="align-self-center icon-dual-info icon-lg"></i>
                                     </div>
                                    <?php 
                                        $tot_co=\DB::table('tblcoordinaters')->where('clgcode',Session::get('clgcode'))->count();
                                    ?>
                                     <!-- stat 3 -->
                                     <div class="col-md-4 media px-3 py-4 ">
                                         <div class="media-body">
                                             <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_co}}</h4>
                                             <span class="text-muted font-weight-bold">Total Co-ordinator</span>
                                         </div>
                                         <i data-feather="user-check" class="align-self-center icon-dual-primary icon-lg"></i>
                                     </div>
                                </div>
                             </div>
                         </div>
                     <!-- products -->
                     <div class="row">
                         <div class="col-xl-12">
                             <div class="card new-shadow-sm" >
                                <h5 class="card-title mt-4 px-4 mb-1 header-title">Events</h5>
                                 <div class="card-body">
                                    <div class="table-responsive overflow-auto my-scroll" style="max-height: 300px;">
                                         <table class="table table-hover table-nowrap mb-0">
                                             <thead>
                                                 <tr>
                                                     <th scope="col">#</th>
                                                     <th scope="col">Event</th>
                                                     <th scope="col">Participator</th>
                                                     <th scope="col">Date</th>
                                                     <th scope="col">Co-ordinator</th>
                                                     <th scope="col">Status</th>
                                                     <th scope="col">Action</th>
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
                                                <td>
                                                    <a href="{{url('sevent_info')}}/{{encrypt($e['eid'])}}" class="btn p-1 btn-rounded mr-1 btn-p-about" data-toggle="tooltip" data-placement="top" title="About">
                                                        <i data-feather="info" height="18px" class=" text-info"></i>
                                                    </a>
                                                    <a href="{{url('sview_candidates')}}/{{encrypt($e['eid'])}}" class="btn btn-p-candidates btn-rounded p-1" style="margin-right:-2px;" data-toggle="tooltip" data-placement="top" title="View Candidates">
                                                        <i data-feather="users" height="18px" class="text-primary"></i>
                                                    </a>
                                                    <?php $r=\DB::table('tblparticipant')->select('senrl')->where([['eid',$e['eid']],['rank',1]])->count();?>
                                                    @if($r==1)
                                                    <a href="{{url('sview_result')}}/{{encrypt($e['eid'])}}" class="btn btn-p-result p-1 btn-rounded ml-1" data-toggle="tooltip" data-placement="top" title="Show Result">
                                                        <i data-feather="award" height="18px" class=" text-success"></i>
                                                    </a>
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
                      <div class="bg-white d-flex justify-content-between align-items-center flex-wrap mt-2 mb-2 py-2 rounded new-shadow-sm">
                          <div class="h4 d-flex align-items-center ml-4">
                              <i data-feather="users"></i>
                              <span class="ml-1">Event Co-ordinators</span>
                          </div>

                          <a href="{{url('new_cod')}}" class="text-success">
                              <div class="add-cod d-flex align-items-center badge badge-soft-info badge-pill pr-sm-3 py-2 mr-3">
                                  <i data-feather="plus-circle" height="18px"></i>
                                  <span class="font-size-13 d-none d-sm-flex">Add Co-ordinator</span>
                              </div>
                          </a>
                      </div>
                   
                <div class="row">
                <?php $count = 0; ?>
                    @foreach($cods as $c)
                    <?php $count++;?>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card rounded-lg new-shadow-sm hover-me-sm">    
                        <div class="card-body px-1 px-sm-2">
                            <div class="d-flex justify-content-between text-lg-left text-left text-sm-center flex-wrap ">
                                <div class="col col-lg-4 col-md-12 col-sm-4 col-4">
                                <img src="{{asset('profile_pic/'.$c->pro_pic)}}" alt="" class="avatar-xxl rounded-circle new-shadow-sm bg-light" style="border:1px solid #f1f1f1" />
                                </div>
                                <div class="col col-lg-8 col-md-12 col-sm-8 col-8">
                                    <h5 class="mt-2 mb-0">{{ucfirst($c['cname'])}}</h5>
                                    <h6 class="text-muted font-weight-normal mt-2 mb-0">
                                    <i data-feather="mail" height="18px"></i>
                                    <span class="font-weight-bold">{{$c['email']}}</span>
                                    </h6>
                                    <h6 class="text-muted font-weight-normal mt-2 mb-0">
                                    <i data-feather="phone" height="18px"></i>
                                    <span class="font-weight-bold">{{$c['mobile']}}</span>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-lg-start justify-content-md-center justify-content-sm-center ">
                                        <span class="badge badge-info badge-pill px-3 mt-3 mr-3 new-shadow-sm">{{ucfirst($c['category'])}}</span>
                                        <a href="#" data-toggle="tooltip" title="Remove Co-ordinator">
                                        <i data-feather="trash-2" id="close-btn" class="mt-3 text-dark" height="18px"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    </div>
                    @endforeach
                </div>
                     <!-- end row -->

                <div class="toast bg-white fade show border-0 new-shadow-2 rounded-lg position-fixed w-75" style="bottom:20px;left:10px;z-index:9999999;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
                    <?php $delay_res=\DB::table('tblresult_delay')->join('tblevents','tblevents.eid','tblresult_delay.eid')->join('tblcoordinaters','tblcoordinaters.cid','tblresult_delay.cid')->join('tblparticipant','tblparticipant.eid','tblevents.eid')->where('tblcoordinaters.clgcode',Session::get('clgcode'))->get()->toarray();?>
                    @if($delay_res)
                        <div class="toast-body text-dark alert mb-1">
                        <h5 class="text-center mt-0">Delay Result List</h5>
                        
                    @foreach($delay_res as $del_res)
                        <div class="card bg-soft-danger p-2 new-shadow hover-me-sm mb-2">
                            <div>
                                <span class="h5 my-1">{{ucfirst($del_res->ename)}}</span>
                            </div> 
                            <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-soft-dark px-3 badge-pill">By {{ucfirst($del_res->cname)}}</span>
                            <a href="{{url('delay_res')}}/{{$del_res->eid}}" class="badge badge-success badge-pill px-2 pl-3">
                                <span>Declare</span>
                                <i data-feather="arrow-right-circle" height="15px" class="text-white"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @endif
                </div>
                <!-- </div>     -->

                </div> <!-- end container fluid-->
             

    
@endsection

 
