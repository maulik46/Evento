<?php
use  App\tblstudent;
?>
@extends('stud_layout')

@section('title','Winner List')

@section('my-content')
            <div class="container-fluid my-5">
                <div class="card mt-2">
                <div class="card-body">

                    <div class=" mt-2 ml-2 h4">
                        <img src="assets/images/svg-icons/student-dash/winner/ranking.svg" height="30px" alt="">
                        Recent Winners
                        <div class="form-group">
                            <!-- <div id="demo2" onmouseover="return demo()">
                            <h1> hi</h1>
                            </div> -->
                            <input type="text" id="sname" placeholder="Name" name="sname">
                            <select name="clas" id="clas" onchange="return func();">
                                <option selected value="">Select Class</option>
                                @foreach($ddclass as $class)
                                <option value="{{$class->class}}">{{$class->class}}</option>
                                @endforeach
                            </select>
                            <select name="division" id="division">
                                <option selected value="">Select Division</option>

                            </select>
                            <input type="text" id="rno" placeholder="Enter Roll no" name="rno">
                            <select name="ename" id="ename">
                                <option selected value="">Select Event</option>
                                @foreach($ddename as $ename)
                                <option value="{{$ename->ename}}">{{$ename->ename}}</option>
                                @endforeach
                            </select>
                            <select name="category" id="category">
                                <option selected value="">Select category</option>
                                @foreach($ddcategory as $category)
                                <option value="{{$category->category}}">{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- start searching table -->
                        <div class="col-xl-12 col-xl-6 mt-3" id="search_table" style="display:none">
                            <div class="table-responsive">
                                <table class="table table-hover table-light new-shadow rounded">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Rank</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>
                                            <th scope="col">Roll No</th>
                                            <th scope="col">Events</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Event Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">

                                    </tbody>
                                    <tbody id="tbody2">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- over searching table -->
                    </div>
                    <div class="row justify-content-between p-2">
                        @if($count==0)
                        <span class="font-size-14">Not Event generate</span>
                        @else
                        @foreach($stud as $s)


                        <!--------------------------table diff  --------------------------------------------------------->


                        <div class="col-md-12 col-xl-6 mt-3">

                            <div class="table-responsive ">
                                @if($s->rank=='1')
                                <table class="table table-hover table-light new-shadow rounded">



                                    <thead class="thead-light">
                                        <tr>
                                            @if($s->eid%2==0)
                                            <td colspan="4"
                                                class="rounded header-title  font-weight-bold text-dark p-3 "
                                                style="background-color: #ffe2e6;;">
                                                @else
                                            <td colspan="4"
                                                class="rounded header-title  font-weight-bold text-dark p-3 "
                                                style="background-color: #dde1fc;">
                                                @endif
                                                {{$s->ename}} Competition Winners
                                                <br>
                                                <span class="font-size-14">{{ $s->edate }}</span>
                                            </td>
                                        </tr>
                                        <tr>


                                            <th scope="col">Rank</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>

                                        </tr>

                                    </thead>
                                    @endif

                                    @if($s->rank=='3')

                                    <tbody>

                                        @endif

                                        <tr>
                                            <th scope="row">
                                                @if($s->rank==1)
                                                <img src="assets/images/svg-icons/student-dash/winner/1.svg"
                                                    height="22px" alt="1">
                                                @elseif($s->rank==2)
                                                <img src="assets/images/svg-icons/student-dash/winner/2.svg"
                                                    height="22px" alt="2">
                                                @elseif($s->rank==3)
                                                <img src="assets/images/svg-icons/student-dash/winner/3.svg"
                                                    height="22px" alt="3">
                                                @endif
                                            </th>

                                            <td>{{$s->sname}}</td>
                                            <td>{{$s->class}}</td>
                                            <td>{{$s->division}}</td>
                                        </tr>

                                        <?php
                                            if($s->rank=='3')
                                            {
                                            ?>
                                    </tbody>
                                </table>
                                <?php
                                            } 
                                            ?>
                            </div>
                        </div>

                        @endforeach
                        @endif

                    </div>
                    <!-- team start -->
                    <div class="row justify-content-between p-2">
                        @if($count==0)
                        <span class="font-size-14">Not Event generate</span>
                        @else
                        @foreach($team as $t)
                        <?php $st=DB::table('tblparticipant')
                                ->join('tblevents', 'tblparticipant.eid', '=', 'tblevents.eid')
                                ->select('tblparticipant.*', 'tblevents.*')
                                ->where('tblparticipant.rank', '!=', 'P')
                                ->where('tblparticipant.eid', '=', $t->eid)
                                ->where('tblevents.e_type', '=', 'team')
                                ->orderBy('tblparticipant.rank','asc')
                                ->get()->toArray(); 
                        ?>
                        @foreach($st as $s)
                        <!--table diff  -->
                        <div class="col-md-12 col-xl-6 mt-3">

                            <div class="table-responsive ">
                                @if($s->rank=='1')
                                <table class="table table-hover table-light new-shadow rounded">



                                    <thead class="thead-light">
                                        <tr>
                                            @if($s->eid%2==0)
                                            <td colspan="4"
                                                class="rounded header-title  font-weight-bold text-dark p-3 "
                                                style="background-color: #ffe2e6;;">
                                                @else
                                            <td colspan="4"
                                                class="rounded header-title  font-weight-bold text-dark p-3 "
                                                style="background-color: #dde1fc;">
                                                @endif
                                                <?php $tblevents=DB::table('tblevents')->where('eid',$s->eid)->get()->first(); ?>
                                                {{$tblevents->ename}} Competition Winners
                                                <br>
                                                <span class="font-size-14">{{ $tblevents->edate }}</span>
                                            </td>
                                        </tr>
                                        <tr>


                                            <th scope="col">Rank</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Division</th>

                                        </tr>

                                    </thead>
                                    @endif

                                    @if($s->rank=='3')

                                    <tbody>

                                        @endif

                                        <tr>
                                            <th scope="row">
                                                @if($s->rank==1)
                                                <img src="assets/images/svg-icons/student-dash/winner/1.svg"
                                                    height="22px" alt="1">
                                                @elseif($s->rank==2)
                                                <img src="assets/images/svg-icons/student-dash/winner/2.svg"
                                                    height="22px" alt="2">
                                                @elseif($s->rank==3)
                                                <img src="assets/images/svg-icons/student-dash/winner/3.svg"
                                                    height="22px" alt="3">
                                                @endif
                                            </th>
                                            <td colspan="3" align="center" style="font-weight: bold;">
                                                {{ucfirst($s->tname)}}</td>
                                        </tr>
                                        <?php       $enrl=explode("-",$s->senrl);             ?>
                                        @foreach($enrl as $en)
                                        <tr>
                                            <?php $tbls=tblstudent::where('senrl',$en)->first();?>
                                            <th></th>
                                            <td>{{$tbls['sname']}}</td>
                                            <td>{{$tbls['class']}}</td>
                                            <td>{{$tbls['division']}}</td>
                                        </tr>
                                        @endforeach
                                        <?php
                                            if($s->rank=='3')
                                            {
                                            ?>
                                    </tbody>
                                </table>
                                <?php
                                            } 
                                            ?>
                            </div>
                        </div>

                        @endforeach
                        @endforeach
                        @endif

                    </div>
                    <!-- team over -->
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class=" mt-2 ml-2 h4">
                        <img src="assets/images/svg-icons/student-dash/winner/ranking.svg" height="30px" alt="">
                        Past Winners
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-light new-shadow rounded">
                            <thead class="thead-light">
                                <tr>
                                    <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3"
                                        style="background-color: #dde1fc;">
                                        Khoo-Khoo Competition Winners
                                        <br>
                                        <span class="font-size-14">Date: 03/11/2019</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">Rank</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Division</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <img src="assets/images/svg-icons/student-dash/winner/1.svg" height="22px"
                                            alt="1">
                                    </th>
                                    <td>Piyush Monpara</td>
                                    <td>TYBCA</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <img src="assets/images/svg-icons/student-dash/winner/2.svg" height="22px"
                                            alt="2">
                                    </th>
                                    <td>Dishant Sakariya</td>
                                    <td>TYBCA</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <img src="assets/images/svg-icons/student-dash/winner/3.svg" height="22px"
                                            alt="3">
                                    </th>
                                    <td>Yash Parmar</td>
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
        function func()
        {
                var clas=$('#clas').val();
                //alert(clas);
                $.ajax({
                    url:"action_division",
                    method:'GET',
                    dataType:'json',
                    data:{"clas":clas},
                    success:function(data)
                    {
                        console.log(data)
                        $('#division').html(data);
                    }
            })
        
        }
        function demo()
        {
                var clas=$('#demo2').val();
                //alert(clas);
                $.ajax({
                    url:"demo",
                    method:'GET',
                    dataType:'json',
                    data:{"name":"parth"},
                    success:function(data)
                    {
                        console.log(data)
                        $('#demo2').html(data);
                    }
            })
        
        }
        // function fun()
        // {      
        //     document.getElementById("search_table").style.display = "block";
        //     var sname=$('#sname').val();
        //     var rno=$('#rno').val();
        //     if(sname.length=="" && rno.length >= 0)
        //     {
        //     //     $('#tbody').html('No data found');
        //     // }
        //     // if(rno.length=="" && sname.length >= 0)
        //     // {
        //     //     $('#tbody').html('No data found');
        //     // }
        //     if(rno.length=="")
        //         {
        //             $('#tbody').html('No Data Found...!');
        //         }
        //         else{
        //     $.ajax({
        //             url:"action",
        //             method:'GET',
        //             dataType:'json',
        //             data:{"rno":rno},
        //             success:function(data)
        //             {
        //                 console.log(data)
        //                 $('#tbody').html(data);
                        
        //             }
        //             }) 
        //         }
        //     }
        //     if(rno.length=="" && sname.length >= 0)
        //     {
        //         if(sname.length=="")
        //         {
        //             $('#tbody').html('No Data Found...!');
        //         }
        //         else{
        //         $.ajax({
        //             url:"action",
        //             method:'GET',
        //             dataType:'json',
        //             data:{"sname":sname},
        //             success:function(data)
        //             {
        //                 console.log(data)
        //                 $('#tbody').html(data);
                        
        //             }
        //             }) 
        //         }
        //     }

            
        // }
        $(document).ready(function(){
           
            $('#clas,#division,#category,#ename,#sname,#rno').on('keyup change',function(){
            
                
                document.getElementById("search_table").style.display = "block";
                var search=$('#search').val();
               // alert("h1");
               
                var division=$('#division').val();
                var clas=$('#clas').val();
                // alert(clas);
                var rno=$('#rno').val();
                var category=$('#category').val();          
                var ename=$('#ename').val();
                var sname=$('#sname').val();
                var rno=$('#rno').val();  
            
                
                    $.ajax({
                    url:"filter",
                    method:'GET',
                    dataType:'json',
                    data:{"clas":clas,"division":division,"ename":ename,"category":category,"sname":sname,"rno":rno},
                    success:function(data)
                    {
                        console.log(data)
                        $('#tbody').html(data);
                    }
                    
                    }) 
                
            
            });
        });
    
</script>
@endsection