<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 
	 $snickname = $_REQUEST['snickname'];
	 $sfname = $_REQUEST['sfname'];
	 $slname = $_REQUEST['slname'];
	 $saddress = $_REQUEST['saddress'];
	 $scity = $_REQUEST['scity'];
	 $sstate = $_REQUEST['sstate'];
	 $spincode = $_REQUEST['spincode'];
	 $smobile = $_REQUEST['smobile'];
	 $slandmark = $_REQUEST['slandmark'];
	 $bnickname = $_REQUEST['bnickname'];
	 $bfname = $_REQUEST['bfname'];
	 $blname = $_REQUEST['blname'];
	 $baddress = $_REQUEST['baddress'];
	 $bcity = $_REQUEST['bcity'];
	 $bstate = $_REQUEST['bstate'];
	 $bpincode = $_REQUEST['bpincode'];
	 $bmobile = $_REQUEST['bmobile'];
	 $blandmark = $_REQUEST['blandmark'];
	 $sqluser=mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{


	        $updatesql=mysql_query("update shopurneeds_user_registration set  `title` = '$bnickname', `billing_address` = '$baddress', `billing_housenumber` = '$blandmark', `billing_city` = '$bcity', `billing_state` = '$bstate', `billing_zip` = '$bpincode', `billing_country` = 'india', `billing_phone` = '$bmobile', `dtitle` = '$snickname', `dfname` = '$sfname', `dlname` = '$slname', `deliver_address` = '$saddress', `deliver_housenumber` = '$slandmark', `deliver_city` = '$scity', `deliver_state` = '$sstate', `deliver_country` = 'India', `deliver_zip` = '$spincode', `deliver_phone` = '$smobile' where  id='".$user_id."'");
  			$response["status"] = "200";
			$response["msg"] = "Address updated successfully";
} 

			echo json_encode($response);

		}
		else {
			$response["status"] = "400";
			$response["msg"] = "Customer do not exist";
			echo json_encode($response);
		}
		
	 
?>