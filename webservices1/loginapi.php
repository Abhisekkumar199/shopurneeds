<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$email 		= 	isset($_REQUEST['email'])?$_REQUEST['email']:'';
$password 	= 	isset($_REQUEST['password'])?$_REQUEST['password']:'';
if(!empty($email)  && !empty($password)){
		$user = $db->getUserByEmailAndPassword($email, $password);
		if ($user != false) {
			$response["success"] = 1;
			$response["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
				$response["user"]["created_at"] = $user["adddate"];
			echo json_encode($response);
		} else {
			$response["error"] = 1;
			$response["error_msg"] = "Incorrect email or password!";
			echo json_encode($response);
		}
	
}else{
	$Response['msg'] = 'Parameter missing';
	echo json_encode($Response);
	exit;
}