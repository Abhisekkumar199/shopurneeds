<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$productname=$_REQUEST['productname']; 
$productname=str_replace("'","`","$productname");
$productslug2=create_slug($productname);
$productslug=strtolower($productslug2); 
$sku=$_REQUEST['sku'];
$barcode = $_REQUEST['barcode'];
$hsncode=$_REQUEST['hsncode'];
$seller_id=$_REQUEST['seller_id'];
$brand=$_REQUEST['brand'];  
$costprice=$_REQUEST['costprice'];  
$discount_percent=$_REQUEST['discount_percent'];  
$discount_value=$_REQUEST['discount_value'];  
$sellingprice=$_REQUEST['sellingprice'];    
$in_stock_qty=$_REQUEST['in_stock_qty'];  
$min_qty=$_REQUEST['min_qty'];  
$max_qty=$_REQUEST['max_qty'];  

$metatitle=mysqli_real_escape_string($conn,$_REQUEST['metatitle']);  
$metadescription=mysqli_real_escape_string($conn,$_REQUEST['metadescription']); 
$metakeyword=mysqli_real_escape_string($conn,$_REQUEST['metakeyword']);       
$longdescription=mysqli_real_escape_string($conn,$_REQUEST['longdescription']);  
$cod=$_REQUEST['cod'];    
$gst=$_REQUEST['gst'];    

$stockavailability=$_REQUEST['stockavailability']; 
$variant=$_REQUEST['variant'];   
 
$status = $_REQUEST['status']; 
 
if($variant!="")
{
    $isvariant="1";
    $vartype = '';
}
else
{
    $isvariant="0"; 
    $vartype = '';
}
 
    $rowbrands=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$brand."'"));
    $brandslug=$rowbrands['brandslug'];
    $rand1=rand(100,999);
    $rand2=rand(1000,9999);
    $mastersku="UI".$rand1."".$rand2;
    $masterslug=strtolower(trim($productslug))."-".$mastersku;

	mysqli_query($conn,"update `".$sufix."product` set `productname`='".$productname."', `longdescription`='".$longdescription."', `other_information`='".$other_information."',`slug`='".$masterslug."',`sku`='".$sku."', `bid`='".$brand."',  `costprice`='".$costprice."',`sellingprice`='".$sellingprice."',`mrp`='".$costprice."',`regularprice`='".$costprice."',`stockavailability`='".$stockavailability."',`discount_percent`='".$discount_percent."',`discount_value`='".$discount_value."',`in_stock_qty`='".$in_stock_qty."',`min_qty`='".$min_qty."',`max_qty`='".$max_qty."',`barcode`='".$barcode."',`editdate`='".date("Y-m-d")."', `displayflag`='".$status."',`seller_id`='".$seller_id."',cod='".$cod."',metatitle='".$metatitle."',metadescription='".$metadescription."',metakeyword='".$metakeyword."' ,`vartype`='".$vartype."',isvariant='".$isvariant."',hsncode='".$hsncode."',gst='".$gst."' where id='".$id."' ");
	
 mysqli_query($conn,"delete from ".$sufix."product_size where product_id='".$id."'"); 
for($i=0;$i<count($_REQUEST['size']); $i++)
{
    if($_POST['size'][$i]!='') 
    { 
        $diamondsql = mysqli_query($conn,"insert into ".$sufix."product_size (`product_id`,`product_size`,`product_mrp`,discount_percent,discount_value,`product_sellingprice`,`adddate`,qty,min_stock_qty) values ('".$id."','".$_POST['size'][$i]."','".$_POST['mrp'][$i]."','".$_POST['discount'][$i]."','".$_POST['discount_amount'][$i]."','".$_POST['sale_price'][$i]."',NOW(),'".$_POST['avl_qty'][$i]."','".$_POST['min_stock_qty'][$i]."')");
    }
}


$atr_id=$_REQUEST['atr_id'];  
mysqli_query($conn,"delete from ".$sufix."product_attribute where pid='".$id."'"); 
for($i=0; $i<=count($atr_id); $i++)
{
	$atr_val_string_name = $atr_id[$i]."_atr_val_id";
	
	$atr_val_id = $_REQUEST[$atr_val_string_name];
	for($j=0; $j<=count($atr_val_id); $j++)
	{  
		if($atr_val_id[$j] > 0)
		{
			mysqli_query($conn,"insert into `".$sufix."product_attribute` (pid,atr_id,atr_val_id) values ('".$id."', '".$atr_id[$i]."', '".$atr_val_id[$j]."')");  
		}
	}		
}
 
  
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/product-image.php?id=<?php echo $id; ?>';</script>  