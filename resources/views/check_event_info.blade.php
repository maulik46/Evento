
@extends('stud_layout')
@section('title','Event Information')
@section('head-tag-links')
<style>
    .printer{
        visibility:hidden;
    }
    #event-info p{
        margin-left:10px;
        margin-right:10px;
    }
</style>
@endsection
@section('my-content')            
            <div class="my-4 d-flex justify-content-center">
                <div class="px-0 container col-xl-6 col-lg-7 col-md-8 col-sm-10">
                  <div class="card new-shadow-2 rounded">
                        <a href="javascript:window.history.go(-1);" class="text-right text-dark p-2">
                            <i data-feather="x-circle" id="close-btn" height="20px"></i>
                        </a>
                        <div class="card-body px-2">
                            <div class="text-center text-dark">
                              <h2 class="font-weight-light"> {{ucfirst($einfo['ename'])}}</h2>
                             <span class="font-weight-bold">{{ucfirst(Session::get('clgname'))}}</span>
                             <p class="my-2">
                                 <span class="font-weight-bold">{{ucfirst($einfo['cname'])}}</span>(Co-ordinator)
                            </p>
                            </div>
                            <hr>
                            <div id="event-info" class="p-1  text-dark font-size-15">
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event Starting date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['edate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event Ending date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['enddate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold text-right">Event time</span>
                                    <span>{{date('h:i A',strtotime($einfo['time']))}}</span>
                                </p>
                                 <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Registraion start date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_start_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Registraion last date</span>
                                    <span>{{date('d/m/Y',strtotime($einfo['reg_end_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event Type</span>
                                    <span>{{ucfirst($einfo['e_type'])}}</span>
                                </p>
                                @if($einfo['e_type']=="team")
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Team Size</span>
                                    <span>{{$einfo['tsize']}}</span>
                                </p>
                                @endif
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event Catagory</span>
                                    <span>{{ucfirst($einfo['category_name'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event For</span>
                                    <span>{{ucfirst($einfo['gallow'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Allowed class</span>
                                    <?php 
                                    $class=explode('-',$einfo['efor']);
                                    $alw="";
                                        foreach($class as $cl)
                                        {
                                            if ($cl) {
                                                    $alw.=$cl.",";
                                            }
                                        }
                                    ?>
                                    <span>{{$alw}}</span>
                                </p>
                                <p class="d-flex justify-content-between">
                                    <span class="font-weight-bold">Event Location</span>
                                    <span>{{ucfirst($einfo['place'])}}</span>
                                </p>
                            </div>
                        
                        </div>
                        
                    </div>
                    
                </div>

                <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left" title="Print">
                    <a onclick="window.print()" >
                        <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" class="hover-me-sm rounded-circle" height="55px" alt="">
                    </a>
                </div>
            </div>
@endsection
