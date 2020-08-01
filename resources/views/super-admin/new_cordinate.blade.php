@extends('super-admin/s_admin_layout')

@section('title','Create Co-ordinator')

@section('head-tag-links')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />

    <style>
        label{
            color:var(--dark);
        }
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
            height:140px;
            overflow:auto;
        }
        .nice-select .option.selected.focus {
            background-color: #f3f4f7;
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

        /* box-shadow: 0 0 2px black; */

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }

        .border-form {
            border: 1px solid #d1d1d152;
            border-radius: .5rem;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 2px solid #f3efef;
            height:100%;
            width:100%;
            text-align:center;
            padding: 6px 10px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #43d39e;
        }

        .my-avatar input[type="checkbox"][class="myCheckbox"] {
        display: none;
        }

        .my-avatar label {
        border: 2px solid #f3efef;
        display: flex;
        position: relative;
        cursor: pointer;
        padding:2px;
        border-radius:8px;
        }

        .my-avatar label img {
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        }

        :checked + label {
        border-color: var(--info);
        background-color: rgba(37,194,227,.15);
        /* border-radius:8px; */
        }

        :checked + label:before {
        content: "";
        transform: scale(1);
        }

        :checked + label img {
        transform: scale(0.95);
        }
        @media(max-width:568px)
        {
            .my-avatar img{
                height:38px;
            }
        }
    </style>
