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
                    <div class="card new-shadow-sm my-2 hover-me-sm" style="border-left: 4px solid #ff5c75;border-radius:0px 10px 10px 0px;">
                    @else
                    <div class="card new-shadow-sm my-2 hover-me-sm" style="border-left: 4px solid #1AE1AC;border-radius:0px 10px 10px 0px;">
                    @endif
                    <div class="card-body py-2 px-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap" >
                            <span class="badge badge-primary px-2 py-1">{{date('d/m/Y',strtotime($nt->ndate))}}
                            </span>
                            <div class="badge badge-warning text-white badge-pill px-3">
                                <span>{{ucfirst($nt->sender)}}</span>
                            </div>    
                        </div>
                            <div>
                                <h5 class="mt-1 mb-0 ml-1">{{ucfirst($nt->topic)}}</h5>
                                <div class="rounded">
                                    <div class="notice-msg ml-1">{!! ucfirst($nt->message) !!}</div>
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
                                                <a href="{{asset('attachment')}}/{{$attachment}}" class="btn badge badge-soft-info badge-pill font-weight-bold py-2 px-3 m-1 hover-me-sm" download="{{substr($attachment, 10)}}">{{substr($attachment, 10)}}</a> 
                                            @endif
                                        @endforeach
                                        </div>
                                    @endif
                            </div>
                    </div>
                    </div>
                    @endforeach
                       
                   </div>
                </div>
            @endsection
            @section('extra-scripts')
            <script>
            $('.notice-msg').find('p').css({'margin-bottom':'0px'});
            </script>
            @endsection

