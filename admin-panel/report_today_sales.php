<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d"); 
 
 $qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);

//include "simple_html_dom.php";

	$fields = '"ORDER ID","Customer Name","Customer Email","Customer Mobile","Address","Order Amount","Payment Type","Order Date"'."\n";			
while($row=mysqli_fetch_array($result))
{
    $sqladdress=mysqli_query($conn,"select * from ".$sufix."customer_address where id='".$row['address_id']."'");
    $rowaddress = mysqli_fetch_array($sqladdress);
    
    
	$fields .= '"'.$row['oid'].'","'.$rowaddress['fname']." ".$rowaddress['lname'].'","'.$row['emailid'].'","'.$rowaddress['mobileno'].'","'.$rowaddress['address'].' '.$rowaddress['city'].' '.$rowaddress['zipcode'].'","'.number_format($row['totalcost'],2).'","'.$row['paytype'].'","'.$row['orderdate'].' '.$row['ordertime'].'"'; 
	$fields.="\n"; 
}

header('Content-type: text/csv');

$fileName=date("d-m-Y")."-today_sales_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>