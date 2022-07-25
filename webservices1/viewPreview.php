<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$catid = $_REQUEST['catid'];
	if($catid!='') {  
	
	  
	  $response["status"] = "200";
		$response["msg"] = "Success";
		
		$response["sizeFrom"] = $_REQUEST['sizeFrom'];
		$response["sizeTo"] = $_REQUEST['sizeTo'];
		$response["sizeTo2"] = $_REQUEST['sizeTo2'];
		$response["price"] = $_REQUEST['price'];
		$response["maxPrice"] = $_REQUEST['maxprice'];
		
		
		 
		$response["comment"] = $_REQUEST['comment'];
	$catattsql = mysql_fetch_assoc(mysql_query("select categoryname,cat_id,uploadimage1,sizetitle1,sizetitle2 ,check_size_option from jewellersmandi_category where cat_id='".$catid."'"));
			$response["categoryname"] = $catattsql['categoryname'];
			$response["itemId"] = $catattsql['cat_id'];
			$response["itemUrl"] = 'https://www.jewellersmandi.com/categoryimages/'.$catattsql['uploadimage1'];
			
			$response["sizeTitle1"] = ucwords(strtolower($catattsql['sizetitle1']));
		$response["sizeTitle2"] = ucwords(strtolower($catattsql['sizetitle2']));
		$response["sizeOption"] = $catattsql['check_size_option'];
        	
			 $attributeid = $_REQUEST['attribute'];
			$attributevalueid = $_REQUEST['attributevalue'];
				
		//echo "select atr_id,attributename from jewellersmandi_attributes where atr_id IN($attributeid[0])";

$attrivsql = mysql_query("select atr_id,attributename from jewellersmandi_attributes where atr_id IN($attributeid)") ;

/*while($attriValuerows = mysql_fetch_assoc($attrivsql)) {
$attrirows = mysql_fetch_assoc(mysql_query("select * from jewellersmandi_attributes where atr_id='".$attriValuerows['atr_id']."'"));
$AttributeValueResult[] = array("subItemName"=>$attriValuerows['attributevaluename']);
$catResult111[] = array("subItemId"=>$attrirows['atr_id'],"subItemType"=>$attrirows['attributename'],"subItemName"=>$AttributeValueResult);
$AttributeValueResult="";	
}*/

while($attriValuerows = mysql_fetch_assoc($attrivsql)) {

$attributeValuesql = mysql_query("select * from jewellersmandi_attributevalue where atr_val_id IN($attributevalueid) and atr_id='".$attriValuerows['atr_id']."'");
if(mysql_num_rows($attributeValuesql)>0) { 
while($attributeValuerows = mysql_fetch_assoc($attributeValuesql)) {
$attributevalueList .= $attributeValuerows['attributevaluename'].',';
}
$attributevalueList2 = substr($attributevalueList,0,-1);
$catResult111[] = array("subItemId"=>$attriValuerows['atr_id'],"subItemType"=>$attriValuerows['attributename'],"subItemName"=>$attributevalueList2);
$AttributeValueResult="";
$attributevalueList = "";	
}
}
//$ins = mysql_query("INSERT INTO ".$sufix."enquiry_attribute (`peid`,`attribute_id`, `attr_id`,`adddate`) values ('".$id."','".$_REQUEST['attributevalue'][$i]."','".$attrirows['atr_id']."',NOW())");


				
		
    
	
	
     $AttributeResut="";
		
     		
    
    $response["itemDesc"]=$catResult111;

			echo json_encode($response);
			
		} else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>