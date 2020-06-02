<?php
    use \App\Http\Controllers\co_ordinate;
    date_default_timezone_set("Asia/Kolkata"); 
?>
@extends('super-admin/s_admin_layout')

@section('title','View Result')

@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
        <a href="{{url('sindex')}}" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <div class="text-center">
            <h2 class="font-weight-light"> {{ucfirst($einfo['ename'])}}</h2>
            <span class="font-weight-bold text-dark">{{ucfirst(Session::get('cclgname'))}}</span>
            <p class="my-2">
                <span class="font-weight-bold text-dark">{{ucfirst($einfo['cname'])}}</span> (Co-ordinator)
            </p>
        </div>
        <h6 class="font-weight-normal text-dark text-center">
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
            <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{date('l',strtotime($einfo['edate']))}}</span>
            <span class="ml-1 font-weight-bold  badge badge-soft-dark px-3 badge-pill">{{ucfirst($einfo['e_type'])}} Event</span>
        </h6>
        
        <hr class=" my-1">
        
    </div>
    <div class="mt-0">
        <div class="card mb-0 rounded-sm">
            <div class="card-body py-2 px-1 px-sm-3  d-flex justify-content-between align-items-center">
                <div class="h5 d-flex align-items-center">
                    <i data-feather="award" class="icon-dual-success"></i>
                    <span class="ml-1">Top 3 Winner Candidate</span>
                </div>
                @if(strtotime("+1 day",strtotime($einfo['enddate'])) >= strtotime(date('Y-m-d')))
                <a href="{{url('delay_res')}}/{{encrypt($einfo['eid'])}}" class="text-success">
                    <div class="add-cod d-flex align-items-center badge badge-soft-warning badge-pill pr-sm-3 py-2 mr-3">
                        <i data-feather="plus-circle" height="18px"></i>
                        <span class="font-size-13 d-none d-sm-flex">Update Result</span>
                    </div>
                </a>
                @endif
            </div>
            
            <hr class=" my-1">
        </div>

        <div class="card new-shadow-sm" style="max-height: 350px;">
            <div class="card-body py-2 px-1 px-sm-3 overflow-auto my-scroll">
                <div class="table-responsive overflow-auto my-scroll">
                    <table class="table table-hover table-nowrap mb-0">
                        <thead style="background-color:#1ce1ac40;color:#000;">
                            <tr>
                                <th scope="col">Rank</th>
                                @if($einfo['e_type']=='solo')
                                <th scope="col">Enrollment</th>
                               
                                <th scope="col">Name</th>
                                <th scope="col">Class</th>
                                <th scope="col">Division</th>
                                @endif
                                @if($einfo['e_type']=='team')
                                <th scope="col">Team Name</th>
                                <th></th>
                                <th></th>
                                <th scope="col" class="text-center">View Team Candidates</th>
                                @endif
                            </tr>
                        </thead>
                        
                        <tbody class="text-dark">
                            <tr>
                                <th scope="row">
                                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}"
                                        height="25px" alt="1">
                                </th>
                                @if($einfo['e_type']=='solo')
                                <?php
                                $r1 = \DB::table('tblparticipant')->select('senrl')->where([['eid', $einfo['eid']], ['rank', 1]])->first();
                                
                                $sinfo = co_ordinate::studinfo($r1->senrl);
                                ?>
                                <td>{{$r1->senrl}}</td>
                                <th>{{ucfirst($sinfo['sname'])}}</th>
                                <td>{{ucfirst($sinfo['class'])}}</td>
                                <td>{{$sinfo['division']}}</td>
                                @endif
                                @if($einfo['e_type']=='team')
                                <?php
                                $t1 = \DB::table('tblparticipant')->select('tname','pid')->where([['eid', $einfo['eid']], ['rank', 1]])->first();

                                ?>
                                <th colspan="3">{{$t1->tname}}</th>
                                <td class="text-center">
                                    <a href="{{url('sview_team')}}/{{encrypt($t1->pid)}}" class="badge badge-pill badge-soft-primary px-3">View Team</a>
                                </td>
                                @endif
                            </tr>
                            <?php
                            $r2 = \DB::table('tblparticipant')->select('senrl')->where([['eid', $einfo['eid']], ['rank', 2]])->first();
                            ?>
                            @if($r2)
                            <tr>
                                <th scope="row">
                                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}"
                                        height="25px" alt="2">
                                </th>
                                
                                @if($einfo['e_type']=='solo')
                                <?php
                                $sinfo = co_ordinate::studinfo($r2->senrl);
                                ?>
                                <td>{{$r2->senrl}}</td>
                                <th>{{ucfirst($sinfo['sname'])}}</th>
                                <td>{{ucfirst($sinfo['class'])}}</td>
                                <td>{{$sinfo['division']}}</td>
                                @endif
                                @if($einfo['e_type']=='team')
                                <?php
                                $t2 = \DB::table('tblparticipant')->select('tname')->where([['eid', $einfo['eid']], ['rank', 2]])->first();

                                ?>
                                <th colspan="3">{{$t2->tname}}</th>
                                <td class="text-center">
                                    <a href="{{url('sview_team')}}/{{encrypt($t1->pid)}}" class="badge badge-pill badge-soft-primary px-3">View Team</a>
                                </td>
                                @endif
                            </tr>
                            @endif
                            <?php
                            $r3 = \DB::table('tblparticipant')->select('senrl')->where([['eid', $einfo['eid']], ['rank', 3]])->first();
                            ?>
                            @if($r3)
                            <tr>
                                <th scope="row">
                                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}"
                                        height="25px" alt="2">
                                </th>
                                
                                @if($einfo['e_type']=='solo')
                                <?php
                                $sinfo = co_ordinate::studinfo($r3->senrl);
                                ?>
                                <td>{{$r3->senrl}}</td>
                                <th>{{ucfirst($sinfo['sname'])}}</th>
                                <td>{{ucfirst($sinfo['class'])}}</td>
                                <td>{{$sinfo['division']}}</td>
                                @endif
                                @if($einfo['e_type']=='team')
                                <?php
                                $t3 = \DB::table('tblparticipant')->select('tname')->where([['eid', $einfo['eid']], ['rank', 3]])->first();

                                ?>
                                <th colspan="3">{{$t3->tname}}</th>
                                <td class="text-center">
                                    <a href="{{url('sview_team')}}/{{encrypt($t1->pid)}}" class="badge badge-pill badge-soft-primary px-3">View Team</a>
                                </td>
                                @endif
                            </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @if($participant > 0)
    <div class="card mb-0 rounded-sm">
        <div class="card-body py-2 d-flex justify-content-between align-items-center">
            <div class="h5 d-flex align-items-center">
                <i data-feather="users" class="icon-dual-info"></i>
                <span class="ml-1">Other Candidates</span>
            </div>
            <div class="h6 d-flex align-items-center">
                <span>Total</span>
                <span class="ml-2">{{$participant}}</span>
            </div>
        </div>
        <hr class=" my-1">
    </div>
    <?php
