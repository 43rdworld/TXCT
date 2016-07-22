<?php
    error_reporting (E_ALL ^ E_NOTICE);
    if(ISSET($_POST['update'])) {
        if (count($_POST['record']) > 0 ) {
            $record = $_POST['record'];
            foreach ($_POST['record'] as $key => $checked) {
                echo "Record: ".$_POST['record'][$key] . "<br>";
                echo "Vol Email: ".$_POST['myEmail'][$key] . "<br>";
                echo "Lead Email: ".$_POST['leadEmail'][$key] . "<br>";
                echo "ID: ".$_POST['formSecret'][$key] . "<br><br>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Test</title>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
        <STYLE TYPE="TEXT/CSS">
            * {font:color:#333;font-family:"Helvetica Neue", Arial, Helvetica, sans-serif;font-size:10pt;}
            th {font-size:.9em;text-align:left;}
            input[type=text] {width:125px;font-size:.9em;}

        </STYLE>
    </head>
    <body>
        <div>
            <form action="test.php" method="POST">
                <table cellpadding="0" cellspacing="0" border="0" class="tct_ResendEmailTable">
                    <tbody>
                        <tr>
                            <th>Resend</th>
                            <th>Vol EMail</th>
                            <th>Team Lead Email</th>
                        </tr>
                        <tr style='background-color:#fff !important;'>
                            <td align='center'><input type="checkbox" name="record[]" id="record" value="abc"></td>
                            <td><input type="text" name="myEmail[]" id="myEmail" value="aa@bb.cc"></td>
                            <td><input type="text" name="leadEmail[]" id="leadEmail" value="bb@cc.dd"></td>
                        <tr>
                        <tr style='background-color:#fff !important;'>
                            <td align='center'><input type="checkbox" name="record[]" id="record" value="efg"></td>
                            <td><input type="text" name="myEmail[]" id="myEmail" value="ee@ff.gg"></td>
                            <td><input type="text" name="leadEmail[]" id="leadEmail" value="ff@gg.hh"></td>
                        <tr>
                        <tr style='background-color:#fff !important;'>
                            <td align='center'><input type="checkbox" name="record[]" id="record" value="ghi"></td>
                            <td><input type="text" name="myEmail[]" id="myEmail" value="gg@hh.ii"></td>
                            <td><input type="text" name="leadEmail[]" id="leadEmail" value="hh@ii.jj"></td>
                        <tr>
                        <tr style='background-color:#fff !important;'>
                            <td align='center'><input type="checkbox" name="record[]" id="record" value="ijk"></td>
                            <td><input type="text" name="myEmail[]" id="myEmail" value="ii@jj.kk"></td>
                            <td><input type="text" name="leadEmail[]" id="leadEmail" value="jj@kk.ll"></td>
                        <tr>
                        <tr>
                            <td><br><br><input type="submit" value="Submit"></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="update" id="update" value="updateTable">
            </form>
        </div>
    </body>
</html>
