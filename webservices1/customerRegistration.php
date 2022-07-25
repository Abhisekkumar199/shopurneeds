<?php 
	header("Content-Type: application/json");	
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
	$fname = $_REQUEST['fname'];
	$lname =$_REQUEST['lname'];
    $email = $_REQUEST['email'];
    $mobile = $_REQUEST["mobile"];
	$password = $_REQUEST['password'];
		$referralcode = $_REQUEST['referralcode'];

	if($email!="" && $mobile!="")
	{
			if ($db->isUserExisted($email,$mobile)) {
				$response["status"] = "400";
				$response["msg"] = "Email I'd or Mobile no is already registered.";

			}else if($db->isUserMobileExist($mobile)){
			    
			    $response["status"]="400";
			    $response["msg"]="Mobile number is already registered.";
			    
			}else { 
									
				$user = $db->customerRegistration($fname,$lname,$email,$mobile,$password,$referralcode);
				if ($user) {
					$response["status"] = "200";
					$response["msg"] = "Registration Successful ! Please verify link sent to your email / mobile no  to activate account";
					include("../includes/libraries/mailfunction.php");
					$emailid = $email;
					$mobileno=$mobile;
					$hash=$user['email_hash'];
					include("../app_signup_mail.php");
					send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
					
					 $link = "https://localhost/project/shopurneeds/verify-user.php?hash=$hash";
        
        $str="Hi, Thanks for registering with shopurneeds! Click here $link to verify your account.";  
       		$usersss = $db->sendordermsg($mobileno,$str);

        
				
				} 
				else {
					$response["status"] = "401";
					$response["msg"] = "Error occurred in Registration";
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