<?php 
session_start();
include("includes/chklogin.php");
include("include/configurationadmin.php"); 



$id=$_REQUEST['id'];
$option=$_REQUEST['option'];

$categoryname2=$_REQUEST['name'];

$atr_id=implode(',',$_REQUEST['atr_id']); 
$topcat=$_REQUEST['topcat'];  
$long_description=$_REQUEST['long_description'];  
$metatitle=$_REQUEST['metatitle'];
$metakeyword = $_REQUEST['metakeyword'];
$metadescription=$_REQUEST['metadescription'];
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
		$image_name=$id."_".$filename;		
		$newname="../uploads/categoryimages/".$image_name;		
		$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname);  
		mysqli_query($conn,"update `".$sufix."category` set `uploadimage`='".$image_name."' where cat_id='".$id."'") ;
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  
		$image_name1=$id."_".$filename1;		
		$newname1="../uploads/categoryimages/".$image_name1;		
		$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);	
		mysqli_query($conn,"update `".$sufix."category` set `uploadimage1`='".$image_name1."' where cat_id='".$id."'") ;  
	} 
	 
	  
 
    mysqli_query($conn,"update `".$sufix."category` set `categoryname`='".$categoryname."',`topcat`='".$topcat."',`cat_slug`='".$catslug."',`attribute`='".$atr_id."', `cat_type`='category',`add_user`='".$_SESSION['username']."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `editdate`='".date("Y-m-d")."'   where cat_id='".$id."'") ;
    
    
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
    mysqli_query($conn,"insert into `".$sufix."category` set `parent`='".$parent."',`categoryname`='".$categoryname."',`topcat`='".$topcat."',`cat_slug`='".$catslug."',`attribute`='".$atr_id."',`add_user`='".$_SESSION['username']."',`long_description`='".mysqli_real_escape_string($conn,$long_description)."',`metatitle`='".mysqli_real_escape_string($conn,$metatitle)."',`metakeyword`='".mysqli_real_escape_string($conn,$metakeyword)."',`metadescription`='".mysqli_real_escape_string($conn,$metadescription)."', `displayflag`='".$status."', `adddate`='".date("Y-m-d")."'") ; 
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
		$image_name=$id."_".$filename;		
		$newname="../uploads/categoryimages/".$image_name;		
		$move=move_uploaded_file($_FILES['image']['tmp_name'],$newname); 
		mysqli_query($conn,"update `".$sufix."category` set `uploadimage`='".$image_name."' where cat_id='".$id."'") ;	 
		 	
	}
	
	// uploading thumb
	if($image1) 
 	{ 
 		$filename1 = $_FILES['image1']['name'];  		
	 
		$image_name1=$id."_".$filename1;		
		$newname1="../uploads/categoryimages/".$image_name1;		
		$move=move_uploaded_file($_FILES['image1']['tmp_name'],$newname1);	  
		mysqli_query($conn,"update `".$sufix."category` set `uploadimage1`='".$image_name1."' where cat_id='".$id."'") ; 
		 	
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