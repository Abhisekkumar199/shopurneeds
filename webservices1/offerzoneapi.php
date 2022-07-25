<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
 $bannerRes=mysql_query("SELECT * FROM shopurneeds_banners WHERE bposition='Offer Zone' and displayflag='1' ORDER BY sortid ASC LIMIT 25 ") or die(mysql_error());
if(mysql_num_rows($bannerRes)>0){
	  while($rowsa=mysql_fetch_array($bannerRes)){
	     $currentday=date("l");
	     $currenttime=date("H:i:s");
	       if($rowsa['uploadimage']!='') { 
                  $imageurl = "https://localhost/project/shopurneeds/uploads/bannerimages/".$rowsa['uploadimage'];
            			} else { 
            			    $imageurl = "";
            			}
            			
            		    $sss[] =array("imageurl"=>$imageurl,"externalLink"=>$rowsa['externallink']);
                }
	        }
	        
	         
	
	    $response["offerbanner"]=$sss;
	  
	    $response["status"] = "200";
	$response["msg"] = "Success"; 
	    
	    
	
	echo json_encode($response); 
	die;
?>