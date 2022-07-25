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
$seller_id=$_SESSION['sellerid'];
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
$stockavailability=$_REQUEST['stockavailability']; 
$variant=$_REQUEST['variant'];  
$status = $_REQUEST['status'];  
$gst = $_REQUEST['gst'];  
 
if($variant == "")
{
    $isvariant="0"; 
    $vartype = '';
}
else
{ 
    $isvariant="1";
    $vartype = $variant;
}
if($_REQUEST['sub_category']!="")
{
    $catid1=$_REQUEST['sub_category']; 
}
else
{
    $catid1=$_REQUEST['search_category'];
}

$atr_id=$_REQUEST['atr_id'];  
$atr_val_id=$_REQUEST['atr_val_id']; 

    $rowbrands=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$brand."'"));
    $brandslug=$rowbrands['brandslug'];
    $rand1=rand(100,999);
    $rand2=rand(1000,9999);
    $mastersku="UI".$rand1."".$rand2;
    $masterslug=strtolower(trim($productslug))."-".$mastersku;
    
    mysqli_query($conn,"insert into `".$sufix."product` (`productname`, `longdescription`, `slug`, `sku`,  `cat_id`, `bid`,  `costprice`,`sellingprice`,`mrp`,`regularprice`,  `stockavailability`,`discount_percent`,`discount_value`,`in_stock_qty`,`min_qty`,`max_qty`,`barcode`,`adddate`, `displayflag`, `add_user`, `seller_id`,cod,metatitle,metadescription,metakeyword,color,`vartype`,isvariant,mainpro_id,hsncode,master_sku,gst) values ('".$productname."', '".$longdescription."', '".$masterslug."', '".$sku."','".$catid1."', '".$brand."', '".$costprice."','".$sellingprice."','".$costprice."','".$costprice."','".$stockavailability."','".$discount_percent."','".$discount_value."','".$in_stock_qty."','".$min_qty."','".$max_qty."','".$barcode."','".date("Y-m-d")."', '".$status."', '".$_SESSION['username']."', '".$seller_id."', '".$cod."', '".$metatitle."', '".$metadescription."', '".$metakeyword."', '".$_REQUEST['color']."','".$vartype."','".$isvariant."','','".$hsncode."','".$mastersku."','".$gst."')") ;

	
	$id=mysqli_insert_id($conn);
	$sqlsbcat=mysqli_query($conn,"insert into `".$sufix."product_cat` (`cat_id`,`pid`,`adddate`,displayflag,maincat) values ('".$catid1."','".$id."',NOW(),'1','1')");	
 
	if(!empty(array_filter($_REQUEST['size'])))
	{ 
        for($i=0;$i<count(array_filter($_REQUEST['size'])); $i++)
        {
            if($_POST['size'][$i]!='') 
            { 
              mysqli_query($conn,"insert into ".$sufix."product_size (`product_id`,`product_size`,`product_mrp`,discount_percent,discount_value,`product_sellingprice`,`adddate`,qty,min_stock_qty) values ('".$id."','".$_POST['size'][$i]."','".$_POST['mrp'][$i]."','".$_POST['discount'][$i]."','".$_POST['discount_amount'][$i]."','".$_POST['sale_price'][$i]."',NOW(),'".$_POST['avl_qty'][$i]."','".$_POST['min_stock_qty'][$i]."')");
            }
        }
	}
	else
	{ 
	    mysqli_query($conn,"insert into ".$sufix."product_size (`product_id`,`product_size`,`product_mrp`,discount_percent,discount_value,`product_sellingprice`,`adddate`,qty,min_stock_qty) values ('".$id."','Free Size','".$costprice."','".$discount_percent."','".$discount_value."','".$sellingprice."',NOW(),'".$in_stock_qty."','".$in_stock_qty."')");
            
	} 
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
    
    if($variant == 1)
    {
?>	

    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/add-product-variant.php?id=<?php echo $id; ?>';</script> 
    <?php } else { ?>
    <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/product-image.php?id=<?php echo $id; ?>';</script>  
<?php } ?>