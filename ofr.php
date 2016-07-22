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
    setRegistrationParams('03/04/2016','03/01/2017');
?>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Texas Cookie Time Outstanding Funds Report Form</title>
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="icon" href="favicon.png" sizes="32x32">
	<link rel="icon" href="favicon.ico" sizes="32x32">
    <link href="css/txct.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="js/vendors/modernizr.js"></script>
</head>
 	<body class="oneColFixCtr" onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theOFRForm" id="theOFRForm" method="post" action="ofrConfirm.php" autocomplete="off">
                <div class="no_js">
                    <div class="container showWhite" style="position:relative;">
                        <div class="span-24" style="height:100px;">&nbsp;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20 noscriptNotice" style="text-align:center;"><a href="http://enable-javascript.com/" target="_blank"><img src="img/javascriptDisabled.png" width="500" height="100" alt="How to enable javascript on your browser" /></a></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="height:500px;">&nbsp;</div>
                        <div class="span-24"><br></div>
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
                            <div class="span-20 closeButNoCigar"><div>Almost ready - please be patient a little while longer.<br>The Outstanding Funds Report form will go live Friday, March 4<sup>th</sup>.</div><br></div>
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
                            <div class="span-24" style="margin-bottom:200px;border-bottom:1px solid #fff;"></div>
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
                            <div class="span-20" style="font-size:1.5em;text-align:center;"><br><br><br><div style="width:450px;margin:0 auto;">The Online Outstanding Funds Report Form has closed for the 2015-16 Season</div>
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
                            <div class="span-24" style="margin-bottom:200px;border-bottom:1px solid #fff;"></div>
                        </div>
                    <?php } else { ?>
                        <div class="container showWhite">
                            <div class="span-24" style="margin-bottom:5px;"><img src="img/hdr_ACHPayment.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Outstanding Funds Report</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" id="eventIntro">
                                <div>
                                    <div class="eventIntroLg">
                                        If you have an individual who has not paid for the cookies they received, you must complete an Outstanding Funds Report.
                                        <div class="para">An Individual Outstanding Funds Report must be completed for each individual who has not paid in full. </div>
                                        <div class="para">To report outstanding funds, you will need to complete all information as directed on the report including your record of all contact/communication regarding the debt. i.e. phone calls, emails, text messages, etc.</div>
                                        <div class="para">Troop Cookie Managers/Service Unit Cookie Managers cannot file OFRs on themselves.</div>
                                        <div class="para">Troop Cookie Managers are relieved of financial responsibility once the OFR is filed on each girl that owes money.</div>
                                        <div class="ofr_FormAnnouncement infoIcon" style="height:50px;">Deposits made to clear outstanding funds must be received by Girl Scouts of Northeast Texas before <span style="text-decoration:underline;">May 6th, 2016</span>  to avoid collection action.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_ACHTroopSU_Select.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="achTroopNum" id="achTroopNumLabel"><span class="required">*</span>Troop Number:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($dbh,'ofrTroopNum','ofrTroopNum','sp_GetTroopNumbers_List 2015,null','form_Select200','Select your Troop Number --','troop_number,null,troop_number,null','style="padding:3px 4px;border:1px solid #999;"','onchange="getTCTServiceUnit(\'getTCTSU_ACH.php?troopNum=\'+this.value,\'innerHTML\',\'serviceUnitDiv\');"','id:null',1,null,null,null,null,null,null,null,null,null);?></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrTroopNumError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- *********************************************************************** -->
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="permSU" id="achSULabel"><span class="required">*</span>Service Unit:</label></div>
                            <div class="span-7 input" id="serviceUnitDiv">
                                <select class"form_Select300" name="permSU" id="permSU" tabIndex="2" style="width:300px;"><option value="">Select your Service Unit --</option></select>
                                <?php //echo getSelectList($dbh,'volSU','volSU','sp_GetTCTServiceUnit_List 2015,null','form_Select300','Select your Service Unit --','su_Number,null,su_Number,su_AreaNames','style="padding:3px 4px;border:1px solid #999;"',null,'id:null',9,null,null,null,null,null,null,null,null,null);?>
                            </div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="permSUError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer" style="margin-top:10px;">&#32;</div>
                            <div class="span-6"><p>&#32;</p></div>
                            <div class="span-12"><div class="dottedDivider"><p>&#32;</p></div></div>
                            <div class="span-6 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_ACHTroopLeaderInformation.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <!-- TROOP LEADER INFO BLOCK ---------------------------------------------------------------------------------------------------->
                            <div class="span-24 marginTop15">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="troopLeaderFName" id="troopLeaderFNameLabel"><span class="required">*</span>Troop Leader First Name: </label></div>
                            <div class="span-7 inputTop"><input type="text" id="troopLeaderFName" name="troopLeaderFName" class="form_Field200" tabindex="3" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderFNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderLName" id="troopLeaderLNameLabel"><span class="required">*</span>Troop Leader Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="troopLeaderLName" name="troopLeaderLName" class="form_Field200" tabindex="4" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderLNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderEmail" id="troopLeaderEmailLabel"><span class="required">*</span>Troop Leader Email:</label></div>
                            <div class="span-7 input"><input type="text" name="troopLeaderEmail" id="troopLeaderEmail" class="form_Field275" value="" tabindex="5" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderEmailError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderEmail2" id="troopLeaderEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                            <div class="span-7 input"><input type="text" name="troopLeaderEmail2" id="troopLeaderEmail2" class="form_Field275" value="" tabindex="6" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderEmail2Error" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderAddress"><span class="required">*</span>Address: </label></div>
                            <div class="span-7 input"><input type="text" id="troopLeaderAddress" name="troopLeaderAddress" class="form_Field275" tabindex="7" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderAddressError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderCity"><span class="required">*</span>City: </label></div>
                            <div class="span-7 input"><input type="text" id="troopLeaderCity" name="troopLeaderCity" class="form_Field200" tabindex="8" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderCityError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderZip"><span class="required">*</span>Zip Code: </label></div>
                            <div class="span-7 input"><input type="text" id="troopLeaderZip" name="troopLeaderZip" class="form_Field50" tabindex="9" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderZipError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="troopLeaderPhone"><span class="required">*</span>Contact Number: </label></div>
                            <div class="span-7 input"><input type="text" id="troopLeaderPhone" name="troopLeaderPhone" class="form_Field125" tabindex="10" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="troopLeaderPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-5" style="height:2px;"><div>&#32;</div></div>
                            <div class="span-8 dashedDivider" style="height:2px;"><div>&#32;</div></div>
                            <div class="span-4" style="height:2px;"><div>&#32;</div></div>
                            <div class="span-2 last" style="height:2px;"><div>&#32;</div></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-1 textCenter"><input type="checkbox" id="ofrSame" name="ofrSame" value="1" tabindex="13" /></div>
                            <div class="span-14"><label for ="ofrSame">The Troop Leader and TCM are the same.</label></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-5 textRight input"><label for="troopLeaderPhone"><span class="required">*</span>Phone: </label></div>-->
                            <!--<div class="span-7 input"><input type="text" id="troopLeaderPhone" name="troopLeaderPhone" class="form_Field125" tabindex="10" autocomplete="off" value="" /></div>-->
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-6"><div id="troopLeaderPhoneError" class="errorContainer"></div></div>-->
                            <!--<div class="span-2 last">&#32;</div>-->
                            <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-5 textRight input"><label for="">Work Phone: </label></div>-->
                            <!--<div class="span-7 input"><input type="text" id="troopLeaderWorkPhone" name="troopLeaderWorkPhone" class="form_Field125" tabindex="11" autocomplete="off" value="" /></div>-->
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-6"><div id="troopLeaderWorkPhoneError" class="errorContainer"></div></div>-->
                            <!--<div class="span-2 last">&#32;</div>-->
                            <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-5 textRight input"><label for="troopLeaderCellPhone">Cell Phone: </label></div>-->
                            <!--<div class="span-7 input"><input type="text" id="troopLeaderCellPhone" name="troopLeaderCellPhone" class="form_Field125" tabindex="12" autocomplete="off" value="" /></div>-->
                            <!--<div class="span-2"><p>&#32;</p></div>-->
                            <!--<div class="span-6"><div id="troopLeaderCellPhoneError" class="errorContainer"></div></div>-->
                            <!--<div class="span-2 last">&#32;</div>-->
                            <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                        <!-- TCM INFO BLOCK ------------------------------------------------------------------------------------------------------------->
                            <div id="ofrTCMInfo_Wrapper">
                                <div class="span-24 marginTop15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_ACHTCMInformation.png" width="400" height="21" alt="" /></div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                                <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                                <div class="span-24">&#32;</div>
                                <div class="span-24 marginTop15">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight inputTop"><label for="tcmFName" id="tcmFNameLabel"><span class="required">*</span>TCM First Name: </label></div>
                                <div class="span-7 inputTop"><input type="text" id="tcmFName" name="tcmFName" class="form_Field200" tabindex="14" autocomplete="off" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmFNameError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmLName" id="tcmLNameLabel"><span class="required">*</span>TCM Last Name: </label></div>
                                <div class="span-7 input"><input type="text" id="tcmLName" name="tcmLName" class="form_Field200" tabindex="15" autocomplete="off" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmLNameError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmEmail" id="tcmEmailLabel"><span class="required">*</span>TCM Email:</label></div>
                                <div class="span-7 input"><input type="text" name="tcmEmail" id="tcmEmail" class="form_Field275" value="" tabindex="16" autocomplete="off" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmEmailError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmEmail2" id="tcmEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                                <div class="span-7 input"><input type="text" name="tcmEmail2" id="tcmEmail2" class="form_Field275" value="" tabindex="17" autocomplete="off" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmEmail2Error" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmAddress"><span class="required">*</span>Address: </label></div>
                                <div class="span-7 input"><input type="text" id="tcmAddress" name="tcmAddress" class="form_Field275" tabindex="18" autocomplete="off" value="" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmAddressError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmCity"><span class="required">*</span>City: </label></div>
                                <div class="span-7 input"><input type="text" id="tcmCity" name="tcmCity" class="form_Field200" tabindex="19" autocomplete="off" value="" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmCityError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmZip"><span class="required">*</span>Zip Code: </label></div>
                                <div class="span-7 input"><input type="text" id="tcmZip" name="tcmZip" class="form_Field50" tabindex="20" autocomplete="off" value="" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmZipError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-5 textRight input"><label for="tcmPhone"><span class="required">*</span>Contact Number: </label></div>
                                <div class="span-7 input"><input type="text" id="tcmPhone" name="tcmPhone" class="form_Field125" tabindex="21" autocomplete="off" value="" /></div>
                                <div class="span-1"><p>&#32;</p></div>
                                <div class="span-8"><div id="tcmPhoneError" class="errorContainer"></div></div>
                                <div class="span-1 last">&#32;</div>
                                <div class="span-24 formFieldSpacer">&#32;</div>
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight input"><label for="tcmPhone"><span class="required">*</span>Phone: </label></div>-->
                                <!--<div class="span-7 input"><input type="text" id="tcmPhone" name="tcmPhone" class="form_Field125" tabindex="21" autocomplete="off" value="" /></div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-6"><div id="tcmPhoneError" class="errorContainer"></div></div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight input"><label for="tcmWorkPhone">Work Phone: </label></div>-->
                                <!--<div class="span-7 input"><input type="text" id="tcmWorkPhone" name="tcmWorkPhone" class="form_Field125" tabindex="22" autocomplete="off" value="" /></div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-6"><div id="tcmWorkPhoneError" class="errorContainer"></div></div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-5 textRight input"><label for="tcmCellPhone">Cell Phone: </label></div>-->
                                <!--<div class="span-7 input"><input type="text" id="tcmCellPhone" name="tcmCellPhone" class="form_Field125" tabindex="23" autocomplete="off" value="" /></div>-->
                                <!--<div class="span-2"><p>&#32;</p></div>-->
                                <!--<div class="span-6"><div id="tcmCellPhoneError" class="errorContainer"></div></div>-->
                                <!--<div class="span-2 last">&#32;</div>-->
                                <!--<div class="span-24 formFieldSpacer">&#32;</div>-->
                            </div>
                        <!-- INDIVIDUAL DELINQUENCY BLOCK -------------------------------------------------------------------------------------------------------------------->
                            <div class="span-24 formFieldSpacer" style="margin-top:10px;">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_OFRIndividualDelinquency.png" width="400" height="24" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 ofr_FormAnnouncement infoIcon" style="padding-top:12px;height:36px;">To be completed by the Troop Cookie Manager - one individual per form.</div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="girlFName" id="girlFNameLabel"><span class="required">*</span>Girl First Name: </label></div>
                            <div class="span-7 input"><input type="text" id="girlFName" name="girlFName" class="form_Field200" tabindex="25" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="girlFNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="girlLName" id="girlLNameLabel"><span class="required">*</span>Girl Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="girlLName" name="girlLName" class="form_Field200" tabindex="26" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="girlLNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianFName" id="parentGuardianFNameLabel"><span class="required">*</span>Parent/Guardian First Name:</label></div>
                            <div class="span-7 input"><input type="text" name="parentGuardianFName" id="parentGuardianFName" class="form_Field200" value="" tabindex="27" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianFNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianLName" id="parentGuardianLNameLabel"><span class="required">*</span>Parent/Guardian Last Name:</label></div>
                            <div class="span-7 input"><input type="text" name="parentGuardianLName" id="parentGuardianLName" class="form_Field200" value="" tabindex="28" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianLNameError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianEmail"><span class="required">*</span>Parent/Guardian Email: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianEmail" name="parentGuardianEmail" class="form_Field275" tabindex="29" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianEmailError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianEmail2"><span class="required">*</span>Confirm Email: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianEmail2" name="parentGuardianEmail2" class="form_Field275" tabindex="30" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianEmail2Error" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianAddress"><span class="required">*</span>Address: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianAddress" name="parentGuardianAddress" class="form_Field275" tabindex="31" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianAddressError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianCity"><span class="required">*</span>City: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianCity" name="parentGuardianCity" class="form_Field200" tabindex="32" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianCityError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianZip"><span class="required">*</span>Zip Code: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianZip" name="parentGuardianZip" class="form_Field50" tabindex="33" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianZipError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianPhone"><span class="required">*</span>Home Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianPhone" name="parentGuardianPhone" class="form_Field125" tabindex="34" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianWorkPhone">Work Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianWorkPhone" name="parentGuardianWorkPhone" class="form_Field125" tabindex="35" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianWorkPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="parentGuardianCellPhone">Cell Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="parentGuardianCellPhone" name="parentGuardianCellPhone" class="form_Field125" tabindex="36" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="parentGuardianCellPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                        <!-- REPORT INFORMATION BLOCK ------------------------------------------------------------------------------------------------------------------------>
                            <div class="span-24 marginTop15">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_OFRReportInformation.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 ofr_ReportNotification">
                                <div style="margin-bottom:8px;">If the troop has collected enough money to cover their entire profit, the council will assume that money owed from the girl equals total cookie package cost with no refund owed to the troop.</div>
                                <div>If the troop has not collected enough money to cover their profit, the troop will receive the amount owed in profit directly from the council once the outstanding amount has been paid in full for the total amount owed council.</div>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24">&#32;</div>
                            <div class="span-3"><p>&#32;</p></div>
                            <div class="span-16 dashedDivider">&nbsp;</div>
                            <div class="span-3 last"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="ofrSubmitter" id="ofrSubmitterLabel"><span class="required">*</span>Person Completing Report:</label></div>
                            <div class="span-7 input"><input type="text" name="ofrSubmitter" id="ofrSubmitter" class="form_Field275" value="" tabindex="37" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrSubmitterError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="ofrPhone"><span class="required">*</span>Phone: </label></div>
                            <div class="span-7 input"><input type="text" id="ofrPhone" name="ofrPhone" class="form_Field125" tabindex="38" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrPhoneError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="ofrComment" id="ofrCommentLabel"><span class="required">*</span>Briefly state why the cookie bill was not paid in full:</label></div>
                            <div class="span-7 input"><textarea name="ofrComment" id="ofrComment" cols="2" rows="2" class="form_TextArea275_150" tabindex="39"></textarea></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrCommentError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="ofrAmountOwed" id="ofrAmountOwedLabel"><span class="required">*</span>Amount Owed Council:</label></div>
                            <div class="span-7 input"><input type="text" name="ofrAmountOwed" id="ofrAmountOwed" class="ofrAmount form_Field150" value="" tabindex="40" autocomplete="off" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrAmountOwedError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="ofrAmountPaid"><span class="required">*</span>Amount Paid to Council: </label></div>
                            <div class="span-7 input"><input type="text" id="ofrAmountPaid" name="ofrAmountPaid" class="ofrAmount form_Field150" tabindex="41" autocomplete="off" value="" /></div>
                            <div class="span-1"><p>&#32;</p></div>
                            <div class="span-8"><div id="ofrAmountPaidError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-3"><p>&#32;</p></div>
                            <div class="span-16 dashedDivider">&nbsp;</div>
                            <div class="span-3 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label style="font-size:1.2em;">Balance Due Council: </label></div>
                            <div class="span-7 input"><div id="sum" name="sum" class="ofrBalanceDue" style="float:left;">$0.00</div></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="ofrBalanceDueError" class="errorContainer"></div></div>
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
                            <div class="span-12"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="button_SubmitOFRReport marginTop5" title="Submit OFR Report Information" tabindex="99" onclick=" return confirm('Are you sure you want to submit an OFR Report\nfor the amount of '+$('#sum').html()+'?');"></div>
                            <div class="span-8 textRight"><?php include('i_securityVendorTrustwave.php');?></div>
                            <div class="span-3 last"><p>&#32;</p></div>
                            <div class="span-24"><br><br></div>
                        </div>
                    <?php }?>
                </div>
                <div class="container showWhite" style="clear:both;">
                    <input type="hidden" name="submitOFR" id="submitOFR" value="submitOFRReport" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="ofrBalanceDueTemp" id="ofrBalanceDueTemp" value="" tabindex="-1" placeholder="OFR Balance Due Temp" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#32;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
                </div>
            </form>
            <?php include('i_cookieFooter.php');?>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/vendors/jquery.maskMoney.js"></script>
        <script src="js/vendors/jquery.tooltipster.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_ofrValidation.js" type="text/javascript"></script>
    </body>
