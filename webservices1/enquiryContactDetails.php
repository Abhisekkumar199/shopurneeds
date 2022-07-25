<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userid = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';

if(!empty($userid)){
$clientId = $_REQUEST['clientId'];
$enquiryId = $_REQUEST['enquiryId']; 
		$user = $db->userDetailsEnquiryById($clientId);
		if ($user != false) {
		$response['status'] = '200';
			$response["message"] = "Success";
			$response["header"] = "Contact Details";
			
			$response["userImage"]="https://localhost/project/shopurneeds/userlogo/".$user['logo'];
			$response["mobileImage"]="https://localhost/project/shopurneeds/contacticon/mobile_icon.png";
			$response["landLineImage"]="https://localhost/project/shopurneeds/contacticon/land_line_icon.png";
			$response["messageImage"]="https://localhost/project/shopurneeds/contacticon/msg_icon.png";
			$response["emailImage"]="https://localhost/project/shopurneeds/contacticon/email_icon.png";
			$response["locationImage"]="https://localhost/project/shopurneeds/contacticon/location_icon.png";
			$response["fname"] = $user['fname'];
			$response["lname"] = $user['lname'];
			$response["mobileNo"] = $user['billing_mobile'];
			$response["landLineNo"] = $user['billing_phone'];
			$response["emailId"] = $user['emailid'];
			$response["address"] = $user['billing_housenumber'].", ".$user['billing_city'].", ".$user['billing_state'].", ".$user['billing_zip'];
			$response["mobileText"] = 'Personal';
			$response["landLineText"] = 'Landline';
			$response["MessageText"] = 'Message';
			$response["emailText"] = 'E-mail';
			
			$wishlistROWS = mysql_num_rows(mysql_query("select * from `jewellersmandi_favorite_product` where user_id='".$userid."' and product_id='".$enquiryId."'"));
			$response['wisthlistStatus'] = $wishlistROWS;
			
			$junkROWS = mysql_num_rows(mysql_query("select * from `jewellersmandi_junkproduct` where user_id='".$userid."' and peid='".$enquiryId."'"));
			$response['junkStatus'] = $junkROWS;
			
			$callROWS = mysql_num_rows(mysql_query("select * from `jewellersmandi_contactproduct` where user_id='".$userid."' and peid='".$enquiryId."'"));
			$response['callCloseStatus'] = $callROWS;
			
			
echo json_encode($response);
		} else {
			$response['status'] = '400';
			$response["message"] = "No record found!";
			$response["header"] = "Contact Details";
			echo json_encode($response);
		}
	
}else{
$response['status'] = '401';
	$response['message'] = 'Please Login first';
	$response["header"] = "Contact Details";
	echo json_encode($response);
	exit;
}