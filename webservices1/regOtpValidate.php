<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
	$mobile = $_REQUEST['mobile'];

		$user = $db->validateRegBymobile($mobile);

		if ($user != false) {

			$response["msg"] = "Success";

						$response["user"]["uid"] = $user["id"];

				$response["user"]["fname"] = $user["fname"];

				$response["user"]["lname"] = $user["lname"];

				$response["user"]["email"] = $user["emailid"];

				$response["user"]["mobile"] = $user["billing_mobile"];

			echo json_encode($response);

		} else {

			$response["msg"] = "Incorrect Mobile Number!";

			echo json_encode($response);

		}

	?>
	