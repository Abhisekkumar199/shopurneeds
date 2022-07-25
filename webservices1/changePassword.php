<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
		$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
		$oldPassword = $_REQUEST['oldPassword'];
		$newPassword = $_REQUEST['newPassword'];
if(!empty($userId)){
		$user = $db->changeUserpassword($userId,$oldPassword,$newPassword);

		if ($user != false) {
			
			$response["status"] = "200";
			$response["msg"] = "Password Changed Successfully.";
			echo json_encode($response);
		} else {

			$response["status"] = "400";
			$response["msg"] = "Old Password Not Match!";
			echo json_encode($response);
			exit;
		}
}else{
	$response["status"] = "401"; 
	$response['msg'] = 'Error occurred';
	echo json_encode($response);
	die;
}
	
	
	

