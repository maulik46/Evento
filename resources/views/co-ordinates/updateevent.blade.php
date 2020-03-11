@extends('co-ordinates/cod_layout')

@section('title','Update Event')

@section('head-tag-links')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
<link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/multicheckbox/multiselect.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('assets/css/create-ev-css.css')}}">
<style>
    .course-name{
        display:flex;
        align-items:center;
        justify-content: center;
        margin-top:0px;
    }
    input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 2px solid #f3efef;
            height:100%;
            width:100%;
            text-align:center;
            padding: 6px 10px;
            cursor: pointer;
        }

        .custom-file-upload:hover {
            color: #43d39e;
        }
</style>
@endsection

@section('my-content')
<div class="container-fluid">
    <!-- <div class="col-md-3 mb-0">
        <div class="card new-shadow">
            <label for="s1" class="btn">
            <input type="checkbox" onclick="sell(this.id);" class="" style="display: none" id="s1" name="">
            <h4 class="course-name p-3">BCA</h4>
             </label>
        </div>
    </div> -->
   
</div>
<div class="row justify-content-center">
@if(Session::has('updatealert'))
           
           <div class="toast bg-success fade show border-0 new-shadow rounded position-fixed w-75" style="top:80px;right:30px;z-index:9999999;" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">
               <div class="toast-body text-white alert mb-1">
                   <a href="#" class=" text-white float-right" data-dismiss="alert" aria-label="Close">
                       <i data-feather="x-circle" id="close-btn" height="18px" ></i>
                   </a>
                   <div class="mt-2 font-weight-bold font-size-14">
                       {{Session::get('updatealert')}}
                   </div> 
                   
               </div>
           </div>
