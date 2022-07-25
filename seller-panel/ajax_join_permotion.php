<?php
session_start(); 
include("include/configurationadmin.php"); 
  
$skuids= $_POST['upids'];
$promotionId = $_POST['promotion_id']; 
 
$sqloldids = mysqli_fetch_assoc(mysqli_query($conn,"select upids from  ".$sufix."promotion where id='".$promotionId."'"));
$oldsku = $sqloldids['upids'];
if($oldsku != '')
{
   $newskuids = $oldsku.",".$skuids; 
}
else
{
   $newskuids = $skuids; 
}


$update = mysqli_query($conn,"update ".$sufix."promotion set upids='".$newskuids."' where id='".$promotionId."'");

?>


<script>window.location.href='https://localhost/project/shopurneeds/seller-panel/seller-promotions';</script>  