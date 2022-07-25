<?php
session_start();
include("../mailfunction.php");   

date_default_timezone_set('Asia/Calcutta');

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['userId'];
	 $cartid = $_REQUEST['cartId'];
	 $payment_mode = $_REQUEST['paymentMode'];
	 	 $address_id = $_REQUEST['address_id'];

	 $cdate = $_REQUEST["cdate"];
	 	 $isbagused = $_REQUEST['isbagused'];
	 	 	 $coupondiscount = $_REQUEST['coupondiscount'];

	 	 	 	 $iswalletused = $_REQUEST["iswalletused"];

if($isbagused==0)
{
    $bagcost='0';
}
else
{
        $bagcost='10';

}

	 	 	 	$shipping_type_id = $_REQUEST['shipping_type_id'];
if(($cartid!="")&&($cartid!=0))
{
    
 	 
$sqlshipping=mysql_query("select * from shopurneeds_shipping_slot where id='".$shipping_type_id."'");
$rowshipping = mysql_fetch_array($sqlshipping);
$sqladdress=mysql_query("select * from shopurneeds_customer_address where id='".$address_id."'");
$rowaddress= mysql_fetch_array($sqladdress);

$sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
$rowuser = mysql_fetch_array($sqluser);
 $userwallet=$rowuser['wallet'];

	
$qty='0';
$subtotal='0';
$shipprice='0'; 



$sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$cartid."'");
while($rowcart = mysql_fetch_array($sqlcart))
{
			       $sellerId=$rowcart['seller_id'];
   $qty=$qty+$rowcart['quantity'];
   $subtotal=$subtotal+$rowcart['subtotal'];
   $shipprice=$shipprice+$rowcart['shipprice'];
   
   $sellerId=$rowcart['seller_id'];
}

$sgst="0";
$cgst="0";
$totalgst="0";
$sqlsssu=mysql_fetch_array(mysql_query("select mobile1, is_gst,lat,lng,discountper from shopurneeds_suppliers where id='".$sellerId."'"));

$gstcheck=$sqlsssu['is_gst'];
$mobile1=$sqlsssu['mobile1'];

$latseller=$sqlsssu['lat'];
$lngseller="-".$sqlsssu['lng'];
$discountper=$sqlsssu['discountper'];


if($gstcheck==1)
{
    $totalgst=0;
   $sgst=0;
$cgst=0;
}


if($subtotal < 600)
                        {
                            $shippingprice = 49;
                        }
                        else if($subtotal >= 600 and $subtotal < 1100)
                        {
                            $shippingprice = 40;
                        }
                        else
                        {
                            $shippingprice = 0 ;
                        } 
                        
$totalcost=($subtotal+$shippingprice+$bagcost)-($coupondiscount); 
if($iswalletused==1)
{
	if($userwallet>0)
{
if($totalcost > $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;
}
else if($totalcost == $userwallet)
{
$walletused=$userwallet;
$totalcost=$totalcost-$walletused;
$userwalletremain=$userwallet-$walletused;

}
else
{
$walletused=$totalcost;
$userwalletremain=$userwallet-$walletused;
$totalcost=$totalcost-$walletused;


}

}
}
$totalcostfinal=$totalcost+$walletused;
if($payment_mode=="cod")
{
    
    $saveorder=mysql_query("insert into shopurneeds_order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`,`seller_id`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`,`paytype`,`address_type`,discountvalue,gstvalue,shippingslot,cdate,walletused,bagcost,address_id,delivery_date,delivery_slot) values ('".$cartid."', '".$qty."', '".$totalcostfinal."', '".$shippingprice."', '', '', '', '".$rowuser['emailid']."','".$sellerId."', '".$rowuser['emailid']."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Approved','0','0','0', '".$rowuser['dtitle']."', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['deliver_housenumber']."', '".$rowaddress['city']."', 'Delhi', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '".$rowshipping['shipping']."', 'COD','".$addressType."','".$coupondiscount."','".$totalgst."','".$shipping_type_id."','".$cdate."','".$walletused."','".$bagcost."','".$address_id."','".$cdate."','".$shipping_type_id."')");
  
	 $orderid=mysql_insert_id();	
	
	if($orderid>0)
	{
	if($walletused>0){
		    	$basketstatsude=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,debit,adddate) values('".$rowuser['id']."','".$orderid."','Paid for order','".$walletused."',NOW())");
		}
		$totalwalletpoint=$userwalletremain;
    	$basketstatsu=mysql_query("update shopurneeds_user_registration set wallet='$totalwalletpoint' where id='".$user_id."'");	
    	
	
	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Approved','".date('Y-m-d')."', '".date("H:m")."', '1')");	
}

 $str="Hi, Your order no $orderid placed successfully.It will be delivered on ".date("d-M-Y",strtotime($cdate)).". Pay online for hassle free & contactless delivery.";

		$usersss = $db->sendordermsg($rowaddress['mobileno'],$str);

///////////Send Order SMS////////////
$emailid=$rowuser['emailid'];
$paytpemail="cod";

	                 include("app_order_mail.php"); 
                        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
                       // include("order_mail_admin.php");
                        //send_mail($toc, $subjectc, $messagec, $headers1, $fromc, ''); 
                        

	$response["status"] = "200";
			$response["msg"] = "Thank you for placing order with Shopurneeds.";
						$response["otype"] = "cod";
			echo json_encode($response);

	}
	else {


    $saveorder=mysql_query("insert into shopurneeds_order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`,`seller_id`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`,`paytype`,`address_type`,discountvalue,gstvalue,walletused,shippingslot,cdate,bagcost,address_id,delivery_date,delivery_slot) values ('".$cartid."', '".$qty."', '".$totalcostfinal."', '".$shippingprice."', '', '', '', '".$rowuser['emailid']."', '".$sellerId."','".$rowuser['emailid']."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowuser['dtitle']."', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['deliver_housenumber']."', '".$rowaddress['city']."', 'Delhi', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '".$rowshipping['shipping']."', 'Online','".$addressType."','".$coupondiscount."','".$totalgst."','".$walletused."','".$shipping_type_id."','".$cdate."','".$bagcost."','".$address_id."','".$cdate."','".$shipping_type_id."')");


	$orderid=mysql_insert_id();	
	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Pending','".date('Y-m-d')."', '".date("H:m")."', '1')");	
	



    $response["status"] = "200";
			$response["msg"] = "Success";
						$response["otype"] = "online";
					$response["orderid"] = $orderid;
				$response["totalcost"] = $totalcost;
         $response["name"] = $rowuser['dfname'];
         $response["emailid"] = $rowuser['emailid'];
       $response["mobileno"] = $rowuser['deliver_phone'];
			echo json_encode($response);


?>

<?php } }?>