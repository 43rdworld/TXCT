<?php
    // form source from http://bassistance.de/
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
//    require("i_PDOConnection.php");								    //=	CREATES DATA CONNECTION TO DATABASE
    require("i_PDOFunctions.php");								    //= LOAD FORM FUNCTIONS
    //require("includes/i_TShirtOrderSettings.php");
    // require("includes/log-referrer.php");
    // session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION
    //    echo "SECRET: ".$formSecret."<br>";
    //    if(!ISSET($_SESSION['formSecret'])) {
    //        $_SESSION['formSecret'] = $formSecret;
    //    }
    setRegistrationParams('10/01/2015','11/17/2018');
//if(today > endDate) {
//    echo 'greater';
//} else {
//    echo 'less';
//}
//echo "TODAY: ".today."<br>";
//echo "END: ".endDate."<br>";
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Texas Cookie Time TShirt Order Form</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="js/vendors/modernizr.js"></script>
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="tshirtOrderConfirmation.php" autocomplete="off">
                <div>
                    <!-- ## BEGIN PAGE 1 ############################################################################################### -->
                    <div class="no_js">
                        <div class="container showWhite" style="position:relative;">
                            <div class="span-24" style="height:100px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 noscriptNotice" style="text-align:center;"><a href="http://enable-javascript.com/" target="_blank"><img src="img/javascriptDisabled.png" width="500" height="100" alt="How to enable javascript on your browser" /></a></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:500px;">&nbsp;</div>
                            <div class="span-24" style="margin-bottom:250px;"><br></div>
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
                                <div class="span-24" style="margin-bottom:250px;"></div>
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
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online registration for Cookie TShirt Orders has closed.<br><br><br></div>
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
                                <div class="span-24" style="margin-bottom:250px;"></div>
                            </div>
                        <?php } else { ?>
                            <div class="container showWhite">
                                <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20"><h1>T-shirt Order Form</h1></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="height:10px;">&nbsp;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntro" id="eventIntro">
                                    <div>
                                        <div class="eventIntroLg">Let everyone know the role you play in the Cookie Program by ordering a Troop Cookie Manager shirt.  Simply enter who you are, how many you want and if you want to pick them up or have them delivered.</div>
                                        <div class="eventIntroRequired">Questions with a red asterisk must be completed in order to complete the nomination.</div>
                                    </div>
                                </div>
                            <!-- START TSHIRT PURCHASE BLOCK ======================================================================================================== -->
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/tshirtPurchaseHeader_Sm.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5"><img src="img/tshirtThumbnail.png" width="175" height="182" alt="" border="0"  id="tshirtOrder" class="magnify" data-magnify-src="img/tShirtLarge.jpg" style="margin-top:10px;"></div>
                                <div class="span-9 inputTop" id="shirtSelectWrapper">
                                    <div class="fauxLabel marginBottom5"><span class="required">*</span>Enter the number of shirts to be ordered below.</div>
                                    <table cellspacing="0" cellpadding="0" class="orderTable">
                                        <tbody>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="orderS" id="orderS" class="ts1 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="orderS">Small <span>($10 + tax)</span></label></td>
                                            </tr>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="orderM" id="orderM" class="ts1 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="orderM">Medium <span>($10 + tax)</span></label></td>
                                            </tr>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="orderL" id="orderL" class="ts1 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="orderL">Large <span>($10 + tax)</span></label></td>
                                            </tr>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="orderXL" id="orderXL" class="ts1 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="orderXL">XL <span>($10 + tax)</span></label></td>
                                            </tr>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="order2X" id="order2X" class="ts2 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="order2X">2XL <span>($12 + tax)</span></label></td>
                                            </tr>
                                            <tr>
                                                <td class="orderQuantityCell"><input type="text" name="order3X" id="order3X" class="ts2 key-numeric form_Field25 tshirtOrderGroup"></td>
                                                <td class="orderSizeCell"><label for="order3X">3XL <span>($12 + tax)</span></label></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="span-6"><div id="orderError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <!--<div class="span-24">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight" style="font-size:1.2em;"><strong>T-Shirt Total:</strong></div>-->
                                <!--<div class="span-9 inputTop" id="orderDeliveryWrapper">-->
                                <!--    <span name="orderTotalText" id="orderTotalText" class="tshirtOrderTotal">$0.00</span>-->
                                <!--</div>-->
                                <!--<div class="span-6">&#32;</div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <div class="span-24 marginTop15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/pickupDeliveryHeader_Sm.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntroLg">
								Choose the store location below where you would like to pick up and pay for your Troop Cookie Manager T-Shirt. The staff at that location will contact you when your shirt is available.
								<div style="margin:8px 0 10px 0;">Our plan is to have your shirt available in December so you have plenty of time to get it before Cookie Season starts.  If you decide to have the shirt shipped directly to you, we will contact you for credit card information when your shirt is available.</div>
								</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight"><label><span class="required">*</span>Pick up/delivery options:</label></div>
                                <div class="span-9 inputTop" id="orderDeliveryWrapper">
                                    <ul class="orderDeliveryList">
                                        <li><input type="radio" name="orderDelivery" id="orderJAF" value="jaf"><label class="labelNormal marginLeft10" for="orderJAF">JoAnn Fogg<br><span>6001 Summerside Dr. Dallas, TX 75252 (972-349-2416)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderSSSC" value="sssc"><label class="labelNormal marginLeft10" for="orderSSSC">Hampton<br><span>8705 S. Hampton Rd. Dallas, TX 75232 (214-946-7075)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderETRC" value="etrc"><label class="labelNormal marginLeft10" for="orderETRC">East Texas Regional Center<br><span>9126 Hwy. 271 Tyler, TX 75708 (903-526-2007)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderRocky" value="rocky"><label class="labelNormal marginLeft10" for="orderRocky">Grayson Area / Camp Rocky Point<br><span>1243 Hanna Drive, Denison, TX  75020 (903-465-5270)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderHV" value="hv"><label class="labelNormal marginLeft10" for="orderHV">Highland Village<br><span>1850 Justin Rd. Highland Village, TX 75077 (972-318-1300)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderDenton" value="den"><label class="labelNormal marginLeft10" for="orderDenton">Denton<br><span>2317 W. University Denton, TX 76207 (940-243-1314)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderParis" value="par"><label class="labelNormal marginLeft10" for="orderParis">Paris<br><span>47 Camp Gambill Dr., Sumner, TX 75486 (903-784-0803)</span></label></li>
                                        <li><input type="radio" name="orderDelivery" id="orderCollin" value="col"><label class="labelNormal marginLeft10" for="orderCollin">Collin Area<br><span>190 E. Stacy Rd. Allen, TX 75002 (972-912-3030)</span></label><div style="border-top:2px dashed #999;width:200px;margin:15px 0 15px 35px;">&#32;</div></li>
                                        <li><input type="radio" name="orderDelivery" id="orderDelivery" value="home"><label class="labelNormal marginLeft10" for="orderDelivery">Ship to my home for a <strong>$6 fee</strong>.</label></li>
                                    </ul>
                                </div>
                                <div class="span-6"><div id="orderDeliveryError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-6"><p>&#32;</p></div>
                                <div class="span-16 sales_PackageNote">Note: Payment is due when the order is picked up in the selected shop or prior to being mailed.</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <!--<div class="span-24 marginTop25">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight" style="font-size:1.4em;"><strong>Grand Total:</strong></div>-->
                                <!--<div class="span-9 inputTop" id="orderDeliveryWrapper">-->
                                <!--    <span name="finalOrderTotalText" id="finalOrderTotalText" class="finalOrderTotal">$0.00</span>-->
                                <!--</div>-->
                                <!--<div class="span-6"><div id="orderDeliveryError" class="errorContainer"></div></div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <div class="span-24 marginTop20">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/customerInformationHeader_Sm.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-24">&#32;</div>
                                <div class="span-24 height5">&#160;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight inputTop"><label for="orderFName"><span class="required">*</span>First Name: </label></div>
                                <div class="span-7 inputTop"><input type="text" id="orderFName" name="orderFName" class="form_Field200" tabindex="1" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="orderFNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="orderLName"><span class="required">*</span>Last Name: </label></div>
                                <div class="span-7 input"><input type="text" id="orderLName" name="orderLName" class="form_Field200" tabindex="2" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="orderLNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div  class="span-24" id="orderAddressWrapper" style="display:none;">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderAddress"><span class="required">*</span>Address: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderAddress" name="orderAddress" class="form_Field275" tabindex="3" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderAddressError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderCity"><span class="required">*</span>City: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderCity" name="orderCity" class="form_Field200" tabindex="4" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderCityError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderState" id="orderStateLabel"><span class="required">*</span>State:</label></div>
                                    <div class="span-7 input"><?php echo getSelectList($dbh,'orderState','orderState','sp_GetStatesList true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',5,null,null,null,null,null,null,null,null)?></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6" style="margin-top:2px;"><div id="orderStateError" class="errorContainer"></div></div>
                                    <div class="span-2 last"><p>&#32;</p></div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderZip"><span class="required">*</span>Zip Code: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderZip" name="orderZip" class="form_Field50" tabindex="6" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderZipError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                </div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="orderPhone"><span class="required">*</span>Daytime Phone: </label></div>
                                <div class="span-9 input"><input type="text" id="orderPhone" name="orderPhone" class="form_Field125" tabindex="7" autocomplete="off" /></div>
                                <div class="span-7"><div id="orderPhoneError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="orderEmail" id="orderEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                <div class="span-7 input"><input type="text" name="orderEmail" id="orderEmail" class="form_Field275" value="" tabindex="8" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="orderEmailError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="orderEmail2" id="orderEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                                <div class="span-7 input"><input type="text" name="orderEmail2" id="orderEmail2" class="form_Field275" value="" tabindex="9" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="orderEmail2Error" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            </div>
                            <div class="container showWhite">
                                <div class="span-24"><p>&nbsp;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24"><p>&#32;</p></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="submitTShirtOrderButton marginTop5" title="Submit Registration Information" tabindex="99"></div>
                                <div class="span-8 textRight"><img src="img/vcss-blue.gif" width="88" height="36" title="Valid CSS" alt="Valid CSS" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="36" title="HTML 5 Powered" alt="HTML 5 Powered" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tc-seal-blue.png" width="72" height="37" title="This site is protected by Trustwave's Trusted Commerce program" alt="This site is protected by Trustwave's Trusted Commerce program" style="cursor:pointer;" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=ssl.trustwave.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"></div>
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
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submittshirtorder" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="permission" tabindex="-1" placeholder="Form Type" />
                    <input type="hidden" name="orderDeliveryLocation" id="orderDeliveryLocation" value="" placeholder="Order Delivery Location" tabindex="-1">
                    <input type="hidden" name="orderTotalCopy" id="orderTotalCopy" value="" placeholder="Order Total Copy" tabindex="-1">
                    <input type="hidden" name="orderItemized" id="orderItemized" value="" placeholder="Order Itemized" tabindex="-1">

                    <input type="hidden" name="orderSTemp" id="orderSTemp" value="" placeholder="Order S" tabindex="-1">
                    <input type="hidden" name="orderMTemp" id="orderMTemp" value="" placeholder="Order M" tabindex="-1">
                    <input type="hidden" name="orderLTemp" id="orderLTemp" value="" placeholder="Order L" tabindex="-1">
                    <input type="hidden" name="orderXLTemp" id="orderXLTemp" value="" placeholder="Order XL" tabindex="-1">
                    <input type="hidden" name="order2XTemp" id="order2XTemp" value="" placeholder="Order 2X" tabindex="-1">
                    <input type="hidden" name="order3XTemp" id="order3XTemp" value="" placeholder="Order 3X" tabindex="-1">
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>s
                </div>
            </form>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/vendors/jquery.magnify.js" type="text/javascript"></script>
        <script src="js/vendors/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_TShirtOrderValidation.js" type="text/javascript"></script>
    </body>
</html>
