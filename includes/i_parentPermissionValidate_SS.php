<?php
	if(ISSET($_REQUEST["permGirlFName"])) {
        $permGirlFName = stripslashes(trim(str_replace("'", "", $_REQUEST["permGirlFName"])));
        $isValid = array('-', '.', '/', ' ', '\'');
        if (ctype_alpha(str_replace($isValid, '', $permGirlFName))) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permGirlLName"])) {
        $permGirlLName = stripslashes(trim(str_replace("'","",$_REQUEST["permGirlLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$permGirlLName))){
            echo "true";
        } else {
            echo "false";
        }
    //} else if (ISSET($_REQUEST["permGSTroop"])) {
     //   $permGSTroop = $_REQUEST["permGSTroop"];
     //   if ((ctype_alnum($permGSTroop))&&(strlen($permGSTroop)<=4)){
     //       echo "true";
     //   } else {
     //       echo "false";
     //   }
	//} else if (ISSET($_REQUEST["permSU"])) {
     //   $permSU = $_REQUEST["permSU"];
     //   if ((ctype_digit($permSU))&&(strlen($permSU)==3)){
     //       echo "true";
     //   } else {
     //       echo "false";
     //   }
	} else if (ISSET($_REQUEST["permPackages"])) {
		$permPackages = stripslashes(str_replace("'","",$_REQUEST["permPackages"]));
        if (ctype_digit($permPackages)){
			echo 'true';
		} else {
			echo 'false';
	    }
    } else if (ISSET($_REQUEST["permMyEmail"])) {
        $permMyEmail = $_REQUEST["permMyEmail"];
        $expr1 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr1, $permMyEmail) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permMyEmail2"])) {
        $permMyEmail2 = $_REQUEST["permMyEmail2"];
        $expr2 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr2, $permMyEmail2) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permLeadEmail"])) {
        $permLeadEmail = $_REQUEST["permLeadEmail"];
        $expr3 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr3, $permLeadEmail)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permLeadEmail2"])) {
        $permLeadEmail2 = $_REQUEST["permLeadEmail2"];
        $expr4 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr4, $permLeadEmail2)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permTCMEmail"])) {
        $permTCMEmail = $_REQUEST["permTCMEmail"];
        $expr5 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr5, $permTCMEmail)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permTCMEmail2"])) {
        $permTCMEmail2 = $_REQUEST["permTCMEmail2"];
        $expr6 = '/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}$/';
        if (preg_match($expr6, $permTCMEmail2)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm1"])) {
        $perm1 = stripslashes(trim(str_replace("'","",$_REQUEST["perm1"])));
        if (ctype_alpha($perm1)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm2"])) {
        $perm2 = stripslashes(trim(str_replace("'","",$_REQUEST["perm2"])));
        if (ctype_alpha($perm2)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm3"])) {
        $perm3 = stripslashes(trim(str_replace("'","",$_REQUEST["perm3"])));
        if (ctype_alpha($perm3)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm4"])) {
        $perm4 = stripslashes(trim(str_replace("'","",$_REQUEST["perm4"])));
        if (ctype_alpha($perm4)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm5"])) {
        $perm5 = stripslashes(trim(str_replace("'","",$_REQUEST["perm5"])));
        if (ctype_alpha($perm5)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm6"])) {
        $perm6 = stripslashes(trim(str_replace("'","",$_REQUEST["perm6"])));
        if (ctype_alpha($perm6)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["perm7"])) {
        $perm7 = stripslashes(trim(str_replace("'","",$_REQUEST["perm7"])));
        if (ctype_alpha($perm7)){
            echo "true";
        } else {
            echo "false";
        }
    // } else if(ISSET($_REQUEST["permCClub"])) {
        // $permCClub = $_REQUEST["permCClub"];
        // if (($permCClub == 1) || ($permCClub == 0)){
            // echo "true";
        // } else {
            // echo "false";
        // }
    } else if(ISSET($_REQUEST["permCC1"])) {
        $permCC1 = stripslashes(trim(str_replace("'","",$_REQUEST["permCC1"])));
        if (ctype_alpha($permCC1)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permCC2"])) {
        $permCC2 = stripslashes(trim(str_replace("'","",$_REQUEST["permCC2"])));
        if (ctype_alpha($permCC2)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permCC3"])) {
        $permCC3 = stripslashes(trim(str_replace("'","",$_REQUEST["permCC3"])));
        if (ctype_alpha($permCC3)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permCC4"])) {
        $permCC4 = stripslashes(trim(str_replace("'","",$_REQUEST["permCC4"])));
        if (ctype_alpha($permCC4)){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permParentFName"])) {
        $permParentFName = stripslashes(trim(str_replace("'","",$_REQUEST["permParentFName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$permParentFName))){
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permParentLName"])) {
        $permParentLName = stripslashes(trim(str_replace("'","",$_REQUEST["permParentLName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$permParentLName))){
            echo "true";
        } else {
            echo "false";
        }
//    } else if(ISSET($_REQUEST["permIDType"])) {
//        echo 'false';
//
    } else if(ISSET($_REQUEST["permID"])) {
        $permID = str_replace("0","",trim($_REQUEST["permID"]));
        if (!empty($permID)){
            echo 'true';
        } else {
            echo 'false';
        }
    } else if (ISSET($_REQUEST["permHomeAddress"])) {
        $permHomeAddress = stripslashes(str_replace("'","",$_REQUEST["permHomeAddress"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$permHomeAddress))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permCity"])) {
        $permCity = stripslashes(str_replace("'","",$_REQUEST["permCity"]));
        $isValid = array('#','.',' ',',','/','-','\'');
        if (ctype_alnum(str_replace($isValid,'',$permCity))){
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permZip"])) {
        $permZip = $_REQUEST["permZip"];
        if (ctype_digit($permZip)) {
            echo "true";
        } else {
            echo "false";
        }
    } else if (ISSET($_REQUEST["permHomePhone"])) {
        $permHomePhone = $_REQUEST["permHomePhone"];
        $expr = '/^\+?(\(?[0-9]{3}\)?|[0-9]{3})[-\.\s]?[0-9]{3}[-\.\s]?[0-9]{4}$/';
        if (preg_match($expr, $permHomePhone) == 1) {
            echo "true";
        } else {
            echo "false";
        }
    } else if(ISSET($_REQUEST["permSignedName"])) {
        $permSignedName = stripslashes(trim(str_replace("'","",$_REQUEST["permSignedName"])));
        $isValid = array('-','.','/',' ','\'');
        if (ctype_alpha(str_replace($isValid,'',$permSignedName))){
            echo "true";
        } else {
            echo "false";
        }
    }

?>
