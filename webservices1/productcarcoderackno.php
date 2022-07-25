<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $username = $_REQUEST['username'];
	 $rackno = $_REQUEST['rackno'];
	 $barcode = $_REQUEST['barcode'];


	 
	if($username!='')
{
	
			$insbasket = mysql_query("insert into `shopurneeds_product_scan`(username,rackno,barcode,adddate)values ('".$username."','".$rackno."','".$barcode."',NOW())") or die(mysql_error());
			
			
			$response["status"] = "200";
			$response["msg"] = "Product added in cart successfully";
				echo json_encode($response);

		
}
else
{
    $response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
}
?>