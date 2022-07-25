<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$stockNo = $_REQUEST['stockNo'];
    $shape = $_REQUEST['shape'];
	$sizeStock = $_REQUEST['sizeStock'];
	$color = $_REQUEST['color'];
	$purity = $_REQUEST['purity'];
	$lab = $_REQUEST['lab'];
	$certNo = $_REQUEST['certNo'];
	$fluoRescence = $_REQUEST['fluoRescence'];
	$measurement = $_REQUEST['measurement'];
	$cutGrade = $_REQUEST['cutGrade'];
	$polish = $_REQUEST['polish'];
	$symmetry = $_REQUEST['symmetry'];
	
	$price = $_REQUEST['price']; 
	$discount = $_REQUEST['discount'];
	$td = $_REQUEST['td'];
	$ta = $_REQUEST['ta'];
	$city = $_REQUEST['city'];
	$comment = $_REQUEST['comment'];
	$uploadStockCheckbox = $_REQUEST['uploadStockCheck'];
	$dWeight = $_REQUEST['dWeight'];
	$certificateLink = $_REQUEST['certificateLink'];
	/*$userDocument = $_FILES['userDocument']['name'];
	$userVisitingCard = $_FILES['userVisitingCard']['name'];*/

$userId = isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
 

			$user = $db->uploadStockByUserId($userId,$stockNo,$shape,$sizeStock,$color,$purity,$lab,$certNo,$fluoRescence,$measurement,$cutGrade,$polish,$symmetry,$price,$discount,$td,$ta,$city,$comment,$uploadStockCheckbox,$dWeight,$certificateLink);

			if ($user) {
				$response["status"] = "200";
				$response["msg"] = "Stock Successfully Uploaded.";
				echo json_encode($response);
			} 
			else {
				$response["status"] = "400";
				$response["msg"] = "Error occurred in upload stock!";
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