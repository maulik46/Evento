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
                                <i data-feather="x-circle" id="close-btn"></i>
                            </a>
                            <h3 class="my-4 text-center text-dark">
                                <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                                <span> Create new notice</span>
                            </h3>
                           <form action="#">
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Notice Title</label>
                                   <div class="form-group has-icon d-flex align-items-center">
                                       <i data-feather="info" class="form-control-icon ml-2" height="19px"></i>
                                       <input type="text" class="form-control" placeholder="Enter Notice Title..." />
                                   </div>
                               </div>
                               <div class="form-group mt-2">
                                   <label class="col-form-label font-size-14">Notice Content</label>
                                   <div class="form-group has-icon d-flex">
                                       <i data-feather="edit" class="form-control-icon ml-2" height="19px" style="margin-top: 13px;"></i>
                                       <textarea class="form-control" rows="6" placeholder="Enter Notice Content..."></textarea>
                                   </div>
                               </div>
                               <div class="row justify-content-start align-items-center">

                                <button type="submit" class="hover-me-sm btn btn-success new-shadow-sm rounded-sm px-4 font-size-15 font-weight-bold ml-3">
                                   <span>Send</span>
                                   <i data-feather="send" height="20px"></i>
                                </button>
                                <div class="ml-2 mt-2">
                                    <!-- file upload button -->
                                    <label for="file-upload" class="hover-me-sm custom-file-upload rounded-sm" data-toggle="tooltip" data-placement="right" title="Attachment">
                                        <i data-feather="paperclip"></i>
                                    </label>

                                    <input id="file-upload" type="file" />
                                    <!-- file upload end -->
                                </div>
                                
                               </div>
                               
                           </form>
                        </div>
                    </div>
        </div>
@endsection        



