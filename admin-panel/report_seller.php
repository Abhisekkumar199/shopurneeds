<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d"); 
 
 $qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);

include "simple_html_dom.php";

$fields = 'Seller Name","Seller Email","Seller Mobile","Address","City","Total Product","Total Order","Order Amount"'."\n";			
while($row=mysqli_fetch_array($result))
{
    $totalproduct = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."product  where seller_id='".$row['id']."' and vartype=''"));
    $sql_customer_order1 = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller  where seller_id='".$row['id']."'"));  
    $total_order_value =  $sql_customer_order1['totalcost']; 
    $sql_total_order = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."order_seller  where seller_id='".$row['id']."'")); 
    
    if($row['fname'] != '') { $name = $row['fname']." ".$row['lname']; } else { $name = $rowaddress['fname']." ".$rowaddress['lname'];   }
  
    
	$fields .= '"'.$row['suppliername'].'","'.$row['emailid'].'","'.$rowaddress['phone'].'","'.$rowaddress['address1'].'","'.$rowaddress['pcity'].'","'.$totalproduct.'","'.$sql_total_order.'","'.number_format($total_order_value,2).'"'; 
	$fields.="\n"; 
}

header('Content-type: text/csv');

$fileName=date("d-m-Y")."-seller_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>