<?php

$deviceToken="a1f99414946cbb39eee556af9f912ea9eaf4e12e91debb8ad08c5b0a4a4f24ff";
// Put your private key's passphrase here:
$passphrase ='123456';


$messiostitle=$_POST['messiostitle'];
$messioskeymsg=$_POST['messioskeymsg'];
$messiosopen=$_POST['messiosopen'];
$messiosweblink=$_POST['messiosweblink'];


////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'jmDev.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.sandbox.push.apple.com:2195', $err,

	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body


$body = array(
    'aps' => array(
		'alert' =>array(
			'title' => $messiostitle,
			'body' => $messioskeymsg,
			'content-available' => 1,
			'sound' => 'default',
		),
	),
	'notification' => array(
		'open' => $messiosopen,
	    'link' => $messiosweblink,
		'image' => $messiosimage
	    )
	);
	
	
// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
$result = fwrite($fp, $msg, strlen($msg));

if (!$result) 
	echo 'Message not delivered' . PHP_EOL;

else 
	echo 'Message successfully delivered' . PHP_EOL;
    

// Close the connection to the server
fclose($fp);

