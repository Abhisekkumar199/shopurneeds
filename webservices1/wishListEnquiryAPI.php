<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
$enquiryId = $_REQUEST['enquiryId'];
$wishListStatus = $_REQUEST['wishListStatus'];
		if($wishListStatus=='1') { 
			$del = mysql_query("delete from jewellersmandi_favorite_product where user_id='".$userId."' and product_id='".$enquiryId."'");
				$Response['status'] = '200';
			$Response['msg'] = 'Remove';
			$Response['wishListStatus'] = '0';
		echo json_encode($Response);
		} else { 
		$del = mysql_query("insert into jewellersmandi_favorite_product (`user_id`,`product_id`,`adddate`) values ('".$userId."','".$enquiryId."',NOW())") or die (mysql_error());
		$Response['status'] = '200';
			$Response['msg'] = 'Added';
			$Response['wishListStatus'] = '1';
			echo json_encode($Response);
		}
	
}else{
$Response['status'] = '400';
	$Response['msg'] = 'Please Login first';
	echo json_encode($Response);
	exit;
}