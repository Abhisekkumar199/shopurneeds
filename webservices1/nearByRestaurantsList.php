<?php 
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	

	$lat=$_REQUEST["lat"];
	$lng=$_REQUEST["lon"];
	$sortby = $_REQUEST["sortBy"];
    $sellerType = $_REQUEST["sellerType"];
        $catid = $_REQUEST["catid"];

	if($userId!=""){
		$response['status']='200';
		$response['header']="Restaurant List";
		
			$resRes=$db->getAllRestaurantByLatLong($lat,$lng,$sortby,$sellerType,$catid);
			if($resRes!=false){
				
				while($resRow=mysql_fetch_assoc($resRes)){
					// for category name
						$catname=$resRow['sellertype'];
					
				    // seller rating 
		              
            		  $sellerRatRes=mysql_query("SELECT round(AVG(`rating`),1) as rating_avg FROM `shopurneeds_seller_review` WHERE seller_id=".$resRow["id"]." ");
            		  $sellerRatRow=mysql_fetch_assoc($sellerRatRes);
            		  
            		  // for close timing of retaurant
		           
		           $currentDay=date('l');
		           
		           // restaurent days
		           
		           $restDays=explode(",",$resRow['open_on_days']);
		           
		           if(in_array($currentDay,$restDays)){
		               
		                date_default_timezone_set("Asia/Kolkata");
        		    
            		    $curr_Date= date("Y-m-d H:i:s");
            		    
            		    $hours = date("H:i",strtotime($curr_Date));
            		    
            		    if(strtotime($hours)>strtotime($resRow["close_at"]) || strtotime($hours)<strtotime($resRow["open_at"])){
            		        
            		       $isclosed="1";
            		       
            		    }else{
            		        $isclosed="1";
            		    }
        		    
		           }else{
		               $isclosed="1";
		               
		           }
        		    
            		  if($sellerRatRow["rating_avg"]!=NULL){
            		      $sellerRating=$sellerRatRow["rating_avg"];
            		  }else{
            		       $sellerRating="";
            		  }
            		  
						if($resRow['uploadimage']!=""){
							
							$resList[]=array("sellerId"=>$resRow['id'],"selllerName"=>$resRow['suppliername'],"category"=>rtrim($catname,","),"sellerRating"=>$sellerRating,"castfortwo"=>$resRow["costfortwo"],"deliverytime"=>$resRow["deliverytime"],"isClosed"=>$isclosed,"is_withoutpro"=>$resRow["is_withoutpro"],"sellerImage"=>"https://localhost/project/shopurneeds/showroomimages/".$resRow['uploadimage']);
						}else{
							$resList[]=array("sellerId"=>$resRow['id'],"selllerName"=>$resRow['suppliername'],"category"=>rtrim($catname,","),"sellerRating"=>$sellerRating,"castfortwo"=>$resRow["costfortwo"],"deliverytime"=>$resRow["deliverytime"],"isClosed"=>$isclosed,"is_withoutpro"=>$resRow["is_withoutpro"],"sellerImage"=>"https://localhost/project/shopurneeds/showroomimages/no_image_found.png");
						}
					
					
				}
				$response["nearByRestaurant"]=$resList;
				if($catid!="")
				{
				    $catimge=mysql_query("SELECT * FROM shopurneeds_category where cat_id='".$catid."' and displayflag='1' ") or die(mysql_error());
		$catimg=mysql_num_rows($catimge);
		
		if($catimg>0){
			$rowcatimg=mysql_fetch_assoc($catimge);
				if($rowcatimg['uploadimage']!='') { 
					$catimageurl = "https://localhost/project/shopurneeds/uploads/categoryimages/".$rowcatimg['uploadimage'];
				} else { 
					$catimageurl = "";
				}
		}
					
		$response['catimgurl']=$catimageurl;
				}
			}else{
				$response["nearByRestaurant"]=array();
			}
			
			
		
	}else{
		$response['status']="404";
		$response['msg']="Please login first";
	}
	
	echo json_encode($response);
	die;
?>