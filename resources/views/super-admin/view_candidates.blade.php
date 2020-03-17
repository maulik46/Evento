<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('super-admin/s_admin_layout')

@section('title','View Candidates')

@section('head-tag-links')
    <style>

     .page-item.active .page-link {
     color: #fff;
     background-color: #43d39e;
     border-color: #43d39e;
     }
     .page-link {
     color: #27b58f;
     background-color: #fff;
     border: 1px solid #e2e7f1;
     }
    </style>
@endsection

@section('my-content')
            <div class="container-fluid">
            <div class="mb-0 pt-2 card new-shadow-sm">
                <a href="{{url('sindex')}}" class="text-right text-dark px-2">
                    <i data-feather="x-circle" id="close-btn" height="20px"></i>
                </a>
                <h2 class="font-weight-normal text-dark text-center">{{ucfirst($einfo['ename'])}}</h2>
                <h6 class="font-weight-normal text-dark text-center">{{ucfirst(Session::get('clgname'))}}</h6>
                <h6 class="font-weight-normal text-dark text-center">
                    <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                    <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{date('l',strtotime($einfo['edate']))}}</span>
                    <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{ucfirst($einfo['e_type'])}} Event</span>
                </h6>
                <hr class="my-0">
            </div>
                 <div class="card new-shadow-sm">
                    <div class="card-body">
                           
                        <div class="justify-content-between d-flex align-items-center ">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" class="icon-dual-success"></i>
                                @if($einfo['e_type']=="team")
                                <span class="h5 ml-2">Participated Teams</span>
                                @else
                               <span class="h5 ml-2">Participated Candidates</span>
                                @endif
                            </div>
                            <div class="font-weight-bold mr-4 h6">
                            <?php $c=participant::where('eid',$einfo['eid'])->count()?>
                            @if($einfo['e_type']=="team")
                                <span class="text-dark">Total Team</span>
                            @else
                                <span class="text-dark">Total Candidates</span>
                            @endif
                                <span class="text-dark h5 ml-1">{{$c}}</span>
                            </div>

                        </div>
                        <hr class="my-1 mb-4">
                        @if($einfo['e_type']=="team")
                        @if($c>0)
                        <?php $count = 0;?>
                        @foreach($participate as $p)
                        <?php $count++;?>
                        <div class="table-responsive my-scroll">
                            <table class="table table-hover table-light rounded">
                                <thead class="thead-light text-dark">
                                    <tr>
                                        <td colspan="4" class=" font-weight-bold text-dark p-3" style="background-color: #dde1fc;">
                                            Team {{$p['tname']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Enrollment</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody id="stud-data{{$count}}">
                                   <?php $enrl=explode("-",$p['senrl'])?>
                                   @foreach($enrl as $e)
                                   <?php 
                                   $sinfo=tblstudent::where('senrl',$e)->first();?>
                                    <tr class="text-dark">
                                        <th scope="row">
                                            {{$e}}
                                        </th>
                                        <td>{{ucfirst($sinfo['sname'])}}</td>
                                        <td>{{ucfirst($sinfo['class'])}}</td>
                                        <td>{{ucfirst($sinfo['division'])}}</td>
                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>

                        </div>
                        @endforeach
                        @else
                        <hr>
                        <p class="font-size-18 text-center font-weight-bold">Nobody has participated yet!!!</p>
                        @endif
                          

                        @elseif($einfo['e_type']=="solo")
                        @if($c>0)
                        <div class="table-responsive my-scroll">
                            <table   class="table table-hover table-light rounded">
                                <thead class="light-bg1 text-dark">
                                    <tr>
                                        <th scope="col">Enrollment</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody class="text-dark">
                                    @foreach($participate as $p)
                                    <?php 
                                    $sinfo=tblstudent::select('senrl','sname','class','division')->where('senrl',$p['senrl'])->first();?>
                                    <tr>
                                        <th scope="row">
                                            {{$sinfo['senrl']}}
                                        </th>
                                        <td>{{ucfirst($sinfo['sname'])}}</td>
                                        <td>{{ucfirst($sinfo['class'])}}</td>
                                        <td>{{ucfirst($sinfo['division'])}}</td>
                                    </tr>
                                   
                                   @endforeach
                                   
                                </tbody>
                            </table>

                        </div>
                        @else
                            <hr>
                            <p class="font-size-18 text-center font-weight-bold">Nobody has participated yet!!!</p>
                        @endif
                        @endif
                        
                    </div>

                </div>
                <div class="position-fixed" style="bottom: 68px;right:17px;" data-toggle="tooltip" data-placement="left"
                    title="Print">
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" class="hover-me-sm rounded-circle" alt="">
                    </a>
                </div>
            </div>
@endsection        

@section('extra-scripts')
<script>
    $(document).ready(function(){
        <?php $count=0;?>
        <?php foreach($participate as $p) { ?>
            <?php $count++;?>
            $('#stud-data<?=$count;?> tr:last').css("display","none");
        <?php } ?>
    })
</script>
@endsection  
