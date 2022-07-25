<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$auctionId = $_REQUEST['auctionId'];
    $auctionUserId = $_REQUEST['auctionUserId'];
	 

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
if(!empty($userId)){
			$user = $db->jewelleryContactResponseUserById($userId);

			if ($user) {
			$response["message"] = "Success";
			$response["header"] = "Jewellery Response";
			
			//change read status for jewellery responses
			$jewelleryResponseRes=mysql_query("update jewellersmandi_stock_upload_contact set is_read=1 where `stock_user_id`='".$userId."' and `uploadType`='Jewellery List' ");
			
			while($diamondResponseRows = mysql_fetch_assoc($user)) {
				//print_r($auctionResponseRows);
				
				$diamondSql = mysql_query("SELECT * FROM jewellersmandi_jewelleryupload where displayflag='1' and id='".$diamondResponseRows['stock_id']."' limit 1");
				while($diamondRows = mysql_fetch_assoc($diamondSql)) { 
				 if($diamondRows['uploadimage']!='') { 
				 $imageurl = 'http://www.jewellersmandi.com/gemstoneimages/'.$diamondRows['uploadimage'];
				 } else {
					$imageurl = 'http://www.jewellersmandi.com/img/contact_img.jpg';
				}
				//echo "SELECT fname,lname FROM ".$sufix."user_registration where id='".$auctionRows['user_id']."'";
				$userDetails = mysql_fetch_assoc(mysql_query("SELECT fname,lname FROM jewellersmandi_user_registration where id='".$diamondResponseRows['user_id']."'"));
				$auctionResponse2[] = array("clientUserId"=>$diamondResponseRows['user_id'],"title"=>"Metal : ".$diamondRows['metal'],"contactPerson"=>$userDetails['fname']." ".$userDetails['lname'],"description"=>$diamondRows['description'],"price"=>$diamondRows['price_per_carat'],"date"=>$diamondResponseRows['adddate'],"contactFlag"=>"Diamond Response","imageUrl"=>$imageurl,"contactFlag"=>'Jewellery');
				}
				
			}
				$response['BusinessList']=$auctionResponse2;
				echo json_encode($response);
			} 
			else {
				$response["message"] = "Error occurred";
				$response["header"] = "Jewellery Response";
				echo json_encode($response);
			}
			
			
}
else
{
    			
				$response["message"] = "Please Login First";
				$response["header"] = "Jewellery Response";
				echo json_encode($response);
}
?>