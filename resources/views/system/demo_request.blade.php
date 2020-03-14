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
    <?php $c=0 ?>
    @foreach($demos as $demo)
    <?php $c++?>
        <div class="mb-3 bg-light new-shadow-sm p-2">
            <div class="navbar px-0">
                <div>
                    <span class="ml-2 badge badge-success badge-pill px-3">
                        {{date('d/m/Y',strtotime($demo->reqdate))}}
                    </span>
                    <span class="ml-2 badge badge-primary badge-pill px-3">
                        BY {{ucfirst($demo->aname)}}
                    </span>
                </div>
                <div>
                    <a href="{{url('s_read_request')}}/{{encrypt($demo->did)}}" class="badge badge-pill pr-sm-2 pl-sm-3 p-1  hover-me-sm text-white d-flex align-items-center" style="background-color: var(--info);">
                        <span class="d-none d-sm-flex">Read more</span>
                        <i data-feather="arrow-right-circle" height="16px"></i>
                    </a>
                </div>
            </div>
            <h6 class="my-0 ml-2">{{ucfirst($demo->iname)}}</h6>
        </div>
    @endforeach
    @if($c==0)
        <h1>Evento</h1>
    @endif
    </div>
</div>
@endsection

