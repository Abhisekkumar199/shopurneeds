<?php
session_start();
date_default_timezone_set('Asia/Calcutta');
include("../configuration.php");
include("../mailfunction.php");  

$CompanyEmail=CompanyEmail;
$CompanyName=CompanyName;

    $emailid=$_REQUEST['emailid'];
    $password=$_REQUEST['password'];
    $mobileno = $_REQUEST['phone'];
    $fname = $_REQUEST['fname'];
$URL=URL;
	 
    $emailid_login=$_REQUEST['emailid_login'];
    $_REQUEST['emailid'] = $emailid;
    $hash=base64_encode($emailid);
    
    if(isset($_REQUEST['subscribe']))
    {
    	$subscribe='1';
    }
    else
    {
    	$subscribe='0';
    }

if($_REQUEST['type']=='signup')
{
	$sql=mysqli_query($conn,"select emailid from `".$sufix."user_registration` where emailid='".$emailid."'");
	if($rows=mysqli_fetch_assoc($sql))
	{		 
		$_SESSION['sessionMsg']="<font color='red'>Email ID already exist!</font>"; 
		?>
		<script>window.location.href='<?php echo URL;?>/basket/checkout_reg';</script>
		<?php 
		exit();		
	}
	else
	{
        //$password=$_REQUEST['cfpassword'];
        $time = date("h:i:s");
        $password1 = rand(11111111,99999999);
        $sql_user=mysqli_query($conn,"insert into `".$sufix."user_registration`(`fname`,`password`,`emailid`,`billing_mobile`, `displayflag`,`adddate`,`addtime`) values ('".$fname."','".$password."', '".$emailid."','".$mobileno."', '1', NOW(),'".$time."')") ;//insert data to 
        
        
        $lastid = mysqli_insert_id($conn);
        
        $_SESSION['emailid']=$emailid;
        $_SESSION['useridse']=$lastid;
        $_SESSION['fnamenew']=$_REQUEST['fname'];  
     
        include("../mail/signup_mail.php");
        send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');  
        ?>
        <script>window.location.href='<?php echo URL;?>/basket/cart';</script>
        <?php 	
    }
}
else
{
    $time = date("h:i:s");
    $pw=$_POST['password'];	
    $sql=mysqli_query($conn,"select * from `".$sufix."user_registration` WHERE (emailid='".$emailid_login."' or billing_mobile='".$emailid_login."') and password='".$pw."'"); 
    /*if($_POST['optradio']==1) 
    { */	
        
    /*} 
    else 
    { 
        $sql=mysqli_query($conn,"select * from `".$sufix."user_registration` WHERE emailid='".$emailid."'"); 
        if(mysqli_num_rows($sql)>0) { } 
        else 
        { 
            $password1 = rand(11111111,99999999);
            mysqli_query($conn,"insert into `".$sufix."user_registration` (`emailid`, `password`, `adddate`, `displayflag`, `approveflag`, `subscribe`,`addtime`) values ('".$_REQUEST['emailid']."', '".$password1."', '".date("Y-m-d")."', '1', '1', '".$subscribe."','".$time."')") ;	
            $lastid = mysqli_insert_id($conn);
            $_SESSION['emailid']=$_REQUEST['emailid'];
            $_SESSION['useridse']=$lastid;
            $_SESSION['fnamenew']='Guest';
            $mobileno = 'xxxxxxxxxx';
            //include("signup_mail.php");
            //send_mail($toc, $subjectc, $messagec, $headers1, $fromc, '');  
            ?>
            <script>window.location.href='<?php echo URL;?>/basket/cart';</script>
        <?php
        }
    }*/
    $num=mysqli_num_rows($sql);
    
    
    if($num>0)
    {
        while($rows=mysqli_fetch_array($sql))
        {
            $emailid=$rows['emailid']; 
            $_SESSION['emailid']=$emailid;
            $_SESSION['useridse']=$rows['id'];
            $_SESSION['fnamenew']=$rows['fname'];
        }  
        $update = mysqli_query($conn,"update ".$sufix."basket set emailid='".$emailid."' where bid='".$_SESSION['shopid']."'");
        $bidsql = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."basket where emailid='".$emailid."'  order by id desc limit 1"));
        $oid_seller = $bidsql['oid_seller'];
        if($oid_seller=='') 
        {
            $bidrows = $bidsql['bid'];
            if($bidrows!='') 
            { 
                $_SESSION['shopid']=$bidsql['bid'];
            }
        }
        ?> 
    	<script>window.location.href='<?php echo URL; ?>/basket/cart';</script>
        <?php 
    
    }	
    else	
    {
        $_SESSION['sessionMsg']="<font color='red'>Invalid Email Address or password. Please try again!</font>"; 
        ?> 
        <script>window.location.href='<?php echo URL; ?>/basket/checkout_one';</script>
        <?php	 
    }		 
}
?>