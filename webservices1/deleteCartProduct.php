<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 $bid = $_REQUEST['cartid']; 
	 	 $size = $_REQUEST['size'];
if($size!="")
     {
	 $sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$bid."' and productid='".$pid."' and size='".$size."'");
     }
     else
     {
        	 $sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$bid."' and productid='".$pid."'");
 
     }
	 $numcart=mysql_num_rows($sqlcart);
	 if($numcart>"0")
	 {
	     if($size!="")
     {
 	 $updatecart=mysql_query("delete from `shopurneeds_basket` where bid='".$bid."' and productid='".$pid."' and size='".$size."'");
     }
     else
     {
          	 $updatecart=mysql_query("delete from `shopurneeds_basket` where bid='".$bid."' and productid='".$pid."'");

     }
			$response["status"] = "200";
			$response["msg"] = "Product Deleted Successfully";
				$sqlcarttotal=mysql_query("select sum(quantity) as quantity,sum(subtotal) as subtotal from shopurneeds_basket where  bid='".$bid."'");
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