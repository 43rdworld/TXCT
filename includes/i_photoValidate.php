<?php
	if(ISSET($_REQUEST["photoUploadFile"])) {
        $photoUploadFile = stripslashes(trim(str_replace("'", "", $_FILES["photoUploadFile"])));
        // $isValid = array('-', '.', '/', ' ', '\'');
        if($_FILES['photoUploadFile']['size'] > 10485760) {                                             //10 MB (size is also in bytes)
            echo 'False';
        } else {
            echo 'True';
        }
 
 
        if (ctype_alpha(str_replace($isValid, '', $t2tFName))) {
            echo "true";
        } else {
            echo "false";
        }
    // } else if(ISSET($_REQUEST["t2tLName"])) {
		// $t2tLName = stripslashes(str_replace("'","",$_REQUEST["t2tLName"]));
		// $isValid = array('-','/',' ','\'');
		// if (ctype_alpha(str_replace($isValid,'',$t2tLName)) && (strlen($t2tLName) >= 2)  && (strlen($t2tLName) <= 25)){
		// 	echo "true";
		// } else {
		// 	echo "false";
		// }
    // } else if (ISSET($_REQUEST["t2tAddress"])) {
		// $t2tAddress = stripslashes(str_replace("'","",$_REQUEST["t2tAddress"]));
		// $isValid = array('#','.',' ',',','/','-');
		// if (ctype_alnum(str_replace($isValid,'',$t2tAddress))  && (strlen($t2tAddress) >= 2) && (strlen($t2tAddress) <= 50)){
		// 	echo "true";
		// } else {
		// 	echo "false";
		// }
    // } else if (ISSET($_REQUEST["t2tAddress2"])) {
    //     $t2tAddress2 = stripslashes(str_replace("'","",$_REQUEST["t2tAddress2"]));
    //     $isValid = array('#','.',' ',',','/','-');
    //     if (ctype_alnum(str_replace($isValid,'',$t2tAddress2)) && (strlen($t2tAddress2) >= 2) && (strlen($t2tAddress2) <= 50)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["t2tCity"])) {
		// $t2tCity = stripslashes(str_replace("'","",$_REQUEST["t2tCity"]));
		// $isValid = array('.',' ',',','/','-');
		// if (ctype_alnum(str_replace($isValid,'',$t2tCity)) && (strlen($t2tCity) >= 2)  && (strlen($t2tCity) <= 30 )){
		// 	echo "true";
		// } else {
		// 	echo "false";
		// }
    // } else if(ISSET($_GET["t2tState"])) {
    //     $t2tState = $_GET["t2tState"];
    //     $allowed = array('AK','AL','AR','AZ','CA','CO','CT','DC','DE','FL','GA','HI','IA','ID','IL','IN','KS','KY','LA','MA','MD','ME','MI','MN','MO','MS','MT','NC','ND','NE','NH','NJ','NM','NV','NY','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VA','VT','WA','WI','WV','WY');
    //     if (in_array($t2tState, $allowed)) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["t2tZip"])) {
    //     $t2tZip = $_REQUEST["t2tZip"];
    //     if ((ctype_digit($t2tZip)) && (preg_match('/^\d{5}$/',$t2tZip))) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["t2tPhone"])) {
    //     $t2tPhone = $_REQUEST["t2tPhone"];
    //     $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
    //     if (preg_match($expr, $t2tPhone) == 1) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["t2tEmail"])) {
    //     $t2tEmail = $_REQUEST["t2tEmail"];
    //     $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
    //     if (preg_match($expr, $t2tEmail) == 1) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["t2tConfirmEmail"])) {
    //     $t2tConfirmEmail = $_REQUEST["t2tConfirmEmail"];
    //     $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
    //     if (preg_match($expr, $t2tConfirmEmail) == 1) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if(ISSET($_REQUEST["t2tAmount"])) {
    //     $t2tAmount = $_REQUEST["t2tAmount"];
    //      $allowed = array('1','2','3','4','5','6','7','8','9','10','11','12','24','48','64','100');
    //     if (in_array($t2tAmount, $allowed)) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if(ISSET($_REQUEST["t2tReferringName"])) {
    //     $t2tReferringName = stripslashes(str_replace("'","",$_REQUEST["t2tReferringName"]));
    //     $isValid = array('-','/',' ','\'');
    //     if (ctype_alpha(str_replace($isValid,'',$t2tReferringName)) && (strlen($t2tReferringName) <= 50)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if(ISSET($_REQUEST["billingFName"])) {
    //     $billingFName = stripslashes(str_replace("'","",$_REQUEST["billingFName"]));
    //     $isValid = array('-','/',' ','\'');
    //     if (ctype_alpha(str_replace($isValid,'',$billingFName)) && (strlen($billingFName) <= 25)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if(ISSET($_REQUEST["billingLName"])) {
    //     $billingLName = stripslashes(str_replace("'","",$_REQUEST["billingLName"]));
    //     $isValid = array('-','/',' ','\'');
    //     if (ctype_alpha(str_replace($isValid,'',$billingLName)) && (strlen($billingLName) <= 25)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingAddress"])) {
    //     $billingAddress = stripslashes(str_replace("'","",$_REQUEST["billingAddress"]));
    //     $isValid = array('#','.',' ',',','/','-');
    //     if (ctype_alnum(str_replace($isValid,'',$billingAddress)) && (strlen($billingAddress) <= 50)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingAddress2"])) {
    //     $billingAddress2 = stripslashes(str_replace("'","",$_REQUEST["billingAddress2"]));
    //     $isValid = array('#','.',' ',',','/','-');
    //     if (ctype_alnum(str_replace($isValid,'',$billingAddress2)) && (strlen($billingAddress2) <= 50)){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingCity"])) {
    //     $billingCity = stripslashes(str_replace("'","",$_REQUEST["billingCity"]));;
    //     $isValid = array('.',' ',',','/','-');
    //     if (ctype_alpha(str_replace($isValid,'',$billingCity)) && (strlen($billingCity) <= 30 )){
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if(ISSET($_REQUEST["billingState"])) {
    //     $billingState = $_REQUEST["billingState"];
    //     $allowed = array('AK','AL','AR','AZ','CA','CO','CT','DC','DE','FL','GA','HI','IA','ID','IL','IN','KS','KY','LA','MA','MD','ME','MI','MN','MO','MS','MT','NC','ND','NE','NH','NJ','NM','NV','NY','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VA','VT','WA','WI','WV','WY');
    //     if (in_array($billingState, $allowed)) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingZip"])) {
    //     $billingZip = $_REQUEST["billingZip"];
    //     if ((ctype_digit($billingZip)) && (preg_match('/^\d{5}$/',$billingZip))) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingPhone"])) {
    //     $billingPhone = $_REQUEST["billingPhone"];
    //     $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
    //     if (preg_match($expr, $billingPhone) == 1) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["billingEmail"])) {
    //     $billingEmail = $_REQUEST["billingEmail"];
    //     $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
    //     if (preg_match($expr, $billingEmail) == 1) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["ccNum"])) {
    //     $ccNum = trim($_REQUEST["ccNum"]);
    //     $visa_regexPattern = "/^4[0-9]{12}(?:[0-9]{3})?$/";
    //     $disc_regexPattern = "/^6(?:011\d{12}|5\d{14}|4[4-9]\d{13}|22(?:1(?:2[6-9]|[3-9]\d)|[2-8]\d{2}|9(?:[01]\d|2[0-5]))\d{10})$/";
    //     $amex_regexPattern = "/^3[47][0-9]{13}$/";
    //     $diners_regexPattern = "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/";
    //     $mc_regexPattern = "/^5[0-5][0-9]{14}$/";
    //     if(preg_match($visa_regexPattern,$ccNum) ==1 ) {
    //         echo "true";
    //     } else if (preg_match($disc_regexPattern,$ccNum) == 1){
    //         echo 'true';
    //     } else if (preg_match($amex_regexPattern,$ccNum)==1){
    //         echo 'true';
    //     } else if (preg_match($mc_regexPattern,$ccNum)==1) {
    //         echo 'true';
    //     } else {
    //         echo "false";
    //     }
    // } else if (ISSET($_REQUEST["ccCVV2"])) {
    //     $ccCVV2 = $_REQUEST["ccCVV2"];
    //     if (is_numeric($ccCVV2)) {
    //         echo "true";
    //     } else {
    //         echo "false";
    //     }

    }




?>
