<?php

    header("Content-Type: application/json");
    require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=$_REQUEST["sellerId"];
	$fullname=$_REQUEST["name"];
	$emailId = $_REQUEST["userEmail"];
	$rating=$_REQUEST["rating"];
	$comment=$_REQUEST["remark"];
	
	if($userId!=""){
		$addreview=$db->addSellerReview($userId,$sellerId,$fullname,$emailId,$rating,$comment);
		$response['status']="200";
		$response['msg']='Review add successfully';
	}else{
		$response['status']="400";
		$response['msg']='Please login first';
	}
	echo json_encode($response);
	die;	
?>