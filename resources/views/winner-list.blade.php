@extends('stud_layout')

@section('title','Home')

@section('my-content')
            <div class="container-fluid my-5">
                <div class="card mt-2">
                        <div class="card-body">  
                            <div class=" mt-2 ml-2 h4">
                                <img src="{{asset('assets/images/svg-icons/student-dash/winner/ranking.svg')}}" height="30px" alt="">
                                Recent Winners
                                <div class="form-group">
                                    <input type="text" id="sname"  placeholder="Name" name="sname" onkeyup="return fun()">
                                    <select name="clas" id="clas">
                                        <option selected value="">Select Class</option>
                                        <option value="TYBCA">TYBCA</option>
                                        <option value="SYBCA">SYBCA</option>
                                    </select>
                                    <select name="division" id="division">
                                        <option selected value="">Select Division</option>
                                        <option value="3">3</option>
                                    </select>
                                    <input type="text" id="rno"  placeholder="Enter Roll no" name="rno"  onkeyup="return fun()">
                                    <select name="ename" id="ename">
                                        <option selected value="">Select Event</option>
                                        <option value="Arti Decoration">Arti Decoration</option>
                                        <option value="Rangoli">Rangoli</option>
                                    </select>
                                    <select name="category" id="category">
                                        <option selected value="">Select category</option>
                                        <option value="cultural">cultural</option>
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
                                    <!--table diff  -->
                                <div class="col-md-12 col-xl-6 mt-3">
                                    
                                    <div class="table-responsive ">
                                    @if($s->rank=='1')
                                        <table class="table table-hover table-light new-shadow rounded">
                                        
                                        
                                            
                                            <thead class="thead-light">                                    
                                                <tr>
                                                    @if($s->eid%2==0)
                                                    <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3 "
                                                        style="background-color: #ffe2e6;;">
                                                    @else
                                                    <td colspan="4" class="rounded header-title  font-weight-bold text-dark p-3 "
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
                                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}" height="22px" alt="1">
                                                        @elseif($s->rank==2)
                                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}" height="22px" alt="2">
                                                        @elseif($s->rank==3)
                                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}" height="22px" alt="3">
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
                        </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class=" mt-2 ml-2 h4">
                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/ranking.svg')}}" height="30px" alt="">
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
                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/1.svg')}}" height="22px"
                                                alt="1">
                                        </th>
                                        <td>Piyush Monpara</td>
                                        <td>TYBCA</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/2.svg')}}" height="22px"
                                                alt="2">
                                        </th>
                                        <td>Dishant Sakariya</td>
                                        <td>TYBCA</td>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <img src="{{asset('assets/images/svg-icons/student-dash/winner/3.svg')}}" height="22px"
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
    function fun()
    {      
         document.getElementById("search_table").style.display = "block";
        var sname=$('#sname').val();
        var rno=$('#rno').val();
        if(sname.length=="" && rno.length >= 0)
        {
        //     $('#tbody').html('No data found');
        // }
        // if(rno.length=="" && sname.length >= 0)
        // {
        //     $('#tbody').html('No data found');
        // }
        if(rno.length=="")
            {
                $('#tbody').html('No data found');
            }
            else{
        $.ajax({
                url:"action",
                method:'GET',
                dataType:'json',
                data:{"rno":rno},
                success:function(data)
                {
                    console.log(data)
                    $('#tbody').html(data);
                    
                }
                }) 
            }
        }
        if(rno.length=="" && search.length >= 0)
        {
            if(search.length=="")
            {
                $('#tbody').html('No data found');
            }
            else{
            $.ajax({
                url:"action",
                method:'GET',
                dataType:'json',
                data:{"search":search},
                success:function(data)
                {
                    console.log(data)
                    $('#tbody').html(data);
                    
                }
                }) 
            }
        }

        
    }
     $(document).ready(function(){
        
        $('#clas,#division,#category,#ename').change(function(){
        
            
            document.getElementById("search_table").style.display = "block";
            var search=$('#search').val();
            
            var division=$('#division').val();
            var clas=$('#clas').val();
            // alert(clas);
            var rno=$('#rno').val();
            var category=$('#category').val();          
            var ename=$('#ename').val();           
                $.ajax({
                url:"action",
                method:'GET',
                dataType:'json',
                data:{"clas":clas,"division":division,"ename":ename,"category":category},
                success:function(data)
                {
                    console.log(data)
                    $('#tbody').html(data);
                    
                }
                }) 
            
        
        })
    })
</script>
@endsection