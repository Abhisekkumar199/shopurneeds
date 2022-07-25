<?php

	require_once 'include/DB_Functions.php';

	$db = new DB_Functions();

		 $result12 = mysql_query("SELECT * FROM buyde_banners where bposition='API Login Slider' and displayflag='1'") or die(mysql_error());
		 $no_of_rows = mysql_num_rows($result12);
		 
		 	if($no_of_rows>0){
		 			$response["status"] = "200";
					   $response["msg"] = "Success";

		 
     while($rowsa=mysql_fetch_array($result12)){

			      $sss[] =array("imageurl"=>"https://keramicfresh.com/bannerimages/".$rowsa['uploadimage'],"link"=>str_replace("/","/",$rowsa['externallink']));
		}

		$response["slider"]=$sss;
		echo json_encode($response);
		}else{
		 			$response["status"] = "400";
					   $response["msg"] = "Faliure";
						echo json_encode($response);
		
		}


		

?>