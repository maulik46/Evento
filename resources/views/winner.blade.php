@extends('stud_layout')

@section('title','Winner List')
@section('head-tag-links')
<style>
    .table td,
    .table th {
        padding: .50rem !important;
        vertical-align: middle !important;
    }
</style>
@endsection
@section('my-content')
<div class="container-fluid my-5">
    <div class="card">
        <div class="card-body">
            <div class="navbar px-0">
                <div class="mt-2 ml-2 h4">
                    <img src="assets/images/svg-icons/student-dash/winner/ranking.svg" height="30px" alt="">
                    <span>Past Winners</span>
                </div>
                <button class="btn btn-soft-success btn-sm btn-rounded pr-3 pl-2 font-weight-bold new-shadow-sm hover-me-sm">
                <i data-feather="filter" height="18px"></i>
                Filters
                </button>
            </div>
        <div class="row mt-4">
        @foreach($winners as $winner)
            <?php 
                $event=App\tblevent::select('eid','ename','e_type','enddate')->where('eid',$winner->eid)->first();
            ?>
            <div class="card mb-0 my-2 rounded-0 col-lg-6 col-md-12 new-shadow-sm">
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
                        <span class="badge badge-pill badge-primary px-3">{{date('d/m/Y',strtotime($event->enddate))}}</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-light">
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
                                <td>{{$sinfo['sname']}}</td>
                                <td>{{strtoupper($sinfo['class'])}}</td>
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
                                <td>{{$r['tname']}}</td>
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
        @endforeach
         
        </div>
            
        <div class="row mt-4">
            
        </div>
        <!-- end row tag -->
        </div>
    </div>





        <!-- <div class="card col-lg-6 col-md-12 p-3 new-shadow-sm">
            <div class="card mb-0 rounded-0 row flex-row align-items-center justify-content-between mx-0"
                style="background-color:#dde1fc;">
                <div class="p-2">
                    <span class="h5">Cricket Competition</span>
                    <span class="badge badge-pill badge-info px-3">Solo</span>
                </div>

                <div class="mr-2">
                    <span class="badge badge-pill badge-primary px-3">12/02/2020</span>
                </div>
            </div>
            <div class="accordion custom-accordionwitharrow" id="accordionExample">
                <div class="card mb-1 border">
                        <div class="card-header px-2" id="heading1">
                            <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="assets/images/svg-icons/student-dash/winner/1.svg" height="25px" alt="1">
                                <span class="ml-2 h5 my-0">Team A</span>
                            </div>
                            <a href="#" class="text-dark" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            <span class="badge badge-success badge-pill px-3 new-shadow-sm">Show Team</span>
                            </a>
                            </div>
                        </div>
                    <div id="collapse1" class="collapse" aria-labelledby="heading1"
                        data-parent="#accordionExample">
                        <div class="card-body text-muted py-0 px-1">
                            <div class="table-responsive">
                                <table class="table table-hover table-light new-shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                1
                                            </th>
                                            <td>Piyush Monpara</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                2
                                            </th>
                                            <td>Dishant Sakariya</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                3
                                            </th>
                                            <td>Yash Parmar</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-1 shadow-none border">

                    <a href="#" class="text-dark" data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
                        aria-controls="collapse2">
                        <div class="card-header" id="heading2">
                            <h5 class="m-0 font-size-16">
                                Team b
                                <i data-feather="chevron-down" class="float-right accordion-arrow"></i>
                            </h5>
                        </div>
                    </a>
                    <div id="collapse2" class="collapse" aria-labelledby="heading2"
                        data-parent="#accordionExample">
                        <div class="card-body text-muted">
                            <div class="table-responsive">
                                <table class="table table-hover table-light new-shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                1
                                            </th>
                                            <td>Piyush Monpara</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                2
                                            </th>
                                            <td>Dishant Sakariya</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                3
                                            </th>
                                            <td>Yash Parmar</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-1 shadow-none border">

                    <a href="#" class="text-dark" data-toggle="collapse" data-target="#collapse3" aria-expanded="true"
                        aria-controls="collapse3">
                        <div class="card-header" id="heading3">
                            <h5 class="m-0 font-size-16">
                                Team c
                                <i data-feather="chevron-down" class="float-right accordion-arrow"></i>
                            </h5>
                        </div>
                    </a>

                    <div id="collapse3" class="collapse" aria-labelledby="heading3"
                        data-parent="#accordionExample">
                        <div class="card-body text-muted">
                            <div class="table-responsive">
                                <table class="table table-hover table-light new-shadow">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                1
                                            </th>
                                            <td>Piyush Monpara</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                2
                                            </th>
                                            <td>Dishant Sakariya</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                3
                                            </th>
                                            <td>Yash Parmar</td>
                                            <td>TYBCA</td>
                                            <td>3</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</div>
@endsection

