// JavaScript Document
//====================================================================================================================================================
//= ONLOAD FUNCTION FOR USE WHEN COMING TO OR RETURNING TO A PAGE WITH DATA
//====================================================================================================================================================
//- FUNCTION TO TAKE A CREDIT CARD INITIAL FROM SESSION AND MOVE THE CREDIT CAR GRAPHIC SO THAT THE CORRECT IMAGE SHOWS ------------------------------
    function setCCType(ccType) {
        if(ccType != '') {
            if(ccType == 'v') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -23px';
            } else if (ccType == 'm') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -46px';
            } else if (ccType == 'a') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -69px';
            } else if (ccType == 'd') {
                document.getElementById('ccBox').style.backgroundPosition = '0 -92px';
            }
        }
    }

  function copyFormSecret(guid) {
      //alert(guid);
      document.getElementById('formSecret').value = guid;
 	}
	
//= FUNCTION TO RETURN THE XML HTTP OBJECT ===================================================
	function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}

    //= FUNCTION TO RETURN THE RESULTS OF THE PASSED URL =========================================
    function getTCTServiceUnit(strURL,theValue,theField) {

        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        if(theValue == 'value') {
                            document.getElementById(theField).value=req.responseText;
                        } else {
                            document.getElementById(theField).innerHTML=req.responseText;
                        }
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }


    function getPhotoUploadServiceUnit(strURL,theValue,theField) {
        var su = theValue.split(",");
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        document.getElementById(theField).value=su[1];
                        document.getElementById(theField).focus();
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }


    //= FUNCTION TO RETURN THE RESULTS OF THE PASSED URL =========================================
    function getTCMList(strURL,theValue,theField,closeField1,closeField2) {
        //alert(strURL);
        var req = getXMLHTTP();
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        if(theValue == 'value') {
                            document.getElementById(theField).value=req.responseText;
                        } else {
                            document.getElementById(theField).innerHTML=req.responseText;
                            document.getElementById(closeField1).innerHTML='';
                            document.getElementById(closeField2).innerHTML='';
                        }
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("GET", strURL, true);
            req.send(null);
        }
    }

