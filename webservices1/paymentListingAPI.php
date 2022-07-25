<?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){ 

		$user = $db->paymentListingById($userId);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Payment List";
			while($paymentRows = mysql_fetch_assoc($user)) {
			
			if($paymentRows['uploadimage']!='') {
				$imageURL = 'https://www.jewellersmandi.com/packageimages/'.$paymentRows['uploadimage'];
			} else { 
				$imageURL = 'https://www.jewellersmandi.com/img/contact_img.jpg';
			}
			$categoryId = $paymentRows['category'];
			if($categoryId!='') {
			$catsql = mysql_query("select cat_id,categoryname from jewellersmandi_category where cat_id IN($categoryId)");
			while($catrows = mysql_fetch_assoc($catsql)) {
			 
					$cate[] = array("categoryName"=>$catrows['categoryname']);
				
			}
			} else { 
					$cate[] = array("categoryName"=>'');
				}
			
				$resultRows[] = array("id"=>$paymentRows['id'], "title"=>$paymentRows['package_name'], "mobile"=>$paymentRows['mobile'], "landLine"=>$paymentRows['landline'], "emailId"=>$paymentRows['emailid'], "description"=>$paymentRows['package_description'], "categoryList"=>$cate, "price"=>$paymentRows['package_price'], "logo"=>$imageURL);
			$cate='';
			}
			$response['payment'] = $resultRows;
echo json_encode($response);
		} else {
		$response["message"] = "No Record Found!";
			$response["header"] = "Payment List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Payment List";
	echo json_encode($response);
	exit;
}