<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $user_id = $_REQUEST['user_id'];
	 $oldpassword = $_REQUEST['oldpassword'];
	 $newpassword = $_REQUEST['newpassword'];

	 $sqluser=mysql_query("select * from buyde_user_registration where id='".$user_id."' and password='$oldpassword'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
while($rows = mysql_fetch_array($sqluser))
{

			$response["status"] = "200";
			$response["msg"] = "Password changed successfully";
$resultwallet = mysql_query("update buyde_user_registration set password = '".$newpassword."' where id='".$user_id."'");
		    		
			echo json_encode($response);

		}
	 }
		else {
			$response["status"] = "400";
			$response["msg"] = "Old Password do not match";
			echo json_encode($response);
		}
?>