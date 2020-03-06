@extends('super-admin/s_admin_layout')

@section('title','Create Notice')

@section('head-tag-links')
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css" />
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

    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7 !important;
        font-size: 1.1em;
        color: #333 !important;
        height: 50px;
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
        margin-top: 5px;
    }

    .custom-file-upload:hover {
        color: #35bbca;
    }
    .note-editor.note-frame .note-editing-area .note-editable {
        padding:10px 20px;
    }
  
</style>
@endsection
@section('my-content')
<div class="content d-flex justify-content-center">
    <div class="container-fluid col-xl-6 col-lg-8 col-md-8">
        <div class="card new-shadow rounded-lg">
            <div class="card-body px-lg-4">
                <a href="{{url('sindex')}}" class="d-flex justify-content-end text-dark">
                    <i data-feather="x-circle" id="close-btn" height="18px"></i>
                </a>
                <h4 class="my-2 mb-3 text-center text-dark">
                    <img src="../assets/images/svg-icons/co-ordinate/writing.svg" height="20px" alt="">
                    <span> Create new notice</span>
                </h4>
                <div class="text-center font-weight-bold text-danger" id="error">{{$errors->first('attachment')}}</div>
                <form action="admin-noticesend" method="post" onsubmit="return check()" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center align-items-center">
                        <div class="form-group col-lg-8 my-0">
                            <label class="col-form-label font-size-14">Notice Title</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter Notice Title..." />
                            </div>
                        </div>
                        <div class="form-group col-lg-4 my-0">
                            <label class="col-form-label font-size-14">Notice for</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                <select name="nfor" id="nfor" class="form-control select-me w-100 py-1">
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
                        <div class="form-group w-100">
                            <textarea id="message" name="message" class="bg-light summernote"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-start align-items-center" style="margin-bottom: -25px;">
                        <button type="submit" class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-4 font-size-15
                                        font-weight-bold
                                        ml-3" style="background-color: #35bbca;">
                            <span>Send</span>
                            <i data-feather="send" height="20px"></i>
                        </button>
                        <div class="ml-2 my-1">
                            <!-- file upload button -->
                            <label for="file-upload" class="hover-me-sm custom-file-upload rounded-sm"
                                data-toggle="tooltip" data-placement="right" title="Attachment">
                                <i data-feather="paperclip"></i>
                            </label>

                            <input id="file-upload" name="attachment[]" type="file" multiple onChange="FileDetails()" />
                            <!-- file upload end -->
                        </div>

                    </div>
                    <div class="mt-4 p-1 rounded-lg" id="fc">

                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
@section('extra-scripts')
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

<script src="{{asset('assets/libs/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $('.summernote').summernote({
        tabsize: 2,
        height: 120,
        toolbar: [
            ['font', ['bold', 'underline', 'clear', 'fontsize', 'height']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['undo', 'redo', 'fullscreen']],
        ],
        placeholder: 'Enter Notice Content...'
    });
</script>
<script>
    $(document).ready(function () {
        $('.select-me').niceSelect();
    });
</script>
<script>
    function check() {
        if ($('#title').val() == "") {
            $('#error').text("Please enter notice title..");
            return false;
        }

        if ($('#message').val() == "") {
            $('#error').text("Please enter your message..");
            return false;
        }
        if ($('#nfor').val() == "") {
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
            $('#fc').css("border", "1px solid #d2d8de");
            document.getElementById('fc').innerHTML =
                '<div class="d-flex justify-content-center align-items-center mr-2" style="margin-top:-12px;"><span class="badge badge-dark px-3 py-1 badge-pill">Total Files: <b>' +
                fi.files.length + '</b></span></div>';

            // RUN A LOOP TO CHECK EACH SELECTED FILE.
            document.getElementById('fc').innerHTML =
                document.getElementById('fc').innerHTML + ' <div class="mt-2 col-xl-12 row" id="fl">';
            for (var i = 0; i <= fi.files.length - 1; i++) {

                var fname = fi.files.item(i).name; // THE NAME OF THE FILE.
                var fsize = fi.files.item(i).size; // THE SIZE OF THE FILE.

                // SHOW THE EXTRACTED DETAILS OF THE FILE.
                document.getElementById('fl').innerHTML =
                    document.getElementById('fl').innerHTML +
                    '<div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;"> <span class="text-dark col-8">' +
                    fname + '</span><span class="badge badge-light px-3 badge-pill mr-2 col-4">' + (fsize / 1024)
                    .toFixed(2) + 'KB</span></div>';
            }

        }
    }
</script>

@endsection