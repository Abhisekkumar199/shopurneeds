<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';	
	if($userId!='') {
	  $enquiryid=$_REQUEST['enquiryid'];
	  $catid = $_REQUEST['catid'];
		if($catid!='') { 
			$response["status"] = "200";
			$response["msg"] = "Success Update Enquiry";
				
			$attributeid = $_REQUEST['attribute'];
			$attributevalueid = $_REQUEST['attributevalue'];
						
			date_default_timezone_set('Asia/Calcutta'); 
			$date = date("Y-m-d H:i:s");
			$sql=mysql_query("update jewellersmandi_product_enquiry set categoryid='".$_REQUEST['catid']."',sizefrom='".$_REQUEST['sizeFrom']."',sizeto='".$_REQUEST['sizeTo']."',sizeto2='".$_REQUEST['sizeTo2']."',pirce='".$_REQUEST['price']."',maxprice='".$_REQUEST['maxprice']."',message='".mysql_real_escape_string($_REQUEST['comment'])."',adddate='".$date."' where user_id='".	$userId."' and id='".$enquiryid."'") or die(mysql_error());
			$sasd=mysql_query("delete from jewellersmandi_enquiry_attribute where peid='".$enquiryid."'");
			$ex = explode(',',$_REQUEST['attributevalue']);
for($i=0; $i<count($ex); $i++) 
{
//echo "select atr_id from jewellersmandi_attributevalue where atr_val_id='".$ex[$i]."'";
$attrirows = mysql_fetch_assoc(mysql_query("select atr_id from jewellersmandi_attributevalue where atr_val_id='".$ex[$i]."'")) ;
$ins = mysql_query("INSERT INTO jewellersmandi_enquiry_attribute (`peid`,`attribute_id`, `attr_id`,`adddate`) values ('".$enquiryid."','".$ex[$i]."','".$attrirows['atr_id']."',NOW())");
}
		}else{
				$response["status"] = "400";
				$response["msg"] = "Please select category!";
				
			}
	}else{
			$response["status"] = "400"; 
			$response["msg"] = "Please Login First!";
			
		}
	//response 
	echo json_encode($response);
	exit;
?>