//= FUNCTION TO RETURN THE RESULTS OF THE PASSED URL =========================================
function getPermissionList(strURL,theValue,theField,closeField1,closeField2) {
    //alert(strURL);
    var req = getXMLHTTP();
    if (req) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {
                    if(theValue == 'value') {
                        document.getElementById(theField).value=req.responseText;
                    } else {
                        document.getElementById(theField).innerHTML=req.responseText;
                        document.getElementById(closeField1).innerHTML='';
                        document.getElementById(closeField2).innerHTML='';
                    }
                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("GET", strURL, true);
        req.send(null);
    }
}

    function getPageName(url) {
        var index = url.lastIndexOf("/") + 1;
        var filenameWithExtension = url.substr(index);
        var filename = filenameWithExtension.split(".")[0]; // <-- added this line
        return filename;                                    // <-- added this line
    }

    //= FUNCTION TO SHOW REMAINING WORDS IN TEXTBOX
    var limit_zone = 15;
    $(function() {
        $.fn.limiter = function ( limit ) {
            return this.each(function() {
                $(this).on('keyup focus', function() {
                    var chars = this.value.length;
                    if (chars > limit) {
                        this.value = this.value.substr(0, limit);
                        chars = limit;
                    }
                    var charsleft = limit - chars;
                    if (chars > limit_zone) {
                        $(this).next().find('span').html(charsleft).addClass('charsRemainAlert');
                    }
                    else {
                        $(this).next().find('span').html(charsleft).removeClass('charsRemainAlert');
                    }
                });
            });
        };
        $('#achAccountName').limiter(21);
    });




    $(document).ready(function () {
        var pageName = getPageName($(location).attr("href")).toLowerCase();
        //alert(pageName);


    //= TCM APPLICATION SCRIPTS ===============================================================================================================================================
        if(pageName == 'tcmapplication') {
            $("#volTroop").mask('*?****',{placeholder:''});
            $("#volPhone").mask("(999) 999-9999");
            //-INITIALS TO UPPER CASE -----------------------------------------------------------------------------------------------------------------------------------------
            //for(var i=1;i<=15;i++) {
            //    $('#txt'+i).keyup(function(){
            //        this.value = this.value.toUpperCase();
            //    });
            //}
        } else if (pageName == 'tcmApplicationConfirm') {

    //= PARENT PERMISSION SCRIPTS =============================================================================================================================================
        } else if (pageName.toLowerCase() == 'parentpermission' ) {
            //alert(pageName);
            $("#permGirlFName").focus();
            $("#permGSTroop").mask('*?****',{placeholder:''});
            $("#permPackages").mask('9?9999',{placeholder:''});
            $("#permZip").mask("99999");
            $("#permHomePhone").mask("(999) 999-9999");
            $("#permCellPhone").mask("(999) 999-9999");
        //MANAGE COOKIE CLUB OPTION ===========================================================================================================================================
            $("#permCClubYes").click(function() {
                if($(this).is(':checked')) {
                    $("#ccClubAcknowledgements").slideDown("slow","easeOutBounce");
                }
            });
            $("#permCClubNo").click(function() {
                if($(this).is(':checked')) {
                    $('#ccClubAcknowledgements').slideUp('slow','easeOutBounce');
                    $('#permCC1').val('').removeClass('valid').removeClass('error');
                    $('#permCC2').val('').removeClass('valid').removeClass('error');
                    $('#permCC3').val('').removeClass('valid').removeClass('error');
                    $('#permCC4').val('').removeClass('valid').removeClass('error');
                    $('#permCC1Error').empty();
                    $('#permCC2Error').empty();
                    $('#permCC3Error').empty();
                    $('#permCC4Error').empty();
                }
            });

        //MANAGE CASH OPTION DROP DOWN ==============================================================================================================================
            $("#permOption").click(function() {
               if($(this).is(':checked')) {
                   $('#pglWrapper').slideDown('slow','easeOutBounce');
               } else {
                   $('#pglWrapper').slideUp('slow','easeOutBounce');
                   $('#permGradeLevel').prop('selectedIndex', 0).removeClass('valid').removeClass('error');
                   $('#permGradeLevelError').empty();
               }
            });
        //COPY EMAIL ADDRESSES FROM PARENT TO LEADER AND FROM LEADER TO TCM =========================================================================================
            $("#permLeaderSame").click(function() {
                if($(this).is(':checked')) {
                    $('#permLeadEmail').val($('#permMyEmail').val());
                    $('#permLeadEmail2').val($('#permMyEmail2').val());
                } else {
                    $('#permLeadEmail').val('').removeClass('valid').removeClass('error');
                    $('#permLeadEmail2').val('').removeClass('valid').removeClass('error');
                    $('#permLeadEmailError').empty();
                    $('#permLeadEmail2Error').empty();
                }
            });

            $("#permTCMSame").click(function() {
                if($(this).is(':checked')) {
                    $('#permTCMEmail').val($('#permLeadEmail').val());
                    $('#permTCMEmail2').val($('#permLeadEmail2').val());
                } else {
                    $('#permTCMEmail').val('').removeClass('valid').removeClass('error');
                    $('#permTCMEmail2').val('').removeClass('valid').removeClass('error');
                    $('#permTCMEmailError').empty();
                    $('#permTCMEmail2Error').empty();
                }
            });
        } else if (pageName == 'parentPermissionConfirm') {
            //= ACH PAYMENT FORM SCRIPTS =====================================================================================================================
        } else if (pageName.toLowerCase() == 'achpayment' ) {
            //alert(pageName);
            $("#achTroopNum").focus();
            $("#achPhone").mask("(999) 999-9999");
            $("#achRouting").mask("999999999");
            $("#achRoutingConfirm").mask("999999999");
            $("#achAmount").maskMoney();

            var elem = $("#accountNameChars");
            $("#achAccountName").limiter(21, elem);

            var routingNumberCopy = '' +
                '<div class="tooltipster-ach_Head">Where is My Routing Number?</div>'+
                '<img src="img/exampleCheck.png" width="320">' +
                '<div class="tooltipster-ach_SubHead tooltipster-ach_Routing">The Routing Number:</div>' +
                '<ul class="tooltipster-ach_UL">' +
                '<li>Is located at the <span style="font-weight:bold;text-decoration:underline;">bottom left</span> corner of a check</li>' +
                '<li>Is always 9 numbers long</li>' +
                '<li>Always begins with a 0, 1, 2 or 3</li>' +
                '</ul>'+
                '<div class="tooltipster-ach_Divider">&#32;</div>'+
                '<ul class="tooltipster-ach_UL2">' +
                '<li><span class="tooltipster-ach_important">Only use the routing number from a check</span></li>'+
                '<li><span class="tooltipster-ach_important">Do not</span> use a deposit slip. A deposit slip is for internal use only by the issuing bank.</li>' +
                '<li>Did we mention to only use the routing number from a check?</li>' +
                '</ul>';

            var accountNumberCopy = '' +
                '<div class="tooltipster-account_Head">Where is My Account Number?</div>'+
                '<img src="img/exampleCheck.png" width="320">' +
                '<div class="tooltipster-ach_SubHead tooltipster-ach_Account">The Account Number:</div>' +
                '<ul class="tooltipster-ach_UL">' +
                '<li>Is located at the <span style="font-weight:bold;text-decoration:underline;">bottom center</span> of a check - to the right of the routing number</li>' +
                '<li>Can be any length as they are used internally by the issuing bank</li>' +
                '</ul>';

            $('#routingTooltip').tooltipster({
                animation: 'grow',
                theme: 'tooltipster-ach',
                trigger: 'click',
                position:'right',
                offsetX: 5,
                offsetY: 8,
                contentAsHTML: true,
                minWidth: 360,
                maxWidth: 360,
                content: routingNumberCopy
            });
            $('#accountTooltip').tooltipster({
                animation: 'grow',
                theme: 'tooltipster-account',
                trigger: 'click',
                position:'right',
                offsetX: 5,
                offsetY: 8,
                contentAsHTML: true,
                minWidth: 360,
                maxWidth: 360,
                content: accountNumberCopy
            });

            $(window).keypress(function() {
                $('#routingTooltip').tooltipster('hide');
                $('#accountTooltip').tooltipster('hide');
            });



            // TROOP TO TROOP FORM ==========================================================================================================================================
        } else if(pageName == 't2t') {
            //alert('t2t');
            $('#t2tFName').focus();
            $("#t2tZip").mask("99999");
            $("#t2tPhone").mask("(999) 999-9999");
            if($('#referralType').val() == 'gs') {
                $("#t2tTroopWrapper").slideDown("slow","easeOutBounce");
            }
            $("#t2tGSRefer").click(function() {
                if($(this).is(':checked')) {
                    $("#t2tTroopWrapper").slideDown("slow","easeOutBounce");
                }
            });
            $("#t2tWebRefer").click(function() {
                if($(this).is(':checked')) {
                    $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                    $('#t2tReferringTroop').prop('selectedIndex', 0);
                    $('#t2tReferringName').val("");
                }
            });
            $("#t2tNewsRefer").click(function() {
                if($(this).is(':checked')) {
                    $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                    $('#t2tReferringTroop').prop('selectedIndex', 0);
                    $('#t2tReferringName').val("");
                }
            });
            $("#t2tOther").click(function() {
                if($(this).is(':checked')) {
                    $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                    $('#t2tReferringTroop').prop('selectedIndex', 0);
                    $('#t2tReferringName').val("");
                }
            });

        //= TROOP TO TROOP  FORM BILLING PAGE ======================================================================================================================
        } else if(pageName == 't2t_billing') {
           //alert('T2T Billing here');
            $("#billingZip").mask("99999");
            $("#billingPhone").mask("(999) 999-9999");
            $("#billingSame").click(function() {
                if($(this).is(':checked')) {
                    $('#billingFName').val($("#t2tFName").val());
                    $('#billingLName').val($("#t2tLName").val());
                    $('#billingAddress').val($("#t2tAddress").val());
                    $('#billingAddress2').val($("#t2tAddress2").val());
                    $('#billingCity').val($("#t2tCity").val());
                    $('#billingState').val($("#t2tState").val());
                    $('#billingZip').val($("#t2tZip").val());
                    $('#billingPhone').val($("#t2tPhone").val());
                    $('#billingEmail').val($("#t2tEmail").val());
                } else {
                    $('#billingFName').val("");
                    $('#billingLName').val("");
                    $('#billingAddress').val("");
                    $('#billingAddress2').val("");
                    $('#billingCity').val("");
                    $('#billingState').val("");
                    $('#billingZip').val("");
                    $('#billingPhone').val("");
                    $('#billingEmail').val("");
                }
            });
            //= REMOVING THE CHECK FROM THE REGISTRATION AND BILLING CHECKBOX IF INFORMATION CHANGES ===============================================================
            var a = $("#billingFName");
            var b = $("#billingLName");
            var c = $("#billingAddress");
            var d = $("#billingAddress2");
            var e = $("#billingCity");
            var f = $("#billingState");
            var g = $("#billingZip");
            var h = $("#billingPhone");
            var i = $("#billingEmail");
            $(a.selector+", "+ b.selector+", "+ c.selector+", "+ d.selector+", "+ e.selector+", "+ f.selector+", "+ g.selector+", "+ h.selector+", "+ i.selector).change(function() {
                $("#billingSame").attr("checked", false);
            });

            //= CREDIT CARD IMAGE DIMMER
            $('#ccNum').change(function(e){
                //alert(this.value.slice(0,2));
                if(/^4/.test(this.value.slice(0, 2))) {							//=CHECK FOR VISA
                    $('#ccBox').css('background-position', '0 -23px');
                    $('#ccType').val('v');
                //    alert( $('#ccType').val());
                } else if (/^5[1-5]/.test(this.value.slice(0, 2))) {            //=CHECK FOR MC
                    $('#ccBox').css('background-position', '0 -46px');
                    $('#ccType').val('m');
                } else if (/^3[47]/.test(this.value.slice(0, 2))) {             //=CHECK FOR AMEX
                    $('#ccBox').css('background-position', '0 -69px');
                    $('#ccType').val('a');
                } else if (/^6(?:011)/.test(this.value.slice(0, 4))) {          //=CHECK FOR DISCOVER
                    $('#ccBox').css('background-position', '0 -92px');
                    $('#ccType').val('d');
                } else if (/^6(?:5)/.test(this.value.slice(0, 2))) {            //=CHECK FOR DISCOVER
                    $('#ccBox').css('background-position', '0 -92px');
                    $('#ccType').val('d');
                } else {
                    $('#ccBox').css('background-position', '0 0');	            //=RESET IMAGES
                    $('#ccType').val('');
                }
            });

    //= TSHIRT ORDERS SCRIPTS =======================================================================================================================================
        } else if (pageName.toLowerCase() == 'tshirtorder' ) {
            //$('#orderFName').focus();
            $('.key-numeric').keypress(function(e) {
                var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
                if (verified) {e.preventDefault();}
            });
            $("#orderZip").mask("99999");
            $("#orderPhone").mask("(999) 999-9999");

            $('#orderDelivery').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideDown('slow','easeOutBounce');
                    $('#orderDeliveryAmount').val(6);
                    //var grandTotal = parseInt($('#orderTotal').val()) + parseInt(6);
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(6)).toFixed(2));
                }
            });
            $('#orderJAF').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));

                }
            });
            $('#orderSSSC').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });
            $('#orderETRC').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });
            $('#orderHV').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });
            $('#orderDenton').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });
            $('#orderParis').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').c;
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });
            $('#orderCollin').click(function(){
                if($(this).is(':checked')) {
                    $('#orderAddressWrapper').slideUp('slow','easeOutBounce');
                    $('#orderAddress').val('');
                    $('#orderCity').val('');
                    $('#orderState').val('TX');
                    $('#orderZip').val('');
                    $('#orderDeliveryLocation').val($(this).val());
                    $("#finalOrderTotalText").html('').html('$' + (parseInt($('#orderTotal').val()) + parseInt(0)).toFixed(2));
                }
            });

            $('#tshirtOrder').magnify({
                speed: 100, // fade in/out speed
                onload: function(){} // callback
            });

            $('#orderS').keyup(function(){
                $("#orderSTemp").val($('#orderS').val());
            });
            $('#orderM').keyup(function(){
                $("#orderMTemp").val($('#orderM').val());
            });
            $('#orderL').keyup(function(){
                $("#orderLTemp").val($('#orderL').val());
            });
            $('#orderXL').keyup(function(){
                $("#orderXLTemp").val($('#orderXL').val());
            });
            $('#order2X').keyup(function(){
                $("#order2XTemp").val($('#order2X').val());
            });
            $('#order3X').keyup(function(){
                $("#order3XTemp").val($('#order3X').val());
            });

            $(".ts1").each(function(){
                $(this).keyup(function(){
                    calculateSum();
                });
            });
            $(".ts2").each(function(){
                $(this).keyup(function(){
                    calculateSum();
                });
            });


            function calculateSum() {
                var sum = 0;
                var price = 0;
                var itemized = '';
                var orderS = Number($('#orderS').val());
                var orderM = Number($('#orderM').val());
                var orderL = Number($('#orderL').val());
                var orderXL = Number($('#orderXL').val());
                var order2X = Number($('#order2X').val());
                var order3X = Number($('#order3X').val());
                var orderTotal = orderS + orderM + orderL + orderXL + order2X + order3X;
                //alert(orderTotal);
                // if (orderTotal > 1) {
                //     orderTotal = orderTotal + ' Cookie Manager t-shirts';
                // } else {
                //     orderTotal = orderTotal + ' Cookie Manager t-shirt';
                // }
                //
                // if(orderS > 0) {
                //     itemized = orderS + ' - Small'+ 'zzz';
                // } else {
                //     orderS = '';
                // }
                // if(orderM > 0) {
                //     itemized = itemized + orderM + ' - Medium'+'zzz';
                // }
                // if(orderL > 0) {
                //     itemized = itemized + orderL + ' - Large'+ 'zzz';
                // }
                // if(orderXL > 0) {
                //     itemized = itemized + orderXL + ' - Extra Large'+ 'zzz';
                // }
                // if(order2X > 0) {
                //     itemized = itemized + order2X + ' - 2X' + 'zzz';
                // }
                // if(order3X > 0) {
                //     itemized = itemized + order3X + ' - 3X' + 'zzz';
                // }

                    price = 10;
                    $(".ts1").each(function () {
                        if (!isNaN(this.value.replace(/\,/g, '')) && this.value.length != 0) {
                            sum += parseFloat(price*(this.value).replace(/\,/g, ''));
                        }
                    });
                    price = 12;
                    $(".ts2").each(function () {
                        if (!isNaN(this.value.replace(/\,/g, '')) && this.value.length != 0) {
                            sum += parseFloat(price*(this.value).replace(/\,/g, ''));
                        }
                    });
                    $("#orderTotalText").html('$'+ sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                    $("#orderTotal").val(sum.toFixed(0).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                    $("#finalOrderTotalText").html('$'+ sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));

                $('#orderTotalCopy').val(orderTotal);
                $('#orderItemized').val(itemized);
            }
            //
            //$("[name='orderDelivery']").click(function(){
            //    //alert($("input[name='orderDelivery']:checked").val());
            //    $("#orderDeliveryLocation").val($("input[name='orderDelivery']:checked").val());
            //});


            //= COOKIE TSHIRT ORDERS SCRIPTS =======================================================================================================================================
        } else if (pageName.toLowerCase() == 'cookieshirtorder' ) {
            //$('#orderFName').focus();
            $('.key-numeric').keypress(function(e) {
                var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
                if (verified) {e.preventDefault();}
            });
            $("#cookieOrderZip").mask("99999");
            $("#cookieOrderPhone").mask("(999) 999-9999");
            $("#cookieBillingZip").mask("99999");
            $("#cookieBillingPhone").mask("(999) 999-9999");

            $("#cookieBillingSame").click(function() {
                if($(this).is(':checked')) {
                    $('#cookieBillingFName').val($("#cookieOrderFName").val());
                    $('#cookieBillingLName').val($("#cookieOrderLName").val());
                    $('#cookieBillingAddress').val($("#cookieOrderAddress").val());
                    $('#cookieBillingCity').val($("#cookieOrderCity").val());
                    $('#cookieBillingState').val($("#cookieOrderState").val());
                    $('#cookieBillingZip').val($("#cookieOrderZip").val());
                    $('#cookieBillingPhone').val($("#cookieOrderPhone").val());
                    $('#cookieBillingEmail').val($("#cookieOrderEmail").val());
                } else {
                    $('#cookieBillingFName').val("");
                    $('#cookieBillingLName').val("");
                    $('#cookieBillingAddress').val("");
                    $('#cookieBillingAddress2').val("");
                    $('#cookieBillingCity').val("");
                    $('#cookieBillingState').val("TX");
                    $('#cookieBillingZip').val("");
                    $('#cookieBillingPhone').val("");
                    $('#cookieBillingEmail').val("");
                    $('#cookieBillingEmail2').val("");
                }
            });

            $('#cookieShirtOrder').magnify({
                speed: 100, // fade in/out speed
                onload: function(){} // callback
            });

            var cookieSquadCopy = '' +
                '<div class="tooltipster-account_Head">Where&apos;s the Security Code on My Card?</div>'+
                '<div class="tooltipster-cookies">' +
                'CVV2 is an important security feature for credit card transactions on the Internet and over the phone. "CVV" stands for "Card Verification Value" (Discover Card calls it the "Cardmember ID").' +
                '</div>' +
                '<img src="img/info_CVV2Codes.png" width="200" height="210" align="right">' +
                '<div class="tooltipster-cookies2">Visa, Mastercard and Discover all use a 3 digit code printed on the back of the card.</div>' +
                '<div class="tooltipster-cookies3">American Express employs a printed 4 digit code on the front if it’s cards.</div>';

            $('#cookieSquadTooltip').tooltipster({
                animation: 'grow',
                theme: 'tooltipster-account',
                trigger: 'click',
                position:'right',
                offsetX: 5,
                offsetY: 8,
                contentAsHTML: true,
                minWidth: 360,
                maxWidth: 360,
                content: cookieSquadCopy
            });

            $(window).keypress(function() {
                $('#cookieSquadTooltip').tooltipster('hide');
            });



            $('#cookieOrderYS').keyup(function(){
                $("#cookieOrderYSTemp").val($('#cookieOrderYS').val());
            });
            $('#cookieOrderYM').keyup(function(){
                $("#cookieOrderYMTemp").val($('#cookieOrderYM').val());
            });
            $('#cookieOrderYL').keyup(function(){
                $("#cookieOrderYLTemp").val($('#cookieOrderYL').val());
            });
            $('#cookieOrderAS').keyup(function(){
                $("#cookieOrderASTemp").val($('#cookieOrderAS').val());
            });
            $('#cookieOrderAM').keyup(function(){
                $("#cookieOrderAMTemp").val($('#cookieOrderAM').val());
            });
            $('#cookieOrderAL').keyup(function(){
                $("#cookieOrderALTemp").val($('#cookieOrderAL').val());
            });
            $('#cookieOrderAXL').keyup(function(){
                $("#cookieOrderAXLTemp").val($('#cookieOrderAXL').val());
            });
            $('#cookieOrderA2X').keyup(function(){
                $("#cookieOrderA2XTemp").val($('#cookieOrderA2X').val());
            });
            $('#cookieOrderA3X').keyup(function(){
                $("#cookieOrderA3XTemp").val($('#cookieOrderA3X').val());
            });
            $('#cookieOrderA4X').keyup(function(){
                $("#cookieOrderA4XTemp").val($('#cookieOrderA4X').val());
            });
            $('#cookieOrderGreatWolf').click(function(){
                if($(this).is(':checked')) {
                    //alert('Great Wolf');
                    $('#cookieOrderAddressWrapper').slideUp('600');
                    $('#cookieOrderPaymentAddressWrapper').slideDown('slow', 'easeOutBounce');
                    $('#cookieOrderSameInfo').slideUp('600');
                    $("#cookieOrderFName").val("");
                    $("#cookieOrderLName").val("");
                    $("#cookieOrderAddress").val("");
                    $("#cookieOrderCity").val("");
                    $("#cookieOrderState").val("TX");
                    $("#cookieOrderZip").val("");
                    $("#cookieOrderPhone").val("");
                    $("#cookieOrderEmail").val("");
                }
            });
            $('#cookieOrderCamp').click(function() {
                if ($(this).is(':checked')) {
                    $('#cookieOrderAddressWrapper').slideDown('slow', 'easeOutBounce');
                    $('#cookieOrderPaymentAddressWrapper').slideUp('600');
                    $('#cookieOrderSameInfo').slideDown('slow','easeOutBounce');
                    $('#paymentSpacer').hide();
                }
            });

            //= CREDIT CARD IMAGE DIMMER
            $('#ccNum').change(function(e){
                //alert(this.value.slice(0,2));
                if(/^4/.test(this.value.slice(0, 2))) {							//=CHECK FOR VISA
                    $('#ccBox').css('background-position', '0 -23px');
                    $('#ccType').val('v');
                    //    alert( $('#ccType').val());
                } else if (/^5[1-5]/.test(this.value.slice(0, 2))) {            //=CHECK FOR MC
                    $('#ccBox').css('background-position', '0 -46px');
                    $('#ccType').val('m');
                } else if (/^3[47]/.test(this.value.slice(0, 2))) {             //=CHECK FOR AMEX
                    $('#ccBox').css('background-position', '0 -69px');
                    $('#ccType').val('a');
                } else if (/^6(?:011)/.test(this.value.slice(0, 4))) {          //=CHECK FOR DISCOVER
                    $('#ccBox').css('background-position', '0 -92px');
                    $('#ccType').val('d');
                } else if (/^6(?:5)/.test(this.value.slice(0, 2))) {            //=CHECK FOR DISCOVER
                    $('#ccBox').css('background-position', '0 -92px');
                    $('#ccType').val('d');
                } else {
                    $('#ccBox').css('background-position', '0 0');	            //=RESET IMAGES
                    $('#ccType').val('');
                }
            });

            $(".cts1").each(function(){
                $(this).keyup(function(){
                    calculateCookieSum();
                });
            });
            $(".cts2").each(function(){
                $(this).keyup(function(){
                    calculateCookieSum();
                });
            });
            function calculateCookieSum() {
                var sum = 0;
                var price = 0;
                var itemized = '';
                var orderYS = Number($('#cookieOrderYS').val());
                var orderYM = Number($('#cookieOrderYM').val());
                var orderYL = Number($('#cookieOrderYL').val());
                var orderAS = Number($('#cookieOrderAS').val());
                var orderAM = Number($('#cookieOrderAM').val());
                var orderAL = Number($('#cookieOrderAL').val());
                var orderAXL = Number($('#cookieOrderAXL').val());
                var orderA2X = Number($('#cookieOrderA2X').val());
                var orderA3X = Number($('#cookieOrderA3X').val());
                var orderA4X = Number($('#cookieOrderA4X').val());
                var cookieOrderTotal = orderYS + orderYM + orderYL + orderAS + orderAM + orderAL + orderAXL + orderA2X + orderA3X + orderA4X;
                var cookieOrderTotalNumber = orderYS + orderYM + orderYL + orderAS + orderAM + orderAL + orderAXL + orderA2X + orderA3X + orderA4X;
                //alert(orderYS);
                if (cookieOrderTotal > 1) {
                    cookieOrderTotal = cookieOrderTotal + ' Cookie Squad Member t-shirts';
                } else {
                    cookieOrderTotal = cookieOrderTotal + ' Cookie Squad Member t-shirt';
                }

                if(orderYS > 0) {
                    itemized = orderYS + ' - Youth Small'+ '<br>';
                } else {
                    orderYS = '';
                }
                if(orderYM > 0) {
                    itemized = itemized + orderYM + ' - Youth Medium'+'<br>';
                }
                if(orderYL > 0) {
                    itemized = itemized + orderYL + ' - Youth Large'+ '<br>';
                }
                if(orderAS > 0) {
                    itemized = itemized + orderAS + ' - Adult Small'+ '<br>';
                }
                if(orderAM > 0) {
                    itemized = itemized + orderAM + ' - Adult Medium'+ '<br>';
                }
                if(orderAL > 0) {
                    itemized = itemized + orderAL + ' - Adult Large'+ '<br>';
                }
                if(orderAXL > 0) {
                    itemized = itemized + orderAXL + ' - Adult Extra Large'+ '<br>';
                }
                if(orderA2X > 0) {
                    itemized = itemized + orderA2X + ' - Adult 2X' + '<br>';
                }
                if(orderA3X > 0) {
                    itemized = itemized + orderA3X + ' - Adult 3X' + '<br>';
                }
                if(orderA4X > 0) {
                    itemized = itemized + orderA4X + ' - Adult 4X' + '<br>';
                }
                price = 10;
                $(".cts1").each(function () {
                    if (!isNaN(this.value.replace(/\,/g, '')) && this.value.length != 0) {
                        sum += parseFloat(price*(this.value).replace(/\,/g, ''));
                    }
                });
                price = 12;
                $(".cts2").each(function () {
                    if (!isNaN(this.value.replace(/\,/g, '')) && this.value.length != 0) {
                        sum += parseFloat(price*(this.value).replace(/\,/g, ''));
                    }
                });
                $("#orderSubTotalText").html('$'+ sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                var cookieSquadSubTotal = sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
                $("#orderTaxText").html('$'+ (sum *.0825).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                var cookieSquadTaxTotal = (sum *.0825).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
                //$("#orderGrandTotalText").html('$'+ +cookieSquadSubTotal + +cookieSquadTaxTotal);
                $("#cookieOrderTotalNumber").val(cookieOrderTotalNumber);
                $("#cookieOrderTotal").val(sum.toFixed(0).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                $("#finalOrderTotalText").html('$'+ sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                $('#cookieOrderTotalCopy').val(cookieOrderTotal);
                $('#cookieOrderItemized').val(itemized);

            //= COPY SUB-TOTAL AND TAX TO HIDDEN FIELDS TO SUBMIT TO DATABASE ==========================================
                $("#cookieOrderSubTotalTemp").val(sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                $("#cookieOrderTaxTemp").val((sum *.0825).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                $("#cookieOrderGrandTotalTemp").val(+($("#cookieOrderSubTotalTemp").val())+ +($("#cookieOrderTaxTemp").val()));
                //$("#orderGrandTotalText").html('$' + +($("#cookieOrderGrandTotalTemp").val()));
                $("#orderGrandTotalText").html('$' + parseFloat($("#cookieOrderGrandTotalTemp").val()).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());

            };

        //= PHOTO UPLOAD TOOL SCRIPTS ======================================================================================================================================
        } else if (pageName.toLowerCase() == 'photoupload' ) {
            $('#agreeToConditions').click(function() {
                if ($(this).is(':checked')) {
                    var currentDate = new Date();
                    $('#photoUploadTroopLeaderConfirmationDate').val((currentDate.getMonth()+1)  + "/"+currentDate.getDate() + "/"+ currentDate.getFullYear() + " "+ currentDate.getHours() + ":"+ currentDate.getMinutes() + ":"+ currentDate.getSeconds());
                }
            });
            $("#photoUploadPhone").mask("(999) 999-9999");


            //= ADMIN TOOL SCRIPTS ======================================================================================================================================
        } else if (pageName.toLowerCase() == 'tctadmin' ) {
            $('#tcmAdmin').click(function(){
                if($(this).is(':checked')) {
                    $('#tcmAdmin_Wrapper').slideDown('slow','easeOutBounce');
                    $('#ppAdmin_Wrapper').slideUp('slow','easeOutBounce');
                }
            });
            $('#ppAdmin').click(function(){
                if($(this).is(':checked')) {
                    $('#ppAdmin_Wrapper').slideDown('slow','easeOutBounce');
                    $('#tcmAdmin_Wrapper').slideUp('slow','easeOutBounce');
                }
            });

            $('.record').hide();
            $('.editRecord').click(function(e) {
                e.preventDefault();
                $('.record').hide();
                $(this).closest('tr').nextUntil(":not(.record)").fadeIn('slow');
            });

            $(".adminEditPhone").mask("(999) 999-9999");
        } else if (pageName.toLowerCase() == 'resendemail' ) {


    //= OFR REPORT SCRIPTS ====================================================================================================================================================
        } else if (pageName.toLowerCase() == 'ofr' ) {
            $("#ofrTroopNum").focus();
            $("#troopLeaderZip").mask("99999");
            $("#troopLeaderPhone").mask("(999) 999-9999");
            //$("#troopLeaderWorkPhone").mask("(999) 999-9999");
            //$("#troopLeaderCellPhone").mask("(999) 999-9999");
            $("#tcmZip").mask("99999");
            $("#tcmPhone").mask("(999) 999-9999");
            //$("#tcmWorkPhone").mask("(999) 999-9999");
            //$("#tcmCellPhone").mask("(999) 999-9999");
            $('#parentGuardianZip').mask("99999");
            $('#parentGuardianPhone').mask("(999) 999-9999");
            $('#parentGuardianWorkPhone').mask("(999) 999-9999");
            $('#parentGuardianCellPhone').mask("(999) 999-9999");
            $('#ofrPhone').mask("(999) 999-9999");
            $('#ofrAmountOwed').maskMoney();
            $('#ofrAmountPaid').maskMoney({allowZero:true});

            //$('#ofrBalanceDue').maskMoney();
            $("#ofrSame").click(function() {
                if($(this).is(':checked')) {
                    $('#ofrTCMInfo_Wrapper').fadeOut('slow');
                    $('#tcmFName').val("").removeClass('valid').removeClass('error');
                    $('#tcmLName').val("").removeClass('valid').removeClass('error');
                    $('#tcmAddress').val("").removeClass('valid').removeClass('error');
                    $('#tcmAddress2').val("").removeClass('valid').removeClass('error');
                    $('#tcmCity').val("").removeClass('valid').removeClass('error');
                    $('#tcmState').val("").removeClass('valid').removeClass('error');
                    $('#tcmZip').val("").removeClass('valid').removeClass('error');
                    $('#tcmPhone').val("").removeClass('valid').removeClass('error');
                    $('#tcmWorkPhone').val("").removeClass('valid').removeClass('error');
                    $('#tcmCellPhone').val("").removeClass('valid').removeClass('error');
                    $('#tcmEmail').val("").removeClass('valid').removeClass('error');
                    $('#tcmEmail2').val("").removeClass('valid').removeClass('error');
                } else {
                    $('#ofrTCMInfo_Wrapper').fadeIn('slow');
                }
            });

            $(".ofrAmount").each(function(){
                $(this).keyup(function(){
                    CalcBalance();
                });
            });

            //function calculateSum(){
            //    var sum=0;
            //    $(".ofrAmount").each(function(){
            //        if(!isNaN(this.value.replace(/\,/g,''))&&this.value.length!=0){
            //            sum+=parseFloat(this.value.replace(/\,/g,''));
            //        }
            //    });
            //    $("#sum").html('$'+sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
            //}

            function CalcBalance() {
                var sum = (GetValue("#ofrAmountOwed")-GetValue("#ofrAmountPaid"));
                $('#ofrBalanceDueTemp').val(GetValue("#ofrAmountOwed")-GetValue("#ofrAmountPaid"));
                $("#sum").html('$'+sum.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,"));
                //$("#sum").html('$'+(GetValue("#ofrAmountOwed")-GetValue("#ofrAmountPaid")));
            }
            function GetValue(fieldId) {
                var fieldVal = $(fieldId).val();
                if(!isNaN(fieldVal.replace(/\,/g,''))&&fieldVal.length!=0){
                    return parseFloat(fieldVal.replace(/\,/g,''));
                }
                else {return 0.00}
            }


        }

    });

//
////  OFR REPORT FORM ============================
////	$("#ofrLdrZip").mask("99999");
////	$("#ofrTcmZip").mask("99999");
////	$("#ofrParentZip").mask("99999");
////	$("#ofrLdrHomePhone").mask("(999) 999-9999");
////	$("#ofrLdrWorkPhone").mask("(999) 999-9999");
////	$("#ofrLdrCellPhone").mask("(999) 999-9999");
////	$("#ofrTcmHomePhone").mask("(999) 999-9999");
////	$("#ofrTcmWorkPhone").mask("(999) 999-9999");
////	$("#ofrTcmCellPhone").mask("(999) 999-9999");
////	$("#ofrParentHomePhone").mask("(999) 999-9999");
////	$("#ofrParentWorkPhone").mask("(999) 999-9999");
////	$("#ofrParentCellPhone").mask("(999) 999-9999");
////
//////  ACH PAYMENT FORM ===========================
////	$("#cookieZipSearch").mask("99999");
////	$("#accountPhone").mask("(999) 999-9999");
////	$("#accountRouting").mask("999999999");
////	$("#accountRouting2").mask("999999999");
////	$("#accountDeposit").maskMoney();
//

//
////	COOKIE TCM APPLICATION FORM ================
//    $('#volPhone').mask('(999) 999-9999');
//    $('#volTroop').mask('**?***',{placeholder:''});
//
//
//	$('#perm1').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#perm2').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#perm3').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#perm4').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#perm5').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#perm6').keyup(function(){
//		this.value = this.value.toUpperCase();
//	});
//	$('#permCC1').keyup(function(){
//		this.value = this.value.toUpperCase();
//	})
//	$('#permCC2').keyup(function(){
//		this.value = this.value.toUpperCase();
//	})
//	$('#permCC3').keyup(function(){
//		this.value = this.value.toUpperCase();
//	})
//	$('#permCC4').keyup(function(){
//		this.value = this.value.toUpperCase();
//	})
//
//	$("#accountDeposit").keyup(function() {
//		$('#accountDepositTemp').val($('#accountDeposit').val());
//		var depositTemp = $('#accountDepositTemp').val();
//	});
//
//
////	COOKIE VOLUNTEER FORM =====================
//	$("#volTroopNum").mask("**?***");
//
//	for(var i=1;i<=15;i++) {
//		$('#txt'+i).keyup(function(){
//			this.value = this.value.toUpperCase();
//		});
//	}
//
//	$("#permCClubYes").click(function(){
//		$("#ccClubAcknowledgements").slideDown("slow","easeOutBounce");
//	});
//	$("#permCClubNo").click(function(){
//		$("#ccClubAcknowledgements").slideUp("slow","easeOutBounce");
//		$('#permCC1').val('');
//		$('#permCC2').val('');
//		$('#permCC3').val('');
//		$('#permCC4').val('');
//	});
//
//
//
////  CASH OPTION PGL DISPLAY
//    $('#permOption').click(function(){
//        if($('input[name=permOption]').prop('checked')) {
//           $('#pglWrapper').slideDown("slow","easeOutBounce");
//        } else {
//            $('#pglWrapper').slideUp("slow","easeOutBounce");
//            $('#permGradeLevel').prop('selectedIndex',0);
//            $('#permGradeLevel').attr('class','form_Select250 normal');
//        }
//    })

    //}
    ////= T@T REVIEW PAGE - DISPLAY PORTION
	//$("#t2tZip").mask("99999");
	//$("#t2tPhone").mask("(999) 999-9999");
    //
	//$("#t2tGSRefer").click(function(){
	//	$("#t2tReferringTroopWrapper").slideDown("slow","easeOutBounce");
	//});
	//$("#t2tWebRefer").click(function(){
	//	$("#t2tReferringTroopWrapper").slideUp("slow","easeOutBounce");
	//	$("#t2tReferringTroop").prop('selectedIndex',0);
	//});
	//$("#t2tNewsRefer").click(function(){
	//	$("#t2tReferringTroopWrapper").slideUp("slow","easeOutBounce");
	//	$("#t2tReferringTroop").prop('selectedIndex',0);
	//});
	//$("#t2tOther").click(function(){
	//	$("#t2tReferringTroopWrapper").slideUp("slow","easeOutBounce");
	//	$("#t2tReferringTroop").prop('selectedIndex',0);
	//});
    //

//	});

////= TROOP TO TR0OP REVIEW PAGE ==========================================================
////= TYPE IN REVIEW FIELD AND UPDATE HIDDEN FIELD TO PASS TO CONFIRMATION PAGE
//	//= FIRST NAME
//		$("#t2tFNameTemp").keyup(function () {
//			$("#t2tFName").val($(this).val());
//		});
//	//= LAST NAME
//		$("#t2tLNameTemp").keyup(function () {
//			$("#t2tLName").val($(this).val());
//		});
//	//= ADDRESS
//		$("#t2tAddressTemp").keyup(function () {
//			$("#t2tAddress").val($(this).val());
//		});
//	//= ADDRESS2
//		$("#t2tAddress2Temp").keyup(function () {
//			$("#t2tAddress2").val($(this).val());
//		});
//	//= CITY
//		$("#t2tCityTemp").keyup(function () {
//			$("#t2tCity").val($(this).val());
//		});
//	//= STATE
//		$("#t2tStateTemp").change(function () {
//			$("#t2tState").val($(this).val());
//		});
//	//= ZIP
//		$("#t2tZipTemp").keyup(function () {
//			$("#t2tZip").val($(this).val());
//		});
//	//= PHONE
//		$("#t2tPhoneTemp").keyup(function () {
//			$("#t2tPhone").val($(this).val());
//		});
//	//= OTHER PHONE
//		$("#t2tOtherPhoneTemp").keyup(function () {
//			$("#t2tOtherPhone").val($(this).val());
//		});
//	//= EMAIL
//		$("#t2tEmailTemp").keyup(function () {
//			$("#t2tEmail").val($(this).val());
//		});
//	//= DONATION
//		$("#t2tDonationAmountTemp").change(function () {
//			$("#t2tDonationAmount").val($(this).val());
//		});
//	//= DONATION INFORMATION
//		$("#t2tWebReferTemp").click(function () {
//			$("#t2tRefer").val($(this).val());
//			$("#t2tReferringTroop").val('');
//			$("#t2tReferringTroopTemp").prop('selectedIndex',0);
//		});
//		$("#t2tNewsReferTemp").click(function () {
//			$("#t2tRefer").val($(this).val());
//			$("#t2tReferringTroop").val('');
//			$("#t2tReferringTroopTemp").prop('selectedIndex',0);
//		});
//		$("#t2tGSReferTemp").click(function () {
//			$("#t2tRefer").val($(this).val());
//			$("#t2tReferringTroop").val('');
//			$("#t2tReferringTroopTemp").prop('selectedIndex',0);
//		});
//		$("#t2tOtherTemp").change(function () {
//			$("#t2tRefer").val($(this).val());
//			$("#t2tReferringTroop").val('');
//			$("#t2tReferringTroopTemp").prop('selectedIndex',0);
//		});
//		$("#t2tReferringTroopTemp").change(function () {
//			$("#t2tReferringTroop").val($(this).val());
//		});
//		$("#t2tReferringScoutTemp").change(function () {
//			$("#t2tReferringScout").val($(this).val());
//		});
//	//= CC INFORMATION
//		$("#ccNameTemp").keyup(function () {
//			$("#ccName").val($(this).val());
//		});
//		$("#ccAddressTemp").keyup(function () {
//			$("#ccAddress").val($(this).val());
//		});
//		$("#ccCityTemp").keyup(function () {
//			$("#ccCity").val($(this).val());
//		});
//		$("#ccStateTemp").change(function () {
//			$("#ccState").val($(this).val());
//		});
//		$("#ccZipTemp").keyup(function () {
//			$("#ccZip").val($(this).val());
//		});
//		$("#ccEmailTemp").keyup(function () {
//			$("#ccEmail").val($(this).val());
//		});
//	//= CC TYPE
//		$("#ccTypeVisa").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNum").val('');
//		});
//		$("#ccTypeMC").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNum").val('');
//		});
//		$("#ccTypeAmex").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNum").val('');
//		});
//		$("#ccTypeDisc").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNum").val('');
//		});
//
//		$("#ccTypeTempVisa").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNumTemp").val('');
//		});
//		$("#ccTypeTempMC").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNumTemp").val('');
//		});
//		$("#ccTypeTempAmex").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNumTemp").val('');
//		});
//		$("#ccTypeTempDisc").click(function () {
//			$("#ccType").val($(this).val());
//			$("#ccNumTemp").val('');
//		});
//		$("#ccNumTemp").focus(function(){
//			$(this).val('');
//		});
//		$("#ccNumTemp").keyup(function () {
//			$("#ccNum").val($(this).val());
//		});
//		$("#ccMonthTemp").change(function () {
//			$("#ccMonth").val($(this).val());
//		});
//		$("#ccYearTemp").change(function () {
//			$("#ccYear").val($(this).val());
//		});
//		$("#ccCVV2Temp").keyup(function () {
//			$("#ccCVV2").val($(this).val());
//		});
//= FUNCTION TO SHOW REMAINING WORDS IN TEXTBOX
//	var limit_zone = 10;
//	$(function() {
//		$.fn.limiter = function ( limit ) {
//		  return this.each(function() {
//			$(this).on('keyup focus', function() {
//			  var chars = this.value.length;
//			  if (chars > limit) {
//				this.value = this.value.substr(0, limit);
//				chars = limit;
//			  }
//			  var charsleft = limit - chars;
//			  if (chars > limit_zone) {
//				$('#accountNameChars span').html(charsleft).addClass('charsRemainAlert');
//			  }
//			  else {
//				$('#accountNameChars span').html(charsleft).removeClass('charsRemainAlert');
//			  }
//			});
//		  });
//		};
//	  $('#accountName').limiter(21);
//	});


//= FUNCTION TO RETURN THE RESULTS OF THE PASSED URL =========================================
//	function getTroopInfo(strURL,theField) {
//	//alert('here');
//		var req = getXMLHTTP();
//		if (req) {
//			req.onreadystatechange = function() {
//				if (req.readyState == 4) {
//					// only if "OK"
//					if (req.status == 200) {
//							document.getElementById(theField).innerHTML=req.responseText;
//					} else {
//						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
//					}
//				}
//			}
//			req.open("GET", strURL, true);
//			req.send(null);
//		}
//	}

//= FUNCTION TO RETURN THE RESULTS OF THE PASSED URL =========================================
//	function getRoutingNumberStatus(strURL,theField) {
//	alert('From the function: '+strURL);
//		var req = getXMLHTTP();
//		if (req) {
//			req.onreadystatechange = function() {
//				if (req.readyState == 4) {
////					// only if "OK"
//					if (req.status == 200) {
//						document.getElementById(theField).value=req.responseText;
//					} else {
//						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
//					}
//				}
//			}
//			req.open("GET", strURL, true);
//			req.send(null);
//		}
//	}


    //function trim11 (str) {
    //	str = str.replace(/^\s+/, '');
    //	for (var i = str.length - 1; i >= 0; i--) {
    //		if (/\S/.test(str.charAt(i))) {
    //			str = str.substring(0, i + 1);
    //			break;
    //		}
    //	}
    //	return str;
    //}







	function makeRequired(theRequiredID,theClickedID) {
		if(document.getElementById(theClickedID).checked == true) {
			document.getElementById(theRequiredID+'Label').innerHTML = '<span class="required">*</span>Program Grade Level: ';
		} else {
			document.getElementById(theRequiredID+'Label').innerHTML = '<span class="notRequired">*</span>Program Grade Level: ';
		}
	}
	
	function modalWin(theTest) {
		if (window.showModalDialog) {
			window.showModalDialog("print.php?test="+theTest,"name", "dialogWidth:520px;dialogHeight:475px;resizable:no;unadorned:yes;");
		} else {
			window.open('print.php?test='.theTest,'name', 'height=475,width=520,toolbar=no,directories=no,status=no, menubar=no,scrollbars=no,resizable=no ,modal=yes');
		}
	}
