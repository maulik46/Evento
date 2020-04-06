@extends('super-admin/s_admin_layout')

@section('title','View Students')

@section('head-tag-links')    
<link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> 
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
        font-size: 1rem;
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

<div class="mx-1 mx-sm-3">
    <div class="card new-shadow-sm">
        <a href="{{url('/sindex')}}" class="text-right text-dark p-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <div class="card-title px-4 mb-1 header-title  align-items-center d-flex justify-content-center">
            <img src="{{asset('assets/images/svg-icons/super-admin/all student.svg')}}" class="mr-2 mb-1" height="25px" alt="">
            <span class="h4 text-dark">All Students</span>
        </div>
        <span class="text-center font-weight-bold text-muted">
            {{ucfirst(Session::get('aclgname'))}}
        </span>
        <hr>
        <div class="card-body px-1 px-md-2 pt-0">
            <!-- <div class="col-lg-3 col-md-5 col-sm-6 col-12 form-group has-icon d-flex align-items-center">
                <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                <input id="myInput" type="text" class="form-control " placeholder="Search Student..">
            </div> -->
            <div class="table-responsive overflow-auto my-scroll">
                <table id="my-datatable" class="table table-hover mb-0 ">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Enrollment</th>
                            <th scope="col">Roll No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Class</th>
                            <th scope="col">Division</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile No</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Address</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=0;?>
                        @foreach($stud as $s)
                        <?php $no++;?>
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$s['senrl']}}</td>
                            <td>{{$s['rno']}}</td>
                            <th>{{ucfirst($s['sname'])}}</th>
                            <td>{{date('d/m/Y',strtotime($s['dob']))}}</td>
                            <td>{{ucfirst($s['class'])}}</td>
                            <td>{{$s['division']}}</td>
                            <td>{{$s['email']}}</td>
                            <td>{{$s['mobile']}}</td>
                            <td>{{ucfirst($s['gender'])}}</td>
                            <td>{{$s['address']}}</td>
                            <td >
                                <a href="{{url('update_stud')}}/{{encrypt($s['senrl'])}}" class="btn text-warning p-0">
                                <i data-feather="edit" height="19px"></i>
                                </a>
                                <a href="" onclick="return confirm('<?php echo $s['senrl'] ?>')" class="btn text-danger p-0">
                                <i data-feather="trash-2" height="19px"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
            
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Datatables init -->
<!-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> -->
<script>
$("#my-datatable").DataTable({
    "language": {
      "emptyTable": "No data available in table"
    },
    
    // "lengthMenu": [ 3, 25, 50, 75, 100 ]
});
$('#my-datatable_info').parent().remove();
$('#my-datatable_paginate .pagination').css({"justify-content":"flex-start","margin":"5px"});
</script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
function confirm(enrl){
     Swal.fire({
        title: "Are you sure!",
        html:"You want to delete this student ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:"Yes,Delete it",
        cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            window.location.href = '<?php echo url('/view_student/confirm_del').'/' ?>'+enrl;
        }
        })
        return false;
    }
</script>
@endsection
