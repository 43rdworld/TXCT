<?php
	if(ISSET($_REQUEST["conTitle"])) {
		$conTitle = stripslashes(trim(str_replace("'","",$_REQUEST["conTitle"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$conTitle))){
            echo "true";
        } else {
            echo "false";
        }
	} else if(ISSET($_REQUEST["conFName"])) {
		$conFName = stripslashes(str_replace("'","",$_REQUEST["conFName"]));
		$isValid = array('-','/',' ','\'');
		if (ctype_alpha(str_replace($isValid,'',$conFName)) && (strlen($conFName) <= 20)){
			echo "true";
		} else {
			echo "false";
		}
	} else if (ISSET($_REQUEST["conLName"])) {
		$conLName = stripslashes(str_replace("'","",$_REQUEST["conLName"]));
		$isValid = array('-','/',' ','\'');
		if (ctype_alpha(str_replace($isValid,'',$conLName)) && (strlen($conLName) <= 20)){
			echo 'true';
		} else {
			echo 'false';
	    }
	} else if (ISSET($_REQUEST["conAddress"])) {
		$conAddress = stripslashes(str_replace("'","",$_REQUEST["conAddress"]));
		$isValid = array('#','.',' ',',','/','-');
		if (ctype_alnum(str_replace($isValid,'',$conAddress))){
			echo "true";
		} else {
			echo "false";
		}
	} else if (ISSET($_REQUEST["conCity"])) {
		$conCity = stripslashes(str_replace("'","",$_REQUEST["conCity"]));;
		$isValid = array('.',' ',',','/','-');
		if (ctype_alnum(str_replace($isValid,'',$conCity))){
			echo "true";
		} else {
			echo "false";
		}
	} else if (ISSET($_REQUEST["conState"])) {
        $conState = $_REQUEST["conState"];
        if ((ctype_alpha($conState))&&(strlen($conState)==2)){
            echo "true";
        } else {
            echo "false";
        }
     } else if (ISSET($_REQUEST["conZip"])) {
        $conZip = $_REQUEST["conZip"];
        if ((ctype_alnum($conZip))&&!(strlen($conZip)>5)&& ($conZip != '')){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["conPhone"])) {
        $conPhone = $_REQUEST["conPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $conPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["conEmail"])) {
        $conEmail = $_REQUEST["conEmail"];
        $expr = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($expr, $conEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["conConfirmEmail"])) {
        $conConfirmEmail = $_REQUEST["conConfirmEmail"];
        //$expr = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $expr = '/^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$^/';     //= EXPRESSION TO ALLOW UPPER CASE IN EMAILS ===============
        if (preg_match($expr, $conConfirmEmail)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["tktTickets"])) {
        $tktTickets = $_REQUEST["tktTickets"];
        if ((ctype_alnum($tktTickets))&&(strlen($tktTickets)>=3)){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["tblNumTables"])) {
        $tblNumTables = $_REQUEST["tblNumTables"];
        if ((ctype_alnum($tblNumTables))&&($tblNumTables)>=1500){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["donateAmt"])) {
        $donateAmt = $_REQUEST["donateAmt"];
        if (($donateAmt!= 0) || ($donateAmt != '')){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["sponsorLevel"])) {
        $sponsorLevel = $_REQUEST["sponsorLevel"];
        if (strlen($sponsorLevel) >= 4){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["raffleTickets"])) {
//        $selectEvent = $_REQUEST["selectEvent"];
        $raffleTickets = $_REQUEST["raffleTickets"];
//        if($selectEvent == 'selectRaffle') {
            if ($raffleTickets != 0) {
                echo "true";
            } else {
                echo "false";
            }
//        }
// BILLING PAGE VALIDATIONS ==========================================================================================================================
    } else if(ISSET($_REQUEST["billingFName"])) {
        $billingFName = stripslashes(str_replace("'","",$_REQUEST["billingFName"]));
        $isValid = array('-','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$billingFName)) && (strlen($billingFName) <= 20)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["billingLName"])) {
        $billingLName = stripslashes(str_replace("'","",$_REQUEST["billingLName"]));
        $isValid = array('-','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$billingLName)) && (strlen($billingLName) <= 20)){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingAddress"])) {
        $billingAddress = stripslashes(str_replace("'","",$_REQUEST["billingAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$billingAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingCity"])) {
        $billingCity = stripslashes(str_replace("'","",$_REQUEST["billingCity"]));;
        $isValid = array(' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$billingCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingState"])) {
        $billingState = $_REQUEST["billingState"];
        if ($billingState != ''){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingZip"])) {
        $billingZip = $_REQUEST["billingZip"];
        if (ctype_digit($billingZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingPhone"])) {
        $billingPhone = $_REQUEST["billingPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $billingPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["billingEmail"])) {
        $billingEmail = $_REQUEST["billingEmail"];
        $expr = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        if (preg_match($expr, $billingEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["ccNum"])) {
        $ccNum = trim($_REQUEST["ccNum"]);
        $visa_regexPattern = "/^4[0-9]{12}(?:[0-9]{3})?$/";
        $disc_regexPattern = "/^6(?:011\d{12}|5\d{14}|4[4-9]\d{13}|22(?:1(?:2[6-9]|[3-9]\d)|[2-8]\d{2}|9(?:[01]\d|2[0-5]))\d{10})$/";
        $amex_regexPattern = "/^3[47][0-9]{13}$/";
        $diners_regexPattern = "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/";
        $mc_regexPattern = "/^5[0-5][0-9]{14}$/";
        if(preg_match($visa_regexPattern,$ccNum) ==1 ) {
            echo "true";
        } else if (preg_match($disc_regexPattern,$ccNum) == 1){
            echo 'true';
        } else if (preg_match($amex_regexPattern,$ccNum)==1){
            echo 'true';
        } else if (preg_match($mc_regexPattern,$ccNum)==1) {
            echo 'true';
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["ccCVV2"])) {
        $ccCVV2 = $_REQUEST["ccCVV2"];
        if (is_numeric($ccCVV2)) {
            echo "true";
        } else {
            echo "false";
        }
    }

?>
