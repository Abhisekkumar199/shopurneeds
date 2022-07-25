<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$listCatId = $_REQUEST['listCatId']; 
	 $sqluser=mysql_query("select * from jewellersmandi_listing_subcategory where list_catid='".$listCatId."'");
	 $numuser=mysql_num_rows($sqluser);
	 if($numuser>"0")
	 {
	     $response["status"] = "200";
			$response["msg"] = "Success";
while($rows = mysql_fetch_array($sqluser))
{

			
	$listingCategory[] = array("id"=>$rows['id'], "subCategoryName"=>$rows['listing_subcat_name']);

	
} 
		            $response["subCategoryNames"]=$listingCategory;


			echo json_encode($response);

		}
		else {
			$response["status"] = "400"; 
			$response["msg"] = "No State found";
			echo json_encode($response);
		}
?>