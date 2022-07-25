<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$email = $_REQUEST['email'];
$user = $db->isUserMobileExist($email);
if ($user != false) {
	$response["status"] = "200";
	$response["msg"] = "Reset code is successfully sent to your mobile. Kindly check your mobile.";
	        $resultuser = mysql_fetch_array(mysql_query("SELECT emailid,billing_mobile from shopurneeds_user_registration WHERE billing_mobile='".$email."'"));

	$random = rand(111111,999999);
	$mobileno=$resultuser['billing_mobile'];
	$update = mysql_query("UPDATE shopurneeds_user_registration set `commcode`='".$random."' where `emailid`='".$resultuser['emailid']."'");
		$usersss = $db->forgotpasswordsms($mobileno,$random);

	//include("../includes/libraries/mailfunction.php");
	//include("../forgot_mail.php");

	//send_mail($resultuser['emailid'], $subjectc, $messagec, $headers1, $fromc, '');
	echo json_encode($response);
	
} else {
	$response["status"] = "400";
	$response["msg"] = "Incorrect Mobile Number!";
	echo json_encode($response); 
}
?>