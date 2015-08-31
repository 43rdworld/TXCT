<?php
    $arrPrint = explode("|",$_GET['print']);
    $payee = stripslashes($arrPrint[0])."<br>";
    setlocale(LC_MONETARY,"en_US");
//    echo "<div style='font-size:6pt;'>";
//    echo " 0. Name: ".$arrPrint[0]." "."<br>";
//    echo " 1. Address: ".$arrPrint[1]."<br>";
//    echo " 2. City, ST, Zip: ".$arrPrint[2]."<br>";
//    echo " 3. Auth Code: ".$arrPrint[3]."<br>";
//    echo " 4. Auth Invoice: ".$arrPrint[4]."<br>";
//    echo " 5. Total Amount: ".$arrPrint[5]."<br>";
//    echo " 6. Num Tickets: ".$arrPrint[6]."<br>";
//    echo " 7. Num Tables: ".$arrPrint[7]."<br>";
//    echo " 8. Sponsor Level: ".$arrPrint[8]."<br>";
//    echo " 9. Donation Amout: ".$arrPrint[9]."<br>";
//    echo "10. Donation Anon: ".$arrPrint[10]."<br>";
//    echo "11. Tribute 1: ".$arrPrint[11]."<br>";
//    echo "12. Tribute 2: ".$arrPrint[12]."<br>";
//    echo "13. Tribute 3: ".$arrPrint[13]."<br>";
//    echo "14. Tribute 4: ".$arrPrint[14]."<br>";
//    echo "15. Event Type: ".$arrPrint[15]."<br>";
//    echo "</div>";
    $numTickets = $arrPrint[6]/150;
    $numTables = $arrPrint[7]/1500;
    if ($arrPrint[8] == 'bronze') {
        $sponsorAmt = 2500;
    } else if ($arrPrint[8] == 'silver') {
        $sponsorAmt = 5000;
    } else {
        $sponsorAmt = '';
    }


//    if ($arrPrint[8] != "") {														//		CHECK TO DETERMINE IF ANY RAFFLE TICKETS WERE ORDERED
//        $discountNumber = 5;														//		SET THE DISCOUNT POINT FOR TICKETS
//        $discountRaffleTickets = (intval($arrPrint[8] / 5))*100;					//		DIVIDE THE NUMBER OF TICKETS BY THE DISCOUNT POINT AND MULTIPLY BY 100
//        $remainderRaffleTickets = (intval($arrPrint[8] % 5) * 25);				//		GET THE MODULUS OF THE NUMBER OF TICKETS DIVIDED BY 12 FOR THE NUMBER OF INDIVIDUAL TICKETS
//        $totalRaffleAmount = ($discountRaffleTickets + $remainderRaffleTickets);	//		SUM THE SUB TOTALS																																						=
//    } else {
        $totalRaffleAmount = 0;
