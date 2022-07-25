<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d"); 
 
 $qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);

include "simple_html_dom.php";

$fields = 'Customer Name","Customer Email","Customer Mobile","Address","City","Pincode","Total Order","Order Amount"'."\n";			
while($row=mysqli_fetch_array($result))
{
    $rowaddress=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."customer_address where user_id='".$row['id']."'")); 
    $sql_total_order = mysqli_num_rows(mysqli_query($conn,"select * from ".$sufix."order_seller  where emailid='".$row['emailid']."'")); 
    $sql_customer_order1 = mysqli_fetch_assoc(mysqli_query($conn,"select sum(totalcost) as totalcost from ".$sufix."order_seller  where emailid='".$row['emailid']."'")); 
    $total_order_value =  $sql_customer_order1['totalcost']; 
    
    if($row['fname'] != '') { $name = $row['fname']." ".$row['lname']; } else { $name = $rowaddress['fname']." ".$rowaddress['lname'];   }
  
    
	$fields .= '"'.$name.'","'.$row['emailid'].'","'.$rowaddress['mobileno'].'","'.$rowaddress['address'].'","'.$rowaddress['city'].'","'.$rowaddress['zipcode'].'","'.$sql_total_order.'","'.number_format($total_order_value,2).'"'; 
	$fields.="\n"; 
}

header('Content-type: text/csv');

$fileName=date("d-m-Y")."-customer_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>