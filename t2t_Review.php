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
    //= CHECK SUBMIT BUTTON STATUS
    //====================================================================================================================================================
    //= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	======================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        require("i_ODBC_Functions.php");
        require("includes/i_T2TSettings.php");
    //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE T2T BILLING FORM 	==============================================================================
        if(returnPageName($_SERVER['HTTP_REFERER']) == 't2t_Billing.php') {
    //       echo "<p>Referrer:".returnPageName($_SERVER['HTTP_REFERER'])."<br>";
            if(returnPageName($_SERVER['HTTP_REFERER']) == 't2t_Billing.php') {
                $referringPage = returnPageName($_SERVER['HTTP_REFERER']);
    //=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==============================================================================
                if (strtolower($_POST["submitT2TBilling"]) == 'submitt2tbilling') {
                    $formSecret=$_POST['formSecret'];							//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                    $ipAddress = getIPAddr();
                    if($_SERVER['COMPUTERNAME'] == 'RODBY') {
                        $connectionVar = 'GSNETX';
                    } else if ($_SERVER['COMPUTERNAME'] = 'V-WWW04-WEBER') {

                    }
                    require("i_ODBC_Connection.php");							//=	CREATES ODBC DATA CONNECTION TO DATABASE
                    $ckSQL = "select id from GSNETX_Web_Events.dbo.tbl_WDLRegistrations where formSecret = '".$formSecret."'";
                    echo $ckSQL."<br>";
                    $result = odbc_exec($writeConn,$ckSQL);
                    $id = odbc_result($result,'id');
                    if ($id != 'a') {
//= SET VARIABLES FOR ALL COMMON FIELDS ==============================================================================================================
                        session_start();
                        setVars('formSecret:str,donorFName:str,donorLName:str,donorAddress:str,donorAddress2:str,donorCity:str,donorState:str,donorZip:int,donorPhone:str,donorEmail:str,donorAmount:int,billingSame:bit,billingFName:str,billingLName:str,billingAddress:str,billingAddress2:str,billingCity:str,billingState:str,billingZip:int,billingPhone:str,billingEmail:str,ccType:str,ccNum:str,ccExpMonth:int,ccExpYear:int,ccCVV2:int',1,1,'Troop to Troop Billing','Common Fields');
                        if($_SESSION['ccCVV2'] == 0) {
                            $_SESSION['ccCVV2'] = '';
                        }
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
    } else {
        header("location: t2t.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Troop to Troop Online Donation Form</title>
    <meta charset="UTF-8">
    <link href="css/txct.css" rel="stylesheet" type="text/css" />
    <script src="//code.jquery.com/jquery-latest.min.js" ></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script src="js/vendors/jquery.maskedinput.js"></script>
    <script src="js/vendors/jquery.maskMoney.js"></script>
    <script src="js/vendors/modernizr.js"></script>
    <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
    <script src="js/i_T2TValidation.js" type="text/javascript"></script>
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
<!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
<form name="theForm" id="theForm" method="post" action="t2t_Review.php" autocomplete="off">
<div>
<!-- ## BEGIN PAGE 1 ############################################################################################################################# -->
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
        <div class="container showGrid">
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-18"><?php echo createPageNav(3,'1. Registration:t2t;2. Billing:t2t_billing;3. Review:t2t_review;4. Confirm:t2t_confirm');?></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 marginTop25">&#32;</div>
            <div class="span-24">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-10 newSection"><img src="img/eventDonationReview.png" width="400" height="21" alt="" style="margin-top:19px;" /></div>
            <div class="span-10 newSection"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24" style="clear:both;">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-20 dividerSection">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 marginTop10">&#32;</div>
            <div class="span-24" style="clear:both;">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label class="columnHead">Item Descripton</label></div>
            <div class="span-3 textCenter"><label class="columnHead">Quantity</label></div>
            <div class="span-4 textCenter"><label class="columnHead">Price&#160;&#160;&#160;&#160;</label></div>
            <div class="span-2 textRight"><label class="columnHead">Amount</label></div>
            <div class="span-5"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 marginTop5">&#32;</div>
            <div class="span-2 noPara"><p>&#32;</p></div>
            <div class="span-3 noPara"><p>&#32;</p></div>
            <div class="span-13 noPara"><div class="totalDivider">&#32;</div></div>
            <div class="span-4 noPara">&#32;</div>
            <div class="span-2 noPara last"><p>&#32;</p></div>
            <div class="span-24 marginTop5">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Cookie Donation:</div>
            <div class="span-3 textCenter marginTop1"><?php echo $donorAmount;?>&#160;&#160;</div>
            <div class="span-4 textCenter marginTop1">4.00&#160;&#160;</div>
            <div class="span-2 textRight marginTop1"><?php echo "$".number_format((4*$donorAmount),2);?></div>
            <div class="span-2">&#160;</div>
            <div class="span-3 textBold textGray">[&#32;<a href="t2t.php" class="editOrder inPageLink">Edit Order</a>&#32;]</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 marginTop15">&#32;</div>
            <div class="span-2 noPara"><p>&#32;</p></div>
            <div class="span-3 noPara"><p>&#32;</p></div>
            <div class="span-13 noPara"><div class="totalDivider">&#32;</div></div>
            <div class="span-4 noPara">&#32;</div>
            <div class="span-2 noPara last"><p>&#32;</p></div>
            <div class="span-24">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight marginTop5"><label class="columnHead">Total Due:</label></div>
            <div class="span-1"><p>&#32;</p></div>
            <div class="span-8 textRight marginTop5"><label class="columnHead"><?php echo "$".number_format((4*$donorAmount),2);?></label></div>
            <div class="span-5"><p>&#32;</p></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 marginTop25">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-20 headerSection"><img src="img/eventRegistrationReview.png" width="250" height="20" style="border:none;" alt="" /></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24">&#32;</div>
            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 height10">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Name:</label></div>
            <div class="span-6 inputTop marginTop1"><?php echo stripslashes(stripslashes($donorFName)).' '.stripslashes(stripslashes($donorLName));?> </div>
            <div class="span-5"><p>&#32;</p></div>
            <div class="span-3 textBold textGray">[&#32;<a href=t2t.php" class="editOrder inPageLink">Edit Registration</a>&#32;]</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 formFieldSpacer">&#160;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Address:</label></div>
            <div class="span-6 inputTop marginTop1">
                    <?php
                        echo stripslashes(stripslashes($donorAddress));
                        if(trim(strlen($donorAddress2))!= 0) {
                            echo "<br>".stripslashes(stripslashes($donorAddress2));
                        }
                        echo "<br />".stripslashes(stripslashes($donorCity)).'. '.$donorState.'&#160;&#160;'.$donorZip;
                    ?>
            </div>
            <div class="span-8"><p>&#32;</p></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 formFieldSpacer">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Phone:</label></div>
            <div class="span-6 inputTop marginTop1"><?php echo $donorPhone;?> </div>
            <div class="span-5"><p>&#32;</p></div>
            <div class="span-3">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24 formFieldSpacer">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Email Address:</label></div>
            <div class="span-6 inputTop marginTop1"><?php echo $donorEmail;?> </div>
            <div class="span-5"><p>&#32;</p></div>
            <div class="span-3">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>

            <div class="span-24 marginTop25">&#32;</div>
            <div class="span-24">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-10 newSection"><img src="img/billingInformationReview.png" width="250" height="20" alt="" style="margin-top:19px;" /></div>
            <div class="span-10 newSection"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24" style="clear:both;">&#32;</div>



            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
            <div class="span-24 marginTop10">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Cardholder:</label></div>
            <div class="span-6">
                <div class="marginLeft10">
                    <?php echo
                        stripslashes($billingFName).' '.stripslashes($billingLName)."<br>".
                        stripslashes($billingAddress)."<br>".
                        stripslashes($billingCity).", ".strtoupper($billingState)."&#32;&#32;".$billingZip."<br>".
                        $billingPhone."<br>".
                        $billingEmail;
                    ?>
                </div>
            </div>
            <div class="span-5"><p>&#32;</p></div>
            <div class="span-3 textBold textGray">[&#32;<a href="t2t_Billing.php" class="editOrder inPageLink">Edit Billing</a>&#32;]</div>
            <div class="span-2 last">&#32;</div>
            <div class="span-24 marginTop5">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-4"><p>&#32;</p></div>
            <div class="span-8 dividerSectionSm">&#32;</div>
            <div class="span-2"><div>&#32;</div></div>
            <div class="span-6"><div>&#32;</div></div>
            <div class="span-2"><div>&#32;</div></div>
            <div class="span-2 last"><div>&#32;</div></div>
            <div class="span-24"><div>&#32;</div></div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Card Type:</label></div>
            <div class="span-6 marginLeft10"><?php echo getCCType($ccNum);?></div>
            <div class="span-1">&#32;</div>
            <div class="span-7">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Card Number:</label></div>
            <div class="span-6 marginLeft10"><?php echo maskCreditCard($ccNum);?></div>
            <div class="span-1">&#32;</div>
            <div class="span-7"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24" style="clear:both;">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Expiration Date:</label></div>
            <div class="span-6 marginLeft10"><?php echo $ccExpMonth.'/20'.$ccExpYear;?></div>
            <div class="span-1"><p>&#32;</p></div>
            <div class="span-7"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24" style="clear:both;">&#32;</div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-6 textRight review"><label>Security Code:</label></div>
            <div class="span-6 marginLeft10"><?php echo $ccCVV2;?></div>
            <div class="span-1"><p>&#32;</p></div>
            <div class="span-7" style="margin-top:2px;"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24" style="clear:both;">&#160;</div>
            <div class="span-24"><br /></div>
            <div class="span-2"><p>&#32;</p></div>
            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24"><p>&#32;</p></div>
            <div class="span-3"><p>&#32;</p></div>
            <div class="span-15"><input name="submit" type="submit" id="submit" value="ggg" class="checkoutButton" title="Submit" tabindex="99"></div>
            <div class="span-4 textRight"><img src="img/vcss-blue.gif" width="88" height="31" border="0" title="Valid CSS" alt="Valid CSS">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="35" border="0" title="HTML 5 Powered" alt="HTML 5 Powered"></div>
            <div class="span-2 last"><p>&#32;</p></div>
            <div class="span-24"><br><br><br><br><br><br><br></div>











            <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br><br><br><br><br><br></div>
        </div>


    <?php }?>
</div>
</div>
<!-- ############################################################################################################### -->
<div style="clear:both;">
    <br><br>
    <input type="text" name="submitDonation" id="submitDonation" value="submitT2TDonation" tabindex="-1" />
    <input type="text" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
    <input type="text" name="formType" id="formType" value="troop2troop" tabindex="-1" placeholder="Form Type" />

    <?php if($referringPage == 't2t.php') {?>
        <input type="text" name="donorFName" id="donorFName"  value="<?php echo stripslashes(stripslashes($donorFName));?>" placeholder="donorFName" tabindex="-1" />
        <input type="text" name="donorLName" id="donorLName"  value="<?php echo stripslashes(stripslashes($donorLName));?>" placeholder="donorLName" tabindex="-1" />
        <input type="text" name="donorAddress" id="donorAddress"  value="<?php echo stripslashes(stripslashes($donorAddress));?>" placeholder="donorAddress" tabindex="-1" />
        <input type="text" name="donorAddress2" id="donorAddress2"  value="<?php echo stripslashes(stripslashes($donorAddress2));?>" placeholder="donorAddress2" tabindex="-1" />
        <input type="text" name="donorCity" id="donorCity"  value="<?php echo stripslashes(stripslashes($donorCity));?>" placeholder="donorCity" tabindex="-1" />
        <input type="text" name="donorState" id="donorState"  value="<?php echo $donorState;?>" placeholder="donorState" tabindex="-1" />
        <input type="text" name="donorZip" id="donorZip"  value="<?php echo $donorZip;?>" placeholder="donorZip" tabindex="-1" />
        <input type="text" name="donorPhone" id="donorPhone"  value="<?php echo $donorPhone;?>" placeholder="donorPhone" tabindex="-1" />
        <input type="text" name="donorEmail" id="donorEmail"  value="<?php echo $donorEmail;?>" placeholder="donorEmail" tabindex="-1" />

    <?php } else if ($referringPage == 't2t_Review.php') {?>
        <input type="hidden" name="formSecret" id="formSecret"  value="<?php echo $_SESSION['formSecret'];?>" placeholder="formSecret" tabindex="-1" />
        <input type="hidden" name="selectEvent" id="selectEvent"  value="<?php echo $_SESSION['selectEvent'];?>" placeholder="selectEvent" tabindex="-1" />
        <input type="hidden" name="tktTickets" id="tktTickets"  value="<?php echo $_SESSION['tktTickets'];?>" placeholder="tktTickets" tabindex="-1" />
        <input type="hidden" name="tblNumTables" id="tblNumTables"  value="<?php echo $_SESSION['tblNumTables'];?>" placeholder="tblNumTables" tabindex="-1" />
        <input type="hidden" name="tblMoreTables" id="tblMoreTables"  value="<?php echo $_SESSION['tblMoreTables'];?>" placeholder="tblMoreTables" tabindex="-1" />
        <input type="hidden" name="donateAmt" id="donateAmt"  value="<?php echo $_SESSION['donateAmt'];?>" placeholder="donateAmt" tabindex="-1" />
        <input type="hidden" name="donateAck" id="donateAck"  value="<?php echo stripslashes(stripslashes($_SESSION['donateAck']));?>" placeholder="donateAck" tabindex="-1" />
        <input type="hidden" name="donateAnon" id="donateAnon"  value="<?php echo $_SESSION['donateAnon'];?>" placeholder="donateAnon" tabindex="-1" />
        <input type="hidden" name="conTitle" id="conTitle"  value="<?php echo stripslashes(stripslashes($_SESSION['conTitle']));?>" placeholder="conTitle" tabindex="-1" />
        <input type="hidden" name="conFName" id="conFName"  value="<?php echo stripslashes(stripslashes($_SESSION['conFName']));?>" placeholder="conFName" tabindex="-1" />
        <input type="hidden" name="conLName" id="conLName"  value="<?php echo stripslashes(stripslashes($_SESSION['conLName']));?>" placeholder="conLName" tabindex="-1" />
        <input type="hidden" name="conCompany" id="conCompany"  value="<?php echo stripslashes(stripslashes($_SESSION['conCompany']));?>" placeholder="conCompany" tabindex="-1" />
        <input type="hidden" name="conPosition" id="conPosition"  value="<?php echo stripslashes(stripslashes( $_SESSION['conPosition']));?>" placeholder="conPosition" tabindex="-1" />
        <input type="hidden" name="conAddress" id="conAddress"  value="<?php echo stripslashes(stripslashes($_SESSION['conAddress']));?>" placeholder="conAddress" tabindex="-1" />
        <input type="hidden" name="conCity" id="conCity"  value="<?php echo stripslashes(stripslashes($_SESSION['conCity']));?>" placeholder="conCity" tabindex="-1" />
        <input type="hidden" name="conState" id="conState"  value="<?php echo $_SESSION['conState'];?>" placeholder="conState" tabindex="-1" />
        <input type="hidden" name="conZip" id="conZip"  value="<?php echo $_SESSION['conZip'];?>" placeholder="conZip" tabindex="-1" />
        <input type="hidden" name="conPhone" id="conPhone"  value="<?php echo $_SESSION['conPhone'];?>" placeholder="conPhone" tabindex="-1" />
        <input type="hidden" name="conFax" id="conFax"  value="<?php echo $_SESSION['conFax'];?>" placeholder="conFax" tabindex="-1" />
        <input type="hidden" name="conEmail" id="conEmail"  value="<?php echo $_SESSION['conEmail'];?>" placeholder="conEmail" tabindex="-1" />
        <input type="hidden" name="sponsorLevel" id="sponsorLevel"  value="<?php echo $_SESSION['sponsorLevel'];?>" placeholder="sponsorLevel" tabindex="-1" />
        <input type="hidden" name="raffleTickets" id="raffleTickets"  value="<?php echo $_SESSION['raffleTickets'];?>" placeholder="raffleTickets" tabindex="-1" />
        <input type="hidden" name="tribute1" id="tribute1"  value="<?php echo $_SESSION['tribute1'];?>" placeholder="tribute1" tabindex="-1" />
        <input type="hidden" name="tribute2" id="tribute2"  value="<?php echo $_SESSION['tribute2'];?>" placeholder="tribute2" tabindex="-1" />
        <input type="hidden" name="tribute3" id="tribute3"  value="<?php echo $_SESSION['tribute3'];?>" placeholder="tribute3" tabindex="-1" />
        <input type="hidden" name="tribute4" id="tribute4"  value="<?php echo $_SESSION['tribute4'];?>" placeholder="tribute4" tabindex="-1" />
        <input type="hidden" name="ccType" id="ccType" value="<?php echo $_SESSION['ccType'];?>" placeholder="ccType" tabindex="-1" />
        <input type="hidden" name="ccType" id="ccType" value="<?php echo $_SESSION['ccType'];?>" placeholder = " ccType" tabindex="-1" />
    <?php } ?>



    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
</div>
</form>
</div>
</body>


</html>
