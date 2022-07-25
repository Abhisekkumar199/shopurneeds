<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $sellerid = $_REQUEST['sellerid'];
	 	 $proid = $_REQUEST['proid'];

	 $sqluser=mysql_query("select * from shopurneeds_suppliers where id='".$sellerid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
            $result = mysql_query("select * from shopurneeds_product where id='".$proid."'");
        $prorows = mysql_fetch_assoc($result);
        	$response["proid"] = $prorows['id'];
        	$response["productname"] = $prorows['productname'];
			$response["sku"] = $prorows['sku'];
        	$response["sellingprice"] = $prorows['sellingprice'];
        	        	$response["costprice"] = $prorows['mrp'];

        	$response["shortdescription"] = $prorows['shortdescription'];
        	$response["catid"] = $prorows['cat_id'];
        	$response["searchkeyword"] = $prorows['searchkeyword'];

            $result11 = mysql_query("select * from shopurneeds_product_size where product_id='".$proid."'");

			while($orderrows = mysql_fetch_assoc($result11)) {
			$productsizedetails[] =array(
			"product_size"=>$orderrows['product_size'],
			"product_mrp"=>$orderrows['product_mrp'],
			 "product_sellingprice"=>$orderrows['product_sellingprice']
								 ); 
}
        			$response["productsizedetails"] = $productsizedetails;

$result11img = mysql_query("select * from shopurneeds_imageupload where pid='".$proid."'");

			while($orderimages = mysql_fetch_assoc($result11img)) {
			$productimagedetails[] =array(
			"pid"=>$orderimages['pid'],
				"imageid"=>$orderimages['id'],
			 "productimage"=>"https://localhost/project/shopurneeds/uploads/productimage/".$orderimages['productimage']
								 ); 
}
           			$response["productimagedetails"] = $productimagedetails;


			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Seller do not exist.";
			echo json_encode($response);
		}
?>