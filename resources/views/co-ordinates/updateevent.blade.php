@extends('co-ordinates/cod_layout')

@section('title','Update Event')

@section('head-tag-links')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}">
    <link href="{{asset('assets/libs/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .disable-me{
            border: .1rem solid #e2e2e2!important;
        }
        .card{
        margin-bottom: 0px;
        }
        .form-control{
        border-radius: .15rem;
        background-color: #f3f4f7!important;
        padding: 10px 15px;
        border: 1px solid #f3f4f7;
        font-size: 1.1em;
        color:#333!important;
        height: 50px;
        cursor: text!important;
        }
         .form-group{
            margin-bottom:0.4rem!important;
        }

        .form-control:focus{
        border: 1px solid #d1d1d1!important;
        background-color: #f3f4f7!important;
        }
       .border-form{
           border: 1px solid #d1d1d152;
           border-radius: .5rem;
       }
       .custom-control-input:checked~.custom-control-label::before {
       color: #fff;
       border-color: #1ae1ac;
       background-color: #1ae1ac;
       }
       .custom-switch .custom-control-input:disabled:checked~.custom-control-label::before {
       background-color: #1ae1ac;
       }

     /* calander and clock extra css */
       .flatpickr-weekdays {
       margin:10px 0px ;
       }
       .flatpickr-weekday {
       color:#000!important;
       margin-top: 5px;
       }

       .popover{
           -webkit-box-shadow: 1px 0 0 #e6e6e6, -1px 0 0 #e6e6e6, 0 1px 0 #e6e6e6, 0 -1px 0 #e6e6e6, 0 3px 13px
           rgba(0,0,0,0.08)!important;
           box-shadow: 1px 0 0 #e6e6e6, -1px 0 0 #e6e6e6, 0 1px 0 #e6e6e6, 0 -1px 0 #e6e6e6, 0 3px 13px
           rgba(0,0,0,0.08)!important;
           border:0;
           border-radius: 5px;
       }
       .clockpicker-popover .arrow{
           display: none!important;
       }
       .popover.bottom{
           margin-top: 0px;
       }
       .popover .popover-content{
           background-color: #fff;
       }

       /* end calander and clock extra css */

       /* nice select css */
       .nice-select .list{
            width:100%;
            border-radius: 2px;
            box-shadow:none; 
            border: 1px solid #d1d1d1;
        }
        .nice-select .option.selected.focus {
            background-color: #f3f4f7;
        }
        .nice-select:after {
        border-bottom: 3px solid #999;
        border-right: 3px solid #999;
        height: 8px;
        right: 15px;
        width: 8px;
        }
       /* nice select css end */
    </style>
@endsection

