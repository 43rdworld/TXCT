<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    $dbh = '';
    $formSecret='';
    //= CHECK SUBMIT BUTTON STATUS
    //=====================================================================================================================================================
    //= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	=======================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        //echo "HERE<br>";
        require("i_PDOFunctions.php");
        //require("includes/i_errorLogging.php");\
        //set_error_handler('userErrorHandler');
        setRegistrationParams('10/01/2015','03/11/2016');
        //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM 	==========================================================================
        if((returnPageName(strtolower($_SERVER['HTTP_REFERER'])) == 't2t.php') || (returnPageName(strtolower($_SERVER['HTTP_REFERER'])) == 't2t_review.php') || (returnPageName(strtolower($_SERVER['HTTP_REFERER'])) == 't2t_confirm.php')) {
            //echo "<p>Referrer:".returnPageName($_SERVER['HTTP_REFERER'])."<br>";
            session_start();

            if(returnPageName($_SERVER['HTTP_REFERER']) == 't2t.php') {
                //echo "FROM T2T<br>";
                $referringPage = returnPageName($_SERVER['HTTP_REFERER']);
                 //echo "REF: ".$referringPage."<P>";
                //=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	===================================================================
                if (strtolower($_POST["submitDonation"]) == 'submitt2tdonation') {
                    $formSecret=$_POST['formSecret'];												//= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE 		=
                    $ipAddress = getIPAddr();
                    $connectionVar = 'GSNETX2014';
                    require("i_PDOConnection.php");												//=	CREATES ODBC DATA CONNECTION TO DATABASE
                    //= SET VARIABLES FOR ALL COMMON FIELDS ===========================================================================================
                    setVars('formSecret:str,t2tFName:str,t2tLName:str,t2tAddress:str,t2tAddress2:str,t2tCity:str,t2tState:str,t2tZip:str,t2tPhone:str,t2tEmail:str,t2tAmount:int,t2tRefer:str,t2tReferringTroop:str,t2tReferringName:str', 1, 0, 'Troop To Troop Billing', 'Common Fields');
                    if ($_SESSION['ccCVV2'] == 0) {
                        $_SESSION['ccCVV2'] = '';
                    }
                } else {
                    header("location: t2t.php");
                }
            } else if((returnPageName(strtolower($_SERVER['HTTP_REFERER'])) == 't2t_review.php') || (returnPageName(strtolower($_SERVER['HTTP_REFERER'])) == 't2t_confirm.php')){
                //echo "FROM REVIEW<br>";
                $referringPage = returnPageName(strtolower($_SERVER['HTTP_REFERER']));
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");
                $key = returnEncryptionKey($dbh, 'EXEC sp_GetDataPoint :tableName, :field, :id', 'tbl_Randoms', 'id', rand(1,20000));
                //echo "KEY: ".$key."<br>";
                $formSecret = $_SESSION['formSecret'];
                if(ISSET($_SESSION['billingSame'])) {
                    if($_SESSION['billingSame'] == 1) {
                    $billingSameChecked = 'checked';
                    } else {
                        $billingSameChecked = '';
                    }
                }
                //echo "RANDOM: ".$_SESSION["rand"]."<br>";
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
        <script src="js/vendors/modernizr.js"></script>
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>')">
        <div>
            <?php include('i_cookieHeader.php');?>
        <!-- ## BEGIN FORM MAIN BODY ###################################################################################################################################### -->
            <form name="theBillingForm" id="theBillingForm" method="post" action="t2t_Review.php" autocomplete="off">
                <div>
                <!-- ## NO JAVASCRIPT ##################################################################################################################################### -->
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
                <!-- ## HAS JAVASCRIPT #################################################################################################################################### -->
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
                            <div class="container showWhite">
                                <div class="span-4"><p>&#32;</p></div>
                                <div class="span-18"><?php echo createPageNav(2,'1. Registration:t2t;2. Billing:t2t_Billing;3. Review:t2t_Review;4. Confirm:t2t_Confirm');?></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 marginTop40">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p style="">&#32;</p></div>
                                <div class="span-20 newTopSection" style="height:20px;"><img src="img/header_BillingInformation.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last" style="margin-bottom:0;"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;">&#32;</div>
                                <div class="span-20 dividerSection">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <!-- BEGIN BILLING INFORMATION ----------------------------------------------------------------------------------------------->
                                <div class="span-24">&#32;</div>



                                <div class="span-24 height5">&#160;</div>
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
                                <div class="span-7 input"><?php echo getSelectList($dbh,'billingState','billingState','sp_GetStates_List true, null','form_Select150','Select your State --','st_abbr,null,state,null','style="padding:3px 0;"',null,'st_abbr:'.$_SESSION['billingState'],5,null,null,null,null,null,null,null,null)?></div>
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
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p style="">&#32;</p></div>
                                <div class="span-20 newSection" style="height:19px;"><img src="img/header_PaymentInformation.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last" style="margin-bottom:0;"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;">&#32;</div>
                                <div class="span-20 dividerSection">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-24 height10">&#32;</div>
                                <!-- BEGIN CREDIT CARD INFORMATION -------------------------------------------------------------------------------------------->
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="ccNum" id="ccNumLabel"><span class="required">*</span>Card Number:</label></div>
                                <div class="span-7 input"><input type="text" name="ccNum" id="ccNum" class="form_Field150" value="" tabindex="10" placeholder="Numbers Only" /></div>
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
                                            //if ($_SESSION['ccExpMonth'] == sprintf("%02s",$i)) {
                                            //    $selected = 'selected';
                                            //} else {
                                            //    $selected = '';
                                            //}
                                            echo "<option value=\"".sprintf("%02s",$i)."\">".$i."</option>";
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
                                            //if ($_SESSION['ccExpYear'] == substr($i,-2)) {
                                            //    $selected = 'selected';
                                            //} else {
                                            //    $selected = '';
                                            //}
                                            echo "<option value=".substr($i,-2).">".$i."</option>";
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
                                <div class="span-7 input"><input type="text" name="ccCVV2" id="ccCVV2" class="form_Field50" value="" tabindex="13" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-7" style="margin-top:2px;"><div id="ccCVV2Error" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#160;</div>


                            </div>
                            <div class="container showWhite">
                                <div class="span-24"><p>&nbsp;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-12"><input name="submitBilling" type="submit" id="submitBilling" value="Review Donation" class="button_ReviewDonationInformation marginTop5" title="Review Donation" tabindex="99" style=margin-top:17px;"></div>
                                <div class="span-8 textRight paddingTop5">
                                    <?php include('i_securityVendors.php');?>
                                </div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24"><br><br></div>
                            </div>
                        <?php }?>
                    </div>
                    <?php include('i_cookieFooter.php');?>
                </div>
                <!-- ############################################################################################################### -->
                <div>
                    <br><br>
                    <input type="hidden" name="submitT2TBilling" id="submitT2TBilling" value="submitT2TBilling" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="troop2troop" tabindex="-1" placeholder="Form Type" />
                    <?php if($referringPage == 't2t.php') {?>
                        <input type="hidden" name="t2tFName" id="t2tFName"  value="<?php echo stripslashes(stripslashes($t2tFName));?>" placeholder="t2tFName" tabindex="-1" />
                        <input type="hidden" name="t2tLName" id="t2tLName"  value="<?php echo stripslashes(stripslashes($t2tLName));?>" placeholder="t2tLName" tabindex="-1" />
                        <input type="hidden" name="t2tAddress" id="t2tAddress"  value="<?php echo stripslashes(stripslashes($t2tAddress));?>" placeholder="t2tAddress" tabindex="-1" />
                        <input type="hidden" name="t2tAddress2" id="t2tAddress2"  value="<?php echo stripslashes(stripslashes($t2tAddress2));?>" placeholder="t2tAddress2" tabindex="-1" />
                        <input type="hidden" name="t2tCity" id="t2tCity"  value="<?php echo stripslashes(stripslashes($t2tCity));?>" placeholder="t2tCity" tabindex="-1" />
                        <input type="hidden" name="t2tState" id="t2tState"  value="<?php echo $t2tState;?>" placeholder="t2tState" tabindex="-1" />
                        <input type="hidden" name="t2tZip" id="t2tZip"  value="<?php echo $t2tZip;?>" placeholder="t2tZip" tabindex="-1" />
                        <input type="hidden" name="t2tPhone" id="t2tPhone"  value="<?php echo $t2tPhone;?>" placeholder="t2tPhone" tabindex="-1" />
                        <input type="hidden" name="t2tEmail" id="t2tEmail"  value="<?php echo $t2tEmail;?>" placeholder="t2tEmail" tabindex="-1" />
                        <input type="hidden" name="t2tAmount" id="t2tAmount"  value="<?php echo $t2tAmount;?>" placeholder="t2tAmount" tabindex="-1" />
                        <input type="hidden" name="t2tRefer" id="t2tRefer"  value="<?php echo $t2tRefer;?>" placeholder="t2tRefer" tabindex="-1" />
                        <input type="hidden" name="t2tReferringTroop" id="t2tReferringTroop"  value="<?php echo $t2tReferringTroop;?>" placeholder="t2tReferringTroop" tabindex="-1" />
                        <input type="hidden" name="t2tReferringName" id="t2tReferringName"  value="<?php echo $t2tReferringName;?>" placeholder="t2tReferringName" tabindex="-1" />
                        <input type="hidden" name="ccType" id="ccType"  value="" placeholder="ccType" tabindex="-1" />
                        <input type="hidden" name="rand" id="rand"  value="<?php echo rand(1,20000);?>" placeholder="Random Number" tabindex="-1" />
                    <?php } else if (($referringPage == 't2t_review.php') || ($referringPage == 't2t_confirm.php')) {?>
                        <h2>From Review Page</h2>
                        <input type="hidden" name="formSecret" id="formSecret"  value="<?php echo $_SESSION['formSecret'];?>" placeholder="formSecret" tabindex="-1" />
                        <input type="hidden" name="t2tFName" id="t2tFName"  value="<?php echo stripslashes(stripslashes($_SESSION['t2tFName']));?>" placeholder="t2tFName" tabindex="-1" />
                        <input type="hidden" name="t2tLName" id="t2tLName"  value="<?php echo stripslashes(stripslashes($_SESSION['t2tLName']));?>" placeholder="t2tLName" tabindex="-1" />
                        <input type="hidden" name="t2tAddress" id="t2tAddress"  value="<?php echo stripslashes(stripslashes($_SESSION['t2tAddress']));?>" placeholder="t2tAddress" tabindex="-1" />
                        <input type="hidden" name="t2tAddress2" id="t2tAddress2"  value="<?php echo stripslashes(stripslashes($_SESSION['t2tAddress2']));?>" placeholder="t2tAddress2" tabindex="-1" />
                        <input type="hidden" name="t2tCity" id="t2tCity"  value="<?php echo stripslashes(stripslashes($_SESSION['t2tCity']));?>" placeholder="t2tCity" tabindex="-1" />
                        <input type="hidden" name="t2tState" id="t2tState"  value="<?php echo $_SESSION['t2tState'];?>" placeholder="t2tState" tabindex="-1" />
                        <input type="hidden" name="t2tZip" id="t2tZip"  value="<?php echo $_SESSION['t2tZip'];?>" placeholder="t2tZip" tabindex="-1" />
                        <input type="hidden" name="t2tPhone" id="t2tPhone"  value="<?php echo $_SESSION['t2tPhone'];?>" placeholder="t2tPhone" tabindex="-1" />
                        <input type="hidden" name="t2tEmail" id="t2tEmail"  value="<?php echo $_SESSION['t2tEmail'];?>" placeholder="t2tEmail" tabindex="-1" />
                        <input type="hidden" name="t2tAmount" id="t2tAmount"  value="<?php echo $_SESSION['t2tAmount'];?>" placeholder="t2tAmount" tabindex="-1" />
                        <input type="hidden" name="t2tRefer" id="t2tRefer"  value="<?php echo $_SESSION['t2tRefer'];?>" placeholder="t2tRefer" tabindex="-1" />
                        <input type="hidden" name="t2tReferringTroop" id="t2tReferringTroop"  value="<?php echo $_SESSION['t2tReferringTroop'];?>" placeholder="t2tReferringTroop" tabindex="-1" />
                        <input type="hidden" name="t2tReferringName" id="t2tReferringName"  value="<?php echo $_SESSION['t2tReferringName'];?>" placeholder="t2tReferringName" tabindex="-1" />
                        <input type="hidden" name="ccType" id="ccType" value="" placeholder="ccType" tabindex="-1" />
                        <input type="hidden" name="rand" id="rand"  value="<?php echo $_SESSION['rand'];?>" placeholder="Random Number" tabindex="-1" />
                    <?php } ?>
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>
        <script src="//code.jquery.com/jquery-latest.min.js" ></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/vendors/jquery.maskMoney.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_TCTValidation.js" type="text/javascript"></script>
    </body>


</html>