@endif
    <div class="col-lg-8 col-md-10 col-sm-10 mx-2 p-0">

        <div class="bg-white new-shadow rounded-lg p-3 pb-5">
            <a href="{{url('/cindex')}}" class="float-right text-dark">
                <i data-feather="x-circle" height="20px" id="close-btn"></i>
            </a>
            <h3 class="my-4 text-center text-dark">
                <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                <span> Update Event</span>  
            </h3>
            <form class="form-horizontal" method="post"  onsubmit="return getMessage()" action="{{url('action_update')}}/{{encrypt($e_data['eid'])}}" enctype="multipart/form-data">
                @csrf
                <div class="card border-form">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                            <div class="col-md-8 form-group mt-2 ">
                                <label class="col-form-label font-size-15">Event Name</label>
                                <div id="enamediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" onkeyup="this.value = this.value.toLowerCase()" id="ename" onkeyup="return echeck()"
                                    name="ename" class="form-control" value="{{$e_data['ename']}}" 
                                    placeholder="Enter Event Name..." />
                                </div>
                                <span id="erevent" class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-md-4 form-group mt-2" >
                                <label class="col-form-label font-size-15">Event Poster</label>
                                <div>
                                <label for="poster-upload" class="custom-file-upload rounded overflow-auto">
                                <i id="camera" data-feather="file-plus"></i>
                                <span id="up" class="mx-2">Upload Poster</span>
                                </label>
                                <input id="poster-upload" name="poster-upload[]" type="file"  multiple onChange="FileDetails()"/>
                                </div>
                                <span class="text-danger font-weight-bold" id="validphoto"></span>

                            </div>
                        </div>
                        <div class="mt-3 p-1" id="fc" >
                            <?php $att = explode(';',$e_data['banner']); 
                            $fcount=0;
                            ?>
                            @foreach($att as $ban)
                            @if($ban)
                                <?php $fcount++ ?>
                            @endif
                            @endforeach
                           
    <div class="mt-3 p-1" style="border: 1px solid #d2d8de; <?php if($fcount==0) { ?> display:none <?php } ?>" >
                            <div class="d-flex justify-content-center align-items-center mr-2" style="margin-top:-12px;">
                                    <span class="badge badge-dark px-3 py-1 badge-pill" id="countfile">{{$fcount}}</span>
                            </div>
                            <div class="mt-2 col-xl-12 row" id="fl">
                            @foreach($att as $ban_details)
                            @if($ban_details)
                                <div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;">
                                    <span class="text-dark col-8">{{substr($ban_details,10)}}</span>
                                    <button class="badge badge-light px-3 badge-pill mr-2 col-4" id="<?php $uniq=uniqid(); echo $uniq; ?>" onclick="return rmimg('<?php echo $uniq; ?>','<?php echo encrypt($ban_details); ?>','<?php echo $e_data['eid']; ?>')" >delete</button>
                                </div>
                                
                            @endif
                            @endforeach
                            </div>
                                
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card border-form my-5">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                            <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Date</label>
                                <div id="edatediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="edate" value="{{date('d/m/Y', strtotime($e_data['edate']))}}" name="edate" class="form-control basicDate"
                                                  placeholder="Event Date..." data-input />
                                </div>
                                <span id="erevent" class="text-danger font-weight-bold"></span>

                            </div>
                             <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event End Date</label>
                                <div id="enddatediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="enddate"  value="{{date('d/m/Y', strtotime($e_data['enddate']))}}" name="enddate" class="form-control basicDate"
                                        placeholder="Event End Date..." data-input />
                                </div>
                                <span id="erevent" class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-xl-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Time</label>
                                <div id="etimediv" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="clock" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="etime" name="etime" value="{{date('h:i A', strtotime($e_data['time']))}}"  class="form-control timePicker" placeholder="Event Time..." autocomplete="off"/>
                                </div>

                                <span class="text-danger font-weight-bold"></span>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl-6 form-group mt-2">
                                <label class=" col-form-label font-size-15">Starting Date Of Registraion
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="sdate" name="sdate" value="{{date('d/m/Y', strtotime($e_data['reg_start_date']))}}" class="form-control basicDate" placeholder="Starting Date Of Registraion..." data-input />
                                </div>

                                <span class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-xl-6 form-group mt-2">
                                <label class=" col-form-label font-size-15">Last Date Of Registraion
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                    <input type="text" id="ldate" name="ldate" value="{{date('d/m/Y', strtotime($e_data['reg_end_date']))}}" class="form-control basicDate" placeholder="Last Date Of Registraion..." data-input />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>

                    </div>
                </div>
                @if($tblpcount>0)
                <h1> some particiapanted student</h1>
                <div class="card border-form my-5">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                        <div class="col-xl-4 form-group mt-2">
                                          <label class="col-form-label font-size-15">Event Type</label>
                                          <div class="form-group has-icon d-flex align-items-center" style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This field disable because some student was participated.">
                                           <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                              <select id="event-type" name="etype" class="form-control w-100 pt-1 nice-select">
                                                        <option selected value="{{$e_data['e_type']}}">{{ucfirst($e_data['e_type'])}}</option>
                                              </select>
                                          </div>
                                          <span class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-xl-4 form-group mt-2">
                            <label class="col-form-label font-size-15">Gender</label>
                                          <div class="form-group has-icon d-flex align-items-center"  style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This field disable because some student was participated.">
                                           <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                              <select id="gen" onchange="return echeck()" name="efor" class="form-control w-100 pt-1 nice-select">
                                                    <option selected value="{{$e_data['gallow']}}">{{ucfirst($e_data['gallow'])}}</option>
                                              </select>
                                          </div>
                                          <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event for</label>
                                <div class="form-group has-icon d-flex align-items-center"  style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This field disable because some student was participated.">
                                    <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                    <select name="class" class="form-control active w-100  nice-select" id="efor">
                                        <option selected value="{{$e_data['efor']}}">
                                        <?php 
                                        $ev="";
                                        $efor=explode('-',$e_data['efor']);
                                        foreach ($efor as $e) {
                                            if ($e) {
                                                $ev.=$e.",";
                                            }
                                        }
                                        echo $ev;
                                        ?>
                                        </option>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group mt-2">
                                <label id="team-size-label" class="col-form-label font-size-15">Team size
                                </label>
                                <div id="t-size" class="form-group has-icon d-flex align-items-center"  style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This field disable because some student was participated.">
                                             <i data-feather="user-plus" class="form-control-icon ml-2" height="19px"></i>
                                               <input id="team-size" name="tsize" type="number" class="form-control"
                                                   placeholder="Team size" value="{{$e_data['tsize']}}" readonly/>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-sm-5 mt-2"  style="opacity: 0.5;" data-toggle="tooltip" data-placement="bottom"
                title="This field disable because some student was participated.">
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_class" class="custom-control-input" id="diff-class" value="yes"<?php if($e_data['alw_dif_class']=="yes"){ ?>checked<?php } ?> disabled>
                                    <label class="custom-control-label" for="diff-class" id="diff-class-label">Allow
                                        Different Class</label>
                                </div>
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_div" value="yes" class="custom-control-input"
                                        id="diff-div" <?php if($e_data['alw_dif_div']=="yes"){ ?> checked<?php } ?> disabled>
                                    <label class="custom-control-label" for="diff-div" id="diff-div-label">Allow
                                        Different Division</label>
                                </div>
                            </div>
                             <div class="col-md-4 form-group mt-2">
                                <label id="max-team-label" class="col-form-label font-size-15">Maximum Team
                                </label>
                                <div id="m-team" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="max-team" name="mteam" type="number" class="form-control" value="{{$e_data['maxteam']}}"
                                        placeholder="Maximum Team"/>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                                <span class="text-danger font-weight-bold">{{Session::get('validteam')}}</span>
                            </div>
                        </div>
                @else
                <?php  $class=App\tblstudent::select('class')->where('clgcode',Session::get('clgcode'))->groupby('class')->orderby('class')->get(); ?>
                <h1>0  particiapanted student</h1>
                <div class="card border-form my-5">
                    <div class="card-body py-0 pb-1">
                        <div class="row">
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event Type</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                    <select id="event-type" name="etype" class="form-control w-100 pt-1 nice-select">
                                        <option hidden value="">Select Type</option>
                                        <option value="solo"<?php if($e_data['e_type']=="solo"){?> selected <?php }?>>Solo</option>
                                        <option value="team"<?php if($e_data['e_type']=="team"){?> selected <?php }?>>Team</option>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold"></span>

                            </div>
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Gender</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                    <select id="gen" onchange="return echeck()" name="efor" class="form-control w-100 pt-1 nice-select">
                                        <option value="" hidden>Select Gender</option>
                                        <option value="male" <?php if($e_data['gallow']=="male"){?> selected <?php }?>>Male</option>
                                        <option value="female"  <?php if($e_data['gallow']=="female"){?> selected <?php }?>>Female</option>
                                        <option value="both"  <?php if($e_data['gallow']=="both"){?> selected <?php }?>>For both</option>
                                    </select>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-2">
                                <label class="col-form-label font-size-15">Event for</label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                    <?php 
                                        $ev="";
                                        $efor=explode('-',$e_data['efor']);
                                        //echo $ev;
                                    ?>
                                    <select  multiple="multiple" name="class[]"  class="form-control active w-100" id="efor">
                                    @foreach($class as $cls)
                                        
                                    @if(in_array($cls['class'],$efor))                           
                                        <option value="{{$cls['class']}}" selected>{{ucfirst($cls['class'])}}</option>
                                    @else
                                        <option value="{{$cls['class']}}" >{{ucfirst($cls['class'])}}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                    
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group mt-2">
                                <label id="team-size-label" class="col-form-label font-size-15">Team size
                                </label>
                                <div id="t-size" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="user-plus" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="team-size" name="tsize" type="number" class="form-control"
                                        placeholder="Team size" value="{{$e_data['tsize']}}"/>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 form-group mt-sm-5 mt-2">
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_class" class="custom-control-input" id="diff-class" value="yes"<?php if($e_data['alw_dif_class']=="yes"){ ?>checked<?php } ?> >
                                    <label class="custom-control-label" for="diff-class" id="diff-class-label">Allow
                                        Different Class</label>
                                </div>
                                <div class="custom-control custom-switch mb-2">
                                    <input type="checkbox" name="alw_diff_div" value="yes" class="custom-control-input"
                                        id="diff-div" <?php if($e_data['alw_dif_div']=="yes"){ ?> checked<?php } ?>>
                                    <label class="custom-control-label" for="diff-div" id="diff-div-label">Allow
                                        Different Division</label>
                                </div>
                            </div>
                             <div class="col-md-4 form-group mt-2">
                                <label id="max-team-label" class="col-form-label font-size-15">Maximum Team
                                </label>
                                <div id="m-team" class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="max-team" name="mteam" type="number" class="form-control"
                                        placeholder="Maximum Team"  value="{{$e_data['maxteam']}}"/>
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>
                @endif
                        <div class="row">
                            <div class="col-xl-12 form-group mt-2">
                                <label class=" col-form-label font-size-15">Event Location
                                </label>
                                <div class="form-group has-icon d-flex align-items-center">
                                    <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                                    <input id="loc" type="text" name="loc" class="form-control" value="{{$e_data['place']}}" placeholder="Event Location..." />
                                </div>
                                <span class="text-danger font-weight-bold"></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card border-form">
                    <div class="card-body py-0 pb-1">
                        <div class="form-group mt-2">
                            <label class="col-form-label font-size-15">Event Co-ordinate</label>
                            <div class="form-group has-icon d-flex align-items-center">
                                <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                                <input type="text" style="background-color: #f3f4f7;color: #737373!important;" class="form-control font-size-15 font-weight-bold" 
                                    disabled value="{{ucfirst(Session::get('cname'))}}" />
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label class="col-form-label font-size-15">Other rules <span
                                    class="font-weight-light">(optional)</span></label>

                            <div class="form-group has-icon d-flex">
                                <i data-feather="edit" class="form-control-icon ml-2" height="19px"
                                    style="margin-top: 13px;"></i>
                                <textarea name="rules" class="form-control" rows="5" id="example-textarea"
                                    placeholder="Enter any message or rule..">{{$e_data['rules']}}</textarea>
                            </div>
                            <span class="help-block">
                                <span>Rules must be seprated by <b>;</b></span>
                            </span>
                        </div>

                        <button type="submit"
                            class="hover-me-sm m-2 btn btn-success px-3  rounded-sm new-shadow font-weight-bold font-size-15">
                            <span class="mr-1">Update Event</span>
                            <i data-feather="check-square" height="20px"></i>
                        </button>
                        <button type="reset"
                            class="hover-me-sm m-2 btn btn-danger px-3  rounded-sm new-shadow font-weight-bold font-size-15">
                            <span class="mr-1">Reset form</span>
                            <i data-feather="x-circle" height="20px"></i>
                        </button>

                    </div>
                </div>

            </form>
            
            

        </div> 

    </div>
