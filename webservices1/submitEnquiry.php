<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
	
	if($userId!='') {  
	
	  $catid = $_REQUEST['catid'];
	  if($catid!='') { 
	  $response["status"] = "200";
		$response["msg"] = "Success Submit Enquiry";
		
		

        	
			 $attributeid = $_REQUEST['attribute'];
			$attributevalueid = $_REQUEST['attributevalue'];
				
		date_default_timezone_set('Asia/Calcutta'); 
$date = date("Y-m-d H:i:s");

$sql = mysql_query("INSERT INTO jewellersmandi_product_enquiry (`user_id`,`categoryid`,`sizefrom`,`sizeto`, `sizeto2`,`pirce`, `maxprice`,`message`,`adddate`) values ('".$_REQUEST['userId']."','".$_REQUEST['catid']."','".$_REQUEST['sizeFrom']."','".$_REQUEST['sizeTo']."', '".$_REQUEST['sizeTo2']."','".$_REQUEST['price']."', '".$_REQUEST['maxprice']."', '".mysql_real_escape_string($_REQUEST['comment'])."','".$date."')");
$id = mysql_insert_id();

$ex = explode(',',$_REQUEST['attributevalue']);
for($i=0; $i<count($ex); $i++) {
//echo "select atr_id from jewellersmandi_attributevalue where atr_val_id='".$ex[$i]."'";
$attrirows = mysql_fetch_assoc(mysql_query("select atr_id from jewellersmandi_attributevalue where atr_val_id='".$ex[$i]."'")) ;
$ins = mysql_query("INSERT INTO jewellersmandi_enquiry_attribute (`peid`,`attribute_id`, `attr_id`,`adddate`) values ('".$id."','".$ex[$i]."','".$attrirows['atr_id']."',NOW())");
}
 
echo json_encode($response);
}else{
			$response["status"] = "400";
			$response["msg"] = "Please select category!";
			echo json_encode($response);
		}
}else {
			$response["status"] = "400"; 
			$response["msg"] = "Please Login First!";
			echo json_encode($response);
		}
?>