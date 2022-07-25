<?php
header("Content-Type: application/json");
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
date_default_timezone_set('Asia/Calcutta');
$currentdate = date('Y-m-d h:i:s', time());
$userid = isset($_REQUEST['userid'])?$_REQUEST['userid']:'';

if(!empty($userid)){

		$user2 = $db->getEnquiryByUsersold($userid,$tabName);
		if ($user2 != false) {
		while($proenquiryrows = mysql_fetch_array($user2)) { 
		$junksql = mysql_query("select * from jewellersmandi_junkproduct where peid='".$proenquiryrows['id']."' and user_id='".$userid."'");
if(mysql_num_rows($junksql)==0) {
			$response["message"] = "Success";
			$response["header"] = "Previous Demand";
			$dt = $proenquiryrows['adddate'];
	//echo "<br>";
	$diff = strtotime($currentdate) - strtotime($dt);
	$diff_in_hrs = $diff/3600;
	$hours = intval($diff_in_hrs);
	if($hours>48) {
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
                        <?php  } 
$ss = substr($attrrr,0,-1);
//echo $ss;

$EnquiryResult2[] = array("Attributs"=>$attributerows['attributename'],"Attributevalue"=>$ss);
$ss=''; $attrrr=''; $attributev='';
 }
 
 //,"AttributeDetails"=>$EnquiryResult2
 //company name
 $companySql=mysql_fetch_assoc(mysql_query("select companyname from jewellersmandi_user_registration where id='".$proenquiryrows['user_id']."' "));
 $companyName=$companySql['companyname'];
$EnquiryResult[] = array("enquiryid"=>$proenquiryrows['id'],"companyname"=>$companyName,"userid"=>$proenquiryrows['user_id'],"sizeFrom"=>$proenquiryrows["sizefrom"], "sizeTo"=>$proenquiryrows["sizeto"],  "sizeTo2"=>$proenquiryrows["sizeto2"], "sizeTitle1"=>ucwords(strtolower($catrows2['sizetitle1'])), "sizeTitle2"=>ucwords(strtolower($catrows2['sizetitle2'])), "sizeOption"=>$catrows2['check_size_option'], "price"=>$proenquiryrows['pirce'],"maxPrice"=>$proenquiryrows['maxprice'],"description"=>$proenquiryrows['message'],"catid"=>$proenquiryrows['categoryid'],"categoryname"=>$catrows2['categoryname'],"imageurl"=>'https://www.jewellersmandi.com/categoryimages/'.$catrows2['uploadimage1'],"date"=>$proenquiryrows['adddate']);
				$EnquiryResult2='';
				}
				$hours=''; } }
				$response["allEnquiry"]=$EnquiryResult;
echo json_encode($response);
		} else {
			$response["message"] = "No Record Found!";
			$response["header"] = "Old Enquiry";
			echo json_encode($response);
		}
	
}else{
	$response['message'] = 'Please Login first';
	$response["header"] = "Old Enquiry";
	echo json_encode($response);
	exit;
}