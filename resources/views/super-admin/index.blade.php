<?php

use App\tblevent;
use \App\Http\Controllers\co_ordinate;
co_ordinate::remain_result();
?>
@extends('super-admin/s_admin_layout')

@section('title','Super Admin dashboard')

@section('head-tag-links')
<style>
    .no-chart-img{
        background-image:url('../assets/images/no-chart3.svg');
        background-size:270px 300px;
    }
    .no-chart-img-2{
        background-image:url('../assets/images/no_chart2.svg');
        background-size:230px 300px;
    }
   
    .no-chart-img,
    .no-chart-img-2{
        
        background-repeat:no-repeat;
        background-position: center;
        width:auto;
    }
    #event-info:hover {
        color: #43d39e !important;
        fill: #fff;
    }
    .add-cat:hover{
        background: var(--info);
        color: #fff !important;

    }
    .event-option.show {
        top: 25% !important;
        right: 2% !important;
        width: 150px;
    }
    .new-cod:hover {
        background: var(--info);
        color: #fff !important;
    }
    .winner-list:hover{
        background: var(--danger);
        color: #fff !important;

    }
    .table td, .table th {
        vertical-align: middle;
    }
    /* css for event co-ordinator list in index page */
   
    .cod-card:hover .cod-name {
        color: #35bbca !important;
    }
    .form-control:focus {
        border-color: lightgray !important;
    }
    .notification-list .noti-icon-badge {
        position: relative;
        top: -4px;
        right: 12px;
    }
    .event-cat{
        border:2px solid #f3efef;
    }
    .event-cat:hover{
        background-color:#98edff4a;
        border-color:rgba(37,194,227,.19);
        transition:0.2s ease;
    }
    .btn-p-about:hover {
        background-color: rgba(37, 194, 227, .15);
    }

    .btn-p-result:hover {
        background-color: rgba(67, 211, 158, .15);
    }

    .btn-p-candidates:hover {
        background-color: rgba(83, 105, 248, .15);
    }

    .btn-about-cod:hover {
        background-color: rgba(37, 194, 227, .15);
        color: var(--info);
    }

    .btn-delete-cod:hover {
        background-color: rgba(255, 92, 117, .15);
        color: var(--danger);
    }
    .avatar-xl{
        height: 5rem;
        width: 5rem;
    }
    .cod-list{
        height:365px;
    }
      
    @media(max-width:1200px){
        .cod-list{
            max-height:265px;
        }
    }
    @media(max-width:992px){
        .cod-list{
            max-height:440px;
        }
    }
    @media(max-width:728px){
        .cod-list{
            max-height:390px;
        }
    }
    @media(max-width:568px){
        .my-avatar img{
            height:40px;
        }
    }
</style>
@endsection
@section('my-content')