$parti = co_ordinate::participant($einfo['eid']);
?>
    <div class="card new-shadow-sm" style="max-height: 350px;">
        <div class="card-body overflow-auto my-scroll py-2 px-1 px-sm-3">
            <div class="table-responsive overflow-auto my-scroll">
                <table class="table table-hover table-nowrap mb-0">
                    <thead style="background-color:#25c2e340;color:#000;">
                    <tr>
                        <th scope="col">#</th>
                        @if($einfo['e_type']=='solo')
                        <th scope="col">Enrollment</th>
                        
                        <th scope="col">Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Division</th>
                        @endif
                        @if($einfo['e_type']=='team')
                        <th colspan="3" scope="col">Team Name</th>
                        <th scope="col" class="text-center">View Team Candidates</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="text-dark">
                        @if($einfo['e_type']=='solo')
                        <?php $cnt=1;?>
                        @foreach($parti as $participant)
                        <?php $sinfo = co_ordinate::studinfo($participant['senrl']);?>
                        <tr>
                            <th>{{$cnt++}}</th>
                            <td>{{$participant['senrl']}}</td>
                            <th>{{ucfirst($sinfo['sname'])}}</th>
                            <td>{{ucfirst($sinfo['class'])}}</td>
                            <td>{{$sinfo['division']}}</td>

                        </tr>
                        @endforeach
                        @endif
                        @if($einfo['e_type']=='team')
                        <?php $c=1?>
                        @foreach($parti as $participant)
                        <tr>
                            <td>{{$c++}}</td>
                            <th colspan="3">{{$participant['tname']}}</th>
                            <td class="text-center">
                                <a href="{{url('sview_team')}}/{{encrypt($participant['pid'])}}" class="badge badge-pill badge-soft-primary px-3">View Team</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div> <!-- end card-body-->
    </div>
    @endif
</div>
@endsection
