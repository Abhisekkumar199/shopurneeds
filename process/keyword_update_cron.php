<?php
include("includes/configuration.php");

$masterproductsql = mysqli_query($conn,"SELECT * From ".$sufix."product where vartype=''");
while($masterproductrows = mysqli_fetch_assoc($masterproductsql)) {
    $rand=rand(1,10000);
    $mrpprice=$masterproductrows['mrp'];
    $sellingprice=$masterproductrows['sellingprice'];
$pervalue = $mrpprice - $sellingprice;
 $percentage = round($pervalue*100/$mrpprice);


    $didsname=str_replace("'","",$masterproductrows['productname']);
$categroyrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT categoryname FROM ".$sufix."category where cat_id='".$masterproductrows['cat_id']."'"));
$brandrows = mysqli_fetch_assoc(mysqli_query($conn,"SELECT brandname FROM ".$sufix."brand where bid='".$masterproductrows['bid']."'"));
$key = $masterproductrows['searchkeyword'].",".$categroyrows['categoryname'].",".$brandrows['brandname'].",".$didsname.",".$masterproductrows['sku'].",".$masterproductrows['id'];
$updatemsql = mysqli_query($conn,"update ".$sufix."product set fskeyword='".mysqli_real_escape_string($conn,$key)."', discountper='".$percentage."', sortid='".$rand."'  where id='".$masterproductrows['id']."'"); 
}
?>