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

    function getPageName(url) {
        var index = url.lastIndexOf("/") + 1;
        var filenameWithExtension = url.substr(index);
        var filename = filenameWithExtension.split(".")[0]; // <-- added this line
        return filename;                                    // <-- added this line
    }

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

$(document).ready(function () {

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
//            $('#permGradLevel').prop('selectedIndex',0);
//            $('#permGradLevel').attr('class','form_Select250 normal');
//        }
//    })


    var pageName = getPageName($(location).attr("href"))
    //alert(pageName);
 //= TCM APPLICATION SCRIPTS ===================================================================================================================================
    if(pageName == 'tcmApplication') {
        $("#volTroop").mask('**?***',{placeholder:''});
        $("#volPhone").mask("(999) 999-9999");
        //-INITIALS TO UPPER CASE ------------------------------------------------------------------------------------------------------------------------------
        for(var i=1;i<=15;i++) {
            $('#txt'+i).keyup(function(){
                this.value = this.value.toUpperCase();
            });
        }
    } else if (pageName == 'tcmApplicationConfirm') {

//= PARENT PERMISSION SCRIPTS ==================================================================================================================================
    } else if (pageName == 'parentPermission' ) {
        //alert(pageName);
        $("#permGirlFName").focus();
        $("#permGSTroop").mask('**?***',{placeholder:''});
        $("#permPackages").mask('9?9999',{placeholder:''});
        $("#permZip").mask("99999");
        $("#permHomePhone").mask("(999) 999-9999");
        $("#permCellPhone").mask("(999) 999-9999");
        //-INITIALS TO UPPER CASE ------------------------------------------------------------------------------------------------------------------------------
        for(var i=1;i<=15;i++) {
            $('#perm'+i).keyup(function(){
                this.value = this.value.toUpperCase();
            });
        }
        for(var i=1;i<=15;i++) {
            $('#permCC'+i).keyup(function(){
                this.value = this.value.toUpperCase();
            });
        }
        //MANAGE COOKIE CLUB OPTION ============================================================================================================================
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

        //MANAGE CASH OPTION DROP DOWN =========================================================================================================================
            $("#permOption").click(function() {
               if($(this).is(':checked')) {
                   $('#pglWrapper').slideDown('slow','easeOutBounce');
               } else {
                   $('#pglWrapper').slideUp('slow','easeOutBounce');
                   $('#permGradLevel').prop('selectedIndex', 0).removeClass('valid').removeClass('error');
                   $('#permGradLevelError').empty();
               }
            })
		//COPY EMAIL ADDRESSES FROM PARENT TO LEADER AND FROM LEADER TO TCM ====================================================================================
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
            })

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

    } else if(pageName == 't2t') {
        //alert('t2t');
        $('#donorFName').focus();
        $("#donorZip").mask("99999");
        $("#donorPhone").mask("(999) 999-9999");
        $("#t2tGSRefer").click(function() {
            if($(this).is(':checked')) {
                $("#t2tTroopWrapper").slideDown("slow","easeOutBounce");
            }
        })
        $("#t2tWebRefer").click(function() {
            if($(this).is(':checked')) {
                $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                $('#t2tReferringTroop').prop('selectedIndex', 0);
                $('#t2tReferringName').val("");
            }
        })
        $("#t2tNewsRefer").click(function() {
            if($(this).is(':checked')) {
                $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                $('#t2tReferringTroop').prop('selectedIndex', 0);
                $('#t2tReferringName').val("");
            }
        })
        $("#t2tOther").click(function() {
            if($(this).is(':checked')) {
                $("#t2tTroopWrapper").slideUp("slow","easeOutBounce");
                $('#t2tReferringTroop').prop('selectedIndex', 0);
                $('#t2tReferringName').val("");
            }
        })

    //= TROOP TO TROOP  FORM BILLING PAGE ======================================================================================================================
    } else if(pageName == 't2t_Billing') {
//        alert('T2T Billing here');
        $("#billingZip").mask("99999");
        $("#billingPhone").mask("(999) 999-9999");
        $("#billingSame").click(function() {
            if($(this).is(':checked')) {
                $('#billingFName').val($("#donorFName").val());
                $('#billingLName').val($("#donorLName").val());
                $('#billingAddress').val($("#donorAddress").val());
                $('#billingAddress2').val($("#donorAddress2").val());
                $('#billingCity').val($("#donorCity").val());
                $('#billingState').val($("#donorState").val());
                $('#billingZip').val($("#donorZip").val());
                $('#billingPhone').val($("#donorPhone").val());
                $('#billingEmail').val($("#donorEmail").val());
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
        })

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
                $('#ccBox').css('background-position', '0 0');	       //=RESET IMAGES
                $('#ccType').val('');
            }
        });

    }



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
});




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
