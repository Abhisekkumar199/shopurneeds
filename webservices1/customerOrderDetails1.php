<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $order_id = $_REQUEST['order_id'];

	 $sqluser=mysql_query("select * from buyde_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
            $result = mysql_query("select * from buyde_order where oid='".$order_id."'");
			while($orderrows = mysql_fetch_assoc($result)) {
			    $results = mysql_query("select * from buyde_basket where bid='".$orderrows['bid']."'");
			while($productrows = mysql_fetch_assoc($results)) {
			    $productcost=$productcost+($productrows['sellingprice']*$productrows['quantity']);
			    $shippingprice=$shippingprice+$productrows['shipprice'];
			    $totalqty=$totalqty+$productrows['quantity'];
			    	$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
			                     "costprice"=>$productrows['costprice'],
								 "discount"=>number_format($pervalue,0),
								 "imageurl"=>$productrows['productimage'],
								 "pid"=>$productrows['productid'],
								 "qty"=>$productrows['quantity'],
								 "size"=>$productrows['size']
								 ); 
}
			$orderdetails[] =array("orderid"=>$orderrows['oid'],
			                     "ordertotal"=>$orderrows['totalcost'],
			                     "shippingcost"=>$orderrows['shipcharge'],
								 "quantity"=>$orderrows['quantity2'],
								 "orderdate"=>$orderrows['orderdate'],
								 "orderstatus"=>$orderrows['approve_status'],
								 "regwallet_discount"=>$orderrows['regwallet'],
								"userwallet_discount"=>$orderrows['userwallet'],
								 "emailid"=>$orderrows['emailid'],
								 "sfname"=>$orderrows['deliver_fname'],
								 "slname"=>$orderrows['deliver_lname'],
								  "saddress"=>$orderrows['deliver_address'],
								 "slankmark"=>$orderrows['deliver_housenumber'],
								 "scity"=>$orderrows['deliver_city'],
								  "sstate"=>$orderrows['deliver_state'],
								 "spincode"=>$orderrows['deliver_zip'],
								 "sphone"=>$orderrows['deliver_phone'],
								 "prodetails"=>$prodetails

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