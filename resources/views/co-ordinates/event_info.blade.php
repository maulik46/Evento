@extends('co-ordinates/cod_layout')
@section('title','Event Information')
@section('my-content')
            <div class="d-flex justify-content-center">
                <div class="container-fluid col-lg-7">
                  <div class="card mt-5 new-shadow rounded">
                        <div class="card-body px-5">
                            <a href="{{url('cindex')}}" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn" height="20px"></i>
                            </a>
                            <br>
                            <div class="text-center mt-4">
                              <h2 class="font-weight-light"> {{ucfirst($einfo['ename'])}}</h2>
                             <span>{{ucfirst(Session::get('clgname'))}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">{{ucfirst(Session::get('cname'))}}</span>(Co-ordinate)
                            </p>
                            </div>
                            <hr>
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold text-right">Event time</span>
                                    <span>{{date('h:i A',strtotime($einfo['etime']))}}</span>
                                </p>
                                 <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion start date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_start_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Registraion last date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_end_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Type</span>
                                    <span>{{ucfirst($einfo['e_type'])}}</span>
                                </p>
                                @if($einfo['e_type']=="team")
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Team Size</span>
                                    <span>{{$einfo['tsize']}}</span>
                                </p>
                                @endif
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Catagory</span>
                                    <span>{{ucfirst($einfo['category'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event For</span>
                                    <span>{{ucfirst($einfo['gallow'])}}</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>{{ucfirst($einfo['place'])}}</span>
                                </p>
                                <p class="mx-5 text-muted font-size-13">
                                    <br>
                                    <span>
                                        **All the team members have to reach at the {{ucfirst($einfo['place'])}} on {{date('h:i A',strtotime($einfo['etime']))}}  without being late
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