<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){

		$user = $db->userProfileDetailsById($userId);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "My Profile";
			$response["userid"] ="JM-00".$user['id'];
			$response["userImage"]="https://localhost/project/shopurneeds/userlogo/".$user['logo'];
			$response["mobileImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/profile_mobile_icon.png";
			$response["landLineImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/profile_landline_icon.png";
			$response["messageImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/msg_icon.png";
			$response["emailImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/profile_email_icon.png";
			$response["locationImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/profile_location_icon.png";
			$response["documentImage"]="https://localhost/project/shopurneeds/contacticon/profileicon/profile_disc_icon.png";
			$response["companyName"] = $user['companyname'];
			$response["userType"] = $user['usertype'];
			
			$response["fullName"] = $user['fname'].' '.$user['lname'];
			$response["mobileNo"] = $user['billing_mobile'];
			$response["landLineNo"] = $user['billing_phone'];
			$response["emailId"] = $user['emailid'];
			$response["address"] = $user['billing_housenumber'];
			
			$response["gstNo"] = $user['gstno'];
			$response["panNo"] = $user['panno'];
			$response["aadhaarNo"] = $user['aadhaarno'];
		
			$response["mobileText"] = 'Mobile No.';
			$response["landLineText"] = 'Landline No.';
			$response["MessageText"] = 'Address';
			$response["emailText"] = 'E-mail';
			
			
			$response["documentText"] = 'Document Type';
			if($user['document']!='') { 
				$response["documentName"] = $user['document'];
			} else { 
				$response["documentName"] = "You haven't uploaded any document yet.";
			} 
			if($user['visiting_card']!='') { 
				$response["visitingCard"] = "https://localhost/project/shopurneeds/visitingcardimages/".$user['visiting_card'];
			} else { 
				$response["visitingCard"] = "Not Found";
			}
			echo json_encode($response);
		} else {
			$response["message"] = "No Record Found!";
			$response["header"] = "My Profile";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "My Profile";
	echo json_encode($response);
	exit;
}