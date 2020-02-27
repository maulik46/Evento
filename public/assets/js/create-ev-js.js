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
        else if (edate <= sdate || today > sdate) {
            $('#sdate').parent().addClass('border border-danger');
            $('#sdate').parent().next().text("Starting date of registration should be before the event date and after today ");
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
