<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
			$response["user_id"]=$rows['id'];
	        $response["wallet"]=$rows['wallet'];
	        $response["regwallet"]=$rows['regwallet'];
$resultwallet = mysql_query("select * from shopurneeds_user_wallet where user_id='".$user_id."'");
		    			while($walletrows = mysql_fetch_assoc($resultwallet)) {
                           $walletdetails[] =array("type"=>$walletrows['type'],
			                     "credit"=>$walletrows['credit'],
			                     "debit"=>$walletrows['debit'],
								 "order"=>$walletrows['orderid'],
								 "adddate"=>$walletrows['adddate']); 
}

             $response["walletdetails"]=$walletdetails;

} 

			echo json_encode($response);

		}
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist";
			echo json_encode($response);
		}
?>