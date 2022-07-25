<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
		$auctionId = 	isset($_REQUEST['auctionId'])?$_REQUEST['auctionId']:'';
		$user = $db->deleteAuctionById($auctionId);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Successfully Deleted Auction";
			echo json_encode($response);
		} else {
			$response["status"] = "400";
			$response["msg"] = "Error";
			echo json_encode($response);
		}
	
}else{
	$response["status"] = "401"; 
	$response['msg'] = 'Please Login first';
	echo json_encode($response);
	exit;
}