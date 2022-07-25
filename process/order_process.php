<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<?php
session_start(); 
include("../includes/libraries/mailfunction.php");
include("../configuration.php");	

$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName; 
$URL=URL;
$basketpid=$_SESSION['shopid'];
$emailid=$_SESSION['emailid'];
$qty=$_SESSION['qty'];
$price=$_SESSION['ordervalue'];
$shipprice=$_SESSION['shipprice'];
$shipprice23=$_REQUEST['shipping']; 
$discvalue=$_SESSION['discvalue'];
$vouchervalue=$_SESSION['vouchervalue'];
$pweight=$_SESSION['pweight'];
$ccvalue123=$_REQUEST['ccvalue123'];
$remainccvalue=$_REQUEST['remainccvalue'];
$tax = $_REQUEST['tax'];
$cod_charges = 0;
$coupon_discount = $_REQUEST['coupon_discount'];
$ipaddress=$_SERVER['REMOTE_ADDR'];
$coupondiscount = $_SESSION['couponcartvalue'];
$discountcode = $_SESSION['couponcartdiscode'];

$delivery_date=date("Y-m-d",strtotime($_REQUEST['delivery_date']));
$delivery_slot=$_REQUEST['slot']; 

$sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$_SESSION['selected_address']."'");
$rowaddress = mysqli_fetch_array($sqladdress); 

$sqlcart=mysqli_query($conn,"select * from shopurneeds_basket where bid='".$basketpid."'");
while($rowcart = mysqli_fetch_array($sqlcart))
{
   $sellerId=$rowcart['seller_id']; 
}

if($_SESSION['oid'] == '')
{
    mysqli_query($conn,"insert into ".$sufix."order(`seller_id`,`address_id`,`bid`, `quantity2`, `totalcost`, `walletused`, `shipcharge`, `discountcode`, `coupondiscount`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,`paytype`,`ipaddress`, `orderinistatus`, `ordermode`,`paymentmodetype`,currency,conration,delivery_date,delivery_slot) values ('".$sellerId."','".$_SESSION['selected_address']."','".$basketpid."', '".$qty."', '".$price."', '".$_SESSION['walletamounttobeuse']."', '".$shipprice."', '".$discountcode."', '".$coupondiscount."', '".$vouchervalue."', '".$pweight."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowaddress['fname']."', '".$rowaddress['lname']."', '".$rowaddress['address']."', '".$rowaddress['city']."', 'Delhi', '".$rowaddress['country']."', '".$rowaddress['zipcode']."', '".$rowaddress['mobileno']."', '', '','online','$ipaddress', 'Order pending', 'Online Payment','1','".$_SESSION['currencycode']."','".$_SESSION['conratio']."','".$delivery_date."','".$delivery_slot."')") ;	
    $orderid=mysqli_insert_id($conn);
    $_SESSION['oid']=$orderid;
}


$Amount = $_SESSION['totalpaybleamount'];
 

?>
<?php 
require('../config.php');
require('../razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
$api = new Api($keyId, $keySecret);
$orderData = [
    'receipt'         => 3456,
    'amount'          => $Amount * 100,
    'currency'        => "INR",
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "",
    "description"       => "",
    "image"             => "",
    "prefill"           => [
    "name"              => $rowaddress['fname'],
    "email"             => $emailid,
    "contact"           => $rowaddress['mobileno'],
    ],
    "notes"             => [
    "address"           => $rowaddress['address'],
    "merchant_order_id" => $orderid,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
//print_r($json);

require("../manual.php");
?>


 