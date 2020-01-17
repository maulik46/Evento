@extends('stud_layout')

@section('title','Home')

@section('my-content')
<div class="d-flex justify-content-center mt-5">
                <div class="container-fluid col-lg-8">
                    <div class="card new-shadow rounded-lg">
                        <div class="card-body px-5">
                            <a href="{{url('/cindex')}}" class="float-right text-dark">
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
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event date</span>
                                    <span>12/12/2019</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold text-right">Event time</span>
                                    <span>09:30 am</span>
                                </p>
                                 <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion start date</span>
                                    <span>1/12/2019</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion last date</span>
                                    <span>8/12/2019</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Type</span>
                                    <span>Team</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Catagory</span>
                                    <span>Male</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Team Size</span>
                                    <span>12</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>J.k Ground</span>
                                </p>
                                <p class="mx-5 text-muted font-size-13">
                                    <br>
                                    <span>
                                        **All the team members have to reach at the J.K ground on 09:00 clock without being late
                                    </span>
                                </p>
                            </div>
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

