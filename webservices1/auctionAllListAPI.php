<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userid = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';

if(!empty($userid)){

		$auction = $db->actionAllListing($userid);
		if ($auction != false) {
		$response["message"] = "Success"; 
			$response["header"] = "Auction";
			while($auctionRows = mysql_fetch_assoc($auction)) {
			
			$statusCheck = mysql_num_rows(mysql_query("select id from jewellersmandi_auction_contact where user_id='".$userid."' and auction_id='".$auctionRows['id']."'"));
			
			$userDetailsRows = mysql_fetch_assoc(mysql_query("SELECT fname,lname,emailid,billing_mobile,billing_phone,billing_address,billing_housenumber,billing_city,billing_state,billing_zip,billing_country FROM jewellersmandi_user_registration where id='".$auctionRows['user_id']."'"));
			if($auctionRows['uploadimage']!='') { 
			$imageUrl = 'https://localhost/project/shopurneeds/auctionimages/'.$auctionRows['uploadimage'];
			} else { 
			$imageUrl = '';
			} 
			
			//user address
			$userAddress=$userDetailsRows['billing_address'].','.$userDetailsRows['billing_housenumber'].','.$userDetailsRows['billing_city'].','.$userDetailsRows['billing_state'].','.$userDetailsRows['billing_country'].','.$userDetailsRows['billing_zip'];
			$postBy = $userDetailsRows['fname'].' '.$userDetailsRows['lname'];
				$auctionResult[] = array("id"=>$auctionRows['id'],"userId"=>$userid, "clientUserId"=>$auctionRows['user_id'], "title"=>$auctionRows['title'],"email"=>$userDetailsRows['emailid'],"mobile"=>$userDetailsRows['billing_mobile'],"phone"=>$userDetailsRows['billing_phone'],"address"=>trim($userAddress),"description"=>$auctionRows['description'], "price"=>$auctionRows['price'],"imageUrl"=>$imageUrl,"sponsored"=>$auctionRows['sponsored'],"date"=>$auctionRows['adddate'],"contactFlag"=>$statusCheck,"userName"=>$postBy);
			}
			$response['auctionList']=$auctionResult;
			
echo json_encode($response);
		} else {
			$response["message"] = "No record found!";
			$response["header"] = "Auction";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Auction";
	echo json_encode($response);
	exit;
}