</div>
@endsection


@section('extra-scripts')
<!-- calander js for date -->
<script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
<?php
$startdate=App\tblevent::select('reg_start_date')->where('eid',$e_data['eid'])->get()->first();
$stdate=date('d-m-Y',strtotime($startdate['reg_start_date']));
?>
<!-- clock  js for time -->
<script src="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/libs/multicheckbox/multiselect.js')}}"></script>
<!-- <script src="{{asset('assets/js/create-ev-js.js')}}"></script> -->
<script>

    function rmimg(iname,fulname,eid)
    {  
        //alert(fulname);
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'POST',
            url: '/del_banner',
            data: {
                'fulname':fulname,
                'eid':eid
            },
            success: function (data) {
                $("#"+iname).parent().addClass('bg-danger');    
                $("#"+iname).text('deleted');  
                $("#"+iname).prop("disabled ",true);    
            },
            error: function (data) {
            console.log(data);
            }
        })
        return false;
    }
</script>
    <script>
    var dcount=0;
    $('#poster-upload').change(function(){
        for(var i=0;i<dcount;i++)
        {
            $("#fl").children().last().remove();
            document.getElementById('countfile').innerHTML =" <?php echo $fcount; ?> ";
        }
        dcount=0;
        $('#countfile').parent().parent().css("display", "block");
                if($('#poster-upload').val() !="")
                {
                var fi = document.getElementById('poster-upload');
                var past= document.getElementById('fl').innerHTML;
                if (fi.files.length > 0) {
                    // $('#fc').css("border","1px solid #d2d8de");
                    var pastc=parseInt(document.getElementById('countfile').innerHTML);
                    document.getElementById('countfile').innerHTML = pastc + parseInt(fi.files.length) ;
                // document.getElementById('fc').innerHTML = document.getElementById('fc').innerHTML + ' <div class="mt-2 col-xl-12 row" id="fl">';
                    for (var i = 0; i <= fi.files.length - 1; i++) {

                        var fname = fi.files.item(i).name;      // THE NAME OF THE FILE.
                        var fsize = fi.files.item(i).size;      // THE SIZE OF THE FILE.
                        var ext = fname.substring(fname.lastIndexOf('.') + 1);
                        const size = (fi.files[i].size / 1024).toFixed(2); 
                        if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "svg" || ext == "SVG" || ext == "png" || ext == "PNG")
                        {
                            if (size > 2048 ) { 
                                $('#validphoto').text("File must be less than 2 MB");
                                sessionStorage.setItem('err',1);
                                sessionStorage.setItem('errsize',1);
                                document.getElementById('fl').innerHTML =
                            document.getElementById('fl').innerHTML + '<div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:orange;border-right:4px solid #fff;border-left:4px solid #fff;"> <span class="text-dark col-8">'+ fname +'</span><span class="badge badge-light px-3 badge-pill mr-2 col-4">' + (fsize/1024).toFixed(2) + 'KB</span></div>';
                            dcount=dcount+1;
                            }  
                            else{
                                $('#validphoto').text("");
                                document.getElementById('fl').innerHTML =
                                document.getElementById('fl').innerHTML + '<div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:#25c2e340;border-right:4px solid #fff;border-left:4px solid #fff;"> <span class="text-dark col-8">'+ fname +'</span><span class="badge badge-light px-3 badge-pill mr-2 col-4">' + (fsize/1024).toFixed(2) + 'KB</span></div>';
                                dcount=dcount+1;
                            } 
                        }
                        else
                        {            
                            $('#validphoto').text('File Extension must be jpg,jpeg,svg and png format...!'); 
                            sessionStorage.setItem('err',1);
                            document.getElementById('fl').innerHTML =
                            document.getElementById('fl').innerHTML + '<div class="alert font-weight-bold rounded-0 p-1 font-size-15 mb-1 d-flex justify-content-between align-items-center col-xl-6" style="background-color:orange;border-right:4px solid #fff;border-left:4px solid #fff;"> <span class="text-dark col-8">'+ fname +'</span><span class="badge badge-light px-3 badge-pill mr-2 col-4">' + (fsize/1024).toFixed(2) + 'KB</span></div>';  
                            dcount=dcount+1;
                        }
                        }
                    
                    }
                    if(sessionStorage.getItem('errsize')==1)
                    {
                        $('#validphoto').text("File must be less than 2 MB");
                        sessionStorage.setItem('errsize',0);
                    }
                    if($('#validphoto').text()=="")
                    {
                        sessionStorage.setItem('err',0);
                    }
                }
            
            });
        
         function sell(id)
        {
	        $("#"+id).parent().toggleClass("bg-info");
        
        };
        $(document).ready(function(){
            <?php 
        
        if ($e_data['e_type']=="solo") {
        ?> 
        $('#team-size').prop("disabled", true);
        $('#team-size').prop("placeholder", "");
        $('#team-size').addClass("disable-me");
        $('#team-size').val('');
        $('#team-size-label').css("color", "lightgray");
            
        $('#diff-class').prop("disabled", true);
        $('#diff-class').addClass("disable-me");
        $('#diff-class-label').css("color", "lightgray");
        $('#diff-class').prop("checked", false);

        $('#diff-div').prop("disabled", true);
        $('#diff-div').addClass("disable-me");
        $('#diff-div-label').css("color", "lightgray");
        $('#diff-div').prop("checked", false);

            <?php
        }
            ?>
});
</script>
<script>
        $('.timePicker').clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now'
});

    $(".basicDate").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
});

    $(".basicDate").focusin(function () {
        $("div").removeClass("animate");
});