@endsection
@section('my-content')
            <div class="content d-flex justify-content-center">
                <div class="container-fluid col-xl-8 col-lg-10 col-md-11 col-sm-12">
                    <div class="card new-shadow rounded-lg mt-2">
                        <div class="card-body px-lg-3">
                            <a href="{{url('/sindex')}}" class="d-flex justify-content-end text-dark">
                                <i data-feather="x-circle" id="close-btn" height="18px"></i>
                            </a>
                            <h4 class="my-3 text-dark d-flex align-items-center justify-content-center">
                                <i data-feather="user-plus"></i>
                                <span class="ml-2">Add new Co-ordinator</span>
                            </h4>
                            <form action="{{url('/new_cod_add')}}" onsubmit="return getMessage()" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="col-md-12 mt-2  px-sm-2 px-0">
                                        <label class="col-form-label font-size-14">Co-ordinator Name</label>
                                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Co-ordinator Name" id="cname" name="cname" />
                                        </div>
                                        <span class="text-danger font-weight-bold"></span>
                                    </div>
                                    
                                    <div class="col-md-12 px-sm-2 px-0">
                                    <label class="col-form-label font-size-14">Select Avatar</label>
                                    <div class="row justify-content-between align-items-center align-items-md-end mx-0 mx-sm-0">
                                    <div class="col-lg-4 col-md-12 col-12 px-sm-2 px-0">
                                        <div class="pt-0">
                                        
                                            <label for="photo-upload" class="custom-file-upload rounded overflow-auto">
                                                <i id="camera" data-feather="camera"></i>
                                                <span id="up" class="mx-2">Upload Picture</span>
                                            </label>

                                            <input id="photo-upload" name="photo-upload" type="file" />
                                        </div>
                                
                                        <span class="text-danger font-weight-bold"></span>
        
                                    
                                    </div>
                                    
                                    <div class="col-lg-8 col-md-12 col-sm-12 row justify-content-around justify-content-sm-between mx-sm-0 px-sm-2 px-0 ml-0">
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox1" value="child (1).svg"/>
                                            <label for="myCheckbox1">
                                            <img src="{{asset('assets/images/avatars/child (1).svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox2" value="child.svg"  />
                                            <label for="myCheckbox2">
                                            <img src="{{asset('assets/images/avatars/child.svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox3" value="girl.svg"  />
                                            <label for="myCheckbox3">
                                            <img src="{{asset('assets/images/avatars/girl.svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox4" value="professor.svg"/>
                                            <label for="myCheckbox4">
                                            <img src="{{asset('assets/images/avatars/professor.svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox5" value="teacher.svg" />
                                            <label for="myCheckbox5">
                                            <img src="{{asset('assets/images/avatars/teacher.svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        <div class="my-avatar">
                                            <input type="checkbox" name="avatar" class="myCheckbox" id="myCheckbox6" value="woman.svg" />
                                            <label for="myCheckbox6">
                                            <img src="{{asset('assets/images/avatars/woman.svg')}}" height="55px" />
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <span class="text-danger font-weight-bold" id="validphoto"></span>
                                    </div>
                                    </div>
                               
                                
                                <div class="form-group row mx-0 mx-sm-0 px-sm-2">
                                    <div class="col-sm-12 col-md-6 px-sm-2 px-0">
                                        <label class="col-form-label font-size-14">
                                        Email</label>
                                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                                           <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control"  placeholder="Enter Co-ordinator's Email" id="email" name="email" onkeyup="return ccheck()" />
                                        </div>
                                        <span class="text-danger font-weight-bold"></span>
                                    </div>
                                    <div class="col-sm-12 col-md-6 px-sm-2 px-0">
                                        <label class="col-form-label font-size-14">Contact No.</label>
                                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                                           <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Co-ordinator's Contact no" id="cno" name="cno" onkeyup="return ccheck()"/>
                                        </div>
                                        <span class="text-danger font-weight-bold"></span>
                                    </div>
                                   
                                </div>

                                <div class="form-group mt-2 row mx-0 mx-sm-0 ">
                                    <div class="col-sm-6 px-sm-2 px-0">
                                        <label class="col-form-label font-size-14">Event Catagory</label>
                                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                                           <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                           <?php $cat=\DB::table('tblcategory')->where('clgcode',Session::get('aclgcode'))->get()?>
                                               <select class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;" id="cocategory" name="category" >
                                                   <option value="">Event Catagory</option>
                                                   @foreach($cat as $c)
                                                   <option value="{{$c->category_id}}">{{$c->category_name}}</option>
                                                   @endforeach
                                               </select>
                                        </div>
                                        <span class="text-danger font-weight-bold"></span>
                                    </div>
                                    <div class="col-sm-6 px-sm-2 px-0">
                                        <label class="col-form-label font-size-14">Password</label>
                                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                                           <i data-feather="key" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" style="letter-spacing: 5px;"
                                                value="<?php echo uniqid() ?>" readonly name="pass" />
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="mt-0 mx-0 row justify-content-start align-items-center">
                                    &nbsp;
                                    <button type="submit"
                                        class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15
                                        font-weight-bold" style="background-color: #35bbca;">
                                        <span>Create</span>
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
<script>
    function ccheck() {
        var email = $('#email').val();
        var cno = $('#cno').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            type: 'POST',
            url: 'c_check',
            data: {
                email: email,
                cno: cno
            },
            success: function (data) {
                
                if (data.email > 0) {
                    $('#email').addClass('border border-danger');
                    $('#email').parent().next().text("Email already exist");
                } 
                else {
                    $('#email').parent().next().text("");
                    $('#email').removeClass('border border-danger');
                }
                if (data.phoneno > 0) {
                    $('#cno').addClass('border border-danger');
                    $('#cno').parent().next().text("Mobile number already exist");
                } 
                else {
                    $('#cno').parent().next().text("");
                    $('#cno').removeClass('border border-danger');
                }
            },
            error: function (data) {
            console.log(data);
            }
        })
}
     $('#photo-upload').on('change', function() { 
        var fileName=document.getElementById('photo-upload').value;
        var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
        const size =  
               (this.files[0].size / 1024).toFixed(2); 
        if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "svg" || ext == "SVG" || ext == "png" || ext == "PNG")
        {
            if (size > 1024 ) { 
                $('#validphoto').text("File must be less than 1 MB");
                sessionStorage.setItem('file',1);
            } else { 
                $('#validphoto').text( 'This file size is: ' + size + ' KB');  
                sessionStorage.setItem('file',0);            
            }   
        }
        else
        {            
            $('#validphoto').text('File Extension must be jpg,jpeg,svg and png format...!');    
            sessionStorage.setItem('file',1);
        }
}); 
    function getMessage() {
        var f = 0;
        var check = 0;
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var phoneno = /^\d{10}$/;
        var regex = /^[A-Za-z\.\s]+$/;
        $('*').removeClass('border border-danger');
        if ($('#cname').val() == "") {
            $('#cname').parent().addClass('border border-danger');
            $('#cname').parent().next().text("Please enter Co-ordinator Name");
            f = 1;
        } 
        else if(!regex.test($('#cname').val()))
        {
            $('#cname').parent().addClass('border border-danger');
            $('#cname').parent().next().text("Please enter valid Co-ordinator Name");
            f = 1;
        }
        else {
            $('#cname').parent().next().text("");
        }
        if($('#photo-upload').val()=="")
        {
            var c=document.getElementsByTagName('input');
            for (var i = 0; i<c.length; i++){
                if (c[i].type=='checkbox')
                {
                    if (c[i].checked){
                        check=0;
                        //alert(c[i].value);
                        break;
                    }
                    else{
                        check=1;
                    }
                }
            }
            if(check == 1)
            {
              
                $('#validphoto').text("Please Select Profile image");
                f=1;
            }
            else{
                $('#validphoto').text("");
            }
            
        }
        if( sessionStorage.getItem('file') == 1)
        {
                f=1;
        }
        if ($('#email').val() == "") {
            $('#email').parent().addClass('border border-danger');
            $('#email').parent().next().text("Please enter email id");
            f = 1;
        } 
        else if(!emailPattern.test($('#email').val()))
        {
            $('#email').parent().addClass('border border-danger');
            $('#email').parent().next().text("Please enter Proper Email id");
            f = 1;
        }
        else if($('#email').parent().next().text()=="Email already exist")
        {
            f = 1;
        }
        else {
            $('#email').parent().next().text("");
        }

        if ($('#cno').val() == "") {
            $('#cno').parent().addClass('border border-danger');
            $('#cno').parent().next().text("Please Enter Content no");
            f = 1;
        } 
        else if (!phoneno.test($('#cno').val())) {
            $('#cno').parent().addClass('border border-danger');
            $('#cno').parent().next().text("Please enter valid mobile number");
            f = 1;
        }
        else if ($('#cno').parent().next().text() == "Mobile number already exist")
        {
            f = 1;
        }
        else {
            $('#cno').parent().next().text("");
        }

        if ($('#cocategory').val() == "") {
            $('#cocategory').parent().addClass('border border-danger');
            $('#cocategory').parent().next().text("Please select event category");
            f = 1;
        } 
        else {
            $('#cocategory').parent().next().text("");
        }
        if (f == 1) {
            return false;
        }
}
$(document).ready(function() {
        // this is for select tag
        $('.select-me').niceSelect();
        $('.nice-select .list').addClass('my-scroll');
        // end here
});
</script>
    <script>
    $(document).ready(function() {
       
            $('#photo-upload').click(function(){
                if($('.myCheckbox').is(":checked"))
                {
                    $('#photo-upload').prop("disabled", true);
                    // $('#photo-upload').val('');
                }
                else {
                    $('#photo-upload').removeAttr("disabled");
                    
                }
                
            });
       
            $('.myCheckbox').change(function(){
                
                if($('#photo-upload').prop("disabled", true))
                {
                    $('#photo-upload').removeAttr("disabled");  

                }

                if($('.myCheckbox').is(":checked")){
                    $('.custom-file-upload').css('color','lightgray'); 
                    $('#photo-upload').val('');
                    $('#validphoto').text("");
                }
                else{
                    
                    $('.custom-file-upload').empty();
                    $('.custom-file-upload').html('<i id="camera" data-feather="camera"></i><span id="up">&nbsp;&nbsp; Upload Picture</span>&nbsp;&nbsp; ').css('color','var(--dark-gray)'); 
                    feather.replace();

                }
               
            });
            
            $('#photo-upload').change(function(){
                if($('#photo-upload').val() !="")
                {
                    $('#up,#camera').hide();
                    // var i = $(this).prev('label').clone();
                    var file = $('#photo-upload')[0].files[0].name;
                    $('.custom-file-upload').text(file);
                    // $('.myCheckbox').prop("disabled", true);
                }
            });

            $('h4').click(function(){
                alert($('#photo-upload').val());
            })

    });
    </script>
    <script>
    // to create avatar as checkbox
        $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        });
   
    </script>
@endsection
