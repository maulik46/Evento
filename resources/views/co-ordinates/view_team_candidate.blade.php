<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('co-ordinates/cod_layout')

@section('title','View Team Candidates')

@section('my-content')
<div class="container-fluid">
    <div class="mb-0 pt-2 card new-shadow-sm pb-4">
        <a href="javascript:window.history.go(-1)" class="text-right text-dark px-2">
            <i data-feather="x-circle" id="close-btn" height="20px"></i>
        </a>
    <?php $a=0?>
    @foreach($team_candidates as $tc)
            <?php 
                $a++;
                if($a==1)
                $id=$tc['eid'];
            ?>
        @endforeach
      
        <span class="h3 my-0 font-weight-normal text-dark text-center">
        Team {{ ucfirst($tc['tname']) }}
        </span>
        <h6 class="font-weight-bold text-dark text-center">
        {{ucfirst(Session::get('cclgname'))}}
        </h6>
        <hr class="my-0">
    </div>
    <div class="card new-shadow-sm" >
        <div class="card-body">
            <div class="table-responsive my-scroll">
                <table class="table table-hover table-nowrap mb-0" >
                    <thead style="background-color:#1ce1ac40;color:#000;">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Enrollment</th>
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
                    @if($e) 
                    <?php $c++; $sinfo=tblstudent::where('senrl',$e)->first();?>
                        <tr>
                            <th scope="row">{{$c}}</th>
                            <td>{{$e}}</td>
                            <th>{{ucfirst($sinfo['sname'])}}</th>
                            <td>{{ucfirst($sinfo['class'])}}</td>
                            <td>{{ucfirst($sinfo['division'])}}</td>
                        </tr> 
                    @endif
                    @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

