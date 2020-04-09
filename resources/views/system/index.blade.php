@extends('system/system_layout')
@section('title','Dashboard')
@section('head-tag-links')
<style>
.no-result{
    background-image: url('../assets/images/nodata_system.jpg');
    background-size:300px;
    background-repeat:no-repeat;
    background-position: top;
    height:188px;
    width:auto;
}
</style>
@endsection
@section('my-content')
<div class="container-fluid mt-5">
    <div class="card new-shadow-sm bg-light mb-2">
        <div class="card-body py-2 navbar px-0">
            <h5 class="ml-3">Institute List</h5>
            <div class="col-md-4 col-sm-6 col-12 form-group has-icon d-flex align-items-center mb-0">
                <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                <input type="text"  id="myInput" class="form-control" placeholder="Search Institute.." />
            </div>
        </div>
    </div>
    <div class="row" id="ins-list">
    <?php $count=0; ?>
    @foreach($clgs as $clg)
    <?php $count++; ?>
        <div class="col-lg-6 college">
            <div class="card new-shadow-2 bg-light">
                <div class="card-body py-1">
                    <div class="navbar px-0 pb-2">
                        <span class="badge badge-soft-primary badge-pill px-3">
                        {{date('d/m/Y',strtotime($clg->start_date))}}
                        </span>
                        @if($clg->status=="a")
                            <div id="stat{{$clg->clgcode}}"><div class="badge badge-success px-3 badge-pill">Active</div></div>
                        @else
                            <div id="stat{{$clg->clgcode}}"><div class="badge badge-danger px-3 badge-pill">Inactive</div></div>
                        @endif
                    </div>
                    <h5 class="text-dark mt-0">{{ucfirst($clg->clgname)}}</h5>
                    
                    <span class="text-muted">
                    <i class="uil uil-map-marker text-danger font-weight-bold"></i>
                    {{ucfirst($clg->address)}}
                    </span>

                    <div class="navbar px-0 pb-0">
                        <div class="d-flex">
                            <a href="javascript: void(0);">
                                <img src="{{asset('profile_pic/admin_pro_pic/')}}/{{$clg->profilepic}}" alt="" class="avatar-sm m-1 rounded-circle">
                            </a>
                            <h6 class="ml-2">
                                {{ucfirst($clg->name)}} 
                                <span class="badge badge-info px-2">Admin</span>
                                <div>
                                <span class="font-size-12 text-muted">{{$clg->email}}</span>
                                </div>
                            </h6>
                        </div>
                        <div class="navbar px-0">
                            <a href="{{url('update_college')}}/{{encrypt($clg->clgcode)}}">
                                <i data-feather="edit" class="text-warning" height="19px"></i>
                            </a>
                            <a href="#" onclick="return del('{{$clg->clgcode}}')" class="mx-2">
                                <i data-feather="trash-2" class="text-danger" height="19px"></i>
                            </a>
                            <div class="custom-control custom-switch mt-1">
                            @if($clg->status=="a")
                                <input type="checkbox" class="custom-control-input" checked onclick="return change_status(this.id)" id="{{$clg->clgcode}}">
                            @else
                            <input type="checkbox" class="custom-control-input" onclick="return change_status(this.id)" id="{{$clg->clgcode}}">
                            @endif
                                <label class="custom-control-label" for="{{$clg->clgcode}}"></label>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    @endforeach
    </div>
    @if($count==0)
    <div class="rounded p-3 px-1 px-sm-2" style="border:1px solid #e2e7f1;">
        <div class="d-flex justify-content-center flex-column bg-white rounded" style="height:60vh;">
            <!-- <img src="{{asset('assets/images/nodata_system.jpg')}}" height="300px" alt="Your institute list is empty..!" > -->
            <div class="no-result"></div>
            <h6 class="text-center text-muted">Your institute list is empty..!</h6>
        </div>
    </div>
    @endif
</div>
@endsection
@section('extra-scripts')
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#ins-list .college").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });
    });
function change_status(id)
{
    if($('#'+id).prop('checked') == true)
    {
        var status="a";
    }
    else{
        var status="i";
    }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/change_status',
            data: {
               clgcode:id,
               status:status,
            },
            success: function (data) {
                $('#stat'+id).html(data.msg);
            },
            error: function (data) {
                console.log(data);
            }
        })
}
function del(clgcode)
{
Swal.fire({
            title: 'Are you sure?',
            text: "You want to Delete this college Records..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Delete'
            }).then((result) => {
            if (result.value) {
                window.location.href = 'delclg/'+clgcode;
            }})
}
</script>
@endsection
