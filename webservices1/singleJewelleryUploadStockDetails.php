<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$jewelleryStockId = $_REQUEST['jewelleryStockId'];
if(!empty($userId) && !empty($jewelleryStockId)){  
 
		$uploadStockRows = $db->singleJewelleryUploadStockDetailsById($userId,$jewelleryStockId);
		if ($uploadStockRows != false) {
			$response["message"] = "Success";
			$response["header"] = "Jewellery Stock List";
	
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,billing_mobile,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
			
			$statusCheck = mysql_num_rows(mysql_query("select id from jewellersmandi_stock_upload_contact where user_id='".$userId."' and stock_id='".$uploadStockRows['id']."' and uploadType='Jewellery List'"));
			
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
			$stockArray[]=array("text"=>"Certificate", "value"=>$uploadStockRows['certificate']);
			$stockArray[]=array("text"=>"Diamond Color", "value"=>$uploadStockRows['diamond_color']);
			$stockArray[]=array("text"=>"Diamond Purity", "value"=>$uploadStockRows['color']);
			$stockArray[]=array("text"=>"Metal", "value"=>$uploadStockRows['metal']);
			$stockArray[]=array("text"=>"Face", "value"=>$uploadStockRows['face']);
			$stockArray[]=array("text"=>"Total Value", "value"=>$uploadStockRows['total_value']);
			$stockArray[]=array("text"=>"Gross Weight", "value"=>$uploadStockRows['gross_weight']);
			
			$stockArray[]=array("text"=>"Ear", "value"=>$uploadStockRows['ear']);
			$stockArray[]=array("text"=>"Neck", "value"=>$uploadStockRows['neck']);
			$stockArray[]=array("text"=>"Chest", "value"=>$uploadStockRows['chest']);
			$stockArray[]=array("text"=>"Wrist", "value"=>$uploadStockRows['wrist']);
			$stockArray[]=array("text"=>"Finger", "value"=>$uploadStockRows['finger']);
			$stockArray[]=array("text"=>"Diamond Rate", "value"=>$uploadStockRows['diamond_rate']);
		
			
			$response["uploadJewelleryStockDetails"]=$stockArray;
			echo json_encode($response);
		} else {
			
			$response["message"] = "No record found!";
			$response["header"] = "Jewellery Stock List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login First';
	$response["header"] = "Jewellery Stock List";
	echo json_encode($response);
	exit;
}