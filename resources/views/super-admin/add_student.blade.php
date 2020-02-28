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

    .nice-select .list {
        width: 100%;
        border-radius: 2px;
        box-shadow: none;
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

    .flatpickr-calendar {
        z-index: 10 !important;
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

    .has-icon .form-control-icon {
        z-index: 1;
    }

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        cursor: pointer;
        /* padding:10px 12px; */
    }
</style>
@endsection
@section('my-content')
@if ($errors->any())
    <div class="bg-danger fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div> 
        </div>
    </div>
@endif
@if($message = Session::get('success'))
    <div class="bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
            <strong>{{ $message }}</strong>
            </div> 
        </div>
    </div>
@endif
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
                        @csrf
                    <div class="row mx-0">
                        <div class="col-md-7 mt-2">
                            <label class="col-form-label font-size-14">
                                Student Name</label>
                            <div class="form-group has-icon d-flex align-items-center">
                               <img src="{{asset('assets/images/svg-icons/super-admin/student.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_name" class="form-control" placeholder="Enter Student Name" />
                            </div>
                        </div>
                        <div class="col-md-5 mt-2">
                            <label class="col-form-label font-size-14">
                                Enrollment Number</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_enrl" class="form-control" placeholder="Enter Enrollment Number" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">
                                Roll no.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/rollno.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_rollno" class="form-control" placeholder="Enter Student's Roll no" />
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Class</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/class.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_class" class="form-control" placeholder="Enter Student's Class" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Division</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/split.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_division" class="form-control" placeholder="Enter Student's Divisions" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">
                                Email</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input type="email" name="s_email" class="form-control" placeholder="Enter Student's Email" />
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">Contact No.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="s_contact" class="form-control" placeholder="Enter Student's Contact no" />
                            </div>
                        </div>

                    </div>

                    <div class="form-group mt-2 row mx-0">
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">
                                Select Gender</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <select name="s_gender" class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
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
                                <input type="text" name="s_dob" class="form-control basicDate" placeholder="Date Of Birth"
                                    data-input />
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label font-size-14">
                            Address</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="s_address" class="form-control" placeholder="Enter Student's Address" />
                        </div>

                    </div>
                    <div class="mt-0 ml-1 row justify-content-start align-items-center">
                        &nbsp;
                        <button type="submit" class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15
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

    <div class="position-fixed plus-btn" style="bottom: 72px;right:20px;" data-toggle="tooltip" data-placement="left"
        title="Upload Excel File">
        <!-- <label for="file-upload" class="custom-file-upload btn bg-white badge-pill hover-me-sm new-shadow-sm">
                        <img src="{{asset('assets/images/svg-icons/super-admin/excel.svg')}}" height="35px" alt="">
                    </label>
                    <input id="file-upload" name="" type="file" /> -->
        <button class="btn bg-white badge-pill hover-me-sm new-shadow-sm p-2 mb-1" id="excel" type="button">
            <img src="{{asset('assets/images/svg-icons/super-admin/excel.svg')}}" height="35px" alt="">
        </button>
    </div>
    <div id="excel-form-model"
        class="col-xl-4 col-md-6 col-sm-8 col-10 p-4 bg-light position-fixed new-shadow-2 rounded"
        style="top: 50%;left: 50%;transform: translate(-50%, -40%);display:none;z-index:9999;">
        <a href="#" id="close-upload-form" class="mb-3 d-flex justify-content-end text-dark" style="margin-top:-10px;">
            <i data-feather="x-circle" id="close-btn" height="18px"></i>
        </a>
        <form action="{{ url('import-excel') }}" method="POST" name="importform" enctype="multipart/form-data">
        @csrf
            <div class="card new-shadow-sm hover-me-sm mb-0" id="upload-plus-btn">
                <label for="file-upload"
                    class="custom-file-upload w-100 d-flex align-items-center justify-content-center overflow-auto">
                    <i data-feather="upload" class="mt-2"></i>
                    <span class="mt-2 ml-2">Upload your excel file from here</span>
                </label>
                <input id="file-upload" name="import_file" type="file" />
            </div>
            <div class="text-center mt-3" style="cursor:pointer;" id="re-upload">
                <i data-feather="refresh-cw" id="close-btn"></i>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <button type="submit" class="mt-3 upl btn btn-success px-3 new-shadow-sm hover-me-sm font-weight-bold rounded-sm">
                    Upload
                </button>
                <a href="{{asset('demo/studentrec.xlsx')}}" class="mt-3 font-weight-bold text-info">Click to get demo of excel file</a>
            </div>
        </form>
        
    </div>
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
    $('#re-upload').hide();
    $('#file-upload').change(function () {

        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $(this).prev('label').text(file).css({
            "margin-top": "4px",
            "color": "var(--success)"
        });
        $('#re-upload').show();


    });
    $('#excel').click(function () {
        $('#excel-form-model').fadeIn(150);
    });
    $('#close-upload-form').click(function () {
        $('#excel-form-model').fadeOut(180);
    });
    $('#re-upload').click(function () {
        $('.custom-file-upload').remove();
        $('#upload-plus-btn').prepend(
            '<label for="file-upload" class="custom-file-upload w-100 d-flex align-items-center justify-content-center overflow-auto"><span class="mt-2">Upload again from here!!</span></label>'
            );
        $('#re-upload').hide();
    });
    $('.upl').click(function () {
        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        alert(file);
    })
</script>
@endsection
