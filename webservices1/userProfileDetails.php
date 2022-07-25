<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
		$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
		$user = $db->getUserDetailsById($userId);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Success";
				$response["fname"] = $user["fname"];
				$response["lname"] = $user["lname"];
				if($user["logo"]!='') { 
				$imageUrl = 'https://localhost/project/shopurneeds/userlogo/'.$user["logo"];
				} else { 
				$imageUrl = '';
				}
				$response["logo"] = $imageUrl;
				$response["userType"] = $user["usertype"];

			echo json_encode($response);

		} else {
			$response["status"] = "400";
			$response["msg"] = "No Record Found Here!";
			echo json_encode($response);

		}

	

