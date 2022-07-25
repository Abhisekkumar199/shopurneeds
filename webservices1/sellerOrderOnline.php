<?php

    header("Content-Type: application/json");
    require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=$_REQUEST["sellerId"];
	
	if($userId!=""){
	    
		$response['status']="200";
		
		//for seller categories name 
		
		$catNameRes = mysql_query("select cat_id,parent,categoryname from shopurneeds_category where cat_id in (select distinct cat_id from shopurneeds_product where seller_id=".$sellerId.")") or die(mysql_error());
		while($catNameRow = mysql_fetch_assoc($catNameRes)){
		    $categories [] = array("categoryId"=>$catNameRow["cat_id"],"categoryName"=>$catNameRow["categoryname"]);
		}
	
		$response['msg']='Categories fetch successfully';
		$response['sellerCategories'] = $categories;
		
	}else{
		$response['status']="400";
		$response['msg']='Please login first';
	}
	echo json_encode($response);
	die;	
?>