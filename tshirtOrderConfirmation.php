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
        header("location: tshirtOrder.php");    											    //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
	}																						    //=	GSNETX HOME PAGE BEFORE THE DATABASE FUNCTIONS ARE ACCCESSED.

//= CHECK SUBMIT BUTTON STATUS//=====================================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	=====================================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "SUBMIT HTTP REFERRER SET OK<br>";
        session_start();
        require("i_PDOFunctions.php");
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM ================================================================================================
//ECHO "PageName: ".$_SERVER['HTTP_REFERER']."<br>";
        if(truncatePage(strtolower(returnPageName($_SERVER['HTTP_REFERER']))) == 'tshirtorder.php') {
            //echo "SUBMIT COMING FROM PARENT PERMISSION HOMEPAGE<br>";
            if (strtolower($_POST["submitRegistration"]) == 'submittshirtorder') {
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                $connectionVar = 'GSNETX';
                require("i_PDOConnection.php");												    //=	CREATES PDO DATA CONNECTION TO DATABASE
                require_once ('lib/swift_required.php');
                //echo "ID: ".returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_TShirtOrders',$_POST['formSecret']);
                if (returnRegistrationStatus ($dbh,'EXEC sp_GetUserID :tableName,:formSecret','id','tbl_TCT_TShirtOrders',$_POST['formSecret']) != 'zz') {
                    setVars('formSecret:str,orderS:str,orderM:str,orderL:str,orderXL:str,order2X:str,order3X:str,orderDelivery:str,orderFName:str,orderLName:str,orderAddress:str,orderCity:str,orderState:str,orderZip:int,orderPhone:str,orderEmail:str', 0, 0, 'Parent Permission Registration Form');
                    $dbFields = array("orderS: ".$orderS,"orderM: ".$orderM,"orderL: ".$orderL,"orderXL: ".$orderXL,"order2X: ".$order2X,"order3X: ".$order3X,"orderDelivery: ".$orderDelivery,"orderFName: ".$orderFName,"orderLName: ".$orderLName,"orderAddress: ".$orderAddress,"orderCity: ".$orderCity,"orderState: ".$orderState,"orderZip: ".$orderZip,"orderPhone: ".$orderPhone,"orderEmail: ".$orderEmail);
                    $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
                    $arrBrowserString = explode(';', $browserString);
                    $pageTitle = "Texas Cookie Time T-Shirt Order Form";
                    $pageHeader = "TXCTTShirtOrders";
                    //===============================================================================================================================================
                    //= PROCESS DATA FROM FORM	=====================================================================================================================
                    //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE
                    try {
                        //echo "<b>Submit to Database</b><br>";
                        $stmt = $dbh_write->prepare('
                        EXEC sp_Save_TCT_TShirtOrders @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@orderS=:orderS,@orderM=:orderM,@orderL=:orderL,@orderXL=:orderXL,@order2X=:order2X,@order3X=:order3X,@orderDelivery=:orderDelivery,@orderFName=:orderFName,@orderLName=:orderLName,@orderAddress=:orderAddress,@orderCity=:orderCity,@orderState=:orderState,@orderZip=:orderZip,@orderPhone=:orderPhone,@orderEmail=:orderEmail');
                        $stmt->bindParam(':formSecret', $formSecret, PDO::PARAM_STR);
                        $stmt->bindParam(':ipAddress', $ipAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':browser', $arrBrowserString[0], PDO::PARAM_STR);
                        $stmt->bindParam(':browserVersion', $arrBrowserString[1], PDO::PARAM_STR);
                        $stmt->bindParam(':os', $arrBrowserString[2], PDO::PARAM_STR);
                        $stmt->bindParam(':orderS', $orderS, PDO::PARAM_STR);
                        $stmt->bindParam(':orderM', $orderM, PDO::PARAM_STR);
                        $stmt->bindParam(':orderL', $orderL, PDO::PARAM_STR);
                        $stmt->bindParam(':orderXL', $orderXL, PDO::PARAM_STR);
                        $stmt->bindParam(':order2X', $order2X, PDO::PARAM_STR);
                        $stmt->bindParam(':order3X', $order3X, PDO::PARAM_STR);
                        $stmt->bindParam(':orderDelivery', $orderDelivery, PDO::PARAM_STR);
                        $stmt->bindParam(':orderFName', $orderFName, PDO::PARAM_STR);
                        $stmt->bindParam(':orderLName', $orderLName, PDO::PARAM_STR);
                        $stmt->bindParam(':orderAddress', $orderAddress, PDO::PARAM_STR);
                        $stmt->bindParam(':orderCity', $orderCity, PDO::PARAM_STR);
                        $stmt->bindParam(':orderState', $orderState, PDO::PARAM_STR);
                        $stmt->bindParam(':orderZip', $orderZip, PDO::PARAM_STR);
                        $stmt->bindParam(':orderPhone', $orderPhone, PDO::PARAM_STR);
                        $stmt->bindParam(':orderEmail', $orderEmail, PDO::PARAM_STR);
                        $stmt->execute();
                        //$stmt = null;
                        //$dbh = null;
                        //===============================================================================================================================================
                        // CREATE ON-SCREEN CONFIRMATION MESSAGE
                        if (($orderS > 1) || ($orderM > 1) || ($orderL > 1) || ($orderXL > 1) || ($order2X > 1) || ($order3X > 1)) {
                            $orderCopy = 'Troop Cookie Manager t-shirts.';
                        } else {
                            $orderCopy = 'Troop Cookie Manager t-shirt.';
                        }
                        if ($orderDelivery == 'home') {
                            $deliveryCopy = 'When your order is ready to be shipped to your home we will contact you for payment information.  Payment must be made prior to orders being shipped.';
                        } else {
                            $deliveryCopy = 'You will be notified when your order is ready to be picked up. Payment is due when the order is picked up.';
                        }
                        $confirmationMessage = "<div class=\"screenMessage\" style=\"font-size:11pt;line-height:15pt;\">";
                        $confirmationMessage .= "<div style=\"margin:10px 0;\">Thank you for submitting an order for " . $orderCopy . ". You will receive a confirmation email shortly.</div>";
                        $confirmationMessage .= "<div style=\"margin:8px 0;\">" . $deliveryCopy . "</div>";
                        $confirmationMessage .= "<div style=\"margin:18px 0;\">Thank you!</div>";
                        $confirmationMessage .= "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $confirmationMessage .= "<div class=\"grayDottedDivider\">&#32;</div>";
                        $confirmationMessage .= "<div>If you have any additional questions, please contact <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Girl Scout Cookie Program\">cookies@gsnetx.org</a> or call (972)349-2400.<br><br></div>";
                        $confirmationMessage .= "</div>";

                        SWITCH ($orderDelivery) {
                            case 'jaf';
                                $pickupLocation = "JoAnn Fogg Shop";
                                $pickupLocationAddress = "<br>6001 Summerside Drive<br>Dallas, TX 75252";
                                $pickupMessage = "You will be contacted by the staff of the JoAnn Fogg Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "lmays@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the JoAnn Fogg Shop";
                                break;
                            case 'sssc';
                                $pickupLocation = "Southern Sector Shop";
                                $pickupLocationAddress = "<br>8705 South Hampton Road<br>Dallas, TX 75232";
                                $pickupMessage = "You will be contacted by the staff of the Southern Sector/Hampton Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "rcurry@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Hampton Shop";
                                break;
                            case 'etrc';
                                $pickupLocation = "East Texas Regional Center Shop";
                                $pickupLocationAddress = "<br>9126 Hwy. 271<br>Tyler, TX 75708";
                                $shopEmailContact = "mabbott@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the ETRC Shop";
                                break;
                            case 'rocky';
                                $pickupLocation = "Grayson Area/Camp Rocky Point Shop";
                                $pickupLocationAddress = "<br>1243 Hanna Drive<br>Denison, TX 75020";
                                $shopEmailContact = "bbridges@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Grayson Area Shop";
                                break;
                            case 'hv';
                                $pickupLocation = "Highland Village Shop";
                                $pickupLocationAddress = "<br>1850 Justin Road, Suite A<br>Highland Village, TX 75077";
                                $pickupMessage = "You will be contacted by the staff of the Highland Village Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "chathaway@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Highland Village Shop";
                                break;
                            case 'den';
                                $pickupLocation = "Denton Shop";
                                $pickupLocationAddress = "<br>2317 W. University Dr., Suite 167<br>Denton, TX 76201";
                                $pickupMessage = "You will be contacted by the staff of the Denton Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "chathaway@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Denton Shop";
                                break;
                            case 'par';
                                $pickupLocation = "Paris Shop";
                                $pickupLocationAddress = "<br>47 Camp Gambill Drive<br>Sumner, TX 75486";
                                $pickupMessage = "You will be contacted by the staff of the Paris Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "trutz@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Paris Shop";
                                break;
                            case 'rocky';
                                $pickupLocation = "Grayson Area Shop";
                                $pickupLocationAddress = "<br>1243 Hanna Drive<br>Denison, TX 75020";
                                $pickupMessage = "You will be contacted by the staff of the Grayson Area Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "bbridges@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Grayson Area Shop";
                                break;
                            case 'col';
                                $pickupLocation = "Collin Area Shop";
                                $pickupLocationAddress = "<br>190 E. Stacy Road, Suite 1512<br>Allen, TX 75002";
                                $pickupMessage = "You will be contacted by the staff of the Collin Area Shop when your order is ready to be paid for and picked up.";
                                $shopEmailContact = "lserrano@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for the Collin Shop";
                                break;
                            case 'home';
                                $pickupLocation = "<div style=\"color:#c00;font-weight:bold;\">To Be Delivered to Address Below</div>";
                                $pickupLocationAddress = "";
                                $pickupMessage = "You will be contacted by staff for payment of the order.  Once your order is ready, it will be shipped to the address you entered previously.";
                                $shopEmailContact = "chathaway@gsnetx.org";
                                $shopEmailSubject = "Troop Cookie Manager T-Shirt Order for Delivery";
                                break;
                        }
                        if ($orderS > 0) {
                            if ($orderS > 1) {
                                $orderDetail .= $orderS . ' Small T-Shirts<br>';
                            } else {
                                $orderDetail .= $orderS . ' Small T-Shirt<br>';
                            }
                        }
                        if ($orderM > 0) {
                            if ($orderM > 1) {
                                $orderDetail .= $orderM . ' Medium T-Shirts<br>';
                            } else {
                                $orderDetail .= $orderM . ' Medium T-Shirt<br>';
                            }
                        }
                        if ($orderL > 0) {
                            if ($orderL > 1) {
                                $orderDetail .= $orderL . ' Large T-Shirts<br>';
                            } else {
                                $orderDetail .= $orderL . ' Large T-Shirt<br>';
                            }
                        }
                        if ($orderXL > 0) {
                            if ($orderXL > 1) {
                                $orderDetail .= $orderXL . ' XL T-Shirts<br>';
                            } else {
                                $orderDetail .= $orderXL . ' XL T-Shirt<br>';
                            }
                        }
                        if ($order2X > 0) {
                            if ($order2X > 1) {
                                $orderDetail .= $order2X . ' 2X T-Shirts<br>';
                            } else {
                                $orderDetail .= $order2X . ' 2X T-Shirt<br>';
                            }
                        }
                        if ($order3X > 0) {
                            if ($order3X > 1) {
                                $orderDetail .= $order3X . ' 3X T-Shirts<br>';
                            } else {
                                $orderDetail .= $order3X . ' 3X T-Shirt<br>';
                            }
                        }
                        $orderTotal = $orderS + $orderM + $orderL + $orderXL + $order2X + $order3X;
                        $emailMessage = "<div style=\"margin:0 auto;width:600px;font:9pt/13pt verdana,arial,sans-serif;\">";
                        $emailMessage .= "<div style=\"font-size:9pt;line-height:13pt;margin:10px 0;\">Thank you for submitting an order for " . $orderTotal . ' ' . $orderCopy . "</div>";
                        $emailMessage .= "<div style=\"font-size:9pt;line-height:13pt;margin:10px 0;\">" . $pickupMessage. "</div>";
                        $emailMessage .= "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">A summary of your order is listed below.  Keep this email for your records.</div>";
                        $emailMessage .= "<div style=\"margin:18px 0;\">Thank you!</div>";
                        $emailMessage .= "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $emailMessage .= "<div style=\"border-top:1px dotted #999;height:1px;margin-top:15px;padding-top:15px;\">&#160;</div>";
                        $emailMessage .= "<div style=\"margin:5px 0;font-size:.9em;\">If you have any additional questions, please contact <a href=\"mailto:shop_manager@gsnetx.org?subject=Question about The T-Shirt Order Form\">shop_manager@gsnetx.org</a> or call (972)349-2400.<br></div>";
                        $emailMessage .= "<table cellpadding=\"8\" cellspacing=\"0\" style=\"width:610px;padding:4px;\">";
                        $emailMessage .= "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;\"><strong>Order Details</strong></th></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . nameize($orderFName) . " " . nameize(stripslashes($orderLName)) . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;vertical-align:top;\">Items Ordered:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">".$orderDetail."</td></tr>";
                        if ($orderDelivery == 'home') {
                            $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Address:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $orderAddress . "</td></tr>";
                            $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">City:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $orderCity . "</td></tr>";
                            $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">State:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $orderState . "</td></tr>";
                            $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Zip Code:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $orderZip . "</td></tr>";

                        }
                        $emailMessage    .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $orderPhone . "</td></tr>";
                        $emailMessage    .= "<tr><td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Email Address:</td><td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\"><a href=\"mailto:".$orderEmail."\">".$orderEmail."</a></td></tr>";
                        $emailMessage .= "</table>";
                        $emailMessage .= "</div>";
                        //echo "CUSTOMER EMAIL:<br>" . $emailMessage . "<br><br>";
                        $shopMessage .= "<div style=\"width:600px;margin:0 auto;\">";
                        $shopMessage .= "<div style=\"font:normal 10pt/13pt verdana,arial,sans-serif;margin:0 0 10px 0;\">An order has been placed online for " . $orderTotal . ' ' . $orderCopy . ".</div>";
                        $shopMessage .= "<div style=\"font:bold 9pt/12pt verdana,arial,sans-serif;margin-bottom:4px;\">Order Details</div>";
                        $shopMessage .= "<table width=\"500\" cellpadding=\"3\" cellspacing=\"0\" style=\"border:1px solid #ccc;border-collapse:collapse;\">";
                        $shopMessage .= "<tbody>";
                        $shopMessage .= "<tr>";
                        $shopMessage .= "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Pickup location:</td>";
                        $shopMessage .= "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">" . $pickupLocation . "</td>";
                        $shopMessage .= "</tr>";
                        $shopMessage .= "<tr>";
                        $shopMessage .= "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;vertical-align: top;\">Items Ordered:</td>";
                        $shopMessage .= "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;vertical-align: top;\">" . $orderDetail . "</td>";
                        $shopMessage .= "</tr>";
                        $shopMessage .= "<tr>";
                        $shopMessage .= "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Name:</td>";
                        $shopMessage .= "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">" . $orderFName . "&#160;" . $orderLName . "</td>";
                        $shopMessage .= "</tr>";
                        if ($orderDelivery == 'home') {
                            $shopMessage .= "<tr>";
                            $shopMessage .= "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Address:</td>";
                            $shopMessage .= "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">".$orderAddress."<br />".$orderCity.", ".$orderState."&#160;".$orderZip."</td>";
                            $shopMessage .= "</tr>";
                        }
                        $shopMessage    .=          "<tr>";
                        $shopMessage    .=              "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Phone:</td>";
                        $shopMessage    .=              "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">".$orderPhone."</td>";
                        $shopMessage    .=          "</tr>";
                        $shopMessage    .=          "<tr>";
                        $shopMessage    .=              "<td valign=\"top\" width=\"35%\" style=\"font:bold 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\">Email Address:</td>";
                        $shopMessage    .=              "<td valign=\"top\" width=\"65%\" style=\"font:normal 8pt/11pt verdana,arial,sans-serif;border:1px solid #ccc;border-collapse:collapse;\"><a href=\"mailto:".$orderEmail."\">".$orderEmail."</a></td>";
                        $shopMessage    .=          "</tr>";
                        $shopMessage    .=      "</table>";
                        $shopMessage    .=      "</div>";
                    //===============================================================================================================================================
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
                                $message->setTo(array($orderEmail));
                                //$message->setTo(array('barker323@verizon.net'));
                                $message->setBody($emailMessage, 'text/html');
                                $message->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));
                            // SEND THE MESSAGE
                                if ($mailer->send($message)) {
                                    $tableName = "tbl_TCT_TShirtOrders";
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
                                    $message->setSubject('Email Error Report From the TXCT TShirt Order Form via GMail');
                                    $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Troop Cookie Manager Shirt Order'));
                                    $message->setTo(array('webmaster@gsnetx.org'));
                                    //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                    $message->setBody(createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gsnetxEmail'));
                                    $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                //  SEND THE EMAIL
                                    $mailer->send($message);
                                    $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }
                            //=======================================================================================================================================
                            //= GSNETX EMAIL TO SHOP                                                                                                                =
                            //= =====================================================================================================================================
                            try {
                                $transport = Swift_SmtpTransport::newInstance('10.1.1.21',25);
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject($shopEmailSubject);
                                $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Troop Cookie Manager T-Shirt Order Form'));
                                //$message->setTo(array($email));
                                $message->setTo(array($shopEmailContact));
                                $message->setBody($shopMessage, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                if ($mailer->send($message)) {
                                    $tableName = "tbl_TCT_TShirtOrders";
                                    $emailTransport = "gsnetx";
                                    $emailSent = '1';
                                    $stmt = $dbh_write->prepare('EXEC GSNETX_Web_Events.dbo.sp_Update_EmailSendStatusForShop @tableName=:tableName,@formSecret=:formSecret,@emailTransport=:emailTransport,@emailSent=:emailSent');
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
                                $message->setSubject('Shop Email Error Report From the TXCT TShirt Order Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Troop Cookie Manager Shirt Order'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody(createTryCatchErrorMessage($gsnetxEmail,$dbFields,'gsnetxEmail'));
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                            // SEND THE MESSAGE
                                $mailer->send($message);
                                $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }
                        } else if (ping('smtp.gmail.com', 587, 3) == 1) {
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
                                $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Troop Cookie Manager Shirt Order'));
                                $message->setTo(array($orderEmail));
                                //$message->setTo(array('barker323@gmail.com'));
                                $message->setBody($emailMessage, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                //$mailer->send($message);
                                if ($mailer->send($message)) {
                                    //echo "<strong>EMAIL SENT FROM GMAIL MAIL</strong><br><br>";
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_TShirtOrders";
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
                                $message->setSubject('Shop Email Error Report From the TXCT TShirt Order Form via GMail');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody(createTryCatchErrorMessage($gmail,$dbFields,'gmail'));
                                $message->setBody('GMAIL FAIL<br> '.$gmail, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                            // SEND THE MESSAGE
                                $mailer->send($message);
                                $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                           }
                            //=================================================================================================================================================
                            //= GMAIL EMAIL TO SHOP                                                                                                                           =
                            //= ===============================================================================================================================================
                            try {
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject($shopEmailSubject);
                                $message->setFrom(array('webmaster@gsnetx.org' => 'GSNETX Troop Cookie Manager T-Shirt Order Form'));
                                //$message->setTo(array($email));
                                $message->setTo(array($shopEmailContact));
                                $message->setBody($shopMessage, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                //$mailer->send($message);
                                if ($mailer->send($message)) {
                                    //echo "<strong>EMAIL SENT FROM GMAIL MAIL</strong><br><br>";
                                    //= EMAIL SENT SUCCESSFULLY. UPDATE DATABASE SENT EMAIL FLAG TO TRUE =============================================================
                                    $tableName = "tbl_TCT_TShirtOrders";
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
                                //echo "<br>Catch GMAIL" . "<br>";
                                $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls');
                                $transport->setUsername('gsnetxweb@gmail.com');
                                $transport->setPassword('divasRock2012');
                                $mailer = Swift_Mailer::newInstance($transport);
                                $message = Swift_Message::newInstance();
                                // SET PRIORITY TO HIGH
                                $message->setPriority(3);
                                $message->setSubject('Shop Error Report From the TXCT TShirt Order Form');
                                $message->setFrom(array('webmaster@gsnetx.org' => 'Girl Scouts of Northeast Texas'));
                                $message->setTo(array('webmaster@gsnetx.org'));
                                //$message->setBody($gMail . "\r\n\r\nFORM DATA\r\nFName: ".$fName."\r\nLName: ".$lName."\r\nPhone: ".$phone."\r\nCity: ".$city."\r\nZip: ".$zip."\r\nEmail: ".$email."\r\nGrade: " . $grade);
                                $message->setBody(createTryCatchErrorMessage($gmail,$dbFields,'gmail'));
                                $message->setBody('GMAIL FAIL<br> '.$gmail, 'text/html');
                                $message->setBcc(array('jrbarker@gsnetx.org' => 'Bob Barker'));
                                // Send the message
                                $mailer->send($message);
                                $emailErrorMessage = "<div class=\"brokenEmailWrapper\">Unfortunately, we were unable to send the confirmation email.<br>Our IT department has been notified and is working on the problem.<br>The confirmation will be sent when the issue is resolved.</div>";
                            }

                            //= SEND CONFIRMATION VIA GMAIL ===================================================================================================================
                        }
                    } catch (Exception $dbError) {
                        $databaseErrorMessage = "<div class=\"dataWrapper\">We're sorry, but we're unable to process your information at this time.<br>Our IT department has been notified and is working on the problem.</div>";
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
                            $message->setSubject('DB Error Report From the TXCT TShirt Order Form');
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
                    $duplicateErrorMessage = "<div class=\"duplicateWrapper\">This order has already been submitted. If you wish to submit another, please start at the <a href=\"tshirtOrder.php\">beginning of the form</a>.</div>";
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
				//echo "SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
                session_unset();
                session_destroy();
                header("location: tshirtOrder.php");
            }
        } else {
            //echo "HTTP_REFERRER NOT COMING FROM TCM APPLICATION - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
            //exit();
            session_unset();
            session_destroy();
            header("location: tshirtOrder.php");
        }
    } else {
		//echo "HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
		//exit;
        session_unset();
        session_destroy();
        header("location: tshirtOrder.php");
    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Texas Cookie Time TShirt Order Form Confirmation</title>
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
                    <div class="span-20"><h1>Order Confirmation</h1></div>
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
