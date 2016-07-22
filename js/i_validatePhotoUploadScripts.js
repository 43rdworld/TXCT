
	function KeyCheck(myfield,e)
	{
		var keycode;
		if (window.event) keycode = window.event.keyCode;
		else if (e) keycode = e.which;
		else return true;
		if (((keycode>47) && (keycode<58) )  || (keycode==45)) { return true; }
		else return false;
	}

	strMessage ='Please correct the following problems!\n\n';
	iErrorCount =0;
	var blnValid = true;
	var errorColor = "#ffecec";
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

	function hasExtension(inputID, exts) {
		var fileName = document.getElementById(inputID).value;
		return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
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

	function getCheckedRadio(rbg) {
	  var radioButtons = document.getElementsByName(rbg);
	  for (var x = 0; x < radioButtons.length; x ++) if (radioButtons[x].checked) return radioButtons[x].value;
	  return "";
	}

	// regular expression to match required date format (mm/dd/yyyy)
	re = /\d{1,2}\/\d{2}\/\d{4}$/;


	function validateForm(theForm){
		strMessage ='Please correct the following problem(s)!\n\n';
		var iErrorCount = 0;
		var f = document.theForm;
	//= BEGIN VALIDATION ===========================================================*/


	//= APPLICATION INFORMATION ====================================================*/
		if(notEmpty(f.photoUploadFName.value)==false){
			strMessage = strMessage +"Enter your first name.\n";
			if(iErrorCount ==0){
				f.photoUploadFName.focus();
				f.photoUploadFName.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadFName.style.background = backColor;
		}
		if(notEmpty(f.photoUploadLName.value)==false){
			strMessage = strMessage +"Enter your first name.\n";
			if(iErrorCount ==0){
				f.photoUploadLName.focus();
				f.photoUploadLName.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadLName.style.background = backColor;
		}
		if(f.photoUploadTroopNum.options[f.photoUploadTroopNum.selectedIndex].value == ""){
			strMessage = strMessage +"Select your troop number from the list.\n" ;
			if(iErrorCount ==0){
				f.photoUploadTroopNum.focus();
				f.photoUploadTroopNum.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadTroopNum.style.background = backColor;
		}
		if(notEmpty(f.photoUploadSU.value)==false){
			strMessage = strMessage +"Enter your service unit.\n";
			if(iErrorCount ==0){
				f.photoUploadSU.focus();
				f.photoUploadSU.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadSU.style.background = backColor;
		}
		if(notEmpty(f.photoUploadTroopLeaderFName.value)==false){
			strMessage = strMessage +"Enter the Troop Leader's first name.\n";
			if(iErrorCount ==0){
				f.photoUploadTroopLeaderFName.focus();
				f.photoUploadTroopLeaderFName.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadTroopLeaderFName.style.background = backColor;
		}
		if(notEmpty(f.photoUploadTroopLeaderLName.value)==false){
			strMessage = strMessage +"Enter the Troop Leader's last name.\n";
			if(iErrorCount ==0){
				f.photoUploadTroopLeaderLName.focus();
				f.photoUploadTroopLeaderLName.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadTroopLeaderLName.style.background = backColor;
		}
		if(notEmpty(f.photoUploadPhone.value)==false){
			strMessage = strMessage +"Enter your phone number.\n";
			if(iErrorCount ==0){
				f.photoUploadPhone.focus();
				f.photoUploadPhone.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadPhone.style.background = backColor;
		}

		if(notEmpty(f.photoUploadEmail.value) == false)
		{
			strMessage = strMessage +"Enter your email address.\n";
			if(iErrorCount ==0){
				f.photoUploadEmail.focus();
				f.photoUploadEmail.style.background = errorColor;
			}
			iErrorCount ++;
		} else if (validateEMail(f.photoUploadEmail.value) == false) {
			strMessage = strMessage + "Please enter a valid email address.\n";
			if(iErrorCount == 0){
				f.photoUploadEmail.focus();
				f.photoUploadEmail.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadEmail.style.background = backColor;
		}

		if(notEmpty(f.photoUploadNames.value) == false)
		{
			strMessage = strMessage +"Please name the people in the photo including their PGL or title.\n";
			if(iErrorCount ==0){
				f.photoUploadNames.focus();
				f.photoUploadNames.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			f.photoUploadNames.style.background = backColor;
		}
		if(f.photoUploadFile.value.length == 0)
		{
			strMessage = strMessage +"Please select a file to upload to the site.\n";
			if(iErrorCount ==0){
				f.photoUploadFile.focus();
				f.photoUploadFile.style.background = errorColor;
			}
			iErrorCount ++;
		} else {
			var uploadedFile = f.photoUploadFile;
			var fileName = uploadedFile.value;
			var fileSize = uploadedFile.files[0].size;
			if(fileSize > 15728640) {
				strMessage = strMessage + "File size is limited to 10Mb. Please select a smaller file";
				if (iErrorCount == 0) {
					f.photoUploadNames.focus();
					f.photoUploadNames.style.background = errorColor;
				}
				iErrorCount++;
			} else if (!hasExtension('photoUploadFile', ['.png', '.PNG','.gif', '.GIF','.jpg', '.JPG','.jpeg', '.JPEG','.pdf', '.PDF'])) {
				strMessage = strMessage + "The flyer template must be a .gif, .png, .jpg, .jpeg or .pdf file.\n";
				if(iErrorCount == 0){
					f.photoUploadFile.focus();
					f.photoUploadFile.style.background = errorColor;
				}
				iErrorCount ++;
			} else {
				f.photoUploadFile.style.background = backColor;
			}
		}


		if (iErrorCount > 0){
			alert(strMessage);
			strMessage ='';
			iErrorCount =0;
			return false;
		}else{
		}
	}
