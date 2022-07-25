<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
		$visitingCard = $_FILES['visitingCard']['name'];
		$user = $db->updateVistingCardById($userId,$visitingCard);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Update Visiting Card";
			
echo json_encode($response);
		} else {
			$response["message"] = "Not Upload Card!";
			$response["header"] = "Update Visiting Card";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Update Visiting Card";
	echo json_encode($response);
	exit;
}