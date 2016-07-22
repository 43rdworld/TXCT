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
    setRegistrationParams('10/01/2015','03/27/2017');
?>
<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Service Unit Cookie Coordinator T-Shirt Order Form</title>
        <meta charset="UTF-8">
        <link rel="icon" href="favicon.png" sizes="32x32">
        <link rel="icon" href="favicon.ico" sizes="32x32">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <link href="css/tooltipster.css" rel="stylesheet" type="text/css" />
        <script src="js/vendors/modernizr.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>

    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
    <div>
        <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="succShirtOrderConfirmation.php" autocomplete="off">
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
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online ordering for Service Unit Cookie Coordinator Shirts has closed.<br><br>Thank you so much for all of your hard work this season.<br><br></br><br></div>
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
                            <div class="container showGrid">
                                <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20"><h1>Service Unit Cookie Coordinator T-Shirt Order Form</h1></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="height:10px;">&nbsp;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntro" id="eventIntro">
                                    <div>
                                        <div class="eventIntroLg">Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</div>
										<div class="eventIntroLg"><span style="color:#909;font-weight:bold;">All orders must be received by Friday, March 25</span> - so don't take too long!</div>
                                        <div class="eventIntroRequired">Questions with a red asterisk must be completed in order to submit the order.</div>
                                    </div>
                                </div>
                            <!-- START TSHIRT PURCHASE BLOCK ======================================================================================================== -->
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_OrderSUCCTShirt.png" width="500" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntroLg">
                                    Start by selecting your service unit below and the size(s) and number of shirts you wish to order.
                                </div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="serviceUnit"><span class="required">*</span>Service Unit: </label></div>
                                <div class="span-7 input"><?php echo getSelectList($dbh,'serviceUnit','serviceUnit','sp_GetServiceUnits_List','form_Select150','Select your SU --','su_Number,null,su_Number,null',null,null,'su_Number:',1,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="orderServiceUnitError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer marginTop10">&#32;</div>
                                <div class="span-3"><p>&#32;</p></div>
                                <div class="span-18 inputTop" id="shirtSelectWrapper"><div class="fauxLabel"><span class="required">*</span>Enter the number of shirts to be ordered below.</div></div>
                                <div class="span-3 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textCenter"><img src="img/succ_TShirt2017_th.png" width="150" height="201" alt="" border="0"  id="succShirtOrder" class="magnify" data-magnify-src="img/succ_TShirt2017.jpg" style="margin:10px 0 0 20px;"></div>
                                <div class="span-9 inputTop" id="shirtSelectWrapper">
                                    <table cellspacing="0" cellpadding="0" class="orderTable">
                                        <tbody>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="orderS" id="orderS" class="su1 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="orderS">Small <span>($10 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="orderM" id="orderM" class="su1 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="orderM">Medium <span>($10 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="orderL" id="orderL" class="su1 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="orderL">Large <span>($10 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="orderXL" id="orderXL" class="su1 key-numeric form_Field25 tshirtOrderGroup" maxlength="3" ></td>
                                            <td class="orderSizeCell"><label for="orderXL">XL <span>($10 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="order2X" id="order2X" class="su2 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="order2X">2XL <span>($12 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="order3X" id="order3X" class="su2 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="order3X">3XL <span>($12 + tax)</span></label></td>
                                        </tr>
                                        <tr>
                                            <td class="orderQuantityCell"><input type="text" name="order4X" id="order4X" class="su2 key-numeric form_Field25 tshirtOrderGroup" maxlength="3"></td>
                                            <td class="orderSizeCell"><label for="order4X">4XL <span>($12 + tax)</span></label></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="span-6"><div id="orderError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Sub-Total:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderSubTotalText" class="succTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-13">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Tax:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderTaxText" class="succTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-13">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Grand Total:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderGrandTotalText" class="succTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-13">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 marginTop15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_PickupDelivery.png" width="500" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
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
                                        <li><input type="radio" name="orderDelivery" id="orderDelivery" value="home"><label class="labelNormal marginLeft10" for="orderDelivery">Ship to my home for a <strong>$6 delivery fee</strong>.</label></li>
                                    </ul>
                                </div>
                                <div class="span-6"><div id="orderDeliveryError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 inputTop" id="orderDeliveryInfoWrapper" style="display:none;">
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_DeliveryInformation.png" width="400" height="21" alt="" /></div>
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
                                    <div class="span-7 inputTop"><input type="text" id="orderFName" name="orderFName" class="form_Field200" tabindex="12" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="orderFNameError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderLName"><span class="required">*</span>Last Name: </label></div>
                                    <div class="span-7 input"><input type="text" id="orderLName" name="orderLName" class="form_Field200" tabindex="13" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="orderLNameError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderAddress"><span class="required">*</span>Address: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderAddress" name="orderAddress" class="form_Field275" tabindex="14" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderAddressError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderCity"><span class="required">*</span>City: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderCity" name="orderCity" class="form_Field200" tabindex="15" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderCityError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderState" id="orderStateLabel"><span class="required">*</span>State:</label></div>
                                    <div class="span-7 input"><?php echo getSelectList($dbh,'orderState','orderState','sp_GetStates_List true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',16,null,null,null,null,null,null,null,null)?></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6" style="margin-top:2px;"><div id="orderStateError" class="errorContainer"></div></div>
                                    <div class="span-2 last"><p>&#32;</p></div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderZip"><span class="required">*</span>Zip Code: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderZip" name="orderZip" class="form_Field50" tabindex="17" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderZipError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderPhone"><span class="required">*</span>Daytime Phone: </label></div>
                                    <div class="span-9 input"><input type="text" id="orderPhone" name="orderPhone" class="form_Field125" tabindex="18" autocomplete="off" /></div>
                                    <div class="span-7"><div id="orderPhoneError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderEmail" id="orderEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="orderEmail" id="orderEmail" class="form_Field275" value="" tabindex="19" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="orderEmailError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="orderEmail2" id="orderEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="orderEmail2" id="orderEmail2" class="form_Field275" value="" tabindex="20" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="orderEmail2Error" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24">&#32;</div>
                                    <div class="span-24 height20">&#160;</div>
                                </div>
                                <div class="span-24 formFieldSpacer" id="paymentSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_PaymentInformation.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-24">&#32;</div>
                                <div class="span-24 height5">&#160;</div>
                                <div class="span-24" id="orderSameInfo" style="display:none;">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-4"><p>&#32;</p></div>
                                    <div class="span-1 textCenter"><input type="checkbox" id="billingSame" name="billingSame" value="1" <?php echo $billingSameChecked;?> tabIndex="21"></div>
                                    <div class="span-14"><label for ="billingSame">My registration and billing information are the same.</label></div>
                                    <div class="span-2 last"><p>&#32;</p></div>
                                    <div class="span-24">&#32;</div>
                                    <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                    <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-8 succOrderDashedDivider" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-24" style="height:10px;">&nbsp;</div>
                                </div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight inputTop"><label for="billingFName"><span class="required">*</span>First Name: </label></div>
                                <div class="span-7 inputTop"><input type="text" id="billingFName" name="billingFName" class="form_Field200" tabindex="22" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="billingFNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingLName"><span class="required">*</span>Last Name: </label></div>
                                <div class="span-7 input"><input type="text" id="billingLName" name="billingLName" class="form_Field200" tabindex="23" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="billingLNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingAddress"><span class="required">*</span>Address: </label></div>
                                <div class="span-9 input"><input type="text" id="billingAddress" name="billingAddress" class="form_Field275" tabindex="24" autocomplete="off" /></div>
                                <div class="span-7"><div id="billingAddressError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingCity"><span class="required">*</span>City: </label></div>
                                <div class="span-9 input"><input type="text" id="billingCity" name="billingCity" class="form_Field200" tabindex="25" autocomplete="off" /></div>
                                <div class="span-7"><div id="billingCityError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingState" id="billingStateLabel"><span class="required">*</span>State:</label></div>
                                <div class="span-7 input"><?php echo getSelectList($dbh,'billingState','billingState','sp_GetStates_List true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',26,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6" style="margin-top:2px;"><div id="billingStateError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingZip"><span class="required">*</span>Zip Code: </label></div>
                                <div class="span-9 input"><input type="text" id="billingZip" name="billingZip" class="form_Field50" tabindex="27" autocomplete="off" /></div>
                                <div class="span-7"><div id="billingZipError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingPhone"><span class="required">*</span>Daytime Phone: </label></div>
                                <div class="span-9 input"><input type="text" id="billingPhone" name="billingPhone" class="form_Field125" tabindex="28" autocomplete="off" /></div>
                                <div class="span-7"><div id="billingPhoneError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="billingEmail" id="billingEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                <div class="span-7 input"><input type="text" name="billingEmail" id="billingEmail" class="form_Field275" value="" tabindex="29" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="billingEmailError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-24" id="billingEmail2Wrapper">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="billingEmail2" id="billingEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="billingEmail2" id="billingEmail2" class="form_Field275" value="" tabindex="30" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="billingEmail2Error" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                </div>
                                <div class="span-24 marginTop20">&#32;</div>
                                <!-- BEGIN CREDIT CARD INFORMATION -------------------------------------------------------------------------------------------->

                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 orderPaymentWrapper">
                                    <div class="span-20 height20" style="clear:both;">&#32;</div>
                                    <div class="span-9 orderPaymentSubhead">
                                        <div style="margin-left:55px;">
                                            Secure Credit Card Payment
                                            <div class="orderPaymentSubheadSecurity">This is a secure, 256-bit TLS encrypted payment</div>
                                        </div>
                                    </div>
                                    <div class="span-11 last"><img src="img\th_TrustwaveLogo.png" width="71" height="36" alt=""></div>
                                    <div class="span-20 height25" style="clear:both;">&#32;</div>
                                    <div class="span-5 textRight input"><label for="ccNum" id="ccNumLabel"><span class="required">*</span>Card Number:</label></div>
                                    <div class="span-6 input"><input type="text" name="ccNum" id="ccNum" class="form_Field150" value="" tabindex="31" placeholder="Numbers Only" /></div>
                                    <div class="span-8" style="margin-top:2px;"><div id="ccNumError" class="errorContainer"></div></div>
                                    <div class="span-1 last"><p>&#32;</p></div>
                                    <div class="span-20 height5" style="clear:both;">&#32;</div>
                                    <div class="span-5 input">&#32;</div>
                                    <div class="span-7 input" id="ccBox"></div>
                                    <div class="span-1 input"></div>
                                    <div class="span-6 last" style="margin-top:2px;"></div>

                                    <div class="span-20 formFieldSpacer">&#160;</div>
                                    <div class="span-5 textRight input"><label for="ccExpMonth" id="expLabel"><span class="required">*</span>Expiration Date:</label></div>
                                    <div class="span-2 input">
                                        <select name="ccExpMonth" id="ccExpMonth" class="form_Select70" tabindex="32">
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
                                        <select name="ccExpYear" id="ccExpYear" class="form_Select70" tabindex="33">
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
                                    <div class="span-5 textRight input"><label for="ccCVV2" id="ccCVV2"><span class="required">*</span>Security Code:</label></div>
                                    <div class="span-2 input"><input type="text" name="ccCVV2" id="ccCVV2" class="form_Field50" value="" tabindex="34" /></div>
                                    <div class="span-4"><span class="orderTooltip" id="orderTooltip"><img src="img/questionMark.png" width="21" height=""21" alt="" style="margin-top:2px;" /></span></div>
                                    <div class="span-8 last" style="margin-top:2px;"><div id="ccCVV2Error" class="errorContainer"></div></div>
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
                                <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="submitSUCCShirtOrderButton marginTop5" title="Enter Payment Information" tabindex="99" style=margin-top:17px;" onclick=" return confirm('Are you sure you want to submit an order for '+$('#orderTotalNumber').val()+' Cookie Squad shirt(s)?\n\nTotal cost will be $'+$('#orderGrandTotalTemp').val()+' including applicable tax.  Shipping is free.');"></div>
                                <!--+' for the amount of '+$('#orderGrandTotalTemp').html()-->
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
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitSUCCShirtOrder" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="permission" tabindex="-1" placeholder="Form Type" />
                    <input type="hidden" name="orderDeliveryLocation" id="orderDeliveryLocation" value="" placeholder="Order Delivery Location" tabindex="-1">
                    <input type="text" name="orderTotal" id="orderTotal" value="" placeholder="Order Total" tabindex="-1">
                    <input type="text" name="orderTotalCopy" id="orderTotalCopy" value="" placeholder="Order Total Copy" tabindex="-1">
                    <input type="text" name="orderItemized" id="orderItemized" value="" placeholder="Order Itemized" tabindex="-1">
                    <input type="text" name="orderSubTotalTemp" id="orderSubTotalTemp" value="" placeholder="Sub Total Temp" tabindex="-1">
                    <input type="text" name="orderTaxTemp" id="orderTaxTemp" value="" placeholder="Tax Temp" tabindex="-1">
                    <input type="text" name="orderGrandTotalTemp" id="orderGrandTotalTemp" value="" placeholder="Grand Total Temp" tabindex="-1">
                    <input type="text" name="orderSTemp" id="orderSTemp" value="" placeholder="Order Adult S" tabindex="-1">
                    <input type="text" name="orderMTemp" id="orderMTemp" value="" placeholder="Order Adult M" tabindex="-1">
                    <input type="text" name="orderLTemp" id="orderLTemp" value="" placeholder="Order Adult L" tabindex="-1">
                    <input type="text" name="orderXLTemp" id="orderXLTemp" value="" placeholder="Order Adult XL" tabindex="-1">
                    <input type="text" name="order2XTemp" id="order2XTemp" value="" placeholder="Order Adult 2X" tabindex="-1">
                    <input type="text" name="order3XTemp" id="order3XTemp" value="" placeholder="Order Adult 3X" tabindex="-1">
                    <input type="text" name="orderA4XTemp" id="order4XTemp" value="" placeholder="Order Adult 4X" tabindex="-1">
                    <input type="text" name="ccType" id="ccType" value="" placeholder="Payment Card Type" tabindex="-1">
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
        <script src="js/vendors/jquery.tooltipster.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/val_SUCCShirtOrder.js" type="text/javascript"></script>
    </body>
</html>
