@extends('stud_layout')
@section('title','Insert Team')
@section('head-tag-links')
<style>
    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7;
        font-size: 16px;
        color: #333 !important;
        height: 50px;
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
                        <span class="ml-2">{{ucfirst($einfo['ename'])}} Compitition</span>
                    </h2>
                    <p class="text-center">{{ucfirst(Session::get('clgname'))}}
                    </p>
                    <hr>
                    <div class="p-2 font-size-15">
                        <ol>
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
                            @if($einfo['alw_diff_class']=="yes")

                            <li>Students from different class allowed.</li>

                            @else

                            <li>Students from different class are not allowed.</li>

                            @endif
                            @if($einfo['alw_diff_div']=="yes")

                            <li>Students from different Division allowed.</li>

                            @else

                            <li>Students from different Division are not allowed.</li>

                            @endif

                        </ol>
                    </div>

                    <div class="pt-1">
                        <hr>
                        <div class="h4 mb-3 font-size-17 ml-2 text-center" id="title1">
                            <i data-feather="user-plus" class="mr-2 icon-dual-dark"></i>
                            <span>Enter Team Members</span>
                        </div>
                        <div class="h4 mb-3 font-size-17 ml-2 text-center" id="title2">
                            <i data-feather="user-plus" class="mr-2 icon-dual-dark"></i>
                            Enter Team Name

                        </div>
                        <hr>
                        <h6 class="ml-2 mt-4 text-muted text-center id-msg">
                            <hr>
                            <span style="top: -25px;position: relative;background-color: white;padding: 6px 20px;">Enter Enrollment ID of your all team members</span>    
                        </h6>
                        <br>

                        <div class="row justify-content-center mt-2">
                            <form id="add-player" class="col-xl-6 col-md-8 col-sm-10 " method="post"
                                action="{{ url('insertteam') }}/{{encrypt($einfo['gallow'])}}/{{encrypt($einfo['alw_dif_class'])}}/{{encrypt($einfo['alw_dif_div'])}}">
                                <?php $n=$einfo['tsize']; ?>
                                @csrf
                                <input type="hidden" value="{{$einfo['eid']}}" name="eid">
                        <div id="part1">
                                    <label class="form-control-label">Team name</label>
                                    <input type="text" class="form-control" name="" id="" placeholder="Enter Team Name" style="letter-spacing: 0;padding:25px;">
                                    <span style="color:red"></span>
                        </div>
                        <div id="part2">
                                @for($i=0;$i<$n;$i++) 
                                <div class="form-group">
                                    <label class="form-control-label">Player {{$i+1}}</label>
                                    <input type="text" class="form-control" name="enrl[]" id="enrl{{$i}}"
                                        placeholder="Enter Enrollment ID" @if($i==0) value="{{Session::get('senrl')}}"
                                        readonly @endif>
                                    <span style="color:red">{{$errors->first('enrl.'. $i)}}</span>
                                    <?php $a=$i+1 ?>
                                    @if(Session::get('error'."$a"))
                                    <p style="color:red"> {{Session::get('error'."$a")}}</p>
                                    @endif
                                </div>
                                 @endfor

                            <button type="submit" class="hover-me-sm mt-2 px-4 btn btn-success new-shadow-sm rounded-sm">
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
            <button class="hover-me-sm mx-2 px-3 btn btn-info new-shadow-sm " id="back-part">
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
    $('#next-part').click(function(){
        $('#part2,#title1,.id-msg,#back-part').show();
        $('#part1,#title2,#next-part').hide();
    });
    $('#back-part').click(function(){
        $('#part2,#title1,.id-msg,#back-part').hide();
        $('#part1,#title2,#next-part').show();
    });
})
</script>
@endsection