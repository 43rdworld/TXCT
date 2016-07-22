$(document).ready(function () {
    $("#theForm").validate({
        groups: {
            orders: "orderS,orderM,orderL,orderXL,order2X,order3X"
        },
		rules: {
            serviceUnit:    {
              required: true
            },
            orderS: 	{
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            orderM: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            orderL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            orderXL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            order2X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            order3X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            order4X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            orderDelivery: {
                 required: true
                   //remote: {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderFName: {
                required: true,
                minlength: 2
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            orderLName: {
                required: true,
                minlength: 2
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            // orderAddress: {
            //     required: true,
            //     maxlength: 50,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // orderCity: {
            //     required: true,
            //     maxlength: 30,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // orderState: {
            //     required: true
            // },
            // orderZip: {
            //     required: true,
            //     maxlength: 5,
            //     digits: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // orderPhone: 	{
            //     required: true,
            //     phone: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // orderEmail: {
            //     required: true,
            //     emailX: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // orderEmail2: {
            //     required: true,
            //     emailX: true,
            //     equalTo: "#orderEmail",
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            billingFName: {
                required: true,
                minlength: 2
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            billingLName: {
                required: true,
                minlength: 2
                // remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            },
            // cookieBillingAddress: {
            //     required: true,
            //     maxlength: 50,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // cookieBillingCity: {
            //     required: true,
            //     maxlength: 30,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // cookieBillingState: {
            //     required: true
            // },
            // cookieBillingZip: {
            //     required: true,
            //     maxlength: 5,
            //     digits: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // cookieBillingPhone: 	{
            //     required: true,
            //     phone: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // cookieBillingEmail: {
            //     required: true,
            //     emailX: true,
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // cookieBillingEmail2: {
            //     required: true,
            //     emailX: true,
            //     equalTo: "#cookieBillingEmail",
            //     remote:     {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // ccNum: 	{
            //     required:	true,
            //     remote: {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // },
            // ccExpMonth: 	{required:	true},
            // ccExpYear: 	{required:	true},
            // ccCVV2: 	{
            //     required:	true,
            //     digits: true,
            //     remote: {url: "includes/i_CookieShirtOrderValidate_SS.php", async: false}
            // }
		},

        errorPlacement: function(error, element) {
            if (element.attr("name") === "serviceUnit") {
                $("#orderServiceUnitError").html(error);
            } else if(element.hasClass("tshirtOrderGroup")) {
                $("#orderError").html(error);
            } else if(element.attr("name") === "orderDelivery") {
                error.appendTo("#orderDeliveryError");
            } else if(element.attr("name") === "orderFName") {
                    error.appendTo("#orderFNameError");
            } else if(element.attr("name") === "orderLName") {
                error.appendTo("#orderLNameError");
            // } else if(element.attr("name") === "orderrderAddress") {
            //     error.appendTo("#orderrderAddressError");
            // } else if(element.attr("name") === "orderrderCity") {
            //     error.appendTo("#orderrderCityError");
            // } else if(element.attr("name") === "orderrderState") {
            //     error.appendTo("#orderrderStateError");
            // } else if(element.attr("name") === "orderrderZip") {
            //     error.appendTo("#orderrderZipError");
            // } else if(element.attr("name") === "orderrderEmail") {
            //     error.appendTo("#orderrderEmailError");
            // } else if(element.attr("name") === "orderrderEmail2") {
            //     error.appendTo("#orderrderEmail2Error");
            // } else if(element.attr("name") === "orderrderPhone") {
            //     error.appendTo("#orderrderPhoneError");
            } else if(element.attr("name") === "billingFName") {
                error.appendTo("#billingFNameError");
            } else if(element.attr("name") === "billingLName") {
                error.appendTo("#billingLNameError");
            // } else if(element.attr("name") === "cookieBillingAddress") {
            //     error.appendTo("#cookieBillingAddressError");
            // } else if(element.attr("name") === "cookieBillingCity") {
            //     error.appendTo("#cookieBillingCityError");
            // } else if(element.attr("name") === "cookieBillingState") {
            //     error.appendTo("#cookieBillingStateError");
            // } else if(element.attr("name") === "cookieBillingZip") {
            //     error.appendTo("#cookieBillingZipError");
            // } else if(element.attr("name") === "cookieBillingEmail") {
            //     error.appendTo("#cookieBillingEmailError");
            // } else if(element.attr("name") === "cookieBillingEmail2") {
            //     error.appendTo("#cookieBillingEmail2Error");
            // } else if(element.attr("name") === "cookieBillingPhone") {
            //     error.appendTo("#cookieBillingPhoneError");
            // } else if(element.attr("name") === "ccNum") {
            //     error.appendTo("#ccNumError");
            // } else if((element.attr("name") === "ccExpMonth") || (element.attr("name") === "ccExpYear")) {
            //     $("#ccDateError").empty();
            //     error.appendTo("#ccDateError");
            // } else if(element.attr("name") === "ccCVV2") {
            //     error.appendTo("#ccCVV2Error");
            }
        },
        messages: {
            serviceUnit:	{
                required: "* Select your service unit"
            },
             orderS:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            orderM:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            orderL:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            orderXL:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            order2X:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            order3X:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            order4X:  {
                require_from_group:   "* Enter a t-shirt quantity"
                // remote:     "* Enter a t-shirt quantity"
            },
            orderDelivery: {
                 required: "* Select a delivery option"
                //remote: "* Select a option from the list"
            },
            orderFName: {
                 required: "* First name is required",
                minlength: "* Name must at least 2 characters"
                   // remote: "* No numbers or special characters"
            },
            orderLName: {
                 required: "* Last name is required",
                minlength: "* Name must at least 2 characters"
                   // remote: "* No numbers or special characters"
            },
             // orderAddress: {
            //      required: "* Home address is required",
            //     maxlength: "* Address limited is to 50 characters",
            //        remote: "* Special characters are not permitted"
            // },
            //     orderCity: {
            //      required: "* City is required",
            //     maxlength: "* City is limited to 30 characters",
            //        remote: "* Special characters are not permitted"
            // },
            // orderState: {
            //     required: "* State is required"
            // },
            //      orderZip: {
            //      required: "* Zip code is required",
            //     maxlength: "* Zip code is limited to 5 characters",
            //        digits: "* Only numbers are allowed",
            //        remote: "* Only numbers are allowed"
            // },
            //    orderPhone: {
            //      required: "* A phone number is required",
            //         phone:	"* A valid phone number is required",
            //        remote: "* A valid phone number is required"
            // },
            //    orderEmail: {
            //      required: "* An email address  is required",
            //        emailX: "* A valid email address  is required",
            //        remote: "* A valid email address  is required"
            // },
            //   orderEmail2: {
            //      required: "* An email address  is required",
            //        emailX: "* A valid email address  is required",
            //       equalTo: "* Email addresses must match",
            //        remote: "* A valid email address  is requiredx"
            // },
            billingFName: {
                required: "* First name is required",
                minlength: "* Name must at least 2 characters"
                // remote: "* No numbers or special characters"
            },
            billingLName: {
                required: "* Last name is required",
                minlength: "* Name must at least 2 characters"
                // remote: "* No numbers or special characters"
            },
            // cookieBillingAddress: {
            //     required: "* Home address is required",
            //     maxlength: "* Address limited is to 50 characters",
            //     remote: "* Special characters are not permitted"
            // },
            // cookieBillingCity: {
            //     required: "* City is required",
            //     maxlength: "* City is limited to 30 characters",
            //     remote: "* Special characters are not permitted"
            // },
            // cookieBillingState: {
            //     required: "* State is required"
            // },
            // cookieBillingZip: {
            //     required: "* Zip code is required",
            //     maxlength: "* Zip code is limited to 5 characters",
            //     digits: "* Only numbers are allowed",
            //     remote: "* Only numbers are allowed"
            // },
            // cookieBillingPhone: {
            //     required: "* A phone number is required",
            //     phone:	"* A valid phone number is required",
            //     remote: "* A valid phone number is required"
            // },
            // cookieBillingEmail: {
            //     required: "* An email address  is required",
            //     emailX: "* A valid email address  is required",
            //     remote: "* A valid email address  is required"
            // },
            // cookieBillingEmail2: {
            //     required: "* An email address  is required",
            //     emailX: "* A valid email address  is required",
            //     equalTo: "* Email addresses must match",
            //     remote: "* A valid email address  is required"
            // },
            // ccNum:	{
            //     required: "* Credit card number is required",
            //     remote: "* A valid credit card number is required"
            // },
            // ccExpMonth:	{
            //     required: "* Card expiration date is required"
            //     //remote: "* Card expireation month is requiredx"
            // },
            // ccExpYear:  	{
            //     required: "* Card expiration date is required"
            //     //remote: "* Card expiration year is requiredx"
            // },
            // ccCVV2:	{
            //     required: "* Card security code is required",
            //     digits: "* Only numbers are allowed",
            //     remote: "* Only numbers are allowed"
            // }
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
