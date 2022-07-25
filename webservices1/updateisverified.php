<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $deliveryid = $_REQUEST['deliveryid'];
	 	 $orderId=$_REQUEST['orderId'];
	 	 	 	 $isPicked=$_REQUEST['isPicked'];

	 	 

	 $sqluser=mysql_query("select * from shopurneeds_driver where id='".$deliveryid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
			 $ordsupdate=mysql_query("update shopurneeds_order set is_picked='".$isPicked."' where oid='".$orderId."'");
			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Delivery Boy do not exist.";
			echo json_encode($response);
		}
?>