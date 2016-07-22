<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    $dbh = '';
    $connectionVar = 'GSNETX2014';
    require("i_PDOConnection.php");								//=	CREATES DATA CONNECTION TO DATABASE
    require("i_PDOFunctions.php");								//= LOAD FORM FUNCTIONS
    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION
    setRegistrationParams('10/01/2015','10/1/16');
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
        <link href="css/tooltipster.css" rel="stylesheet" type="text/css" />
        <script src="js/vendors/modernizr.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>

    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
    <div id="top">
        <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="cookieRallyOrderConfirmation.php" autocomplete="off">
                <div>
                    <!-- ## BEGIN PAGE 1 ############################################################################################### -->
                    <div class="no_js">
                        <div class="container showWhite" style="position:relative;">
                            <div class="span-24" style="height:100px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 noscriptNotice" style="text-align:center;"><a href="http://enable-javascript.com/" target="_blank"><img src="img/javascriptDisabled.png" width="500" height="100" alt="How to enable javascript on your browser" /></a></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:500px;">&nbsp;</div>
                            <div class="span-24" style="border-bottom:1px solid #ccc;"><br></div>
                        </div>
                    </div>
                    <div class="has_js">
                        <?php if( today<launchDate) {?>
                            <div class="container showWhite" style="position:relative;">
                                <div class="span-24">&#160;</div>
                                <div class="span-24"><p>&nbsp;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Sorry -- not ready for prime time yet.  Just be patient a little longer while we finish this up.<br><br>The TCM TShirt Order form will be available soon.<br><br><br></div>
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
                                <div class="span-24" style="margin-bottom:250px;border-bottom:1px solid #fff;"></div>
                            </div>
                        <?php } else if (today >endDate) {?>
                            <div class="container showWhite" style="position:relative;">
                                <div class="span-24">&#160;</div>
                                <div class="span-24"><p>&nbsp;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online ordering for Cookie Rally Packages has closed.<br><br>Good luck as we celebrate our Cookie-tennial with the 100th anniversary of the Trefoil.<br><br></br><br></div>
                                <!--<div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Our apologies - we are experiencing technical difficulties with the Parent Permission form.<br><br>Thank you for your patience as we work to get functionality restored.<br><br><br></div>-->
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
                                <div class="span-24" style="margin-bottom:200px;"></div>
                            </div>
                        <?php } else { ?>
                            <div class="container showWhite">
                                <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 rallyPatchImage">
                                    <h1>Cookie Rally Package Order Form</h1>
                                    <div>
                                        <div class="rallyIntroLg" style="margin-top:21px !important;width:510px;">Cookie Rallies are a great way to get your Girl Scouts excited about the upcoming cookie season. Increase sales and girl participation while helping your girls accomplish their troop goals, have new adventures and introduce them to key skills to help set them up for success.</div>
                                        <div class="rallyIntroLg" style="color:#909;font-weight:bold;">Order before September 30 and get 50% off the regular price and a copy of Trefoil Tips! </div>
                                        <div class="rallyIntroLg">Orders will be available for pick up between November 4<sup class="rallyOrdinal">th</sup> and 19<sup class="rallyOrdinal">th</sup>.</div>
                                        <div class="eventIntroRequired">Questions with a red asterisk (*) are required.</div>
                                    </div>
                                </div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="height:10px;">&nbsp;</div>

                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_RallyPlaceOrder.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 height5">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="rallyDate"><span class="required">*</span>Rally Date: </label></div>
                                <div class="span-5 inputTop"><input type="text" id="rallyDate" name="rallyDate" class="form_Field100" tabindex="1" autocomplete="off" /></div>
                                <div class="span-4 textRight input"><label for="rallyCount"><span class="required">*</span># of Girls Expected: </label></div>
                                <div class="span-6 input"><input type="text" id="rallyCount" name="rallyCount" class="form_Field50 key-numeric" tabindex="2" maxlength="3" autocomplete="off" value="" /></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-24 formFieldSpacer height5">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-24 formFieldSpacer height15">&#32;</div>
                                <div class="span-3"><p>&#32;</p></div>
                                <div class="span-18">
                                    <div class="rallyOrderFormIntro">Cookie quantities limited to a maximum of 4 boxes per 25 girls.</div>
                                    <table cellpadding="0" cellspacing="0" class="rallyOrderTable">
                                        <tr>
                                            <th>ITEM</th>
                                            <th>AMOUNT</th>
                                            <th></th>
                                            <th>TOTAL</th>
                                        </tr>
                                        <tr>
                                            <td><label for="rallyCookies">Trefoils</label></td>
                                            <td><input type="text" id="rallyCookies" name="rallyCookies" class="form_Field35 key-numeric rally1" maxlength="4" value="" autocomplete="off"></td>
                                            <td>X 2.00 per package</td>
                                            <td id="rallyCookieCountText">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td><label for="rallyPatches">Patches</label></td>
                                            <td><input type="text" id="rallyPatches" name="rallyPatches" class="form_Field35 key-numeric rally2" maxlength="4" value="" autocomplete="off"></td>
                                            <td>X .50 per patch</td>
                                            <td id="rallyPatchCountText">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><div class="rallyTotalDivider">&#32;</div></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1.2em;font-weight:bold;">Sub-Total</td>
                                            <td colspan="2"><div id="rallyOrderSubTotalText" class="textLeft marginLeft10" style="font-size:1.2em;font-weight:bold;">$0.00</div></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1.2em;font-weight:bold;">Tax</td>
                                            <td colspan="2"><div id="rallyOrderTaxText" class="textLeft marginLeft10" style="font-size:1.2em;font-weight:bold;">$0.00</div></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:1.2em;font-weight:bold;">Grand Total</td>
                                            <td colspan="2"><div id="rallyOrderGrandTotalText" class="textLeft marginLeft10" style="font-size:1.2em;font-weight:bold;">$0.00</div></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="rallyOrderTableSpacer"><img src="img/spacer.png" width="100" height="1" border="0" alt=""></td>
                                            <td class="rallyOrderTableSpacer"><img src="img/spacer.png" width="60" height="1" border="0" alt=""></td>
                                            <td class="rallyOrderTableSpacer"><img src="img/spacer.png" width="200" height="1" border="0" alt=""></td>
                                            <td class="rallyOrderTableSpacer"><img src="img/spacer.png" width="80" height="1" border="0" alt=""></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="span-3 last"><div>&#32;</div></div>
                                <div class="span-24">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="margin-top:15px !important;;height:21px;"><img src="img/hdr_CookieRally_ContactInfo.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 height5">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntro" style="font-size:1.2em;">Select a pick up location and let us know who you are so we can contact you when your order is ready for pick up.<br>Orders will be available for pick up between November 4<sup class="rallyOrdinal">th</sup> and 19<sup class="rallyOrdinal">th</sup>.</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer height15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="rallyPickup"><span class="required">*</span>Pick Up Location: </label></div>
                                <div class="span-9 inputTop"><?php echo getSelectList($dbh,'rallyPickup','rallyPickup','JAF||JoAnn Fogg Shop,CSC||Collin Area Service Center and Shop,DSC||Denton Area Service Center and Shop,ETRC||East Texas Regional Service Center and Shop,GASC||Grayson Area Service Center and Shop,HVSC||Highland Village Service Center and Shop,PSC||Paris Regional Service Center and Shop,SSSC||Southern Sector Service Center and Shop','form_Select300','Select a Service Center for Order Pick Up --','null,null,null,null',null,null,null,3,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-7" id="shopInfo"></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 height5">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-24 formFieldSpacer height15">&#32;</div>


                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="rallyFName"><span class="required">*</span>First Name: </label></div>
                                <div class="span-6 inputTop"><input type="text" id="rallyFName" name="rallyFName" class="form_Field150" tabindex="10" autocomplete="off" /></div>
                                <div class="span-3 textRight input"><label for="rallyLName"><span class="required">*</span>Last Name: </label></div>
                                <div class="span-6 input"><input type="text" id="rallyLName" name="rallyLName" class="form_Field150" tabindex="11" autocomplete="off" /></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="rallyEmail"><span class="required">*</span>Email: </label></div>
                                <div class="span-6 inputTop"><input type="text" id="rallyEmail" name="rallyEmail" class="form_Field200" tabindex="12" autocomplete="off" /></div>
                                <div class="span-3 textRight input"><label for="rallyEmail2"><span class="required">*</span>Confirm Email: </label></div>
                                <div class="span-6 input"><input type="text" id="rallyEmail2" name="rallyEmail2" class="form_Field200" tabindex="13" autocomplete="off" /></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="rallyPhone"><span class="required">*</span>Phone: </label></div>
                                <div class="span-6 inputTop"><input type="text" id="rallyPhone" name="rallyPhone" class="form_Field10" tabindex="14" autocomplete="off" /></div>
                                <div class="span-3 textRight input">&#32;</div>
                                <div class="span-6 input">&#32;</div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START TSHIRT PURCHASE BLOCK ======================================================================================================== -->








                                <div class="span-24 formFieldSpacer" id="paymentSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_PaymentInformation.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <!--<!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight"><input type="checkbox" id="billingSame" name="billingSame" value="1" <?php echo $billingSameChecked;?> tabindex="20"></div>
                                <div class="span-16"><label for ="billingSame">My contact and billing information are the same.</label></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 height5"><p>&nbsp;</p></div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                <div class="span-24 height10"><p>&nbsp;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight inputTop"><label for="billingFName"><span class="required">*</span>First Name: </label></div>
                                <div class="span-6 inputTop"><input type="text" id="billingFName" name="billingFName" class="form_Field150" tabindex="21" autocomplete="off" /></div>
                                <div class="span-3 textRight input"><label for="billingLName"><span class="required">*</span>Last Name: </label></div>
                                <div class="span-6 input"><input type="text" id="billingLName" name="billingLName" class="form_Field150" tabindex="22" autocomplete="off" /></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight input"><label for="billingAddress"><span class="required">*</span>Address: </label></div>
                                <div class="span-6 input"><input type="text" id="billingAddress" name="billingAddress" class="form_Field200" tabindex="23" autocomplete="off" /></div>
                                <div class="span-3 textRight input"><label for="billingCity"><span class="required">*</span>City: </label></div>
                                <div class="span-6 input"><input type="text" id="billingCity" name="billingCity" class="form_Field200" tabindex="24" autocomplete="off" /></div>
                                <div class="span-4 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight input"><label for="billingState" id="billingStateLabel"><span class="required">*</span>State:</label></div>
                                <div class="span-6 input"><?php echo getSelectList($dbh,'billingState','billingState','sp_GetStates_List true, null','form_Select100','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',25,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-3 textRight input"><label for="billingZip"><span class="required">*</span>Zip Code: </label></div>
                                <div class="span-6 input"><input type="text" id="billingZip" name="billingZip" class="form_Field50" tabindex="26" autocomplete="off" /></div>
                                <div class="span-4 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-4 textRight input"><label for="billingEmail" id="billingEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                <div class="span-15 input"><input type="text" name="billingEmail" id="billingEmail" class="form_Field200" value="" tabindex="27" autocomplete="off" /></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-24 marginTop20">&#32;</div>
                                <!-- BEGIN CREDIT CARD INFORMATION *********************************************************************************** -->
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 cookieOrderPaymentWrapper">
                                    <div class="span-20 height20" style="clear:both;">&#32;</div>
                                    <div class="span-9 cookeOrderPaymentSubhead">
                                        <div style="margin-left:55px;">
                                            Secure Credit Card Payment
                                            <div class="cookiePaymentSubheadSecurity">This is a secure, 256-bit TLS encrypted payment</div>
                                        </div>
                                    </div>
                                    <div class="span-11 last"><img src="img/th_TrustwaveLogo.png" width="71" height="36" alt=""></div>
                                    <div class="span-20 height25" style="clear:both;">&#32;</div>
                                    <div class="span-4 textRight input"><label for="ccNum" id="ccNumLabel"><span class="required">*</span>Card Number:</label></div>
                                    <div class="span-5 input"><input type="text" name="ccNum" id="ccNum" class="form_Field150 key-numeric" value="" tabindex="31" placeholder="Numbers Only" maxlength="16" /></div>
                                    <div class="span-4 textRight input"><label for="ccCVV2" id="ccCVV2"><span class="required">*</span>Security Code:</label></div>
                                    <div class="span-2 input"><input type="text" name="ccCVV2" id="ccCVV2" class="form_Field50 key-numeric" value="" tabindex="32" maxlength="4" /></div>
                                    <div class="span-4 textLeft"><span class="rallyOrderTooltip" id="rallyOrderTooltip"><img src="img/questionMark.png" width="21" height=""21" alt="" style="margin-top:2px;" alt="Where is the Security Code?" /></span></div>
                                    <div class="span-1 last"><p>&#32;</p></div>
                                    <div class="span-20 height5" style="clear:both;">&#32;</div>
                                    <div class="span-4 input">&#32;</div>
                                    <div class="span-15 input last" id="ccBox">&#32;</div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-20 formFieldSpacer">&#160;</div>
                                    <div class="span-4 textRight input"><label for="ccExpMonth" id="expLabel"><span class="required">*</span>Expiration Date:</label></div>
                                    <div class="span-2 input">
                                        <select name="ccExpMonth" id="ccExpMonth" class="form_Select70" tabindex="33">
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
                                    <div class="span-4 input">
                                        <!--suppress HtmlFormInputWithoutLabel -->
                                        <select name="ccExpYear" id="ccExpYear" class="form_Select70" tabindex="34">
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
                                    <div class="span-9 last" style="margin-top:2px;"><div id="ccDateError" class="errorContainer"></div></div>
                                    <div class="span-20 formFieldSpacer">&#160;</div>
                                    <div class="span-20" style="clear:both;"><br><br></div>
                                </div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="clear:both;">&#160;</div>
                            </div>
                            <div class="container showWhite">
                                <div class="span-24"><p>&nbsp;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="button_SubmitPaymentInformation marginTop5" title="Enter Payment Information" tabindex="99" style=margin-top:17px;" onclick="return confirm('Are you sure you want to submit a Cookie Rally Package Order for '+$('#rallyOrderItemized').val().replace('<br>','')+'?\n\nTotal cost will be $'+$('#rallyOrderGrandTotalTemp').val()+', which includes applicable tax.\n\nYour order may be picked up at the '+$('#rallyOrderDeliveryCopy').val()+' between November 4 and 19.');"></div>
                                <!--+' for the amount of '+$('#cookieOrderGrandTotalTemp').html()-->
                                <!--var temp = $('#orderItemized').val();-->
                                <!--//     var itemizedConverted = temp.replace(/<br>/g,"\n");-->
                                <div class="span-8 textRight">
                                    <?php include('i_securityVendorTrustwave.php');?>
                                    <!--<div class="span-8 textRight"><img src="img/vcss-blue.gif" width="88" height="36" title="Valid CSS" alt="Valid CSS" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="36" title="HTML 5 Powered" alt="HTML 5 Powered" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tc-seal-blue.png" width="72" height="37" title="This site is protected by Trustwave's Trusted Commerce program" alt="This site is protected by Trustwave's Trusted Commerce program" style="cursor:pointer;" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=ssl.trustwave.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"></div>-->
                                    <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24"><br><br><br></div>
                            </div>
                        <?php }?>
                    </div>
                    <?php include('i_cookieFooter.php');?>
                </div>
                <!-- ############################################################################################################### -->
                <div style="clear:both;">
                    <br><br>
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitRallyOrder" tabindex="-1" />
                    <input type="text" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="text" name="formType" id="formType" value="order" tabindex="-1" placeholder="Form Type" />
                    <input type="text" name="rallyOrderDeliveryLocation" id="rallyOrderDeliveryLocation" value="" placeholder="Order Delivery Location" tabindex="-1">
                    <input type="text" name="rallyOrderDeliveryCopy" id="rallyOrderDeliveryCopy" value="" placeholder="Pick Up Location - Long" tabindex="-1">
                    <input type="text" name="rallyOrderItemized" id="rallyOrderItemized" value="" placeholder="Order Itemized" tabindex="-1">
                    <input type="text" name="rallyOrderSubTotalTemp" id="rallyOrderSubTotalTemp" value="" placeholder="Sub Total Temp" tabindex="-1">
                    <input type="text" name="rallyOrderTaxTemp" id="rallyOrderTaxTemp" value="" placeholder="Tax Temp" tabindex="-1">
                    <input type="text" name="rallyOrderGrandTotalTemp" id="rallyOrderGrandTotalTemp" value="" placeholder="Grand Total Temp" tabindex="-1">
                    <input type="text" name="rallyOrderCookiesTemp" id="rallyOrderCookiesTemp" value="" placeholder="Total Cookie Sales" tabindex="-1">
                    <input type="text" name="rallyOrderPatchesTemp" id="rallyOrderPatchesTemp" value="" placeholder="Total Patch Sales" tabindex="-1">
                    <input type="text" name="ccType" id="ccType" value="" placeholder="CC Type" tabindex="-1">

                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
                </div>
            </form>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/vendors/jquery.magnify.js" type="text/javascript"></script>
        <script src="js/vendors/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="js/vendors/jquery.tooltipster.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
    </body>
</html>
