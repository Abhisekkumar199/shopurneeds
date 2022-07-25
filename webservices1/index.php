<?php

if (isset($_REQUEST['tag']) && $_REQUEST['tag'] != '') {



	$tag = $_REQUEST['tag'];

	require_once 'include/DB_Functions.php';

	$db = new DB_Functions();

	//$response = array("tag" => $tag, "success" => 0, "error" => 0);

	if ($tag == 'login') {

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
				
				if($user["approveflag"]==1) { 
				$response["user"]["mobileotp"]=0;
				} else { 
					
					$str=$str=$_POST['fname']." Welcome to the Mallfort.com. Please verify your mobile number now to enter into the world of On Demand Shopping. Your OTP is ".$user["mobileotp"];
					$message=urlencode($str);
					$username="keramicfresh";
					$password="39256";
					$senderid="MLLFRT";
					$numbers=$response["user"]["mobile"];
					$url="http://smsleads.in/pushsms.php?username=$username&password=$password&message=$message&sender=$senderid&numbers=$numbers";
					 $ch = curl_init($url);
					  curl_setopt($ch, CURLOPT_HEADER, 0);
					   curl_setopt($ch, CURLOPT_POST, 0);
					    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
						 $response1 = curl_exec($ch);

					$response["user"]["mobileotp"] = $user["mobileotp"];
				}
				
				

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

	else if($tag=='search') {
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
		$proimagesql = mysql_query("select `productimage` from `buyde_imageupload` where pid='".$productrows['id']."' limit 1");
		$proimagerows = mysql_fetch_assoc($proimagesql);
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
								 "imageurl"=>"https://keramicfresh.com/productimage/".$proimagerows['productimage'],
								 "seller_id"=>$productrows['seller_id'],
								 "costprice"=>$productrows['costprice'],
								 "discount"=>$pervalue); 
		}
		$response["productdetails"]=$prodetails;
			echo json_encode($response);
		}
		 else {
			$response["msg"] = "NO RECORD FOUND!";
			echo json_encode($response);
		}
	 }
	 else if($tag=='product') { 
	$pid = $_REQUEST['pid'];
	$product = $db->getProductDetailsForview($pid);
	//print_r($user);
		if ($product != false) {
			$response["msg"] = "Success";
			$proimagesql = mysql_query("select `productimage` from buyde_imageupload where pid='".$product['id']."' limit 5");
			while($proimagerows = mysql_fetch_assoc($proimagesql)){
					$proimagerowsLine[] = trim('https://www.keramicfresh.com/productimage/'.$proimagerows['productimage']);			
			}
			$ImageArray = implode(",",$proimagerowsLine);
			$response["imagepath"] = $ImageArray;
			$pervalue=100-(($product['sellingprice']*100)/$product['costprice']);
			$response["product"]["id"] = $product["id"];
			$response["product"]["productname"] = $product["productname"];
			$response["product"]["imageurl"]="https://keramicfresh.com/productimage/".$proimagerows['productimage'];
			$response["product"]["discount"] = $pervalue;
			$response["product"]["longdescription"] = preg_replace("/\r|\n/", "",strip_tags($product['longdescription']));
			$response["product"]["shortdescription"] = preg_replace("/\r|\n/", "",strip_tags($product['shortdescription']));
			$response["product"]["totalrating"] = $product['totalrating'];
			$response["product"]["qty"] = $product['qty'];
			$response["product"]["slug"] = $product['slug'];
			echo json_encode($response);

		} else {

			$response["msg"] = "No record found!";

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

			      $sss[] =array("imageurl"=>"https://keramicfresh.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 

		}

		$response["slider"]=$sss;

					echo json_encode($response);



		

	}

	else if ($tag == 'homepage') {

		 $response["msg"] = "Success";

		 $result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Homepage Slider' and displayflag='1'") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result12);

 while($rowsa=mysql_fetch_array($result12)){

			      $sss[] =array("imageurl"=>"https://keramicfresh.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 



				

				

		}

				

				$response["slider"]=$sss;

				$result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Below Slider Banner' and displayflag='1'") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result12);

 while($rowsa=mysql_fetch_array($result12)){

			      $sssbeloew[] =array("imageurl"=>"https://keramicfresh.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink'])); 



				

				

		}

						$response["belowsliderbanner"]=$sssbeloew;



		


$result1234 = mysql_query("SELECT * FROM buyde_product where id IN(37254,37252,37246,37244,37243)") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result1234);

 while($rowsa4=mysql_fetch_array($result1234)){

 $pervalue=100-(($product['sellingprice']*100)/$product['costprice']);

	$rowimage = mysql_fetch_assoc(mysql_query("select * from buyde_imageupload where pid='".$rowsa4['id']."' and mainimage='1'"));		    

		$produc[]=array("prodetails"=>array('productname'=>$rowsa4['productname'],'sellingprice'=>$rowsa4['sellingprice'],'costprice'=>$rowsa4['mrp'],'discount'=>$pervalue,'image'=>$rowimage['productimage'],"imageurl"=>"https://keramicfresh.com/productimage/".$rowimage['productimage'])); 		

				

		}



$response["sdf"]=$produc;



					echo json_encode($response);



		

	}

	else if ($tag == 'register') {

		$fname = $_REQUEST['first_name'];

				$lname = $_REQUEST['last_name'];

		$email = $_REQUEST['email'];

		$password = $_REQUEST['password'];

		$mobile = $_REQUEST['mobile_no'];



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

} else {

		$response["msg"] = "Access Denied";

			echo json_encode($response);

}

?>