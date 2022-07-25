<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$catid = $_REQUEST['catid'];
	if($catid!='') {  
	
	  
	  $response["status"] = "200";
		$response["msg"] = "Success"; 
    
	$catattsql = mysql_fetch_assoc(mysql_query("select * from jewellersmandi_category where cat_id='".$catid."' order by sortid asc"));
			$response["categoryname"] = $catattsql['categoryname'];
			
        	$catattsql2 = mysql_query("select * from jewellersmandi_cat_attribute where cat_id='".$catid."'");
			$num = mysql_num_rows($catattsql2);
			//if($num>0) {
			  while($catattrows = mysql_fetch_assoc($catattsql2)) { 
			  $catatt22 .= $catattrows['atr_id'].','; 
			   }
			 $catatt222 = substr($catatt22,0,-1);
			 $catatt22='';
			 
			 $attributesql=mysql_query("select * from jewellersmandi_attributes where displayflag='1' and atr_id IN($catatt222) order by sortid asc");
		  while($attributerows = mysql_fetch_assoc($attributesql))  {
		  
		  $sqlattval=mysql_query("select * from jewellersmandi_attributevalue  where atr_id='".$attributerows['atr_id']."' and displayflag='1' order by sortid asc");
			  $j=1;
			  while($rowattval=mysql_fetch_array($sqlattval))
				{
				if($rowattval['uploadimage']!='') {
				$subimageurl = "https://www.jewellersmandi.com/attributeimages/".$rowattval['uploadimage'];
				} else { 
				$subimageurl = "";
				}
				$AttributeValueResult[] = array("atrribute_value_id"=>$rowattval['atr_val_id'],"attributevaluename"=>$rowattval['attributevaluename'],"subimageurl"=>$subimageurl);
				$j++; }
				$catResult111[] = array("attribute_id"=>$attributerows['atr_id'],"attributename"=>$attributerows['attributename'],"attriburevalue"=>$AttributeValueResult);
				 $AttributeResut="";
	 $AttributeValueResult="";	
			}
    
	$exmin = explode(',',$catattsql['minprice']);
	foreach($exmin as $value) {
	$minP[] = array("minPrice"=>$value);
	}
	$response["pirce"] = $minP;
	
	$exmax = explode(',',$catattsql['maxprice']);
	foreach($exmax as $value2) {
	$maxP[] = array("maxprice"=>$value2);
	}
	
	$response["maxPrice"] = $maxP;
    $response["sizeOption"] = $catattsql['check_size_option'];
	$response["sizeTitle1"] = $catattsql['sizetitle1'];
	$response["sizeTitle2"] = $catattsql['sizetitle2'];	
    
    $response["attributeListvalue"]=$catResult111;

			echo json_encode($response);
			/*} else { 
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
			}*/
		} else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>