<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$auctionId = $_REQUEST['auctionId'];
    $auctionUserId = $_REQUEST['auctionUserId'];
	 

$userId = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
if(!empty($userId)){
			$user = $db->sellOnAuctionResponseUserById($userId);

			if ($user) {
			$response["message"] = "Success";
			$response["header"] = "Auction Response";
			
			//changes read status for auction responses
			$auctionResponseRes=mysql_query("update jewellersmandi_auction_contact set is_read=1 where `auction_userid`='".$userId."'");
			while($auctionResponseRows = mysql_fetch_assoc($user)) {
				//print_r($auctionResponseRows);
				
				$auctionSql = mysql_query("SELECT * FROM jewellersmandi_auction where displayflag='1' and id='".$auctionResponseRows['auction_id']."' limit 1");
				while($auctionRows = mysql_fetch_assoc($auctionSql)) { 
				if($auctionRows['uploadimage']!='') { 
					$imageurl = 'https://www.jewellersmandi.com/auctionimages/'.$auctionRows['uploadimage'];
				} else { 
					$imageurl = '';
				} 
				//echo "SELECT fname,lname FROM ".$sufix."user_registration where id='".$auctionRows['user_id']."'";
				$userDetails = mysql_fetch_assoc(mysql_query("SELECT fname,lname FROM jewellersmandi_user_registration where id='".$auctionRows['user_id']."'"));
				$auctionResponse2[] = array("clientUserId"=>$auctionResponseRows['user_id'],"id"=>$auctionResponseRows['auction_id'],"userId"=>$auctionRows['user_id'],"userName"=>$userDetails['fname']." ".$userDetails['lname'],"title"=>$auctionRows['title'],"price"=>$auctionRows['price'],"description"=>$auctionRows['description'],"sponsored"=>$auctionRows['sponsored'],"contactFlag"=>"Auction Response","imageUrl"=>$imageurl,"date"=>$auctionResponseRows['adddate']);
				}
				
			}
				$response['auctionList']=$auctionResponse2;
				echo json_encode($response);
			} 
			else {
			
				$response["message"] = "Error occurred";
				$response["header"] = "Auction Response";
				echo json_encode($response);
			}
			
			
}
else
{
    			
				$response["message"] = "Please Login First";
				$response["header"] = "Auction Response";
				echo json_encode($response);
}
?>