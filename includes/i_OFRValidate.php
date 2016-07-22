<?php
    if(ISSET($_REQUEST["troopLeaderFName"])) {
        $troopLeaderFName = stripslashes(trim(str_replace("'", "", $_REQUEST["troopLeaderFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $troopLeaderFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["troopLeaderLName"])) {
        $troopLeaderLName = stripslashes(trim(str_replace("'","",$_REQUEST["troopLeaderLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$troopLeaderLName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["troopLeaderEmail"])) {
        $troopLeaderEmail = $_GET["troopLeaderEmail"];
        $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr, $troopLeaderEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["troopLeaderEmail2"])) {
        $troopLeaderEmail2 = $_GET["troopLeaderEmail2"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $troopLeaderEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["troopLeaderAddress"])) {
        $troopLeaderAddress = stripslashes(str_replace("'","",$_REQUEST["troopLeaderAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$troopLeaderAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["troopLeaderCity"])) {
        $troopLeaderCity = stripslashes(str_replace("'","",$_REQUEST["troopLeaderCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$troopLeaderCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["troopLeaderZip"])) {
        $troopLeaderZip = $_REQUEST["troopLeaderZip"];
        if (ctype_digit($troopLeaderZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["troopLeaderPhone"])) {
        $troopLeaderPhone = $_GET["troopLeaderPhone"];
        $expr2 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr2, $troopLeaderPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["tcmFName"])) {
        $tcmFName = stripslashes(trim(str_replace("'", "", $_REQUEST["tcmFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $tcmFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["tcmLName"])) {
        $tcmLName = stripslashes(trim(str_replace("'","",$_REQUEST["tcmLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$tcmLName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["tcmEmail"])) {
        $tcmEmail = $_GET["tcmEmail"];
        $expr3 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr3, $tcmEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["tcmEmail2"])) {
        $tcmEmail2 = $_GET["tcmEmail2"];
        $expr4 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr4, $tcmEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["tcmAddress"])) {
        $tcmAddress = stripslashes(str_replace("'","",$_REQUEST["tcmAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$tcmAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["tcmCity"])) {
        $tcmCity = stripslashes(str_replace("'","",$_REQUEST["tcmCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$tcmCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["tcmZip"])) {
        $tcmZip = $_REQUEST["tcmZip"];
        if (ctype_digit($tcmZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["tcmPhone"])) {
        $tcmPhone = $_GET["tcmPhone"];
        $expr5 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr5, $tcmPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["girlFName"])) {
        $girlFName = stripslashes(trim(str_replace("'", "", $_REQUEST["girlFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $girlFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["girlLName"])) {
        $girlLName = stripslashes(trim(str_replace("'","",$_REQUEST["girlLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$girlLName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["parentGuardianFName"])) {
        $parentGuardianFName = stripslashes(trim(str_replace("'", "", $_REQUEST["parentGuardianFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $parentGuardianFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["parentGuardianLName"])) {
        $parentGuardianLName = stripslashes(trim(str_replace("'","",$_REQUEST["parentGuardianLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$parentGuardianLName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["parentGuardianEmail"])) {
        $parentGuardianEmail = $_GET["parentGuardianEmail"];
        $expr6 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr6, $parentGuardianEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["parentGuardianEmail2"])) {
        $parentGuardianEmail2 = $_GET["parentGuardianEmail2"];
        $expr7 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr7, $parentGuardianEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["parentGuardianAddress"])) {
        $parentGuardianAddress = stripslashes(str_replace("'","",$_REQUEST["parentGuardianAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$parentGuardianAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["parentGuardianCity"])) {
        $parentGuardianCity = stripslashes(str_replace("'","",$_REQUEST["parentGuardianCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$parentGuardianCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["parentGuardianZip"])) {
        $parentGuardianZip = $_REQUEST["parentGuardianZip"];
        if (ctype_digit($parentGuardianZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["parentGuardianPhone"])) {
        $parentGuardianPhone = $_GET["parentGuardianPhone"];
        $expr8 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr8, $parentGuardianPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["parentGuardianWorkPhone"])) {
        $parentGuardianWorkPhone = $_GET["parentGuardianWorkPhone"];
        $expr9 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr9, $parentGuardianWorkPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["parentGuardianCellPhone"])) {
        $parentGuardianCellPhone = $_GET["parentGuardianCellPhone"];
        $expr10 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr10, $parentGuardianCellPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["ofrSubmitter"])) {
        $ofrSubmitter = stripslashes(trim(str_replace("'","",$_REQUEST["ofrSubmitter"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$ofrSubmitter))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["ofrPhone"])) {
        $ofrPhone = $_GET["ofrPhone"];
        $expr11 = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr11, $ofrPhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    //} else if(ISSET($_REQUEST["ofrComment"])) {
    //    $ofrComment = stripslashes(trim(str_replace("'", "", $_REQUEST["ofrComment"])));
    //    $isValid = array('-', '.', '/', ' ', '\'');
    //    if (ctype_alpha(str_replace($isValid, '', $troopLeaderFName))) {
    //        echo "true";
    //    } else {
    //        echo "false";
    //    }
    } else if (ISSET($_GET["ofrAmountOwed"])) {
        $ofrAmountOwed = str_replace(',','',$_GET["ofrAmountOwed"]);
        $expr13 = '/^\d*\.\d{2}$/';
        if (preg_match($expr13, $ofrAmountOwed) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_GET["ofrAmountPaid"])) {
        $ofrAmountPaid = str_replace(',','',$_GET["ofrAmountPaid"]);
        $expr14 = '/^\d*\.\d{2}$/';
        if (preg_match($expr14, $ofrAmountPaid) == 1) {
            echo "true";
        } else {
            echo "false";
        }

    }

