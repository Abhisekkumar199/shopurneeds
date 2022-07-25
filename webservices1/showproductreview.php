<?php
require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
	$user_id = $_REQUEST['user_id'];
		$pid = $_REQUEST['pid'];

	if($user_id!="") 
	{

		
			$response["status"] = "200";
			$response["msg"] = "Review List!";
				$result = mysql_query("select * from shopurneeds_reviews where product_id='".$pid."'");

					while($rows = mysql_fetch_assoc($result)) {


				$resultuser = mysql_fetch_array(mysql_query("select * from shopurneeds_user_registration where id='".$rows['user_id']."'"));


			$prodetails[] =array("rating"=>$rows['rating'],
			                     "review"=>$rows['comments'],
								 "customename"=>$resultuser['fname']); 
								 
}

		$response["reviewdetails"]=$prodetails;

			echo json_encode($response);

		}
		 else {
			$response["status"] = "400";
			$response["msg"] = "Coming Soon...";
			echo json_encode($response);
		}
	 
	?>