<?php
//session_start();
//include 'config.php';
$ch = curl_init();

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
}

$ddd=$json->access_token;

  $url_payment="https://api.paypal.com/v1/payments/payment/".$_POST['paymentID']."/execute/";

 
  $data = '{
      "payer_id": "'.$_POST['payerID'].'"

}';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url_payment);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$ddd));

$result = curl_exec($ch);



?>