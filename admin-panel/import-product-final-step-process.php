<?php
include("include/configurationadmin.php");  
 
$salpr=mysqli_query($conn,"select * from ".$sufix."product_dummy where insertid='".$_REQUEST['insertid']."' and sku !='' group by sku ");
while($rowpr=mysqli_fetch_array($salpr))
{
    
    $rowbrands=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$rowpr['brand_name']."'"));
    $brandslug=$rowbrands['brandslug'];
    $productname1=$rowpr['product_title'];
    $productname=str_replace("'","`","$productname1");
    $productslug2=create_slug($productname);
    $productslug=strtolower($productslug2);
    $rand1=rand(100,999);
    $rand2=rand(1000,9999);
    $mastersku="UI".$rand1."".$rand2;
    $masterslug=strtolower(trim($productslug))."-".$mastersku;
    
	$sssscccstore=mysqli_query($conn,"INSERT into `".$sufix."product` (`productname`,  `shortdescription`, `producttype`,`seller_id`, `longdescription`, `slug`, `sku`,  `cat_id`, `bid`,  `sellingprice`,`costprice`,`mrp`,`regularprice`, `stockavailability`, `adddate`, `displayflag`, `add_user`, `qty`, `delivertime`,color,size,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,attribute1,attribute2,attribute3,attribute4,attribute5,attribute6,attribute7,attribute8,attribute9,attribute10,videourl,gst,measurements,composition,metatitle,metadescription,metakeyword,searchkeyword,cod,vendorcode,vartype,wash_care,product_warranty,material,hsncode,master_sku,bundle_total_unit,bundle_price) values ('".mysqli_real_escape_string($conn,$rowpr['product_title'])."', '".mysqli_real_escape_string($conn,$rowpr['short_description'])."', 'marketplace','".$rowpr['vendor_id']."', '".mysqli_real_escape_string($conn,$rowpr['long_description'])."', '".$masterslug."', '".$rowpr['sku']."',  '".$rowpr['maincategory_id']."',  '".$rowpr['brand_name']."', '".$rowpr['price']."','".$rowpr['mrp']."','".$rowpr['mrp']."','".$rowpr['mrp']."','".$rowpr['is_in_stock']."', '".date("Y-m-d")."', '".$rowpr['status']."', '".$_SESSION['username']."', '".$rowpr['qty']."', '".$rowpr['sla']."','".$rowpr['colour_code']."','".$rowpr['size']."','".$rowpr['images1']."','".$rowpr['images2']."','".$rowpr['images3']."','".$rowpr['images4']."','".$rowpr['images5']."','".$rowpr['images6']."','".$rowpr['images7']."','".$rowpr['images8']."','".$rowpr['images9']."','".$rowpr['images10']."','".$rowpr['attribute1']."','".$rowpr['attribute2']."','".$rowpr['attribute3']."','".$rowpr['attribute4']."','".$rowpr['attribute5']."','".$rowpr['attribute6']."','".$rowpr['attribute7']."','".$rowpr['attribute8']."','".$rowpr['attribute9']."','".$rowpr['attribute10']."','".$rowpr['videourl']."','".$rowpr['gst']."','".$rowpr['measurements']."','".$rowpr['composition']."','".$rowpr['meta_title']."','".$rowpr['meta_description']."','".$rowpr['meta_keyword']."','".mysqli_real_escape_string($conn,$rowpr['searchkeyword'])."','".$rowpr['cod']."','".$rowpr['vendor_code']."','1','".$rowpr['wash_care']."','".$rowpr['product_warranty']."','".$rowpr['material']."','".$rowpr['hsn_code']."','".$mastersku."','".$rowpr['bundle_total_unit']."','".$rowpr['bundle_price']."')");
	
	$lastids=mysqli_insert_id($conn);
	if($lastids>0) 
	{  
	    if($rowpr['maincategory_id'] > 0)
	    {
	    
		$sqlsbcat=mysqli_query($conn,"insert into `".$sufix."product_cat` (`cat_id`,`pid`,`adddate`,displayflag,maincat) values ('".$rowpr['maincategory_id']."','".$lastids."',NOW(),'1','1')");	 
	    }    
	    if($rowpr['category_ids'] != '')
	    {
    	$catiss=$rowpr['category_ids'];
    	$catiss12=explode("-",$catiss);
    	
    	for($i=0;$i<count($catiss12);$i++)
    	{
    	    $sqlsbcat=mysqli_query($conn,"insert into `".$sufix."product_cat` (`cat_id`,`pid`,`adddate`,displayflag,maincat) values ('".$catiss12[$i]."','".$lastids."',NOW(),'1','0')");	 
        } 
	    }
	} 
    //$dhfmas=mysqli_query($conn,"update `".$sufix."product_dummy` set pro_id='$lastids' where sku='".$rowpr['sku']."'"); 
}
  
