<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    date_default_timezone_set('America/Chicago');
    $testing = "true";
    $date = new DateTime();
    //display_errors   =   Off

    //= HONEYPOT TRAP FOR AUTO SUBMITTING ROBOTS
    //===============================================================================================================================================================
    if (strlen($_POST['labrea']) != 0) {													    //=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
        //echo "Redirect page to home page";
        header("Location:parentPermission.php");											    //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
    }																						    //=	GSNETX HOME PAGE BEFORE THE DATABASE FUNCTIONS ARE ACCCESSED.

    //= CHECK SUBMIT BUTTON STATUS//=====================================================================================================================================
    //= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	=====================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "SUBMIT HTTP REFERRER SET OK<br>";
        session_start();
        require("i_PDOFunctions.php");
        if(truncatePage(strtolower(returnPageName($_SERVER['HTTP_REFERER']))) == 'parentpermission.php') {
            //echo "SUBMIT COMING FROM PARENT PERMISSION HOMEPAGE<br>";
            if (strtolower($_POST["submitRegistration"]) == 'submitparentguardianregistration') {
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                $connectionVar = 'GSNETX';
                require("i_PDOConnection.php");												    //=	CREATES PDO DATA CONNECTION TO DATABASE
                require_once ('lib/swift_required.php');
                //echo "ID: ".returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_PermissionResponsibility',$_POST['formSecret']);
                if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_PermissionResponsibility',$_POST['formSecret']) == '') {
                    setVars('formSecret:str,permGirlFName:str,permGirlLName:str,permGSTroop:str,permSU:int,permPackages:int,permMyEmail:str,permLeadEmail:str,permTCMEmail:str,perm1:str,perm2:str,perm3:str,perm4:str,perm5:str,perm6:str,perm7:str,permCClub:bit,permCC1:str,permCC2:str,permCC3:str,permCC4:str,permParentFName:str,permParentLName:str,permIDType:str,permID:str,permHomeAddress:str,permCity:str,permZip:int,permHomePhone:str,permCellPhone:str,permOption:bit,permGradeLevel:str,permSignedName:str', 0, 0, 'Parent Permission Registration Form');
                    $dbFields = array("Form Secret: ".$formSecret,"Girl FName: ".$permGirlFName,"Girl LName: ".$permGirlLName,"Service Unit: ".$permSU,"Troop Number: ".$permGSTroop,"Packages: ".$permPackages,"Parent Email: ".$permMyEmail,"Leader Email: ".$permLeadEmail,"TCM Email: ".$permTCMEmail,"Perm 1: ".$perm1,"Perm 2: ".$perm2,"Perm 3: ".$perm3,"Perm 4: ".$perm4,"Perm 5: ".$perm5,"Perm 6: ".$perm6,"Perm 7: ".$perm7,"Perm CC: ".$permCClub,"Perm CC1: ".$permCC1,"Perm CC2: ".$permCC2,"Perm CC3: ".$permCC3,"Perm CC4: ".$permCC4,"Parent FName: ".$permParentFName,"Parent LName: ".$permParentLName,"ID Type: ".$permIDType,"ID Number: ".$permID,"Address: ".$permHomeAddress,"City: ".$permCity,"Zip: ".$permZip,"Phone: ".$permHomePhone,"Cell: ".$permCellPhone,"Cash Option: ".$permOption,"Grade Level: ".$permGradLevel,"Signature: ".$permSignedName);
                    $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
                    $arrBrowserString = explode(';', $browserString);
                    $pageTitle = "Parent Permission Responsibility Form";
                    $pageHeader = "ParentPermissionResponsibility";
					$permGirlFName = titleCase($permGirlFName);
					$permGirlLName = titleCase($permGirlLName);
					$permParentFName = titleCase($permParentFName);
					$permParentLName = titleCase($permParentLName);
					$permSignedName = titleCase($permSignedName);
                    //===============================================================================================================================================
                    //= PROCESS DATA FROM FORM	=====================================================================================================================
                    //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE
                    try {
                        //echo "<b>Submit to Database</b><br>";
                        $stmt = $dbh_write->prepare('EXEC sp_Save_TCTPermissionRegistration @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@girlFName=:girlFName,@girlLName=:girlLName,@ServiceUnit=:ServiceUnit,@TroopNumber=:TroopNumber,@numPackages=:numPackages,@MyEmail=:MyEmail,@TroopLeaderEmail=:TroopLeaderEmail,@TCMEmail=:TCMEmail,@perm1=:perm1,@perm2=:perm2,@perm3=:perm3,@perm4=:perm4,@perm5=:perm5,@perm6=:perm6,@perm7=:perm7,@permCClub=:permCClub,@permCC1=:permCC1,@permCC2=:permCC2,@permCC3=:permCC3,@permCC4=:permCC4,@ParentGuardianFName=:ParentGuardianFName,@ParentGuardianLName=:ParentGuardianLName,@SecurityType=:SecurityType,@SecurityNumber=:SecurityNumber,@HomeAddress=:HomeAddress,@City=:City,@ZipCode=:ZipCode,@HomePhone=:HomePhone,@CellPhone=:CellPhone,@CashOption=:CashOption,@GradeLevel=:GradeLevel,@SignedName=:SignedName');
                        $stmt->bindParam(':formSecret', $formSecret, PDO::PARAM_STR);
                        $stmt->bindParam(':ipAddress', $ipAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':browser', $arrBrowserString[0], PDO::PARAM_STR);
                        $stmt->bindParam(':browserVersion', $arrBrowserString[1], PDO::PARAM_STR);
                        $stmt->bindParam(':os', $arrBrowserString[2], PDO::PARAM_STR);
                        $stmt->bindParam(':girlFName', $permGirlFName, PDO::PARAM_STR);
                        $stmt->bindParam(':girlLName', $permGirlLName, PDO::PARAM_STR);
                        $stmt->bindParam(':ServiceUnit', $permSU, PDO::PARAM_STR);
                        $stmt->bindParam(':TroopNumber', $permGSTroop, PDO::PARAM_STR);
                        $stmt->bindParam(':numPackages', $permPackages, PDO::PARAM_STR);
                        $stmt->bindParam(':MyEmail', $permMyEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':TroopLeaderEmail',$permLeadEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':TCMEmail',$permTCMEmail, PDO::PARAM_STR);
                        $stmt->bindParam(':perm1',$perm1, PDO::PARAM_STR);
                        $stmt->bindParam(':perm2',$perm2, PDO::PARAM_STR);
                        $stmt->bindParam(':perm3',$perm3, PDO::PARAM_STR);
                        $stmt->bindParam(':perm4',$perm4, PDO::PARAM_STR);
                        $stmt->bindParam(':perm5',$perm5, PDO::PARAM_STR);
                        $stmt->bindParam(':perm6',$perm6, PDO::PARAM_STR);
                        $stmt->bindParam(':perm7',$perm7, PDO::PARAM_STR);
                        $stmt->bindParam(':permCClub',$permCClub, PDO::PARAM_STR);
                        $stmt->bindParam(':permCC1',$permCC1, PDO::PARAM_STR);
                        $stmt->bindParam(':permCC2',$permCC2, PDO::PARAM_STR);
                        $stmt->bindParam(':permCC3',$permCC3, PDO::PARAM_STR);
                        $stmt->bindParam(':permCC4',$permCC4, PDO::PARAM_STR);
                        $stmt->bindParam(':ParentGuardianFName',$permParentFName, PDO::PARAM_STR);
                        $stmt->bindParam(':ParentGuardianLName',$permParentLName, PDO::PARAM_STR);
                        $stmt->bindParam(':SecurityType',$permIDType, PDO::PARAM_STR);
                        $stmt->bindParam(':SecurityNumber',$permID, PDO::PARAM_STR);
                        $stmt->bindParam(':HomeAddress',$permHomeAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':City',$permCity, PDO::PARAM_STR);
                        $stmt->bindParam(':ZipCode',$permZip, PDO::PARAM_STR);
                        $stmt->bindParam(':HomePhone',$permHomePhone, PDO::PARAM_STR);
                        $stmt->bindParam(':CellPhone',$permCellPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':CashOption',$permOption, PDO::PARAM_STR);
                        $stmt->bindParam(':GradeLevel',$permGradeLevel, PDO::PARAM_STR);
                        $stmt->bindParam(':SignedName',$permSignedName, PDO::PARAM_STR);
                        $stmt->execute();
                        //$stmt = null;
                        //$dbh = null;
                    //===============================================================================================================================================
                        //= CREATE ON-SCREEN CONFIRMATION MESSAGE =======================================================================================================
                        switch ($permIDType) {
                            case "DL":
                                $permIDType = "Driver&rsquo;s License";
                                break;
                            case "ID":
                                $permIDType = "State Issued ID";
                                break;
                        }
                        $confirmationMessage =    "<div class=\"screenMessage\">";
                        $confirmationMessage .=       "<div style=\"margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility Agreement for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
                        $confirmationMessage .=       "<div style=\"margin:8px 0;\">You will receive a confirmation email shortly. A copy will also be sent to your Troop Leader and Troop Cookie Manager.  In the case of missing emails, please forward a copy of the confirmation email to those needing it.  They need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
                        $confirmationMessage .=       "<div style=\"margin:18px 0;\">Thank you!</div>";
                        $confirmationMessage .=       "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $confirmationMessage .=       "<div class=\"grayDottedDivider\">&#32;</div>";
                        $confirmationMessage .=       "<div>If you have any additional questions, please contact <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Girl Scout Cookie Program\">cookies@gsnetx.org</a> or call (972)349-2400.<br><br></div>";
                        $confirmationMessage .=   "</div>";

                        //= CREATE CONFIRMATION EMAIL MESSAGE ===========================================================================================================

                        $emailMessage   =   "<div style=\"margin:0 auto;width:600px;font:9pt/13pt verdana,arial,sans-serif;\">";
                        $emailMessage  .=       "<div style=\"font-size:9pt;line-height:13pt;margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility Agreement for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
                        $emailMessage  .=       "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">The information you submitted is summarized below.  Keep this email for your records.  A copy of this email has also been sent to your Troop Leader and Troop Cookie Manager.  Please check with them to verify that they received your information - they will need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
                        $emailMessage  .=       "<div style=\"margin:18px 0;\">Thank you!</div>";
                        $emailMessage  .=       "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $emailMessage  .=       "<div style=\"border-top:1px dotted #999;height:1px;margin-top:15px;padding-top:15px;\">&#160;</div>";
                        $emailMessage  .=       "<div style=\"margin:5px 0;font-size:.9em;\">If you have any additional questions, please contact <a href=\"mailto:cookies@gsnetx.org?subject=Question about The Parent/Guardian Permission and Responsibility Form\">cookies@gsnetx.org</a> or call (972)349-2400.<br></div>";
                        $emailMessage  .=       "<table cellpadding=\"8\" cellspacing=\"0\" style=\"width:610px;padding:4px;\">";
                        $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;\"><strong>Parent/Guardian Permission and Responsibility Form</strong></th></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Girl Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . titleCase($permGirlFName) . " " . titleCase(stripslashes($permGirlLName)) . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Packages Ordered:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permPackages . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Troop Number:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permGSTroop . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Service Unit:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permSU . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Troop Leader Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permLeadEmail . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Cookie Manager Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permTCMEmail . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Parent/Guardian Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permMyEmail . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Parent/Guardian Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . titleCase($permParentFName) . " " . titleCase($permParentLName) . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Address:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . titleCase($permHomeAddress) . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\"></td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . titleCase($permCity).", TX ".$permZip. "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Home Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permHomePhone . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Cell Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permCellPhone . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Type:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . stripslashes($permIDType) . "</td></tr>";
                        $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Number Ending in:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . substr($permID, -4) . "</td></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;border:none;\">Acknowledgements and Agreements</th></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">By submitting this form, the submitter has acknowledged that:</td></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:1px solid #ccc;border-collapse:collapse;\">";
                        $emailMessage  .=               "<ul style=\"margin:4px 10px 8px 25px;\">";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I agree to accept <span style=\"font-weight:bold;text-decoration:underline;\">full</span> financial responsibility for all cookies and money my Girl Scout receives.</li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I will see that: my Girl Scout has adult guidance at all times; no cookie orders are taken prior to the official starting date of January 15, 2016; payment for cookies is not collected prior to delivery to customers; and cookies are not paid for on the internet.</li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that cookie payment deadlines as set by my Troop Cookie Manager/Leader should be met along with the final payment due at the end of the Cookie Program.  If not, an Outstanding Funds Report will be completed for the balance due and Girl Scouts of Northeast Texas will take collection action. </li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that all cookies ordered by my Girl Scout are considered sold and may not be returned.</li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand girl reward items are ordered only for eligible girls whose full balance is paid by the end of the program. I understand if money is not received on time, my Girl Scout will not receive reward items.</li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that if I or my Girl Scout owes money 60 days past March 7, 2016 I cannot serve in any volunteer capacity until the account is paid in full. Any balances owed are considered outstanding until paid in full.</li>";
                        $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that if I or my Girl Scout owes money, she cannot participate in the Cookie Program until the balance is paid in full.</li>";
                        $emailMessage  .=               "</ul>";
                        $emailMessage  .=           "</td></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;border:none;\">Cookie Club Participation</th></tr>";
                        if ($permCClub == true) {
                            $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">By submitting this form, the submitter has acknowledged that:</td></tr>";
                            $emailMessage .=        "<tr><td colspan=\"2\" style=\"border:1px solid #ccc;border-collapse:collapse;\">";
                            $emailMessage .=            "<ul style=\"margin:4px 10px 8px 25px;\">";
                            $emailMessage .=                "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that online payment for cookies is not allowed.</li>";
                            $emailMessage .=                "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that it is my responsibility to review my Girl Scout&rsquo;s Cookie Club &ldquo;promises&rdquo; to ensure they are genuine orders from customers.</li>";
                            $emailMessage .=                "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that my Girl Scout&rsquo;s personal email information should not be provided to the customer.</li>";
                            $emailMessage .=                "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I support my Girl Scout in using the Cookie Club online goal-setting and email tools.</li>";
                            $emailMessage .=            "</ul>";
                            $emailMessage .=        "</td></tr>";
                        } else {
                            $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:5px 10px;border:1px solid #ccc;border-collapse:collapse;font-weight:normal;\">The submitter has chosen to not participate in Cookie Club.</td></tr>";
                        }
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;border:none;\">Cash Option for Older Girls</th></tr>";
                        if($permOption== true) {
                            $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">The submitter has chosen the cash option for: ".$permGradeLevel."s</td></tr>";
                        } else {
                            $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:5px 10px;border:1px solid #ccc;border-collapse:collapse;font-weight:normal;\">The submitter has chosen to not participate in the cash option.</td></tr>";
                        }
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">Acknowledged and Signed by: </td></tr>";
                        $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">" . titleCase($permSignedName) . " - " . $date->format('F j, Y g:i a - T') . "</td></tr>";
                        $emailMessage  .=       "</table>";
                        $emailMessage  .=   "</div>";



                        if (ping('10.1.1.21', 25, 8) == 1) {
                            //echo "GSNETX EMAIL<br>";
                            try {
                                $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                //SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('GSNETX Parent Permission & Responsibility Agreement Confirmation');
                                $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                $message->setTo(array($permMyEmail,$permLeadEmail,$permTCMEmail));
                                $message->setBody($emailMessage, 'text/html');
                                $message->setCc(array('cookies@gsnetx.org'));
                                $message->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                //$mailer->send($message);
                                if ($mailer->send($message)) {
                                    //echo "<strong>EMAIL SENT FROM GSNETX MAIL<br><br></strong>";
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_PermissionResponsibility";
                                    $emailTransport = "gsnetx";
                                    $emailSent = '1';
                                    $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatus @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
                                    $stmt->bindParam('tableName',$tableName,PDO::PARAM_STR);
                                    $stmt->bindParam('formSecret',$formSecret,PDO::PARAM_STR);
                                    $stmt->bindParam('emailTransport',$emailTransport,PDO::PARAM_STR);
                                    $stmt->bindParam('emailSent',$emailSent,PDO::PARAM_STR);
                                    $stmt->execute();
                                }
                            } catch (Exception $gsnetxEmail) {
                                //echo "Catch ".$gsnetxEmail."<br>";
                                $messageIntro = "There was error updating the email (gsnetx) sent status for the record with ID: ".$formSecret.".\r\n\r\n";
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('Error Report From the TXCT Parent Permission Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody($messageIntro.createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gmail'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                $mailer->send($message);
                                //$emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email from gsnetx.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }
                        } else if (ping('smtp.gmail.com', 587, 3) == 1) {
                            //echo "GMAIL EMAIL<br>";
                            try {
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('GSNETX Parent Permission & Responsibility Agreement Confirmation');
                                $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                $message->setTo(array($permMyEmail,$permLeadEmail,$permTCMEmail));
                                //$message->setTo(array('barker323@gmail.com'));
                                $message->setBody($emailMessage, 'text/html');
                                $message->setCc(array('cookies@gsnetx.org'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                //$mailer->send($message);
                                if ($mailer->send($message)) {
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_PermissionResponsibility";
                                    $emailTransport = "gmail";
                                    $emailSent = '1';
                                    $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatus @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
                                    $stmt->bindParam('tableName',$tableName,PDO::PARAM_STR);
                                    $stmt->bindParam('formSecret',$formSecret,PDO::PARAM_STR);
                                    $stmt->bindParam('emailTransport',$emailTransport,PDO::PARAM_STR);
                                    $stmt->bindParam('emailSent',$emailSent,PDO::PARAM_STR);
                                    $stmt->execute();
                                }
                            } catch (Exception $gmail) {
                                $messageIntro = "There was error updating the email (gMail) sent status for the record with ID: ".$formSecret.".\r\n\r\n";
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('Email Error Report From the Parent Permission Registration Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody(createTryCatchErrorMessage($gmail,$dbFields,'gmail'));
                                $message->setBody( $messageIntro.$gmail, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                $mailer->send($message);
                                $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email from gmail.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }
                        }
                    } catch (Exception $dbError) {
                        //- IN PRODUCTION, EMAIL THE ERROR MESSAGE TO THE WEBMASTER ACCOUNT -----------------------------------------------------------------------------------
                        try {
                            //$transport = Swift_SmtpTransport::newInstance('10.1.1.21', 25);
                            $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                            $transport->setUsername('gsnetxweb@gmail.com');
                            $transport->setPassword('divasRock2012');
                            $mailer = Swift_Mailer::newInstance($transport);
                            $message = Swift_Message::newInstance();
                            // SET PRIORITY TO HIGH
                            $message->setPriority(3);
                            $message->setSubject('DB Error Report From the Parent Permission Registration Form');
                            $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                            $message->setTo(array('webmaster@gsnetx.org'));
                            //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                            $message->setBody(createTryCatchErrorMessage($dbError, $dbFields, 'gmail'));
                            $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                            // Send the message
                            $mailer->send($message);
                        } catch (Exception $dbEmailError) {
                        }
                        $databaseErrorMessage = "<div class=\"dataWrapper\">We're sorry, but we're unable to process your information at this time.<br>Our IT department has been notified and is working on the problem.</div>";
                        //echo createTryCatchErrorMessage($dbError, $dbFields, 'gmail');
                    }
                } else {
                    //= DUPLICATE RECORD - DO NOT SUBMIT RECORD TO DATABASE =========================================================================================
                    $duplicateErrorMessage = "<div class=\"duplicateWrapper\">This request has already been submitted. If you wish to submit another, please start at the <a href=\"default.php\">beginning of the form</a>.</div>";
                    //echo $duplicateErrorMessage."<br>";
                    // Unset all of the session variables.
                    $_SESSION = array();
                    // If it's desired to kill the session, also delete the session cookie.
                    // Note: This will destroy the session, and not just the session data!
                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                        );
                        // Finally, destroy the session.
                        session_destroy();
                    }
                }
            } else {
//				echo "SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
                session_unset();
                session_destroy();
                header("location: parentPermission.php");
            }
        } else {
//            echo "HTTP_REFERRER NOT COMING FROM PARENT PERMISSION REGISTRATION - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
            //exit();
            session_unset();
            session_destroy();
            header("location: parentPermission.php");
        }
    } else {
//		echo "HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
//		exit;
        session_unset();
        session_destroy();
        header("location: parentPermission.php");
    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Parent/Guardian Permission and Responsibility Registration Form Confirmation</title>
        <meta charset="UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div>
            <?php include('i_cookieHeader.php');?>
            <div>
                <div class="container" style="position:relative;background-color:#00ae58;">
                    <div class="span-24" style="height:175px;"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                    <div class="span-24 contentWrapper showWhite">
                        <div class="span-24 marginTop10 marginBottom20">
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Registration Confirmation</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20">
                                <?php
                                if (($databaseErrorMessage != '') || ($emailErrorMessage != '') || ($duplicateErrorMessage != '')) {
                                    echo "<div class=\"errorWrapper\">";
                                    if ($databaseErrorMessage != '') {
                                        echo $databaseErrorMessage;
                                    } else if ($emailErrorMessage != '') {
                                        echo $emailErrorMessage;
                                    } else if ($duplicateErrorMessage != '') {
                                        echo $duplicateErrorMessage;
                                    }
                                    echo "</div>";
                                } else {
                                    echo $confirmationMessage;
                                }
                                ?>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                        </div>
                    </div>
                    <?php include('i_cookieFooter.php');?>
                </div>
            </div>
        </div>
		<div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
	</body>
</html>
