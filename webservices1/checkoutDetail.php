<?php 
    header("Content-type:application/json");
    require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$userId = $_REQUEST["userId"];
	$userName = $_REQUEST["userName"];
	$userEmail = $_REQUEST["userEmail"];
	$userMobile = $_REQUEST["userMobile"];
	$userAddress = $_REQUEST["userAddress"];
	$userCity = $_REQUEST["userCity"];
	$userState =  $_REQUEST["userState"];
	$userPincode = $_REQUEST["userPincode"];
	
	// separate firstname and lastname
	$expName = explode(" ",$userName);


	$updCheckoutSql=mysql_query("update shopurneeds_user_registration set fname='".$expName[0]."',lname='".$expName[1]."',billing_address='".mysql_escape_string($userAddress)."',billing_city='".$userCity."',billing_state='".$userState."',billing_zip='".$userPincode."',billing_mobile='".$userMobile."',dfname='".$expName[0]."',dlname='".$expName[1]."',deliver_address='".mysql_escape_string($userAddress)."',deliver_city='".$userCity."',deliver_state='".$userState."',deliver_zip='".$userPincode."',deliver_phone='".$userMobile."',user_mobile='".$userMobile."' where id='".$userId."' ") or die(mysql_error());
	
	if($updCheckoutSql){
	    $response["status"]="200";
	    $response["msg"]="checkout detail update successfully";
	}else{
	    $response["status"]="400";
	    $response["msg"]="failed to update checkout detail";
	}
	echo json_encode($response);
	die;
	
?>