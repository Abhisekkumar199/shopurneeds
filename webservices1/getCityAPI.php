<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$stateName = $_REQUEST['stateName'];
	if($stateName!='') { 
		$getStateRows = mysql_fetch_assoc(mysql_query("SELECT id from jewellersmandi_states where statename='".$stateName."'"));
		$getStateId = $getStateRows['id'];
		$stateValue = " and state_id='".$getStateId."'";
	}
	 $sqluser=mysql_query("select * from jewellersmandi_city where displayflag='1' {$stateValue}");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	     $response["status"] = "200";
			$response["msg"] = "Success";
while($rows = mysql_fetch_array($sqluser))
{

			
	$Shippingaddress[] = array("city"=>$rows['cityname']);

	
} 
		            $response["cityName"]=$Shippingaddress;


			echo json_encode($response);

		}
		else {
			$response["status"] = "400"; 
			$response["msg"] = "City Not Found";
			echo json_encode($response);
		}
?>