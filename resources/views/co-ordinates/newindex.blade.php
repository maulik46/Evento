<?php
    use \App\Http\Controllers\co_ordinate;
    co_ordinate::remain_result();
?>
@extends('co-ordinates/cod_layout')

@section('title','Co-ordinator dashboard')

@section('head-tag-links')
<style>
    #event-info:hover {
        color: #43d39e !important;
        fill: #fff;
    }
    
    .event-option.show {
        top: 25% !important;
        right: 2% !important;
        width: 150px;
    }
        .toast {
            width: 400px !important;
            max-width: none;
        }

        .new-event:hover {
            background: #43d39e;
            color: #fff !important;
        }
        .winner-list:hover{
            background: var(--danger);
            color: #fff !important;

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
        .form-control:focus {
        border-color: lightgray !important;
    }
            
</style>
@endsection



@section('my-content')
<div class="container-fluid">
    @if(Session::has('success'))
           
           <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
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
<!-- charts -->

    <div class="row justify-content-between align-items-center">
        <div class="col-md-7 col-sm-12">
            <div class="card pr-4 py-2 new-shadow-sm">
                <div id="chart-2" class="apex-charts"></div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="card new-shadow-sm p-1 px-3 overflow-auto my-scroll" style="height:340px;">
            <div class="h5 d-flex align-items-center justify-content-center">
                <i data-feather="calendar" height="18px" class="icon-dual-dark"></i>
                <span class="ml-1">My Running Events</span>
            </div>   
            <hr class="mt-1 mb-2">
            <?php $c = 0;$a=0;?>
            @foreach($events as $e)
            <?php $c++;
            $p = \DB::table('tblparticipant')->select('senrl')->where('eid', $e['eid'])->count();
            ?>
            @if($e['cid']==Session::get('cid'))
            @if($e['edate'] <= date('Y-m-d') && $e['enddate'] >= date('Y-m-d'))
             <?php $a=1;?>
                <div class="card bg-light new-shadow-sm mb-2 my-1 px-2 rounded-0 hover-me-sm">
                    <div class="d-flex justify-content-between align-items-center px-1">
                        <div>
                        @if($e['e_type']=='team')
                            <span class="badge badge-soft-warning px-3 badge-pill">Team</span>
                        @else
                            <span class="badge badge-soft-info px-3 badge-pill">Solo</span>
                        @endif    
                            <span class="badge badge-soft-dark px-3 badge-pill">
                            {{date('d/m/Y', strtotime($e['edate']))}}
                            </span>
                       
                        </div>
                        <div>
                        <?php 
                            $result=\DB::table('tblparticipant')->where([['eid',$e['eid']],['rank',1]])->count();
                        ?>
                            <a href="{{url('view_candidates')}}/{{encrypt($e['eid'])}}" class="btn btn-p-candidates btn-rounded p-1" style="margin-right:-2px;" data-toggle="tooltip" data-placement="top" title="View Candidates">
                                <i data-feather="users" height="18px" class="text-primary"></i>
                            </a>
                            <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="btn btn-p-about btn-rounded p-1" data-toggle="tooltip" data-placement="top" title="About">
                                <i data-feather="info" height="18px" class="text-info"></i>
                            </a>
                            @if($result == 0)
                            <a href="{{url('create_result')}}/{{encrypt($e['eid'])}}" class="btn btn-p-result btn-rounded p-1" style="margin-right:-2px;" data-toggle="tooltip" data-placement="top" title="Announce Result">
                                <i data-feather="award" height="18px" class="text-success"></i>
                            </a>
                            @else
                            <a href="{{url('view_result')}}/{{encrypt($e['eid'])}}" class="btn btn-p-result p-1 btn-rounded ml-1" data-toggle="tooltip" data-placement="top" title="Show Result">
                                    <i data-feather="award" height="18px" class=" text-success"></i>
                            </a>
                            @endif
                         </div>
                    </div>
                    <div style="margin-top:-5px;">
                        <h5>{{ucfirst($e['ename'])}} competition</h5>
                        </div>
                    
                </div>
               @endif
               @endif
               @endforeach 
               @if($a==0)
                    <div class="font-size-15 font-weight-bold text-dark d-flex align-items-center justify-content-center" style="height:200px;">
                            No running events available..!
                    </div>
                @endif
            </div>
        </div>    
            
                <!-- <canvas id="canvas"></canvas> -->
                
    </div>

<!-- charts over -->

    <div class="card mt-2 mb-0 new-shadow-sm">
        <div class="py-2 navbar">
            <div class="h4">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">All Events</span>
            </div>
            <div class="col-xl-3 col-md-6 col-12 mb-0 form-group has-icon d-flex align-items-center px-0">
                <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                <input type="text" id="myInput" class="form-control" placeholder="Search Events" />
            </div>
        </div>
    </div> 
    <div class="card new-shadow-sm mt-2" >
        <div class="card-body py-2 px-1 px-sm-2">
            <div class="table-responsive overflow-auto my-scroll" style="max-height: 360px;">
            <table class="table table-hover table-nowrap mb-0" >
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Event</th>
                            <th scope="col">Participator</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Co-ordinator</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="all-events">
                        <?php $c=0 ?>
                         @foreach($events as $e)
                        <?php $c++;
                            $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                            $co=\DB::table('tblcoordinaters')->select('cname')->where('cid',$e['cid'])->first();
                            $rate=\DB::table('tblrates')->where('eid',$e['eid'])->avg('rate');
                        ?>
                        <tr>
                            <td>#{{$c}}</td>
                            <td>
                                <i data-feather="star" class="icon-dual-warning" height="18px"></i>
                                <span>{{round($rate,1)}}</span>
                            </td>
                            <td>{{ucfirst($e['ename'])}} compition</td>
                            <td>{{$p}}</td> <!--total Participator -->
                            <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                            <td>{{date('d/m/Y', strtotime($e['enddate']))}}</td>
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
                                <a href="{{url('view_candidates')}}/{{encrypt($e['eid'])}}" class="btn btn-p-candidates btn-rounded p-1" data-toggle="tooltip" data-placement="top" title="View Candidates">
                                    <i data-feather="users" height="18px" class="text-primary"></i>
                                </a>
                                <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="btn btn-p-about p-1 btn-rounded" data-toggle="tooltip" data-placement="top" title="About">
                                    <i data-feather="info" height="18px" class=" text-info"></i>
                                </a>
                            <?php $r = \DB::table('tblparticipant')->select('senrl')->where([['eid', $e['eid']], ['rank', 1]])->count();?>
                            @if($r==1)
                                <a href="{{url('view_result')}}/{{encrypt($e['eid'])}}" class="btn btn-p-result p-1 btn-rounded" data-toggle="tooltip" data-placement="top" title="Show Result">
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

    <div class="card mb-0  new-shadow-sm">
        <div class="card-body py-2 d-flex justify-content-between align-items-center">
            <div class="h4 d-flex align-items-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">My Events</span>
            </div>
            <a href="{{url('/create_event')}}" class="text-success d-none d-sm-block ">
                <div class="d-flex align-items-center badge badge-soft-success badge-pill pr-3 py-2 new-event">
                    <i data-feather="plus-circle" height="18px"></i>
                    <span class="font-size-13">Create Event</span>
                </div>
            </a>
        </div>
    </div>

    <div class="row" id="event-list">
        @foreach($events as $e)
        @if($e['cid']==Session::get('cid'))
        @if($e['edate']>date('Y-m-d'))
        <div class="col-md-6 col-xl-4 col-sm-6">
            <?php $tblapp=DB::table('tblapproval')->where('eid',$e['eid'])->get()->count(); ?>
            @if($tblapp!=0)
        <div class="card new-shadow-sm hover-me-sm mb-3 mt-2" style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom" title="This Event is Currently disabled. You need approval from Administrator to delete it.">
            
            @else
            <div class="card new-shadow-sm hover-me-sm mb-3 mt-2">
            @endif
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center">
                                @if($e['e_type']=='team')
                                <span
                                    class="text-muted badge rounded-pill badge-soft-warning  px-3">{{ucfirst($e['e_type'])}}
                                    @else
                                    <span
                                        class="text-muted badge rounded-pill badge-soft-success  px-3">{{ucfirst($e['e_type'])}}
                                        @endif
                                    </span>
                                    <div>
                                    <a href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" <?php if($tblapp!=0){ ?>class="dropdown-toggle disabled"<?php } else { ?>class="dropdown-toggle" <?php } ?>>

                                            <i id="event-info" data-feather="more-vertical" class="text-dark"
                                                height="20px"></i>

                                        </a>
                                        <div
                                            class="dropdown-menu event-option profile-dropdown-items dropdown-menu-right" style="z-index:10;">
                                            <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="dropdown-item">
                                                <i data-feather="info" class="icon-dual-info icon-xs mr-2"></i>
                                                <span>About Event</span>
                                            </a>
                                            <a href="{{url('update_event')}}/{{encrypt($e['eid'])}}" class="dropdown-item my-1">
                                                <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                                <span>Update Event</span>
                                            </a>
                                            <!-- <a href="{{url('delete_event')}}/{{encrypt($e['eid'])}}" class="dropdown-item"> -->
                                             <a href="#" class="dropdown-item" onclick="deleteEvent({{$e['eid']}})">
                                                <i data-feather="trash-2" class="icon-dual-danger icon-xs mr-2"></i>
                                                <span class="text-danger">Delete Event</span>
                                            </a>

                                        </div>
        
                                    </div>
                            </div>
                            <h4 class="mb-0 mt-3">{{ucfirst($e['ename'])}}</h4>
                            <span class="text-muted1">{{date('d/m/Y', strtotime($e['edate']))}}</span>
                        </div>
                    </div>
                    <div class="bg-light">
                    <a href="{{url('view_candidates')}}/{{encrypt($e['eid'])}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark d-flex align-items-center justify-content-center view-candidate" <?php if($tblapp){ ?>onclick="return false;"<?php }  ?>>
                            <i data-feather="eye" height="18px"></i>
                            <span>View Candidates</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endif
        @endforeach
        
        <div class="col-md-6 col-xl-4 col-sm-6">
            <div class="card new-shadow-sm mt-2 mb-3" style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This Event is Currently disabled. You need approval from Administrator to delete it.">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted badge rounded-pill badge-soft-warning  px-3">Team
                                </span>
                                <div>
                                    <a href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                        aria-expanded="false" class="dropdown-toggle disabled">

                                        <i id="event-info" data-feather="more-vertical" class="text-dark"
                                            height="20px"></i>

                                    </a>
                                    <div class="dropdown-menu event-option profile-dropdown-items dropdown-menu-right ">
                                        <a href="{{url('/event_info')}}" class="dropdown-item">
                                            <i data-feather="info" class="icon-dual-info icon-xs mr-2"></i>
                                            <span>About Event</span>
                                        </a>
                                        <a href="{{url('/event_info')}}" class="dropdown-item my-1">
                                            <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                            <span>Update Event</span>
                                        </a>
                                        <a href="#">
                                            <i data-feather="trash-2" class="icon-dual-danger icon-xs mr-2"></i>
                                            <span class="text-danger">Delete Event</span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <h4 class="mb-0 mt-3">Cricket</h4>
                            <span class="text-muted1">21/12/2019</span>
                        </div>
                    </div>
                    <div class="bg-light">
                        <a href="{{url('/view_candidates')}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark d-flex align-items-center justify-content-center disabled">
                            <i data-feather="eye" height="18px"></i>
                            <span>View Candidates</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->
            
    <?php $c=0 ?>
    @foreach($events as $e)
    @if($e['cid']==Session::get('cid'))
    @if($e['enddate'] < date('Y-m-d'))

    <?php 
        $r=\DB::table('tblparticipant')->select('senrl')->where([['eid',$e['eid']],['rank',1]])->count();
    ?>
    @if($r==1)       
    <?php $c++ ?>                 
    @if($c==1)
    <div class="card mt-2 mb-0 new-shadow-sm">
        <div class="card-body py-2 d-flex justify-content-between align-items-center">
            <div class="h4 d-flex align-items-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">Finished Events</span>
            </div>
            <a href="{{url('/cindex/winner-list')}}" class="text-success d-none d-sm-block ">
                <div class="d-flex align-items-center badge badge-soft-danger badge-pill pr-3 py-2 winner-list">
                    <i data-feather="award" height="18px"></i>
                    <span class="font-size-13">Winners List</span>
                </div>
            </a>
        </div>
    </div> 
    <div class="card new-shadow-sm mt-2">
        <div class="card-body py-2 px-1 px-sm-2">
            <div class="table-responsive overflow-auto my-scroll" style="max-height: 360px;">
                <table class="table table-hover table-nowrap mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Event</th>
                            <th scope="col">Participator</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Co-ordinator</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @endif
                        <?php
                            $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                        ?>
                        <tr>
                            <td>#{{$c}}</td>
                            <td>
                                <i data-feather="star" class="icon-dual-warning" height="18px"></i>
                                <span>{{round($rate,1)}}</span>
                            </td>
                            <td>{{ucfirst($e['ename'])}} compition</td>
                            <td>{{$p}}</td> <!--total Participator -->
                            <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                            <td>{{date('d/m/Y', strtotime($e['enddate']))}}</td>
                            <td>{{ucfirst(Session::get('cname'))}}</td>
                            <td  class="d-flex justify-content-start align-items-center pt-1 mb-0">
                                <a href="{{url('view_candidates')}}/{{encrypt($e['eid'])}}" class="btn btn-p-candidates btn-rounded p-1" data-toggle="tooltip" data-placement="top" title="View Candidates">
                                    <i data-feather="users" height="18px" class="text-primary"></i>
                                </a>
                                <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="btn btn-p-about p-1 btn-rounded" data-toggle="tooltip" data-placement="top" title="About">
                                    <i data-feather="info" height="18px" class=" text-info"></i>
                                </a>
                                <a href="{{url('view_result')}}/{{encrypt($e['eid'])}}" class="btn btn-p-result p-1 btn-rounded" data-toggle="tooltip" data-placement="top" title="Show Result">
                                    <i data-feather="award" height="18px" class=" text-success"></i>
                                </a>
                                
                                
                            </td>
                        </tr>
                        @endif
                        @endif
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <!-- end table-responsive -->
           
        </div> <!-- end card-body-->
    </div>



    <!-- 
 <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed" style="top:20px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
     <div class="toast-body text-white alert mb-1">
         <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
             <i data-feather="x-circle" id="close-btn" height="18px" ></i>
         </a>
        <div class="mt-2 font-weight-bold font-size-14">
            Hello, world! This is new notification.Hello, world!Hello, world! This is new notification.
        </div> 
        
     </div>
 </div> -->




</div><!-- end begining div -->
@endsection




@section('extra-scripts')
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- page js -->
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>

async function deleteEvent(eid){
  
   	var id=eid;
    const { value: formValues } = await Swal.fire({
    title: 'Are you sure you want to delete?',
    text: 'You need to approval from super admin to delete..!',
    icon: 'warning',
    showCancelButton: false,
    html:
    '<input id="swal-input1" class="swal2-input" placeholder="Reason is required..!" required>',
    focusConfirm: false,
    showCloseButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#1ce1ac',
    confirmButtonText: 'Delete',
    
    showLoaderOnConfirm: true,
    preConfirm: function() {
      if (document.getElementById('swal-input1').value) {
         var reason=document.getElementById('swal-input1').value
        $.ajax({
            url: "delete_event",
            method:'GET',    
            dataType:'json',       
            data: {"id":id,"reason":reason},
            success:function(data)
                    {
                        window.location.href = "cindex";
                    }

        })
      } else {
        Swal.showValidationMessage('Reason Required.. :)')   
      }
    
     
   },
})

}
</script>
<script>
    var area = {
          series: [
        <?php
                foreach ($tble as $t)
                 {
                 ?>
                
                {
	            name:'<?php echo $t['ename']; ?>',
                data: [
                    <?php
                    $date_str="";
                    $today_dat=date("d-m-Y");
                    for($i=0;$i<5;$i++)
                        {
                            $date_v=date("Y-m-d", strtotime("-1 day", strtotime($today_dat)));
                            $line=App\participant::where('reg_date',$date_v)->where('eid',$t['eid'])->count();
                            $date_str.=$line.",";
                            $today_dat=$date_v;
                        }
                        echo $date_str;
                	?>
					]
                },
                <?php
                }
                ?>
        ],
          chart: {
          height: 350,
          type: 'bar'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories:[<?php echo $date_string; ?>]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy'
          },
        },
        };

 var pie = {
          series: [<?php echo $part_count; ?>],
          chart: {
          height: 350,
          type: 'donut',
        },
        labels: [<?php echo $ename_string; ?>],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        // var chart1 = new ApexCharts(
        //     document.querySelector("#chart-1"), 
        //     area
            
        // );
        // chart1.render();

        var chart2 = new ApexCharts( 
            document.querySelector("#chart-2"),
            pie
        );
        chart2.render();

</script>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".table-responsive #all-events tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });
    });
</script>
@endsection
