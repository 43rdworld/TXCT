    $(document).ready(function () {
        $("#theForm").validate({
            //debug: true,
            //focusCleanup: true,
            //focusInvalid: false,
            errorElement: "div",
            errorPlacement: function(error, element) {
                offset = element.offset();
                error.addClass('message');  // add a class to the wrapper
                error.css('position', 'absolute');
                error.css('left', offset.left + element.outerWidth());
                error.hide().insertBefore(element)
            },
                // //onfocusin: function( element, event ) {
                // //    this.lastActive = element;
                // //
                // //    // hide error label and remove error class on focus if enabled
                // //    if ( this.settings.focusCleanup && !this.blockFocusCleanup ) {
                // //        if ( this.settings.unhighlight ) {
                // //            this.settings.unhighlight.call( this, element, this.settings.errorClass, this.settings.validClass );
                // //        }
                // //        this.addWrapper(this.errorsFor(element)).fadeOut();
                // //    }
                // //},
                showErrors: function() {
                    var i, elements;
                    for ( i = 0; this.errorList[i]; i++ ) {
                        var error = this.errorList[i];
                        if ( this.settings.highlight ) {
                            this.settings.highlight.call( this, error.element, this.settings.errorClass, this.settings.validClass );
                        }
                        this.showLabel( error.element, error.message );
                    }
                    if ( this.errorList.length ) {
                        this.toShow = this.toShow.add( this.containers );
                    }
                    if ( this.settings.success ) {
                        for ( i = 0; this.successList[i]; i++ ) {
                            this.showLabel( this.successList[i] );
                        }
                    }
                    if ( this.settings.unhighlight ) {
                        for ( i = 0, elements = this.validElements(); elements[i]; i++ ) {
                            this.settings.unhighlight.call( this, elements[i], this.settings.errorClass, this.settings.validClass );
                        }
                    }
                    this.toHide = this.toHide.not( this.toShow );
                    this.hideErrors();
                    this.addWrapper( this.toShow ).fadeIn();
                },




                rules: {
                    // agreeToConditions: {
                    //     required: true
                    // },

                    troopLeaderFName: {
                        required: true,
                            minlength: 2
                    },
                    // troopLeaderLName:	{
                    //     required:true,
                    //     minlength: 2,
                    //     maxlength: 25
                    // },
                },
    //======================================================================================================================
    // 		errorPlacement: function(error, element) {
    //            errorContainer: $("#theForm div.errorBlock");
    // 			if(element.attr("name") === "troopLeaderFName") {
    // 				error.appendTo("#troopLeaderFNameError");
    // 			// } else if(element.attr("name") === "lName") {
    // 			// 	error.appendTo("#errorBlock");
    // 			}
    // 	    },
    //======================================================================================================================
                messages: {
                    // agreeToConditions:	{
                    //     required:	"Please indicate your agreement with our terms and conditions."
                    // },
                    troopLeaderFName:	{
                        required:	    "The Troop Leaders' First Name is required",
                            minlength:      "A minimum of 2 characters is required"
                    },
                    // troopLeaderLName:	{
                    //   required:     "The Troop Leaders' Last name is required",
                    //       minlength:    "A minimum of 2 characters is required",
                    //  maxlength:     "First name is limited to 25 characters"
                    // },
                    // photoUploadFName:	{
                    //     required:	    "The Troop Leaders' First Name is required",
                    //     minlength:      "A minimum of 2 characters is required"
                    // },

    //======================================================================================================================
                },
                highlight: function(element) {
                    $(element).prev('label').addClass("error");
                    $(element).addClass("error");
                },
                unhighlight: function(element) {
                    $(element).prev('label').removeClass("error");
                    $(element).addClass("valid");
                },


                submitHandler: function(form) {
    //			if (confirm('You are about to submit a payment of $' +document.getElementById('accountDepositTemp').value+ '.\n\nClick OK to confirm or Cancel to return to the form.')) {
                    form.submit();
    //			}
                },
    //
    //        submitHandler: function() {
    //            alert('valid form');
    //            return false;
    //		},

                errorContainer: $('#errorContainer'),
                    errorLabelContainer: $('#errorContainer ul'),
                    wrapper: 'li',
            });


        $("#theFileForm").validate({


            errorElement: "div",
            errorPlacement: function(error, element) {
                offset = element.offset();
                error.addClass('message');  // add a class to the wrapper
                error.css('position', 'absolute');
                error.css('left', offset.left + element.outerWidth());
                error.hide().insertBefore(element)
            },
            // //onfocusin: function( element, event ) {
            // //    this.lastActive = element;
            // //
            // //    // hide error label and remove error class on focus if enabled
            // //    if ( this.settings.focusCleanup && !this.blockFocusCleanup ) {
            // //        if ( this.settings.unhighlight ) {
            // //            this.settings.unhighlight.call( this, element, this.settings.errorClass, this.settings.validClass );
            // //        }
            // //        this.addWrapper(this.errorsFor(element)).fadeOut();
            // //    }
            // //},
            showErrors: function() {
                var i, elements;
                for ( i = 0; this.errorList[i]; i++ ) {
                    var error = this.errorList[i];
                    if ( this.settings.highlight ) {
                        this.settings.highlight.call( this, error.element, this.settings.errorClass, this.settings.validClass );
                    }
                    this.showLabel( error.element, error.message );
                }
                if ( this.errorList.length ) {
                    this.toShow = this.toShow.add( this.containers );
                }
                if ( this.settings.success ) {
                    for ( i = 0; this.successList[i]; i++ ) {
                        this.showLabel( this.successList[i] );
                    }
                }
                if ( this.settings.unhighlight ) {
                    for ( i = 0, elements = this.validElements(); elements[i]; i++ ) {
                        this.settings.unhighlight.call( this, elements[i], this.settings.errorClass, this.settings.validClass );
                    }
                }
                this.toHide = this.toHide.not( this.toShow );
                this.hideErrors();
                this.addWrapper( this.toShow ).fadeIn();
            },

            
            
            
            rules: {
                photoUploadPhone: {
                    required: true,
                    minlength: 2
                },
            },
            // errorPlacement: function(error, element) {
            //     errorContainer: $("#theForm div.errorBlock");
            //     if(element.attr("name") === "photoUploadPhone") {
            //         error.appendTo("#photoUploadPhoneError");
            //         // } else if(element.attr("name") === "lName") {
            //         // 	error.appendTo("#errorBlock");
            //     }
            // },
            messages: {
                photoUploadPhone: {
                    required: "The Troop Leaders' First Name is required",
                    minlength: "A minimum of 2 characters is required"
                },
            },
            
            highlight: function(element) {
                $(element).prev('label').addClass("error");
                $(element).addClass("error");
            },
            unhighlight: function(element) {
                $(element).prev('label').removeClass("error");
                $(element).addClass("valid");
            },
            errorContainer: $('#errorContainer2'),
            errorLabelContainer: $('#errorContainer2 ul'),
            wrapper: 'li',           
        });



        $.validator.addMethod('emailX', function(value) {
            return (
                value.match(/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/)
            );
        })

        $.validator.addMethod("zipcodeUS", function(value, element) {
            return this.optional(element) || /\d{5}-\d{4}$|^\d{5}$/.test(value)
        }, "The specified US ZIP Code is invalid");
        $.validator.addMethod('phone', function(value) {
            return (
                value.match(/^((\+)?[1-9]{1,2})?([-\s\.])?(\(\d\)[-\s\.]?)?((\(\d{1,4}\))|\d{1,4})(([-\s\.])?[0-9]{1,12}){1,2}(\s*(ext|x)\s*\.?:?\s*([0-9]+))?$/)
            );
        })

    });

