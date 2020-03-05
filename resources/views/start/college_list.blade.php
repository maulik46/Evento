@extends('start/start_layout')
@section('title','Institute List')

@section('my-content')       
        <div class="mt-4 mx-4 mx-sm-3 d-flex justify-content-center align-items-center">
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
                <form>
                <div class="clg-list px-2 py-3 overflow-auto my-scroll" style="height: 210px;">
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">
                            Sutex bank college of computer applications & science 
                        </label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">
                            S.V patel college
                        </label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio3">
                            S D J international college
                        </label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio4">
                            S S Agarwal college
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio5">
                            Bhagvan mahavir college
                        </label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio6" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio6">
                            S P B college
                        </label>
                    </div>
                    <div class="custom-control custom-radio mb-2">
                        <input type="radio" id="customRadio7" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio7">
                            Sarvjanik college of computer science
                        </label>
                    </div>
                    
                    
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
   </script>
@endsection