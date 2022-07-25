<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $deliveryid = $_REQUEST['deliveryid'];
	 	 $start=$_REQUEST['startid'];

	 $sqluser=mysql_query("select * from shopurneeds_driver where id='".$deliveryid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
			            $totlsas = mysql_num_rows(mysql_query("select * from shopurneeds_order where approve_status!='Order Pending' and driver_id='".$deliveryid."' order by oid desc"));
//echo "select * from nfdcart_order where approve_status!='Order Pending' order by oid desc limit $start ,20";
            $result = mysql_query("select * from shopurneeds_order where approve_status!='Order Pending' and driver_id='".$deliveryid."'  order by oid desc limit $start ,20");
            $totlsasssss = mysql_num_rows($result);
            if($totlsasssss>0)
            {
              $ddds="1";  
                
            }
            else
            {
                              $ddds="0";  

                
            }
                        			$response["showresult"] = $ddds;

            			$response["totalrecord"] = $totlsas;
            			
			while($orderrows = mysql_fetch_assoc($result)) {
			$orderdetails[] =array("orderid"=>$orderrows['oid'],
			                     "ordertotal"=>$orderrows['totalcost'],
			                     "shippingcost"=>$orderrows['shipcharge'],
								 "quantity"=>$orderrows['quantity2'],
								 "orderdate"=>$orderrows['orderdate'],
								 "orderstatus"=>$orderrows['approve_status'],
								 "regwallet_discount"=>$orderrows['regwallet'],
							 "userwallet_discount"=>$orderrows['userwallet'],
								"ordermode"=>$orderrows['payby'],
					 "is_picked"=>$orderrows['is_picked'],
								"deliver_fname"=>$orderrows['deliver_fname'],
								"deliver_lname"=>$orderrows['deliver_lname'],
						"deliver_address"=>$orderrows['deliver_address'],
						"deliver_city"=>$orderrows['deliver_city'],
						"deliver_state"=>$orderrows['deliver_state'],
						"deliver_country"=>$orderrows['deliver_country'],
				"deliver_zip"=>$orderrows['deliver_zip']


								 ); 
}

        			$response["orderdetails"] = $orderdetails;

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Delivery Boy do not exist.";
			echo json_encode($response);
		}
?>