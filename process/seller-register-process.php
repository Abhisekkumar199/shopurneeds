<?php
session_start();
include("../configuration.php");	
include("../mailfunction.php");  
 
    $business_name=mysqli_real_escape_string($conn,$_REQUEST['brand_name']);
    $business_name2=trim($business_name);  
    $slug=strtolower(create_slug($business_name2));  
    $brand_name=$_REQUEST['brand_name'];
    $seller_emailid=$_REQUEST['seller_emailid'];
    $seller_phone=$_REQUEST['seller_phone'];
    $seller_password=$_REQUEST['seller_password'];   
    $hash=base64_encode($seller_emailid); 
    
    $sql=mysqli_query($conn,"select * from `".$sufix."suppliers` WHERE emailid='".$seller_emailid."'");
    $num=mysqli_num_rows($sql); 
     
    if($num == 0) 
    { 
        mysqli_query($conn,"insert into `".$sufix."suppliers` set  `showroom_name`='".$brand_name."',`suppliername`='".$business_name."',`seller_slug`='".$slug."',`emailid`='".$seller_emailid."',`brandname`='".$business_name."',`password`='".$seller_password."', `adddate`='".date("Y-m-d")."'") ; 
        $seller_id = mysqli_insert_id($conn);  
         
        include("../mail/seller_signup_mail.php");
        send_mail($toc, $subjectc, $messagec, $headers1, $fromc,''); 
        $_SESSION['sessionregmsg']="<font color='green'>Thank you to taking your time by requesting to join as a seller in Shopurneeds.com. Please check your mail for details. </font>";
    
    	?>
    	<script>window.location.href='<?php echo URL; ?>/register-seller';</script>
    	<?php  
    }	
    else 
    {
    	$_SESSION['sessionregmsg']="<font color='red'>Email Id already exist!</font>";
    ?>
    	<script>window.location.href='<?php echo URL; ?>/register-seller';</script>
    <?php } ?>