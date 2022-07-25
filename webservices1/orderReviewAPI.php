<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $bid = $_REQUEST['cartid'];
	 $user_id = $_REQUEST['user_id'];
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
								 "imageurl"=>"https://www.keramicfresh.com/productimage/small/".$productrows['productimage'],
								 "pid"=>$productrows['productid'],
								 "qty"=>$productrows['quantity'],
								 "size"=>$productrows['size']
								 ); 
}

$resultship = mysql_query("select * from buyde_shipping_type");
			while($shiprows = mysql_fetch_assoc($resultship)) {
			    	$shippingtype[] =array("shipid"=>$shiprows['id'],"shiptype"=>$shiprows['shipping'],
			                     "shipcost"=>$shiprows['price']
								 ); 
			    
			}
				            $response["shippingtype"]=$shippingtype;

			
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
	
		$sname=$rows['dfname'].' '.$rows['dlname'];
		$saddress=$rows['deliver_address'].' , '.$rows['deliver_city'].' '.$rows['deliver_state'].' '.$rows['deliver_zip'];
		$smobile=$rows['deliver_phone'];
	$Shippingaddress[] = array("customername"=>$sname,"customeraddress"=>$saddress,"customermobile"=>$smobile);
	            $response["shippingaddress"]=$Shippingaddress;

	

} }
$coupondiscount=0;

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
            $response["productdetails"]=$prodetails;
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