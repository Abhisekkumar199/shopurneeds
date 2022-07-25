<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$stockId = $_REQUEST['stockId'];
if(!empty($userId) && !empty($stockId)){  
 
		$uploadStockRows = $db->singleUploadStockDetailsById($userId,$stockId);
		if ($uploadStockRows != false) {
			$response["message"] = "Success";
			$response["header"] = "Diamond Stock List";
			$sqlState= mysql_fetch_assoc(mysql_query("select statename from jewellersmandi_states where id=(select state_id from jewellersmandi_city  WHERE `cityname` = '".$uploadStockRows['city']."')"));
			$statusCheck = mysql_num_rows(mysql_query("select id from jewellersmandi_stock_upload_contact where user_id='".$userId."' and stock_id='".$uploadStockRows['id']."' and uploadType='Diamond List'"));
			
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,billing_mobile,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
			
			$response["stockId"]=$uploadStockRows['id'];
			$response["userId"]=$userId;
			$response["contactStatus"]=$statusCheck;
			$response["clientId"] = $uploadStockRows['user_id'];
			$response['certLink']=$uploadStockRows['cert_link'];
			
			$stockArray[]=array("text"=>"Company Name", "value"=>$userDetailsRows['companyname']);
			$stockArray[]=array("text"=>"Mobile No", "value"=>$userDetailsRows['billing_mobile']);
			$stockArray[]=array("text"=>"Stock No.", "value"=>$uploadStockRows['stockno']);
			$stockArray[]=array("text"=>"Shape", "value"=>$uploadStockRows['shape']);
						$stockArray[]=array("text"=>"State", "value"=>$sqlState['statename']);

			$stockArray[]=array("text"=>"City", "value"=>$uploadStockRows['city']);
			$stockArray[]=array("text"=>"Color", "value"=>$uploadStockRows['color']);
			$stockArray[]=array("text"=>"Purity", "value"=>$uploadStockRows['purity']);
			$stockArray[]=array("text"=>"Stock Size", "value"=>$uploadStockRows['size_stock']);
			$stockArray[]=array("text"=>"Lab", "value"=>$uploadStockRows['lab']);
			$stockArray[]=array("text"=>"Cert. No.", "value"=>$uploadStockRows['cert_no']);
			
			$stockArray[]=array("text"=>"Weight", "value"=>$uploadStockRows['dweight']);
			$stockArray[]=array("text"=>"Fluorescence", "value"=>$uploadStockRows['fluorescence']);
			$stockArray[]=array("text"=>"Measurement", "value"=>$uploadStockRows['measurement']);
			$stockArray[]=array("text"=>"Cut Grade", "value"=>$uploadStockRows['cutgrade']);
			$stockArray[]=array("text"=>"Polish", "value"=>$uploadStockRows['polish']);
			$stockArray[]=array("text"=>"Symmetry", "value"=>$uploadStockRows['symmetry']);
			$stockArray[]=array("text"=>"Price", "value"=>$uploadStockRows['price']);
			$stockArray[]=array("text"=>"Discount", "value"=>$uploadStockRows['discount']);
			$stockArray[]=array("text"=>"TD", "value"=>$uploadStockRows['td']);
			$stockArray[]=array("text"=>"TA", "value"=>$uploadStockRows['ta']);
			$stockArray[]=array("text"=>"Comment", "value"=>$uploadStockRows['comment']);
			$stockArray[]=array("text"=>"Check Box", "value"=>$uploadStockRows['is_syndicate']);
			
			
			
			$response["uploadStockDetails"]=$stockArray;
			echo json_encode($response);
		} else {
			
			$response["message"] = "No record found!";
			$response["header"] = "Diamond Stock List";
			echo json_encode($response);
		}
	
}else{
	$Response['message'] = 'Please Login first';
	$response["header"] = "Diamond Stock List";
	echo json_encode($Response);
	exit;
}