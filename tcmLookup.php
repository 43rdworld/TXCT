<?php
    // form source from http://bassistance.de/
    error_reporting (E_ALL ^ E_NOTICE);
    header('Content-Type: text/html; charset=utf-8');
    header('X-UA-Compatible: IE=edge,chrome=1');
    header('Cache-Control: max-age=30, must-revalidate');
    ini_set("display_errors", 1);
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    date_default_timezone_set('America/Chicago');
    require("i_PDOConnection.php");								    //=	CREATES DATA CONNECTION TO DATABASE =========================================================
    require("i_PDOFunctions.php");								    //= LOAD FORM FUNCTIONS =========================================================================
    require_once("PHPExcel.php");

    setRegistrationParams('10/01/2015','03/01/2016');               //= SETS DATES TO TURN FORM ON AND OFF ==========================================================
    session_start();												//= START SESSION TO PREVENT RE-SUBMITTING FORM =================================================
    $formSecret=md5(uniqid(rand(), true));							//= SET SECRET NUMBER TO USE IN DUPLICATE SUBMISSION DETECTION ==================================

    //= RETREIVE SEARCH TERMS FROM FORM AFTER POST ==================================================================================================================
    if(isset($_POST['lookupSubmit'])) {
        if (strtolower($_POST['lookupSubmit']) == 'lookupsubmit') {
            if (($_POST['suSearch'] != '') && ($_POST['year'] != '')) {
                $year = $_POST['year'];
                $search = preg_replace("/[^0-9,.]/", "", $_POST['suSearch']);
                //echo $search."<br>";
                //echo $year;
                $showButton = "display:block";

                //= QUERY DATABASE FOR RESULTS FROM SEARCH ======================================================================================================================
                $query = $dbh->prepare("sp_GetTCT_TCMRegistrations 2015,'".$search."'");
                $query->execute();
                $data = $query->fetchAll();

                //= CREATE EXCEL SPREADSHEET FOR DOWNLOAD =======================================================================================================================
                $objPHPExcel = new PHPExcel();
                //echo date('g:i:s A') , " Set document properties" , EOL;
                $objPHPExcel->getProperties()->setCreator("Girl Scouts of Northeast Texas")
                    ->setLastModifiedBy("Girl Scouts of Northeast Texas")
                    ->setTitle("SU ".$suID." Troop Cookie Manager Roster Report for 2015 - 2016")
                    ->setSubject("SU ".$suID." Troop Cookie Manager Roster Report for 2015 - 2016")
                    ->setDescription("TCM Roster Report for Office 2007 XLSX, generated using PHP classes.")
                    ->setKeywords("Cookies, TCM, Troop Cookie Manager")
                    ->setCategory("TCM Rosters");
                // SET DIRECTORY TO SAVE FILES IN ===============================================================================================================================
                $rosterDir = 'suRosters\TCM_Roster_for_SU_';
                //= ADD DATA ====================================================================================================================================================
                //echo date('g:i:s A') , " Add some data" , EOL;
                $rowCount = 1;
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Submit Date')
                    ->setCellValue('B1', 'Troop #')
                    ->setCellValue('C1', 'TCM Name')
                    ->setCellValue('D1', 'Email Sent');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF666666');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getBorders()->getAllBorders()->applyFromArray(
                    array(
                        'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                        'color' => array(
                            'rgb' => '444444'
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()
                    ->getStyle('B'.$rowCount)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHPExcel->getActiveSheet()
                    ->getStyle('D'.$rowCount)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //= POPULATE CELLS WITH DATA ====================================================================================================================================
                foreach ($data as $row) {
                    $rowCount++;
                    if ($row['emailSent'] == 0 || $row['emailSent'] == '') {
                        if (is_null($row['emailSentDate'])) {
                            $email = '';
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_LTGRAY);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFeeeeee');
                            $objPHPExcel->getActiveSheet()
                                ->getStyle('B'.$rowCount)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()
                                ->getStyle('D'.$rowCount)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getBorders()->getAllBorders()->applyFromArray(
                                array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array(
                                        'rgb' => '999999'
                                    )
                                )
                            );
                        } else {
                            $email = 'No';
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKYELLOW);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFfffac6');
                            $objPHPExcel->getActiveSheet()
                                ->getStyle('B'.$rowCount)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()
                                ->getStyle('D'.$rowCount)
                                ->getAlignment()
                                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getBorders()->getAllBorders()->applyFromArray(
                                array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                                    'color' => array(
                                        'rgb' => '999999'
                                    )
                                )
                            );
                        }
                    } else {
                        $email = 'Yes';
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_DARKGREEN);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFd5ffd5');
                        $objPHPExcel->getActiveSheet()
                            ->getStyle('B'.$rowCount)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $objPHPExcel->getActiveSheet()
                            ->getStyle('D'.$rowCount)
                            ->getAlignment()
                            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.":D".$rowCount)->getBorders()->getAllBorders()->applyFromArray(
                            array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
                                'color' => array(
                                    'rgb' => '999999'
                                )
                            )
                        );
                    }
                    $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $row['submitDate']);
                    $objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $row['troop']);
                    $objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $row['leaderName']);
                    $objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $email);
                }
                //= SET COLUMN WIDTHS ===========================================================================================================================================
                //echo date('g:i:s A') , " Set column widths" , EOL;
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                //= SET FONTS AND STYLES ========================================================================================================================================
                //echo date('g:i:s A') , " Set fonts" , EOL;
                $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true)->setSize(13)->getColor()->setRGB('fafafa');;

                //= SET HEADER AND FOOTER. WHEN NO DIFFERENT HEADERS FOR ODD/EVEN ARE USED, ODD HEADER IS ASSUMED ===============================================================
                //echo date('g:i:s A') , " Set header/footer" , EOL;
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BPersonal cash register&RPrinted on &D');
                $objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

                //= SET PAGE ORIENTATION AND SIZE ===============================================================================================================================
                //echo date('g:i:s A') , " Set page orientation and size" , EOL;
                $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
                $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

                //= RENAME WORKSHEET ============================================================================================================================================
                //echo date('g:i:s A') , " Rename worksheet" , EOL;
                $objPHPExcel->getActiveSheet()->setTitle($suID.' '.'TCM Roster');

                //= SET ACTIVE SHEET INDEX TO THE FIRST SHEET, SO EXCEL OPENS THE FILE ON THE FIRST SHEET =======================================================================
                $objPHPExcel->setActiveSheetIndex(0);

                //= SAVE THE FILE IN EXCEL 2007 (.XLSX) FORMAT ==================================================================================================================
                //echo date('g:i:s A') , " Write to Excel2007 format" , EOL;

                $callStartTime = microtime(true);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

                $objWriter->save($rosterDir.$search.'.xlsx');
                $callEndTime = microtime(true);
                $callTime = $callEndTime - $callStartTime;
                //echo date('g:i:s A') , " File written to " , $rosterDir.$search.'.xlsx', EOL;
                //echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
                //echo date('G:i:s A') , " Done writing file" , EOL;
                //echo 'File has been created in ' , getcwd() , EOL;






            } else {
                if (($_POST['year'] == '') && ($_POST['suSearch'] == '')) {
                    $msg = "Please enter a Report Year and Service Unit Number";
                } else if ($_POST['suSearch'] == '') {
                    $msg = "Please enter a Service Unit Number";
                } else if ($_POST['year'] == '') {
                    $msg = "Please enter a Report Year";
                }
                $showButton = "display:none !important;";
            }
        } else {
            //echo "wha?";
            $showButton = "display:none !important;";
        }

    } else {
        $showButton = "display:none !important;";
    }
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>TCM Registration Lookup</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <link href="css/txct.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="js/vendors/modernizr.js"></script>
        <style type="text/css">
            table {border:1px solid #999;border-collapse:collapse;width:90%;margin: 0 auto;}
            th {font-size:1.2em; background-color:#444;font-weight:bold;color:#eee;border:1px solid #999;border-collapse:collapse;}
            td {font-size:1em; background-color:#fff !important;border:1px solid #ccc;border-collapse:collapse;}
            .noBorder {border:none;}
            .regLookup_Data {text-align:center;}
            .reportSearch {font-size:8pt;width:175px;padding:3px;}
            #download {font-size:1em; width:150px; padding:2px;float:right;}
            #submit {font-size:1em; width:75px; padding:2px;}
            /*.reportLookupTable {border:1px solid #999;border-collapse:collapse;text-align:left;}*/
            /*.reportLookupTH {font-size:1.2em;font-weight:bold;border:1px solid #999;border-collapse:collapse;padding:0  4px;background-color:#444;color:#eee;text-align:center;}*/
            /*.reportLookupTD {text-align:center;border:1px solid #999;border-collapse:collapse;padding:4px;font:8pt Verdana, Geneva, sans-serif;color:#333;}*/
            .reportDivider {margin:10px auto 25px auto;width:250px;height:1px;border-top:2px dashed #ccc;}
            .reportHeader {font:1.3em Verdana, Geneva, sans-serif;font-weight:bold;margin:10px 0 5px 35px;color:#333;}
            .reportReceived {background-color:#d5ffd5;color:green;}
            .reportNotReceived {background-color:#ffe5e5;color:#900;}
            /*.accountBalance {text-align:right !important;padding-right:45px;}*/
            /*.alignLeft {text-align:left;}*/
        </style>
    </head>
    <body onload="copyFormSecret('<?php echo $formSecret;?>');">
    <?php include_once("i_AnalyticsTracking.php") ?>
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
                            <div class="span-20" style="font-size:1.3em;text-align:center;"><br><br><br>Online registration for the 2015 Parent/Guardian Permission & Responsibility Form has closed.<br><br><br></div>
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
                            <div class="span-24" style="margin-bottom:500px;"></div>
                        </div>
                    <?php } else { ?>
                        <div class="container showWhite">
                            <div><form method="post" name="theForm" id="theForm" action="" style="width:600px;text-align:left;""></div>
                            <div class="span-24 marginBottom20"><img src="img/hdr_ParentPermissionResponsibility.png" width="960" height="175" alt="" /></div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20"><h1>TCM Registration Lookup</h1></div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                            <div class="span-2"><p>&#32;</p></div>
                            <div class="span-20" style="font-size:1.2em;">Use this tool to lookup a list of service unit troops to see who has submitted a TCM Registration Agreement.</div>
                            <div class="span-2 last"><p>&#32;</p></div>
                            <div class="span-24" style="height:10px;">&nbsp;</div>
                                <div class="span-2"><p>&#32;</p></div>
                                <div class="span-18" style="text-align:center;">
                                    <div style="margin:5px 0 12px 0;color:#c00;font-weight:bold;"><?php echo $msg;?></div>
                                    <table cellpadding="0" cellspacing="0" class="noBorder">
                                        <tr>
                                            <td width="140" class="noBorder"></td>
                                            <td style="text-align:center;" class="noBorder">
                                                <input type="text" name="suSearch" id="suSearch" value="" class="reportSearch key-numeric" placeholder="Enter Service Unit Number" size="23" />&nbsp;&nbsp;&nbsp;
                                                <input type="submit" name="submit" id="submit" value="Submit" class="reportSearch" />
                                            </td>
                                            <td width="140" class="noBorder"><a href="suRosters\TCM_Roster_for_SU_<?php echo $search;?>.xlsx" title="Download SU <?php echo $search;?> TCM Roster" alias="Download SU <?php echo $search;?> TCM Roster" style="<?php echo $showButton;?>">Download TCM Roster</a></td>
                                        </tr>
                                        <tr>
                                            <td class="noBorder"></td>
                                            <td class="noBorder">
                                                <div style="text-align:center;padding-right:90px;font-size:.8em;color:#999;font-style:italic;">(numbers only)</div>
                                            </td>
                                            <td class="noBorder"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="span-4 last"><p>&#32;</p></div>
                                <div class="span-24" style="margin-bottom:100px;">
                                <?php if ($search != '') {?>
                                    <div class="span-2"><p>&#32;</p></div>
                                    <div class="span-18">
                                        <div class="reportDivider">&#32;</div>
                                        <div class="reportHeader"><?php echo $year;?> TCM Registrations for SU <?php echo $search;?><div style="font-size:.7em;color:#666;font-weight:normal;font-style:italic;float:right;margin:3px 35px 0 0 !important;">(as of <?php echo date("n/j/y: g:i a");?>)</div></div>
                                        <table cellpadding="0" cellspacing="0" style="border:1px solid #ccc;border-collapse:collapse;">
                                            <tr>
                                                <th width="25%">Submit Date</th>
                                                <th width="15%">Troop #</th>
                                                <th width="35%">TCM Name</th>
                                                <th width="15%" style="text-align: center;">Email Sent</th>
                                            </tr>
                                            <?php
                                                foreach ($data as $row) {
                                                    if ($row['emailSent'] == 0 || $row['emailSent'] == '') {
                                                        if (is_null($row['emailSentDate']) && !empty($row['submitDate'])) {
                                                            $email = 'No';
                                                            $style = "style=\"background-color:#fffac6 !important;;color:#c60;\"";
                                                            //$style = "style=\"background-color:#ffe5e5 !important;;color:#900;\"";
                                                        } else {
                                                            $email = '';
                                                            //$style = "style=\"background-color:#fffac6 !important;;color:#c60;\"";
                                                            $style = "style=\"background-color:#eee !important;color:#999;\"";
                                                        }
                                                    } else {
                                                        $email = 'Yes';
                                                        $style = "style=\"background-color:#d5ffd5 !important;color:green;\"";
                                                    }

                                            ?>
                                            <tr>
                                                <td <?php echo $style;?>><?php echo str_replace("-","/",$row['submitDate']);?></td>
                                                <td class="regLookup_Data" <?php echo $style;?>><?php echo $row['troop'];?></td>
                                                <td <?php echo $style;?>><?php echo $row['leaderName'];?></td>
                                                <td class="regLookup_Data" <?php echo $style;?>><?php echo $email;?></td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </div>
                                    <div class="span-4 last"><p>&#32;</p></div>
                                    <div class="span-24 formFieldSpacer">&#32;</div>
                                <?php }?>
                                </div>
                                <div class="span-24">
                                    <input type="hidden" name="lookupSubmit" id="lookupSubmit" value="lookupSubmit" />
                                    <input type="hidden" name="year" id="year" value="2015" />
                                </div>
                            <div></form></div>
                        </div>
                    <?php }?>
                </div>
                <?php include('i_cookieFooter.php');?>
            </div>
            <!-- ############################################################################################################### -->
            <div style="clear:both;">
                <br><br>
                <input type="hidden" name="submitRegistration" id="submitRegistration" value="submittshirtorder" tabindex="-1" />
                <input type="hidden" name="formSecret" id="formSecret" value="" tabindex="-1" placeholder="formSecret" />
                <input type="hidden" name="formType" id="formType" value="permission" tabindex="-1" placeholder="Form Type" />
                <input type="hidden" name="orderDeliveryLocation" id="orderDeliveryLocation" value="" placeholder="Order Delivery Location" tabindex="-1">
                <input type="hidden" name="orderTotalCopy" id="orderTotalCopy" value="" placeholder="Order Total Copy" tabindex="-1">
                <input type="hidden" name="orderItemized" id="orderItemized" value="" placeholder="Order Itemized" tabindex="-1">

                <input type="hidden" name="orderSTemp" id="orderSTemp" value="" placeholder="Order S" tabindex="-1">
                <input type="hidden" name="orderMTemp" id="orderMTemp" value="" placeholder="Order M" tabindex="-1">
                <input type="hidden" name="orderLTemp" id="orderLTemp" value="" placeholder="Order L" tabindex="-1">
                <input type="hidden" name="orderXLTemp" id="orderXLTemp" value="" placeholder="Order XL" tabindex="-1">
                <input type="hidden" name="order2XTemp" id="order2XTemp" value="" placeholder="Order 2X" tabindex="-1">
                <input type="hidden" name="order3XTemp" id="order3XTemp" value="" placeholder="Order 3X" tabindex="-1">
                <div class="formLableH">Ignore if visible: <label for="labrea">&#160;</label><input type="hidden" name="labrea" id="labrea" tabindex="-1" /></div>
                <div style="display: none;"><a href="https://webforms.gsnetx.org/numbshoe.php">representational-silhouette</a></div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" ></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
        <script src="js/i_texasCookieTime.js" type="text/javascript"></script>
        <!--<script src="js/i_TShirtOrderValidation.js" type="text/javascript"></script>-->
    </body>
</html>
