<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $bid = $_REQUEST['cartid'];
	 $user_id = $_REQUEST['user_id'];
	 	 $shipping_type_id = $_REQUEST['shipping_type_id'];

	 $sqlshipping=mysql_query("select * from buyde_shipping_type where id='".$shipping_type_id."'");
$rowshipping = mysql_fetch_array($sqlshipping);

     $sqlcart=mysql_query("select * from buyde_basket where bid='".$bid."'");
          $cartnum=mysql_num_rows($sqlcart);
          if($cartnum>0)
          {
			$response["status"] = "200";
			$response["msg"] = "Success"; 
			$response["bid"] = $bid;
			$productcost=0;
			$shippingprice=0;
			$totalqty=0;
	$result = mysql_query("select * from buyde_basket where bid='$bid'");
			while($productrows = mysql_fetch_assoc($result)) {
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


			
	 $sqluser=mysql_query("select * from buyde_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

		$regwallet=	$rows['regwallet'];
		$userwallet=	$rows['wallet'];

		if($regwallet>0)
		{
		   $regprocost= ($productcost*25)/100;
		   $regprocost=number_format($regprocost);
		   if($regprocost > $regwallet)
		   {
		       $walletregdis=$regwallet;
		   }
		   else
		   {
		       $walletregdis=$regprocost;
		   }
		   
		}


	

} }
$coupondiscount=0;
if($productcost>200) { $shippingprice='0'; if($shipping_type_id=="5") { $shippingprice='30';} } else {$shippingprice='30';}
$totalcost=($productcost+$shippingprice)-($coupondiscount+$walletregdis); 
	if($userwallet>0)
		{
		  if($totalcost > $userwallet)
		   {
		       		       		       $walletused=$userwallet;

		       $totalcost=$totalcost-$userwallet;
		       $userwalletremain=0;
		   }
		   else if($totalcost == $userwallet)
		   {
		       $totalcost=0;
		       $userwalletremain=0;
		       		       		       $walletused=$userwallet;

		   }
		   else
		   {
		       		       $walletused=$totalcost;

		       $userwalletremain=$userwallet-$totalcost;
		       $totalcost=0;
		       
		   }
		   
		}
                        $response["totalqty"]=$totalqty;
                        $response["subtotal"]=$productcost;
                        $response["shippingprice"]=$shippingprice;
                        $response["reg_wallet_discount"]=$walletregdis;
                        $response["user_wallet"]=$walletused;
                        $response["coupondiscount"]=$coupondiscount;
                        $response["totalcost"]=$totalcost;
echo json_encode($response);
		} else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>