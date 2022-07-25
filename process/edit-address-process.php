<?php
include("../includes/session.php");
include("../configuration.php");  
 
$address_id = $_REQUEST['address_id'];
$addredd_type = $_REQUEST['addredd_type']; 
$fname = ucwords(strtolower($_REQUEST['fname']));
$lname = ucwords(strtolower($_REQUEST['lname']));
$mobile = $_REQUEST['mobile'];
$address = $_REQUEST['address'];
$city = $_REQUEST['city'];
$pincode = $_REQUEST['pincode'];  
$sql_user_address=mysqli_query($conn,"update   ".$sufix."customer_address set  addresstype='$addredd_type',fname='$fname',lname='$lname',mobileno='$mobile',address='$address',city='$city',zipcode='$pincode'  where id='$address_id'"); 

  
?> 
        <script>window.location.href='<?php echo URL;?>/basket/shipping';</script>
<?php 
 
?>	