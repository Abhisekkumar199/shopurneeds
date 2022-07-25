<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	 $banner = $_REQUEST['homepage'];
	 					$cartid = $_REQUEST['cartid'];

if($banner=="homepage") {

   $result12 = mysql_query("SELECT * FROM jewellersmandi_banners where bposition='Mobile Index Top' and displayflag='1' ORDER BY sortid ASC  Limit 5") or die(mysql_error());

 $no_of_rows = mysql_num_rows($result12);
        $response["status"] = "200";
		$response["msg"] = "Success"; 
		
		
		$userId = 	isset($_REQUEST['userId'])?$_REQUEST['userId']:'';
		if(!empty($userId)){

			$statusRows = $db->getUserType($userId);
			if($statusRows['package_status']!='1') { 
				$response["auction"] = "Yes";
								$response["demand"] = "Yes";
						$response["findPeople"] = "Yes";
						$mandicheck = "Yes";


			} else {
				$response["auction"] = "No";
								$response["demand"] = "Yes";
					$response["findPeople"] = "No";
					$mandicheck = "No";

			}
			if($statusRows['package_status2']=='1') { 
			$response["auction"] = "Yes";
		} 
			
			
				
			
		}
		
     	while($rowsa=mysql_fetch_array($result12)){
			if($rowsa['uploadimage']!='') { 
			$imageurl = "https://www.jewellersmandi.com/bannerimages/".$rowsa['uploadimage'];
			} else { 
			$imageurl = "";
			}
			      $sss[] =array("imageurl"=>$imageurl,"externalLink"=>$rowsa['externallink'],"title"=>$rowsa['bannername']); 
     	}
                $response["topbanners"]=$sss;
				
							
 $categorySql = mysql_query("SELECT `cat_id`,`categoryname`,`uploadimage1` FROM `jewellersmandi_category` WHERE `displayflag` = '1' and parent='0' ORDER BY sortid ASC") or die(mysql_error());
    $no_of_rows = mysql_num_rows($categorySql);
        
     		while($catRows = mysql_fetch_array($categorySql)){
			if($statusRows['package_status']=='1') { 
				if($catRows['cat_id']=='0112' || $catRows['cat_id']=='0110') {
					$status = "No";
				} else { 
					$status = "Yes";
				}
			}  else { 
				$status = "Yes";
			}
			if($catRows['uploadimage1']!='') { 
			$imageurl = 'https://www.jewellersmandi.com/categoryimages/'.$catRows['uploadimage1'];
			} else { 
			$imageurl = "";
			}
				  $catResult[] = array("catid"=>$catRows['cat_id'],"categoryname"=>$catRows['categoryname'],"imageurl"=>$imageurl,"status"=>$status);
     		} 
                 $response["createEnquiry"]=$catResult;
             
				$testimonialSql = mysql_query("SELECT * FROM jewellersmandi_banners where displayflag='1' and bposition='Our Partner' order by sortid") or die(mysql_error());
    $tno_of_rows = mysql_num_rows($testimonialSql);
        
     		while($testimonialRows = mysql_fetch_array($testimonialSql)){
			if($testimonialRows['uploadimage']!='') { 
				$imageurl = 'https://www.jewellersmandi.com/bannerimages/'.$testimonialRows['uploadimage'];
			} else { 
				$imageurl = "";
			}
				  $TestimonialResult[] = array("imageurl"=>$imageurl);
     		}
         $response["testimonial"]=$TestimonialResult;
         
         $offerSql = mysql_query("SELECT * FROM jewellersmandi_banners where displayflag='1' and bposition='Header Offer Strip' order by sortid asc") or die(mysql_error());
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
		 }
	 $response["mandiHeader"]=$offerResult;
         
	echo json_encode($response); 
	
	 
}
else
{
    	$response["status"] = "400";
				$response["msg"] = "Faliure";
				echo json_encode($response);
}
?>