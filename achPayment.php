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
    setRegistrationParams('10/01/2015','03/01/2017');
?>
<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>ePayment - Pay Your Cookie Bill Online</title>
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
            <form name="theACHPaymentForm" id="theACHPaymentForm" method="post" action="achPaymentConfirm.php" autocomplete="off">
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
                                <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>We know you can't wait to get started but give us a little more time to make the place presentable.<br><br>The Project Troop to Troop donation form will be available soon.<br><br><br></div>
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
                                <div class="span-24" style="margin-bottom:500px;border-bottom:1px solid #fff;"></div>
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
                                <div class="span-20" style="font-size:1.2em;text-align:center;">Online e-payment for the 2015 Cookie Season has closed.<br><br>For additional information, please contact the GSNETX Cookie Team at <a href="mailto:cookies@gsnetx.org?subject=Question about payment options">cookies@gsnetx.org</a></div>
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
                                <div class="span-24" style="margin-bottom:500px;border-bottom:1px solid #666;"><br><br><br><br><br><br><br></div>
                            </div>
                        <?php } else { ?>
                        <div class="container showWhite">
                            <div class="span-24"><img src="img/hdr_ACHPayment.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>e-Payment</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" id="eventIntro">
                                <div>
                                    <div class="eventIntroLg">
                                        Use our secure <em>ePayment</em> form below to deposit Cookie sales monies with the Council. All form fields are required.
                                        <div class="para">Note that name field is limited by the bank to 21 characters. Please abbreviate where you can but in such a way that the account name is still recognizable by your bank.</div>
                                    </div>
                                    <div class="eventIntroRequired">Use this secure form to pay your cookie bill online. Questions with a red asterisk must be completed in order to submit the form.</div>
                                </div>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/cookieBillPaymentHeader.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                        <!-- START PAYMENT INFO BLOCK --------------------------------------------------------------------------------------------------->
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="achTroopNum" id="achTroopNumLabel"><span class="required">*</span>Troop Number:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($dbh,'achTroopNum','achTroopNum','sp_GetTroopNumbers_List 2015,null','form_Select200','Select your Troop Number --','troop_number,null,troop_number,null','style="padding:3px 4px;border:1px solid #999;"','onchange="getTCTServiceUnit(\'getTCTSU_ACH.php?troopNum=\'+this.value,\'innerHTML\',\'serviceUnitDiv\');"','id:null',1,null,null,null,null,null,null,null,null,null);?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="achTroopNumError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- *********************************************************************** -->
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permSU" id="achSULabel"><span class="required">*</span>Service Unit:</label></div>
                            <div class="span-7 input" id="serviceUnitDiv">
                                <select class"form_Select300" name="permSU" id="permSU" tabIndex="2" style="width:300px;"><option value="">Select your Service Unit --</option></select>
                                <?php //echo getSelectList($dbh,'volSU','volSU','sp_GetTCTServiceUnit_List 2015,null','form_Select300','Select your Service Unit --','su_Number,null,su_Number,su_AreaNames','style="padding:3px 4px;border:1px solid #999;"',null,'id:null',9,null,null,null,null,null,null,null,null,null);?>
                            </div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permSUError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer" style="margin-top:10px;">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achAccountName"><span class="required">*</span>Name on Account: </label></div>
                            <div class="span-9 inputTop"><input type="text" id="achAccountName" name="achAccountName" class="form_Field175" tabindex="3" autocomplete="off" value="" maxlength="21" placeholder="21 Characters Max" />&nbsp;&nbsp;<span class="charsRemain" id="accountNameChars"><span>21</span> characters left</span></div>
                            <div class="span-8 last"><div id="achAccountNameError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="achPhone"><span class="required">*</span>Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="achPhone" name="achPhone" class="form_Field125" tabindex="4" autocomplete="off" value="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-8"><div id="achPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="achEmail" id="achEmailLabel"><span class="required">*</span>Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="achEmail" id="achEmail" class="form_Field275" tabindex="5" autocomplete="off" value="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-8 last"><div id="achEmailError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="achConfirmEmail" id="achConfirmEmailLabel"><span class="required">*</span>Confirm Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="achConfirmEmail" id="achConfirmEmail" class="form_Field275" tabindex="6" autocomplete="off" value="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-8 last"><div id="achConfirmEmailError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achRouting"><span class="required">*</span>Routing Number: </label></div>
                            <div class="span-5 inputTop"><input type="text" id="achRouting" name="achRouting" class="form_Field200" tabindex="7" autocomplete="off" value="" /></div>
                            <div class="span-4">&#160;&#160;&#160;&#160;&#160;&#160;<span class="routingTooltip" id="routingTooltip"><img src="img/questionMark.png" width="21" height="21" alt="" /></span></div>
                            <div class="span-8 last"><div id="achRoutingError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achRoutingConfirm"><span class="required">*</span>Routing Number (confirm): </label></div>
                            <div class="span-9 inputTop"><input type="text" id="achRoutingConfirm" name="achRoutingConfirm" class="form_Field200" tabindex="8" autocomplete="off" value="" /></div>
                            <div class="span-8 last"><div id="achRoutingConfirmError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achAccount"><span class="required">*</span>Account Number: </label></div>
                            <div class="span-5 inputTop"><input type="text" id="achAccount" name="achAccount" class="form_Field200" tabindex="9" autocomplete="off" value="" /></div>
                            <div class="span-4">&#160;&#160;&#160;&#160;&#160;&#160;<span class="accountTooltip" id="accountTooltip"><img src="img/questionMark.png" width="21" height="21" alt="" /></span></div>
                            <div class="span-8 last"><div id="achAccountError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achAccountConfirm"><span class="required">*</span>Account Number (confirm): </label></div>
                            <div class="span-9 inputTop"><input type="text" id="achAccountConfirm" name="achAccountConfirm" class="form_Field200" tabindex="10" autocomplete="off" value="" /></div>
                            <div class="span-8 last"><div id="achAccountConfirmError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="achAmount"><span class="required">*</span>Deposit Amount: </label></div>
                            <div class="span-9 inputTop"><input type="text" id="achAmount" name="achAmount" class="form_Field100" tabindex="11" autocomplete="off" value="" />&nbsp;&nbsp;<span class="formNote"><span>(0.00)</span></span></div>
                            <div class="span-8 last"><div id="achAmountError" class="errorContainer"></div></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                        </div>
                        <div class="container showWhite">
                            <div class="span-24"><p>&nbsp;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="button_SubmitPaymentInformation marginTop5" title="Enter Payment Information" tabindex="99" style=margin-top:17px;"></div>
                            <div class="span-8 textRight">
                                <?php include('i_securityVendorTrustwave.php');?>
                            <!--<div class="span-8 textRight"><img src="img/vcss-blue.gif" width="88" height="36" title="Valid CSS" alt="Valid CSS" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="36" title="HTML 5 Powered" alt="HTML 5 Powered" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tc-seal-blue.png" width="72" height="37" title="This site is protected by Trustwave's Trusted Commerce program" alt="This site is protected by Trustwave's Trusted Commerce program" style="cursor:pointer;" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=ssl.trustwave.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"></div>-->
                            <div class="span-3 last"><p>&#32;</p></div>
                            <div class="span-24"><br><br></div>
                        </div>
                    <?php }?>
                </div>
                <?php include('i_cookieFooter.php');?>
                <div style="clear:both;">
                    <br><br>
                    <input type="hidden" name="submitPayment" id="submitPayment" value="submitACHPayment" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="achpayment" tabindex="-1" placeholder="Form Type" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>

        <!--<script src="../common/js/jquery.min.js" ></script>                                                                                                   <!-- V 1.11.2 -->-->
        <!--<script src="../common/js/jquery-ui.min.js"></script>                                                                                                 <!-- V 1.11.2 -->-->
        <!--<script src="../common/js/jquery.validate.min.js"></script>                                                                                           <!-- V 1.14.0 -->-->
        <!--<script src="../common/js/additional-methods.min.js"></script>-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/vendors/jquery.maskMoney.js"></script>
        <script src="js/vendors/jquery.tooltipster.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_achValidation.js" type="text/javascript"></script>

	</body>
</html>
