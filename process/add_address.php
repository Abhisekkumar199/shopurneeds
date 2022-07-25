<?php
include("../includes/session.php");
include("../configuration.php");  
 
$address_id = $_REQUEST['addredd_id'];
$addredd_type = $_REQUEST['addredd_type'];
$is_add_ddress = $_REQUEST['is_add_ddress'];
$fname = ucwords(strtolower($_REQUEST['fname']));
$lname = ucwords(strtolower($_REQUEST['lname']));
$mobile = $_REQUEST['mobile'];
$address = $_REQUEST['address'];
$city = $_REQUEST['city'];
$pincode = $_REQUEST['pincode'];
$countrycode = $_SESSION['current_country'];
 $user_id = $_SESSION['useridse'];
    
$sql_country=mysqli_fetch_assoc(mysqli_query($conn,"select countryname from ".$sufix."country where countrycode='$countrycode' ")); 
$countryname = $sql_country['countryname']; 

$sql = mysqli_query($conn," select id from ".$sufix."customer_address where user_id='$user_id' ");
if(mysqli_num_rows($sql) == 0)
{
     mysqli_query($conn,"update `".$sufix."user_registration` set  `fname`='".$fname."',`billing_mobile`='$mobile' where id='".$user_id."'") ; 
} 
  

$sql_user_address=mysqli_query($conn,"insert into ".$sufix."customer_address set user_id='$user_id',addresstype='$addredd_type',fname='$fname',lname='$lname',mobileno='$mobile',address='$address',city='$city',zipcode='$pincode',country='$countryname',adddate='".date("y-m-d")."',addtime='".date("H:i")."'"); 
      
  
?> 
        <script>window.location.href='<?php echo URL;?>/basket/shipping';</script>
<?php 
 
?>	