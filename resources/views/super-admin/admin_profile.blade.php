@extends('super-admin/s_admin_layout')

@section('title','My Profile')

@section('head-tag-links')
<style>
    .pattern-bg {
        background-image: url('../assets/images/pattern/p2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        height: 240px;
        border-radius: 0.6rem 0.6rem 0px 2rem;
    }

    .user-img {
        background: url('../assets/images/pattern/user.jpg');
        background-size: cover;
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
    }

    input[type="file"] {
        display: none;
    }

    .custom-file-upload {
        heigh: 100%;
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
            border-radius: 0.3rem 0.3rem 0px 1rem;
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
<div class="container-fluid">
    <div class="card pattern-bg mb-0 d-flex align-items-end justify-content-start">
        <a href="#cod-section" class="btn bg-white py-0 text-dark btn-sm badge-pill font-weight-bold m-1 m-sm-2 d-flex align-items-center hover-me-sm" id="update-profile" style="cursor:pointer;">
            <i data-feather="edit" height="15px"></i>
            <span>Update Profile</span>
        </a>
    </div>
    <div id="cod-section" class="card mb-0 py-3 py-sm-4  bg-white new-shadow-sm cod-detail">
        <div class="text-right px-0 px-sm-3">
            <div class="mt-2 mt-md-0 font-size-22 text-dark font-weight-bold cod-name">MR. Dishant Sakariya</div>
            <div class="font-size-14 text-muted font-weight-bold cod-clg">Sutex Bank College Of Computer Applications &
                Science </div>
            <div class="mt-1">
                <span class="badge badge-soft-dark px-2" style="padding:0.1rem 0px;">
                    <i data-feather="mail" height="18px"></i>
                    dishantsakariya@gmail.com
                </span>
                <span class="badge badge-soft-dark px-2" style="padding:0.1rem 0px;">
                    <i data-feather="phone" height="18px"></i>
                    9685741230
                </span>
            </div>
        </div>
    </div>

    <div class="user-img new-shadow-2 d-flex align-items-end justify-content-center overflow-hidden">
        <div id="upload-photo" class="p-1 w-100 text-center" data-toggle="tooltip" data-placement="bottom"
            title="Upload Photo">
            <label for="file-upload" class=" custom-file-upload rounded">
                <i data-feather="camera" height="20px"></i>
            </label>
            <input id="file-upload" name="" type="file" />
        </div>
    </div>

    <div  class="row" style="margin-top:-160px!important;">
        <div class="col">
            <div class="card p-1 new-shadow-sm">
                <h4 class="ml-3">
                    <i data-feather="bar-chart-2" class="icon-dual"></i>
                    My Activity
                </h4>
            </div>
            <div class="left-timeline pl-1 pl-sm-3">
                <ul class="list-unstyled events">
                    <li class="event-list">
                        <div>
                            <div class="media">
                                <div class="event-date text-center mr-1 mr-sm-3">
                                    <div class="bg-soft-primary badge mt-2 font-size-13">
                                        <span class="avatar-title text-primary font-weight-semibold">
                                            02 Jun 2020
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body mt-2">
                                    <div class="card d-inline-block new-shadow-sm">
                                        <div class="card-body p-3">
                                            <h5 class="mt-0">Event One</h5>
                                            <span class="text-muted">It will be as simple as occidental in fact it will be Occidental Cambridge friend</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="event-list">
                        <div>
                            <div class="media">
                                <div class="event-date text-center  mr-1 mr-sm-3">
                                    <div class="bg-soft-primary badge mt-2 font-size-13">
                                        <span class="avatar-title text-primary font-weight-semibold">
                                            02 Jun 2020
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body mt-2">
                                    <div class="card d-inline-block new-shadow-sm">
                                        <div class="card-body p-3">
                                            <h5 class="mt-0">Event One</h5>
                                            <span class="text-muted">It will be as simple as occidental in fact it will be Occidental Cambridge friend</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    
                    <!-- dont touch me -->
                    <li class="event-list last-child"></li>
                    <!-- i said don't touch me :( -->
                    

                </ul>
            </div>
        </div>
        <div class="col-lg-5 mt-4 mt-lg-0" id="update-form">
            <div class="card new-shadow-sm">
                <span class="text-right p-1 px-2" id="close-form">
                    <i data-feather="x-circle" id="close-btn" height="18px" class="text-dark" style="cursor:pointer;"></i>
                </span>
                <div class="card-body">
                    <h4 class="text-center mt-0 mb-2">
                        Update Details
                    </h4>
                    <form>
                        <label class="col-form-label font-size-14">Name</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" class="form-control" value="Mr. Dishant Sakariya" />
                        </div>
                        <label class="col-form-label font-size-14">Email</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" class="form-control" value="dishantsakariya@gmail.com" />
                        </div>
                        <label class="col-form-label font-size-14">Mobile No</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" class="form-control" value="9685741230" />
                        </div>
                        <button type="submit" class="btn btn-success rounded-sm hover-me-sm px-2 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13">
                            <i data-feather="check-square" height="18px"></i>
                            Update Details
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
@section('extra-scripts')
<script>
    $(document).ready(function(){
        $('#update-form').hide();
        $('.user-img').hover(function () {
            $('#upload-photo').fadeToggle(250);
        });
        $('#update-profile').click(function(){
             $('#update-form').fadeIn(200);
        });
        $('#close-form').click(function(){
             $('#update-form').fadeOut(200);
        });

    });
    

</script>

@endsection