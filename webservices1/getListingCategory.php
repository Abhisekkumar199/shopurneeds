<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $sqluser=mysql_query("select * from jewellersmandi_listing_category");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
		$response["status"] = "200";
		$response["msg"] = "Success";
			while($rows = mysql_fetch_array($sqluser))
			{	
				$listingCategory[] = array("id"=>$rows['id'], "categoryName"=>$rows['listingcat_name']);				
			} 
		$response["categoryNames"]=$listingCategory;
		echo json_encode($response);

	}else {
		$response["status"] = "400"; 
		$response["msg"] = "No State found";
		echo json_encode($response);
	}
?>