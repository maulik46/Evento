@extends('super-admin/s_admin_layout')

@section('title','Add new student')

@section('head-tag-links')
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <style>
        .nice-select:after {
            border-bottom: 3px solid #999;
            border-right: 3px solid #999;
            height: 8px;
            right: 15px;
            width: 8px;
        }
        .nice-select .list{
            width:100%;
            border-radius: 2px;
            box-shadow:none; 
            border: 1px solid #d1d1d1;
        }
        .nice-select .option.selected.focus {
            background-color: #f3f4f7;
        }
         .flatpickr-weekdays {
        margin: 10px 0px;
        }

        .flatpickr-weekday {
            color: #000 !important;
            margin-top: 5px;
        }
        .flatpickr-calendar{
            z-index: 10!important;
        }
        .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 10px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 50px;
        }

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }

        input[type="file"] {
        display: none;
        }

        .custom-file-upload {
            cursor: pointer;
            padding:10px 12px;
        }


    </style>
@endsection
@section('my-content')
            <div class="content d-flex justify-content-center">
                <div class="container-fluid col-xl-9 col-lg-10 col-md-12">
                    <div class="card new-shadow rounded-lg mt-2">
                        <div class="card-body px-lg-3">
                            <a href="{{url('/sindex')}}" class="d-flex justify-content-end text-dark">
                                <i data-feather="x-circle" id="close-btn" height="18px"></i>
                            </a>
                            <h4 class="my-3 text-dark d-flex align-items-center justify-content-center">
                                <i data-feather="user-plus"></i>
                                <span class="ml-2">Add new student</span>
                            </h4>
                            <form action="#">
                                <div class="row mx-0">
                                    <div class="col-md-7 mt-2">
                                        <label class="col-form-label font-size-14">
                                        Student Name</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Student Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <label class="col-form-label font-size-14">
                                        Enrollment Number</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Enrollment Number" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mx-0">
                                    <div class="col-sm-12 col-md-4">
                                        <label class="col-form-label font-size-14">
                                        Roll no.</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                            <input type="email" class="form-control"  placeholder="Enter Student's Roll no" />
                                        </div>
                                     
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="col-form-label font-size-14">Division</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <img src="{{asset('assets/images/svg-icons/super-admin/split.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                            <input type="text" class="form-control" placeholder="Enter Student's Divisions" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label class="col-form-label font-size-14">Class</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <img src="{{asset('assets/images/svg-icons/super-admin/class.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                            <input type="text" class="form-control" placeholder="Enter Student's Class" />
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="form-group row mx-0">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="col-form-label font-size-14">
                                        Email</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="email" class="form-control"  placeholder="Enter Student's Email" />
                                        </div>
                                     
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="col-form-label font-size-14">Contact No.</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Student's Contact no" />
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="form-group mt-2 row mx-0">
                                    <div class="col-sm-6">
                                        <label class="col-form-label font-size-14">
                                        Select Gender</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                               <select class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
                                                   <option value="">Select Gender</option>
                                                   <option value="Sport">Male</option>
                                                   <option value="Cultural">Female</option>
                                               </select>
                                        </div>
                                     
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label font-size-14">Date Of Birth</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control basicDate" placeholder="Date Of Birth" data-input />
                                        </div>
                                    </div>
                                   
                                </div>
                                 <div class="col-sm-12">
                                        <label class="col-form-label font-size-14">
                                        Address</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="email" class="form-control"  placeholder="Enter Student's Address" />
                                        </div>
                                     
                                    </div>
                                <div class="mt-0 ml-1 row justify-content-start align-items-center">
                                    &nbsp;
                                    <button type="submit"
                                        class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15
                                        font-weight-bold ml-2" style="background-color: #35bbca;">
                                        <span>Add Student</span>
                                        <i data-feather="plus-square" height="20px"></i>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            <!--  right side buttons div  -->
                
                <div class="position-fixed plus-btn" style="bottom: 72px;right:16px;" data-toggle="tooltip" data-placement="left" title="Upload Excel File">
                    <label for="file-upload" class="custom-file-upload btn bg-white badge-pill hover-me-sm new-shadow-sm">
                        <img src="{{asset('assets/images/svg-icons/super-admin/excel.svg')}}" height="35px" alt="">
                    </label>
                    <input id="file-upload" name="" type="file" />
                </div>
            <!-- end right side buttons div -->
            </div>
@endsection  
@section('extra-scripts')
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script> 
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script>
    $('.select-me').niceSelect();

    $(".basicDate").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
    });
</script>
@endsection