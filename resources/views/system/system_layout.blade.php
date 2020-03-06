<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Evento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/my-extra.css')}}" rel="stylesheet">
    
    <link href="{{asset('assets/libs/multicheckbox/multiselect.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/system_admin_css.css')}}" rel="stylesheet">
    @section('head-tag-links')
    
    @show
</head> 

<body class="body-scroll pb-0">

    <!-- Begin page -->
    <div id="wrapper">
            <nav class="navbar position-fixed w-100 shadow-none" style="z-index:99!important;">
                <a href="/index" class="navbar-brand logo-position">
                    <img src="{{asset('assets/images/logo.png')}}" alt="" height="24" />
                    <span class="d-inline h2 text-dark font-weight-bold">Evento</span>
                </a>
                <div>
                    <a href="#" class="right-bar-toggle text-dark">
                        <i data-feather="grid" height="19px"></i>
                        <!-- <span class="noti-icon-badge"></span> -->
                    </a>
                    <a href="#" class="btn btn-default button-menu-mobile open-left text-dark mr-0">
                        <i data-feather="menu" class="menu-icon"></i>
                    </a>
                </div>
            </nav>
            <div class="left-side-menu bg-transparent shadow-none" style="top:10px;z-index:100!important;">
                    <div class="media user-profile d-flex flex-column align-items-center mt-5">
                        <img src="{{asset('assets/images/avatars/man.svg')}}" class="avatar-xl border rounded-circle bg-white d-block mx-auto" alt="User" />

                        <div class="media-body mx-auto mt-3 font-weight-bold text-center">
                            <a href="#" class="pro-user-name text-dark user-link font-size-16">
                                Maulik
                            </a>
                        </div>
                    </div>

                    <div class="sidebar-content">
                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
                            <ul class="metismenu" id="menu-bar">

                                <li class="my-3">
                                    <a href="{{url('/system')}}">
                                        <i class="text-dark uil uil-home-alt h5"></i>
                                        <span class="font-weight-bold">Dashboard</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/system_add_college')}}">
                                        <i class="text-dark uil uil-graduation-hat h5"></i>
                                        <span class="font-weight-bold">Add College</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/system_notice')}}">
                                        <i class="text-dark uil uil-envelope-add h5"></i>
                                        <span class="font-weight-bold">Demo Requests</span>
                                    </a>
                                </li>
                                <li class="my-3">
                                    <a href="{{url('/system_change_password')}}">
                                        <i class="text-dark uil uil-padlock h5"></i>
                                        <span class="font-weight-bold">Change Password</span>
                                    </a>
                                </li>
                                
                                <li class="mt-3">
                                    <a href="#" class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="text-dark uil uil-exit h5"></i>
                                        <span class="font-weight-bold">Log Out</span>
                                    </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- End Sidebar -->
                    </div>
                    <!-- Sidebar -left -->

            </div>


        <div class="content-page bg-white" style="border-radius:30px 0px 0px 0px;margin-top:63px;min-height:90vh;">
            <div class="content">
                @yield('my-content')
            </div>
        </div> <!-- content-page -->
    <div class="right-bar">
            <a href="#" class="d-flex d-sm-none float-right text-dark pr-2 position-relative" style="top:14px;" id="close-btn" onclick="window.location.reload()">
                <i data-feather="x-circle" height="18px"></i>
            </a>
        <div class="rightbar-title">
            
            <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-message-tab" data-toggle="pill" href="#pills-message" role="tab" aria-controls="pills-message"aria-selected="true">
                        <i class="uil uil-envelope-upload h5 text-muted"></i>
                        Notice
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="pill" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                        <i class="uil uil-user-square h5 text-muted"></i>
                        Profile
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-message" role="tabpanel" aria-labelledby="pills-message-tab">
                <form>
                @csrf
                    <label class="col-form-label font-size-15">Event for</label>
                        <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                        <select  multiple="multiple" name=""  class="form-control active w-100">
                            <option value="sutex">sutex</option>
                            <option value="s v patel">s v patel</option>
                            <option value="s s agarwal">s s agarwal</option>
                        </select>
                        </div>
                    <label class="col-form-label font-size-14">Notice Title</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" name="title" id="title" class="form-control"placeholder="Enter Notice Title..." />
                    </div>
                    <div class="form-group">
                        <label class="col-form-label font-size-14">Notice Content</label>
                        <div class="form-group w-100">
                            <textarea id="message" name="message" class="bg-light summernote"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="mt-2 btn  rounded-sm hover-me-sm px-3 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13 text-white" style="background-color: var(--success);">
                        Send
                        <i data-feather="send" height="18px"></i>
                    </button>
                </form>
                </div>
                <div class="tab-pane fade active overflow-auto my-scroll" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h5 class="text-center mb-0">Your Details</h5>
                <form>
                @csrf
                    <label class="col-form-label font-size-14">Name</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="sname" name="user_name" class="form-control" value="" />
                    </div>
                    <div id="name-er" class="text-danger font-weight-bold"></div>
                    <label class="col-form-label font-size-14">Email</label>
                    <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                        <input type="email" id="semail" name="user_email" class="form-control" value="" />
                    </div>
                    <div id="email-er" class="text-danger font-weight-bold"></div>
                    <label class="col-form-label font-size-14">Mobile No</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="smobile" name="user_mobile" class="form-control" value="" />
                    </div>
                    <div id="mobile-er" class="text-danger font-weight-bold"></div>
                    <label for="photo-upload" class="custom-file-upload rounded overflow-auto">
                        <i id="camera" height="19px" data-feather="camera"></i>
                        <span id="up" class="mx-2">Upload Picture</span>
                    </label>
                    <input id="photo-upload" name="photo-upload" type="file" />

                    <button type="submit" class="mt-2 btn  rounded-sm hover-me-sm px-3 font-weight-bold new-shadow-sm btn-sm py-2 font-size-13 text-white" style="background-color: var(--success);">
                        Save Details
                        <i data-feather="check-square" height="18px"></i>
                    </button>
                </form>
                </div>
            </div>

        </div>
    </div>
    <div class="rightbar-overlay"></div>



    </div> <!-- end wrapper tag -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/libs/multicheckbox/multiselect.js')}}"></script>

    <script src="{{asset('assets/libs/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['undo', 'redo', 'fullscreen']],
            ],
            placeholder: 'Enter Notice Content...'
        });
    </script>
    <script>
        $(document).ready(function() {
        $('select[multiple]').multiselect({
            columns: 1,
            placeholder: 'Select Class',
            selectAll: true
        });

        $('.ms-options').removeAttr('style');
        $('.ms-options').addClass('my-scroll');
    });
    </script>
    @section('extra-scripts')

    @show
</body>
</html>
