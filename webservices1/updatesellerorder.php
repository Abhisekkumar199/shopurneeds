<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $sellerid = $_REQUEST['sellerid'];
	 $order_id = $_REQUEST['order_id'];
	 $orderstatus = $_REQUEST['orderstatus'];

	 $sqluser=mysql_query("select * from shopurneeds_suppliers where id='".$sellerid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
				$time = date("H:i:s");

	$ssa=mysql_query("update `shopurneeds_order` set `approve_status`='".$orderstatus."' where oid='".$order_id."'");		
	
	$dsss=mysql_query("insert into `shopurneeds_order_status` (`oid`,`remarks`,`adddate`,`displayflag`,`addtime`,`add_user`) values ('".$order_id."','".$orderstatus."','".date("Y-m-d")."', '1','".$time."','Seller')");

	
	
			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Seller do not exist.";
			echo json_encode($response);
		}
?>