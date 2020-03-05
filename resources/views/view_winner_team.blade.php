
@extends('stud_layout')

@section('title','Winner List')
@section('head-tag-links')
<style>

</style>
@endsection
@section('my-content')
<div class="container-fluid my-5">
    <div class="mb-0 pt-2 card new-shadow-sm py-4">

        <span class="h3 my-0 font-weight-normal text-dark text-center">
        Team Blue
        </span>
        <h6 class="font-weight-normal text-dark text-center">
            Sutex Bank College
        </h6>
        <hr class="my-0">
    </div>
    <div class="card new-shadow-sm" >
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-nowrap mb-0" >
                    <thead style="background-color:#1ce1ac40;color:#000;">
                    
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">EID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Class</th>
                            <th scope="col">Division</th>                
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        <tr>
                            <td>1</td>
                            <td>e123456erew</td>
                            <td>Maulik</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

