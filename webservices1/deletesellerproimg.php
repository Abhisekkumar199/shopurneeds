<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 $imageid = $_REQUEST['imageid']; 
	 $sqlcart=mysql_query("select * from shopurneeds_imageupload where pid='".$pid."' and id='".$imageid."'");
	 $numcart=mysql_num_rows($sqlcart);
	 if($numcart>"0")
	 {
 	 $updatecart=mysql_query("delete from `shopurneeds_imageupload` where id='".$imageid."'");
			$response["status"] = "200";
			$response["msg"] = "Product images Deleted Successfully";
				
			echo json_encode($response);
		}
		else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>