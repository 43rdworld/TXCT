    $(document).ready(function () {
        $("#theForm").validate({
            rules: {
                photoUploadFName: {
                required:   true,
                minlength:  2,
                maxlength:  25
                },
                photoUploadLName: {
                    required:   true,
                    minlength:  2,
                    maxlength:  25
                },
                photoUploadTroopNumber: {
                    required:   true
                },
                photoUploadSU: {
                    required:   true
                },
                photoUploadTroopLeaderFName: {
                    required:   true,
                    minlength:  2,
                    maxlength:  25
                },
                photoUploadTroopLeaderLName: {
                    required:   true,
                    minlength:  2,
                    maxlength:  25
                },
                photoUploadPhone: {
                    required:   true,
                    phone:      true
                },
                photoUploadEmail: {
                    required:   true,
                    emailX:     true
                },
                photoUploadNames: {
                    required:   true
                },
                photoUploadFile: {
                    required:   true,
                    extension:  'jpg|jpeg|gif|png|pdf',
                    filesize:   15728640
                    // remote:     {url: "includes/i_photoUploadValidate.php", async: false}
                }
            },

    //======================================================================================================================
            errorPlacement: function(error, element) {
                if (element.attr("name") === "photoUploadFName") {
                    error.appendTo("#photoUploadFNameError");
                } else if (element.attr("name") === "photoUploadLName") {
                    error.appendTo("#photoUploadLNameError");
                } else if (element.attr("name") === "photoUploadTroopNum") {
                    error.appendTo("#photoUploadTroopNumError");
                } else if (element.attr("name") === "photoUploadSU") {
                    error.appendTo("#photoUploadSUError");
                } else if (element.attr("name") === "photoUploadTroopLeaderFName") {
                    error.appendTo("#photoUploadTroopLeaderFNameError");
                } else if (element.attr("name") === "photoUploadTroopLeaderLName") {
                    error.appendTo("#photoUploadTroopLeaderLNameError");
                } else if (element.attr("name") === "photoUploadPhone") {
                    error.appendTo("#photoUploadPhoneError");
                } else if (element.attr("name") === "photoUploadEmail") {
                    error.appendTo("#photoUploadEmailError");
                } else if (element.attr("name") === "photoUploadNames") {
                    error.appendTo("#photoUploadNamesError");
                } else if (element.attr("name") === "photoUploadFile") {
                    error.appendTo("#photoUploadFileError");
                }
            },    
    //======================================================================================================================
            messages: {
                photoUploadFName: {
                    required:   "* First name is required",
                    minlength:  "* A minimum of 2 characters is required",
                    maxlength:  "* First name is limited to 25 characters"
                },
                photoUploadLName: {
                    required:   "* Last mame is required",
                    minlength:  "* A minimum of 2 characters is required",
                    maxlength:  "* Last name is limited to 25 characters"
                },
                photoUploadTroopNum: {
                    required:   "* A troop number is required"
                },
                photoUploadSU: {
                    required:   "* A service unit number is required"
                },
                photoUploadTroopLeaderFName: {
                    required:   "* Troop leader first name is required",
                   minlength:   "* A minimum of 2 characters is required",
                   maxlength:   "* First name is limited to 25 characters"

                },
                photoUploadTroopLeaderLName: {
                    required:   "* Troop leader last name is required",
                   minlength:   "* A minimum of 2 characters is required",
                   maxlength:   "* Last name is limited to 25 characters"
                },
                photoUploadPhone: {
                    required:   "* A phone number is required",
                    phone:      "* A valid phone number is required"
                },
                photoUploadEmail: {
                    required:   "* An email address is required",
                    emailX:     "* A valid email address is required"
                },
                photoUploadNames: {
                    required:   "* Please identify the people in the photo"
                },
                photoUploadFile: {
                    required:   "* An image file is required",
                    extension:  "* Only jpg, jpeg, png, gif or pdf files",
                    filesize:   "* Files are limited to 10mb or less",
                    // remote:     "* safsafasfdsafd"
                }
                
                // agreeToConditions:	{
                //     required:	    "Please indicate your agreement with our terms and conditions."
                // },
                // photoUploadTroopLeaderFName:	{
                //     required:       "The Troop Leaders' First Name is required",
                //     minlength:      "A minimum of 2 characters is required",
                //     maxlength:      "Last name is limited to 25 characters"
                // },
                // photoUploadTroopLeaderLName:	{
                //     required:       "The Troop Leaders' Last name is required",
                //     minlength:      "A minimum of 2 characters is required",
                //     maxlength:      "Last name is limited to 25 characters"
                // },
            }
    //
    //             submitHandler: function(form) {
    // //			if (confirm('You are about to submit a payment of $' +document.getElementById('accountDepositTemp').value+ '.\n\nClick OK to confirm or Cancel to return to the form.')) {
    //                 form.submit();
    // //			}
    //             },
    //
    //        submitHandler: function() {
    //            alert('valid form');
    //            return false;
    //		},
            });


        $.validator.addMethod('emailX', function(value) {
            return (
                value.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/)
            );
        });

        $.validator.addMethod("zipcodeUS", function(value, element) {
            return this.optional(element) || /\d{5}-\d{4}$|^\d{5}$/.test(value)
        }, "The specified US ZIP Code is invalid");
        $.validator.addMethod('phone', function(value) {
            return (
                value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
            );
        });
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        });
    });