@section('my-content')
            <div class="row justify-content-center">
              <div class="col-lg-8 col-md-10 col-sm-10 mx-2 p-0">
                 
                  <div class="bg-white new-shadow rounded-lg p-4 pb-5">
                       <a href="{{url('/cindex')}}" class="float-right text-dark">
                           <i data-feather="x-circle" id="close-btn"></i>
                       </a>
                      <h3 class="my-4 text-center text-dark">
                          <img src="{{asset('assets/images/svg-icons/co-ordinate/writing.svg')}}" height="25px" alt="">
                           <span> Update Event</span>
                      </h3>

                                <form class="form-horizontal" method="post"  onsubmit="return getMessage()" action="{{url('action_update')}}/{{encrypt($e_data['eid'])}}">
                          @csrf
                          <div class="card border-form">
                              <div class="card-body py-0 pb-1">
                                  <div class="form-group mt-2 " >
                                      <label class="col-form-label font-size-15">Event Name  </label>
                                       <div id="enamediv" class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                                          <input type="text" onkeyup="this.value = this.value.toLowerCase()" id="ename" onkeyup="return echeck()" name="ename" class="form-control" value="{{$e_data['ename']}}" placeholder="Enter Event Name..." />
                                      </div>
                                       <span id="erevent" class="text-danger font-weight-bold"></span>
                                       
                                  </div>
                              </div>
                          </div>
                          <div class="card border-form my-4">
                              <div class="card-body py-0 pb-1">
                                  <div class="row">
                                      <div class="col-xl-6 form-group mt-2" >
                                          <label class="col-form-label font-size-15">Event Date</label>
                                           <div id="edatediv" class="form-group has-icon d-flex align-items-center">
                                             <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                              <input type="text" id="edate" value="{{date('d/m/Y', strtotime($e_data['edate']))}}" name="edate" class="form-control basicDate"
                                                  placeholder="Event Date..." data-input />
                                          </div>
                                          <span id="erevent" class="text-danger font-weight-bold"></span>
                                       
                                      </div>
                                      <div class="col-xl-6 form-group mt-2">
                                          <label class="col-form-label font-size-15" >Event Time</label>
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

                          <div class="card border-form my-4">
                              <div class="card-body py-0 pb-1">
                                  <div class="row">
                                      <div class="col-xl-6 form-group mt-2">
                                          <label class="col-form-label font-size-15">Event Type</label>
                                          <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="users" class="form-control-icon ml-2" height="19px"></i>
                                              <select id="event-type" name="etype" class="form-control w-100 pt-1" disabled>
                                                        <option selected value="{{$e_data['e_type']}}">{{ucfirst($e_data['e_type'])}}</option>
                                              </select>
                                          </div>
                                          <span class="text-danger font-weight-bold"></span>

                                      </div>
                                      <div class="col-xl-6 form-group mt-2">
                                          <label class="col-form-label font-size-15">Event for</label>
                                          <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                              <select id="gen" onchange="return echeck()" name="efor" class="form-control w-100 pt-1" disabled>
                                                    <option selected value="{{$e_data['gallow']}}">{{ucfirst($e_data['gallow'])}}</option>
                                              </select>
                                          </div>
                                          <span class="text-danger font-weight-bold"></span>
                                      </div>
                                  
                                     
                                  </div>
                                  <div class="row">
                                       <div class="col-xl-6 col-md-6 col-sm-6 form-group mt-2">
                                           <label id="team-size-label" class="col-form-label font-size-15">Team size
                                           </label>
                                           <div id="t-size" class="form-group has-icon d-flex align-items-center">
                                             <i data-feather="user-plus" class="form-control-icon ml-2" height="19px"></i>
                                               <input id="team-size" name="tsize" type="number" class="form-control"
                                                   placeholder="Team size" value="{{$e_data['tsize']}}" disabled/>
                                           </div>
                                           <span class="text-danger font-weight-bold"></span>
                                       </div>
                                       <div class="col-xl-6 col-md-6 col-sm-6 form-group mt-sm-5 mt-2">
                                           <div class="custom-control custom-switch mb-2">
                                               @if($e_data['alw_dif_class']=='yes')
                                               <input type="checkbox" name="alw_diff_class" value="yes" class="custom-control-input" id="diff-class" checked disabled>
                                               @endif
                                               <label class="custom-control-label" for="diff-class" id="diff-class-label">Allow Different Class</label>
                                           </div>
                                            <div class="custom-control custom-switch mb-2">
                                               @if($e_data['alw_dif_div']=='yes')
                                               <input type="checkbox" name="alw_diff_div" value="yes" class="custom-control-input" id="diff-div" checked disabled>
                                               @endif
                                               <label class="custom-control-label" for="diff-div" id="diff-div-label">Allow Different Division</label>
                                           </div>
                                       </div>
                                  </div>
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
                                          <input type="text" style="background-color: #f3f4f7;"
                                              class="form-control font-size-15" disabled value="<?=Session::get('cname')?>" />
                                      </div>
                                  </div>
                                  <div class="form-group mt-2">
                                      <label class="col-form-label font-size-15">Other rules <span
                                              class="font-weight-light">(optional)</span></label>
                                         
                                      <div class="form-group has-icon d-flex">
                                          <i data-feather="edit" class="form-control-icon ml-2" height="19px" style="margin-top: 13px;"></i>
                                          <textarea name="rules" class="form-control" rows="5" id="example-textarea" placeholder="Enter any message or rule..">{{$e_data['rules']}}</textarea>
                                      </div>
                                      <span class="help-block">
                                          <span>Rules seprated by <b>;</b></span>
                                      </span>
                                  </div>

                                  <button type="submit" 
                                      class="hover-me-sm m-2 btn btn-success px-4  rounded-sm new-shadow font-weight-bold font-size-15">
                                      <span class="mr-1">Create Event</span>
                                      <i data-feather="check-square" height="20px"></i>
                                  </button>
                                  <button type="reset" 
                                      class="hover-me-sm m-2 btn btn-danger px-4  rounded-sm new-shadow font-weight-bold font-size-15">
                                      <span class="mr-1">Reset form</span>
                                      <i data-feather="x-circle" height="20px"></i>
                                  </button>

                              </div>
                          </div>

                      </form>


                  </div> <!-- end col -->

              </div><!-- end container-fluid -->
            </div>
