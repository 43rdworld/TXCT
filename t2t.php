<?php
	//header('Location: https://www.texascookietime.org/forms/tct2015/t2t.php');
	error_reporting (E_ALL ^ E_NOTICE);
	header('Content-Type: text/html; charset=utf-8');
	header('X-UA-Compatible: IE=edge,chrome=1');
	header('Cache-Control: max-age=30, must-revalidate');
	ini_set("display_errors", 1);
    $conn = '';
    require("includes/i_T2TSettings.php");
    if($_SERVER['COMPUTERNAME'] == 'RODBY') {
        $connectionVar = 'GSNETX';
    } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {

    }
	require("i_ODBC_Connection.php");								//=	CREATES DATA CONNECTION TO DATABASE
	require("i_ODBC_Functions.php");								//= LOAD FORM FUNCTIONS
	session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
	$formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION

    if(!ISSET($_SESSION['formSecret'])) {
        $_SESSION['formSecret'] = $formSecret;
    }

    if(!ISSET($_SESSION['donorState'])) {
        $donorState = 'TX';
    } else {
        $donorState = $_SESSION['donorState'];
    }
    $t2tDonationOptions =  '1||1 Package = $4.00,2||2 Packages = $8.00,3||3 Packages = $12.00,4||4 Packages = $16.00,5||5 Packages = $20.00,6||6 Packages = $24.00,7||7 Packages = $28.00,8||8 Packages = $32.00,9||9 Packages = $36.00,10||10 Packages = $40.00,11||11 Packages = $44.00,12||12 Packages = $48.00,24||24 Packages = $96.00,48||48 Packages = $192.00,64||64 Packages = $256.00,100||100 Packages = $400.00||';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
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
                            <div class="span-20" style="font-size:1.5em;text-align:left;"><br><br><strong>Send the delicious gift of Girl Scout cookies to military personnel at home and abroad through Project Troop to Troop!</strong><br><br>
                                <div style="font-size:.8em;"><img src="img/t2t_DonateCookies.png" align="right" style="margin:5px 15px 20px 25px;" alt="">Cookies donated through Project Troop to Troop are transported to Fort Hood, the USO, and the American Red Cross.<br><br>
                                Last year over 80,000 packages of cookies were donated to our military personnel, help us donate even more this year! You can even make donations using your credit card; be sure to include troop numbers if you would like a particular troop to receive credit for your donation.<br><br>
                                Donations for Project Troop to Troop will open January 16, 2015.</div>
                                <br><br></div>
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
                                <div class="span-20" style="font-size:1.2em;text-align:center;">Online registration for the 2015 Parent/Guardian Permission & Responsibility Form has closed.</div>
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
                        <div class="container showGrid">

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
                                        <div class="para">The 2014 Project Troop to Troop Cookies will be transported to Fort Hood, the USO, the American Red Cross and ultimately servicemen and servicewomen at home and abroad. Girl Scout Cookies will also reach local Veterans Organizations and wounded soldiers.</div>
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
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <!-- START DONATION INFO BLOCK ---------------------------------------------------------------------------------------------------->
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="donorFName"><span class="required">*</span>First Name: </label></div>
                            <div class="span-7 inputTop"><input type="text" id="donorFName" name="donorFName" class="form_Field200" tabindex="1" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorFNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorLName"><span class="required">*</span>Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="donorLName" name="donorLName" class="form_Field200" tabindex="2" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorLNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>


                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorAddress"><span class="required">*</span>Address: </label></div>
                            <div class="span-7 input"><input type="text" id="donorAddress" name="donorAddress" class="form_Field275" tabindex="3" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorAddressError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"></div>
                            <div class="span-7 input"><input type="text" id="donorAddress2" name="donorAddress2" class="form_Field275" tabindex="4" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorAddress2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorCity"><span class="required">*</span>City: </label></div>
                            <div class="span-7 input"><input type="text" id="donor" name="donorCity" class="form_Field200" tabindex="5" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorCityError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorState" id="donorStateLabel"><span class="required">*</span>State:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($conn,'donorState','donorState','sp_GetStatesList true, null','form_Select150','Select your State --','st_abbr,null,state,null',null,null,'st_abbr:TX',6,null,null,null,null,null,null,null,null)?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="donorStateError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorZip"><span class="required">*</span>Zip Code: </label></div>
                            <div class="span-7 input"><input type="text" id="donorZip" name="donorZip" class="form_Field50" tabindex="26" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorZipError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorPhone"><span class="required">*</span>Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="donorPhone" name="donorPhone" class="form_Field125" tabindex="7" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorPhoneError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorEmail" id="donorEmailLabel"><span class="required">*</span>Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="donorEmail" id="donorEmail" class="form_Field275" value="" tabindex="8" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorEmail2" id="donorEmail2Label"><span class="required">*</span>Confirm Email Address:</label></div>
                            <div class="span-7 input"><input type="text" name="donorEmail2" id="donorEmail2" class="form_Field275" value="" tabindex="9" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="donorEmail2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorAmount" id="donorAmountLabel"><span class="required">*</span>Donation Amount:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($conn,'donorAmount','donorAmount',$t2tDonationOptions,'form_Select175','Select an Amount --','null',null,null,'null',10,null,null,null,null,null,null,null,null)?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="donorAmountError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="donorHear" id="donorHearLabel">Where did you hear:<br>about this program?</label></div>
                            <div class="span-7 input">
                                <div class="t2tWrapperLabel">
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tWebRefer" class="t2tReferral" value="web" tabindex="11" />Website</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tNewsRefer" class="t2tReferral" value="news" tabindex="11" />News/Advertisement</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tGSRefer" class="t2tReferral" value="gs" tabindex="11" />Girl Scout Troop</label>
                                    <label class="t2tRadioLabel"><input type="radio" name="t2tRefer" id="t2tOther" class="t2tReferral" value="other" tabindex="11" />Other</label>
                                </div>
                            </div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6" style="margin-top:2px;"><div id="donorAmountError" class="errorContainer"></div></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-24" id="t2tTroopWrapper" style="display:none;">
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="t2tReferingTroop" id="t2tReferingTroopLabel"><span class="required">*</span>Referring Troop:</label></div>
                                <div class="span-7 input"><?php echo getSelectList($conn,'t2tReferringTroop','t2tReferringTroop','sp_getTCTTroopList_NoSU 2014','form_Select200','Select the referring troop --','troopNum,null,troopNum,null','style="padding:1px 0;"',null,'Troop:null',12,null,null,null,'tctTroopEdit',null,null,null,null)?></div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-6" style="margin-top:2px;"><div id="t2tReferringTroopError" class="errorContainer"></div></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="t2tReferringName" id="t2tReferringNameLabel"><span class="required">*</span>Referring Girl Scout:</label></div>
                                <div class="span-7 input"><input type="text" name="t2tReferringName" id="t2tReferringName" class="form_Field200" value="" tabindex="13" autocomplete="off" /></div>
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
                            <div class="span-24"><p>&#32;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="enterPaymentInformationButton marginTop5" title="Enter Payment Information" tabindex="99"></div>
                            <div class="span-8 textRight"><img src="img/vcss-blue.gif" width="88" height="36" title="Valid CSS" alt="Valid CSS" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/HTML5_Logo.svg" width="35" height="36" title="HTML 5 Powered" alt="HTML 5 Powered" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="img/tc-seal-blue.png" width="72" height="37" title="This site is protected by Trustwave's Trusted Commerce program" alt="This site is protected by Trustwave's Trusted Commerce program" style="cursor:pointer;" onclick="window.open('https://sealserver.trustwave.com/cert.php?customerId=&amp;size=105x54&amp;style=normal&amp;baseURL=ssl.trustwave.com', 'c_TW', 'location=no, toolbar=no, resizable=yes, scrollbars=yes, directories=no, status=no, width=615, height=720'); return false;"></div>
                            <div class="span-3 last"><p>&#32;</p></div>
                            <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br><br><br><br></div>
                        </div>
                            <!-- ## END PAGE 4 ################################################################################################# -->
                        <?php }?>
                    </div>
                    <div class="container">
                        <div id="footerWrapper">
                            <div id="copyRight">&copy; 2014 Girl Scouts of Northeast Texas</div>
                            <div id="socialMedia">
                                <a href="https://twitter.com/GSNETXcouncil" target="_blank"><img src="img/twitter_30_white.png" width="30" height="30" /></a>
                                <a href="https://www.facebook.com/GSNETX?ref=ts" target="_blank"><img src="img/facebook_30_white.png" width="30" height="30" /></a>
                                <a href="https://www.youtube.com/channel/UC4uxrvCdVYkGzLZdocf1aHQ" target="_blank"><img src="img/youtube_30_white.png" width="30" height="30" /></a>
                                <a href="http://instagram.com/gsnetxcouncil" target="_blank"><img src="img/instagram_30_white.png" width="30" height="30" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ############################################################################################################### -->
                <div style="clear:both;">
                    <br><br>
                    <input type="hidden" name="submitDonation" id="submitDonation" value="submitT2TDonation" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="troop2troop" tabindex="-1" placeholder="Form Type" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>
    </body>




</html>
