@extends('stud_layout')
@section('title','Insert Team')
@section('head-tag-links')
<style>
    .form-control{
        border-radius: .15rem;
        background-color: #f3f4f7!important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7;
        font-size: 1.1em;
        color:#333!important;
        height: 50px;
        letter-spacing:3px;
        }
        ::placeholder{
           letter-spacing:0px; 
        }
        .form-control:focus{
        border: 1px solid #d1d1d1!important;
        background-color: #f3f4f7c9!important;
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
            <div class="px-2 py-4">
                <div class="mt-4">
                    <div class="col-12">
                        <h2
                            class="d-flex justify-content-center align-items-center font-weight-normal text-center text-dark my-3">
                            <img src="{{asset('assets/images/svg-icons/student-dash/flag.svg')}}" height="30px" alt="">
                            <span class="ml-2">{{ucfirst($einfo['ename'])}} Compitition</span>
                        </h2>
                        <p class="text-center">{{ucfirst(Session::get('clgname'))}}
                        </p>
                        <hr>
                        <div class="p-2 font-size-15">
                            <ol >
                                @if($einfo['gallow']=="both")

                                <li>Both Male and Female are allowed.</li>

                                @else

                                <li>This event is only for {{Session::get('gender')}}.</li>

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

                        <div class="pt-1 pb-3">
                            <hr>
                            <h4 class="mb-3 font-size-17 ml-2 d-flex align-items-center">
                                <i data-feather="user-plus" class="mr-2 icon-dual-dark"></i>
                                Add Team Members

                            </h4>
                            <hr>
                            <h6 class="ml-2 text-muted">
                                **Enter Enrollment ID of your all team members
                            </h6>
                            <br>

                            <div class="row justify-content-center my-4">
                                <form id="add-player" class="col-xl-5 col-md-8 col-sm-10 " method="post"
                                    action="{{ url('insertteam') }}/{{encrypt($einfo['gallow'])}}/{{encrypt($einfo['alw_dif_class'])}}/{{encrypt($einfo['alw_dif_div'])}}">
                                    <?php $n=$einfo['tsize'] ;
                                                 ?>
                                    @csrf
                                    <input type="hidden" value="{{$einfo['eid']}}" name="eid">
                                    @for($i=0;$i<$n;$i++) <div class="form-group">
                                        <label class="form-control-label">Player {{$i+1}}</label>
                                        <input type="text" class="form-control" name="enrl[]" id="enrl{{$i}}"
                                            placeholder="Enter Enrollment ID" @if($i==0)
                                            value="{{Session::get('senrl')}}" readonly @endif>
                                        <span style="color:red">{{$errors->first('enrl.'. $i)}}</span>
                                        <?php $a=$i+1 ?>
                                        @if(Session::get('error'."$a"))
                                        <p style="color:red"> {{Session::get('error'."$a")}}</p>
                                        @endif
                            </div>
                            @endfor
                            <!-- <label class="form-control-label">Member 2</label>
                                                     <input type="text" class="form-control" placeholder="Enter Enrollment ID">

                                                <label class="form-control-label">Member 3</label>
                                                     <input type="text" class="form-control" placeholder="Enter Enrollment ID"> -->

                            
                            <button type="submit" class="hover-me-sm mt-2 px-4 btn btn-success new-shadow-sm rounded-sm">
                                <span class="font-weight-bold font-size-15">Next</span>
                                <i data-feather="arrow-right-circle" height="22px"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
           


        </div>
    </div> <!-- end card -->
</div> <!-- end col-12 -->

@endsection