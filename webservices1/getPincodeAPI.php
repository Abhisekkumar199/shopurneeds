<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 

	 $sqluser=mysql_query("select * from shopurneeds_pincode where displayflag='1'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	     $response["status"] = "200";
			$response["msg"] = "Success";
while($rows = mysql_fetch_array($sqluser))
{

			
	$Shippingaddress[] = array("pincode"=>$rows['pincode']);

	
} 
		            $response["pincode"]=$Shippingaddress;


			echo json_encode($response);

		}
		else {
			$response["status"] = "400"; 
			$response["msg"] = "Pincode Not Found";
			echo json_encode($response);
		}
?>