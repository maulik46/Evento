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
        height: 40px;
        cursor: text !important;
    }

    .form-control:focus {
        border: 1px solid #d1d1d190 !important;
    }

    .droppable-7 {
        /* width: 100px; */
        /* height: 90px;padding: 0.5em; float: left; 
            margin: 10px; 
            border: 1px solid black; 
            background-color:#A39480; */
    }

    .droppable.active {
        background-color: red;
    }
    body{
        margin-bottom:1000px;
    }
    .sticky {
        position: fixed;
        top: 72px;
        left:0px;
        width:100%;
        border-top:1px solid lightgray;
        border-radius:0px!important;
        z-index:99;
        box-shadow: 0 3px 6px -5px #777;
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
    <!-- <div class="card">
        <div class="card-body">
            <div>
                <span class="badge badge-success px-5 mb-1">Rank 1</span>
                <div class="card bg-soft-success p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                   <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}" height="50px" alt="1">
                </div>

                <span class="badge badge-primary px-4 mb-1">Rank 2</span>
                <div class="card bg-soft-primary p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}" height="40px" alt="2">
                </div>

                <span class="badge badge-warning px-3 mb-1">Rank 3</span>
                <div class="card bg-soft-warning p-2 px-3 droppable-rank" style="border:2px dashed #333;">
                    <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}" height="35px" alt="3">
                </div>
            </div>
            <div class="text-center pt-3">
                <a href="#" class="btn btn-success px-4 new-shadow-sm rounded-sm font-weight-bold hover-me-sm">
                Done
                <i data-feather="check-square" height="19px"></i>
                </a>
                <a href="#" class="btn btn-danger px-4 new-shadow-sm rounded-sm font-weight-bold hover-me-sm" onclick="window.location.reload();">
                Clear
                <i data-feather="refresh-cw" height="19px"></i>
                </a>
            </div>
        </div>
        
    </div> -->

    <div class="card" id="myHeader">
    <div class="card-body">
        <h1>rank</h1>
    </div>
    </div>

    <div class="card mb-2 pb-1 rounded-sm new-shadow-sm">
        <div class="card-body py-2 ">
            <div class="h5 d-flex align-items-center">
                <i data-feather="users" class="icon-dual-info"></i>
                <span class="ml-1">All Candidates</span>
            </div>
        </div>
        <div class="d-flex flex-wrap justify-content-between align-items-center p-2" style="margin-top:-20px;">
            <div class="ml-2 mt-4 d-flex align-items-center">
                <span class="badge badge-soft-primary badge-pill px-3">Total</span>
                <span class="badge badge-primary badge-pill ml-1">2</span>
            </div>
            <div class="d-flex align-items-center col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <input id="myInput" class="form-control" type="text" placeholder="Search Candidate Name..">
            </div>
        </div>
        
    </div>


    <div id="my-record">    
        <div class="card p-1 mb-2 px-3 pb-1 hover-me-sm new-shadow-sm stud-info">
            <div class="font-size-16 font-weight-bold text-dark">
                Piyush Mukeshbhai Monpara
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between p-1">
                <div class="eid">
                    <span class="text-dark">EID</span>
                    <span class="font-weight-bold mx-2">E12345677890</span>
                </div>
                <div>
                    <span class="text-dark">Class</span>
                    <span class="font-weight-bold mx-2">TYBCA</span>
                </div>
                <div>
                    <span class="text-dark">Division</span>
                    <span class="font-weight-bold mx-2">3</span>
                </div>
                <div>
                    <span class="text-dark">Gender</span>
                    <span class="font-weight-bold mx-2">Male</span>
                </div>
            </div>
        </div>

        <div class="card p-1 mb-2 px-3 pb-1 hover-me-sm new-shadow-sm stud-info">
            <div class="font-size-16 font-weight-bold text-dark">
                Pilo  Monpara
            </div>
            <div class="d-flex flex-wrap align-items-center justify-content-between p-1">
                <div>
                    <span class="text-dark">EID</span>
                    <span class="font-weight-bold mx-2">E12345677890</span>
                </div>
                <div>
                    <span class="text-dark">Class</span>
                    <span class="font-weight-bold mx-2">TYBCA</span>
                </div>
                <div>
                    <span class="text-dark">Division</span>
                    <span class="font-weight-bold mx-2">3</span>
                </div>
                <div>
                    <span class="text-dark">Gender</span>
                    <span class="font-weight-bold mx-2">Male</span>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection

@section('extra-scripts')
<script src="{{asset('assets/libs/jquery-ui/jquery-ui.min.js')}}"></script>

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

<script>
    $(function () {
        $('.stud-info').draggable({
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

    $('.stud-info').hover(function(){
        $(this).css("z-index","100");
    })
</script>

<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
    
  } else {
    header.classList.remove("sticky");
  }
}
</script>
@endsection