<?php
use \App\tblstudent;
?>
@extends('super-admin/s_admin_layout')

@section('title','Student Records')

@section('head-tag-links')    
<link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> 
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

<div class="mx-1 mx-sm-3">
    <div class="card new-shadow-sm">
        <a href="{{url('/sindex')}}" class="text-right text-dark p-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <div class="card-title px-4 mb-1 header-title  align-items-center d-flex justify-content-center">
            <img  src="{{asset('assets/images/svg-icons/super-admin/all student.svg')}}" class=" mr-2 mb-1" height="25px" alt="">
            <span class="h4 text-dark">All Students Record</span>
        </div>
        <span class="text-center font-weight-bold text-muted">
            {{ucfirst(Session::get('aclgname'))}}
        </span>
        <hr>
        <div class="card-body px-1 px-md-2 pt-0">
            <!-- <div class="col-lg-3 col-md-5 col-sm-6 col-12 form-group has-icon d-flex align-items-center">
                <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                <input id="myInput" type="text" class="form-control " placeholder="Search Student..">
            </div> -->
            <div class="table-responsive overflow-auto my-scroll">
                <table id="my-datatable" class="table table-hover mb-0 ">
                    <thead class="bg-soft-info text-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Enrollment</th>
                            <th scope="col">Roll No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Class</th>
                            <th scope="col">Division</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Rank 1</th>
                            <th scope="col">Rank 2</th>
                            <th scope="col">Rank 3</th>
                            <th scope="col" data-toggle="tooltip" title="Total Participation" data-placement="top">Total</th>
                            <th scope="col" class="text-danger">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 
                        $stud = tblstudent::where('clgcode',Session::get('aclgcode'))->get();
                        ?>
                        <?php $no = 0;?>
                        @foreach($stud as $s)
                        <?php $no++;
                            $r1=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$s['senrl'].'%'],['rank',1]])->count();
                            $r2=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$s['senrl'].'%'],['rank',2]])->count();
                            $r3=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$s['senrl'].'%'],['rank',3]])->count();
                            $tp=\DB::table('tblparticipant')->where('senrl','LIKE','%'.$s['senrl'].'%')->count();
                        ?>
                        <tr class="text-dark">
                            <td>{{$no}}</td>
                            <td>{{$s['senrl']}}</td>
                            <td>{{$s['rno']}}</td>
                            <td class="font-weight-bold">{{ucfirst($s['sname'])}}</td>
                            <td>{{ucfirst($s['class'])}}</td>
                            <td>{{$s['division']}}</td>
                            <td>{{ucfirst($s['gender'])}}</td>
                            <td>{{$r1}}</td>
                            <td>{{$r2}}</td>
                            <td>{{$r3}}</td>
                            <td>{{$tp}}</td>
                            <td>
                                <a href="{{url('single_record')}}/{{encrypt($s['senrl'])}}">
                                    <i data-feather="eye" height="18px"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
            
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Datatables init -->
<!-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> -->
<script>
$(document).ready(function(){
    $("#my-datatable").DataTable({
    "language": {
      "emptyTable": "No data available in table"
    },
    
    // "lengthMenu": [10]
    });
    $('#my-datatable_info').parent().remove();
    $('#my-datatable_paginate .pagination').css({"justify-content":"flex-start","margin":"5px"});
});

</script>
      

@endsection
