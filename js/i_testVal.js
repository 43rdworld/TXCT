$(document).ready(function () {
    $("#theForm").validate({
        rules: {
            fName: {
                required: true
            },
            lName: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            errorContainer: $("#theForm div.errorBlock");
            if(element.attr("name") === "fName") {
                error.appendTo("#fNameError");
            } else if(element.attr("name") === "lName") {
                error.appendTo("#lNameError");
            }
        },
        messages: {
            fName:	{
                required:	    "First name is required."
            },
            lName:	{
                required:	    "Last name is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
    });

});

