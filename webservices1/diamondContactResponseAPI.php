<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$auctionId = $_REQUEST['auctionId'];
    $auctionUserId = $_REQUEST['auctionUserId'];
	 

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
			$user = $db->diamondContactResponseUserById($userId);

			if ($user) {
			$response["message"] = "Success";
			$response["header"] = "Diamond Response";
			
			//change read status of diamond response
			$diamondResponseRes=mysql_query("update jewellersmandi_stock_upload_contact set is_read=1 where `stock_user_id`='".$userId."' and `uploadType`='Diamond List'");
			
			while($diamondResponseRows = mysql_fetch_assoc($user)) {
				//print_r($auctionResponseRows);
				
				$diamondSql = mysql_query("SELECT * FROM jewellersmandi_upload_stock where displayflag='1' and id='".$diamondResponseRows['stock_id']."' limit 1");
				while($diamondRows = mysql_fetch_assoc($diamondSql)) { 
				 
					$imageurl = 'http://www.jewellersmandi.com/img/contact_img.jpg';
				
				//echo "SELECT fname,lname FROM ".$sufix."user_registration where id='".$auctionRows['user_id']."'";
				$userDetails = mysql_fetch_assoc(mysql_query("SELECT fname,lname FROM jewellersmandi_user_registration where id='".$diamondResponseRows['user_id']."'"));
				$auctionResponse2[] = array("clientUserId"=>$diamondResponseRows['user_id'],"description"=>$diamondRows['description'],"price"=>$diamondRows['price'],"title"=>"Stock NO:".$diamondRows['stockno'],"contactPerson"=>$userDetails['fname']." ".$userDetails['lname'],"date"=>$diamondResponseRows['adddate'],"contactFlag"=>"Diamond","imageUrl"=>$imageurl);
				}
				
			}
				$response['BusinessList']=$auctionResponse2;
				echo json_encode($response);
			} 
			else {
			
				$response["message"] = "Error occurred";
				$response["header"] = "Diamond Response";
				echo json_encode($response);
			}
			
			
}
else
{
				$response["message"] = "Please Login First";
				$response["header"] = "Diamond Response";
				echo json_encode($response);
}
?>