@extends('co-ordinates/cod_layout')

@section('title','View Team Candidates')

@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
        <a href="{{url('cindex')}}" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <span class="h3 my-0 font-weight-normal text-dark text-center">
        Team ABC
        </span>
        <h6 class="font-weight-normal text-dark text-center">
        {{ucfirst(Session::get('clgname'))}}
        </h6>
        <hr class="my-0">
    </div>
    <div class="card new-shadow-sm" >
        <div class="card-body">
            <div class="table-responsive overflow-auto my-scroll" style="height: 350px;">
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
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr><tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr><tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr><tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr><tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
                            <td>TYBCA</td>
                            <td>3</td>
                        </tr><tr>
                            <th scope="row">#1</th>
                            <td>E12345</td>
                            <td>Piyush Monpara</td>
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

@section('extra-scripts')
<script>
$(document).ready(function(){
    $('tbody tr:first td:first').next().css("font-weight","bold");
})
</script>
@endsection