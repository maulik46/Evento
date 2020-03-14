@extends('system/system_layout')
@section('title','Send Notice')
@section('head-tag-links')
<link href="{{asset('assets/libs/multicheckbox/multiselect.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/summernote/summernote-bs4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('my-content')
<div class="container-fluid mt-2">
    <div class="row justify-content-center align-items-center">
        <div class="col-12">
            <div class="text-center py-2 rounded card shadow-none mb-0">
                <span class="h4">
                <i class="uil uil-envelope-edit h4 mr-1"></i>
                Create Notice
                </span>
            </div>
            <div class="mt-2 card shadow-none p-3 px-3 px-sm-4 rounded-lg" style="border:1px solid #e2e7f1;">
            <div class="text-center font-weight-bold text-danger" id="error">{{$errors->first('attachment')}}</div>
                <form action="{{url('send_notice')}}" method="post" onsubmit="return check()" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label font-size-15">Event for</label>
                        <div class="form-group has-icon d-flex align-items-center bg-white">
                            <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                            <select id="nfor"  multiple="multiple" name="clg[]"  class="form-control active w-100 py-2">
                            @foreach($clgs as $clg)
                                <option value="{{$clg->clgcode}}">{{ucfirst($clg->clgname)}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-form-label font-size-14">Notice Title</label>
                        <div class="form-group has-icon d-flex align-items-center">
                            <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="title" id="title" class="form-control"placeholder="Enter Notice Title..." />
                        </div>
                    </div>
                    <div class="ml-2 mt-2">
                                        <!-- file upload button -->
                        <label for="file-upload" class="custom-file-upload rounded-sm"
                            data-toggle="tooltip" data-placement="right" title="Attachment">
                            <i data-feather="paperclip"></i>
                        </label>

                        <input id="file-upload" name="attachment[]" type="file" multiple onChange="FileDetails()"/>
                        <!-- file upload end -->
                    </div>
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
                <div class="mt-3 p-1" id="fc" >
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="{{asset('assets/libs/multicheckbox/multiselect.js')}}"></script>

    <script src="{{asset('assets/libs/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'fontsize','clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['view', ['style','undo', 'redo', 'fullscreen','codeview']],
            ],
            placeholder: ' Enter Notice Content...'
        });
    </script>
    <script>
        $(document).ready(function() {
        $('select[multiple]').multiselect({
            columns: 1,
            placeholder: 'Select college(s)',
            selectAll: true
        });

        $('.ms-options').removeAttr('style');
        $('.ms-options').addClass('my-scroll');
    });
    </script>
    <script>
    function check() {
        if ($('#nfor').val() == "") {
            $('#error').text("Please select Receiver..");
            return false;
        }

        if ($('#title').val() == "") {
            $('#error').text("Please enter notice title..");
            return false;
        }

        if ($('#message').val() == "") {
            $('#error').text("Please enter your message..");
            return false;
        }
        

    }
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
@endsection
