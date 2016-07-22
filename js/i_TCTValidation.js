    $(document).ready(function () {
        //= VALIDATE DONOR INFORMATION FORM ==========================================================================================================
        $("#theForm").validate({
            rules: {
                //= DONOR INFORMATION ================================================================================================================
                t2tFName: {
                    required:true,
                    minlength: 2,
                    maxlength: 25,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tLName: {
                    required:true,
                    minlength: 2,
                    maxlength:25,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tAddress: {
                    required:true,
                    minlength: 2,
                    maxlength:50,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tAddress2: {
                    required:   false,
                    minlength:  2,
                    maxlength:  50,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tCity: {
                    required: true,
                    minlength: 2,
                    maxlength: 30,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tState: {
                    required: true,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tZip: {
                    required:   true,
                    digits:     true,
                    minlength:  5,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tPhone: {
                    required:   true,
                    phone:      true,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tEmail: {
                    required:   true,
                    emailX:     true,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tConfirmEmail: {
                    required:   true,
                    emailX:     true,
                    equalTo:    '#t2tEmail',
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                t2tAmount: {
                    required: true,
                    remote: {url: "includes/i_T2TValidate.php", async: false}
                },
                t2tReferringTroop: {
                    required: {
                        depends: function () {
                            return $('input[name=t2tRefer]:checked').val() == 'gs';
                        }
                    }
                    //remote: {url: "includes/i_T2TValidate.php", async: false}
                },
                t2tReferringName: {
                    required: {
                        depends: function () {
                            return $('input[name=t2tRefer]:checked').val() == 'gs';
                        }
                    },
                    maxlength: 50,
                    remote: {url: "includes/i_T2TValidate.php", async: false}
                }
            },
            //================================================================================================================================================
            //= ERROR PLACEMENT ==============================================================================================================================
            errorPlacement: function(error, element) {
                //= CONTACT INFORMATION ERROR CONTAINERS =============================================================================================================
                if(element.attr("name") === "t2tFName") {
                    error.appendTo("#t2tFNameError");
                } else if (element.attr("name") === "t2tLName") {
                    error.appendTo("#t2tLNameError");
                } else if (element.attr("name") === "t2tAddress") {
                    error.appendTo("#t2tAddressError");
                } else if (element.attr("name") === "t2tAddress2") {
                    error.appendTo("#t2tAddress2Error");
                } else if (element.attr("name") === "t2tCity") {
                    error.appendTo("#t2tCityError");
                } else if (element.attr("name") === "t2tState") {
                    error.appendTo("#t2tStateError");
                } else if (element.attr("name") === "t2tZip") {
                    error.appendTo("#t2tZipError");
                } else if (element.attr("name") === "t2tPhone") {
                    error.appendTo("#t2tPhoneError");
                } else if (element.attr("name") === "t2tEmail") {
                    error.appendTo("#t2tEmailError");
                } else if (element.attr("name") === "t2tConfirmEmail") {
                    error.appendTo("#t2tConfirmEmailError");
                } else if (element.attr("name") === "t2tAmount") {
                    error.appendTo("#t2tAmountError");
                } else if (element.attr("name") === "t2tReferringTroop") {
                    error.appendTo("#t2tReferringTroopError");
                } else if (element.attr("name") === "t2tReferringName") {
                    error.appendTo("#t2tReferringNameError");
                }
            },
            //=================================================================================================================================================================
            //= ERROR PLACEMENT ==============================================================================================================================
            messages: {
                //= DONOR INFORMATION ERROR MESSAGES =========================================================================================================
                t2tFName:   {
                    required:   "* First name is required",
                    minlength:   "* Must be at least 2 characters",
                    maxlength:   "* No more than 25 characters",
                    remote:   "* No numbers or special characters"
                },
                t2tLName:   {
                    required:   "* First name is required",
                    minlength:   "* Must be at least 2 characters",
                    maxlength:   "* No more than 25 characters",
                    remote:   "* No numbers or special characters"
                },
                t2tAddress:   {
                    required:   "* Address is required",
                    minlength:   "* Must be at least 2 characters",
                    maxlength:  "* No more than 50 characters",
                    remote:     "* Special characters not allowed"
                },
                t2tAddress2:   {
                    required:   "",
                    minlength:   "* Must be at least 2 characters",
                    maxlength:  "* No more than 50 characters",
                    remote:     "* Special characters not allowed"
                },
                t2tCity:   {
                    required:   "* City name is required",
                    minlength:  "* Must be at least 2 characters",
                    maxlength:  "* No more than 30 characters",
                    remote:     "* Special characters not allowed"
                },
                t2tState:   {
                    required:   "* State is required",
                    remote:     "* Make a selection from the list"
                },
                t2tZip:   {
                    required:   "* Zip Code is required",
                    digits:     "* Numbers Only",
                    minlength:  "* Zip Code must be 5 characters",
                    remote:     "* Numbers Only"
                },
                t2tPhone: {
                    required:   "* Phone Number is required",
                    phone:      "* A valid phone number is required",
                    remote:     "* A valid phone number is required"
                },
                t2tEmail: {
                    required:   "* An email address  is required",
                    emailX:     "* A valid email address  is required",
                    remote:     "* A valid email address  is required"
                },
                t2tConfirmEmail: {
                    required:   "* An email address  is required",
                    emailX:     "* A valid email address  is required",
                    equalTo:    "* Email addresses must match",
                    remote:     "* A valid email address  is required"
                },
                t2tAmount: {
                    required:   "* Donation amount is required",
                    remote:     "* Select an amount from the list"
                },
                t2tReferringTroop: {
                    required:   "* Select a troop from the list"
                },
                t2tReferringName: {
                    required:   "* Name of referring Scout",
                    maxlength:  "* No more than 50 characters",
                    remote:     "* No numbers or special characters"
                }
            //    //----------------------------------------------------------------------------------------------------------------------------------------------------
            //    //
            //    //submitHandler: function() {
            //    //  alert('valid form');
            //    //  return false;
            //    //},
            }

        });

        //= VALIDATE DONOR INFORMATION FORM ===================================================================================================================================
        $("#theBillingForm").validate({
            rules: {
                billingFName:	{
                    required:true,
                    maxlength:25,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                billingLName:	{
                    required:true,
                    maxlength:25,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                billingAddress: {
                    required:   true,
                    maxlength:  50,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                billingAddress2: {
                    required:   false,
                    maxlength:  50,
                    remote:     {url: "includes/i_T2TValidate.php", async: true}
                },
                billingCity:	{
                    required:true,
                    maxlength:30,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                billingState:	{
                    required:true,
                    remote: {url: "includes/i_T2TValidate.php"}
                },
                billingZip: 	{
                    required:	true,
                    maxlength:	5,
                    digits:	true,
                    remote:	{url: "includes/i_T2TValidate.php", async: true}
                },
                billingPhone:	{
                    required: true,
                    remote: {url: "includes/i_T2TValidate.php", async: true}
                },
                billingEmail: 	{
                    required:	true,
                    email:	true,
                    remote: {url: "includes/i_T2TValidate.php", async: false}
                },
                ccNum: 	{
                    required:	true,
                    remote: {url: "includes/i_T2TValidate.php", async: false}
                },
                ccExpMonth: 	{required:	true},
                ccExpYear: 	{required:	true},
                ccCVV2: 	{
                    required:	true,
                    digits: true,
                    remote: {url: "includes/i_T2TValidate.php", async: false}
                }
        //=====================================================================================================================================================================
            },
            errorPlacement: function(error, element) {
                if(element.attr("name") === "billingFName") {
                    error.appendTo("#billingFNameError");
                } else if(element.attr("name") === "billingLName") {
                    error.appendTo("#billingLNameError");
                } else if(element.attr("name") === "billingAddress") {
                    error.appendTo("#billingAddressError");
                } else if(element.attr("name") === "billingAddress2") {
                    error.appendTo("#billingAddress2Error");
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
        //=====================================================================================================================================================================
            },
            messages: {
                billingFName:	{
                    required:   "* First name is required",
                    maxlength:  "* First name is limited to 20 characters",
                    remote:     "* No numbers or special characters"
                },
                billingLName:	{
                    required:   "* Last name is required",
                    maxlength:  "* Last name is limited to 20 characters",
                    remote:     "* No numbers or special characters"
                },
                billingAddress:	{
                    required:   "* Address is required",
                    maxlength:  "* Address is limited to 50 characters",
                    remote:     "* Special characters are not permitted"
                },
                billingAddress2:	{
                    maxlength:  "* Address is limited to 50 characters",
                    remote:     "* Special characters are not permitted"
                },
                billingCity:	{
                    required:   "* City is required",
                    maxlength:  "* City is limited to 30 characters",
                    remote:     "* No numbers or special characters"
                },
                billingState:	{
                    required:   "* State is required",
    			    remote:     "* State is a maximum of 2 letters"
                },
                billingZip:	{
                    required:   "* Zip code is required",
                    maxlength:  "* Zip code is limited to 5 characters",
                    digits:     "* Only numbers are allowed",
                    remote:     "* Only numbers are allowed"
                },
                billingPhone:	{
                    required:   "* Phone number is required",
                    remote:     "* A valid phone number is required"
                },
                billingEmail: 	{
                    required:   "* Email address is required",
                    email:      "* A valid email address is required",
                    remote:     "* A valid email address is required"
                },
                ccNum:	{
                    required: "* Credit card number is required",
                    remote: "* A valid credit card number is required"
                },
                ccExpMonth:	{
                    required: "* Card expiration date is required"
					//remote: "* Card expireation month is requiredx"
                },
                ccExpYear:  	{
                    required: "* Card expiration date is required"
					//remote: "* Card expiration year is requiredx"
                },
                ccCVV2:	{
                    required: "* Card security code is required",
                    digits: "* Only numbers are allowed",
                    remote: "* Only numbers are allowed"
                }
            //==================================================================================================================================================
            },
//
//
//
//
//            submitHandler: function(form) {
//                //if (confirm('You are about to submit a payment of $12345.\n\nClick OK to confirm or Cancel to return to the form.')) {
//                //return false;
//                    form.submit();
//                //}
//            }
        });
//
//        //= VALIDATE ACH PAYMENT FORM ================================================================================================================
//        $("#theACHPaymentForm").validate({
//            rules: {
//                achSU:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                //achTroopNum:	{
//                //    required:   true
//                //    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                //},
//                achAccountName:	{
//                    required:   true,
//                    maxlength:  21,
//                    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                achPhone:	{
//                    required:   true,
//                    phone:      true,
//                    remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                achEmail: 	{
//                    required:	true,
//                    emailX:	    true,
//                    remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                achConfirmEmail: {
//                    required:   true,
//                    emailX:     true,
//                    equalTo:    '#achEmail',
//                    remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                achRouting:	{
//                    required:true,
//                    digits: true,
//                    remote: {
//                        url:	"includes/i_GetRoutingNumberStatus.php",
//                        type:	"post",
//                        data:	{
//                            id: function() {
//                                return $('#theACHPaymentForm :input[name="achRouting"]').val();
//                            }
//                        }
//                    }
//                },
//                achRoutingConfirm:	{
//                    digits: {
//                        param: '#achRoutingConfirm',
//                        depends: function(element) {return $("#achRouting").val()!="";}
//                    },
//                    equalTo: {
//                        param: '#achRouting',
//                        depends: function(element) {return $("#achRouting").val()!="";}
//                    }
//                },
//                achAccount:	{
//                    required: true,
//                    remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                achAccountConfirm:	{
//                    equalTo: {
//                        param: '#achAccount',
//                        depends: function(element) {return $("#achAccount").val()!="";}
//                    }
//                },
//                achAmount:	{
//                    required:   true,
//                    remote: {url: "includes/i_ACHValidate.php", async: false}
//                }
//            //========================================================================================================================================
//            },
//            errorPlacement: function(error, element) {
//                if(element.attr("name") === "achSU") {
//                    error.appendTo("#achSUError");
//                } else if(element.attr("name") === "achTroopNum") {
//                    error.appendTo("#achTroopNumError");
//                } else if(element.attr("name") === "achAccountName") {
//                    error.appendTo("#achAccountNameError");
//                } else if(element.attr("name") === "achPhone") {
//                    error.appendTo("#achPhoneError");
//                } else if(element.attr("name") === "achEmail") {
//                    error.appendTo("#achEmailError");
//                } else if(element.attr("name") === "achConfirmEmail") {
//                    error.appendTo("#achConfirmEmailError");
//                } else if(element.attr("name") === "achRouting") {
//                    error.appendTo("#achRoutingError");
//                } else if(element.attr("name") === "achRoutingConfirm") {
//                    error.appendTo("#achRoutingConfirmError");
//                } else if(element.attr("name") === "achAccount") {
//                    error.appendTo("#achAccountError");
//                } else if(element.attr("name") === "achAccountConfirm") {
//                    error.appendTo("#achAccountConfirmError");
//                } else if(element.attr("name") === "achAmount") {
//                    error.appendTo("#achAmountError");
////                } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
////                    $("#ccDateError").empty();
////                    error.appendTo("#ccDateError");
////                } else if(element.attr("name") === "ccCVV2") {
////                    error.appendTo("#ccCVV2Error");
//                }
//////======================================================================================================================
//            },
//            messages: {
//                achSU: {
//                    required:   "* Select your service unit"
//                },
//                //achTroopNum: {
//                //    required:   "* Select your Troop number"
//                //},
//                achAccountName:	{
//                    required:   "* Account name required",
//                    maxlength:  "* No more than 21 characters",
//                    remote:     "* No special characters"
//                },
//                achPhone:	{
//                    required:   "* Phone number required",
//                    phone:      "* Valid phone number required",
//                    remote:     "* Valid phone number required"
//                },
//                achEmail: 	{
//                    required:   "* Email address required",
//                    emailX:     "* Email address must be valid",
//                    remote:     "* Valid email address required"
//                },
//                achConfirmEmail: {
//                    required:   "* Email address  required",
//                    emailX:     "* Valid email address required",
//                    equalTo:    "* Email addresses must match",
//                    remote:     "* Valid email address required"
//                },
//                achRouting:	{
//                    required:	"* A bank routing number is required",
//                    digits:	    "* Numbers only",
//                    remote:	    "* A valid routing number is required"
//                },
//                achRoutingConfirm:	{
//                    digits:	    "* Numbers only",
//                    equalTo:	"* Routing numbers must match"
//                },
//                achAccount:	{
//                    required:	"* An account number is required",
//                    remote:	    "* An account number is required"
//                },
//                achAccountConfirm:	{
//                    equalTo:	"* Account numbers must match"
//                },
//                achAmount: {
//                    required:   "* Payment amount required",
//                    remote:     "* Payment amount required"
//                }
//            //========================================================================================================================================
//            },
//
//
//
//
//            submitHandler: function(form) {
//                if (confirm('You are about to submit an ACH payment of $'+$('#achAmount').val()+'.\n\nClick OK to confirm or Cancel to return to the form.')) {
//                //return true;
//                form.submit();
//                }
//           }
//        });
//
//
//
//        //= VALIDATE OFR REPORTING FORM ==============================================================================================================
//        $("#theOFRReportForm").validate({
//            rules: {
//                ofrSU: {
//                    required: true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tctTroopNum:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderFName:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderLName:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderEmail:	{
//                    required:   true,
//                    emailX:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderEmail2: {
//                    emailX: {
//                        param: '#troopLeaderEmail',
//                        depends: function (element) {return $("#troopLeaderEmail").val() != "";}
//                    },
//                    equalTo: {
//                        param: '#troopLeaderEmail',
//                        depends: function (element) {return $("#troopLeaderEmail").val() != "";}
//                    }
//                    //remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderAddress:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderCity:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderZip:	{
//                    required:   true,
//                    digits:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                troopLeaderPhone:	{
//                    required:   true,
//                    phone:      true
//                     //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//            //= TCM SECTION ==========================================================================================================================
//                tcmFName:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmLName:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmEmail:	{
//                    required:   true,
//                    emailX:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmEmail2: {
//                    emailX: {
//                        param:  '#tcmEmail',
//                      depends:  function (element) {return $("#tcmEmail").val() != "";}
//                    },
//                    equalTo: {
//                        param:  '#tcmEmail',
//                      depends:  function (element) {return $("#tcmEmail").val() != "";}
//                    }
//                    //remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmAddress: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmCity: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmZip: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                tcmPhone: {
//                    required:   true,
//                    phone:      true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//            //= INDIVIDUAL DELINQUENCY SECTION =======================================================================================================
//                girlFName: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                girlLName: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianFName: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianLName: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianEmail:	{
//                    required:   true,
//                    emailX:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianEmail2: {
//                    emailX: {
//                        param:  '#parentGuardianEmail',
//                        depends:  function (element) {return $("#parentGuardianEmail").val() != "";}
//                    },
//                    equalTo: {
//                        param:  '#parentGuardianEmail',
//                        depends:  function (element) {return $("#parentGuardianEmail").val() != "";}
//                    }
//                    //remote:     {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianAddress:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianCity:	{
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianZip:	{
//                    required:   true,
//                    digits:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                parentGuardianPhone:	{
//                    required:   true,
//                    phone:     true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//            //= REPORT INFORMATION SECTION ===========================================================================================================
//                ofrSubmitter: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                ofrPhone: {
//                    required:   true,
//                    phone:      true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                ofrComment: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                ofrAmountOwed: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                },
//                ofrAmountPaid: {
//                    required:   true
//                    //    remote: {url: "includes/i_ACHValidate.php", async: false}
//                }
//            },
//            errorPlacement: function(error, element) {
//                if (element.attr("name") === "ofrSU") {
//                    error.appendTo("#ofrSUError");
//                } else if (element.attr("name") === "tctTroopNum") {
//                    error.appendTo("#tctTroopNumError");
//                } else if (element.attr("name") === "troopLeaderFName") {
//                    error.appendTo("#troopLeaderFNameError");
//                } else if (element.attr("name") === "troopLeaderLName") {
//                    error.appendTo("#troopLeaderLNameError");
//                } else if (element.attr("name") === "troopLeaderEmail") {
//                    error.appendTo("#troopLeaderEmailError");
//                } else if (element.attr("name") === "troopLeaderEmail2") {
//                    error.appendTo("#troopLeaderEmail2Error");
//                } else if (element.attr("name") === "troopLeaderAddress") {
//                    error.appendTo("#troopLeaderAddressError");
//                } else if (element.attr("name") === "troopLeaderCity") {
//                    error.appendTo("#troopLeaderCityError");
//                } else if (element.attr("name") === "troopLeaderZip") {
//                    error.appendTo("#troopLeaderZipError");
//                } else if (element.attr("name") === "troopLeaderPhone") {
//                    error.appendTo("#troopLeaderPhoneError");
//            //= TCM SECTION ==========================================================================================================================
//                } else if (element.attr("name") === "tcmFName") {
//                    error.appendTo("#tcmFNameError");
//                } else if (element.attr("name") === "tcmLName") {
//                    error.appendTo("#tcmLNameError");
//                } else if (element.attr("name") === "tcmEmail") {
//                    error.appendTo("#tcmEmailError");
//                } else if (element.attr("name") === "tcmEmail2") {
//                    error.appendTo("#tcmEmail2Error");
//                } else if (element.attr("name") === "tcmAddress") {
//                    error.appendTo("#tcmAddressError");
//                } else if (element.attr("name") === "tcmCity") {
//                    error.appendTo("#tcmCityError");
//                } else if (element.attr("name") === "tcmZip") {
//                    error.appendTo("#tcmZipError");
//                } else if (element.attr("name") === "tcmPhone") {
//                    error.appendTo("#tcmPhoneError");
//                } else if (element.attr("name") === "tcmWorkPhone") {
//                    error.appendTo("#tcmWorkPhoneError");
//                } else if (element.attr("name") === "tcmCellPhone") {
//                    error.appendTo("#tcmCellPhoneError");
//            //= INDIVIDUAL DELINQUENCY SECTION =======================================================================================================
//                } else if (element.attr("name") === "girlFName") {
//                    error.appendTo("#girlFNameError");
//                } else if (element.attr("name") === "girlLName") {
//                    error.appendTo("#girlLNameError");
//                } else if (element.attr("name") === "parentGuardianFName") {
//                    error.appendTo("#parentGuardianFNameError");
//                } else if (element.attr("name") === "parentGuardianLName") {
//                    error.appendTo("#parentGuardianLNameError");
//                } else if (element.attr("name") === "parentGuardianEmail") {
//                    error.appendTo("#parentGuardianEmailError");
//                } else if (element.attr("name") === "parentGuardianEmail2") {
//                    error.appendTo("#parentGuardianEmail2Error");
//                } else if (element.attr("name") === "parentGuardianAddress") {
//                    error.appendTo("#parentGuardianAddressError");
//                } else if (element.attr("name") === "parentGuardianCity") {
//                    error.appendTo("#parentGuardianCityError");
//                } else if (element.attr("name") === "parentGuardianZip") {
//                    error.appendTo("#parentGuardianZipError");
//                } else if (element.attr("name") === "parentGuardianPhone") {
//                    error.appendTo("#parentGuardianPhoneError");
//            //= REPORT INFORMATION SECTION ===========================================================================================================
//                } else if (element.attr("name") === "ofrSubmitter") {
//                    error.appendTo("#ofrSubmitterError");
//                } else if (element.attr("name") === "ofrPhone") {
//                    error.appendTo("#ofrPhoneError");
//                } else if (element.attr("name") === "ofrComment") {
//                    error.appendTo("#ofrCommentError");
//                } else if (element.attr("name") === "ofrAmountOwed") {
//                    error.appendTo("#ofrAmountOwedError");
//                } else if (element.attr("name") === "ofrAmountPaid") {
//                    error.appendTo("#ofrAmountPaidError");
//                } else if (element.attr("name") === "ofrBalanceDue") {
//                    error.appendTo("#ofrBalanceDueError");
//                }
//           },
//            messages: {
//                ofrSU: {
//                    required:   "* Select your service unit"
//                },
//                tctTroopNum: {
//                    required:   "* Select your Troop number"
//                },
//                troopLeaderFName: {
//                    required:   "* Troop leader first name is required"
//                },
//                troopLeaderLName: {
//                    required:   "* Troop leader last name is required"
//                },
//                troopLeaderEmail: {
//                    required:   "* Troop leader email is required",
//                    emailX:     "* A valid email address is required"
//                },
//                troopLeaderEmail2: {
//                    equalTo:    "* Email addresses must match",
//                    emailX:     "* A valid email address is required"
//                },
//                troopLeaderAddress: {
//                    required:   "* Troop leader address is required"
//                },
//                troopLeaderCity: {
//                    required:   "* Troop leader city is required"
//                },
//                troopLeaderZip: {
//                    required:   "* Troop leader zip code is required",
//                    digits:     "* Numbers only"
//                },
//                troopLeaderPhone: {
//                    required:   "* Troop leader phone is required",
//                    phone:      "* A valid phone number is required"
//                },
//            //= TCM SECTION ==========================================================================================================================
//                tcmFName: {
//                    required:   "* TCM first name is required"
//                },
//                tcmLName: {
//                    required:   "* TCM last name is required"
//                },
//                tcmEmail: {
//                required:   "* Troop leader email is required",
//                emailX:     "* A valid email address is required"
//                },
//                tcmEmail2: {
//                equalTo:    "* Email addresses must match",
//                emailX:   "* A valid email address is required"
//                },
//                tcmAddress: {
//                    required:   "* TCM Address is required"
//                },
//                tcmCity: {
//                    required:   "* TCM City is required"
//                },
//                tcmZip: {
//                    required:   "* TCM zip code is required"
//                },
//                tcmPhone: {
//                    required:   "* TCM phone number is required",
//                    phone:      "* A valid phone number is required"
//                },
//                tcmWorkPhone: {
//                    phone:   "* A valid phone number is required"
//                },
//                tcmCellPhone: {
//                    phone:   "* A valid phone number is required"
//                },
//            //= INDIVIDUAL DELINQUENCY SECTION =======================================================================================================
//                girlFName: {
//                    required:   "* Girl first name is required"
//                },
//                girlLName: {
//                    required:   "* Girl last name is required"
//                },
//                parentGuardianFName: {
//                    required:   "* Parent/Guardian first name is required"
//                },
//                parentGuardianLName: {
//                    required:   "* Parent/Guardian last name is required"
//                },
//                parentGuardianEmail: {
//                    required:   "* Parent/Guardian email is required",
//                    emailX:     "* A valid email address is required"
//                },
//                parentGuardianEmail2: {
//                    equalTo:    "* Email addresses must match",
//                    emailX:   "* A valid email address is required"
//                },
//                parentGuardianAddress: {
//                    required:   "* Parent/Guardian Address is required"
//                },
//                parentGuardianCity: {
//                    required:   "* Parent/Guardian City is required"
//                },
//                parentGuardianZip: {
//                    required:   "* Parent/Guardian zip code is required",
//                    digits:     "* Numbers only"
//                },
//                parentGuardianPhone: {
//                    required:   "* Parent/Guardian phone is required",
//                    phone:      "* A valid phone number is required"
//                },
//            //= REPORT INFORMATION SECTION ===========================================================================================================
//                ofrSubmitter: {
//                    required:   "* Submitter's name is required"
//                },
//                ofrPhone: {
//                    required:   "* Submitter's phone is required",
//                    phone:      "* A valid phone number is required"
//                },
//                ofrComment: {
//                    required:   "* Comments are required"
//                },
//                ofrAmountOwed: {
//                    required:   "* Amount owed is required"
//                },
//                ofrAmountPaid: {
//                    required:   "* Amount paid is required"
//                }
//
//            }
//
////ofrSubmitter
////ofrPhone
////ofrComment
////ofrAmountOwed
////ofrAmountPaid
////ofrBalanceDue
////                achAccountName:	{
////                    required:   true,
////                    maxlength:  21,
////                    remote: {url: "includes/i_ACHValidate.php", async: false}
////                },
////                achPhone:	{
////                    required:   true,
////                    phone:      true,
////                    remote:     {url: "includes/i_ACHValidate.php", async: false}
////                },
////                achEmail: 	{
////                    required:	true,
////                    emailX:	    true,
////                    remote:     {url: "includes/i_ACHValidate.php", async: false}
////                },
////                achConfirmEmail: {
////                    required:   true,
////                    emailX:     true,
////                    equalTo:    '#achEmail',
////                    remote:     {url: "includes/i_ACHValidate.php", async: false}
////                },
////                achRouting:	{
////                    required:true,
////                    digits: true,
////                    remote: {
////                        url:	"includes/i_GetRoutingNumberStatus.php",
////                        type:	"post",
////                        data:	{
////                            id: function() {
////                                return $('#theACHPaymentForm :input[name="achRouting"]').val();
////                            }
////                        }
////                    }
////                },
////                achRoutingConfirm:	{
////                    digits: {
////                        param: '#achRoutingConfirm',
////                        depends: function(element) {return $("#achRouting").val()!="";}
////                    },
////                    equalTo: {
////                        param: '#achRouting',
////                        depends: function(element) {return $("#achRouting").val()!="";}
////                    }
////                },
////                achAccount:	{
////                    required: true,
////                    remote:     {url: "includes/i_ACHValidate.php", async: false}
////                },
////                achAccountConfirm:	{
////                    equalTo: {
////                        param: '#achAccount',
////                        depends: function(element) {return $("#achAccount").val()!="";}
////                    }
////                },
////                achAmount:	{
////                    required:   true,
////                    remote: {url: "includes/i_ACHValidate.php", async: false}
////                }
////                //========================================================================================================================================
////            },
////            errorPlacement: function(error, element) {
////                if(element.attr("name") === "achSU") {
////                    error.appendTo("#achSUError");
////                } else if(element.attr("name") === "achTroopNum") {
////                    error.appendTo("#achTroopNumError");
////                } else if(element.attr("name") === "achAccountName") {
////                    error.appendTo("#achAccountNameError");
////                } else if(element.attr("name") === "achPhone") {
////                    error.appendTo("#achPhoneError");
////                } else if(element.attr("name") === "achEmail") {
////                    error.appendTo("#achEmailError");
////                } else if(element.attr("name") === "achConfirmEmail") {
////                    error.appendTo("#achConfirmEmailError");
////                } else if(element.attr("name") === "achRouting") {
////                    error.appendTo("#achRoutingError");
////                } else if(element.attr("name") === "achRoutingConfirm") {
////                    error.appendTo("#achRoutingConfirmError");
////                } else if(element.attr("name") === "achAccount") {
////                    error.appendTo("#achAccountError");
////                } else if(element.attr("name") === "achAccountConfirm") {
////                    error.appendTo("#achAccountConfirmError");
////                } else if(element.attr("name") === "achAmount") {
////                    error.appendTo("#achAmountError");
//////                } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
//////                    $("#ccDateError").empty();
//////                    error.appendTo("#ccDateError");
//////                } else if(element.attr("name") === "ccCVV2") {
//////                    error.appendTo("#ccCVV2Error");
////                }
////////======================================================================================================================
////            },
////            messages: {
////                achSU: {
////                    required:   "* Select your service unit"
////                },
////                //achTroopNum: {
////                //    required:   "* Select your Troop number"
////                //},
////                achAccountName:	{
////                    required:   "* Account name required",
////                    maxlength:  "* No more than 21 characters",
////                    remote:     "* No special characters"
////                },
////                achPhone:	{
////                    required:   "* Phone number required",
////                    phone:      "* Valid phone number required",
////                    remote:     "* Valid phone number required"
////                },
////                achEmail: 	{
////                    required:   "* Email address required",
////                    emailX:     "* Email address must be valid",
////                    remote:     "* Valid email address required"
////                },
////                achConfirmEmail: {
////                    required:   "* Email address  required",
////                    emailX:     "* Valid email address required",
////                    equalTo:    "* Email addresses must match",
////                    remote:     "* Valid email address required"
////                },
////                achRouting:	{
////                    required:	"* A bank routing number is required",
////                    digits:	    "* Numbers only",
////                    remote:	    "* A valid routing number is required"
////                },
////                achRoutingConfirm:	{
////                    digits:	    "* Numbers only",
////                    equalTo:	"* Routing numbers must match"
////                },
////                achAccount:	{
////                    required:	"* An account number is required",
////                    remote:	    "* An account number is required"
////                },
////                achAccountConfirm:	{
////                    equalTo:	"* Account numbers must match"
////                },
////                achAmount: {
////                    required:   "* Payment amount required",
////                    remote:     "* Payment amount required"
////                }
////                //========================================================================================================================================
////            },
////
////
////
////
////            submitHandler: function(form) {
////                if (confirm('You are about to submit an ACH payment of $'+$('#achAmount').val()+'.\n\nClick OK to confirm or Cancel to return to the form.')) {
////                    //return true;
////                    form.submit();
////                }
////            }
//        });





        $.validator.addMethod('phone', function(value) {
          return (
            value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
          );
        });

        $.validator.addMethod('emailX', function(value) {
            return (
                value.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/)
            );
        });

        $.validator.addMethod('integer', function(value, element, param) {
            return (value != 0) && (value == parseInt(value, 10));
        }, 'Please enter a non zero integer value!');

        $.validator.addMethod('require_from_group_updated', function (value, element, options) {
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
        }, jQuery.validator.format("* Please fill out at least {0} of these fields."));


        $.validator.addMethod("phonenumber", function(value) {
            var re = new RegExp("[\\d\\s()+-]", "g");
            return re.test(value);
            //return value.match("/[\d\s]*$");
        }, "Please enter a valid phone number");

    });

