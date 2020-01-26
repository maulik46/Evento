@extends('stud_layout')

    @section('title','My Profile')

    @section('head-tag-links')
        <?php use Carbon\Carbon;?>
        <style>
        #event-info:hover{
            color: #43d39e!important;
        }
        </style>
        
    @endsection
 

    @section('my-content')
<div> <!-- start div -->
    <div class="row mt-5">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-3">
                            @if(Session::get('gender')=='male')
                                 <img src="{{asset('assets/images/avatars/man.svg')}}" alt="User Profile" class="avatar-xl" />
                            @else
                                 <img src="{{asset('assets/images/avatars/woman.svg')}}" alt="User Profile" class="avatar-xl" />
                            @endif
                                 <h5 class="mt-2 mb-0">{{ucfirst(Session::get('sname'))}}</h5>
                                 <h6 class="text-muted font-weight-normal mt-2 mb-0">
                                 {{ucfirst(Session::get('clgname'))}}
                                 </h6>
                             </div>

                             <!-- profile  -->

                                <div class="mt-1 pt-2">
                                 <h4 class="font-size-15 text-center">My Information</h4>
                                 <hr class="mt-1 mb-1">
                                 <div class="table-responsive my-scroll overflow-auto">
                                     <table class="table table-borderless mb-0 text-muted">
                                         <tbody>
                                             <tr>
                                                 <th scope="row">Gender</th>
                                                 <td>{{ucfirst(Session::get('gender'))}}</td>
                                             </tr>
                                             <tr>
                                                 <th scope="row">Date of birth</th>
                                                 <td>{{date('d/m/Y', strtotime(Session::get('dob')))}}</td>
                                             </tr>
                                             <tr>
                                                 <th scope="row">Email</th>
                                                 <td>{{Session::get('email')}}</td>
                                             </tr>
                                             <tr>
                                                 <th scope="row">Phone</th>
                                                 <td>{{Session::get('mobile')}}</td>
                                             </tr>
                                             <tr>
                                                 <th scope="row">Address</th>
                                                 <td>{{Session::get('address')}}</td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                        <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-participated-tab" data-toggle="pill"href="#pills-participated" role="tab" aria-controls="pills-participated"aria-selected="true">
                                            Participated Events
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-activity-tab" data-toggle="pill" href="#pills-activity" role="tab" aria-controls="pills-activity" aria-selected="false">
                                            Activity
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <!-- messages -->
                        <div class="tab-pane fade show active overflow-auto my-scroll" id="pills-participated" role="tabpanel" aria-labelledby="pills-participated-tab" style="height: 60vh;">
                    <!-- 1st event -->
                    @foreach($activity as $act)
                    @if($act['edate'] > date('Y-m-d'))
                            <div class="card bg-light rounded mx-2 new-shadow-sm">
                                <div class="card-body pt-3 pb-1">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        @if($act['e_type']=='team')
                                        <span class="badge badge-soft-warning badge-pill px-3 mb-1 font-size-13">Team Event</span>
                                        @else
                                        <span class="badge badge-soft-success badge-pill px-3 mb-1 font-size-13">Solo Event</span>
                                        @endif
                                        <div>
                                        <a href="{{url('about_event')}}/{{encrypt($act['pid'])}}" data-toggle="tooltip" data-placement="bottom" title="About Event">
                                            <i data-feather="info" height="20px" class="text-dark" id="event-info"></i>
                                        </a>
                                        </div>         
                                    </div>
                                    <div class="card-text">
                                        <div class="mt-1">
                                            <span class="text-muted font-weight-bold mr-2">Date:</span>
                                            <span>{{date('d/m/Y', strtotime($act['edate']))}}</span>
                                        </div>
                                        <h4>{{ucfirst($act['ename'])}}</h4> 
                                    </div>
                                </div>
                            </div>
                    @endif
                    @endforeach
                            
                        </div>

                        <div class="tab-pane fade show" id="pills-activity" role="tabpanel" aria-labelledby="pills-activity-tab">
                            <div class="left-timeline px-3 bg-white pt-3 overflow-auto my-scroll" style="height: 60vh;">
                                <h3 class="mb-5 font-size-20 text-center text-dark d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/images/svg-icons/student-dash/activity.svg')}}" height="30px" class="mr-2" alt="Activity">
                                                Your Activity
                                </h3>
                                <ul class="list-unstyled events">
                                    <?php $a=0;?>
                                    @foreach($activity as $act)
                                    @if($act['edate'] < date('Y-m-d'))
                                    <?php 
                                        $a=1;
                                    ?>
                                    <li class="event-list ">
                                        <div>
                                            <div class="media">
                                                <div class="event-date text-center mr-4">
                                                    <div class="py-1 px-3 bg-soft-primary rounded">
                                                        <span
                                                            class="font-size-16 avatar-title text-primary font-weight-semibold ">
                                                            @if(date('d/m/Y', strtotime($act['edate']))===date('d/m/Y', strtotime('-1 day')))
                                                            Yesterday
                                                            @else
                                                            {{date('d/m/Y', strtotime($act['edate']))}}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="media-body ">
                                                    <div class="card bg-light rounded-lg">
                                                        <div class="card-body p-2">
                                                            <h5 class="mt-0">{{ucfirst($act['ename'])}}</h5>
                                                            <p class="text-muted">
                                                                On this day you took a part in {{ucfirst($act['ename'])}} Compitition.
                                                            </p>
                                                            
                                                                @if(($act['rank'])=='p')
                                                                <span class="font-size-14 badge badge-pill badge-soft-danger px-3">
                                                                    You Lose
                                                                @elseif(($act['rank'])==1)
                                                                <span class="font-size-14 badge badge-pill badge-soft-success px-3">
                                                                    First
                                                                @elseif(($act['rank'])==2)
                                                                <span class="font-size-14 badge badge-pill badge-soft-info px-3">
                                                                    Second
                                                                @elseif(($act['rank'])==3)
                                                                <span class="font-size-14 badge badge-pill badge-soft-warning px-3">
                                                                    Third
                                                                @endif
                                                                </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                    
                                </ul>
                                @if($a==0)
                                <div class="font-size-14 font-weight-bold d-flex align-items-center justify-content-center">
                                       
                                    <span>You have no Activities!!</span> 
                                </div>
                                @endif
                            </div> <!-- end activity div -->

                        </div> <!-- end tab pane -->

                    </div> <!-- end tab content -->


                </div><!-- end card body -->
            </div><!-- end card -->

        </div><!-- end col-lg-7 -->
                  
    </div> <!-- end row -->
</div>
    @endsection  









