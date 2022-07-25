<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();

$userId 			= 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
$gemstoneStone 		= 	isset($_REQUEST['gemstoneStone'])?$_REQUEST['gemstoneStone']:'';
$certificate 		= 	isset($_REQUEST['certificate'])?$_REQUEST['certificate']:'';
$stoneIdentity 		= 	isset($_REQUEST['stoneIdentity'])?$_REQUEST['stoneIdentity']:'';
$gemstoneShape 		= 	isset($_REQUEST['gemstoneShape'])?$_REQUEST['gemstoneShape']:'';
if($gemstoneShape=="")
    {
        $gemstoneShape 		= 	isset($_REQUEST['shape2'])?$_REQUEST['shape2']:'';

    }
$pricePerCarat 		= 	isset($_REQUEST['pricePerCarat'])?$_REQUEST['pricePerCarat']:'';
$gemstoneWeight 	= 	isset($_REQUEST['gemstoneWeight'])?$_REQUEST['gemstoneWeight']:'';
if($gemstoneWeight=="")
    {
        $gemstoneWeight 		= 	isset($_REQUEST['weight'])?$_REQUEST['weight']:'';

    }
$totalValue 		= 	isset($_REQUEST['totalValue'])?$_REQUEST['totalValue']:'';
//echo $gemstoneWeight;
if(!empty($userId)){ 

		$user = $db->uploadGemstoneListingByUserId($userId,$gemstoneStone,$certificate,$stoneIdentity,$gemstoneShape,$pricePerCarat,$gemstoneWeight,$totalValue);
		if ($user != false) {
			$response["message"] = "Success";
			$response["header"] = "Gemstone Stock List";
			while($uploadStockRows = mysql_fetch_assoc($user)) {
			$userDetailsRows = mysql_fetch_assoc(mysql_query("select emailid,companyname from jewellersmandi_user_registration where id='".$uploadStockRows['user_id']."'"));
				$resultRows[] = array("userId"=>$uploadStockRows['user_id'],"gemstoneId"=>$uploadStockRows['id'],"companyname"=>$userDetailsRows['companyname'],"seller"=>$userDetailsRows['emailid'], "stone"=>$uploadStockRows['stone'],"certificate"=>$uploadStockRows['certificate'],"stoneIdentity"=>$uploadStockRows['stone_identity'],"shape"=>$uploadStockRows['shape'],"pricePerCarat"=>$uploadStockRows['price_per_carat'],"date"=>$uploadStockRows['adddate']);
				$cate='';
			}
			$response['uploadGemstoneStockList'] = $resultRows;
echo json_encode($response);
		} else {
			$response["message"] = "No record found!";
			$response["header"] = "Gemstone Stock List";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Gemstone Stock List";
	echo json_encode($response);
	exit;
}