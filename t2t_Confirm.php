<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    date_default_timezone_set('America/Chicago');
    ini_set("display_errors", 1);
    $selectEvent = '';
    $formSecret = '';

    if (strlen($_POST['labrea']) != 0) {							//=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
        //		echo "Redirect page to home page";
        header("Location:default.php");								//= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
    }
    //= CHECK SUBMIT BUTTON STATUS ============================================================================================================================================
    //= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	===========================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "HERE<br>";
        require("i_PDOFunctions.php");
        setRegistrationParams('10/01/2015','03/11/2016');
        //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE T2T REVIEW FORM 	======================================================================
        if(strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 't2t_review.php') {
            //=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==================================================================
            if (strtolower($_POST["submitReview"]) == 'submitt2treview') {
                $formSecret=$_POST['formSecret'];							            //= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");
                require_once ('lib/swift_required.php');
                session_start();
                //echo "RAND: ".$_SESSION['rand']."<br>";
                if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_Troop2Troop_Donations',$_POST['formSecret']) == '') {
                    $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
                    $arrBrowserString = explode(';', $browserString);
                    $key = returnEncryptionKey($dbh, 'EXEC sp_GetDataPoint :tableName, :field, :id', 'tbl_Randoms', 'id', $_POST["rand"]);
                    setVars('formSecret:str,t2tFName:str,t2tLName:str,t2tAddress:str,t2tAddress2:str,t2tCity:str,t2tState:str,t2tZip:int,t2tPhone:str,t2tEmail:str,t2tAmount:int,t2tRefer:str,t2tReferringTroop:str,t2tReferringName:str,billingSame:bit,billingFName:str,billingLName:str,billingAddress:str,billingAddress2:str,billingCity:str,billingState:str,billingZip:int,billingPhone:str,billingEmail:str', 1, 0, null, 'Common Fields');
                    $dbFields = array("formSecret:" . $formSecret, "ipAddress:" . $ipAddress, "browser:" . $arrBrowserString[0], "browserVersion:" . $arrBrowserString[1], "os:" . $arrBrowserString[2], "t2tDate:" . $t2tDate, "t2tFName:" . $t2tFName, "t2tLName:" . $t2tLName, "t2tAddress:" . $t2tAddress, "t2tAddress2:" . $t2tAddress2, "t2tCity:" . $t2tCity, "t2tState:" . $t2tState, "t2tZip:" . $t2tZip, "t2tPhone:" . $t2tPhone, "t2tEmail:" . $t2tEmail, "t2tRefer:" . $t2tRefer, "t2tReferringTroop:" . $t2tReferringTroop, "t2tReferringName:" . $t2tReferringName, "t2tAmount:" . $t2tAmount, "t2tAuthCode:" . $t2tAuthCode, "t2tInvoiceNum:" . $t2tInvoiceNum, "t2tConfirmationID:" . $t2tConfirmationID, "emailSent:" . $emailSent, "emailTransport:" . $emailTransport, "emailSentDate:" . $emailSentDate, "rand:" . $rand);
                    $ccType = $_POST['ccType'];
                    $ccNum = $_POST['ccNum'];
                    $ccExpMonth = $_POST['ccExpMonth'];
                    $ccExpYear = $_POST['ccExpYear'];
                    $ccCVV2 = $_POST['ccCVV2'];
                    $t2tFullAddress = $t2tAddress;
                    if (strlen($t2tAddress2) > 0) {
                        $t2tFullAddress .= ", " . $t2tAddress2 . "<br>";
                    } else {
                        $t2tFullAddress .= "<br>";
                    }
                    $t2tFullAddress .= $t2tCity . ", " . $t2tState . "&nbsp;&nbsp;" . $t2tZip;
                    $t2tName = $t2tFName . " " . $t2tLName;
                    $eventTitle = "Girl Scouts of Northeast Texas Project Troop To Troop Donation.\n";
                    //echo "<br><br>PROCESS CC<br>";
                    //echo "CC: ".cc_decrypt($ccNum, $key)."<br>";
                    //echo "CVV2: ".cc_decrypt($ccCVV2, $key)."<br>";
                    //
                    //echo "CERTPATH: ".$certpath."<br>";
                //=============================================================================================================================================================
                //=  USA ePay PHP LIBRARY                                                                                                                                     =
                //=============================================================================================================================================================
                   //      v1.6
                   //      Copyright (c) 2002-2008 USA ePay
                   //      For support please contact devsupport@usaepay.com
                   //
                   //      The following is an example of running a transaction using the php library.
                   //      Please see the README file for more information on usage.
                   //      Change this path to the location you have save usaepay.php to
                   include ("usaepay.php");
                // INSTANTIATE USAePay CLIENT OBJECT ==========================================================================================================================
                    $tran=new umTransaction;
                    //$tran->cabundle='<//?php echo $certpath?//>';
                    $tran->cabundle='c:\windows\curl-ca-bundle.crt';
                // MERCHANTS SOURCE KEY MUST BE GENERATED WITHIN THE CONSOLE ==================================================================================================
                    //$tran->key="GhMFgFhudvuq1c2g40mpv9ayfV1n5Cl3";   	    //-- SANDBOX KEY ----------------------------------------------------------------------------------
                    $tran->key="ZuND3pA2uHn7QA7I0KwIpv2SJjSfJk9f";			//-- PRODUCTION KEY FOR REGISTRATON EVENT ---------------------------------------------------------
                // SEND REQUEST TO SANDBOX SERVER, NOT PRODUCTION. MAKE SURE TO COMMENT OR REMOVE THIS LINE BEFORE PUTTING YOUR CODE INTO PRODUCTION ==========================
                    //$tran->usesandbox=true;
                    //$tran->testmode=true;
                    $invoiceNum = makePin('T2T',6);
                    $tran->card=cc_decrypt($ccNum, $key);
                    $tran->exp=$ccExpMonth.$ccExpYear;
                    $tran->amount=($t2tAmount*4);
                    $tran->invoice=$invoiceNum;
                    $tran->cardholder=stripslashes(stripslashes(stripslashes(titleCase($billingFName)))).' '.stripslashes(stripslashes(stripslashes(titleCase($billingLName))));
                    $tran->street=nameize($billingAddress);
                    $tran->zip=$billingZip;
                    $tran->description=$eventTitle;
                    $tran->cvv2= cc_decrypt($ccCVV2, $key);
                    $tran->custemail = $billingEmail;
                    $tran->custreceipt='yes';
                    $tran->billfname=stripslashes(stripslashes(stripslashes(titleCase($billingFName))));
                    $tran->billlname=stripslashes(stripslashes(stripslashes(titleCase($billingLName))));
                    $tran->billstreet=stripslashes(stripslashes(stripslashes(titleCase($billingAddress))));
                    $tran->billcity=stripslashes(stripslashes(stripslashes(titleCase($billingCity))));
                    $tran->billstate=$billingState;
                    $tran->billzip=$billingZip;
                    $tran->billphone=$billingPhone;
                    //echo "<h1>Please Wait One Moment While We process your card.</h1><br>\n";
                    flush();
                    if($tran->Process()) {
                        //if(!$tran->error) {
                        $authCode = $tran->authcode;
                        $requestGuid = createGuid();
                        $t2tPhone = format_phone($t2tPhone,0);
                        $t2tFName = titleCase($t2tFName);
                        $t2tLName = titleCase($t2tLName);
                        $t2tAddress = titleCase($t2tAddress);
                        $t2tAddress2 = titleCase($t2tAddress2);
                        $t2tCity = titleCase($t2tCity);
                        $t2tReferringName = titleCase($t2tReferringName);
                        try {
                            $stmt = $dbh_write->prepare('EXEC sp_Save_TCT_T2TDonations @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@t2tFName=:t2tFName,@t2tLName=:t2tLName,@t2tAddress=:t2tAddress,@t2tAddress2=:t2tAddress2,@t2tCity=:t2tCity,@t2tState=:t2tState,@t2tZip=:t2tZip,@t2tPhone=:t2tPhone,@t2tEmail=:t2tEmail,@t2tRefer=:t2tRefer,@t2tReferringTroop=:t2tReferringTroop,@t2tReferringName=:t2tReferringName,@t2tAmount=:t2tAmount,@t2tAuthCode=:t2tAuthCode,@t2tInvoiceNum=:t2tInvoiceNum,@t2tConfirmationID=:t2tConfirmationID');
                            //
                            $stmt->bindParam(':formSecret',$formSecret, PDO::PARAM_STR);
                            $stmt->bindParam(':ipAddress',$ipAddress, PDO::PARAM_STR);
                            $stmt->bindParam(':browser',$arrBrowserString[0], PDO::PARAM_STR);
                            $stmt->bindParam(':browserVersion',$arrBrowserString[1], PDO::PARAM_STR);
                            $stmt->bindParam(':os',$arrBrowserString[2], PDO::PARAM_STR);
                            $stmt->bindParam(':t2tFName',$t2tFName, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tLName',$t2tLName, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tAddress',$t2tAddress, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tAddress2',$t2tAddress2, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tCity',$t2tCity, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tState',$t2tState, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tZip',$t2tZip, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tPhone',$t2tPhone, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tEmail',$t2tEmail, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tRefer',$t2tRefer, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tReferringTroop',$t2tReferringTroop, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tReferringName',$t2tReferringName, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tAmount',$t2tAmount, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tAuthCode',$authCode, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tInvoiceNum',$invoiceNum, PDO::PARAM_STR);
                            $stmt->bindParam(':t2tConfirmationID',$t2tConfirmationID, PDO::PARAM_STR);
                            $stmt->execute();

                       //================================================================================================================================
                       // CREATE ON-SCREEN CONFIRMATION MESSAGE																			             =
                       //================================================================================================================================
                            $confirmationMessage = "<div class=\"confirmationWrapper\">";
                            $confirmationMessage .= "<div style=\"margin:10px;font-weight:bold;font-size:1.1em;\">Thank you for your donation to Project Troop to Troop.</div>";
                            $confirmationMessage .= "<div>&#32;</div>";
                            $confirmationMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">Your invoice number is " . $invoiceNum . ".</div>";
                            $confirmationMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">Your authorization code is " . $authCode . ".</div>";
                            $confirmationMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">You will receive payment confirmation via e-mail shortly.</div>";
                            $confirmationMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;\">&#32;</div>";
                           // $confirmationMessage .= "<div id=\"basic-modal\" style=\"margin-left:10px;font-size:.9em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" name=\"t2tPrintButton\" value=\"Print Registration\" class=\"t2tPrintButton\"  /></div>";
                            $confirmationMessage .= "<div style=\"margin:15px 10px;font-size:.9em;\">If you have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Project Troop to Troop\">cookies@gsnetx.org</a> via e-mail.</div>";
                            //$confirmationMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;clear:both;\">&#32;</div>";
                            //$confirmationMessage .= "<div style=\"margin-left:10px;font-size:.8em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"t2tPrintButton\" value=\"Print Registration\" id=\"button\" onClick=\"modalWin('".$messageArray."'); return false;\"></div>";
                            $confirmationMessage .= "</div>";
                        //= EMAIL REGISTRATION CONFIRMATION MESSAGE TO REGISTRANT ====================================================================
                            $emailMessage = "<div>";
                            $emailMessage .= "<table cellpadding=\"10\" cellspacing=\"0\" border=\"0\" width=\"600\" style=\"border:1px solid #ccc;\">";
                            $emailMessage .= "<tr><td height=\"20\" width=\"5\" style=\"background-color:#00a94f;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;background-color:#00a94f;color:#fff;font-size:15pt;font-weight:bold;\">Girl Scouts of Northeast Texas Project Troop to Troop</td><td height=\"20\" width=\"5\" style=\"background-color:#00a94f;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td colspan=\3\" height=\"2\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td>&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;\">Thank you for your donation to Project Troop to Troop.</td><td>&#32;</td></tr>";
                            $emailMessage .= "<tr><td>&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;\">Your invoice number is ".$invoiceNum."</td><td>&#32;</td></tr>";
                            $emailMessage .= "<tr><td>&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;\">Please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Project Troop to Troop Question\">cookies@gsnetx.org</a> with any questions that you may have.</td><td>&#32;</td></tr>";
                            $emailMessage .= "<tr><td>&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;\">We appreciate your support of Girl Scouting and our military personnel.</td><td>&#32;</td></tr>";
                            $emailMessage .= "<tr><td colspan=\:3\" height=\"2\">&#32;</td></tr>";
                            $emailMessage .= "</table>";
                            $emailMessage .= "</div>";
                            if (ping('10.1.1.21', 25, 8) == 1) {
                                //echo "GSNETX EMAIL<br>";
                                try {
                                    $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                    $mailer = Swift_Mailer::newInstance($transport);
                                    $message = Swift_Message::newInstance();
                                    //SET PRIORITY TO HIGH
                                    $message->setPriority(3);
                                    $message->setSubject('GSNETX Project Troop to Troop Donation Confirmation');
                                    $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                    $message->setTo(array($t2tEmail));
                                    $message->setBody($emailMessage, 'text/html');
                                    //$message->setCc(array('cookies@gsnetx.org'));
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                    // Send the message
                                    //$mailer->send($message);
                                    if ($mailer->send($message)) {
                                        //echo "<strong>EMAIL SENT FROM GSNETX MAIL<br><br></strong>";
                                        //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                        $tableName = "tbl_TCT_Troop2Troop_Donations";
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
                                    $message->setSubject('Error Report From the TXCT Troop to Troop Donation Form');
                                    $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                    $message->setTo(array('webmaster@gsnetx.org'));
                                    $message->setBody($messageIntro.createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gmail'));
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                    // Send the message
                                    $mailer->send($message);
                                    $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
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
                                    $message->setSubject('GSNETX Project Troop to Troop Donation Confirmation');
                                    $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                    $message->setTo(array($t2tEmail));
                                    $message->setBody($emailMessage, 'text/html');
                                    //$message->setCc(array('cookies@gsnetx.org'));
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                    // Send the message
                                    //$mailer->send($message);
                                    if ($mailer->send($message)) {
                                        //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                        $tableName = "tbl_TCT_Troop2Troop_Donations";
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
                                    $message->setSubject('Error Report From the TXCT Troop to Troop Donation Form');
                                    $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                    $message->setTo(array('webmaster@gsnetx.org'));
                                    //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                    $message->setBody(createTryCatchErrorMessage($gmail,$dbFields,'gmail'));
                                    $message->setBody( $messageIntro.$gmail, 'text/html');
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                    // Send the message
                                    $mailer->send($message);
                                    $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                                }
                                //= UNSET ALL THE SESSION VARIABLES ==========================================================================================
                                $_SESSION = array();
                                //= DELETE THE SESSION COOKIE ================================================================================================
                                if (ini_get("session.use_cookies")) {
                                    $params = session_get_cookie_params();
                                    setcookie(session_name(), '', time() - 42000,
                                        $params["path"], $params["domain"],
                                        $params["secure"], $params["httponly"]
                                    );
                                }
                                //= DESTROY THE SESSION ======================================================================================================
                                session_destroy();
                            }
                        } catch (PDOException $dbError) {
                            try {
                                //$transport = Swift_SmtpTransport::newInstance('10.1.1.21', 25);
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('DB Error Report From the Troop 2 Troop Donation Form');
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
                        //echo "ERROR: ".$dbError->getMessage();
                        }
                    } else {
                    //============================================================================================================================
                    //= IF TRANSACTION IS DECLINED, DISPLAY SCREEN MESSAGE
                    //============================================================================================================================
                       //echo "IF CC IS NOT PROCESSED, DISPLAY ERROR<br>";
                        $confirmationMessage = "<div class=\"confirmationWrapper\">";
                        $confirmationMessage	.= "<div style=\"margin:5px 0;\">We're sorry, your card was declined.";
                        $confirmationMessage    .= "<div style=\"margin:5px 0;\">The error we received was: </div>";
                        $confirmationMessage    .= "<div style=\"margin:10px 0;font-size:.9em;font-style:italic;line-height:1.4em;\">&lsquo;".str_replace('. ','.<br>',$tran->error)."&rsquo;</div>";
                        $confirmationMessage	.= "<div class=\"cardDeclined\"style=\"margin:10px 0 15px 0;\">Please try <a href=\"t2t_Billing.php\" >entering your payment information again</a></div>";
                        //$confirmationMessage	.= "<div style=\"margin:0;\"><input type=\"button\" value=\"Go Back\" class=\"t2tBackButton\" onclick=\"location.href='t2t_billing.php';\" /></div>";
                        $confirmationMessage .= "</div>";
                        if($tran->curlerror) $confirmationMessage .= "<b>Curl Error:</b> " . $tran->curlerror . "<br>";
                    }

                } else {
                    $duplicateErrorMessage = "<div class=\"duplicateWrapper\">This donation has already been submitted. If you wish to submit another, please start at the <a href=\"t2t.php\">beginning of the form</a>.</div>";
                }

            } else {
                header("location: t2t.php");
            }
        } else {
            header("location: t2t.php");
        }
    } else {
        header("location: t2t.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Project Troop to Troop Online Donation Form - Confirmation</title>
        <meta charset="UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <script src="//code.jquery.com/jquery-latest.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script src="js/vendors/modernizr.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/vendors/jquery.maskMoney.js"></script>
        <script src='js/vendors/jquery.simplemodal.js'></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ######################################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="t2t_Confirm.php" autocomplete="off">
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
                                <div class="span-20" style="font-size:1.2em;text-align:center;">Project Troop to Troop has closed for another year.<br><br>Thanks to your generosity, we have been able to send <?php getCookieCount;?> boxes of Girl Scouts Cookies to the men and women in service to our country.</div>
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
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-18"><?php echo createPageNav(4,'1. Registration:t2t;2. Billing:t2t_Billing;3. Review:t2t_Review;4. Confirm:t2t_Confirm');?></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 marginTop25">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-10 newSection"><img src="img/hdr_DonationConfirmation.png" width="400" height="21" alt="" style="margin-top:19px;" /></div>
                                <div class="span-10 newSection"></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 dividerSection">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 marginTop10">&#32;</div>
                                <div class="span-24" style="clear:both;">&#32;</div>

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


                                <div class="span-24">&#32;</div>
                                <div class="span-24" style="clear:both;">&#160;</div>
                                <div class="span-24"><br /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 textRight paddingTop5">
                                    <?php include('i_securityVendors.php');?>
                                </div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><br><br><br></div>
                            </div>
                        <?php }?>
                    </div>
                    <?php include('i_cookieFooter.php');?>
                </div>
                <!-- ############################################################################################################################# -->
                <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
            </form>
        </div>
    </body>
    <!--<!-- MODAL RECEIPT WINDOWS START ---------------------------------------------------------------------------------------------------------------->-->
    <!--<div id='container'>-->
    <!--    <div id='content'>-->
    <!--        <!-- modal content -->-->
    <!--        <div id="basic-modal-content">-->
    <!--            <table cellpadding="0" cellspacing="0" style="border:1px solid #ccc;">-->
    <!--                <tr>-->
    <!--                    <td></td>-->
    <!--                    <td colspan="2"><img src="img/t2tPageHeader_Sm.png" border="0" alt="" width="460" height="75" style="margin-bottom:8px;" /></td>-->
    <!--                    <td></td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td></td>-->
    <!--                    <td></td>-->
    <!--                    <td class="noPrintLink"><a onclick="PrintContent();" ;">Print this page</a></td>-->
    <!--                    <td></td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td></td>-->
    <!--                    <td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px solid #999;">&nbsp;</div></td>-->
    <!--                    <td></td>-->
    <!--                </tr>-->
    <!--                <tr><td></td><td valign="top" class="printHeader" colspan="2">Donation Receipt</td><td></td></tr>-->
    <!--                <tr><td></td><td class="printLabelSm" colspan="2">Invoice Number:&nbsp;<span style="font-weight:normal;">&nbsp;--><?php //echo $invoiceNum;?><!--</span></td><td></td></tr>-->
    <!--                <tr><td></td><td class="printLabelSm" colspan="2">Authorization Number:&nbsp;<span style="font-weight:normal;">&nbsp;--><?php //echo $authCode;?><!--</span></td><td></td></tr>-->
    <!--                <tr><td colspan="4" class="printSpacer">&nbsp;</td></tr>-->
    <!--                <tr><td></td><td class="printHeaderSm" colspan="2">Payment Received From:</td><td></td></tr>-->
    <!--                <tr><td></td><td class="printLabelTxt" colspan="2">--><?php //echo $t2tName."<br>".$t2tFullAddress;?><!--</td><td></td></tr>-->
    <!--                <tr><td></td><td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px dashed #999;">&nbsp;</div></td><td></td></tr>-->
    <!--                <tr>-->
    <!--                    <td></td>-->
    <!--                    <td colspan="2">-->
    <!--                        <table cellpadding="0" cellspacing="0" width="440" style="background:none;width:440px;">-->
    <!--                            <tr>-->
    <!--                                <td class="receiptLabel receiptLabel1">Description</td>-->
    <!--                                <td class="receiptLabel receiptLabel2">Quantity</td>-->
    <!--                                <td class="receiptLabel receiptLabel3">Price</td>-->
    <!--                                <td class="receiptLabel receiptLabel4">Amount</td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td class="receiptText" valign="top">Project Troop to Troop Donation: Sending Girl Scout Cookies to our servicemen and servicewomen</td>-->
    <!--                                <td class="receiptText receiptCenter" valign="top">--><?php //echo $t2tAmount;?><!--</td>-->
    <!--                                <td class="receiptText receiptCenter" valign="top">$4.00</td>-->
    <!--                                <td class="receiptText receiptRight" valign="top">$--><?php //echo ($t2tAmount*4);?><!--</td>-->
    <!--                            </tr>-->
    <!--                            --><?php //if ((strlen($t2tReferringTroop) <= 0) && (strlen($t2tReferringName) <= 0)) {?>
    <!--                                <tr><td colspan="4"><div style="margin:6px 0;border-top:1px solid #999;">&#32;</div></td></tr>-->
    <!--                            --><?php //} else { ?>
    <!--                                <tr><td colspan="4"><div style="margin:6px 0 2px 0;border-top:1px solid #f99;">&#32;</div></td></tr>-->
    <!--                                --><?php //if (strlen($t2tReferringTroop) > 0) {?>
    <!--                                    <tr><td colspan="4" class="receiptText">Referring Troop:&nbsp;&nbsp;--><?php //echo $t2tReferringTroop;?><!--</td></tr>-->
    <!--                                --><?php //} ?>
    <!--                                --><?php //if (strlen($t2tReferringName) > 0) {?>
    <!--                                    <tr><td colspan="4" class="receiptText">Referring Scout:&nbsp;&nbsp;--><?php //echo $t2tReferringName;?><!--</td></tr>-->
    <!--                                    <tr><td colspan="4"><div style="margin:6px 0;border-top:1px solid #999;">&#32;</div></td></tr>-->
    <!--                                --><?php //} ?>
    <!--                            --><?php //} ?>
    <!--                            <tr>-->
    <!--                                <td class="receiptLabel receiptRight" colspan="3">Total</td>-->
    <!--                                <td class="receiptText receiptRight"><strong>$--><?php //echo ($t2tAmount*4);?><!--</strong></td>-->
    <!--                            </tr>-->
    <!--                            <tr>-->
    <!--                                <td width="200"><img src="img/spacer.png" width="200" height="1" alt="" ></td>-->
    <!--                                <td width="66"><img src="img/spacer.png" width="66" height="1" alt="" ></td>-->
    <!--                                <td width="66"><img src="img/spacer.png" width="66" height="1" alt="" ></td>-->
    <!--                                <td width="66"><img src="img/spacer.png" width="66" height="1" alt="" ></td>-->
    <!--                            </tr>-->
    <!--                        </table>-->
    <!--                    </td>-->
    <!--                    <td></td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td></td>-->
    <!--                    <td colspan="2" style="text-align:left;font-size:8pt;" class="noPrintLink"><a href="Javascript:$.modal.close();">close window</a><br /></td>-->
    <!--                    <td></td>-->
    <!--                </tr>-->
    <!--                <tr>-->
    <!--                    <td width="10px"><img src="img/spacer.png" width="10" height="1" alt="" ></td>-->
    <!--                    <td width="280px"><img src="img/spacer.png" width="280" height="1" alt="" ></td>-->
    <!--                    <td width="160px"><img src="img/spacer.png" width="160" height="1" alt="" ></td>-->
    <!--                    <td width="10px"><img src="img/spacer.png" width="10" height="1" alt="" ></td>-->
    <!--                </tr>-->
    <!--            </table>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <!-- preload the images -->-->
    <!--    <div style='display:none'>-->
    <!--        <img src='img/x.png' alt='' />-->
    <!--    </div>-->
    <!--</div>-->
</html>
