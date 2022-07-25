<?php 
session_start();
include("../configuration.php");
include("../mailfunction.php");   
date_default_timezone_set('Asia/Calcutta'); 
    $emailid=$_REQUEST['emailid'];
    $password=$_REQUEST['password'];
    $mobileno = $_REQUEST['mobileno'];
    $fname = $_REQUEST['fname'];
    $CompanyEmail=CompanyEmail;
    $CompanyName=CompanyName;
    $URL=URL;
    $hash=base64_encode($emailid); 
    $sql=mysqli_query($conn,"select emailid from `".$sufix."user_registration` where emailid='".$emailid."' or billing_mobile='".$mobileno."'") ; 
    $num=mysqli_num_rows($sql); 
    if($num ==0)
    { 
        $otp = rand(100000,999999); 
        $time = date("h:i:s");	
        $sql_user=mysqli_query($conn,"insert into `".$sufix."user_registration`(`fname`,`password`,`emailid`,`billing_mobile`,`mobileotp`, `displayflag`,`adddate`,`addtime`,wallet) values ('".$fname."','".$password."', '".$emailid."','".$mobileno."','".$otp."', '1', NOW(),'".$time."',50)") ;//insert data to 
        
        			$inserid=mysqli_insert_id($conn);

        		    	$basketstatsude=mysql_query("insert into shopurneeds_user_wallet(user_id, orderid,`type`,credit,adddate) values('".$inserid."','','Registration Wallet','50',NOW())");

        
        $link = "https://localhost/project/shopurneeds/verify-user.php?hash=$hash";
        
        $message=urlencode("Hi, Thanks for registering with shopurneeds! Click here $link to verify your account.");  
        $url="sms.webkype.in/sms_api/sendsms.php?username=shopurneeds&password=shopurneeds123@&mobile=$mobileno&sendername=SHOPUR&message=$message";  
        $ch = curl_init();  
        
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2 ); 
        curl_exec($ch);
        
        
        $_SESSION['otp']=$otp;
        $_SESSION['otp_mobile']=$mobileno;
        $_SESSION['otp_email']=$emailid;
        
        include("../mail/signup_mail.php"); 
        send_mail($toc, $subjectc, $messagec, $headers1, $fromc,'');
        echo $_SESSION['sessionMsg']='<font color="#003300" class="emailregister"> Thanks for registering with shopurneeds! Please check your registered email id for your login credentials.</font>';
        
        
        
        
        //email send
        //$sqlssassss=mysqli_query($conn,"select * from shopurneeds_user_registration where emailid='".$emailid."'");
        //$saidsw=mysqli_fetch_assoc($sqlssassss);
        
        //$_SESSION['emailid']=$saidsw['emailid'];
        //$_SESSION['fnamenew']=$saidsw['fname'];
        //$_SESSION['useridse']=$saidsw['id'];
	    //$update = mysqli_query($conn,"update ".$sufix."basket set emailid='".$emailid."' where bid='".$_SESSION['shopid']."'");
        					
        
    ?>
    <script>//window.parent.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>"</script>
    <?php
    }
	else
	{
        echo '<font color="#FF0000">Email ID / Mobile no. already registered</font>'; 
    ?>	
<?php } ?>



