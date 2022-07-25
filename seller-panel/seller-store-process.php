<?php  
header('Content-Type: text/html; charset=utf-8');
session_start(); 
include("include/configurationadmin.php");  

$id=$_REQUEST['id'];
$option=$_REQUEST['option']; 
$showroom_name=$_REQUEST['showroom_name'];  
$emailid=$_REQUEST['emailid'];
$facebookurl=$_REQUEST['facebookurl'];
$twitterurl=$_REQUEST['twitterurl']; 
$instagramurl=$_REQUEST['instagramurl']; 
$flipkarturl=$_REQUEST['flipkarturl']; 
$amazonurl=$_REQUEST['amazonurl']; 
$myntraurl=$_REQUEST['myntraurl']; 
$shopcluesurl=$_REQUEST['shopcluesurl'];
$ebayurl = $_REQUEST['ebayurl'];
$aboutus=$_REQUEST['aboutus']; 
$shipping=$_REQUEST['shipping']; 
$customerservice=$_REQUEST['customerservice'];
$returns=$_REQUEST['returns'];
 
define ("MAX_SIZE","3000"); 
   
 $errors=0;
$banner1=$_FILES['banner1']['name'];	 
$banner2=$_FILES['banner2']['name'];
$banner3=$_FILES['banner3']['name'];	  	 

 mysqli_query($conn,"SET NAMES 'utf8'"); 
mysqli_query($conn,'SET CHARACTER SET utf8');
 	
	// uploading banner 1
	if($banner1) 
 	{ 
 		$filename = $_FILES['banner1']['name'];  
		$banner1_name=$id."_".$filename;		
		$newname="../uploads/sellerimages/".$banner1_name;		
		$move=move_uploaded_file($_FILES['banner1']['tmp_name'],$newname); 
		
		 mysqli_query($conn,"update `".$sufix."suppliers` set `banner1`='".$banner1_name."' where id='".$id."'") ;
	 	
	}
	
	// uploading banner 2
	if($banner2) 
 	{ 
 		$filename = $_FILES['banner2']['name'];  
		$banner2_name=$id."_".$filename;		
		$newname="../uploads/sellerimages/".$banner2_name;		
		$move=move_uploaded_file($_FILES['banner2']['tmp_name'],$newname);  
		mysqli_query($conn,"update `".$sufix."suppliers` set `banner2`='".$banner2_name."' where id='".$id."'") ;
	}
	
	// uploading banner 3
	if($banner3) 
 	{ 
 		$filename = $_FILES['banner3']['name'];  
		$banner3_name=$id."_".$filename;		
		$newname="../uploads/sellerimages/".$banner3_name;		
		$move=move_uploaded_file($_FILES['banner3']['tmp_name'],$newname);  
		
		mysqli_query($conn,"update `".$sufix."suppliers` set `banner3`='".$banner3_name."' where id='".$id."'") ;
	}
   
    mysqli_query($conn,"update `".$sufix."suppliers` set `showroom_name`='".$showroom_name."', `facebookurl`='".$facebookurl."', `twitterurl`='".$twitterurl."', `instagramurl`='".$instagramurl."', `pinteresturl`='".$pinteresturl."', `flipkarturl`='".$flipkarturl."', `amazonurl`='".$amazonurl."', `myntraurl`='".$myntraurl."', `shopcluesurl`='".$shopcluesurl."', `ebayurl`='".$ebayurl."',`aboutus`='".mysqli_real_escape_string($conn,$aboutus)."',`shipping`='".mysqli_real_escape_string($conn,$shipping)."',`customerservice`='".mysqli_real_escape_string($conn,$customerservice)."',`returns`='".mysqli_real_escape_string($conn,$returns)."' where id='".$id."'") ; 
 
?>	

<script>window.location.href='https://localhost/project/shopurneeds/seller-panel/seller-store-page';</script>  