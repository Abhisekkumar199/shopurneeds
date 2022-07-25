<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
	$mobileno 		= 	isset($_REQUEST['mobileno'])?$_REQUEST['mobileno']:'';
	$password 	= 	isset($_REQUEST['password'])?$_REQUEST['password']:'';
		$user = $db->getdeliveryboybyusername($mobileno, $password);
		if ($user != false) {
			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["deliveryboy"]["id"] = $user["id"];
				$response["deliveryboy"]["fname"] = $user["driver_name"];
				$response["deliveryboy"]["email"] = $user["driver_email"];
				$response["deliveryboy"]["mobile"] = $user["driver_mobile"];

				$response["deliveryboy"]["vehicle_no"] = $user["vehicle_no"];
				
			echo json_encode($response);

		} else {
			$response["status"] = "400";
			$response["msg"] = "Incorrect username or password!";
			echo json_encode($response);

		}

?>
	

