$(document).ready(function () {
    $("#theForm").validate({
            rules: {
                permGirlFName: {
                    required: true,
                    minlength: 2,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permGirlLName: {
                    required: true,
                    minlength: 2,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permGSTroop: {
                    required: true,
                    minlength: 3,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permSU: {
                    required: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permPackages: {
                    required: true,
                    digits: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permMyEmail: {
                    required: true,
                    email: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permLeadEmail: {
                    required: true,
                    email: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permTCMEmail: {
                    required: true,
                    email: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                perm1: {
                    required: true,
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                perm2: {
                    required: true,
                    equalTo: '#perm1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                perm3: {
                    required: true,
                    equalTo: '#perm1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                perm4: {
                    required: true,
                    equalTo: '#perm1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                perm5: {
                    required: true,
                    equalTo: '#perm1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permCClub: {
                    required: true
//                      remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permCC1: {
                    required: true,
                    equalTo: '#permCC1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permCC2: {
                    required: true,
                    equalTo: '#permCC1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permCC3: {
                    required: true,
                    equalTo: '#permCC1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permCC4: {
                    required: true,
                    equalTo: '#permCC1',
                    remote: {url: "i_parentPermissionValidate.php", async: false}
                },
              permParentFName: {
                     required: true,
                    minlength: 2,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
              permParentLName: {
                     required: true,
                    minlength: 2,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                   permIDType:   {
                     required: true
                },
                       permID: {
                     required: true,
                    minlength: 2,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
              permHomeAddress: {
                     required: true,
                    maxlength: 50,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                     permCity: {
                     required: true,
                    maxlength: 30,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                      permZip: {
                     required: true,
                    maxlength: 5,
                       digits: true,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permHomePhone: 	{
                     required: true,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                },
                permGradLevel: 	{
                     required: true
                },
               permSignedName: {
                     required: true,
                    minlength: 2,
                       remote: {url: "i_parentPermissionValidate.php", async: false}
                }
        },

        errorPlacement: function(error, element) {
            if(element.attr("name") === "permGirlFName") {
                error.appendTo("#permGirlFNameError");
            } else if(element.attr("name") === "permGirlLName") {
                error.appendTo("#permGirlLNameError");
            } else if(element.attr("name") === "permGSTroop") {
                error.appendTo("#permGSTroopError");
            } else if(element.attr("name") === "permSU") {
                error.appendTo("#permSUError");
            } else if(element.attr("name") === "permPackages") {
                error.appendTo("#permPackagesError");
            } else if(element.attr("name") === "permMyEmail") {
                error.appendTo("#permMyEmailError");
            } else if(element.attr("name") === "permLeadEmail") {
                error.appendTo("#permLeadEmailError");
            } else if(element.attr("name") === "permTCMEmail") {
                error.appendTo("#permTCMEmailError");
            } else if(element.attr("name") === "perm1") {
                error.appendTo("#perm1Error");
            } else if(element.attr("name") === "perm2") {
                error.appendTo("#perm2Error");
            } else if(element.attr("name") === "perm3") {
                error.appendTo("#perm3Error");
            } else if(element.attr("name") === "perm4") {
                error.appendTo("#perm4Error");
            } else if(element.attr("name") === "perm5") {
                error.appendTo("#perm5Error");
            } else if(element.attr("name") === "permCClub") {
                error.appendTo("#permCClubError");
            } else if(element.attr("name") === "permCC1") {
                error.appendTo("#permCC1Error");
            } else if(element.attr("name") === "permCC2") {
                error.appendTo("#permCC2Error");
            } else if(element.attr("name") === "permCC3") {
                error.appendTo("#permCC3Error");
            } else if(element.attr("name") === "permCC4") {
                error.appendTo("#permCC4Error");
            } else if(element.attr("name") === "permParentFName") {
                error.appendTo("#permParentFNameError");
            } else if(element.attr("name") === "permParentLName") {
                error.appendTo("#permParentLNameError");
            } else if(element.attr("name") === "permIDType") {
                error.appendTo("#permIDTypeError");
            } else if(element.attr("name") === "permID") {
                error.appendTo("#permIDError");
            } else if(element.attr("name") === "permHomeAddress") {
                error.appendTo("#permHomeAddressError");
            } else if(element.attr("name") === "permCity") {
                error.appendTo("#permCityError");
            } else if(element.attr("name") === "permZip") {
                error.appendTo("#permZipError");
            } else if(element.attr("name") === "permHomePhone") {
                error.appendTo("#permHomePhoneError");
            } else if(element.attr("name") === "permCellPhone") {
                error.appendTo("#permCellPhoneError");
            } else if(element.attr("name") === "permGradLevel") {
                error.appendTo("#permGradLevelError");
            } else if(element.attr("name") === "permSignedName") {
                error.appendTo("#permSignedNameError");


            }


        },
            messages: {
                permGirlFName: {
                    required: "* First Name is required",
                    minlength: "* Name must at least 2 characters",
                    remote: "* No numbers or special characters"
            },
                permGirlLName: {
                    required: "* Last Name is required",
                    minlength: "* Name must at least 2 characters",
                    remote: "* No numbers or special characters"
            },
                permGSTroop: {
                    required: "* Troop number is required",
                    minlength: "* Troop # must be at least 3 characters",
                    remote: "* Troop # must be at least 3 characters"
            },
                permSU: {
                    required: "* Service Unit is required",
                    remote: "* Service Unit is Required"
            },
                permPackages: {
                    required: "* Number of packages is required",
                    digits: "* Numbers only",
                    remote: "* Number of packages is required"
            },
                permMyEmail: {
                    required: "* An email address  is required",
                    email: "* A valid email address  is required",
                    remote: "* A valid email address  is required"
            },
                permLeadEmail: {
                    required: "* An email address  is required",
                    email: "* A valid email address  is required",
                    remote: "* A valid email address  is required"
            },
                permTCMEmail: {
                    required: "* An email address is required",
                    email: "* A valid email address  is required",
                    remote: "* A valid email address  is required"
            },
                perm1: {
                    required: "* Please enter your initials",
                    remote: "* Please enter your initials"
            },
                perm2: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                perm3: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                perm4: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                perm5: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                permCClub: {
                    required: "* Select a Cookie Club option"
//                    remote:    "* Select a Cookie Club option"
            },
                permCC1: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                permCC2: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                permCC3: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                permCC4: {
                    required: "* Please enter your initials",
                    equalTo: "* Initials must match",
                    remote: "* Please enter your initials"
            },
                permParentFName: {
                    required: "* First Name is required",
                    minlength: "* Name must at least 2 characters",
                    remote: "* No numbers or special characters"
            },
                permParentLName: {
                    required: "* Last Name is required",
                    minlength: "* Name must at least 2 characters",
                    remote: "* No numbers or special characters"
            },
                permIDType: {
                    required: "* An ID number is required"
            },
                permID: {
                    required: "* An ID number is required",
                    minlength: "* Name must at least 2 characters",
                    remote: "* A valid ID number is required"
            },
                permHomeAddress: {
                    required: "* Home Address is required",
                    maxlength: "* Address limited is to 50 characters",
                    remote: "* Special characters are not permitted"
            },
                permCity: {
                    required: "* City is required",
                    maxlength: "* City is limited to 30 characters",
                    remote: "* Special characters are not permitted"
            },
                permZip: {
                    required: "* Zip code is required",
                    maxlength: "* Zip code is limited to 5 characters",
                    digits: "* Only numbers are allowed",
                    remote: "* Only numbers are allowed"
            },
                permHomePhone: {
                    required: "* Home phone is required",
                    remote: "* A valid phone number is required"
            },
                permGradLevel:  {
                    required:   "* Select a grade level"
            },
              permSignedName:   {
                    required:    "* 'Signature' is required",
                      remote:    "* Special characters are not permitted"
            }
        },

        submitHandler: function(form) {
			if (confirm('By submitting this form, you agree that you acknowledge and agree to the terms and conditions set forth in the form.\n\nClick OK to confirm or Cancel to return to the form.')) {
//				return false;
            form.submit();
			}
        }


    });

    $.validator.addMethod('phone', function(value) {
        return (
            value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
        );
    })
});
