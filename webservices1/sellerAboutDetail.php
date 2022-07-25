<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';	
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=isset($_REQUEST["sellerId"])?$_REQUEST["sellerId"]:"";

	if(!empty($userId)) {
		$sellerDetail=$db->sellerAboutDetailById($sellerId);
		
		if(!empty($sellerDetail)){
			$response["status"]="200";
			$response["header"]="seller Aboutus Detail";
			$response["sellerAboutus"]=$sellerDetail['aboutus'];
			
		}else{
			$response["status"]="404";
			$response["header"]="No Aboutus detail Available";
		}
		
		
	} else {
		$response["status"] = "400";
		$response["msg"] = "Login first";
	}
	echo json_encode($response); 
	die;
?>