@endsection


@section('extra-scripts') 
    <!-- calander js for date -->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>

    <!-- clock  js for time -->
    <script src="{{asset('assets/libs/clockpicker/clockpicker-gh-pages/dist/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>   

    <script>
// script for time-picker and date picker-----------------------------------
   $('.timePicker').clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now'
   });

    $(".basicDate").flatpickr({
        enableTime: false,
        dateFormat: "d-m-Y"
    });

    $(".basicDate").focusin(function(){
        $( "div" ).removeClass( "animate" );
    });
    
// end script for time-picker and date picker---------------------------------

// nice-select js ------------------------------------------------------------

    $(document).ready(function() {
        $('select').niceSelect();
    });

// nice-select js end --------------------------------------------------------


// disable max-person field on select solo option from event catagory---------
    $('#event-type').change(function() {
        if($(this).val()=="solo")
        {
        $('#team-size').prop( "disabled", true );
        $('#team-size').prop( "placeholder", "" );
        $('#team-size').addClass("disable-me");
        $('#team-size').val('');
        $('#team-size-label').css("color","lightgray");

        $('#diff-class').prop( "disabled", true );
        $('#diff-class').addClass("disable-me");
        $('#diff-class-label').css("color","lightgray");
        $('#diff-class').prop( "checked", false );

        $('#diff-div').prop( "disabled", true );
        $('#diff-div').addClass("disable-me");
        $('#diff-div-label').css("color","lightgray");
        $('#diff-div').prop( "checked", false );
        

        }
        else{
        $('#team-size').prop( "disabled", false );
        $('#team-size').prop( "placeholder", "Team size" );
        $('#team-size').removeClass("disable-me");
        $('#team-size-label').css("color","#6c757d");

        $('#diff-class').prop( "disabled", false );
        $('#diff-class').removeClass("disable-me");
        $('#diff-class-label').css("color","#6c757d");

        $('#diff-div').prop( "disabled", false );
        $('#diff-div').removeClass("disable-me");
        $('#diff-div-label').css("color","#6c757d");

        }

            
    })
   // end disable max-person field on select solo option from event catagory--
   $('#diff-class').click(function(){
        if($(this).prop("checked") == true){
             $('#diff-div').prop( "checked", true );
             $('#diff-div').prop( "disabled", true );
        }
        else{
            $('#diff-div').prop( "checked", false );
            $('#diff-div').prop( "disabled", false );
        }
   });
 

