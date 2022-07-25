<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
    $certificate = $_REQUEST['certificate'];
	$diamondColor = $_REQUEST['diamondColor'];
	$diamondClarity = $_REQUEST['diamondClarity'];
	$metal = $_REQUEST['metal'];
	$face = $_REQUEST['face'];
	$totalValue = $_REQUEST['totalValue'];
	$grossWeight = $_REQUEST['grossWeight'];
	$ear = $_REQUEST['ear'];
	$neck = $_REQUEST['neck'];
	$chest = $_REQUEST['chest'];
	$wrist = $_REQUEST['wrist'];
	$finger = $_REQUEST['finger'];
	$diamondRate = $_REQUEST['diamondRate'];
	
	$uploadImage = $_FILES['uploadImage']['name'];
	$jewelleryId= $_REQUEST['jewelleryId'];

    $userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
 

			$user = $db->editStockJewelleryByUserId($userId,$jewelleryId,$certificate,$diamondColor,$diamondClarity,$metal,$face,$totalValue,$grossWeight,$ear,$neck,$chest,$wrist,$finger,$diamondRate,$uploadImage);
			if ($user) {
			$response["status"] = "200";
			$response["msg"] = "Jewellery Stock Successfully Updated.";
				echo json_encode($response);
			} 
			else {
			$response["status"] = "400";
				$response["msg"] = "Error occurred in Jewellery update stock!";
				echo json_encode($response);
			}
}
else
{
				$response["status"] = "400";
				$response["msg"] = "Please Login First";
				echo json_encode($response);
}
?>