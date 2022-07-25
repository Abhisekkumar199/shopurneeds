<?php
session_start(); 
include("../configuration.php");
include("../mailfunction.php");  
$rerurnyes=$_POST['rerurnyes'];
$product_id=$_POST['product_id'];
$product_oid_seller=$_POST['product_oid_seller'];
$product_bid=$_POST['product_bid'];
$seller_id=$_POST['seller_id'];
$user_id=$_POST['user_id'];
$status=$_POST['status'];
$type=$_POST['type'];
$reason=$_POST['reason'];

if($_REQUEST['checkstatus']=='cancelorder') 
{  
    $update = mysqli_query($conn,"update ".$sufix."order set approve_status='Cancelled',cancle_reason='".$_REQUEST['reason_status']."' where oid = '".$_REQUEST['orderid']."'") ;
     $sqlorder=mysqli_fetch_array(mysqli_query($conn,"select *  from ".$sufix."order where oid = '".$_REQUEST['orderid']."'"));
     if($sqlorder['walletused']>0)
     {
         $sqluser=mysqli_fetch_array(mysqli_query($conn,"select *  from ".$sufix."user_registration where emailid = '".$sqlorder['emailid']."'"));

         $walleramount=$sqlorder['walletused'];
         	$query = mysqli_query($conn,"update `".$sufix."user_registration` set `wallet`=wallet+$walleramount where id='".$sqluser['id']."'");

	mysqli_query($conn,"insert into `".$sufix."user_wallet` (user_id,orderid,type,credit,adddate) values('".$sqluser['id']."','".$_REQUEST['orderid']."','Cancelled Order','".$walleramount."',NOW())");

     }
    include("../mail/order_status_mail.php"); 
    send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
 } 
 else 
 {
 
    $reason = mysqli_query($conn,"insert into ".$sufix."reason (`pid`,`bid`,`seller_id`,`user_id`,`status`,`reason`,`adddate`,`type`,`oid_seller`) values('".$_REQUEST['pid']."', '".$_REQUEST['bid']."', '".$_REQUEST['seller_id']."', '".$_REQUEST['user_id']."', 'Return', '".$_REQUEST['reason_status']."', NOW(),'product', '".$_REQUEST['orderid']."')");
    
    $update = mysqli_query($conn,"update ".$sufix."basket set status = 'Return', reason = '".$_POST['reason_status']."' where oid_seller = '".$_REQUEST['orderid']."'");
    
    $to = 'info@shopurneeds.in';
    $subject = "Return request by customer";
    
    $message = "<b>Seller Id :  ".$_REQUEST['seller_id']."<br>";
    $message .= "<b>Product Id : ".$_REQUEST['pid']."<br>";
    
    
    $header = "From:info@shopurneeds.in \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    
    $retval = mail ($to,$subject,$message,$header);
 
 }
 echo "Request updated successfully";
?>