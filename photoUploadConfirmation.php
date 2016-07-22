<?php
	error_reporting (E_ALL ^ E_NOTICE);
	header('X-UA-Compatible: IE=edge,chrome=1');
	header('Cache-Control: max-age=30, must-revalidate');
	date_default_timezone_set('America/Chicago');
	$testing = "true";
	$date = date('m/d/Y h:i:s a', time());

//display_errors   =   Off
    //= HONEYPOT TRAP FOR AUTO SUBMITTING ROBOTS
    //=========================================================================================================================================================================
	if (strlen($_POST['labrea']) != 0) {													    //=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
		//echo "Redirect page to home page";
        header("location: cookieShirtOrder.php");    											    //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
	}																						    //=	GSNETX HOME PAGE BEFORE THE DATABASE FUNCTIONS ARE ACCCESSED.

//= CHECK SUBMIT BUTTON STATUS//===============================================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	===============================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        // echo "SUBMIT HTTP REFERRER SET OK<br>";
        session_start();
        require("i_PDOFunctions.php");
    //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE CORRECT SUBMISSION FORM ==============================================================================================
        if(truncatePage(strtolower(returnPageName($_SERVER['HTTP_REFERER']))) == 'photoupload.php') {
            //echo "SUBMIT COMING FROM COOKIE SQUAD HOMEPAGE<br>";
            if  (strtolower($_POST["submitPhoto"]) == 'submitphotoupload') {
                 //ECHO "<b>PHOTO UPLOAD PROCESS HERE</b><br>";
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");												    //=	CREATES PDO DATA CONNECTION TO DATABASE ===================================
                //require('includes/dfm-smug-wrapper.php');                                       //= PHP WRAPPER CLASS LIBRARY FOR SMUGMUG API UPLOAD ==========================
                require_once('lib/swift_required.php');
            //= IF RECORD EXISTS, SUBMIT THE REST OF THE INFORMATION.  IF RECORD DOESN'T EXIST, THERE'S NO RECORD OF ACKNOWLEDGEMENT - DON'T PROCESS THE UPLOAD =====
            //     echo "<br>REG OBJECT: ".returnObjectStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','secret','tbl_TCT_PhotoUploads',$_POST['formSecret'])."<br>";
                if (returnObjectStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','secret','tbl_TCT_PhotoUploads',$_POST['formSecret']) == '') {
                     //echo "FORM SECRET: ".$formSecret."<br>";
                     //echo "UPLOAD PHOTO<br>";
                     //echo "COMPUTER NAME: ".$_SERVER['COMPUTERNAME']."<br>";
                //= CHECK TO SEE IF PREVIOUS UPLOAD EXISTS. IF FILE ALREADY EXISTS, SUBMISSION IS A DUPLICATE - DO NOT PROCESS ================================================
                //   if (returnObjectStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','file','tbl_TCT_PhotoUploads',$_POST['formSecret']) == 0) {
                        setVars('formSecret:str,agreeToConditions:bit,photoUploadTroopLeaderFName:str,photoUploadTroopLeaderLName:str,photoUploadTroopLeaderConfirmationDate:dat,photoUploadFName:str,photoUploadLName:str,photoUploadTroopNumTemp:str,photoUploadSU:int,photoUploadPhone:phn,photoUploadEmail:str,photoUploadNames:str,photoUploadFile:fil', 0, 0, 'Cookies Photo Upload Form');
                        $ipAddress = getIPAddr();
                        $browserString = getBrowserInfo(@$_SERVER['HTTP_USER_AGENT']);
                        $arrBrowserString = explode(';',$browserString);
                        $photoUploadNames = newLine2Break($photoUploadNames);
                        $dbFields = array("formSecret:".$formSecret,"ipAddress:".$ipAddress,"browser:".$arrBrowserString[0],"browserVersion:".$arrBrowserString[1],"operatingSystem:".$arrBrowserString[2],"photoLeaderConfirmation:".$agreeToConditions,"photoLeaderFirstName:".$photoUploadTroopLeaderFName,"photoLeaderLastName:".$photoUploadTroopLeaderLName,"photoLeaderConfirmationDate:".$photoUploadTroopLeaderConfirmationDate,"photoUploadFName:".$photoUploadFName,"photoUploadLName:".$photoUploadLName,"photoUploadTroopNum:".$photoUploadTroopNumTemp,"photoUploadSU:".$photoUploadSU,"photoUploadPhone:".$photoUploadPhone,"photoUploadEmail:".$photoUploadEmail,"photoUploadNames:".$photoUploadNames,"photoUploadFile:".$photoUploadFile);
                        if(isset($_FILES['photoUploadFile'])) {
                        // $errors = array();
                            $file_name = $_FILES['photoUploadFile']['name'];
                            $file_size = $_FILES['photoUploadFile']['size'];
                            $file_tmp = $_FILES['photoUploadFile']['tmp_name'];
                            $file_type = $_FILES['photoUploadFile']['type'];
                            @$file_ext = strtolower(end(explode('.', $_FILES['photoUploadFile']['name'])));
                             //echo "File Name: ".$file_name."<br>";
                             //echo "File Size: ".$file_size."<br>";
                             //echo "File Tmp: ".$file_tmp."<br>";
                             //echo "File Type: ".$file_type."<br>";
                             //echo "File Extension: ".$file_ext."<br>";
                            if (isset($_FILES['photoUploadFile']['size']) && ($_FILES['photoUploadFile']['size'] > 0 )) {
                                if ($_SERVER['COMPUTERNAME'] == 'RODBY') {
                                    $uploadDir = 'C:\inetpub\wwwroot\rodby\_webForms\TXCT2016\uploads\\';
                                } else if($_SERVER['COMPUTERNAME'] == 'V-WEBDEV') {
                                    $uploadDir = 'C:\inetpub\wwwroot\txct2016\uploads\\';
                                } else {
                                    $uploadDir = 'C:\inetpub\wwwroot\forms.gsnetx.org\TXCT2016\uploads\\';
                                }
                                $uploadFileName = preg_replace('/[^a-zA-Z0-9.]/','',basename($_FILES['photoUploadFile']['name']));
                                $uploadFileName = strtolower(htmlentities($photoUploadFName."-".$photoUploadLName."_Troop".$photoUploadTroopNumTemp."_".str_replace("/","-",date("m-d-Y_h-i-sa").".".$file_ext)));
                                 //echo "UPLOAD DIR: ".$uploadDir."<br>";
                                 //echo "UPLOAD: ".$uploadFileName."<br>";
                                $uploadFile = $uploadDir . $uploadFileName;
                                move_uploaded_file($_FILES['photoUploadFile']['tmp_name'],$uploadFile);
                                $nomImageSubmitted = 'Yes';
                                //echo "<br><strong>UPLOADED FILE: ".$uploadFile."</strong><br>";
                                //
                                // $f = new DFM_Smug(
                                //     "oauth_consumer_key=MO4savPcj5yrRNGXeUDJoehdRYs3odEl",
                                //     "oauth_secret=0c129f255a9a1e69f827168403f1cfdd",
                                //     "token_id=MO4savPcj5yrRNGXeUDJoehdRYs3odEl",
                                //     "token_secret=0c129f255a9a1e69f827168403f1cfdd",
                                //     "app_name=My Cool App/1.0 (http://app.com)",
                                //     "api_ver=1.0"
                                // );
                                //
                                // try {
                                //     // $username = 'webmaster@gsnetx.org';
                                //     // $f->albums_get( // Get a list of all albums
                                //     //     "Username=$username"
                                //     // );
                                //     $f->images_upload("AlbumID=58837850rWtLh", "File=/inetpub/wwwroot/txct2016/uploads/aaa-bbb_troop6794_04-29-2016_12-14-15pm.jpg");
                                //     // $resp = $f->auth_getRequestToken();
                                //     // echo "RESP: ".$resp."<br>";
                                // } catch (Exception $e) {
                                //     printf('%s (Error Code: %d)', $e->getMessage(), $e->getCode());
                                // }
                                // echo '<a href="'.$f->authorize("Access=[Public|Full]", "Permissions=[Read|Add|Modify]").'">Authorize</a>';


                                // $f = new DFM_Smug(
                                //     "oauth_consumer_key=MO4savPcj5yrRNGXeUDJoehdRYs3odEl",
                                //     "oauth_secret=0c129f255a9a1e69f827168403f1cfdd",
                                //     "token_id=MO4savPcj5yrRNGXeUDJoehdRYs3odEl",
                                //     "token_secret=0c129f255a9a1e69f827168403f1cfdd",
                                //     "app_name=My Cool App/1.0 (http://app.com)",
                                //     "api_ver=2.0"
                                //     // array(
                                //     //     "oauth_consumer_key" => "MO4savPcj5yrRNGXeUDJoehdRYs3odEl",
                                //     //     "oauth_secret" => "0c129f255a9a1e69f827168403f1cfdd",
                                //     //     "token_id" => "12345",
                                //     //     "token_secret" => "some_other_secret",
                                //     //     "app_name" => "My Cool App/1.0 (http://app.com)",
                                //     //     "api_ver" => "2.0"
                                //     // )
                                // );
                                // echo "HERE";
                                // $f->images_upload("AlbumID=FrWtLh", "File=C:\\inetpub\\wwwroot\\txct2016\\uploads\\aaa-bbb_troop26_04-28-2016_04-28-07pm.jpg");
                            }
                        } else {
                            $uploadFileName = '';
                            $nomImageSubmitted = 'No';
                        }
                    //= PROCESS DATA FROM FORM	===========================================================================================================================
                    //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE
                        try {
                            $stmt = $dbh_write->prepare('EXEC sp_Save_TCT_PhotoUploads @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@photoLeaderConfirmation=:photoLeaderConfirmation,@photoFirstName=:photoFirstName,@photoLastName=:photoLastName,@photoLeaderConfirmationDate=:photoLeaderConfirmationDate,@photoTroopNumber=:photoTroopNumber,@photoSU=:photoSU,@photoLeaderFirstName=:photoLeaderFirstName,@photoLeaderLastName=:photoLeaderLastName,@photoPhone=:photoPhone,@photoEmail=:photoEmail,@photoNames=:photoNames,@photoFileName=:photoFileName,@photoOriginalFileName=:photoOriginalFileName,@photoType=:photoType,@photoSize=:photoSize');
                            $stmt->bindParam(':formSecret', $formSecret, PDO::PARAM_STR);
                            $stmt->bindParam(':ipAddress', $ipAddress, PDO::PARAM_STR);
                            $stmt->bindParam(':browser', $arrBrowserString[0], PDO::PARAM_STR);
                            $stmt->bindParam(':browserVersion', $arrBrowserString[1], PDO::PARAM_STR);
                            $stmt->bindParam(':os', $arrBrowserString[2], PDO::PARAM_STR);
                            $stmt->bindParam(':photoLeaderConfirmation',$agreeToConditions, PDO::PARAM_STR);
                            $stmt->bindParam(':photoFirstName',$photoUploadFName, PDO::PARAM_STR);
                            $stmt->bindParam(':photoLastName',$photoUploadLName, PDO::PARAM_STR);
                            $stmt->bindParam(':photoLeaderConfirmationDate',$photoUploadTroopLeaderConfirmationDate, PDO::PARAM_STR);
                            $stmt->bindParam(':photoTroopNumber',$photoUploadTroopNumTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':photoSU',$photoUploadSU, PDO::PARAM_STR);
                            $stmt->bindParam(':photoLeaderFirstName', $photoUploadTroopLeaderFName, PDO::PARAM_STR);
                            $stmt->bindParam(':photoLeaderLastName', $photoUploadTroopLeaderLName, PDO::PARAM_STR);
                            $stmt->bindParam(':photoPhone',$photoUploadPhone, PDO::PARAM_STR);
                            $stmt->bindParam(':photoEmail',$photoUploadEmail, PDO::PARAM_STR);
                            $stmt->bindParam(':photoNames',$photoUploadNames, PDO::PARAM_STR);
                            $stmt->bindParam(':photoFileName',$uploadFileName, PDO::PARAM_STR);
                            $stmt->bindParam(':photoOriginalFileName',$file_name, PDO::PARAM_STR);
                            $stmt->bindParam(':photoType',$file_type, PDO::PARAM_STR);
                            $stmt->bindParam(':photoSize',$file_size, PDO::PARAM_STR);
                            $stmt->execute();
                           //$stmt = null;
                           //$dbh = null;
                        //=====================================================================================================================================================
                        // CREATE ON-SCREEN CONFIRMATION MESSAGE																			                                  =
                        //=====================================================================================================================================================
                            $screenMessage = "<div class=\"confirmationWrapper\">";
                            $screenMessage .= "<div style=\"margin-right:75px;\">";
                            $screenMessage .= "<div style=\"margin:5px;font-weight:bold;font-size:1.1em;\">You have successfully uploaded your troop photo to our website.</div>";
                            $screenMessage .= "<div>&#32;</div>";
                            $screenMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">Thank you for sharing your Girl Scouts' cookie fun-perience to us!</div>";
                            $screenMessage .= "<div style=\"margin:15px 10px;font-size:.9em;\">Please contact <a href='mailto:cookies@gsnetx.org?subject=Question about Troop Photo uploads'>cookies@gsnetx.org</a> with any questions or concerns.</div>";
                            $screenMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;\">&#32;</div>";
                            // $confirmationMessage .= "<div id=\"basic-modal\" style=\"margin-left:10px;font-size:.9em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" name=\"t2tPrintButton\" value=\"Print Registration\" class=\"t2tPrintButton\"  /></div>";
                            $screenMessage .= "<div style=\"margin:15px 10px;font-size:.9em;\">Your GSNETX Cookie Team</div>";
                            //$confirmationMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;clear:both;\">&#32;</div>";
                            //$confirmationMessage .= "<div style=\"margin-left:10px;font-size:.8em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"t2tPrintButton\" value=\"Print Registration\" id=\"button\" onClick=\"modalWin('".$messageArray."'); return false;\"></div>";
                            $screenMessage .= "</div>";
                            $screenMessage .= "</div>";

                        //= EMAIL REGISTRATION CONFIRMATION MESSAGE TO REGISTRANT ====================================================================
                            $emailMessage = "<div style=\"width:635px;\">";
                            $emailMessage .= "<table cellpadding=\"10\" cellspacing=\"0\" border=\"0\" width=\"625\" style=\"border:none;\">";
                            $emailMessage .= "<tr><td height=\"25\" width=\"5\" style=\"background-color:#00a94f;border:none;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;background-color:#00ae58;color:#fff;font-size:16pt;font-weight:bold;border:none;\">Troop Photo Upload Confirmation</td><td height=\"20\" width=\"5\" style=\"background-color:#00a94f;border:none;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td colspan=\3\" height=\"1\" style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">Thank you for sharing your cookie fun-perience with us by sharing a photo of the event!</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">We're honored to showcase your troop in our materials such as the Texas Cookie Time website, parents guide and other advertising and promotional materials.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">Please contact <a href='mailto:cookies@gsnetx.org?subject=Question about uploaded photos'>cookies@gsnetx.org</a> with any questions or concerns.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">We appreciate your support of Girl Scouting and the Cookie Program.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td height=\"2\" style=\"border:none;background-color:#fff;\"><hr size=\"2\"></td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">Thank you again!</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;padding-bottom:5px;\">Your GSNETX Cookie Team</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td colspan=\3\" height=\"35\" style=\"border:none;background-color:#fff;\">&#160;</td></tr>";
                            $emailMessage .= "</table>";
                            $emailMessage .= "</div>";
                             //echo "<br>".$emailMessage."<br>";
                        //=====================================================================================================================================================
                             if (ping('10.1.1.21', 25, 3) == 1) {
                                 //echo "<br><strong>GSNETX EMAIL</strong><br>";
                             //= GSNETX EMAIL SEND =============================================================================================================================
                                try {
                                    $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                    $mailer = Swift_Mailer::newInstance($transport);
                                    $message = Swift_Message::newInstance();
                                    //SET PRIORITY TO HIGH
                                    $message->setPriority(3);
                                    $message->setSubject('Girls Scouts of Northeast Texas File Upload Confirmation');
                                    $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                    //$message->setTo(array($email));
                                    $message->setTo(array($photoUploadEmail));
                                    $message->setBody($emailMessage, 'text/html');
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                //= SEND THE MESSAGE ==========================================================================================================================
                                    if ($mailer->send($message)) {
                                        $tableName = "tbl_TCT_PhotoUploads";
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
                                    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                    $transport->setUsername('gsnetxweb@gmail.com');
                                    $transport->setPassword('divasRock2012');
                                    $mailer = Swift_Mailer::newInstance($transport);
                                    $message = Swift_Message::newInstance();
                                    // SET PRIORITY TO HIGH
                                    $message->setPriority(3);
                                    $message->setSubject('Email Error Report From the TXCT Photo Upload Form via GMail');
                                    $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                    $message->setTo(array('webmaster@gsnetx.org'));
                                    //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                    $message->setBody(createTryCatchErrorMessage($gsnetxEmail, $dbFields, 'gsnetx'));
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                    //  SEND THE EMAIL
                                    $mailer->send($message);
                                    $screenMessage = "<div class=\"errorWrapper\"><div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div></div>";
                                }
                             } else if (ping('smtp.gmail.com', 587, 3) == 1) {
                                   //echo "<br><strong>GMAIL EMAIL</strong><br>";
                                 try {
                                     $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                     $transport->setUsername('gsnetxweb@gmail.com');
                                     $transport->setPassword('divasRock2012');
                                     $mailer = Swift_Mailer::newInstance($transport);
                                     $message = Swift_Message::newInstance();
                                     // SET PRIORITY TO HIGH
                                     $message->setPriority(3);
                                     $message->setSubject('Girls Scouts of Northeast Texas File Upload Confirmation');
                                     $message->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'));
                                     $message->setTo(array($photoUploadEmail));
                                     //$message->setTo(array('barker323@gmail.com'));
                                     $message->setBody($emailMessage, 'text/html');
                                     $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                     // Send the message
                                     //$mailer->send($message);
                                     if ($mailer->send($message)) {
                                         //echo "<strong>EMAIL SENT FROM GMAIL MAIL</strong><br><br>";
                                         //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE ==================================================
                                         $tableName = "tbl_TCT_PhotoUploads";
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
                                     $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                     $transport->setUsername('gsnetxweb@gmail.com');
                                     $transport->setPassword('divasRock2012');
                                     $mailer = Swift_Mailer::newInstance($transport);
                                     $message = Swift_Message::newInstance();
                                     // SET PRIORITY TO HIGH
                                     $message->setPriority(3);
                                     $message->setSubject('Email Error Report From the TXCT Photo Upload Form via GMail');
                                     $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                     $message->setTo(array('webmaster@gsnetx.org'));
                                     //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                     $message->setBody(createTryCatchErrorMessage($gmail,$dbFields,'gmail'));
                                     $message->setBody('GMAIL FAIL<br> '.$gmail, 'text/html');
                                     $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                     // SEND THE MESSAGE
                                     $mailer->send($message);
                                     $screenMessage = "<div class=\"errorWrapper\"><div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div></div>";
                                 }
                            }
                       } catch (Exception $dbError) {
                            $screenMessage = "<div class=\"errorWrapper\"><div class=\"dataWrapper\">We're sorry, but we're unable to process your information at this time.<br>Our IT department has been notified and is working on the problem.</div></div>";
                            //echo createTryCatchErrorMessage($dbError, $dbFields, 'gmail');
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
                                 $message->setSubject('DB Error Report From the TXCT Cookie Squad TShirt Order Form');
                                 $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                 $message->setTo(array('webmaster@gsnetx.org'));
                                 //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                 $message->setBody(createTryCatchErrorMessage($dbError, $dbFields, 'gmail'));
                                 $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                 // Send the message
                                 $mailer->send($message);
                             } catch (Exception $dbEmailError) {
                             }
                       }
                } else {
                //= DUPLICATE RECORD - DO NOT SUBMIT RECORD TO DATABASE =========================================================================================
                    $screenMessage = "<div class=\"errorWrapper\"><div class=\"duplicateWrapper\">This informaton has already been submitted. If you wish to submit another, please start at the <a href=\"photoUpload.php\">beginning of the form</a>.</div></div>";
                    //echo $screenMessage."<br>";
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
                // echo "<b>SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS</b><br>";
                session_unset();
                session_destroy();
                header("location: photoUpload.php");
            }
        } else {
            // echo "<b>HTTP_REFERRER NOT COMING FROM TCM APPLICATION - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS</b><br>";
            session_unset();
            session_destroy();
            header("location: photoUpload.php");
        }
    } else {
		// echo "<b>HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS</b><br>";
        session_unset();
        session_destroy();
        header("location: photoUpload.php");
    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Texas Cookie Time Image Upload Confirmation</title>
        <meta charset="UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div>
            <?php include('i_cookieHeader.php');?>
            <div>
                <div class="container showWhite">
                    <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20"><h1>Texas Cookie Time Image Uploader</h1></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24" style="height:1px;">&nbsp;</div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20">
                        <?php
                        echo $screenMessage;
                        //if (($databaseErrorMessage != '') || ($emailErrorMessage != '') || ($duplicateErrorMessage != '')) {
                        //    echo "<div class=\"errorWrapper\">";
                        //    if ($databaseErrorMessage != '') {
                        //        echo $databaseErrorMessage;
                        //    } else if ($emailErrorMessage != '') {
                        //        echo $emailErrorMessage;
                        //    } else if ($duplicateErrorMessage != '') {
                        //        echo $duplicateErrorMessage;
                        //    }
                        //    echo "</div>";
                        //} else {
                        //    echo $confirmationMessage;
                        //}
                        //echo "<br><br>".$emailMessage."<br><br>";
                        ?>
                    </div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24" style="height:10px;">&nbsp;</div>
                    <div class="span-24 formFieldSpacer">&#32;</div>
                    <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br><br><br></div>
                </div>
                <?php include('i_cookieFooter.php');?>
            </div>
            <!-- ################################################################################################################################################ -->
            <div style="clear:both;"><br><br></div>
        </div>
        <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
	</body>
</html>
