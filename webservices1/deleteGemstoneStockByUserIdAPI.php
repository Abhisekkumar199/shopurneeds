<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
	$gemstoneStockId=$_REQUEST["gemstoneStockId"];

	if(!empty($userId)){ 

			$user = $db->deleteGemstoneByUserId($userId,$gemstoneStockId);
			if ($user) {
				$response["status"] = "200";
				$response["msg"] = "Gemstone stock successfully delete.";
				
			}else {
				$response["status"] = "400";
				$response["msg"] = "Error occurred in delete Gemstone stock!";
				
			}
	}else{
				$response["status"] = "401";
				$response["msg"] = "Please Login First";				
	}
//response
echo json_encode($response);
die;
?>