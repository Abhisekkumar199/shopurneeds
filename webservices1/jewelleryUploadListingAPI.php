<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId 			= 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$jewCertificate 	= 	isset($_REQUEST['jewCertificate'])?$_REQUEST['jewCertificate']:'';
if($jewCertificate=="")
    {
        $jewCertificate 		= 	isset($_REQUEST['certificate'])?$_REQUEST['certificate']:'';

    }
$diamondColor 		= 	isset($_REQUEST['diamondColor'])?$_REQUEST['diamondColor']:'';

$diamondPurity 		= 	isset($_REQUEST['diamondPurity'])?$_REQUEST['diamondPurity']:'';
if($diamondPurity=="")
    {
        $diamondPurity 		= 	isset($_REQUEST['diamondClarity'])?$_REQUEST['diamondClarity']:'';

    }
$metal 				= 	isset($_REQUEST['metal'])?$_REQUEST['metal']:'';
$face 				= 	isset($_REQUEST['face'])?$_REQUEST['face']:'';
$ear 				= 	isset($_REQUEST['ear'])?$_REQUEST['ear']:'';
$neck 				= 	isset($_REQUEST['neck'])?$_REQUEST['neck']:'';
$chest 				= 	isset($_REQUEST['chest'])?$_REQUEST['chest']:''; 
$wrist 				= 	isset($_REQUEST['wrist'])?$_REQUEST['wrist']:'';
$finger 			= 	isset($_REQUEST['finger'])?$_REQUEST['finger']:'';
$diamondRate 		= 	isset($_REQUEST['diamondRate'])?$_REQUEST['diamondRate']:'';

if(!empty($userId)){ 

		$user = $db->uploadJewelleryListingById($userId,$jewCertificate,$diamondColor,$diamondPurity,$metal,$face,$ear,$neck,$chest,$wrist,$finger,$diamondRate);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Jewellery Stock List";
			while($uploadStockRows = mysql_fetch_assoc($user)) {
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
				$resultRows[] = array("userId"=>$uploadStockRows['user_id'],"jewelleryId"=>$uploadStockRows['id'],"companyname"=>$userDetailsRows['companyname'],"seller"=>$userDetailsRows['emailid'], "Certificate"=>$uploadStockRows['certificate'],"diamondColor"=>$uploadStockRows['diamond_color'],"grossWeight"=>$uploadStockRows['gross_weight'],"metal"=>$uploadStockRows['metal'],"totalValue"=>$uploadStockRows['total_value'],"date"=>$uploadStockRows['adddate']);
				$cate='';
			}
			$response['uploadJewelleryStockList'] = $resultRows;
echo json_encode($response);
		} else {
			
			$response["message"] = "No record found!";
			$response["header"] = "Jewellery Stock List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Jewellery Stock List";
	echo json_encode($response);
	exit;
}
?>