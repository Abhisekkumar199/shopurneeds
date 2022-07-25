<?php  
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$categoryname2=$_REQUEST['name'];

$atr_id=implode(',',$_REQUEST['atr_id']); 
$short_description=$_REQUEST['short_description'];
$long_description=$_REQUEST['long_description']; 
$long_description2=$_REQUEST['long_description2']; 
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$metadescription=$_REQUEST['metadescription'];

$name_in_hebrew=$_REQUEST['name_in_hebrew'];
$short_description_in_hebrew=$_REQUEST['short_description_in_hebrew'];
$long_description_in_hebrew=$_REQUEST['long_description_in_hebrew'];
$long_description2_in_hebrew=$_REQUEST['long_description2_in_hebrew'];
$metatitle_in_hebrew=$_REQUEST['metatitle_in_hebrew'];
$metakeyword_in_hebrew=$_REQUEST['metakeyword_in_hebrew'];
$metadescription_in_hebrew=$_REQUEST['metadescription_in_hebrew'];

$status=$_REQUEST['status']; 
$parent=$_REQUEST['parent']; 

$categoryname=trim($categoryname2);  
$catslug=strtolower(create_slug($categoryname2));
 

$pagename2=create_slug($categoryname); 
$pagename=strtolower($pagename2)."/".$id."/mpage=category";
 
  
define ("MAX_SIZE","3000");  
 $errors=0;
$image=$_FILES['image']['name'];	
$image1=$_FILES['image1']['name'];	 

if($option=="Edit")
{	
	// uploading banner
	if($image) 
 	{ 
 		$filename = $_FILES['image']['name'];  		
		$extension = getExtension($filename);		
 		$extension = strtolower($extension); 	
 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{ 
		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name=$id."_".$filename;		
			$newname="../uploads/categoryimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
		} 	
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image1']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name1=$id."_".$filename1;		
			$newname1="../uploads/categoryimages/".$image_name1;		
			$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);								
		} 	
	}
	 
	 
	if($image!="")
	{
	    $fieldname=$image_name;
	}
	else
	{
	    $fieldname=$_REQUEST['blankimage'];
	}	
	if($image1!="")
	{
	    $fieldname1=$image_name1;
	}
	else
	{
	    $fieldname1=$_REQUEST['blankimage1'];
	}
	 
	
 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"update `".$sufix."category` set `categoryname`='".$categoryname."',`cat_slug`='".$catslug."',`attribute`='".$atr_id."', `uploadimage`='".$fieldname."',`uploadimage1`='".$fieldname1."',`cat_dept`='".$_REQUEST['cat_dept']."', `cat_type`='category',`add_user`='".$_SESSION['username']."',`short_description`='".mysqli_real_escape_string($conn,$short_description)."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`long_description2`='".mysqli_real_escape_string($conn,$long_description2)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."',`name_in_hebrew`='".$name_in_hebrew."',`short_description_in_hebrew`='".$short_description_in_hebrew."',`long_description_in_hebrew`='".$long_description_in_hebrew."',`long_description2_in_hebrew`='".$long_description2_in_hebrew."',`metatitle_in_hebrew`='".$metatitle_in_hebrew."',`metakeyword_in_hebrew`='".$metakeyword_in_hebrew."',`metadescription_in_hebrew`='".$metadescription_in_hebrew."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where cat_id='".$id."'") ;
    
    $rowcatparent=mysqli_fetch_array(mysqli_query($conn,"select * from `".$sufix."category` where cat_id='".$id."'"));
    if($rowcatparent['parent']!='0')
    {
        $rowcatparent12=mysqli_fetch_array(mysqli_query($conn,"select cat_slug from `".$sufix."category` where cat_id='".$rowcatparent['parent']."'"));
        $catslugginel=$rowcatparent12['cat_slug']."-".$catslug;
        $update=mysqli_query($conn,"update `".$sufix."category` set cat_slug='".$catslugginel."' where cat_id='".$id."'");
    } 
}
else
{  
    
 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
    mysqli_query($conn,"insert into `".$sufix."category` set `parent`='".$parent."',`categoryname`='".$categoryname."',`cat_slug`='".$catslug."',`attribute`='".$atr_id."',`cat_dept`='".$_REQUEST['cat_dept']."', `cat_type`='category',`add_user`='".$_SESSION['username']."',`short_description`='".mysqli_real_escape_string($conn,$short_description)."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`long_description2`='".mysqli_real_escape_string($conn,$long_description2)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."',`name_in_hebrew`='".$name_in_hebrew."',`short_description_in_hebrew`='".$short_description_in_hebrew."',`long_description_in_hebrew`='".$long_description_in_hebrew."',`long_description2_in_hebrew`='".$long_description2_in_hebrew."',`metatitle_in_hebrew`='".$metatitle_in_hebrew."',`metakeyword_in_hebrew`='".$metakeyword_in_hebrew."',`metadescription_in_hebrew`='".$metadescription_in_hebrew."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
    $id=mysqli_insert_id($conn);
    $rowcatparent=mysqli_fetch_array(mysqli_query($conn,"select * from `".$sufix."category` where cat_id='".$id."'"));
    if($rowcatparent['parent']!='0')
    {
        $rowcatparent12=mysqli_fetch_array(mysqli_query($conn,"select cat_slug from `".$sufix."category` where cat_id='".$rowcatparent['parent']."'"));
        $catslugginel=$rowcatparent12['cat_slug']."-".$catslug;
        $update=mysqli_query($conn,"update `".$sufix."category` set cat_slug='".$catslugginel."' where cat_id='".$id."'");
    }
	
	// uploading banner 
	if($image) 
 	{ 
 		$filename = $_FILES['image']['name'];  		
		$extension = getExtension($filename);		
 		$extension = strtolower($extension); 	
 		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 		{ 
		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
 		} 
 		else
 		{
		    $size=filesize($_FILES['image']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
			$image_name=$id."_".$filename;		
			$newname="../uploads/categoryimages/".$image_name;		
			$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
			mysqli_query($conn,"update `".$sufix."category` set `uploadimage`='".$image_name."' where cat_id='".$id."'") ;	 
		} 	
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  		
		$extension1 = getExtension($filename1);		
 		$extension1 = strtolower($extension1); 	
 		if (($extension1 != "jpg") && ($extension1 != "jpeg") && ($extension1 != "png") && ($extension1 != "gif")) 
 		{ 
 		    $_SESSION['message']="<div class='alert alert-danger' role='alert'>Invalid File Extension!</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php  
 		} 
 		else
 		{
		    $size=filesize($_FILES['image1']['tmp_name']); 
			if ($size > MAX_SIZE*1024)
			{ 
			    $_SESSION['message']="<div class='alert alert-danger' role='alert'>You have exceeded the size limit</div>";
		    ?>
			    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/add-category.php?id=<?php echo $id; ?>&option=Edit';</script>
		    <?php 
			}
	
			$image_name1=$id."_".$filename1;		
			$newname1="../uploads/categoryimages/".$image_name1;		
			$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);	  
			mysqli_query($conn,"update `".$sufix."category` set `uploadimage1`='".$image_name1."' where cat_id='".$id."'") ; 
		} 	
	} 
} 
if($option=="Edit")
{ 
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Category has been updated</div>";
    ?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/category-list.php?catid=<?php echo $parent; ?>';</script>  
<?php } else {  
    $_SESSION['message']="<div class='alert alert-success' role='alert'>Category has been inserted</div>";
?>
    <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/category-list.php?catid=<?php echo $parent; ?>';</script>  
<?php } ?>	