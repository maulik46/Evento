<?php
    use \App\Http\Controllers\co_ordinate;
    co_ordinate::remain_result();
?>
@extends('stud_layout')

@section('title','Home')


@section('head-tag-links')
<!-- ======== head tag links ======== -->
<style>
    .btn-explore {
        background-color: #fff;
        color: #000;
    }

    .btn-explore:hover {
        background-color: #fff;
        color: #000;
        border-color: #fff;
        transform: translateY(0.1);
        box-shadow: 0 1.1rem 4rem rgba(0, 0, 0, 0.08);
    }

    .btn-explore:active {
        background-color: #fefefe;
        color: #000;
        box-shadow: none;
    }

    .event-link:hover {
        color: var(--success) !important;
    }

    .event-info:hover {
        color: var(--info) !important;
    }

    .form-control {
        border-radius: .15rem;
        background-color: #f3f4f7 !important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7 !important;
        font-size: 1em;
        color: #333 !important;
        height: 40px;
        cursor: text !important;
    }

    .form-control:focus {
        background-color: #f3f4f79a !important;
    }

</style>
@endsection


@section('my-content')
<div>
    <!-- start div -->

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))

    <div class="bg-{{$msg}} fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert"
        aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
        <div class="text-white alert mb-1">
            <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                <i data-feather="x-circle" height="20px"></i>
            </a>
            <div class="font-weight-bold font-size-16 text-center">
                {{Session::get('alert-' . $msg)}}
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <!-- carousal Start -->
    <div class="row align-items-center">
        <div id="carouselExampleIndicators" class="carousel slide col-xl-8 mt-4" data-ride="carousel">
            <?php  
                $tble=App\tblevent::where([['reg_end_date','>=',date('Y-m-d')],
                ['reg_start_date','<=',date('Y-m-d')]])->where('clgcode',Session::get('clgcode'))->get();
                $tblecount=App\tblevent::select('banner')->where([['reg_end_date','>=',date('Y-m-d')],
                ['reg_start_date','<=',date('Y-m-d')]])->where('clgcode',Session::get('clgcode'))->get()->toArray();
                $active=0;
                $ban_c=0;
                $count=0;
                foreach($tblecount as $c)
                {
                    if($c['banner'])
                    {
                        $ban_c++;
                    }
                }
            ?>
            @if($ban_c>0)
            <ol class="carousel-indicators">

                @foreach($tble as $e)

                <?php $att = explode(';',$e['banner']);
                                        ?>
                @foreach($att as $b)
                @if($b)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$count}}" <?php if($active==0) { ?> class="active" <?php $active=1;  } ?>></li>
                <?php $count++; ?>
                @endif
                @endforeach
                @endforeach

            </ol>
            <div class="carousel-inner new-shadow rounded" role="listbox">

                @foreach($tble as $e)

                <?php $att = explode(';',$e['banner']);
                                ?>
                @foreach($att as $b)
                @if($b)
                <div class="carousel-item <?php if($active==1) { ?>  active <?php $active=0;  } ?> ">
                    <div style="height: 300px; width: 100%;background-color: #d9e4f5;background-image:url('../banner/{{$b}}');background-repeat:no-repeat;background-position:center;background-size:cover;')" class="d-flex align-items-center justify-content-end flex-column">

                        <h1 class="bg-soft-dark w-100 text-center text-white font-size-24 mb-5 font-weight-bold">{{ucfirst($e['ename'])}}</h1>
                    </div>
                </div>
                @endif
                @endforeach

                @endforeach
            </div>
            @else
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner new-shadow rounded" role="listbox">
                <div class="carousel-item active">
                    <div style="height: 300px; width: 100%;background-color: #d9e4f5;background-image:url('../assets/images/cod_bg.png')"
                        class="d-flex align-items-center justify-content-end flex-column">
                        <h1 class="text-dark font-size-24 mb-5 font-weight-light">{{Session::get('clgname')}}</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <div style="height: 300px; width: 100%;background-color: #d9e4f5;background-image:url('../assets/images/super_admin_bg.png')"
                        class="d-flex align-items-center justify-content-end flex-column">
                        <h1 class="text-dark font-size-24 mb-5 font-weight-light">Evento IT Solution</h1>
                    </div>
                </div>
            </div>
            @endif
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only text-primary">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> <!-- carousal end -->
        <div class="col-xl-4 rounded overflow-auto my-scroll bg-white mt-4 new-shadow" style="height: 300px;">
            <div class="card shadow-none">
                <div class="card-body pt-2 p-0">
                    <!-- <h6 class="font-size-24 mb-0 pb-1 text-center d-xl-none d-flex">Events</h6> -->
                    <div class="form-group has-icon d-flex align-items-center col-xl-12 col-sm-8 col-12 px-0">
                        <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="myInput" class="form-control" placeholder="Search Events" />
                    </div>
                    <div class="row mx-0" id="event-list">
                        <?php $a=0?>
                        @foreach($events as $e)
                        <?php $c=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['eid',$e['eid']]])->count();
                                    ?>
                        @if($c==0)
                        <?php $a=1;?>

                        <div class="col-xl-12 col-md-6 media my-1 px-2 py-2 new-shadow-sm bg-light hover-me-sm event-name">
                            <div class="media-body">
                                <span class="text-muted badge badge-pill  
                                                @if ($e['category'] == 'cultural')badge-soft-primary 
                                                @endif 
                                                @if ($e['category'] == 'it')badge-soft-warning 
                                                @endif
                                                @if ($e['category'] == 'sports')badge-soft-success 
                                                @endif 
                                                px-3">{{ucfirst($e['category'])}}
                                </span>
                                <span class="text-muted badge badge-pill badge-soft-dark px-3">
                                    {{date('d/m/Y',strtotime($e['edate']))}}
                                </span>
                                <div class="ml-1 mt-2 header-title text-dark">
                                    {{ucfirst($e['ename'])}}
                                </div>


                            </div>
                            <a href="{{url('check_event_info')}}/{{encrypt($e['eid'])}}" data-toggle="tooltip"
                                data-placement="bottom" title="Details" class="mr-1">
                                <i data-feather="info" height="18px" class="text-dark event-info"></i>
                            </a>
                            @if($e['e_type']=='team')
                            <a href="{{url('/team-insert')}}/{{encrypt($e['eid'])}}" data-toggle="tooltip"
                                data-placement="bottom" title="Participate">
                                <i data-feather="arrow-right-circle" class="align-self-center text-dark event-link"
                                    height="18px">
                                </i>
                            </a>
                            @else
                            <a href="{{url('/participate-now')}}/{{encrypt($e['eid'])}}" data-toggle="tooltip"
                                data-placement="bottom" title="Participate">
                                <i data-feather="arrow-right-circle" class="align-self-center text-dark event-link"
                                    height="18px">
                                </i>
                            </a>
                            @endif
                        </div>

                        @endif
                        @endforeach
                    </div>
                    @if($a==0)
                    <div class="p-4 font-weight-bold text-center">
                        No new events available!!
                    </div>
                    @endif
                </div>
            </div>
        </div>


    </div><!-- row end -->

    <!-- row start -->
    <div class="row mt-4" id="event-box">
        <div class="col-lg-4 col-xl-4 ">
            <div class="card new-shadow hover-me-sm">
                <div class="card-body p-0">
                    <div class="media px-3 py-5">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">#sport</span>
                            <h3 class="mb-0"><a href="{{ url('explore') }}/sports">Sport Events</a></h3>
                        </div>
                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                            <img src="assets/images/svg-icons/student-dash/sport.svg" class="img-fluid" height="50px"
                                width="50px" alt="">
                        </div>
                    </div>
                    <div class="border-top" style="border-color: #e9e9e9!important;">
                        <a href="{{ url('explore') }}/sports"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold">Explore
                            Event</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-4">
            <div class="card new-shadow hover-me-sm">
                <div class="card-body p-0">
                    <div class="media px-3 py-5">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">#culture</span>
                            <h3 class="mb-0"><a href="{{ url('explore') }}/cultural">Cultural Events</a></h3>
                        </div>
                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                            <img src="assets/images/svg-icons/student-dash/cultural.svg" class="img-fluid" height="50px"
                                width="50px" alt="">
                        </div>
                    </div>
                    <div class="border-top" style="border-color: #e9e9e9!important;">
                        <a href="{{ url('explore') }}/cultural"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold">Explore
                            Event</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-4">
            <div class="card new-shadow hover-me-sm">
                <div class="card-body p-0">
                    <div class="media px-3 py-5 ">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">#IT</span>
                            <h3 class="mb-0"><a href="{{ url('explore') }}/it">IT Events</a></h3>
                        </div>
                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                            <img src="assets/images/svg-icons/student-dash/IT.svg" class="img-fluid" height="50px"
                                width="50px" alt="">
                        </div>
                    </div>
                    <div class="border-top" style="border-color: #e9e9e9!important;">
                        <a href="{{ url('explore') }}/it"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold">Explore
                            Event</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end row -->

</div> <!-- end begining div -->

@endsection
@section('extra-scripts')
<script>
    $(document).ready(function () {
        $("#myInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#event-list .event-name").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });
    });
</script>
@endsection