<?php 
	header("Content-Type: application/json");	
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$fullname = $_REQUEST['fullname'];
    $email = $_REQUEST['email'];
   
	
	if($email!="")
	{
	    $googleRes=mysql_query("select `id`,`user_mobile`,`fname`,`lname`,`emailid`,`user_image` from shopurneeds_user_registration where `emailid`='".$email."' ");
		    if(mysql_num_rows($googleRes)>0){
		        
		        $googleRow=mysql_fetch_assoc($googleRes);
		        $response["status"] = "200";
				$response["user"]["uid"] = $googleRow["id"];
				$response["user"]["fname"] = $googleRow["fname"];
				$response["user"]["lname"] = $googleRow["lname"];
				$response["user"]["email"] = $googleRow["emailid"];
				$response["user"]["mobile"] = $user["user_mobile"];
				
				if($googleRow["user_image"]!='') { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/userlogo/'.$googleRow["user_image"];
				} else { 
					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/img/contact_img.png';
				}
		        
		        
		    }else{
		        
		        
		            $user = $db->googleSignup($fullname,$email);
		            
		            if($user!=false){
		                $response["status"]="200";
		                $response["msg"]="success";
		                
		                $response["user"]["uid"] = $user["id"];
        				$response["user"]["fname"] = $user["fname"];
        				$response["user"]["lname"] = $user["lname"];
        				$response["user"]["email"] = $user["emailid"];
        				
        				
        				if($user["user_image"]!='') { 
        					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/userlogo/'.$user["user_image"];
        				} else { 
        					$response["user"]["logo"] = 'https://localhost/project/shopurneeds/img/contact_img.png';
        				}
		            }
		        
		        
		    }
		    
	}
	else
	{
		$response["status"] = "404";
		$response["msg"] = "Invalid Request";
		
	}
		echo json_encode($response);
		die;
?>