@extends('stud_layout')

@section('title','My Profile')

@section('head-tag-links')
<?php use Carbon\Carbon;?>
<style>
    #event-info:hover {
        color: #43d39e !important;
    }

    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 15px 15px;
        border: 1px solid #f3f4f7 !important;
        font-size: 1.1em;
        color: #333 !important;
        height: 40px;
    }

    .form-control:focus {
        border: 1px solid #d1d1d1 !important;
        background-color: #f3f4f7 !important;
    }

    .form-group {
        margin-bottom: 2px !important;
    }
</style>

@endsection


@section('my-content')
<div>
    @if(Session::has('msg'))
    <div class="bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert"
        aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle" height="20px"></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
                {{Session::get('msg')}}
            </div>
        </div>
    </div>
    @endif
    <!-- start div -->
    <div class="row mt-5">
        <div class="col-lg-5">
            <div class="card new-shadow-sm">
                <div class="card-body px-2 px-sm-3">
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
                    <hr class="mb-0">
                    <div class="pt-1">
                        <div class="mx-2 d-flex justify-content-between align-items-center">
                            <div class="h4 font-size-15 text-center">
                                My Information
                            </div>
                            <a href="#" id="update-profile-btn" data-toggle="tooltip" data-placement="bottom"
                                title="Update Profile" class="text-warning">
                                <i data-feather="edit" height="18px"></i>
                            </a>
                            <a href="#" style="display:none" id="close-form" class="text-danger">
                                <i data-feather="x-circle" height="18px"></i>
                            </a>

                        </div>
                        <hr class="mt-1 mb-1">
                        <div id="user-info" class="table-responsive my-scroll overflow-auto">
                            <table class="table table-borderless mb-0 text-muted">
                                <tbody>
                                    <tr>
                                        <th scope="row">Enrollment no</th>
                                        <td>{{ucfirst(Session::get('senrl'))}}</td>
                                    </tr>
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
                        <div class="card-body pt-0" style="display:none" id="update-form">
                            <form action="{{url('student_update_action')}}/{{encrypt(Session::get('senrl'))}}"
                                method="POST">
                                @csrf
                                <label class="col-form-label font-size-14">Email</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="email" id="email" name="user_email" class="form-control"
                                        value="{{Session::get('email')}}" />
                                </div>
                                <div id="email-er" class="text-danger font-weight-bold"></div>
                                <label class="col-form-label font-size-14">Mobile No</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="mobile" name="user_mobile" class="form-control"
                                        value="{{Session::get('mobile')}}" />
                                </div>
                                <div id="mobile-er" class="text-danger font-weight-bold"></div>
                                <label class="col-form-label font-size-14">Address</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="address" name="user_address" class="form-control"
                                        value="{{Session::get('address')}}" />
                                </div>
                                <div id="address-er" class="text-danger font-weight-bold"></div>
                                <button type="submit" id="update"
                                    class="mt-2 btn  rounded-sm hover-me-sm px-2 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13 text-white"
                                    style="background-color: var(--red);">
                                    <i data-feather="check-square" height="18px"></i>
                                    Update Details
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card new-shadow-sm">
                <div class="card-body px-2 px-sm-3">
                    <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-participated-tab" data-toggle="pill"
                                href="#pills-participated" role="tab" aria-controls="pills-participated"
                                aria-selected="true">
                                Participated Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-activity-tab" data-toggle="pill" href="#pills-activity"
                                role="tab" aria-controls="pills-activity" aria-selected="false">
                                Activity
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <!-- messages -->
                        <div class="tab-pane fade show active overflow-auto my-scroll" id="pills-participated"
                            role="tabpanel" aria-labelledby="pills-participated-tab" style="height: 60vh;">
                            <!-- 1st event -->
                            <?php $a=0;?>
                            @foreach($activity as $act)
                            @if($act['edate'] > date('Y-m-d'))
                            <?php $a=1;
                                $captain=substr($act['senrl'],0,15);
                            ?>
                            <div class="card bg-light rounded  new-shadow-sm  hover-me-sm">
                                <div class="card-body pt-2 pb-1">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                                        <div>
                                        @if($act['e_type']=='team')
                                        <span class="badge badge-soft-warning badge-pill px-3 ">Team Event</span>
                                        @else
                                        <span class="badge badge-soft-success badge-pill px-3 ">Solo Event</span>
                                        @endif
                                        <span class="badge badge-soft-primary badge-pill px-3 ">{{date('d/m/Y', strtotime($act['edate']))}}</span>
                                        </div>
                                        <div>
                                            <a href="{{url('about_event')}}/{{encrypt($act['pid'])}}" data-toggle="tooltip" data-placement="bottom" title="About Event" class="mr-1">
                                                <i data-feather="info" height="18px" class="text-dark" id="event-info"></i>
                                            </a>
                                            @if(Session::get('senrl')==$captain)
                                                <?php $msg="<b>You want to cancel participation ?</b>";?>
                                                @if($act['e_type']=="team")
                                                <?php $msg="<b>You want to cancel participation of your whole team ?</b>";?>
                                                @endif
                                                    <a href="" onclick="return cancel_part('<?php echo $act['pid']?>','<?php echo $msg?>')" class="text-dark cancel-btn" data-toggle="tooltip" data-placement="bottom" title="Cancel Participation">
                                                        <i data-feather="trash-2" height="18px" id="close-btn"></i>
                                                    </a>
                                                
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-text py-1">
                                        <span class="font-size-20 font-weight-bold text-dark">{{ucfirst($act['ename'])}}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @if($a==0)
                            <div class="font-size-14 font-weight-bold d-flex align-items-center justify-content-center font-size-16"
                                style="height: 60vh;">
                                <span>You have not participated in any activities!!</span>
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane fade show" id="pills-activity" role="tabpanel"
                            aria-labelledby="pills-activity-tab">
                            <div class="left-timeline bg-white overflow-auto my-scroll" style="height: 60vh;">
                                <?php $a=0;?>
                                @foreach($activity as $act)
                                @if($act['edate'] < date('Y-m-d')) <?php $a=1;?> 
                                <div class="card bg-light p-2 new-shadow-sm hover-me-sm">
                                    <div class="row align-items-center mx-0 justify-content-between">
                                        <span class="badge badge-soft-primary badge-pill px-3">
                                            @if(date('d/m/Y', strtotime($act['edate']))===date('d/m/Y',strtotime('-1
                                            day')))Yesterday
                                            @else{{date('d/m/Y', strtotime($act['edate']))}}
                                            @endif
                                        </span>
                                        <div>
                                            <span class="badge badge-primary px-3 rounded-0">
                                                Result
                                            </span>
                                            <span class="badge badge-soft-primary px-3 rounded-0">
                                                @if(($act['rank'])=='p')Lost
                                                @elseif(($act['rank'])==1)First
                                                @elseif(($act['rank'])==2)Second
                                                @elseif(($act['rank'])==3)Third
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <span class="font-size-20 font-weight-bold text-dark py-1">{{ucfirst($act['ename'])}}</span>
                                    <div class="card-text">
                                        On this day you participated in {{ucfirst($act['ename'])}}
                                    </div>
                                </div>
                            @endif
                            @endforeach
                            @if($a==0)
                            <div class="font-size-14 font-weight-bold d-flex align-items-center justify-content-center font-size-16"
                                style="height:30vh;">

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
@section('extra-scripts')

<script>
    $(document).ready(function () {
        $('#update-form').hide();
        $('#update-profile-btn').click(function () {
            $('#user-info,#update-profile-btn').hide();
            $('#update-form,#close-form').show();

        });
        $('#close-form').click(function () {
            $('#update-form,#close-form').hide();
            $('#user-info,#update-profile-btn').show();
        });
    })
</script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
    $('#update').click(function () {

        var f = 0;
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if ($('#email').val() == "") {
            $('#email-er').text("Please enter your Email Address.");
            f = 1;
        } else if (!regex.test($('#email').val())) {
            $('#email-er').text("Please enter valid email Address.");
            f = 1;
        } else {
            $('#email-er').text('');
        }
        regex = /^\d*(?:\.\d{1,2})?$/;
        if ($('#mobile').val() == "") {
            $('#mobile-er').text("Please enter your Mobile no.");
            f = 1;
        } else if (!(regex.test($('#mobile').val()) && $('#mobile').val().length == 10)) {
            $('#mobile-er').text("Please enter valid Mobile no.");
            f = 1;
        } else {
            $('#mobile-er').text('');
        }

        if ($('#address').val() == "") {
            $('#address-er').text("Please enter your Address");
            f = 1;
        } else {
            $('#address-er').text('');
        }

        if (f == 1) {
            return false;
        }

    })
    function cancel_part(pid,msg)
    {
        Swal.fire({
        title: "Are you sure?",
        html:msg,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:"Yes,cancel it",
        cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            window.location.href = '<?php echo url('/profile/confrim_del').'/' ?>'+pid;
        }
        })
        return false;
    }
</script>
@endsection
