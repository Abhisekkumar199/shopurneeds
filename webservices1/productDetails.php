<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$pid = $_REQUEST['pid'];
	$cartid = $_REQUEST['cartid'];
			$user_id = $_REQUEST['user_id'];

	$product = $db->getProductDetailsForview($pid);
	//print_r($user);
		if ($product != false) {
	$result = mysql_query("select * from shopurneeds_product where id='".$pid."'") or die(mysql_error());
	
$productrows=mysql_fetch_array($result);

$resultbrand = mysql_fetch_array(mysql_query("select * from shopurneeds_brand where bid='".$productrows['bid']."'"));
	

  $sqlfav=mysql_query("SELECT * FROM `shopurneeds_favorite_product` where user_id='".$user_id."' and product_id='".$productrows['id']."'");
		    $numfav=mysql_num_rows($sqlfav);
		    if($numfav>0)
		    {
		        $favoflg="1";
		    }
		    else
		    {
		        		        $favoflg="0";

		    }
		    
		    	$resultvariant = mysql_query("select * from shopurneeds_product_size where product_id='".$pid."'  order by id asc");
		    			    if(mysql_num_rows($resultvariant)>0){

		    			while($variantrows = mysql_fetch_assoc($resultvariant)) {
		    			    		$pervalue222=100-(($variantrows['product_sellingprice']*100)/$variantrows['product_mrp']);

		    			    $sqlcartcar=mysql_query("select quantity from shopurneeds_basket where productid='".$pid."' and bid='".$cartid."' and size='".$variantrows['product_size']."'");
		    			    $numcartvar=mysql_num_rows($sqlcartcar);
		    			    if($numcartvar>0)
		    			    {
		    			        
		    			        $varcartqty=mysql_result($sqlcartcar,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $varcartqty='0'; 
		    			    }
		    			    $variantdetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$variantrows['product_sellingprice'],
			                     "costprice"=>$variantrows['product_mrp'],
			                     "saleqty"=>$variantrows['qty'], 
			                     "size"=>$variantrows['product_size'],
			                      "sizeid"=>$variantrows['id'],
								 "pid"=>$pid,
								 "pvid"=>$pid.'-'.$variantrows['id'],
								 "discount"=>number_format($pervalue222,0),
								 "vsid"=>$variantrows['id'],
								 "cartqty"=>$varcartqty); 
		    			}
		    					$variant_type= '1';	

		    }
		    else 
		    {
		        		    				$variant_type = '0';	

		     $variantdetails[]= new stdClass();  

		    }
		    
		    $proimagesql = mysql_query("select `productimage` from shopurneeds_imageupload where pid='".$pid."' limit 5");
			while($proimagerows = mysql_fetch_assoc($proimagesql)){
					$proimagerowsLine[] = trim('https://localhost/project/shopurneeds/uploads/productimage/'.$proimagerows['productimage']);			
			}
			$ImageArray = implode(",",$proimagerowsLine);
			$response["msg"] = "Success";
			
			$response["product"]["id"] = $productrows["id"];
			$response["product"]["productname"] = $productrows["productname"];
			$response["product"]["costprice"] = $productrows['mrp'];
			$response["product"]["sellingprice"] = $productrows['sellingprice'];
			$response["product"]["favoritecheck"] = $favoflg;
			$response["product"]["productsku"] = $productrows['master_sku'];
			$response["product"]["brand"] = $resultbrand['brandname'];

			
			$response["product"]["longdescription"] = preg_replace("/\r|\n/", "",strip_tags($productrows['longdescription']));
			$response["product"]["shortdescription"] = preg_replace("/\r|\n/", "",strip_tags($productrows['shortdescription']),
						$response["product"]["cartqty"] = $maincartqty,

			$response["product"]["imagepath"] = $ImageArray,
			$response["product"]["variantdetails"] = $variantdetails
			);
	    	$ImageArray="";
	    	$variantdetails="";
			$sqlcarttotal=mysql_query("select sum(quantity) from shopurneeds_basket where  bid='".$cartid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		$response["totalcartqty"]=$totalcartqty;
			echo json_encode($response);

		} else {

			$response["msg"] = "No record found!";

			echo json_encode($response);

		}

	?>