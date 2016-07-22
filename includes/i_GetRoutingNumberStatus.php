<?php
	ini_set('error_reporting', E_ALL);
	//try {
	//	$routeConn = odbc_connect('eventsWebRO', 'events_web_ro', '%readonly%',SQL_CUR_USE_ODBC);
    //
	//	if(!$routeConn) {
	//		//echo "Not Connected<br><Br>";
	//	} else {
	//		global $conn;
	//		//echo "I'm Connected<br><br>";
	//	}
	//} catch (Exception $e) {
	//	//echo 'Connection Failed: '.$e->getMessage()."<br>";
	//}
	////  GET THE ID FROM THE ACH REMOTE VALIDATION METHOD ==============================================================================================
	//if(isset($_POST['id'])) {
	//	$routeNum = $_POST['id'];
	//	//  QUERY DATABASE FOR EXISTIN RECORD ==============================================================================================================
	//	$query = "select id FROM tbl_ACHRouting where routingNumber = '".$routeNum."'";
	//	$result = odbc_exec($routeConn, $query);
	//	$id = odbc_result($result, 'id');
	//	//  CHECK LENGTH OF RESULT - IF GREATER THAN ZERO, THEN A ROUTING NUMBER MATCH WAS FOUND. ====================================================
	//	//  IF ZERO, THEN NO MATCH AND FALSE IS RETURNED AND THE CHECK FAILS =========================================================================
	//	if(strlen($id) > 0) {
	//		echo 'true';
	//	} else if (strlen($id) == 0) {
	//		echo 'false';
	//	}
	//}

	try {
		$myRO_DSN = "odbc:webEventsRO";
		$myRO_UID = "Events_Web_RO";
		$myRO_PW = "%readonly%";
		$routeConn = odbc_connect('eventsWebRO', 'events_web_ro', '%readonly%',SQL_CUR_USE_ODBC);
		$dbhRoute = new PDO($myRO_DSN,$myRO_UID,$myRO_PW);
		$dbhRoute->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected<br>";
		if(!$dbhRoute) {
			//echo "Not Connected<br><Br>";
		} else {
			//global $dbhRoute;
			//echo "I'm Connected<br><br>";
		}
	} catch (Exception $e) {
			echo 'Connection Failed: '.$e->getMessage()."<br>";
	}
	//  GET THE ID FROM THE ACH REMOTE VALIDATION METHOD ==============================================================================================
	if(isset($_POST['id'])) {
		$routeNum = $_POST['id'];
		//$routeNum = 1234567890;
	//  QUERY DATABASE FOR EXISTIN RECORD ==============================================================================================================
		$query = "select id FROM tbl_ACHRouting where routingNumber = '".$routeNum."'";
		//echo $query;
		$stmt = $dbhRoute->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch();
		$id = $row['id'];
		//  CHECK LENGTH OF RESULT - IF GREATER THAN ZERO, THEN A ROUTING NUMBER MATCH WAS FOUND. ====================================================
		//  IF ZERO, THEN NO MATCH AND FALSE IS RETURNED AND THE CHECK FAILS =========================================================================
		if(strlen($id) > 0) {
			echo 'true';
		} else if (strlen($id) == 0) {
			echo 'false';
		}
	}




 ?>
