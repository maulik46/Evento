<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Create Notice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">


    <!-- App css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- extra css  -->
    <link rel="stylesheet" type="text/css" href="../assets/css/my-extra.css">
    <style>
        .profile-dropdown-items {
            width: 200px;
        }

        .content-page {
            margin: 50px 0px !important;

        }

        #event-info p {
            margin: 22px 0px;
        }

        #close-btn:hover {
            color: #ff5c75;
        }

        .form-control {
            border-radius: .15rem;
            background-color: #f3f4f7 !important;
            padding: 10px 15px;
            border: 1px solid #f3f4f7 !important;
            font-size: 1.1em;
            color: #333 !important;
            height: 50px;
            cursor: text !important;
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
            border: 1px solid gainsboro;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #35bbca;
        }
    </style>
</head>

<body data-layout="topnav" class="body-scroll">
    <!-- Begin page -->
    <div class="wrapper">

        <!-- Topbar Start -->
         <div class="navbar navbar-expand flex-column flex-md-row navbar-custom position-fixed w-100 new-shadow-sm">
             <div class="container-fluid">
                 <!-- LOGO -->
                 <a href="index.html" class="navbar-brand mx-2">
                     <span class="logo-lg">
                         <img src="../assets/images/logo.png" alt="" height="24" />
                         <span class="d-inline h3 font-weight-bold">Evento</span>
                         <h6 class="my-0 text-muted font-size-12 d-sm-none d-md-none" style="margin-left: 30px;">
                             Super-admin</h6>
                     </span>
                 </a>

                 <ul class="navbar-nav flex-row ml-auto d-flex list-unstyled topnav-menu float-right mb-0">

                     <li class="dropdown notification-list align-self-center profile-dropdown">
                         <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                             aria-haspopup="false" aria-expanded="false">
                             <div class="media user-profile ">
                                 <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image"
                                     class="align-self-center" />
                                 <div class="media-body text-left d-none d-sm-block">
                                     <h6 class="ml-2 my-0">
                                         <span>Mr.Yash Parmar</span>
                                         <span class="text-muted d-block font-size-12 mt-1">
                                             Super-admin
                                         </span>
                                     </h6>
                                 </div>
                                 <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                             </div>
                         </a>
                         <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                             <div class="media dropdown-item d-sm-none d-md-none">
                                 <img src="../assets/images/svg-icons/super-admin/man1.svg" alt="user-image"
                                     height="40px" class="align-self-center" />
                                 <div class="media-body text-left">
                                     <h6 class="ml-2 my-0">
                                         <span>Mr.Yash Parmar</span>
                                         <span class="text-muted d-block font-size-12 mt-1">
                                             Co-ordinator
                                         </span>
                                     </h6>
                                 </div>
                             </div>

                             <div class="dropdown-divider d-sm-none d-md-none"></div>
                             <a href="newindex.html" class="dropdown-item notify-item mb-2">
                                 <i data-feather="home" class="icon-dual-primary icon-xs mr-2"></i>
                                 <span>Home</span>
                             </a>
                             <a href="newevent.html" class="dropdown-item notify-item my-2">
                                 <i data-feather="user-plus" class="icon-dual-success icon-xs mr-2"></i>
                                 <span>Add Co-ordinator</span>
                             </a>
                             <a href="new_notice.html" class="dropdown-item notify-item my-2">
                                 <i data-feather="edit-3" class="icon-dual-warning icon-xs mr-2"></i>
                                 <span>Create Notice</span>
                             </a>
                             <a href="#" class="dropdown-item notify-item my-2">
                                 <i data-feather="key" class="icon-dual-info icon-xs mr-2"></i>
                                 <span>Change Password</span>
                             </a>

                             <div class="dropdown-divider"></div>

                             <a href="#" class="dropdown-item notify-item">
                                 <i data-feather="log-out" class="icon-dual-danger icon-xs mr-2"></i>
                                 <span>Logout</span>
                             </a>
                         </div>
                     </li>
                 </ul>
             </div>

         </div>
        <!-- end Topbar -->

        <div class="content-page">
            <div class="content d-flex justify-content-center">
                <div class="container-fluid col-xl-6 col-lg-8 col-md-8">
                    <div class="card mt-5 new-shadow rounded-lg">
                        <div class="card-body px-lg-4">
                            <a href="index.html" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <h3 class="my-4 text-center text-dark">
                                <img src="../assets/images/svg-icons/co-ordinate/writing.svg" height="25px" alt="">
                                <span> Create new notice</span>
                            </h3>
                            <div class="text-center font-weight-bold text-danger" id="error">{{$errors->first('attachment')}}</div>
                            <form action="admin-noticesend" method="post" onsubmit="return check()" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center" style="margin-bottom: -10px;">
                                    <div class="form-group mt-2 col-lg-8">
                                        <label class="col-form-label font-size-14">Notice Title</label>
                                         <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Notice Title..." />
                                        </div>
                                    </div>
                                    <div class="form-group mt-2 col-lg-4">
                                        <label class="col-form-label font-size-14">Notice for</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                            <select name="nfor" id="nfor" class="form-control custom-select">
                                                <option value="" hidden>Notice for</option>
                                                <option value="coordinator">Co-ordinator</option>
                                                <option value="students">Students</option>
                                                <option value="student-coordinator">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label font-size-14">Notice Content</label>
                                    <div class="form-group has-icon d-flex">
                                          <i data-feather="edit" class="form-control-icon ml-2" height="19px" style="margin-top: 13px;"></i>
                                        <textarea id="message" name="message" class="form-control" rows="6"
                                            placeholder="Enter Notice Content..."></textarea>
                                    </div>
                                </div>
                                <div class="row justify-content-start align-items-center">

                                    <button type="submit"
                                        class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-4 font-size-15
                                        font-weight-bold
                                        ml-3" style="background-color: #35bbca;">
                                        <span>Send</span>
                                        <i data-feather="send" height="20px"></i>
                                    </button>
                                    <div class="ml-2 mt-1">
                                        <!-- file upload button -->
                                        <label for="file-upload" class="hover-me-sm custom-file-upload rounded-sm"
                                            data-toggle="tooltip" data-placement="right" title="Attachment">
                                            <i data-feather="paperclip"></i>
                                        </label>

                                        <input id="file-upload" name="attachment[]" type="file" multiple onChange="FileDetails()"/>
                                        <!-- file upload end -->
                                    </div>

                                </div>
                                <div class="mt-3 p-1" id="fc" >
                               
                               </div>                             
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    function check()
    {
        if($('#title').val()=="")
        {
            $('#error').text("Please enter notice title..");
            return false;
        }
        
        if($('#message').val()=="")
        {
            $('#error').text("Please put your message..");
            return false;
        }
        if($('#nfor').val()=="")
        {
            $('#error').text("Please select Receiver..");
            return false;
        }
        
    }
