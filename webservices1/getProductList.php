<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $catid = $_REQUEST['catid'];
	   	$result = mysql_query("select `id`,`productname`,`sellingprice` from `buyde_product` where displayflag='1' and `cat_id` = '".$catid."' and vartype=''");
			$chkNum = mysql_num_rows($result);
			 if($chkNum>0){
			$response["msg"] = "Success"; 
			$response["status"] = "200"; 
			while($proLine = mysql_fetch_array($result)){
			$proimagesql = mysql_query("select `productimage` from `buyde_imageupload` where `pid` = '".$proLine['id']."' ");
			$proimagerows = mysql_fetch_assoc($proimagesql);			
			$productList[] = array('id'=>$proLine['id'],'productname'=>$proLine['productname'],'imageurl'=>trim('https://www.keramicfresh.com/productimage/'.$proimagerows['productimage']),'sellingprice'=>$proLine['sellingprice']);
/*	   	    $proVariant = mysql_query("select `mainpro_id`,`size` from `buyde_product` where displayflag='1' and  and `mainpro_id`='".$proLine['id']."'");
			$varprorows = mysql_fetch_assoc($proVariant);			
			$provarList[] = array('mainpro_id'=>$varprorows['mainpro_id'],'size'=>$varprorows['size']);*/


			}
					//$response["provarient"]=$provarList;
					$response["product"]=$productList;
					echo json_encode($response);				
				}else{
			$response["status"] = "400"; 	
			$response["msg"] = "No record found!";
			echo json_encode($response);	
				}

?>