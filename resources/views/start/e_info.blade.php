@extends('start/start_layout')
@section('title','Event Details')

@section('my-content')
<div class="d-flex justify-content-center">
                <div class="px-0 container col-lg-6 col-md-9 col-sm-10">
                  <div class="card new-shadow-2 rounded">
                        <a href="#" onclick="history.back();" class="text-right text-dark p-2">
                            <i data-feather="x-circle" id="close-btn" height="20px"></i>
                        </a>
                        <div class="card-body pt-0 px-2">
                            <div class="text-center">
                              <h2 class="font-weight-light">Cricket Competition</h2>
                             <span>{{ucfirst(Session::get('clgname'))}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">
                                 Yash Parmar</span>(Co-ordinator)
                            </p>
                            </div>
                            <hr>
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Starting date</span>
                                    <span>12/02/2020</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Ending date</span>
                                    <span>15/02/2020</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold text-right">Event time</span>
                                    <span>10:30 AM</span>
                                </p>
                                 <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion start date</span>
                                    <span>02/02/2020</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion last date</span>
                                    <span>08/02/2020</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Type</span>
                                    <span>Team</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Team Size</span>
                                    <span>12</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Catagory</span>
                                    <span>Sport</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event For</span>
                                    <span>Male</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>J.K Ground</span>
                                </p>
                            </div>
                        
                        </div>
                        
                    </div>
                    
                </div>
            </div>
@endsection