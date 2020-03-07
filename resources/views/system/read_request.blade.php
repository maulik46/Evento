@extends('system/system_layout')
@section('title','Demo Requests')

@section('my-content')
<div class="container-fluid mt-2">
    <div class="text-center py-2 rounded card shadow-none mb-0">
        <span class="h4">
        <i class="uil uil-envelope-edit h4 mr-1"></i>
            Demo Request
        </span>
    </div>
    <div class="mt-2 rounded-lg p-3 px-1 px-sm-2" style="border:1px solid #e2e7f1;">
        <div class="mb-3 bg-light new-shadow-sm p-2">
        <div class="navbar px-0">
            <div>
                <span class="ml-2 badge badge-success badge-pill px-3">
                    12/12/2019
                </span>
                <span class="ml-2 badge badge-primary badge-pill px-3">
                    By Yash Parmar
                </span>
            </div>
            <div>
                <a href="#" class="badge badge-pill pr-sm-2 pl-sm-3 p-1  hover-me-sm text-white d-flex align-items-center" style="background-color: var(--info);">
                    <span class="d-none d-sm-flex">Read more</span>
                    <i data-feather="arrow-right-circle" height="16px"></i>
                </a>
            </div>
        </div>
        <h6 class="my-0 ml-2">Sutex bank college of computer applications & Science</h6>
        </div>
    </div>
</div>
@endsection

