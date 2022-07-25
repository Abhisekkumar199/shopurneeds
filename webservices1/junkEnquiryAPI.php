<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
$enquiryId = $_REQUEST['enquiryId'];
		$user = $db->junkEnquiryByUserId($userId,$enquiryId);
		if ($user != false) { 
			
			$response['status'] = '200';
			$response['msg'] = 'Enquiry Delete';
		
			
			echo json_encode($response);
		} else {
				$response['status'] = '400';
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
	
}else{
$response['status'] = '401'; 
	$response['msg'] = 'Please Login first';
	echo json_encode($response);
	exit;
}