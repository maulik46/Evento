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
        height: 45px;
    }

    .form-control:focus {
        border: 1px solid #d1d1d1 !important;
        background-color: #f3f4f7 !important;
    }
    label{
        color: var(--dark)!important;
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
    <div class="bg-danger fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99;top:73px;left:0px">
        <div class="text-white alert mb-0  py-1 ">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div >
            <ol class="mt-2 font-weight-bold font-size-16 d-flex align-items-center justify-content-center">
                @foreach ($errors->all() as $error)
                    <li class="text-left">{{ $error }}</li>
                @endforeach
            </ol>
            </div> 
        </div>
    </div>
@endif
@if($message = Session::get('success'))
    <div class="bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99;top:73px;left:0px">
        <div class="text-white alert mb-0 py-0">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
            <span>{{ $message }}</span>
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
                    <form action="{{url('studinsrt')}}" method="post" onsubmit="return valid()">
                    @csrf
                    <div class="row mx-0">
                        <div class="col-md-7 mt-2">
                            <label class="col-form-label font-size-14">
                                Student Name</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                               <img src="{{asset('assets/images/svg-icons/super-admin/student.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" name="name" id="sname" class="form-control" placeholder="Enter Student Name" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-md-5 mt-2">
                            <label class="col-form-label font-size-14">
                                Enrollment Number</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/student-dash/id.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" id="enrl" onkeyup="checkenrl()" name="enrl" class="form-control" placeholder="Enter Enrollment Number" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">
                                Roll no.</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/rollno.svg')}}" class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="number" name="rno"  id="rno" onkeyup="checkrno()"  class="form-control" placeholder="Enter Student's Roll no" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Class</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/class.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="text" id="clas" name="clas" onkeyup="checkrno()" class="form-control" placeholder="Enter Student's Class" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <label class="col-form-label font-size-14">Division</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/super-admin/split.svg')}}"
                                    class="ml-2 form-control-icon" height="20px" alt="">
                                <input type="number" id="div" name="div" class="form-control" placeholder="Enter Student's Divisions" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>
                    <div class="form-group row mx-0">
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">
                                Email</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input type="email" name="email" onkeyup="checkemail()"  id="email" class="form-control" placeholder="Enter Student's Email" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="col-form-label font-size-14">Contact No.</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="mobile" onkeyup="checkmobile()"  id="mobile" class="form-control" placeholder="Enter Student's Contact no" />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>

                    <div class="form-group mt-2 row mx-0">
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">
                                Select Gender</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <select name="gen" id="gen" class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="col-form-label font-size-14">Date Of Birth</label>
                            <div class="mb-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input type="date" name="dob" id="dob" class="form-control basicDate" placeholder="Date Of Birth" data-input />
                            </div>
                            <span class="text-danger font-weight-bold"></span>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <label class="col-form-label font-size-14">
                            Address</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="add" id="add" class="form-control" placeholder="Enter Student's Address" />
                        </div>
                        <span class="text-danger font-weight-bold"></span>
                    </div>
                    <div class="mt-3 mx-0 row justify-content-start align-items-center">
                        &nbsp;
                        <button type="submit" class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15 font-weight-bold ml-2 d-flex align-items-center" style="background-color: #35bbca;">
                            <span class="mr-1">Add Student</span>
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
        class="col-lg-4 col-md-5 col-sm-7 col-10 p-4 bg-light position-fixed new-shadow-2 rounded"
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
            <div class="d-flex align-items-center justify-content-between">
                <button type="submit"class="mt-3 upl btn btn-success px-3 new-shadow-sm hover-me-sm font-weight-bold rounded-sm">Upload</button>
                <a href="{{asset('demo')}}/studentrec.xlsx" class="font-weight-bold text-primary">Click to get excel file demo</a>
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
            '<label for="file-upload" class="custom-file-upload w-100 d-flex align-items-center justify-content-center overflow-auto"><i data-feather="upload" class="mt-2"></i><span class="mt-2 ml-2">Upload your excel file from here</span></label>'
            );
            feather.replace();
        $('#re-upload').hide();
    });
    $('.upl').click(function () {
        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
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
                enrl: enrl
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
            email: email
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
            mobile: mobile
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
            clas:clas
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
