@extends('super-admin/s_admin_layout')

@section('title','Create Co-ordinator')

@section('head-tag-links')
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
    <style>
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
            padding: 12px 10px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #43d39e;
        }
        @media(max-width:432)
        {
            .photo-upload{
                position:relative!important;
                left:-20px!important;
                top:45px!important;
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
                            <h3 class="my-3 text-center text-dark">
                                <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                                <span> Create Co-ordinator</span>
                            </h3>
                            <form action="#">
                                <div class="d-flex">
                                    <div class="col-11 mt-2">
                                        <label class="col-form-label font-size-14">Co-ordinator Name</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Co-ordinator Name..." />
                                        </div>
                                    </div>
                                    <div class="col-1 photo-upload" style="position:relative;left:-16px;top:45px;">
                                        <!-- file upload button -->
                                        <label for="file-upload" class=" custom-file-upload rounded-sm"
                                            data-toggle="tooltip" data-placement="right" title="Profile Photo">
                                            <i data-feather="image"></i>
                                        </label>

                                        <input id="file-upload" name="attachment[]" type="file" multiple onChange="FileDetails()"/>
                                        <!-- file upload end -->
                                    </div>
                                </div>
                                
                                <div class="form-group mt-2 row mx-0">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="col-form-label font-size-14">
                                        Email</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="email" class="form-control"  placeholder="Enter Co-ordinator's Email" />
                                        </div>
                                     
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="col-form-label font-size-14">Contact No.</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" placeholder="Enter Co-ordinator's Contact no" />
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="form-group mt-2 row mx-0">
                                    <div class="col-sm-6">
                                        <label class="col-form-label font-size-14">Event Catagory</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                               <select class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
                                                   <option value="">Event Catagory</option>
                                                   <option value="Sport">Sport</option>
                                                   <option value="Cultural">Cultural</option>
                                                   <option value="IT">IT</option>
                                               </select>
                                        </div>
                                     
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-form-label font-size-14">Password</label>
                                        <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="key" class="form-control-icon ml-2" height="19px"></i>
                                            <input type="text" class="form-control" style="letter-spacing: 5px;"
                                                value="A1be4TY" readonly />
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="mt-0 ml-1 row justify-content-start align-items-center">
                                    &nbsp;
                                    <button type="submit"
                                        class="hover-me-sm btn btn-info new-shadow-sm rounded-sm px-3 font-size-15
                                        font-weight-bold ml-2" style="background-color: #35bbca;">
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
$(document).ready(function() {
        $('.select-me').niceSelect();
        
    });
</script>
@endsection