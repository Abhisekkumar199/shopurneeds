<meta http-equiv="refresh" content="2" >

<?php 
include("resize-class.php");
define ("MAX_SIZE","3000"); 
ini_set('memory_limit', '156M');
include("sql.php");
$salpr=mysqli_query($conn,"select * from shopurneeds_product where image1!='' and vartype='' order by id desc limit 1 ");
while($rowss=mysqli_fetch_array($salpr))
{
   $sqljjj=mysqli_query($conn,"update shopurneeds_product set displayflag='1',image1='' where id='".$rowss['id']."'");
     $fname=str_replace(" ","%20","https://localhost/project/shopurneeds/downloadimages/".$rowss['image1']);
    $fname=str_replace("%28","(",$fname);
    $fname=str_replace("%29",")",$fname);
      $name12=str_replace("%20","" ,str_replace("?dl=1","",str_replace(" ","",strtolower(end(explode('/',$fname))))));
    $content = file_get_contents($fname);
    $fp = fopen("uploads/productimage/".$name12, "wb");
    fwrite($fp, $content);
    fclose($fp);
		
    $newname="uploads/productimage/".$name12; 
    $newname="uploads/productimage/".$name12; 
    $newname2="uploads/productimage/thumb/".$name12;	
	$newname3="uploads/productimage/small/".$name12;
					 
    $sqljjj=mysqli_query($conn,"insert into shopurneeds_imageupload(pid,productimage,adddate,mainimage,sortid) values ('".$rowss['id']."','".$name12."',NOW(),'1','1')"); 
	list($gotwidth, $gotheight, $gottype, $gotattr)= getimagesize($newname); 	

						

	//---------- To create thumbnail of image---------------

    $array = explode('.', $name12);
    $extension = end($array);
    if($extension=="png")
    {
        $src = imagecreatefrompng($newname);
    }
    else
    {
        $src = imagecreatefromjpeg($newname); 
    } 
    list($width,$height)=getimagesize($newname); 

    if($gotwidth>=277) 
    { 
        //if bigger set it to 124 
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
    //echo "insert into buyde_imageupload(pid,productimage,adddate,mainimage,sortid) values ('".$rowss['id']."','".$name12."',NOW(),'1','1')"; 
}

?>
