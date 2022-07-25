<?php 
error_reporting("E_ALL"); 
include("sql.php");
$urdate=mysqli_query($conn,"update shopurneeds_category set catprocheck='0'");
$salpr=mysqli_query($conn,"select distinct cat_id from shopurneeds_product_cat where displayflag='1'");
while($rowpr=mysqli_fetch_array($salpr))
{
$catids .=  $rowpr['cat_id'].",";
}
$catis=substr($catids,0,-1);

$urdate=mysqli_query($conn,"update shopurneeds_category set catprocheck='1' where cat_id in($catis)");
echo "DONE";
?>
