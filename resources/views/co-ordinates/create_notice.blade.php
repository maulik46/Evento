@extends('co-ordinates/cod_layout')

@section('title','Create Notice')

@section('head-tag-links')
    <style>
        .form-control{
        border-radius: .15rem;
        background-color: #f3f4f7!important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7!important;
        font-size: 1.1em;
        color:#333!important;
        height: 50px;
        cursor: text!important;
        }
        /* box-shadow: 0 0 2px black; */

        .form-control:focus{
        border: 1px solid #d1d1d1!important;
        background-color: #f3f4f7!important;
        }
        .border-form{
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
        .custom-file-upload:hover{
            color: #43d39e;
        }
    </style>
@endsection



@section('my-content')        
        <div class="container col-lg-6">
                    <div class="card mt-5 new-shadow rounded-lg">
                        <div class="card-body px-lg-4">
                            <a href="{{url('/cindex')}}" class="float-right text-dark">
                                <i data-feather="x-circle" id="close-btn" height="20px"></i>
                            </a>
                            <h3 class="my-4 text-center text-dark">
                                <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                                <span> Create new notice</span>
                                
                            </h3>
                            <div class="text-center font-weight-bold text-danger" id="error">{{$errors->first('attachment')}}</div>
                            <form action="noticesend" method="post" onsubmit="return check()" enctype="multipart/form-data">
                            @csrf
                                <div class="row justify-content-center" style="margin-bottom: -10px;">
                                    <div class="form-group mt-2 col-lg-12">
                                        <label class="col-form-label font-size-14">Notice Title</label>
                                         <div class="form-group has-icon d-flex align-items-center">
                                        <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Notice Title..." />
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-form-label font-size-14">Notice Content</label>
                                    <div class="form-group has-icon d-flex">
                                          <i data-feather="edit" class="form-control-icon ml-2" height="19px" style="margin-top: 13px;"></i>
                                        <textarea class="form-control" name="message" id="message" rows="6" maxlength=550
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
                                    <div class="ml-2 mt-2">
                                        <!-- file upload button -->
                                        <label for="file-upload" class="custom-file-upload rounded-sm"
                                            data-toggle="tooltip" data-placement="right" title="Attachment">
                                            <i data-feather="paperclip"></i>
                                        </label>

                                        <input id="file-upload" name="attachment" type="file" multiple />
                                        <!-- file upload end -->
                                    </div>
                                    
                                </div>
                            <div class="mt-3 p-1" style="border: 1px solid #d2d8de;">
                                <div class="d-flex justify-content-center align-items-center smr-2" style="margin-top:-12px;">
                                    <span class="badge badge-dark px-3 py-1 badge-pill">Total Files: 3</span>
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">

                                    <div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;">
                                       <span class="text-dark ml-2">file1.txt</span>
                                       <span class="badge badge-light px-3 badge-pill mr-2">12mb</span>
                                    </div> 

                                    <div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;">
                                       <span class="text-dark ml-2">file1.txt</span>
                                       <span class="badge badge-light px-3 badge-pill mr-2">12mb</span>
                                    </div>
                                                                   
                                </div>
                            </div>
                                
                            </form>
                        </div>
                    </div>
        </div>
@endsection        
@section('extra-scripts')
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
            $('#error').text("Please enter put your message");
            return false;
        }
        
        
    }
</script>
@endsection


