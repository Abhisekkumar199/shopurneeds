<?php

header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){

		$user = $db->userEditProfileDetailsById($userId);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Edit Profile";
			$response['userid']=$user['id'];
			
			if($user['user_image']!=''){
			    $response["userLogo"]="https://localhost/project/shopurneeds/userlogo/".$user['user_image'];
			}else{
			    $response["userLogo"]="https://localhost/project/shopurneeds/img/logo.png";
			}
					
			$response["firstName"] = $user['fname'];
			$response["lastName"] = $user['lname'];
			$response["mobileNo"] = $user['billing_mobile'];
			$response["emailId"] = $user['emailid'];
			$response["birthday"]= $user['dob'];
			$response["address"] = $user['billing_address'];
						$response["wallet"] = $user['wallet'];		
						$response["referralcode"] = "OXY".$user['id'];		

			/*$response["city"] = $user['billing_city'];			
			$stateRows = mysql_fetch_assoc(mysql_query("select * from olio_states where statename='".$user['billing_state']."'"));
			$response["state"] = $stateRows['statename'];
			$response["pinCode"] = $user['billing_zip'];*/

		} else {
			$response["message"] = "No Record Found!";
			$response["header"] = "My Profile";
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Edit Profile";
	
}
	echo json_encode($response);
	die;
?>