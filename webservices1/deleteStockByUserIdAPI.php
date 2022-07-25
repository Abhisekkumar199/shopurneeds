<?php 
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
		$stockId = isset($_REQUEST['stockId'])?$_REQUEST['stockId']:'';
		$user = $db->deleteStockByUserId($userId,$stockId);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Successfully Deleted Auction";
		}else {
			$response["status"] = "400";
			$response["msg"] = "Error";
		}
	
}else{
	$response["status"] = "401"; 
	$response['msg'] = 'Please Login first';
}
//response 
echo json_encode($response);
die;
?>