<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	 $banner = $_REQUEST['banner'];
if($banner=="topbanner") {

   $result12 = mysql_query("SELECT * FROM jewellersmandi_banners where bposition='Mobile Index Top' and displayflag='1'  Limit 5") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result12);

 
        if ($no_of_rows > 0) {
		
		$response["status"] = "200";
		$response["msg"] = "Success"; 
		
     	while($rowsa=mysql_fetch_array($result12)){

			      $sss[] =array("imageurl"=>"https://www.jewellersmandi.com/bannerimages/".$rowsa['uploadimage'],"Cat_id"=>$rowsa['externallink']); 

		}
				
			
					$response["topcategory"]=$sss;
				echo json_encode($response);
        } else{
				$response["status"] = "400";
				$response["msg"] = "Faliure";
				echo json_encode($response);
		}
}
else if($banner=="middlebanner") {
    $result12 = mysql_query("SELECT * FROM jewellersmandi_banners where bposition='Mobile Middle Banner' and displayflag='1'  Limit 1") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result12);

 
        if ($no_of_rows > 0) {
		
		$response["status"] = "200";
		$response["msg"] = "Success";
		
     	while($rowsa=mysql_fetch_array($result12)){

			      $sss[] =array("imageurl"=>"https://www.jewellersmandi.com/bannerimages/".$rowsa['uploadimage'],"Cat_id"=>$rowsa['externallink']); 

		}
				
			
					$response["topcategory"]=$sss;
				echo json_encode($response);
        } else{
				$response["status"] = "400";
				$response["msg"] = "Faliure";
				echo json_encode($response);
		}
    
}
else
 
{
    	$response["status"] = "400";
				$response["msg"] = "Faliure";
				echo json_encode($response);
}

		
		

?>