</script>
<script>
   function FileDetails() {

// GET THE FILE INPUT.
var fi = document.getElementById('file-upload');

// VALIDATE OR CHECK IF ANY FILE IS SELECTED.
if (fi.files.length > 0) {

    // THE TOTAL FILE COUNT.
    $('#fc').css("border","1px solid #d2d8de");
    document.getElementById('fc').innerHTML =
        '<div class="d-flex justify-content-center align-items-center mr-2" style="margin-top:-12px;"><span class="badge badge-dark px-3 py-1 badge-pill">Total Files: <b>' + fi.files.length + '</b></span></div>';

    // RUN A LOOP TO CHECK EACH SELECTED FILE.
    document.getElementById('fc').innerHTML =
            document.getElementById('fc').innerHTML + ' <div class="mt-2 col-xl-12 row" id="fl">';
    for (var i = 0; i <= fi.files.length - 1; i++) {

        var fname = fi.files.item(i).name;      // THE NAME OF THE FILE.
        var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.

        // SHOW THE EXTRACTED DETAILS OF THE FILE.
        document.getElementById('fl').innerHTML =
            document.getElementById('fl').innerHTML + '<div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;"> <span class="text-dark col-8">'+ fname +'</span><span class="badge badge-light px-3 badge-pill mr-2 col-4">' + (fsize/1024).toFixed(2) + 'KB</span></div>';
        }
     
    }
}
</script>

    <script src="../assets/js/jquery.min.js"></script>
    <!-- Vendor js -->
    <script src="../assets/js/vendor.min.js"></script>

    <!-- optional plugins -->
    <script src="../assets/libs/moment/moment.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
</body>

</html>