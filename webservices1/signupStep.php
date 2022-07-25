<?php 
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$signupStep=$_REQUEST["signupStep"];
	if($userId!=""){
		$updSignupStepRes=mysql_query("UPDATE olio_user_registration set signup_step='".$signupStep."' where id='".$userId."'") or die(mysql_error());
		if($updSignupStepRes){
			$response["status"]="200";
			$response["msg"]="Signup step update success";			
		}else{
			$response["status"]="500";
			$response["msg"]="Signup step update failed";
		}
	}else{
		$response["status"]="404";
		$response["msg"]="Please login first";
	}
	echo json_encode($response);
	die;
?>