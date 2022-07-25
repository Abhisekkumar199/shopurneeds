<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	

			$offerSql = mysql_query("SELECT * FROM jewellersmandi_banners where displayflag='1' and bposition='Header Offer Strip' order by sortid asc") or die(mysql_error());
			$response["status"] = "200";
		$response["msg"] = "Success";
		
		$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
		if(!empty($userId)){
			$statusRows = $db->getUserType($userId);
			if($statusRows['package_status']!='1') { 
				$response["auction"] = "Yes";
								$mandicheck = "Yes";
												$response["demand"] = "Yes";


			} else {
				$response["auction"] = "No";
												$mandicheck = "No";
																$response["demand"] = "Yes";


			}
			
		}
	 $no_of_rows = mysql_num_rows($offerSql);
	 if($no_of_rows>0) {  
	 while($offerRows = mysql_fetch_assoc($offerSql)) { 
	 $cityname1 = explode('?',$offerRows['externallink']);
	 $cityname2 = explode('&',$cityname1[1]);
	 $cityname3 = explode('=',$cityname2[0]);
	 $cityName = $cityname3[1];
	 if($offerRows['uploadimage']!='') { 
				$imageurl = 'https://www.jewellersmandi.com/bannerimages/'.$offerRows['uploadimage'];
			} else { 
				$imageurl = "";
			}
	 $offerResult[] = array("cityName"=>$cityName, "bannerName"=>$offerRows['bannername'], "imageurl"=>$imageurl,"mandicheck"=>$mandicheck);
	  
	 }
		$response["mandiHeader"]=$offerResult;
		echo json_encode($response); 
	} else {
		$response["status"] = "400";
		$response["msg"] = "No Record Found!";
	}		 
?>