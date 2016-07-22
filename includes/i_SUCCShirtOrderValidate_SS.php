<?php
    if(ISSET($_REQUEST["orderS"])) {
    $orderS = stripslashes(str_replace("'","",$_REQUEST["orderS"]));
        if (strlen($orderS) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["orderM"])) {
        $orderM = stripslashes(str_replace("'", "", $_REQUEST["orderM"]));
        if (strlen($orderM) != 0) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["orderL"])) {
        $orderL = stripslashes(str_replace("'","",$_REQUEST["orderL"]));
        if (strlen($orderL) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["orderXL"])) {
        $orderXL = stripslashes(str_replace("'","",$_REQUEST["orderXL"]));
        if (strlen($orderXL) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["order2X"])) {
        $order2X = stripslashes(str_replace("'","",$_REQUEST["order2X"]));
        if (strlen($order2X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["order3X"])) {
        $order3X = stripslashes(str_replace("'","",$_REQUEST["order3X"]));
        if (strlen($order3X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["order4X"])) {
        $order4X = stripslashes(str_replace("'","",$_REQUEST["order4X"]));
        if (strlen($order4X) != 0 ){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["orderFName"])) {
        $orderFName = stripslashes(trim(str_replace("'", "", $_REQUEST["orderFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $orderFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["orderLName"])) {
        $orderLName = stripslashes(trim(str_replace("'", "", $_REQUEST["orderLName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $orderLName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["orderAddress"])) {
        $orderAddress = stripslashes(str_replace("'","",$_REQUEST["orderAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$orderAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["orderCity"])) {
        $orderCity = stripslashes(str_replace("'","",$_REQUEST["orderCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$orderCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["orderZip"])) {
        $orderZip = $_REQUEST["orderZip"];
        if (ctype_digit($orderZip)) {
            echo "true";
        } else {
            echo "false";
        }




    }
//} else if (ISSET($_REQUEST["orderPhone"])) {
//    $orderPhone = $_REQUEST["orderPhone"];
//    $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
//    if (preg_match($expr, $orderPhone) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["orderEmail"])) {
//    $orderEmail = $_REQUEST["orderEmail"];
//    $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
//    if (preg_match($expr1, $orderEmail) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["orderEmail2"])) {
//    $orderEmail2 = $_REQUEST["orderEmail2"];
//    $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
//    if (preg_match($expr2, $orderEmail2) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if(ISSET($_REQUEST["billingFName"])) {
//    $billingFName = stripslashes(trim(str_replace("'", "", $_REQUEST["billingFName"])));
//    $isValid = array('-', '.', '/', ' ', '\'');
//    if (ctype_alpha(str_replace($isValid, '', $billingFName))) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if(ISSET($_REQUEST["billingLName"])) {
//    $billingLName = stripslashes(trim(str_replace("'", "", $_REQUEST["billingLName"])));
//    $isValid = array('-', '.', '/', ' ', '\'');
//    if (ctype_alpha(str_replace($isValid, '', $billingLName))) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingAddress"])) {
//    $billingAddress = stripslashes(str_replace("'","",$_REQUEST["billingAddress"]));
//    $isValid = array('#','.',' ',',','/','-','\'');
//    if (ctype_alnum(str_replace($isValid,'',$billingAddress))){
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingCity"])) {
//    $billingCity = stripslashes(str_replace("'","",$_REQUEST["billingCity"]));
//    $isValid = array('#','.',' ',',','/','-','\'');
//    if (ctype_alnum(str_replace($isValid,'',$billingCity))){
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingZip"])) {
//    $billingZip = $_REQUEST["billingZip"];
//    if (ctype_digit($billingZip)) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingPhone"])) {
//    $billingPhone = $_REQUEST["billingPhone"];
//    $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
//    if (preg_match($expr, $billingPhone) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingEmail"])) {
//    $billingEmail = $_REQUEST["billingEmail"];
//    $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
//    if (preg_match($expr1, $billingEmail) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["billingEmail2"])) {
//    $billingEmail2 = $_REQUEST["billingEmail2"];
//    $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
//    if (preg_match($expr2, $billingEmail2) == 1) {
//        echo "true";
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["ccNum"])) {
//    $ccNum = trim($_REQUEST["ccNum"]);
//    $visa_regexPattern = "/^4[0-9]{12}(?:[0-9]{3})?$/";
//    $disc_regexPattern = "/^6(?:011\d{12}|5\d{14}|4[4-9]\d{13}|22(?:1(?:2[6-9]|[3-9]\d)|[2-8]\d{2}|9(?:[01]\d|2[0-5]))\d{10})$/";
//    $amex_regexPattern = "/^3[47][0-9]{13}$/";
//    $diners_regexPattern = "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/";
//    //$mc_regexPattern = "/^5[0-5][0-9]{14}$/";
//    $mc_regexPatter = "/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$|^2(?:2(?:2[1-9]|[3-9]\d)|[3-6]\d\d|7(?:[01]\d|20))-?\d{4}-?\d{4}-?\d{4}$/";
//    if(preg_match($visa_regexPattern,$ccNum) ==1 ) {
//        echo "true";
//    } else if (preg_match($disc_regexPattern,$ccNum) == 1){
//        echo 'true';
//    } else if (preg_match($amex_regexPattern,$ccNum)==1){
//        echo 'true';
//    } else if (preg_match($mc_regexPattern,$ccNum)==1) {
//        echo 'true';
//    } else {
//        echo "false";
//    }
//} else if (ISSET($_REQUEST["ccCVV2"])) {
//    $ccCVV2 = $_REQUEST["ccCVV2"];
//    if (is_numeric($ccCVV2)) {
//        echo "true";
//    } else {
//        echo "false";
//    }

    ?>
