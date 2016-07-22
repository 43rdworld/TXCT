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
        <title></title>
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
            <form name="theForm" id="theForm" method="post" action="cookieShirtOrderConfirmation.php" autocomplete="off">
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
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online ordering for Cookie Squad Shirts has closed.<br><br>Thank you so much for all of your hard work this season.<br><br></br><br></div>
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
                                <div class="span-20"><h1>Cookie Squad Member T-shirt Order Form</h1></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24" style="height:10px;">&nbsp;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 eventIntro" id="eventIntro">
                                    <div>
                                        <div class="eventIntroLg">Let everyone know the role you play in your favorite Super Seller's Cookie Program by ordering a Cookie Squad shirt.  Simply enter who you are, how many you want and and how your Diva super seller will celebrate her 1200+ reward (camp, Great Wolf Lodge or cookie dough) .</div>
										<div class="eventIntroLg"><span style="color:#909;font-weight:bold;">All orders must be received by Friday, March 25</span> - so don't take too long!</div>
                                        <div class="eventIntroRequired">Questions with a red asterisk must be completed in order to complete the nomination.</div>
                                    </div>
                                </div>
                            <!-- START TSHIRT PURCHASE BLOCK ======================================================================================================== -->
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_OrderCookieSquadTShirt.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- START CONTACT INFO BLOCK =========================================================================================================== -->
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5"><img src="img/cookieTShirtThumbnail.png" width="175" height="230" alt="" border="0"  id="cookieShirtOrder" class="magnify" data-magnify-src="img/cookieTShirtLarge.jpg" style="margin-top:10px;"></div>
                                <div class="span-9 inputTop">
                                    <div class="fauxLabel marginBottom5"><span class="required">*</span>Enter the number of shirts to be ordered below.</div>
                                    <table cellpadding="0" cellspacing="0" class="cookieOrderTableWrapper" style="margin:0;">
                                        <tr>
                                            <th>Youth Sizes</th>
                                            <th>Adult Sizes</th>
                                        </tr>
                                        <tr>
                                            <td style="background-color:#fff; ">
                                                <table cellspacing="0" cellpadding="0" class="cookieOrderTable">
                                                    <tbody>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderYS" id="cookieOrderYS" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="1"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderS">Small <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderYM" id="cookieOrderYM" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="2"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderM">Medium <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderYL" id="cookieOrderYL" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="3"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderL">Large <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td style="background-color:#fff; ">
                                                <table cellspacing="0" cellpadding="0" class="cookieOrderTable">
                                                    <tbody>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderAS" id="cookieOrderAS" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="4"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderS">Small <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderAM" id="cookieOrderAM" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="5"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderM">Medium <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderAL" id="cookieOrderAL" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="6"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderL">Large <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderAXL" id="cookieOrderAXL" class="cts1 key-numeric form_Field20 tshirtOrderGroup" tabindex="7"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrderXL">XL <span>($10 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderA2X" id="cookieOrderA2X" class="cts2 key-numeric form_Field20 tshirtOrderGroup" tabindex="8"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrder2X">2XL <span>($12 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderA3X" id="cookieOrderA3X" class="cts2 key-numeric form_Field20 tshirtOrderGroup" tabindex="9"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrder3X">3XL <span>($12 + tax)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="cookieOrderQuantityCell"><input type="text" name="cookieOrderA4X" id="cookieOrderA4X" class="cts2 key-numeric form_Field20 tshirtOrderGroup" tabindex="10"></td>
                                                        <td class="cookieOrderSizeCell"><label for="cookieOrder3X">4XL <span>($12 + tax)</span></label></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="span-6"><div id="cookieOrderError" class="errorContainer" style="margin-top:50px;"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Sub- Total:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderSubTotalText" class="cookieTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-14">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Tax:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderTaxText" class="cookieTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-14">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-5 textRight" style="font-size:13pt;"><strong>Grand Total:</strong></div>
                                <div class="span-2 inputTop" id="cookieOrderDeliveryWrapper">
                                    <div id="orderGrandTotalText" class="cookieTShirtOrderTotal">$0.00</div>
                                </div>
                                <div class="span-14">&#32;</div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 marginTop15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_PickupDelivery.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-14 eventIntroLg">Choose the delivery option that works best for you:</div>
                                <div class="span-6"><div id="cookieOrderDeliveryError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight"><label><span class="required">*</span>Select an option:</label></div>
                                <div class="span-12 inputTop" id="cookieOrderDeliveryWrapper">
                                    <ul class="orderDeliveryList">
                                        <li><input type="radio" name="cookieOrderDelivery" id="cookieOrderGreatWolf" value="gwl" tabIndex="11"><label class="labelNormal marginLeft10" for="cookieOrderGreatWolf"><strong>For Super Sellers choosing the Great Wolf Lodge Reward -</strong><div class="cookieOrderDeliveryOptions">Shirts will  be delivered to your Super Seller's room at the Great Wolf Lodge along with your Super Seller's goody bag.</div></label></li>
                                        <li><input type="radio" name="cookieOrderDelivery" id="cookieOrderCamp" value="camp"><label class="labelNormal marginLeft10" for="cookieOrderCamp"><strong>For Super Sellers choosing a resident camp session or cookie dough -</strong><div class="cookieOrderDeliveryOptions">Shirts will be delivered to your home address along with your Super Seller's shirt at no additional charge.</div></label></li>
                                    </ul>
                                </div>
                                <div class="span-3"></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24">&#32;</div>
                                <div class="span-24 inputTop" id="cookieOrderAddressWrapper" style="display:none;">
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
                                    <div class="span-5 textRight inputTop"><label for="cookieOrderFName"><span class="required">*</span>First Name: </label></div>
                                    <div class="span-7 inputTop"><input type="text" id="cookieOrderFName" name="cookieOrderFName" class="form_Field200" tabindex="12" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="cookieOrderFNameError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderLName"><span class="required">*</span>Last Name: </label></div>
                                    <div class="span-7 input"><input type="text" id="cookieOrderLName" name="cookieOrderLName" class="form_Field200" tabindex="13" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="cookieOrderLNameError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderAddress"><span class="required">*</span>Address: </label></div>
                                    <div class="span-9 input"><input type="text" id="cookieOrderAddress" name="cookieOrderAddress" class="form_Field275" tabindex="14" autocomplete="off" /></div>
                                    <div class="span-7"><div id="cookieOrderAddressError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderCity"><span class="required">*</span>City: </label></div>
                                    <div class="span-9 input"><input type="text" id="cookieOrderCity" name="cookieOrderCity" class="form_Field200" tabindex="15" autocomplete="off" /></div>
                                    <div class="span-7"><div id="cookieOrderCityError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderState" id="cookieOrderStateLabel"><span class="required">*</span>State:</label></div>
                                    <div class="span-7 input"><?php echo getSelectList($dbh,'cookieOrderState','cookieOrderState','sp_GetStates_List true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',16,null,null,null,null,null,null,null,null)?></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6" style="margin-top:2px;"><div id="cookieOrderStateError" class="errorContainer"></div></div>
                                    <div class="span-2 last"><p>&#32;</p></div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderZip"><span class="required">*</span>Zip Code: </label></div>
                                    <div class="span-9 input"><input type="text" id="cookieOrderZip" name="cookieOrderZip" class="form_Field50" tabindex="17" autocomplete="off" /></div>
                                    <div class="span-7"><div id="cookieOrderZipError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderPhone"><span class="required">*</span>Daytime Phone: </label></div>
                                    <div class="span-9 input"><input type="text" id="cookieOrderPhone" name="cookieOrderPhone" class="form_Field125" tabindex="18" autocomplete="off" /></div>
                                    <div class="span-7"><div id="cookieOrderPhoneError" class="errorContainer"></div></div>
                                    <div class="span-1 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderEmail" id="cookieOrderEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="cookieOrderEmail" id="cookieOrderEmail" class="form_Field275" value="" tabindex="19" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="cookieOrderEmailError" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieOrderEmail2" id="cookieOrderEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="cookieOrderEmail2" id="cookieOrderEmail2" class="form_Field275" value="" tabindex="20" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="cookieOrderEmail2Error" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24">&#32;</div>
                                    <div class="span-24 height20">&#160;</div>
                                </div>
                                <!--<div class="span-24 marginTop25">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight" style="font-size:1.4em;"><strong>Grand Total:</strong></div>-->
                                <!--<div class="span-9 inputTop" id="cookieOrderDeliveryWrapper">-->
                                <!--    <span name="finalOrderTotalText" id="finalOrderTotalText" class="finalOrderTotal">$0.00</span>-->
                                <!--</div>-->
                                <!--<div class="span-6"><div id="orderDeliveryError" class="errorContainer"></div></div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <!--<div class="span-24 marginTop20">&#32;</div>-->
                                <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-20 newSection" style="height:21px;"><img src="img/hdr_CustomerInformation.png" width="400" height="21" alt="" /></div>-->
                                <!--<div class="span-2 last"><p>&#32;</p></div>-->
                                <!--<div class="span-24">&#32;</div>-->
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
                                <div class="span-24" id="cookieOrderSameInfo" style="display:none;">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-4"><p>&#32;</p></div>
                                    <div class="span-1 textCenter"><input type="checkbox" id="cookieBillingSame" name="cookieBillingSame" value="1" <?php echo $billingSameChecked;?> tabIndex="21"></div>
                                    <div class="span-14"><label for ="cookieBillingSame">My registration and billing information are the same.</label></div>
                                    <div class="span-2 last"><p>&#32;</p></div>
                                    <div class="span-24">&#32;</div>
                                    <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                    <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                                    <div class="span-24" style="height:10px;">&nbsp;</div>
                                </div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight inputTop"><label for="cookieBillingFName"><span class="required">*</span>First Name: </label></div>
                                <div class="span-7 inputTop"><input type="text" id="cookieBillingFName" name="cookieBillingFName" class="form_Field200" tabindex="22" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="cookieBillingFNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingLName"><span class="required">*</span>Last Name: </label></div>
                                <div class="span-7 input"><input type="text" id="cookieBillingLName" name="cookieBillingLName" class="form_Field200" tabindex="23" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="cookieBillingLNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingAddress"><span class="required">*</span>Address: </label></div>
                                <div class="span-9 input"><input type="text" id="cookieBillingAddress" name="cookieBillingAddress" class="form_Field275" tabindex="24" autocomplete="off" /></div>
                                <div class="span-7"><div id="cookieBillingAddressError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingCity"><span class="required">*</span>City: </label></div>
                                <div class="span-9 input"><input type="text" id="cookieBillingCity" name="cookieBillingCity" class="form_Field200" tabindex="25" autocomplete="off" /></div>
                                <div class="span-7"><div id="cookieBillingCityError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingState" id="cookieBillingStateLabel"><span class="required">*</span>State:</label></div>
                                <div class="span-7 input"><?php echo getSelectList($dbh,'cookieBillingState','cookieBillingState','sp_GetStates_List true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',26,null,null,null,null,null,null,null,null)?></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6" style="margin-top:2px;"><div id="cookieBillingStateError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingZip"><span class="required">*</span>Zip Code: </label></div>
                                <div class="span-9 input"><input type="text" id="cookieBillingZip" name="cookieBillingZip" class="form_Field50" tabindex="27" autocomplete="off" /></div>
                                <div class="span-7"><div id="cookieBillingZipError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingPhone"><span class="required">*</span>Daytime Phone: </label></div>
                                <div class="span-9 input"><input type="text" id="cookieBillingPhone" name="cookieBillingPhone" class="form_Field125" tabindex="28" autocomplete="off" /></div>
                                <div class="span-7"><div id="cookieBillingPhoneError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="cookieBillingEmail" id="cookieBillingEmailLabel"><span class="required">*</span>Email Address:</label></div>
                                <div class="span-7 input"><input type="text" name="cookieBillingEmail" id="cookieBillingEmail" class="form_Field275" value="" tabindex="29" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="cookieBillingEmailError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-24" id="cookieOrderPaymentAddressWrapper">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-5 textRight input"><label for="cookieBillingEmail2" id="cookieBillingEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                                    <div class="span-7 input"><input type="text" name="cookieBillingEmail2" id="cookieBillingEmail2" class="form_Field275" value="" tabindex="30" autocomplete="off" /></div>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-6"><div id="cookieBillingEmail2Error" class="errorContainer"></div></div>
                                    <div class="span-2 last">&#32;</div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                </div>
                                <div class="span-24 marginTop20">&#32;</div>
                                <!-- BEGIN CREDIT CARD INFORMATION -------------------------------------------------------------------------------------------->

                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 cookieOrderPaymentWrapper">
                                    <div class="span-20 height20" style="clear:both;">&#32;</div>
                                    <div class="span-9 cookeOrderPaymentSubhead">
                                        <div style="margin-left:55px;">
                                            Secure Credit Card Payment
                                            <div class="cookiePaymentSubheadSecurity">This is a secure, 256-bit TLS encrypted payment</div>
                                        </div>
                                    </div>
                                    <div class="span-11 last"><img src="img\th_TrustwaveLogo.png" width="71" height="36" alt=""></div>
                                    <div class="span-20 height25" style="clear:both;">&#32;</div>
                                    <div class="span-5 textRight input"><label for="ccNum" id="ccNumLabel"><span class="required">*</span>Card Number:</label></div>
                                    <div class="span-6 input"><input type="text" name="ccNum" id="ccNum" class="form_Field150" value="" tabindex="31" placeholder="Numbers Only" /></div>
                                    <div class="span-8" style="margin-top:2px;">&#32;</div>
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
                                    <div class="span-4"><span class="cookieSquadTooltip" id="cookieSquadTooltip"><img src="img/questionMark.png" width="21" height=""21" alt="" style="margin-top:2px;" /></span></div>
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
                                <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="button_SubmitPaymentInformation marginTop5" title="Enter Payment Information" tabindex="99" style=margin-top:17px;" onclick=" return confirm('Are you sure you want to submit an order for '+$('#cookieOrderTotalNumber').val()+' Cookie Squad shirt(s)?\n\nTotal cost will be $'+$('#cookieOrderGrandTotalTemp').val()+' including applicable tax.  Shipping is free.');"></div>
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
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitCookieShirtOrder" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="permission" tabindex="-1" placeholder="Form Type" />
                    <input type="hidden" name="cookieDeliveryLocation" id="cookieDeliveryLocation" value="" placeholder="Order Delivery Location" tabindex="-1">
                    <input type="text" name="cookieOrderTotalNumber" id="cookieOrderTotalNumber" value="" placeholder="Order Total Copy" tabindex="-1">
                    <input type="text" name="cookieOrderTotalCopy" id="cookieOrderTotalCopy" value="" placeholder="Order Total " tabindex="-1">
                    <input type="text" name="cookieOrderItemized" id="cookieOrderItemized" value="" placeholder="Order Itemized" tabindex="-1">
                    <input type="text" name="cookieOrderSubTotalTemp" id="cookieOrderSubTotalTemp" value="" placeholder="Sub Total Temp" tabindex="-1">
                    <input type="text" name="cookieOrderTaxTemp" id="cookieOrderTaxTemp" value="" placeholder="Tax Temp" tabindex="-1">
                    <input type="text" name="cookieOrderGrandTotalTemp" id="cookieOrderGrandTotalTemp" value="" placeholder="Grand Total Temp" tabindex="-1">
                    <input type="text" name="cookieOrderYSTemp" id="cookieOrderYSTemp" value="" placeholder="Order Youth S" tabindex="-1">
                    <input type="text" name="cookieOrderYMTemp" id="cookieOrderYMTemp" value="" placeholder="Order Youth M" tabindex="-1">
                    <input type="text" name="cookieOrderYLTemp" id="cookieOrderYLTemp" value="" placeholder="Order Youth L" tabindex="-1">
                    <input type="text" name="cookieOrderASTemp" id="cookieOrderASTemp" value="" placeholder="Order Adult S" tabindex="-1">
                    <input type="text" name="cookieOrderAMTemp" id="cookieOrderAMTemp" value="" placeholder="Order Adult M" tabindex="-1">
                    <input type="text" name="cookieOrderALTemp" id="cookieOrderALTemp" value="" placeholder="Order Adult L" tabindex="-1">
                    <input type="text" name="cookieOrderAXLTemp" id="cookieOrderAXLTemp" value="" placeholder="Order Adult XL" tabindex="-1">
                    <input type="text" name="cookieOrderA2XTemp" id="cookieOrderA2XTemp" value="" placeholder="Order Adult 2X" tabindex="-1">
                    <input type="text" name="cookieOrderA3XTemp" id="cookieOrderA3XTemp" value="" placeholder="Order Adult 3X" tabindex="-1">
                    <input type="text" name="cookieOrderA4XTemp" id="cookieOrderA4XTemp" value="" placeholder="Order Adult 4X" tabindex="-1">
                    <input type="hidden" name="ccType" id="ccType" value="" placeholder="Payment Card Type" tabindex="-1">
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
        <script src="js/i_CookieSquadOrderValidation.js" type="text/javascript"></script>
    </body>
</html>
