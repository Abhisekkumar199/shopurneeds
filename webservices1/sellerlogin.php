<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
		$email 		= 	isset($_REQUEST['email'])?$_REQUEST['email']:'';
		$password 	= 	isset($_REQUEST['password'])?$_REQUEST['password']:'';
		$user = $db->getSellerByEmailAndPassword($email, $password);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["seller"]["uid"] = $user["id"];
				$response["seller"]["fname"] = $user["fname"];
				$response["seller"]["lname"] = $user["lname"];
				$response["seller"]["email"] = $user["emailid"];

				$response["seller"]["companyname"] = $user["suppliername"];
				$response["seller"]["sellerlogo"] = "https://localhost/project/shopurneeds/showroomimages/".$user["uploadimage1"];
				$response["seller"]["sellerbanner"] = "https://localhost/project/shopurneeds/showroomimages/".$user["uploadimage"];

				$response["seller"]["mobile"] = $user["mobile1"];

			echo json_encode($response);

		} else {
			$response["status"] = "400";
			$response["msg"] = "Incorrect email or password!";
			echo json_encode($response);

		}

?>
	

