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
    .single_carousel{
        height: 300px; 
        width: 100%;
        background-color: #ffe2e6;
        background-image:url('../assets/images/right_side.png');
        background-size:contain;
        background-repeat:no-repeat;
        background-position:right;
        
    }
    .libq_box{
        background-color: transparent !important;
        border-radius:0px!important;
        padding:0px!important;
        margin:0px!important;
        width:100%!important;
        font-family: 'Comic Sans MS'!important;
        color: var(--dark)!important;
        font-size:1.48em!important;
    }
    .event-link:hover {
        color: var(--success) !important;
    }

    .event-info:hover {
        color: var(--info) !important;
    }

    .form-control {
        border-radius: .15rem;
        background-color: #fff !important;
        padding: 10px 15px;
        border: 1px solid #eaeaea !important;
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
                <a href="../banner/{{$b}}" target="_blank">
                    <div style="height: 300px; width: 100%;background-color: #d9e4f5;background-image:url('../banner/{{$b}}');background-repeat:no-repeat;background-position:center;background-size:cover;')" class="d-flex align-items-center justify-content-end flex-column">

                        <h1 class="w-100 text-center text-white font-size-24 mb-5 font-weight-bold" style="background-color:rgba(0,0,0,0.5);">{{ucfirst($e['ename'])}}</h1>
                    </div>
                  </a>
                </div>
                @endif
                @endforeach

                @endforeach
            </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only text-primary">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            @else
                <div class="single_carousel d-flex align-items-start justify-content-center flex-column new-shadow flex-wrap">
                    <div class="col-10 d-flex align-items-start justify-content-center flex-column">
                    <img src="{{asset('assets/images/svg-icons/student-dash/left-quote3.svg')}}" height="50px" alt="">
                    <!-- <script type="text/javascript" src="https://libquotes.com/widget/qotd.js?st=1"></script> -->
                    <div class="libq_box">
                        <script src="https://www.coolnsmart.com/qotd/qotd.txt" type="text/javascript"></script>
                    </div>
                    </div>
                </div>
            @endif
            
        </div> <!-- carousal end -->
        <div class="col-xl-4 rounded overflow-auto my-scroll bg-white mt-4 new-shadow" style="height: 300px;">
            <div class="card shadow-none">
                <div class="card-body pt-2 p-0">
                    <!-- <h6 class="font-size-24 mb-0 pb-1 text-center d-xl-none d-flex">Events</h6> -->
                    <div class="form-group has-icon d-flex align-items-center col-xl-12 col-md-6 col-12 px-0 mb-1 new-shadow-sm">
                        <i data-feather="search" class="form-control-icon ml-2" height="19px"></i>
                        <input type="text" id="myInput" class="form-control" placeholder="Search Events" />
                    </div>
                    <div class="row mx-0" id="event-list">
                        <?php $a=0?>
                        @foreach($events as $e)
                        <?php $c=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['eid',$e['eid']]])->count();?>
                        @if($c==0)
                        <?php $a=1;?>

                        <div class="col-xl-12 col-md-6 media my-1 px-2 py-2 new-shadow-sm bg-light hover-me-sm event-name">
                            <div class="media-body">
                                <span class="text-muted badge badge-pill badge-soft-primary px-3">{{ucfirst($e['category_name'])}}
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
                    <div class="no-result-img" style="height:135px;background-size:220px;"> 
                    </div>
                    <h6 class="mt-1 font-size-12 text-center darkblue">No new events available!!</h6>
                    @endif
                </div>
            </div>
        </div>


    </div><!-- row end -->

    <!-- row start -->
    <div class="row mt-4" id="event-box">
    <?php $category=\DB::table('tblcategory')->where('clgcode',Session::get('clgcode'))->get(); ?>
    @foreach($category as $cat)
        <div class="col-lg-4 col-xl-4 ">
            <div class="card new-shadow hover-me-sm">
                <div class="card-body p-0">
                    <div class="media px-3 py-5">
                        <div class="media-body">
                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">#{{strtoupper($cat->category_name)}}</span>
                            <h3 class="mb-0">{{ucfirst($cat->category_name)}} Events</h3>
                        </div>
                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                            <img src="{{asset('assets/images/svg-icons/super-admin/event_cat')}}/{{$cat->cat_pic}}" class="img-fluid" height="50px"
                                width="50px" alt="">
                        </div>
                    </div>
                    <div class="border-top" style="border-color: #e9e9e9!important;">
                        <a href="{{url('explore')}}/{{encrypt($cat->category_id)}}"
                            class="text-center btn btn-light btn-block rounded-0 text-dark font-weight-bold">Explore Events</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
        $('.libq_box').find('b').css('display','none');
        $('.libq_box').find('br').remove();
        $('.libq_box').find('div a').css({'font-size':'0.7em','color':'var(--dark)','font-weight':'bold'});
        $('.libq_box').find('div a').prepend('- ');

        $('.quote').find('b').remove();
    });
</script>
@endsection
