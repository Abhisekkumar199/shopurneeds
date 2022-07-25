<?php
require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
	if($userId!='') { 
	$update = mysql_query("update jewellersmandi_user_registration set `login_check`='0' where id='".$userId."'");
	$response["status"] = "200";
			$response["msg"] = "Success";
			echo json_encode($response);
	} else {
			$response["status"] = "400";
			$response["msg"] = "Kindly Try Again!";
			echo json_encode($response);

	}
?>