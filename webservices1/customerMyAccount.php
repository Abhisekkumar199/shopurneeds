<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $sqluser=mysql_query("select * from buyde_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["user_id"]=$rows['id'];
	        $response["fname"]=$rows['fname'];
	        $response["lname"]=$rows['lname'];
	        $response["email"]=$rows['emailid'];
	        $response["mobile"]=$rows['billing_mobile'];
	        $response["wallet"]=$rows['wallet'];
	        $response["regwallet"]=$rows['regwallet'];
	        $response["referal_code"]="KFRESH".$rows['id'];



} 

			echo json_encode($response);

		}
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist";
			echo json_encode($response);
		}
?>