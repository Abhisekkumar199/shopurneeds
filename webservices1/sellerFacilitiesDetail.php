<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';	
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=isset($_REQUEST["sellerId"])?$_REQUEST["sellerId"]:"";

	if(!empty($userId)) {
		$sellerDetail=$db->sellerServiceDetailById($sellerId);
		
		if(!empty($sellerDetail)){
			$response["status"]="200";
			$response["header"]="seller facilities Detail";
			$response["sellerFacilities"]=$sellerDetail['customerservice'];
			
		}else{
			$response["status"]="404";
			$response["header"]="No facilities detail Available";
		}
		
		
	} else {
		$response["status"] = "400";
		$response["msg"] = "Login first";
	}
	echo json_encode($response); 
	die;
?>