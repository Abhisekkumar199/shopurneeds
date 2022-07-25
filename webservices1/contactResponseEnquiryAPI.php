<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
$enquiryId = $_REQUEST['enquiryId'];
		$user = $db->contactEnquiryByUserId($userId,$enquiryId);
		if ($user != false) {
		$response['status'] = '200';
			$response["msg"] = "Success";
			$checkContact = mysql_num_rows(mysql_query("select id from jewellersmandi_contactproduct where peid='".$enquiryId."' and user_id='".$userId."'"));
			if($checkContact>0) { 
				$response['enquiryStatus']='1';
			} else { 
				$response['enquiryStatus']='0';
			}
			echo json_encode($response);
		} else {
		$response['status'] = '400';
			$response["msg"] = "Already Contact!";
			echo json_encode($response);
		}
	
}else{
$response['status'] = '401'; 
	$response['msg'] = 'Please Login first';
	echo json_encode($response);
	exit;
}