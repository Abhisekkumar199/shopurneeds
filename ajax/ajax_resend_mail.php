<?php 
session_start();
include("../configuration.php");
include("../mailfunction.php");   
date_default_timezone_set('Asia/Calcutta'); 
      $emailid=$_SESSION['otp_email']; 
   
    $mobileno = $_SESSION['otp_mobile'];
    $sql_user=mysqli_fetch_assoc(mysqli_query($conn,"select fname from `".$sufix."user_registration` where emailid='".$emailid."'"));  
    $fname = $sql_user['fname']; 
    $password = $sql_user['password'];
    
    $hash=base64_encode($emailid); 
    $CompanyEmail=CompanyEmail;
    $CompanyName=CompanyName;
    $URL=URL; 
    
    
        
    include("../mail/signup_mail.php"); 
    send_mail($toc, $subjectc, $messagec, $headers1, $fromc,'');
       			
        
    ?>
    


