<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$fname = $_REQUEST['fname'];
	$lname = $_REQUEST['lname'];
	$mobile = $_REQUEST['billingMobile'];
	$landlineno = $_REQUEST['billingPhone'];
	$companyname = $_REQUEST['companyName'];
	$street = $_REQUEST['billingHouseNumber'];
	$state = $_REQUEST['billingState'];
	$city = $_REQUEST['billingCity'];
	$pin = $_REQUEST['billingZip'];
	$userType = $_REQUEST['userType'];
	$category = $_REQUEST['category'];
	$userLogo = $_FILES['userLogo']['name'];
	$userDocument = $_FILES['userDocument']['name'];
	
	$gstNo = $_REQUEST['gstNo'];
	$panNo = $_REQUEST['panNo'];
	$aadhaarNo = $_REQUEST['aadhaarNo'];
	//$userVisitingCard = $_FILES['userVisitingCard']['name'];
	
	
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if($userId!="")
{

			$user = $db->editProfileUserById($userId,$fname,$lname,$mobile,$landlineno,$companyname,$street,$state,$city,$pin,$userType,$userLogo,$userDocument,$category,$gstNo,$panNo,$aadhaarNo);

			if ($user) {
			$response["status"] = "200";
				$response["msg"] = "Profile Updated Successfully!";
				echo json_encode($response);
				
			} 
			else {
			$response["status"] = "400"; 
				$response["msg"] = "Error occurred in updating profile";
				echo json_encode($response);
			}
		
}
else
{
    $response["status"] = "401";
				$response["msg"] = "Please Try Again!";
				echo json_encode($response);
}