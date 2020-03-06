@extends('system/system_layout')
@section('title','Add College')
@section('my-content')            
            <form class="mt-5 p-2 px-2 px-sm-4">
                <div class="row mx-0">
                    <div class="form-group col-sm-6 mb-1">
                        <label>Admin Name</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text"  class="form-control" placeholder="Enter Admin Name..." />
                        </div>
                    </div>
                    <div class="form-group col-sm-6 mb-1">
                        <label>Email</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                            <input type="email" class="form-control" placeholder="Enter Your Email">
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column mb-1">
                    <label>Institute Name</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/clg1.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" class="form-control" placeholder="Enter Your Institute Name">
                    </div>
                    <!--  -->
                </div>
                <div class="row mx-0">
                    <div class="form-group col-md-4 col-12 mb-1">
                        <label>Contact no</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" class="form-control" placeholder="Enter Institute Contact">
                        </div>
                        <!--  -->
                    </div>
                    <div class="form-group col-md-4 col-12 mb-1">
                        <label>City</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" class="form-control" placeholder="Enter Institute City">
                        </div>
                        <!--  -->
                    </div>
                    <div class="form-group col-md-4 col-12 mb-1">
                        <label>Password</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="key" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" class="form-control" style="letter-spacing:2px;" value="<?=uniqid();?>" readonly>
                        </div>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column mb-1">
                    <label>Institute Address</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/svg-icons/address.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" class="form-control" placeholder="Enter Institute Address">
                    </div>
                    <!--  -->
                </div>
                <div class="row form-group col-12 mx-0 mb-0">
                    <label>Message</label>
                    <div class="form-group has-icon d-flex align-items-start w-100">
                    <i data-feather="message-square" class="form-control-icon ml-2" style="margin-top: 10px;" height="19px"></i>
                    <input type="text" class="form-control" placeholder="Enter Your Message" />
                    </div>
                </div>
                <div class="my-2 mx-2">
                    <button type="submit"  class="hover-me-sm btn btn-success new-shadow-sm font-weight-bold px-3 rounded-sm mr-1">
                        <span class="font-size-15">Send</span>
                        <i data-feather="send" class="mb-1" height="18px"></i>
                    </button>
                    <button type="reset"  class="hover-me-sm btn btn-danger new-shadow-sm font-weight-bold px-3 rounded-sm ml-1">
                        <span class="font-size-15">Clear</span>
                        <i data-feather="rotate-ccw" class="mb-1" height="18px"></i>
                    </button>
                </div>
            </form>
@endsection