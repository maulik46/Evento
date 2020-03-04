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
                    <a href="{{url('/view_students')}}" class="d-flex justify-content-end text-dark">
                        <i data-feather="x-circle" id="close-btn" height="18px"></i>
                    </a>
                    <h4 class="my-3 text-dark d-flex align-items-center justify-content-center">
                        <img src="{{asset('assets/images/svg-icons/super-admin/edit-stud.svg')}}" class="ml-2 form-control-icon" height="27px" alt="">
                        <span class="ml-2">Update student</span>
                    </h4>
                    <form action="{{url('/action_update_stud')}}/{{encrypt($stud_data['senrl'])}}" method="POST"  onsubmit="return valid()">
                        @csrf
                    <div class="row mx-0">
                        <div class="col-md-7 mt-2">
                            <label class="col-form-label font-size-14">
                                Student Name</label>
                            <div class="form-group has-icon d-flex align-items-center">
                               <img src="{{asset('assets/images/svg-icons/super-admin/student.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input id="sname" type="text" name="s_name" class="form-control" value="{{$stud_data['sname']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-md-5 mt-2">
                            <label class="col-form-label font-size-14">
                                Enrollment Number</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" id="enrl" onkeyup="checkenrl()" name="s_enrl" class="form-control" value="{{$stud_data['senrl']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">
                                Roll no.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/rollno.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" onkeyup="checkrno()" id="rno" name="s_rollno" class="form-control" value="{{$stud_data['rno']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Class</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/class.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input id="clas" type="text" onkeyup="checkrno()" name="s_class" class="form-control" value="{{$stud_data['class']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Division</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/split.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" id="div" name="s_division" class="form-control" value="{{$stud_data['division']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">
                                Email</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input id="email" type="email" onkeyup="checkemail()" name="s_email" class="form-control" value="{{$stud_data['email']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">Contact No.</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input id="mobile" type="text" name="s_contact"  onkeyup="checkmobile()" class="form-control" value="{{$stud_data['mobile']}}" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>

                    <div class="form-group mt-2 row mx-0">
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">
                                Select Gender</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <select id="gen" name="s_gender" class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
                                    
                                    <option value="" hidden>Select Gender</option>
                                    <option value="male" <?php if($stud_data['gender']=="male"){?> selected <?php }?>>Male</option>
                                    <option value="female"  <?php if($stud_data['gender']=="female"){?> selected <?php }?>>Female</option>
                                </select>
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">Date Of Birth</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" id="dob" name="s_dob" class="form-control basicDate" value="{{date('Y/m/d', strtotime($stud_data['dob']))}}"  data-input />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label font-size-14">
                            Address</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input id="add" type="text" name="s_address" class="form-control" value="{{$stud_data['address']}}" />
                        </div>
                        <span class="text-danger font-weight-bold"></span>
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
<script>
    function valid()
    {
        var f=0;
        var regex = /^[A-Za-z\s]+$/;
        $('*').removeClass('border border-danger');
        if($('#sname').val()=="")
        {
            $('#sname').parent().next().html("Please enter valid Student name.");
            $('#sname').parent().addClass('border border-danger');
            f = 1;
        }
        else if(!regex.test($('#sname').val())){
            $('#sname').parent().next().html("Please enter valid Student name.");
            $('#sname').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#sname').parent().next().html("");
        }


        regex= /^[Ee]{1}\d{14}$/;
        if($('#enrl').val()=="")
        {
            $('#enrl').parent().next().html("Please enter valid Enrollment number.");
            $('#enrl').parent().addClass('border border-danger');
            f = 1;
        }
        else if(!regex.test($('#enrl').val()))
        {
            $('#enrl').parent().next().html("Please enter valid Student Enrollment.");
            $('#enrl').parent().addClass('border border-danger');
            f = 1;
        }
        else if ($('#enrl').parent().next().html().length > 0) {
            $('#enrl').parent().addClass('border border-danger');
            $('#enrl').parent().next().text("This Enrollment number already available");
            f = 1;
        } 
        else{
            $('#enrl').parent().next().html("");
        }


       
        if($('#rno').val()=="")
        {
            $('#rno').parent().next().html("Please enter Student Roll no.");
            $('#rno').parent().addClass('border border-danger');
            f = 1;
        }
        else if($('#rno').val()<1)
        {
            $('#rno').parent().next().html("Please enter valid Student Division.");
            $('#rno').parent().addClass('border border-danger');
            f = 1;
        }
        else if ($('#rno').parent().next().html().length > 0) {
            $('#rno').parent().addClass('border border-danger');
            $('#rno').parent().next().text("This roll no already available for this class");
            f = 1;
        } 
        else{
            $('#rno').parent().next().html("");
        }
        

        regex = /^[A-Za-z]+$/;
        if($('#clas').val()=="")
        {
            $('#clas').parent().next().html("Please enter Student class.");
            $('#clas').parent().addClass('border border-danger');
            f = 1;
        }
        else if(!regex.test($('#clas').val()))
        {
            $('#clas').parent().next().html("Please enter valid Student class.");
            $('#clas').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#clas').parent().next().html("");
        }


        if($('#div').val()=="")
        {
            $('#div').parent().next().html("Please enter Student Division.");
            $('#div').parent().addClass('border border-danger');
            f = 1;
        }
        else if($('#div').val() <= 0)
        {
            $('#div').parent().next().html("Please enter valid Student Division.");
            $('#div').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#div').parent().next().html("");
        }

        regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if($('#email').val()=="")
        {
            $('#email').parent().next().html("Please enter Student Email Address.");
            $('#email').parent().addClass('border border-danger');
            f = 1;
        }
        else if(!regex.test($('#email').val()))
        {
            $('#email').parent().next().html("Please enter valid email Address.");
            $('#email').parent().addClass('border border-danger');
            f = 1;
        }
        else if ($('#email').parent().next().html().length > 0) {
            $('#email').parent().addClass('border border-danger');
            $('#email').parent().next().text("This email addess already taken");
            f = 1;
        }
        else{
            $('#email').parent().next().html("");
        }


        regex = /^\d*(?:\.\d{1,2})?$/;
        var mo= $('#mobile').val();
        if($('#mobile').val()=="")
        {
            $('#mobile').parent().next().html("Please enter Student Mobile no.");
            $('#mobile').parent().addClass('border border-danger');
            f = 1;
        }
        else if(!(regex.test($('#mobile').val()) && mo.length == 10))
        {
            $('#mobile').parent().next().html("Please enter valid Mobile no.");
            $('#mobile').parent().addClass('border border-danger');
            f = 1;
        }
        else if ($('#mobile').parent().next().html().length > 0) {
            $('#mobile').parent().addClass('border border-danger');
            $('#mobile').parent().next().text("This Mobile number already taken");
            f = 1;
        }
        else{
            $('#mobile').parent().next().html("");
        }



        if($('#gen').val()=="")
        {
            $('#gen').parent().next().html("Please select gender of student.");
            $('#gen').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#gen').parent().next().html("");
        }

        if($('#dob').val()=="")
        {
            $('#dob').parent().next().html("Please enter date of birth");
            $('#dob').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#dob').parent().next().html("");
        }


        if($('#add').val()=="")
        {
            $('#add').parent().next().html("Please enter Student Address");
            $('#add').parent().addClass('border border-danger');
            f = 1;
        }
        else if($('#add').val().length < 8){
            $('#add').parent().next().html("Address is too short ");
            $('#add').parent().addClass('border border-danger');
            f = 1;
        }
        else{
            $('#add').parent().next().html("");
        }
        if(f==1)
        {
            return false;
        }
        return true;
    }
  
</script>
<script>
  function checkenrl(){
    
        var enrl = $('#enrl').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type: 'POST',
            url: '/checkenrl',
            data: {
                enrl: enrl,
                oenrl:'<?php echo $stud_data['senrl']?>'
            },
            success: function (data) {
                if(data.msg.length==0)
                {
                    $('#enrl').parent().next().html("");
                    $('#enrl').parent().removeClass('border border-danger');
                }
                else
                {
                     $('#enrl').parent().next().html(data.msg);
                     $('#enrl').parent().addClass('border border-danger');
                     
                }
            },
            error: function (data) {
            console.log(data);
            }
        })
    }
    function checkemail(){
    
    var email = $('#email').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        type: 'POST',
        url: '/checkemail',
        data: {
            email: email,
            enrl:'<?php echo $stud_data['senrl']?>'
        },
        success: function (data) {
            if(data.msg.length==0)
            {
                $('#email').parent().next().html("");
                $('#email').parent().removeClass('border border-danger');
            }
            else
            {
                 $('#email').parent().next().html(data.msg);
                 $('#email').parent().addClass('border border-danger');
            }
        },
        error: function (data) {
        console.log(data);
        }
    })
}
function checkmobile(){
    
    var mobile = $('#mobile').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        type: 'POST',
        url: '/checkmobile',
        data: {
            mobile: mobile,
            enrl:'<?php echo $stud_data['senrl']?>'
        },
        success: function (data) {
            if(data.msg.length==0)
            {
                $('#mobile').parent().next().html("");
                $('#mobile').parent().removeClass('border border-danger');
            }
            else
            {
                 $('#mobile').parent().next().html(data.msg);
                 $('#mobile').parent().addClass('border border-danger');
            }
        },
        error: function (data) {
        console.log(data);
        }
    })
}
function checkrno(){
    
    var rno = $('#rno').val();
    var clas=$('#clas').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax({
        type: 'POST',
        url: '/checkrno',
        data: {
            rno: rno,
            clas:clas,
            enrl:'<?php echo $stud_data['senrl']?>'
        },
        success: function (data) {
            if(data.msg.length==0)
            {
                $('#rno').parent().next().html("");
                $('#rno').parent().removeClass('border border-danger');
            }
            else
            {
                 $('#rno').parent().next().html(data.msg);
                 $('#rno').parent().addClass('border border-danger');
            }
        },
        error: function (data) {
        console.log(data);
        }
    })
}

</script>
@endsection
