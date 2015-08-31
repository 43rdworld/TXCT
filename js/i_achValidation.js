$(document).ready(function () {
	$("#theForm").validate({

		rules: {
			troopSU:	{required:true},
		   troopNum:	{required:true},
		accountType:	{required:true},
		accountName:	{required:true},
	   accountEmail: 	{
						 required:true,
							email:true
						},
	  accountEmail2: 	{ 
							   email:true,
							 equalTo:'#accountEmail'
						 },
	   accountPhone:	{
						 required:true,
						 maskedPhone:true
						},
	 accountRouting:	{
						 required:true,
						 digits: true,
						 remote: {
								  url:	"getRoutingNumberStatusNew.php",
								  type:	"post",
								  data:	{
										 id: function() {
														 return $('#theForm :input[name="accountRouting"]').val();
														}
										}									
								}
						},
	accountRouting2:	{
						   digits: true,
						  equalTo: '#accountRouting'
						},
		 accountNum:	{required: true},
		accountNum2:	{ equalTo: '#accountNum'},
	 accountDeposit: 	{
						 required: true,
						   number: true,
						},
//======================================================================================================================
		},

		errorPlacement: function(error, element) {
			if(element.attr("name") === "troopSU") {
				error.appendTo("#troopSUError");
			} else if(element.attr("name") === "troopNum") {
				error.appendTo("#troopNumError");
			} else if(element.attr("name") === "accountType") {
				error.appendTo("#accountTypeError");
			} else if(element.attr("name") === "accountName") {
				error.appendTo("#accountNameError");
			} else if(element.attr("name") === "accountEmail") {
				error.appendTo("#accountEmailError");
			} else if(element.attr("name") === "accountEmail2") {
				error.appendTo("#accountEmail2Error");
			} else if(element.attr("name") === "accountPhone") {
				error.appendTo("#accountPhoneError");
			} else if(element.attr("name") === "accountRouting") {
				$("#accountRoutingError").empty();
				error.appendTo("#accountRoutingError");
			} else if(element.attr("name") === "accountRouting2") {
				error.appendTo("#accountRouting2Error");
			} else if(element.attr("name") === "accountNum") {
				error.appendTo("#accountNumError");
			} else if(element.attr("name") === "accountNum2") {
				error.appendTo("#accountNum2Error");
			} else if(element.attr("name") === "accountDeposit") {
				error.appendTo("#accountDepositError");
			}
//======================================================================================================================
	    },
		messages: {
			  troopSU:	"* Service Unit is required",
			 troopNum:	"* Troop number is required",
		  accountType:	"* Choose the account type",
		  accountName:	"* Enter the name on the account",
		 accountEmail:	{
						 required:	"* An email address is required",
							email:	"* A valid email address is required"
						},
		accountEmail2: {
							email: "* A valid email address is required",
						  equalTo: "* Email addresses must match"
						},
		 accountPhone:	"* Phone number is required",
	   accountRouting:	{
						 required:	"* A bank routing number is required",
						   digits:	"* Numbers only",
						   remote:	"* A valid routing number is required"
						
						},
	  accountRouting2:	{
						   digits:	"* Numbers only",
						  equalTo:	"* Routing numbers must match"
						},
		  accountNum:	{required:	"* An account number is required"},
		  accountNum2:	{ equalTo:	"* Account numbers must match"},
  	   accountDeposit:	{
		   				 required: 	"* A deposit amount is required",
						   number:	"* Numbers, commas or decimals only"
		   
	   					},

//======================================================================================================================
		},
    submitHandler: function(form) {
        if (confirm('You are about to submit a payment of $' +document.getElementById('accountDepositTemp').value+ '.\n\nClick OK to confirm or Cancel to return to the form.')) {
            form.submit();
        }
    }
	});

	$.validator.addMethod('phone', function(value) {
	  return (
		value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
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
