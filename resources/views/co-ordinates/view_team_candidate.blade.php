<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('co-ordinates/cod_layout')

@section('title','View Team Candidates')

@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm">
        <a href="{{url('/cindex')}}" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
        <span class="h3 my-0 font-weight-normal text-dark text-center">
        Team
        @foreach($team_candidates as $tc)
            {{ ucfirst($tc['tname']) }}    
        @endforeach
        
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
                    <?php $c=0;?>
                    @foreach($team_candidates as $tc)
                    <?php $enrl=explode("-",$tc['senrl'])?>
                    @foreach($enrl as $e)
                    <?php $c++; $sinfo=tblstudent::where('senrl',$e)->first();?>
                        <tr>
                            <th scope="row">{{$c}}</th>
                            <td>{{$e}}</td>
                            <td>{{ucfirst($sinfo['sname'])}}</td>
                            <td>{{ucfirst($sinfo['class'])}}</td>
                            <td>{{ucfirst($sinfo['division'])}}</td>
                        </tr> 
                    @endforeach
                    @endforeach
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