//    }
    $totalAmount = '';
    if($arrPrint[15] == 'ticket') {
        $totalAmount = str_replace(",","",$arrPrint[6]) + str_replace(",","",$arrPrint[11]) + str_replace(",","",$arrPrint[12]) + str_replace(",","",$arrPrint[13]) + str_replace(",","",$arrPrint[14]);
    } elseif ($arrPrint[15] == 'table') {
        $totalAmount = str_replace(",","",$arrPrint[7]) + str_replace(",","",$arrPrint[11]) + str_replace(",","",$arrPrint[12]) + str_replace(",","",$arrPrint[13]) + str_replace(",","",$arrPrint[14]);
    } elseif ($arrPrint[15] == 'donate') {
        $totalAmount = str_replace(",","",$arrPrint[9]) + str_replace(",","",$arrPrint[11]) + str_replace(",","",$arrPrint[12]) + str_replace(",","",$arrPrint[13]) + str_replace(",","",$arrPrint[14]);
    } elseif ($arrPrint[15] == 'sponsor') {
        $totalAmount = str_replace(",","",$sponsorAmt);
//    } elseif ($arrPrint[15] == 'raffle') {
//        $totalAmount = $totalRaffleAmount + str_replace(",","",$arrPrint[11]) + str_replace(",","",$arrPrint[12]) + str_replace(",","",$arrPrint[13]) + str_replace(",","",$arrPrint[14]);
    }

    if((trim($arrPrint[11]) != "") || ($arrPrint[11] != "0.00")) {
        $tributeDescription1 = "Gene Jones";
        $tribute1 = $arrPrint[11];
    } else {
        $tributeDescription1 = "";
        $tribute1="";
    }
    if((trim($arrPrint[12]) != "") || ($arrPrint[12] != "0.00")) {
        $tributeDescription2 = "Nancy Ann Hunt";
        $tribute2 = $arrPrint[12];
    } else {
        $tributeDescription2 = "";
        $tribute2="";
    }
    if((trim($arrPrint[13]) != "") || ($arrPrint[13] != "0.00")) {
        $tributeDescription3 = "Meredith Burke";
        $tribute3 = $arrPrint[13];
    } else {
        $tributeDescription3 = "";
        $tribute3="";
    }
    if((trim($arrPrint[14]) != "") || ($arrPrint[14] != "0.00")) {
        $tributeDescription4 = "Cameron Wicks";
        $tribute4 = $arrPrint[14];
    } else {
        $tributeDescription4 = "";
        $tribute4="";
    }

    $transaction = "Registration for the 2014 Women of Distinction Luncheon";		//CHECK AMOUNT
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Women of Distinction Luncheon Registration Receipt</title>
        <style type="text/css" media="all">
            * {font-family:Verdana, Geneva, sans-serif;}
            body {overflow:hidden;}
            table tr td table tr td {padding:2px;}
            a:link { color:#0082c0; text-decoration:none; }
            a:visited { color:#0082c0; text-decoration:none; }
            a:hover { color:#666666; text-decoration:underline; }
            .printHeader {padding:5px 0 12px 5px;font:bold 11pt/14pt Verdana, Geneva, sans-serif;color:#333;}
            .printHeaderSm {padding:5px 0 2px 5px;font:bold 10pt/13pt Verdana, Geneva, sans-serif;color:#333;}
            .printLabelSm {font:bold 8pt/11pt Verdana, Geneva, sans-serif;color:#333;padding:4px 0 4px 5px;}
            .printLabelTxt {font:normal 8pt/11pt Verdana, Geneva, sans-serif;color:#333;padding:4px 0 4px 5px;}
            .noPrintLink {text-align:right;vertical-align:bottom;font-size:8pt;}
            .receiptLabel {font:bold 8pt/11pt Verdana, Geneva, sans-serif;color:#333;}
            .receiptLabel1 {width:180px;}
            .receiptLabel2 {width:105px;text-align:center;}
            .receiptLabel3 {width:110px;text-align:center;}
            .receiptLabel4 {width:105px;text-align:center;}
            .receiptText {font:normal 8pt/11pt Verdana, Geneva, sans-serif;color:#333;}
            .center {text-align:center;}
            .right {text-align:right;padding-right:25px;}
            .receiptTextHead {font:bold 8pt/11pt Verdana, Geneva, sans-serif;color:#333;padding-top:10px;border-bottom:1px solid #999;;}
        </style>
        <style type="text/css" media="print">
            .noPrintLink {display:none;}
            .printSpacer {height:30px;}
        </style>
        <script type="text/javascript">
            function printWindow() {
                window.open('', '_blank','fullscreen=yes');
                window.print();
        //    window.close();
            }
        </script>
    </head>

    <body>
        <table cellpadding="0" cellspacing="0" border="0" width="490" style="margin:10px auto 0 auto;">
            <tr>
                <td width="10"></td>
                <td colspan="2"><img src="img/printPageHeader.png" width="470" height="75" border="0" alt="" style="margin-bottom:8px;" /></td>
                <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="noPrintLink"><a href="javascript:window.open;window.print();">Print this page</a></td>
                <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
            </tr>
            <tr>
                <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
                <td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px solid #999;">&nbsp;</div></td>
                <td></td>
            </tr>
            <tr><td></td><td valign="top" class="printHeader" colspan="2">Registation Receipt</td><td></td></tr>
            <tr><td></td><td class="printLabelSm" colspan="2">Invoice Number:&nbsp;<span style="font-weight:normal;">&nbsp;<?php echo $arrPrint[3];?></span></td><td></td></tr>
            <tr><td></td><td class="printLabelSm" colspan="2">Authorization Number:&nbsp;<span style="font-weight:normal;">&nbsp;<?php echo $arrPrint[4];?></span></td><td></td></tr>
            <tr><td colspan="4" class="printSpacer">&nbsp;<td></td></tr>
            <tr><td></td><td class="printHeaderSm" colspan="2">Payment Received From:</td><td></td></tr>
            <tr><td></td><td class="printLabelTxt" colspan="2"><?php echo stripslashes($arrPrint[0])."<br>".stripslashes($arrPrint[1])."<br>".stripslashes($arrPrint[2]);?></td><td></td></tr>
            <tr><td width="10"></td><td colspan="2"><div style="margin:5px 0;height:1px;border-bottom:1px dashed #999;">&nbsp;</div></td><td></td></tr>
            <tr>
                <td></td>
                <td colspan="2">
                    <table cellpadding="0" cellspacing="0">
                        <tr><td class="receiptLabel receiptLabel1">Description</td><td class="receiptLabel receiptLabel2">Quantity</td><td class="receiptLabel receiptLabel3">Price</td><td class="receiptLabel receiptLabel4">Amount</td></tr>
                        <?php if($arrPrint[15] == 'ticket') {?>                                                                          <!-- TICKETS -->
                            <tr>
                                <td class="receiptText" valign="top">Event Tickets </td>
                                <td class="receiptText center" valign="top"><?php echo $numTickets;?></td>
                                <td class="receiptText center" valign="top">$150.00</td>
                                <td class="receiptText right" valign="top">$<?php echo number_format($arrPrint[6],2);?></td>
                            </tr>
                        <?php } else if ($arrPrint[15] == 'table') {?>                                                                  <!-- TABLES -->
                            <tr>
                                <td class="receiptText" valign="top">Event Tables </td>
                                <td class="receiptText center" valign="top"><?php echo $numTables; ?></td>
                                <td class="receiptText center" valign="top">$1500.00</td>
                                <td class="receiptText right" valign="top">$<?php echo number_format($arrPrint[7],2);?></td>
                            </tr>
                        <?php }?>
                        <?php if ($arrPrint[15] == 'sponsor') {?>
                            <?php if (($arrPrint[8] == 'bronze') || ($arrPrint[8] == 'silver')) {?>
                                <tr>
                                    <td class="receiptText" valign="top"><?php echo ucfirst($arrPrint[8]); ?> Sponsorship</td>
                                    <td class="receiptText center" valign="top">1</td>
                                    <td class="receiptText center" valign="top"><?php echo number_format(($sponsorAmt),2);?></td>
                                    <td class="receiptText right" valign="top">$<?php echo number_format(($sponsorAmt),2);?></td>
                                </tr>
                            <?php }?>
                        <?php }?>
                        <?php if ($arrPrint[9] > 0) {?>
                            <?php if($arrPrint[10] == 1) {
                              $anonCopy = "Anonymous ";
                            }else {
                                $anonCopy = '';
                            }?>
                            <tr>
                                <td class="receiptText" valign="top"><?php echo $anonCopy;?>Donation</td>
                                <td class="receiptText center" valign="top"><?php echo $arrPrint[9]; ?></td>
                                <td class="receiptText center" valign="top">&#32;</td>
                                <td class="receiptText right" valign="top">$<?php echo number_format(str_replace(",","",$arrPrint[9]),2);?></td>
                            </tr>
                        <?php }?>
                        <?php
                            if (($arrPrint[11] > '0.00') || ($arrPrint[12] > '0.00') ||($arrPrint[13] > '0.00') ||($arrPrint[14] > '0.00')) {
                                echo "<tr><td colspan=\"4\" class=\"receiptTextHead\">Tribute</td></tr>";
                                echo "<tr><td colspan=\"4\"><img src=\"img/spacer.png\" width=\"1\" height=\"5\" alt=\"\"></td></tr>";
                                for ($i=1;$i<=4;$i++) {
                                    if (${'tributeDescription' . $i} != '') {
                                        echo "<tr>";
                                        echo "<td colspan=\"3\" class=\"receiptText\">" . ${'tributeDescription' . $i} . "</td>";
                                        echo "<td class=\"receiptText right\">$" . number_format(${'tribute' . $i}, 2, '.', ',') . "</td>";
                                        echo "</tr>";
                                    }
                                }
                            } ?>
                        <tr>
                            <td colspan="4"><div style="margin:5px 0;height:1px;border-bottom:1px solid #999;">&nbsp;</div></td>
                        </tr>
                        <tr>
                            <td class="receiptLabel right" colspan="3">Total</td>
                            <td class="receiptText right"><strong>$<?php echo number_format(str_replace(",","",$totalAmount),2);?></strong></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" style="text-align:left;font-size:8pt;" class="noPrintLink"><br /><a href="Javascript:window.close();">close window</a><br /><br /></td>
                <td></td>
            </tr>
            <tr>
                <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
                <td width="200"><img src="img/spacer.png" width="200" height="1" /></td>
                <td width="260"><img src="img/spacer.png" width="260" height="1" /></td>
                <td width="10"><img src="img/spacer.png" width="10" height="1" /></td>
            </tr>
        </table>
    </body>
</html>
