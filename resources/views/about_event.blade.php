@extends('stud_layout')

@section('title','About Event')

@section('my-content')
<div class="d-flex justify-content-center mt-5">
                <div class="container-fluid col-lg-10">
                    <div class="card new-shadow rounded-lg">
                        <div class="card-body px-md-4 px-1">
                            <a href="{{url('/profile')}}" class="float-right text-dark mr-1">
                                <i data-feather="x-circle" height="20px" id="close-btn"></i>
                            </a>
                            <br>
                            <div class="text-center mt-4">
                              <h2 class="font-weight-light">{{ucfirst($list_event_d['ename'])}} Compitition</h2>
                             <span class="font-weight-bold ">{{ucfirst($list_event_d['clgname'])}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">{{ucfirst($list_event_d['cname'])}} </span>(Co-ordinator)
                            </p>
                            </div>
                            <hr>
                            <div class=" d-flex justify-content-center">
                                <div id="event-info" class="col-lg-7 col-md-8 col-sm-10 p-2 text-dark font-size-15 ">
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event date</span>
                                        <span>{{date('d/m/Y', strtotime($list_event_d['edate']))}}</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event Ending date</span>
                                        <span>{{date('d/m/Y', strtotime($list_event_d['enddate']))}}</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold text-right">Event time</span>
                                        <span>{{date('h:i A', strtotime($list_event_d['time']))}}</span>
                                    </p>
                                    
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event Type</span>
                                        <span>{{ucfirst($list_event_d['e_type'])}}</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Gender</span>
                                        <span>{{ucfirst($list_event_d['gallow'])}}</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event Location</span>
                                        <span>{{ucfirst($list_event_d['place'])}}</span>
                                    </p>
                                </div>
                            </div>  
                            @if($list_event_d['e_type']=='team')  
                            <div class="mt-3">
                                <div class="table-responsive overflow-auto my-scroll">
                                    <table class="table table-hover table-light new-shadow-sm rounded-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <td colspan="6" class="rounded-sm  font-weight-bold text-dark p-3"
                                                    style="background-color: #dde1fc;">
                                                    <span>Team</span>
                                                    <span class="mt-1 badge badge-primary px-3 badge-pill">
                                                         {{ucfirst($list_event_d['tname'])}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Enrollment no</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Class</th>
                                                <th scope="col">Division</th>
                                                <th scope="col">Roll No</th>
                                            </tr>
                                        </thead>
                                        <tbody class="team-leader">
                                            <?php
                                                $stud_data=explode('-',$list_event_d['senrl']);
                                                $c=1;
                                            ?>
                                            @foreach($stud_data as $s)
                                            @if($s)
                                            <?php
                                            
                                            $stud=App\tblstudent::where('senrl',$s)->get()->first();
                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    {{$c}}
                                                </th>
                                                <td>{{$stud['senrl']}}</td>
                                                <th>{{ucfirst($stud['sname'])}}</th>
                                                <td>{{ucfirst($stud['class'])}}</td>
                                                <td>{{$stud['division']}}</td>
                                                <td>{{$stud['rno']}}</td>
                                            </tr>
                                            <?php
                                            $c++;
                                            ?>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                               
                        </div>
                        
                    </div>
                   
                    <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left" title="Print">
                        <a href="#" >
                            <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" class="hover-me-sm rounded-circle" height="55px" alt="">
                        </a>
                    </div>
                </div>
            </div>
@endsection



