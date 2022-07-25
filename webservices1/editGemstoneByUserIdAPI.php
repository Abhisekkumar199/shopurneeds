<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$stone = $_REQUEST['stone'];
    $certificate = $_REQUEST['certificate'];
	$stoneIdentity = $_REQUEST['stoneIdentity'];
	$shape = $_REQUEST['shape'];
	$pricePerCarat = $_REQUEST['pricePerCarat'];
	$weight = $_REQUEST['weight'];
	$totalValue = $_REQUEST['totalValue'];
	$uploadImage = $_FILES['uploadImage']['name'];
	$gemstoneId=$_REQUEST["gemstoneId"];	
	$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

	if(!empty($userId)){
	 

				$user = $db->editStockGemstoneByUserId($userId,$gemstoneId,$stone,$certificate,$stoneIdentity,$shape,$pricePerCarat,$weight,$totalValue,$uploadImage);
				if ($user) {
					$response["status"] = "200";
					$response["msg"] = "Gemstone Stock Successfully updated.";
					echo json_encode($response);
				} 
				else {
					$response["status"] = "400"; 
					$response["msg"] = "Error occurred in Gemstone update stock!";
					echo json_encode($response);
				}
	}
	else
	{
					$response["status"] = "400";
					$response["message"] = "Please Login First";
					echo json_encode($response);
	}
?>