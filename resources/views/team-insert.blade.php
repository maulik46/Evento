@extends('stud_layout')
@section('title','Insert Team')
@section('head-tag-links')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7;
        font-size: 16px;
        color: #333 !important;
        height: 45px;
        letter-spacing: 3px;   
    }
    ::placeholder {
        letter-spacing: 0px;
    }
    
    .form-control:focus {
        border: 1px solid #fff !important;
        background-color: #f3f4f79a !important;
    }

    ol li {
        margin-bottom: 5px;
        margin-left: 12px;
    }
</style>
@endsection


@section('my-content')

<div class="col-12 mt-5">
    <div class="card new-shadow rounded-lg">
    
        <div class="px-2 pb-2 pt-0">
        <div class="my-2 text-right">
             <a href="{{url('/index')}}" class="text-dark" id="close-btn">
                <i data-feather="x-circle" height="20px"></i>
            </a>
        </div>
           
                <div class="col-xl-12">
                    <h2
                        class="d-flex justify-content-center align-items-center font-weight-normal text-center text-dark my-3 mt-4s">
                        <img src="{{asset('assets/images/svg-icons/student-dash/flag.svg')}}" height="30px" alt="">
                        <span class="ml-2">{{ucfirst($einfo['ename'])}}</span>
                    </h2>
                    <div class="text-center font-weight-bold text-dark">
                        <span>{{ucfirst(Session::get('clgname'))}}</span><br>
                        <span class="font-weight-light">{{ucfirst($einfo['cname'])}} (Co-ordinator)</span> 
                    </div>
                    
                    <hr>
                    <div class="p-2">
                        <span class="h6 text-dark">Following are some rules for this competition :</span>
                        <ol class="font-size-14 text-dark mt-2">
                            @if($einfo['gallow']=="both")

                            <li>Both Boys and Girls candidates are allowed.</li>

                            @else

                            <li>
                                This event is only for
                                @if(Session::get('gender')=='male')
                                {{'Boys'}}.
                                @else
                                {{'Girls'}}.
                                @endif
                            </li>

                            @endif
                            @if($einfo['alw_dif_class']=="yes")

                            <li>Students from different class allowed.</li>

                            @else

                            <li>Students from different class are not allowed.</li>

                            @endif
                            @if($einfo['alw_dif_div']=="yes")

                            <li>Students from different Division allowed.</li>

                            @else

                            <li>Students from different Division are not allowed.</li>

                            @endif

                        </ol>
                    </div>

                    <div class="pt-1">
                        <hr>
                        <div class="row align-items-center justify-content-center" id="title1" style="display:none;">
                            <img src="{{asset('assets/images/svg-icons/student-dash/team.svg')}}" class="mr-2" height="30px" alt="">
                            <span class="h5">Enter Team Members</span>
                        </div>
                        <div class="row align-items-center justify-content-center" id="title2">
                            <img src="{{asset('assets/images/svg-icons/student-dash/team.svg')}}" class="mr-2" height="30px" alt="">
                            <span class="h5">Enter Team Name</span>

                        </div>
                        <hr>
                        <h6 class="ml-2 mt-4 text-muted text-center id-msg d-none">
                            <hr>
                            <span style="top: -25px;position: relative;background-color: white;padding: 6px 20px;">Enter Enrollment ID of your all team members</span>    
                        </h6>
                        <br>

                        <div class="row justify-content-center mt-2">
                            <form id="add-player" action="{{url('insertteam')}}" class="col-xl-6 col-md-8 col-sm-10 " method="post" onsubmit="return check()">
                                <?php $n=$einfo['tsize']; ?>
                                @csrf
                                <input type="hidden" id="eid" value="{{$einfo['eid']}}" name="eid">
                        <div id="part1">
                            <label class="text-dark">Team Name</label>
                            <div class="form-group has-icon d-flex align-items-center mb-1">
                                <img src="{{asset('assets/images/svg-icons/student-dash/team_name.svg')}}" class="form-control-icon ml-2" height="19px" alt="">
                                <input type="text" id="tname" onkeyup="return checktname()" class="form-control" name="tname" id="" placeholder="Enter Team Name" style="letter-spacing: 0;" />
                            </div>
                            <span id="tnameerr" class="text-danger font-weight-bold"></span>
                        </div>
                        <div id="part2" style="display:none">
                        <script>a=0 ;</script>
                        @for($i=0;$i<$n;$i++) 
                            <div class="form-group">
                                @if($i==0)
                                <label class="form-control-label">Player 1(You)</label>
                                <input type="text" class="form-control font-weight-bold" style="color:var(--dark-gray)!important;" name="enrl[]" id="enrl{{$i}}" 
                                    placeholder="Enter Enrollment ID" value="{{Session::get('senrl')}}"
                                    readonly >
                                    <script>a++ ;</script>
                                @else
                                <label class="form-control-label">Player {{$i+1}}</label>
                                <input type="text" class="form-control" onkeyup="return checkplayer(this.id)" onblur="this.value=this.value.toUpperCase()" name="enrl[]" id="enrl{{$i}}"
                                    placeholder="Enter Enrollment ID">
                                    <script> a++ ;</script>
                                @endif
                                <span class="text-danger font-weight-bold">{{$errors->first('enrl.'. $i)}}</span>
                                <?php $a=$i+1 ?>
                                @if(Session::get('error'."$a"))
                                <p class="text-danger font-weight-bold"> {{Session::get('error'."$a")}}</p>
                                @endif
                            </div>
                        @endfor

                            <button type="submit" onclick="return sameplayer()" class="hover-me-sm mt-2 px-3 btn btn-success new-shadow-sm rounded-sm">
                                <span class="font-weight-bold font-size-15">Participate Now</span>
                                <i data-feather="check-circle" height="22px"></i>
                            </button>
                        </div>        


                        </form>
                        
                    </div>
                </div> <!-- end col -->
        </div>

        <div class="d-flex justify-content-end mt-3 pb-3 px-2">
            <button class="hover-me-sm mx-2 px-3 btn btn-success new-shadow-sm" id="next-part">
                <span class="font-size-14 font-weight-bold">Next</span>
                <i data-feather="arrow-right-circle" height="22px"></i>
            </button>
            <button class="hover-me-sm mx-2 px-3 btn btn-info new-shadow-sm" style="display:none" id="back-part">
                <i data-feather="arrow-left-circle" height="22px"></i>
                <span class="font-size-14 font-weight-bold">Back</span>
            </button>
        </div>
    </div>
