<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$businessCategory = $_REQUEST['businessCategory'];
	$businessSubCategory = $_REQUEST['businessSubCategory'];
	$businessName = $_REQUEST['businessName'];
    $contactPerson = $_REQUEST['contactPerson'];
	$contactNumber = $_REQUEST['contactNumber'];
	$contactEmail = $_REQUEST['contactEmail'];
	$contactAddress = $_REQUEST['contactAddress'];
	
	$description = $_REQUEST['description'];
	
	$state = $_REQUEST['state'];
	$city = $_REQUEST['city'];
	
	$businessLogo = $_FILES['businessLogo']['name'];
	$businessVisitingCard = $_FILES['businessVisitingCard']['name'];
	
$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if($userId!="")
{
			$user = $db->addBusinessListingByUserId($userId,$businessCategory,$businessSubCategory,$businessName,$contactPerson,$contactNumber,$contactEmail,$contactAddress,$description,$businessLogo,$businessVisitingCard,$state,$city);

			if ($user) {
			$response["status"] = "200";
				$response["msg"] = "Success"; 
				echo json_encode($response);
			} 
			else {
			$response["status"] = "400";
				$response["msg"] = "Error occurred in business listing";
				echo json_encode($response);
			}
}
else
{
    $response["status"] = "400"; 
				$response["msg"] = "Please fill all required field";
				echo json_encode($response);
}