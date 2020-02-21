@extends('stud_layout')
@section('title','Explore Events')
@section('my-content')
<div class="container">
    <div id="carouselExampleSlidesOnly" class="carousel slide card my-4 p-1 light-bg1 new-shadow"
        data-ride="carousel">
        <div class="carousel-inner card-body">
            <h5 class="card-title font-size-16">#quotes</h5>
            <div class="carousel-item active">
                <p class="card-text text-dark font-weight-bold font-size-22 lead"
                    style="font-family: comfortaa,open sans!important;">“I always felt that my greatest
                    asset was not my physical ability, it was my mental ability”
                </p>
                <span>– Bruce Jenner</span>
            </div>
            <div class="carousel-item">
                <p class="card-text text-dark font-weight-bold font-size-22 lead"
                    style="font-family: comfortaa,open sans!important;">“A trophy carries dust. Memories last forever.”
                </p>
                <span>– Mary Lou Retton</span>
            </div>
            <div class="carousel-item">
                <p class="card-text text-dark font-weight-bold font-size-22 lead"
                    style="font-family: comfortaa,open sans!important;">“Make sure your worst enemy doesn’t live between
                    your own two ears.”
                </p>
                <span>– Laird Hamilton</span>
            </div>
        </div>
    </div>
    @if(isset($massege))
    <div class="p-4 w-100 d-flex align-items-center justify-content-center font-size-18" style="min-height: 50vh;">
        No new events are available!!
    </div>
    @endif
    @if(isset($events))
    <?php $a=0 ?>
    <div class="row justify-content-xl-start justify-content-md-center justify-content-center mt-4" id="event-box">
        @foreach($events as $e)
        <?php $c=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['eid',$e['eid']]])->count();
                            ?>
        @if($c==0)
        <?php $a=1 ?>
        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card new-shadow hover-me-sm">
                <div class="card-body p-0">
                    <div class="media px-4 py-2 ">
                        <div class="media-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4>
                                    @if($e['e_type']=='team')
                                    <a href="{{url('/team-insert')}}/{{encrypt($e['eid'])}}">
                                            {{ucfirst($e['ename'])}}
                                    </a>
                                    @else
                                    <a href="{{url('/participate-now')}}/{{encrypt($e['eid'])}}">
                                        {{ucfirst($e['ename'])}}
                                    </a>
                                    @endif
                                </h4>
                                <div>
                                    
                                    @if($e['e_type']=='team')
                                    <span class="font-size-13 badge badge-pill badge-soft-warning px-3">
                                        Team Event
                                    </span>
                                    @else
                                    <span class="font-size-13 badge badge-pill badge-soft-success px-3">
                                        Solo Event
                                    </span>
                                    @endif
                                </div>
                                
                            </div>
                            <hr class="mt-0 mb-1">
                            <div class="text-muted">
                                <p class="d-flex justify-content-between my-2">
                                    <span class="font-weight-bold">Date</span>
                                    <span class="mr-2">{{date('d/m/Y',strtotime($e['edate']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between my-2">
                                    <span class="font-weight-bold">Time</span>
                                    <span class="mr-2">{{$e['time']}}</span>
                                </p>
                                <p class="d-flex justify-content-between my-2">
                                    <span class="font-weight-bold">Registration Last-Date</span>
                                    <span class="mr-2">{{date('d/m/Y',strtotime($e['reg_end_date']))}}</span>
                                </p>
                                <p class="d-flex justify-content-between my-2">
                                    <span class="font-weight-bold">Gender Allow</span>
                                    <span class="mr-2">{{ucfirst($e['gallow'])}}</span>
                                </p>
                                <p class="d-flex justify-content-between my-2">
                                    <span class="font-weight-bold">Venue</span>
                                    <span class="mr-2">{{$e['place']}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-top" style="border-color: #e9e9e9!important;">
                        @if($e['e_type']=='team')

                        <a href="{{url('/team-insert')}}/{{encrypt($e['eid'])}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold ">
                            Participate Now
                            <i data-feather="arrow-right-circle" height="18px"></i>
                        </a>
                        @else

                        <a href="{{url('/participate-now')}}/{{encrypt($e['eid'])}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold ">
                            Participate Now
                            <i data-feather="arrow-right-circle" height="18px"></i>
                        </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @endif


        @endforeach
        @if($a==0)
        <div class="p-4 w-100 d-flex align-items-center justify-content-center font-size-18" style="min-height: 50vh;">
            No new events available!!
        </div>
        @endif
        @endif

    </div><!-- end row -->

</div>
@endsection
