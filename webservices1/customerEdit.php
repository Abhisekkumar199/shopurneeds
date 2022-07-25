<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$userId = $_REQUEST['userId'];
	$fname = $_REQUEST['fname'];
	$lname = $_REQUEST['lname'];


	if(!empty($userId)){
		
		$UpdateUser=$db->editProfileUserById($userId,$fname,$lname);
		
		if($UpdateUser){
			$response['status']='200';
			$response['msg']='Customer Profile Update Successfully';
			$response["userProfile"]["fname"]=$fname;
			$response["userProfile"]["lname"]=$lname;
		
			
		
		}else {
			$response['status']='400';
			$response['msg']='Customer Profile update failed';
		}
		
	}
	else {
		$response["status"] = "400";
		$response["msg"] = "Login first";
		
	}
	echo json_encode($response);
	die;
?>