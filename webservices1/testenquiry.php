<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 $mobilenumber = $_REQUEST['mobilenumber'];
$userid = $_REQUEST['userid'];


if($mobilenumber!="")
{
    $ddds=mysql_query("insert into tesing_enquiry(`number`,`adddate`,`addtime`) values('".$mobilenumber."',NOW(),NOW())");
			$response["status"] = "200";
			$response["msg"] = "Success Registered";
				echo json_encode($response);

	
}
else
{
	$response["status"] = "402";
	$response["msg"] = "No Mobile Number";
	echo json_encode($response);
}