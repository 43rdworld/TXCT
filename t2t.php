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
    setRegistrationParams('10/01/2015','03/11/2016');

    if(!ISSET($_SESSION['formSecret'])) {
        $_SESSION['formSecret'] = $formSecret;
    }
    if(!ISSET($_SESSION['t2tState'])) {
        $t2tState = '';
    } else {
        $t2tState = $_SESSION['t2tState'];
    }
    if(!ISSET($_SESSION['t2tRefer'])) {
        $t2tRefer = '';
    }else {
        switch ($_SESSION['t2tRefer']) {
            case "web";
                $webOption = 'checked';
                break;
            case "news";
                $newsOption = 'checked';
                break;
            case "gs";
                $gsOption = 'checked';
                break;
            case "other";
                $otherOption = 'checked';
                break;
        }
    }
    //echo "REFERRING TROOP: ".$_SESSION['t2tReferringTroop'].'<br>';
    $t2tDonationOptions =  '1||1 Package = $4.00,2||2 Packages = $8.00,3||3 Packages = $12.00,4||4 Packages = $16.00,5||5 Packages = $20.00,6||6 Packages = $24.00,7||7 Packages = $28.00,8||8 Packages = $32.00,9||9 Packages = $36.00,10||10 Packages = $40.00,11||11 Packages = $44.00,12||12 Packages = $48.00,24||24 Packages = $96.00,48||48 Packages = $192.00,64||64 Packages = $256.00,100||100 Packages = $400.00||';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Project Troop to Troop Online Donation Form</title>
        <meta charset="UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <script src="js/vendors/modernizr.js"></script>
	</head>

    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="t2t_Billing.php" autocomplete="off">
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Almost there!  We're baking up a fresh batch just for you - just be patient a little bit longer!<br><br>The Project Troop to Troop donation form will be available soon.<br><br><br></div>
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
                                <div class="span-20" style="font-size:1.2em;text-align:center;">Online donations for Project Troop to Troop has concluded for the 2015/16 Cookie Season.<br><br>Thanks to your generousity, we will be able to provide a taste of home to our servicemen<br>and servicewomen serving at home and abroad.<br><br>Thank You.</div>
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
                                <div class="span-24" style="margin-bottom:100px;"><br><br><br><br><br><br><br></div>
                            </div>
                        <?php } else { ?>
                        <div class="container showWhite">
                            <div class="span-24"><img src="img/hdr_Troop2TroopDonation.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Project Troop to Troop</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" id="eventIntro">
                                <div>
                                    <div class="eventIntroLg">
                                        <em><strong>Project Troop to Troop</strong></em> is a Girl Scout service initiative that encourages members of the community to buy packages of Girl Scout Cookies to donate to US servicemen and servicewomen at home and abroad.
                                        <div class="para">The 2016 Project Troop to Troop Cookies will be transported to Fort Hood, the USO, the American Red Cross and ultimately servicemen and servicewomen at home and abroad. Girl Scout Cookies will also reach local Veterans Organizations and wounded soldiers.</div>
                                    </div>
                                    <div class="eventIntroRequired">Use this secure form to donate cookies online. Questions with a red asterisk must be completed in order to submit the form.</div>
                                </div>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/donationCookiesHeader_Sm.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <!-- START DONATION INFO BLOCK ---------------------------------------------------------------------------------------------------->
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="t2tFName"><span class="required">*</span>First Name: </label></div>
                            <div class="span-7 inputTop"><input type="text" id="t2tFName" name="t2tFName" class="form_Field200" tabindex="1" autocomplete="off" value="<?php echo $_SESSION['t2tFName'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tFNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tLName"><span class="required">*</span>Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="t2tLName" name="t2tLName" class="form_Field200" tabindex="2" autocomplete="off" value="<?php echo $_SESSION['t2tLName'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tLNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tAddress"><span class="required">*</span>Address: </label></div>
                            <div class="span-7 input"><input type="text" id="t2tAddress" name="t2tAddress" class="form_Field275" tabindex="3" autocomplete="off" value="<?php echo $_SESSION['t2tAddress'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tAddressError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"></div>
                            <div class="span-7 input"><input type="text" id="t2tAddress2" name="t2tAddress2" class="form_Field275" tabindex="4" autocomplete="off" value="<?php echo $_SESSION['t2tAddress2'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tAddress2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tCity"><span class="required">*</span>City: </label></div>
                            <div class="span-7 input"><input type="text" id="t2tCity" name="t2tCity" class="form_Field200" tabindex="5" autocomplete="off" value="<?php echo $_SESSION['t2tCity'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tCityError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tState" id="t2tStateLabel"><span class="required">*</span>State:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($dbh,'t2tState','t2tState','sp_GetStates_List true, null','form_Select150 font85','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:'.$t2tState,6,null,null,null,null,null,null,null,null)?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="t2tStateError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tZip"><span class="required">*</span>Zip Code: </label></div>
                            <div class="span-7 input"><input type="text" id="t2tZip" name="t2tZip" class="form_Field50" tabindex="7" autocomplete="off" value="<?php echo $_SESSION['t2tZip'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tZipError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tPhone"><span class="required">*</span>Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="t2tPhone" name="t2tPhone" class="form_Field125" tabindex="8" autocomplete="off" value="<?php echo $_SESSION['t2tPhone'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tPhoneError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tEmail" id="t2tEmailLabel"><span class="required">*</span>Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="t2tEmail" id="t2tEmail" class="form_Field275" tabindex="9" autocomplete="off" value="<?php echo $_SESSION['t2tEmail'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tConfirmEmail" id="t2tConfirmEmailLabel"><span class="required">*</span>Confirm Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="t2tConfirmEmail" id="t2tConfirmEmail" class="form_Field275" tabindex="10" autocomplete="off" value="<?php echo $_SESSION['t2tEmail'];?>" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="t2tConfirmEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tAmount" id="t2tAmountLabel"><span class="required">*</span>Donation Amount:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($conn,'t2tAmount','t2tAmount',$t2tDonationOptions,'form_Select175','Select an Amount --','null',null,null,$_SESSION['t2tAmount'],11,null,null,null,null,null,null,null,null)?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="t2tAmountError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="t2tHear" id="t2tHearLabel">Where did you hear:<br>about this program?</label></div>
                            <div class="span-7 input">
                                <div class="t2tWrapperLabel">
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tWebRefer" class="t2tReferral" value="web" tabindex="12" <?php echo $webOption;?> />Website</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tNewsRefer" class="t2tReferral" value="news" tabindex="12" <?php echo $newsOption;?> />News/Advertisement</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tGSRefer" class="t2tReferral" value="gs" tabindex="12" <?php echo $gsOption;?> />Girl Scout Troop</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tOther" class="t2tReferral" value="other" tabindex="12" <?php echo $otherOption;?> />Other</label>
                                </div>
                            </div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="t2tReferError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-24" id="t2tTroopWrapper" style="display:none;">
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="t2tReferingTroop" id="t2tReferingTroopLabel"><span class="required">*</span>Referring Troop:</label></div>
                                <div class="span-7 input"><?php echo getSelectList($dbh,'t2tReferringTroop','t2tReferringTroop','sp_getTroopNumbers_List 2015,NULL','form_Select200','Select the referring troop --','troop_number,null,troop_number,null','style="padding:1px 0;"',null,'troop_number:'.$_SESSION['t2tReferringTroop'],13,null,null,null,'tctTroopEdit',null,null,null,null)?></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6" style="margin-top:2px;"><div id="t2tReferringTroopError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="t2tReferringName" id="t2tReferringNameLabel"><span class="required">*</span>Referring Girl Scout:</label></div>
                                <div class="span-7 input"><input type="text" name="t2tReferringName" id="t2tReferringName" class="form_Field200" value="<?php echo $_SESSION["t2tReferringName"];?>" tabindex="14" autocomplete="off" /></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6"><div id="t2tReferringNameError" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                            </div>
                        </div>
                        <div class="container showWhite">
                            <div class="span-24"><p>&nbsp;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="Enter Payment Information" class="button_EnterPaymentInformation marginTop5" title="Enter Payment Information" tabindex="99" style=margin-top:17px;"></div>
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
                <div style="clear:both;">
                    <br><br>
                    <input type="hidden" name="submitDonation" id="submitDonation" value="submitT2TDonation" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="troop2troop" tabindex="-1" placeholder="Form Type" />
                    <input type="hidden" name="referralType" id="referralType" value="<?php echo $_SESSION['t2tRefer'];?>" tabindex="-1" placeholder="Referral Type" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>
        <script src="//code.jquery.com/jquery-latest.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/vendors/jquery.maskMoney.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_TCTValidation.js" type="text/javascript"></script>
    </body>
</html>
