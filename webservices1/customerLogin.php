<?php
error_reporting(0);
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];
	$user = $db->getUserByEmailAndPassword($email,$password);
	if ($user != false) {
		$response["status"] = "200";
		$response["msg"] = "Success";
		
		//check user email verified or not
	/*	$isEmaiLVerified=mysql_fetch_object(mysql_query("select is_email_verified from shopurneeds_user_registration where id='".$user["id"]."'")) or die(mysql_error());
			if($isEmaiLVerified->is_email_verified==1){
				$response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["user_mobile"];
			
				if($user["user_image"]!='') { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/userlogo/'.$user["user_image"];
				} else { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/img/contact_img.png';
				}
				
			}else{
				$response['status']="404";
				$response['msg']="Email is not registered. Please signup first.";
			}*/
		
		        $response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
				$response["user"]["referralcode"] = "SUN".$user["uid"];

				if($user["user_image"]!='') { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/userlogo/'.$user["user_image"];
				} else { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/img/contact_img.png';
				}
			

	} else {
		$response["status"] = "400";
		$response["msg"] = "Incorrect Mobile Number or password!";

	}
	
	echo json_encode($response);
	die;
	
?>
