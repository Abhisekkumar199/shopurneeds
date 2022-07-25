<?php  
include("includes/chklogin.php");
include("include/configurationadmin.php");  
$cat_id=$_REQUEST['cat_id'];
$atr_id = $_REQUEST['atr_id'];
$atr_val_id = $_REQUEST['atr_val_id'];
$brand_id = $_REQUEST['brand_id'];
$product_id = $_REQUEST['product_id'];
$color_id = $_REQUEST['color_id'];
$flavour_id = $_REQUEST['flavour_id'];

// deleting category
if(sizeof($product_id) > 0)
{
    for($i=0; $i<sizeof($product_id); $i++)
    {
    	if($product_id[$i])
    	{ 
    	    
    	    $sql_product_images = mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$product_id[$i]."'");
    	    while($rows_image = mysqli_fetch_assoc($sql_product_images))
    	    {
	            $file = "../uploads/productimage/".$rows_image['productimage']; 
                $file1 = "../uploads/productimage/thumb/".$rows_image['productimage']; 
                $file2 = "../uploads/productimage/small/".$rows_image['productimage'];
                unlink($file);
                unlink($file1);
                unlink($file2);
    	    } 
    		mysqli_query($conn,"delete from `".$sufix."imageupload`  where `pid` ='$product_id[$i]'");
    		mysqli_query($conn,"delete from `".$sufix."product_cat`  where `pid` ='$product_id[$i]'");
    		mysqli_query($conn,"delete from `".$sufix."product_size`  where `product_id` ='$product_id[$i]'");
    		mysqli_query($conn,"delete from `".$sufix."product_attribute`  where `pid` ='$product_id[$i]'");
    		mysqli_query($conn,"delete from `".$sufix."product`  where `id` ='$product_id[$i]'");
    		
    	}	
    }
    
	$_SESSION['sessionMsg']="Categories has been deleted"; 
}

// deleting category
if(sizeof($cat_id) > 0)
{
    for($i=0; $i<sizeof($cat_id); $i++)
    {
    	if($cat_id[$i])
    	{ 
    	    
    	    $sql_cat = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$cat_id[$i]."'")) ;
        
            if($sql_cat['uploadimage1']!='') 
            {
                $file = "../uploads/categoryimages/".$sql_cat['uploadimage1']; 
                unlink($file); 
            }
            if($sql_cat['uploadimage']!='') 
            {
                $file = "../uploads/categoryimages/".$sql_cat['uploadimage']; 
                unlink($file);  
            } 
    		mysqli_query($conn,"delete from `".$sufix."category`  where `cat_id` ='$cat_id[$i]'");
    	}	
    }
    
	$_SESSION['sessionMsg']="Categories has been deleted"; 
}

// deleting attributes
if(sizeof($atr_id) > 0)
{
    for($i=0; $i<sizeof($atr_id); $i++)
    {
    	if($atr_id[$i])
    	{   
    		mysqli_query($conn,"delete from `".$sufix."attributes`  where `atr_id` ='$atr_id[$i]'");
    	}	
    } 
	$_SESSION['sessionMsg']="Record has been deleted"; 
}

// deleting attributes value
if(sizeof($atr_val_id) > 0)
{
    for($i=0; $i<sizeof($atr_val_id); $i++)
    {
    	if($atr_val_id[$i])
    	{   
    		mysqli_query($conn,"delete from `".$sufix."attributevalue`  where `atr_val_id` ='$atr_val_id[$i]'");
    	}	
    }
    
	$_SESSION['sessionMsg']="Record has been deleted"; 
}

// deleting brands
if(sizeof($brand_id) > 0)
{
    for($i=0; $i<sizeof($brand_id); $i++)
    {
    	if($brand_id[$i])
    	{ 
    	    
    	    $sql_brand = mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."brand where bid='".$brand_id[$i]."'")) ;
        
            if($sql_brand['uploadimage1']!='') 
            {
                $file = "../uploads/brandimages/".$sql_brand['uploadimage1']; 
                unlink($file); 
            }
            if($sql_brand['uploadimage']!='') 
            {
                $file = "../uploads/brandimages/".$sql_brand['uploadimage']; 
                unlink($file); 
            }
            
    		mysqli_query($conn,"delete from `".$sufix."brand`  where `bid` ='$brand_id[$i]'");
    	}	
    }
    
	$_SESSION['sessionMsg']="Records has been deleted"; 
}


// deleting attributes value
if(sizeof($color_id) > 0)
{
    for($i=0; $i<sizeof($color_id); $i++)
    {
    	if($color_id[$i])
    	{   
    		mysqli_query($conn,"delete from `".$sufix."color_code`  where `id` ='$color_id[$i]'");
    	}	
    }
    
	$_SESSION['sessionMsg']="Record has been deleted"; 
}

// deleting flavour value
if(sizeof($flavour_id) > 0)
{
    for($i=0; $i<sizeof($flavour_id); $i++)
    {
    	if($flavour_id[$i])
    	{   
    		mysqli_query($conn,"delete from `".$sufix."flavour`  where `id` ='$flavour_id[$i]'");
    	}	
    } 
	$_SESSION['sessionMsg']="Record has been deleted"; 
}
?>
<script>window.location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script> 

 