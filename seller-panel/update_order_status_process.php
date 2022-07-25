<?php 
session_start(); 
include("include/configurationadmin.php"); 
include("include/mailfunction.php");   

$id = $_REQUEST['id']; 
if(isset($_REQUEST['new_status']))
{
    $new_status=$_REQUEST['new_status'];
    if($new_status == "Order Packed")
    {
        $mail_Status = "packed"; 
    }
    else if($new_status == "Order Shipped")
    {
        $mail_Status = "shipped"; 
    }
    else if($new_status == "Delivered")
    {
        $mail_Status = "delivered"; 
    }
    else if($new_status == "Cancelled")
    {
        $mail_Status = "cancelled"; 
    }
    $sql_new="UPDATE shopurneeds_order SET approve_status='$new_status' WHERE  oid='".$id."'";
    if($result_new=mysqli_query($conn,$sql_new))
    { 
        $time = date("H:i:s");
        if($_REQUEST['new_status']!='') 
        { 
            $remarks =  $_REQUEST['new_status'];
        } 
        else 
        { 
            $remarks =  $_REQUEST['remarks'];
        }
         mysqli_query($conn,"insert into shopurneeds_order_status (`oid`,`remarks`,`adddate`,`ordermode`,`displayflag`,`add_user`,`addtime`) values ('".$id."','".$remarks."',NOW(),'".$_REQUEST['ordermode']."','1','Seller','".$time."')");
  
    }
    
    include("order_status_mail.php"); 
    send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');
 
}
?>
<script>window.location.href='https://localhost/project/shopurneeds/seller-panel/order-list?orderstatus=<?php echo $new_status; ?>';</script>