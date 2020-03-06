@extends('system/system_layout')
@section('title','Change Password')
@section('my-content')
<div class="container-fluid mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-5 col-md-8 col-sm-10">
            <h5 class="text-center bg-light py-3 rounded card new-shadow-sm">
                Change Password</h5>
            <div class="mt-2 card bg-light p-3 new-shadow-2">
                <form>
                    <div class="form-group mt-2">
                        
                        <label class="col-form-label font-size-14">Current Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                            <input type="password"  class="form-control" placeholder="Enter Current Password..." />
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label font-size-14">New Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="unlock" class="form-control-icon ml-2" height="19px"></i>
                            <input type="password" class="form-control" placeholder="Enter New Password..." />
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label class="col-form-label font-size-14">Confirm Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="check-circle" class="form-control-icon ml-2" height="19px"></i>
                            <input type="password"  class="form-control" placeholder="Enter Confirm Password..." />
                        </div>
                    </div>
                    <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow-sm font-weight-bold px-3 mt-2 mb-1">
                        Change
                        <i data-feather="check-square" height="20px"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection