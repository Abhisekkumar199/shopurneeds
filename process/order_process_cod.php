<?php 
session_start();  
include("../configuration.php");	
include("../mailfunction.php");

$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName; 
$URL=URL;
$basketpid=$_SESSION['shopid'];
$emailid=$_SESSION['emailid'];
$qty=$_SESSION['qty'];
$price=$_SESSION['ordervalue']; 
$shipprice=$_SESSION['shipprice'];
$codcharges=$_SESSION['cod_charges'];  
$vouchervalue=$_SESSION['vouchervalue'];
$pweight=$_SESSION['pweight'];
$ccvalue123=$_REQUEST['ccvalue123'];
$remainccvalue=$_REQUEST['remainccvalue'];
$tax = $_REQUEST['tax'];
$cod_charges = 0;
$coupon_discount = $_REQUEST['coupon_discount'];

$coupondiscount = $_SESSION['couponcartvalue'];
$discountcode = $_SESSION['couponcartdiscode'];


$delivery_date=date("Y-m-d",strtotime($_REQUEST['delivery_date']));
$delivery_slot=$_REQUEST['slot']; 

$ipaddress=$_SERVER['REMOTE_ADDR'];
$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'") ;
$rowuser=mysqli_fetch_assoc($sql);
$sqlcou=mysqli_query($conn,"select countryname from shopurneeds_country where countrycode='".$rowuser['deliver_country']."'");

$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$_SESSION['selected_address']."'");
$rowaddress = mysqli_fetch_array($sqladdress); 

$sqlcart=mysqli_query($conn,"select * from shopurneeds_basket where bid='".$basketpid."'");
while($rowcart = mysqli_fetch_array($sqlcart))
{
   $sellerId=$rowcart['seller_id']; 
}
 
 if($_REQUEST['paytype'] == 'wallet')
 {
     $sql_order = mysqli_query($conn,"insert into ".$sufix."order(`seller_id`,`address_id`,`bid`, `quantity2`, `totalcost`, `walletused`, `shipcharge`,`codcharge`, `discountcode`, `coupondiscount`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `deliver_fname`, `deliver_lname`, `deliver_address` , `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,`paytype`,`ipaddress`, `orderinistatus`, `ordermode`,`paymentmodetype`,currency,conration,delivery_date,delivery_slot) values ('".$sellerId."','".$_SESSION['selected_address']."','".$basketpid."', '".$qty."', '".$price."', '".$_SESSION['walletamounttobeuse']."', '".$shipprice."', '".$codcharges."', '".$discountcode."', '".$coupondiscount."', '".$vouchervalue."', '".$pweight."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Placed','0','0','1', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['city']."', 'Delhi', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '', '','Wallet','$ipaddress', 'Order Approved', 'Wallet','1','".$_SESSION['currencycode']."','".$_SESSION['conratio']."','".$delivery_date."','".$delivery_slot."')") ;
 }
 else
 {
     $sql_order = mysqli_query($conn,"insert into ".$sufix."order(`seller_id`,`address_id`,`bid`, `quantity2`, `totalcost`, `walletused`, `shipcharge`,`codcharge`, `discountcode`, `coupondiscount`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `deliver_fname`, `deliver_lname`, `deliver_address` , `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,`paytype`,`ipaddress`, `orderinistatus`, `ordermode`,`paymentmodetype`,currency,conration,delivery_date,delivery_slot) values ('".$sellerId."','".$_SESSION['selected_address']."','".$basketpid."', '".$qty."', '".$price."', '".$_SESSION['walletamounttobeuse']."', '".$shipprice."', '".$codcharges."', '".$discountcode."', '".$coupondiscount."', '".$vouchervalue."', '".$pweight."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Placed','0','0','0', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['city']."', 'Delhi', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '', '','COD','$ipaddress', 'Order pending', 'COD','1','".$_SESSION['currencycode']."','".$_SESSION['conratio']."','".$delivery_date."','".$delivery_slot."')") ;
 }
	
$orderid=mysqli_insert_id($conn);
$_SESSION['oid']=$orderid;
?>
<script type="text/javascript">
<!--
window.location = "https://localhost/project/shopurneeds/checkout/codconfirm"
//-->
</script>
