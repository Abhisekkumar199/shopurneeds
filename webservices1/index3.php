<?php

#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AAAAbpRfSZI:APA91bGAdpoNLVWJBMci2w4bwURzOsawXbjqRNSFIZ9CaRbMZw9wEFgHuaHfU_XSgWIY2Br81xiUCcEE9pCbTO83bfR1WaK48_hF5avbEAKlqF5X0shmI8EUw5dHr4mQZQwylV5rP5W2' );
    $registrationIds = $_REQUEST['id'];

#prep the bundle
     $msg = array
          (
		'body' 	=> 'Body  Of Notification',
		'title'	=> 'Title Of Notification',
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