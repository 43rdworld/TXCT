<?php
if(ISSET($_REQUEST["volFName"])) {
    $volFName = stripslashes(trim(str_replace("'", "", $_REQUEST["volFName"])));
    $isValid = array('-', '.', '/', ' ', '\'');
    if (ctype_alpha(str_replace($isValid, '', $volFName))) {
        echo "true";
    } else {
        echo "false";
    }
} else if(ISSET($_REQUEST["volLName"])) {
    $volLName = stripslashes(trim(str_replace("'","",$_REQUEST["volLName"])));
    $isValid = array('-','.','/',' ','\'');
    if (ctype_alpha(str_replace($isValid,'',$volLName))){
        echo "true";
    } else {
        echo "false";
    }
} else if (ISSET($_REQUEST["volEmail"])) {
    $volEmail = $_REQUEST["volEmail"];
    $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
    if (preg_match($expr, $volEmail) == 1) {
        echo "true";
    } else {
        echo "false";
    }
} else if (ISSET($_REQUEST["volEmail2"])) {
    $volEmail2 = $_REQUEST["volEmail2"];
    $expr = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
    if (preg_match($expr, $volEmail2) == 1) {
        echo "true";
    } else {
        echo "false";
    }
} else if (ISSET($_REQUEST["volPhone"])) {
    $volPhone = $_REQUEST["volPhone"];
    $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
    if (preg_match($expr, $volPhone) == 1) {
        echo "true";
    } else {
        echo "false";
    }
    } else if(ISSET($_REQUEST["volIDType"])) {
        echo 'false';
    } else if(ISSET($_REQUEST["volID"])) {
        $volID = str_replace("0","",trim($_REQUEST["volID"]));
        if (!empty($volID)){
            echo 'true';
        } else {
            echo 'false';
        }
    } else if (ISSET($_REQUEST["volTroop"])) {
        $volTroop = stripslashes(str_replace("'","",$_REQUEST["volTroop"]));
        $isValid = array('#','.',' ',',','/','-');
        if (ctype_alnum($volTroop) && (strlen($volTroop)>=2)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt1"])) {
        $txt1 = stripslashes(trim(str_replace("'","",$_REQUEST["txt1"])));
        if ((ctype_alpha($txt1)) && (strlen($txt1)!='')){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt2"])) {
        $txt2 = stripslashes(trim(str_replace("'","",$_REQUEST["txt2"])));
        if (ctype_alpha($txt2)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt3"])) {
        $txt3 = stripslashes(trim(str_replace("'","",$_REQUEST["txt3"])));
        if (ctype_alpha($txt3)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt4"])) {
        $txt4 = stripslashes(trim(str_replace("'","",$_REQUEST["txt4"])));
        if (ctype_alpha($txt4)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt5"])) {
        $txt5 = stripslashes(trim(str_replace("'","",$_REQUEST["txt5"])));
        if (ctype_alpha($txt5)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt6"])) {
        $txt6 = stripslashes(trim(str_replace("'","",$_REQUEST["txt6"])));
        if (ctype_alpha($txt6)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt7"])) {
        $txt7 = stripslashes(trim(str_replace("'","",$_REQUEST["txt7"])));
        if (ctype_alpha($txt7)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt8"])) {
        $txt8 = stripslashes(trim(str_replace("'","",$_REQUEST["txt8"])));
        if (ctype_alpha($txt8)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt9"])) {
        $txt9 = stripslashes(trim(str_replace("'","",$_REQUEST["txt9"])));
        if (ctype_alpha($txt9)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt10"])) {
        $txt10 = stripslashes(trim(str_replace("'","",$_REQUEST["txt10"])));
        if (ctype_alpha($txt10)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt11"])) {
        $txt11 = stripslashes(trim(str_replace("'","",$_REQUEST["txt11"])));
        if (ctype_alpha($txt11)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt12"])) {
        $txt12 = stripslashes(trim(str_replace("'","",$_REQUEST["txt12"])));
        if (ctype_alpha($txt12)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt13"])) {
        $txt13 = stripslashes(trim(str_replace("'","",$_REQUEST["txt13"])));
        if (ctype_alpha($txt13)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["txt14"])) {
        $txt14 = stripslashes(trim(str_replace("'","",$_REQUEST["txt14"])));
        if (ctype_alpha($txt14)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["volSignedName"])) {
        $volSignedName = stripslashes(trim(str_replace("'","",$_REQUEST["volSignedName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$volSignedName))){
            echo "true";
        } else {
            echo "false";
        }


}

?>
