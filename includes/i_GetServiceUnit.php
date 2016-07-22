<?php
	function getTroopNumberList_WithSU ($dbh,$name,$query,$index) {
		$select = '';
		$select .=	"<select id=\"".$name."\" name=\"".$name."\" class=\"form_Select150\" tabindex=\"".$index."\" onChange=\"getPhotoUploadServiceUnit('getTCTSU.php',this.value,'photoUploadSU');\" style=\"padding:4px 0;border:1px solid #bbb;\" >";
		$select .=	"<option value=\"\">Select Troop # --</option>";
		$stmt = $dbh->prepare($query);
		$stmt->execute();
		$data = $stmt->fetchAll();
		foreach ($data as $row) {
		 	$select.= "<option value=\"".$row['troop_number'].','.$row['troop_su_number']."\" >".$row['troop_number'];
		 	$select.="</option>";
		}
		$select .=	"</select>";
		return $select;
	}
 ?>
