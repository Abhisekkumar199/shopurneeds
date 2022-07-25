<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
	$price = $_REQUEST['price'];
	$sponsored = $_REQUEST['sponsored'];
	$image = $_FILES['image']['name'];

$userId = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
if(!empty($userId)){
	$checkaunction = mysql_num_rows(mysql_query("select auction_counter from jewellersmandi_user_registration where id='".$userId."' and auction_counter<=9"));
	if($checkaunction>0) { 
if($_FILES['image']['name']!='') { 

			$user = $db->sellOnAuctionUserById($userId,$title,$price,$description,$sponsored,$image);

				if ($user) {
				$response["status"] = "200";
					$response["msg"] = "Successfully Auction Added";
					echo json_encode($response);
				} 
				else {
				$response["status"] = "400";
					$response["msg"] = "Error occurred";
					echo json_encode($response);
				}
			}else{ 
					$response["status"] = "400";
					$response["msg"] = "Please upload image";
					echo json_encode($response);
				}
			} else { 
				$response["status"] = "400";
				$response["msg"] = "You have already added 10 auction.";
				echo json_encode($response);
			}
}
else
{
    			$response["status"] = "401";
				$response["msg"] = "Please Login First";
				echo json_encode($response);
}
?>