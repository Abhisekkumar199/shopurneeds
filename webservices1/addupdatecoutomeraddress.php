<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 	
	 $user_id = $_REQUEST['user_id'];
	 	 $address_id = $_REQUEST['address_id'];

	 $fname = $_REQUEST['fname'];
	 $lname = $_REQUEST['lname'];
	 $address = $_REQUEST['address'];
	 $state = $_REQUEST['state'];
	 $city = $_REQUEST['city'];
	 $country = $_REQUEST['country'];
	 $zipcode = $_REQUEST['zipcode'];
	 	 	 $mobileno = $_REQUEST['mobileno'];
	 	 	 $addresstype = $_REQUEST['addresstype'];

	 
	
	 $sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {

if($address_id!='')
{
    
	        $updatesql=mysql_query("update shopurneeds_customer_address set  `fname` = '$fname', `lname` = '$lname', `address` = '$address', `state` = '$state', `city` = '$city', `country` = '$country', `zipcode` = '$zipcode', `mobileno` = '$mobileno', `addresstype` = '$addresstype',adddate=NOW() where  id='".$address_id."'");
}
else
{
    	
    $updatesql=mysql_query("insert into shopurneeds_customer_address set  `fname` = '$fname', `lname` = '$lname', `address` = '$address', `state` = '$state', `city` = '$city', `country` = '$country', `zipcode` = '$zipcode', `mobileno` = '$mobileno' , `addresstype` = '$addresstype' , user_id='$user_id', adddate=NOW()");
}
  			$response["status"] = "200";
			$response["msg"] = "Address updated successfully";
						echo json_encode($response);

} 


		
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist";
			echo json_encode($response);
		}
	
	 
?>