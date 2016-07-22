$(document).ready(function () {
    $("#theForm").validate({
        groups: {
            orders: "orderS,orderM,orderL,orderXL,order2X,order3X"
        },
		rules: {

            cookieOrderYS: 	{
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderYM: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderYL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderAS: 	{
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderAM: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderAL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderAXL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderA2X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderA3X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderA4X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderDelivery: {
                 required: true
                   //remote: {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderFName: {
                required: true,
                minlength: 2,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
			},
			cookieOrderLName: {
                required: true,
                minlength: 2,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
			},
            cookieOrderAddress: {
                required: true,
                maxlength: 50,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderCity: {
                required: true,
                maxlength: 30,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderState: {
                required: true
            },
            cookieOrderZip: {
                required: true,
                maxlength: 5,
                digits: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderPhone: 	{
                required: true,
                phone: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieOrderEmail: {
                required: true,
                emailX: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
			},
            cookieOrderEmail2: {
                required: true,
                emailX: true,
                equalTo: "#cookieOrderEmail",
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
			},
            cookieBillingFName: {
                required: true,
                minlength: 2,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingLName: {
                required: true,
                minlength: 2,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingAddress: {
                required: true,
                maxlength: 50,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingCity: {
                required: true,
                maxlength: 30,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingState: {
                required: true
            },
            cookieBillingZip: {
                required: true,
                maxlength: 5,
                digits: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingPhone: 	{
                required: true,
                phone: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingEmail: {
                required: true,
                emailX: true,
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            cookieBillingEmail2: {
                required: true,
                emailX: true,
                equalTo: "#cookieBillingEmail",
                remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            ccNum: 	{
                required:	true,
                remote: {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            ccExpMonth: 	{required:	true},
            ccExpYear: 	{required:	true},
            ccCVV2: 	{
                required:	true,
                digits: true,
                remote: {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            }
		},

        errorPlacement: function(error, element) {
            if(element.hasClass("tshirtOrderGroup")) {
                $("#cookieOrderError").html(error);
            } else if(element.attr("name") === "cookieOrderDelivery") {
                error.appendTo("#cookieOrderDeliveryError");
            } else if(element.attr("name") === "cookieOrderFName") {
                    error.appendTo("#cookieOrderFNameError");
            } else if(element.attr("name") === "cookieOrderLName") {
                error.appendTo("#cookieOrderLNameError");
            } else if(element.attr("name") === "cookieOrderAddress") {
                error.appendTo("#cookieOrderAddressError");
            } else if(element.attr("name") === "cookieOrderCity") {
                error.appendTo("#cookieOrderCityError");
            } else if(element.attr("name") === "cookieOrderState") {
                error.appendTo("#cookieOrderStateError");
            } else if(element.attr("name") === "cookieOrderZip") {
                error.appendTo("#cookieOrderZipError");
            } else if(element.attr("name") === "cookieOrderEmail") {
                error.appendTo("#cookieOrderEmailError");
            } else if(element.attr("name") === "cookieOrderEmail2") {
                error.appendTo("#cookieOrderEmail2Error");
            } else if(element.attr("name") === "cookieOrderPhone") {
                error.appendTo("#cookieOrderPhoneError");
            } else if(element.attr("name") === "cookieBillingFName") {
                error.appendTo("#cookieBillingFNameError");
            } else if(element.attr("name") === "cookieBillingLName") {
                error.appendTo("#cookieBillingLNameError");
            } else if(element.attr("name") === "cookieBillingAddress") {
                error.appendTo("#cookieBillingAddressError");
            } else if(element.attr("name") === "cookieBillingCity") {
                error.appendTo("#cookieBillingCityError");
            } else if(element.attr("name") === "cookieBillingState") {
                error.appendTo("#cookieBillingStateError");
            } else if(element.attr("name") === "cookieBillingZip") {
                error.appendTo("#cookieBillingZipError");
            } else if(element.attr("name") === "cookieBillingEmail") {
                error.appendTo("#cookieBillingEmailError");
            } else if(element.attr("name") === "cookieBillingEmail2") {
                error.appendTo("#cookieBillingEmail2Error");
            } else if(element.attr("name") === "cookieBillingPhone") {
                error.appendTo("#cookieBillingPhoneError");
            } else if(element.attr("name") === "ccNum") {
                error.appendTo("#ccNumError");
            } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
                $("#ccDateError").empty();
                error.appendTo("#ccDateError");
            } else if(element.attr("name") === "ccCVV2") {
                error.appendTo("#ccCVV2Error");
            }
        },
        messages: {
            cookieOrderYS:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderYM:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderYL:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderAS:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderAM:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderAL:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderAXL:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderA2X:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderA3X:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderA4X:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            cookieOrderDelivery: {
                 required: "* Select a delivery option"
                //remote: "* Select a option from the list"
            },
            cookieOrderFName: {
                 required: "* First name is required",
                minlength: "* Name must at least 2 characters",
                   remote: "* No numbers or special characters"
            },
            cookieOrderLName: {
                 required: "* Last name is required",
                minlength: "* Name must at least 2 characters",
                   remote: "* No numbers or special characters"
            },
             cookieOrderAddress: {
                 required: "* Home address is required",
                maxlength: "* Address limited is to 50 characters",
                   remote: "* Special characters are not permitted"
            },
                cookieOrderCity: {
                 required: "* City is required",
                maxlength: "* City is limited to 30 characters",
                   remote: "* Special characters are not permitted"
            },
            cookieOrderState: {
                required: "* State is required"
            },
                 cookieOrderZip: {
                 required: "* Zip code is required",
                maxlength: "* Zip code is limited to 5 characters",
                   digits: "* Only numbers are allowed",
                   remote: "* Only numbers are allowed"
            },
               cookieOrderPhone: {
                 required: "* A phone number is required",
                    phone:	"* A valid phone number is required",
                   remote: "* A valid phone number is required"
            },
               cookieOrderEmail: {
                 required: "* An email address  is required",
                   emailX: "* A valid email address  is required",
                   remote: "* A valid email address  is required"
            },
              cookieOrderEmail2: {
                 required: "* An email address  is required",
                   emailX: "* A valid email address  is required",
                  equalTo: "* Email addresses must match",
                   remote: "* A valid email address  is requiredx"
            },
            cookieBillingFName: {
                required: "* First name is required",
                minlength: "* Name must at least 2 characters",
                remote: "* No numbers or special characters"
            },
            cookieBillingLName: {
                required: "* Last name is required",
                minlength: "* Name must at least 2 characters",
                remote: "* No numbers or special characters"
            },
            cookieBillingAddress: {
                required: "* Home address is required",
                maxlength: "* Address limited is to 50 characters",
                remote: "* Special characters are not permitted"
            },
            cookieBillingCity: {
                required: "* City is required",
                maxlength: "* City is limited to 30 characters",
                remote: "* Special characters are not permitted"
            },
            cookieBillingState: {
                required: "* State is required"
            },
            cookieBillingZip: {
                required: "* Zip code is required",
                maxlength: "* Zip code is limited to 5 characters",
                digits: "* Only numbers are allowed",
                remote: "* Only numbers are allowed"
            },
            cookieBillingPhone: {
                required: "* A phone number is required",
                phone:	"* A valid phone number is required",
                remote: "* A valid phone number is required"
            },
            cookieBillingEmail: {
                required: "* An email address  is required",
                emailX: "* A valid email address  is required",
                remote: "* A valid email address  is required"
            },
            cookieBillingEmail2: {
                required: "* An email address  is required",
                emailX: "* A valid email address  is required",
                equalTo: "* Email addresses must match",
                remote: "* A valid email address  is required"
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
        },

        // submitHandler: function(form) {
			// var loc = $('#orderDeliveryLocation').val();
        //     var temp = $('#orderItemized').val();
        //     var itemizedConverted = temp.replace(/<br>/g,"\n");
        //     switch (loc) {
        //         case 'gwl':
        //             var location = 'You will be contacted when your order is ready for pickup at the JoAnn Fogg Shop. Payment will be due at that time';
        //             break;
        //         case 'camp':
        //             var location = 'You will be contacted when your order is ready for pickup at the Southern Sector Shop. Payment will be due at that time.';
        //             break;
        //     }
        //     if (confirm('You are placing an order for the ' + $('#orderTotalCopy').val() + ':\n' + itemizedConverted + '\n'+ location + '.\n\nClick OK to confirm and place the order or Cancel to return to the form.'))
			// {
        //          //alert('valid form');
        //          //return false;
        //     form.submit();
			// }
        // }


    });
    $.validator.addMethod('emailX', function(value) {
        return (
            value.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/)
        );
    })
    $.validator.addMethod('phone', function(value) {
        return (
            value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
        );
    })
});
