<?php 
require_once 'include/DB_Functions.php';
$db = new DB_Functions();   
$date =date("Y-m-d H:i:s"); 
$proid = isset($_REQUEST['proid'])?$_REQUEST['proid']:'';
$sellerid = isset($_REQUEST['sellerid'])?$_REQUEST['sellerid']:'';
$catid = isset($_REQUEST['catid'])?$_REQUEST['catid']:'';
$productName = isset($_REQUEST['productName'])?$_REQUEST['productName']:'';
$searchkeyword = isset($_REQUEST['searchkeyword'])?$_REQUEST['searchkeyword']:'';

$productName = strtolower($productName);
$productslug=str_replace(" ","-",$productslug2);

$sku = isset($_REQUEST['sku'])?$_REQUEST['sku']:'';
$costprice = isset($_REQUEST['sellingprice'])?$_REQUEST['costprice']:'';

$sellingprice = isset($_REQUEST['sellingprice'])?$_REQUEST['sellingprice']:'';
$shortdescription = isset($_REQUEST['shortdescription'])?$_REQUEST['shortdescription']:'';

$productsize = isset($_REQUEST['productsize'])?$_REQUEST['productsize']:'';
if($productsize!= '')
{
    $productsize =  explode(',',$productsize);
}
 
$sizesellingprice = isset($_REQUEST['sizesellingprice'])?$_REQUEST['sizesellingprice']:'';
$sizesellingprice =  explode(',',$sizesellingprice); 

$sizecostprice = isset($_REQUEST['sizecostprice'])?$_REQUEST['sizecostprice']:'';
$sizecostprice =  explode(',',$sizecostprice); 

if($productName != '')
{ 
    if($proid== '')
    {
        // insert product
        $insertProduct = mysql_query("insert into `shopurneeds_product` (`productname`, `shortdescription`,`producttype`,`seller_id`,`suppliername`, `longdescription`, `slug`, `sku`, `barcode`, `cat_id`, `bid`,  `costprice`,`sellingprice`,`mrp`,`regularprice`, `paymentoption`, `stockavailability`, `relatedproducts`, `vartype`,  `adddate`, `displayflag`, `add_user`, `qty`,searchkeyword) values ('".$productName."', '".$shortdescription."','marketplace','".$sellerid."','', '".$shortdescription."', '".$productslug."', '".$sku."', '', '".$catid."', '', '".$costprice."','".$sellingprice."','".$costprice."','".$costprice."', '', '1', '', '', '".date("Y-m-d")."', '1', 'seller', '1','".$searchkeyword."')") or die("record not inserted".mysql_error()); 
    
        $id=mysql_insert_id();
           
           
           
        if($productsize!= '')
        {
            // insert quantity
            for($i=0; $i<count($productsize); $i++)
            { 
                mysql_query("insert into `shopurneeds_product_size` (`product_id`, `product_size`, `qty`, `product_mrp`, `product_sellingprice`, `adddate`, `displayflag`) VALUES ('".$id."', '".$productsize[$i]."','1' ,'".$sizecostprice[$i]."', '".$sizesellingprice[$i]."', '".$date."', '1')"); 
            }
        }
        			$target_dir = "../productimage/";
$issa=1;
        foreach($_FILES['productimage']['name'] as $key=>$val){
            
				$image_name = $_FILES['productimage']['name'][$key];
				$tmp_name   = $_FILES['productimage']['tmp_name'][$key];
				$size       = $_FILES['productimage']['size'][$key];
				$type       = $_FILES['productimage']['type'][$key];
				$error      = $_FILES['productimage']['error'][$key];
				$imageName=strtotime(date("h:i:s")).$image_name;
				$target_file = $target_dir .$imageName;
				$isImageUpload=move_uploaded_file($tmp_name,$target_file);
				if($isImageUpload){
				    if($issa==1) { $mains="1"; } else { $mains="0";}
					$addDocumentRes=mysql_query("insert into shopurneeds_imageupload set pid='".$id."',productimage='".$imageName."',displayflag='1',sortid='".$issa."',mainimage='".$mains."',adddate='".date("Y-m-d H:i:s")."'");
				}
			$issa++;	
			}
        
    }
    else
    {
        // insert product
        $updateProduct = mysql_query("update  `shopurneeds_product` set `productname`='".$productName."', sku='".$sku."', shortdescription='".$shortdescription."',longdescription='".$shortdescription."', `costprice`='".$costprice."',searchkeyword='".$searchkeyword."',`sellingprice`='".$sellingprice."',`mrp`='".$costprice."',`regularprice`='".$costprice."' where id='".$proid."'"); 
    
    if($productsize!= '')
        {
         $sizedel=mysql_query("delete from shopurneeds_product_size where product_id='".$proid."'");   
            for($i=0; $i<count($productsize); $i++)
            { 
                mysql_query("insert into `shopurneeds_product_size` (`product_id`, `product_size`, `qty`, `product_mrp`, `product_sellingprice`, `adddate`, `displayflag`) VALUES ('".$proid."', '".$productsize[$i]."','1' ,'".$sizecostprice[$i]."', '".$sizesellingprice[$i]."', '".$date."', '1')"); 
            }
        }
       
    	$target_dir = "../productimage/";
$issa=1;
        foreach($_FILES['productimage']['name'] as $key=>$val){
            
				$image_name = $_FILES['productimage']['name'][$key];
				$tmp_name   = $_FILES['productimage']['tmp_name'][$key];
				$size       = $_FILES['productimage']['size'][$key];
				$type       = $_FILES['productimage']['type'][$key];
				$error      = $_FILES['productimage']['error'][$key];
				$imageName=strtotime(date("h:i:s")).$image_name;
				$target_file = $target_dir .$imageName;
				$isImageUpload=move_uploaded_file($tmp_name,$target_file);
				if($isImageUpload){
				    if($issa==1) { $mains="1"; } else { $mains="0";}
					$addDocumentRes=mysql_query("insert into shopurneeds_imageupload set pid='".$proid."',productimage='".$imageName."',displayflag='1',sortid='".$issa."',mainimage='".$mains."',adddate='".date("Y-m-d H:i:s")."'");

				}
			$issa++;	
			}
    	
    	
    	
    	
    	
        
       
        
    }
    
    
    if($insertProduct)
    {
        $response["status"] = "200";
        $response["msg"] = "Success"; 
        echo json_encode($response);
    }
    else if($updateProduct) 
    {
        $response["status"] = "200";
        $response["msg"] = "Success"; 
        echo json_encode($response);
    }
    else
    {
        $response["status"] = "400";
        $response["msg"] = "erro"; 
        echo json_encode($response);
    } 
}
else 	
{		
	$response["status"] = "401";		
	$response["msg"] = "Parameter missing!";		
	echo json_encode($response);	
}