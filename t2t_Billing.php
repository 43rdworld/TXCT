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
//=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM 	==============================================================================
        if((returnPageName($_SERVER['HTTP_REFERER']) == 't2t.php') || (returnPageName($_SERVER['HTTP_REFERER']) == 't2t_Review.php')) {
            echo "<p>Referrer:".returnPageName($_SERVER['HTTP_REFERER'])."<br>";
            session_start();
            if(!ISSET($_SESSION['billingState'])) {
                $_SESSION['billingState'] = 'TX';
            }
            if(returnPageName($_SERVER['HTTP_REFERER']) == 't2t.php') {
                $referringPage = returnPageName($_SERVER['HTTP_REFERER']);
                echo "REF: ".$referringPage."<P>";
//=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	==============================================================================
                if (strtolower($_POST["submitDonation"]) == 'submitt2tdonation') {
                    $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE 		=
                    $ipAddress = getIPAddr();
                    if($_SERVER['COMPUTERNAME'] == 'RODBY') {
                        $connectionVar = 'GSNETX';
                    } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {

                    }
                    require("i_ODBC_Connection.php");												//=	CREATES ODBC DATA CONNECTION TO DATABASE
                    $ckSQL = "select id from GSNETX_Web_Events.dbo.tbl_wdlRegistrations where formSecret = '".$formSecret."'";
                    $result = odbc_exec($conn,$ckSQL);
                    $id = odbc_result($result,'id');
//                    echo "SQL: ".$ckSQL."<br>";
                    if ($id != 'a') {
//= SET VARIABLES FOR ALL COMMON FIELDS ==============================================================================================================
                        setVars('formSecret:str,donorFName:str,donorLName:str,donorAddress:str,donorAddress2:str,donorCity:str,donorState:str,donorZip:int,donorPhone:str,donorEmail:str,donorAmount:int',1,1,'Troop to Troop Billing','Common Fields');
                        if($_SESSION['ccCVV2'] == 0) {
                            $_SESSION['ccCVV2'] = '';
                        }
                    }
                } else {
                    header("location: t2t.php");
                }

            } else if(returnPageName($_SERVER['HTTP_REFERER']) == 't2t_Review.php') {
                $referringPage = returnPageName($_SERVER['HTTP_REFERER']);
                if($_SERVER['COMPUTERNAME'] == 'RODBY') {
                    $connectionVar = 'GSNETX';
                } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {

                }
                require("i_ODBC_Connection.php");
                $formSecret = $_SESSION['formSecret'];									//=	CREATES ODBC DATA CONNECTION TO DATABASE
            }
            if(ISSET($_SESSION['billingSame'])) {
                if($_SESSION['billingSame'] == 1) {
                    $billingSameChecked = 'checked="checked"';
                } else {
                    $billingSameChecked = '';
                }
            }
            if(ISSET($_SESSION['billingState'])) {
                $billingState = $_SESSION['billingState'];
            } else if($billingState == '') {
                $billingState = 'TX';
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
    <body onload="copyFormSecret('<?php echo $formSecret;?>');setCCType('<?php echo $_SESSION['ccType']?>');">
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
                                <div class="span-20" style="font-size:1.2em;text-align:center;">Online registration and raffle ticket sales for the 2014 Women of Distinction Luncheon has closed.<br><br>Additional tickets must be purchased in person on the day of the event at the Hilton Anatole Chantilly Ballroom.<br><br>Doors open at 11:30 am. Priority seating will not be available.<br><br>Raffle tickets may still be purchased in person on the day of the event.</div>
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
                                <div class="span-18"><?php echo createPageNav(2,'1. Registration:t2t;2. Billing:t2t_billing;3. Review:t2t_review;4. Confirm:t2t_confirm');?></div>
                                <div class="span-2 last"><p>&#32;</p></div>

                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-10 newSubSection"><img src="img/billingInformationHeader_Sm.png" width="250" height="20" alt="" style="margin-top:30px;" /></div>
                                <div class="span-10 newSubSection"></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 dividerSection">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 height10">&#32;</div>
                                 <!-- BEGIN BILLING INFORMATION ----------------------------------------------------------------------------------------------->
                                <div class="span-24 height10">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4"><p>&#32;</p></div>
                                <div class="span-1 textCenter"><input type="checkbox" id="billingSame" name="billingSame" value="1" <?php echo $billingSameChecked;?>></div>
                                <div class="span-14"><label for ="billingSame">My registration and billing information are the same.</label></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-24" style="height:10px;">&nbsp;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight inputTop"><label for="billingFName" id="billingFNameLabel"><span class="required">*</span>First Name:</label></div>
                                <div class="span-7 inputTop"><input type="text" name="billingFName" id="billingFName" class="form_Field150" value="<?php echo stripslashes(stripslashes($_SESSION['billingFName']));?>" tabindex="1" maxlength="20" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7"><div id="billingFNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingLName" id="billingLNameLabel"><span class="required">*</span>Last Name:</label></div>
                                <div class="span-7 input"><input type="text" name="billingLName" id="billingLName" class="form_Field150" value="<?php echo stripslashes(stripslashes($_SESSION['billingLName']));?>" tabindex="2" maxlength="20" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7"><div id="billingLNameError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingAddress" id="billingAddressLabel"><span class="required">*</span>Address:</label></div>
                                <div class="span-7 input"><input type="text" name="billingAddress" id="billingAddress" class="form_Field250" value="<?php echo stripslashes(stripslashes($_SESSION['billingAddress']));?>" tabindex="3" maxlength="50" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingAddressError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingAddress2" id="billingAddress2Label"></div>
                                <div class="span-7 input"><input type="text" name="billingAddress2" id="billingAddress2" class="form_Field250" value="<?php echo stripslashes(stripslashes($_SESSION['billingAddress2']));?>" tabindex="3" maxlength="50" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingAddress2Error" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingCity" id="billingCityLabel"><span class="required">*</span>City:</label></div>
                                <div class="span-7 input"><input type="text" name="billingCity" id="billingCity" class="form_Field150" value="<?php echo $_SESSION['billingCity'];?>" tabindex="4" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingCityError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingState" id="billingStateLabel"><span class="required">*</span>State:</label></div>
                                <div class="span-7 input"><?php echo getSelectList($conn,'billingState','billingState','sp_GetStatesList true, null','form_Select150','Select your State --','st_abbr,null,state,null','style="padding:3px 0;"',null,'st_abbr:'.$billingState,5,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingStateError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingZip" id="billingZipLabel"><span class="required">*</span>Zip/Postal Code:</label></div>
                                <div class="span-7 input"><input type="text" name="billingZip" id="billingZip" value="<?php echo $_SESSION['billingZip'];?>" class="form_Field50" tabindex="6" maxlength="5" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingZipError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingPhone" id="billingPhoneLabel"><span class="required">*</span>Phone:</label></div>
                                <div class="span-7 input"><input type="text" name="billingPhone" id="billingPhone" class="form_Field100" value="<?php echo $_SESSION['billingPhone']; ?>" tabindex="7" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingPhoneError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingEmail" id="billingEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                <div class="span-7 input"><input type="text" name="billingEmail" id="billingEmail" class="form_Field250" value="<?php echo $_SESSION['billingEmail']; ?>" tabindex="8" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="billingEmailError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-10 newSubSection"><img src="img/paymentInformationHeader_Sm.png" width="250" height="20" alt="" style="margin-top:30px;" /></div>
                                <div class="span-10 newSubSection"></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 dividerSection">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 height10">&#32;</div>
                                <!-- BEGIN CREDIT CARD INFORMATION -------------------------------------------------------------------------------------------->
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="ccNum" id="ccNumLabel"><span class="required">*</span>Card Number:</label></div>
                                <div class="span-7 input"><input type="text" name="ccNum" id="ccNum" class="form_Field150" value="<?php echo $_SESSION['ccNum'];?>" tabindex="10" placeholder="Numbers Only" /></div>
                                <div class="span-1 input">&#32;</div>
                                <div class="span-7" style="margin-top:2px;"><div id="ccNumError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 height5" style="clear:both;">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input">&#32;</div>
                                <div class="span-7 input" id="ccBox"></div>
                                <div class="span-1 input"></div>
                                <div class="span-7" style="margin-top:2px;"></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="ccExpMonth" id="expLabel"><span class="required">*</span>Expiration Date:</label></div>
                                <div class="span-2 input">
                                    <select name="ccExpMonth" id="ccExpMonth" class="form_Select70" tabindex="11">
                                        <option value="">Month -</option>
                                        <?php
                                        $num = 2;
                                        for ($i=1;$i<13;$i++) {
                                            if ($_SESSION['ccExpMonth'] == sprintf("%02s",$i)) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option value=\"".sprintf("%02s",$i)."\" ".$selected.">".$i."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="span-5 input">
                                    <!--suppress HtmlFormInputWithoutLabel -->
                                    <select name="ccExpYear" id="ccExpYear" class="form_Select70" tabindex="12">
                                        <option value="">Year -</option>
                                        <?php
                                        for ($i=date("Y");$i<(date("Y") + 15);$i++) {
                                            if ($_SESSION['ccExpYear'] == substr($i,-2)) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            echo "<option value=".substr($i,-2)." ".$selected.">".$i."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="ccDateError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="ccCVV2" id="ccCVV2"><span class="required">*</span>Security Code:</label></div>
                                <div class="span-7 input"><input type="text" name="ccCVV2" id="ccCVV2" class="form_Field50" value="<?php echo $_SESSION['ccCVV2'];?>" tabindex="13" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="ccCVV2Error" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#160;</div>
                                <div class="span-24"><br /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-12"><input name="submitBilling" type="submit" id="submitBilling" value="ggg" class="reviewRegistrationButton" title="Submit" tabindex="99"></div>
                                <div class="span-8 textRight"><img src="img/vcss-blue.gif" width="88" height="36" title="Valid CSS" alt="Valid CSS" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="36" title="HTML 5 Powered" alt="HTML 5 Powered" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tc-seal-blue.png" width="72" height="37" title="This site is protected by Trustwave's Trusted Commerce program" alt="This site is protected by Trustwave's Trusted Commerce program" style="cursor:pointer;" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=ssl.trustwave.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br><br><br><br><br><br></div>
                            </div>


                        <?php }?>
                    </div>
                </div>
                <!-- ############################################################################################################### -->
                <div style="clear:both;">
                    <br><br>
                    <input type="text" name="submitT2TBilling" id="submitT2TBilling" value="submitT2TBilling" tabindex="-1" />
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
                        <input type="text" name="donorAmount" id="donorAmount"  value="<?php echo $donorAmount;?>" placeholder="donorAmount" tabindex="-1" />
                        <input type="text" name="ccType" id="ccType"  value="<?php echo $ccType;?>" placeholder="ccType" tabindex="-1" />

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
                    <?php } ?>



                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>
    </body>


</html>
