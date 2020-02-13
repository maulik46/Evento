<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('co-ordinates/cod_layout')

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

    body {
        margin-bottom: 1000px;
    }

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

    .stud-info:hover .drag-me {
        -webkit-transform: translateY(-2px);
        transform: translateY(-2px);
        box-shadow: 0 1px 6px 0 rgba(0, 0, 0, .12), 0 1px 1px 0 rgba(0, 0, 0, .08);
    }
</style>
<link href="{{asset('assets/libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
@endsection
@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
        <a href="{{url('cindex')}}" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <h2 class="font-weight-normal text-dark text-center">Rangoli making Competiton</h2>
        <h6 class="font-weight-normal text-dark text-center">Sutex bank college of computer applications and science
        </h6>
        <h6 class="font-weight-normal text-dark text-center mb-3">
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">12/12/2019</span>
            <span class="ml-1 font-weight-bold  badge badge-soft-dark px-4 badge-pill">Monday</span>
        </h6>
        <hr class="my-0">
    </div>
    <div class="card mb-0">
        <div class="card-body">
            <div class="d-flex align-items-center ">
                <i data-feather="award" class="text-success"></i>
                <h5>Create Result</h5>
            </div>
        </div>
        <hr class="my-0">
    </div>


    <div class="card new-shadow-sm" id="myHeader">
        <div class="card-body py-2">
            <div class="row align-items-center" style="margin-bottom:-15px;">
                <div class="col-md-4">
                    <span class="badge badge-success px-5 mb-1">Rank 1</span>
                    <div class="card bg-soft-success p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}" height="35px" alt="1">
                    </div>
                </div>

                <div class="col-md-4">
                    <span class="badge badge-primary px-4 mb-1">Rank 2</span>
                    <div class="card bg-soft-primary p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}" height="35px" alt="2">
                    </div>
                </div>
                <div class="col-md-4">
                    <span class="badge badge-warning px-3 mb-1">Rank 3</span>
                    <div class="card bg-soft-warning p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                        <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}" height="35px" alt="3">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="#" class="btn btn-success px-4 new-shadow-sm rounded-sm font-weight-bold hover-me-sm mx-1">
                    Done
                    <i data-feather="check-square" height="19px"></i>
                </a>
                <a href="#" class="btn btn-danger px-4 new-shadow-sm rounded-sm font-weight-bold hover-me-sm mx-1"
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
                <span class="ml-1">All Candidates</span>
            </div>
            <div class=" mr-2 d-flex align-items-center">
                <span class="badge badge-soft-primary badge-pill px-3">Total</span>
                <span class="badge badge-primary badge-pill ml-1">2</span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <input id="myInput" class="form-control" type="text" placeholder="Search Candidate..">
        </div>
    </div>


    <div id="my-record" class="accordion custom-accordionwitharrow">
    @foreach($candidates as $p)
    <?php $enrl=explode("-",$p['senrl'])?>
        @foreach($enrl as $e)
            <?php $sinfo = tblstudent::select('senrl', 'sname', 'class', 'division')->where('senrl', $p['senrl'])->first(); ?>

        <div class="card p-1 mb-0 px-1 pb-1  stud-info">
                <a href="#" class="text-dark" data-toggle="collapse" data-target="#c1" aria-expanded="true" aria-controls="c1">
                    <div class="col-md-12 font-size-16 font-weight-bold text-dark d-flex justify-content-between align-items-center">
                        <span>{{ucfirst($sinfo['sname'])}}</span>
                        <i data-feather="chevron-down"></i>
                    </div>
                </a>
                <div class="col-md-12">
                    <span class="text-dark badge badge-soft-primary px-3 mr-2">EID</span>
                    <span class="font-weight-bold">{{ucfirst($sinfo['senrl'])}}</span>
                    <span id="pid" style="display:none;"></span>
                </div>

                <div class="col-md-12 row collapse pt-1" id="c1" data-parent="#my-record">
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Class</span>
                        <span class="font-weight-bold mx-2">{{ucfirst($sinfo['class'])}}</span>
                    </div>
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Division</span>
                        <span class="font-weight-bold mx-2">{{ucfirst($sinfo['division'])}}</span>
                    </div>
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Gender</span>
                        <span class="font-weight-bold mx-2">{{ucfirst($sinfo['gender'])}}</span>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-block btn-success rounded-sm p-0 font-weight-bold" >1st</button>
            </div>
             <div class="col-sm-4">
                <button class="btn btn-block btn-soft-primary rounded-sm p-0 font-weight-bold">2nd</button>
            </div>
            <div class="col-sm-4">
                <button class="btn btn-block btn-soft-warning rounded-sm p-0 font-weight-bold">3rd</button>
            </div>
        </div>
    @endforeach
    @endforeach
         <!-- <div class="card p-1 mb-2 px-1 pb-1 new-shadow-sm stud-info">
                <a href="#" class="text-dark" data-toggle="collapse" data-target="#c2" aria-expanded="true" aria-controls="c2">
                    <div class="col-md-12 font-size-16 font-weight-bold text-dark d-flex justify-content-between align-items-center">
                        <span>Piyush Mukeshbhai Monpara</span>
                        <i data-feather="chevron-down"></i>
                    </div>
                </a>
                <div class="col-md-12">
                    <span class="text-dark badge badge-soft-primary px-3 mr-2">EID</span>
                    <span class="font-weight-bold">E12345677890</span>
                    <span id="pid" style="display:none;"></span>
                </div>

                <div class="col-md-12 row collapse" id="c2" data-parent="#my-record">
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Class</span>
                        <span class="font-weight-bold mx-2">Fybca</span>
                    </div>
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Division</span>
                        <span class="font-weight-bold mx-2">1</span>
                    </div>
                    <div class="col-sm-4  d-flex align-items-end">
                        <span class="text-dark badge badge-soft-dark px-3 mr-2">Gender</span>
                        <span class="font-weight-bold mx-2">Male</span>
                    </div>
                </div>
        </div> -->
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#my-record  .stud-info").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });
    });
</script>

<!-- <script>
    $(function () {
        $('.drag-me').draggable({
            revert: true
        });
        $('.droppable-rank').droppable({
            hoverClass: 'active',
            drop: function (e, ui) {
                $(this).html(ui.draggable.remove().html());
                $(this).droppable('destroy');
                $(this).addClass("bg-white new-shadow-sm");
            }
        });
    });

    $('.stud-info').mouseenter(function(){
        $(this).css("z-index","100");
    })

    $('.stud-info').mouseleave(function(){
        $(this).css("z-index","0");
    })
</script> -->

<!-- <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
var allCandidate=document.getElementById("all-candidate");

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    allCandidate.style.marginTop="300px";
    
  } else {
    header.classList.remove("sticky");
    allCandidate.style.marginTop="0px";
  }
}
</script> -->
@endsection