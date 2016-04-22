<?php
 // form source from http://bassistance.de/
    error_reporting (E_ALL ^ E_NOTICE);
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    require("i_PDOConnection.php");								    //=	CREATES DATA CONNECTION TO DATABASE
    require("i_PDOFunctions.php");								    //= LOAD FORM FUNCTIONS

    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION
//    echo "SECRET: ".$formSecret."<br>";
//    if(!ISSET($_SESSION['formSecret'])) {
//        $_SESSION['formSecret'] = $formSecret;
//    }
	setRegistrationParams('10/01/2015','06/01/2016');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Troop Cookie Manager Online Registration Form</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <script src="js/vendors/modernizr.js"></script>
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
        <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
            <form name="theForm" id="theForm" method="post" action="tcmApplicationConfirm.php">
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>We know you can't wait to get started but give us a little more time to make the place presentable.<br><br>Registration will open on October 29.<br><br><br></div>
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br><br><br><br><div style="border:3px solid #B42D44;padding:20px;margin:0 auto 20px auto;width:80%;font-weight:bold;color:#B42D44;font-size:1.2em;line-height:1.8em;text-align:center;">This form is currently down for maintenance.  Please try again later.</div><br><br><br><br><br><br></div>
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
                            <div class="span-24"><img src="img/hdr_TCMApplication.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Girl Scout Troop Cookie Manager Agreement</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/troopCookieManagerHeader_Sm.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 tcmPositionIntro">The GS Troop Cookie Manager is responsible for administering the Girl Scout Troop’s Cookie Program Activity, including all financial transactions, reporting and paperwork and providing programmatic support.</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight"><label>Term:</label></div>
                            <div class="span-15" style="font-size:1em;">
                                <ul style="font-size:1em;margin-bottom:0;">
                                    <li>12 months</li>
                                </ul>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight"><label>Organizational Relationships:</label></div>
                            <div class="span-15">
                                <ul style="font-size:1em;margin-bottom:0;">
                                    <li>Appointed by:  SU Cookie Coordinator</li>
                                    <li>Volunteer Support:  GS Troop Leader /  SU Cookie Coordinator</li>
                                    <li>Staff Support: Volunteer Coordinator</li>
                                </ul>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight"><label>Qualifications:</label></div>
                            <div class="span-15">
                                <ul style="font-size:1em;margin-bottom:0;">
                                    <li>Have current GSUSA registration and valid security status.</li>
                                    <li>Ensure that compliance with the regulations governed by the following is met: GSUSA Volunteer Essentials and Safety Activity Checkpoints</li>
                                    <li>Ensure compliance with and familiarity with GSNETX Policies and Procedures, specifically those policies regarding GS Troop funds.</li>
                                </ul>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight"><label>Length of Appointment:</label></div>
                            <div class="span-15">
                                <ul style="font-size:1em;margin-bottom:0;">
                                    <li>Volunteer Appointment Agreement is for the period of October1, 2015 to September 30, 2016.</li>
                                </ul>
                            </div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-4"><p>&#32;</p></div>
                            <div class="span-16">
                                <div style="margin: 10px auto 5px;text-align: center;"><img src="img/star-empty_orange_32.png"/><img src="img/star-empty_orange_32.png"/><img src="img/star-empty_orange_32.png"/></div>
                            </div>
                            <div class="span-4 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 newSection" style="height:21px;"><img src="img/registrationInfoHeader_Sm.png" width="350" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 marginTop15">&#32;</div>
                            <!-- START REGISTRATION INFO BLOCK ------------------------------------------------------------------------------------------------>
                            <div class="span-24">&#32;</div>
                            <div class="span-24 height5">&#160;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight inputTop"><label for="volFName" id="volFNameLabel"><span class="required">*</span>First Name: </label></div>
                            <div class="span-7 inputTop"><input type="text" id="volFName" name="volFName" class="form_Field200" tabindex="1" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volFNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volLName" id="volLNameLabel"><span class="required">*</span>Last Name: </label></div>
                            <div class="span-7 input"><input type="text" id="volLName" name="volLName" class="form_Field200" tabindex="2" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volLNameError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volEmail" id="volEmailLabel"><span class="required">*</span>Email:</label></div>
                            <div class="span-7 input"><input type="text" name="volEmail" id="volEmail" class="form_Field275" value="" tabindex="3" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volEmailError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volEmail2" id="volEmail2Label"><span class="required">*</span>Confirm Email:</label></div>
                            <div class="span-7 input"><input type="text" name="volEmail2" id="volEmail2" class="form_Field275" value="" tabindex="4" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volEmail2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volPhone" id="volPhoneLabel"><span class="required">*</span>Phone Number:</label></div>
                            <div class="span-7 input"><input type="text" name="volPhone" id="volPhone" class="form_Field125" value="" tabindex="5" autocomplete="off" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volPhoneError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volIDType" id="volIDTypeLabel" ><span class="required">*</span>Identification Type: </label></div>
                            <div class="span-9 input">
                                <select name="volIDType" ID="volIDType" class="form_Select200" tabindex="6" style="border:1px solid #bbb;" autocomplete="off">
                                    <option value="">- Select an ID type --</option>
                                    <option value="DL">Driver&#39;s license #</option>
                                    <option value="ID">State issued ID #</option>
                                </select>&nbsp;&nbsp;&nbsp;
                            </div>
                            <div class="span-7"><div id="volIDTypeError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volID" id="volIDLable"><span class="required">*</span>Identification Number: </label></div>
                            <div class="span-9 input"><input type="text" id="volID" name="volID" class="form_Field200" tabindex="7" autocomplete="off" /></div>
                            <div class="span-7"><div id="volIDError" class="errorContainer"></div></div>
                            <div class="span-1 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- *********************************************************************** -->
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volTroop" id="volTroopLabel"><span class="required">*</span>Troop Number:</label></div>
                            <div class="span-7 input"><?php echo getSelectList($dbh,'volTroop','volTroop','sp_GetTroopNumbers_List 2015,null','form_Select50','Select your Troop Number --','troop_number,null,troop_number,null','style="padding:3px 4px;border:1px solid #999;"','onchange="$(\'#serviceUnitTest\').val(this.value);getTCTServiceUnit(\'getTCTSU.php?troopNum=\'+this.value,\'innerHTML\',\'serviceUnitDiv\');"','id:null',9,null,null,null,null,null,null,null,null,null);?></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volTroopError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <!-- *********************************************************************** -->
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volSU" id="volSULabel"><span class="required">*</span>GS Service Unit:</label></div>
                            <div class="span-7 input" id="serviceUnitDiv">
                                <select class"form_Select300" name="serviceUnit" id="serviceUnit" tabIndex="9" style="width:300px;"><option value="">Select your Service Unit --</option></select>
                                <?php //echo getSelectList($dbh,'volSU','volSU','sp_GetTCTServiceUnit_List 2015,null','form_Select300','Select your Service Unit --','su_Number,null,su_Number,su_AreaNames','style="padding:3px 4px;border:1px solid #999;"',null,'id:null',9,null,null,null,null,null,null,null,null,null);?>
                            </div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6"><div id="volSUError" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer" style="margin-top:10px;">&#32;</div>
                            <!-- ACKNOWLEDGEMENTS AND RESPONSIBILITIES SECTION -------------------------------------------------------------------------------------------->
                            <div class="span-24 marginTop15">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 headerSection" style="height:21px;"><img src="img/accountabilitiesHeader_Sm.png" width="400" height="21" alt="" /></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                            <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 height10">&#32;</div>
                            <div class="span-3"><p>&#32;</p></div>
                            <div class="span-18">Please enter your initials in the boxes below, confirming you agree to all accountabilities of your position. <div style="font-size:.9em;margin-top:5px;color:#c00;">All boxes must be initialed &mdash; 4 letters max.</div></div>
                            <div class="span-3 last">&#32;</div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt1" id="txt1" class="form_Field50 padding2 textCenter textUppercase" tabindex="10" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt1" class="labelNormal">I understand that while training is not required, it is my responsibility to take advantage of the eBudde and program training materials available to me.</label></div>
                            <div class="span-6"><div id="txt1Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt2" id="txt2" class="form_Field50 padding2 textCenter textUppercase" tabindex="11" autocomplete="off" maxlength="4" style="vertical-align:top;" /></div>
                            <div class="span-9 t1a"><label for="txt2" class="labelNormal">I understand that I am responsible for holding girl & parent/guardian information session(s) and distributing Cookie Program information and forms to girls and their parents.</label></div>
                            <div class="span-6"><div id="txt2Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt3" id="txt3" class="form_Field50 padding2 textCenter textUppercase" tabindex="12" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt3" class="labelNormal">I will ensure girls are registered for the current Girl Scout membership year and ensure online Cookie Program Parent Permission Forms for each participating Girl Scout are completed.</label></div>
                            <div class="span-6"><div id="txt3Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt4" id="txt4" class="form_Field50 padding2 textCenter textUppercase" tabindex="13" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt4" class="labelNormal">I understand it is my responsibility to interpret to girls and their parents/guardians the Cookie Program procedures, girl reward program, and the importance of the Cookie Program to the council and to the girl&#146;s leadership journey.</label></div>
                            <div class="span-6"><div id="txt4Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt5" id="txt5" class="form_Field50 padding2 textCenter textUppercase" tabindex="14" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt5" class="labelNormal">I understand it is my responsibility to communicate and cooperate with my Girl Scout Service Unit Cookie Coordinator (SUCC) and <strong>adhere to deadlines</strong>.</label></div>
                            <div class="span-6"><div id="txt5Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt6" id="txt6" class="form_Field50 padding2 textCenter textUppercase" tabindex="15" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt6" class="labelNormal">I understand it is my responsibility to train Girl Scouts on all aspects of the 5 Skills of the Cookie Program.</label></div>
                            <div class="span-6"><div id="txt6Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt7" id="txt7" class="form_Field50 padding2 textCenter textUppercase" tabindex="16" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt7" class="labelNormal">I understand it is my responsibility to promote booth sales and request booth space and time, as needed.  I will ensure that a positive image of Girl Scouting is presented to the community during booth sales.</label></div>
                            <div class="span-6"><div id="txt7Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt8" id="txt8" class="form_Field50 padding2 textCenter textUppercase" tabindex="17" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt8" class="labelNormal">I understand it is my responsibility to set due dates to receive girl cookie orders, payments and girl rewards selection information from girls and parents/guardians.</label></div>
                            <div class="span-6"><div id="txt8Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt9" id="txt9" class="form_Field50 padding2 textCenter textUppercase" tabindex="18" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt9" class="labelNormal">I understand it is my responsibility to maintain accurate records (paper copies and within all software applications including eBudde) and will issue receipts any time products or money is exchanged.</label></div>
                            <div class="span-6"><div id="txt9Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt10" id="txt10" class="form_Field50 padding2 textCenter textUppercase" tabindex="19" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt10" class="labelNormal">As the Girl Scout Troop Cookie Manager, I agree that it is my responsibility to timely complete and submit any Outstanding Funds Report Forms and to follow all established guidelines for reporting unpaid or delinquent funds owed for the Girl Scout Troop cookie money. I agree that I will not be allowed to submit an Outstanding Funds Report Form for money which I personally owe for the Girl Scout Troop cookie money.</label></div>
                            <div class="span-6"><div id="txt10Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt11" id="txt11" class="form_Field50 padding2 textCenter textUppercase" tabindex="20" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt11" class="labelNormal">As the Girl Scout Troop Cookie Manager, I understand that collection action will be taken on all outstanding accounts and debts for the Girl Scout Troop cookie money which are not settled in full by <strong>March 7, 2016</strong>. I understand that such outstanding accounts or debts may be reported to a credit bureau and referred to collection agencies and pursued through legal action against me.  I agree to pay all reasonable costs and expenses of collecting such outstanding debts and unpaid amounts, including collection agency fees, reasonable attorneys&#146; fees, and costs.</label></div>
                            <div class="span-6"><div id="txt11Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt12" id="txt12" class="form_Field50 padding2 textCenter textUppercase" tabindex="21" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a">
                                <label for="txt12" class="labelNormal">As the Girl Scout Troop Cookie Manager, I agree that I am personally responsible for handling and accounting for the Girl Scout Troop cookie money. I understand that I assume all financial responsibility for collection and timely payment of all the Girl Scout troop cookie money for my troop.</label>
                                <ul class="permissionList">
                                    <li>Therefore, I acknowledge that I am fully aware of this responsibility.</li>
                                    <li>I agree to keep accurate records and to personally assume such financial responsibility for all Girl Scout Troop cookie money.</li>
                                    <li>If any Girl Scout troop cookie money is owed, I accept personal financial responsibility for payment of that outstanding debt owed for the Girl Scout Troop cookie money. </li>
                                </ul>
                            </div>
                            <div class="span-6"><div id="txt12Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt13" id="txt13" class="form_Field50 padding2 textCenter textUppercase" tabindex="22" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt13" class="labelNormal"><strong>FIDUCIARY DUTY AND FINANCIAL RESPONSIBILITY</strong>: The undersigned Girl Scout Troop Cookie Manager hereby acknowledges his/her understanding and agreement that the responsibilities of a Troop Cookie Manager constitute a fiduciary duty for the benefit of the GSNETX and its beneficiaries. I have read the responsibilities outlined herein, understand them, and agree to assume them in accordance with all applicable GSNETX policies and procedures. I agree to accept, and do hereby accept, financial responsibility, for all Troop cookies entrusted for distribution, sale, collection, accounting, and deposit, and I further agree to adhere to, and abide by all of the prescribed GSNETX procedures and policies for record-keeping, accounting, and depositing cookie funds. Should it become necessary for GSNETX to incur collection fees, attorney’s fees and/or costs for legal representation to collect any monies not paid, or payable, from the cookie sales, which are attributable to my Troop, I shall be responsible for all such collection agency fees, reasonable attorney&#146;s fees, and costs.</label></div>
                            <div class="span-6"><div id="txt13Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><input type="text" name="txt14" id="txt14" class="form_Field50 padding2 textCenter textUppercase" tabindex="23" autocomplete="off" maxlength="4" /></div>
                            <div class="span-9 t1a"><label for="txt14" class="labelNormal">I understand it is my responsibility to have completed the Criminal Background process and have been approved to volunteer with GSNETX.</label></div>
                            <div class="span-6"><div id="txt14Error" class="errorContainer"></div></div>
                            <div class="span-2 last">&#32;</div>
                            <div class="span-24 formFieldSpacer10">&#32;</div>
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
                            <div class="span-24 formFieldSpacer10">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-5 textRight input"><label for="volSignedName"><span class="required">*</span>Full Name: </label></div>
                            <div class="span-9 input"><input type="text" name="volSignedName" id="volSignedName" class="form_Field275" tabindex="30" autocomplete="off" ></div>
                            <div class="span-7"><div id="volSignedNameError" class="errorContainer"></div></div>
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
                    <?php include('i_cookieFooter.php');?>
                </div>
                <!-- ############################################################################################################### -->
                <div style="clear:both;">
                    <br><br>
                    <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitTroopCookieManagerRegistration" tabindex="-1" />
                    <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                    <input type="hidden" name="serviceUnitTest" id="serviceUnitTest" value="" tabindex="-1" placeholder="serviceUnit" />
                    <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                    <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
                </div>
            </form>
        </div>
        <script src="../common/js/jquery.min.js" ></script>                                                                                                   <!-- V 1.11.2 -->
        <script src="../common/js/jquery-ui.min.js"></script>                                                                                                 <!-- V 1.11.2 -->
        <script src="../common/js/jquery.validate.min.js"></script>                                                                                           <!-- V 1.14.0 -->
        <script src="../common/js/additional-methods.min.js"></script>                                                                                        <!-- V 1.14.0 -->
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <script src="js/i_tcmApplicationValidation.js" type="text/javascript"></script>

        <script>
            // function checkPopup() {
            // var openWin = window.open("http://www.google.com","directories=no,height=100,width=100,menubar=no,resizable=no,scrollbars=no,status=no,titlebar=no,top=0,location=no");
            // if (!openWin) {
            // alert("A popup blocker was detected. Please Remove popupblocker for this site");
            // } else {
            // openWin.close();
            // //alert("No popup blocker dectected");
            // }
            // }
            // window.onload = checkPopup;
        </script>

    </body>
</html>
