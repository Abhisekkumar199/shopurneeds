<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$otp = $_REQUEST['otp'];
$emailId = $_REQUEST['email'];
$password = $_REQUEST['password'];
$user = $db->resetPasswordByOtp($otp,$emailId,$password);
if ($user != false) {
	$response["status"] = "200";
	$response["msg"] = "Your password is successfully reset.";
	
	echo json_encode($response);
} else {
	$response["status"] = "400";
	$response["msg"] = "Email or otp Password not match!";
	echo json_encode($response);
}
?>

	