<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php");  
 
$option=$_REQUEST['option']; 
$id=$_REQUEST['id'];
 

for($i=0;$i<=count($_FILES['image']['name']);$i++)
{
    $errors=0; 	
    $image=$_FILES['image']['name'][$i]; 
    if($image) 
    { 	
    	$filename = $_FILES['image']['name'][$i];
    	$extension = getExtension($filename);		
    	$extension = strtolower($extension);  
	
		$image_name=$filename;		
		$newname="../uploads/productimage/".$image_name;
		$newname2="../uploads/productimage/thumb/".$image_name;	
		$newname3="../uploads/productimage/small/".$image_name;				
		$move=move_uploaded_file($_FILES['image']['tmp_name'][$i],$newname);
		
		list($gotwidth, $gotheight, $gottype, $gotattr)= getimagesize($newname); 	
			
            //---------- To create thumbnail of image---------------
			if($extension=="jpg" || $extension=="jpeg" )
			{
			    $src = imagecreatefromjpeg($newname);
			}
			else if($extension=="png")
			{
			    $src = imagecreatefrompng($newname);
			}
			else
			{
			    $src = imagecreatefromgif($newname);
			} 
			list($width,$height)=getimagesize($newname); 
			if($gotwidth>=277)
			{ 				
			    $newwidth=277;
				$newwidth2=120;
			} 	
			else
			{
				//if small let it be original
				$newwidth=$gotwidth;
			}
			//Find the new height
			$newheight=round(($gotheight*$newwidth)/$gotwidth);
			$newheight2=round(($gotheight*$newwidth2)/$gotwidth);
			//Creating thumbnail
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			$tmp2=imagecreatetruecolor($newwidth2,$newheight2);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight, $width,$height);
			imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2, $width,$height);
			//Create thumbnail image
			$createImageSave=imagejpeg($tmp,$newname2,277);
			$createImageSave2=imagejpeg($tmp2,$newname3,135);
	 			
		$fieldname=$image_name;
	
        mysqli_query($conn,"insert into `".$sufix."imageupload` (`productname`, `pid`, `varpid`, `productimage`, `description`, `adddate`) values ('', '".$id."', '', '".$fieldname."', '', '".date("Y-m-d")."')");
        if($i==0)
        {
        $imageid=mysqli_insert_id($conn);
        
        mysqli_query($conn,"update `".$sufix."imageupload` set `mainimage` = '1',sortid='1' where `id` ='".$imageid."'");
        } 
	}
		
}
 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/admin-panel/product-image.php?id=<?php echo $id; ?>';</script>  