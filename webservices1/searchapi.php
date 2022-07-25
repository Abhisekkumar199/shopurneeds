<?php

	$tag = $_REQUEST['tag'];
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	//$response = array("tag" => $tag, "success" => 0, "error" => 0);
	if($tag=='cart') {
	$pid1 = $_REQUEST['pid'];
	$rowproduct = $db->getProductCartDetails($pid1);
	//print_r($rowproduct);
	if ($rowproduct != false) {
		$response["msg"] = "Success";
		$rowimage = mysql_fetch_assoc(mysql_query("select * from buyde_imageupload where pid='".$_REQUEST['pid']."' and mainimage='1'"));
			
			$mrp=$rowproduct['mrp'];
			$sellingprice=$_REQUEST['price'];
			$offer=$_REQUEST['offer'];
			$productname=$rowproduct['productname'];
			$qty=$_REQUEST['pquantity'];
			$bid = $_REQUEST['bid'];
			//$shipprice=$rowproduct['shipprice']; 
			$totalcost=$qty * $sellingprice;
			$description=str_replace("'","`",$rowproduct['combo_shortdescription']);
			
			if($rowproduct['bid']!='')
			{
			//echo "select brandname from buyde_brand where bid='".$rowproduct['bid']."'";
				$brands = mysql_fetch_assoc(mysql_query("select brandname from buyde_brand where bid='".$rowproduct['bid']."'"));
			}	
			//echo "insert into buyde_basket(`productid`,`bid`, `comboid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`,cashcoin) values ('".$_REQUEST['pid']."','".$bid."', '".$rowproduct['cat_id']."', '".$rowproduct['cat_id']."', '".$rowproduct['combo_subcatid']."', '".$rowproduct['combo_subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands['brandname']."', '', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['product_sku']."', '".$rowproduct['product_bar']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."','".$_REQUEST['cashcoinp']."')";
			$insbasket = mysql_query("insert into buyde_basket(`productid`,`bid`, `comboid`, `cat_id`, `subcat_id`, `subsubcat_id`, `productname`, `productimage`, `slug`, `description`, `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`, `suppliername`,cashcoin) values ('".$_REQUEST['pid']."','".$bid."', '".$rowproduct['cat_id']."', '".$rowproduct['cat_id']."', '".$rowproduct['combo_subcatid']."', '".$rowproduct['combo_subsubcat_id']."', '".$productname."', '".$rowimage['productimage']."', '".$rowproduct['slug']."', '".$description."', '".$sellingprice."', '".$mrp."', '".$brands['brandname']."', '', '".$totalcost."', '".$qty."', '".$offer."', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '".$rowproduct['product_sku']."', '".$rowproduct['product_bar']."', '".$_REQUEST['weight']."', '".$_REQUEST['weight']."', '".$msubscription."', '".$rowproduct['vatvalue']."', '".$rowproduct['vat']."', '".$rowproduct['suppliername']."','".$_REQUEST['cashcoinp']."')") or die(mysql_error());	
			
			echo json_encode($response);
		} else {
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
	} else if($tag=='product') { 
	$pid = $_REQUEST['pid'];
	$product = $db->getProductDetailsForview($pid);
	//print_r($user);
		if ($product != false) {
			$response["msg"] = "Success";
			$proimagesql = mysql_query("select productimage from buyde_imageupload where pid='".$product['id']."' limit 1");
			$pervalue=100-(($product['sellingprice']*100)/$product['costprice']);
			$proimagerows = mysql_fetch_assoc($proimagesql);
			$response["product"]["id"] = $product["id"];
			$response["product"]["productname"] = $product["productname"];
			$response["product"]["imageurl"]="https://mallfort.com/productimage/".$proimagerows['productimage'];
			$response["product"]["imagename"] = $proimagerows['productimage'];
			$response["product"]["discount"] = $pervalue;
			$response["product"]["longdescription"] = $product['longdescription'];
			$response["product"]["shortdescription"] = $product['shortdescription'];
			$response["product"]["totalrating"] = $product['totalrating'];
			$response["product"]["qty"] = $product['qty'];
			$response["product"]["slug"] = $product['slug'];
			
			
			echo json_encode($response);
		} else {
			$response["msg"] = "No record found!";
			echo json_encode($response);
		}
	} else if($tag=='search') {
	$response["msg"] = "Success";
		$catid = $_REQUEST['catid'];
		$brand = $_REQUEST['brand'];
		$page = $_REQUEST['page'];
		$ksearch = $_REQUEST['ksearch']; 
		$getproduct = $db->getProductByCatidAndBrand($catid, $brand, $ksearch, $page); 


		if ($getproduct) {
		
		while($productrows = mysql_fetch_assoc($getproduct)) {
		//echo "select productimage from buyde_imageupload where pid='".$productrows['id']."' limit 1";
		$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
		$proimagesql = mysql_query("select productimage from buyde_imageupload where pid='".$productrows['id']."' limit 1");
		$proimagerows = mysql_fetch_assoc($proimagesql);
			$prodetails[] =array("productname"=>$productrows['productname'],"sellingprice"=>$productrows['sellingprice'],"imageurl"=>"https://mallfort.com/productimage/".$proimagerows['productimage'],"seller_id"=>$productrows['seller_id'],"costprice"=>$productrows['costprice'],"discount"=>$pervalue); 
		}
		$response["productdetails"]=$prodetails;
			echo json_encode($response);
		} else {
			$response["msg"] = "NO RECORD FOUND!";
			echo json_encode($response);
		}
		
	 } else if ($tag == 'login') {
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$user = $db->getUserByEmailAndPassword($email, $password);
		if ($user != false) {
			$response["msg"] = "Success";
			$response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
			echo json_encode($response);
		} else {
			$response["msg"] = "Incorrect email or password!";
			echo json_encode($response);
		}
	} 
	else if ($tag == 'forgetpass') {
		$mobile = $_REQUEST['mobile'];
		$user = $db->validateUserBymobile($mobile);
		if ($user != false) {
			$response["msg"] = "Success";
						$response["user"]["uid"] = $user["id"];
			$response["user"]["mobileotp"] = $user["fpassotp"];
				$response["user"]["mobile"] = $user["billing_mobile"];
			echo json_encode($response);
		} else {
			$response["msg"] = "Incorrect Mobile Number!";
			echo json_encode($response);
		}
	}
	else if ($tag == 'resetpass') {
		$mobile = $_REQUEST['mobile'];
		$password = $_REQUEST['password'];
		$user = $db->updateUserpassword($mobile,$password);
		if ($user != false) {
			$response["msg"] = "Success";
			echo json_encode($response);
		} else {
			$response["msg"] = "Incorrect Mobile Number!";
			echo json_encode($response);
		}
	}
	else if ($tag == 'validatereg') {
		$mobile = $_REQUEST['mobile'];
		$user = $db->validateRegBymobile($mobile);
		if ($user != false) {
			$response["msg"] = "Success";
						$response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
			echo json_encode($response);
		} else {
			$response["msg"] = "Incorrect Mobile Number!";
			echo json_encode($response);
		}
	}
		else if ($tag == 'loginslider') {
		 $response["msg"] = "Success";
		 $result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Login Slider' and displayflag='1'") or die(mysql_error());
 $no_of_rows = mysql_num_rows($result12);
 while($rowsa=mysql_fetch_array($result12)){
			      $sss[] =array("imageurl"=>"https://mallfort.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 

				
				
		}
		$response["slider"]=$sss;
					echo json_encode($response);

		
	}
	else if ($tag == 'homepage') {
		 $response["msg"] = "Success";
		 $result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Login Slider' and displayflag='1'") or die(mysql_error());
 $no_of_rows = mysql_num_rows($result12);
 while($rowsa=mysql_fetch_array($result12)){
			      $sss[] =array("imageurl"=>"https://mallfort.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 

				
				
		}
				
				$response["slider"]=$sss;
				$result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Below Slider Banner' and displayflag='1'") or die(mysql_error());
 $no_of_rows = mysql_num_rows($result12);
 while($rowsa=mysql_fetch_array($result12)){
			      $sssbeloew[] =array("imageurl"=>"https://mallfort.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 

				
				
		}
						$response["belowsliderbanner"]=$sssbeloew;

		$result123 = mysql_query("SELECT * FROM buyde_floorapi where displayflag='1'") or die(mysql_error());
 $no_of_rows = mysql_num_rows($result123);
 while($rowsa3=mysql_fetch_array($result123)){
			      $sssbeloew3[] =array("floorname"=>$rowsa3['floorapiname'],"floorimage"=>"https://mallfort.com/levelimages/".$rowsa3['uploadimage'],"floorimage1"=>"https://mallfort.com/levelimages/".$rowsa3['uploadimage1'],"floorimage2"=>"https://mallfort.com/levelimages/".$rowsa3['uploadimage2'],"floorimage3"=>"https://mallfort.com/levelimages/".$rowsa3['uploadimage3'],"floorimage4"=>"https://mallfort.com/levelimages/".$rowsa3['uploadimage4']); 

				
				
		}
						$response["floor"]=$sssbeloew3;

					echo json_encode($response);

		
	}
	else if ($tag == 'register') {
		$fname = $_REQUEST['fname'];
				$lname = $_REQUEST['lname'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$mobile = $_REQUEST['mobile'];

		if ($db->isUserExisted($email,$mobile)) {
			$response["msg"] = "Email ID or Mobile already existed";
			echo json_encode($response);
		} else {
			$user = $db->storeUser($fname,$lname,$mobile, $email, $password);
			if ($user) {
				$response["msg"] = "Success";
				$response["user"]["uid"] = $user["id"];
				$response["user"]["fname"] = $user["fname"];
				$response["user"]["lname"] = $user["lname"];
				$response["user"]["email"] = $user["emailid"];
				$response["user"]["mobile"] = $user["billing_mobile"];
				$response["user"]["mobileotp"] = $user["mobileotp"];
				echo json_encode($response);
			} else {
				$response["msg"] = "Error occurred in Registration";
				echo json_encode($response);
			}
		}
	} else {
			$response["msg"] = "Invalid Request";
			echo json_encode($response);
	}

?>