<?php
session_start();
include("../configuration.php"); 
header('Access-Control-Allow-Origin: *');  
 
$sql=mysqli_query($conn,"select * from `".$sufix."user_registration` WHERE ( emailid='".mysqli_real_escape_string($conn,$_REQUEST['sEmail'])."' or billing_mobile='".mysqli_real_escape_string($conn,$_REQUEST['sEmail'])."' )  and password='".mysqli_real_escape_string($conn,$_REQUEST['sPassword'])."'");
$num=mysqli_num_rows($sql);
if($num>0)
{
    $sql_check=mysqli_query($conn,"select * from `".$sufix."user_registration` WHERE ( emailid='".mysqli_real_escape_string($conn,$_REQUEST['sEmail'])."' or billing_mobile='".mysqli_real_escape_string($conn,$_REQUEST['sEmail'])."' ) and is_verified='1'");
    $num_check=mysqli_num_rows($sql_check);
    if($num_check > 0)
    {
    	while($rows=mysqli_fetch_array($sql))
    	{
    		$emailid=$rows['emailid'];
    		$_SESSION['emailid']=$emailid;
    		$_SESSION['fnamenew']=$rows['fname'];
    		$_SESSION['useridse']=$rows['id'];
    	}
    	
    	?>
        <script>window.parent.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>"</script>
        <?php
    
	}
	else
    {
        echo '<font style="color:#FF0000;">Your account is not verified</font>';
    } 

}	
else	
{
echo '<font style="color:#FF0000;">Invalid username or password. Please try again!</font>';

}

?>