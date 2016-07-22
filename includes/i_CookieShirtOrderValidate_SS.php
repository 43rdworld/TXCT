<?php
    if(ISSET($_REQUEST["cookieOrderYS"])) {
        $cookieOrderYS = stripslashes(str_replace("'","",$_REQUEST["cookieOrderYS"]));
        if (strlen($cookieOrderYS) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderYM"])) {
        $cookieOrderYM = stripslashes(str_replace("'", "", $_REQUEST["cookieOrderYM"]));
        if (strlen($cookieOrderYM) != 0) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderYL"])) {
        $cookieOrderYL = stripslashes(str_replace("'", "", $_REQUEST["cookieOrderYL"]));
        if (strlen($cookieOrderYL) != 0) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderAS"])) {
    $cookieOrderAS = stripslashes(str_replace("'","",$_REQUEST["cookieOrderAS"]));
    if (strlen($cookieOrderAS) != 0 ){
        echo "true";
    } else {
        echo "false";
    }
    } else if(ISSET($_REQUEST["cookieOrderAM"])) {
        $cookieOrderAM = stripslashes(str_replace("'", "", $_REQUEST["cookieOrderAM"]));
        if (strlen($cookieOrderAM) != 0) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderAL"])) {
        $cookieOrderAL = stripslashes(str_replace("'","",$_REQUEST["cookieOrderAL"]));
        if (strlen($cookieOrderAL) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderAXL"])) {
        $cookieOrderAXL = stripslashes(str_replace("'","",$_REQUEST["cookieOrderAXL"]));
        if (strlen($cookieOrderAXL) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderA2X"])) {
        $cookieOrderA2X = stripslashes(str_replace("'","",$_REQUEST["cookieOrderA2X"]));
        if (strlen($cookieOrderA2X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderA3X"])) {
        $cookieOrderA3X = stripslashes(str_replace("'","",$_REQUEST["cookieOrderA3X"]));
        if (strlen($cookieOrderA3X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderA4X"])) {
        $cookieOrderA4X = stripslashes(str_replace("'","",$_REQUEST["cookieOrderA4X"]));
        if (strlen($cookieOrderA4X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderFName"])) {
        $cookieOrderFName = stripslashes(trim(str_replace("'", "", $_REQUEST["cookieOrderFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $cookieOrderFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieOrderLName"])) {
        $cookieOrderLName = stripslashes(trim(str_replace("'", "", $_REQUEST["cookieOrderLName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $cookieOrderLName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderAddress"])) {
        $cookieOrderAddress = stripslashes(str_replace("'","",$_REQUEST["cookieOrderAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$cookieOrderAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderCity"])) {
        $cookieOrderCity = stripslashes(str_replace("'","",$_REQUEST["cookieOrderCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$cookieOrderCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderZip"])) {
        $cookieOrderZip = $_REQUEST["cookieOrderZip"];
        if (ctype_digit($cookieOrderZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderPhone"])) {
        $cookieOrderPhone = $_REQUEST["cookieOrderPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $cookieOrderPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderEmail"])) {
        $cookieOrderEmail = $_REQUEST["cookieOrderEmail"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $cookieOrderEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieOrderEmail2"])) {
        $cookieOrderEmail2 = $_REQUEST["cookieOrderEmail2"];
        $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr2, $cookieOrderEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieBillingFName"])) {
        $cookieBillingFName = stripslashes(trim(str_replace("'", "", $_REQUEST["cookieBillingFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $cookieBillingFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["cookieBillingLName"])) {
        $cookieBillingLName = stripslashes(trim(str_replace("'", "", $_REQUEST["cookieBillingLName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $cookieBillingLName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingAddress"])) {
        $cookieBillingAddress = stripslashes(str_replace("'","",$_REQUEST["cookieBillingAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$cookieBillingAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingCity"])) {
        $cookieBillingCity = stripslashes(str_replace("'","",$_REQUEST["cookieBillingCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$cookieBillingCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingZip"])) {
        $cookieBillingZip = $_REQUEST["cookieBillingZip"];
        if (ctype_digit($cookieBillingZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingPhone"])) {
        $cookieBillingPhone = $_REQUEST["cookieBillingPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $cookieBillingPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingEmail"])) {
        $cookieBillingEmail = $_REQUEST["cookieBillingEmail"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $cookieBillingEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["cookieBillingEmail2"])) {
        $cookieBillingEmail2 = $_REQUEST["cookieBillingEmail2"];
        $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr2, $cookieBillingEmail2) == 1) {
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
