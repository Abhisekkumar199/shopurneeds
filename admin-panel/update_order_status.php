<?php 
session_start(); 
include("include/configurationadmin.php");    
include("include/mailfunction.php");   

$new_status=$_REQUEST['status'];
$id = $_REQUEST['orderid']; 
$sql_order=mysqli_fetch_assoc(mysqli_query($conn,"select * from shopurneeds_order WHERE  oid='".$id."'"));
$deeds=$sql_order['delivery_date'];
    $newDate = date("d-m-y", strtotime($deeds));  

$sqluser=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."user_registration where emailid='".$sql_order['emailid']."'"));
$mobileno = $sqluser['billing_mobile'];

if(isset($_REQUEST['status']))
{
    
    if($new_status == "Order Packed")
    {
        $mail_Status = "packed"; 
    }
    else if($new_status == "Order Shipped")
    {
        $mail_Status = "shipped"; 
        $message=urlencode("Your order no $id will reach you on ".$deeds.". Our apology for undelivered items in your order. Kindly refer your email for details. Regards, Team Shop Ur Needs");   
        $url="sms.webkype.in/sms_api/sendsms.php?username=shopurneeds&password=shopurneeds123@&mobile=$mobileno&sendername=SHOPUR&message=$message";  
        $ch = curl_init();   
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 ); 
        curl_exec($ch); 
    }
    else if($new_status == "Delivered")
    {
        $mail_Status = "delivered"; 
        $message=urlencode("Hi, Delighted to serve you as promised,your order is delivered on time.Kindly leave suggestions/feedback on contact@shopurneeds.com Cheers, Team Shop Ur Needs");   
        $url="sms.webkype.in/sms_api/sendsms.php?username=shopurneeds&password=shopurneeds123@&mobile=$mobileno&sendername=SHOPUR&message=$message";  
        $ch = curl_init();   
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 ); 
        curl_exec($ch);
    }
    else if($new_status == "Order Cancelled")
    {
        $mail_Status = "cancelled"; 
    }else if($new_status== 'Order Approved'){
        $mail_Status = "Approved"; 
    }
    
    $sql_new="UPDATE shopurneeds_order SET approve_status='$new_status' WHERE  oid='".$id."'";
    if($result_new=mysqli_query($conn,$sql_new))
    { 
        $time = date("H:i:s");
        if($_REQUEST['status']!='') 
        { 
            $remarks =  $_REQUEST['status'];
        } 
        else 
        { 
            $remarks =  $_REQUEST['remarks'];
        }
        $ins = mysqli_query($conn,"insert into shopurneeds_order_status (`oid`,`remarks`,`adddate`,`ordermode`,`displayflag`,`add_user`,`addtime`) values ('".$id."','".$remarks."',NOW(),'".$_REQUEST['ordermode']."','1','Seller','".$time."')");
 
    }
    include("order_status_mail.php"); 
   send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
}
?> 