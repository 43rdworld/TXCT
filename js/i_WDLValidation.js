$(document).ready(function () {
	$("#theForm").validate({

        rules: {
    //* EVENT REGISTRATION *******************************************************************************************************************************

    //= CONTACT INFORMATION ==============================================================================================================================
                conTitle: {
                                required:true,
                               minlength: 2,
                                remote: {url: "i_validate.php", async: false}
                          },
                conFName: {
                                required:true,
                                maxlength:20,
                                remote: {url: "i_validate.php", async: false}
                          },
                conLName:   {
                                required:true,
                                maxlength:20,
                                remote: {url: "i_validate.php", async: false}
                            },
                conAddress: {
                                required:true,
                                maxlength:50,
                                remote: {url: "i_validate.php", async: false}
                            },
                conCity:    {
                                required:true,
                                maxlength:30,
                                remote: {url: "i_validate.php", async: false}
                            },
                conState:   {
                                required:true,
                                remote: {url: "i_validate.php"}
                            },
                conZip:     {
                                required:true,
                                maxlength:5,
                                digits:true,
                                remote: {url: "i_validate.php", async: false}
                            },
                conPhone:   {
                                required:true,
                                phonenumber:true,
                                remote: {url: "i_validate.php", async: false}
                            },
                conEmail:   {
                                required:true,
                                email:true,
                                remote: {url: "i_validate.php", async: false}
                            },
         conConfirmEmail:   {
                                email:true,
                                equalTo: '#conEmail',
                                remote: {url: "i_validate.php", async: false}
                            },

    //= PURCHASE TICKETS =================================================================================================================================
            tktTickets:     {
                                required:true,
                                remote: {url: "i_validate.php", async: false}
                            },
    //= PURCHASE A TABLE =================================================================================================================================
            tblNumTables: {
                required: {
                    depends: function () {
                        var sel = $('input[name=tblMoreTables]:checked', '#theForm').val();
                        if (sel == 1) {
                            return false;
                        }
                        else {
                            return true;
                        }
                    }
                }
            },

    //= DONATION =========================================================================================================================================
            donateAmt:   {
                required: true,
                remote: {url: "i_validate.php", async: false}
            },
    //= SPONSORSHIP ======================================================================================================================================
            sponsorLevel:   {
                required: true,
                remote: {url: "i_validate.php", async: false}
            },
    //= RAFFLE ===========================================================================================================================================
            raffleTickets:   {
                required:
                {
                    depends:function()
                    {
                        var sel = $('input[name=selectEvent]:checked', '#theForm').val();

                        if(sel =='raffle')
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                },
                integer:
                {
                    depends:function()
                    {
                        var sel = $('input[name=selectEvent]:checked', '#theForm').val();

                        if(sel =='raffle')
                        {
                            return true;
                        }
                        else
                        {
                            return false;
                        }
                    }
                }
    /*            'selectEvent[name]': {
                    required: true,
                    remote: {
                        param: {
                            url: "i_validate.php",
                                data: {
                                'selectEvent[id]': "selectRaffle"
                            }
                        },
                        depends: function() {
                            return $("#selectRaffle").val() !== "raffle";
                        }
                    }
                }*/
            }
        },

            errorPlacement: function(error, element) {
    //= CONTACT INFORMATION ERROR CONTAINERS =============================================================================================================
                if(element.attr("name") === "conTitle") {
                    error.appendTo("#conTitleError");
                } else if (element.attr("name") === "conFName") {
                    error.appendTo("#conFNameError");
                } else if (element.attr("name") === "conLName") {
                    error.appendTo("#conLNameError");
                } else if (element.attr("name") === "conAddress") {
                    error.appendTo("#conAddressError");
                } else if (element.attr("name") === "conCity") {
                    error.appendTo("#conCityError");
                } else if (element.attr("name") === "conState") {
                    error.appendTo("#conStateError");
                } else if (element.attr("name") === "conZip") {
                    error.appendTo("#conZipError");
                } else if (element.attr("name") === "conPhone") {
                    error.appendTo("#conPhoneError");
                } else if (element.attr("name") === "conEmail") {
                    error.appendTo("#conEmailError");
                } else if (element.attr("name") === "conConfirmEmail") {
                    error.appendTo("#conConfirmEmailError");
                }

    //= TICKET INFORMATION ERROR CONTAINER ===============================================================================================================
                if(element.attr("name") === "tktTickets") {
                    error.appendTo("#tktTicketsError");
                }

    //= TABLE INFORMATION ERROR CONTAINER ================================================================================================================
                if(element.attr("name") === "tblNumTables") {
                    error.appendTo("#tblNumTablesError");
                }
    //= DONATION ERROR CONTAINER =========================================================================================================================
                if(element.attr("name") === "donateAmt") {
                    error.appendTo("#donateAmtError");
                }
    //= SPONSOR ERROR CONTAINER ==========================================================================================================================
                if(element.attr("name") === "sponsorLevel") {
                    error.appendTo("#sponsorLevelError");
                }
    //= RAFFLE TICKET ERROR CONTAINER ====================================================================================================================
                if(element.attr("name") === "raffleTickets") {
                    error.appendTo("#raffleTicketsError");
                }
    //======================================================================================================================


    //		highlight: function(element,errorClass) {
    //        	$("#nomFNameError").addClass("errorMessage").removeClass("successMessage");
    //			//$(element.form).find("div#nomFNameError").addClass("errorClass");
    //	    },
    //    	unhighlight: function(element,errorClass) {
    //        	$("#nomFNameError").removeClass("errorMessage").addClass("successMessage");
    //			//$(element.form).find("div#nomFNameError").removeClass("errorClass");
            },
            messages: {
//= CONTACT INFORMATION ERROR MESSAGES ===============================================================================================================
                    conTitle:   {
                        required:   "* Title is required",
                       minlength:   "* Title must at least 2 characters",
                          remote:   "*  No numbers or special characters"
                    },
                    conFName:   {
                        required:   "* First name is required",
                       maxlength:   "* First name is limited to 20 characters",
                          remote:   "*  No numbers or special characters"
                    },
                    conLName:   {
                        required:   "* Last name is required",
                       maxlength:   "* Last name is limited to 20 characters",
                          remote:   "* No numbers or special characters"
                    },
                    conAddress:     {
                        required:   "* Mailing address is required",
                       maxlength:   "* Address is limited to 50 characters",
                          remote:   "* Special characters are not allowed"
                    },
                    conCity:  {
                        required:   "* City is required",
                        maxlength:  "* City is limited to 30 characters",
                        remote:     "* Special characters are not allowed"
                    },
                    conState:   {
                        required:   "* State is required",
                        remote:     "* State is a maximum of 2 letters"
                    },
                    conZip: {
                        required:   "* A zip code is required",
                        maxlength:  "* A zip code is limited to 5 characters",
                        digits:     "* Only numbers are allowed",
                        remote:     "* Only numbers are allowed"
                    },
                    conPhone: "* Phone number is required",
                    conEmail: {
                        required:   "* An email address is required",
                        email:      "* A valid email address is required",
                        remote:     "* A valid email address is required"
                    },
                    conConfirmEmail: {
                        email:      "* A valid email address is required",
                        equalTo:    "* Email addresses must match"
                    },
        //= TICKET SALES ERROR MESSAGES ======================================================================================================================
                    tktTickets:      {
                        required:   "* Select the number of tickets needed",
                        remote:     "* Select the number of tickets needed"
                    },
                    tblNumTables:   {
                        required:   "* Select the number of tables needed",
                        remote:     "* Select the number of tables neededx"
                    },
                    donateAmt:   {
                        required:   "* A donation amount is required",
                        remote:     "* A donation amount is required"
                    },
                    sponsorLevel:   {
                        required:   "* Please select a sponsorship level",
                        remote:   "* Please select a sponsorship level"
                    },
                    raffleTickets:   {
                        required:   "* Indicate number of raffle tickets",
                        integer:    "* Indicate number of raffle tickets"
            //            remote:     "* Indicate number of raffle tickets"

                    }
    //----------------------------------------------------------------------------------------------------------------------------------------------------

        //        submitHandler: function() {
        //            alert('valid form');
        //            return false;
        //		},
            }

        });


        $("#theBillingForm").validate({

            rules: {
                billingFName:	{
                    required:true,
                    maxlength:20,
                    remote: {url: "i_validate.php", async: false}
                },
                billingLName:	{
                    required:true,
                    maxlength:20,
                    remote: {url: "i_validate.php", async: false}
                },
                billingAddress: {
                    required:true,
                    maxlength:50,
                    remote: {url: "i_validate.php", async: false}
                },
                billingCity:	{
                    required:true,
                    maxlength:30,
                    remote: {url: "i_validate.php", async: false}
                },
                billingState:	{
                    required:true
//                    remote: {url: "i_validate.php"}
                },
                billingZip: 	{
                    required:	true,
                    maxlength:	5,
                    digits:	true,
                    remote:	{url: "i_validate.php", async: false}
                },
                billingPhone:	{
                    required: true,
                    remote: {url: "i_validate.php", async: false}
                },
                billingEmail: 	{
                    required:	true,
                    email:	true,
                    remote: {url: "i_validate.php", async: false}
                },
                ccNum: 	{
                    required:	true,
                    remote: {url: "i_validate.php", async: false}
                },
                ccExpMonth: 	{required:	true},
                ccExpYear: 	{required:	true},
                ccCVV2: 	{
                    required:	true,
                    digits: true,
                    remote: {url: "i_validate.php", async: false}
                }
//======================================================================================================================
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") === "billingFName") {
                    error.appendTo("#billingFNameError");
                } else if(element.attr("name") === "billingLName") {
                    error.appendTo("#billingLNameError");
                } else if(element.attr("name") === "billingAddress") {
                    error.appendTo("#billingAddressError");
                } else if(element.attr("name") === "billingCity") {
                    error.appendTo("#billingCityError");
                } else if(element.attr("name") === "billingState") {
                    error.appendTo("#billingStateError");
                } else if(element.attr("name") === "billingZip") {
                    error.appendTo("#billingZipError");
                } else if(element.attr("name") === "billingPhone") {
                    error.appendTo("#billingPhoneError");
                } else if(element.attr("name") === "billingEmail") {
                    error.appendTo("#billingEmailError");
                } else if(element.attr("name") === "ccNum") {
                    error.appendTo("#ccNumError");
                } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
                    $("#ccDateError").empty();
                    error.appendTo("#ccDateError");
                } else if(element.attr("name") === "ccCVV2") {
                    error.appendTo("#ccCVV2Error");
                }
//======================================================================================================================
            },
            messages: {
                billingFName:	{
                    required: "* First name is required",
                    maxlength: "* First name is limited to 20 characters",
                    remote: "* No numbers or special characters"
                },
                billingLName:	{
                    required: "* Last name is required",
                    maxlength: "* Last name is limited to 20 characters",
                    remote: "* No numbers or special characters"
                },
                billingAddress:	{
                    required: "* Address is required",
                    maxlength: "* Address is limited to 50 characters",
                    remote: "* Special characters are not permitted"
                },
                billingCity:	{
                    required: "* City is required",
                    maxlength: "* City is limited to 30 characters",
                    remote: "* Special characters are not permitted"
                },
                billingState:	{
                    required: "* State is required"
//			    remote: "* State is a maximum of 2 letters"
                },
                billingZip:	{
                    required: "* Zip code is required",
                    maxlength: "* Zip code is limited to 5 characters",
                    digits: "* Only numbers are allowed",
                    remote: "* Only numbers are allowed"
                },
                billingPhone:	{
                    required: "* Phone number is required",
                    remote: "* A valid phone number is required"
                },
                billingEmail: 	{
                    required: "* An email address is required",
                    email: "* A valid email address is required",
                    remote: "* A valid email address is required"
                },
                ccNum:	{
                    required: "* Credit card number is required",
                    remote: "* A valid credit card number is required"
                },
                ccExpMonth:	{
                    required: "* Card expiration date is required"
//					remote: "* Card expireation month is requiredx"
                },
                ccExpYear:  	{
                    required: "* Card expiration date is required"
//					remote: "* Card expiration year is requiredx"
                },
                ccCVV2:	{
                    required: "* Card security code is required",
                    digits: "* Only numbers are allowed",
                    remote: "* Only numbers are allowedx"
                }
//======================================================================================================================
            },

            submitHandler: function(form) {
    //			if (confirm('You are about to submit a payment of $12345.\n\nClick OK to confirm or Cancel to return to the form.')) {
    //				return false;
                    form.submit();
    //			}
            }






        });





        $.validator.addMethod('phone', function(value) {
          return (
            value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
          );
        })




        jQuery.validator.addMethod('integer', function(value, element, param) {
            return (value != 0) && (value == parseInt(value, 10));
        }, 'Please enter a non zero integer value!');

        jQuery.validator.addMethod('require_from_group_updated', function (value, element, options) {
            var numberRequired = options[0];
            var selector = options[1];
            var fields = $(selector, element.form);
            var filled_fields = fields.filter(function () {
            // it's more clear to compare with empty string
                return $(this).val() != "";
            });
            var empty_fields = fields.not(filled_fields);
            // we will mark only first empty field as invalid
            if (filled_fields.length < numberRequired && empty_fields[0] == element) {
                return false;
            }
            return true;
            // {0} below is the 0th item in the options field
        }, jQuery.format("* Please fill out at least {0} of these fields."));


        jQuery.validator.addMethod("phonenumber", function(value) {
            var re = new RegExp("[\\d\\s()+-]", "g");
            return re.test(value);
            //return value.match("/[\d\s]*$");
        }, "Please enter a valid phone number");

});

