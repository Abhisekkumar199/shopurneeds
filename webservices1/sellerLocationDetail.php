<?php
  
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';	
	$db = new DB_Functions();
	$userId=isset($_REQUEST["userId"])?$_REQUEST["userId"]:"";
	$sellerId=isset($_REQUEST["sellerId"])?$_REQUEST["sellerId"]:"";


	if(!empty($userId)) {
		$sellerDetail=$db->sellerDetailById($sellerId);
		
		if(!empty($sellerDetail)){
			$response["status"]="200";
			$response["header"]="Address & Contact Information";
			$response["address"]=$sellerDetail['paddress1']."".$sellerDetail['paddress2'];
			$response["city"]=$sellerDetail['pcity'];
			$response['state']=$sellerDetail['pstate'];
			$response['pincode']=$sellerDetail['ppincode'];
			
			$response['contactNo']=$sellerDetail['mobile1'];
			$response['lat']=$sellerDetail['lat'];
			$response['lng']=$sellerDetail['lng'];
		    
		    // address
		    $adrloc=$sellerDetail['paddress1']."".$sellerDetail['paddress2']."".$sellerDetail['pcity']."".$sellerDetail['pstate']."".$sellerDetail['ppincode'];
			//$response['mapLocation']="https://www.google.com/maps/?q=$lat2,$lon2";
			$response['mapLocation']='<iframe width="100%" height="100%" src="https://maps.google.com/maps?q='.$adrloc.'&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
			
		}else{
			$response["status"]="404";
			$response["header"]="No location detail Available";
		}
		
		
	} else {
		$response["status"] = "400";
		$response["msg"] = "Login first";
	}
	echo json_encode($response); 
	die;
?>