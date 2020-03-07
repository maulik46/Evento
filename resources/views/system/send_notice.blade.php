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
                <form>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label class="col-form-label font-size-15">Event for</label>
                        <div class="form-group has-icon d-flex align-items-center bg-white">
                            <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                            <select  multiple="multiple" name=""  class="form-control active w-100 py-2">
                                <option value="sutex">sutex</option>
                                <option value="s v patel">s v patel</option>
                                <option value="s s agarwal">s s agarwal</option>
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
            placeholder: 'Select Class',
            selectAll: true
        });

        $('.ms-options').removeAttr('style');
        $('.ms-options').addClass('my-scroll');
    });
    </script>
@endsection