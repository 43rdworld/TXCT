<?php
    // form source from http://bassistance.de/
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    $conn = '';

    if($_SERVER['COMPUTERNAME'] == 'RODBY') {
        $connectionVar = 'GSNETX';
    } else if ($_SERVER['COMPUTERNAME'] == 'V-WWW04-WEBER') {

    }
    require("i_ODBC_Connection.php");								//=	CREATES DATA CONNECTION TO DATABASE
    require("i_ODBC_Functions.php");								//= LOAD FORM FUNCTIONS
    require("includes/i_OFRSettings.php");
    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION

//    if(!ISSET($_SESSION['formSecret'])) {
//        $_SESSION['formSecret'] = $formSecret;
//    }
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Outstanding Funds Reporting Form</title>
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
        <script src="js/i_parentPermissionValidation.js" type="text/javascript"></script>
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
            <form name="theForm" id="theForm" method="post" action="parentPermissionConfirm.php" autocomplete="off">
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
                        <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>We know you can't wait to get started but we're putting in new carpet and a coat of paint to spruce things up.<br><br>The Outstanding Funds Report form will be available February 23<sup>rd</sup>, 2015.<br><br><br></div>
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
                            <!--<div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online registration for the 2015 Parent/Guardian Permission & Responsibility Form has closed.<br><br><br></div> -->
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Our apologies - we are experiencing technical difficulties with the Parent Permission form.<br><br>Thank you for your patience as we work to get functionality restored.<br><br><br></div>
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
                            <div class="span-24" style="margin-bottom:500px;border-bottom:1px solid #666;"></div>
                        </div>
                    <?php } else { ?>
                        <div class="container showWhite">
                            <div class="span-24"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Parent/Guardian Permission and Responsibility Form</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" id="eventIntro">
                                <div>
                                    <div class="eventIntroLg">This form must be completed for your Girl Scout to participate in the 2014-2015 Girl Scouts of Northeast Texas Cookie Program.</div>
                                    <div class="eventIntroRequired">Questions with a red asterisk must be completed in order to complete the nomination.</div>
                                </div>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/registrationInfoHeader_Sm.png" width="350" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
							<!-- START CONTACT INFO BLOCK ============================================================================================================== -->
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="permGirlFName"><span class="required">*</span>Girl First Name: </label></div>
                            <div class="span-7 inputTop"><input type="text" id="permGirlFName" name="permGirlFName" class="form_Field200" tabindex="1" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permGirlFNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permGirlLName"><span class="required">*</span>Girl Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="permGirlLName" name="permGirlLName" class="form_Field200" tabindex="2" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permGirlLNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permGSTroop" id="permGSTroopLabel"><span class="required">*</span>Troop Number:</label></div>
                            <div class="span-7 input"><input type="text" id="permGSTroop" name="permGSTroop" class="form_Field50" tabindex="3" autocomplete="off" maxlength="5" />&nbsp;&nbsp;<span class="formNote">(5 character maximum)</span></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-7"><div id="permGSTroopError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permSU" id="permSULabel">GS Service Unit:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($conn,'permSU','permSU','sp_GetCookieServiceUnitList','form_Select300','Select your ServiceUnit --','suNum,null,suNum,suCity','style="padding:3px 4px;border:1px solid #999;"',null,'id:null',4,null,null,null,null,null,null,null,null,null);?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permSUError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer" style="margin-top:10px;">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 formNotice">Please enter the package Grand Total from your Girl Scout’s Goal Worksheet (from the Family Guide) in the space below. This is her initial cookie order that she will be able to sell beginning January 16, 2015.<div style="margin:5px 0;">She can earn her first Cookie Program patch when this information is sent to your Troop Cookie Manager by December 1, 2014. Remember, you do not need to order by flavor!</div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permPackages" id="permSULabel">Packages Ordered:</label></div>
                            <div class="span-7 input"><input type="text" name="permPackages" id="permPackages" class="form_Field50" value="" tabindex="5" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permPackagesError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-16"><div style="margin:12px 100px 8px 100px;border-top:2px dashed #666;height:1px;">&#32;</div></div>
                            <div class="span-4 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 emailNotice">A copy of this completed form will be sent to each email address entered below. If you do not know your GS Troop Leader or GS Troop Cookie Manager’s email address, you must print and give them a completed copy of this form. </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permMyEmail" id="permMyEmailLabel"><span class="required">*</span>My Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permMyEmail" id="permMyEmail" class="form_Field275" value="" tabindex="6" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permMyEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permMyEmail2" id="permMyEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permMyEmail2" id="permMyEmail2" class="form_Field275" value="" tabindex="7" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permMyEmail2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-8"><p>&#32;</p></div>
                            <div class="span-5"><div style="margin:5px 0 0 0;border-top:2px dotted #666;height:1px;">&#32;</div></div>
                            <div class="span-11 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-7"><p>&#32;</p></div>
                            <div class="span-12"><label for="permLeaderSame"><input type="checkbox" name="permLeaderSame" id="permLeaderSame" value="1" tabindex="8">&#160;&#160;&#160;I also serve as Troop Leader for the troop.</label></div>
                            <div class="span-5 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permLeadEmail" id="permLeadEmailLabel"><span class="required">*</span>Troop Leader Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permLeadEmail" id="permLeadEmail" class="form_Field275" value="" tabindex="9" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permLeadEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permLeadEmail2" id="permLeadEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permLeadEmail2" id="permLeadEmail2" class="form_Field275" value="" tabindex="10" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permLeadEmail2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-8"><p>&#32;</p></div>
                            <div class="span-5"><div style="margin:5px 0 0 0;border-top:2px dotted #666;height:1px;">&#32;</div></div>
                            <div class="span-11 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-7"><p>&#32;</p></div>
                            <div class="span-12"><label for="permTCMSame"><input type="checkbox" name="permTCMSame" id="permTCMSame" value="1" tabindex="11">&#160;&#160;&#160;The Troop Leader also serves as Cookie Manager for the troop.</label></div>
                            <div class="span-5 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permTCMEmail" id="permTCMEmailLabel"><span class="required">*</span>Cookie Manager Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permTCMEmail" id="permTCMEmail" class="form_Field275" value="" tabindex="12" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permTCMEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permTCMEmail2" id="permTCMEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                            <div class="span-7 input"><input type="text" name="permTCMEmail2" id="permTCMEmail2" class="form_Field275" value="" tabindex="13" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="permTCMEmail2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <!-- ACKNOWLEDGEMENTS AND RESPONSIBILITIES SECTION ========================================================================================= -->
                            <div class="span-24 marginTop15">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection"><img src="img/parentResponsibilityHeader_Sm.png" width="350" height="21" style="border:none;" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                            <div class="span-3"><p>&#32;</p></div>
                            <div class="span-18">Please enter your initials in the boxes below, confirming you agree to all responsibilities. <div style="font-size:.9em;margin-top:5px;color:#c00;">All boxes must be initialed &mdash; 4 letters max.</div></div>
                            <div class="span-3 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="perm1" id="perm1" class="form_Field50 padding2 textCenter" tabindex="14" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9"><div class="t1a"><label for="perm1" class="labelNormal">I agree to accept <span class="boldUnderline">full</span> financial responsibility for all cookies and money my Girl Scout receives.</label></div></div>
                            <div class="span-6"><div id="perm1Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="perm2" id="perm2" class="form_Field50 padding2 textCenter" tabindex="15" autocomplete="off" maxlength="4" style="vertical-align:top;" /></div>
                            <div class="span-9">
                                <div class="t1a">
                                    <label for="perm2" class="labelNormal">I will see that:</label>
                                    <ul class="permissionList">
                                        <li>My Girl Scout has adult guidance at all times</li>
                                        <li>No cookie orders are taken prior to the official starting date of January 16, 2015</li>
                                        <li>Payment for cookies is not collected prior to delivery to customers; and cookies are not paid for on the internet.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="span-6"><div id="perm2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="perm3" id="perm3" class="form_Field50 padding2 textCenter" tabindex="16" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9"><div class="t1a"><label for="perm3" class="labelNormal">I understand that payments for the cookies need to be made as set by my Troop Leader and Troop Cookie Manager/Leader with the final payment made balance by the end of the Cookie Program or an Outstanding Funds Report will be completed for the balance due amount outstanding and Girl Scouts of Northeast Texas will take collection action.</label></div></div>
                            <div class="span-6"><div id="perm3Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="perm4" id="perm4" class="form_Field50 padding2 textCenter" tabindex="17" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9"><div class="t1a"><label for="perm4" class="labelNormal">I understand that all cookies ordered by my Girl Scout are considered sold and may not be returned.</label></div></div>
                            <div class="span-6"><div id="perm4Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="perm5" id="perm5" class="form_Field50 padding2 textCenter" tabindex="18" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9"><div class="t1a"><label for="perm5" class="labelNormal">I understand girl reward items are ordered only for eligible girls whose full balance is paid by the end of the program. I understand if money is not received on time, my Girl Scout <span class="boldUnderline">will not</span> receive reward items.</label></div></div>
                            <div class="span-6"><div id="perm5Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-24 marginTop10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection"><img src="img/cookieClub_InfoHeader_Sm.png" width="350" height="21" style="border:none;" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20">
                                <div class="eventIntroCopy">The Cookie Club is an online tool available to girls! This password protected website features tips like how to set and track goals. The Club allows customers to submit their requests for cookies, and your daughter’s account will save their contact information. All you have to do is continue with in-person delivery and collect payment! Please enter your initials in the boxes below to agree to all responsibilities.</div>
                                <div class="eventIntroCopy" style="margin-bottom:10px;font-weight:bold;"><span class="required">*</span>To use Cookie Club, a Girl Scout’s parent/guardian must complete the following questions.</div>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- COOKIE CLUB PARTICIPATION SECTION ===================================================================================================== -->
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-11"><label class="radioLabel"><input type="radio" name="permCClub" id="permCClubYes" class="permCClub" value="1" tabindex="19" />&#160;&#160;&#160;Yes, I want my daughter to participate in Cookie Club</label></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-6"><div id="permCClubError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div  class="span-24" id="ccClubAcknowledgements" style="display:none;">
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><input type="text" name="permCC1" id="permCC1" class="form_Field50 padding2 textCenter" tabindex="20" autocomplete="off" maxlength="4" /></div>
                                <div class="span-9"><div class="t1b"><label for="permCC1" class="labelNormal">I understand that online payment for cookies is not allowed.</label></div></div>
                                <div class="span-6"><div id="permCC1Error" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><input type="text" name="permCC2" id="permCC2" class="form_Field50 padding2 textCenter" tabindex="21" autocomplete="off" maxlength="4" /></div>
                                <div class="span-9"><div class="t1b"><label for="permCC2" class="labelNormal">I understand that it is my responsibility to review my Girl Scout’s Cookie Club “promises” to ensure they are genuine orders from customers.</label></div></div>
                                <div class="span-6"><div id="permCC2Error" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><input type="text" name="permCC3" id="permCC3" class="form_Field50 padding2 textCenter" tabindex="22" autocomplete="off" maxlength="4" /></div>
                                <div class="span-9"><div class="t1b"><label for="permCC3" class="labelNormal">I understand that my Girl Scout&#39;s personal email information should not be provided to the customer.</label></div></div>
                                <div class="span-6"><div id="permCC3Error" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><input type="text" name="permCC4" id="permCC4" class="form_Field50 padding2 textCenter" tabindex="23" autocomplete="off" maxlength="4" /></div>
                                <div class="span-9"><div class="t1b"><label for="permCC4" class="labelNormal">I support my Girl Scout in using the Cookie Club online goal-setting and email tools through Cookie Club.</label></div></div>
                                <div class="span-6"><div id="permCC4Error" class="errorContainer"></div></div>
                                <div class="span-2 last">&#32;</div>
                            </div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-11"><label class="radioLabel"><input type="radio" name="permCClub" id="permCClubNo" class="permCClub" value="0" tabindex="24" />&#160;&#160;&#160;No, I don't want my daughter to participate in Cookie Club this year.</label></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-6">&#32;</div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- ACKNOWLEDGEMENTS AND RESPONSIBILITIES SECTION ========================================================================================= -->
                            <div class="span-24 marginTop10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection"><img src="img/contactInformationHeader_Sm.png" width="350" height="21" style="border:none;" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                             <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20">
                                <div class="eventIntroCopy">ALL communication, including invitations to top seller events, will be sent to the email address in the GSNETX membership database.</div>
                                <div class="eventIntroCopy" style="margin-bottom:20px;">Please enter your current information below & to ensure your Girl Scout’s information is correct with GSNETX, go to <a href="http://www.gsnetx.org" target="_blank">www.gsnetx.org</a> & click on My GS (in the menu line—top right corner) to login to update your personal information.</div>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="permParentFName"><span class="required">*</span>Parent/Guardian First Name: </label></div>
                            <div class="span-9 inputTop"><input type="text" id="permParentFName" name="permParentFName" class="form_Field200" tabindex="25" autocomplete="off" /></div>
                            <div class="span-6"><div id="permParentFNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permParentLName"><span class="required">*</span>Parent/Guardian Last Name: </label></div>
                            <div class="span-9 input"><input type="text" id="permParentLName" name="permParentLName" class="form_Field200" tabindex="26" autocomplete="off" /></div>
                            <div class="span-7"><div id="permParentLNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                             <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permIDType" ><span class="required">*</span>Identification Type: </label></div>
                            <div class="span-9 input">
                                <select name="permIDType" ID="permIDType" class="form_Select200" tabindex="27" style="border:1px solid #bbb;">
                                    <option value="">- Select an ID type --</option>
                                    <option value="Driver's license">Driver&#39;s license #</option>
                                    <option value="State issued ID">State issued ID #</option>
                                </select>&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="span-7"><div id="permIDTypeError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permID"><span class="required">*</span>Identification Number: </label></div>
                            <div class="span-9 input"><input type="text" id="permID" name="permID" class="form_Field200" tabindex="28" autocomplete="off" /></div>
                            <div class="span-7"><div id="permIDError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permHomeAddress"><span class="required">*</span>Home Address: </label></div>
                            <div class="span-9 input"><input type="text" id="permHomeAddress" name="permHomeAddress" class="form_Field275" tabindex="29" autocomplete="off" /></div>
                            <div class="span-7"><div id="permHomeAddressError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permCity"><span class="required">*</span>City: </label></div>
                            <div class="span-9 input"><input type="text" id="permCity" name="permCity" class="form_Field200" tabindex="30" autocomplete="off" /></div>
                            <div class="span-7"><div id="permCityError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permZip"><span class="required">*</span>Zip Code: </label></div>
                            <div class="span-9 input"><input type="text" id="permZip" name="permZip" class="form_Field50" tabindex="31" autocomplete="off" /></div>
                            <div class="span-7"><div id="permZipError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permHomePhone"><span class="required">*</span>Home Phone: </label></div>
                            <div class="span-9 input"><input type="text" id="permHomePhone" name="permHomePhone" class="form_Field125" tabindex="32" autocomplete="off" /></div>
                            <div class="span-7"><div id="permHomePhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permCellPhone">Cell Phone: </label></div>
                            <div class="span-9 input"><input type="text" id="permCellPhone" name="permCellPhone" class="form_Field125" tabindex="33" autocomplete="off" /></div>
                            <div class="span-7"><div id="permCellPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                           <!-- CASH OPTION SECTION =================================================================================================================== -->
                            <div class="span-24 marginTop10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection"><img src="img/cashOptionHeader_Sm.png" width="350" height="21" style="border:none;" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 eventIntroCopy"> <strong>OPTIONAL:&#160;&#160;</strong>For members of Cadette, Senior and Ambassador Troops taking the cash option, please select below:</div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-17"><div style="float:left;margin:0 10px 30px 0;"><input type="checkbox" name="permOption" id="permOption" tabindex="34" value="1" /></div><label class="radioLabel" for="permOption">My GS Troop has elected to receive an increased per package profit in place of individual troop members receiving recognition items. Girl Scouts will receive earned Cookie Program patches.</label></div>
                            <div class="span-3 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div  class="span-24" id="pglWrapper" style="display:none;">
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="permGradLevel" id="permGradLevelLabel"><span class="required">*</span>Program Grade Level: </label></div>
                                <div class="span-9 input">
                                    <select name="permGradLevel" id="permGradLevel" class="form_Select300" tabindex="35">
                                        <option value="">- Select Program Grade Level --</option>
                                        <option value="Cadette">Cadette Girl Scouts: 6th grade- 8th grade</option>
                                        <option value="Senior">Senior Girl Scouts: 9th grade-10th grade</option>
                                        <option value="Ambassador">Ambassador Girl Scouts: 11th grade-12th grade</option>
                                    </select>
                                </div>
                                <div class="span-7"><div id="permGradLevelError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                            </div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                           <!-- ACKNOWLEDGEMENTS AND RESPONSIBILITIES SECTION ========================================================================================= -->
                            <div class="span-24 marginTop10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection"><img src="img/acknowledgementsHeader_Sm.png" width="400" height="21" style="border:none;" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20">
                                <div class="eventIntroCopy_Alert">You must enter your name acknowledging that you have read, understand and agree to all terms and conditions outlined herein.</div>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permSignedName"><span class="required">*</span>Full Name: </label></div>
                            <div class="span-9 input"><input type="text" name="permSignedName" id="permSignedName" class="form_Field275" tabindex="36" autocomplete="off"></div>
                            <div class="span-7"><div id="permSignedNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                        </div>
                        <div class="container showWhite">
                            <div class="span-24"><p>&nbsp;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24"><p>&#32;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="submitRegistrationButton marginTop5" title="Submit Registration Information" tabindex="99"></div>
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
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitParentGuardianRegistration" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="formType" id="formType" value="permission" tabindex="-1" placeholder="Form Type" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
        </div>
    </body>
</html>
