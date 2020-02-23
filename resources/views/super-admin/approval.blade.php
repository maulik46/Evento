@extends('super-admin/s_admin_layout')

@section('title','Delete Approval')

@section('head-tag-links')
<style>
    #labels span:nth-child(odd){
        border-radius:6rem 0px 0px 6rem!important;
    }
    #labels span:nth-child(even){
        border-radius:0px 6rem 6rem 0px!important;
    }
    .card-text div span{
        font-weight:bold;
        color:var(--dark);
        margin-right: 6px;
    }
</style>
@endsection
@section('my-content')
<div class="container-fluid">
    <div class="card mb-0">
        <a href="{{url('sindex')}}" class="text-dark text-right p-2" id="close-btn">
            <i data-feather="x-circle" height="20px"></i>
        </a>
        <div class="text-dark d-flex align-items-center justify-content-center p-1">
            <i data-feather="calendar"></i>
            <span class="h4 text-dark ml-2">Approve Deleted Event</span>
        </div>
    </div>
    <div class="card mb-0 mt-1 new-shadow-sm">
        <div class="card-body py-2">
           
            <div class="row justify-content-between align-items-center mx-0">
                <span class="text-danger font-weight-bold font-size-16">PL/SQL competition</span>
                <div id="labels">
                    <span class="badge badge-primary px-3 badge-pill  my-1 rounded-0" style="margin-right:-5px;">
                       Event-date
                    </span>
                    <span class="badge badge-soft-primary px-3 badge-pill  my-1 rounded-0">
                        12/02/2020
                    </span>
                </div>
            </div>
            <hr class="my-0">
            <div class="row justify-content-between align-items-end">
                <div class="card-text col-sm-9 col-12">
                    <div>
                        <span>Event Co-ordinator</span>  Dr.Parth Patthar
                    </div>
                    <div>
                        <span>Event-Type</span>  IT
                    </div>
                    <div>
                        <span>Reason</span> Due to emergency of world war 3 & lack resource of chips
                    </div>
                    
                </div>
                <div class="col-sm-3 col-12">
                    <a href="#" class="m-1 btn btn-default btn-sm  btn-rounded float-right font-weight-bold px-4 text-danger" style="border:2px solid var(--danger);">
                        <span>Cancel</span>    
                    </a>
                    <a href="#" class="m-1 btn btn-danger btn-sm  btn-rounded float-right font-weight-bold px-4" >
                        <span>Delete</span>    
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')


@endsection