$salpr=mysqli_query($conn,"select * from ".$sufix."product_dummy where insertid='".$_REQUEST['insertid']."' group by vendor_code ");
while($rowpr=mysqli_fetch_array($salpr))
{
    
    $rowbrands=mysqli_fetch_array(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$rowpr['brand_name']."'"));
    $brandslug=$rowbrands['brandslug'];
    $productname1=$rowpr['product_title'];
    $productname=str_replace("'","`","$productname1");
    $productslug2=create_slug($productname);
    $productslug=strtolower($productslug2);
    $rand1=rand(100,999);
    $rand2=rand(1000,9999);
    $mastersku="UI".$rand1."".$rand2;
    $randli=rand(50,1000);

    $masterslug=strtolower(trim($productslug))."-".$mastersku;
    if($rowpr['pro_id']!='0')
    {
        $isvariant='1';
    }
    else
    {
        $isvariant='0'; 
    }
    
    
	$sssscccstore=mysqli_query($conn,"INSERT into `".$sufix."product` (`productname`,  `shortdescription`, `producttype`,`seller_id`, `longdescription`, `slug`, `sku`,  `cat_id`, `bid`,  `sellingprice`,`costprice`,`mrp`,`regularprice`, `stockavailability`, `adddate`, `displayflag`, `add_user`, `qty`, `delivertime`,color,size,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,attribute1,attribute2,attribute3,attribute4,attribute5,attribute6,attribute7,attribute8,attribute9,attribute10,videourl,gst,measurements,composition,metatitle,metadescription,metakeyword,searchkeyword,cod,vendorcode,mainpro_id,isvariant,wash_care,product_warranty,material,master_sku,hsncode,like_count,bundle_total_unit,bundle_price) values ('".mysqli_real_escape_string($conn,$rowpr['product_title'])."', '".mysqli_real_escape_string($conn,$rowpr['short_description'])."', 'marketplace','".$rowpr['vendor_id']."', '".mysqli_real_escape_string($conn,$rowpr['long_description'])."', '".$masterslug."', '".$rowpr['vendor_code']."',  '".$rowpr['maincategory_id']."',  '".$rowpr['brand_name']."', '".$rowpr['price']."','".$rowpr['mrp']."','".$rowpr['mrp']."','".$rowpr['mrp']."','".$rowpr['is_in_stock']."', '".date("Y-m-d")."', '".$rowpr['status']."', '".$_SESSION['username']."', '".$rowpr['qty']."', '".$rowpr['sla']."','".$rowpr['colour_code']."','".$rowpr['size']."','".$rowpr['images1']."','".$rowpr['images2']."','".$rowpr['images3']."','".$rowpr['images4']."','".$rowpr['images5']."','".$rowpr['images6']."','".$rowpr['images7']."','".$rowpr['images8']."','".$rowpr['images9']."','".$rowpr['images10']."','".$rowpr['attribute1']."','".$rowpr['attribute2']."','".$rowpr['attribute3']."','".$rowpr['attribute4']."','".$rowpr['attribute5']."','".$rowpr['attribute6']."','".$rowpr['attribute7']."','".$rowpr['attribute8']."','".$rowpr['attribute9']."','".$rowpr['attribute10']."','".$rowpr['videourl']."','".$rowpr['gst']."','".$rowpr['measurements']."','".$rowpr['composition']."','".$rowpr['meta_title']."','".$rowpr['meta_description']."','".$rowpr['meta_keyword']."','".mysqli_real_escape_string($conn,$rowpr['searchkeyword'])."','".$rowpr['cod']."','".$rowpr['vendor_code']."','".$rowpr['pro_id']."','".$isvariant."','".$rowpr['wash_care']."','".$rowpr['product_warranty']."','".$rowpr['material']."','".$mastersku."','".$rowpr['hsn_code']."','".$randli."','".$rowpr['bundle_total_unit']."','".$rowpr['bundle_price']."')");
	$lastids=mysqli_insert_id($conn);
	if($lastids>0) 
	{  
	    if($rowpr['maincategory_id'] > 0)
	    {
	     $sqlsbcat=mysqli_query($conn,"insert into `".$sufix."product_cat` (`cat_id`,`pid`,`adddate`,displayflag,maincat) values ('".$rowpr['maincategory_id']."','".$lastids."',NOW(),'1','1')");								
   
	    }
		
		if($rowpr['category_ids'] != '')
	    {
    	$catiss=$rowpr['category_ids'];
    	$catiss12=explode("-",$catiss);
    	for($i=0;$i<count($catiss12);$i++)
    	{
    	    $sqlsbcat=mysqli_query($conn,"insert into `".$sufix."product_cat` (`cat_id`,`pid`,`adddate`,displayflag,maincat) values ('".$catiss12[$i]."','".$lastids."',NOW(),'1','0')");								
        }
	    }
        
	    $sqlqqzise=mysqli_query($conn,"select * from ".$sufix."product_dummy where insertid='".$_REQUEST['insertid']."'and vendor_code='".$rowpr['vendor_code']."'");
    	while($rowsize=mysqli_fetch_array($sqlqqzise))
    	{
           
    		$diamondsql = mysqli_query($conn,"insert into ".$sufix."product_size (`product_id`,`product_size`,`product_mrp`,`product_sellingprice`,`adddate`,qty) values ('".$lastids."','".$rowsize['size']."','".$rowsize['mrp']."','".$rowsize['price']."',NOW(),'".$rowsize['qty']."')");
        }
	}
}

$salpr=mysqli_query($conn,"delete from  ".$sufix."product_dummy where insertid='".$_REQUEST['insertid']."'");

$_SESSION['sessionMsg']="Products have been inserted";
?>
 <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/import-product';</script>  
<?php 
?>