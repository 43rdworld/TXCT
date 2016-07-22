<?php
    getServiceUnit();
    function getServiceUnit(){
		$permTable = '';
		try
		{
			$dbh = new PDO('odbc:webEventsRO','Events_Web_RO','%readonly%');
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
			//echo "Connected<br>";
		}
			catch(PDOException $e)
		{
			//echo 'Connection Failed: '.$e->getMessage();
			//exit();
		}
        //$sql = "{CALL sp_GETServiceUnit_FromTroopNum(@troop_Year=:troop_Year,@troop_Number=:troop_Number)}";
        //$sql = "SELECT troop_su_Number FROM tbl_TroopNumbers WHERE (active = 1) AND (troop_Year = :troop_Year) AND (troop_Number =:troop_Number)";
        $sql = "SELECT * FROM tbl_TCT_PermissionResponsibility WHERE (emailSent IS NULL) OR (TCMEMail IS NULL)";
        $stmt = $dbh->prepare($sql);
		//echo "SQL: ".$sql;
		//echo "<br>TY: ".$troopYear.", "."TN: ".$troopNum."<br>";
        $stmt = $dbh->prepare($sql);
        //$stmt->bindValue(':troop_Year', $troopYear, PDO::PARAM_INT);
        //$stmt->bindValue(":troop_Number", $troopNum, PDO::PARAM_STR);
		$stmt->execute();
        if($stmt->errorCode() == 0) {
            $permTable .=   "<form action=\"resendEmail.php\" method=\"POST\">";
            $permTable .=   "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tct_ResendEmailTable\">";
            $permTable .=       "<tbody>";
            $permTable .=       "<tr>";
            $permTable .=           "<th style=\"width:50px;\">Resend</th>";
            $permTable .=           "<th style=\"width:45px;\">Troop</th>";
            $permTable .=           "<th style=\"width:40px;\">SU</th>";
            $permTable .=           "<th style=\"width:190px;\">Vol EMail</th>";
            $permTable .=           "<th style=\"width:190px;\">Leader Email</th>";
            $permTable .=           "<th style=\"width:190px;\">TCM Email</th>";
            $permTable .=       "</tr>";
            while(($row = $stmt->fetch()) != false) {
                $i=0;
                if($row['TroopLeaderEmail'] == '') {
                    $leaderColor='color:#c00';
                } else {
                    $leaderColor = '';
                }
                $permTable .=   "<tr style='background-color:#fff !important;'>";
                $permTable .=       "<td align='center'><input type=\"checkbox\" name=\"record[]\" id=\"record".$i."\" value=\"1\"></td>";
                $permTable .=       "<td>".$row['GSTroop']."</td>";
                $permTable .=       "<td>".$row['GSServiceUnit']."</td>";
                $permTable .=       "<td><input type=\"text\" name=\"myEmail[]\" id=\"myEmail\" value=\"".$row['MyEmail']."\" style='width:180px;font-size:.8em;'></td>";
                $permTable .=       "<td><input type=\"text\" name=\"troopLeaderEmail[]\" id=\"troopLeaderEmail\" value=\"".$row['TroopLeaderEmail']."\" style='width:180px;font-size:.8em;".$leaderColor."'></td>";
                $permTable .=       "<td>";
                $permTable .=           "<input type=\"text\" name=\"tcmEmail[]\" id=\"tcmEmail\" value=\"".$row['TCMEmail']."\" style='width:180px;font-size:.8em;'>";
                $permTable .=           "<input type=\"text\" name=\"formSecret[]\" id=\"formSecret\" value=\"".$row['formSecret']."\" >";
                $permTable .=       "</td>";
                $permTable .=   "<tr>";
                //echo "TROOP:".$row['troop_su_Number'] . "\n";
               // $os = $row['os'];
                //echo $os."<br>";
                $i++;
            }
            $permTable .= "<tr>";
            $permTable .= "<td><input type=\"submit\" value=\"Submit\"></td>";
            $permTable .= "</tr>";
            $permTable .= "</tbody>";
            $permTable .= "</table>";
            $permTable .= "<input type=\"text\" name=\"updatePermissions\" id=\"updatePermissions\" value=\"updatePermissions\">";
            $permTable .= "</form>";
            echo $permTable;
            } else {
                $errors = $stmt->errorInfo();
                echo("ERRORS: ".$errors[2]);
        }

    }
 ?>
