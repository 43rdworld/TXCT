<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    date_default_timezone_set('America/Chicago');
    ini_set("display_errors", 1);
    $transMessage = '';
//= CHECK SUBMIT BUTTON STATUS
//====================================================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	======================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        require("i_PDOFunctions.php");
        setRegistrationParams('03/04/2016', '03/01/2017');
        //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE OFR REPORT FORM 	======================================================================
        if (strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 'ofr.php') {
            //=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==================================================================
            if (strtolower($_POST["submitOFR"]) == 'submitofrreport') {
                  //=============================================================================================================================================================
                $ipAddress = getIPAddr();
                $dbh = '';
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");                                        //=	CREATES ODBC DATA CONNECTION TO DATABASE
                require_once('lib/swift_required.php');
                if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_OFR_Reports',$_POST['formSecret']) == '') {
                    $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
                    $arrBrowserString = explode(';', $browserString);
                    $confirmationID = generateRandomID('OFR_','str',8);
                    //echo $confirmationID."<br>";
                    //echo "PHONE: ".format_phone($_POST['troopLeaderPhone'],0)."<br>";
                    //echo "IP: ".$ipAddress."<br>";
                    setVars('formSecret:str,date:dat,ofrTroopNum:str,permSU:int,troopLeaderFName:caps,troopLeaderLName:caps,troopLeaderEmail:str,troopLeaderAddress:caps,troopLeaderCity:caps,troopLeaderZip:int,troopLeaderPhone:phn,ofrSame:bit,tcmFName:caps,tcmLName:caps,tcmEmail:str,tcmAddress:caps,tcmCity:caps,tcmZip:int,tcmPhone:phn,girlFName:caps,girlLName:caps,parentGuardianFName:caps,parentGuardianLName:caps,parentGuardianEmail:str,parentGuardianAddress:caps,parentGuardianCity:caps,parentGuardianZip:int,parentGuardianPhone:phn,parentGuardianWorkPhone:phn,parentGuardianCellPhone:phn,ofrSubmitter:caps,ofrPhone:phn,ofrComment:str,ofrAmountOwed:mon,ofrAmountPaid:mon,ofrBalanceDueTemp:mon,emailSent:bit,emailSentDate:dat,emailTransport:str,active:bit,notes:str', 0, 0, 'OFR Report Form');
                    $dbFields = array("formSecret:".$formSecret,"ipAddress:".$ipAddress,"browser:".$arrBrowserString[0],"browserVersion:".$arrBrowserString[1],"operatingSystem:".$arrBrowserString[2],"date:".$date,"ofrTroopNum:".$ofrTroopNum,"ofrSU:".$permSU,"troopLeaderFName:".$troopLeaderFName,"troopLeaderLName:".$troopLeaderLName,"troopLeaderEmail:".$troopLeaderEmail,"troopLeaderAddress:".$troopLeaderAddress,"troopLeaderCity:".$troopLeaderCity,"troopLeaderZip:".$troopLeaderZip,"troopLeaderPhone:".$troopLeaderPhone,"tcmFName:".$tcmFName,"tcmLName:".$tcmLName,"tcmEmail:".$tcmEmail,"tcmAddress:".$tcmAddress,"tcmCity:".$tcmCity,"tcmZip:".$tcmZip,"tcmPhone:".$tcmPhone,"girlFName:".$girlFName,"girlLName:".$girlLName,"parentGuardianFName:".$parentGuardianFName,"parentGuardianLName:".$parentGuardianLName,"parentGuardianEmail:".$parentGuardianEmail,"parentGuardianAddress:".$parentGuardianAddress,"parentGuardianCity:".$parentGuardianCity,"parentGuardianZip:".$parentGuardianZip,"parentGuardianPhone:".$parentGuardianPhone,"parentGuardianWorkPhone:".$parentGuardianWorkPhone,"parentGuardianCellPhone:".$parentGuardianCellPhone,"ofrSubmitter:".$ofrSubmitter,"ofrPhone:".$ofrPhone,"ofrComment:".$ofrComment,"ofrAmountOwed:".$ofrAmountOwed,"ofrAmountPaid:".$ofrAmountPaid,"ofrBalanceDue:".$ofrBalanceDueTemp,"confirmationID:".$confirmationID,"emailSent:".$emailSent,"emailSentDate:".$emailSentDate,"emailTransport:".$emailTransport,"active:".$active,"notes:".$notes);
                    //exit();
                //=============================================================================================================================================================
                //= PROCESS DATA FROM FORM																																	  =
                //=============================================================================================================================================================
                    try {
                        //=============================================================================================================================================================
                        // CREATE ON-SCREEN CONFIRMATION MESSAGE																			             	 						  =
                        //=============================================================================================================================================================
                        if($ofrSame ==1) {
                            $tcmFName = $troopLeaderFName;
                            $tcmLName = $troopLeaderLName;
                            $tcmAddress = $troopLeaderAddress;
                            $tcmCity = $troopLeaderCity;
                            $tcmZip = $troopLeaderZip;
                            $tcmPhone = $troopLeaderPhone;
                            $tcmEmail = $troopLeaderEmail;
                        }
                        $screenMessage = "<div class=\"screenMessage\" style=\"font-size:11pt;line-height:17pt;\">";
                        $screenMessage .= "<div style=\"margin:10px 0;\">Thank you for submitting an Outstanding Funds Report.</div>";
                        $screenMessage .= "<div style=\"margin:8px 0;\">A summary of your report is listed below and a copy will be emailed to the address submitted with the payment information.</div>";
                        $screenMessage .= "<div style=\"margin:5px 0;line-height:1.4em;\">If you have any additional questions, please contact <a href=\"mailto:khoward@gsnetx.org?subject=Question about an OFR Report\">khoward@gsnetx.org</a> or call (972) 349-2459.</div>";
                        $screenMessage .= "<table cellpadding=\"0\" cellspacing=\"0\" class=\"ofrConfirmationWrapper\">";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<table cellpadding=\"4\" cellspacing=\"0\" class=\"ofrConfirmationTable\">";
                        $screenMessage .=               "<tr><th colspan=\"2\" class=\"ofrConfirmationHeader\">Outstanding Funds Report</th></tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Troop Number:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . ltrim(ltrim($ofrTroopNum, 'Troop'), '0') . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Service Unit:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . $permSU . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Troop Cookie Manager:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($tcmFName) . ' ' . titleCase($tcmLName) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Troop Leader:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($troopLeaderFName) . ' ' . titleCase($troopLeaderLName) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Report Prepared By:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($ofrSubmitter) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=           "</table>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<div style=\"margin:10px 20px;border-top:2px dashed #ccc;\">&#32;</div>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<table cellpadding=\"4\" cellspacing=\"0\" class=\"ofrConfirmationTable\">";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Girl&rsquo;s Name:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($girlFName) . ' ' . titleCase($girlLName) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Name:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($parentGuardianFName) . ' ' . titleCase($parentGuardianLName) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Address:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . titleCase($parentGuardianAddress) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Phone:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . format_phone($parentGuardianPhone,1) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Work Phone:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . format_phone($parentGuardianWorkPhone,1) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Cell Phone:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">" . format_phone($parentGuardianCellPhone,1) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Parent-Guardian Email:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\"><a href=\"mailto:" . $parentGuardianEmail . "&subject=Outstanding Cookie Funds\">" . $parentGuardianEmail . "</a></td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=           "</table>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<div style=\"margin:10px 20px;border-top:2px dashed #ccc;\">&#32;</div>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<table cellpadding=\"4\" cellspacing=\"0\" class=\"ofrConfirmationTable\">";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\" style=\"vertical-align:top;\">Why Cookie Bill Has Not<br>Been Paid In Full:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\" style=\"vertical-align:top;\">" . newLine2Break($ofrComment) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=           "</table>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<div style=\"margin:10px 20px;border-top:2px dashed #ccc;\">&#32;</div>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .=   "<tr>";
                        $screenMessage .=       "<td class=\"ofrConfirmationWrapperTD\">";
                        $screenMessage .=           "<table cellpadding=\"4\" cellspacing=\"0\" class=\"ofrConfirmationTable\">";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Total Due Council:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">$" . number_format(cleanData($ofrAmountOwed),2) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationLabel\">Amount Paid:</td>";
                        $screenMessage .=                   "<td valign=\"top\" class=\"ofrConfirmationData\">$" . number_format(cleanData($ofrAmountPaid),2) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=               "<tr>";
                        $screenMessage .=                   "<td  width=\"180\" valign=\"top\" class=\"ofrConfirmationLabel\">Balance Due:</td>";
                        $screenMessage .=                   "<td width=\"425\" valign=\"top\" class=\"ofrConfirmationData\">$" . number_format(cleanData($ofrBalanceDueTemp),2) . "</td>";
                        $screenMessage .=               "</tr>";
                        $screenMessage .=           "</table>";
                        $screenMessage .=       "</td>";
                        $screenMessage .=   "</tr>";
                        $screenMessage .= "</table>";
                        $screenMessage .= "</div>";
                    //= CREATE EMAIL MESSAGE FOR SUCCESSFUL TRANSACTION ======================================================================================
                        $emailMessage = "<div style=\"width:600px;text-align:left;\">";
                        $emailMessage .= "<table cellpadding=\"0\" cellspacing=\"0\" width=\"600\">";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td style=\"border:0;\">";
                        $emailMessage .= "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:10px 0;\">Thank you for submitting an Outstanding Funds Report.</div>";
                        $emailMessage .= "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">A summary of your report is listed below.</div>";
                        $emailMessage .= "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:5px 0;line-height:1.4em;\">If you have any additional questions, please contact <a href=\"mailto:khoward@gsnetx.org?subject=Question about an OFR Report\">khoward@gsnetx.org</a> or call (972) 349-2459.</div>";
                        $emailMessage .= "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:18px 0;\">Thank you!</div>";
                        $emailMessage .= "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $emailMessage .= "<div style=\"margin-top:20px;padding-top:20px;border-top:2px solid #999;\">&#32;</div>";
                        $emailMessage .= "<div style=\"margin:10px 5px 25px;\">";
                        $emailMessage .= "<div style=\"font:10pt/15pt verdana,arial,sans-serif;color:#444;font-weight:bold;margin:0 0 5px 0;text-align:left;\">Outstanding Funds Report Confirmation Receipt</div>";
                        $emailMessage .= "<table cellpadding=\"4\" cellspacing=\"0\" style=\"border-collapse:collapse:width:525px;\">";
                        $emailMessage .= "<tbody>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999; border-collapse: collapse; width: 184px;background-color:#E5ECF9;\">Submission Date:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999; border-left:none;border-collapse: collapse; width: 294px;background-color:#fff;\">" . date('m/d/Y g:i a', time()) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td colspan=\"2\" style=\"border: none;background-color:#fff;\">&#32;</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999; border-collapse: collapse;border-bottom:none; width: 184px;background-color:#E5ECF9;\">Troop Number:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999;border-left:none; border-collapse: collapse;border-bottom:none; width: 294px;background-color:#fff\">" . ltrim(ltrim($ofrTroopNum, 'Troop'), '0') . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold;  border: 1px solid #999; border-collapse: collapse;border-bottom:none;width: 184px;background-color:#E5ECF9;\">Service Unit:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999;border-left:none; border-bottom:none; border-collapse: collapse;width: 294px;background-color:#fff;\">" . $permSU . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999; border-collapse: collapse; border-bottom:none; width: 184px;background-color:#E5ECF9;\">Troop Leader:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999;border-left:none; border-bottom:none; border-collapse: collapse; width: 294px;background-color:#fff;\">" . titleCase($troopLeaderFName) . ' ' . titleCase($troopLeaderLName) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999; border-collapse: collapse; width: 184px;background-color:#E5ECF9;\">Troop Cookie Manager:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999;border-left:none; border-collapse: collapse; width: 294px;background-color:#fff;\">" . titleCase($tcmFName) . ' ' . titleCase($tcmLName) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td colspan=\"2\" style=\"border: none;height:5px;background-color:#fff;\">&#32;</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none; width: 184px;background-color:#E5ECF9;\">Parent/Guardian Name:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none; width: 294px;background-color:#fff;\">" . titleCase($parentGuardianFName) . ' ' . titleCase($parentGuardianLName) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none; width: 184px;background-color:#E5ECF9;\">Girl Name:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none; width: 294px;background-color:#fff;\">" . titleCase($girlFName) . ' ' . titleCase($girlLName) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Address:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . $parentGuardianAddress . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">City:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . $parentGuardianCity . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Zip:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . $parentGuardianZip . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Phone:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . format_phone($parentGuardianPhone,1) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Work Phone:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . format_phone($parentGuardianWorkPhone,1) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Cell Phone:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . format_phone($parentGuardianCellPhone,1) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Email:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;border-left:none;background-color:#fff;\">" . $parentGuardianEmail . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;background-color:#E5ECF9;\">Person Completing Report:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;background-color:#fff;\">" . titleCase($ofrSubmitter) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td colspan=\"2\" style=\"border: none;height:5px;background-color:#fff;\">&#32;</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;;border-bottom:none;vertical-align:top;background-color:#E5ECF9;\">Why Cookie Bill Was Not:<br />Paid In Full&nbsp;</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;border-bottom:none;vertical-align:top;background-color:#fff;\">" . newLine2Break($ofrComment) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;vertical-align:top;background-color:#E5ECF9;\">Total Due Council:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;border-bottom:none;background-color:#fff;\">$" . number_format(cleanData($ofrAmountOwed),2) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;border-bottom:none;background-color:#E5ECF9;\">Amount Paid to Council:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;border-bottom:none;background-color:#fff;\">$" . number_format(cleanData($ofrAmountPaid),2) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;background-color:#E5ECF9;\">Balance Due Council:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;background-color:#fff;\">$" . number_format(cleanData($ofrBalanceDueTemp),2) . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td colspan=\"2\" style=\"border: none; height:5px;background-color:#fff;\">&#32;</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "<tr>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: right; font-weight: bold; border: 1px solid #999999; border-collapse: collapse;background-color:#E5ECF9;\">Confirmation ID:</td>";
                        $emailMessage .= "<td valign=\"top\" style=\"font-size: 9pt; line-height: 12pt; font-family: Verdana, Geneva, sans-serif; text-align: left; font-weight: normal; border: 1px solid #999999; border-collapse: collapse;border-left:none;background-color:#fff;\">" . $confirmationID . "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "</tbody>";
                        $emailMessage .= "</table>";
                        $emailMessage .= "</div>";
                        $emailMessage .= "</td>";
                        $emailMessage .= "</tr>";
                        $emailMessage .= "</table>";
                    //= CREATE EMAIL MESSAGE FOR PERSON BEING FILED ON ========================================================================================================
                        $emailMessage2 = "<div style=\"width:600px;text-align:left;\">";
                        $emailMessage2 .=   "<table cellpadding=\"0\" cellspacing=\"0\" width=\"600\" border=\"0\">";
                        $emailMessage2 .=       "<tr>";
                        $emailMessage2 .=           "<td style=\"border:none;\">";
                        $emailMessage2 .=               "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:10px 0;\">Dear ".titleCase($parentGuardianFName)." ".titleCase($parentGuardianLName) ."</div>";
                        $emailMessage2 .=               "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">An outstanding funds report has been submitted to Girl Scouts of Northeast Texas (GSNETX) regarding cookie funds that you have not paid. This report states that you owe $".number_format(cleanData($ofrBalanceDueTemp), 2)." as part of your daughter’s participation in Girl Scout Troop #".$ofrTroopNum.". All cookie funds were due on March 7, 2016.</div>";
                        $emailMessage2 .=               "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">Persons with an outstanding amount due to GSNETX beyond 60 days are not permitted to serve in a volunteer capacity until the amount is paid in full.  GSNETX also has the right to turn over your account to collections if payment is not received 60 days from the March due date. To prevent these actions from occurring, this overdue amount should be paid by May 6, 2016.</div>";
                        $emailMessage2 .=               "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">Please remit payment to GSNETX by cash in person at GSNETX Headquarters, mail a check to the address listed below or call me with credit card information at (972) 349-2459.</div>";
                        $emailMessage2 .=               "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:15px 0 8px 0;\">Sincerely,</div>";
                        $emailMessage2 .=               "<div style=\"font:9pt/13pt verdana,arial,sans-serif;font-weight:normal;margin:0;\">Kirsten Howard<br>Controller<br>Girl Scouts of Northeast Texas<br>6001 Summerside Drive<br>Dallas, TX 75252<br><a href=\"mailto:khoward@gsnetx.org\">khoward@gsnetx.org</a><br>(972) 349-2459<br><br><br></div>";
                        $emailMessage2 .=           "</td>";
                        $emailMessage2 .=       "</tr>";
                        $emailMessage2 .=   "</table>";
                        $emailMessage2 .= "</div>";

                        $stmt = $dbh_write->prepare('EXEC sp_Save_TCT_OFRReports @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@ofrTroopNum=:ofrTroopNum,@ofrSU=:ofrSU,@troopLeaderFName=:troopLeaderFName,@troopLeaderLName=:troopLeaderLName,@troopLeaderEmail=:troopLeaderEmail,@troopLeaderAddress=:troopLeaderAddress,@troopLeaderCity=:troopLeaderCity,@troopLeaderZip=:troopLeaderZip,@troopLeaderPhone=:troopLeaderPhone,@ofrSame=:ofrSame,@tcmFName=:tcmFName,@tcmLName=:tcmLName,@tcmEmail=:tcmEmail,@tcmAddress=:tcmAddress,@tcmCity=:tcmCity,@tcmZip=:tcmZip,@tcmPhone=:tcmPhone,@girlFName=:girlFName,@girlLName=:girlLName,@parentGuardianFName=:parentGuardianFName,@parentGuardianLName=:parentGuardianLName,@parentGuardianEmail=:parentGuardianEmail,@parentGuardianAddress=:parentGuardianAddress,@parentGuardianCity=:parentGuardianCity,@parentGuardianZip=:parentGuardianZip,@parentGuardianPhone=:parentGuardianPhone,@parentGuardianWorkPhone=:parentGuardianWorkPhone,@parentGuardianCellPhone=:parentGuardianCellPhone,@ofrSubmitter=:ofrSubmitter,@ofrPhone=:ofrPhone,@ofrComment=:ofrComment,@ofrAmountOwed=:ofrAmountOwed,@ofrAmountPaid=:ofrAmountPaid,@ofrAmountDue=:ofrAmountDue,@confirmationID=:confirmationID');
                        //,@ofrComment=:ofrComment,@ofrAmountPaid=:ofrAmountPaid,@ofrAmountDue=:ofrAmountDue,@confirmationID=:confirmationID
                        $stmt->bindParam(':formSecret',$formSecret, PDO::PARAM_STR);
                        $stmt->bindParam(':ipAddress',$ipAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':browser',$arrBrowserString[0], PDO::PARAM_STR);
                        $stmt->bindParam(':browserVersion',$arrBrowserString[1], PDO::PARAM_STR);
                        $stmt->bindParam(':os',$arrBrowserString[2], PDO::PARAM_STR);
                        $stmt->bindParam(':ofrTroopNum',$ofrTroopNum, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrSU',$permSU, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderFName',$troopLeaderFName, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderLName',$troopLeaderLName, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderEmail',$troopLeaderEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderAddress',$troopLeaderAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderCity',$troopLeaderCity, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderZip',$troopLeaderZip, PDO::PARAM_STR);
                        $stmt->bindParam(':troopLeaderPhone',$troopLeaderPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrSame',$ofrSame, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmFName',$tcmFName, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmLName',$tcmLName, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmEmail',$tcmEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmAddress',$tcmAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmCity',$tcmCity, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmZip',$tcmZip, PDO::PARAM_STR);
                        $stmt->bindParam(':tcmPhone',$tcmPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':girlFName',$girlFName, PDO::PARAM_STR);
                        $stmt->bindParam(':girlLName',$girlLName, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianFName',$parentGuardianFName, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianLName',$parentGuardianLName, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianEmail',$parentGuardianEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianAddress',$parentGuardianAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianCity',$parentGuardianCity, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianZip',$parentGuardianZip, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianPhone',$parentGuardianPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianWorkPhone',$parentGuardianWorkPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':parentGuardianCellPhone',$parentGuardianCellPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrSubmitter',$ofrSubmitter, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrPhone',$ofrPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrComment',$ofrComment, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrAmountOwed',$ofrAmountOwed, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrAmountPaid',$ofrAmountPaid, PDO::PARAM_STR);
                        $stmt->bindParam(':ofrAmountDue',$ofrBalanceDueTemp, PDO::PARAM_STR);
                        $stmt->bindParam(':confirmationID',$confirmationID, PDO::PARAM_STR);
                        $stmt->execute();

                       //processEmail($dbh_write,'Outstanding Funds Report for Troop '.$ofrTroopNum,'webmaster@gsnetx.org','Girl Scouts of Northeast Texas','webmaster@gsnetx.org','',$emailMessage,'tbl_TCT_OFR_Reports',$formSecret);

                    //= SEND CONFIRMATION EMAIL TO SUBMITTER ==================================================================================================================
                        if (ping('10.1.1.21', 25, 8) == 1) {
                            //	//echo "GSNETX EMAIL<br>";
                            try {
                                $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                $mailer = Swift_Mailer::newInstance($transport);
                                //= CREATE CONFIRMATION MESSAGE ===================================================================================================================
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO STANDARD
                                $message->setPriority(3);
                                $message->setSubject('Outstanding Funds Report for Troop '.$ofrTroopNum);
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                if($ofrSame == 1) {
                                    $message->setTo(array($troopLeaderEmail));
                                } else {
                                    $message->setTo(array($troopLeaderEmail, $tcmEmail));
                                }
                                $message->setBody($emailMessage, 'text/html');
                                //$message->setCc(array('cookies@gsnetx.org'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker','khoward@gsnetx.org' => 'Kirsten Howard'));
                                // Send the message
                                //$mailer->send($message);
                                //= CREATE NOTIFICATION MESSAGE ===================================================================================================================
                                $message2 = Swift_Message::newInstance();
                                // SET PRIORITY TO STANDARD
                                $message2->setPriority(3);
                                $message2->setSubject('Outstanding Funds Report Filed for Troop '.$ofrTroopNum);
                                $message2->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message2->setTo(array($parentGuardianEmail));
                                $message2->setBody($emailMessage2, 'text/html');
                                //$message->setCc(array('cookies@gsnetx.org'));
                                $message2->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                if (($mailer->send($message)) && ($mailer->send($message2))) {
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_OFR_Reports";
                                    $emailTransport = "gsnetx";
                                    $emailSent = '1';
                                    $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatus @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
                                    $stmt->bindParam('tableName',$tableName,PDO::PARAM_STR);
                                    $stmt->bindParam('formSecret',$formSecret,PDO::PARAM_STR);
                                    $stmt->bindParam('emailTransport',$emailTransport,PDO::PARAM_STR);
                                    $stmt->bindParam('emailSent',$emailSent,PDO::PARAM_STR);
                                    $stmt->execute();
                                    //$dbh_write = null;
                                }
                            } catch (Exception $gsnetxEmail) {
                                echo "Catch ".$gsnetxEmail."<br>";
                                $messageIntro = "There was error updating the email (gsnetx) sent status for the record with ID: ".$formSecret.".\r\n\r\n";
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                            //= CREATE CONFIRMATION MESSAGE ===================================================================================================================
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO STANDARD
                                $message->setPriority(3);
                                $message->setSubject('Error Report From the ACH Cookie Payment Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody($messageIntro.createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gmail'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker','khoward@gsnetx.org' => 'Kirsten Howard'));
                            }
                        } else if (ping('smtp.gmail.com', 587, 3) == 1) {
                            //	//echo "GMAIL EMAIL<br>";
                            try {
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                            //= CREATE CONFIRMATION MESSAGE ===================================================================================================================
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO STANDARD
                                $message->setPriority(3);
                                $message->setSubject('Outstanding Funds Report for Troop '.$ofrTroopNum);
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                if($ofrSame == 1) {
                                    $message->setTo(array($troopLeaderEmail));
                                } else {
                                    $message->setTo(array($troopLeaderEmail, $tcmEmail));
                                }
                                $message->setBody($emailMessage, 'text/html');
                                //$message->setCc(array('cookies@gsnetx.org'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                //$mailer->send($message);
                            //= CREATE NOTIFICATION MESSAGE ===================================================================================================================
                                $message2 = Swift_Message::newInstance();
                                // SET PRIORITY TO STANDARD
                                $message2->setPriority(3);
                                $message2->setSubject('Outstanding Funds Report Filed for Troop '.$ofrTroopNum);
                                $message2->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message2->setTo(array($parentGuardianEmail));
                                $message2->setBody($emailMessage2, 'text/html');
                                //$message->setCc(array('cookies@gsnetx.org'));
                                $message2->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                if (($mailer->send($message)) && ($mailer->send($message2))) {
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_OFR_Reports";
                                    $emailTransport = "gmail";
                                    $emailSent = '1';
                                    $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatus @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
                                    $stmt->bindParam('tableName',$tableName,PDO::PARAM_STR);
                                    $stmt->bindParam('formSecret',$formSecret,PDO::PARAM_STR);
                                    $stmt->bindParam('emailTransport',$emailTransport,PDO::PARAM_STR);
                                    $stmt->bindParam('emailSent',$emailSent,PDO::PARAM_STR);
                                    $stmt->execute();
                                    //$dbh_write = null;
                                }
                            } catch (Exception $gmailError) {
                                echo "CATCH: ".$gmailError;
                                $messageIntro = "There was error updating the email (gmail) sent status for the record with ID: ".$formSecret.".\r\n\r\n";
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('Error Report From the ACH Cookie Payment Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody($messageIntro.createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gmail'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                $mailer->send($message);
                                //$emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email from gsnetx.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }
                        }
                    } catch (PDOException $dbError) {
                        echo "<div style=\"text-align:center;\"><div style=\"border:1px solid #f00;background-color:#fff;padding:10px 5px;margin:10px auto;display:inline-block;\">ERROR: ".$dbError->getMessage()."</div></div>";
                        try {
                            //$transport = Swift_SmtpTransport::newInstance('10.1.1.21', 25);
                            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                            $transport->setUsername('gsnetxweb@gmail.com');
                            $transport->setPassword('divasRock2012');
                            $mailer = Swift_Mailer::newInstance($transport);
                            $message = Swift_Message::newInstance();
                            // SET PRIORITY TO HIGH
                            $message->setPriority(3);
                            $message->setSubject('DB Error Report From the OFR Report Form');
                            $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                            $message->setTo(array('webmaster@gsnetx.org'));
                            //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                            $message->setBody(createTryCatchErrorMessage($dbError, $dbFields, 'gmail'));
                            $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                            // Send the message
                            $mailer->send($message);
                        } catch (Exception $dbEmailError) {
                        }
                        $screenMessage = "<div class=\"errorWrapper\"><div class=\"dataWrapper\">We're sorry, but we're unable to process your information at this time.<br>Our IT department has been notified and is working on the problem.</div></div>";
                    }
                } else {
                //= DUPLICATE RECORD - DO NOT SUBMIT RECORD TO DATABASE =======================================================================================================
                    $screenMessage = "<div class=\"errorWrapper\"><div class=\"duplicateWrapper\">This Outstanding Funds Report has already been submitted.<br>If you need to make additional reports, please start over at the <a href=\"ofr.php\">beginning of the form</a>.</div></div>";
                    // Unset all of the session variables.
                    if(ISSET ($_SESSION)) {
                        //$_SESSION = array();
                        //// If it's desired to kill the session, also delete the session cookie.
                        //// Note: This will destroy the session, and not just the session data!
                        //if (ini_get("session.use_cookies")) {
                        //    $params = session_get_cookie_params();
                        //    setcookie(session_name(), '', time() - 42000,
                        //        $params["path"], $params["domain"],
                        //        $params["secure"], $params["httponly"]
                        //    );
                        //    // Finally, destroy the session.
                        //    session_destroy();
                        //}
                    }
                }
            } else {
                header("location: ofr.php");
            }
        } else {
            header("location: ofr.php");
        }
    } else {
        header("location: ofr.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cookies Outstanding Funds Report - Confirmation</title>
    <meta charset="UTF-8">
    <link href="css/txct.css" rel="stylesheet" type="text/css" />
    <script src="js/vendors/modernizr.js"></script>
</head>
<body class="oneColFixCtr">
<div>
    <?php include('i_cookieHeader.php');?>
    <!-- ## BEGIN FORM MAIN BODY ######################################################################################################### -->
    <div>
        <!-- ## BEGIN PAGE 1 ######################################################################################################### -->
        <div class="no_js">
            <div class="container showWhite" style="position:relative;">
                <div class="span-24" style="height:100px;">&nbsp;</div>
                <div class="span-2"><p>&#32;</p></div>
                <div class="span-20 noscriptNotice" style="text-align:center;"><a href="http://enable-javascript.com/" target="_blank"><img src="img/javascriptDisabled.png" width="500" height="100" border="0" alt="" /></a></div>
                <div class="span-2 last"><p>&#32;</p></div>
                <div class="span-24" style="height:500px;">&nbsp;</div>
                <div class="span-24" style="border-bottom:1px solid #ccc;"><br></div>
            </div>
        </div>
        <div class="has_js">
            <?php if( today>endDate) {?>
                <div class="container showWhite" style="position:relative;">
                    <div class="span-24" style="height:100px;">&nbsp;</div>
                    <div class="span-24"><p>&nbsp;</p></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24"><p>&#32;</p></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20" style="font-size:1.2em;text-align:center;">Outstanding Funds Reporting has closed for another year.<br><br>.</div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24"><p>&nbsp;</p></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24"><p>&#32;</p></div>
                    <div class="span-3"><p>&#32;</p></div>
                    <div class="span-15"></div>
                    <div class="span-4 textRight"></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24" style="margin-bottom:500px;"><br><br><br><br><br><br><br></div>
                </div>
            <?php } else { ?>
                <div class="container showWhite">
                    <div class="span-24"><img src="img/hdr_ACHPayment.png" width="960" height="175" alt="" /></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20"><h1>Outstanding Funds Report Confirmation</h1></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24" style="height:10px;">&nbsp;</div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20"><?php echo $screenMessage;?></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24"><p>&#32;</p></div>
                    <div class="span-24"><p>&#32;</p></div>
                </div>
            <?php }?>
        </div>
    </div>
    <?php include('i_cookieFooter.php');?>
    <!-- ############################################################################################################################# -->
</div>
<script src="//code.jquery.com/jquery-latest.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script src="js/vendors/jquery.maskedinput.js"></script>
<script src="js/vendors/jquery.maskMoney.js"></script>
<script src='js/vendors/jquery.simplemodal.js'></script>
<script src="js/i_texasCookieTime.js" type="text/javascript"></script>
</body>
</html>
