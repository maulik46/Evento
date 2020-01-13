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
        <div class="col-lg-6 col-md-8 col-sm-8">
                    <div class="card new-shadow rounded-lg px-1">
                       <div class="card-body px-lg-4">
                           <a href="{{url('/cindex')}}" class="float-right text-dark">
                               <i data-feather="x-circle" id="close-btn"></i>
                           </a>
                           <h4 class="my-4 text-center text-dark">
                               <img src="{{asset('assets/images/svg-icons/co-ordinate/lock.svg')}}" height="22px" alt="">
                               <span> Change Password</span>
                           </h4>
                           <form action="#">
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Current Password</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="lock" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="password" class="form-control" placeholder="Enter Your Current Password..." />
                                   </div>
                               </div>
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">New Password</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="unlock" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="password" class="form-control"
                                           placeholder="Enter New Password..." />
                                   </div>
                               </div>
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Confirm Password</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="check-circle" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="password" class="form-control" placeholder="Enter Password Again..." />
                                   </div>
                               </div>
                               <button type="submit" class="hover-me-sm btn btn-success rounded-sm new-shadow-sm font-weight-bold px-3 mt-2 mb-3">
                                    Change Password
                                    <i data-feather="check-square" height="20px"></i>
                               </button>
                           </form>
                       </div>
                    </div>
        </div>
        </div>
@endsection

