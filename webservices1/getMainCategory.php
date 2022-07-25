<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	
	 $sqluser=mysql_query("select * from jewellersmandi_category where displayflag='1' and parent='0' and cat_dept='1'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	     $response["status"] = "200";
			$response["msg"] = "Success";
while($rows = mysql_fetch_array($sqluser))
{

			
	$Shippingaddress[] = array("catId"=>$rows['cat_id'], "category"=>$rows['categoryname']);

	
} 
		            $response["categoryName"]=$Shippingaddress;


			echo json_encode($response);

		}
		else {
			$response["status"] = "400"; 
			$response["msg"] = "Category Not Found";
			echo json_encode($response);
		}
?>