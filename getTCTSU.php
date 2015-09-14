<?php
    if(isset($_GET['troopNum'])){
        getServiceUnit($_GET['troopNum']);
    }
    
    function getServiceUnit($troopNum){
		$troopYear = '2015';
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
        $sql = "SELECT troop_su_Number FROM tbl_TroopNumbers WHERE (active = 1) AND (troop_Year = :troop_Year) AND (troop_Number =:troop_Number)";
        $stmt = $dbh->prepare($sql);
		//echo "SQL: ".$sql;
		//echo "<br>TY: ".$troopYear.", "."TN: ".$troopNum."<br>";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':troop_Year', $troopYear, PDO::PARAM_INT);
        $stmt->bindValue(":troop_Number", $troopNum, PDO::PARAM_STR);
		$stmt->execute();
        if($stmt->errorCode() == 0) {
            while(($row = $stmt->fetch()) != false) {
                //echo "TROOP:".$row['troop_su_Number'] . "\n";
                $troop_SUNumber = $row['troop_su_Number'];
            }
            } else {
                $errors = $stmt->errorInfo();
                //echo("ERRORS: ".$errors[2]);
        }

        //$row = $stmt->fetch();
        //$troop_SUNumber = $row['troop_su_Number'];
        //echo "SU Number:".$row['troop_su_Number']."<br>";
        $stmt = $dbh->prepare("SELECT su_Number,su_AreaNames FROM tbl_ServiceUnitAssignments WHERE (active = 1) AND (su_Year = :suYear) ORDER BY su_Number");
        $stmt->bindValue(':suYear', $troopYear, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $select = "<select class\"form_Select300\" style=\"width:300px;\" name=\"permSU\" id=\"permSU\" tabIndex=\"9\">
        <option value=\"\">Select your Service Unit -- zzz</option>";
        foreach ($data as $row) {
            if($row["su_Number"] == $troop_SUNumber) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $select .= "<option value=\"".$row['su_Number']."\" $selected>".$row['su_Number']." - ".$row['su_AreaNames']."</option>";
        }
        $select .= "</select>";
        // // //$stmt->closeCursor();
        echo $select;
    }
 ?>
