<!--//

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

function id(el) {
  return document.getElementById(el);
}

function validateForm(theForm){
	strMessage ='Please correct the following:\n\n';
	var f = document.theForm;
//= BEGIN VALIDATION ============================================================================
//=	GIRL SCOUT FIRST NAME =======================================================================
	if(notEmpty(id('permGirlFName').value)==false){
		strMessage = strMessage +"The Girl Scout's first name is required.\n";
		if(iErrorCount ==0){
			id('permGirlFName').focus();
			id('permGirlFName').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permGirlFName').style.background = backColor;
	}
//=	GIRL SCOUT LAST NAME ========================================================================
	if(notEmpty(id('permGirlLName').value)==false){
		strMessage = strMessage +"The Girl Scout's last name is required.\n";
		if(iErrorCount ==0){
			id('permGirlLName').focus();
			id('permGirlLName').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permGirlLName').style.background = backColor;
	}
//=	TROOP NUMBER ================================================================================
	if(notEmpty(id('permGSTroop').value)==false){
		strMessage = strMessage +"Troop number is required.\n";
		if(iErrorCount ==0){
			id('permGSTroop').focus();
			id('permGSTroop').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permGSTroop').style.background = backColor;
	}
//=	SERVICE UNIT ================================================================================
	if(id('permSU').options[id('permSU').selectedIndex].value == ""){
		   strMessage = strMessage +"Service Unit is required.\n" ;
			if(iErrorCount ==0){
				id('permSU').focus();
				id('permSU').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permSU').style.background = backColor;			
	}
//=	EMAIL ADDRESS ===============================================================================
	if(notEmpty(id('permMyEmail').value)==false){
			strMessage = strMessage +"An email address is required.\n" ;
			if(iErrorCount ==0){
				id('permMyEmail').focus();
				id('permMyEmail').style.background = errorColor;
			}
			iErrorCount ++;
	}
	else if(validateEMail(id('permMyEmail').value)==false) {
		strMessage = strMessage + "A valid email address is required.\n";
		if(iErrorCount == 0){
			id('permMyEmail').focus();
			id('permMyEmail').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permMyEmail').style.background = backColor;
	}
//=	TCM EMAIL ADDRESS ===========================================================================
	if(notEmpty(id('permLeadEmail').value)==false){
			strMessage = strMessage +"An email address for the troop TCM is required.\n" ;
			if(iErrorCount ==0){
				id('permLeadEmail').focus();
				id('permLeadEmail').style.background = errorColor;
			}
			iErrorCount ++;
	}
	else if(validateEMail(id('permLeadEmail').value)==false) {
		strMessage = strMessage + "A valid email address for the troop TCM is required.\n";
		if(iErrorCount == 0){
			id('permLeadEmail').focus();
			document.getElementById('permLeadEmail').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permLeadEmail').style.background = backColor;
	}
//=	AGREE TO CONDITIONS =========================================================================
	for (var i=0;i<6;++i) {
		if(notEmpty(eval("id('perm'+(i+1))"+".value"))==false){
			strMessage = strMessage + "Please initial text box "+(i+1)+".\n";
			if(iErrorCount == 0) {
				id(['perm'+(i+1)]).focus();
				id(['perm'+(i+1)]).style.background = errorColor;
			}
			iErrorCount ++;
		} else if(i > 0) {
			if (eval("id('perm'+(i+1))"+".value") !=  id('perm1').value) {
				strMessage = strMessage + "Initials in text box "+(i+1)+" must match.\n";
				if(iErrorCount == 0) {
					id(['perm'+(i+1)]).value='';
					id(['perm'+(i+1)]).focus();
					id(['perm'+(i+1)]).style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				id(['perm'+(i+1)]).style.background = backColor;
			}
		} else {
			id(['perm'+(i+1)]).style.background = backColor;
		}
	}
//=	CHECK COOKIE CLUB PERMISSIION ===============================================================
	if((id('permCClubYes').checked == false) && (id('permCClubNo').checked == false)) {
		strMessage = strMessage + "Your Cookie Club participation preference is required.\n";
		if(iErrorCount == 0) {
			id('permCClubYes').focus();
			id('permCClubYes').style.background = errorColor;
		} else {
			id('permCClubYes').style.background = backColor;
		}
	}
//= IF COOKIE CLUB IS YES, MAKE SURE ALL BOXES HAVE BEEN INTIALIZED =============================
	if(id('permCClubYes').checked == true) {
		//strMessage = strMessage + "Yes to Cookie Club\n";
		for (var i=0;i<4;++i) {
			if(notEmpty(eval("id('permCC'+(i+1))"+".value"))==false){
				strMessage = strMessage + "Please initial Cookie Club text box "+(i+1)+".\n";
				if(iErrorCount == 0) {
					id(['perm'+(i+1)]).focus();
					id(['perm'+(i+1)]).style.background = errorColor;
				}
				iErrorCount ++;
			} else if(i > 0) {
				if (eval("id('permCC'+(i+1))"+".value") !=  id('perm1').value) {
					strMessage = strMessage + "Initials in Cookie Club text box "+(i+1)+" must match.\n";
					if(iErrorCount == 0) {
						id(['permCC'+(i+1)]).value='';
						id(['permCC'+(i+1)]).focus();
						id(['permCC'+(i+1)]).style.background = errorColor;
					}
					iErrorCount ++;
				} else {
					id(['permCC'+(i+1)]).style.background = backColor;
				}
			} else {
				id(['permCC'+(i+1)]).style.background = backColor;
			}
		}
	}

//=	PARENT FIRST NAME ===========================================================================
	if(notEmpty(id('permParentFName').value)==false){
			strMessage = strMessage +"The parent/guardian first name is required.\n" ;
			if(iErrorCount ==0){
				id('permParentFName').focus();
				id('permParentFName').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permParentFName').style.background = backColor;
	}
//=	PARENT LAST NAME ============================================================================
	if(notEmpty(id('permParentLName').value)==false){
			strMessage = strMessage +"The parent/guardian last name is required.\n" ;
			if(iErrorCount ==0){
				id('permParentLName').focus();
				id('permParentLName').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permParentLName').style.background = backColor;
	}

//=	ID TYPE =====================================================================================
	if(id('permIDType').options[id('permIDType').selectedIndex].value == ""){
		   strMessage = strMessage +"An ID type is required.\n" ;
			if(iErrorCount ==0){
				id('permIDType').focus();
				id('permIDType').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permIDType').style.background = backColor;			
	}
//=	ID NUMBER ===================================================================================
	if(notEmpty(id('permID').value)==false){
		if(id('permIDType').options[id('permIDType').selectedIndex].value == ""){
			strMessage = strMessage +"An identification number is required.\n" ;
		} else {
			strMessage = strMessage +"A "+ id('permIDType').options[id('permIDType').selectedIndex].value.toLowerCase() +" number is required.\n" ;
		}
		if(iErrorCount ==0){
			id('permID').focus();
			id('permID').style.background = errorColor;
		}
		iErrorCount ++;
	} else {
		id('permID').style.background = backColor;
	}
//=	HOME ADDRESS ================================================================================
	if(notEmpty(id('permHomeAddress').value)==false){
			strMessage = strMessage +"Home address is required.\n" ;
			if(iErrorCount ==0){
				id('permHomeAddress').focus();
				id('permHomeAddress').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permHomeAddress').style.background = backColor;
	}
//=	CITY ========================================================================================
	if(notEmpty(id('permCity').value)==false){
			strMessage = strMessage +"City is required.\n" ;
			if(iErrorCount ==0){
				id('permCity').focus();
				id('permCity').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permCity').style.background = backColor;
	}
//=	ZIP CODE ====================================================================================
	if(notEmpty(id('permZip').value)==false){
			strMessage = strMessage +"Zip code is required.\n" ;
			if(iErrorCount ==0){
				id('permZip').focus();
				id('permZip').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permZip').style.background = backColor;
	}
//=	HOME PHONE ==================================================================================
	if(notEmpty(id('permHomePhone').value)==false){
			strMessage = strMessage +"A home phone number is required.\n" ;
			if(iErrorCount ==0){
				id('permHomePhone').focus();
				id('permHomePhone').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permHomePhone').style.background = backColor;
	}
//////=	SELECT GRADE LEVEL ==========================================================================
////	if(document.theForm.permOption.checked==true){
////		if(document.theForm.permGradLevel.options[document.theForm.permGradLevel.selectedIndex].value == ""){
////			strMessage = strMessage +"Please select the grade level of the troop.\n" ;
////				if(iErrorCount ==0){
////					document.theForm.permGradLevel.focus();
////					document.theForm.permGradLevel.style.background = errorColor;
////				}
////				iErrorCount ++;
////		} else {
////			document.theForm.permGradLevel.style.background = backColor;			
////		}
////	}
//=	SIGNATURE ===================================================================================
	if(notEmpty(id('permSignedName').value)==false){
			strMessage = strMessage +"Acknowledgement of all terms and conditions is required.\n" ;
			if(iErrorCount ==0){
				id('permSignedName').focus();
				id('permSignedName').style.background = errorColor;
			}
			iErrorCount ++;
	} else {
		id('permSignedName').style.background = backColor;
	}


	if (iErrorCount > 0){
		alert(strMessage);
		strMessage ='';
		iErrorCount =0;
		return false;
	}else{
	}
}
//-->