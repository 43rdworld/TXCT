<?php
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    date_default_timezone_set('America/Chicago');
    ini_set("display_errors", 1);
    $selectEvent = '';
    $formSecret = '';

    if (strlen($_POST['labrea']) != 0) {							//=	CHECK TRAP FOR ONLINE ROBOTS. AN	EMPTY,HIDDEN FORM FIELD SET ON
        //		echo "Redirect page to home page";
        header("Location:default.php");								//= PREVIOUS PAGE.  IF ROBOT FILLS OUT FIELD, THIS WILL REDIRECT THEM TO
    }
    //= CHECK SUBMIT BUTTON STATUS
    //=====================================================================================================================================================
    //= CHECK TO MAKE SURE THE SUBMIT IS COMING FROM ANOTHER PAGE	=======================================================================================
    if(isset($_SERVER['HTTP_REFERER'])) {
        require("i_PDOFunctions.php");
        setRegistrationParams('10/01/2015','03/11/2016');
        //=	CHECK TO MAKE SURE THE SUBMIT IS COMING FROM THE T2T BILLING FORM 	===========================================================================
        if(strtolower(returnPageName($_SERVER['HTTP_REFERER'])) == 't2t_billing.php') {
            $referringPage = returnPageName($_SERVER['HTTP_REFERER']);
            //=	CHECK TO MAKE SURE THE SUBMIT BUTTON WAS PRESSED ON PREVIOUS PAGE	=======================================================================
            if (strtolower($_POST["submitT2TBilling"]) == 'submitt2tbilling') {
                $formSecret=$_POST['formSecret'];							            //= ASSIGN SECRET NUMBER FROM HIDDEN FIELD TO VARIABLE FOR COMPARISON TO STORED VALUE
                $connectionVar = 'GSNETX2014';
                require("i_PDOConnection.php");							            //=	CREATES ODBC DATA CONNECTION TO DATABASE
                //= CHECK TO SEE IF THIS RECORD HAS BEEN SUBMITTED BEFORE =================================================================================
                //= SET VARIABLES FOR ALL COMMON FIELDS ===================================================================================================
                session_start();
                setVars('formSecret:str,t2tFName:str,t2tLName:str,t2tAddress:str,t2tAddress2:str,t2tCity:str,t2tState:str,t2tZip:int,t2tPhone:str,t2tEmail:str,t2tAmount:int,t2tRefer:str,t2tReferringTroop:str,t2tReferringName:str,billingSame:bit,billingFName:str,billingLName:str,billingAddress:str,billingAddress2:str,billingCity:str,billingState:str,billingZip:int,billingPhone:str,billingEmail:str,billingSame:int,rand:str',1,0,'Troop to Troop Billing','Common Fields');
                //= SET ENCRYPTION FOR SENSITIVE DATA =====================================================================================================
                //echo "Rand: ".$rand."<br>";
                if(!isset($rand)) {
                    //echo "Random number is NOT set<br>";
                    $rand = mt_rand(1, 200000);
                } else {
                    //echo "Random number is set<br>";
                }
                if (ISSET($_POST['ccNum'])) {
                    $key = returnEncryptionKey($dbh, 'EXEC sp_GetDataPoint :tableName, :field, :id', 'tbl_Randoms', 'id', $rand);
                    //echo "CC Num: " . $_POST['ccNum'] . "<br>";
                    $ccNum = cc_encrypt($_POST['ccNum'], $key);
                    switch ($_POST['ccType']) {
                        case 'm':
                            $ccType = 'MasterCard';
                            break;
                        case 'a':
                            $ccType = 'American Express';
                            break;
                        case 'd':
                            $ccType = 'Discover';
                            break;
                        case 'v':
                            $ccType = 'Visa';
                            break;
                    }
                    $ccExpMonth = $_POST['ccExpMonth'];
                    $ccExpYear = $_POST['ccExpYear'];
                    $ccCVV2 = cc_encrypt($_POST['ccCVV2'], $key);
                    //$_SESSION['ccType'] = $ccType;
                    //$_SESSION["ccNum"] = $ccNum;
                    //$_SESSION["ccExpMonth"] = $ccExpMonth;
                    //$_SESSION["ccExpYear"] = $ccExpYear;
                    //$_SESSION["ccCVV2"] = $ccCVV2;
                    //$_SESSION["rand"] = $rand;
                    //echo "CC Num: " . $ccNum . "<br>";
                    //echo "CC Type: " . $ccType . "<br>";
                    //echo "CC Month: " . $ccExpMonth . "<br>";
                    //echo "CC Year: " . $ccExpYear . "<br>";
                    //echo "CC CVV2: " . $ccCVV2 . "<br>";
                    //echo "CC Num: " . cc_decrypt($ccNum, $key) . "<br>";
                    //echo "CC CVV2: " . cc_decrypt($ccCVV2, $key) . "<br>";
                    //echo "RANDOM:" . $rand."<br>";
                    //echo "RANDOM SESSION:" . $_SESSION['rand']."<br>";


                }
            } else {
                header("location: t2t.php");
            }

        } else {
            header("location: t2t.php");
        }
    } else {
        header("location: t2t.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Troop to Troop Online Donation Form - Review</title>
    <meta charset="UTF-8">
    <link href="css/txct.css" rel="stylesheet" type="text/css" />
    <script src="js/vendors/modernizr.js"></script>
</head>
<body onload="copyFormSecret('<?php echo $formSecret;?>');">
    <div>
        <?php include('i_cookieHeader.php');?>
        <!-- ## BEGIN FORM MAIN BODY ####################################################################################### -->
        <form name="theForm" id="theForm" method="post" action="t2t_Confirm.php" autocomplete="off">
            <div>
                <!-- ## BEGIN PAGE 1 ############################################################################################################################# -->
                <div class="no_js">
                    <div class="container showWhite" style="position:relative;">
                        <div class="span-24" style="height:100px;">&nbsp;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20 noscriptNotice" style="text-align:center;"><a href="http://enable-javascript.com/" target="_blank"><img src="img/javascriptDisabled.png" width="500" height="100" border="0" alt="" /></a></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="height:500px;">&nbsp;</div>
                        <div class="span-24" style="border-bottom:1px solid #ccc;"><br></div>
                    </div>
                </div>
                <div class="has_js">
                    <?php if( today>endDate) {?>
                        <div class="container showWhite" style="position:relative;">
                            <div class="span-24" style="height:100px;">&nbsp;</div>
                            <div class="span-24"><p>&nbsp;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24"><p>&#32;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="font-size:1.2em;text-align:center;">Project Troop to Troop has closed for another year.<br><br>Thanks to your generosity, we have been able to send <?php getCookieCount;?> boxes of Girl Scouts Cookies to the men and women in service to our country.</div>
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
                            <div class="span-24" style="margin-bottom:500px;"><br><br><br><br><br><br><br></div>
                        </div>
                    <?php } else { ?>
                    <div class="container showWhite">
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-18"><?php echo createPageNav(3,'1. Registration:t2t;2. Billing:t2t_billing;3. Review:t2t_review;4. Confirm:t2t_confirm');?></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop25">&#32;</div>
                        <div class="span-24">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-10 newSection"><img src="img/eventDonationReview.png" width="400" height="21" alt="" style="margin-top:19px;" /></div>
                        <div class="span-10 newSection"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20 dividerSection">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop10">&#32;</div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label class="columnHead">Item Descripton</label></div>
                        <div class="span-3 textCenter"><label class="columnHead">Quantity</label></div>
                        <div class="span-4 textCenter"><label class="columnHead">Price&#160;&#160;&#160;&#160;</label></div>
                        <div class="span-2 textRight"><label class="columnHead">Amount</label></div>
                        <div class="span-5"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop5">&#32;</div>
                        <div class="span-2 noPara"><p>&#32;</p></div>
                        <div class="span-3 noPara"><p>&#32;</p></div>
                        <div class="span-13 noPara"><div class="totalDivider">&#32;</div></div>
                        <div class="span-4 noPara">&#32;</div>
                        <div class="span-2 noPara last"><p>&#32;</p></div>
                        <div class="span-24 marginTop5">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Cookie Donation:</div>
                        <div class="span-3 textCenter marginTop1"><?php echo $t2tAmount;?>&#160;&#160;</div>
                        <div class="span-4 textCenter marginTop1">4.00&#160;&#160;</div>
                        <div class="span-2 textRight marginTop1"><?php echo "$".number_format((4*$t2tAmount),2);?></div>
                        <div class="span-2">&#160;</div>
                        <div class="span-3 textBold textGray">[&#32;<a href="t2t.php" class="editOrder inPageLink">Edit Order</a>&#32;]</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop15">&#32;</div>
                        <div class="span-2 noPara"><p>&#32;</p></div>
                        <div class="span-3 noPara"><p>&#32;</p></div>
                        <div class="span-13 noPara"><div class="totalDivider">&#32;</div></div>
                        <div class="span-4 noPara">&#32;</div>
                        <div class="span-2 noPara last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight marginTop5"><label class="columnHead">Total Donation:</label></div>
                        <div class="span-1"><p>&#32;</p></div>
                        <div class="span-8 textRight marginTop5"><label class="columnHead"><?php echo "$".number_format((4*$t2tAmount),2);?></label></div>
                        <div class="span-5"><p>&#32;</p></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 marginTop25">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-20 headerSection"><img src="img/donorInformationReview.png" width="400" height="21" style="border:none;" alt="" /></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>
                        <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                        <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 height10">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Name:</label></div>
                        <div class="span-6 inputTop marginTop1"><?php echo stripslashes(stripslashes($t2tFName)).' '.stripslashes(stripslashes($t2tLName));?> </div>
                        <div class="span-5"><p>&#32;</p></div>
                        <div class="span-3 textBold textGray">[&#32;<a href="t2t.php" class="editOrder inPageLink">Edit Information</a>&#32;]</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 formFieldSpacer2">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Address:</label></div>
                        <div class="span-6 inputTop marginTop1">
                            <?php
                            echo stripslashes(stripslashes($t2tAddress));
                            if(trim(strlen($t2tAddress2))!= 0) {
                                echo "<br>".stripslashes(stripslashes($t2tAddress2));
                            }
                            echo "<br />".stripslashes(stripslashes($t2tCity)).', '.$t2tState.'&#160;&#160;'.$t2tZip;
                            ?>
                        </div>
                        <div class="span-8"><p>&#32;</p></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 formFieldSpacer2">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Phone:</label></div>
                        <div class="span-6 inputTop marginTop1"><?php echo $t2tPhone;?> </div>
                        <div class="span-5"><p>&#32;</p></div>
                        <div class="span-3">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24 formFieldSpacer2">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Email Address:</label></div>
                        <div class="span-6 inputTop marginTop1"><?php echo $t2tEmail;?> </div>
                        <div class="span-5"><p>&#32;</p></div>
                        <div class="span-3">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>
                        <?php
                        if($t2tRefer == 'gs') {
                            echo "<div class=\"span-24 formFieldSpacer2\">&#32;</div>";
                            echo "<div class=\"span-2\"><p>&#32;</p></div>";
                            echo "<div class=\"span-6 textRight review\"><label>Referring Troop:</label></div>";
                            echo "<div class=\"span-6 inputTop marginTop1\">".$t2tReferringTroop."</div>";
                            echo "<div class=\"span-5\"><p>&#32;</p></div>";
                            echo "<div class=\"span-3\">&#32;</div>";
                            echo "<div class=\"span-2 last\"><p>&#32;</p></div>";
                            echo "<div class=\"span-24\">&#32;</div>";
                            echo "<div class=\"span-24 formFieldSpacer2\">&#32;</div>";
                            echo "<div class=\"span-2\"><p>&#32;</p></div>";
                            echo "<div class=\"span-6 textRight review\"><label>Referring Scout:</label></div>";
                            echo "<div class=\"span-6 inputTop marginTop1\">".$t2tReferringName."</div>";
                            echo "<div class=\"span-5\"><p>&#32;</p></div>";
                            echo "<div class=\"span-3\">&#32;</div>";
                            echo "<div class=\"span-2 last\"><p>&#32;</p></div>";
                            echo "<div class=\"span-24\">&#32;</div>";
                        }
                        ?>
                        <div class="span-24 marginTop25">&#32;</div>
                        <div class="span-24">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-10 newSection"><img src="img/billingInformationReview.png" width="400" height="21" alt="" /></div>
                        <div class="span-10 newSection"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2" style="height:2px;"><p>&#32;</p></div>
                        <div class="span-20 dividerSection" style="height:2px;">&#32;</div>
                        <div class="span-2 last" style="height:2px;"><p>&#32;</p></div>
                        <div class="span-24 marginTop10">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Cardholder:</label></div>
                        <div class="span-6">
                            <div class="marginLeft10">
                                <?php
                                $billingInfo  = stripslashes($billingFName).' '.stripslashes($billingLName)."<br>";
                                $billingInfo .= stripslashes($billingAddress)."<br>";
                                if($billingAddress2 != '') {
                                    $billingInfo .= stripslashes($billingAddress2)."<br>";
                                }
                                $billingInfo .= stripslashes($billingCity).", ".strtoupper($billingState)."&#32;&#32;".$billingZip."<br>";
                                $billingInfo .= $billingPhone."<br>".$billingEmail;
                                echo $billingInfo;
                                ?>
                            </div>
                        </div>
                        <div class="span-5"><p>&#32;</p></div>
                        <div class="span-3 textBold textGray">[&#32;<a href="t2t_billing.php" class="editOrder inPageLink">Edit Billing</a>&#32;]</div>
                        <div class="span-2 last">&#32;</div>
                        <div class="span-24 marginTop5">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-4"><p>&#32;</p></div>
                        <div class="span-8 dividerSectionSm">&#32;</div>
                        <div class="span-2"><div>&#32;</div></div>
                        <div class="span-6"><div>&#32;</div></div>
                        <div class="span-2"><div>&#32;</div></div>
                        <div class="span-2 last"><div>&#32;</div></div>
                        <div class="span-24"><div>&#32;</div></div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Card Type:</label></div>
                        <div class="span-6 marginLeft10"><?php echo $ccType;?></div>
                        <div class="span-1">&#32;</div>
                        <div class="span-7">&#32;</div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Card Number:</label></div>
                        <div class="span-6 marginLeft10"><?php echo maskCreditCard(cc_decrypt($ccNum,$key));?></div>
                        <div class="span-1">&#32;</div>
                        <div class="span-7"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Expiration Date:</label></div>
                        <div class="span-6 marginLeft10"><?php echo $ccExpMonth.'/20'.$ccExpYear;?></div>
                        <div class="span-1"><p>&#32;</p></div>
                        <div class="span-7"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#32;</div>
                        <div class="span-2"><p>&#32;</p></div>
                        <div class="span-6 textRight review"><label>Security Code:</label></div>
                        <div class="span-6 marginLeft10"><?php echo cc_decrypt($ccCVV2,$key);?></div>
                        <div class="span-1"><p>&#32;</p></div>
                        <div class="span-7" style="margin-top:2px;"></div>
                        <div class="span-2 last"><p>&#32;</p></div>
                        <div class="span-24" style="clear:both;">&#160;</div>
                        <div class="span-24"><br /></div>
                        <div class="container showWhite">
                            <div class="span-24"><p>&nbsp;</p></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="background-color:green;height:6px">&#32;</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24">&#32;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-11"><input name="submitForm" type="submit" id="submitForm" value="ggg" class="checkoutButton marginTop5" title="Submit Payment and Checkout" tabindex="99" style=margin-top:17px;"></div>
                            <div class="span-9 textRight paddingTop5">
                                <?php include('i_securityVendors.php');?>
                            </div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="border-bottom:1px solid #ccc;"><br><br></div>
                        </div>
                        <?php }?>
                    </div>
                    <?php include('i_cookieFooter.php');?>
                </div>
            </div>
            <!-- ##################################################################################################################################### -->
            <div style="clear:both;">
                <br><br>
                <input type="hidden" name="submitReview" id="submitReview" value="submitT2TReview" tabindex="-1" />
                <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                <input type="hidden" name="formType" id="formType" value="troop2troop" tabindex="-1" placeholder="Form Type" />
                <input type="hidden" name="t2tFName" id="t2tFName"  value="<?php echo stripslashes(stripslashes($t2tFName));?>" placeholder="t2tFName" tabindex="-1" />
                <input type="hidden" name="t2tLName" id="t2tLName"  value="<?php echo stripslashes(stripslashes($t2tLName));?>" placeholder="t2tLName" tabindex="-1" />
                <input type="hidden" name="t2tAddress" id="t2tAddress"  value="<?php echo stripslashes(stripslashes($t2tAddress));?>" placeholder="t2tAddress" tabindex="-1" />
                <input type="hidden" name="t2tAddress2" id="t2tAddress2"  value="<?php echo stripslashes(stripslashes($t2tAddress2));?>" placeholder="t2tAddress2" tabindex="-1" />
                <input type="hidden" name="t2tCity" id="t2tCity"  value="<?php echo stripslashes(stripslashes($t2tCity));?>" placeholder="t2tCity" tabindex="-1" />
                <input type="hidden" name="t2tState" id="t2tState"  value="<?php echo $t2tState;?>" placeholder="t2tState" tabindex="-1" />
                <input type="hidden" name="t2tZip" id="t2tZip"  value="<?php echo $t2tZip;?>" placeholder="t2tZip" tabindex="-1" />
                <input type="hidden" name="t2tPhone" id="t2tPhone"  value="<?php echo $t2tPhone;?>" placeholder="t2tPhone" tabindex="-1" />
                <input type="hidden" name="t2tEmail" id="t2tEmail"  value="<?php echo $t2tEmail;?>" placeholder="t2tEmail" tabindex="-1" />
                <input type="hidden" name="t2tAmount" id="t2tAmount"  value="<?php echo $t2tAmount;?>" placeholder="t2tAmount" tabindex="-1" />
                <input type="hidden" name="t2tRefer" id="t2tRefer"  value="<?php echo $t2tRefer;?>" placeholder="t2tRefer" tabindex="-1" />
                <input type="hidden" name="t2tReferringTroop" id="t2tReferringTroop"  value="<?php echo $t2tReferringTroop;?>" placeholder="t2tReferringTroop" tabindex="-1" />
                <input type="hidden" name="t2tReferringName" id="t2tReferringName"  value="<?php echo $t2tReferringName;?>" placeholder="t2tReferringName" tabindex="-1" />
                <input type="hidden" name="billingSame" id="billingSame" value="<?php echo $billingSame;?>" placeholder = " billingSame" tabindex="-1" />
                <input type="hidden" name="billingFName" id="billingFName" value="<?php echo $billingFName;?>" placeholder = " billingFName" tabindex="-1" />
                <input type="hidden" name="billingLName" id="billingLName" value="<?php echo $billingLName;?>" placeholder = " billingLName" tabindex="-1" />
                <input type="hidden" name="billingAddress" id="billingAddress" value="<?php echo $billingAddress;?>" placeholder = " billingAddress" tabindex="-1" />
                <input type="hidden" name="billingAddress2" id="billingAddress2" value="<?php echo $billingAddress2;?>" placeholder = " billingAddress2" tabindex="-1" />
                <input type="hidden" name="billingCity" id="billingCity" value="<?php echo $billingCity;?>" placeholder = " billingCity" tabindex="-1" />
                <input type="hidden" name="billingState" id="billingState" value="<?php echo $billingState;?>" placeholder = " billingState" tabindex="-1" />
                <input type="hidden" name="billingZip" id="billingZip" value="<?php echo $billingZip;?>" placeholder = " billingZip" tabindex="-1" />
                <input type="hidden" name="billingPhone" id="billingPhone" value="<?php echo $billingPhone;?>" placeholder = " billingPhone" tabindex="-1" />
                <input type="hidden" name="billingEmail" id="billingEmail" value="<?php echo $billingEmail;?>" placeholder = " billingEmail" tabindex="-1" />
                <input type="hidden" name="ccType" id="ccType" value="<?php echo $ccType;?>" placeholder = " ccType" tabindex="-1" />
                <input type="hidden" name="ccNum" id="ccNum" value="<?php echo $ccNum;?>" placeholder = " ccNum" tabindex="-1" />
                <input type="hidden" name="ccExpMonth" id="ccExpMonth" value="<?php echo $ccExpMonth;?>" placeholder = " ccExpMonth" tabindex="-1" />
                <input type="hidden" name="ccExpYear" id="ccExpYear" value="<?php echo $ccExpYear;?>" placeholder = " ccExpYear" tabindex="-1" />
                <input type="hidden" name="ccCVV2" id="ccCVV2" value="<?php echo $ccCVV2;?>" placeholder = " ccCVV2" tabindex="-1" />
                <input type="hidden" name="rand" id="rand" value="<?php echo $rand;?>" placeholder = " random num" tabindex="-1" />
                <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                <div style="display: none;"><a href="https://forms.gsnetx.org/chap.php">servo-staircase</a></div>
            </div>
        </form>
    </div>
    <script src="//code.jquery.com/jquery-latest.min.js" ></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
    <script src="js/vendors/jquery.maskedinput.js"></script>
    <script src="js/vendors/jquery.maskMoney.js"></script>
    <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
    <script src="js/i_TCTValidation.js" type="text/javascript"></script>
</body>


</html>