// end script for time-picker and date picker---------------------------------

// nice-select js ------------------------------------------------------------

    $(document).ready(function () {
        $('.nice-select').niceSelect();
});

// nice-select js end --------------------------------------------------------


// disable max-person field on select solo option from event catagory---------
    $('#event-type').change(function () {
        if ($(this).val() == "solo") {
        $('#team-size').prop("disabled", true);
        $('#team-size').prop("placeholder", "Team size");
        $('#team-size').addClass("disable-me");
        $('#team-size').val('');
        $('#team-size-label').css("color", "lightgray");
            
        $('#diff-class').prop("disabled", true);
        $('#diff-class').addClass("disable-me");
        $('#diff-class-label').css("color", "lightgray");
        $('#diff-class').prop("checked", false);

        $('#diff-div').prop("disabled", true);
        $('#diff-div').addClass("disable-me");
        $('#diff-div-label').css("color", "lightgray");
        $('#diff-div').prop("checked", false);


        } 
        else {
        $('#team-size').prop("disabled", false);
        $('#team-size').prop("placeholder", "Team size");
        $('#team-size').removeClass("disable-me");
        $('#team-size-label').css("color", "#6c757d");
         
        $('#diff-class').prop("disabled", false);
        $('#diff-class').removeClass("disable-me");
        $('#diff-class-label').css("color", "#6c757d");

        $('#diff-div').prop("disabled", false);
        $('#diff-div').removeClass("disable-me");
        $('#diff-div-label').css("color", "#6c757d");

    }

})
// end disable max-person field on select solo option from event catagory--

