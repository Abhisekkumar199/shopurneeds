<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
		$sellerid = 	isset($_REQUEST['sellerid'])?$_REQUEST['sellerid']:'';
		$seller = $db->getSellerDetailsById($sellerid);
		if ($seller != false) {
			$response["status"] = "200";
			$response["msg"] = "Success";
				$response["seller"]["uid"] = $seller["id"];
				$response["seller"]["fname"] = $seller["fname"];
				$response["seller"]["lname"] = $seller["lname"];
				$response["seller"]["email"] = $seller["emailid"];
				$response["seller"]["wallet"] = $seller["wallet"];
				$response["seller"]["walletbankpics"] = "https://localhost/project/shopurneeds/images/oxygenselletwalletbank.png";
				$response["seller"]["companyname"] = $seller["suppliername"];
				$response["seller"]["sellerlogo"] = "https://localhost/project/shopurneeds/showroomimages/".$seller["uploadimage1"];
				$response["seller"]["sellerbanner"] = "https://localhost/project/shopurneeds/showroomimages/".$seller["uploadimage"];

				$response["seller"]["mobile"] = $seller["mobile1"];

			echo json_encode($response);

		} else {
			$response["status"] = "400";
			$response["msg"] = "No Record Found Here!";
			echo json_encode($response);

		}

	

