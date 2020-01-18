@extends('stud_layout')

@section('title','About Event')

@section('my-content')
<div class="d-flex justify-content-center mt-5">
                <div class="container-fluid col-lg-10">
                    <div class="card new-shadow rounded-lg">
                        <div class="card-body px-md-4 px-1">
                            <a href="{{url('/profile')}}" class="float-right text-dark mr-1">
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <br>
                            <div class="text-center mt-4">
                              <h2 class="font-weight-light">Cricket Compitition</h2>
                             <span>Sutex Bank College of Computer Applications & Science</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">Dr.Akki Maniya </span>(Co-ordinate)
                            </p>
                            </div>
                            <hr>
                            <div class=" d-flex justify-content-center">
                                <div id="event-info" class="col-lg-7 col-md-8 col-sm-10 p-2 text-dark font-size-15 ">
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event date</span>
                                        <span>12/12/2019</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold text-right">Event time</span>
                                        <span>09:30 am</span>
                                    </p>
                                    
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event Type</span>
                                        <span>Team</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Gender</span>
                                        <span>Male</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Team Size</span>
                                        <span>12</span>
                                    </p>
                                    <p class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Event Location</span>
                                        <span>J.k Ground</span>
                                    </p>
                                </div>
                            </div>    
                            <div class="mt-3">
                                <div class="table-responsive overfloaw-auto my-scroll">
                                    <table class="table table-hover table-light new-shadow-sm rounded-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                                    style="background-color: #dde1fc;">
                                                    <div class="font-size-18">
                                                        Your Team Members
                                                    </div>
                                                    <div class="font-size-13 mt-1 badge badge-light px-3 rounded-pill">
                                                        Team XYZ
                                                    </div>
                                                </td>
                                            </tr>
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
                            
                                <p class="mx-5 text-muted font-size-13">
                                    <br>
                                    <span>
                                        **All the team members have to reach at the J.K ground on 09:00 clock without being late
                                    </span>
                                </p>
                        </div>
                        
                    </div>
                    <!-- <button class="btn btn-success new-shadow rounded-sm font-weight-bold font-size-15 px-4">
                        <span>Print Details </span>
                        <i data-feather="printer" height="20px"></i>
                    </button> -->
                    <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left" title="Print">
                        <a href="#" >
                            <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" class="hover-me-sm rounded-circle" height="55px" alt="">
                        </a>
                    </div>
                </div>
            </div>
@endsection

