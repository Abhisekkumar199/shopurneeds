<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$notiSql = mysql_query("select * from jewellersmandi_product_enquiry where ios_status='0' order by id asc limit 1");
if(mysql_num_rows($notiSql)>0) { 
$notiRows = mysql_fetch_assoc($notiSql);
$notiSql = mysql_query("update jewellersmandi_product_enquiry set ios_status='1' where id='".$notiRows['id']."'");
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$user = $db->getAllCustomerios($userId);
		
		while($customerRows = mysql_fetch_assoc($user)) {
$ioscount12=$customerRows['ios_count']+1;
$sqlaa=mysql_query("update jewellersmandi_user_registration set ios_count=ios_count+1 where id='".$customerRows['id']."'");
		$registrationIds = $customerRows['ios_token'];
 $deviceToken=$registrationIds;
// Put your private key's passphrase here:
$passphrase ='123456';


$messiostitle="Jewellers Mandi";
$messioskeymsg="You have new demand";
$messiosopen=$_POST['messiosopen'];
$messiosweblink=$_POST['messiosweblink'];


////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();
stream_context_set_option($ctx, 'ssl', 'local_cert', 'jmPro2.pem');
stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server
$fp = stream_socket_client(
	'ssl://gateway.push.apple.com:2195', $err,

	$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)
	exit("Failed to connect: $err $errstr" . PHP_EOL);

//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body


$body = array(
    'aps' => array(
	
			'alert' => $messioskeymsg,
			'sound' => 'default',
			'badge' => intval($ioscount12)

	
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
	echo 'Message successfully delivered' . PHP_EOL.$ioscount12;
    

// Close the connection to the server
fclose($fp);
}
}
?>