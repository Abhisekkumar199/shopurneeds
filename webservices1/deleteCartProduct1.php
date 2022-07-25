<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 $bid = $_REQUEST['cartid']; 
	 $sqlcart=mysql_query("select * from buyde_basket where bid='".$bid."' and productid='".$pid."'");
	 $numcart=mysql_num_rows($sqlcart);
	 if($numcart>"0")
	 {
 	 $updatecart=mysql_query("delete from `buyde_basket` where bid='".$bid."' and productid='".$pid."'");
			$response["status"] = "200";
			$response["msg"] = "Product Deleted Successfully";
				$sqlcarttotal=mysql_query("select sum(quantity) as quantity,sum(subtotal) as subtotal from buyde_basket where  bid='".$bid."'");
				$rowtotal=mysql_fetch_array($sqlcarttotal);
                $totalcartqty=$rowtotal['quantity'];
                                $totalcartprice=$rowtotal['subtotal'];

        					$response["totalcartqty"]=$totalcartqty;
        					        					$response["totalcartprice"]=$totalcartprice;

			echo json_encode($response);
		}
		else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>