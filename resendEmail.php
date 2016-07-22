<?php
 // form source from http://bassistance.de/
    error_reporting (E_ALL ^ E_NOTICE);
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    require("i_PDOConnection.php");								    //=	CREATES DATA CONNECTION TO DATABASE
    require("i_PDOFunctions.php");								    //= LOAD FORM FUNCTIONS
    setRegistrationParams('10/01/2015','03/01/2016');
    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION
//    echo "SECRET: ".$formSecret."<br>";
    if(ISSET($_POST['updatePermissions'])) {
        if(count($_POST['record']) > 0 && !empty($_POST['record'][0])) {
            $i = 0;
            $record = $_POST['record'];
            echo "Size: ".sizeof($_POST['record'])."<br>";
            foreach ($_POST['record'] as $key => $checked) {
            //    if ($_POST['record'][$key] == 1) {
                    echo "<strong>Record " . $key . "</strong><br>";
            //        echo $_POST['record'][$key] . "<br>";
            //        echo $_POST['myEmail'][$key] . "<br>";
            //        echo $_POST['leaderEmail'][$key] . "<br>";
            //        echo $_POST['tcmEmail'][$key] . "<br>";
            //        echo $_POST['formSecret'][$key] . "<br><br>";
            //    }
            //setVars('formSecret:str,myEmail:arr, troopLeaderEmail:arr, tcmEmail:arr', 0, 1, 'TCM/PP Email Resend Form');
            $i++;
            }
        }

    }
//        $_SESSION['formSecret'] = $formSecret;
//    }
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
        <!-- ## BEGIN FORM MAIN BODY ###################################################################################################################################### -->
            <div>
                <div class="container showWhite">
                    <div class="span-24"><img src="img/hdr_TCMApplication.png" width="960" height="175" alt="" /></div>
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20"><h1>GSNETX Cookie Program Email Sender</h1></div>
                    <div class="span-2 last"><p>&#32;</p></div>
                    <div class="span-24" style="height:10px;">&nbsp;</div>
                    <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                    <div class="span-20 tcmPositionIntro">Select the form below to check for missing emails. Select all email you wish to resend.  Update missing email addresses as needed and click on the update button to update the data and re-send the emails.</div>
                    <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                    <div class="span-24">&#32;</div>
                    <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                    <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                    <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                    <div class="span-24 marginTop15">&#32;</div>
                    <!-- ## START FORM SELECTION BLOCK ################################################################################################################ -->
                    <div class="span-24">&#32;</div>
                    <div class="span-24 height5">&#160;</div>
                    <div class="span-4"><p>&#32;</p></div>
                    <div class="span-4 inputTop"><label for="tcm" id="tcmLabel"><input type="radio" name="cookieForm" id="tcm" value="tcm" onclick="getTCMList('getTCMMailList.php?troopNum=123','innerHTML','tcmDiv','permissionDiv','tshirtDiv');">&#160;&#160;TCM Registration</label></div>
                    <!--onchange="getTCTServiceUnit('getTCTSU.php?troopNum='+this.value,'innerHTML','serviceUnitDiv');"-->
                    <div class="span-1"><p>&#32;</p></div>
                    <div class="span-4 inputTop"><label for="permission" id="permissionLabel"><input type="radio" name="cookieForm" id="permission" value="permission" onclick="getPermissionList('getPermissionMailList.php','innerHTML','permissionDiv','tcmDiv','tshirtDiv');">&#160;&#160;Parent Permission</label></div>
                    <div class="span-1"><p>&#32;</p></div>
                    <div class="span-4 inputTop"><label for="shirt" id="shirtLabel"><input type="radio" name="cookieForm" id="shirt" value="shirt" onclick="alert(this.value);">&#160;&#160;TShirt Sales</label></div>
                    <div class="span-4 last">&#32;</div>
                    <div class="span-24 formFieldSpacer">&#32;</div>
                    <!-- ## START RESULTS DISPLAY AREA ################################################################################################################ -->
                    <div class="span-2"><p>&#32;</p></div>
                    <div class="span-20" style="border:1px solid #f00;">
                        <div id="tcmDiv"></div>
                        <div id="permissionDiv"><?= $permissionUpdateMessage;?></div>
                        <div id="tshirtDiv"></div>
                    </div>
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
            </div>
            <?php include('i_cookieFooter.php');?>
            <!-- ############################################################################################################### -->
            <div style="clear:both;">
                <input type="hidden" name="submitRegistration" id="submitRegistration" value="submitTroopCookieManagerRegistration" tabindex="-1" />
                <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                <input type="hidden" name="serviceUnitTest" id="serviceUnitTest" value="" tabindex="-1" placeholder="serviceUnit" />
                <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/vendors/jquery.maskedinput.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <!--<script src="js/i_tcmApplicationValidation.js" type="text/javascript"></script>-->

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
