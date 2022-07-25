<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$cat_id = $_REQUEST['cat_id'];
if($cat_id!="")
{
    $categorySql = mysql_query("SELECT `cat_id`,`categoryname`,`uploadimage` FROM `shopurneeds_category` WHERE `displayflag` = '1' and parent='".$cat_id ."' order by sortid") or die(mysql_error());
    $no_of_rows = mysql_num_rows($categorySql);
        if ($no_of_rows > 0) {
		
		$response["status"] = "200";
		$response["msg"] = "Success";
		
     		while($catRows = mysql_fetch_array($categorySql)){
				  $catResult[] = array("catid"=>$catRows['cat_id'],"categoryname"=>$catRows['categoryname'],"categorydesc"=>$catRows['description'],"imageurl"=>'https://localhost/project/shopurneeds/uploads/categoryimages/'.$catRows['uploadimage']);
			}
				
			
				$response["topcategory"]=$catResult;
				echo json_encode($response);
        } else{
				$response["status"] = "200";
				$response["msg"] = "Success";
								$response["topcategory"]=[];

				echo json_encode($response);
		}
}
	

	    else{
				$response["status"] = "400";
				$response["msg"] = "Faliure";

				echo json_encode($response);
	}
		

?>