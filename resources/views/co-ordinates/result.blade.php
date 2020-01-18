<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('co-ordinates/cod_layout')

@section('title','Result Announcement')

@section('my-content')
<div class="container-fluid">
                 <div class="card mt-5 new-shadow-sm">
                    <div class="card-body">
                        <a href="{{url('cindex')}}" class="float-right text-dark">
                            <i data-feather="x-circle" id="close-btn"></i>
                        </a>    
                        <div class="mb-3 mt-4 justify-content-between d-flex align-items-center ">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('/assets/images/svg-icons/co-ordinate/team.svg')}}" height="35px" alt="">
                                <span class="h4 ml-2">Participated Candidates</span>
                            </div>
                            <div class="font-weight-bold mr-4 font-size-15">
                            <?php $c=participant::where('eid',$eresult['eid'])->count()?>
                            @if($eresult['e_type']=="team")
                                <span class="">Total Team:</span>
                            @else
                                <span class="">Total Candidates:</span>
                            @endif
                                <span class="text-dark font-size-18 ml-1">{{$c}}</span class="text-muted">
                            </div>

                        </div>
                        @if($eresult['e_type']=="team")
                        @foreach($participate as $p)
                        <div class="table-responsive my-scroll">
                            <table id=""  class="table table-hover table-light rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                            style="background-color: #dde1fc;">
                                            {{ucfirst($p['tname'])}}
                                            <br>
                                            <!-- <span class="font-size-14">Date: 03/11/2019</span> -->
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
                                   <?php $enrl=explode("-",$p['senrl'])?>
                                   @foreach($enrl as $e)
                                   <?php 
                                   $sinfo=tblstudent::where('senrl',$e)->first();?>
                                    <tr>
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
                        @elseif($eresult['e_type']=="solo")
                        <div class="table-responsive my-scroll">
                            <table   class="table table-hover table-light rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                            style="background-color: #dde1fc;">
                                            {{$eresult['ename']}}
                                            <br>
                                            <span class="font-size-14">Date: {{date('d/m/Y', strtotime($eresult['edate']))}}</span>
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
                        @endif
                    </div>

                </div>
                <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left"
                    title="Print">
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" class="hover-me-sm rounded-circle" alt="">
                    </a>
                </div>
            </div>
@endsection
