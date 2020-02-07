@extends('co-ordinates/cod_layout')

@section('title','Create Event')

@section('head-tag-links')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/multicheckbox/multiselect.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/create-ev-css.css')}}">
<style>
    .course-name{
        display:flex;
        align-items:center;
        justify-content: center;
        margin-top:0px;
    }
</style>
@endsection

@section('my-content')
<div class="container-fluid">
    <div class="col-md-3 mb-0">
        <div class="card new-shadow">
            <label for="s1" class="btn">
            <input type="checkbox" onclick="sell(this.id);" class="" style="display: none" id="s1" name="">
            <h4 class="course-name p-3">BCA</h4>
             </label>
        </div>
    </div>
   
</div>
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-10 mx-2 p-0">

        <div class="bg-white new-shadow rounded-lg p-3 pb-5">
            <a href="{{url('/cindex')}}" class="float-right text-dark">
                <i data-feather="x-circle" height="20px" id="close-btn"></i>
            </a>
            <h3 class="my-4 text-center text-dark">
                <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                <span> Create new event</span>
            </h3>

            <form class="form-horizontal" method="post" onsubmit="return getMessage()" action="{{url('newevent')}}">
                @csrf
                <div class="card border-form">
                    <div class="card-body py-0 pb-1">
                        <div class="form-group mt-2 ">
                            <label class="col-form-label font-size-15">Event Name</label>
                            <div id="enamediv" class="form-group has-icon d-flex align-items-center">
                                <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" onkeyup="this.value = this.value.toLowerCase()" id="ename"
                                    onkeyup="return echeck()" name="ename" class="form-control"
                                    placeholder="Enter Event Name..." />
                            </div>
                            <span id="erevent" class="text-danger font-weight-bold"></span>

                        </div>
                    </div>
                </div>
                <div class="card border-form my-5">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                            <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Date</label>
                                <div id="edatediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="edate" name="edate" class="form-control basicDate"
                                        placeholder="Event Date..." data-input />
                                </div>
                                <span id="erevent" class="text-danger font-weight-bold"></span>

                            </div>
                             <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event End Date</label>
                                <div id="enddatediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="enddate" name="enddate" class="form-control basicDate"
                                        placeholder="Event End Date..." data-input />
                                </div>
                                <span id="erevent" class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Time</label>
                                <div id="etimediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="clock" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="etime" name="etime" class="form-control timePicker"
                                        placeholder="Event Time..." autocomplete="off" />
                                </div>

                                <span class="text-danger font-weight-bold"></span>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group mt-2">
                                <label class=" col-form-label font-size-15">Starting Date Of Registraion
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="sdate" name="sdate" class="form-control basicDate"
                                        placeholder="Starting Date Of Registraion..." data-input />
                                </div>

                                <span class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-xl-6 form-group mt-2">
                                <label class=" col-form-label font-size-15">Last Date Of Registraion
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="ldate" name="ldate" class="form-control basicDate"
                                        placeholder="Last Date Of Registraion..." data-input />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border-form my-5">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Type</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                    <select id="event-type" name="etype" class="form-control w-100 pt-1 nice-select">
                                        <option hidden value="">Select Type</option>
                                        <option value="solo">Solo</option>
                                        <option value="team">Team</option>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Gender</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                    <select id="gen" onchange="return echeck()" name="efor" class="form-control w-100 pt-1 nice-select">
                                        <option value="" hidden>Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="both">For both</option>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event for</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                    <select  multiple="multiple" class="form-control active w-100" id="scripts">
                                        <option value="FY">FY</option>
                                        <option value="SY">SY</option>
                                        <option value="TY">TY</option>
                                    </select>

                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group mt-2">
                                <label id="team-size-label" class="col-form-label font-size-15">Team size
                                </label>
                                <div id="t-size" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-plus" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="team-size" name="tsize" type="number" class="form-control"
                                        placeholder="Team size" />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-sm-5 mt-2">
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_class" value="yes"
                                        class="custom-control-input" id="diff-class">
                                    <label class="custom-control-label" for="diff-class" id="diff-class-label">Allow
                                        Different Class</label>
                                </div>
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_div" value="yes" class="custom-control-input"
                                        id="diff-div">
                                    <label class="custom-control-label" for="diff-div" id="diff-div-label">Allow
                                        Different Division</label>
                                </div>
                            </div>
                             <div class="col-md-4 form-group mt-2">
                                <label id="max-team-label" class="col-form-label font-size-15">Maximum Team
                                </label>
                                <div id="m-team" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="max-team" name="mteam" type="number" class="form-control"
                                        placeholder="Maximum Team" />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 form-group mt-2">
                                <label class=" col-form-label font-size-15">Event Location
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="loc" type="text" name="loc" class="form-control"
                                        placeholder="Event Location..." />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border-form">
                    <div class="card-body py-0 pb-1">
                        <div class="form-group mt-2">
                            <label class="col-form-label font-size-15">Event Co-ordinate</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" style="background-color: #f3f4f7;color: #737373!important;" class="form-control font-size-15 font-weight-bold" 
                                    disabled value="{{ucfirst(Session::get('cname'))}}" />
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label class="col-form-label font-size-15">Other rules <span
                                    class="font-weight-light">(optional)</span></label>

                            <div class="form-group has-icon d-flex">
                                <i data-feather="edit" class="form-control-icon ml-2" height="19px"
                                    style="margin-top: 13px;" s></i>
                                <textarea name="rules" class="form-control" rows="5" id="example-textarea"
                                    placeholder="Enter any message or rule.."></textarea>
                            </div>
                            <span class="help-block">
                                <span>Rules must be seprated by <b>;</b></span>
                            </span>
                        </div>

                        <button type="submit"
                            class="hover-me-sm m-2 btn btn-success px-3  rounded-sm new-shadow font-weight-bold font-size-15">
                            <span class="mr-1">Create Event</span>
                            <i data-feather="check-square" height="20px"></i>
                        </button>
                        <button type="reset"
                            class="hover-me-sm m-2 btn btn-danger px-3  rounded-sm new-shadow font-weight-bold font-size-15">
                            <span class="mr-1">Reset form</span>
                            <i data-feather="x-circle" height="20px"></i>
                        </button>

                    </div>
                </div>

            </form>


        </div> 

    </div>
</div>
@endsection


@section('extra-scripts')
<!-- calander js for date -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

<!-- clock  js for time -->
<script src="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/libs/multicheckbox/multiselect.js')}}"></script>
<script src="{{asset('assets/js/create-ev-js.js')}}"></script>
<script>
         function sell(id)
        {
	        $("#"+id).parent().toggleClass("bg-info");
        
        };
</script>
@endsection
