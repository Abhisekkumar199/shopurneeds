<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions(); 
#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAAbpRfSZI:APA91bGAdpoNLVWJBMci2w4bwURzOsawXbjqRNSFIZ9CaRbMZw9wEFgHuaHfU_XSgWIY2Br81xiUCcEE9pCbTO83bfR1WaK48_hF5avbEAKlqF5X0shmI8EUw5dHr4mQZQwylV5rP5W2' );
	$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
		$user = $db->getAllCustomer($userId);
		
		while($customerRows = mysql_fetch_assoc($user)) {
		
		$alluser[] =  $customerRows['android_token'];
		}
		for($i=0;$i<count($alluser);$i++) { 
		$registrationIds = $alluser[$i];

#prep the bundle
     $msg = array
          (
		'body' 	=> strip_tags($notiRows['message']),
		'title'	=> strip_tags($notiRows['title']),
             	'icon'	=> 'myicon',/*Default Icon*/
              	'sound' => 'mySound'/*Default sound*/
          );

	$fields = array
			(
				'to'		=> $registrationIds,
				'notification'	=> $msg
			);
	
	
	$headers = array
			(
				'Authorization: key=' . API_ACCESS_KEY,
				'Content-Type: application/json'
			);

#Send Reponse To FireBase Server	
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

#Echo Result Of FireBase Server
echo $result;
}
?>