<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$oldPassword = $_REQUEST['oldPassword'];
$newPassword = $_REQUEST['newPassword'];
$emailId = $_REQUEST['emailId'];
$user = $db->resetPassword($oldPassword,$newPassword,$emailId);
if ($user != false) {
	$response["status"] = "200";
	$response["msg"] = "Your password is successfully reset.";
	echo json_encode($response);
} else {
	$response["status"] = "400";
	$response["msg"] = "EmailId / Old Password not match!";
	echo json_encode($response);
}
?>

	