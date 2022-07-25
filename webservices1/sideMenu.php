<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
	if(!empty($userId)){
	    
	    $usercheck=mysql_fetch_array(mysql_query("select * from jewellersmandi_user_registration where id='".$userId."'"));
	    $usertyp1=$usercheck['package_status'];
	    	    $usertyp2=$usercheck['package_status2'];

	    
		 $dat1=date("Y-m-d");

		if($usertyp1!="1") 
		{ 
		    if($dat1>$usercheck['payment_enddate'])
		    {
		        $sqlaa=mysql_query("update jewellersmandi_user_registration set package_status='1'  where id='".$userId."'");
		    }

		}
		if($usertyp2!="0") 
		{ 
		    if($dat1>$usercheck['auction_enddate'])
		    {
		        $sqlaa=mysql_query("update jewellersmandi_user_registration set package_status2='0' where id='".$userId."'");
		    }

		}
	    
	    
		$user = $db->getUserType($userId);
		

	 $sqluser=mysql_query("select * from jewellersmandi_sidebar_menu where displayflag='1'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	    $response["status"] = "200";
		$response["msg"] = "Success";
		
		//display unread auction responses
		$auctionResponseRes=mysql_query("SELECT COUNT(`auction_userid`) as auctionresponses from jewellersmandi_auction_contact where `auction_userid`='".$userId."' and is_read=0");
		$auctionResponseRow=mysql_fetch_object($auctionResponseRes);
		$response['auctionresponses']=$auctionResponseRow->auctionresponses;
			
		//display unread people responses
		$peopleResponseRes=mysql_query("SELECT count(user_id) as resposecount from jewellersmandi_business_contact WHERE business_user_id='".$userId."' and is_read=0");
		$peopleResponseRow=mysql_fetch_object($peopleResponseRes);
		$response['peopleResponses']=$peopleResponseRow->resposecount;
		
		//display unread diamond responses
		$diamondResponseRes=mysql_query("SELECT COUNT(stock_user_id) as diamondresponses from jewellersmandi_stock_upload_contact where `stock_user_id`='".$userId."' and `uploadType`='Diamond List' and is_read=0");
		$diamondResponseRow=mysql_fetch_object($diamondResponseRes);
		$response['diamondResponseRes']=$diamondResponseRow->diamondresponses;
		
		//display unread gemstone responses
		$gemstoneResponseRes=mysql_query("SELECT COUNT(stock_user_id) as gemstoneresponses from jewellersmandi_stock_upload_contact where `stock_user_id`='".$userId."' and `uploadType`='Gemstone List' and is_read=0");
		$gemstoneResponseRow=mysql_fetch_object($gemstoneResponseRes);
		$response['gemstoneResponseRes']=$gemstoneResponseRow->gemstoneresponses;
		
		//display unread jewellery reponses
		$jewelleryResponseRes=mysql_query("SELECT COUNT(stock_user_id) as jewelleryresponses from jewellersmandi_stock_upload_contact where `stock_user_id`='".$userId."' and `uploadType`='Jewellery List' and is_read=0");
		$jewelleryResponseRow=mysql_fetch_object($jewelleryResponseRes);
		$response['jewelleryResponseRes']=$jewelleryResponseRow->jewelleryresponses;
		
while($rows = mysql_fetch_array($sqluser))
{

			if($user['package_status']=="1") {
				if($rows['id']=="1"  || $rows['id']=="2" || $rows['id']=="17" || $rows['id']=="18" || $rows['id']=="19" || $rows['id']=="20" || $rows['id']=="21" || $rows['id']=="4"|| $rows['id']=="12") {
					$status = "Yes";
				} else { 
					$status = "No";
				}
			} else if($user['package_status']=="2") {
				if($rows['id']=="1" || $rows['id']=="17" || $rows['id']=="18" || $rows['id']=="19" || $rows['id']=="20" || $rows['id']=="21" || $rows['id']=="4" || $rows['id']=="10" || $rows['id']=="12") {
					$status = "Yes";
				} else { 
					$status = "No";
				}
			}
			
			else if($user['package_status']=="3") {
				if($rows['id']=="5" || $rows['id']=="6") {
					$status = "No";
				} else { 
					$status = "Yes";
				}
			}
			else if($user['package_status']=="4") {
				if($rows['id']=="1" || $rows['id']=="17" || $rows['id']=="7" || $rows['id']=="18" || $rows['id']=="19" || $rows['id']=="20" || $rows['id']=="21"|| $rows['id']=="13") {
					$status = "Yes";
				} else { 
					$status = "No";
				}
			}
			
			if($user['package_status2']=="1") { 
				if($rows['id']=="5" || $rows['id']=="6") {
					$status = "Yes";
				}
			} 
	$menuNameLists[] = array("menuName"=>$rows['menu_name'],"status"=>$status);

	
} 
		            $response["menuNameList"]=$menuNameLists;


			echo json_encode($response);

		}
		else { 
			$response["status"] = "400";
			$response["msg"] = "No State found";
			echo json_encode($response);
		}
}else{
	$response["status"] = "401"; 
	$response['msg'] = 'Please Login';
	echo json_encode($response);
	exit;
}
?>