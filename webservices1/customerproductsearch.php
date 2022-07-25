<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
		$searchkey = $_REQUEST['searchkey']; 
	
	$result = mysql_query("select * from shopurneeds_product where displayflag='1' and productname like '%$searchkey%'") or die(mysql_error());
     $no_of_rows = mysql_num_rows($result);
      if ($no_of_rows > 0) {
    	$response["status"] = "200";
		$response["msg"] = "Success";
       
		while($productrows = mysql_fetch_assoc($result)) {
		   $prodetails[] =array("productname"=>$productrows['productname']);
		}
	
        $response["productdetails"]=$prodetails;
			echo json_encode($response);
		}
		 else {
			$response["status"] = "200";
			$response["msg"] = "No Result found";
		$response["productdetails"]=[];
			echo json_encode($response);
		}
	 
	?>