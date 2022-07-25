<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $pid = $_REQUEST['pid'];
	 $bid = $_REQUEST['cartid'];
	 $qty = $_REQUEST['qty'];
	 $user_id = $_REQUEST['user_id'];
	 
	 $product = $db->addToCart($pid);

		if ($product != false) {

			if($product['bid']!='')
			{
			//echo "select brandname from buyde_brand where bid='".$rowproduct['bid']."'";
				$brands = mysql_fetch_assoc(mysql_query("select brandname from `buyde_brand` where `bid` = '".$product['bid']."'"));
			}	
			$imageLine = mysql_fetch_array(mysql_query("select `productimage` from buyde_imageupload where pid='".$product['id']."' and `mainimage`='1' limit 1"));
			$productImage123 = trim('https://www.keramicfresh.com/productimage/small/'.$imageLine['productimage']);			

			$productId = $product["id"];
			$productname = $product["productname"];
			$slug = $product["slug"];
			$sellingprice = $product["sellingprice"];
			$description = preg_replace("/\r|\n/", "",strip_tags($product['longdescription']));
			$shortdescription = preg_replace("/\r|\n/", "",strip_tags($product['shortdescription']));
			$productImage = $productImage123;
				
				if($bid=='0'){
				$sbasket=mysql_query("select `bid` from `buyde_basketid` order by bid desc");
					if($row=mysql_fetch_array($sbasket))
					{
						$bid=$row['bid']+1;
					}
					else
					{
						$bid=1;
					}
						mysql_query("insert into `buyde_basketid`(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") or die(mysql_error());
				}else{
				$bid = $bid;
				}	
					
			$userinfo = mysql_fetch_array(mysql_query("select * from buyde_user_registration where id='".$user_id."'limit 1"));
			
			$insbasket = mysql_query("insert into `buyde_basket`(`productid`,`bid`, `cat_id`,`productname`, `productimage`, `slug`,  `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`,cashcoin,userid,emailid)values ('".$productId."','".$bid."','".$product['cat_id']."','".$productname."', '".$productImage123."', '".$product['slug']."',  '".$sellingprice."', '".$product['costprice']."', '".$brands['brandname']."', '', '".$sellingprice."', '".$qty."', '".$product['offer']."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$product['product_sku']."', '".$product['product_bar']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."','".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."','".$_REQUEST['cashcoinp']."','".$userinfo['emailid']."','".$userinfo['emailid']."')") or die(mysql_error());
			
	$sqlcarttotal=mysql_query("select sum(quantity) from buyde_basket where  bid='".$bid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		
			$response["status"] = "200";
			$response["msg"] = "Product added in cart successfully";
			$response["bid"] = $bid;
			$response["totalcartqty"]=$totalcartqty;
			$response["cartqty"] = "1";

			echo json_encode($response);
		} else {
			$response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
?>