<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    date_default_timezone_set('America/Chicago');
    ini_set("display_errors", 1);
    $transMessage = '';
    if (strlen($_POST['labrea']) != 0) {							        //=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
        //		echo "Redirect page to home page";
        header("Location:default.php");								        //= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
    }

//= CHECK SUBMIT BUTTON STATUS//======================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	======================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        require("i_ODBC_Functions.php");
        require("includes/i_T2TSettings.php");
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM 	==============================================================================
        if(returnPageName($_SERVER['HTTP_REFERER']) == 'review.php') {
//=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==============================================================================
            if (strtolower($_POST["submitReview"]) == 'submiteventreview') {
                $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $ipAddress = getIPAddr();
                if($_SERVER['COMPUTERNAME'] == 'RODBY') {
                    $connectionVar = 'GSNETX';
                } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {

                }
                require("i_ODBC_Connection.php");												//=	CREATES ODBC DATA CONNECTION TO DATABASE
				require_once('class.phpmailer.php');
                $ckSQL = "select id,emailSent from tbl_WDLRegistrations where formSecret = '".$formSecret."'";
                $result = odbc_exec($writeConn,$ckSQL);
                $id = odbc_result($result,'id');
                $emailSent = odbc_result($result,'emailSent');
//                echo "SQL: ".$ckSQL."<br>";
//                echo "<br>ID: ".$id."<br>";
//                echo "EMail Flag: ".$emailSent."<br>";

                if ($id == '') {
//= SET VARIABLES FOR ALL COMMON FIELDS ==============================================================================================================
                    session_start();
                    setVars('formSecret:str,selectEvent:str,tktTickets:mon,tblNumTables:mon,tblMoreTables:bit,conTitle:str,conFName:str,conLName:str,conCompany:str,conPosition:str,conAddress:str,conCity:str,conState:str,conZip:int,conPhone:str,conFax:str,conEmail:str,sponsorLevel:str,donateAmt:mon,donateAck:str,donateAnon:bit,tribute1:mon,tribute2:mon,tribute3:mon,tribute4:mon,totalAmount:mon,billingFName:str,billingLName:str,billingAddress:str,billingCity:str,billingState:str,billingZip:int,billingPhone:str,billingEmail:str,ccType:str,ccNum:str,ccExpMonth:int,ccExpYear:int,ccCVV2:int',0,0,null,'Common Fields');
                    if ($selectEvent == 'donate') {
                        $eventTitle = "Girl Scouts of Northeast Texas Women of Distinction Luncheon Donation.\n";
                    }else {
                        $eventTitle = "Girl Scouts of Northeast Texas Women of Distinction Luncheon Registration.\n";
                    }
//                  echo "<br><br>SQL: ".$ckSQL."<br><br>";
//=  USA ePay PHP Library.
//===========================================================================================================================================================================
                //      v1.6
                //      Copyright (c) 2002-2008 USA ePay
                //      For support please contact devsupport@usaepay.com
                //
                //      The following is an example of running a transaction using the php library.
                //      Please see the README file for more information on usage.
                //      Change this path to the location you have save usaepay.php to
                    include ("usaepay.php");
    			// Instantiate USAePay client object
					$tran=new umTransaction;
					$tran->cabundle='<?//php echo $certpath?//>';
					$tran->cabundle='c:\windows\curl-ca-bundle.crt';
				// Merchants Source key must be generated within the console
                    //$tran->key="GhMFgFhudvuq1c2g40mpv9ayfV1n5Cl3";   	//-- SANDBOX KEY
                    $tran->key="D65w3n092MaLNcXPKa1rFQnPx2veok8d";			//-- PRODUCTION KEY FOR REGISTRATON EVENT
				// Send request to sandbox server not production.  Make sure to comment or remove this line before putting your code into production
//					$tran->usesandbox=true;
//					$tran->testmode=true;
					$invoiceNum = makePin();
					$tran->card=$ccNum;
					$tran->exp=$ccExpMonth.$ccExpYear;
                    $tran->amount=$totalAmount;
                    $tran->invoice=$invoiceNum;
                    $tran->cardholder=stripslashes(stripslashes(stripslashes(nameize($billingFName)))).' '.stripslashes(stripslashes(stripslashes(nameize($billingLName))));
                    $tran->street=nameize($billingAddress);
                    $tran->zip=$billingZip;
                    $tran->description=$eventTitle;
                    $tran->cvv2=$ccCVV2;
                    $tran->custemail = $billingEmail;
                    $tran->custreceipt='yes';
                    $tran->billfname=stripslashes(stripslashes(stripslashes($billingFName)));
                    $tran->billlname=stripslashes(stripslashes(stripslashes($billingLName)));
                    $tran->billstreet=stripslashes(stripslashes(stripslashes($billingAddress)));
                    $tran->billcity=stripslashes(stripslashes(stripslashes($billingCity)));
                    $tran->billstate=$billingState;
                    $tran->billzip=$billingZip;
                    $tran->billphone=$billingPhone;
                    //echo "<h1>Please Wait One Moment While We process your card.<br>\n";
                    flush();
                    if($tran->Process()) {
                        //if(!$tran->error) {
                        $authCode = $tran->authcode;
                        $requestGuid = createGuid();
                        //echo "<br>".$authCode."<br>";
//=================================================================================================================================================
// CREATE ON-SCREEN CONFIRMATION MESSAGE																			*
//=================================================================================================================================================
//= CREATE ARRAY FOR PASSING TO PRINT INVOICE PAGE
                        $messageArray = nameize($conFName) . " " . nameize($conLName) . "|" . nameize($conAddress) . "|" . nameize($conCity) . ", " . $conState . "  " . $conZip . "|" . $invoiceNum . "|" . $authCode . "|" . $totalAmount . "|" . $tktTickets . "|" . $tblNumTables . "|" . $sponsorLevel . "|" . $donateAmt . "|" . $donateAnon . "|" . $tribute1 . "|" . $tribute2 . "|" . $tribute3 . "|" . $tribute4 . "|" . $selectEvent;
                        $transMessage = "<div style=\"line-height:1.6em;\">";
                        if ($selectEvent == 'donate') {
                            $transMessage .= "<div style=\"margin:10px;font-weight:bold;font-size:1.1em;\">Thank you for your donation to the 2014 Women of Distinction Luncheon .</div>";
                        } else {
                            $transMessage .= "<div style=\"margin:10px;font-weight:bold;font-size:1.1em;\">Your Registration to the 2014 Women of Distinction Luncheon has been confirmed.</div>";
                        }
                        $transMessage .= "<div style=\"margin\">&#32;</div>";
                        $transMessage .= "<div style=\"margin:2px 10px;font-size:1em;\">Your invoice number is " . $invoiceNum . ".</div>";
                        $transMessage .= "<div style=\"margin:2px 10px;\">Your authorization code is " . $authCode . ".</div>";
                        $transMessage .= "<div style=\"margin:2px 10px;\">You will receive payment confirmation via e-mail shortly.</div>";
                        $transMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;\">&#32;</div>";
                        $transMessage .= "<div style=\"margin-left:10px;\">Print an itemized receipt or this registration for your records.&nbsp;&nbsp;&nbsp;<input type=\"button\" class=\"eventPrintButton\" value=\"Print Registration\" id=\"button\" onclick=\"PopupCenter('print.php?print=" . $messageArray . "', 'myPop1',520,545);\" /></div>";
                        $transMessage .= "<div style=\"margin:10px;height:1px;border-bottom:1px dotted #999;clear:both;\">&#32;</div>";
                        $transMessage .= "<div style=\"margin:15px 10px;\">If you have any additional questions, please contact Brianna Morris at <a href=\"mailto:bmorris@gsnetx.org?subject=2014 Women of Distinction Luncheon\">bmorris@gsnetx.org</a> via e-mail.</div>";
                        $transMessage .= "</div>";
                        // echo "Array: ".$messageArray;
                        // echo "<div style=\"margin:15px 0 7px 0;\" class=\"noPrint\"><hr></div>";
                        // echo "<div style=\"margin:12px 0;\" class=\"noPrint\">Please print this page for your records.<input type=\"button\" name=\"printMe\" id=\"printMe\" value=\"Print Receipt\" class=\"rgrwPrintButton\" style=\"margin-left:20px;clear:both;\" onClick=\"printit()\"/></div>";
                        // echo "Process form and write to database";
//===============================================================================================================================================
// WRITE INFORMATION TO DATABASE																												*
//===============================================================================================================================================
                        $sql = "{CALL sp_Save_WDLRegistrations(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";
                        $stmt = odbc_prepare($writeConn, $sql);
                        $success = odbc_execute($stmt, array(
                            $formSecret,
                            $ipAddress,
                            $selectEvent,
                            $tktTickets,
                            $tblNumTables,
                            $tblMoreTables,
                            stripslashes(stripslashes(stripslashes($conTitle))),
                            stripslashes(stripslashes(stripslashes($conFName))),
                            stripslashes(stripslashes(stripslashes($conLName))),
                            stripslashes(stripslashes(stripslashes($conCompany))),
                            stripslashes(stripslashes(stripslashes($conPosition))),
                            stripslashes(stripslashes(stripslashes($conAddress))),
                            stripslashes(stripslashes(stripslashes($conCity))),
                            $conState,
                            $conZip,
                            $conPhone,
                            $conFax,
                            $conEmail,
                            $sponsorLevel,
                            $tribute1,
                            $tribute2,
                            $tribute3,
                            $tribute4,
                            $donateAmt,
                            stripslashes(stripslashes(stripslashes($donateAck))),
                            $donateAnon,
                            stripslashes(stripslashes(stripslashes($billingFName))),
                            stripslashes(stripslashes(stripslashes($billingLName))),
                            stripslashes(stripslashes(stripslashes($billingAddress))),
                            stripslashes(stripslashes(stripslashes($billingCity))),
                            $billingState,
                            $billingZip,
                            $billingPhone,
                            $billingEmail,
                            $totalAmount,
                            $authCode,
                            $invoiceNum
                        ));

//= EMAIL REGISTRATION CONFIRMATION TO REGISTRANT ============================================================================================
                        $emailHeader = "<div style=\"margin: 0 0 10px 10px;\"><img src=\"http://www.gsnetx.org/content/dam/NE_Texas/images/email/emailHeader.png\" width=\"600\" height=\"82\" alt=\"Event logo image\"></div>";
                        if ($selectEvent == 'donate') {
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Thank you for your donation to the 2014 Women of Distinction Luncheon.</p>";
                            if (($_SESSION["donateAnon"] == 1) && ($_SESSION["donateAck"] == "")) {
                                $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Your donation will be made anonymously.</p>";
                            } else if (($_SESSION["donateAnon"] == 1) && ($_SESSION["donateAck"] != "")) {
                                $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Your donation will be made anonymously and in the name of " . $_SESSION["donateAck"] . ".</p>";
                            } else if (($_SESSION["donateAnon"] == 0) && ($_SESSION["donateAck"] != "")) {
                                $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Your donation will be made in the name of " . $_SESSION["donateAck"] . ".</p>";
                            }
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Please contact Brianna Morris at <a href=\"mailto:bmorris@gsnetx.org?subject=2014 Women of Distinction Luncheon Donation Question\">bmorris@gsnetx.org</a> with any questions that you may have.</p>";

                        } else {
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Thank you for registering for the 2014 Women of Distinction Luncheon on November 19, 2014 at the Hilton Anatole Chantilly Ballroom..</p>";
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Your payment has been approved and your registration to the event confirmed.</p>";
                            if ((($selectEvent == 'ticket') && (($tktTickets / 150) > 1)) || ($selectEvent == 'table')) {
                                $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">Please contact Brianna Morris at <a href=\"mailto:bmorris@gsnetx.org?subject=2014 Women of Distinction Guest List\">bmorris@gsnetx.org</a> with your guest list and for any questions that you may have.</p>";
                            }
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">You will receive a receipt for your payment shortly.</p>";
                            $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">All tickets will be held at the door. Doors open at 11:00 a.m.</p>";
                        }
                        $email .= "<p style=\"font:11px/14px verdana,arial,sans-serif;margin-left:20px;\">We appreciate your support of Girl Scouting.</p>";
                        // }
                    } else {
////=================================================================================================================================================
////= IF TRANSACTION IS DECLINED, DISPLAY SCREEN MESSAGE
////=================================================================================================================================================
                        $transMessage	.= "<div style=\"margin:5px 0;\">Card Declined: (".$tran->error.")</div>";
                        $transMessage	.= "<div style=\"margin:5px 0 25px 0;\">Please try entering your payment information again<input type=\"button\" value=\"Go Back\" class=\"wdlBackButton\" onclick=\"history.go(-2);\" style=\"margin-left:10px;\"/></div>";
                        if($tran->curlerror) $transMessage .= "<b>Curl Error:</b> " . $tran->curlerror . "<br>";
                   }
                } else {
//=================================================================================================================================================
//= IF TRANSACTION HAS ALREADY BEEN SUBMITTED, DISPLAY SCREEN MESSAGE
//=================================================================================================================================================
                        $transMessage	.= "<div style=\"margin: 40px 0 20px 0;font-size:1.1em;font-weight:bold;\">This information has already been submitted.</div>";
                        $transMessage	.= "<div style=\"margin: 30px 0 70px 0;\">If you need to make additional registrations or donations, please start over at the <a href=\"default.php\">beginning of the form</a>.</div>";
                        session_unset();
                        session_destroy();
                }

                if($emailSent == 0) {
//= PROCESS EMAIL FOR REGISTRANT HERE =========================================================================================================================================
//                    if(!$tran->error) {                                          // DON'T SEND EMAIL IF THE TRANSACTION FAILS
                    $mail = new PHPMailer(true);                            // defaults to using php "mail()"
                    try {
                        $body = $emailHeader . $email;
                        $body = preg_replace("[\\\]", '', $body);
                        $mail->SMTPDebug = 0;
                        $mail->SetFrom("webmaster@gsnetx.org", null);
                        $mail->AddReplyTo("webmaster@gsnetx.org", null);
                        $mail->AddAddress($conEmail, null);
                        $mail->AddBCC("bbarker@gsnetx.org");
                        if($selectEvent == 'donate') {
                            $mail->Subject = "Women of Distinction Luncheon Donation Confirmation";
                        } else {
                            $mail->Subject = "Women of Distinction Luncheon Registration Confirmation";
                        }
                        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->MsgHTML($body);
                        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
                        if (!$mail->Send()) {
                            //  echo "<strong>EMAIL NOT SENT</strong> - flag set in database to 0.<br>";
                            $transMessage = "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
                            $transMessage .= "<div style=\"font-weight:bold;color:#900;\">Unfortunately, your confirmation email was not sent.</div>";
                            $transMessage .= "<div style=\"margin: 10px 0 70px 0;color:#333;\">Please refresh the screen to try again. Your registration will not be re-submitted.</div>";
                            $transMessage .= "</div>";
                            $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_WDLRegistrations','" . $_SESSION['formSecret'] . "',0)}");
                            odbc_execute($results, array());
                        } else {
                            //  echo "<strong>EMAIL SENT</strong> - flag set in database to 1<br>";
                            $transMessage .= "<div style=\"margin: 0 0 70px 10px;\">Your confirmation email should arrive shortly.</div>";
                            $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_WDLRegistrations','" . $formSecret . "',1)}");
                            odbc_execute($results, array());
                            if ($tran->error) {

                            } else {
                                session_unset();
                                session_destroy();
                            }
                        }
                    } catch (phpmailerException $e) {
                        echo $e->errorMessage();
                    } catch (phpmailerException $e) {
                        echo $e->getMessage();
                    }
//                    }
                } else {
//                    echo "Email already sent";
                }
            } else {
                header("location: default.php");
            }
        } else {
            header("location: default.php");
        }
    } else {
        header("location: default.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo date("Y");?> Women of Distinction Luncheon Online Registration Form</title>
    <link rel="stylesheet" href="css/wdlEvent.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/general.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/vendors/modernizr.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js" ></script>
<!--    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.js"></script>-->
<!--    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>-->
<!--    <script type="text/javascript" src="js/vendors/additional-methods.js"></script>-->
    <script type="text/javascript" src="js/vendors/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="js/vendors/jquery.maskMoney.js"></script>
    <script type="text/javascript" src="js/vendors/jquery.tooltipster.js"></script>
    <script type="text/javascript" src="js/i_WDLScripts.js"></script>
    <script type="text/javascript" src="js/i_WDLValidation.js"></script>
<!--    <script src="js/vendors/popup.js" type="text/javascript"></script>-->
</head>
<body class="no-print">
<div  style="background:url('img/formHeader.png') repeat-x top left;">
        <div class="container" style="position:relative;">
            <div class="span-1"><p>&#32;</p></div>
            <div class="span-11"><img src="img/gsnetxLogoWhite.png" width="175" height="66" alt="" style="float:left;border:none;" /></div>
            <div class="span-11"><img src="img/hd_WomenOfDistinctionRegistrations.png" style="float:right;border:none;" alt="" ></div>
            <div class="span-1 last"><p>&#32;</p></div>
        </div>
        <!-- ## BEGIN FORM MAIN BODY ################################################################################################ -->
        <div>
            <!-- ## BEGIN PAGE 1 ######################################################################################################## -->
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
                <?php if( 1==2) {?>
                    <div class="container showWhite" style="position:relative;">
                        <div class="span-24" style="height:100px;">&nbsp;</div>
                        <div class="span-24"><p>&nbsp;</p></div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24"><p>&#32;</p></div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20" style="font-size:1.3em;text-align:center;">Registrations for the 2014 Women of Distinction Luncheon are now closed.<br><br>You may still purchase tickets on the day of the event at the door.</div>
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
                    <div class="container showWhite" style="position:relative;">
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-18"><?php echo createPageNav(4,'1. Registration:default;2. Billing:billing;3. Review:review;4. Confirm:confirm');?></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>

                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-10 newSection"><img src="img/confirmationHeader_Sm.png" width="250" height="20" alt="" style="margin-top:19px;" /></div>
                        <div class="span-10 newSection"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20 dividerSection">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop10">&#32;</div>

                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20"><?php echo $transMessage;?></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>
                        <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br><br><br><br><br><br></div>
                    </div>
                <?php }?>
            </div>
        </div>
        <div style="clear:both;">&nbsp;</div>
        <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
    </div>
</body>
<div id="popupContact" class="print">
    <a id="popupContactClose">x</a>
    <h1>Title of our cool popup, yay!</h1>
    <table cellpadding="0" cellspacing="0" border="0" width="490" style="margin:10px auto 0 auto;">
        <tr>
            <td width="10"></td>
            <td colspan="2"><img src="img/printPageHeader.png" width="470" height="75" border="0" alt="" style="margin-bottom:8px;" /></td>
            <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="noPrintLink"><a href="javascript:window.open();window.print();">Print this page</a></td>
            <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
        </tr>
        <tr>
            <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
            <td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px solid #999;">&nbsp;</div></td>
            <td></td>
        </tr>
        <tr><td></td><td valign="top" class="printHeader" colspan="2">Registation Receipt</td><td></td></tr>
        <tr><td></td><td class="printLabelSm" colspan="2">Invoice Number:&nbsp;<span style="font-weight:normal;">&nbsp;<?php echo $arrPrint[3];?></span></td><td></td></tr>
        <tr><td></td><td class="printLabelSm" colspan="2">Authorization Number:&nbsp;<span style="font-weight:normal;">&nbsp;<?php echo $arrPrint[4];?></span></td><td></td></tr>
        <tr><td colspan="4" class="printSpacer">&nbsp;<td></td></tr>
        <tr><td></td><td class="printHeaderSm" colspan="2">Payment Received From:</td><td></td></tr>
        <tr><td></td><td class="printLabelTxt" colspan="2"><?php echo $arrPrint[0]."<br>".$arrPrint[1]."<br>".$arrPrint[2];?></td><td></td></tr>
        <tr><td width="10"></td><td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px dashed #999;">&nbsp;</div></td><td></td></tr>
        <tr>
            <td></td>
            <td colspan="2">
                <table cellpadding="0" cellspacing="0">
                    <tr><td class="receiptLabel receiptLabel1">Description</td><td class="receiptLabel receiptLabel2">Quantity</td><td class="receiptLabel receiptLabel3">Price</td><td class="receiptLabel receiptLabel4">Amount</td></tr>
                    <tr><td>
                            <?php echo "ArrPrint 6: ".$arrPrint[6]."<br>";?>
                            <?php echo "ArrPrint 7: ".$arrPrint[7]."<br>";?>
                            <?php echo "ArrPrint 8: ".$arrPrint[8]."<br>";?>
                    </td></tr>
                    <?php if(intval($arrPrint[6]) > 0) {?>                                                                          <!-- TICKETS -->
                        <tr>
                            <td class="receiptText" valign="top">Event Tickets </td>
                            <td class="receiptText center" valign="top"><?php echo $numTickets;?></td>
                            <td class="receiptText center" valign="top">$150.00</td>
                            <td class="receiptText right" valign="top">$<?php echo number_format($arrPrint[6],2);?></td>
                        </tr>
                    <?php } else if (intval($arrPrint[7]) > 0) {?>                                                                  <!-- TABLES -->
                        <tr>
                            <td class="receiptText" valign="top">Event Tables </td>
                            <td class="receiptText center" valign="top"><?php echo $numTables; ?></td>
                            <td class="receiptText center" valign="top">$1500.00</td>
                            <td class="receiptText right" valign="top">$<?php echo number_format($arrPrint[7],2);?></td>
                        </tr>
                    <?php }?>
                    <?php if (intval($arrPrint[9]) > 0) {?>
                        <?php if($arrPrint[10] == 1) {
                            $anonCopy = "Anonymous ";
                        }else {
                            $anonCopy = '';
                        };?>
                        <tr>
                            <td class="receiptText" valign="top"><?php echo $anonCopy;?>Donation</td>
                            <td class="receiptText center" valign="top"><?php echo $arrPrint[9]; ?></td>
                            <td class="receiptText center" valign="top">&#32;</td>
                            <td class="receiptText right" valign="top">$<?php echo number_format($arrPrint[9],2);?></td>
                        </tr>
                    <?php }?>
                    <!--
                     <?//php if ($numGuests > 0) {?>
                        <?//php if ($numGuessts > 1) {?>
                             <tr>
                              <td class="receiptText" valign="top">Guest Registrations </td>
                              <td class="receiptText center" valign="top"><?//php echo $numGuests;?></td>
                              <td class="receiptText center" valign="top">$10.00</td>
                              <td class="receiptText right" valign="top">$<?//php echo ($numGuests*10);?>.00</td>
                            </tr>
                        <?//php } else { ?>
                             <tr>
                              <td class="receiptText" valign="top">Guest Registration </td>
                              <td class="receiptText center" valign="top">1</td>
                              <td class="receiptText center" valign="top">$10.00</td>
                              <td class="receiptText right" valign="top">$10.00</td>
                            </tr>
                    <?//php } ?>
                    <?//php } ?>
        -->
                    <tr>
                        <td colspan="4"><div style="margin:5px 0;height:1px;border-bottom:1px solid #999;">&nbsp;</div></td>
                    </tr>
                    <tr>
                        <td class="receiptLabel right" colspan="3">Total</td>
                        <td class="receiptText right"><strong>$<?php echo number_format($totalAmount,2);?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="2" style="text-align:left;font-size:8pt;" class="noPrintLink"><br /><a href="Javascript:window.close();">close window</a><br /><br /></td>
            <td></td>
        </tr>
        <tr>
            <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
            <td width="200"><img src="img/spacer.png" width="200" height="1" /></td>
            <td width="260"><img src="img/spacer.png" width="260" height="1" /></td>
            <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
        </tr>
    </table>
</div>
<div id="backgroundPopup"></div>

</html>
