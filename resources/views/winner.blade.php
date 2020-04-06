@extends('stud_layout')

@section('title','Winner List')
@section('head-tag-links')
<style>
    .table td,
    .table th {
        padding: .50rem !important;
        vertical-align: middle !important;
        color:#000!important;
    }
    .form-control:focus {
        background-color: #fff !important;
        border: 1px solid lightgray !important;
        }
</style>
@endsection
@section('my-content')
<div class="container-fluid my-5">
    <div class="card new-shadow-sm">
        <div class="card-body px-1 px-sm-3">
            <div class="navbar px-2">
                <div class="mt-2 h4">
                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/ranking.svg')}}" height="33px" alt="">
                    <span>Past Winners</span>
                </div>
                <a href="#" class=" badge-pill badge-soft-dark btn-sm pr-3 pl-2 font-weight-bold new-shadow-sm btn-filter hover-me-sm">
                    <i data-feather="sliders" height="18px"></i>
                    Filters
                </a>
                <a href="#" class="text-dark" id="close-btn" style="display:none">
                    <i data-feather="x-circle" height="20px"></i>
                </a>
            </div>
            <hr class="my-0">
            <div id="filter-box" class="card position-relative w-100 mb-0" style="left:0px;display:none;border:1px solid #e9e9e9;">
                <div class="card-body px-1 px-sm-2">
                <div class="row justify-content-between">
                <div class="col-md-5 col-12">
                    <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                        <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" name="sname" onkeyup="filter()" id="sname" class="form-control" placeholder="Enter Student Name" />
                    </div>
                </div>
                <div class="col-md-5 col-12">
                    <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                        <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" name="ename" onkeyup="filter()" id="ename" class="form-control" placeholder="Enter Event Name" />
                    </div>
                </div>
                <div class="col-md-2 col-12">
                        <select name="year" id="year" onchange="filter()" class="form-control">
                        <?php $year=date('Y')?>
                            <option hidden value="">Select Year</option>
                            @for($i=2019;$i<=$year;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                </div>
                </div>
                <div class="row justify-content-between justify-content-sm-around">
                    <div class="col col-md-5">
                        <h6>Class</h6>
                        <div class="row justify-content-start justify-content-lg-around mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                        <?php $c=0?>
                        @foreach($ddclass as $class)
                        <?php $c++?>
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="clas[]" onclick="filter()" value="{{$class->class}}" class="custom-control-input" id="clas{{$c}}">
                            <label class="custom-control-label" for="clas{{$c}}">{{ucfirst($class->class)}}</label>
                        </div>
                        
                        @endforeach
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <h6>Division</h6>
                        <div class="row justify-content-start justify-content-sm-around mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="div[]" onclick="filter()" value="1" class="custom-control-input" id="div1">
                            <label class="custom-control-label" for="div1">1</label>
                        </div>
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="div[]" onclick="filter()" value="2" class="custom-control-input" id="div2">
                            <label class="custom-control-label" for="div2">2</label>
                        </div>
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="div[]" onclick="filter()" value="3" class="custom-control-input" id="div3">
                            <label class="custom-control-label" for="div3">3</label>
                        </div>
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="div[]" onclick="filter()" value="4" class="custom-control-input" id="div4">
                            <label class="custom-control-label" for="div4">4</label>
                        </div>
                        </div>
                    </div>
                    <div class="col col-md-3">
                        <h6>Event type</h6>
                        <div class="row justify-content-start justify-content-sm-around mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="cat[]" onclick="filter()" value="team" class="custom-control-input" id="cat1">
                            <label class="custom-control-label" for="cat1">Team</label>
                        </div>
                        <div class="custom-control custom-checkbox m-1">
                            <input type="checkbox" name="cat[]" onclick="filter()"p value="solo" class="custom-control-input" id="cat2">
                            <label class="custom-control-label" for="cat2">Solo</label>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div>
            
            </div>
            <div id="filter-table" class="card-body text-muted mt-1 py-0 px-1">
                <div class="table-responsive overflow-auto my-scroll">
                    <table class="table table-hover table-light new-shadow" id="tbody">
                       
                    </table>
                </div>
            </div>
        <div class="row mt-2">
        @foreach($winners as $winner)
            <?php 
                $event=App\tblevent::select('eid','ename','e_type','enddate')->where('eid',$winner->eid)->first();
            ?>
            <div class="col-lg-6 col-md-12 my-2">
            <div class="card mb-0 rounded-0  new-shadow-sm">
                <div class="row  align-items-center justify-content-between mx-0" style="background-color:#dde1fc;">
                    <div class="p-2"  >
                        <span class="h5">{{ucfirst($event->ename)}}</span>
                        @if($event->e_type=="solo")
                        <span class="badge badge-pill badge-info px-3">{{ucfirst($event->e_type)}}</span>
                        @else
                        <span class="badge badge-pill badge-warning px-3">{{ucfirst($event->e_type)}}</span>
                        @endif
                    </div>
                    <div class="mr-2">
                        <span class="badge badge-primary">{{date('d/m/Y',strtotime($event->enddate))}}</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-light text-dark">
                        <thead class="thead-light">
                            <tr>
                            @if($event->e_type=="solo")
                                <th scope="col">Rank</th>
                                <th scope="col">Name</th>
                                <th scope="col">Class</th>
                                <th scope="col">Division</th>
                            @else
                                <th scope="col">Rank</th>
                                <th scope="col">Team Name</th>
                                <th scope="col" class="text-center">View Team</th>
                            @endif
                            </tr>
                        </thead>
                        <tbody>
                        <?php $rank=App\participant::where([['eid',$event->eid],['rank','!=','p']])->orderby('rank','asc')->get(); ?>
                        @foreach($rank as $r)
                        @if($event->e_type=="solo")
                        <?php $sinfo=App\tblstudent::select('sname','class','division')->where('senrl',$r['senrl'])->first();?>
                            <tr>
                                <th scope="row">
                                @if($r['rank']==1) 
                                    <img src="assets/images/svg-icons/student-dash/winner/1.svg" height="22px" alt="1">
                                @elseif($r['rank']==2)
                                    <img src="assets/images/svg-icons/student-dash/winner/2.svg" height="22px" alt="2">
                                @else
                                    <img src="assets/images/svg-icons/student-dash/winner/3.svg" height="22px" alt="3">
                                @endif
                                </th>
                                <td class="font-weight-bold">{{ucfirst($sinfo['sname'])}}</td>
                                <td>{{ucfirst($sinfo['class'])}}</td>
                                <td>{{$sinfo['division']}}</td>
                            </tr>
                        @else
                            <tr>
                                <th scope="row">
                                @if($r['rank']==1)
                                    <img src="assets/images/svg-icons/student-dash/winner/1.svg" height="22px" alt="1">
                                @elseif($r['rank']==2)
                                    <img src="assets/images/svg-icons/student-dash/winner/2.svg" height="22px" alt="2">
                                @else
                                    <img src="assets/images/svg-icons/student-dash/winner/3.svg" height="22px" alt="3">
                                @endif
                                </th>
                                <td class="font-weight-bold">{{$r['tname']}}</td>
                                <td class="text-center">
                                    <a href="{{url('viewteam')}}/{{encrypt($r['pid'])}}" class="badge badge-success badge-pill px-3">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endif
                        @endforeach
                            <!-- <tr>
                                <th scope="row">
                                    <img src="assets/images/svg-icons/student-dash/winner/2.svg" height="22px" alt="2">
                                </th>
                                <td>Dishant Sakariya</td>
                                <td>TYBCA</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <img src="assets/images/svg-icons/student-dash/winner/3.svg" height="22px" alt="3">
                                </th>
                                <td>Yash Parmar</td>
                                <td>TYBCA</td>
                                <td>3</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        @endforeach
         
        </div>
            
        <div class="row mt-4">
            
        </div>
        <!-- end row tag -->
        </div>
    </div>

</div>
@endsection

@section('extra-scripts')
<script>
$(document).ready(function(){
    $('#filter-box,#close-btn').hide();
    $('.btn-filter').click(function(){
        $('#filter-box,#close-btn').show();
        $('.btn-filter').hide();
    });
    $('#close-btn').click(function(){
        $('#filter-box,#close-btn,#filter-table').hide();
        $('.btn-filter').show();
    })
})
</script>
<script>
function filter()
{
    var ename=$('#ename').val();
    var sname=$('#sname').val();
    var clas =new Array();
    var div = new Array();
    var cat = new Array();
    var year=$('#year').val();
    $("input[name='clas[]']").each( function () {
        if($(this).prop('checked') == true){
            clas.push($(this).val());
            }
   });
   $("input[name='div[]']").each( function () {
        if($(this).prop('checked') == true){
            div.push($(this).val());
            }
   });
   $("input[name='cat[]']").each( function () {
        if($(this).prop('checked') == true){
            cat.push($(this).val());
            }
   });
   $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/filter',
            data: {
               clas:clas,
               div:div,
               cat:cat,
               year:year,
               sname:sname,
               ename:ename,
            },
            success: function (data) {
                $('#tbody').html(data.msg);
            },
            error: function (data) {
                console.log(data);
            }
        })
}
</script>
@endsection

