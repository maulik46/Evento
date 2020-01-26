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
        .event-link:hover{
            color:#1ac1ae!important;
        }
    </style>
    @endsection
 

    @section('my-content')
    <div>       <!-- start div -->
        
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
           
        <div class=" bg-success fade show border-0 new-shadow rounded-0 position-fixed w-100" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast" style="z-index:99999;top:73px;left:0px">
            <div class="text-white alert mb-1">
                <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                    <i data-feather="x-circle"  height="20px" ></i>
                </a>
                <div class="font-weight-bold font-size-16 text-center">
                    You have successfully participated..!
                </div> 
            </div>
        </div>
        @endif
        @endforeach
                    <!-- carousal Start -->
                    <div class="row align-items-center">
                        <div id="carouselExampleIndicators" class="carousel slide col-xl-8 mt-4" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner new-shadow rounded" role="listbox">
                                <div class="carousel-item active">
                                    <div style="height: 300px; width: 100%;background-color: #d9e4f5;background-image: linear-gradient(315deg, #d9e4f5 0%, #f5e3e6 74%);"
                                        class="d-flex align-items-center justify-content-center flex-column">
                                        <h1 class="text-dark font-size-24">Upcoming Sport Event Notice</h1>
                                        <button
                                            class="btn btn-explore btn-rounded font-weight-light mt-3 px-5 new hover-me-sm">Participate
                                            Now</button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div style="height: 300px; width: 100%;  background-color: #f8f9d2;background-image: linear-gradient(315deg, #f8f9d2 0%, #e8dbfc 74%);"
                                        class="d-flex align-items-center flex-column justify-content-center ">
                                        <h1 class="text-dark font-size-24">Upcoming Cultural Event Notice</h1>
                                        <button
                                            class="btn btn-explore btn-rounded font-weight-light mt-3 px-5 hover-me-sm">Participate
                                            Now</button>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div style="height: 300px; width: 100%; background-color: #fde7f9;background-image: linear-gradient(315deg, #fde7f9 0%, #aacaef 74%);"
                                        class="d-flex align-items-center flex-column justify-content-center flex-column ">
                                        <h1 class="text-dark font-size-24">Upcoming IT Event Notice</h1>
                                        <button
                                            class="btn btn-explore btn-rounded font-weight-light mt-3 px-5 hover-me-sm">Participate
                                            Now</button>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only text-primary">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div> <!-- carousal end -->
                        <div class="col-xl-4 rounded overflow-auto my-scroll bg-white mt-4 new-shadow"
                            style="height: 300px;">
                            <div class="card shadow-none">
                                <div class="card-body pt-2 p-0">
                                    <h6 class="font-size-24 mb-0 pb-1 ml-3 text-center">Events</h6>
                                    <hr>
                                    <?php $a=0?>
                                    @foreach($events as $e)
                                    <?php $c=\DB::table('tblparticipant')->where([['senrl','LIKE','%'.Session::get('senrl').'%'],['eid',$e['eid']]])->count();
                                    ?>
                                    @if($c==0)
                                    <?php $a=1;?>
                                    <div class="media px-3 py-2 new-shadow-sm">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1 header-title  ">{{ucfirst($e['ename'])}}</h4>
                                            <div class="text-muted">{{date('d/m/Y',strtotime($e['edate']))}}</div>
                                            <span
                                                class="text-muted badge rounded-pill 
                                                @if ($e['category'] == 'cultural')badge-soft-primary 
                                                @endif 
                                                @if ($e['category'] == 'it')badge-soft-warning @endif
                                                @if ($e['category'] == 'sports')badge-soft-success 
                                                @endif 
                                                px-3">{{ucfirst($e['category'])}}
                                            </span>

                                        </div>
                                        @if($e['e_type']=='team')
                                        <a href="{{url('/team-insert')}}/{{encrypt($e['eid'])}}">
                                            <i data-feather="external-link"
                                                class="align-self-center text-dark event-link" height="20px">
                                            </i>
                                        </a>
                                        @else
                                        <a href="{{url('/participate-now')}}/{{encrypt($e['eid'])}}">
                                            <i data-feather="external-link" class="align-self-center text-dark event-link" height="20px">
                                            </i>
                                        </a>
                                        @endif
                                        
                                    </div>
                                    @endif
                                    @endforeach
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
                                            <span
                                                class="text-muted text-uppercase font-size-12 font-weight-bold">#sport</span>
                                            <h3 class="mb-0"><a href="{{ url('explore') }}/sports">Sport Events</a></h3>
                                        </div>
                                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                                            <img src="assets/images/svg-icons/student-dash/sport.svg" class="img-fluid"
                                                height="50px" width="50px" alt="">
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
                                            <span
                                                class="text-muted text-uppercase font-size-12 font-weight-bold">#culture</span>
                                            <h3 class="mb-0"><a href="{{ url('explore') }}/cultural">Cultural Events</a></h3>
                                        </div>
                                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                                            <img src="assets/images/svg-icons/student-dash/cultural.svg"
                                                class="img-fluid" height="50px" width="50px" alt="">
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
                                            <span
                                                class="text-muted text-uppercase font-size-12 font-weight-bold">#IT</span>
                                            <h3 class="mb-0"><a href="{{ url('explore') }}/it">IT Events</a></h3>
                                        </div>
                                        <div class="align-self-center mr-2 p-3 rounded-circle bg-color">
                                            <img src="assets/images/svg-icons/student-dash/IT.svg" class="img-fluid"
                                                height="50px" width="50px" alt="">
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

    </div>      <!-- end begining div -->
             
    @endsection 



