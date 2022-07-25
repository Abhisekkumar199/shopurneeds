<?php
include("includes/session.php");
include("../configuration.php");  
 
$address_id = $_REQUEST['id']; 
$sql_user_address=mysqli_query($conn,"delete from   ".$sufix."customer_address    where id='$address_id'"); 

  
?> 
    <script>window.parent.location.href = "<?php echo $_SERVER['HTTP_REFERER'];?>"</script>
<?php 
 
?>	