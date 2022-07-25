<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 	 $orderId=$_REQUEST['orderId'];

	 	 

	 $sqluser=mysql_query("select * from shopurneeds_order where oid='".$orderId."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

	 $sqldriver=mysql_fetch_array(mysql_query("select * from shopurneeds_driver where id='".$rows['driver_id']."'"));

			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["deliveryboyid"]=$rows['driver_id'];
			$response["is_picked"]=$rows['is_picked'];
			$response["driver_name"]=$sqldriver['driver_name'];
			$response["driver_mobile"]=$sqldriver['driver_mobile'];
			$response["driver_email"]=$sqldriver['driver_email'];
			$response["vehicle_no"]=$sqldriver['vehicle_no'];

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Order do not exist.";
			echo json_encode($response);
		}
?>