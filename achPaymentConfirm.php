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
		setRegistrationParams('10/01/2015','03/01/2017');
		//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE T2T REVIEW FORM 	======================================================================
		if(strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 'achpayment.php') {
			//=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==================================================================
			if (strtolower($_POST["submitPayment"]) == 'submitachpayment') {
				$formSecret = $_POST['formSecret'];                                      //= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
				$ipAddress = getIPAddr();
				$dbh = '';
				$connectionVar = 'GSNETX2014';
				require("i_PDOConnection.php");                                        //=	CREATES ODBC DATA CONNECTION TO DATABASE
				require_once('lib/swift_required.php');
				if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_ACHPayments',$_POST['formSecret']) == '') {
					$browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
					$arrBrowserString = explode(';', $browserString);
					$confirmationID = generateRandomID('ACH_','str',8);
					$rand = mt_rand(1,5000);
					$test = "xyz_".$key;
					$key = returnEncryptionKey ($dbh,'EXEC sp_GetDataPoint :tableName, :field, :id','tbl_Randoms','id',$rand);
					$test = "xyz_".$key;
					//echo "TEST: ".$test."<br>";
					//echo "TEST 4: ".substr($test,4)."<br>";
					setVars('formSecret:str,achTroopNum:str,permSU:str,achAccountName:str,achEmail:str,achPhone:str,achRouting:xyz'.$key.',achAccount:xyz'.$key.',achAmount:mon', 0, 0, 'ACH Cookie Payment Form');
					$dbFields = array("formSecret:" . $formSecret, "browser:" . $arrBrowserString[0], "browserVersion:" . $arrBrowserString[1], "os:" . $arrBrowserString[2], "achTroopNum:" . $achTroopNum, "achSU:" . $permSU, "achAccountName:" . $achAccountName, "achPhone:" . $achPhone, "achEmail:" . $achEmail, "achRouting:" . $achRouting, "achAccount:" . $achAccount, "achAmount:" . $achAmount, "confirmationID:" . $confirmationID);
					//echo "<br>";
					$achRouting = cc_encrypt($_POST['achRouting'],$key);
					$achAccount = cc_encrypt($_POST['achAccount'],$key);
					//echo "<strong>Random ID: </strong>: ".$rand."<br>";
					//echo "<strong>KEY: </strong>: ".$key."<br>";
					//echo "<strong>Routing Number: </strong>".$achRouting."<br>";
					//echo "<strong>Routing Number Decrypted:  </strong>".cc_decrypt($achRouting,$key)."<br><br>";
					//echo "<strong>Account Number:  </strong>".$achAccount."<br>";
					//echo "<strong>Account Number Decrypted:  </strong>".cc_decrypt($achAccount,$key)."<br><br>";


				//=============================================================================================================================================================
				//= PROCESS DATA FROM FORM																																	  =
				//=============================================================================================================================================================
					try {
				//=============================================================================================================================================================
				// CREATE ON-SCREEN CONFIRMATION MESSAGE																			             	 						  =
				//=============================================================================================================================================================
					$screenMessage  =	"<div class=\"screenMessage\" style=\"font-size:10.5pt;line-height:13pt;text-align:left;width:800px;margin:0 auto;\">";
					$screenMessage .=		"<div style=\"margin:10px 0;\">Thank you for using e-Payment.</div>";
					$screenMessage .=		"<div style=\"margin:10px 0;\">Your deposit will be processed within the next 5 business days.</div>";
					$screenMessage .=		"<div style=\"margin:10px 0;\">A summary of your transaction is listed below and a copy will be emailed to the address submitted with the payment information.</div>";
					$screenMessage .=		"<div style=\"margin:5px 0;line-height:1.4em;\"><span style=\"color:#900;\"><strong>In the event of an error, do not try to re-submit the form.</strong></span>  If you do not get an email confirmation or have any additional questions, please contact <a href=\"mailto:financedepartmentcookies@gsnetx.org?subject=Question about the e-Payment for Cookies\">financedepartmentcookies@gsnetx.org</a> or call (972) 349-2400.</div>";
					$screenMessage .=		"<div style=\"margin:18px 0;\">Thank you!</div>";
					$screenMessage .=		"<div style=\"margin:8px 0 15px 0;\">Girl Scouts of Northeast Texas</div>";
					$screenMessage .=		"<div class=\"grayDashedDivider\"><img src=\"images/spacer.png\" width=\"1\" height=\"1\" border=\"0\" /></div>";
					$screenMessage .=		"<div class=\"achConfirmationWrapper\">";
                    $screenMessage .=           "<div style=\"width:525px;margin:0 auto;\">";
					$screenMessage .=			    "<div class=\"achConfirmationHeader\">e-Payment Confirmation Receipt</div>";
					$screenMessage .=			    "<table cellpadding=\"4\" cellspacing=\"0\" class=\"achReceiptTable\">";
					$screenMessage .=				    "<tr>";
					$screenMessage .=					    "<td class=\"achReceiptLabel\">Date:</td>";
					$screenMessage .=   					"<td class=\"achReceiptData\">".date("F j, Y, g:i a")."</td>";
					$screenMessage .=	    			"</tr>";
					$screenMessage .=	      			"<tr>";
					$screenMessage .=	 	    			"<td class=\"achReceiptLabel\">Troop Number:</td>";
					$screenMessage .=			   			"<td class=\"achReceiptData\">".ltrim(ltrim($achTroopNum,'Troop'),'0')."</td>";
					$screenMessage .=			    	"</tr>";
					$screenMessage .=		    		"<tr>";
					$screenMessage .=			   			"<td class=\"achReceiptLabel\">Service Unit:</td>";
					$screenMessage .=			    		"<td class=\"achReceiptData\">".$permSU."</td>";
					$screenMessage .=				    "</tr>";
					$screenMessage .=				    "<tr>";
					$screenMessage .=	    				"<td class=\"achReceiptLabel\">Account Name:</td>";
					$screenMessage .=		    			"<td class=\"achReceiptData\">".$achAccountName."</td>";
					$screenMessage .=			   		"</tr>";
					$screenMessage .=			    	"<tr>";
					$screenMessage .=				    	"<td class=\"achReceiptLabel\">Contact Email:</td>";
					$screenMessage .=					    "<td class=\"achReceiptData\">".$achEmail."</td>";
					$screenMessage .=		    		"</tr>";
					$screenMessage .=			   		"<tr>";
					$screenMessage .=			    		"<td class=\"achReceiptLabel\">Contact Phone:</td>";
					$screenMessage .=				    	"<td class=\"achReceiptData\">".$achPhone."</td>";
					$screenMessage .=	    			"</tr>";
                    $screenMessage .=	                "<tr>";
                    $screenMessage .=	                    "<td class=\"achReceiptLabel\">Routing Number:</td>";
                    $screenMessage .=	                    "<td class=\"achReceiptData\">Number ending in ".substr(cc_decrypt($achRouting,$key),-3)."</td>";
                    $screenMessage .=	                "</tr>";
                    $screenMessage .=	                "<tr>";
                    $screenMessage .=	                    "<td class=\"achReceiptLabel\">Account Number:</td>";
                    $screenMessage .=	                    "<td class=\"achReceiptData\">Number ending in ".substr(cc_decrypt($achAccount,$key),-3)."</td>";
                    $screenMessage .=	                "</tr>";
					$screenMessage .=		    		"<tr>";
					$screenMessage .=			   			"<td class=\"achReceiptLabel\">Payment Amount:</td>";
					$screenMessage .=			    		"<td class=\"achReceiptData\">$".$achAmount."</td>";
					$screenMessage .=				    "</tr>";
                    $screenMessage .=		    		"<tr>";
                    $screenMessage .=			   			"<td class=\"achReceiptLabel\">Confirmation ID:</td>";
                    $screenMessage .=			    		"<td class=\"achReceiptData\">".$confirmationID."</td>";
                    $screenMessage .=				    "</tr>";
					$screenMessage .=		    	"</table><br><br><br><br><br>";
					$screenMessage .=			"</div>";
					$screenMessage .=		"</div>";
					$screenMessage .=	"</div>";
				//=============================================================================================================================================================
				// CREATE CONFIRMATION EMAIL MESSAGE																			             	 						  	  =
				//=============================================================================================================================================================
                    $emailMessage  =	"<div style=\"width:600px;text-align:left;\">";
                    $emailMessage .=	    "<table cellpadding=\"0\" cellspacing=\"0\" width=\"600\">";
                    $emailMessage .=	        "<tr>";
                    $emailMessage .=	            "<td>";
                    $emailMessage .=	                "<div style=\"font:10pt/15pt verdana,arial,sans-serif;font-weight:bold;margin:10px 0;\">Thank you for using e-Payment.</div>";
                    $emailMessage .=	                "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">Your deposit will be processed within the next 5 business days.</div>";
                    $emailMessage .=	                "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">A summary of your transaction is listed below.</div>";
                    $emailMessage .=	                "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">If you have any additional questions, please contact <a href=\"mailto:financedepartmentcookies@gsnetx.org?subject=Question about the e-Payment for Cookies\">financedepartmentcookies@gsnetx.org</a><br>or call (972)349-2400.</div>";
                    $emailMessage .=	                "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:18px 0;\">Thank you!</div>";
                    $emailMessage .=	                "<div style=\"font:9pt/14pt verdana,arial,sans-serif;font-weight:normal;margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                    $emailMessage .=	                "<div style=\"margin-top:20px;padding-top:20px;border-top:2px solid #999;\">&#32;</div>";
                    $emailMessage .=	                "<div style=\"margin:25px 5px;\">";
                    $emailMessage .=	                    "<div style=\"font:10pt/15pt verdana,arial,sans-serif;color:#444;font-weight:bold;margin:0 0 5px 0;text-align:left;\">e-Payment Confirmation Receipt</div>";
                    $emailMessage .=	                    "<table cellpadding=\"4\" cellspacing=\"0\" style=\"border:1px solid #ccc;border-collapse:collapse:width:525px;\">";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Date:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".date("F j, Y, g:i a")."</td>";
                    $emailMessage .=	                        "</tr>";
					$emailMessage .=	                        "<tr>";
					$emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Troop Number:</td>";
					$emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".ltrim(ltrim($achTroopNum,'Troop'),'0')."</td>";
					$emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Service Unit:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".$permSU."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Account Name:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".nameize($achAccountName)."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Contact Email:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".$achEmail."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Contact Phone:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".$achPhone."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Routing Number:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">Number ending in ".substr(cc_decrypt($achRouting,$key),-3)."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Account Number:</td>";
                    $emailMessage .=	                            "<td width=\"375\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">Number ending in ".substr(cc_decrypt($achAccount,$key),-3)."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=	                        "<tr>";
                    $emailMessage .=	                            "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Payment Amount:</td>";
                    $emailMessage .=	                            "<td style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">$".str_replace('..','.',$achAmount)."</td>";
                    $emailMessage .=	                        "</tr>";
                    $emailMessage .=		    		        "<tr>";
                    $emailMessage .=			   			        "<td width=\"150\" style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:right;font-weight:bold;padding-right:5px;\">Confirmation ID:</td>";
                    $emailMessage .=			    		        "<td style=\"font:8pt/13pt verdana,arial,sans-serif;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;text-align:left;padding-left:5px;\">".$confirmationID."</td>";
                    $emailMessage .=				            "</tr>";
                    $emailMessage .=	                    "</table>";
                    $emailMessage .=	                "</div>";
                    $emailMessage .=                "</td>";
                    $emailMessage .=            "</tr>";
                    $emailMessage .=	    "</table>";
                    $emailMessage .=	"</div>";
					//echo "SUBMIT TO DATABASE"."<br>";
					//echo $screenMessage."<br>";
					//echo $emailMessage."<br>";

					$stmt = $dbh_write->prepare('EXEC sp_Save_TCT_ACHPayments @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@achTroopNum=:achTroopNum,@achSU=:achSU,@achAccountName=:achAccountName,@achPhone=:achPhone,@achEmail=:achEmail,@achRouting=:achRouting,@achAccount=:achAccount,@achAmount=:achAmount,@confirmationID=:confirmationID,@keyIndex=:keyIndex');
					$stmt->bindParam(':formSecret',$formSecret, PDO::PARAM_STR);
					$stmt->bindParam(':ipAddress',$ipAddress, PDO::PARAM_STR);
					$stmt->bindParam(':browser',$arrBrowserString[0], PDO::PARAM_STR);
					$stmt->bindParam(':browserVersion',$arrBrowserString[1], PDO::PARAM_STR);
					$stmt->bindParam(':os',$arrBrowserString[2], PDO::PARAM_STR);
					$stmt->bindParam(':achTroopNum',$achTroopNum, PDO::PARAM_STR);
					$stmt->bindParam(':achSU',$permSU, PDO::PARAM_STR);
					$stmt->bindParam(':achAccountName',$achAccountName, PDO::PARAM_STR);
					$stmt->bindParam(':achPhone',$achPhone, PDO::PARAM_STR);
					$stmt->bindParam(':achEmail',$achEmail, PDO::PARAM_STR);
					$stmt->bindParam(':achRouting',$achRouting, PDO::PARAM_STR);
					$stmt->bindParam(':achAccount',$achAccount, PDO::PARAM_STR);
					$stmt->bindParam(':achAmount',$achAmount, PDO::PARAM_STR);
					$stmt->bindParam(':keyIndex',$rand, PDO::PARAM_STR);
					$stmt->bindParam(':confirmationID',$confirmationID, PDO::PARAM_STR);
					$stmt->execute();

					if (ping('10.1.1.21', 25, 5) == 1) {
					//	//echo "GSNETX EMAIL<br>";
						try {
							$transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
							$mailer = Swift_Mailer::newInstance($transport);
							$message = Swift_Message::newInstance();
							//SET PRIORITY TO HIGH
							$message->setPriority(3);
							$message->setSubject('GSNETX Cookie Program E-Payment Confirmation');
							$message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
							$message->setTo(array($achEmail));
							$message->setBody($emailMessage, 'text/html');
							//$message->setCc(array('cookies@gsnetx.org'));
							$message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
							// Send the message
							//$mailer->send($message);
							if ($mailer->send($message)) {
								//echo "<strong>EMAIL SENT FROM GSNETX MAIL<br><br></strong>";
								//= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
								$tableName = "tbl_TCT_ACHPayments";
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
					} else if (ping('smtp.gmail.com', 587, 3) == 1) {
					//	//echo "GMAIL EMAIL<br>";
						try {
							$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
							$transport->setUsername('gsnetxweb@gmail.com');
							$transport->setPassword('divasRock2012');
							$mailer = Swift_Mailer::newInstance($transport);
							$message = Swift_Message::newInstance();
							// SET PRIORITY TO HIGH
							$message->setPriority(3);
							$message->setSubject('GSNETX Cookie Program E-Payment Confirmation');
							$message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
							$message->setTo(array($achEmail));
							//$message->setCc(array('cookies@gsnetx.org'));
							$message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
							// Send the message
							//$mailer->send($message);
							if ($mailer->send($message)) {
								//= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
								$tableName = "tbl_TCT_ACHPayments";
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
							$messageIntro = "There was error updating the email (gsnetx) sent status for the record with ID: ".$formSecret.".\r\n\r\n";
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
					//echo "ERROR: ".$dbError->getMessage();
					try {
						//$transport = Swift_SmtpTransport::newInstance('10.1.1.21', 25);
						$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
						$transport->setUsername('gsnetxweb@gmail.com');
						$transport->setPassword('divasRock2012');
						$mailer = Swift_Mailer::newInstance($transport);
						$message = Swift_Message::newInstance();
						// SET PRIORITY TO HIGH
						$message->setPriority(3);
						$message->setSubject('DB Error Report From the ACH Payment Form');
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
					//echo createTryCatchErrorMessage($dbError, $dbFields, 'gmail');
					}
				} else {
					//= DUPLICATE RECORD - DO NOT SUBMIT RECORD TO DATABASE ===================================================================================================
					$screenMessage = "<div class=\"errorWrapper\"><div class=\"duplicateWrapper\">This payment has already been submitted.<br><br>If you need to make additional payments, please start over at the <a href=\"achpayment.php\">beginning of the form</a>.</div></div>";
					//echo $duplicateErrorMessage."<br>";
					// Unset all of the session variables.
					if(ISSET ($_SESSION)) {
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
				}

			//= EMAIL REGISTRATION CONFIRMATION MESSAGE TO REGISTRANT =========================================================================================================
////					$emailHeader = "<div style=\"margin: 0 0 10px 10px;\"><img src=\"http://www.gsnetx.org/content/dam/NE_Texas/images/email/emailHeader.png\" width=\"600\" height=\"82\" alt=\"Event logo image\"></div>";
////					$email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Thank you for your donation to Project Troop to Troop.</p>";
////					$email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Project Troop to Troop Question\">cookies@gsnetx.org</a> with any questions that you may have.</p>";
////					$email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">We appreciate your support of Girl Scouting.</p>";
//				} else {
//				//====================================================================================================================================
//				//= IF TRANSACTION HAS ALREADY BEEN SUBMITTED, DISPLAY SCREEN MESSAGE
//				//====================================================================================================================================
//					$screenMessage	.= "<div style=\"margin: 40px 0 20px 0;font-size:1.1em;font-weight:bold;\">This information has already been submitted.</div>";
//					$screenMessage	.= "<div style=\"margin: 30px 0 70px 0;\" class=\"pageLink\">If you need to make additional payments, please start over at the <a href=\"achpayment.php\">beginning of the form</a>.</div>";
//				}
//				if($emailSent == 0) {
//					//echo "EMAIL NEEDS TO BE SENT";
//				} else {
//					//echo "EMAIL ALREADY SENT";
//				}
//
//
//				if($emailSent == 0) {
//                    $transport = Swift_MailTransport::newInstance('10.1.1.21', 25);
//                    $mailer = Swift_Mailer::newInstance($transport);
//                    $message = Swift_Message::newInstance();
//                    // SET PRIORITY TO HIGH
//                    $message->setPriority(3);
//                    $message->setSubject('GSNETX Cookie Program E-Payment Confirmation');
//                    $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
//                    $message->setTo(array($achEmail));
//                    $message->setBody($emailMessage, 'text/html');
//                    $message->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));
//                    // Send the message
//                    //                       $result = $mailer->send($message);
//                    //  echo "here2";
//                    if ($mailer->send($message)) {
//                        //	echo "Failures:";
//                        //  print_r($failures);
//                        //  $screenMessage  = "<div style=\"margin:0 auto;width:775px;\">";
//                        //  $screenMessage .=   "<div style=\"margin:10px 0;\">Thank you for submitting the Parent Permission and Responsibility form for your Girl Scout's participation in the GSNETX Cookie Program.</div>";
//                        //  $screenMessage .=   "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">You will receive an email shortly, confirming your registration and containing a copy of all the information just submitted.</div>";
//                        //  $screenMessage .=   "<div style=\"margin:8px 0;\">A copy will also be sent to your Troop Leader and Troop Cookie Manager. In the case of missing emails, please forward a copy of the confirmation email to those needing it. They need to receive the confirmation before issuing your Girl Scout's Cookie materials.</div>";
//                        //  $screenMessage .=   "<div style=\"margin:8px 0;\">&#32;</div>";
//                        //  $screenMessage .=   "<div style=\"margin:12px 0 ;\">Thank you</div>";
//                        //  $screenMessage .=   "<div style=\"margin:0;\">Girl Scouts of Northeast Texas</div>";
//                        //  $screenMessage .=   "<div class=\"grayDottedDivider\"><img src=\"https://www.texascookietime.org/img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
//                        //  $screenMessage .=   "<div style=\"margin:5px 0;\">If you have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookies@gsnetx.or</a> or call (972)349-2400.</div><br><br>";
//                        //  $screenMessage .= "</div>";
//                        $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_TCT_ACHPayments','" . $formSecret . "',1)}");
//                        odbc_execute($results, array());
//                    } else {
//                        $emailError = 1;
//                        // $screenMessage  =   "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
//                        // $screenMessage .=       "<div style=\"font-weight:bold;color:#900;\">Unfortunately, your confirmation email was not sent.</div>";
//                        // $screenMessage .=       "<div style=\"margin: 10px 0 70px 0;color:#333;\">Please refresh the screen to try again. Your registration will not be re-submitted.</div>";
//                        // $screenMessage .=   "</div>";
//                        $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_AwardNominations','" . $formSecret . "',0)}");
//                        odbc_execute($results, array());
//                    }
//				} else {
//					//echo "EMAIL ALREADY SENT";
//					// $screenMessage =    "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
//					// $screenMessage .=       "<div style=\"font-weight:bold;color:#900;\">An email has already be sent for this registration.</div>";
//					// $screenMessage .=       "<div class=\"grayDottedDivider\"><img src=\"img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
//					// $screenMessage .=       "<div style=\"margin:5px 0;\">If you do not receive your confirmation or have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookiesk@gsnetx.or</a> or call (972)349-2400.</div><br><br></div>";
//					// $screenMessage .=   "</div>";
//				}
//
//


			} else {
				header("location: achPayment.php");
			}
		} else {
			header("location: achPayment.php");
		}
	} else {
		header("location: achPayment.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Cookies E-Payment Form - Confirmation</title>
		<meta charset="UTF-8">
		<link rel="icon" href="favicon.png" sizes="32x32">
		<link rel="icon" href="favicon.ico" sizes="32x32">
		<link href="css/txct.css" rel="stylesheet" type="text/css" />
		<script src="js/vendors/modernizr.js"></script>
	</head>
	<body onload="copyFormSecret('<?php echo $formSecret;?>');">
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
							<li><a href="http://www.texascookietime.org" class="currentTab">HOME</a></li>
							<li><a href="http://www.texascookietime.org/girl-scout-cookies.html">GIRL SCOUT COOKIES</a></li>
							<li><a href="http://www.texascookietime.org/families.html">FAMILIES</a></li>
							<li><a href="http://www.texascookietime.org/volunteers.html">VOLUNTEERS</a></li>
							<li><a href="http://www.texascookietime.org/forms.html">FORMS</a></li>
						</ul>
					</div>
				</div>
			</div>
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
                            <div class="span-20" style="font-size:1.2em;text-align:center;">ACH Payment has closed for another year.<br><br>Thanks to your generosity, we have been able to send <?php getCookieCount;?> boxes of Girl Scouts Cookies to the men and women in service to our country.</div>
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
                        <div class="span-20"><h1>e-Payment Confirmation</h1></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="height:10px;">&nbsp;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20"><?php echo $screenMessage;?></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24"><p>&#32;</p></div>
                    </div>
                    <?php }?>
                </div>
            </div>
			<div class="container">
				<div id="footerWrapper">
					<div id="copyRight">&copy; <?php echo date("Y");?>  Girl Scouts of Northeast Texas</div>
					<div id="socialMedia">
						<a href="/media" title="Media Page"><img src="img/media_32_white.png" alt="Media Page" width="62" height="32" style="margin-right:20px;" /></a>
						<a href="https://twitter.com/GSNETXcouncil" target="_blank"><img src="img/twitter_30_white.png" width="30" height="30" /></a>
						<a href="https://www.facebook.com/GSNETX?ref=ts" target="_blank"><img src="img/facebook_30_white.png" width="30" height="30" /></a>
						<a href="https://www.youtube.com/channel/UC4uxrvCdVYkGzLZdocf1aHQ" target="_blank"><img src="img/youtube_30_white.png" width="30" height="30" /></a>
						<a href="http://instagram.com/gsnetxcouncil" target="_blank"><img src="img/instagram_30_white.png" width="30" height="30" /></a>
					</div>
				</div>
			</div>
            <!-- ############################################################################################################################# -->
		</div>
	</body>
</html>

<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">-->
<!--<html xmlns="http://www.w3.org/1999/xhtml">-->
<!--	<head runat="server">-->
<!--    	<title>--><?php //echo $pageTitle;?><!--</title>-->
<!--    	<meta http-equiv="X-UA-Compatible" content="IE=9" />-->
<!--        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<!--		<script type="text/javascript" src="scripts/milonic_src.js"></script>	-->
<!--        <script type="text/javascript" src="scripts/mmenudom.js"></script>-->
<!--        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
<!--       	<link rel="stylesheet" type="text/css" href="css/i_cssReset.css"/>-->
<!--       	<link rel="stylesheet" type="text/css" href="css/tct2014.css"/>-->
<!--    </head>-->
<!--	  <body class="oneColFixCtr">-->
<!--		<div id="outerWrapper">-->
<!--            <div>-->
<!--                <a href="http://www.gsnetx.org" target="_blank"><img src="images/gsnetxLogo.png" width="260" height="105" alt="Girl Scouts of Northeast Texas Homepage" border="0" id="logo" /></a>-->
<!--                <div class="topNav"><div class="innerTopNav"><a href="http://www.texascookietime.org/Volunteers/TroopCookieManagerResources.aspx">Volunteer Resources</a><span class="topNavDivider">|</span><a href="" target="_blank">eBudde</a><span class="topNavDivider">|</span><a href="http://www.gsnetx.org" target="_blank">www.gsnetx.org</a></div><form name="search" id="search" action="http://www.texascookietime.org/searchResults.aspx?Search=" method="post" style="float:right;"><input id="search" name="search" type="text" ><input type="image" src="images/cookieSearch.png" class="cookieSearch" /></form></div>-->
<!--            </div>-->
<!--	    	<div class="contentWrapper">-->
<!--				<div id="navWrapper"><script type="text/javascript" src="scripts/menu_data.js"></script></div>-->
<!--				<div id="innerWrapper">-->
<!--        			<img src="images/hdr_--><//?php //echo $headerImage;?><!--.jpg" width="968" height="160" alt="" />-->
<!--                    <div id="formWrapper">-->
<!--                        <h1>--></?php //echo $headerCopy;?><!--</h1>-->
<!--                        <div id="innerFormWrapper">-->
<!--                            --><//?php
//                                echo $screenMessage;
//                            ?>
<!--//** END FORM ********************************************************************** //-->
<!--                        </div>-->
<!--                    </div>-->
<!--	    	    </div>-->
<!--				--><?php //include('i_TCTFormsFooter.php');?>
<!--            </div>-->
<!--        </div>-->
<!--	</body>-->
<!--</html>-->
