<?php
require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 	
	 $pid = $_REQUEST['pid'];
	 $user_id = $_REQUEST['user_id'];
	 	 $favflag = $_REQUEST['favflag'];

	 if($favflag==1)
	 {
	     $sqlinsert=mysql_query("insert into shopurneeds_favorite_product(user_id,product_id,adddate) VALUES('".$user_id."','".$pid."', NOW())");
	     	$response["status"] = "200";
			$response["msg"] = "Success";
			

			echo json_encode($response);
	 }
	 else if($favflag==0)
	 {
	     
	 	     $sqlinsert=mysql_query("delete from shopurneeds_favorite_product where user_id='".$user_id."' and product_id='".$pid."'");

			$response["status"] = "200";
			$response["msg"] = "success";
		

			echo json_encode($response);
	 }
	 else
	 {
	     	$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
	 }
?>