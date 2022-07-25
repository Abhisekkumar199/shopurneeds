<?php
require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 	
	 $user_id = $_REQUEST['user_id'];
	 $cartid = $_REQUEST['cartid'];

$sqlfav=mysql_query("select * from shopurneeds_favorite_product where user_id='".$user_id."'");
 $numfav=mysql_num_rows($sqlfav);
	 if($numfav>0)
	 {

		while($rowfav=mysql_fetch_array($sqlfav))
		{
		    $pidsas .= $rowfav['product_id'].",";
		}
 $finalpids=substr($pidsas,0,-1);
$result = mysql_query("select * from shopurneeds_product where displayflag='1' and id in ($finalpids)");
	$response["status"] = "200";
			$response["msg"] = "success";
while($productrows = mysql_fetch_assoc($result)) {
		        
		    	$resultvariant = mysql_query("select * from shopurneeds_product_size where product_id='".$productrows['id']."'  order by id asc");
		    			    if(mysql_num_rows($resultvariant)>0){

		    			while($variantrows = mysql_fetch_assoc($resultvariant)) {
		$pervalue222=100-(($variantrows['product_sellingprice']*100)/$variantrows['product_mrp']);
		    			    $sqlcartcar=mysql_query("select quantity from shopurneeds_basket where productid='".$productrows['id']."' and bid='".$cartid."' and size='".$variantrows['product_size']."'");
		    			    $numcartvar=mysql_num_rows($sqlcartcar);
		    			    if($numcartvar>0)
		    			    {
		    			        
		    			        $varcartqty=mysql_result($sqlcartcar,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $varcartqty='0'; 
		    			    }
		    			    $variantdetails[] =array("productname"=>trim($productrows['productname']),
		    			    	 "costprice"=>$variantrows['product_mrp'], 
			                     "sellingprice"=>$variantrows['product_sellingprice'], 
			                     "size"=>$variantrows['product_size'],
								 "pid"=>$productrows['id'],
								 "sizeid"=>$variantrows['id'],
								 "discount"=>number_format($pervalue222,0),
								 "pvid"=>$productrows['id'].'-'.$variantrows['id'],
								 "cartqty"=>$varcartqty); 
		    			}
		    					$variant_type= '1';	

		    }
		    else 
		    {
		        		    				$variant_type = '0';	

		     $variantdetails[]= new stdClass();  

		    }
 
		$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
		$proimagesql = mysql_query("select `productimage` from `shopurneeds_imageupload` where pid='".$productrows['id']."' limit 1");
		$proimagerows = mysql_fetch_assoc($proimagesql);
		$sqlcartain=mysql_query("select quantity from shopurneeds_basket where productid='".$productrows['id']."' and bid='".$cartid."'");
		    			    $nummainvar=mysql_num_rows($sqlcartain);
		    			    if($nummainvar>0)
		    			    {
		    			        
		    			        $maincartqty=mysql_result($sqlcartain,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $maincartqty='0'; 
		    			    }
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
			                     "costprice"=>$productrows['mrp'],
								 "imageurl"=>"https://localhost/project/shopurneeds/uploads/productimage/thumb/".$proimagerows['productimage'],
								  "imageurllarge"=>"https://localhost/project/shopurneeds/uploads/productimage/".$proimagerows['productimage'],
								 "pid"=>$productrows['id'],
								 "productType"=>$productrows['vegnonveg'],
								 "productDescription"=>strip_tags(substr($productrows['shortdescription'],0,145)),
								 "discount"=>number_format($pervalue,0),"cartqty"=>$maincartqty,"variantdetails"=>$variantdetails,"variant_type"=>$variant_type); 
							     $variantdetails="";
		}
		$response["productdetails"]=$prodetails;
$sqlcarttotal=mysql_query("select sum(quantity) from shopurneeds_basket where  bid='".$cartid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		$response["totalcartqty"]=$totalcartqty;
        
			echo json_encode($response);
	 }
	 else
	 {
	     	$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
	 }
?>