</html>

<!--		<div id="outerWrapper">-->
<!--			<div><img src="images/gsnetxLogo.png" width="255" height="115" alt="Girl Scouts of Northeast Texas Homepage" border="0" id="logo" /></div>-->
<!--	    	<div class="contentWrapper">-->
<!--				<div id="navWrapper"><script type="text/javascript" src="scripts/menu_data.js"></script></div>-->
<!--	    	    <div id="innerWrapper">-->
<!--        			<img src="images/hdr_OFR.jpg" width="968" height="167" alt="" />-->
<!--                    <div id="formWrapper">-->
<!--						<h1>Outstanding Funds Report</h1>-->
<!--    	                <div id="innerFormWrapper">-->
<!---->
<!--                            <div class="achPara">If you have an individual who has not paid for the cookies they received, you must complete an Outstanding Funds Report.</div>-->
<!--                            <div class="achPara">An Individual Outstanding Funds Report must be completed for each individual who has not paid in full. </div>-->
<!--							<div class="achPara">To report outstanding funds, you will need to complete all information as directed on the report including your record of all contact/communication regarding the debt. i.e. phone calls, emails, text messages, etc.</div>-->
<!--							<div class="achPara" style="color:#900;">Deposits made to clear outstanding funds must be received by Girl Scouts of Northeast Texas <span style="font-weight:bold;">before May 1st, 2014</span>  to avoid collection action.</div>-->
<!--                            <div class="dashDivider">&#32;</div>-->
<!--                            <form method="post" name="theForm" id="theForm" action="ofrConfirm.php" autocomplete="off">-->
<!--                                <fieldset class="noBorder">-->
<!--                                    <table cellpadding="4" cellspacing="0" width="100%">-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><span class="required">*</span>Service Unit:</td>-->
<!--                                            <td class="agreementPadding2">-->
<!--                                                <//?php echo getSelectList($writeConn,'troopSU','troopSU','sp_GetCookieServiceUnitList','form_Select400','Select your ServiceUnit --','suNum,null,suNum,suCity','style="padding:1px 0;"','onchange="getTroopInfo(\'getTroopNumber.php?id=\'+this.value,\'troopNumDiv\')";','id:null',1,null,null,null,null,null,null,null,null,null);?><span class="formError" id="troopSUError"></span>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><span class="required">*</span>Troop Number:</td>-->
<!--                                            <td class="agreementPadding2">-->
<!--                                                <div id="troopNumDiv">-->
<!--                                                    <select class="form_Select175" name="troopNum" id="troopNum" tabIndex="2">-->
<!--                                                        <option value="">Select Troop Number --</option>-->
<!--                                                    </select><span class="formError" id="troopNumError"></span>-->
<!--                                                </div>-->
<!--                                            </td>-->
<!--                                        </tr>-->
<!--                                    </table>-->
<!--                                </fieldset>-->
<!--                                <div style="height:1px;">&#32;</div>-->
<!--                                <fieldset>-->
<!--                                    <legend>Troop Leader Information</legend>-->
<!--                                    <table cellpadding="4" cellspacing="0" width="100%">-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrFName"><span class="required">*</span>Troop Leader First Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrLdrFName" name="ofrLdrFName" class="form_Field200" tabindex="3" autocomplete="off" /><span class="formError" id="ofrLdrFNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrLName"><span class="required">*</span>Troop Leader Last Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrLdrLName" name="ofrLdrLName" class="form_Field200" tabindex="4" autocomplete="off" /><span class="formError" id="ofrLdrLNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrEmail"><span class="required">*</span>Troop Leader Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrLdrEmail" name="ofrLdrEmail" class="form_Field250" tabindex="5" autocomplete="off" /><span class="formError" id="ofrLdrEmailError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrEmail2"><span class="required">*</span>Confirm Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrLdrEmail2" name="ofrLdrEmail2" class="form_Field250" tabindex="6" autocomplete="off" /><span class="formError" id="ofrLdrEmail2Error"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrAddress"><span class="required">*</span>Address: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrAddress" id="ofrLdrAddress" class="form_Field250" tabindex="7" autocomplete="off" /><span class="formError" id="ofrLdrAddressError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrCity"><span class="required">*</span>City: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrCity" id="ofrLdrCity" class="form_Field200" tabindex="8" autocomplete="off" /><span class="formError" id="ofrLdrCityError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrZip"><span class="required">*</span>Zip Code: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrZip" id="ofrLdrZip" class="form_Field50" tabindex="9" autocomplete="off" /><span class="formError" id="ofrLdrZipError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrHomePhone"><span class="required">*</span>Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrHomePhone" id="ofrLdrHomePhone" class="form_Field125" tabindex="10" autocomplete="off" .><span class="formError" id="ofrLdrHomePhoneError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrWorkPhone">Work Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrWorkPhone" id="ofrLdrWorkPhone" class="form_Field125" tabindex="11" autocomplete="off" /></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrLdrCellPhone">Cell Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrLdrCellPhone" id="ofrLdrCellPhone" class="form_Field125" tabindex="12" autocomplete="off" /></td>-->
<!--                                        </tr>-->
<!--                                        <tr><td colspan="2"><div style="height:15px;">&#32;</div></td></tr>-->
<!--									</table>-->
<!--                                </fieldset>-->
<!--                                <div style="height:1px;">&#32;</div>-->
<!--								<fieldset>-->
<!--                                    <legend>Troop Cookie Manager Information</legend>-->
<!--                                    <table cellpadding="4" cellspacing="0" width="100%">-->
<!--                                        <tr>-->
<!--                                            <td colspan="2"><label for="tcmSame" class="checkboxLabel" style="font-weight:bold;"><input type="checkbox" class="checkbox" name="tcmSame" id="tcmSame" value="1" tabindex="20" />The Troop Cookie Manager is the same as the Troop Leader.</label></td>-->
<!--                                        </tr>-->
<!--                                            <tr>-->
<!--                                                <td colspan="2"><div class="dashDivider" style="width:300px;margin:12px 150px;">&#32;</div></td>-->
<!--                                            </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmFName"><span class="required">*</span>TCM First Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrTcmFName" name="ofrTcmFName" class="form_Field200" tabindex="21" autocomplete="off" /><span class="formError" id="ofrTcmFNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmLName"><span class="required">*</span>TCM Last Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrTcmLName" name="ofrTcmLName" class="form_Field200" tabindex="22" autocomplete="off" /><span class="formError" id="ofrTcmLNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmEmail"><span class="required">*</span>TCM Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrTcmEmail" name="ofrTcmEmail" class="form_Field250" tabindex="23" autocomplete="off" /><span class="formError" id="ofrTcmEmailError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmEmail2"><span class="required">*</span>Confirm Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrTcmEmail2" name="ofrTcmEmail2" class="form_Field250" tabindex="24" autocomplete="off" /><span class="formError" id="ofrTcmEmail2Error"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmAddress"><span class="required">*</span>Address: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmAddress" id="ofrTcmAddress" class="form_Field250" tabindex="25" autocomplete="off" /><span class="formError" id="ofrTcmAddressError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmCity"><span class="required">*</span>City: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmCity" id="ofrTcmCity" class="form_Field200" tabindex="26" autocomplete="off" /><span class="formError" id="ofrTcmCityError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmZip"><span class="required">*</span>Zip Code: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmZip" id="ofrTcmZip" class="form_Field50" tabindex="27" autocomplete="off"><span class="formError" id="ofrTcmZipError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmHomePhone"><span class="required">*</span>Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmHomePhone" id="ofrTcmHomePhone" class="form_Field125" tabindex="28" autocomplete="off" /><span class="formError" id="ofrTcmHomePhoneError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmWorkPhone">Work Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmWorkPhone" id="ofrTcmWorkPhone" class="form_Field125" tabindex="29" autocomplete="off" /></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrTcmCellPhone">Cell Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrTcmCellPhone" id="ofrTcmCellPhone" class="form_Field125" tabindex="30" autocomplete="off" /></td>-->
<!--                                        </tr>-->
<!--                                        <tr><td colspan="2"><div style="height:15px;">&#32;</div></td></tr>-->
<!--									</table>-->
<!--                                </fieldset>-->
<!--                                <div style="height:1px;">&#32;</div>-->
<!--								<fieldset>-->
<!--                                    <legend>Individual Delinquency</legend>-->
<!--                                    <table cellpadding="4" cellspacing="0" width="100%">-->
<!--                                        <tr>-->
<!--                                            <td colspan="2"><div class="formInstructions">To be completed by the Troop Cookie Manager - one individual per form.</div></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrGSFName"><span class="required">*</span>Girl First Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrGSFName" name="ofrGSFName" class="form_Field200" tabindex="41" autocomplete="off" /><span class="formError" id="ofrGSFNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrGSLName"><span class="required">*</span>Girl Last Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrGSLName" name="ofrGSLName" class="form_Field200" tabindex="42" autocomplete="off" /><span class="formError" id="ofrGSLNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentFName"><span class="required">*</span>Parent/Guardian First Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrParentFName" name="ofrParentFName" class="form_Field200" tabindex="43" autocomplete="off" /><span class="formError" id="ofrParentFNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentLName"><span class="required">*</span>Parent/Guardian Last Name: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrParentLName" name="ofrParentLName" class="form_Field200" tabindex="44" autocomplete="off" /><span class="formError" id="ofrParentLNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentEmail"><span class="required">*</span>Parent/Guardian Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrParentEmail" name="ofrParentEmail" class="form_Field250" tabindex="45" autocomplete="off" /><span class="formError" id="ofrParentEmailError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentEmail2"><span class="required">*</span>Confirm Email: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" id="ofrParentEmail2" name="ofrParentEmail2" class="form_Field250" tabindex="46" autocomplete="off" /><span class="formError" id="ofrParentEmail2Error"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentAddress"><span class="required">*</span>Address: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentAddress" id="ofrParentAddress" class="form_Field250" tabindex="47" autocomplete="off" /><span class="formError" id="ofrParentAddressError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentCity"><span class="required">*</span>City: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentCity" id="ofrParentCity" class="form_Field200" tabindex="48" autocomplete="off" /><span class="formError" id="ofrParentCityError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentZip"><span class="required">*</span>Zip Code: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentZip" id="ofrParentZip" class="form_Field50" tabindex="49" autocomplete="off"><span class="formError" id="ofrParentZipError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentHomePhone"><span class="required">*</span>Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentHomePhone" id="ofrParentHomePhone" class="form_Field125" tabindex="50" autocomplete="off"><span class="formError" id="ofrParentHomePhoneError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentWorkPhone">Work Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentWorkPhone" id="ofrParentWorkPhone" class="form_Field125" tabindex="51" autocomplete="off"></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrParentCellPhone">Cell Phone: </label></td>-->
<!--                                            <td class="agreementPadding2"><input type="text" name="ofrParentCellPhone" id="ofrParentCellPhone" class="form_Field125" tabindex="52" autocomplete="off"></td>-->
<!--                                        </tr>-->
<!--                                        <tr><td colspan="2"><div style="height:15px;">&#32;</div></td></tr>-->
<!--									</table>-->
<!--								</fieldset>-->
<!--                                <div style="height:1px;">&#32;</div>-->
<!--								<fieldset>-->
<!--                                    <legend>Report Information</legend>-->
<!--                                    <table cellpadding="4" cellspacing="0" width="100%">-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrRepFame"><span class="required">*</span>Person Completing Report: </label></td>-->
<!--                                            <td class="agreementPadding2" colspan="2"><input type="text" id="ofrRepName" name="ofrRepName" class="form_Field200" tabindex="60" autocomplete="off" /><span class="formError" id="ofrRepNameError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrRepPhone"><span class="required">*</span>Phone: </label></td>-->
<!--                                            <td class="agreementPadding2" colspan="2"><input type="text" name="ofrRepPhone" id="ofrRepPhone" class="form_Field125" tabindex="61" autocomplete="off" /><span class="formError" id="ofrRepPhoneError"></span></td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <td class="tctLabel"><label for="ofrNoBillPayment"><span class="required">*</span>Briefly state why the cookie bill was not paid in full: </label></td>-->
<!--                                            <td class="agreementPadding2" valign="top"><textarea id="ofrNoBillPayment" name="ofrNoBillPayment" cols="5" rows="5" class="ofrTextArea" tabindex="62"></textarea></td>-->
<!--                                            <td style="width:210px;vertical-align:top;"><div class="formError" id="ofrNoBillPaymentError"></div></td>-->
<!--                                        </tr>-->
<!--                                            <tr>-->
<!--                                                <td colspan="3"><div class="dashDivider" style="width:300px;margin:12px 150px;">&#32;</div></td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="tctLabel"><label for="ofrTotalDue"><span class="required">*</span>Total Amount Owed by Girl: </label></td>-->
<!--                                                <td class="agreementPadding2" colspan="2"><input type="text" name="ofrTotalDue" id="ofrTotalDue" class="form_Field150" tabindex="64" autocomplete="off" onfocus="startIncomeCalc();" onblur="stopIncomeCalc();" onkeypress="return onlyNumbers(1);" value="" />&nbsp;&nbsp;<span class="formNote">(numbers only)</span><span class="formError" id="ofrTotalDueError"></span></td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="tctLabel"><label for="ofrAmountPaid"><span class="required">*</span>Amount Paid by Girl: </label></td>-->
<!--                                                <td class="agreementPadding2" colspan="2"><input type="text" name="ofrAmountPaid" id="ofrAmountPaid" class="form_Field150" tabindex="65" autocomplete="off" onfocus="startIncomeCalc();" onblur="stopIncomeCalc();" onkeypress="return onlyNumbers(1);" value="" />&nbsp;&nbsp;<span class="formNote">(numbers only)</span><span class="formError" id="ofrAmountPaidError"></span></td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td class="tctLabel"><label for="ofrBalanceDue" style="color:#c00;">Balance Due from Girl: </label></td>-->
<!--                                                <td class="agreementPadding2" colspan="2"><input type="text" name="ofrBalanceDue" id="ofrBalanceDue" class="form_Field150 balanceDue" tabindex="66" value="$0.00" autocomplete="off" readonly="readonly" style="background-color:#efefef;" />&nbsp;&nbsp;<span class="formNote">(read only)</span></td>-->
<!--                                            </tr>-->
<!--                                        <tr><td colspan="3"><div style="height:15px;">&#32;</div></td></tr>-->
<!--									</table>-->
<!--								</fieldset>-->
<!--								<div style="margin-left:100px;">-->
<!--                                    <input type="hidden" name="submitOFRReport" value="submitOFRReport" />-->
<!--                                    <input type="hidden" name="ofrFormSecret" id="ofrFormSecret" value="--><?php //echo $formSecret;?><!--" placeholder="ofr form secret" />-->
<!--                                    <input type="hidden" name="ofrBalanceDueTemp" id="ofrBalanceDueTemp" value="0" />-->
<!--                                	<input type="submit" name="submitOFR" id="submitOFR" value="Submit OFR Report" class="submitButtonYellow" onclick="return confirm('You are about to submit a payment of $' +document.getElementById('accountDepositTemp').value+ '.\n\nClick OK to confirm or Cancel to return to the form.');">-->
<!--                                    <div class="formLableH">Ignore if visible: <input type="text" name="labrea" id="labrea" /></div>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