// toggle btn of differnet division------

    $('#diff-class').click(function () {
        if ($(this).prop("checked") == true) {
            $('#diff-div').prop("checked", true);
            // $('#diff-div').prop("disabled", true);
        } else {
            $('#diff-div').prop("checked", false);
            // $('#diff-div').prop("disabled", false);
        }
});
// end toggle btn script---


// form validation start

function getMessage() {
        var f = 0;
        var d = new Date();
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        var edate = $('#edate').val().split("-").reverse().join("-");
        var sdate = $('#sdate').val().split("-").reverse().join("-");
        var ldate = $('#ldate').val().split("-").reverse().join("-");
        var enddate=$('#enddate').val().split("-").reverse().join("-");
        var ename = $('#ename').val();
        var gen = $('#gen').val();
        today = yyyy + '-' + mm + '-' + dd;
        $('*').removeClass('border border-danger');

        if ($('#ename').val() == "") {
            $('#ename').parent().addClass('border border-danger');
            $('#ename').parent().next().text("Please enter event Name");
            f = 1;
        } 
        else if ($('#ename').parent().next().text() == "Event already exist") {
            $('#ename').parent().addClass('border border-danger');
            $('#ename').parent().next().text("Event already exist");
            f = 1;
        } 
        else {
            $('#ename').parent().next().text("");
        }

        if(sessionStorage.getItem('err')==1)
        {
            f = 1;
        }
        
        if ($('#etime').val() == "") {
            $('#etime').parent().addClass('border border-danger');
            $('#etime').parent().next().text("Please enter event time");
            f = 1;
        } 
        else {
            $('#etime').parent().next().text("");
        }


        if (enddate == "") {
            $('#enddate').parent().addClass('border border-danger');
            $('#enddate').parent().next().text("Please enter event end Date");
            f = 1;
        } 
        else if (edate > enddate) {
            $('#enddate').parent().addClass('border border-danger');
            $('#enddate').parent().next().text("Event end date must be after the event start date");
             f = 1;
        } 
        else {
            $('#enddate').parent().next().text("");
        }


        if (edate == "") {
            $('#edate').parent().addClass('border border-danger');
            $('#edate').parent().next().text("Please enter event Date");
            f = 1;
        } 
        else if (edate < today) {
            $('#edate').parent().addClass('border border-danger');
            $('#edate').parent().next().text("Event date is invalid ");
             f = 1;
        } 
        else {
            $('#edate').parent().next().text("");
        }


        if (sdate == "") {
            $('#sdate').parent().addClass('border border-danger');
            $('#sdate').parent().next().text("Please enter Registration Start Date");
            f = 1;
        } 
        else if (edate <= sdate ) {
            $('#sdate').parent().addClass('border border-danger');
            $('#sdate').parent().next().text("Starting date of registration should be before the event date ");
            f = 1;
        } else {
            $('#sdate').parent().next().text("");
        }


        if (ldate == "") {
            $('#ldate').parent().addClass('border border-danger');
            $('#ldate').parent().next().text("Please enter Last date of Registration ");
            f = 1;
        } 
        else if (ldate < sdate || edate <= ldate) {
            $('#ldate').parent().addClass('border border-danger');
            $('#ldate').parent().next().text(
            "End date of registration should be before the event date  and after start date of registration");
            f = 1;
        } 
        else {
            $('#ldate').parent().next().text("");
        }


        if ($('#event-type').val() == "") {
            $('#event-type').parent().addClass('border border-danger');
            $('#event-type').parent().next().text("Please Select event type");
            f = 1;
        } 
        else {
            $('#event-type').parent().next().text("");
        }

        if ($('#gen').val() == "") {
            $('#gen').parent().addClass('border border-danger');
            $('#gen').parent().next().text("Please select gender");
            f = 1;
        } 
        else {
            $('#gen').parent().next().text("");
        }

        if ($('#event-type').val() == "team") {
            if ($('#team-size').val() == "") {
            $('#team-size').parent().addClass('border border-danger');
            $('#team-size').parent().next().text("Please insert team size");
            f = 1;
            } 
            else {
            $('#team-size').parent().next().text("");
        }
        } 
        else {
            $('#team-size').parent().next().text("");
        }


        if($('#efor').val()=="")
        {
            $('#efor').parent().addClass('border border-danger');
            $('#efor').parent().next().text("Please select class");
        }
        else {
            $('#efor').parent().next().text("");
        }

        if($('#max-team').val()=="")
        {
            $('#max-team').parent().addClass('border border-danger');
            $('#max-team').parent().next().text("Please enter maximum team");
            f = 1;
        }

        if($('#max-team').val()<=1)
        {
            $('#max-team').parent().addClass('border border-danger');
            $('#max-team').parent().next().text("Maximum limit should be more than one");
            f = 1;
        }

        if ($('#loc').val() == "") {
            $('#loc').parent().addClass('border border-danger');
            $('#loc').parent().next().text("Please insert event location");
            f = 1;
        } 
        else {
            $('#loc').parent().next().text("");
        }
        if (f == 1) {
            return false;
        }
}

// validation end

// event already exist or not js

function echeck() {
        var ename = $('#ename').val();
        var gen = $('#gen').val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
            type: 'POST',
            url: 'msg',
            data: {
                ename: ename,
                gen: gen
            },
            success: function (data) {
                
                if (data.msg > 0) {
                    $('#ename').addClass('border border-danger');
                    $('#ename').parent().next().text("Event already exist");
                } 
                else {
                    $('#ename').parent().next().text("");
                    $('#ename').removeClass('border border-danger');
                }
            },
            error: function (data) {
            console.log(data);
            }
        })
}
// event already exist or not js end


// checkbox select js

$(document).ready(function() {
    $('select[multiple]').multiselect({
        columns: 1,
        placeholder: 'Select Class',
        selectAll: true
    });

    $('.ms-options').removeAttr('style');
    $('.ms-options').addClass('my-scroll');
});
    
// checkbox select js end

    </script>
@endsection
