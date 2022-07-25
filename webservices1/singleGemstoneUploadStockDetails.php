<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$gemstoneStockId = $_REQUEST['gemstoneStockId'];
if(!empty($userId) && !empty($gemstoneStockId)){  
 
		$uploadStockRows = $db->singleGemstoneUploadStockDetailsById($userId,$gemstoneStockId);
		if ($uploadStockRows != false) {
			$response["message"] = "Success";
			$response["header"] = "Gemstone Stock List";
			
			$statusCheck = mysql_num_rows(mysql_query("select id from jewellersmandi_stock_upload_contact where user_id='".$userId."' and stock_id='".$uploadStockRows['id']."' and uploadType='Gemstone List'"));
	
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,billing_mobile,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
			
			//$response["stockId"]=$uploadStockRows['id'];
			$response["userId"]=$userId;
						$response["stockId"]=$uploadStockRows['id'];

			$response["contactStatus"]=$statusCheck;
			$response["clientId"] = $uploadStockRows['user_id'];
			
			if($uploadStockRows['uploadimage']!='') { 
			$imageUrl = 'https://localhost/project/shopurneeds/gemstoneimages/'.$uploadStockRows['uploadimage'];
			} else { 
			$imageUrl = ''; 
			}
			$response["image"]=$imageUrl;
			$stockArray[]=array("text"=>"Company Name", "value"=>$userDetailsRows['companyname']);
			$stockArray[]=array("text"=>"Mobile No", "value"=>$userDetailsRows['billing_mobile']);
			$stockArray[]=array("text"=>"Stone", "value"=>$uploadStockRows['stone']);
			$stockArray[]=array("text"=>"Certificate", "value"=>$uploadStockRows['certificate']);
			$stockArray[]=array("text"=>"Stone Identity", "value"=>$uploadStockRows['stone_identity']);
			$stockArray[]=array("text"=>"Shape", "value"=>$uploadStockRows['shape']);
			$stockArray[]=array("text"=>"Price Per Carat", "value"=>$uploadStockRows['price_per_carat']);
			$stockArray[]=array("text"=>"Weight", "value"=>$uploadStockRows['weight']);
			$stockArray[]=array("text"=>"Total Value", "value"=>$uploadStockRows['total_value']);
	
			
			$response["uploadGemstoneStockDetails"]=$stockArray;
			echo json_encode($response);
		} else {
			
			$response["message"] = "No record found!";
			$response["header"] = "Gemstone Stock List";
			echo json_encode($response);
		}
	
} else {
	$response['message'] = 'Please Login first';
	$response["header"] = "Gemstone Stock List";
	echo json_encode($response);
	exit;
}