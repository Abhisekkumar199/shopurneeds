<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $sellerid = $_REQUEST['sellerid'];
	 $sqluser=mysql_query("select * from shopurneeds_suppliers where id='".$sellerid."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
            $result = mysql_query("select * from shopurneeds_product where seller_id='".$sellerid."'");
			while($orderrows = mysql_fetch_assoc($result)) {
			    $result11imgs = mysql_fetch_assoc(mysql_query("select * from shopurneeds_imageupload where pid='".$orderrows['id']."' order by sortid asc limit 1"));

			$productdetails[] =array("proid"=>$orderrows['id'],
			                     "productname"=>$orderrows['productname'],
			                      "mrp"=>$orderrows['mrp'],
			                       "sellingprice"=>$orderrows['sellingprice'],
			                       "displayflag"=>$orderrows['displayflag'],
			                      "productimage"=>"https://localhost/project/shopurneeds/uploads/productimage/".$result11imgs['productimage']


								 ); 
}
        			$response["productdetails"] = $productdetails;

			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Seller do not exist.";
			echo json_encode($response);
		}
?>