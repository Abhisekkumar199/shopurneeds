<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
	$demandId=$_REQUEST["demandStockId"];

	if(!empty($userId)){ 

			$user = $db->deleteDemandByUserId($userId,$demandId);
			if ($user) {
				$response["status"] = "200";
				$response["msg"] = "Demand stock successfully delete.";
				
			}else {
				$response["status"] = "400";
				$response["msg"] = "Error occurred in delete demand stock!";
				
			}
	}else{
				$response["status"] = "401";
				$response["msg"] = "Please Login First";				
	}
//response
echo json_encode($response);
die;
?>