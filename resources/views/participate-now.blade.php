@extends('stud_layout')
@section('title','Participate Now')
@section('head-tag-links') 
    <style>
        .rules-div li{
            margin:14px 0px;
        }
    </style>
@endsection   


@section('my-content')        
<div class="">
                    <div class="col-12 mt-5">
                        <div class="card new-shadow rounded-lg">
                        <div class="text-right p-2">
                            <a href="{{url('/index')}}" class="text-dark" id="close-btn">
                                    <i data-feather="x-circle" height="20px"></i>
                            </a>
                        </div>
                            <div class="px-2">
                            
                                <!-- Logo & title -->
                                    <div class="col-12">
                                        <h2 class="d-flex justify-content-center align-items-center font-weight-normal text-center text-dark my-3"> 
                                            <img src="{{asset('assets/images/svg-icons/student-dash/flag.svg')}}" height="30px" alt="">
                                            <span class="ml-2">{{ucfirst($einfo->ename)}} </span>
                                        </h2>
                                        <p class="text-center">{{ucfirst(Session::get('clgname'))}}</p>
                                        
                                            <div class="d-flex align-items-center justify-content-center flex-wrap">
                                                <span class="badge badge-pill badge-soft-dark px-3 mx-1">
                                                {{date('d/m/Y', strtotime($einfo->edate))}}
                                                </span>
                                                <span class="badge badge-pill badge-soft-dark px-3 mx-1">
                                                {{date('h:i A', strtotime($einfo->time))}}
                                                </span>
                                                <span class="badge badge-pill badge-soft-dark px-3 mx-1">
                                                {{date('l', strtotime($einfo->time))}}
                                                </span>
                                            </div>

                                        <div class="mt-3 pt-2">
                                            <hr>
                                            <h4 class="mb-3 font-size-17 ml-2 d-flex align-items-center">
                                                <i data-feather="info" class="mr-1 icon-dual-dark"></i>
                                                Your Information
                                            </h4>
                                            <hr>
                                            <div class="table-responsive my-scroll overflow-auto pt-4   col-12">
                                                 <table class="table new-shadow-sm">
                                                     <thead class="light-bg1">
                                                         <tr class="text-dark">
                                                             <th>No</th>
                                                             <th>Enrollment</th>
                                                             <th>Name</th>
                                                             <th>Mobile No</th>
                                                             <th>Division</th>
                                                             <th>Class</th>
                                                         </tr>
                                                     </thead>
                                                     <tbody>
                                                         <tr class="text-dark">
                                                             <th scope="row">1</th>
                                                             <td>{{Session::get('senrl')}}</td>
                                                             <td>{{Session::get('sname')}}</td>
                                                             <td>{{Session::get('mobile')}}</td>
                                                             <td>{{Session::get('div')}}</td>
                                                             <td>{{ucfirst(Session::get('class'))}}</td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                <div class="mt-4">
                                    <div class="col-12">
                                        
                                        <div class="mt-3 pt-2">
                                            <hr>
                                            <h4 class="d-flex align-items-center mb-3 font-size-17 ml-2">
                                                <i data-feather="file-text" class="mr-1 icon-dual-dark"></i>
                                                Rules For Compitition
                                            </h4>
                                            <hr>
                                            <div class="rules-div pt-1 text-mutes font-size-15 ml-4">
                                                <ol>
                                                <?php
                                                $rules=(explode(";",$einfo->rules));
                                                $c=0;
                                               ?>
                                                @foreach($rules as $rule)
                                                    @if(strlen($rule)>0)
                                                    <li class="font-weight-bold">
                                                        {{$rule}}
                                                        <?php $c=1;?>
                                                    </li>
                                                    @endif
                                                @endforeach
                                                @if($c==0)
                                                    <div class="font-weight-bold text-center p-1">There are no particular rules for {{ucfirst($einfo->ename)}} Competition!! </div>
                                                @endif
                                                </ol>
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>

                                <div class="mt-5 mb-1 ml-4">
                                    <a href="#" class="px-3 btn btn-success new-shadow rounded-sm hover-me-sm" data-toggle="modal" data-target="#modal-success">
                                        <span class="font-weight-bold font-size-15">Confirm participation</span>
                                       <i data-feather="check-square" height="20px"></i>   
                                    </a>
                                    <br>
                                    <a href="{{url('/index')}}" class="my-3 px-4 font-weight-bold btn btn-info new-shadow rounded-sm hover-me-sm">
                                        <span>Back</span>
                                        <i data-feather="arrow-left-circle" height="20px"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->

    <!-- success modal -->
    <div class="modal fade" id="modal-success" tabindex="-1" role="dialog" aria-labelledby="modal-errorLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">
                         <i data-feather="x-circle" id="close-btn"></i>
                     </span>
                 </button>
             </div>
             <div class="modal-body text-center">
                <h1 class="display-3 text-warning">?</h1>
                <h3 class="text-dark">
                 Confirm Your Action
                </h3>
                <h5  class="text-dark mt-3 font-weight-normal">
                Are you sure you want to participate in this event?
                </h5> 
                <div class="my-4">
                       <a href="{{url('confirm-reg')}}/{{encrypt($einfo->eid)}}/{{encrypt($einfo->maxteam)}}" class="px-3 btn btn-success rounded-sm new-shadow font-weight-bold">
                         <i data-feather="check-circle" height="20px"></i> Confirm Registration
                    </a>
                 </div>
             </div>
         </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


</div>
@endsection            

@section('extra-scripts')

    <script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
          
        setTimeout("preventBack()", 0); 
          
        window.onunload = function () { null }; 
    </script>
@endsection
