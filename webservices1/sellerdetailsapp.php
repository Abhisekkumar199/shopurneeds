<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
		$sellerid = $_REQUEST['sellerid'];
	

		$sqlseller = mysql_fetch_array(mysql_query("select * from shopurneeds_suppliers where  id='".$sellerid."'"));
if($sellerid!='') {
    
$response["status"] = "200";
			$response["msg"] = "Success";
			$response["seller"]["companyname"] = $sqlseller["suppliername"];
			$response["seller"]["aboutus"] = $sqlseller["aboutus"];
		$response["seller"]["mobile"] = $sqlseller["mobile1"];
				$response["seller"]["address1"] = $sqlseller["address1"];
		$response["seller"]["address2"] = $sqlseller["address2"];
		$response["seller"]["city"] = $sqlseller["cityname"];
		$response["seller"]["state"] = $sqlseller["pstate"];
		$response["seller"]["pincode"] = $sqlseller["ppincode"];

			$response["seller"]["shipping"] = $sqlseller["shipping"];
			$response["seller"]["returns"] = $sqlseller["returns"];
			$response["seller"]["customerservice"] = $sqlseller["customerservice"];
			$response["seller"]["dealsin"] = $sqlseller["dealsin"];

				$response["seller"]["sellerlogo"] = "https://localhost/project/shopurneeds/showroomimages/".$sqlseller["uploadimage1"];
				$response["seller"]["sellerbanner"] = "https://localhost/project/shopurneeds/showroomimages/".$sqlseller["uploadimage"];

       			echo json_encode($response);

		}
		 else {
			$response["status"] = "400";
			$response["msg"] = "Coming Soon...";
			echo json_encode($response);
		}
	 
	?>