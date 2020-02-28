@extends('super-admin/s_admin_layout')

@section('title','Update student')

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

</style>
@endsection
@section('my-content')


    <div class="content d-flex justify-content-center">
        <div class="container-fluid col-xl-9 col-lg-10 col-md-12">
            <div class="card new-shadow rounded-lg mt-2">
                <div class="card-body px-lg-3">
                    <a href="{{url('/view_students')}}" class="d-flex justify-content-end text-dark">
                        <i data-feather="x-circle" id="close-btn" height="18px"></i>
                    </a>
                    <h4 class="my-3 text-dark d-flex align-items-center justify-content-center">
                        <img src="{{asset('assets/images/svg-icons/super-admin/edit-stud.svg')}}" class="ml-2 form-control-icon" height="27px" alt="">
                        <span class="ml-2">Update student</span>
                    </h4>
                    <form action="{{url('/action_update_stud')}}/{{encrypt($stud_data['senrl'])}}" method="POST">
                        @csrf
                    <div class="row mx-0">
                        <div class="col-md-7 mt-2">
                            <label class="col-form-label font-size-14">
                                Student Name</label>
                            <div class="form-group has-icon d-flex align-items-center">
                               <img src="{{asset('assets/images/svg-icons/super-admin/student.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_name" class="form-control" value="{{$stud_data['sname']}}" />
                            </div>
                        </div>
                        <div class="col-md-5 mt-2">
                            <label class="col-form-label font-size-14">
                                Enrollment Number</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_enrl" class="form-control" value="{{$stud_data['senrl']}}" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">
                                Roll no.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/rollno.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_rollno" class="form-control" value="{{$stud_data['rno']}}" />
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Class</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/class.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_class" class="form-control" value="{{$stud_data['class']}}" />
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Division</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/split.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="s_division" class="form-control" value="{{$stud_data['division']}}" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">
                                Email</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input type="email" name="s_email" class="form-control" value="{{$stud_data['email']}}" />
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">Contact No.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="s_contact" class="form-control" value="{{$stud_data['mobile']}}" />
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
                                    <!-- <option selected value="{{$stud_data['gender']}}">
                                        {{ucfirst($stud_data['gender'])}}
                                    </option> -->
                                    <option value="" hidden>Select Gender</option>
                                    <option value="male" <?php if($stud_data['gender']=="male"){?> selected <?php }?>>Male</option>
                                    <option value="female"  <?php if($stud_data['gender']=="female"){?> selected <?php }?>>Female</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">Date Of Birth</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="s_dob" class="form-control basicDate" value="{{date('Y/m/d', strtotime($stud_data['dob']))}}"  data-input />
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label font-size-14">
                            Address</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="s_address" class="form-control" value="{{$stud_data['address']}}" />
                        </div>

                    </div>
                    <div class="mt-0 ml-1 row justify-content-start align-items-center">
                        &nbsp;
                        <button type="submit" class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15
                                        font-weight-bold ml-2" style="background-color: #35bbca;">
                            <span>Update Student</span>
                            <i data-feather="check-square" height="20px"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script>
    $('.select-me').niceSelect();

    $(".basicDate").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d"
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
