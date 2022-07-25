<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
session_start(); 
include("include/configurationadmin.php");   

$date=date("Y-m-d");  
$qidd = $_REQUEST['sql']; 
 
 
$result=mysqli_query($conn,$qidd);
while($row=mysqli_fetch_array($result))
{
    $basketids .= $row['bid'].",";
}
$basketids = substr($basketids,0,-1);
$basketids ="and bid in($basketids)";

include "simple_html_dom.php";

    $fields = '"Product Id","Product Name","Size"'."\n";			
  
    $sqlbasket=mysqli_query($conn,"select * from ".$sufix."basket where id !='' {$basketids} group by productid");
    
 
    while($row_basket=mysqli_fetch_array($sqlbasket))
    {
        $sizes ='';
        $productid = $row_basket['productid']; 
        $sqlprod=mysqli_query($conn,"select * from ".$sufix."basket where id !='' and productid = '".$productid."' {$basketids} ");
        while($row_prod=mysqli_fetch_array($sqlprod))
        {
            $sizes .= $row_prod['size'].",";
        }
        $sizes = substr($sizes,0,-1);
        
    	$fields .= '"'.$row_basket['productid'].'","'.$row_basket['productname'].'","'.$sizes.'"'; 
    	$fields.="\n"; 
    }
  
header('Content-type: text/csv');

$fileName=date("d-m-Y")."-order_report.csv";

header("Content-Disposition: attachment; filename=".$fileName);

echo $fields;

 ?>