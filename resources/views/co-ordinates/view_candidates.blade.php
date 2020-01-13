@extends('co-ordinates/cod_layout')

@section('title','View Candidates')

@section('head-tag-links')
    <!-- data table plugins -->
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>

     .page-item.active .page-link {
     color: #fff;
     background-color: #43d39e;
     border-color: #43d39e;
     }
     .page-link {
     color: #27b58f;
     background-color: #fff;
     border: 1px solid #e2e7f1;
     }
    </style>
@endsection

@section('my-content')
            <div class="container-fluid">
                <div class="card mt-5 new-shadow-sm">
                    <div class="card-body">
                        <a href="{{url('/cindex')}}" class="float-right text-dark">
                            <i data-feather="x-circle" id="close-btn"></i>
                        </a>
                        <div class="mb-3 mt-4 justify-content-between d-flex align-items-center ">
                            <div class="d-flex align-items-center">
                                <img src="{{asset('assets/images/svg-icons/co-ordinate/team.svg')}}" height="35px" alt="">
                                <span class="h4 ml-2">Participated Candidates</span>
                            </div>
                            <div class="font-weight-bold mr-4 font-size-15">
                                <span class="">Total Candidates:</span>
                                <span class="text-dark font-size-18 ml-1">3</spanclass="text-muted">
                            </div>

                        </div>
                        <div class="table-responsive my-scroll">
                            <table id="basic-datatable"  class="table table-hover table-light rounded">
                                <thead class="thead-light">
                                    <tr>
                                        <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                            style="background-color: #dde1fc;">
                                            Khoo-Khoo Competition Winners
                                            <br>
                                            <span class="font-size-14">Date: 03/11/2019</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">EID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Division</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        <th scope="row">
                                            E12345
                                        </th>
                                        <td>Piyush Monpara</td>
                                        <td>TYBCA</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            E12345
                                        </th>
                                        <td>yash Monpara</td>
                                        <td>TYBCA</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            E12345
                                        </th>
                                        <td>jjjj Monpara</td>
                                        <td>TYBCA</td>
                                        <td>3</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <div class="position-fixed" style="bottom: 10px;right:12px;" data-toggle="tooltip" data-placement="left"
                    title="Print">
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icons/co-ordinate/print.svg')}}" height="55px" class="hover-me-sm rounded-circle" alt="">
                    </a>
                </div>
            </div>
@endsection        

@section('extra-scripts')
     <script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
     <!-- Datatables init -->
     <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection  
