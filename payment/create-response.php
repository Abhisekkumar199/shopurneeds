<?php
$ch = curl_init();

$client="AVuwvvJgST0a3d78OYDn3eBcu676t1tnCTeAOt4S0wAW6ZFrbxgbo2zB4BzEVd6kiZVi86pVRWXrlFtF";
$secret="EPq_oRZg5E220KRtzvLLafdkbOUb0MqHfHKVbaCEaU2DaW1UD-uj4tkGzyyA_yNh2w3Gb3E6kqixYUyD";

curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
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

  $url_payment="https://api.sandbox.paypal.com/v1/payments/payment/".$_GET['paymentID'];

 
 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url_payment);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$ddd));

$result = curl_exec($ch);


if(empty($result))die("Error: No response.");
else
{
    $json = json_decode($result);
echo $json->payments->id;
}


?>