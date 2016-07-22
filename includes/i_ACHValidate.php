<?php
	if(ISSET($_GET["achAccountName"])) {
        $achAccountName = stripslashes(trim(str_replace("'", "", $_GET["achAccountName"])));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$achAccountName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["achPhone"])) {
        $achPhone = $_GET["achPhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $achPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["achEmail"])) {
        $achEmail = $_GET["achEmail"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $achEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["achConfirmEmail"])) {
        $achConfirmEmail = $_GET["achConfirmEmail"];
        $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr2, $achConfirmEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["achAccount"])) {
        $achAccount = $_REQUEST["achAccount"];
        if ((ctype_digit($achAccount))&&(strlen($achAccount)>0)){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["achAmount"])) {
        $achAmount = str_replace(',','',$_GET["achAmount"]);
        $expr3 = '/^\d*\.\d{2}$/';
        if (preg_match($expr3, $achAmount) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    }

