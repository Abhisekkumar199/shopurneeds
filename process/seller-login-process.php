<?php
session_start();
include("../configuration.php");	
include("../mailfunction.php");  
 
$username=$_REQUEST['seller_emailid'];
$password=$_REQUEST['seller_password'];   
$sql  = mysqli_query($conn,"select * from ".$sufix."suppliers where emailid='".$username."' and password='".$password."'") ; 
if(mysqli_num_rows($sql) > 0)
{
    $sql_check=mysqli_query($conn,"select * from ".$sufix."suppliers where emailid='".$username."' and password='".$password."'  and is_verified='1'");
    $num_check=mysqli_num_rows($sql_check);
    if($num_check > 0)
    {
        $rows = mysqli_fetch_assoc($sql); 
    	$_SESSION['id'] = $rows['id'];	
    	$_SESSION['sellerid'] = $rows['id'];		               
        $_SESSION['username'] = $rows['username'];	
    	$_SESSION['usertype'] = $rows['type'];   
        ?>
        <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/dashboard';</script>
        <?php 
    }
	else
    {
        $_SESSION['sessionregmsg']="<font color='red'>Your account is not verified!</font>"; 
        
        ?>
        <script>window.location.href='<?php echo URL; ?>/seller-login';</script> 
        <?php
    }  
} 
else 
{ 
    $_SESSION['sessionregmsg']="<font color='red'>Invalid userid/password!</font>";
?> 
    <script>window.location.href='<?php echo URL; ?>/seller-login';</script> 
<?php } ?>