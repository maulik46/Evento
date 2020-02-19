@extends('super-admin/s_admin_layout')

@section('title','Change Password')

@section('head-tag-links')
<style>
        .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 10px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 50px;
            cursor: text !important;
        }

        /* box-shadow: 0 0 2px black; */

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }

        .border-form {
            border: 1px solid #d1d1d152;
            border-radius: .5rem;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid gainsboro;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #43d39e;
        }
    </style>
@endsection
@section('my-content')
            <div class="content d-flex justify-content-center">
                <div class="container-fluid pt-0 col-lg-5 col-md-8 col-sm-10">
                    <div class="card mt-4 new-shadow rounded-lg px-1">
                        <div class="card-body px-lg-4">
                            <a href="{{url('/sindex')}}" class="d-flex justify-content-end text-dark">
                                <i data-feather="x-circle" id="close-btn" height="18px"></i>
                            </a>
                            <h4 class="mt-0 text-center text-dark">
                                <img src="{{asset('assets/images/svg-icons/co-ordinate/lock.svg')}}" height="22px" alt="">
                                <span> Change Password</span>
                            </h4>
                           <form method="post" action="change_pass" onsubmit="return check()">
                           @csrf
                           <p id="error" class="font-weight-bold text-center text-danger">{{Session::get('error')}}
                           </p>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Current Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" name="current_pass" id="curpass" class="form-control"
                                            placeholder="Enter Your Current Password" />
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">New Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="unlock" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" class="form-control" name="npass" id="npass"
                                            placeholder="Enter New Password" />
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label font-size-14">Confirm Password</label>
                                    <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="check-circle" class="form-control-icon ml-2" height="19px"></i>
                                        <input type="password" class="form-control" name="cpass" id="cpass"
                                            placeholder="Enter Password Again" />
                                    </div>
                                </div>
                                <button type="submit"
                                    class="hover-me-sm btn btn-info rounded-sm new-shadow-sm font-weight-bold px-3 mt-2 mb-3" style="background-color: #35bbca;">
                                    Change Password
                                    <i data-feather="check-square" height="20px"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('extra-scripts')        
    <script>
    function check()
    {
        if($('#curpass').val()=="")
        {
            $('#error').html("Plese Enter your current password");
            return false;
        }
        if($('#npass').val()=="")
        {
            $('#error').html("Plese Enter your New password");
            return false;
        }
        else if($('#npass').val().length <= 6)
        {
            $('#error').html("New password length must be greater then 6 character");
            return false;
        }
        if($('#cpass').val()=="")
        {
            $('#error').html("Please Re-Enter your New password");
            return false;
        }
    }
    </script>
@endsection