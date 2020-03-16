<?php
use \App\tblstudent;
?>
@extends('super-admin/s_admin_layout')

@section('title','Event Records')

@section('head-tag-links')
<style>
    .form-control {
        border-radius: .1rem;
        background-color: #fff !important;
        padding: 5px 10px;
        border: 1px solid #d1d1d1;
        font-size: 1em;
        color: #333;
        height: 35px;
        cursor: text !important;
    }
    .form-control:focus {
        border: 1px solid #d1d1d190 !important;
    }
    .page-item.active .page-link {
        background-color: var(--info);
        border-color: var(--info);
        text-align:left!important;
    }
    .page-link{
        color: var(--info);
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 90px;
        display: inline-block;
    }
    @media (max-width: 767.98px){
    li.paginate_button.next, li.paginate_button.previous {
        display: inline-block;
        font-size: 13px;
    }
    }
</style>
@endsection
@section('my-content')
    @if(Session::get('msg'))
    
    <div class="bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle"  height="20px" ></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
                <span class="text-white ">{{ Session::get('msg') }}</span>
            </div>
        </div>
    </div>
    @endif
    <div class="container-fluid">
    <div class="mx-1 mx-sm-3">
        <div class="card new-shadow-sm">
            <!-- <a href="{{url('/sindex')}}" class="text-right text-dark p-2">
                <i data-feather="x-circle" id="close-btn" height="20px"></i>
            </a> -->
            <div class="card-title px-4 mb-1 header-title  align-items-center d-flex justify-content-center">
                <img src="{{asset('assets/images/svg-icons/super-admin/all student.svg')}}" class="mr-2 mb-1" height="25px" alt="">
                <span class="h4 text-dark">All Events Record</span>
            </div>
            <span class="text-center font-weight-bold text-muted">
                {{ucfirst(Session::get('clgname'))}}
            </span>
            <hr>
            <div class="card-body px-1 px-md-2 pt-0">
                <div class="text-right">
                    <a href="#" class="badge-pill badge-soft-primary btn-sm pr-3 pl-2 font-weight-bold new-shadow-sm btn-filter">
                        <i data-feather="filter" height="18px"></i>
                        Filters
                    </a>
                    <a href="#" class="text-dark" id="close-filter" style="display:none">
                        <i data-feather="x-circle" height="20px"></i>
                    </a>
                </div>
                <div id="filter-box" class="mt-2 card position-relative w-100 mb-0" style="left:0px;z-index:9;display:none;border:1px solid #e9e9e9;">
                    <div class="card-body p-2">
                    <div class="row justify-content-between mx-0">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Event Name" />
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group has-icon d-flex align-items-center px-0 mb-1">
                                <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter Co-ordinator Name" />
                            </div>
                        </div>
                        <div class="col-md-4 col-12 d-flex justify-content-end">
                            <div class="mx-sm-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input name="" id="from" onchange="filter()" type="text" class="form-control basicDate" placeholder="From" />
                            </div>
                            <div class="mx-sm-1 form-group has-icon d-flex align-items-center">
                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                <input name="" id="to" onchange="filter()" type="text" class="form-control basicDate" placeholder="To" />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between justify-content-sm-around mx-0">
                        <div class="col-auto">
                            <h6>Category</h6>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Sport</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Cultural</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">IT</label>
                            </div>
                        </div>
                        <!-- <div class="col-auto">
                            <h6>Division</h6>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">1</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">2</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">3</label>
                            </div>
                        </div> -->
                        <div class="col-auto">
                            <h6>Event Type</h6>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Team</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Solo</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- <div id="filter-table" class="card-body text-muted mt-3 py-0 px-1">
                    <div class="table-responsive overflow-auto my-scroll">
                        <table class="table table-hover table-light new-shadow ">
                            <thead class="bg-soft-success">
                                <tr class="text-dark">
                                    <th scope="col">Rank</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Division</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        1
                                    </th>
                                    <td>Piyush Monpara</td>
                                    <td>Cricket</td>
                                    <td>TYBCA</td>
                                    <td>3</td>
                                    <td>12/12/2019</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        2
                                    </th>
                                    <td>Dishant Sakariya</td>
                                    <td>Rakhi making</td>
                                    <td>TYBCA</td>
                                    <td>3</td>
                                    <td>12/12/2019</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        3
                                    </th>
                                    <td>Yash Parmar</td>
                                    <td>Kho-kho</td>
                                    <td>TYBCA</td>
                                    <td>3</td>
                                    <td>12/12/2019</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <div class="table-responsive overflow-auto my-scroll">
                    <table class="table table-hover mb-0 ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Co-ordinator</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-dark">
                                <td>1</td>
                                <td>Rakhi Making</td>
                                <td>12/02/2019</td>
                                <td>Parth Patthar</td>
                                <td>Solo Event</td>
                                <td>Cultural</td>
                                <td>
                                <a href=""
                                    class="btn p-1 btn-rounded mr-1 btn-p-about" data-toggle="tooltip"
                                    data-placement="top" title="Result">
                                    <i data-feather="award" height="18px" class=" text-success"></i>
                                </a>
                                <a href=""
                                    class="btn p-1 btn-rounded mr-1 btn-p-about" data-toggle="tooltip"
                                    data-placement="top" title="About">
                                    <i data-feather="info" height="18px" class=" text-info"></i>
                                </a>
                                <a href=""
                                    class="btn p-1 btn-rounded mr-1 btn-p-about" data-toggle="tooltip"
                                    data-placement="top" title="Candidates">
                                    <i data-feather="users" height="18px" class=" text-primary"></i>
                                </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div>
    </div>
@endsection
@section('extra-scripts')
<script>
$(document).ready(function(){
    $('#filter-box,#close-filter').hide();
    $('.btn-filter').click(function(){
        $('#filter-box,#close-filter').show();
        $('.btn-filter').hide();
    });
    $('#close-filter').click(function(){
        $('#filter-box,#close-filter,#filter-table').hide();
        $('.btn-filter').show();
    })
})
</script>
@endsection
