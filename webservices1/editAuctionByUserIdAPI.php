<?php
	header("Content-Type:application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$auctionId=$_REQUEST['auctionId'];
	$title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
	$price = $_REQUEST['price'];
	$sponsored = $_REQUEST['sponsored'];
	$image = $_FILES['image']['name'];	

	$userId = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
	if(!empty($userId)){
		
				if($_FILES['image']['name']!='') { 

					$user = $db->editAuctionUserById($userId,$auctionId,$title,$price,$description,$sponsored,$image);

						if ($user) {
							$response["status"] = "200";
							$response["msg"] = "Successfully Auction edit";
							
						}else {
							$response["status"] = "400";
							$response["msg"] = "Error occurred";							
						}
				}else{ 
					$response["status"] = "400";
					$response["msg"] = "Please upload image";					
				}
				
	}else{
		$response["status"] = "401";
		$response["msg"] = "Please Login First";
	
	}
	
	//response
	echo json_encode($response);
	exit;
?>