</div> <!-- end card -->
</div> <!-- end col-12 -->

@endsection

@section('extra-scripts')
<script>
$(document).ready(function(){
    $('#part2,#title1,.id-msg,#back-part').hide();
    
    $('#back-part').click(function(){
        $('#part2,#title1,.id-msg,#back-part').hide();
        $('#part1,#title2,#next-part').show();
    });
  
    $('#next-part').click(function(){
        if($('#tname').val()=="")
        {
            $('#tnameerr').text("Plase enter team name");   
        }
        if($('#tname').val().length > 5 && $('#tnameerr').text().length==""){
        $('#part2,#title1,.id-msg,#back-part').show();
        $('#part1,#title2,#next-part').hide();
    }
    });
    
    
})

function checktname(){
    var tname=$('#tname').val();
    var eid=$('#eid').val();
    if($('#tname').val().length <= 5)
    {
        $('#tnameerr').text("Team name must be greater then 5 charecter");
    }
    else
    {
        $('#tnameerr').text("");
    }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/tnameexist',
            data: {
                tname: tname,
                eid:eid,
            },
            success: function (data) {
                if (data.msg > 0) {
                    $('#tnameerr').text("*This name is already taken");
                } 
                else{
                    $('#tnameerr').text();
                }
            },
            error: function (data) {
                console.log(data);
            }
        })
}
function check(){
    var c=0;
    for(i=0;i<a;i++)
    {
        var enrl=$('#enrl'+i).val();
        if($('#enrl'+i).val()=="")
        {
            $('#enrl'+i).next().next().html("Enter enrollment no of<b> Player "+(i+1)+"</b>");
            c++;
        }
        else{
        }
       
    }
    $( "input[name^='news']" ).val( "news here!" );
    if(!$("input[id^='enrl']").next().next().text()=="")
    {
    return false;
    }
}
function sameplayer()
{
    var c=0;
    for(i=0;i<a;i++)
    {
        var enrl=$('#enrl'+i).val();
        for(j=0;j<i;j++)
        {
            var enrl2=$('#enrl'+j).val();
            if(enrl==enrl2)
            {
                $('#enrl'+i).next().next().html("This Enrollment number is same as <b> Player "+(j+1)+"</b>");
            }
        }
    }
}
function checkplayer(id)
{
    var enrl=$('#'+id).val();
    var eid=$('#eid').val();
    var galw='<?php echo $einfo['gallow'] ?>';
    var alw_diff_class='<?php echo $einfo['alw_dif_class'] ?>';
    var a_d_d='<?php echo $einfo['alw_dif_div'] ?>';
    var efor='<?php echo $einfo['efor'] ?>';
    $.ajax({
            type: 'GET',
            url: '/teamvalidation',
            data: {
                enrl: enrl,
                eid:eid,
                galw:galw,
                alw_diff_class:alw_diff_class,
                a_d_d:a_d_d,
                efor:efor,
            },
            success: function (data) {
                if(data.msg.length==0)
                {
                    $('#'+id).next().next().html("");
                }
                else
                {
                     $('#'+id).next().next().html(data.msg);
                }
            },
            error: function (data) {
                console.log(data);
            }
        })
}
</script>
@endsection
