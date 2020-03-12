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
    </style>
@endsection

@section('my-content')
            <div class="container-fluid">
                 <div class="card mt-5 new-shadow-sm">
                    <div class="card-body">
                        <a href="{{url('cindex')}}" class="float-right text-dark">
                            <i data-feather="x-circle" id="close-btn" height="20px"></i>
                        </a>    
                        <div class="mb-3 mt-4 justify-content-between d-flex align-items-center ">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/assets/images/svg-icons/co-ordinate/team.svg')}}" height="35px" alt="">
                                @if($einfo['e_type']=="team")
                                <span class="h4 ml-2">Participated Teams</span>
                                @else
                               <span class="h4 ml-2">Participated Candidates</span>
                                @endif
                            </div>
                            <div class="font-weight-bold mr-4 font-size-15">
                            <?php $c=participant::where('eid',$einfo['eid'])->count()?>
                            @if($einfo['e_type']=="team")
                                <span class="text-muted">Total Team:</span>
                            @else
                                <span class="text-muted">Total Candidates:</span>
                            @endif
                                <span class="text-dark font-size-18 ml-1">{{$c}}</span>
                            </div>

                        </div>
                        @if($einfo['e_type']=="team")
                        @if($c>0)
                        @foreach($participate as $p)
                        <div class="table-responsive my-scroll">
                            <table class="table table-hover table-light rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="4" class=" font-weight-bold text-dark p-3" style="background-color: #dde1fc;">
                                            Team {{$p['tname']}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">EID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody class="team-leader-name">
                                   <?php $enrl=explode("-",$p['senrl'])?>
                                   @foreach($enrl as $e)
                                   <?php 
                                   $sinfo=tblstudent::where('senrl',$e)->first();?>
                                    <tr >
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
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                            style="background-color: #dde1fc;">
                                            {{ucfirst($einfo['ename'])}}
                                            <br>
                                            <span class="font-size-14">Date: {{date('d/m/Y', strtotime($einfo['edate']))}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">EID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody >
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
                <div class="position-fixed" style="bottom: 134px;right:15px;" data-toggle="tooltip" data-placement="left"
                    title="Print">
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" class="hover-me-sm rounded-circle" alt="">
                    </a>
                </div>
            </div>
@endsection        

