<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d"); 
 
 $qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);

include "simple_html_dom.php";

	$fields = '"Date","Order Id","Product Value","Shipping Charge","SGST","CGST","IGST","Total Order Value","Email Id","Mobile No."'."\n";			
while($row=mysqli_fetch_array($result))
{
    $subtotal="0"; 
    $sqlcart=mysqli_query($conn,"select * from ".$sufix."basket where bid='".$row['bid']."'  ");
    while($rowcart = mysqli_fetch_array($sqlcart))
    {  
        $subtotal= $rowcart['subtotal'];  
        $sqlpt=mysqli_fetch_array(mysqli_query($conn,"select gst from ".$sufix."product where id='".$rowcart['productid']."'"));
        $tax=$sqlpt['gst'];  
        $gst=$subtotal*$tax/100; 
        $gstvalues122=$gstvalues122+$gst; 
    } 
    $total_gst_value=number_format($gstvalues122,2);  
     
    $total_order_value=$subtotal; 
    $shipcharge=$row['shipcharge']; 
    $bagcost=$row['bagcost']; 
    
    $totalgstfinal=number_format($total_gst_value,2);
    $totalsgst=number_format(($total_gst_value)/2,2);
    $totalcgst=number_format(($total_gst_value)/2,2); 
    
    $finalcost=$total_order_value+$bagcost+$shipcharge;
                                                    
    $productvalue = round($row['totalcost'] - $totalgstfinal);
	$fields .= '"'.$row['orderdate'].'","'.$row['oid'].'","'.$productvalue.'","'.$shipcharge.'","'.$totalsgst.'","'.$totalcgst.'","'.$totalgstfinal.'","'.$row['totalcost'].'","'.$row['emailid'].'","'.$row['deliver_phone'].'"'; 
	$fields.="\n"; 
	
	$total_order_value = 0;    
                                            $total_gst_value=0;
                                            $totalgstfinal=0;
                                            $totalsgst=0;
                                            $totalcgst=0;  
                                             
                                            $gstvalues122=0;
}

header('Content-type: text/csv');

$fileName=date("d-m-Y")."-orderwisegst_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>