<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';	
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=isset($_REQUEST["sellerId"])?$_REQUEST["sellerId"]:"";
		$cartid=isset($_REQUEST["cartid"])?$_REQUEST["cartid"]:"";
if($cartid!="")
{
    $deless=mysql_query("delete from shopurneeds_basket where bid='".$cartid."'");
}
	if(!empty($userId)) {
		$sellerDetail=$db->sellerDetailById($sellerId);
		
		if(!empty($sellerDetail)){
			$response["status"]="200";
			$response["header"]="seller Shop Detail";
			
			$response["bannerImg"][]=array("bannerImg"=>"https://localhost/project/shopurneeds/showroomimages/".$sellerDetail["uploadimage"]);
			$response["bannerImg"][]=array("bannerImg"=>"https://localhost/project/shopurneeds/showroomimages/".$sellerDetail["uploadimage1"]);
			$response["bannerImg"][]=array("bannerImg"=>"https://localhost/project/shopurneeds/showroomimages/".$sellerDetail["uploadimage2"]);
			$response["bannerImg"][]=array("bannerImg"=>"https://localhost/project/shopurneeds/showroomimages/".$sellerDetail["uploadimage3"]);
			$response["bannerImg"][]=array("bannerImg"=>"https://localhost/project/shopurneeds/showroomimages/".$sellerDetail["uploadimage4"]);
			$response["companyName"]=$sellerDetail["suppliername"];
			
			// for rating 
			
			$ratRes=mysql_query("select round(avg(rating),1) as sellerRating from shopurneeds_seller_review where seller_id=".$sellerDetail["id"]." ");
			$sellerRat=mysql_fetch_object($ratRes);
			
			if($sellerRat->sellerRating!=NULL){
			    $avgRating=$sellerRat->sellerRating;
			}else {
			   $avgRating="";
			}
			$response["rating"]=$avgRating;
			

			$categories=$sellerDetail["sellertype"];
		    $response["categories"]=$categories;
		    $response["deliverytime"]=$sellerDetail["deliverytime"];
		    $response["costfortwo"]=$sellerDetail["costfortwo"];
		    
		    /*// for close timing of retaurant
		    date_default_timezone_set("Asia/Kolkata");
		    $curr_Date= date("Y-m-d H:i:s");
		    
		    $hours = date("H:i",strtotime($curr_Date));
		    
		    if(strtotime($hours)>strtotime($sellerDetail["close_at"]) || strtotime($hours)<strtotime($sellerDetail["open_at"])){
		       echo "closed";
		    }else{
		        echo "open";
		    }*/
		   
		    $response["openAt"]=$sellerDetail["open_at"];
		    $response["closeAt"]=$sellerDetail["close_at"];
			$response["bestOffer"]=array("offerName"=>"Get Upto Rs.200","offerDesp"=>"Pay Via Payment ad Get 20% Cashback on booking fee.");
			
		}else{
			$response["status"]="404";
			$response["header"]="No seller Details";
		}
		
		
	} else {
		$response["status"] = "400";
		$response["msg"] = "Login first";
	}
	

	echo json_encode($response); 
	die;
?>