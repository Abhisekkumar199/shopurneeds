<?php     
session_start();
include("includes/configuration.php"); 	
include("includes/currency_display.php");	

$catid=explode("/",$_REQUEST['catid']);		
$mystring = $_REQUEST['catid'];
$findme   = 'product-detail';
$pos = strpos($mystring, $findme);
$pcheck= end($catid);
$sitename = '';
$desc = '';
$keys = '';

$sqlulrcheck=mysqli_query($conn,"select * from ".$sufix."seo_url where `from`='$pcheck' and displayflag='1'");
$numurlcheck1=mysqli_num_rows($sqlulrcheck);

if($numurlcheck1>"0")
{ 
    $urlrows = mysqli_fetch_assoc($sqlulrcheck);
    ?>
    <script>window.location.href='<?php echo $urlrows['to'];?>'</script>
    <?php
    exit();
} 

// product detail page
$sqlpcheck=mysqli_query($conn,"select * from ".$sufix."product where slug='$pcheck'");
$numpcheck=mysqli_num_rows($sqlpcheck);
if($numpcheck>"0")
{
    $sqlpids=mysqli_query($conn,"select * from ".$sufix."product where slug='$pcheck'");
    $rowproid=mysqli_fetch_assoc($sqlpids);
    $pid = $rowproid['id'];
    $sqlimage12=mysqli_query($conn,"select productimage from ".$sufix."imageupload where displayflag='1' and pid='".$pid."' order by mainimage desc limit 1");
    $imagenamemeta111=mysqli_fetch_assoc($sqlimage12);
	$imagenamemeta = $imagenamemeta111['productimage'];
    $ogtitle=$rowproid['productname'];
    $ogurl="https://localhost/project/shopurneeds/".$pcheck;
    $ogimg="https://localhost/project/shopurneeds/uploads/productimage/thumb/".$imagenamemeta;
    $sitename=$rowproid['productname']." - Buy ".$rowproid['productname']." on shopurneeds.com";
    $desc = $rowproid['productname']." - Buy ".$rowproid['productname']." on shopurneeds.com";
    $keys = $rowproid['searchkeyword'];
    $canonical = $pcheck;
    include("includes/header_product.php");	//
    include("pages/productdetails.inc.php");
    include("includes/footer_product.php");
    exit();
}


// category page
$sqlpcheck=mysqli_query($conn,"select * from ".$sufix."category where cat_slug='$pcheck'"); 
$numpcheck1=mysqli_num_rows($sqlpcheck); 
if($numpcheck1>"0") 
{ 
    $sqlpids=mysqli_query($conn,"select * from ".$sufix."category where cat_slug='$pcheck'"); 
    $rowcatid=mysqli_fetch_assoc($sqlpids); 
    $cat_id = $rowcatid['cat_id']; 
    $promotionIdfcat = $rowcatid['promotionId']; 

    $sitename=str_replace("-"," ",$rowcatid['categoryname'])." on shopurneeds.com"; 
    $desc = str_replace("-"," ",$rowcatid['categoryname'])." on shopurneeds.com"; 
    $keys = str_replace("-"," ",$rowcatid['categoryname'])." on shopurneeds.com"; 
    $conversion_script1 = $rowcatid['categoryname']; 
    $conversion_script2 = $rowcatid['categoryname']; 
    $title = $rowcatid['categoryname']; 
    $canonical = $pcheck; 
    include("includes/header_cat.php");	// 
    include("pages/category.inc.php");  
    include("includes/footer_cat.php");	// 
    exit(); 
}


// brand page
$sqlpcheck=mysqli_query($conn,"select * from ".$sufix."brand where brandslug='$pcheck'"); 
$numpcheck1=mysqli_num_rows($sqlpcheck); 
if($numpcheck1>"0") 
{ 
    $sqlpids=mysqli_query($conn,"select * from ".$sufix."brand where brandslug='$pcheck'"); 
    $bidrow=mysqli_fetch_array($sqlpids); 
    $bid=$bidrow['bid']; 
    $sitename=$bidrow['metatitle'];
    $desc = $bidrow['metadescription'];
    $keys = $bidrow['metakeyword']; 
    
    $canonical = $pcheck; 
    include("includes/header_cat.php");  
    include("pages/brand.inc.php");  
    include("includes/footer_cat.php");	
    exit(); 
}


// seller page
$sql=mysqli_query($conn,"select * from ".$sufix."suppliers where seller_slug='$mystring'"); 
$num12=mysqli_num_rows($sql); 
if($num12>"0") 
{ 
    $sqlseller=mysqli_query($conn,"select * from ".$sufix."suppliers where seller_slug='$mystring'"); 
    $rowse=mysqli_fetch_array($sqlseller); 
    $ogtitle=$rowse['metatitle']; 
    $seller_id=$rowse['id']; 
    $ogurl="https://localhost/project/shopurneeds/".$rowse['seller_slug']; 
    $ogimg="https://localhost/project/shopurneeds/showroomimages/".$rowse['uploadimage']; 
    $sitename=strip_tags($rowse['metatitle']); 
    $keys=strip_tags($rowse['metakeyword']); 
    $desc=strip_tags($rowse['metadescription']); 
    $canonical = $mystring;
    include("includes/header_cat.php");	 
    include("pages/seller.inc.php");  
    include("includes/footer_cat.php");	
    exit; 
}

$salstatci=mysqli_query($conn,"select * from shopurneeds_static_pages where link_name='".$pcheck."'"); 
if(mysqli_num_rows($salstatci)>0) 
{  
    $rowstatic=mysqli_fetch_array($salstatci); 
    $sitename=strip_tags($rowstatic['metatitle']); 
    $keys=strip_tags($rowstatic['metakeyword']); 
    $desc=strip_tags($rowstatic['metadescription']); 
    $description=$rowstatic['description']; 
    $heading = $rowstatic['heading']; 
    $canonical = $pcheck; 
    include("includes/header.php");	 
    include("pages/commonfile.inc.php");  
    include("includes/footer.php"); 
} 
else 
{ 
	header("Location:https://localhost/project/shopurneeds/404.php"); 
} 
 
 
?> 