@extends('co-ordinates/cod_layout')

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

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }
    </style>
@endsection


@section('my-content')
        <div class="d-flex justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-8 col-10">
                    <div class="card new-shadow rounded-lg px-1">
                       <div class="card-body px-lg-4">
                           <a href="{{url('/cindex')}}" class="float-right text-dark">
                               <i data-feather="x-circle" height="19px" id="close-btn"></i>
                           </a>
                           <h4 class="my-4 text-center text-dark">
                               <img src="{{asset('assets/images/svg-icons/co-ordinate/lock.svg')}}" height="22px" alt="">
                               <span> Change Password</span>
                           </h4>
                           <form method="post" action="update_pass" onsubmit="return check()">
                           @csrf
                           <p id="error" class="text-center text-danger font-weight-bold">{{Session::get('error')}}</p>
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Current Password</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="password" name="current_pass" id="curpass" class="form-control" placeholder="Enter Your Current Password" />
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
                                       <input type="password" name="cpass" id="cpass" class="form-control" placeholder="Enter Password Again" />
                                   </div>
                               </div>
                               
                               <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow-sm font-weight-bold px-3 my-2">
                                    Change
                                    <i data-feather="rotate-ccw" height="20px"></i>
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
