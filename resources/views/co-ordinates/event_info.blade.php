@extends('co-ordinates/cod_layout')
@section('title','Event Information')
@section('head-tag-links')
<style>
    .printer{
        visibility:hidden;
    }
    .print-btn:hover .printer,
    .card:hover .printer{
        visibility:visible;
    }
    .card:hover .print-btn,
    .print-btn:hover{
        width:55px!important;
        padding:0.5rem 0.9rem!important;
        transition:0.2s ease-out;
    }
</style>
@endsection
@section('my-content')
            <div class="d-flex justify-content-center">
                <div class="container-fluid col-lg-6 col-md-9 col-sm-10">
                  <div class="card new-shadow-2 rounded">
                        <a href="{{url('cindex')}}" class="text-right text-dark p-2">
                            <i data-feather="x-circle" id="close-btn" height="20px"></i>
                        </a>
                        <div class="position-absolute print-btn bg-success new-shaow-sm" style="padding:0.5rem 0.3rem;top: 15%;left:100%;width:0px;border-radius:0px 5px 5px 0px;" data-toggle="tooltip" data-placement="left" title="Print">
                            <a href="#" class="printer">
                                <i data-feather="printer" class="text-white"></i>
                            </a>
                        </div>
                        <div class="card-body px-2">
                            <div class="text-center">
                              <h2 class="font-weight-light"> {{ucfirst($einfo['ename'])}}</h2>
                             <span>{{ucfirst(Session::get('clgname'))}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">{{ucfirst(Session::get('cname'))}}</span>(Co-ordinator)
                            </p>
                            </div>
                            <hr>
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Starting date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Ending date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['enddate']))}}</span>
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
                                    <span>{{ucfirst($einfo['category_name'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event For</span>
                                    <span>{{ucfirst($einfo['gallow'])}}</span>
                                </p>
                                
                                <p class="d-flex justify-content-between mx-5">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>{{ucfirst($einfo['place'])}}</span>
                                </p>
                            </div>
                        
                        </div>
                        
                    </div>
                    
                </div>
            </div>
@endsection


