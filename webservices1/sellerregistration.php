<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$fname = $_REQUEST['first_name'];
$email = $_REQUEST['email'];
$mobile = $_REQUEST['mobile_no'];
$companyname = $_REQUEST['companyname'];
$password = $_REQUEST['password'];

if($email!="")
{
	if ($db->isSellerExisted($email)) {
	$response["status"] = "400";
		$response["msg"] = "Email ID already exists";
		echo json_encode($response);
	} 
	else
	{
		$user = $db->storeSeller($fname,$mobile, $email,$companyname,$password);
		if ($user) {
			$response["status"] = "200";
			$response["msg"] = "Success Registered";
			echo json_encode($response);
		} 
		else {
			$response["status"] = "401";
			$response["msg"] = "Error occurred in Registration";
			echo json_encode($response);
		}
	}
}
else
{
	$response["status"] = "402";
	$response["msg"] = "Please fill all required field";
	echo json_encode($response);
}