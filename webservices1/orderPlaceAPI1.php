<?php
session_start();
include("../includes/libraries/mailfunction.php");
date_default_timezone_set('Asia/Calcutta');

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $cartid = $_REQUEST['cartid'];
	 	 $payment_mode = $_REQUEST['payment_mode'];
	 	 	 	 $shipping_type_id = $_REQUEST['shipping_type_id'];
if(($cartid!="")&&($cartid!=0))
{
    
 	 
$sqlshipping=mysql_query("select * from shopurneeds_shipping_type where id='".$shipping_type_id."'");
$rowshipping = mysql_fetch_array($sqlshipping);

$sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
$rowuser = mysql_fetch_array($sqluser);

		$regwallet=	$rowuser['regwallet'];
		$userwallet=	$rowuser['wallet'];

	
$qty='0';
$subtotal='0';
$shipprice='0'; 

$sqlcart=mysql_query("select * from shopurneeds_basket where bid='".$cartid."'");
while($rowcart = mysql_fetch_array($sqlcart))
{
   $qty=$qty+$rowcart['quantity'];
   $subtotal=$subtotal+$rowcart['subtotal'];
   $shipprice=$shipprice+$rowcart['shipprice'];

    
}
	if($regwallet>0)
		{
		   $regprocost= ($subtotal*20)/100;
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
		if($subtotal>200) { $shippingprice='0'; if($shipping_type_id=="5") { $shippingprice='20';} } else {$shippingprice='30';}

$totalcost=($subtotal+$shippingprice)-($coupondiscount+$walletregdis); 
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
		
if($payment_mode=="cod")
{
    
 
  $saveorder=mysql_query("insert into shopurneeds_order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`,`payby`,regwallet,userwallet) values ('".$cartid."', '".$qty."', '".$totalcost."', '".$shippingprice."', '', '', '', '".$rowuser['emailid']."', '".$rowuser['emailid']."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Placed','0','0','0', '".$rowuser['dtitle']."', '".$rowuser['dfname']."', '".$rowuser['dlname']."', '".$rowuser['deliver_address']."', '".$rowuser['deliver_housenumber']."', '".$rowuser['deliver_city']."', '".$rowuser['deliver_state']."', '".$rowuser['deliver_country']."', '".$rowuser['deliver_zip']."', '".$rowuser['deliver_phone']."', '".$rowshipping['shipping']."', 'COD','".$walletregdis."','".$walletused."')");
	$orderid=mysql_insert_id();	
	
	
		$subtotalremaining=($subtotal*8/100);
		if($walletused>0){
		    	$basketstatsude=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,debit,adddate) values('".$rowuser['id']."','".$orderid."','Paid for order','".$walletused."',NOW())");
		}
		    	$basketstatsucr=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,credit,adddate) values('".$rowuser['id']."','".$orderid."','Cashback Received','".$subtotalremaining."',NOW())");
		    	
		$totalwalletpoint=$userwalletremain+$subtotalremaining;
    	$basketstatsu=mysql_query("update shopurneeds_user_registration set wallet='$totalwalletpoint' where id='".$user_id."'");	

  $regremainwallet=$regwallet-$walletregdis;
	if($regwallet>0)
{
    	$basketstatsu=mysql_query("update shopurneeds_user_registration set regwallet='$regremainwallet' where id='".$user_id."'");	
}
	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Placed','".date('Y-m-d')."', '".date("H:m")."', '1')");	
///////////Send Order SMS////////////
	 $str="Hi ".$rowuser['fname']." ".$rowuser['lname'].", Thank you for your order No. ".$orderid." at https://localhost/project/shopurneeds of amount Rs. ".$totalcost.". We will deliver the order asap.";
	
	$message=urlencode($str);

$username="phalanxtrans";

$password="mfePrK1z";

$senderid="MAZBOX";

$numbers=$rowuser['billing_mobile'];

$url="http://sms6.routesms.com:8080/bulksms/bulksms?username=$username&password=$password&type=0&dlr=1&destination=$numbers&source=$senderid&message=$message";



$ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);
	
	
	//////////Send Order SMS////////////
  $_SESSION['oidapi']=$orderid;
?>

<script type="text/javascript">
<!--
window.location = "https://localhost/project/shopurneeds/webservices1/order_cod_success.php"
//-->
</script>

<?php


}
else if($payment_mode=="paytm")

{
    

$saveorder=mysql_query("insert into shopurneeds_order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`,`payby`,regwallet,userwallet) values ('".$cartid."', '".$qty."', '".$totalcost."', '".$shippingprice."', '', '', '', '".$rowuser['emailid']."', '".$rowuser['emailid']."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowuser['dtitle']."', '".$rowuser['dfname']."', '".$rowuser['dlname']."', '".$rowuser['deliver_address']."', '".$rowuser['deliver_housenumber']."', '".$rowuser['deliver_city']."', '".$rowuser['deliver_state']."', '".$rowuser['deliver_country']."', '".$rowuser['deliver_zip']."', '".$rowuser['deliver_phone']."', '".$rowshipping['shipping']."', 'Paytm','".$walletregdis."','".$walletused."')");
	$orderid=mysql_insert_id();	
	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Pending','".date('Y-m-d')."', '".date("H:m")."', '1')");	
	



    $_SESSION['oidapi']=$orderid;
    $_SESSION['apiuserid']=$user_id;
	$_SESSION['apiemail']=$rowuser['emailid'];
	$_SESSION['ordertotalcost']=$totalcost;
	$_SESSION['orderfirstname']=$rowuser['dfname'];
	$_SESSION['orderlastname']=$rowuser['dlname'];
    $_SESSION['ordermobilenumber']=$rowuser['billing_mobile'];

?>
<script type="text/javascript">
<!--
window.location = "https://localhost/project/shopurneeds/webservices1/paytm_app_order.php"
//-->
</script>
<?php } 
else
{
    

$saveorder=mysql_query("insert into shopurneeds_order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`,`payby`,regwallet,userwallet) values ('".$cartid."', '".$qty."', '".$totalcost."', '".$shippingprice."', '', '', '', '".$rowuser['emailid']."', '".$rowuser['emailid']."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowuser['dtitle']."', '".$rowuser['dfname']."', '".$rowuser['dlname']."', '".$rowuser['deliver_address']."', '".$rowuser['deliver_housenumber']."', '".$rowuser['deliver_city']."', '".$rowuser['deliver_state']."', '".$rowuser['deliver_country']."', '".$rowuser['deliver_zip']."', '".$rowuser['deliver_phone']."', '".$rowshipping['shipping']."', 'Online','".$walletregdis."','".$walletused."')");
	$orderid=mysql_insert_id();	
	$basketstatsu=mysql_query("insert into shopurneeds_order_status(`oid`,`remarks`,`adddate`, `addtime`, `displayflag`) values ('".$orderid."','Order Pending','".date('Y-m-d')."', '".date("H:m")."', '1')");	
	



    $_SESSION['oidapi']=$orderid;
	$_SESSION['apiemail']=$rowuser['emailid'];
	$_SESSION['ordertotalcost']=$totalcost;
	$_SESSION['orderfirstname']=$rowuser['dfname'];
	$_SESSION['orderlastname']=$rowuser['dlname'];
    $_SESSION['ordermobilenumber']=$rowuser['billing_mobile'];

?>
<script type="text/javascript">
<!--
window.location = "https://localhost/project/shopurneeds/webservices1/payu-redirect.php"
//-->
</script>
<?php } }?>