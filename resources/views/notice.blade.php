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
                       <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #ff5c75;">
                           <div class="card-body py-2">
                               <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <span class="badge badge-soft-primary px-3 py-1 badge-pill">{{date('d/m/Y',strtotime($nt->ndate))}}</span>
                                    <h6>{{ucfirst($nt->sender)}}</h6>
                               </div>
                               <div>
                                    <h5 class="mt-0">{{ucfirst($nt->topic)}}</h5>
                                    <div class="card-text mb-1"> 
                                        {{ucfirst($nt->message)}}
                                    </div>
                                    @if($nt->attechment)
                                    <div class="card-action my-2">
                                        <a href="{{asset('attechment')}}/{{$nt->attechment}}" class="btn btn-soft-danger rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">{{$nt->attechment}}</a>
                                        
                                    </div> 
                                    @endif
                               </div>
                           </div>
                       </div>
                       @else
                       <div class="card new-shadow-sm my-2 rounded-0 hover-me-sm" style="border-left: 4px solid #1AE1AC;">
                           <div class="card-body py-2">
                               <div class="d-flex justify-content-between align-items-center flex-wrap">
                                    <span class="badge badge-soft-primary px-3 py-1 badge-pill">{{date('d/m/Y',strtotime($nt->ndate))}}</span>
                                    <h6>{{ucfirst($nt->sender)}}</h6>
                               </div>
                               <div>
                                    <h5 class="mt-0">{{ucfirst($nt->topic)}}</h5>
                                    <div class="card-text mb-1"> 
                                        {{ucfirst($nt->message)}}
                                    </div>
                                    @if($nt->attechment)
                                    <div class="card-action my-2">
                                        <a href="{{asset('attechment')}}/{{$nt->attechment}}" class="btn btn-soft-danger rounded-sm new-shadow-sm font-weight-bold px-3 mr-1">{{$nt->attechment}}</a>
                                        
                                    </div> 
                                    @endif
                               </div>
                           </div>
                       </div>
                       @endif
                       @endforeach
                       
                   </div>
                </div>
            @endsection

