<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$auctionId = $_REQUEST['auctionId'];
    $auctionUserId = $_REQUEST['auctionUserId'];
	 

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
			$user = $db->businessContactResponseUserById($userId);

			if ($user) {
			$response["message"] = "Success";
			$response["header"] = "Business Response";
			
			//change read status of people response
			$peopleResponseRes=mysql_query("update jewellersmandi_business_contact set is_read=1 where business_user_id='".$userId."'");
			
			while($businessResponseRows = mysql_fetch_assoc($user)) {
				//print_r($auctionResponseRows);
				
				$businessSql = mysql_query("SELECT * FROM jewellersmandi_business_listing where displayflag='1' and id='".$businessResponseRows['business_id']."' limit 1");
				while($businessRows = mysql_fetch_assoc($businessSql)) { 
				 
					$imageurl = 'http://www.jewellersmandi.com/userlogo/'.$businessRows['logo'];
				
				//echo "SELECT fname,lname FROM ".$sufix."user_registration where id='".$auctionRows['user_id']."'";
				$userDetails = mysql_fetch_assoc(mysql_query("SELECT fname,lname FROM jewellersmandi_user_registration where id='".$businessResponseRows['user_id']."'"));
				
				$auctionResponse2[] = array("clientUserId"=>$businessResponseRows['user_id'],"BusinessID"=>$businessResponseRows['business_id'],"title"=>$businessRows['business_name'],"contactPerson"=>$userDetails['fname']." ".$userDetails['lname'],"description"=>$businessRows['description'],"date"=>$businessResponseRows['adddate'],"imageUrl"=>$imageurl,"contactFlag"=>'people',"price"=>'');
				}
				
			}
				$response['BusinessList']=$auctionResponse2;
				echo json_encode($response);
			} 
			else {
			
				$response["message"] = "Error occurred";
				$response["header"] = "Business Response";
				echo json_encode($response);
			}
			
			
}
else
{
				$response["message"] = "Please Login First";
				$response["header"] = "Business Response";
				echo json_encode($response);
}
?>