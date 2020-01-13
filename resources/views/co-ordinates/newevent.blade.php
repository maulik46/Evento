@extends('co-ordinates/cod_layout')

@section('title','Create Event')

@section('head-tag-links')
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
                           <span> Create new event</span>
                      </h3>

                      <form class="form-horizontal">
                          <div class="card border-form">
                              <div class="card-body py-0 pb-1">
                                  <div class="form-group mt-2">
                                      <label class="col-form-label font-size-15">Event Name</label>
                                       <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="edit-3" class="form-control-icon ml-2" height="19px"></i>
                                          <input type="text" class="form-control" placeholder="Enter Event Name..."
                                             />
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="card border-form my-4">
                              <div class="card-body py-0 pb-1">
                                  <div class="row">
                                      <div class="col-xl-6 form-group mt-2" >
                                          <label class="col-form-label font-size-15">Event Date</label>
                                           <div class="form-group has-icon d-flex align-items-center">
                                             <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                              <input type="text" class="form-control basicDate"
                                                  placeholder="Event Date..." data-input />
                                          </div>
                                      </div>
                                      <div class="col-xl-6 form-group mt-2">
                                          <label class="col-form-label font-size-15" >Event Time</label>
                                          <div class="form-group has-icon d-flex align-items-center">
                                            <i data-feather="clock" class="form-control-icon ml-2" height="19px"></i>
                                              <input type="text" class="form-control timePicker" placeholder="Event Time..."/>
                                          </div>
                                      </div>
                                 
                                  </div>
                                  <div class="row">
                                         <div class="col-xl-6 form-group mt-2">
                                             <label class=" col-form-label font-size-15">Starting Date Of Registraion
                                             </label>
                                             <div class="form-group has-icon d-flex align-items-center">
                                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                                 <input type="text" class="form-control basicDate" placeholder="Starting Date Of Registraion..." data-input />
                                             </div>
                                         </div>
                                         <div class="col-xl-6 form-group mt-2">
                                             <label class=" col-form-label font-size-15">Last Date Of Registraion
                                             </label>
                                             <div class="form-group has-icon d-flex align-items-center">
                                                <i data-feather="calendar" class="form-control-icon ml-2" height="19px"></i>
                                                 <input type="text" class="form-control basicDate" placeholder="Last Date Of Registraion..." data-input />
                                             </div>
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
                                              <select id="event-type" class="form-control w-100 py-1">
                                                  <option hidden>Select Type</option>
                                                  <option value="Solo">Solo</option>
                                                  <option value="Team">Team</option>
                                              </select>
                                          </div>
                                          

                                      </div>
                                      <div class="col-xl-6 form-group mt-2">
                                          <label class="col-form-label font-size-15">Event for</label>
                                          <div class="form-group has-icon d-flex align-items-center">
                                           <i data-feather="user-check" class="form-control-icon ml-2" height="19px"></i>
                                              <select class="form-control w-100 py-1">
                                                  <option hidden>Select Gender</option>
                                                  <option value="Male">Male</option>
                                                  <option value="Female">Female</option>
                                                  <option value="For both">For both</option>
                                              </select>
                                          </div>
                                      </div>
                                  
                                     
                                  </div>
                                  <div class="row">
                                       <div class="col-xl-6 col-md-6 col-sm-6 form-group mt-2">
                                           <label id="team-size-label" class="col-form-label font-size-15">Team size
                                           </label>
                                           <div class="form-group has-icon d-flex align-items-center">
                                             <i data-feather="user-plus" class="form-control-icon ml-2" height="19px"></i>
                                               <input id="team-size" type="number" class="form-control"
                                                   placeholder="Team size" />
                                           </div>
                                       </div>
                                       <div class="col-xl-6 col-md-6 col-sm-6 form-group mt-sm-5 mt-2">
                                           <div class="custom-control custom-switch mb-2">
                                               <input type="checkbox" class="custom-control-input" id="diff-class">
                                               <label class="custom-control-label" for="diff-class" id="diff-class-label">Allow Different Class</label>
                                           </div>
                                            <div class="custom-control custom-switch mb-2">
                                               <input type="checkbox" class="custom-control-input" id="diff-div">
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
                                              <input type="text" class="form-control" placeholder="Event Location..." />
                                          </div>
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
                                              class="form-control font-size-15" disabled value="Dr. Akki Maniya" />
                                      </div>
                                  </div>
                                  <div class="form-group mt-2">
                                      <label class="col-form-label font-size-15">Message <span class="font-weight-light">(Optional)</span></label>
                                         
                                      <div class="form-group has-icon d-flex">
                                          <i data-feather="edit" class="form-control-icon ml-2" height="19px" style="margin-top: 13px;"></i>
                                          <textarea class="form-control" rows="5" id="example-textarea" placeholder="Enter any message or rule.."></textarea>
                                      </div>
                                      <span class="help-block">
                                          <span>Add any message</span>
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
        if($(this).val()=="Solo")
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


@endsection