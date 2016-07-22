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
    } else if (ISSET($_REQUEST["orderPhone"])) {
        $orderPhone = $_REQUEST["orderPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $orderPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["orderEmail"])) {
        $orderEmail = $_REQUEST["orderEmail"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $orderEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["orderEmail2"])) {
        $orderEmail2 = $_REQUEST["orderEmail2"];
        $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr2, $orderEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    }

?>