</script>
<script>
         function getMessage() {
             var f=0;
             var d=new Date();
             var today=d.getDate()+"-"+("0" + (d.getMonth() + 1)).slice(-2)+"-"+d.getFullYear();
             
             var edate=$('#edate').val();
             var sdate=$('#sdate').val();
             
             var ldate=$('#ldate').val();
             var ename=$('#ename').val();
             var gen=$('#gen').val();
             
            
             $('*').removeClass('border border-danger');
             
             if($('#ename').val()=="")
             {
                $('#ename').parent().addClass('border border-danger');
                $('#ename').parent().next().text("Please enter event Name");
                f=1;
             }
             else if($('#ename').parent().next().text()=="Event already exist")
             {
                $('#ename').parent().addClass('border border-danger');
                $('#ename').parent().next().text("Event already exist");
                f=1;
             }
             else{
                $('#ename').parent().next().text(""); 
             }
             

             if($('#etime').val()=="")
             {
                 $('#etime').parent().addClass('border border-danger');
                 $('#etime').parent().next().text("Please enter event time");
                 f=1;
             }
             else{
                $('#etime').parent().next().text("");
             }


             if(edate=="")
             {
                 $('#edate').parent().addClass('border border-danger');
                 $('#edate').parent().next().text("Please enter event Date");
                 f=1;
             }
             else if(edate<today)
            {
                $('#edate').parent().addClass('border border-danger');
                $('#edate').parent().next().text("Event date is invalid ");
                f=1;
            }
             else{
                $('#edate').parent().next().text("");
                }
             


             if(sdate=="")
             {
                 $('#sdate').parent().addClass('border border-danger');
                 $('#sdate').parent().next().text("Please enter Registration Start Date");
                 f=1;
             }
             else if(edate<sdate || today>sdate)
             {
                 $('#sdate').parent().addClass('border border-danger');
                 $('#sdate').parent().next().text("Starting date of registration should be before the event date and after today ");
                 f=1;
             }
             else{
                $('#sdate').parent().next().text("");
             }


             if(ldate=="")
             {
                 $('#ldate').parent().addClass('border border-danger');
                 $('#ldate').parent().next().text("Please enter Last date of Registration ");
                 f=1;
             }
             else if(ldate<sdate || edate<ldate)
             {
                 $('#ldate').parent().addClass('border border-danger');
                 $('#ldate').parent().next().text("End date of registration should be before the event date  and after start date of registration");
                 f=1;
             }
             else{
                $('#ldate').parent().next().text("");
             }

             
             if($('#event-type').val()=="")
             {
                 $('#event-type').parent().addClass('border border-danger');
                 $('#event-type').parent().next().text("Please Select event type");
                 f=1;
             }
             else{
                $('#event-type').parent().next().text("");
             }

             if($('#gen').val()=="")
             {
                 $('#gen').parent().addClass('border border-danger');
                 $('#gen').parent().next().text("Please select gender");
                 f=1;
             }
             else{
                $('#gen').parent().next().text("");
             }

             if($('#event-type').val()=="team")
             {
                    if($('#team-size').val()=="")
                    {
                        $('#team-size').parent().addClass('border border-danger');
                        $('#team-size').parent().next().text("Please insert team size");
                        f=1;
                    }
                    else{
                        $('#team-size').parent().next().text("");
                    }
             }
             else{
                        $('#team-size').parent().next().text("");
            }
            

            
            if($('#loc').val()=="")
             {
                 $('#loc').parent().addClass('border border-danger');
                 $('#loc').parent().next().text("Please insert event location");
                 f=1;
             }
             else{
                $('#loc').parent().next().text("");
             }
            if(f==1)
            {
                return false;
            }
         }
        function echeck()
        {
            var ename=$('#ename').val();
            var gen=$('#gen').val();
            $.ajaxSetup({
                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            $.ajax({
               type:'POST',
               url:'msg',
               data:{ename:ename,gen:gen},
               success:function(data) {
                if(data.msg>0)
                   {
                    $('#ename').addClass('border border-danger');
                    $('#ename').parent().next().text("Event already exist");
                   }
                   else{
                    $('#ename').parent().next().text("");
                    $('#ename').parent().next().removeClass('border border-danger');
                   }
               },
               error:function(data){
               console.log(data);
               }
            })
         }
      </script>

@endsection
