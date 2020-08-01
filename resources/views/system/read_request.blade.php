@extends('system/system_layout')
@section('title','Read Requests')

@section('my-content')
<div class="container-fluid mt-2">
    <div class="mt-4 rounded-lg p-3 px-1 px-sm-2" style="border:1px solid #e2e7f1;">
    <div>
        <div class="d-flex justify-content-center align-items-start align-items-sm-center flex-column flex wrap">
            <h5 id="iname">
            {{ucfirst($d_req->iname)}}
            </h5>
            <div class="d-flex flex-sm-row flex-column">
                <span id="" class="badge badge-pill badge-soft-primary pl-2 pr-3 m-1">
                <i data-feather="calendar" height="14px"></i>
                {{date('d/m/Y',strtotime($d_req->reqdate))}}
                </span>
                <span id="email" class="badge badge-pill badge-soft-info pl-2 pr-3 m-1">
                <i data-feather="mail" height="14px"></i>
                {{$d_req->email}}
                </span>
                <span id="contact" class="badge badge-pill badge-soft-dark pl-2 pr-3 m-1">
                <i data-feather="phone" height="14px"></i>
                {{$d_req->contact}}
                </span>
            </div>
        </div>
        
        <div class="text-muted" id="msg-text">
        <hr>
        @if($d_req->msg)
        Hello..
        <br><br>
        {{$d_req->msg}}
        <br><br>
        @endif
            <div class="text-muted font-weight-bold">
                <i data-feather="map-pin" height="18px"></i>Address
                <div class="m-2" >
                <p id="addrs">{{$d_req->address}}</p>
                <span id="city">{{$d_req->city}}</span>,
                </div>
            </div>
            <div class="text-right font-weight-bold text-dark m-3">
            <h6>By <span id="aname">{{$d_req->aname}}</span></h6>
            </div>
        </div>
    </div>
    </div>

    <form id="clg-code-form" style="display:none;">
    <div class="row justify-content-center align-items-start flex-row mt-3">
        <div class="col-lg-4 col-sm-6">
        <div class="form-group my-0">
            <div class="form-group has-icon d-flex align-items-center">
                <i class="uil uil-tag-alt form-control-icon ml-2"></i>
                <input type="text" id="clgcode" class="form-control" placeholder="Enter Institute Code" required>
                @error('clgcode')
                <div>
                    <span class="text-danger font-weight-bold">{{$message}}</span>
                </div>
                @enderror
                <input type="hidden" id="did" value="{{$d_req->did}}">
            </div>
        </div>
        </div>

        <div class="col-lg-4 col-sm-6">
            <button type="submit" onclick="return valcheck()" id="submit-code" class="mt-0 btn btn-success font-weight-bold rounded-sm px-3 new-shadow-sm hover-me-sm">
                Done
                <i data-feather="arrow-right-circle" height="18px"></i>
            </button>
            <button type="reset" id="cancel-code" class="mt-0 btn btn-danger font-weight-bold rounded-sm px-3 new-shadow-sm hover-me-sm">
                Cancel
                <i data-feather="arrow-right-circle" height="18px"></i>
            </button>
        </div>
    
    </div>
    </form>

    <div id="request-btns">
        <a href="#" id="accept-btn" class="mt-2 btn btn-success font-weight-bold rounded-sm px-3 new-shadow-sm hover-me-sm">
            Accept Request
            <i data-feather="check-square" height="18px"></i>
        </a>
        <a href="#" onclick="return reject()" class="mt-2 btn btn-danger font-weight-bold rounded-sm px-3 new-shadow-sm hover-me-sm">
            Reject
            <i data-feather="x-circle" height="18px"></i>
        </a>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('#accept-btn').click(function(){
        $('#msg-text,#request-btns').hide();
        $('#clg-code-form').show();
    });
    $('#cancel-code').click(function(){
        $('#msg-text,#request-btns').show();
        $('#clg-code-form').hide();
    })
});
function reject()
{
    
    var did=$('#did').val();
    var link='<?php echo url("/system/delreq")?>'+'/'+did;
    Swal.fire({
        title: "Are you sure!",
        html:"You want to Reject the request?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:"Yes,Delete it",
        cancelButtonText: 'No',
        }).then((result) => {
        if (result.value) {
            window.location.href = link;
        }
        })
}
function valcheck()
{
    var iname=$.trim($('#iname').text());
    var aname=$('#aname').text();
    var email=$.trim($('#email').text());
    var contact=$.trim($('#contact').text());
    var city=$('#city').text();
    var addrs=$('#addrs').text();
    var clgcode=$('#clgcode').val();
    var did=$('#did').val();
    var reqdate='<?php echo $d_req->reqdate ?>';
    if(clgcode!="")
    {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type: 'POST',
            url: '/system/add_institute',
            data: {
                iname: iname,
                aname: aname,
                email: email,
                contact:contact,
                city:city,
                addrs:addrs,
                clgcode:clgcode,
                did:did,
                reqdate:reqdate,
            },
            success: function (data) {
                window.location.href = "/system"
            },
            error: function (data) {
                alert('Somthing went wrong,please try again..!')
            }
        })
    }
}
</script>
@endsection

