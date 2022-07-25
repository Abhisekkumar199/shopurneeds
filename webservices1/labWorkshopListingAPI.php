<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';

if(!empty($userId)){
$city = $_REQUEST['city'];
$category = $_REQUEST['category'];
$subCategory = $_REQUEST['subCategory'];
		$user = $db->labWorkshowListingById($userId,$city,$category,$subCategory);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Find People";
			while($labWorkshorRows = mysql_fetch_assoc($user)) {
			
			$statusCheck = mysql_num_rows(mysql_query("select id from jewellersmandi_business_contact where user_id='".$userId."' and business_id='".$labWorkshorRows['id']."'"));
			
			if($labWorkshorRows['logo']!='') {
				$imageURL = 'https://www.jewellersmandi.com/userlogo/'.$labWorkshorRows['logo'];
			} else { 
				$imageURL = 'https://www.jewellersmandi.com/img/contact_img.jpg';
			}
			$categoryId = $labWorkshorRows['businesstype_subcategory'];
			
			if($categoryId!='') {
			$catsql = mysql_query("select id,listing_subcat_name from jewellersmandi_listing_subcategory where id IN($categoryId)");
			while($catrows = mysql_fetch_assoc($catsql)) {
				$cate[] = array("categoryName"=>$catrows['listing_subcat_name']);
			}
			} else { 
					$cate[] = array("categoryName"=>'');
				}
				$resultRows[] = array("id"=>$labWorkshorRows['id'],"clientId"=>$labWorkshorRows['user_id'],"title"=>$labWorkshorRows['business_name'],"email"=>$labWorkshorRows['contact_email'],"phone"=>$labWorkshorRows['contact_number'],"description"=>$labWorkshorRows['description'],"categoryList"=>$cate,"contactFlag"=>$statusCheck,"logo"=>$imageURL,"type"=>$labWorkshorRows['type']);
				$cate='';
			}
			$response['labWorkshop'] = $resultRows;
echo json_encode($response);
		} else {
			$response["message"] = "No record found!";
			$response["header"] = "Business List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Business List";
	echo json_encode($response);
	exit;
}