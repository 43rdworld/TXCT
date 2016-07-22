$(document).ready(function () {
    $("#theForm").validate({
        groups: {
            orders: "orderS,orderM,orderL,orderXL,order2X,order3X"
        },
		rules: {

            orderS: 	{
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderM: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderXL: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            order2X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            order3X: 	    {
                require_from_group: [1, ".tshirtOrderGroup"],
                number: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderDelivery: {
                 required: true
                   //remote: {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
               orderFName: {
				 required: true,
				minlength: 2,
                   remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
			},
			   orderLName: {
				 required: true,
				minlength: 2,
                   remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
			},
             orderAddress: {
                 required: true,
                maxlength: 50,
                 remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
                orderCity: {
                 required: true,
                maxlength: 30,
                    remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderZip: {
                 required: true,
                maxlength: 5,
                   digits: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
            orderPhone: 	{
                required: true,
                phone: true,
                remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
            },
               orderEmail: {
				 required: true,
				   emailX: true,
                   remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
			},
              orderEmail2: {
				 required: true,
				   emailX: true,
				  equalTo: "#orderEmail",
                  remote:     {url: "includes/i_TShirtOrderValidate_SS.php", async: false}
			}
		},

        errorPlacement: function(error, element) {
            if(element.hasClass("tshirtOrderGroup")) {
                $("#orderError").html(error);
            } else if(element.attr("name") === "orderDelivery") {
                error.appendTo("#orderDeliveryError");
            } else if(element.attr("name") === "orderFName") {
                    error.appendTo("#orderFNameError");
            } else if(element.attr("name") === "orderLName") {
                error.appendTo("#orderLNameError");
            } else if(element.attr("name") === "orderAddress") {
                error.appendTo("#orderAddressError");
            } else if(element.attr("name") === "orderCity") {
                error.appendTo("#orderCityError");
            } else if(element.attr("name") === "orderZip") {
                error.appendTo("#orderZipError");
            } else if(element.attr("name") === "orderEmail") {
                error.appendTo("#orderEmailError");
            } else if(element.attr("name") === "orderEmail2") {
                error.appendTo("#orderEmail2Error");
            } else if(element.attr("name") === "orderPhone") {
                error.appendTo("#orderPhoneError");
            }
        },
        messages: {
            orderS:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity s"
            },
            orderM:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity m"
            },
            orderL:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            orderXL:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            order2X:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            order3X:  {
                require_from_group:   "* Enter a t-shirt quantity",
                remote:     "* Enter a t-shirt quantity"
            },
            orderDelivery: {
                 required: "* Select a option from the list"
                //remote: "* Select a option from the list"
            },
            orderFName: {
                 required: "* First Name is required",
                minlength: "* Name must at least 2 characters",
                   remote: "* No numbers or special characters"
            },
            orderLName: {
                 required: "* Last Name is required",
                minlength: "* Name must at least 2 characters",
                   remote: "* No numbers or special characters"
            },
             orderAddress: {
                 required: "* Home Address is required",
                maxlength: "* Address limited is to 50 characters",
                   remote: "* Special characters are not permitted"
            },
                orderCity: {
                 required: "* City is required",
                maxlength: "* City is limited to 30 characters",
                   remote: "* Special characters are not permitted"
            },
                 orderZip: {
                 required: "* Zip code is required",
                maxlength: "* Zip code is limited to 5 characters",
                   digits: "* Only numbers are allowed",
                   remote: "* Only numbers are allowed"
            },
               orderPhone: {
                 required: "* A phone number is required",
                    phone:	"* A valid phone number is required",
                   remote: "* A valid phone number is required"
            },
               orderEmail: {
                 required: "* An email address  is required",
                   emailX: "* A valid email address  is required",
                   remote: "* A valid email address  is required"
            },
              orderEmail2: {
                 required: "* An email address  is required",
                   emailX: "* A valid email address  is required",
                  equalTo: "* Email addresses must match",
                   remote: "* A valid email address  is required"
            }
        },

        submitHandler: function(form) {
			var loc = $('#orderDeliveryLocation').val();
            var temp = $('#orderItemized').val();
            var itemizedConverted = temp.replace(/zzz/g,"\n");
            switch (loc) {
                case 'jaf':
                    var location = 'You will be contacted when your order is ready for pickup at the JoAnn Fogg Shop. Payment will be due at that time';
                    break;
                case 'sssc':
                    var location = 'You will be contacted when your order is ready for pickup at the Southern Sector Shop. Payment will be due at that time.';
                    break;
                case 'etrc':
                    var location = 'You will be contacted when your order is ready for pickup at the East Texas Regional Center. Payment will be due at that time.';
                    break;
                case 'hv':
                    var location = 'You will be contacted when your order is ready for pickup pickup at the Highland Village Shop. Payment will be due at that time.';
                    break;
                case 'den':
                    var location = 'You will be contacted when your order is ready for pickup at the Denton Shop. Payment will be due at that time.';
                    break;
                case 'par':
                    var location = 'You will be contacted when your order is ready for pickup at the Paris Shop. Payment will be due at that time.';
                    break;
                case 'col':
                    var location = 'You will be contacted when your order is ready for pickup at the Collin Area Shop. Payment will be due at that time.';
                    break;
                case 'home':
                    var location = 'Your order will be shipped to your home for an additional $6 fee. Payment is due before the order is sent.';
                    break;
            }
            if (confirm('You are placing an order for the ' + $('#orderTotalCopy').val() + ':\n' + itemizedConverted + '\n'+ location + '.\n\nClick OK to confirm and place the order or Cancel to return to the form.'))
			{
                 //alert('valid form');
                 //return false;
            form.submit();
			}
        }


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
