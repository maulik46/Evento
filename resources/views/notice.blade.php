@extends('stud_layout')
    @section('title','Notice')
            @section('my-content')
                <div class="container-fluid my-5">
                   <!-- <div class="d-flex align-items-center justify-content-center" style="height: 60vh!important;">
                        <h5>
                           <i data-feather="meh" class="icon-dual"></i>
                           <span>oops..!there is no Notice available</span>
                        </h5>
                   </div> -->
                <div>
                   <?php $c=0;?>
                @foreach($notice as $nt)
                   <?php 
                        $c++;
                        if($c==1)
                        {
                            $new=App\tblstudent::select('last_noti')->where('senrl',Session::get('senrl'))->first();
                            \DB::table('tblstudent')->where('senrl',Session::get('senrl'))->update(['last_noti'=>$nt->nid]);
                        }
                    ?>
                    @if($nt->nid > $new['last_noti'])
                    <div class="card new-shadow-sm my-2" style="border-left: 4px solid #ff5c75;border-radius:0px 10px 10px 0px;">
                    @else
                    <div class="card new-shadow-sm my-2" style="border-left: 4px solid #1AE1AC;border-radius:0px 10px 10px 0px;">
                    @endif
                    <div class="card-body py-1 px-2">
                        <div class="navbar px-1" >
                            <div>
                                <span class="badge badge-primary px-2 py-1">{{date('d/m/Y',strtotime($nt->ndate))}}
                                </span>
                                <span class="badge badge-soft-primary px-2 py-1">{{date('h:i A',strtotime($nt->ntime))}}
                                </span>
                            </div>
                            <div>
                                @if($nt->sender=='System' || $nt->sender=='system')
                                <div class="badge badge-success text-white px-2">
                                    <span>{{ucfirst($nt->sender)}}</span>
                                </div>
                                @else
                                <div class="badge badge-danger text-white px-2">
                                    <span>{{ucfirst($nt->sender)}}</span>
                                </div>
                                <div class="badge badge-soft-danger text-white px-2">
                                    <span>{{ucfirst($nt->sender_type)}}</span>
                                </div>
                                @endif  
                            </div>     
                        </div>
                            <div>
                                <h5 class="mt-1 mb-0">{{ucfirst($nt->topic)}}</h5>
                                <div class="rounded ml-3">
                                    <div class="notice-msg">{!! ucfirst($nt->message) !!}</div>
                                </div>
                                    @if($nt->attechment)
                                        <?php $att = explode(';',$nt->attechment);
                                            $c=count($att);
                                            $a=0;
                                        ?>
                                        <div class="card-action my-0">
                                        @foreach($att as $attachment)
                                            <?php $a++;?>
                                            @if($a<$c)  
                                                <a href="{{asset('attachment')}}/{{$attachment}}" class="btn badge badge-soft-info badge-pill font-weight-bold py-1 pl-2 pr-3 m-1 hover-me-sm" download="{{substr($attachment, 10)}}">
                                                <i data-feather="download" height="16px"></i>{{substr($attachment, 10)}}</a> 
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif
                            </div>
                    </div>
                    </div>
                @endforeach
                @if($c==0)
                <div class="d-flex align-items-center justify-content-center flex-column bg-white rounded new-shadow-sm" style="height:70vh;">
                    <img src="{{asset('assets/images/empty.svg')}}" height="40px" alt="">
                    <h6>Inbox is empty..!</h6>
                </div>
                @endif    
                </div>
                </div>
            @endsection
@section('extra-scripts')
<script>
$('.notice-msg').find('p').css({'margin-bottom':'0px'});
</script>
@endsection

