<?php
use \App\tblstudent;
?>
@extends('super-admin/s_admin_layout')

@section('title','Event Records')

@section('head-tag-links')
<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
<link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
<style>
    .form-control {
        border-radius: .1rem;
        background-color: #fff !important;
        padding: 5px 10px;
        border: 1px solid #d1d1d1;
        font-size: 1em;
        color: #333;
        height: 35px;
        cursor: text !important;
    }
    .form-control:focus {
        border: 1px solid #d1d1d190 !important;
    }
    .page-item.active .page-link {
        background-color: var(--info);
        border-color: var(--info);
        text-align:left!important;
    }
    .page-link{
        color: var(--info);
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 90px;
        display: inline-block;
    }
    label{
        font-weight:normal!important;
    }
    .flatpickr-weekdays {
        margin: 10px 0px;
    }

    .flatpickr-weekday {
        color: #000 !important;
        margin-top: 5px;
    }
    .flatpickr-calendar{
        z-index: 10!important;
    }
    @media (max-width: 767.98px){
    li.paginate_button.next, li.paginate_button.previous {
        display: inline-block;
        font-size: 13px;
    }
    }
</style>
@endsection
@section('my-content')
    @if(Session::get('msg'))
    
    <div class="bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
                <span class="text-white ">{{ Session::get('msg') }}</span>
            </div>
        </div>
    </div>
    @endif
    <div class="">
    <div class="mx-1 mx-sm-3">
        <div class="card new-shadow-sm">
            <!-- <a href="{{url('/sindex')}}" class="text-right text-dark p-2">
                <i data-feather="x-circle" id="close-btn" height="20px"></i>
            </a> -->
            <div class="pt-2 card-title px-4 mb-1 header-title  align-items-center d-flex justify-content-center">
                <img src="{{asset('assets/images/svg-icons/super-admin/calendar.svg')}}" class="mr-2 mb-1" height="25px" alt="">
                <span class="h4 text-dark">All Events Record</span>
            </div>
            <span class="text-center font-weight-bold text-muted">
                {{ucfirst(Session::get('aclgname'))}}
            </span>
            <hr>
            <div class="card-body px-1 px-md-2 pt-0">
                <div class="text-right mb-2">
                    <a href="#" class="badge-pill badge-soft-primary btn-sm pr-3 pl-2 font-weight-bold new-shadow-sm btn-filter">
                        <i data-feather="filter" height="18px"></i>
                        Filters
                    </a>
                    <a href="#" class="text-dark" id="close-filter" style="display:none">
                        <i data-feather="x-circle" height="20px"></i>
                    </a>
                </div>
                <div id="filter-box" class="mt-2 card position-relative w-100 mb-2" style="left:0px;z-index:9;border:1px solid #e9e9e9;">
                    <div class="card-body p-2">
                    <div class="row justify-content-between mx-0">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" onkeyup="event_filter()" name="ename" id="ename" class="form-control" placeholder="Enter Event Name" />
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                                <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                <select name="cod" onchange="event_filter()" id="cod" class="form-control">
                                <?php $cod=\DB::table('tblcoordinaters')->where('clgcode',Session::get('aclgcode'))->get()?>
                                    <option hidden value="">Select Co-ordinator</option>
                                    @foreach($cod as $c)
                                        <option value="{{$c->cid}}">{{ucfirst($c->cname)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-12 d-flex justify-content-start">
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input name="from" id="from" onchange="event_filter()" type="text" class="form-control basicDate" placeholder="From" />
                            </div>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar"  class="form-control-icon ml-2" height="19px"></i>
                                <input name="to" id="to" onchange="event_filter()" type="text" class="form-control basicDate" placeholder="To" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between justify-content-sm-around mx-0">
                        
                        <div class="col col-md-3 col-6">
                            <h6>Gender</h6>
                            <div class="row flex-column mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" onclick="event_filter()" name="gen[]" value="male" class="custom-control-input" id="male">
                                <label class="custom-control-label" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" onclick="event_filter()" name="gen[]" value="female" class="custom-control-input" id="female">
                                <label class="custom-control-label" for="female">Female</label>
                            </div>
                            </div>
                        </div>
                        <div class="col col-md-3 col-6">
                            <h6>Event Type</h6>
                            <div class="row flex-column mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                            <div class="custom-control custom-checkbox my-1">
                                <input type="checkbox" onclick="event_filter()" name="etype[]" class="custom-control-input" value="team" id="team">
                                <label class="custom-control-label" for="team">Team</label>
                            </div>
                            <div class="custom-control custom-checkbox my-1">
                                <input type="checkbox" onclick="event_filter()" name="etype[]" class="custom-control-input" value="solo" id="solo">
                                <label class="custom-control-label" for="solo">Solo</label>
                            </div>
                            </div>
                        </div>
                        <div class="col col-lg-6 col-md-6 col-12">
                            <h6>Category</h6>
                            <?php $cate=\DB::table('tblcategory')->where('clgcode',Session::get('aclgcode'))->get()?>
                            <div class="row mx-0 p-2 rounded-lg" style="border:1px solid #edebeb;">
                            @foreach($cate as $cat)
                                <div class="col-sm-4 col-6 custom-control custom-checkbox my-1">
                                    <input type="checkbox" onclick="event_filter()" name="cat[]" class="custom-control-input" value="{{$cat->category_id}}" id="{{$cat->category_id}}">
                                    <label class="custom-control-label" for="{{$cat->category_id}}">{{$cat->category_name}}</label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="overflow-auto my-scroll">
                    <table class="table table-hover mb-0 ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Co-ordinator</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <?php $count=0;?>
                            @foreach($event_data as $ed)
                            <?php $count++;?>
                            <tr class="text-dark">
                                <td>{{$count}}</td>
                                <td>{{ucfirst($ed['ename'])}}</td>
                                <td>{{date('d-m-Y',strtotime($ed['edate']))}}</td>
                                <td>{{ucfirst($ed['cname'])}}</td>
                                <td>{{ucfirst($ed['e_type'])}} Event</td>
                                <td>{{ucfirst($ed['category_name'])}}</td>
                                <td class="d-flex">
                                
                                <a href="{{url('sevent_info')}}/{{encrypt($ed['eid'])}}"
                                    class="btn p-1 btn-rounded" data-toggle="tooltip"
                                    data-placement="top" title="About">
                                    <i data-feather="info" height="18px" class=" text-info"></i>
                                </a>
                                <a href="{{url('sview_candidates')}}/{{encrypt($ed['eid'])}}"
                                    class="btn p-1 btn-rounded" data-toggle="tooltip"
                                    data-placement="top" title="Candidates">
                                    <i data-feather="users" height="18px" class=" text-primary"></i>
                                </a>
                                <?php $r = \DB::table('tblparticipant')->select('senrl')->where([['eid', $ed['eid']], ['rank', 1]])->count();?>
                                @if($r==1)
                                <a href="{{url('sview_result')}}/{{encrypt($ed['eid'])}}"
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
    </div>
    </div>
@endsection
@section('extra-scripts')
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('#filter-box,#close-filter').hide();
    $('.btn-filter').click(function(){
        $('#filter-box,#close-filter').show();
        $('.btn-filter').hide();
    });
    $('#close-filter').click(function(){
        $('#filter-box,#close-filter,#filter-table').hide();
        $('.btn-filter').show();
    });
    $(".basicDate").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
    });

    $(".basicDate").focusin(function () {
        $("div").removeClass("animate");
    });
})
function event_filter()
{
    var ename=$('#ename').val();
    var cod=$('#cod').val();
    var from=$('#from').val();
    var to=$('#to').val();
    var gen=new Array();
    var etype=new Array();
    var cat=new Array();
    $("input[name='gen[]']").each( function () {
        if($(this).prop('checked') == true){
            gen.push($(this).val());
            }
   });
   $("input[name='etype[]']").each( function () {
        if($(this).prop('checked') == true){
            etype.push($(this).val());
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
            url: '/event_filter',
            data: {
               cod:cod,
               from:from,
               to:to,
               gen:gen,
               etype:etype,
               cat:cat,
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
