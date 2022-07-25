<?php 
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();  
$date = date('Y-m-d');
$feedback = isset($_REQUEST['feedback'])?$_REQUEST['feedback']:'';
$user_id = isset($_REQUEST['user_id'])?$_REQUEST['user_id']:'';


if($user_id != '')
{ 
    

    	$sqlbid12=mysql_query("insert into  shopurneeds_feedback(user_id,feedback) values('".$user_id."','".$feedback."')");
    	$response["status"] = "200";		
	$response["msg"] = "Added Successfully!";		
	echo json_encode($response);	
}
else 	
{		
	$response["status"] = "400";		
	$response["msg"] = "Parameter missing!";		
	echo json_encode($response);	
}