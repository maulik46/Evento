<?php use App\log ;?>

@extends('co-ordinates/cod_layout')

@section('title','Co-ordinator Profile')

@section('head-tag-links')
<style>
    .pattern-bg {
        background-image: url('../assets/images/pattern/p1.jpg');
        background-color: #b5e8ce;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 240px;
        border-radius: 0.6rem 0.6rem 0px 2rem;
    }

    .user-img {
        background: url('../profile_pic/<?php echo Session::get("cprofilepic")?>');
        background-size: cover;
        background-color:white;
        background-repeat: no-repeat;
        background-position: center;
        width: 180px;
        height: 180px;
        border-radius: 100%;
        position: relative;
        top: -225px;
        left: 50px;
        border: 5px solid #f6f6f6;
        
    }

    #upload-photo {
        display: none;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        cursor:pointer;
    }

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        height: 100%;
        width: 100%;
        text-align: center;
        cursor: pointer;
    }

    .cod-detail {
        position: relative;
        z-index: -1;
        left: 0px;
        top: -18px;
        border-radius: 0rem 0rem 0.6rem 2rem;
    }

    #update-profile {
        opacity: 0.5;
    }

    .pattern-bg:hover #update-profile {
        opacity: 1;
    }
    .left-timeline  .events .last-child::after{
        width:0px!important;
    }
    .left-timeline .events .last-child::before{
        border-radius:0px!important;
        background-color:var(--primary);
        height:15px;
        width:30px;
        border:3px solid #fff;
        left:-52px;
    }
    .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 15px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 40px;
        }

        /* box-shadow: 0 0 2px black; */

        .form-control:focus {
            border: 1px solid #d1d1d1 !important;
            background-color: #f3f4f7 !important;
        }
        .form-group{
            margin-bottom:0.3rem;
        }
        .my-scroll::-webkit-scrollbar-thumb{
            background-color:transparent;
        }

    @media(max-width:468px) {

        .user-img {
            transform: translate(-50%, -207%) !important;
        }

        .cod-name {
            font-size: 18px !important;
        }

        .cod-clg {
            font-size: 12px !important;
        }
    }

    @media(max-width: 768px) {
        .pattern-bg {
            height: 200px;
            border-radius: 0.3rem 0.3rem 0px 0px;
        }

        .user-img {
            width: 150px;
            height: 150px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -182%);
        }

        .cod-detail {
            border-radius: 0rem 0rem 0.6rem 0.6rem;
        }

        .cod-detail div {
            text-align: center !important;
        }
    }
</style>
<!-- text-center text-md-right -->
@endsection
@section('my-content')
@if(Session::has('success'))
           
           <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
               <div class="toast-body text-white alert mb-1">
                   <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                       <i data-feather="x-circle" height="18px" ></i>
                   </a>
                   <div class="mt-2 font-weight-bold font-size-14">
                       {{Session::get('success')}}
                   </div> 
                   
               </div>
           </div>
@endif
@if($errors->first('photo-upload'))
           
           <div class="toast bg-danger fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:99;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
               <div class="toast-body text-white alert mb-1">
                   <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                       <i data-feather="x-circle"  height="18px" ></i>
                   </a>
                   <div class="mt-2 font-weight-bold font-size-14">
                   {{$errors->first('photo-upload')}}
                   </div> 
                   
               </div>
           </div>
