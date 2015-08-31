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
//        echo "SUBMIT: HTTP REFERRER SET OK<br>";
        session_start();
        require("i_ODBC_Functions.php");
        require("includes/i_TCMSettings.php");
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM ===========================================================================================
        if(strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 'tcmapplication.php') {
//            echo "SUBMIT: COMING FROM TCM APPLICATION HOMEPAGE<br>";
            if (strtolower($_POST["submitRegistration"]) == 'submittroopcookiemanagerregistration') {
//                echo "SUBMIT VALUE OK<br>";
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
                setVars('volFName:str,volLName:str,volEmail:str,volPhone:str,volIDType:str,volID:str,volTroop:str,volSU:str,txt1:str,txt2:str,txt3:str,txt4:str,txt5:str,txt6:str,txt7:str,txt8:str,txt9:str,txt10:str,txt11:str,txt12:str,txt13:str,txt14:str,volSignedName:str,', 0, 0, 'TCM Application Form');
                $pageTitle = "Troop Cookie Manager Application Form";
                $pageHeader = "TroopCookieManagerApplication";
                //==============================================================================================================================================
                //= PROCESS DATA FROM FORM	====================================================================================================================
                //= ONCE FORM HAS BEEN SUBMITTED WRITE THE ORDER INFORMATION TO THE DATABASE	                                                               =
                //==============================================================================================================================================
                $ckSQL = "select id,emailSent from tbl_TCT_TCMApplication where formSecret = '" . $formSecret . "'";
                $result = odbc_exec($writeConn, $ckSQL);
                $id = odbc_result($result, 'id');
                $emailSent = odbc_result($result, 'emailSent');
//                echo "SQL: ".$ckSQL."<br>";
//                echo "<br>ID: ".$id."<br>";
//                echo "EMail Flag: ".$emailSent."<br>";
//                echo "SECRET: ".$formSecret;

                if ($id == '') {
                    $sql = "{CALL sp_Save_TCT_TCMApplication(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}";
                    $stmt = odbc_prepare($writeConn, $sql);
                    $success = odbc_execute($stmt, array(
                        $formSecret,
                        $ipAddress,
                        nameize($volFName),
                        nameize($volLName),
                        $volEmail,
                        $volPhone,
                        $volIDType,
                        $volID,
                        $volTroop,
                        $volSU,
                        $txt1,
                        $txt2,
                        $txt3,
                        $txt4,
                        $txt5,
                        $txt6,
                        $txt7,
                        $txt8,
                        $txt9,
                        $txt10,
                        $txt11,
                        $txt12,
                        $txt13,
                        $txt14,
                        nameize($volSignedName)
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
                     if($emailSent == 0) {
                        $emailMessage = "<div style=\"margin:0 auto;width:600px;font:9pt/13pt verdana,arial,sans-serif;\">";
                        $emailMessage .= "<div style=\"font-size:9pt;line-height:13pt;margin:10px 0;\">Thank you for submitting your Girl Scout Troop Cookie Manager Agreement.</div>";
                        $emailMessage .= "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">The information you submitted is summarized below.  Keep this email for your records.</div>";
                        $emailMessage .= "<div style=\"margin:18px 0;\">Thank you!</div>";
                        $emailMessage .= "<div style=\"margin:8px 0;\">Girl Scouts of Northeast Texas</div>";
                        $emailMessage .= "<div style=\"border-top:1px dotted #999;height:1px;margin-top:15px;padding-top:15px;\"><img src=\"https://www.texascookietime.org/img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                        $emailMessage .= "<div style=\"margin:5px 0;font-size:.9em;\">If you have any additional questions, please contact <a href=\"mailto:customercare@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">customercare@gsnetx.org</a> or call (972)349-2400.</div><br>";
                        $emailMessage .= "<table cellpadding=\"8\" cellspacing=\"0\" style=\"width:600px;padding:4px;\">";
                        $emailMessage .= "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;\"><strong>Troop Cookie Manager Application Confirmation</strong></th></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Volunteer Name:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . nameize($volFName) . " " . nameize($volLName) . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Volunteer Email:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $volEmail . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Volunteer Phone:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $volPhone . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Troop Number:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $volTroop . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">Service Unit:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $volSU . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Type:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . $volIDType . "</td></tr>";
                        $emailMessage .= "<tr><td style=\"font:8pt/13pt verdana,arial,sans-serif;width:175px;color:#333;padding:4px;text-align:right;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">ID Number Ending in:</td><td style=\"font:8pt/13pt verdana,arial,sans-serif;padding:4px;font-weight:normal;border:1px solid #ccc;border-collapse:collapse;width:425px;\">" . substr($volID, -4) . "</td></tr>";
                        $emailMessage .= "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage .= "<tr><th colspan=\"2\" style=\"font:10pt/14pt verdana,arial,sans-serif;font-weight:bold;color:#333;padding:4px 6px;text-align:left;\">Acknowledgements and Agreements</th></tr>";
                        $emailMessage .= "<tr><td colspan=\"2\" style=\"font:8pt/13pt verdana,arial,sans-serif;color:#333;padding:10px;border:1px solid #ccc;border-collapse:collapse;font-weight:bold;\">By submitting this form, the submitter has acknowledged that:";
                        $emailMessage .= "<ul style=\"margin:4px 10px 8px 25px;\">";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is a requirement that I take the GSNETX online Cookie Program Training.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand that I am responsible for holding girl & parent/guardian information session(s) and distributing Cookie Program information and forms to girls and their parents.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I will ensure girls are registered for the current Girl Scout membership year and ensure online Cookie Program Parent Permission Forms for each participating Girl Scout are completed.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to interpret to girls and their parents/guardians the Cookie Program procedures, girl reward program, and the importance of the Cookie Program to the council and to the girl&rsquo;s leadership journey.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to communicate and cooperate with my Girl Scout Service Unit Cookie Coordinator (SUCC) and <strong>adhere to deadlines</strong>.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to train Girl Scouts on all aspects of the 5 Skills of the Cookie Program.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to promote booth sales and request booth space and time, as needed.  I will ensure that a positive image of Girl Scouting is presented to the community during booth sales.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to set due dates to receive girl cookie orders, payments and girl rewards selection information from girls and parents/guardians.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to maintain accurate records (paper copies and within all software applications including eBudde) and will issue receipts any time products or money is exchanged.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">As the Girl Scout Troop Cookie Manager, I agree that it is my responsibility to timely complete and submit any Outstanding Funds Report Forms and to follow all established guidelines for reporting unpaid or delinquent funds owed for the Girl Scout Troop cookie money. I agree that I will not be allowed to submit an Outstanding Funds Report Form for money which I personally owe for the Girl Scout Troop cookie money.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">As the Girl Scout Troop Cookie Manager, I understand that collection action will be taken on all outstanding accounts and debts for the Girl Scout Troop cookie money which are not settled in full by <strong>March 6, 2015</strong>. I understand that such outstanding accounts or debts may be reported to a credit bureau and referred to collection agencies and pursued through legal action against me.  I agree to pay all reasonable costs and expenses of collecting such outstanding debts and unpaid amounts, including collection agency fees, reasonable attorneys&rsquo; fees, and costs.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">As the Girl Scout Troop Cookie Manager, I agree that I am personally responsible for handling and accounting for the Girl Scout Troop cookie money. I understand that I assume all financial responsibility for collection and timely payment of all the Girl Scout troop cookie money for my troop.</label>
                                                <ul class=\"permissionList\">
                                                    <li>Therefore, I acknowledge that I am fully aware of this responsibility.</li>
                                                    <li>I agree to keep accurate records and to personally assume such financial responsibility for all Girl Scout Troop cookie money.</li>
                                                    <li>If any Girl Scout troop cookie money is owed, I accept personal financial responsibility for payment of that outstanding debts owed for the Girl Scout Troop cookie money.</li>
                                                 </ul>
                                             </li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin:5px 0;\"><strong>FIDUCIARY DUTY AND FINANCIAL RESPONSIBILITY</strong>: The undersigned Girl Scout Troop Cookie Manager hereby acknowledges his/her understanding and agreement that the responsibilities of a Troop Cookie Manager constitute a fiduciary duty for the benefit of the GSNETX and its beneficiaries. I have read the responsibilities outlined herein, understand them, and agree to assume them in accordance with all applicable GSNETX policies and procedures. I agree to accept, and do hereby accept, financial responsibility, for all Troop cookies entrusted for distribution, sale, collection, accounting, and deposit, and I further agree to adhere to, and abide by all of the prescribed GSNETX procedures and policies for record-keeping, accounting, and depositing cookie funds. Should it become necessary for GSNETX to incur collection fees, attorney&rsquo;s fees and/or costs for legal representation to collect any monies not paid, or payable, from the cookie sales, which are attributable to my Troop, I shall be responsible for all such collection agency fees, reasonable attorney&rsquo;s fees, and costs.</li>";
                        $emailMessage .= "<li style=\"font:8pt/12pt verdana,arial,sans-serif;font-weight:normal;list-style-type:square;margin-bottom:5px;\">I understand it is my responsibility to have completed the Criminal Background process and have been approved to volunteer with GSNETX.</li>";
                        $emailMessage .= "</ul>";
                        $emailMessage .= "</td></tr>";
                        $emailMessage .= "<tr><td colspan=\"2\" style=\"border:none;height:8px;\">&#32;</td></tr>";
                        $emailMessage .= "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">Submitted and Signed by: </td></tr>";
                        $emailMessage .= "<tr><td colspan=\"2\" style=\"border:none;font:10pt/13pt verdana,arial,sans-serif;font-weight:bold;\">" . nameize($volSignedName) . " - " . $date->format('F j, Y g:i a - T') . "</td></tr>";
                        $emailMessage .= "</table>";
                        $emailMessage .= "</div>";
                       // CREATE TRANSPORT CONFIG
                        $transport = Swift_MailTransport::newInstance();
                        // CREATE MSG
                        $message = Swift_Message::newInstance('10.1.1.21', 25);
                        // SET PRIORITY TO HIGH
                        $message->setPriority(2);
                        // SUBJECT
                        //                        $message->setSubject('Subject');
                        //                        // FROM
                        //                        $message->setFrom(array('webmaster@gsnetx.org'));
                        //                        // TO
                        //                        $message->setTo(array('bbarker@gsnetx.org'));
                        //                        // EMAIL BODY
                        //                        $message->setBody($emailMessage);
                        // SEND
                        if($emailSent == 0) {
                            $mailer = Swift_Mailer::newInstance($transport);
                            $message = Swift_Message::newInstance('Troop Cookie Manager Application Confirmation')
                                ->setFrom(array('cookies@gsnetx.org' => 'Girl Scouts of Northeast Texas Cookie Team'))
                                ->setTo(array(strtolower($volEmail) => nameize($volFName) . ' ' . nameize($volLName)))
                                ->setBody($emailMessage, 'text/html')
                                ->setBcc(array('bbarker@gsnetx.org' => 'Bob Barker'));;
                            // Send the message
                            $result = $mailer->send($message);
                            if (!$mailer->send($message, $failures)) {
                                echo "Failures:";
                                print_r($failures);
                                $screenMessage = "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
                                $screenMessage .= "<div style=\"font-weight:bold;color:#900;\">Unfortunately, your confirmation email was not sent.</div>";
                                $screenMessage .= "<div style=\"margin: 10px 0 70px 0;color:#333;\">Please refresh the screen to try again. Your registration will not be re-submitted.</div>";
                                $screenMessage .= "</div>";
                                $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_TCT_TCMApplication','" . $formSecret . "',0)}");
                                odbc_execute($results, array());
                            } else {
                                $screenMessage = "<div style=\"margin:0 auto;width:775px;\">";
                                $screenMessage .= "<div style=\"margin:10px 0;\">Thank you for submitting your Girl Scout Troop Cookie Manager Agreement.</div>";
                                $screenMessage .= "<div style=\"font-size:inherit;line-height:inherit;margin:8px 0;\">You will receive an email shortly, confirming your application.";
                                $screenMessage .= "<div style=\"margin:8px 0;\">We hope you will enjoy your role as Troop Cookie Manager.</div>";
                                $screenMessage .= "<div style=\"margin:8px 0;\"></div>";
                                $screenMessage .= "<div style=\"margin:12px 0 ;\">Thank you</div>";
                                $screenMessage .= "<div style=\"margin:0;\">Girl Scouts of Northeast Texas</div>";
                                $screenMessage .= "<div class=\"grayDottedDivider\"><img src=\"https://www.texascookietime.org/img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                                $screenMessage .= "<div style=\"margin:5px 0;\">If you have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookies@gsnetx.or</a> or call (972)349-2400.</div><br><br>";
                                $screenMessage .= "</div>";
                                $results = odbc_prepare($writeConn, "{CALL sp_Update_EmailSendStatus('tbl_TCT_TCMApplication','" . $formSecret . "',1)}");
                                odbc_execute($results, array());
                            }
                        } else {
                            $screenMessage = "<div style=\"margin: 0 0 0 10px;\"><img src=\"img/brokenEmail.png\" align=\"left\" style=\"margin-right:5px;\">";
                            $screenMessage .= "<div style=\"font-weight:bold;color:#900;\">An email has already be sent for this registration.</div>";
                            $screenMessage .= "<div class=\"grayDottedDivider\"><img src=\"img/spacer.png\" width=\"1\" height=\"20\" border=\"0\" /></div>";
                            $screenMessage .= "<div style=\"margin:5px 0;\">If you do not receive your confirmation or have any additional questions, please contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnetx.org?subject=Question about the Troop Cookie Manager Application\">cookiesk@gsnetx.or</a> or call (972)349-2400.</div><br><br></div>";
                        }
                     }
                } else {
                    $screenMessage  =	"<div class=\"screenMessage\" style=\"font:10pt/14pt verdana,arial,sans-serif;\">";
                    $screenMessage .=	"<div style=\"font:10pt/14pt verdana,arial,sans-serif;margin:10px 0;\">Information from this form has already been submitted.</div>";
                    $screenMessage .=	"<div class=\"messageDivider2\">&#32;</div>";
                    $screenMessage .=	"<div style=\"font:10pt/14pt verdana,arial,sans-serif;margin:10px 0;\">If you have any questions, contact the GSNETX Cookie Team at <a href=\"mailto:cookies@gsnex.org?subject=Question about the Troop Cookie Manager Application\">cookies@gsnetx.org</a> or 972-349-2400. </div>";
                    $screenMessage .=	"<p>&#160;</p><p>&#160;</p><p>&#160;</p>";
                    $screenMessage .=	"</div>";
                }
            } else {
//				echo "SUBMIT VALUE NOT PROPERLY SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
                session_unset();
                session_destroy();
                header("location: tcmApplication.php");
            }
        } else {
//            echo "HTTP_REFERRER NOT COMING FROM TCM APPLICATION - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
            exit();
            session_unset();
            session_destroy();
             header("location: tcmApplication.php");
        }
	} else {
//		echo "HTTP_REFERRER NOT SET - REDIRECT TO FORM HOMEPAGE - DO NOT PROCESS<br>";
//		exit;
        session_unset();
        session_destroy();
        header("location: tcmApplication.php");
	}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>GSNETX Troop Cookie Manager Registration Confirmation</title>
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
                            <li><a href="http://www.texascookietime.org" class="currentTab">HOME</a></li>
                            <li><a href="http://www.texascookietime.org/girl-scout-cookies.html">GIRL SCOUT COOKIES</a></li>
                            <li><a href="http://www.texascookietime.org/families.html">FAMILIES</a></li>
                            <li><a href="http://www.texascookietime.org/volunteers.html">VOLUNTEERS</a></li>
                            <li><a href="http://www.texascookietime.org/forms.html">FORMS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="span-24"><img src="img/hdr_TCMApplication.png" width="960" height="175" alt="" /></div>
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
            </div>
            <div class="container">
                <div id="footerWrapper">
                    <div id="copyRight">&copy; <?php auto_copyright();?> Girl Scouts of Northeast Texasz</div>s
                    <div id="socialMedia">
                        <a href="https://twitter.com/GSNETXcouncil" target="_blank"><img src="img/twitter_30_white.png" width="30" height="30" /></a>
                        <a href="https://www.facebook.com/GSNETX?ref=ts" target="_blank"><img src="img/facebook_30_white.png" width="30" height="30" /></a>
                        <a href="https://www.youtube.com/channel/UC4uxrvCdVYkGzLZdocf1aHQ" target="_blank"><img src="img/youtube_30_white.png" width="30" height="30" /></a>
                        <a href="http://instagram.com/gsnetxcouncil" target="_blank"><img src="img/instagram_30_white.png" width="30" height="30" /></a>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
	</body>
</html>