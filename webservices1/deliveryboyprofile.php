<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	
	$deliveryboyid 		= 	isset($_REQUEST['deliveryboyid'])?$_REQUEST['deliveryboyid']:'';
	$lat 	= 	isset($_REQUEST['lat'])?$_REQUEST['lat']:'';
		$lon 	= 	isset($_REQUEST['lon'])?$_REQUEST['lon']:'';

		$user = $db->getdeliveryboybyid($deliveryboyid, $lat,$lon);
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
	