@endif
<div class="container-fluid">
    <div class="card pattern-bg mb-0 d-flex align-items-end justify-content-start">
        <!-- <a href="#profile-section" class="btn bg-white py-0 text-dark btn-sm badge-pill font-weight-bold m-1 m-sm-2 d-flex align-items-center hover-me-sm" id="update-profile" style="cursor:pointer;">
            <i data-feather="edit" height="15px"></i>
            <span>Update Profile</span>
        </a> -->
    </div>
    <div id="profile-section" class="card mb-0 py-3 py-sm-4  bg-white new-shadow-sm cod-detail">
        <div class="text-right px-0 px-sm-3">
            <div class="mt-2 mt-md-0 font-size-22 text-dark font-weight-bold cod-name">
                {{ucfirst(Session::get('cname'))}}
            </div>
            <div class="font-size-14 text-muted font-weight-bold cod-clg">{{ucfirst(Session::get('cclgname'))}}</div>
            <div class="mt-1">
                <span class="badge badge-soft-dark px-2" style="padding:0.1rem 0px;">
                    <i data-feather="mail" height="18px"></i>
                    {{Session::get('cemail')}}
                </span>
                <span class="badge badge-soft-dark px-2" style="padding:0.1rem 0px;">
                    <i data-feather="phone" height="18px"></i>
                    {{Session::get('cmobile')}}
                </span>
            </div>
        </div>
    </div>

    <div class="user-img new-shadow-2 d-flex align-items-end justify-content-center overflow-hidden">
        <div id="upload-photo" class="p-1 w-100 text-center" data-toggle="tooltip" data-placement="bottom"
            title="Upload Photo">
            <span class="rounded">
                <i data-feather="camera" height="20px"></i>
            </span>
           
        </div>
    </div>

    <div  class="row" style="margin-top:-160px!important;">
        <div class="col" >
            <div class="text-center card p-1 new-shadow-sm mb-2">
                <h4 class="ml-3">
                    <i data-feather="bar-chart-2" class="icon-dual"></i>
                    My Activity
                </h4>
            </div>
            <div class="left-timeline pl-1 pl-sm-3 overflow-auto my-scroll bg-light rounded pt-2 new-shadow-sm" style="max-height:400px;">
            <ul class="list-unstyled events">
                <?php
                    $activity=log::where([['uid',Session::get('cid')],['utype','co-ordinator']])->whereNotIn('action_on', ['login','logout'])->orderBy('time','desc')->get();
                    $a=0;
                ?>
                @foreach($activity as $act)
                <?php $a=1;?>
                    <li class="event-list">
                        <div>
                            <div class="media">
                                <div class="event-date text-center mr-1 mr-sm-3">
                                    <div class="bg-soft-primary badge mt-2 font-size-13">
                                        <span class="avatar-title text-primary font-weight-semibold">
                                            {{date('d M Y',$act['time'])}}
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body mt-2">
                                    <div class="card d-inline-block new-shadow-sm">
                                        <div class="card-body p-3">
                                            <h5 class="mt-0">{{$act['action_on']}}</h5>
                                            <span class="text-muted">{!! $act['descr'] !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
                @if($a==1)    
                    <!-- dont touch me -->
                    <li class="event-list last-child"></li>
                    <!-- i said don't touch me :( -->
                @endif
            </ul>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0" id="update-form">
            <div class="card new-shadow-sm">
                
                <div class="card-body">
                    <h4 class="text-center mt-0 mb-3">
                        <i data-feather="edit" height="22px"></i>
                        Update Details
                    </h4>
                    <form method="post" onsubmit="return valid()" action="{{url('cod_profile/updateprofile')}}">
                    @csrf
                    <input type="hidden" name="cid" class="form-control" value="{{ucfirst(Session::get('cid'))}}" />
                        <label class="col-form-label font-size-14">Name</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" class="form-control" id="cname" name="cname" value="{{ucfirst(Session::get('cname'))}}" />
                                
                        </div>
                        <div class="text-danger font-weight-bold" id="cname-err"></div>
                        <label class="col-form-label font-size-14">Email</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" class="form-control" id="cemail" name="cemail" value="{{Session::get('cemail')}}" />
                                
                        </div>
                        <div class="text-danger font-weight-bold" id="email-err"></div>
                        <label class="col-form-label font-size-14">Mobile No</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" id="mobile" class="form-control" name="mobile" value="{{Session::get('cmobile')}}" />
                           
                        </div>
                        <div id="mobile-err" class="text-danger font-weight-bold"></div>
                        <button type="submit" class="mt-2 btn btn-success rounded-sm hover-me-sm px-2 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13">
                            <i data-feather="check-square" height="18px"></i>
                            Update Details
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div id="profile-form-modal"
        class="col-lg-4 col-md-5 col-sm-7 col-10 p-4 bg-light position-fixed new-shadow-2 rounded"
        style="top: 50%;left: 50%;transform: translate(-50%, -40%);display:none;z-index:9999;">
        <a href="#" id="close-upload-form" class="mb-3 d-flex justify-content-end text-dark" style="margin-top:-10px;">
            <i data-feather="x-circle" id="close-btn" height="18px"></i>
        </a>
        <form action="{{ url('update_propic') }}" method="POST" name="importform" enctype="multipart/form-data">
        @csrf
            <div class="card new-shadow-sm hover-me-sm mb-0" id="upload-plus-btn">
                <label for="file-upload"
                    class="custom-file-upload w-100 d-flex align-items-center justify-content-center overflow-auto">
                    <i data-feather="upload" class="mt-2"></i>
                    <span class="mt-2 ml-2">Upload your photo from here</span>
                </label>
                <input id="file-upload" name="photo-upload" type="file" />
            </div>
            <div class="text-center mt-3" style="cursor:pointer;" id="re-upload">
                <i data-feather="refresh-cw" id="close-btn"></i>
            </div>
            <button type="submit"
                class="mt-3 upl btn btn-success px-3 new-shadow-sm hover-me-sm font-weight-bold rounded-sm">Upload</button>
        </form>
    </div>
</div>
@endsection
@section('extra-scripts')
<script>
function valid()
{
    
     var f=0;
    var regex = /^[A-Za-z\.\s]+$/;
     if(!regex.test($('#cname').val()))
    {
        $('#cname-err').text("Please enter valid name");
        f=1;
    }
    else{
        $('#cname-err').text("");
    }

    regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if($('#cemail').val()=="")
    {
        $('#email-err').text("Please enter email");
        f=1;
    }
    else if(!regex.test($('#cemail').val()))
    {
        
        $('#email-err').text("Invalid email Address");
        f=1;
    }
    else{
        $('#email-err').text("");
    }
    regex = /^\d*(?:\.\d{1,2})?$/; 
    var mo= $('#mobile').val();
    if($('#mobile').val()=="")
    {
        $('#mobile-err').text("Please enter Mobile no.");
        f=1;
    }
    else if(!(regex.test($('#mobile').val()) && mo.length == 10))
    {
        $('#mobile-err').text("Please enter valid Mobile no.");
        f=1;
    }
    else{
        $('#mobile-err').text("");
    }
    if(f==1)
    {
        return false;
    }
}
    $(document).ready(function(){
        
    $('.user-img').hover(function () {
        $('#upload-photo').fadeToggle(250);
    });
       
    });
    $('#upload-photo').click(function () {
        $('#profile-form-modal').fadeIn(150);
    });
    $('#close-upload-form').click(function () {
        $('#profile-form-modal').fadeOut(180);
    });
    $('#re-upload').hide();
    $('#re-upload').click(function () {
        $('.custom-file-upload').remove();
        $('#upload-plus-btn').prepend(
            '<label for="file-upload" class="custom-file-upload w-100 d-flex align-items-center justify-content-center overflow-auto"><i data-feather="upload" class="mt-2"></i><span class="mt-2 ml-2">Upload your photo from here</span></label>'
            );
        feather.replace();
        $('#re-upload').hide();
    });
    $('#file-upload').change(function () {

        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $(this).prev('label').text(file).css({
            "margin-top": "4px",
            "color": "var(--success)"
        });
        $('#re-upload').show();


    });
    

</script>

@endsection
