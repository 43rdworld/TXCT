<?php
	error_reporting (E_ALL ^ E_NOTICE);
	header('X-UA-Compatible: IE=edge,chrome=1');
	header('Cache-Control: max-age=30, must-revalidate');
	date_default_timezone_set('America/Chicago');
	$testing = "true";
	$date = date('m/d/Y h:i:s a', time());
    //display_errors   =   Off
    //= HONEYPOT TRAP FOR AUTO SUBMITTING ROBOTS
    //===============================================================================================================================================================
	if (strlen($_POST['labrea']) != 0) {													    //=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
		//echo "Redirect page to home page";
        header("location: cookieShirtOrder.php");    											    //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
	}																						    //=	GSNETX HOME PAGE BEFORE THE DATABASE FUNCTIONS ARE ACCCESSED.

//= CHECK SUBMIT BUTTON STATUS//=====================================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	=====================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "SUBMIT HTTP REFERRER SET OK<br>";
        //session_start();
        require("i_PDOFunctions.php");
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM ================================================================================================
//        ECHO "PageName: ".$_SERVER['HTTP_REFERER']."<br>";
        if(truncatePage(strtolower(returnPageName($_SERVER['HTTP_REFERER']))) == 'cookierallyorder.php') {
            //echo "SUBMIT COMING FROM COOKIE RALLY PACKAGE HOMEPAGE<br>";
            if (strtolower($_POST["submitRegistration"]) == 'submitrallyorder') {
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");												    //=	CREATES PDO DATA CONNECTION TO DATABASE
                require_once ('lib/swift_required.php');
                //echo "ID: ".returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_CookieSquadShirtSales',$_POST['formSecret']);
                if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_CookieSquadShirtSales',$_POST['formSecret']) != 'zz') {
                    setVars('formSecret:str,rallyDate:dat,rallyCount:int,rallyCookies:int,rallyPatches:int,rallyPickup:str,rallyFName:str,rallyLName:str,rallyEmail:str,rallyPhone:phn,billingSame:bit,billingFName:str,billingLName:str,billingAddress:str,billingCity:str,billingState:str,billingZip:str,billingEmail:str,ccNum:str,ccExpMonth:str,ccExpYear:str,ccCVV2:str,ccType:str,rallyOrderItemized:str,rallyOrderCookiesTemp:int,rallyOrderPatchesTemp:int,rallyOrderSubTotalTemp:mon,rallyOrderTaxTemp:mon,rallyOrderGrandTotalTemp:mon', 0, 0, 'Cookie Rally Package Order Form');
                    $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
                    $arrBrowserString = explode(';', $browserString);
                    $pageTitle = "Texas Cookie Time Rally Package Order Form";
                    $pageHeader = "TXCTRallyPackageOrders";
                    $dbFields = array("formSecret:".$formSecret,"ipAddress:".$ipAddress,"browser:".$arrBrowserString[0],"browserVersion:".$arrBrowserString[1],"operatingSystem:".$arrBrowserString[2],"submitDate:".$date,"rallyDate:".$rallyDate,"rallyCount:".$rallyCount,"rallyCookies:".$rallyCookies,"rallyPatches:".$rallyPatches,"rallyPickup:".$rallyPickup,"rallyFName:".$rallyFName,"rallyLName:".$rallyLName,"rallyEmail:".$rallyEmail,"rallyPhone:".$rallyPhone,"billingSame:".$billingSame,"billingFName:".$billingFName,"billingLName:".$billingLName,"billingAddress:".$billingAddress,"billingCity:".$billingCity,"billingState:".$billingState,"billingZip:".$billingZip,"billingEmail:".$billingEmail,"ccNum:".$ccNum,"ccCVV2:".$ccCVV2,"ccExpMonth:".$ccExpMonth,"ccExpYear:".$ccExpYear,"rallyOrderItemized:".$rallyOrderItemized,"rallyOrderCookiesTemp:".$rallyOrderCookiesTemp,"rallyOrderPatchesTemp:".$rallyOrderPatchesTemp,"rallyOrderSubTotalTemp:".$rallyOrderSubTotalTemp,"rallyOrderTaxTemp:".$rallyOrderTaxTemp,"rallyOrderGrandTotalTemp:".$rallyOrderGrandTotalTemp,"orderInvoice:".$orderInvoice,"authCode:".$authCode,"emailSent:".$emailSent,"emailTransport:".$emailTransport,"emailSentDate:".$emailSentDate,"active:".$active,"notes:".$notes);

                //= PROCESS CREDIT CARD PAYMENT	===============================================================================================================================
                    //=========================================================================================================================================================
                    //=  USA ePay PHP LIBRARY                                                                                                                                 =
                    //=========================================================================================================================================================
                    //      v1.6
                    //      Copyright (c) 2002-2008 USA ePay
                    //      For support please contact devsupport@usaepay.com
                    //
                    //      The following is an example of running a transaction using the php library.
                    //      Please see the README file for more information on usage.
                    //      Change this path to the location you have save usaepay.php to
                    //= ALL TRANSACTION, EMAIL AND DATABASE FUNCTIONS DISABLED 3/28/16 ============================================================================================================
                    include ("usaepay.php");
                    // INSTANTIATE USAePay CLIENT OBJECT ======================================================================================================================
                    $invoiceNum = makePin('Rally',6);
                    $tran=new umTransaction;
                    //$tran->cabundle='<?php echo $certpath?//>';
                    $tran->cabundle='c:\windows\curl-ca-bundle.crt';
                    //// MERCHANTS SOURCE KEY MUST BE GENERATED WITHIN THE CONSOLE ==============================================================================================
                    ////$tran->key="GhMFgFhudvuq1c2g40mpv9ayfV1n5Cl3";   	    //-- SANDBOX KEY ----------------------------------------------------------------------------------
                    $tran->key="Z837l8iUFWs2fPnz0NG0f5C3NHPm7OMT";			//-- PRODUCTION KEY FOR REGISTRATON EVENT ---------------------------------------------------------
                    //// SEND REQUEST TO SANDBOX SERVER, NOT PRODUCTION. MAKE SURE TO COMMENT OR REMOVE THIS LINE BEFORE PUTTING YOUR CODE INTO PRODUCTION ======================
                    ////$tran->usesandbox=true;
                    $tran->testmode=true;
                    $tran->card=$ccNum;
                    $tran->exp=$ccExpMonth.$ccExpYear;
                    $tran->amount=$rallyOrderGrandTotalTemp;
                    $tran->invoice=$invoiceNum;
                    $tran->custemail = $billingEmail;
                    $tran->custreceipt='yes';
                    $tran->cardholder=stripslashes(stripslashes(stripslashes($billingFName))).' '.stripslashes(stripslashes(stripslashes($billingLName)));
                    $tran->street=stripslashes(stripslashes(stripslashes(titleCase($billingAddress))));
                    $tran->zip=$billingZip;
                    $tran->cvv2=$ccCVV2;
                    $tran->description='Cookie Rally Package Order';
                    flush();
                    if($tran->Process()) {
                        $authCode = $tran->authcode;
                        //$authCode = "12345zxy";
//                    //===============================================================================================================================================
//                    //= PROCESS DATA FROM FORM	=====================================================================================================================
//                    //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE
                        try {
                        //echo "<b>Submit to Database</b><br>";
                            $stmt = $dbh_write->prepare('EXEC sp_Save_TCT_RallyPackageOrders @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@rallyDate=:rallyDate,@rallyCount=:rallyCount,@rallyCookies=:rallyCookies,@rallyPatches=:rallyPatches,@rallyPickup=:rallyPickup,@rallyFName=:rallyFName,@rallyLName=:rallyLName,@rallyEmail=:rallyEmail,@rallyPhone=:rallyPhone,@billingSame=:billingSame,@billingFName=:billingFName,@billingLName=:billingLName,@billingAddress=:billingAddress,@billingCity=:billingCity,@billingState=:billingState,@billingZip=:billingZip,@billingEmail=:billingEmail,@rallyOrderItemized=:rallyOrderItemized,@rallyOrderCookies=:rallyOrderCookies,@rallyOrderPatches=:rallyOrderPatches,@rallyOrderSubTotal=:rallyOrderSubTotal,@rallyOrderTax=:rallyOrderTax,@rallyOrderGrandTotal=:rallyOrderGrandTotal,@orderInvoice=:orderInvoice,@authCode=:authCode');
                            //,@cookieOrderYS=:cookieOrderYS,@cookieOrderYM=:cookieOrderYM,@cookieOrderYL=:cookieOrderYL,@cookieOrderAS=:cookieOrderAS,@cookieOrderAM=:cookieOrderAM,@cookieOrderAL=:cookieOrderAL,@cookieOrderAXL=:cookieOrderAXL,@cookieOrderA2X=:cookieOrderA2X,@cookieOrderA3X=:cookieOrderA3X,@cookieOrderA4X=:cookieOrderA4X,@cookieOrderDelivery=:cookieOrderDelivery,@cookieOrderFName=:cookieOrderFName,@cookieOrderLName=:cookieOrderLName,@cookieOrderAddress=:cookieOrderAddress,@cookieOrderCity=:cookieOrderCity,@cookieOrderState=:cookieOrderState,@cookieOrderZip=:cookieOrderZip,@cookieOrderPhone=:cookieOrderPhone,@cookieOrderEmail=:cookieOrderEmail,@cookieBillingSame=:cookieBillingSame,@cookieBillingFName=:cookieBillingFName,@cookieBillingLName=:cookieBillingLName,@cookieBillingAddress=:cookieBillingAddress,@cookieBillingCity=:cookieBillingCity,@cookieBillingState=:cookieBillingState,@cookieBillingZip=:cookieBillingZip,@cookieBillingPhone=:cookieBillingPhone,@cookieBillingEmail=:cookieBillingEmail,@cookieOrderSubTotal=:cookieOrderSubTotal,@cookieOrderTax=:cookieOrderTax,@cookieOrderTotal=:cookieOrderTotal,@cookieOrderAuthcode=:cookieOrderAuthcode,@cookieOrderInvoiceNum=:cookieOrderInvoiceNum
                            $stmt->bindParam(':formSecret', $formSecret, PDO::PARAM_STR);
                            $stmt->bindParam(':ipAddress', $ipAddress, PDO::PARAM_STR);
                            $stmt->bindParam(':browser', $arrBrowserString[0], PDO::PARAM_STR);
                            $stmt->bindParam(':browserVersion', $arrBrowserString[1], PDO::PARAM_STR);
                            $stmt->bindParam(':os', $arrBrowserString[2], PDO::PARAM_STR);
                            $stmt->bindParam(':rallyDate',$rallyDate, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyCount',$rallyCount, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyCookies',$rallyCookies, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyPatches',$rallyPatches, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyPickup',$rallyPickup, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyFName',$rallyFName, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyLName',$rallyLName, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyEmail',$rallyEmail, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyPhone',$rallyPhone, PDO::PARAM_STR);
                            $stmt->bindParam(':billingSame',$billingSame, PDO::PARAM_STR);
                            $stmt->bindParam(':billingFName',$billingFName, PDO::PARAM_STR);
                            $stmt->bindParam(':billingLName',$billingLName, PDO::PARAM_STR);
                            $stmt->bindParam(':billingAddress',$billingAddress, PDO::PARAM_STR);
                            $stmt->bindParam(':billingCity',$billingCity, PDO::PARAM_STR);
                            $stmt->bindParam(':billingState',$billingState, PDO::PARAM_STR);
                            $stmt->bindParam(':billingZip',$billingZip, PDO::PARAM_STR);
                            $stmt->bindParam(':billingEmail',$billingEmail, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderItemized',$rallyOrderItemized, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderCookies',$rallyOrderCookiesTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderPatches',$rallyOrderPatchesTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderSubTotal',$rallyOrderSubTotalTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderTax',$rallyOrderTaxTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':rallyOrderGrandTotal',$rallyOrderGrandTotalTemp, PDO::PARAM_STR);
                            $stmt->bindParam(':orderInvoice',$invoiceNum, PDO::PARAM_STR);
                            $stmt->bindParam(':authCode',$authCode, PDO::PARAM_STR);
                            $stmt->execute();
                            //$stmt = null;
                            //$dbh = null;
                        //=====================================================================================================================================================
                        // CREATE ON-SCREEN CONFIRMATION MESSAGE																			                                  =
                        //=====================================================================================================================================================
                            $screenMessage = "<div class=\"confirmationWrapper\">";
                            $screenMessage .= "<div style=\"margin-right:75px;\">";
                            $screenMessage .= "<div style=\"margin:0 10px 10px 10px;font-weight:bold;font-size:1.1em;\">You have successfully ordered your Rally Package Kit. Please keep a copy of the order form and payment confirmation for your records.</div>";
                            $screenMessage .= "<div>&#32;</div>";
                            $screenMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">Your invoice number is " . $invoiceNum . ".</div>";
                            $screenMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">Your authorization code is " . $authCode . ".</div>";
                            $screenMessage .= "<div style=\"margin:2px 10px;font-size:.9em;\">You will receive an itemized confirmation and a separate payment confirmation via e-mail shortly.</div>";
                            $screenMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;\">&#32;</div>";
                            // $confirmationMessage .= "<div id=\"basic-modal\" style=\"margin-left:10px;font-size:.9em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" name=\"t2tPrintButton\" value=\"Print Registration\" class=\"t2tPrintButton\"  /></div>";
                            $screenMessage .= "<div style=\"margin:15px 10px;font-size:.9em;\">If there is an error with your order, please contact <a href=\"mailto:shop_manager@gsnetx.org?subject=Rally Package Order Question\">shop_manager@gsnetx.org</a>.</div>";
                            //$confirmationMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;clear:both;\">&#32;</div>";
                            //$confirmationMessage .= "<div style=\"margin-left:10px;font-size:.8em;\">Print an itemized receipt of this donation for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"t2tPrintButton\" value=\"Print Registration\" id=\"button\" onClick=\"modalWin('".$messageArray."'); return false;\"></div>";
                            $screenMessage .= "</div>";
                            $screenMessage .= "</div>";

                            //= EMAIL REGISTRATION CONFIRMATION MESSAGE TO REGISTRANT ====================================================================
                            switch($rallyPickup) {
                                case 'JAF':
                                    $rallyPickupName = "JoAnn Foog Service Center and Shop";
                                    break;
                                case 'CSC':
                                    $rallyPickupName = "Collin Area Service Center and Shop";
                                    break;
                                case 'DSC':
                                    $rallyPickupName = "Denton Area Service Center and Shop";
                                    break;
                                case 'ETRC':
                                    $rallyPickupName = "East Texas Regional Service Center and Shop";
                                    break;
                                case 'GASC':
                                    $rallyPickupName = "Grayson Area Service Center and Shop";
                                    break;
                                case 'HVSC':
                                    $rallyPickupName = "Highland Village Service Center and Shop";
                                    break;
                                case 'PSC':
                                    $rallyPickupName = "Paris Regional Service Center and Shop";
                                    break;
                                case 'SSSC':
                                    $rallyPickupName = "Southern Sector Service Center and Shop";
                                    break;
                            }
                            $emailMessage = "<div style=\"width:610px;\">";
                            $emailMessage .= "<table cellpadding=\"10\" cellspacing=\"0\" border=\"0\" width=\"600\" style=\"border:none;\">";
                            $emailMessage .= "<tr><td height=\"20\" width=\"5\" style=\"background-color:#00a94f;border:none;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;background-color:#00a94f;color:#fff;font-size:15pt;font-weight:bold;border:none;\">Cookie Rally Kit Order Confirmation</td><td height=\"20\" width=\"5\" style=\"background-color:#00a94f;border:none;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td colspan=\3\" height=\"2\" style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:11pt;font-weight:normal;border:none;background-color:#fff;\">You have successfully ordered your Cookie Rally Kit. Please keep a copy of the order form and payment confirmation for your records.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;border:none;background-color:#fff;\">Your invoice number is ".$invoiceNum."</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;border:none;background-color:#fff;\">Your payment authorization code is ".$authCode."</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;border:none;background-color:#fff;\">Please contact the GSNETX Shop Manager at <a href=\"mailto:shop_manager@gsnetx.org?subject=Cookie Rally Kit Order Question\">shop_manager@gsnetx.org</a> with any questions you may have about your order.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td style=\"font-family:Arial, Tahoma, sans-serif;color:#444;font-size:10pt;font-weight:normal;border:none;background-color:#fff;\">We appreciate your support of Girl Scouting and the Cookie Program.</td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr><td style=\"border:none;background-color:#fff;\">&#32;</td><td height=\"2\" style=\"border:none;background-color:#fff;\"><hr size=\"2\"></td><td style=\"border:none;background-color:#fff;\">&#32;</td></tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;\">&#32;</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;text-align:center;\">";
                            $emailMessage .= "<table cellpadding=\"3\" cellspacing=\"0\" style=\"font:9pt/13pt verdana,arial,sans-serif;\"\">";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Rally Package Order:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$rallyOrderItemized."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Sold To:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$billingFName." ".$billingLName."<br>".$billingAddress."<br>".$billingCity.", ".$billingState."&#160;&#160;".$billingZip."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Amount:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$rallyOrderSubTotalTemp."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Tax:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$rallyOrderTaxTemp."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Total Amount:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">$".number_format($rallyOrderGrandTotalTemp,2)."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Invoice Number:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$invoiceNum."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Payment Authorization:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">".$authCode."</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "<tr>";
                            $emailMessage .= "<td valign=\"top\" style=\"vertical-align:top;border:none;background-color:#fff;font-weight:bold;text-align:right;width:200px;\">Pickup Information:</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;width:5px;\"></td>";
                            $emailMessage .= "<td valign=\"top\" style=\"border:none;background-color:#fff;text-align:left;width:400px;\">Your Rally Package will be available for pickup at ".$rallyPickupName." between November 4 and 19.<br><br>Please refer to <a href=\"http://www.gsnetx.org/shop\">www.gsnetx.org/shop</a> for specific shop locations and hours.<br><br></td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "</table>";
                            $emailMessage .= "</td>";
                            $emailMessage .= "<td style=\"border:none;background-color:#fff;\">&#32;</td>";
                            $emailMessage .= "</tr>";
                            $emailMessage .= "</table>";
                            $emailMessage .= "</div>";
                            //echo "<br>".$emailMessage."<br>";
                            //                        //===============================================================================================================================================
                            if (ping('10.1.1.21', 25, 3) == 1) {
                                //echo "GSNETX EMAIL<br>";
                                //=======================================================================================================================================
                                //= GSNETX EMAIL TO TCM                                                                                                                 =
                                //= =====================================================================================================================================
                                try {
                                    $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                    $mailer = Swift_Mailer::newInstance($transport);
                                    $message = Swift_Message::newInstance();
                                    //SET PRIORITY TO HIGH
                                    $message->setPriority(3);
                                    $message->setSubject('Girls Scouts of Northeast Texas Order Confirmation');
                                    $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                    //$message->setTo(array($email));
                                    $message->setTo(array($billingEmail));
                                    $message->setBody($emailMessage, 'text/html');
                                    $message->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));
                                // SEND THE MESSAGE
                                    if ($mailer->send($message)) {
                                            $tableName = "tbl_TCT_RallyPackageOrders";
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
                                        $message->setSubject('Email Error Report From the TXCT Rally Package Order Form via GMail');
                                        $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Rally Package Order Form'));
                                        $message->setTo(array('webmaster@gsnetx.org'));
                                        //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                        $message->setBody(createTryCatchErrorMessage($gsnetxEmail, $dbFields, 'gsnetx'));
                                        $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                        //  SEND THE EMAIL
                                        $mailer->send($message);
                                        $screenMessage = "<div class=\"errorWrapper\"><div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div></div>";
                                }
                            } else if (ping('smtpx.gmailx.comx', 587, 3) == 1) {
                                    //=======================================================================================================================================
                                    //= GMAIL EMAIL TO PURCHASER                                                                                                                           =
                                    //= =====================================================================================================================================
                                    try {
                                        $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                        $transport->setUsername('gsnetxweb@gmail.com');
                                        $transport->setPassword('divasRock2012');
                                        $mailer = Swift_Mailer::newInstance($transport);
                                        $message = Swift_Message::newInstance();
                                        // SET PRIORITY TO HIGH
                                        $message->setPriority(3);
                                        $message->setSubject('Girls Scouts of Northeast Texas Order Confirmation');
                                        $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                        $message->setTo(array($billingEmail));
                                        //$message->setTo(array('barker323@gmail.com'));
                                        $message->setBody($emailMessage, 'text/html');
                                        $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                        // Send the message
                                        //$mailer->send($message);
                                        if ($mailer->send($message)) {
                                            //echo "<strong>EMAIL SENT FROM GMAIL MAIL</strong><br><br>";
                                            //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                            $tableName = "tbl_TCT_RallyPackageOrders";
                                            $emailTransport = "gmail";
                                            $emailSent = '1';
                                            $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatusForShop @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
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
                                        $message->setSubject('Shop Email Error Report From the TXCT Rally Package Order Form via GMail');
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

                                //= SEND CONFIRMATION VIA GMAIL ===================================================================================================================
                            }
                        } catch (Exception $dbError) {
                            $screenMessage = "<div class=\"errorWrapper\"><div class=\"dataWrapper\">We're sorry, but we're unable to process your information at this time.<br>Our IT department has been notified and is working on the problem.</div></div>";
                            echo createTryCatchErrorMessage($dbError, $dbFields, 'gmail');
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
                                $message->setSubject('DB Error Report From the TXCT Cookie Rally Package Order Form');
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
//                    } else {
//                    //=========================================================================================================================================================
//                    //= IF TRANSACTION IS DECLINED, DISPLAY SCREEN MESSAGE                                                                                                    =
//                    //=========================================================================================================================================================
//                        //echo "IF CC IS NOT PROCESSED, DISPLAY ERROR<br>";
//                        $screenMessage = "<div class=\"confirmationWrapper\">";
//                        $screenMessage	.= "<div style=\"margin:5px 0;\">We're sorry, your card was declined.";
//                        $screenMessage    .= "<div style=\"margin:5px 0;\">The error we received was: </div>";
//                        $screenMessage    .= "<div style=\"margin:10px 0;font-size:.9em;font-style:italic;line-height:1.4em;\">&lsquo;".str_replace('. ','.<br>',$tran->error)."&rsquo;</div>";
//                        $screenMessage	.= "<div class=\"cardDeclined\"style=\"margin:10px 0 15px 0;\">Please try <a href=\"cookieShirtOrder.php\" >entering your information again</a></div>";
//                        //$confirmationMessage	.= "<div style=\"margin:0;\"><input type=\"button\" value=\"Go Back\" class=\"t2tBackButton\" onclick=\"location.href='t2t_billing.php';\" /></div>";
//                        $screenMessage .= "</div>";
//                        if($tran->curlerror) $screenMessage .= "<b>Curl Error:</b> " . $tran->curlerror . "<br>";
                    }

                } else {
                //= DUPLICATE RECORD - DO NOT SUBMIT RECORD TO DATABASE =======================================================================================================
                    $screenMessage = "<div class=\"errorWrapper\"><div class=\"duplicateWrapper\">This order has already been submitted. If you wish to submit another, please start at the <a href=\"cookieshirtOrder.php\">beginning of the form</a>.</div></div>";
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
                ////echo "SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
                //session_unset();
                //session_destroy();
                //header("location: cookieRallyOrder.php");
            }
        } else {
            ////echo "HTTP_REFERRER NOT COMING FROM TCM APPLICATION - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
            ////exit();
            //session_unset();
            //session_destroy();
            //header("location: cookieRallyOrder.php");
        }
    } else {
        ////echo "HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
        ////exit;
        //session_unset();
        //session_destroy();
        //header("location: cookieRallyOrder.php");
    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Cookie Rally Package Orders</title>
        <meta charset="UTF-8">
        <meta http-equiv="Expires" content="Tue, 01 Jan 1995 12:12:12 GMT">
        <meta http-equiv="Pragma" content="no-cache">
        <link rel="icon" href="favicon.png" sizes="32x32">
        <link rel="icon" href="favicon.ico" sizes="32x32">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div>
            <?php include('i_cookieHeader.php');?>
            <div>
                <div class="container showWhite">
                    <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20"><h1>Cookie Rally Package Order Confirmation</h1></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24">&#32;</div>
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
