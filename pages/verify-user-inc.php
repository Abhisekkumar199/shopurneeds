<?php
session_start(); 
	
$hash=$_REQUEST['hash'];
$emailid=base64_decode($hash);
	$sql=mysqli_query($conn,"select * from `shopurneeds_user_registration` where `is_verified`='0' and emailid='".$emailid."'");
	
    if(mysqli_num_rows($sql) > 0) 
	{
	    $rows=mysqli_fetch_array($sql); 
	     mysqli_query($conn,"update `shopurneeds_user_registration` set `is_verified`='1'  where emailid='".$emailid."'"); 
		
		
		$msq =  "<h1>Your account has been verified successully</h1>";
		
	    $mobileno = $rows['billing_mobile'];
	    
	    $message=urlencode("Hi, Welcome to Shop Ur Needs Family! We welcome you onboard with 50 Wallet points. Start Shopping Start Saving!!! Cheers, Team Shop Ur Needs");  
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
	else
	{
	    
		$msq =  "<h1>Your account already verified</h1>";
	}
?>	 
<link href="<?php echo $url; ?>/assets/css/styledashboard.css" rel="stylesheet">
<div class="da_body"  style="width:100%; padding:10px;min-height:400px;" > 
  <div class="da_dashboard">     
     <?php echo $msq; ?>
  </div> 
</div>
 