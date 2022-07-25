<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
$clientId = $_REQUEST['clientId'];
$stockId = $_REQUEST['stockId'];
$stockType = $_REQUEST['stockType'];
	$user = $db->contactStockResponseUserById($userId,$clientId,$stockId,$stockType);

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