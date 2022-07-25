<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions(); 

$userid = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';

if(!empty($userid)){
		    $sqlaa=mysql_query("update jewellersmandi_user_registration set ios_count=0 where id='".$userid."'");

		$notification = $db->notificationEnquiryByUserId($userid);
		if ($notification != false) {
		while($proenquiryrows = mysql_fetch_array($notification)) { 
			$response["message"] = "Success";
			$response["header"] = "Notifications";
			
if($proenquiryrows!='') { 
	$imageurl = 'https://www.jewellersmandi.com/notificationimages/'.$proenquiryrows['uploadimage'];
} else { 
	$imageurl = "";
}

		//"AttributeDetails"=>$EnquiryResult2
				$EnquiryResult[] = array("enquiryid"=>$proenquiryrows['title'],"description"=>strip_tags($proenquiryrows['message']),"imageurl"=>$imageurl,"date"=>$proenquiryrows['adddate']);
				$EnquiryResult2='';
				
				}
				$response["allEnquiry"]=$EnquiryResult;
			
				
			echo json_encode($response);
		} else {
			$response["message"] = "No record found!";
			$response["header"] = "Notifications";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Notifications";
	echo json_encode($response);
	exit;
}