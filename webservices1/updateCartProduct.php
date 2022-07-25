<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 $bid = $_REQUEST['cartid'];
	 $size = $_REQUEST['size'];

     $option=$_REQUEST['option'];
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
while($rows = mysql_fetch_array($sqlcart))
{
	$sellingprice=$rows['sellingprice'];
	$qty=$rows['quantity'];	
	$pweight2=$rows['pweight'];
	$shipprice=$rows['shipprice'];
	
}


if($option=='add')
{
	$qty2=$qty + 1;
}
else
{
	$qty2=$qty - 1;

}	

if($qty2<1)
{	
	$qty2=1;
}

 $subtotal=$sellingprice*$qty2;
 $pweight= $pweight2*$qty2;
 if($size!="")
     {
 	 $updatecart=mysql_query("update `shopurneeds_basket` set `quantity`='".$qty2."', `subtotal`='".$subtotal."', `totalweight`='".$pweight."' where bid='".$bid."' and productid='".$pid."'and  size='".$size."'"); 
     }
     else
     {
          	 $updatecart=mysql_query("update `shopurneeds_basket` set `quantity`='".$qty2."', `subtotal`='".$subtotal."', `totalweight`='".$pweight."' where bid='".$bid."' and productid='".$pid."'"); 

     }
		
			$response["status"] = "200";
			$response["msg"] = "Product Quantity updated successfully";
			$response["qty"] = $qty2;
			
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