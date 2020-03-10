@extends('start/start_layout')
@section('title','Institute List')
@section('head-tag-links')
<style>
        .my-college input[type="radio"][class="myCollege"] {
        display: none;
        }

        .my-college label {
        border: 2px solid transparent;
        display: flex;
        position: relative;
        cursor: pointer;
        }

        .my-college label  {
        transition-duration: 0.2s;
        transform-origin: 50% 50%;
        }
        

        :checked + label  {
        border: 2px solid var(--success)!important;
        background-color:rgba(67,211,158,.25)!important;
        /* border-radius:8px; */
        }
        :checked + label  h6{
            color:#fff!important;
        }

        :checked + label :before {
        content: "";
        transform: scale(1);
        }

        :checked + label  {
        transform: scale(0.970);
        }
</style>

@endsection
@section('my-content')       
        <!-- <div class="mt-4 mx-4 mx-sm-3 d-flex justify-content-center align-items-center">
            <div class="card col-lg-6 col-md-8 col-sm-8 p-2 pt-3 pb-1 new-shadow-2 rounded-lg">
                <h5 class="text-center">Select Your College</h5>
                <hr class="mt-0">
                <div class="col-12">
                    <div class="form-group has-icon d-flex align-items-center">
                        <i data-feather="search" class="form-control-icon text-dark ml-2" height="19px"></i>
                        <input type="text" id="myInput" class="form-control p-3 px-5 font-size-15 rounded"
                            placeholder="Enter Your college name..">
                    </div>
                </div>
                <form method="post" action="{{url('/event_list')}}">
                @csrf
                <div class="clg-list px-2 py-3 overflow-auto my-scroll" style="height: 210px;">
                <?php $a=0?>
                @foreach($clgs as $clg) 
                <?php $a++?>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio{{$a}}" name="clgcode" value="{{$clg->clgcode}}" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio{{$a}}">
                            {{ucfirst($clg->clgname)}} 
                        </label>
                    </div>
                @endforeach
                </div>
                <div class="p-3">
                    <button type="submit"
                        class="btn btn-success new-shadow-sm font-weight-bold new-shadow-sm rounded-sm hover-me-sm px-3 mr-2">
                        Next <i data-feather="arrow-right-circle" height="19px"></i>
                    </button>
                    <button type="reset"
                        class="btn btn-danger new-shadow-sm font-weight-bold new-shadow-sm rounded-sm hover-me-sm px-3 ml-2">
                        Clear <i data-feather="rotate-ccw" height="17px"></i>
                    </button>
                </div>
                </form>
            </div>
        </div>  -->
        <div class="container">
        <div class="rounded new-shadow-sm pt-3" style="background-color:rgba(255,255,255,0.7);">
        <div class="col-lg-4">
            <div class=" form-group has-icon d-flex align-items-center">
                <i data-feather="search" class="form-control-icon text-dark ml-2" height="19px"></i>
                <input type="text" id="myInput" class="w-100 border-0 p-2 pl-5 pr-4 font-size-14 rounded bg-light" placeholder="Search Your Institute/College">
            </div>
        </div>
        <h5 class="text-center text-dark">Select Your Institute/College</h5>
        <hr class="my-1">
        <form method="post" action="{{url('/event_list')}}" class="d-flex align-items-center flex-column" style="min-height:65vh;">
            @csrf
            <div class="row justify-content-center mx-0 mb-auto">
            <?php $a=0?>
            @foreach($clgs as $clg) 
            <?php $a++?>
            <div class="col col-auto my-1">
                <div class="my-college">
                    <input type="radio" class="myCollege" id="customRadio{{$a}}" name="clgcode" value="{{$clg->clgcode}}" />
                    <label for="customRadio{{$a}}" class="btn btn-sm bg-white mb-0 px-4 new-shadow-sm hover-me-sm font-weight-bold" style="border-radius:30px!important;">
                        <span class="font-size-13 text-dark">{{ucfirst($clg->clgname)}}</span>
                    </label>
                </div>
            </div>
            @endforeach
            </div>
            <div class="mb-3">
                <button id="btn-next" type="submit" class="btn btn-success new-shadow-sm font-weight-bold new-shadow-sm rounded-sm hover-me-sm px-3 mr-2">
                        <span>Next</span>
                        <i data-feather="arrow-right-circle" height="19px"></i>
                </button>
                <button id="btn-clear" type="reset" class="btn btn-danger new-shadow-sm font-weight-bold new-shadow-sm rounded-sm hover-me-sm px-3 ml-2">
                        <span>Clear</span>
                        <i data-feather="rotate-ccw" height="17px"></i>
                </button>
            </div>
        </form>
        </div>
        
        <nav class="row justify-content-between align-items-center position-fixed" style="z-index: 999;width: 100%;bottom:10px;left:0px;">
            <div class="d-flex align-items-center justify-content-center mt-0 mt-md-5 mx-4 mx-sm-5">
                <a href="#" class="badge-pill btn bg-white p-1 mx-1 hover-me-sm">
                    <i data-feather="facebook" class="text-primary" height="20px"></i>
                </a>
                <a href="#" class="badge-pill btn bg-white p-1 mx-1  hover-me-sm">
                    <i data-feather="instagram" class="text-danger" height="20px"></i>
                </a>
                <a href="#" class="badge-pill btn bg-white p-1 mx-1  hover-me-sm">
                    <i data-feather="twitter" class="text-info" height="20px"></i>
                </a>
                <a href="#" class="badge-pill btn bg-white p-1 mx-1  hover-me-sm">
                    <i data-feather="linkedin" class="text-blue" height="20px"></i>
                </a>
            </div>
            <a href="{{url('getdemo')}}" class="mt-0 mt-md-5 mx-2 mx-sm-3 badge badge-pill badge-primary hover-me-sm px-3">
                Get a demo
            </a>
            
            
        </nav>
@endsection
@section('extra-scripts')
   <script>
        $(document).ready(function () {
            $("#myInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".clg-list .custom-control").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                });
            });
        });
    // $(document).ready(function() {
    //     // this is for avatar raddio
    //     var allRadios = document.getElementsByName('clgcode');
    //     var booRadio;
    //     var x = 0;
    //     for(x = 0; x < allRadios.length; x++){
    //     allRadios[x].onclick = function() {
    //         if(booRadio == this){
    //         this.checked = false;
    //         booRadio = null;
    //         } else {
    //         booRadio = this;
    //         }
    //     };
    //     } 
    // });

    $(document).ready(function() {
        $('#btn-next').prop("disabled",true);
        $('.myCollege').click(function(){
            if($(this).prop("checked") == true){
                $('#btn-next').prop("disabled",false);
            }
        });
        $('#btn-clear').click(function(){
            $('#btn-next').prop("disabled",true);
            
        })
        
    });
   </script>
@endsection
