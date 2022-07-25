<?php
header("Content-type:application/json");
	session_start();
include("includes/configuration.php");

$response=array();
if(isset($_POST["email_id"])){
$tryproid=$_REQUEST["product_id"];
$city = $_REQUEST['city'];
$email = $_REQUEST['email_id'];
$tdate = $_REQUEST['product_date'];
$tryid=rand(100,999).rand(1000,99999);
$sqlss=mysqli_query($conn,"insert into shopurneeds_tryathome_dummy(city,email,bdate,adddate,freepro) values('".$city."','".$email."','".$tdate."',NOW(),'".$tryproid."')");
$_SESSION['TryCity']=$city;
$_SESSION['TryDate']=$tdate;
$_SESSION['Tryemail']=$email;
$_SESSION['TryID']=$tryid;
$_SESSION["Tryproduct_id"]=$tryproid;
	$response['status']='success';
    $response['msg']=$_SESSION;
	
}else{
    $response['status']='error';
    $response['msg']="Invalid request";
}
echo json_encode($response);
die;

?>