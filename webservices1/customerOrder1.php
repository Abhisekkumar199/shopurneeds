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
            $result = mysql_query("select * from buyde_order where userid='".$rows['emailid']."' and approve_status!='Order Pending'");
			while($orderrows = mysql_fetch_assoc($result)) {
			$orderdetails[] =array("orderid"=>$orderrows['oid'],
			                     "ordertotal"=>$orderrows['totalcost'],
			                     "shippingcost"=>$orderrows['shipcharge'],
								 "quantity"=>$orderrows['quantity2'],
								 "orderdate"=>$orderrows['orderdate'],
								 "orderstatus"=>$orderrows['approve_status'],
								 "regwallet_discount"=>$orderrows['regwallet'],
								 "userwallet_discount"=>$orderrows['userwallet']
								 ); 
}
        			$response["orderdetails"] = $orderdetails;

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist.";
			echo json_encode($response);
		}
?>