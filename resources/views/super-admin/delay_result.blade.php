<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('super-admin/s_admin_layout')
@section('title','Create Result')
@section('head-tag-links')
<style>
    .form-control {
        border-radius: .1rem;
        background-color: #fff !important;
        padding: 5px 10px;
        border: 1px solid #d1d1d1;
        font-size: 1.1em;
        color: #333;
        height: 35px;
        cursor: text !important;
    }

    .form-control:focus {
        border: 1px solid #d1d1d190 !important;
    }
    /* .custom-control-input.switch-1:checked~.custom-control-label::before {
        color: #fff;
        border-color: #1ae1ac;
        background-color: #1ae1ac;
    }
    .custom-control-input.switch-2:checked~.custom-control-label::before {
        color: #fff;
        border-color: var(--info);
        background-color: var(--info);
    }
    .custom-control-input.switch-3:checked~.custom-control-label::before {
        color: #fff;
        border-color: var(--warning);
        background-color: var(--warning);
    } */
    .sticky {
        position: fixed;
        top: 72px;
        left: 0px;
        width: 100%;
        border-top: 1px solid lightgray;
        border-radius: 0px !important;
        z-index: 99;
        box-shadow: 0 3px 6px -5px #777;
    }
    .stud-info:hover .drag-me,
    .team-info:hover .drag-me{
        -webkit-transform: translateY(-2px);
        transform: translateY(-2px);
        box-shadow: 0 1px 6px 0 rgba(255, 0, 0, .2), 0 1px 1px 0 rgba(0, 0, 0, .08);
        border-radius: .2rem;
        cursor:move!important;
    }
    @media(max-width: 768px)
    {
        .small-sticky{
            margin:-24px 0px;
        }
    }
