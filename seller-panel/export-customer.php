<?php 
header('Content-type: text/csv');
$fileName=date("d-m-Y")."-Customer.csv";
header("Content-Disposition: attachment; filename=".$fileName); 
include("include/configurationadmin.php");   
if($_REQUEST['getselectvalue']!='') 
{
$www =  $_REQUEST['getselectvalue'];
$qidd = "select * from shopurneeds_user_registration where id IN($www)";
} 
else 
{
$qidd = $_REQUEST['query12'];
}
$result=mysqli_query($conn,$qidd);
include "simple_html_dom.php";
$fields = '"ID","Customer Name","Email","Address","City","Zipcode","Contact Number","Total Orders","Total Abandoned Orders"'."\n";
										
while($row=mysqli_fetch_array($result))
{
$totalordersql = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."order_seller where userid='".$row['emailid']."'"));
$totalAbandoned = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."basket where emailid='".$row['emailid']."' and oid_seller=''"));
$fields .= '"'.$row['id'].'","'.$row['fname'].'","'.$row['emailid'].'","'.$row['billing_address'].'","'.$row['billing_city'].'","'.$row['billing_zip'].'","'.$row['billing_mobile'].'","'.$totalordersql.'","'.$totalAbandoned.'"'."\n";
$row['id']=$row['fname']=$row['emailid']=$row['billing_address']=$row['billing_city']=$row['billing_zip']=$row['billing_mobile']=$totalordersql=$totalAbandoned='';
}
echo $fields; 
?>