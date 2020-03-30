<?php use App\log;?>
@extends('super-admin/s_admin_layout')

@section('title','Student Record Details')

@section('head-tag-links')
<style>
    .event-info:hover{
        color: var(--info)!important;
    }
    
</style>
@endsection
@section('my-content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-md-12">
        <div class="row ">
            <div class="col-lg-12 col-md-6 ">
                <div class="card new-shadow-sm mb-3">
                    <div class="card-body px-3">
                        <h4 class="text-dark font-weight-light text-center my-0">{{ucfirst($stud['sname'])}}</h4>
                        <h6 class="text-dark text-center">{{ucfirst(Session::get('aclgname'))}}</h6>
                        <hr class="my-0">
                        <h6 class="mt-4">Enrollment ID<span class="text-dark font-weight-light ml-2">{{ucfirst($stud['senrl'])}}</span></h6>

                        <h6>Roll No <span class="text-dark font-weight-light" style="margin-left:50px;">{{ucfirst($stud['rno'])}}</span></h6>

                        <h6>Class <span class="text-dark font-weight-light" style="margin-left:65px;">{{ucfirst($stud['class'])}}</span></h6>

                        <h6>Division <span class="text-dark font-weight-light" style="margin-left:45px;">{{ucfirst($stud['division'])}}</span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-6">
                <div class="card new-shadow-sm mb-3">
                    <div class="card-body pt-1 px-3">
                        <h6 class="text-dark font-weight-bold text-center">Student Information</h6>
                        <hr class="my-0">
                        <h6 class="mt-4">D.O.B<span class="text-dark font-weight-light" style="margin-left:58px;">{{date('d/m/Y',strtotime($stud['dob']))}}</span></h6>

                        <h6>Gender<span class="text-dark font-weight-light" style="margin-left:45px;">{{ucfirst($stud['gender'])}}</span></h6>

                        <h6>Contact No <span class="text-dark font-weight-light ml-3">{{ucfirst($stud['mobile'])}}</span></h6>

                        <h6>Email<span class="text-dark font-weight-light" style="margin-left:58px;">{{$stud['email']}}</span></h6>

                        <h6>Address <span class="text-dark font-weight-light" style="margin-left:37px;">{{ucfirst($stud['address'])}}</span></h6>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php 
            $r1=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$stud['senrl'].'%'],['rank',1]])->count();
            $r2=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$stud['senrl'].'%'],['rank',2]])->count();
            $r3=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.$stud['senrl'].'%'],['rank',3]])->count();
        ?>
        <div class="col-lg-7 col-md-12">
            <div class="card new-shadow-sm light-bg2 mb-3 rounded-sm">
                <div class="card-body p-0 py-2">
                <div class="navbar py-1 px-0 px-sm-2">
                    <div class="col-4 text-center">
                        <img src="{{asset('assets/images/svg-icons/super-admin/1.svg')}}" alt="Rank 1" height="40px"><br>
                        <span class="badge badge-light">First Rank</span><br>
                        <span class="h3 text-dark">{{$r1}}</span>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{asset('assets/images/svg-icons/super-admin/2.svg')}}" alt="Rank 2" height="40px"><br>
                        <span class="badge badge-light">Second Rank</span><br>
                        <span class="h3 text-dark">{{$r2}}</span>
                    </div>
                    <div class="col-4 text-center">
                        <img src="{{asset('assets/images/svg-icons/super-admin/3.svg')}}" alt="Rank 3" height="40px"><br>
                        <span class="badge badge-light">Third Rank</span><br>
                        <span class="h3 text-dark">{{$r3}}</span>
                    </div>
                </div>
                </div>
            </div>
            <div class="card new-shadow-sm mb-3">
                <div class="card-body p-2 overflow-auto my-scroll">
                <table class="table text-dark mb-1">
                    <tr class="light-bg1">
                        <th>#</th>
                        <th>Event Category</th>
                        <th class="text-center">Total Participation</th>
                    </tr>
                    <?php $a=0;?>
                    @foreach($c_list as $c)
                    <?php $a++?>
                    <tr>
                        <th>{{$a}}</th>
                        <td>{{$c->category_name}}</td>
                        <td class="text-center">{{$c->total_participation}}</td>
                    </tr>
                    @endforeach
                    <?php
                    
                    $count=\DB::table('tblparticipant')->join('tblevents','tblparticipant.eid','=','tblevents.eid')->join('tblcategory','tblcategory.category_id','=','tblevents.cate_id')->where('senrl','LIKE','%'.$stud['senrl'].'%')->count('senrl');
                    ?>
                    <tr class="bg-light">
                        <th colspan="2">Total</th>
                        <th class="text-center">{{$count}}</th>
                    </tr>
                </table>
                </div>
            </div>

            
            <!-- <div class="card new-shadow-sm mb-3">
                <div class="card-body p-2 overflow-auto my-scroll">
                <table class="table text-dark mb-1">
                    <tr class="bg-light" >
                        <th class="text-danger p-1" colspan="5">1. &nbsp;Sport Events</th>
                    </tr>
                    <tr class="light-bg1">
                        <th>#</th>
                        <th>Competition name</th>
                        <th>Rank</th>
                        <th>Date</th>
                        <th class="text-center">Event Details</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>Rakhi Making </th>
                        <th>1</th>
                        <td>12/12/2019</td>
                        <td class="text-center">
                            <a href="#"><i data-feather="info" class="text-dark event-info" height="18px"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <th>PHP Quiz</th>
                        <th>3</th>
                        <td>12/12/2019</td>
                        <td class="text-center">
                            <a href="#"><i data-feather="info" class="text-dark event-info" height="18px"></i></a>
                        </td>
                    </tr>
                </table>
                </div>
            </div> -->
            <?php $a=0;?>
            @foreach($category as $c)
            <?php $a++;?>
            
            <div class="card new-shadow-sm mb-3">
                <div class="card-body p-2 overflow-auto my-scroll">
                <table class="table text-dark mb-1">
                    <tr class="bg-light" >
                    <th class="text-danger p-1" colspan="5">{{$a}}. &nbsp;{{$c->category_name}} Events</th>
                    </tr>
                    <tr class="light-bg1">
                        <th>#</th>
                        <th>Competition name</th>
                        <th>Rank</th>
                        <th>Date</th>
                        <th class="text-center">Event Details</th>
                    </tr>
                    <tr>
                        <th>{{$a}}</th>
                        <th>{{ucfirst($c->ename)}}</th>
                        <th>{{$c->rank}}</th>
                        <td>{{$c->edate}}</td>
                        <td class="text-center">
                            <a href="#"><i data-feather="info" class="text-dark event-info" height="18px"></i></a>
                        </td>
                    </tr>
                </table>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="position-fixed" style="bottom: 68px;right:17px;" data-toggle="tooltip" data-placement="left" title="Print">
        <a href="#">
            <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" class="hover-me-sm rounded-circle" alt="">
        </a>
    </div>
</div>
@endsection
@section('extra-scripts')

<script>


</script>

@endsection