</style>
<link href="{{asset('assets/libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
@endsection
@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
        <a href="javascript:window.history.back()" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <span class="h2 my-0 font-weight-normal text-dark text-center">{{ucfirst($einfo['ename'])}}</span>
        <h6 class="font-weight-bold text-muted text-center">{{ucfirst(Session::get('aclgname'))}}
        </h6>
        <h6 class="text-dark text-center mb-3">
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">
            {{date('d/m/Y',strtotime($einfo['edate']))}}
            </span>
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">
            {{date('l',strtotime($einfo['edate']))}}
            </span>
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">
            {{ucfirst($einfo['e_type'])}} Event
            </span>
        </h6>
        <hr class="my-0">
    </div>
    <div class="card mb-0">
        <div class="card-body py-3 px-2">
            <div class="d-flex align-items-center ">
                <i data-feather="award" class="icon-dual-success"></i>
                <h5>Create Result</h5>
            </div>
        </div>
        <hr class="my-0">
    </div>


    <div class="card new-shadow-sm" id="myHeader">
        <div class="card-body py-1 py-sm-2">
            <div class="row align-items-center" style="margin-bottom:-15px;">
                <div class="col-md-4">
                    <span class="badge badge-success px-5 mb-1">Rank 1</span>
                    <div id="r1" class="card bg-soft-success px-3 p-1 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}" height="35px" alt="1">
                    </div>
                </div>

                <div class="col-md-4 small-sticky">
                    <span class="badge badge-primary px-4 mb-1">Rank 2</span>
                    <div id="r2" class="card bg-soft-primary px-3 p-1 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}" height="35px" alt="2">
                    </div>
                </div>
                <div class="col-md-4">
                    <span class="badge badge-warning px-3 mb-1">Rank 3</span>
                    <div id="r3" class="card bg-soft-warning px-3 p-1 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}" height="35px" alt="3">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="" class="btn btn-success px-3 p-1 new-shadow-sm rounded-sm font-weight-bold hover-me-sm mx-1"  onclick="return rankcheck()">
                    Done
                    <i data-feather="check-square" height="19px"></i>
                </a>
                <a href="#" class="btn btn-danger px-3 p-1 new-shadow-sm rounded-sm font-weight-bold hover-me-sm mx-1"
                    onclick="window.location.reload();">
                    Clear
                    <i data-feather="refresh-cw" height="19px"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-2 pb-2 rounded-sm new-shadow-sm" id="all-candidate">
        <div class="card-body pt-2 pb-2 row justify-content-between">
            <div class="h5 ml-2 d-flex align-items-center">
                <i data-feather="users" class="icon-dual-info"></i>
                <span class="ml-1">
                @if($einfo['e_type']=='team')
                    All Team
                @else
                    All Candidates
                @endif
                </span>
            </div>
            <div class=" mr-2 d-flex align-items-center">
            <?php $c=participant::where('eid',$einfo['eid'])->count()?>
                <span class="badge badge-soft-primary badge-pill px-3">Total
                @if($einfo['e_type']=='team')
                    Team
                @else
                    Participator
                @endif
                </span>
                <span class="badge badge-primary badge-pill ml-1">{{$c}}</span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <input id="myInput" class="form-control" type="text" 
            placeholder="@if($einfo['e_type']=='team')Search Team..
            @else Search Candidates..
            @endif
            ">
        </div>
    </div>


    <div id="my-record" class="accordion custom-accordionwitharrow">
    
        <!-- <div class="card p-1 mb-2 px-1 pb-1 new-shadow-sm stud-info">
                <div class="col-md-12 font-size-16 font-weight-bold text-dark d-flex justify-content-between align-items-center flex-wrap">
                    <div class="col-md-6 row">Piyush Mukeshbhai Monpara</div>
                    <div class="row col-md-6 justify-content-md-end justify-content-around">
                        <div class="custom-control custom-switch  mx-2">
                            <input type="checkbox" name="1" class="switch-1 custom-control-input" id="r1">
                            <label class="custom-control-label" for="r1">1st</label>
                        </div>   
                        <div class="custom-control custom-switch mx-2">
                            <input type="checkbox" name="1" class="switch-2 custom-control-input" id="r2">
                            <label class="custom-control-label" for="r2">2nd</label>
                        </div>
                        <div class="custom-control custom-switch  mx-2">
                            <input type="checkbox" name="1" class="switch-3 custom-control-input" id="r3">
                            <label class="custom-control-label" for="r3">3rd</label>
                        </div>  
                    </div>
                </div>
                <div class="dropdown-divider m-1"></div>
                <div class="col-sm-12 row">
                    <div class="col-6 col-sm-3 d-flex align-items-end">
                        <span class="text-dark pr-1">Enrollment</span>
                        <span class="font-weight-bold">E12345677890</span>
                        <span id="pid" style="display:none;"></span>
                    </div>
                    <div class="col-6 col-sm-3 d-flex align-items-end">
                        <span class="text-dark pr-3">Class</span>
                        <span class="font-weight-bold">Fybca</span>
                    </div>
                    <div class="col-6 col-sm-3  d-flex align-items-end">
                        <span class="text-dark  pr-3">Division</span>
                        <span class="font-weight-bold">1</span>
                    </div>
                    <div class="col-6 col-sm-3  d-flex align-items-end">
                        <span class="text-dark pr-3">Gender</span>
                        <span class="font-weight-bold">Male</span>
                    </div>
                </div>
        </div> -->
    @if($einfo['e_type']=='solo')   
    @foreach($candidates as $p)
        <?php $enrl=explode("-",$p['senrl'])?>
        @foreach($enrl as $e)
            <?php $sinfo = tblstudent::select('senrl', 'sname', 'class', 'division','gender')->where('senrl', $p['senrl'])->first(); ?>
        
        <div class="bg-white p-1 my-2 px-1 pb-1 new-shadow-sm stud-info rounded">
                <div class="col-md-12 font-weight-bold text-dark d-flex justify-content-between align-items-center flex-wrap">
                    <div class=" font-size-16 drag-me px-2 ml-1 rounded-sm bg-white hover-me-sm" style="min-width:150px!important;">
                       <span>{{ucfirst($sinfo['sname'])}}</span> 
                       <span id="pid" style="display:none;">{{$p['pid']}}</span>
                    </div>
                    <div>
                        <span class="badge badge-soft-primary px-3 badge-pill">Solo</span>
                    </div>
                </div>
                <div class="dropdown-divider m-1"></div>
                <div class="col-sm-12 d-flex flex-wrap">
                    <div class="col-6 col-sm-3 d-flex align-items-end">
                        <span class="text-dark pr-1">Enrollment</span>
                        <span class="font-weight-bold">{{ucfirst($sinfo['senrl'])}}</span>
                    </div>
                    <div class="col-6 col-sm-3 d-flex align-items-end">
                        <span class="text-dark pr-3">Class</span>
                        <span class="font-weight-bold">{{ucfirst($sinfo['class'])}}</span>
                    </div>
                    <div class="col-6 col-sm-3  d-flex align-items-end">
                        <span class="text-dark  pr-3">Division</span>
                        <span class="font-weight-bold">{{ucfirst($sinfo['division'])}}</span>
                    </div>
                    <div class="col-6 col-sm-3  d-flex align-items-end">
                        <span class="text-dark pr-3">Gender</span>
                        <span class="font-weight-bold">{{ucfirst($sinfo['gender'])}}</span>
                    </div>
                </div>
        </div>
        @endforeach
    @endforeach
    @endif

    <div class="row">

    @if($einfo['e_type']=='team')
    @foreach($candidates as $p)
        <?php $enrl=explode("-",$p['senrl'])?>
    <div class="col-md-6 team-info">
        <span class="badge text-white badge-pill badge-warning px-3 position-relative" style="top:5px;left:8px;z-index:98;">Team</span>
        <div class="card p-2 my-0 px-1 pb-1 new-shadow-sm">
            <div class="row">
                <div class="col-sm-3 col-md-6 col-6">
                    <div class="bg-white font-weight-bold text-dark">
                        <div class="col-sm-12 drag-me bg-white hover-me-sm px-3">
                            <span class="font-size-16">{{ucfirst($p['tname'])}}</span>
                            <span id="pid" style="display:none;">{{$p['pid']}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9 col-md-6 col-6">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{url('sview_team')}}/{{encrypt($p['pid'])}}" class="d-flex align-items-center badge badge-primary badge-pill p-1 px-2 pr-3 mr-1">
                            <i data-feather="users" height="15px"></i>
                            <span class="">View Candidates</span>    
                        </a>
                    </div>
                </div>
            </div>      
        </div>
    </div>
    @endforeach
    @endif 
    
    </div>
    </div> <!-- end div of id='myrecord' -->
</div> <!-- end container-fluid -->
@endsection

@section('extra-scripts')
<script src="{{asset('assets/libs/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/js/jQueryUITouchPunch.js')}}"></script>
<script src="{{asset('assets/js/sweetalert2.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#my-record  .stud-info, #my-record .team-info").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });
    });
