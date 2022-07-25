<?php
require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
	 $pid = $_REQUEST['pid'];
	 $rating = $_REQUEST['rating'];
	 $review = $_REQUEST['review'];
	 $user_id = $_REQUEST['user_id'];
	if($user_id!="") 
	{

		
			$response["status"] = "200";
			$response["msg"] = "Review added Successfully!";
			$insert=mysql_query("INSERT INTO `shopurneeds_reviews` (`product_id`, `user_id`, `rating`, `comments`, `adddate`, `publish`) VALUES ('".$pid."', '".$user_id."','".$rating."', '".$review."', NOW(), '0')");
			echo json_encode($response);
		
	}
	else
	{
	    	$response["status"] = "400";
			$response["msg"] = "Parameter Missing.";
			echo json_encode($response);
	}
	
?>