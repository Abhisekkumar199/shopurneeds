<?php
session_start();


$orderid=$_SESSION['oidapi'];

$Amount=	$_SESSION['ordertotalcost'];

?>
	
	
	<?php 
require('config222.php');
require('razorpay-php/Razorpay.php');
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
    "name"              => $_SESSION['orderfirstname'],
    "email"             => $_SESSION['apiemail'],
    "contact"           => $_SESSION['ordermobilenumber'],
    ],
    "notes"             => [
    "address"           => "noida",
    "merchant_order_id" => $orderid,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
//print_r($json);

require("manual.php");
?>
