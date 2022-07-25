<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d"); 
 
 $qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);

include "simple_html_dom.php";

$fields = '"Date","Order Id","Product Name","HSN Code","Qty","Selling Price","SGST","CGST","IGST","Order Value","Pay Type","Email Id","Mobile No."'."\n";			
while($row=mysqli_fetch_array($result))
{
    $sqlcart=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$row['bid']."'  ");
    while($rowcart = mysqli_fetch_array($sqlcart))
    {     
        $sqlpt=mysqli_fetch_array(mysqli_query($conn,"select gst from ".$sufix."product where id='".$rowcart['productid']."'"));
        $tax=$sqlpt['gst'];  
        $gst=$rowcart['subtotal']*$tax/100;  
        
        $total_gst_value=number_format($gst,2);   
        $totalgstfinal=number_format($total_gst_value,2);
        $totalsgst=number_format(($total_gst_value)/2,2);
        $totalcgst=number_format(($total_gst_value)/2,2);  
    
	$fields .= '"'.$row['orderdate'].'","'.$row['oid'].'","'.$rowcart['productname'].'","'.$rowcart['hsncode'].'","'.$rowcart['quantity'].'","'.$rowcart['sellingprice'].'","'.$totalsgst.'","'.$totalcgst.'","'.$totalgstfinal.'","'.$row['paytype'].'","'.$rowcart['subtotal'].'","'.$row['emailid'].'","'.$row['deliver_phone'].'"'; 
	$fields.="\n"; 
    }
}

header('Content-type: text/csv');

$fileName=date("d-m-Y")."-productwisegst_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>