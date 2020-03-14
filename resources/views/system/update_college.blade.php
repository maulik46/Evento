@extends('system/system_layout')
@section('title','Add College')
@section('my-content')  
         <div class="text-center py-2 rounded card shadow-none mb-0">
                <span class="h4">
                <i class="uil uil-graduation-hat h4 mr-1"></i>
                Update College
                </span>
        </div> 
        <div class="px-1 px-sm-3" >
            <form method="POST" action="{{url('action_update_college')}}/{{encrypt($clg_data['clgcode'])}}" class="mt-2 card shadow-none py-3 px-1 px-sm-2 rounded-lg" style="border:1px solid #e2e7f1;" onsubmit="return validForm()">
            @csrf
                <div class="row mx-0">
                    <div class="form-group col-sm-6">
                        <label>Admin Name</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <i data-feather="user" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="admin_name"  class="form-control" value="{{$clg_data['name']}}" id="admin_name">
                        </div>
                        <span class="text-danger font-weight-bold" id="admin_name_err"></span>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Email</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <i data-feather="mail" class="form-control-icon ml-2" height="19px"></i>
                            <input type="email" name="admin_email" class="form-control" value="{{$clg_data['email']}}" id="clg_email">
                        </div>
                        <span class="text-danger font-weight-bold" id="clg_email_err"></span>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="form-group col-md-12 mx-0 flex-column">
                    <label>Institute Name</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <img src="{{asset('assets/images/clg1.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                            <input type="text" name="clg_name" class="form-control" value="{{$clg_data['clgname']}}" id="clg_name">
                        </div>
                        <span class="text-danger font-weight-bold" id="clg_name_err"></span>
                    </div>
                </div>
                
                <div class="row mx-0">
                    <div class="form-group col-md-6 col-12">
                        <label>Contact no</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <i data-feather="phone" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="clg_mob" class="form-control" value="{{$clg_data['mobile']}}" id="clg_mob">
                        </div>
                        <span class="text-danger font-weight-bold" id="clg_mob_err"></span>
                        <!--  -->
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>City</label>
                        <div class="mb-1 form-group has-icon d-flex align-items-center">
                            <i data-feather="map" class="form-control-icon ml-2" height="19px"></i>
                            <input type="text" name="clg_city" class="form-control" value="{{$clg_data['city']}}" id="city_name">
                        </div>
                        <span class="text-danger font-weight-bold" id="city_name_err"></span>
                        <!--  -->
                    </div>
                </div>
                <div class="row form-group col-12 mx-0 flex-column">
                    <label>Institute Address</label>
                    <div class="mb-1 form-group has-icon d-flex align-items-center">
                        <img src="{{asset('assets/images/svg-icons/address.svg')}}" height="20px" class="form-control-icon ml-2" alt="">
                        <input type="text" name="clg_add" class="form-control" value="{{$clg_data['address']}}" id="clg_add">
                    </div>
                    <span class="text-danger font-weight-bold" id="clg_add_err"></span>
                    <!--  -->
                </div>
                <div class="my-2 mx-2">
                    <button type="submit"  class="hover-me-sm btn btn-success new-shadow-sm font-weight-bold px-3 rounded-sm mr-1">
                        <span class="font-size-15">Update</span>
                        <i data-feather="check-square" class="mb-1" height="18px"></i>
                    </button>
                </div>
            </form>
        </div>          
@endsection
@section('extra-scripts')
<script>
    function validForm(){
        var f=0;
        var regex = /^[A-Za-z\s]+$/;
        $('*').removeClass('border border-danger');
        if($('#admin_name').val()=="")
        {
            $('#admin_name_err').text('Please Enter Admin Name');
            $('#admin_name').addClass('border border-danger');
            f=1;
        }
        else if(!regex.test($('#admin_name').val())){
            $('#admin_name_err').text("Please enter valid name");
            $('#admin_name').addClass('border border-danger');
            f = 1;
        }
        else{
            $('#admin_name_err').text('');
        }

        regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if($('#clg_email').val()=="")
        {
            $('#clg_email_err').text('Please Enter Email');
            $('#clg_email').addClass('border border-danger');
            f=1;
        }
        else if(!regex.test($('#clg_email').val()))
        {
            $('#clg_email_err').text('Please Enter valid Email');
            $('#clg_email').addClass('border border-danger');
            f=1;
        }
        else{
            $('#clg_email_err').text('');
        }

        var regex = /^[A-Za-z\s]+$/;

        if($('#clg_name').val()=="")
        {
            $('#clg_name_err').text('Please Enter Institute/College Name');
            $('#clg_name').addClass('border border-danger');
            f=1;
        }
        else if(!regex.test($('#clg_name').val())){
            $('#clg_name_err').text("Please Enter Institute/College Name");
            $('#clg_name').addClass('border border-danger');
            f = 1;
        }
        else{
            $('#clg_name_err').text('');
        }
        
        regex = /^\d*(?:\.\d{1,2})?$/;
        if($('#clg_mob').val()=="")
        {
            $('#clg_mob_err').text('Please Enter Institue/College Mobile no');
            $('#clg_mob').addClass('border border-danger');
            f=1;
        }
        else if(!regex.test($('#clg_mob').val())){
            $('#clg_mob_err').text("Please Enter Valid Mobile no");
            $('#clg_mob').addClass('border border-danger');
            f = 1;
        }
        else if(!(regex.test($('#clg_mob').val()) && $('#clg_mob').val().length == 10))
        {
            $('#clg_mob_err').text("Please enter valid Mobile no.");
            $('#clg_mob').addClass('border border-danger');
            f = 1;
        }
        else{
            $('#clg_mob_err').text("");
        }


        if($('#city_name').val()=="")
        {
            $('#city_name_err').text('Please Enter City Name');
            $('#city_name').addClass('border border-danger');
            f=1;
        }
        else{
            $('#city_name_err').text('');
        }

        if($('#clg_add').val()=="")
        {
            $('#clg_add_err').text('Please Enter Institue/College Address');
            $('#clg_add').addClass('border border-danger');
            f=1;
        }
        else{
            $('#clg_add_err').text('');
        }
        if(f==1)
        {
            return false;
        }
        return true;
       
    }
</script>
@endsection