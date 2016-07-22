$(document).ready(function () {
	//= VALIDATE ACH PAYMENT FORM ================================================================================================================
	$("#theOFRForm").validate({
		rules: {
			ofrTroopNum:	{
				required:   	true
			},
			//permSU:	{
			//    required:   	true
			//},
			troopLeaderFName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderLName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderEmail:	{
				required:		true,
				emailX:	    	true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderEmail2:	{
				emailX:     	true,
				equalTo:    	'#troopLeaderEmail',
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderAddress:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderCity:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderZip:		{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			troopLeaderPhone:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmFName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmLName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmEmail:	{
				required:		true,
				emailX:	    	true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmEmail2:	{
				emailX:     	true,
				equalTo:    	'#tcmEmail',
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmAddress:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmCity:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmZip:		{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			tcmPhone:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			girlFName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			girlLName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianFName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianLName:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianEmail:	{
				required:		true,
				emailX:	    	true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianEmail2:	{
				emailX:     	true,
				equalTo:    	'#parentGuardianEmail',
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianAddress:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianCity:	{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianZip:		{
				required:		true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianPhone:	{
				required:		true,
				phone:			true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianWorkPhone:	{
				//phone:			true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			parentGuardianCellPhone:	{
				//phone:			true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			ofrSubmitter:	{
				required:   	true,
				maxlength:  	50,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			ofrPhone:	{
				required:		true,
				phone:			true,
				remote:     	{url: "includes/i_OFRValidate.php", async: false}
			},
			ofrComment:	{
				required:   	true,
				minlength:		8
				//remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			ofrAmountOwed:	{
				required:   	true,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},
			ofrAmountPaid:	{
				required:   	true,
				remote: 		{url: "includes/i_OFRValidate.php", async: false}
			},

		//=======================================================================================================================================
		},
		errorPlacement: function(error, element) {
			if(element.attr("name") === "ofrTroopNum") {
				error.appendTo("#ofrTroopNumError");
			} else if(element.attr("name") === "permSU") {
					error.appendTo("#permSUError");
			} else if(element.attr("name") === "troopLeaderFName") {
				error.appendTo("#troopLeaderFNameError");
			} else if(element.attr("name") === "troopLeaderLName") {
				error.appendTo("#troopLeaderLNameError");
			} else if(element.attr("name") === "troopLeaderEmail") {
				error.appendTo("#troopLeaderEmailError");
			} else if(element.attr("name") === "troopLeaderEmail2") {
				error.appendTo("#troopLeaderEmail2Error");
			} else if(element.attr("name") === "troopLeaderAddress") {
				error.appendTo("#troopLeaderAddressError");
			} else if(element.attr("name") === "troopLeaderCity") {
				error.appendTo("#troopLeaderCityError");
			} else if(element.attr("name") === "troopLeaderZip") {
				error.appendTo("#troopLeaderZipError");
			} else if(element.attr("name") === "troopLeaderPhone") {
				error.appendTo("#troopLeaderPhoneError");
			} else if(element.attr("name") === "tcmFName") {
				error.appendTo("#tcmFNameError");
			} else if(element.attr("name") === "tcmLName") {
				error.appendTo("#tcmLNameError");
			} else if(element.attr("name") === "tcmEmail") {
				error.appendTo("#tcmEmailError");
			} else if(element.attr("name") === "tcmEmail2") {
				error.appendTo("#tcmEmail2Error");
			} else if(element.attr("name") === "tcmAddress") {
				error.appendTo("#tcmAddressError");
			} else if(element.attr("name") === "tcmCity") {
				error.appendTo("#tcmCityError");
			} else if(element.attr("name") === "tcmZip") {
				error.appendTo("#tcmZipError");
			} else if(element.attr("name") === "tcmPhone") {
				error.appendTo("#tcmPhoneError");
			} else if(element.attr("name") === "girlFName") {
				error.appendTo("#girlFNameError");
			} else if(element.attr("name") === "girlLName") {
				error.appendTo("#girlLNameError");
			} else if(element.attr("name") === "parentGuardianFName") {
				error.appendTo("#parentGuardianFNameError");
			} else if(element.attr("name") === "parentGuardianLName") {
				error.appendTo("#parentGuardianLNameError");
			} else if(element.attr("name") === "parentGuardianEmail") {
				error.appendTo("#parentGuardianEmailError");
			} else if(element.attr("name") === "parentGuardianEmail2") {
				error.appendTo("#parentGuardianEmail2Error");
			} else if(element.attr("name") === "parentGuardianAddress") {
				error.appendTo("#parentGuardianAddressError");
			} else if(element.attr("name") === "parentGuardianCity") {
				error.appendTo("#parentGuardianCityError");
			} else if(element.attr("name") === "parentGuardianZip") {
				error.appendTo("#parentGuardianZipError");
			} else if(element.attr("name") === "parentGuardianPhone") {
				error.appendTo("#parentGuardianPhoneError");
			} else if(element.attr("name") === "parentGuardianWorkPhone") {
				error.appendTo("#parentGuardianWorkPhoneError");
			} else if(element.attr("name") === "parentGuardianCellPhone") {
				error.appendTo("#parentGuardianCellPhoneError");
			} else if(element.attr("name") === "ofrSubmitter") {
				error.appendTo("#ofrSubmitterError");
			} else if(element.attr("name") === "ofrPhone") {
				error.appendTo("#ofrPhoneError");
			} else if(element.attr("name") === "ofrComment") {
				error.appendTo("#ofrCommentError");
			} else if(element.attr("name") === "ofrAmountOwed") {
				error.appendTo("#ofrAmountOwedError");
			} else if(element.attr("name") === "ofrAmountPaid") {
				error.appendTo("#ofrAmountPaidError");

//			} else if(element.attr("name") === "achRouting") {
//				error.appendTo("#achRoutingError");
//			} else if(element.attr("name") === "achRoutingConfirm") {
//				error.appendTo("#achRoutingConfirmError");
//				error.appendTo("#achAccountError");
//			} else if(element.attr("name") === "achAccountConfirm") {
//				error.appendTo("#achAccountConfirmError");
//			} else if(element.attr("name") === "achAmount") {
//				error.appendTo("#achAmountError");
////                } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
////                    $("#ccDateError").empty();
////                    error.appendTo("#ccDateError");
////                } else if(element.attr("name") === "ccCVV2") {
////                    error.appendTo("#ccCVV2Error");
			}
////======================================================================================================================
		},
		messages: {
			ofrTroopNum: {
			    required:   	"* Select your Troop number"
			},
			//permSU: {
			//	required: 		"* Select your Service Unit"
			//},
			troopLeaderFName:	{
				required:   	"* Troop Leader first name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			troopLeaderLName:	{
				required:   	"* Troop Leader last name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			troopLeaderEmail:	{
				required:   	"* An email address is required",
				emailX:     	"* Email address must be valid",
				remote:     	"* A valid email address is required"
			},
			troopLeaderEmail2:	{
				emailX:     	"* Email address must be valid",
				equalTo:    	"* Email addresses must match",
				remote:     	"* A valid email address is required"
			},
			troopLeaderAddress:	{
				required:		"* Address is required",
				remote:			"* Special characters are not allowed"
			},
			troopLeaderCity:	{
				required:		"* City name is required",
				remote:			"* Special characters are not allowed"
			},
			troopLeaderZip:		{
				required:		"* Zip code is required",
				remote:			"* Numbers only"
			},
			troopLeaderPhone:	{
				required:		"* Phone number is required",
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			tcmFName:	{
				required:   	"* TCM first name required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			tcmLName:	{
				required:   	"* TCM last name required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			tcmEmail:	{
				required:   	"* Email address is required",
				emailX:     	"* The email address must be valid",
				remote:     	"* A valid email address is required"
			},
			tcmEmail2:	{
				emailX:     	"* A valid email address required",
				equalTo:    	"* Email addresses must match",
				remote:     	"* A valid email address is required"
			},
			tcmAddress:	{
				required:		"* Address is required",
				remote:			"* Special characters are not allowed"
			},
			tcmCity:	{
				required:		"* City name is required",
				remote:			"* Special characters are not allowed"
			},
			tcmZip:		{
				required:		"* Zip code is required",
				remote:			"* Zip code is required"
			},
			tcmPhone:	{
				required:		"* Phone number is required",
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			girlFName:	{
				required:   	"* Girl's first name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			girlLName:	{
				required:   	"* Girl's last name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			parentGuardianFName:	{
				required:   	"* Parent/guardian's first name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			parentGuardianLName:	{
				required:   	"* Parent/guardian's last name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			parentGuardianEmail:	{
				required:   	"* Email address is required",
				emailX:     	"* The email address must be valid",
				remote:     	"* A valid email address is required"
			},
			parentGuardianEmail2:	{
				emailX:     	"* A valid email address required",
				equalTo:    	"* Email addresses must match",
				remote:     	"* A valid email address is required"
			},
			parentGuardianAddress:	{
				required:		"* Address is required",
				remote:			"* Special characters are not allowed"
			},
			parentGuardianCity:	{
				required:		"* City name is required",
				remote:			"* Special characters are not allowed"
			},
			parentGuardianZip:		{
				required:		"* Zip code is required",
				remote:			"* Zip code is required"
			},
			parentGuardianPhone:	{
				required:		"* Phone number is required",
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			parentGuardianWorkPhone:	{
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			parentGuardianCellPhone:	{
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			ofrSubmitter:	{
				required:   	"* Report submitter name is required",
				maxlength:  	"* Name can't be over 50 characters",
				remote: 		"* Special characters or numbers are not allowed"
			},
			ofrPhone:	{
				required:		"* Phone number is required",
				phone:     		"* A valid phone number is required",
				remote: 	    "* A valid phone number is required"
			},
			ofrComment:	{
				required:   	"* State why the bill was not paid in full",
				minlength:		"* Minimum of 8 characters required"
				//remote: 		"* State why the bill was not paid in full"
			},
			ofrAmountOwed:	{
				required:   	"* Amount owed is required",
				remote: 		"* Amount owed is required"
			},
			ofrAmountPaid:	{
				required:   	"* Amount paid is required",
				remote: 		"* Amount paid is required"
			}

			//achAccountName:	{
			//	required:   "* Account name required",
			//	maxlength:  "* No more than 21 characters",
			//	remote:     "* Special characters are not allowed"
			//},
			//achPhone:	{
			//	required:   "* Phone number required",
			//	phone:      "* Valid phone number required",
			//	remote:     "* Valid phone number required"
			//},
			//achEmail: 	{
			//},
			//achConfirmEmail: {
			//	//required:   "* Email address  required",
			//},
			//achRouting:	{
			//	required:	"* A bank routing number is required",
			//	digits:	    "* Numbers only",
			//	remote:	    "* A valid routing number is required"
			//},
			//achRoutingConfirm:	{
			//	digits:	    "* Numbers only",
			//	equalTo:	"* Routing numbers must match"
			//},
			//achAccount:	{
			//	required:	"* An account number is required",
			//	remote:	    "* An account number is required"
			//},
			//achAccountConfirm:	{
			//	equalTo:	"* Account numbers must match"
			//},
			//achAmount: {
			//	required:   "* Payment amount required",
			//	remote:     "* Payment amount required"
			//}
			//========================================================================================================================================
		},




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
	})
	$.validator.addMethod('emailX', function(value) {
		return (
			value.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/)
		);
	})
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
