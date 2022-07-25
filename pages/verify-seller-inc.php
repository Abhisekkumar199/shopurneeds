<?php
session_start(); 
	
$hash=$_REQUEST['hash'];
$emailid=base64_decode($hash);
$sql=mysqli_query($conn,"select * from `shopurneeds_suppliers` where `is_verified`='0' and emailid='".$emailid."'"); 
if(mysqli_num_rows($sql) > 0) 
{
    $rows=mysqli_fetch_array($sql);
	$sql=mysqli_query($conn,"update `shopurneeds_suppliers` set `is_verified`='1'  where emailid='".$emailid."'"); 
	$msq =  "<h1>Your account has been verified successully</h1>";
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
 