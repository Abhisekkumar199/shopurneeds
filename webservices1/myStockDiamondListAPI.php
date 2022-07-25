<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId 		= 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$shape2 		= 	isset($_REQUEST['shape2'])?$_REQUEST['shape2']:'';
$cutGrade 		= 	isset($_REQUEST['cutGrade'])?$_REQUEST['cutGrade']:'';
$polish 		= 	isset($_REQUEST['polish'])?$_REQUEST['polish']:'';
$symmetry 		= 	isset($_REQUEST['symmetry'])?$_REQUEST['symmetry']:'';
$color 			= 	isset($_REQUEST['color'])?$_REQUEST['color']:'';
$lab 			= 	isset($_REQUEST['lab'])?$_REQUEST['lab']:'';
$purity 		= 	isset($_REQUEST['purity'])?$_REQUEST['purity']:'';
$city 			= 	isset($_REQUEST['city'])?$_REQUEST['city']:'';
$fluorescence 	= 	isset($_REQUEST['fluorescence'])?$_REQUEST['fluorescence']:'';
if(!empty($userId)){ 
 
		$user = $db->uploadStockListingByUserId($userId,$shape2,$cutGrade,$polish,$symmetry,$color,$lab,$purity,$city,$fluorescence);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Diamond Stock List";
			while($uploadStockRows = mysql_fetch_assoc($user)) {
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,id,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
				$resultRows[] = array("userId"=>$uploadStockRows['user_id'],"stockId"=>$uploadStockRows['id'],"companyname"=>$userDetailsRows['companyname'], "seller"=>$userDetailsRows['emailid'], "stockNo"=>$uploadStockRows['stockno'],"shape"=>$uploadStockRows['shape'],"city"=>$uploadStockRows['city'],"color"=>$uploadStockRows['color'],"purity"=>$uploadStockRows['purity'],"size"=>$uploadStockRows['size_stock'],"date"=>$uploadStockRows['adddate']);
				$cate='';
			}
			$response['uploadStockList'] = $resultRows;
echo json_encode($response);
		} else {
			$response["message"] = "No record found!";
			$response["header"] = "Diamond Stock List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Diamond Stock List";
	echo json_encode($response);
	exit;
}