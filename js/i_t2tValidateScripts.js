<!--//
		function checkLuhn(input)
		{
			var sum = 0;
			var numdigits = input.length;
			var parity = numdigits % 2;
			for(var i=0; i < numdigits; i++) {
				var digit = parseInt(input.charAt(i))
				if(i % 2 == parity) digit *= 2;
				if(digit > 9) digit -= 9;
				sum += digit;
			}
			return (sum % 10) == 0;
		}

        <!-- This script is based on the javascript code of Roman Feldblum (web.developer@programmer.net) -->
        <!-- Original script : http://javascript.internet.com/forms/format-phone-number.html -->
        <!-- Original script is revised by Eralper Yilmaz (http://www.eralper.com) -->
        <!-- Revised script : http://www.kodyaz.com -->
        <!-- Format : "(123) 456-7890" -->

        var zChar = new Array(' ', '(', ')', '-', '.');
        var maxphonelength = 14;
        var phonevalue1;
        var phonevalue2;
        var cursorposition;

        function ParseForNumber1(object){
          phonevalue1 = ParseChar(object.value, zChar);
        }

        function ParseForNumber2(object){
          phonevalue2 = ParseChar(object.value, zChar);
        }

        function backspacerUP(object,e) { 
          if(e){ 
            e = e 
          } else {
            e = window.event 
          } 
          if(e.which){ 
            var keycode = e.which 
          } else {
            var keycode = e.keyCode 
          }

          ParseForNumber1(object)

          if(keycode >= 48){
            ValidatePhone(object)
          }
        }

        function backspacerDOWN(object,e) { 
          if(e){ 
            e = e 
          } else {
            e = window.event 
          } 
          if(e.which){ 
            var keycode = e.which 
          } else {
            var keycode = e.keyCode 
          }
          ParseForNumber2(object)
        } 

        function GetCursorPosition(){

          var t1 = phonevalue1;
          var t2 = phonevalue2;
          var bool = false
          for (i=0; i<t1.length; i++)
          {
            if (t1.substring(i,1) != t2.substring(i,1)) {
              if(!bool) {
                cursorposition=i
                window.status=cursorposition
                bool=true
              }
            }
          }
        }

        function ValidatePhone(object){

          var p = phonevalue1

          p = p.replace(/[^\d]*/gi,"")

          if (p.length < 3) {
            object.value=p
          } else if(p.length==3){
            pp=p;
            d4=p.indexOf('(')
            d5=p.indexOf(')')
            if(d4==-1){
              pp="("+pp;
            }
            if(d5==-1){
              pp=pp+")";
            }
            object.value = pp;
          } else if(p.length>3 && p.length < 7){
            p ="(" + p; 
            l30=p.length;
            p30=p.substring(0,4);
            p30=p30+") " 

            p31=p.substring(4,l30);
            pp=p30+p31;

            object.value = pp; 

          } else if(p.length >= 7){
            p ="(" + p; 
            l30=p.length;
            p30=p.substring(0,4);
            p30=p30+") " 

            p31=p.substring(4,l30);
            pp=p30+p31;

            l40 = pp.length;
            p40 = pp.substring(0,9);
            p40 = p40 + "-"

            p41 = pp.substring(9,l40);
            ppp = p40 + p41;

            object.value = ppp.substring(0, maxphonelength);
          }

          GetCursorPosition()

          if(cursorposition >= 0){
            if (cursorposition == 0) {
              cursorposition = 2
            } else if (cursorposition <= 2) {
              cursorposition = cursorposition + 1
            } else if (cursorposition <= 4) {
              cursorposition = cursorposition + 3
            } else if (cursorposition == 5) {
              cursorposition = cursorposition + 3
            } else if (cursorposition == 6) { 
              cursorposition = cursorposition + 3 
            } else if (cursorposition == 7) { 
              cursorposition = cursorposition + 4 
            } else if (cursorposition == 8) { 
              cursorposition = cursorposition + 4
              e1=object.value.indexOf(')')
              e2=object.value.indexOf('-')
              if (e1>-1 && e2>-1){
                if (e2-e1 == 4) {
                  cursorposition = cursorposition - 1
                }
              }
            } else if (cursorposition == 9) {
              cursorposition = cursorposition + 4
            } else if (cursorposition < 11) {
              cursorposition = cursorposition + 3
            } else if (cursorposition == 11) {
              cursorposition = cursorposition + 1
            } else if (cursorposition == 12) {
              cursorposition = cursorposition + 1
            } else if (cursorposition >= 13) {
              cursorposition = cursorposition
            }

            var txtRange = object.createTextRange();
            txtRange.moveStart( "character", cursorposition);
            txtRange.moveEnd( "character", cursorposition - object.value.length);
            txtRange.select();
          }

        }

        function ParseChar(sStr, sChar)
        {

          if (sChar.length == null) 
          {
            zChar = new Array(sChar);
          }
            else zChar = sChar;

          for (i=0; i<zChar.length; i++)
          {
            sNewStr = "";

            var iStart = 0;
            var iEnd = sStr.indexOf(sChar[i]);

            while (iEnd != -1)
            {
              sNewStr += sStr.substring(iStart, iEnd);
              iStart = iEnd + 1;
              iEnd = sStr.indexOf(sChar[i], iStart);
            }
            sNewStr += sStr.substring(sStr.lastIndexOf(sChar[i]) + 1, sStr.length);

            sStr = sNewStr;
          }

          return sNewStr;
        }



	function onlyNumbers() 
		{
		var e = event || evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
			if ( (charCode < 48 || charCode > 57) && charCode != 46 && charCode != 44 ) 
			return false;
		return true;
	}
	function KeyCheck(myfield,e)
	{
		var keycode;
		if (window.event) keycode = window.event.keyCode;
		else if (e) keycode = e.which;
		else return true;
		if (((keycode>47) && (keycode<58) )  || (keycode==8) || (keycode==32) || (keycode==45)) { return true; }
		else return false;
	}

	strMessage ='Please correct the following problems!\n\n';
	iErrorCount =0;
	var blnValid = true;
	var errorColor = "#ffcccc";
	var backColor = "#ffffff";
	// Support Functions
	
	function stringFilter (input) 
	{
		s = input.value;
		filteredValues = "-";     // Characters stripped out
		var i;
		var returnString = "";
		for (i = 0; i < s.length; i++) {  // Search through string and append to unfiltered values to returnString.
			var c = s.charAt(i);
			if (filteredValues.indexOf(c) == -1) returnString += c;
			}
		input.value = returnString;
	}

	function strip(filter,str){
		var i,curChar;
		var retStr = '';
		var len = str.length;
		for(i=0; i<len; i++){
			curChar = str.charAt(i);
			if(filter.indexOf(curChar)<0) //not in filter, keep it
				retStr += curChar;
		}
		return retStr;
	}
	
	function reformat(str){
		var arg;
		var pos = 0;
		var retStr = '';
		var len = reformat.arguments.length;
		for(var i=1; i<len; i++){
			arg = reformat.arguments[i];
			if(i%2==1)
				retStr += arg;
			else{
				retStr += str.substring(pos, pos + arg);
				pos += arg;
			}
		}
		return retStr;
	}
	
	function notEmpty(str){
		if(strip(" \n\r\t",str).length ==0)
			return false;
		else
			return true;
	}
	
	function validateInteger(str){
		str = strip(' ',str);
		//remove leading zeros, if any
		while(str.length > 1 && str.substring(0,1) == '0'){
			str = str.substring(1,str.length);
		}
		var val = parseInt(str);
		if(isNaN(val))
			return false;
		else
			return true;
	}
	
	function validateZip(str){
		str = strip("- \n\r\t",str);
		if(validateInteger(str)&&(str.length==9 || str.length==5))
			return true;
		else
			return false;
	}
	
	function validateEMail(str){
		str = strip(" \n\r\t",str);
		if(str.indexOf("@")>-1 && str.indexOf(".")>-1)
			return true;
		else
			return false;
	}
	
	function formatZip(str){
		str = strip("- \n\r\t",str);
		if(str.length==5)
			return str;
		if(str.length==9)
			return reformat(str,"",5,"-",4);
	}


	/*================================================================================================
	
	This routine checks the credit card number. The following checks are made:
	
	1. A number has been provided
	2. The number is a right length for the card
	3. The number has an appropriate prefix for the card
	4. The number has a valid modulus 10 number check digit if required
	
	If the validation fails an error is reported.
	
	The structure of credit card formats was gleaned from a variety of sources on the web, although the 
	best is probably on Wikepedia ("Credit card number"):
	
	  http://en.wikipedia.org/wiki/Credit_card_number
	
	Parameters:
				cardnumber           number on the card
				cardname             name of card as defined in the card list below
	
	Author:     John Gardner
	Date:       1st November 2003
	Updated:    26th Feb. 2005      Additional cards added by request
	Updated:    27th Nov. 2006      Additional cards added from Wikipedia
	Updated:    18th Jan. 2008      Additional cards added from Wikipedia
	Updated:    26th Nov. 2008      Maestro cards extended
	Updated:    19th Jun. 2009      Laser cards extended from Wikipedia
	Updated:    11th Sep. 2010      Typos removed from Diners and Solo definitions (thanks to Noe Leon)
	
	*/
	
	/*
	   If a credit card number is invalid, an error reason is loaded into the global ccErrorNo variable. 
	   This can be be used to index into the global error  string array to report the reason to the user 
	   if required:
	   
	   e.g. if (!checkCreditCard (number, name) alert (ccErrors(ccErrorNo);
	*/
	
	var ccErrorNo = 0;
	var ccErrors = new Array ()
	
	ccErrors [0] = "Unknown card type";
	ccErrors [1] = "No card number provided";
	ccErrors [2] = "Credit card number is in invalid format";
	ccErrors [3] = "Credit card number is invalid";
	ccErrors [4] = "Credit card number has an inappropriate number of digits";
	
	function checkCreditCard (cardnumber, cardname) {
	  // Array to hold the permitted card characteristics
	  var cards = new Array();
	
	  // Define the cards we support. You may add addtional card types as follows.
	  
	  //  Name:         As in the selection box of the form - must be same as user's
	  //  Length:       List of possible valid lengths of the card number for the card
	  //  prefixes:     List of possible prefixes for the card
	  //  checkdigit:   Boolean to say whether there is a check digit
	  
	  cards [0] = {name: "Visa", 
				   length: "13,16", 
				   prefixes: "4",
				   checkdigit: true};
	  cards [1] = {name: "MasterCard", 
				   length: "16", 
				   prefixes: "51,52,53,54,55",
				   checkdigit: true};
	  cards [2] = {name: "DinersClub", 
				   length: "14,16", 
				   prefixes: "305,36,38,54,55",
				   checkdigit: true};
	  cards [3] = {name: "CarteBlanche", 
				   length: "14", 
				   prefixes: "300,301,302,303,304,305",
				   checkdigit: true};
	  cards [4] = {name: "AmEx", 
				   length: "15", 
				   prefixes: "34,37",
				   checkdigit: true};
	  cards [5] = {name: "Discover", 
				   length: "16", 
				   prefixes: "6011,622,64,65",
				   checkdigit: true};
	  cards [6] = {name: "JCB", 
				   length: "16", 
				   prefixes: "35",
				   checkdigit: true};
	  cards [7] = {name: "enRoute", 
				   length: "15", 
				   prefixes: "2014,2149",
				   checkdigit: true};
	  cards [8] = {name: "Solo", 
				   length: "16,18,19", 
				   prefixes: "6334,6767",
				   checkdigit: true};
	  cards [9] = {name: "Switch", 
				   length: "16,18,19", 
				   prefixes: "4903,4905,4911,4936,564182,633110,6333,6759",
				   checkdigit: true};
	  cards [10] = {name: "Maestro", 
				   length: "12,13,14,15,16,18,19", 
				   prefixes: "5018,5020,5038,6304,6759,6761",
				   checkdigit: true};
	  cards [11] = {name: "VisaElectron", 
				   length: "16", 
				   prefixes: "417500,4917,4913,4508,4844",
				   checkdigit: true};
	  cards [12] = {name: "LaserCard", 
				   length: "16,17,18,19", 
				   prefixes: "6304,6706,6771,6709",
				   checkdigit: true};
				   
	  // Establish card type
	  var cardType = -1;
	  for (var i=0; i<cards.length; i++) {
	
		// See if it is this card (ignoring the case of the string)
		if (cardname.toLowerCase () == cards[i].name.toLowerCase()) {
		  cardType = i;
		  break;
		}
	  }
	  
	  // If card type not found, report an error
	  if (cardType == -1) {
		 ccErrorNo = 0;
		 return false; 
	  }
	   
	  // Ensure that the user has provided a credit card number
	  if (cardnumber.length == 0)  {
		 ccErrorNo = 1;
		 return false; 
	  }
		
	  // Now remove any spaces from the credit card number
	  cardnumber = cardnumber.replace (/\s/g, "");
	  
	  // Check that the number is numeric
	  var cardNo = cardnumber
	  var cardexp = /^[0-9]{13,19}$/;
	  if (!cardexp.exec(cardNo))  {
		 ccErrorNo = 2;
		 return false; 
	  }
		   
	  // Now check the modulus 10 check digit - if required
	  if (cards[cardType].checkdigit) {
		var checksum = 0;                                  // running checksum total
		var mychar = "";                                   // next char to process
		var j = 1;                                         // takes value of 1 or 2
	  
		// Process each digit one by one starting at the right
		var calc;
		for (i = cardNo.length - 1; i >= 0; i--) {
		
		  // Extract the next digit and multiply by 1 or 2 on alternative digits.
		  calc = Number(cardNo.charAt(i)) * j;
		
		  // If the result is in two digits add 1 to the checksum total
		  if (calc > 9) {
			checksum = checksum + 1;
			calc = calc - 10;
		  }
		
		  // Add the units element to the checksum total
		  checksum = checksum + calc;
		
		  // Switch the value of j
		  if (j ==1) {j = 2} else {j = 1};
		} 
	  
		// All done - if checksum is divisible by 10, it is a valid modulus 10.
		// If not, report an error.
		if (checksum % 10 != 0)  {
		 ccErrorNo = 3;
		 return false; 
		}
	  }  
	
	  // The following are the card-specific checks we undertake.
	  var LengthValid = false;
	  var PrefixValid = false; 
	  var undefined; 
	
	  // We use these for holding the valid lengths and prefixes of a card type
	  var prefix = new Array ();
	  var lengths = new Array ();
		
	  // Load an array with the valid prefixes for this card
	  prefix = cards[cardType].prefixes.split(",");
		  
	  // Now see if any of them match what we have in the card number
	  for (i=0; i<prefix.length; i++) {
		var exp = new RegExp ("^" + prefix[i]);
		if (exp.test (cardNo)) PrefixValid = true;
	  }
		  
	  // If it isn't a valid prefix there's no point at looking at the length
	  if (!PrefixValid) {
		 ccErrorNo = 3;
		 return false; 
	  }
		
	  // See if the length is valid for this card
	  lengths = cards[cardType].length.split(",");
	  for (j=0; j<lengths.length; j++) {
		if (cardNo.length == lengths[j]) LengthValid = true;
	  }
	  
	  // See if all is OK by seeing if the length was valid. We only check the length if all else was 
	  // hunky dory.
	  if (!LengthValid) {
		 ccErrorNo = 4;
		 return false; 
	  };   
	  
	  // The credit card is in the required format.
	  return true;
	}




function validateForm(theForm){
		var sPath = window.location.pathname;
		var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
		var d = new Date();
		var curYear = (d.getFullYear()+'').match(/\d{2}$/);
		
		//var curMonth = parseInt(('0'+(d.getMonth()+1)).slice(-2)); 
		var curMonth = (d.getMonth() + 1);
		strMessage ='The following items are required.\n\n';
//= BEGIN VALIDATION - HOME PAGE ================================================================
	if(sPage == 'troop2troop.php') {
//=	FIRST NAME ==================================================================================
		if(notEmpty(document.getElementById('t2tFName').value)==false){
			strMessage = strMessage +"First name\n";
			if(iErrorCount ==0){
				document.getElementById('t2tFName').focus();
				document.getElementById('t2tFName').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tFName').style.background = backColor;
		}
//=	LAST NAME ===================================================================================
		if(notEmpty(document.getElementById('t2tLName').value)==false){
			strMessage = strMessage +"Last name\n";
			if(iErrorCount ==0){
				document.getElementById('t2tLName').focus();
				document.getElementById('t2tLName').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tLName').style.background = backColor;
		}
//=	ADDRESS =====================================================================================
		if(notEmpty(document.getElementById('t2tAddress').value)==false){
			strMessage = strMessage +"Address\n";
			if(iErrorCount ==0){
				document.getElementById('t2tAddress').focus();
				document.getElementById('t2tAddress').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tAddress').style.background = backColor;
		}
//=	CITY ========================================================================================
		if(notEmpty(document.getElementById('t2tCity').value)==false){
			strMessage = strMessage +"City\n";
			if(iErrorCount ==0){
				document.getElementById('t2tCity').focus();
				document.getElementById('t2tCity').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tCity').style.background = backColor;
		}

//=	STATE =======================================================================================
		if(document.getElementById('t2tState').options[document.getElementById('t2tState').selectedIndex].value == ""){
			   strMessage = strMessage +"State\n" ;
				if(iErrorCount ==0){
					document.getElementById('t2tState').focus();
					document.getElementById('t2tState').style.background = errorColor;
				}
				iErrorCount ++;
		} else {
			document.getElementById('t2tState').style.background = backColor;			
		}
//=	ZIP =========================================================================================
		if(notEmpty(document.getElementById('t2tZip').value)==false){
			strMessage = strMessage +"Zip code\n";
			if(iErrorCount ==0){
				document.getElementById('t2tZip').focus();
				document.getElementById('t2tZip').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tZip').style.background = backColor;
		}
//=	PHONE =======================================================================================
		if(notEmpty(document.getElementById('t2tPhone').value)==false){
			strMessage = strMessage +"Phone number\n";
			if(iErrorCount ==0){
				document.getElementById('t2tPhone').focus();
				document.getElementById('t2tPhone').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tPhone').style.background = backColor;
		}
//=	EMAIL ADDRESS ===============================================================================
		if(notEmpty(document.getElementById('t2tEmail').value)==false){
				strMessage = strMessage +"E-mail address\n" ;
				if(iErrorCount ==0){
					document.getElementById('t2tEmail').focus();
					document.getElementById('t2tEmail').style.background = errorColor;
				}
				iErrorCount ++;
		}
		else if(validateEMail(document.getElementById('t2tEmail').value)==false) {
			strMessage = strMessage + "A valid e-mail address\n";
			if(iErrorCount == 0){
				document.getElementById('t2tEmail').focus();
				document.getElementById('t2tEmail').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('t2tEmail').style.background = backColor;
		}
//=	DONATION AMOUNT =============================================================================
		if(document.getElementById('t2tDonationAmount').options[document.getElementById('t2tDonationAmount').selectedIndex].value == ""){
			   strMessage = strMessage +"A donation amount from the list\n" ;
				if(iErrorCount ==0){
					document.getElementById('t2tDonationAmount').focus();
					document.getElementById('t2tDonationAmount').style.background = errorColor;
				}
				iErrorCount ++;
		} else {
			document.getElementById('t2tDonationAmount').style.background = backColor;			
		}		
//=	TROOP REFERRAL TEMP ==============================================================================
//			if(document.getElementById('t2tGSRefer').checked == true) {
//				if(notEmpty(document.getElementById('t2tReferringTroop').value)==false){
//					strMessage = strMessage +"The referring troop number.\n";
//					if(iErrorCount ==0){
//						document.getElementById('t2tReferringTroop').focus();
//						document.getElementById('t2tReferringTroop').style.background = errorColor;
//					}
//					iErrorCount ++;
//				} else {
//					document.getElementById('t2tReferringTroop').style.background = backColor;
//				}
//			}

//=	TROOP REFERRAL ==============================================================================
		if(document.getElementById('t2tGSRefer').checked == true) {
			if(document.getElementById('t2tReferringTroop').options[document.getElementById('t2tReferringTroop').selectedIndex].value == ""){
			   strMessage = strMessage +"The referring troop number.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tReferringTroop').focus();
					document.getElementById('t2tReferringTroop').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tReferringTroop').style.background = backColor;		
			}
			if(notEmpty(document.getElementById('t2tReferringScout').value)==false){
				strMessage = strMessage +"The name of the Girl Scout that referred you.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tReferringScout').focus();
					document.getElementById('t2tReferringScout').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tReferringScout').style.background = backColor;
			}
		}				
//= END VALIDATION - HOME PAGE ==================================================================
//= BEGIN VALIDATION - BILLING PAGE =============================================================
	} else if(sPage == 't2tBilling.php') { 
//***********************************************************************************************
//= ORDER BILLING PAGE 																			*
//***********************************************************************************************
//=	CC NAME =====================================================================================
		if(notEmpty(document.getElementById('ccName').value)==false){
		strMessage = strMessage +"The cardholder name as it appears on the card.\n";
		if(iErrorCount ==0){
		document.getElementById('ccName').focus();
		document.getElementById('ccName').style.background = errorColor;
		}
		iErrorCount ++;
		} else {
		document.getElementById('ccName').style.background = backColor;
		}
//=	CC ADDRESS ==================================================================================
		if(notEmpty(document.getElementById('ccAddress').value)==false){
		strMessage = strMessage +"The billing address for the card.\n";
		if(iErrorCount ==0){
		document.getElementById('ccAddress').focus();
		document.getElementById('ccAddress').style.background = errorColor;
		}
		iErrorCount ++;
		} else {
		document.getElementById('ccAddress').style.background = backColor;
		}
//=	CC CITY =====================================================================================
		if(notEmpty(document.getElementById('ccCity').value)==false){
		strMessage = strMessage +"The billing city for the card.\n";
		if(iErrorCount ==0){
		document.getElementById('ccCity').focus();
		document.getElementById('ccCity').style.background = errorColor;
		}
		iErrorCount ++;
		} else {
		document.getElementById('ccCity').style.background = backColor;
		}
//=	CC STATE ====================================================================================
		if(document.getElementById('ccState').options[document.getElementById('ccState').selectedIndex].value == ""){
		strMessage = strMessage +"State for the billing address.\n" ;
		if(iErrorCount ==0){
		document.getElementById('ccState').focus();
		document.getElementById('ccState').style.background = errorColor;
		}
		iErrorCount ++;
		} else {
		document.getElementById('ccState').style.background = backColor;			
		}
//=	CC ZIP ======================================================================================
		if(notEmpty(document.getElementById('ccZip').value)==false){
			strMessage = strMessage +"The billing zip code for the card.\n";
			if(iErrorCount ==0){
				document.getElementById('ccZip').focus();
				document.getElementById('ccZip').style.background = errorColor;
			}
			iErrorCount ++;
			} else {
			document.getElementById('ccZip').style.background = backColor;
		}
//=	CC EMAIL ADDRESS ============================================================================
		if(notEmpty(document.getElementById('ccEmail').value)==false){
			strMessage = strMessage +"Please enter your e-mail address.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccEmail').focus();
				document.getElementById('ccEmail').style.background = errorColor;
			}
			iErrorCount ++;
			} else if(validateEMail(document.getElementById('ccEmail').value)==false) {
				strMessage = strMessage + "Please enter a valid e-mail address.\n";
				if(iErrorCount == 0){
					document.getElementById('ccEmail').focus();
					document.getElementById('ccEmail').style.background = errorColor;
				}
			iErrorCount ++;
			} else {
			document.getElementById('ccEmail').style.background = backColor;
		}
//= CREDIT CARD VALIDATION ==========================================================================
		if((document.getElementById('ccTypeVisa').checked==false) && (document.getElementById('ccTypeMC').checked==false) && (document.getElementById('ccTypeAmex').checked==false) && (document.getElementById('ccTypeDisc').checked==false)) {
			strMessage = strMessage + "Select a credit card type.\n";
			if(iErrorCount == 0){
				document.getElementById('ccTypeVisa').focus();
				document.getElementById('ccTypeVisa').style.background = errorColor;
				document.getElementById('ccTypeMC').style.background = errorColor;
				document.getElementById('ccTypeAmex').style.background = errorColor;
				document.getElementById('ccTypeDisc').style.background = errorColor;
			}
			iErrorCount ++;
			} else {
				document.getElementById('ccTypeVisa').style.background = backColor;
				document.getElementById('ccTypeMC').style.background = backColor;
				document.getElementById('ccTypeAmex').style.background = backColor;
				document.getElementById('ccTypeDisc').style.background = backColor;
			}
			
			if(notEmpty(document.getElementById('ccNum').value)==false){
				strMessage = strMessage +"Enter your credit card number.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccNum').focus();
				document.getElementById('ccNum').style.background = errorColor;
			}
		iErrorCount ++;
//= VALIDATE THE INCOMING CARD NUMBER AGAINST THE SELECTED CREDIT CARD TYPE ================================
//= VISA ===================================================================================================
		} else if(document.getElementById('ccTypeVisa').checked ==true) {
			if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeVisa').value)==false) {
				strMessage = strMessage + "Card number is not a valid Visa card number.\n";
				if(iErrorCount ==0){
					document.getElementById('ccNum').focus();
					document.getElementById('ccNum').style.background = errorColor;
				}
			iErrorCount ++;
			}else {
			document.getElementById('ccNum').style.background = backColor;			
		}
//= MASTERCARD ====================================================================================
		} else if(document.getElementById('ccTypeMC').checked == true) {
			if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeMC').value)==false) {
				strMessage = strMessage + "Card number is not a valid MasterCard card number.\n";
				if(iErrorCount ==0){
					document.getElementById('ccNum').focus();
					document.getElementById('ccNum').style.background = errorColor;
			}
			iErrorCount ++;
			}else {
			document.getElementById('ccNum').style.background = backColor;			
		}
//= AMERICAN EXPRESS ==============================================================================
		} else if(document.getElementById('ccTypeAmex').checked ==true) {
			if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeAmex').value)==false) {
				strMessage = strMessage + "Card number is not a valid American Express card number.\n";
				if(iErrorCount ==0){
					document.getElementById('ccNum').focus();
					document.getElementById('ccNum').style.background = errorColor;
				}
				iErrorCount ++;
			}else {
			document.getElementById('ccNum').style.background = backColor;			
		}
//= DISCOVER =====================================================================================
		} else if(document.getElementById('ccTypeDisc').checked ==true) {
			if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeDisc').value)==false) {
				strMessage = strMessage + "Card number is not a valid Discover card number.\n";
				if(iErrorCount ==0){
					document.getElementById('ccNum').focus();
					document.getElementById('ccNum').style.background = errorColor;
				}
					iErrorCount ++;
				}else {
				document.getElementById('ccNum').style.background = backColor;			
				}
			} else {
				document.getElementById('ccNum').style.background = backColor;			
		}
//= VALIDATE THE EXPIRATION MONTH OF THE CREDIT CARD ==============================================
		if(document.getElementById('ccMonth').options[document.getElementById('ccMonth').selectedIndex].value == ""){
			strMessage = strMessage +"Select the expiration month from the list.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccMonth').focus();
				document.getElementById('ccMonth').style.background = errorColor;
			}
				iErrorCount ++;
			} else {
			document.getElementById('ccMonth').style.background = backColor;			
		}
//= VALIDATE THE EXPIRATION YEAR ==================================================================		
		if(document.getElementById('ccYear').options[document.getElementById('ccYear').selectedIndex].value == ""){
			strMessage = strMessage +"Select the expiration year from the list.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccYear').focus();
				document.getElementById('ccYear').style.background = errorColor;
			}
			iErrorCount ++;
			} else {
				document.getElementById('ccYear').style.background = backColor;			
		}
//= VALIDATE THE EXPIRATION MONTH AND YEAR TO SEE IF DATE IS BEFORE CURRENT DATE ==================
		if ((document.getElementById('ccMonth').options[document.getElementById('ccMonth').selectedIndex].value<curMonth) && (document.getElementById('ccYear').options[document.getElementById('ccYear').selectedIndex].value == curYear)) {
			strMessage = strMessage +"The expiration month selected is before the current month.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccMonth').focus();
				document.getElementById('ccMonth').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('ccMonth').style.background = backColor;			
		}
//= VALIDATE THE CVV2 CODE =======================================================================
		if(notEmpty(document.getElementById('ccCVV2').value)==false){
			strMessage = strMessage +"Enter your cards 3-digit security code.\n" ;
			if(iErrorCount ==0){
				document.getElementById('ccCVV2').focus();
				document.getElementById('ccCVV2').style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			document.getElementById('ccCVV2').style.background = backColor;
		}
//= END VALIDATION - BILLING PAGE ===============================================================
//= BEGIN VALIDATION - REVIEW PAGE ==============================================================
		} else if (sPage == 't2tReview.php') {
//***********************************************************************************************
//= ORDER REVIEW PAGE 																			*
//***********************************************************************************************
//=	FIRST NAME ==================================================================================
			if(notEmpty(document.getElementById('t2tFNameTemp').value)==false){
				strMessage = strMessage +"Please enter your first name.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tFNameTemp').focus();
					document.getElementById('t2tFNameTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tFNameTemp').style.background = backColor;
			}
//=	LAST NAME ===================================================================================
			if(notEmpty(document.getElementById('t2tLNameTemp').value)==false){
				strMessage = strMessage +"Please enter your last name.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tLNameTemp').focus();
					document.getElementById('t2tLNameTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tLNameTemp').style.background = backColor;
			}
//=	ADDRESS =====================================================================================
			if(notEmpty(document.getElementById('t2tAddressTemp').value)==false){
				strMessage = strMessage +"Please enter your address.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tAddressTemp').focus();
					document.getElementById('t2tAddressTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tAddressTemp').style.background = backColor;
			}
//=	CITY ========================================================================================
			if(notEmpty(document.getElementById('t2tCityTemp').value)==false){
				strMessage = strMessage +"Please enter your city.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tCityTemp').focus();
					document.getElementById('t2tCityTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tCityTemp').style.background = backColor;
			}
//=	STATE =================================/======================================================
			if(document.getElementById('t2tStateTemp').options[document.getElementById('t2tStateTemp').selectedIndex].value == ""){
				   strMessage = strMessage +"Please select your state from the list.\n" ;
					if(iErrorCount ==0){
						document.getElementById('t2tStateTemp').focus();
						document.getElementById('t2tStateTemp').style.background = errorColor;
					}
					iErrorCount ++;
			} else {
				document.getElementById('t2tStateTemp').style.background = backColor;			
			}
//=	ZIP =========================================================================================
			if(notEmpty(document.getElementById('t2tZipTemp').value)==false){
				strMessage = strMessage +"Please enter your zip code.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tZipTemp').focus();
					document.getElementById('t2tZipTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tZipTemp').style.background = backColor;
			}
//=	PHONE =======================================================================================
			if(notEmpty(document.getElementById('t2tPhoneTemp').value)==false){
				strMessage = strMessage +"Please enter your phone number.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tPhoneTemp').focus();
					document.getElementById('t2tPhoneTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tPhoneTemp').style.background = backColor;
			}
//=	EMAIL ADDRESS ===============================================================================
			if(notEmpty(document.getElementById('t2tEmailTemp').value)==false){
					strMessage = strMessage +"Please enter your e-mail address.\n" ;
					if(iErrorCount ==0){
						document.getElementById('t2tEmailTemp').focus();
						document.getElementById('t2tEmailTemp').style.background = errorColor;
					}
					iErrorCount ++;
			}
			else if(validateEMail(document.getElementById('t2tEmailTemp').value)==false) {
				strMessage = strMessage + "Please enter a valid e-mail address.\n";
				if(iErrorCount == 0){
					document.getElementById('t2tEmailTemp').focus();
					document.getElementById('t2tEmailTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tEmailTemp').style.background = backColor;
			}
//=	DONATION AMOUNT =============================================================================
			if(document.getElementById('t2tDonationAmountTemp').options[document.getElementById('t2tDonationAmountTemp').selectedIndex].value == ""){
				   strMessage = strMessage +"Please select your donation from the list.\n" ;
					if(iErrorCount ==0){
						document.getElementById('t2tDonationAmountTemp').focus();
						document.getElementById('t2tDonationAmountTemp').style.background = errorColor;
					}
					iErrorCount ++;
			} else {
				document.getElementById('t2tDonationAmountTemp').style.background = backColor;			
			}		

//=	TROOP REFERRAL TEMP ==============================================================================
//	if(document.getElementById('t2tGSReferTemp').checked == true) {
//				if(notEmpty(document.getElementById('t2tReferringTroopTemp').value)==false){
//					strMessage = strMessage +"The referring troop number.\n";
//					if(iErrorCount ==0){
//						document.getElementById('t2tReferringTroopTemp').focus();
//						document.getElementById('t2tReferringTroopTemp').style.background = errorColor;
//					}
//					iErrorCount ++;
//				} else {
//					document.getElementById('t2tReferringTroopTemp').style.background = backColor;
//				}
//			}

//=	TROOP REFERRAL ==============================================================================
		if(document.getElementById('t2tGSReferTemp').checked == true) {
			if(document.getElementById('t2tReferringTroopTemp').options[document.getElementById('t2tReferringTroopTemp').selectedIndex].value == ""){
			   strMessage = strMessage +"The referring troop number.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tReferringTroopTemp').focus();
					document.getElementById('t2tReferringTroopTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tReferringTroopTemp').style.background = backColor;		
			}
			if(notEmpty(document.getElementById('t2tReferringScoutTemp').value)==false){
				strMessage = strMessage +"The name of the Girl Scout that referred you.\n";
				if(iErrorCount ==0){
					document.getElementById('t2tReferringScoutTemp').focus();
					document.getElementById('t2tReferringScoutTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('t2tReferringScoutTemp').style.background = backColor;
			}
		}				



//=	CC NAME =====================================================================================
			if(notEmpty(document.getElementById('ccNameTemp').value)==false){
				strMessage = strMessage +"The cardholder name as it appears on the card.\n";
				if(iErrorCount ==0){
					document.getElementById('ccNameTemp').focus();
					document.getElementById('ccNameTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
			document.getElementById('ccNameTemp').style.background = backColor;
			}
//=	CC ADDRESS ==================================================================================
			if(notEmpty(document.getElementById('ccAddressTemp').value)==false){
				strMessage = strMessage +"The billing address for the card.\n";
				if(iErrorCount ==0){
					document.getElementById('ccAddressTemp').focus();
					document.getElementById('ccAddressTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
			document.getElementById('ccAddressTemp').style.background = backColor;
			}
//=	CC CITY =====================================================================================
			if(notEmpty(document.getElementById('ccCityTemp').value)==false){
				strMessage = strMessage +"The billing city for the card.\n";
				if(iErrorCount ==0){
					document.getElementById('ccCityTemp').focus();
					document.getElementById('ccCityTemp').style.background = errorColor;
				}
				iErrorCount ++;
				} else {
				document.getElementById('ccCityTemp').style.background = backColor;
			}
//=	CC STATE ====================================================================================
			if(document.getElementById('ccStateTemp').options[document.getElementById('ccStateTemp').selectedIndex].value == ""){
				strMessage = strMessage +"State for the billing address.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccStateTemp').focus();
					document.getElementById('ccStateTemp').style.background = errorColor;
				}
				iErrorCount ++;
				} else {
				document.getElementById('ccStateTemp').style.background = backColor;			
			}
//=	CC ZIP ======================================================================================
			if(notEmpty(document.getElementById('ccZipTemp').value)==false){
				strMessage = strMessage +"The billing zip code for the card.\n";
				if(iErrorCount ==0){
					document.getElementById('ccZipTemp').focus();
					document.getElementById('ccZipTemp').style.background = errorColor;
				}
				iErrorCount ++;
				} else {
				document.getElementById('ccZipTemp').style.background = backColor;
			}
//=	CC EMAIL ADDRESS ============================================================================
			if(notEmpty(document.getElementById('ccEmailTemp').value)==false){
				strMessage = strMessage +"Please enter the e-mail address associated with the card.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccEmailTemp').focus();
					document.getElementById('ccEmailTemp').style.background = errorColor;
				}
				iErrorCount ++;
				} else if(validateEMail(document.getElementById('ccEmailTemp').value)==false) {
					strMessage = strMessage + "Please enter a valid e-mail address.\n";
					if(iErrorCount == 0){
						document.getElementById('ccEmailTemp').focus();
						document.getElementById('ccEmailTemp').style.background = errorColor;
					}
				iErrorCount ++;
				} else {
				document.getElementById('ccEmailTemp').style.background = backColor;
			}
//= CREDIT CARD VALIDATION ==========================================================================
			if((document.getElementById('ccTypeTempVisa').checked==false) && (document.getElementById('ccTypeTempMC').checked==false) && (document.getElementById('ccTypeTempAmex').checked==false) && (document.getElementById('ccTypeTempDisc').checked==false)) {
				strMessage = strMessage + "Select a credit card type.\n";
				if(iErrorCount == 0){
					document.getElementById('ccTypeTempVisa').focus();
					document.getElementById('ccTypeTempVisa').style.background = errorColor;
					document.getElementById('ccTypeTempMC').style.background = errorColor;
					document.getElementById('ccTypeTempAmex').style.background = errorColor;
					document.getElementById('ccTypeTempDisc').style.background = errorColor;
				}
				iErrorCount ++;
				} else {
					document.getElementById('ccTypeTempVisa').style.background = backColor;
					document.getElementById('ccTypeTempMC').style.background = backColor;
					document.getElementById('ccTypeTempAmex').style.background = backColor;
					document.getElementById('ccTypeTempDisc').style.background = backColor;
				}
//= ENSURE THE CREDIT CARD FIELD IS NOT BLANK ==============================================================
				if(notEmpty(document.getElementById('ccNumTemp').value)==false){
					strMessage = strMessage +"Enter your credit card number.\n" ;
					if(iErrorCount ==0){
						document.getElementById('ccNumTemp').focus();
						document.getElementById('ccNumTemp').style.background = errorColor;
					}
				iErrorCount ++;
			}
//= VALIDATE THE INCOMING CARD NUMBER AGAINST THE SELECTED CREDIT CARD TYPE ================================
//= VISA ===================================================================================================
			else if(document.getElementById('ccTypeTempVisa').checked==true) {
					if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeTempVisa').value)==false) {
						strMessage = strMessage + "Card number is not a valid Visa card number.\n";
						if(iErrorCount ==0){
							document.getElementById('ccNumTemp').focus();
							document.getElementById('ccNumTemp').style.background = errorColor;
						}
						iErrorCount ++;
					}else {
						document.getElementById('ccNumTemp').style.background = backColor;			
					}
//= MASTERCARD ====================================================================================
			} else if(document.getElementById('ccTypeTempMC').checked == true) {
				if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeTempMC').value)==false) {
					strMessage = strMessage + "Card number is not a valid MasterCard card number.\n";
					if(iErrorCount ==0){
						document.getElementById('ccNumTemp').focus();
						document.getElementById('ccNumTemp').style.background = errorColor;
					}
					iErrorCount ++;
				}else {
					document.getElementById('ccNumTemp').style.background = backColor;			
				}
//= AMERICAN EXPRESS ==============================================================================
			} else if(document.getElementById('ccTypeTempAmex').checked ==true) {
				if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeTempAmex').value)==false) {
					strMessage = strMessage + "Card number is not a valid American Express card number.\n";
					if(iErrorCount ==0){
						document.getElementById('ccNumTemp').focus();
						document.getElementById('ccNumTemp').style.background = errorColor;
					}
					iErrorCount ++;
				}else {
				document.getElementById('ccNumTemp').style.background = backColor;			
			}
//= DISCOVER =====================================================================================
			} else if(document.getElementById('ccTypeTempDisc').checked ==true) {
				if (checkCreditCard(document.getElementById('ccNum').value,document.getElementById('ccTypeTempDisc').value)==false) {
					strMessage = strMessage + "Card number is not a valid Discover card number.\n";
					if(iErrorCount ==0){
						document.getElementById('ccNumTemp').focus();
						document.getElementById('ccNumTemp').style.background = errorColor;
					}
					iErrorCount ++;
				}else {
					document.getElementById('ccNumTemp').style.background = backColor;			
				}
			
			}else {
			document.getElementById('ccNumTemp').style.background = backColor;	
			}
//= VALIDATE THE EXPIRATION MONTH OF THE CREDIT CARD ==============================================
			if(document.getElementById('ccMonthTemp').options[document.getElementById('ccMonthTemp').selectedIndex].value == ""){
				strMessage = strMessage +"Select the expiration month from the list.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccMonthTemp').focus();
					document.getElementById('ccMonthTemp').style.background = errorColor;
				}
					iErrorCount ++;
				} else {
				document.getElementById('ccMonthTemp').style.background = backColor;			
			}
//= VALIDATE THE EXPIRATION YEAR ==================================================================		
			if(document.getElementById('ccYearTemp').options[document.getElementById('ccYearTemp').selectedIndex].value == ""){
				strMessage = strMessage +"Select the expiration year from the list.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccYearTemp').focus();
					document.getElementById('ccYearTemp').style.background = errorColor;
				}
				iErrorCount ++;
				} else {
					document.getElementById('ccYearTemp').style.background = backColor;			
			}
//= VALIDATE THE EXPIRATION MONTH AND YEAR TO SEE IF DATE IS BEFORE CURRENT DATE ==================
			if ((document.getElementById('ccMonthTemp').options[document.getElementById('ccMonthTemp').selectedIndex].value<curMonth) && (document.getElementById('ccYearTemp').options[document.getElementById('ccYearTemp').selectedIndex].value == curYear)) {
				strMessage = strMessage +"The expiration month selected is before the current month.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccMonthTemp').focus();
					document.getElementById('ccMonthTemp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('ccMonthTemp').style.background = backColor;			
			}
//= VALIDATE THE CVV2 CODE =======================================================================
			if(notEmpty(document.getElementById('ccCVV2Temp').value)==false){
				strMessage = strMessage +"Enter your cards 3-digit security code.\n" ;
				if(iErrorCount ==0){
					document.getElementById('ccCVV2Temp').focus();
					document.getElementById('ccCVV2Temp').style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				document.getElementById('ccCVV2Temp').style.background = backColor;
			}
		}
//= END VALIDATION - REVIEW PAGE ================================================================

	if (iErrorCount > 0){
		alert(strMessage);
		strMessage ='';
		iErrorCount =0;
		return false;
	}else{
	}
}
//-->