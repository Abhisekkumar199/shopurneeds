<?php

    header("Content-Type: application/json");
    require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=$_REQUEST["sellerId"];	
	if($userId!=""){
		$response['status']="200";
		$response['header']='Seller Reviews';
		$sellerReview=$db->getReviewBySellerId($sellerId);
		
		// seller average rating
	    
	   
	    
		$avgRatRes=mysql_query("SELECT round(AVG(rating),1) as sellerRating from shopurneeds_seller_review where seller_id=".$sellerId." ");
		
		$avgRatRow = mysql_fetch_object($avgRatRes);
		
		if($avgRatRow->sellerRating!=NULL){
            $avgRating = $avgRatRow->sellerRating;
		}else{
		    $avgRating="";
		}
		
		$response["sellerAvgRating"] = $avgRating;
		
		if($sellerReview!=false){
		    
		    while($sellerReviewRow=mysql_fetch_assoc($sellerReview)){
		        
		        //getting user image
			   
			    
    			$userRes=mysql_fetch_object(mysql_query("select user_image from shopurneeds_user_registration where id='".$sellerReviewRow['user_id']."'")) or die(mysql_error());
    			
    			if($userRes->user_image!=""){
    			    $userImg ="https://localhost/project/shopurneeds/userlogo/".$userRes->user_image;
    			    
    			}else{
    			    $userImg="";
    			}
    			
    			
    			$response['sellerReviews'][]=array("userImage"=>$userImg,"rating"=>$sellerReviewRow['rating'],
    			"remark"=>$sellerReviewRow['message'],"userName"=>$sellerReviewRow['user_name'],"reviewDate"=>$sellerReviewRow['adddate']);
    		        
		    }
		    
		    
		}else{
		    	$response['sellerReviews']=[];
		}
		
		
			
	}else{
		$response['status']="400";
		$response['msg']='Please login first';
	}
	echo json_encode($response);
	die;	
?>