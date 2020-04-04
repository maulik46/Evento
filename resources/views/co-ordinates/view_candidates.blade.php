<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('co-ordinates/cod_layout')

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
     table{
         border-bottom:1px solid #edeaea;
     }
    </style>
@endsection

@section('my-content')
            <div class="container-fluid">
            <div class="mb-0 pt-2 card new-shadow-sm">
                <a href="{{url('cindex')}}" class="text-right text-dark px-2">
                    <i data-feather="x-circle" id="close-btn" height="20px"></i>
                </a>
                <h2 class="font-weight-normal text-dark text-center">{{ucfirst($einfo['ename'])}}</h2>
                <h6 class="font-weight-bold text-dark text-center mt-1">{{ucfirst(Session::get('cclgname'))}}</h6>
                <p class="text-center my-0">
                    <span class="font-weight-bold text-dark">{{ucfirst(Session::get('cname'))}}</span> (Co-ordinator)
                </p>
                <h6 class="font-weight-normal text-dark text-center">
                    <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                    <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{date('l',strtotime($einfo['edate']))}}</span>
                    <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{ucfirst($einfo['e_type'])}} Event</span>
                </h6>
                <hr class="my-0">
            </div>
                 <div class="card new-shadow-sm">
                    <div class="card-body pt-2 pb-4 px-1 px-sm-3">
                        <div class="justify-content-between d-flex align-items-center ">
                            <div class="d-flex align-items-center">
                                <i data-feather="users" class="icon-dual"></i>
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
                        <hr class="my-1">
                        <a href="" class="btn btn-sm pr-3 pl-2 rounded btn-success font-weight-bold mt-1 mb-3 new-shadow-sm hover-me-sm">
                            <i data-feather="printer" height="19px"></i>
                            Print
                        </a>
                        @if($einfo['e_type']=="team")
                        @if($c>0)
                        <?php $count=0;?>
                        @foreach($participate as $p)
                        
                        <?php $count++;?>
                        <div class="table-responsive my-scroll ">
                            <table class="table table-light rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="5" class=" font-weight-bold p-3" style="background-color: #dde1fc;">
                                            Team <span class="badge badge-pill badge-primary px-3">{{$p['tname']}}</span>
                                        </td>
                                    </tr>
                                    <tr class="text-dark">
                                        <th scope="col">Enrollment</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody id="stud-data{{$count}}">
                                   <?php $enrl=explode("-",$p['senrl'])?>
                                   @foreach($enrl as $e)
                                   @if($e)
                                   <?php 
                                   $sinfo=tblstudent::where('senrl',$e)->first();?>
                                    <tr class="text-dark">
                                        <th scope="row">
                                            {{$e}}
                                        </th>
                                        <td>{{ucfirst($sinfo['sname'])}}</td>
                                        <td>{{ucfirst($sinfo['email'])}}</td>
                                        <td>{{ucfirst($sinfo['class'])}}</td>
                                        <td>{{ucfirst($sinfo['division'])}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                   
                                </tbody>
                            </table>

                        </div>
                        
                        @endforeach
                        @else
                        <div class="text-center">
                                <!-- <p class="font-size-18 text-center font-weight-bold">Nobody has participated yet!!!</p> -->
                                <img src="{{asset('assets/images/no result.png')}}" class="img-fluid" height="500px" width="500px" alt="No result found.!">
                            </div>
                        @endif
                          

                        @elseif($einfo['e_type']=="solo")
                        @if($c>0)
                        <div class="table-responsive my-scroll ">
                            
                            <table  class="table table-light rounded">
                                <thead class="light-bg1">
                                    <tr class="text-dark">
                                        <th scope="col">Enrollment</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($participate as $p)
                                    @if($p)
                                    <?php 
                                    $sinfo=tblstudent::select('senrl','sname','email','class','division')->where('senrl',$p['senrl'])->first();?>
                                    <tr class="text-dark">
                                        <th scope="row">
                                            {{$sinfo['senrl']}}
                                        </th>
                                        <td>{{ucfirst($sinfo['sname'])}}</td>
                                        <td>{{ucfirst($sinfo['email'])}}</td>
                                        <td>{{ucfirst($sinfo['class'])}}</td>
                                        <td>{{ucfirst($sinfo['division'])}}</td>
                                    </tr>
                                   @endif
                                   @endforeach
                                   
                                </tbody>
                            </table>

                        </div>
                        @else
                            <div class="no-result-img"></div>
                            <h6 class="text-center darkblue mt-1">No student has participated yet..!</h6>
                        @endif
                        @endif
                        
                    </div>

                </div>
            </div>
@endsection 
@section('extra-scripts')
<!-- <script>
$(document).ready(function(){
    <?php $count=0;?>
     <?php foreach($participate as $p) { ?>
         <?php $count++;?>
         $('#stud-data<?=$count;?> tr:last').css("display","none");
     <?php } ?>
})
</script> -->
@endsection       

