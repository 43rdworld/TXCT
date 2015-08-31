$(document).ready(function () {
    $("#theForm").validate({
            rules: {
                    volFName: {
                    required: true,
                   minlength: 2,
                      remote: {url: "i_tcmApplicationValidate.php", async: false}
                },
                    volLName: {
                    required: true,
                   minlength: 2,
                      remote: {url: "i_tcmApplicationValidate.php", async: false}
                },
                    volEmail: {
                    required: true,
                       email: true,
                      remote: {url: "i_tcmApplicationValidate.php", async: false}
                },
                   volEmail2: {
                    required: true,
                       email: true,
                     equalTo: "#volEmail",
                      remote: {url: "i_tcmApplicationValidate.php", async: false}
                },
                   volIDType:   {
                    required: true
               },
               volID: {
                    required: true,
                   minlength: 2
//                      remote: {url: "i_tcmApplicationValidate.php", async: false}
               },
               //  volTroopNum: {
               //     required: true,
               //    minlength: 3,
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               //},
               //        volSU: {
               //     required: true,
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               //},
               //         txt1: {
               //     required: true,
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt2: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //
               //         txt3: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt4: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt5: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt6: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt7: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt8: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //         txt9: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //        txt10: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //        txt11: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //        txt12: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //        txt13: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //        txt14: {
               //     required: true,
               //      equalTo: "#txt1",
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // },
               //volSignedName: {
               //     required: true,
               //    minlength: 2,
               //       remote: {url: "i_tcmApplicationValidate.php", async: false}
               // }
        },

        errorPlacement: function(error, element) {
            if(element.attr("name") === "volFName") {
                error.appendTo("#volFNameError");
            } else if(element.attr("name") === "volLName") {
                error.appendTo("#volLNameError");
            } else if(element.attr("name") === "volEmail") {
                error.appendTo("#volEmailError");
            } else if(element.attr("name") === "volEmail2") {
                error.appendTo("#volEmail2Error");
            } else if(element.attr("name") === "volIDType") {
                error.appendTo("#volIDTypeError");
            } else if(element.attr("name") === "volID") {
                error.appendTo("#volIDError");
            //} else if(element.attr("name") === "volTroopNum") {
            //    error.appendTo("#volTroopNumError");
            //} else if(element.attr("name") === "volSU") {
            //    error.appendTo("#volSUError");
            //} else if(element.attr("name") === "txt1") {
            //    error.appendTo("#txt1Error");
            //} else if(element.attr("name") === "txt2") {
            //    error.appendTo("#txt2Error");
            //} else if(element.attr("name") === "txt3") {
            //    error.appendTo("#txt3Error");
            //} else if(element.attr("name") === "txt4") {
            //    error.appendTo("#txt4Error");
            //} else if(element.attr("name") === "txt5") {
            //    error.appendTo("#txt5Error");
            //} else if(element.attr("name") === "txt6") {
            //    error.appendTo("#txt6Error");
            //} else if(element.attr("name") === "txt7") {
            //    error.appendTo("#txt7Error");
            //} else if(element.attr("name") === "txt8") {
            //    error.appendTo("#txt8Error");
            //} else if(element.attr("name") === "txt9") {
            //    error.appendTo("#txt9Error");
            //} else if(element.attr("name") === "txt10") {
            //    error.appendTo("#txt10Error");
            //} else if(element.attr("name") === "txt11") {
            //    error.appendTo("#txt11Error");
            //} else if(element.attr("name") === "txt12") {
            //    error.appendTo("#txt12Error");
            //} else if(element.attr("name") === "txt13") {
            //    error.appendTo("#txt13Error");
            //} else if(element.attr("name") === "txt14") {
            //    error.appendTo("#txt14Error");
            //} else if(element.attr("name") === "volSignedName") {
            //    error.appendTo("#volSignedNameError");
            }


        },
            messages: {
                    volFName: {
                    required: "* First Name is required",
                   minlength: "* Name must at least 2 characters",
                      remote: "* No numbers or special characters"
            },
                    volLName: {
                    required: "* Last Name is required",
                   minlength: "* Name must at least 2 characters",
                      remote: "* No numbers or special characters"
            },
                    volEmail: {
                    required: "* An email address  is required",
                       email: "* A valid email address  is required",
                      remote: "* A valid email address  is required"
            },
                   volEmail2: {
                    required: "* An email address  is required",
                       email: "* A valid email address  is required",
                     equalTo: "* Email addresses must match",
                      remote: "* A valid email address  is required"
            },
                   volIDType: {
                    required: "* An ID number is required"
            },
                       volID: {
                    required: "* An ID number is required",
                   minlength: "* Name must at least 2 characters"
//                      remote: "* A valid ID number is required"
            },
            //     volTroopNum: {
            //        required: "* Troop number is required",
            //       minlength: "* Troop # must be at least 3 characters",
            //          remote: "* Troop # must be at least 3 characters"
            //},
            //           volSU: {
            //        required: "* Service Unit is required"
            //          //remote: "* Service Unit is Required"
            //},
            //            txt1: {
            //        required: "* Please enter your initialszz",
            //          remote: "* Please enter your initialsxx"
            //},
            //            txt2: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //},
            //            txt3: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //},
            //            txt4: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //},
            //            txt5: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //},
            //
            //            txt6: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //            txt7: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //            txt8: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //            txt9: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //           txt10: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //           txt11: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //           txt12: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //           txt13: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //           txt14: {
            //        required: "* Please enter your initials",
            //         equalTo: "* Initials must match",
            //          remote: "* Please enter your initials"
            //    },
            //   volSignedName:   {
            //        required:    "* 'Signature' is required",
            //          remote:    "* Special characters are not permitted"
            //}
        },

        submitHandler: function(form) {
			if (confirm('By submitting this form, you acknowledge and agree to the terms and conditions set forth in the form.\n\nClick OK to confirm or Cancel to return to the form.')) {
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
