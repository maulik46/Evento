@extends('system/system_layout')
@section('title','Dashboard')
@section('my-content')
<div class="container-fluid mt-4">
    <div class="card new-shadow-sm bg-light mb-2">
        <div class="card-body py-2 navbar px-0">
            <h5 class="ml-3">College List</h5>
            <div class="col-md-4 col-sm-6 col-12 form-group has-icon d-flex align-items-center mb-0">
                <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                <input type="text"  name="" class="form-control" placeholder="Search Institute.." />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card new-shadow-2 bg-light hover-me-sm">
                <div class="card-body py-1">
                    <div class="navbar px-0 pb-2">
                        <span class="badge badge-soft-success badge-pill px-3">
                        12/12/2019
                        </span>
                        <div class="badge badge-success px-3 badge-pill">Running</div>
                    </div>
                    <h5 class="text-dark mt-0">Sutex Bank College</h5>
                    
                    <span class="text-muted">Address If several languages coalesce, the grammar of the resulting language ismore regular.</span>

                    <div class="navbar px-0 pb-0">
                        <div class="d-flex">
                            <a href="javascript: void(0);">
                                <img src="assets/images/avatars/child.svg" alt="" class="avatar-sm m-1 rounded-circle">
                            </a>
                            <h6 class="ml-2">
                                Yash Parmar <span class="badge badge-soft-primary px-3 badge-pill">Admin</span>
                            </h6>
                        </div>
                        <div>
                            <a href="#">
                                <i data-feather="edit" class="text-warning mr-1" height="19px"></i>
                            </a>
                            <a href="#" >
                                <i data-feather="trash-2" class="text-danger ml-1" height="19px"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection