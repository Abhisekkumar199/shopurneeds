<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
		$email = $_REQUEST['email'];
	//	$email=str_replace("%40","@",$email);
		$password = $_REQUEST['password'];
		$user = $db->getUserByEmailAndPassword($email, $password);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				if($user["logo"]!='') { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/userlogo/'.$user["logo"];
				} else { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/img/contact_img.jpg';
				}
				$response["user"]['usertype'] = $user["usertype"];
			$update = mysql_query("update jewellersmandi_user_registration set device_name='".$_REQUEST['device_name']."', ios_token='".$_REQUEST['ios_token']."',`login_check`='1' where id='".$user["id"]."'");
			echo json_encode($response);

		} else {
			$response["status"] = "400";
			$response["msg"] = "Incorrect email or password!";
			echo json_encode($response);

		}

	

