@extends('co-ordinates/cod_layout')

@section('title','Co-ordinator dashboard')

@section('head-tag-links')
<style>
    #event-info:hover {
        color: #43d39e !important;
        fill: #fff;
    }
    canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
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
        .btn-p-about:hover{
            background-color:rgba(37,194,227,.15);
        }
        .btn-p-result:hover{
            background-color:rgba(67,211,158,.15);
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
<!-- charts -->
    <div class="row justify-content-between align-items-center">
        <div class="col-md-7 col-sm-12">
            <div class="card pr-4 new-shadow-sm">
                <div id="chart-1"></div>
            </div>
        </div>
        <div class="col-md-5 col-sm-12">
            <div class="card new-shadow-sm p-1 px-3 overflow-auto my-scroll" style="height:350px;">
            <div class="h4 d-flex align-items-center justify-content-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">My Running Events</span>
            </div>
            <hr class="mt-0 mb-2">
            <?php $c = 0;$a=0;?>
            @foreach($events as $e)
            <?php $c++;
            $p = \DB::table('tblparticipant')->select('senrl')->where('eid', $e['eid'])->count();
            ?>
            @if($e['cid']==Session::get('cid'))
            @if($e['edate']==date('Y-m-d'))
             <?php $a=1;?>
                <div class="card bg-light new-shadow-sm mb-2 my-1 px-2 rounded-0 hover-me-sm">
                    <div class="d-flex justify-content-between align-items-center px-1">
                        <div>
                        @if($e['e_type']=='team')
                            <span class="badge badge-soft-warning px-3 badge-pill">Team</span>
                        @else
                            <span class="badge badge-soft-warning px-3 badge-pill">Solo</span>
                        @endif    
                            <span class="badge badge-soft-dark px-3 badge-pill">
                            {{date('d/m/Y', strtotime($e['edate']))}}
                            </span>
                       
                        </div>
                        <div>
                            <a href="{{url('/create_result')}}" class="btn btn-p-result btn-rounded p-1" style="margin-right:-2px;" data-toggle="tooltip" data-placement="top" title="Announce Result">
                                <i data-feather="award" height="18px" class="text-dark"></i>
                            </a>
                            <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="btn btn-p-about btn-rounded p-1" data-toggle="tooltip" data-placement="top" title="About">
                                <i data-feather="info" height="18px" class="text-dark"></i>
                            </a>
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
                    <div class="p-4 font-weight-bold text-center">
                            No new events available!!
                    </div>
                @endif
            </div>
        </div>    
            
                <!-- <canvas id="canvas"></canvas> -->
                
    </div>

<!-- charts over -->
    <!-- <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card new-shadow-sm">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Today
                                Revenue</span>
                            <h2 class="mb-0">$2189</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-revenue-chart" class="apex-charts">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 ">
            <div class="card new-shadow-sm">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Product
                                Sold</span>
                            <h2 class="mb-0">1065</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-product-sold-chart" class="apex-charts"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card new-shadow-sm">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                Customers</span>
                            <h2 class="mb-0">11</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-new-customer-chart" class="apex-charts"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card new-shadow-sm">
                <div class="card-body p-0">
                    <div class="media p-3">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">New
                                Visitors</span>
                            <h2 class="mb-0">750</h2>
                        </div>
                        <div class="align-self-center">
                            <div id="today-new-visitors-chart" class="apex-charts"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <div class="card mt-2 mb-0 new-shadow-sm">
        <div class="card-body py-2">
            <div class="h4 d-flex align-items-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">All Events</span>
            </div>
        </div>
    </div> 
    <div class="card new-shadow-sm mt-2" style="max-height: 350px;">
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
                    <tbody>
                        <?php $c=0 ?>
                        @foreach($events as $e)
                        <?php $c++;
                            $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                        ?>
                        <tr>
                            <td>#{{$c}}</td>
                            <td>{{ucfirst($e['ename'])}} compition</td>
                             <td>{{$p}}</td> <!--total Participator -->
                            <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                            <td>{{ucfirst($e['cid'])}}</td>
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

        <div class="col-md-6 col-xl-4 col-sm-6">
            <div class="card new-shadow-sm hover-me-sm mb-3 mt-2">
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
                                        <a href="#" data-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                            aria-expanded="false" class="dropdown-toggle">

                                            <i id="event-info" data-feather="more-vertical" class="text-dark"
                                                height="20px"></i>

                                        </a>
                                        <div
                                            class="dropdown-menu event-option profile-dropdown-items dropdown-menu-right ">
                                            <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="dropdown-item">
                                                <i data-feather="info" class="icon-dual-info icon-xs mr-2"></i>
                                                <span>About Event</span>
                                            </a>
                                            <a href="{{url('update_event')}}/{{encrypt($e['eid'])}}" class="dropdown-item my-1">
                                                <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                                <span>Update Event</span>
                                            </a>
                                            <!-- <a href="{{url('delete_event')}}/{{encrypt($e['eid'])}}" class="dropdown-item"> -->
                                             <a href="#" class="dropdown-item" onclick="return deleteEvent()">
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
                        <a href="{{url('view_candidates')}}/{{$e['eid']}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark d-flex align-items-center justify-content-center view-candidate">
                            <i data-feather="eye" height="18px"></i>
                            <span>View Candidates</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
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
   
  
    <div class="card mt-2 mb-0 new-shadow-sm">
        <div class="card-body py-2">
            <div class="h4 d-flex align-items-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">Past Events</span>
            </div>
        </div>
    </div> 
     <div class="card new-shadow-sm mt-2" style="max-height: 350px;">
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $c=0 ?>
                        @foreach($events as $e)
                        <?php $c++;
                            $p=\DB::table('tblparticipant')->select('senrl')->where('eid',$e['eid'])->count();
                        ?>
                        <tr>
                            <td>#{{$c}}</td>
                            <td>{{ucfirst($e['ename'])}} compition</td>
                             <td>{{$p}}</td> <!--total Participator -->
                            <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                            <td>{{ucfirst($e['cid'])}}</td>
                            <td  class="d-flex justify-content-start align-items-center pt-1 mb-0">
                                <a href="{{url('event_info')}}/{{encrypt($e['eid'])}}" class="btn btn-p-about py-1 px-1 btn-rounded mr-1" data-toggle="tooltip" data-placement="top" title="About">
                                    <i data-feather="info" height="20px" class=" text-info"></i>
                                </a>
                                <a href="{{url('view_candidates')}}/{{$e['eid']}}" class="btn btn-p-result py-1 px-1 btn-rounded ml-1" data-toggle="tooltip" data-placement="top" title="Result">
                                    <i data-feather="award" height="20px" class=" text-success"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
            <!-- end table-responsive -->
           
        </div> <!-- end card-body-->
    </div>

    <!-- plus button right side for create events -->
    <div class="position-fixed plus-btn" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left"
        title="Create Event">
        <a href="{{url('/create_event')}}">
            <img src="{{asset('assets/images/svg-icons/co-ordinate/plus.svg')}}" class="hover-me-sm rounded-circle"
                height="55px" alt="">
        </a>

    </div>

    <!-- end plus button div -->

    <!-- 
 <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed" style="top:20px;z-index:9999999;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
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
<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/Chart.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/utils.js')}}"></script> -->
<script>

function deleteEvent(){
    var id = $(this).data('id');

    Swal.fire({
    title: 'Are you sure you want to delete?',
    text: 'You need to approval from super admin to delete..!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#1ce1ac',
    confirmButtonText: 'Delete',
    preConfirm: function() {
     return new Promise(function(resolve) {
     /*
     Ajax code will be here
     */
        $.ajax({
            url: '{{url('delete_event')}}/{{encrypt($e['eid'])}}',
            type: 'POST',           
            data: '{id:eid}'
           
        })
     });
   },
   allowOutsideClick: false 
    })

}
</script>
<script>
var area = {
          series: [{
          name: 'series1',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'series2',
          data: [11, 32, 45, 32, 34, 52, 41]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
        },
        };

 var pie = {
          series: [44, 55, 13, 43, 22],
          chart: {
          width: 480,
          height: 300,
          type: 'donut',
        },
        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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

        var chart1 = new ApexCharts(
            document.querySelector("#chart-1"), 
            area
            
        );
        chart1.render();

        var chart2 = new ApexCharts( 
            document.querySelector("#chart-2"),
            pie
        );
        chart2.render();

</script>
@endsection
