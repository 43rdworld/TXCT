<?php
	error_reporting (E_ALL ^ E_NOTICE);
	header('X-UA-Compatible: IE=edge,chrome=1');
	header('Cache-Control: max-age=30, must-revalidate');
	date_default_timezone_set('America/Chicago');
	$testing = "true";
	$date = new DateTime();
    //display_errors   =   Off

//= HONEYPOT TRAP FOR AUTO SUBMITTING ROBOTS
//==============================================================================================================================================================
	if (strlen($_POST['labrea']) != 0) {													    //=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
		//echo "Redirect page to home page";
//		header("Location:http://www.gsnetx.org");											    //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
	}																						    //=	GSNETX HOME PAGE BEFORE THE DATABASE FUNCTIONS ARE ACCCESSED.

//= CHECK SUBMIT BUTTON STATUS//================================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "SUBMIT HTTP REFERRER SET OK<br>";
        session_start();
        require("i_ODBC_Functions.php");
        require("includes/i_ParentPermissionSettings.php");
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM ===========================================================================================
        if(strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 'parentpermission.php') {
//            echo "SUBMIT COMING FROM PARENT PERMISSION HOMEPAGE<br>";
            if (strtolower($_POST["submitRegistration"]) == 'submitparentguardianregistration') {
                //echo "SUBMIT VALUE OK<br>";
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                if($_SERVER['COMPUTERNAME'] == 'RODBY') {
                    $connectionVar = 'GSNETX';
                } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {
                }
                require("i_ODBC_Connection.php");												//=	CREATES ODBC DATA CONNECTION TO DATABASE
                //	require_once('class.phpmailer.php');
                require_once ('lib/swift_required.php');
                $ipAddress = getIPAddr();
                setVars('permGirlFName:str,permGirlLName:str,permGSTroop:str,permSU:int,permPackages:int,permMyEmail:str,permLeadEmail:str,permTCMEmail:str,perm1:str,perm2:str,perm3:str,perm4:str,perm5:str,permCClub:bit,permCC1:str,permCC2:str,permCC3:str,permCC4:str,permParentFName:str,permParentLName:str,permIDType:str,permID:str,permHomeAddress:str,permCity:str,permZip:int,permHomePhone:str,permCellPhone:str,permOption:bit,permGradLevel:str,permSignedName:str', 0, 0, 'Permission Form');
                $pageTitle = "Parent/Guardian Permission and Responsibility Agreement";
                $pageHeader = "ParentPermissionResponsibility";
                //==============================================================================================================================================
                //= PROCESS DATA FROM FORM	====================================================================================================================
                //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE	                                                               =
                //==============================================================================================================================================
                $ckSQL = "select id,emailSent from tbl_TCT_PermissionResponsibility where formSecret = '" . $formSecret . "'";
                $rs = odbc_exec($writeConn, $ckSQL);
                $id = odbc_result($rs, 'id');
                $emailSent = odbc_result($rs, 'emailSent');
                //echo "SQL: ".$ckSQL."<br>";
                //echo "ID: ".$id."<br>";
                //echo "Email Sent: ".$emailSent."<br>";
                if ($id == '') {
                    $sql = "{CALL sp_Save_TCTPermissionRegistration(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";
                    $stmt = odbc_prepare($writeConn, $sql);
                    $success = odbc_execute($stmt, array(
                        $formSecret,
                        $ipAddress,
                        nameize($permGirlFName),
                        nameize($permGirlLName),
                        $permGSTroop,
                        $permSU,
                        $permPackages,
                        $permMyEmail,
                        $permLeadEmail,
                        $permTCMEmail,
                        $perm1,
                        $perm2,
                        $perm3,
                        $perm4,
                        $perm5,
                        $permCClub,
                        $permCC1,
                        $permCC2,
                        $permCC3,
                        $permCC4,
                        nameize($permParentFName),
                        nameize($permParentLName),
                        $permIDType,
                        $permID,
                        nameize($permHomeAddress),
                        nameize($permCity),
                        $permZip,
                        $permHomePhone,
                        $permCellPhone,
                        $permOption,
                        $permGradLevel,
                        nameize($permSignedName)
                    ));
                    odbc_close($writeConn);
                    //*******************************************************************************
                    //** CREATE ON-SCREEN CONFIRMATION MESSAGE																			*
                    //*******************************************************************************
                    switch ($volIDType) {
                        case "DL":
                            $volIDType = "Driver&rsquo;s License";
                            break;
                        case "ID":
                            $volIDType = "State Issued ID";
                            break;
                    }
                    $screenMessage =    "<div class=\"screenMessage\" style=\"font-size:10pt;line-height:13pt;\">";
                    $screenMessage .=       "<div style=\"margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility Agreement for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
                    $screenMessage .=       "<div style=\"margin:8px 0;\">You will receive a confirmation email shortly. A copy will also be sent to your Troop Leader and Troop Cookie Manager.  In the case of missing emails, please forward a copy of the confirmation email to those needing it.  They need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
                    $screenMessage .=       "<div style=\"margin:18px 0;\">Thank you!</div>";
                    $screenMessage .=       "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                    $screenMessage .=       "<div class=\"grayDottedDivider\"><img src=\"images/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                    $screenMessage .=       "<div style=\"margin:5px 0;\">If you have any additional questions, please contact <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Girl Scout Cookie Program\">cookies@gsnetx.org</a> or call (972)349-2400.<br><br></div>";
                    $screenMessage .=   "</div>";
                    $emailMessage   =   "<div style=\"margin:0 auto;width:600px;font:9pt/13pt verdana,arial,sans-serif;\">";
                    $emailMessage  .=       "<div style=\"font-size:9pt;line-height:13pt;margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility Agreement for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
                    $emailMessage  .=       "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">The information you submitted is summarized below.  Keep this email for your records.  A copy of this email has also been sent to your Troop Leader and Troop Cookie Manager.  Please check with them to verify that they received your information - they will need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
                    $emailMessage  .=       "<div style=\"margin:18px 0;\">Thank you!</div>";
                    $emailMessage  .=       "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                    $emailMessage  .=       "<div style=\"border-top:1px dotted #999;height:1px;margin-top:15px;padding-top:15px;\"><img src=\"images/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                    $emailMessage  .=       "<div style=\"margin:5px 0;font-size:.9em;\">If you have any additional questions, please contact <a href=\"mailto:cookies@gsnetx.org?subject=Question about The Parent/Guardian Permission and Responsibility Form\">cookies@gsnetx.org</a> or call (972)349-2400.<br></div>";
                    $emailMessage  .=       "<table cellpadding=\"8\" cellspacing=\"0\" style=\"width:610px;padding:4px;\">";
                    $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;\"><strong>Parent/Guardian Permission and Responsibility Form</strong></th></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Girl Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . strtotitle($permGirlFName) . " " . strtotitle(stripslashes($permGirlLName)) . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Packages Ordered:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permPackages . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Troop Number:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permGSTroop . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Service Unit:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permSU . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Troop Leader Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permLeadEmail . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Cookie Manager Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permTCMEmail . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Parent/Guardian Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permMyEmail . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Parent/Guardian Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . nameize($permParentFName) . " " . nameize($permParentLName) . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Address:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . nameize($permHomeAddress) . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\"></td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . nameize($permCity).", TX ".$permZip. "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Home Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permHomePhone . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Cell Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $permCellPhone . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Type:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . stripslashes($permIDType) . "</td></tr>";
                    $emailMessage  .=           "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Number Ending in:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . substr($permID, -4) . "</td></tr>";
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                    $emailMessage  .=           "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;border:none;\">Acknowledgements and Agreements</th></tr>";
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">By submitting this form, the submitter has acknowledged that:</td></tr>";
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:1px solid #ccc;border-collapse:collapse;\">";
                    $emailMessage  .=               "<ul style=\"margin:4px 10px 8px 25px;\">";
                    $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I agree to accept <span style=\"font-weight:strong;text-decoration:underline;\">full</span> financial responsibility for all cookies and money my Girl Scout receives.</li>";
                    $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I will see that my Girl Scout has adult guidance at all times, that no cookie orders are taken prior to the official starting date of January 16, 2015, payment for cookies is not collected prior to delivery to customers and cookies are not paid for on the internet.</li>";
                    $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">understand that payments for the cookies need to be made as set by my Troop Leader and Troop Cookie Manager/Leader with the final payment made balance by the end of the Cookie Program or an Outstanding Funds Report will be completed for the balance due amount outstanding and Girl Scouts of Northeast Texas will take collection action.</li>";
                    $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that all cookies ordered by my Girl Scout are considered sold and may not be returned.</li>";
                    $emailMessage  .=                   "<li style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand girl reward items are ordered only for eligible girls whose full balance is paid by the end of the program. I understand if money is not received on time, my Girl Scout will not receive reward items.</li>";
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
                        $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">The submitter has chosen the cash option for: ".$permGradLevel."s</td></tr>";
                    } else {
                        $emailMessage .=        "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:5px 10px;border:1px solid #ccc;border-collapse:collapse;font-weight:normal;\">The submitter has chosen to not participate in the cash option.</td></tr>";
                    }
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">Acknowledged and Signed by: </td></tr>";
                    $emailMessage  .=           "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">" . strtotitle($permSignedName) . " - " . $date->format('F j, Y g:i a - T') . "</td></tr>";
                    $emailMessage  .=       "</table>";
                    $emailMessage  .=   "</div>";
                    /* END DATA PROCESS BLOCK ********************************************************************************/
                    //= EMAIL NOTIFICATION TO ???? ==================================================================
                        // CREATE TRANSPORT CONFIG
                        //                    $transport = Swift_MailTransport::newInstance('smtp.gmail.com',587,'tls');
                        //                    $transport->setUsername('barker323@verizon.net');
                        //                    $transport->setPassword('Man$3ll1992!!');
                        //                    // CREATE MSG
                        //                    $message = Swift_Message::newInstance();
                        //                    // SET PRIORITY TO HIGH
                        //                    $message->setPriority(2);
                        //                    // SUBJECT
                        //                    $message->setSubject('Subject');
                        //                    // FROM
                        //                    $message->setFrom(array('webmaster@gsnetx.org'));
                        //                    // TO
                        //                    $message->setTo(array('barker323@verizon.net'));
                        //                    // EMAIL BODY
                        //                    $message->setBody($emailMessage);
                        //                    // SEND

                    if($emailSent == 0) {
                        $transport = Swift_MailTransport::newInstance('10.1.1.21', 25);
                        $mailer = Swift_Mailer::newInstance($transport);
                        $message = Swift_Message::newInstance();
                        // SET PRIORITY TO HIGH
                        $message->setPriority(3);
                        $message->setSubject('Parent Permission & Responsibility Agreement Confirmation');
                        $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                        $message->setTo(array($permMyEmail,$permLeadEmail,$permTCMEmail));
                        $message->setBody($emailMessage, 'text/html');
                        $message->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));;

                            // Send the message
                            $result = $mailer->send($message);
                            //  echo "here2";
                            if (!$mailer->send($message, $failures)) {
                                //echo "Failures:";
                                print_r($failures);
                                $screenMessage  =   "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
                                $screenMessage .=       "<div style=\"font-weight:bold;color:#900;\">Unfortunately, your confirmation email was not sent.</div>";
                                $screenMessage .=       "<div style=\"margin: 10px 0 70px 0;color:#333;\">Please refresh the screen to try again. Your registration will not be re-submitted.</div>";
                                $screenMessage .=   "</div>";
                                $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_TCT_PermissionResponsibility','" . $formSecret . "',0)}");
                                odbc_execute($results, array());
                            } else {
                                $screenMessage  = "<div style=\"margin:0 auto;width:775px;\">";
                                $screenMessage .=   "<div style=\"margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility form for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
                                $screenMessage .=   "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">You will receive an email shortly, confirming your registration and containing a copy of all the information just submitted.</div>";
                                $screenMessage .=   "<div style=\"margin:8px 0;\">A copy will also be sent to your Troop Leader and Troop Cookie Manager. In the case of missing emails, please forward a copy of the confirmation email to those needing it. They need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
                                $screenMessage .=   "<div style=\"margin:8px 0;\">&#32;</div>";
                                $screenMessage .=   "<div style=\"margin:12px 0 ;\">Thank you</div>";
                                $screenMessage .=   "<div style=\"margin:0;\">Girl Scouts of Northeast Texas</div>";
                                $screenMessage .=   "<div class=\"grayDottedDivider\"><img src=\"https://www.texascookietime.org/img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                                $screenMessage .=   "<div style=\"margin:5px 0;\">If you have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookies@gsnetx.or</a> or call (972)349-2400.</div><br><br>";
                                $screenMessage .= "</div>";
                                $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_TCT_PermissionResponsibility','" . $formSecret . "',1)}");
                                odbc_execute($results, array());
                            }
                        } else {
                            $screenMessage =    "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
                            $screenMessage .=       "<div style=\"font-weight:bold;color:#900;\">An email has already be sent for this registration.</div>";
                            $screenMessage .=       "<div class=\"grayDottedDivider\"><img src=\"img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                            $screenMessage .=       "<div style=\"margin:5px 0;\">If you do not receive your confirmation or have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookiesk@gsnetx.or</a> or call (972)349-2400.</div><br><br></div>";
                            $screenMessage .=   "</div>";
                        }
                } else {
                    $screenMessage =    "<div class=\"screenMessage\" style=\"font-size:10pt;line-height:14pt;\">";
                    $screenMessage .=       "<div style=\"margin:10px 0;font:10pt/15pt verdana,arial,sans-serif;\">Information from this form had already been submitted.</div>";
                    $screenMessage .=       "<div style=\"font:10pt/15pt verdana,arial,sans-serif;margin:8px 0;\">If you need to submit another permission form, please start at the <a href=\"parentPermission.php\">beginning of the form</a>.</div>";
                    $screenMessage .=       "<div class=\"messageDivider2\">&#32;</div>";
                    $screenMessage .=       "<div style=\"margin:10px 0;font:10pt/15pt verdana,arial,sans-serif;\">If you have any questions, contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnex.org?subject=Cookie Question\">cookies@gsnetx.org</a> or 972-349-2400. </div>";
                    $screenMessage .=   "</div>";
                }
            } else {
            //echo "SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
            session_unset();
            session_destroy();
            //header("location: parentPermission.php");
            }
        } else {
        }
	} else {
    //echo "HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
        session_unset();
        session_destroy();
//		header("location: default.php");
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
            <div class="container" style="position:relative;background-color:#00ae58;">
                <div class="span-7"><img src="img/gsnetxLogo_White.png" width="225" height="96" alt="Girl Scouts of Northeast Texas" id="gsnetxLogo" /></div>
                <div class="span-17 last">
                    <div id="searchWrapper">
                        <div id="eyebrow">
                            <ul>
                                <li><a href="#">Financial Literacy</a></li>
                                <li><a href="#" target="_blank">eBudde</a></li>
                                <li><a href="http://www.littlebrowniebakers.com/" target="_blank">Little Brownie Bakers</a></li>
                            </ul>
                        </div>
                        <div id="siteSearch"><input type="text" id="search" name="search" class="searchTerm" value="" /><label for="search"></label></label></div>
                    </div>
                </div>
                <div class="span-24" style="background-color:#009447;width:960px;">
                    <div id="navWrapper">
                        <ul class="siteNavList">
                            <li><a href="http://www.texascookietime.org">HOME</a></li>
                            <li><a href="http://www.texascookietime.org/girl-scout-cookies.html">GIRL SCOUT COOKIES</a></li>
                            <li><a href="http://www.texascookietime.org/families.html">FAMILIES</a></li>
                            <li><a href="http://www.texascookietime.org/volunteers.html">VOLUNTEERS</a></li>
                            <li><a href="http://www.texascookietime.org/forms.html">FORMS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                <div class="span-24 contentWrapper showWhite">
                    <div class="span-24 marginTop10 marginBottom20">
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20"><h1>Registration Confirmation</h1></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="height:10px;">&nbsp;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20"><?php echo $screenMessage;?></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="height:10px;">&nbsp;</div>
                    </div>
                </div>
                <div class="span-24">
                    <div id="footerWrapper">
                        <div id="copyRight">&copy; <?php auto_copyright();?> Girl Scouts of Northeast Texasz</div>
                        <div id="socialMedia">
                            <a href="https://twitter.com/GSNETXcouncil" target="_blank"><img src="img/twitter_30_white.png" width="30" height="30" /></a>
                            <a href="https://www.facebook.com/GSNETX?ref=ts" target="_blank"><img src="img/facebook_30_white.png" width="30" height="30" /></a>
                            <a href="https://www.youtube.com/channel/UC4uxrvCdVYkGzLZdocf1aHQ" target="_blank"><img src="img/youtube_30_white.png" width="30" height="30" /></a>
                            <a href="http://instagram.com/gsnetxcouncil" target="_blank"><img src="img/instagram_30_white.png" width="30" height="30" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</body>
</html>
