jQuery.noConflict()(function ($) {
    $("#postForm").validate({

            submitHandler: function(form)
            {
                form.submit();
            }
        });


    $( function() {
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            duration: "slow",
            // yearRange: "1965:2022"
            yearRange: (new Date().getFullYear()-57) +":"+ new Date().getFullYear(),
        });
    });

});


// $('.datepicker').datepicker({
//     format: 'mm/dd/yyyy',
//     startDate: '-3d'
// });

