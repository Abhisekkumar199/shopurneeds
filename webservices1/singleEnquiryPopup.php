<?php
header('Content-Type: application/json');
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
$userId = 	isset($_REQUEST['userid'])?$_REQUEST['userid']:'';
$eId = 	isset($_REQUEST['enquiryid'])?$_REQUEST['enquiryid']:'';
if(!empty($userId)){
		$user2 = $db->getSingleEnquiryByUsersId($userId,$eId);
		if ($user2 != false) {
		while($proenquiryrows = mysql_fetch_array($user2)) { 
			$response["message"] = "Success";
			$response["header"] = "My Enquiry";
			$catsql = mysql_query("SELECT * FROM jewellersmandi_category WHERE cat_id='".$proenquiryrows['categoryid']."'");
$catrows2 = mysql_fetch_assoc($catsql);
$peidsql = mysql_query("select * from jewellersmandi_enquiry_attribute where peid='".$proenquiryrows['id']."' and attr_id!='0'");
		while($peidrows = mysql_fetch_assoc($peidsql)) { 
		$peidids .= $peidrows['attr_id'].',';
		$peididv .= $peidrows['attribute_id'].',';
		}
		$catatt222 = substr($peidids,0,-1);
		
		
		  $attributesql=mysql_query("select * from jewellersmandi_attributes where displayflag='1' and atr_id IN($catatt222)");
		  while($attributerows = mysql_fetch_assoc($attributesql))  {
		  
		 $peidsql = mysql_query("select * from jewellersmandi_enquiry_attribute where attr_id='".$attributerows['atr_id']."' and attr_id!='0' and peid='".$proenquiryrows['id']."'");
		while($peidrows2 = mysql_fetch_assoc($peidsql)) { 
		
		$peididv .= $peidrows2['attribute_id'].',';
		}
		$attributev = substr($peididv,0,-1);
		$peididv = '';
		
		 $sqlattval=mysql_query("select * from jewellersmandi_attributevalue  where atr_id='".$attributerows['atr_id']."' and atr_val_id IN($attributev)");
						
			  $j=1;
			  while($rowattval=mysql_fetch_array($sqlattval))
{ 	
?>
                        <?php $attrrr .= $rowattval['attributevaluename'].',';?>
                        <?php } 
$ss = substr($attrrr,0,-1);
//echo $ss;

$EnquiryResult2[] = array("Attributs"=>$attributerows['attributename'],"Attributevalue"=>$ss);
$ss=''; $attrrr=''; $attributev='';
 }


		
				$response['enquiryid'] = $proenquiryrows['id'];
				$response['userid'] = $proenquiryrows['user_id'];
				
				$response['description'] = $proenquiryrows['message'];
				$response['catid']=$proenquiryrows['categoryid'];
				$response['categoryname'] = $catrows2['categoryname'];
				
				$response["sizeFrom"] = $proenquiryrows['sizefrom'];
				$response["sizeTo"] = $proenquiryrows['sizeto'];
				$response["sizeTo2"] = $proenquiryrows['sizeto2'];
				$response["price"] = $proenquiryrows['pirce'];
				$response["maxPrice"] = $proenquiryrows['maxprice'];
						$response["sizeTitle1"] = $catrows2['sizetitle1'];
				$response["sizeTitle2"] = $catrows2['sizetitle2'];
				$response["sizeOption"] = $catrows2['check_size_option'];
				
				$response['imageurl'] = 'https://www.jewellersmandi.com/categoryimages/'.$catrows2['uploadimage1'];
				$response['AttributeDetails'] = $EnquiryResult2;
				
				
				$EnquiryResult2='';
				}
				
			
				
			echo json_encode($response);
		} else {
			
			$response["message"] = "No record found!";
			$response["header"] = "My Enquiry";
			echo json_encode($response); 
		} 
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "My Enquiry";
	echo json_encode($response);
	exit; 
}