</script>

<script>
    $(function () {
        $('.drag-me').draggable({
            revert: true,
            // drag:function() {
            //     $(this).parent().parent().css('border','1px solid red');
            // }
        });
        $('.droppable-rank').droppable({
            hoverClass: 'active',
            drop: function (e, ui) {
                $(this).html(ui.draggable.remove().html());
                $(this).droppable('destroy');
                $(this).addClass("font-size-16 font-weight-bold text-dark py-1");
                $(this).css("border","2px solid gray");
            }
        });
    });
    

    $('.stud-info,.drag-me').mouseenter(function(){
        $(this).css("z-index","100");
    })

    $('.stud-info,.drag-me').mouseleave(function(){
        $(this).css("z-index","0");
    })
</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
var allCandidate=document.getElementById("all-candidate");

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    allCandidate.style.marginTop="230px";
    
  } else {
    header.classList.remove("sticky");
    allCandidate.style.marginTop="0px";
  }
}
</script>
<script>

function rankcheck() {
        var r1 = $('#r1 #pid').text();
        var r2 = $('#r2 #pid').text();
        var r3 = $('#r3 #pid').text();
        var link = "<?php echo url('sindex') ?>";
        var ename="<?php echo ucfirst($einfo['ename'])?>";
        var eid="<?php echo $einfo['eid'] ?>";
        // alert(r1+r2+r3);
        if(r1=="" && r2=="" && r3=="")
        {
            Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please give any rank..!!',
                    });
                return false;
        }
        if(r2!="")
        {
            if(r1=="")
            {
                Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'if you want to give Rank 2 then Rank 1 is Mandatory..!',
                    });
                return false;
            }
        }
        if(r3!="")
        {
            if(r2=="")
            {
                Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'if you want to give Rank 3 then Rank 1 and Rank 2 is Mandatory..!',
                    });
                return false;
            }
        }
        if(r2 != "" && r3=="")
        {
                        Swal.fire({
            title: 'Are you sure?',
            text: "You give only Rank 1 and Rank 2..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
            }).then((result) => {
            if (result.value) {
                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        type: 'POST',
                        url: '/srank',
                        data: {
                            r1: r1,
                            r2: r2,    
                            r3: r3,
                            utype:'admin',
                            ename:ename,
                            eid:eid,
                        },
                        success: function (data) {
                            window.location.href = link;
                        },
                        error: function (data) {
                        console.log(data);
                        }
                    })
                    
            }
            
            })
            return false;
        }
        if(r1 != "" && r2=="")
        {
                        Swal.fire({
            title: 'Are you sure?',
            text: "You want to give only Rank 1..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
            }).then((result) => {
            if (result.value) {
                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        type: 'POST',
                        url: '/srank',
                        data: {
                            r1: r1,
                            r2: r2,    
                            r3: r3,
                            utype:'admin',
                            ename:ename,
                            eid:eid,
                        },
                        success: function (data) {
                            window.location.href = link;
                        },
                        error: function (data) {
                        console.log(data);
                        }
                    })
                    
            }
            
            })
            return false;
        }
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to Announce the result..!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm'
            }).then((result) => {
            if (result.value) {
                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                    $.ajax({
                        type: 'POST',
                        url: '/srank',
                        data: {
                            r1: r1,
                            r2: r2,    
                            r3: r3,
                            utype:'admin',
                            ename:ename,
                            eid:eid,
                        },
                        success: function (data) {
                            window.location.href = link;
                        },
                        error: function (data) {
                        console.log(data);
                        }
                    })
                    
            }
            
            })
            return false;
}
</script>
@endsection
