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
    $formSecret=md5(uniqid(rand(), true));
    setRegistrationParams('10/01/2015','05/1/2019');
    $signatureDate = date("F j, Y g:i a");

//= CHECK SUBMIT BUTTON STATUS//======================================================================================================================
//= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	======================================================================================
//    if(isset($_SERVER['HTTP_REFERER'])) {
//    //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE PERMISSION FORM =============================================================================
//        //ECHO "PageName: ".$_SERVER['HTTP_REFERER']."<br>";
//        if(truncatePage(strtolower(returnPageName($_SERVER['HTTP_REFERER']))) == 'photoupload.php') {
            $connectionVar = 'GSNETX2014';
            require("i_PDOConnection.php");												    //=	CREATES PDO DATA CONNECTION TO DATABASE
            require("includes/i_GetServiceUnit.php");
//            require_once('lib/swift_required.php');
//            if (strtolower($_POST["submitAcknowledgement"]) == 'submitphotoreleaseacknowledgement') {
//                // ECHO "<b>ACKNOWLEDGEMENT RECEIVED - CREATE RECORD IN DATABASE</b><br>";
//                $ipAddress = getIPAddr();
//                $browserString = getBrowserInfo($_SERVER['HTTP_USER_AGENT']);
//                $arrBrowserString = explode(';', $browserString);
//                setVars('formSecret:str,agreeToConditions:bit,photoUploadTroopLeaderFName:caps,photoUploadTroopLeaderLName:caps,photoUploadTroopLeaderConfirmationDate:str', 0, 0, 'Cookie Image Uploader Acknowledgement');
//                $dbFields = array("formSecret: " . $formSecret, "agreeToConditions: " . $agreeToConditions, "browser: " . $arrBrowserString[0], "browserVersion: " . $arrBrowserString[1], "operatingSystem: " . $arrBrowserString[2], "troopLeaderFName: " . $troopLeaderFName, "troopLeaderLName: " . $troopLeaderLName);
//                $confirmed = $agreeToConditions;
//                //- CHECK FOR DUPLICATE SUBMISSIONS ---------------------------------------------------------------------------------------------------------------------------
//                // echo "Object Status: ".returnObjectStatus ($dbh,'EXEC GSNETX_Web_Events.dbo.sp_GetUserID :tableName,:formSecret','id','GSNETX_Web_Events.dbo.tbl_TCT_PhotoUploads',$_POST["formSecret"]);
//                if (returnObjectStatus ($dbh,'EXEC GSNETX_Web_Events.dbo.sp_GetUserID :tableName,:formSecret','id','GSNETX_Web_Events.dbo.tbl_TCT_PhotoUploads',$_POST["formSecret"]) == '') {
//                   $stmt = $dbh_write->prepare('EXEC sp_Save_TCT_PhotoUploads @formSecret=:formSecret,@ipAddress=:ipAddress,@browser=:browser,@browserVersion=:browserVersion,@os=:os,@photoLeaderConfirmation=:photoLeaderConfirmation,@photoLeaderFirstName=:photoLeaderFirstName,@photoLeaderLastName=:photoLeaderLastName,@photoLeaderConfirmationDate=:photoLeaderConfirmationDate');
//                    $stmt->bindParam(':formSecret',$formSecret, PDO::PARAM_STR);
//                    $stmt->bindParam(':ipAddress',$ipAddress, PDO::PARAM_STR);
//                    $stmt->bindParam(':browser',$arrBrowserString[0], PDO::PARAM_STR);
//                    $stmt->bindParam(':browserVersion',$arrBrowserString[1], PDO::PARAM_STR);
//                    $stmt->bindParam(':os',$arrBrowserString[2], PDO::PARAM_STR);
//                    $stmt->bindParam(':photoLeaderConfirmation',$agreeToConditions, PDO::PARAM_STR);
//                    $stmt->bindParam(':photoLeaderFirstName',$photoUploadTroopLeaderFName, PDO::PARAM_STR);
//                    $stmt->bindParam(':photoLeaderLastName',$photoUploadTroopLeaderLName, PDO::PARAM_STR);
//                    $stmt->bindParam(':photoLeaderConfirmationDate',$photoUploadTroopLeaderConfirmationDate, PDO::PARAM_STR);
//                    $stmt->execute();
//                    $stmt = null;
//                    $confirmed = 1;
//                } else {
//                    $confirmed = '1';
//                }
//            } else {
//                $confirmed = '';
//            }
//        } else {
//        $confirmed = '';
//        }
//    } else {
//        $confirmed = '';
//        $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION
//    }
?>
<!DOCTYPE html>
    <html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Texas Cookie Time Photo Uploads</title>
        <meta charset="UTF-8">
        <link rel="icon" href="favicon.png" sizes="32x32">
        <link rel="icon" href="favicon.ico" sizes="32x32">
        <link rel="stylesheet" type="text/css" href="css/accordion-slider.min.css" media="screen"/>
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <script src="js/vendors/modernizr.js"></script>
        <script src="js/i_validatePhotoUploadScripts.js" type="text/javascript"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
        <div>
            <?php include('i_cookieHeader.php');?>
            <!-- ## BEGIN FORM MAIN BODY ############################################################################################################# -->
            <div>
            <!-- ## BEGIN PAGE 1 ######################################################################################################### -->
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Sorry -- not ready for prime time yet.  Just be patient a little longer while we finish this up.<br><br>The Photo Upload form will be available soon.<br><br><br></div>
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
                            <!--<div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online submission of Cookie Sales photos has been closed.<br><br>Thank you so much for all of your hard work this season.<br><br><br><br></div>-->
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online submission of Cookie Sales photos is experiencing technical difficulties.<br><br>Thank you for your patience while we work to get them resolved.<br><br><br><br></div>
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
                            <div class="span-24" style="width:870px;height:190px;padding:5px 45px;">
                                <div id="my-accordion" class="accordion-slider">
                                    <div class="as-panels">
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop7457.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 7457</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop6448.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 6448</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop6429.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 6429</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop7432.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 7432</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop3402.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 3402</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop5295.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 5295</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop2733.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 2733</div>
                                        </div>
                                        <div class="as-panel">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop3234.png"/>
                                            <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 3234</div>
                                        </div>
                                        <div class="as-panel"">
                                            <img class="as-background" src="img/spacer.png" data-src="img/accordion/troop6805.png"  />
                                        <div class="as-layer as-opened as-black as-padding" data-width="100%" data-position="bottom" data-show-transition="up" data-hide-transition="down">Troop 6805</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Texas Cookie Time Image Uploader</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20 eventIntro" id="eventIntro">
                                <div>
                                    <div class="eventIntroMed" style="font-size:1.2em;">Since a picture is worth a thousand words, share your Cookie story and send us a photo from your event.</div>
                                </div>
                            </div>
                        <!-- START TSHIRT PURCHASE BLOCK ============================================================================================================== -->
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-5" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-14 grayDashedDivider" style="height:2px;">&#32;</div>
                            <div class="span-5 last" style="height:2px;"><p>&#32;</p></div>
                            <div class="span-24 formFieldSpacer">&#32;</div>
                        <!-- START PHOTO UPLOAD BLOCK ================================================================================================================= -->
                            <form name="theForm" id="theForm" method="post" action="photoUploadConfirmation.php" autocomplete="off" enctype="multipart/form-data" onsubmit="return validateForm(this);">
                                <div class="span-24" style="clear:both;">
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-20 eventIntro" id="eventIntro">
                                        <div class="eventIntroMed" style="color:#333;"><strong>Terms and Conditions</strong></div>
                                        <div class="eventIntroMed" style="font-size:1.05em;">By submission to the Girl Scouts of Northeast Texas, I hereby consent that the photographs and/or electronic images may be used by Girl Scouts of Northeast Texas and their assigns or successors, in whatever way they desire.</div>
                                        <div class="eventIntroMed" style="font-size:1.05em;">Furthermore, I hereby consent that such photographs and/or electronic images shall be their property, and they shall have the right to duplicate, reproduce, and make other uses of such photographs and/or electronic images as they may desire free and clear of any claim whatsoever on my part.  For all group photos, I also confirm that the individuals pictured have agreed to allow me to share their image for the purposes described. I understand that troop numbers and first names may be attributed to my photograph(s).</div>
                                        <div class="span-20 formFieldSpacer15">&#32;</div>
                                        <div class="span-20">&#32;</div>
                                        <div class="span-5"><p>&#32;</p></div>
                                        <div class="span-12 inputTop"><input type="checkbox" name="agreeToConditions" id="agreeToConditions" value="1" tabindex="1">&#160;&#160;&#160;<label for="agreeToConditions"><span class="required">*</span>Agreed to on <?= date("l, F jS, Y");?> at <?= date("g:i a");?></label></div>
                                        
                                        <div class="span-3 last">&#32;</div>
                                        <div class="span-20" id="photoUploadForm_Wrapper" style="display:none;">
                                            <div class="span-20 formFieldSpacer marginTop10">&#32;</div>
                                        <!-- FIRST NAME ===================================================================================================== -->
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadFName"><span class="required">*</span>First Name: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadFName" name="photoUploadFName" class="form_Field150" tabindex="2" autocomplete="off" placeholder="First Name" /></div>
                                            <div class="span-7 last"><div id="photoUploadFNameError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadLName"><span class="required">*</span>Last Name: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadLName" name="photoUploadLName" class="form_Field150" tabindex="3" autocomplete="off" placeholder="Last Name" /></div>
                                            <div class="span-7 last"><div id="photoUploadLNameError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadTroopNum"><span class="required">*</span>Troop Number: </label></div>
                                            <div class="span-6"><?php echo getTroopNumberList_WithSU($dbh,'photoUploadTroopNum','sp_GetTroopNumbers_List_PhotoUpload 2015,null',4);?></div>
                                            <div class="span-7 last"><div id="photoUploadTroopNumError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadSU"><span class="required">*</span>Service Unit: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadSU" name="photoUploadSU" class="form_Field100" tabindex="5" autocomplete="off" placeholder="Service Unit" /></div>
                                            <div class="span-7 last"><div id="photoUploadSUError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadTroopLeaderFName"><span class="required">*</span>Troop Leader First Name: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadTroopLeaderFName" name="photoUploadTroopLeaderFName" class="form_Field150" tabindex="6" autocomplete="off" placeholder="Leader First Name" /></div>
                                            <div class="span-7 last"><div id="photoUploadTroopLeaderFNameError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadTroopLeaderLName"><span class="required">*</span>Troop Leader Last Name: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadTroopLeaderLName" name="photoUploadTroopLeaderLName" class="form_Field150" tabindex="7" autocomplete="off" placeholder="Leader Last Name" /></div>
                                            <div class="span-7 last"><div id="photoUploadTroopLeaderLNameError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadPhone"><span class="required">*</span>Phone: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadPhone" name="photoUploadPhone" class="form_Field125" tabindex="8" autocomplete="off" placeholder="Phone Number" /></div>
                                            <div class="span-7 last"><div id="photoUploadPhoneError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadEmail"><span class="required">*</span>Email: </label></div>
                                            <div class="span-6"><input type="text" id="photoUploadEmail" name="photoUploadEmail" class="form_Field225" tabindex="9" autocomplete="off" placeholder="Email Address" /></div>
                                            <div class="span-7 last"><div id="photoUploadEmailError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadNames"><span class="required">*</span>People in photo: </label><div class="formNoteRed">List people from left to<br>right. Please include<br>their applicable pgl or<br>title with their name.</div></div>
                                            <div class="span-6"><textarea tabindex="10" id="photoUploadNames" name="photoUploadNames" class="form_TextArea225_100 cols="25" rows="5" autocomplete="off" style="font-size:.9em;" placeholder="L-R, First & Last Name, PGL or Title"></textarea></div>
                                            <div class="span-7 last"><div id="photoUploadNamesError" class="photoErrorContainer"></div></div>
                                            <div class="span-20 formFieldSpacer10">&#32;</div>
                                            <div class="span-2">&#160;</div>
                                            <div class="span-5 input textRight"><label class="formLabel" for="photoUploadFile"><span class="required">*</span>Upload File: </label></div>
                                            <div class="span-6"><input type="file" id="photoUploadFile" name="photoUploadFile" class="form_Field200" style="font-size:1em;border:none;" tabindex="11" /></div>
                                            <div class="span-6 last"><div id="photoUploadFileError" class="photoErrorContainer"></div></div>
                                            <div class="span-20">&#32;</div>
                                            <div class="span-7">&#160;</div>
                                            <div class="span-10"><div style="font-size:.9em;line-height:1.5em;padding:5px;"><strong>Allowable file types include .gif, .jpg, .jpeg, .png and .pdf.<br>Please limit file size to no more than 10 megabytes (mb).</strong></div></div>
                                            <div class="span-3 last">&#32;</div>
                                            <div class="span-20 formFieldSpacer15">&#32;</div>
                                            <div class="span-3"><p>&#32;</p></div>
                                            <div class="span-14"><div class="grayDashedDivider" style="height:2px;margin:0;padding:0;">&#32;</div></div>
                                            <div class="span-3 last"><p>&#32;</p></div>
                                            <div class="span-20">&#32;</div>


                                            <div class="span-2"><p>&#32;</p></div>
                                            <div class="span-12"><input name="submitUpload" type="submit" id="submitUpload" value="ggg" class="button_SubmitPhotoForUpload marginTop5" title="Upload a photo of your cookie event" tabindex="99" style="margin-top:17px;" onclick=" return confirm('Please verify that you understand and agree to the GSNETX Terms and Conditions pertaining to the submission and usage of any images uploaded through this site.\n\nIf you agree click Confirm to submit your photo and information');"></div>
                                            <div class="span-6 last"><p>&#32;</p></div>
                                            <div class="span-20 formFieldSpacer">&#32;</div>

                                        </div>
                                    </div>
                                <div class="span-2 last"><p>&#32;</p></div>
                                <div class="span-24 formFieldSpacer10">&#32;</div>
                                <div class="span-24">
                                    <div style="clear:both;">
                                        <br><br>
                                        <input type="hidden" name="submitPhoto" id="submitPhoto" value="submitPhotoUpload" tabindex="-1" />
                                        <input type="hidden" name="formSecret" id="formSecret" value="<?php echo $formSecret;?>" tabindex="-1" placeholder="formSecret" />
                                        <input type="hidden" name="photoUploadTroopLeaderConfirmationDate" id="photoUploadTroopLeaderConfirmationDate" value="" tabindex="-1" placeholder="Confirmation Date" />
                                        <input type="hidden" name="photoUploadTroopNumTemp" id="photoUploadTroopNumTemp" value="" tabindex="-1" placeholder="Troop number temp" />
                                        <div class="formLabelH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                                        <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
                                    </div>
                                </div>
                            </form>
                            <div class="span-24"><br><br><br></div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <?php include('i_cookieFooter.php');?>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/vendors/jquery.accordionSlider.min.js"></script>
        <script src="js/vendors/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <!-- <script src="js/i_photoUploadValidation.js" type="text/javascript"></script>-->
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#my-accordion').accordionSlider({
                    width: 960,
                    height: 215,
                    visiblePanels: 9,
                    startPanel: 4,
                    closePanelsOnMouseOut: false,
                    shadow: false,
                    panelDistance: 10,
                    autoplay: true,
                    mouseWheel: false
                });
            });
        </script>
    <?php include('i_AnalyticsTracking_Cookies.php');?>
    </body>
</html>
