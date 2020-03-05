<?php 
    use App\tblstudent;
    use App\participant;
?>
@extends('stud_layout')

@section('title','Winner List')
@section('head-tag-links')
<style>

</style>
@endsection
@section('my-content')
<div class="container-fluid my-5">
    <div class="mb-0 pt-2 card new-shadow-sm py-4">
    <?php $a=0?>
    @foreach($winner_team as $win)
            <?php 
                $a++;
                if($a==1)
                $id=$win['eid'];
            ?>
        @endforeach
      
        <span class="h3 my-0 font-weight-normal text-dark text-center">
        Team
        @foreach($winner_team as $win)
            {{ ucfirst($win['tname']) }}    
        @endforeach
        
        </span>
        <h6 class="font-weight-normal text-dark text-center">
        {{ucfirst(Session::get('clgname'))}}
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
                    <?php $c=0;?>
                    @foreach($winner_team as $win)
                    <?php $enrl=explode("-",$win['senrl'])?>
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

