<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
$clientId = $_REQUEST['clientId'];
$auctionId = $_REQUEST['auctionId'];
	$user = $db->contactAuctionResponseUserById($userId,$clientId,$auctionId);

	if ($user!= false) {
		$response["status"] = "200";
		$response["msg"] = "Success";
		echo json_encode($response);
	} 
	else {
		$response["status"] = "400";
		$response["msg"] = "Error occurred";
		echo json_encode($response);
	}
}
else
{ 
	$response["status"] = "401";
	$response["msg"] = "Please Login First";
	echo json_encode($response);
}
?>