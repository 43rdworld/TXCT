<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    $conn = '';

    require("i_PDOConnection.php");								    //=	CREATES DATA CONNECTION TO DATABASE
    require("i_PDOFunctions.php");								    //= LOAD FORM FUNCTIONS
    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM

    setRegistrationParams('10/01/2015','11/17/2015');               //= SET START AND STOP PARAMETERS FOR THE FORM

    if(isset($_POST['tcmUpdateSubmit'])) {
        if (strtolower($_POST['tcmUpdateSubmit']) == 'tcmupdatesubmit') {
            //if (($_POST['suSearch'] != '') && ($_POST['year'] != '')) {
            setVars('formSecret:str,volFName:str,volLName:str,volEmail:str,volPhone:str,volTroop:str,volSU:str,resendEmail:str,', 0, 0, 'TCM/PP Admin Form');

            try {
                //echo "<b>Submit to Database</b><br>";
                $stmt = $dbh_write->prepare('
                EXEC sp_Update_TCT_TCMApplications @formSecret=:formSecret,@volFName=:volFName,@volLName=:volLName,@volEmail=:volEmail,@volPhone=:volPhone,@volTroop=:volTroop,@volSU=:volSU');
                $stmt->bindParam(':formSecret',$formSecret, PDO::PARAM_STR);
                $stmt->bindParam(':volFName',$volFName, PDO::PARAM_STR);
                $stmt->bindParam(':volLName',$volLName, PDO::PARAM_STR);
                $stmt->bindParam(':volEmail',$volEmail, PDO::PARAM_STR);
                $stmt->bindParam(':volPhone',$volPhone, PDO::PARAM_STR);
                $stmt->bindParam(':volTroop',$volTroop, PDO::PARAM_STR);
                $stmt->bindParam(':volSU',$volSU, PDO::PARAM_STR);
                $stmt->execute();

                $update = $_POST['formSecret'];
                //echo "Update Data";
            } catch (Exception $dbError) {
                echo "CRAP: ".$dbError;
            }

            //header('location:tctAdmin.php');

            if ($_POST['resendEmail'] == 1) {
                //echo 'Resend Email';
            } else {
                //echo 'Do Not Resend Email';
            }
        }
    }

    //= QUERY DATABASE FOR RESULTS FROM SEARCH ======================================================================================================================
    $query = $dbh->prepare("sp_GetTCT_TCMRegistrations_All");
    $query->execute();
    $data = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>TXCT Parent Permission and TCM Admininstrator</title>
        <meta charset="UTF-8">
        <link href="css/screen.css" rel="stylesheet" type="text/css" />
        <link href="css/txctAdmin.css" rel="stylesheet" type="text/css" />
        <script src="js/vendors/modernizr.js"></script>
    </head>
    <body>
    <div>
        <?php include('i_cookieHeader.php');?>
        <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>We know you can't wait to get started but give us a little more time to make the place presentable.<br><br>The Parent Permission form will be available soon.<br><br><br></div>
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
                            <div class="span-24"><img src="img/hdr_Admin.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>Parent Permission and TCM Application Admin</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:20px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-6 plus1 paddingLeft10"><input type="radio" name="tctAdmin" id="tcmAdmin" value="tcm"><label for="tcmAdmin">Edit TCM Registrations</label></div>
                            <div class="span-12 plus1"><input type="radio" name="tctAdmin" id="ppAdmin" value="pp"><label for="ppAdmin">Edit Parent Permission Registrations</label></div>
                            <div class="span-4 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:1px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20">
                                <div id="tcmAdmin_Wrapper" style="display:block;">
                                    <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_TCMAdmin.png" width="400" height="21" alt="" /></div>
                                    <div class="span-20"><p>&#32;</p></div>
                                    <table cellpadding="0" cellspacing="0" class="tctAdmin" id="txct_TCMAdmin" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Register Date</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email Address</th>
                                            <th>Troop</th>
                                            <th>SU</th>
                                            <th>Email Sent</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($data as $row) {
                                                    $i++;
                                                    if ($update == $row['formSecret']) {
                                                        $class = "updatedRow";
                                                    }else {
                                                        $class = "";
                                                    }
                                            ?>
                                            <tr class="<?php echo $class;?>">
                                                <td><?php echo $row['submitDate'];?></td>
                                                <td><?php echo $row['volFName'];?></td>
                                                <td><?php echo $row['volLName'];?></td>
                                                <td><?php echo $row['volEmail'];?></td>
                                                <td><?php echo $row['volTroop'];?></td>
                                                <td><?php echo $row['volSU'];?></td>
                                                <td><?php echo $row['emailSentDate'];?></td>
                                                <td><img src="img/icon_Edit.png" class="editRecord" width="17" height="17" border="0" alt="Edit Record"><img src="img/icon_Delete.png" width="17" height="17" alt="Delete Record" style="margin-left:15px;"></td>
                                            </tr>
                                            <tr id="tcm<?php echo $i;?>" class="record" style="display:none;">
                                                <td colspan="8">
                                                    <form method="post" name="theForm" id="theForm">
                                                        <table cellpadding="0" cellspacing="0" class="tctEditData" width="100%">
                                                            <tr>
                                                                <td class="tctEditCell">F Name<input type="text" name="volFName" class="form_Field60" value="<?php echo $row['volFName'];?>"></td>
                                                                <td class="tctEditCell">L Name<input type="text" name="volLName" class="form_Field60" value="<?php echo $row['volLName'];?>"></td>
                                                                <td class="tctEditCell">Email<input type="text" name="volEmail" class="form_Field100" value="<?php echo $row['volEmail'];?>"></td>
                                                                <td class="tctEditCell">Phone<input type="text" name="volPhone" class="form_Field95 adminEditPhone" value="<?php echo $row['volPhone'];?>"></td>
                                                                <td class="tctEditCell">Troop<input type="text" name="volTroop" class="form_Field35" value="<?php echo $row['volTroop'];?>"></td>
                                                                <td class="tctEditCell">SU<input type="text" name="volSU" class="form_Field30" value="<?php echo $row['volSU'];?>"></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" class="tctUpdateCell">
                                                                    <div class="adminDivider">&#32;</div>
                                                                    <!--<div style="float:left;"><input type="checkbox" name="resendEmail" id="resendEmail--><?php //echo $i;?><!--" value="1" onClick="copyCheck(this.value);"><label for="resendEmail--><?php //echo $i;?><!--">Re-send email</label></div>-->
                                                                    <input type="submit" value="Update" style="float:right;margin-right:3px;">
                                                                    <input type="hidden" name="tcmUpdateSubmit" id="tcmUpdateSubmit" value="tcmUpdateSubmit" />
                                                                    <input type="hidden" name="formSecret" id="formSecret" value="<?php echo $row['formSecret'];?>">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="ppAdmin_Wrapper" style="display:none;">
                                    <div class="span-20 newSection" style="height:21px;"><img src="img/hdr_PPAdmin.png" width="400" height="21" alt="" /></div>
                                    <div class="span-20"><p>&#32;</p></div>
                                </div>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                       </div>
                    <?php }?>
                </div>
                <?php include('i_cookieFooter.php');?>
            </div>
            <!-- ############################################################################################################### -->
            <div style="clear:both;">
                <br><br>
                <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="text" name="labrea" id="labrea" tabindex="-1" /></div>
                <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
            </div>
    </div>

    <script src="//code.jquery.com/jquery-latest.min.js" ></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/vendors/jquery.tablesorter.js"></script>
    <script src="js/vendors/jquery.maskedinput.js"></script>
    <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
    <script src="js/i_parentPermissionValidation.js" type="text/javascript"></script>



    </body>
</html>
