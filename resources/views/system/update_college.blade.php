@extends('system/system_layout')
@section('title','Add College')
@section('my-content')  
         <div class="text-center py-2 rounded card shadow-none mb-0">
                <span class="h4">
                <i class="uil uil-graduation-hat h4 mr-1"></i>
                Update College
                </span>
        </div> 
        <div class="px-1 px-sm-3" >
            <form method="POST" action="{{url('action_update_college')}}/{{encrypt($clg_data['clgcode'])}}" class="mt-2 card shadow-none py-3 px-1 px-sm-2 rounded-lg" style="border:1px solid #e2e7f1;">
            @csrf
                <div class="row mx-0">
                    <div class="form-group col-sm-6 mb-1">
                        <label>Admin Name</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="admin_name"  class="form-control" value="{{$clg_data['name']}}" />
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-1">
                        <label>Email</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                            <input type="email" name="admin_email" class="form-control" value="{{$clg_data['email']}}">
                        </div>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="form-group col-md-12 mx-0 flex-column mb-1">
                    <label>Institute Name</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/clg1.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" name="clg_name" class="form-control" value="{{$clg_data['clgname']}}">
                    </div>
                    </div>
                </div>
                
                <div class="row mx-0">
                    <div class="form-group col-md-6 col-12 mb-1">
                        <label>Contact no</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="clg_mob" class="form-control" value="{{$clg_data['mobile']}}">
                        </div>
                        <!--  -->
                    </div>
                    <div class="form-group col-md-6 col-12 mb-1">
                        <label>City</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="clg_city" class="form-control" value="{{$clg_data['city']}}">
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column mb-1">
                    <label>Institute Address</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/svg-icons/address.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" name="clg_add" class="form-control" value="{{$clg_data['address']}}">
                    </div>
                    <!--  -->
                </div>
                <div class="my-2 mx-2">
                    <button type="submit"  class="hover-me-sm btn btn-success new-shadow-sm font-weight-bold px-3 rounded-sm mr-1">
                        <span class="font-size-15">Update</span>
                        <i data-feather="check-square" class="mb-1" height="18px"></i>
                    </button>
                    <button type="reset"  class="hover-me-sm btn btn-danger new-shadow-sm font-weight-bold px-3 rounded-sm ml-1">
                        <span class="font-size-15">Clear</span>
                        <i data-feather="rotate-ccw" class="mb-1" height="18px"></i>
                    </button>
                </div>
            </form>
        </div>          
@endsection