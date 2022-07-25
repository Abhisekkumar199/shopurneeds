<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 
	 $flag = $_REQUEST['flag'];
	 
	 if($pid!="")
	 {

$sqlpro=mysql_query("update shopurneeds_product set displayflag='".$flag."' where id='".$pid."'");

  			$response["status"] = "200";
			$response["msg"] = "Product status changed successfully.";

			echo json_encode($response);

		}
		else {
			$response["status"] = "400";
			$response["msg"] = "Parameter Missing";
			echo json_encode($response);
		}
		
	 
?>