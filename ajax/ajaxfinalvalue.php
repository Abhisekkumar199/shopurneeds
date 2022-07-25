<?php 
session_start(); 
include("../configuration.php");  
include('../includes/currency_display.php');

$paymentType = $_REQUEST['paymentType'];
$estimatetotal = $_REQUEST['estimatetotal']; 

$codcharge = $_REQUEST['codcharge']; 
$codchargeshow = $_REQUEST['codchargeshow']; 
$newestimatetotal = $_REQUEST['newestimatetotal'];
 $bid=$_SESSION['shopid'];   
$sqlpcheck=mysqli_query($conn,"select * from shopurneeds_basket where bid='$bid' and promotionId = '0'");
 $numpcheck=mysqli_num_rows($sqlpcheck);
  
if($paymentType == 'codpay')
{
    $newestimatetotal = $estimatetotal;
    $newcodcharge = $codcharge;
    $_SESSION['price']= $newestimatetotal;  
    $six_digit_random_number = rand(100000, 999999);
    //$six_digit_random_number = str_replace(' ', '', $six_digit_random_number);
    $_SESSION['otp'] = $six_digit_random_number;
    echo $newestimatetotal."-".$newcodcharge."-".$six_digit_random_number; 
    
    $str="OTP for COD Verification is ".$six_digit_random_number;
    $message=urlencode($str); 
    $numbers=$_REQUEST['mobile'];
      $url="http://sms.webkype.in/sms_api/sendsms.php?username=webkypein&password=Kype123@&message=$message&sendername=shopurneeds&mobile=$numbers"; $ch = curl_init($url); curl_setopt($ch, CURLOPT_HEADER, 0); curl_setopt($ch, CURLOPT_POST, 0); curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); $response = curl_exec($ch);	

    $emailforotp=$_REQUEST['emailforotp']; 
	include("../mail/otp_mail.php");//send email file				
    send_mail($toc, $subjectc, $message, $headers1, $fromc, ''); 
}
else if($paymentType == 'onlinepay' or $paymentType == 'paytm')
{
    if($codchargeshow > 0)
    {
        $newestimatetotal = $newestimatetotal ;
        $newcodcharge = $codchargeshow;
        $_SESSION['price']= $newestimatetotal;  
        $_SESSION['otp'] = $six_digit_random_number; 
        echo $newestimatetotal."-".$newcodcharge; 
    }
    else
    {
        $newcodcharge = 0;
        $newestimatetotal = $estimatetotal; 
        $_SESSION['price']= $newestimatetotal;  
        echo $newestimatetotal."-".$newcodcharge; 
    }
    
}

?>    
							
	 