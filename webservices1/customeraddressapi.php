 <?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 	
	$user_id = $_REQUEST['user_id'];

    $addressSql = mysql_query("SELECT * FROM `shopurneeds_customer_address` WHERE user_id='".$user_id."'");
    $no_of_rows = mysql_num_rows($addressSql);
        if ($no_of_rows > 0) {
		
		$response["status"] = "200";
		$response["msg"] = "Success";

     		while($catRows = mysql_fetch_array($addressSql)){

     		    
				  $addressResult1[] = array("address_id"=>$catRows['id'],"fname"=>$catRows['fname'],"lname"=>$catRows['lname'],"address"=>$catRows['address'],"state"=>$catRows['state'],"city"=>$catRows['city'],"country"=>$catRows['country'],"zipcode"=>$catRows['zipcode'],"mobileno"=>$catRows['mobileno'],"addresstype"=>$catRows['addresstype']);
			}
				
			
					$response["customeraddress"]=$addressResult1;
									echo json_encode($response);

        } 	
                    
                    
else

{
    	$response["status"] = "400";
				$response["msg"] = "No Address found";
				echo json_encode($response);
}

		
		

?>