<?php
session_start();
include("includes/chklogin.php");
include("includes/libraries/mailfunction.php");
include("includes/configuration.php");	

$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName; 
$URL=URL;
$basketpid=$_SESSION['shopid'];
$emailid=$_SESSION['emailid'];
$qty=$_SESSION['qty'];
$price=$_SESSION['price'];
$shipprice=$_SESSION['shipprice'];
$shipprice23=$_REQUEST['shipping']; 
$discvalue=$_SESSION['discvalue'];
$vouchervalue=$_SESSION['vouchervalue'];
$pweight=$_SESSION['pweight'];
$ccvalue123=$_REQUEST['ccvalue123'];
$remainccvalue=$_REQUEST['remainccvalue'];
$tax = $_REQUEST['tax'];
$cod_charges = $_REQUEST['cod_charges'];
$coupon_discount = $_REQUEST['coupon_discount'];
$ipaddress=$_SERVER['REMOTE_ADDR'];
$sql=mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$_SESSION['emailid']."'") ;
$rowuser=mysqli_fetch_assoc($sql);
mysqli_query($conn,"insert into ".$sufix."order(`bid`, `quantity2`, `totalcost`, `shipcharge`, `discountcode`, `vouchervalue`, `oweight`, `userid`, `emailid`, `displayflag`, `orderdate`, `ordertime`, `approve_status`, `confirm_status`, `deliver_status`, `paymentflag`, `dtitle`, `deliver_fname`, `deliver_lname`, `deliver_address`, `deliver_housenumber`, `deliver_city`, `deliver_state`, `deliver_country`, `deliver_zip`, `deliver_phone`, `shippingmethod`, `shipping_cost`,`paytype`,`ipaddress`, `orderinistatus`, `ordermode`,`paymentmodetype`,currency,conration) values ('".$basketpid."', '".$qty."', '".$price."', '".$shipprice."', '".$discvalue."', '".$vouchervalue."', '".$pweight."', '".$emailid."', '".$emailid."', '1','".date('Y-m-d')."', '".date("H:i")."', 'Order Pending','0','0','0', '".$rowuser['dtitle']."', '".$rowuser['dfname']."', '".$rowuser['dlname']."', '".$rowuser['deliver_address']."', '".$rowuser['deliver_housenumber']."', '".$rowuser['deliver_city']."', '".$rowuser['deliver_state']."', '".$rowuser['deliver_country']."', '".$rowuser['deliver_zip']."', '".$rowuser['deliver_phone']."', '', '','online','$ipaddress', 'Order pending', 'Online Payment','1','".$_SESSION['currencycode']."','".$_SESSION['conratio']."')") ;	
$orderid=mysql_insert_id();
$_SESSION['oid']=$orderid;
$baskk=mysqli_query($conn,"select * from `".$sufix."basket` where bid='".$basketpid."'");
$totalcose1="0";

while($rowsbaskk=mysqli_fetch_array($baskk))
{
    
    $itemcals11 .='{
        "quantity": "'.$rowsbaskk['quantity'].'",
        "name": "'.$rowsbaskk['productname'].'",
        "price": "'.floor($rowsbaskk['sellingprice']*$_SESSION['conratio']).'",
        "currency": "'.$_SESSION['currencycode'].'",
        "description": "'.$rowsbaskk['productname'].'",
        "tax": "0"
      },';
}
$itemcals=substr($itemcals11,0,-1);
///////////code for paypal////////////////////////////////
//open connection
$ch = curl_init();
$pay1="noida123";
$client="Aehy69M7LRXC9lTB2v8KKmW7HHCoqaZm5fvVGx3R_R0geD4-Zr3SUIWA_jVROQWXeDdzrZGLhGSmiNfE";
$secret="EA0EuyU6gFnLKMDrBxEtmynqUOlo_JMgn_lQoNwvUT9t2kCNU8Cd9FeUgxTlcZXqCGmxL_I6qvPEw2CH";

curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERPWD, $client.":".$secret);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

$result = curl_exec($ch);

if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
  //  print_r($json->access_token);
}

// Now doing txn after getting the token 
$rrr=$json->access_token;
$ch = curl_init();

 $data = '{
  "intent": "sale",
  "redirect_urls":
  {
    "return_url": "https://localhost/project/shopurneeds/create-response.php",
    "cancel_url": "https://localhost/project/shopurneeds/cancel.php"
  },
  "payer":
    {
     "payment_method": "paypal",
		"payer_info": {
			"email":"'.$emailid.'",
			"first_name": "'.trim($rowuser['fname']).'",
			"last_name":"'.trim($rowuser['lname']).'"
		}
    },
    "application_context" : {
 	 	"shipping_preference": "SET_PROVIDED_ADDRESS"
	},
  "transactions": [
  {
  
  
  
    "amount":
    {
      "total": "'.floor(($price-$_SESSION['couponcartvalue'])*$_SESSION['conratio']).'",
      "currency": "'.$_SESSION['currencycode'].'",
      "details":
      {
        "subtotal": "'.floor($price*$_SESSION['conratio']).'",
        "shipping": "0.00",
        "tax": "0.00",
        "shipping_discount": "'.floor($_SESSION['couponcartvalue']*$_SESSION['conratio']).'"
      }
    },
    
    "item_list":
    {
    
      "items": [
      '.$itemcals.'
      ],
      
      "shipping_address": {
          "recipient_name": "'.trim($rowuser['dfname']).' '.trim($rowuser['lname']).'",
          "line1": "'.trim($rowuser['deliver_address']).'",
          "line2": "",
          "city": "'.trim($rowuser['deliver_city']).'",
          "state": "'.trim($rowuser['deliver_state']).'",
          "phone": "'.trim($rowuser['deliver_phone']).'",
          "postal_code": "'.trim($rowuser['deliver_zip']).'",
          "country_code": "'.trim($rowuser['deliver_country']).'"
        },
        	   "shipping_phone_number" : "'.trim($rowuser['billing_mobile']).'"

    },
      
      
    
      "description":"This is the payment transaction description.",
       "invoice_number": "'.$orderid.'"
    }
  ]
}
';

curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/payments/payment");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$rrr));

$result = curl_exec($ch);


if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
    print_r(substr($json,0,-1));
}


?>