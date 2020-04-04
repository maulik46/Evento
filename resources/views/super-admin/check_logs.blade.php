
<?php date_default_timezone_set("Asia/Kolkata"); ?>
@extends('super-admin/s_admin_layout')

@section('title','Check Logs')

@section('head-tag-links')
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
<style>
    .nice-select:after {
        border-bottom: 3px solid #999;
        border-right: 3px solid #999;
        height: 8px;
        right: 15px;
        width: 8px;
    }

    .nice-select .list {
        width: 100%;
        border-radius: 2px;
        box-shadow: none;
        border: 1px solid #d1d1d1;
    }

    .nice-select .option.selected.focus {
        background-color: #f3f4f7;
    }
    .flatpickr-weekdays {
        margin: 10px 0px;
    }

    .flatpickr-weekday {
        color: #000 !important;
        margin-top: 5px;
    }
    .flatpickr-calendar{
        z-index: 10!important;
    }

    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7 !important;
        font-size: 1.1em;
        color: #333 !important;
        height: 45px;
    }
    .morecontent span {
        display: none;
    }
    .morelink {
        display: block;
    }
    .form-control:focus {
        border: 1px solid #d1d1d1 !important;
        background-color: #f3f4f7 !important;
    }
    #action span:nth-child(odd){
        border-radius:6rem 0px 0px 6rem!important;
    }
    #action span:nth-child(even){
        border-radius:0px 6rem 6rem 0px!important;
    }
    .morelink{
        display:inline-flex!important;
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
            <i data-feather="list"></i>
            <span class="h4 text-dark ml-2">Co-ordinator's Log</span>
        </div>
        <hr class="my-1">
        <div class="card-body row justify-content-between pb-0 new-shadow-sm mx-0">

            <div class="col-md-4 col-sm-12">
                <div class="form-group has-icon d-flex align-items-center">
                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                    <select name="cname" id="cname" onchange="filter()" class="w-100 py-1 form-control  select-me" style="cursor:pointer!important;">
                        <option value="">Select Co-ordinator</option>
                        <option value="all">All</option>
                        @foreach($cod as $co)
                           <option value="{{$co['cid']}}">{{ucfirst($co['cname'])}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-8 col-12 d-flex justify-content-end">
                <div class="mx-1 form-group has-icon d-flex align-items-center">
                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                    <input name="" id="from" onchange="filter()" type="text" class="form-control basicDate" placeholder="From" />
                </div>
                <div class="mx-1 form-group has-icon d-flex align-items-center">
                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                    <input name="" id="to" onchange="filter()" type="text" class="form-control basicDate" placeholder="To" />
                </div>
            </div>
        </div>

    </div>
  
    <div id="loglist">
    <?php $a=0;?>
    @foreach($logs as $log)
    <?php $a=1;?>
        <div class="card mb-0 mt-3 new-shadow-sm">
            <div class="card-body py-2">
                <div class="row justify-content-between mx-0">
                    <div>
                    <span class="badge badge-info px-3 badge-pill  my-1">{{date('d-m-Y',$log['time'])}}</span>
                    <span class="badge badge-danger px-3 badge-pill  my-1">{{date('h:m:s A',$log['time'])}}</span>
                    <span class="badge badge-soft-primary px-3 badge-pill  my-1">By {{ucfirst($log['cname'])}}</span>
                    </div>
                    <div id="action" class="row justify-content-between mx-0">
                        <div class="mr-1">
                            <span class="badge badge-dark px-3 rounded-0  my-1" style="margin-right:-5px;">Action on</span>
                            <span class="badge badge-soft-dark px-3 rounded-0">{{ucfirst($log['action_on'])}}</span>
                        </div>
                        <div class="ml-1">
                            <span class="badge badge-dark px-3 rounded-0  my-1" style="margin-right:-5px;">Action</span>
                            <span class="badge badge-soft-dark px-3 rounded-0">{{ucfirst($log['action_type'])}}</span>
                        </div>
                    </div>
                </div>
                
                <div class="card-text">
                    <span class="text-muted more">{!!$log['descr']!!}</span>
                    <div class="float-right">
                        <span class="font-weight-bold">IP</span>
                        <span class="badge badge-soft-dark badge-pill px-2">{{$log['ip_add']}}</span>
                    </div>
                </div>
            </div>
            
        </div>
    @endforeach
    @if($a==0)
    <div class="card mt-2 new-shadow-sm" style="height:50vh;">
        <div class="no-result-img mt-2"></div>
        <h6 class="text-center darkblue mt-1">No logs available..! </h6>
    </div>
    @endif
        <div class="mt-3">
        {{$logs->links()}}
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<!-- calander js for date -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script>
    $(document).ready(function () {
        // this is for select tag
        $('.select-me').niceSelect();
        // end here
        $(".basicDate").flatpickr({
            enableTime: false,
            dateFormat: "d-m-Y"
        });

    });
</script>
<script>
    $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 120;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink morelink badge badge-soft-danger px-2 badge-pill">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
function filter()
{
    
    var cid = $('#cname').val();
    var sdate = $('#from').val();
    var ldate = $('#to').val();
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type: 'POST',
            url: '/filterlog',
            data: {
                cid: cid,
                sdate: sdate,
                ldate: ldate
            },
            success: function (data) {
                    $('#loglist').html(data.msg);
            },
            error: function (data) {
            console.log(data);
            }
        })
}

</script>
@endsection
