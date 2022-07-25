<?php
session_start(); 
include("include/configurationadmin.php"); 
$saasta=$_REQUEST['ostatus'];
$sqlorder=mysqli_query($conn,"select bid from shopurneeds_order where approve_status='".$saasta."'");
while($roworder=mysqli_fetch_array($sqlorder))
{
    $bidids .=$roworder['bid'].",";
}
 $bidids12=substr($bidids,0,-1);
$query  = "select sum(quantity) as totalquantity,productid,productname,size,sku,sellingprice from  shopurneeds_basket  where  bid in ($bidids12) group by productid";

$result = mysqli_query($conn,$query) or die('Error, query failed');

$fields = '"product ID","product name","Size","Quantity","Cost Price","Total Amount"'."\n";


$i=1;
    while($row = mysqli_fetch_assoc($result))
    {
		$rdsd=mysqli_fetch_array(mysqli_query($conn,"select * from shopurneeds_product where id='".$row['productid']."'"));
$sasssubtto=$row['sellingprice']*$row['totalquantity'];
	$fields .= '"'.$row['productid'].'","'.$row['productname'].'","'.$row['size'].'","'.$row['totalquantity'].'","'.$row['sellingprice'].'","'.$sasssubtto.'"'."\n";

		$i++;
}

 
// Set our header

header('Content-type: text/csv');

/* To display data in-browser, change the header below to:

 header("Content-Disposition: inline");*/

$fileName=date("d-m-Y")."-Product-collection-report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

     

    // Output our data

 echo $fields;

?> 





