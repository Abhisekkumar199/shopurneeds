<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Success";
	$Shippingaddress[] = array("snickname"=>$rows['dtitle'],"sfname"=>$rows['dfname'],"slname"=>$rows['dlname'],"saddress"=>$rows['deliver_address'],"scity"=>$rows['deliver_city'],"sstate"=>$rows['deliver_state'],"spincode"=>$rows['deliver_zip'],"smobile"=>$rows['deliver_phone'],"slandmark"=>$rows['deliver_housenumber']);
	            $response["shippingaddress"]=$Shippingaddress;

	
		$billingaddress[] = array("bnickname"=>$rows['title'],"bfname"=>$rows['fname'],"blname"=>$rows['lname'],"baddress"=>$rows['billing_address'],"bcity"=>$rows['billing_city'],"bstate"=>$rows['billing_state'],"bpincode"=>$rows['billing_zip'],"bmobile"=>$rows['billing_phone'],"blandmark"=>$rows['billing_housenumber']);
		            $response["billingaddress"]=$billingaddress;

} 

			echo json_encode($response);

		}
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist";
			echo json_encode($response);
		}
?>