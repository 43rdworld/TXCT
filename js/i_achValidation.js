$(document).ready(function () {
	//= VALIDATE ACH PAYMENT FORM ================================================================================================================
	$("#theACHPaymentForm").validate({
		rules: {
			achTroopNum:	{
				required:   true
				//    remote: {url: "includes/i_ACHValidate.php", async: false}
			},
			permSU:	{
			    //required:   true
			    //    remote: {url: "includes/i_ACHValidate.php", async: false}
			},
			achAccountName:	{
				required:   true,
				maxlength:  21,
				remote: {url: "includes/i_ACHValidate.php", async: false}
			},
			achPhone:	{
				required:   true,
				phone:      true,
				remote:     {url: "includes/i_ACHValidate.php", async: false}
			},
			achEmail: 	{
				required:	true,
				emailX:	    true,
				remote:     {url: "includes/i_ACHValidate.php", async: false}
			},
			achConfirmEmail: {
				//required:   true,
				emailX:     true,
				equalTo:    '#achEmail',
				remote:     {url: "includes/i_ACHValidate.php", async: false}
			},
			achRouting:	{
				required:true,
				digits: true,
				remote: {
					url:	"includes/i_GetRoutingNumberStatus.php",
					type:	"post",
					data:	{
						id: function() {
							return $('#theACHPaymentForm :input[name="achRouting"]').val();
						}
					}
				}
			},
			achRoutingConfirm:	{
				digits: {
					param: '#achRoutingConfirm',
					depends: function(element) {return $("#achRouting").val()!="";}
				},
				equalTo: {
					param: '#achRouting',
					depends: function(element) {return $("#achRouting").val()!="";}
				}
			},
			achAccount:	{
				required: true,
				remote:     {url: "includes/i_ACHValidate.php", async: false}
			},
			achAccountConfirm:	{
				equalTo: {
					param: '#achAccount',
					depends: function(element) {return $("#achAccount").val()!="";}
				}
			},
			achAmount:	{
				required:   true,
				remote: {url: "includes/i_ACHValidate.php", async: false}
			}
			//========================================================================================================================================
		},
		errorPlacement: function(error, element) {
			if(element.attr("name") === "achTroopNum") {
				error.appendTo("#achTroopNumError");
			} else if(element.attr("name") === "permSU") {
					error.appendTo("#permSUError");
			} else if(element.attr("name") === "achAccountName") {
				error.appendTo("#achAccountNameError");
			} else if(element.attr("name") === "achPhone") {
				error.appendTo("#achPhoneError");
			} else if(element.attr("name") === "achEmail") {
				error.appendTo("#achEmailError");
			} else if(element.attr("name") === "achConfirmEmail") {
				error.appendTo("#achConfirmEmailError");
			} else if(element.attr("name") === "achRouting") {
				error.appendTo("#achRoutingError");
			} else if(element.attr("name") === "achRoutingConfirm") {
				error.appendTo("#achRoutingConfirmError");
			} else if(element.attr("name") === "achAccount") {
				error.appendTo("#achAccountError");
			} else if(element.attr("name") === "achAccountConfirm") {
				error.appendTo("#achAccountConfirmError");
			} else if(element.attr("name") === "achAmount") {
				error.appendTo("#achAmountError");
//                } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
//                    $("#ccDateError").empty();
//                    error.appendTo("#ccDateError");
//                } else if(element.attr("name") === "ccCVV2") {
//                    error.appendTo("#ccCVV2Error");
			}
////======================================================================================================================
		},
		messages: {
			achTroopNum: {
			    required:   "* Select your Troop number"
			},
			permSU: {
				required: {
					depends: function(element) {
						return $('#achTroopNum option:selected').val() != '';
					}
				}
			},
			achAccountName:	{
				required:   "* Account name required",
				maxlength:  "* No more than 21 characters",
				remote:     "* Special characters are not allowed"
			},
			achPhone:	{
				required:   "* Phone number required",
				phone:      "* Valid phone number required",
				remote:     "* Valid phone number required"
			},
			achEmail: 	{
				required:   "* Email address required",
				emailX:     "* Email address must be valid",
				remote:     "* Valid email address required"
			},
			achConfirmEmail: {
				//required:   "* Email address  required",
				emailX:     "* Valid email address required",
				equalTo:    "* Email addresses must match",
				remote:     "* Valid email address required"
			},
			achRouting:	{
				required:	"* A bank routing number is required",
				digits:	    "* Numbers only",
				remote:	    "* A valid routing number is required"
			},
			achRoutingConfirm:	{
				digits:	    "* Numbers only",
				equalTo:	"* Routing numbers must match"
			},
			achAccount:	{
				required:	"* An account number is required",
				remote:	    "* An account number is required"
			},
			achAccountConfirm:	{
				equalTo:	"* Account numbers must match"
			},
			achAmount: {
				required:   "* Payment amount required",
				remote:     "* Payment amount required"
			}
			//========================================================================================================================================
		}




		//submitHandler: function(form) {
		//	if (confirm('You are about to submit an ACH payment of $'+$('#achAmount').val()+'.\n\nClick OK to confirm or Cancel to return to the form.')) {
		//		return true;
		//		form.submit();
		//	}
		//}
	});

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
		}, $.validator.format("* Please fill out at least {0} of these fields."));

    $.validator.addMethod("maskedPhone", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
        return this.optional(element) || phone_number.length > 9 &&
        //matches the following:
        // (222) 222-2222
        // (222)-222-2222
        // 222 222-2222
        // 222-222-2222
        // (___) ___-____
        // ()  -
        phone_number.match(/^((\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4})|\(_{3}\) (_{3})-(_{4})|\(\s{3}\) (\s{3})-(\s{4})|\(\) -$/);
    }, "Required");


});
