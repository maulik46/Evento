@extends('co-ordinates/cod_layout')

@section('title','Create Result')
@section('head-tag-links')
<style>
    .form-control{
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
        border: 1px solid #d1d1d180 !important;
        background-color: #f9f9f9e1 !important;
    }
</style>
@endsection
@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
         <a href="{{url('cindex')}}" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a> 
        <h2 class="font-weight-normal text-dark text-center">Rangoli making Competiton</h2>
        <h6 class="font-weight-normal text-dark text-center">Sutex bank college of computer applications and science</h6>
        <h6 class="font-weight-normal text-dark text-center">
            <span class="font-weight-bold badge badge-soft-dark px-3 badge-pill">12/12/2019</span>
            <span class="ml-1 font-weight-bold  badge badge-soft-dark px-4 badge-pill">Monday</span>
        </h6>
        <hr class=" my-1">
    </div>
  

    <div class="card mb-0 rounded-sm">
        <div class="card-body py-2 d-flex justify-content-between align-items-center">
            <div class="h5 d-flex align-items-center">
                <i data-feather="users" class="icon-dual-info"></i>
                <span class="ml-1">All Candidates</span>
            </div>
            <div class="h6 d-flex align-items-center">
                <span>Total</span>
                <span class="ml-2">3</span>
            </div>
        </div>
        <hr class=" my-1">
    </div>
    <div class="card new-shadow-sm" style="max-height: 350px;">
        <div class="card-body overflow-auto my-scroll">

        <input id="myInput" class="form-control col-lg-3 col-md-4 col-sm-6 mb-2" type="text" placeholder="Search Candidate Name..">

            <div class="table-responsive overflow-auto my-scroll">
                <table class="table table-hover table-nowrap mb-0">
                    <thead style="background-color:#25c2e340;color:#000;">
                        <tr>
                            <th scope="col">EID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Class</th>
                            <th scope="col">Division</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark" id="my-record">
                        <tr>
                            <td>E123</td>
                            <td>Maulik Paghdal</td>
                            <td>Tybca</td>
                            <td>3</td>

                        </tr>
                        <tr>
                            <td>E123</td>
                            <td>Yash Parmar</td>
                            <td>Tybca</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>E123</td>
                            <td>Parth Patthar</td>
                            <td>Tybca</td>
                            <td>3</td>
                        </tr>

                    </tbody>
                </table>
            </div> <!-- end table-responsive-->
        </div> <!-- end card-body-->
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#my-record tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      
    });
  });
});
</script>
@endsection
