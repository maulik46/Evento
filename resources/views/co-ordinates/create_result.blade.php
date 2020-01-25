@extends('co-ordinates/cod_layout')

@section('title','Create Result')

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
                <span class="ml-1">Other Candidates</span>
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
                    <tbody class="text-dark">
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