<div class="container-fluid">
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

    <!-- stats + charts -->
    <div class="row">
        <div class="col-xl-4">
            <div class="card new-shadow-sm">
                <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>
                <div class="card-body p-0">
                    <!-- stat 1 -->
                    <?php $tot_event = \DB::table('tblevents')->where('clgcode', Session::get('aclgcode'))->count();
                    ?>
                    <div class="media px-3 py-4 border-right border-bottom">
                        <div class="media-body">
                            <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_event}}</h4>
                            <span class="text-muted font-weight-bold">Total Events</span>
                        </div>
                        <i data-feather="calendar" class="align-self-center icon-dual-success icon-lg"></i>
                    </div>
                    <?php $tot_part = 0;?>
                    @foreach($events as $e)
                    <?php $p = \DB::table('tblparticipant')->select('senrl')->where('eid', $e['eid'])->count(); 
                    $tot_part = ($e['tsize'] * $p) + $tot_part;
                    ?>
                    @endforeach
                    <!-- stat 2 -->
                    <div class="media px-3 py-4 border-right border-bottom">
                        <div class="media-body">
                            <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_part}}</h4>
                            <span class="text-muted font-weight-bold">Total Participator</span>
                        </div>
                        <i data-feather="users" class="align-self-center icon-dual-info icon-lg"></i>
                    </div>
                    <?php $tot_co = \DB::table('tblcoordinaters')->where('clgcode', Session::get('aclgcode'))->count(); ?>
                    <!-- stat 3 -->
                    <div class=" media px-3 py-4 ">
                        <div class="media-body">
                            <h4 class="mt-0 mb-1 font-size-22 font-weight-bold">{{$tot_co}}</h4>
                            <span class="text-muted font-weight-bold">Total Co-ordinator</span>
                        </div>
                        <i data-feather="user-check" class="align-self-center icon-dual-primary icon-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-md-12">
            @if($part_count=="")
            <div style="width: 100%;height:348px;background:linear-gradient(to right,#25c2e33b,#39ee9b40);" class="card d-flex align-items-end  justify-content-end  new-shadow-sm">
                <div style="width: 100%;height:348px;" class="no-chart-img-2"></div>
                <!-- this div contain img which visible when chart has no data  -->
                <h5 class="text-center w-100 m-0 p-2" style="font-family:Comic Sans MS!important;background-color:#ffffff80">There is no participation data..!</h5>

            </div>
            @else
            <div class="card new-shadow-sm">
                <div class="card-body pb-0">
                    <h5 class="card-title mb-0 header-title">Participation by class</h5>
                    <div id="chart-1" class="apex-charts"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-xl-7 col-md-12">
            @if($part_count=="")     
            <div style="width: 100%;height:405px;background:linear-gradient(to right,#25c2e338,#e83e8c4f);" class="card d-flex align-items-end  justify-content-end  new-shadow-sm">
                <div style="width: 100%;height:348px;" class="no-chart-img"></div>
                <!-- this div contain img which visible when chart has no data  -->
                <h5 class="text-center w-100 m-0 p-2" style="font-family:Comic Sans MS!important;background-color:#ffffff80">There is no participation data..!</h5>

            </div>
            @else
            <div class="card new-shadow-sm">
                <div class="card-body px-0">
                    <h5 class="card-title mt-0 mb-0 header-title px-4">Revenue </h5>
                    <!-- <div id="sales-by-category-chart" class="apex-charts mb-0 mt-3" dir="ltr"></div> -->
                    
                    <div id="chart-2" class="apex-charts mb-0 mt-3"></div>
                   
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            @endif
        </div>
        <div class="col-xl-5">
        <div class="card mb-0 new-shadow-sm" style="border-bottom:1px solid #d1d1d1;border-radius:.2rem .2rem 0px 0px">
            <h5 class=" text-center mt-2">
            <i data-feather="user-check" height="20px" class="icon-dual-dark"></i>
            Event Co-ordinators
            </h5>
        </div>
        <div class="card new-shadow-sm overflow-auto my-scroll cod-list">
        <div class="card-body py-0">
            <div class="row">
                <?php $count = 0;?>
                @foreach($cods as $c)
                <?php $count++;?>
                <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="card bg-light pt-2 pt-xl-0 my-2 rounded new-shadow-sm hover-me-sm cod-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center justify-content-center text-lg-left text-left text-sm-center flex-wrap ">
                                <div class="col col-lg-4 col-md-12 col-sm-4 col-4">
                                    <img src="{{asset('profile_pic/'.$c->pro_pic)}}" alt=""
                                        class="avatar-xl rounded-circle new-shadow-sm bg-light"
                                        style="border:1px solid #f1f1f1" />
                                </div>
                                <div class="col col-lg-8 col-md-12 col-sm-8 col-8">
                                    <h6 class="mb-0 cod-name">{{ucfirst($c['cname'])}}</h6>
                                    <h6 class="text-muted font-weight-normal mt-1 mb-0">
                                        <i data-feather="mail" height="15px" class="icon-dual-danger"></i>
                                        <span class="font-weight-bold">{{$c['email']}}</span>
                                    </h6>
                                    <h6 class="text-muted font-weight-normal mt-1 mb-0">
                                        <i data-feather="phone" height="15px" class="icon-dual-success"></i>
                                        <span class="font-weight-bold">{{$c['mobile']}}</span>
                                    </h6>
                                    <div class="d-flex align-items-center justify-content-lg-start justify-content-md-center justify-content-sm-center mb-1">
                                        <span class="badge badge-info badge-pill px-3 mt-0 mr-3 new-shadow-sm">{{ucfirst($c['category_name'])}}</span>
                                        <?php $tble = tblevent::where([['cid', $c['cid']],['enddate','>',date('Y-m-d')]])->get()->toArray();
                                        $e = "";
                                        foreach ($tble as $te) {
                                            $e .= $te['ename'] . ",";
                                        }?>
                                        <a href="#" data-toggle="tooltip" title="Delete"
                                            onclick="return confirm('<?php echo $e ?>','<?php echo $c['cid'] ?>')"
                                            class="btn text-danger p-1 btn-rounded mt-0 btn-delete-cod">
                                            <i data-feather="trash-2" height="17px"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
            @if($count == 0)
            <div class="d-flex justify-content-center flex-column " style="height:320px;">
                <div class="no-result-img" style="height:160px;background-size:250px;">
                </div>
                <h6 class="mt-0 text-center darkblue">You have no Co-ordinator in system..! </h6>
                <div class="mt-2 d-flex align-items-center justify-content-center">
                    <a href="{{url('new_cod')}}" class="rounded btn btn-sm btn-success font-weight-bold new-shadow-sm pr-3 pl-2">
                    <i data-feather="user-plus" height="15px"></i>
                    Create New
                    </a>
                </div>
            </div>
            @endif
        </div>
        </div>
        </div>
    </div>
    <div class="card mt-2 mb-0 new-shadow-sm">
        <div class="py-1 navbar">
            <div class="h5 d-flex align-items-center">
                <i data-feather="calendar" class="icon-dual-dark"></i>
                <span class="ml-1">All Event Categories</span>
            </div>
            <a href="{{url('/add_category')}}" class="text-success  ">
                <div class="d-flex align-items-center badge badge-soft-info badge-pill pr-2 pr-sm-3 py-2 add-cat">
                    <i data-feather="plus-circle" height="18px"></i>
                    <span class="font-size-13 d-none d-sm-block">Add Category</span>
                </div>
            </a>
        </div>
    </div>
    <div class="card mt-2 new-shadow-sm">
        <div class="card-body p-2">
            <div class="row mx-0">
            <?php $cat=\DB::table('tblcategory')->select('category_name','category_id')->where([['clgcode',Session::get('aclgcode')],['status','a']])->get();
            ?>
                @foreach($cat as $category)
                <?php $ev=App\tblevent::where([['cate_id',$category->category_id],['enddate','>',date('Y-m-d')]])->get();
                $e = "";
                foreach ($ev as $te) {
                    $e .= ucfirst($te['ename']) . ",";
                }?>
                <div class="my-2 col col-auto px-1">
                    <div class="d-flex align-items-center btn btn-sm badge-pill pl-3 pr-2 py-2 event-cat">
                    <span class="text-dark font-size-14 font-weight-bold">{{$category->category_name}}</span>
                    <a href="{{url('updatecat')}}/{{$category->category_id}}" class="text-warning ml-3"><i data-feather="edit" height="16px"></i></a>
                    <a href="#" onclick="delcat({{$category->category_id}},'{{ $e }}')" class="text-danger"><i data-feather="delete" height="16px"></i></a>
                    </div>
                </div>
              @endforeach 
              
            </div>
        </div>
    </div>                                    
    <div class="row">
        <div class="col-xl-12">
            
            <div class="card mt-2 mb-0 new-shadow-sm">
                <div class="h5 d-flex align-items-center ml-3">
                    <i data-feather="calendar" class="icon-dual-dark"></i>
                    <span class="ml-1">All Events</span>
                </div>
                <div class="py-2 navbar flex-nowrap">
                    
                    <div class="col-xl-3 col-md-6 col-sm-8 col-10 mb-0 form-group has-icon d-flex align-items-center px-0">
                        <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="myInput" class="form-control" placeholder="Search Events" />
                    </div>
                    <a href="{{url('/admin/winner-list')}}" class="text-success">
                        <div class="d-flex align-items-center badge badge-soft-danger badge-pill pr-2 pr-sm-3 py-2 winner-list">
                            <i data-feather="award" height="18px"></i>
                            <span class="font-size-13 d-none d-sm-block">Winners List</span>
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="all-events"><?php $c = 0?>
                                @foreach($events as $e)
                                <?php $c++;
                                $p = \DB::table('tblparticipant')->select('senrl')->where('eid', $e['eid'])->count();
                                $co = \DB::table('tblcoordinaters')->select('cname')->where('cid', $e['cid'])->first();
                                $rate=\DB::table('tblrates')->where('eid',$e['eid'])->avg('rate');
                                ?>
                                <tr>
                                    <td>{{$c}}</td>
                                    <td>
                                        <i data-feather="star" class="icon-dual-warning" height="18px"></i>
                                        <span>{{round($rate,1)}}</span>
                                    </td>
                                    <th>{{ucfirst($e['ename'])}} </th>
                                    <td>{{$p}}</td><!--total Participator -->
                                    <td>{{date('d/m/Y', strtotime($e['edate']))}}</td>
                                    <td>{{date('d/m/Y', strtotime($e['enddate']))}}</td>
                                    <td>{{ucfirst($co->cname)}}</td>
                                    <td>
                                        @if($e['edate'] <= date('Y-m-d') && $e['enddate']>= date('Y-m-d'))
                                            <span class="badge badge-soft-success badge-pill px-3 py-1">Running</span>
                                            @elseif($e['edate'] > date('Y-m-d'))
                                            <span class="badge badge-soft-warning badge-pill px-3 py-1">Upcoming</span>
                                            @elseif($e['edate'] < date('Y-m-d')) <span
                                                class="badge badge-soft-info badge-pill px-3 py-1">Finished</span>
                                                @endif
                                    </td>
                                    <td>
                                        <a href="{{url('sview_candidates')}}/{{encrypt($e['eid'])}}"
                                            class="btn btn-p-candidates btn-rounded p-1" 
                                            data-toggle="tooltip" data-placement="top" title="View Candidates">
                                            <i data-feather="users" height="18px" class="text-primary"></i>
                                        </a>
                                        <a href="{{url('sevent_info')}}/{{encrypt($e['eid'])}}"
                                            class="btn p-1 btn-rounded btn-p-about" data-toggle="tooltip"
                                            data-placement="top" title="About">
                                            <i data-feather="info" height="18px" class=" text-info"></i>
                                        </a>
                                        <?php $r = \DB::table('tblparticipant')->select('senrl')->where([['eid', $e['eid']], ['rank', 1]])->count();?>
                                        @if($r==1)
                                        <a href="{{url('sview_result')}}/{{encrypt($e['eid'])}}"
                                            class="btn btn-p-result p-1 btn-rounded" data-toggle="tooltip"
                                            data-placement="top" title="Show Result">
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
    <div class="toast bg-white fade show border-0 new-shadow-2 rounded-lg position-fixed w-75"
        style="bottom:20px;left:10px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true"
        data-toggle="toast">
        <?php $delay_res = \DB::table('tblresult_delay')->join('tblevents', 'tblevents.eid', 'tblresult_delay.eid')->join('tblcoordinaters', 'tblcoordinaters.cid', 'tblresult_delay.cid')->join('tblparticipant', 'tblparticipant.eid', 'tblevents.eid')->where('tblcoordinaters.clgcode', Session::get('aclgcode'))->get()->toarray();?>
        @if($delay_res)
        <div class="toast-body text-dark alert mb-1">
            <h5 class="text-center mt-0">Delay Result List</h5>

            @foreach($delay_res as $del_res)
            <div class="card bg-soft-danger p-2 new-shadow hover-me-sm mb-2">
                <div class="navbar p-0">
                    <span class="h5 my-1">{{ucfirst($del_res->ename)}}</span>
                    <span class="badge badge-primary">12/12/2020</span>
                </div>
                <div class="navbar p-0">
                    <span class="badge badge-primary">By {{ucfirst($del_res->cname)}}</span>
                    <a href="{{url('delay_res')}}/{{encrypt($del_res->eid)}}"
                        class="badge badge-success badge-pill px-2 pl-3">
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
@section('extra-scripts')
<script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
function delcat(cid,ename)
{
    var cid = cid;
        var ename_string = "";
        var ename_array = ename.split(',');
        for (var i = 0; i < ename_array.length; i++) {
            if (ename_array[i]) {

                ename_string += "<span class='m-1 badge badge-soft-primary px-3 font-size-13'>" + ename_array[i] +"</span>";
            }
        }
        if (ename.length > 0) {
            Swal.fire({
                title: "<h4 class='my-0'>You Can't delete this Event category!</h4>",
                html: "<h6 class='text-danger'>Following events are running or upcoming</h6>" +
                    "<div class='d-flex align-items-center flex-wrap'>" + ename_string + "</div></br>",
                icon: 'warning'
            })
            return false;
        } else {
            Swal.fire({
                title: "<h5>Are you sure want to delete this Event category !</h5>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes,Delete it",
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    window.location.href = '<?php echo url('/delcat').'/'?>' + cid;
                }
            })
            return false;
        }

}
</script>
<script>
var area = {
          series: [
        <?php
                foreach ($div as $t)
                 {
                 ?>
                
                {
	            name:'<?php echo "Div :".$t['division']; ?>',
                data: [
                    <?php
                    $data_str="";
                    foreach($class as $c)
                        {
                        
                            $stud=App\tblstudent::join('tblparticipant', function($join) {
                                $join->on('tblparticipant.senrl','LIKE',\DB::raw("CONCAT('%',tblstudent.senrl,'%')"));
                            })
                            ->join('tblevents','tblevents.eid','=','tblparticipant.eid')
                            ->where([['tblevents.enddate','>=',date('Y-m-d')]])
                            ->where('tblstudent.class',$c)
                            ->where('tblstudent.division',$t['division'])->get()->count();
                            $data_str.="'".$stud."'".",";
                        }
                        echo $data_str;
                	?>
                    
					]
                },
                <?php
                }
                ?>
        ],
          chart: {
          height: 313,
          type: 'bar'
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '10%'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth',
          width: 6,
          colors: ['transparent']
        },
        xaxis: {
          categories:[<?php
          $class_string="";
            foreach($class as $c)
            {               
                $class_string.="'".strtoupper($c['class'])."'".",";
            }
            echo $class_string;
            ?>]
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
          breakpoint: 576,
          options: {
            chart: {
              width: 260
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
<script>
    function confirm(ename, cid) {
        var cid = cid;
        var ename_string = "";
        var ename_array = ename.split(',');
        for (var i = 0; i < ename_array.length; i++) {
            if (ename_array[i]) {

                ename_string += "<span class='m-1 badge badge-soft-primary px-3 font-size-13'>" + ename_array[i] +"</span>";
            }
        }
        if (ename.length > 0) {
            Swal.fire({
                title: "<h4 class='my-0'>You Can't delete this co-ordinater!</h4>",
                html: "<h6 class='text-danger'>Following events are running or upcoming</h6>" +
                    "<div class='d-flex align-items-center flex-wrap'>" + ename_string + "</div></br>",
                icon: 'warning'
            })
            return false;
        } else {
            Swal.fire({
                title: "<h5>Are you sure want to delete this co-ordinator !</h5>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Yes,Delete it",
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.value) {
                    window.location.href = '<?php echo url('/confirm_del_cod').'/'?>' + cid;
                }
            })
            return false;
        }


    }
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
