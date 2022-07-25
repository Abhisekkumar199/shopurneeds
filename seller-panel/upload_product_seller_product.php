<?php
//include("includes/chklogin.php");
include("../includes/configurationadmin.php");
 

function get_file_extension($file_name) { //
	return explode('.',$file_name);
}

function substrword5($text, $maxchar, $end='') {
	if (strlen($text) > $maxchar || $text == '') {
		$words = preg_split('/\s/', $text);      
		$output = '';
		$i      = 0;
		while (1) {
			$length = strlen($output)+strlen($words[$i]);
			if ($length > $maxchar) {
				break;
			} 
			else {
				$output .= " " . $words[$i];
				++$i; 
			}
		}
		$output .= $end;
	} 
	else {
		$output = $text;
	}
	return $output;
	}
				

function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= '<div class="msg-error">'.$error[$i].'</div>';
			$i ++;}
			return $showError;
	}// close if empty errors
} // close function






ini_set('auto_detect_line_endings', true);


if (isset($_POST['upfile'])){
// check feilds are not empty


//echo $_FILES["uploaded"]["name"];
/*if(get_file_extension($_FILES["uploaded"]["name"])!= 'csv')
{
$error[] = 'Only CSV files accepted!';
}*/

//if (!$error){



$tot = 0;
$columns = 0;
$handle = fopen($_FILES["uploaded"]["tmp_name"], "r");
$i="1";

 $randnum=rand(100,999);
$arr = array();
while (($data = fgetcsv($handle,0, ",")) !== FALSE) {
 if($i!='1') {
 
     if(($data[0]=="")||($data[1]=="")||($data[3]=="")||($data[4]=="")||($data[16]=="")||($data[17]=="")||($data[18]=="")||($data[19]==""))
{
$error="1";
}


$sqlcat1=mysqli_query($conn,"select * from ".$sufix."category where cat_id='".$data[6]."'");
$numcat1=mysqli_num_rows($sqlcat1);
if($numcat1==0)
{
$error="3";
}
$sqlsupp=mysqli_query($conn,"select * from ".$sufix."suppliers where suppliername='".$data[0]."'");
$numsupp1=mysqli_num_rows($sqlsupp);
if($numsupp1==0)
{
$error="4";
}

$sqlbra1=mysqli_query($conn,"select * from ".$sufix."brand where brandname='".$data[1]."'");
  $numbra1=mysqli_num_rows($sqlbra1);
if($numbra1==0)
{
$error="5";
}
/*
if (!is_numeric($data[13])) 
{
$error="4";
} 
*/

 //echo "select bid from ".$sufix."brand where brandname='".$data[19]."'";
 $brandid = mysqli_query($conn,"select bid from ".$sufix."brand where brandname='".$data[1]."'");
  $brandidrows = mysql_result($brandid,0);
   $sellerid = mysqli_query($conn,"select id from ".$sufix."suppliers where suppliername='".$data[0]."'");
  $selleridrows = mysql_result($sellerid,0);
  if($data[0]!="")
  {
mysqli_query($conn,"INSERT INTO `littletags_product_dummy` (`sku`, `maincategory_id`, `category_ids`, `gst`, `vendor_code`, `product_title`, `short_description`, `long_description`, `measurements`, `composition`, `size`, `colour_code`, `mrp`, `price`, `searchkeyword`, `brand_name`, `material`, `pweight`, `status`, `inventory_type`, `wash_care`, `meta_description`, `meta_title`, `meta_keyword`, `product_warranty`, `vendor_id`, `attribute1`, `attribute2`, `attribute3`, `attribute4`, `attribute5`, `images1`, `images2`, `images3`, `images4`, `images5`, `videourl`, `insertid`,uploaderror,hsn_code) VALUES ('".$data[2]."', '".$data[6]."','".$data[7]."','".$data[18]."','".$data[3]."','".mysql_real_escape_string($data[4])."','','".mysql_real_escape_string($data[5])."','".$data[12]."','".$data[13]."','".$data[10]."','".$data[9]."','".$data[16]."','".$data[17]."','".mysql_real_escape_string($data[8])."','".$brandidrows."','".$data[11]."','".$data[14]."','0','".$data[19]."','".$data[21]."','".mysql_real_escape_string($data[22])."','".mysql_real_escape_string($data[23])."','".mysql_real_escape_string($data[24])."','".$data[25]."','".$selleridrows."','".$data[26]."','".$data[27]."','".$data[28]."','".$data[29]."','".$data[30]."','".$data[31]."','".$data[32]."','".$data[33]."','".$data[34]."','".$data[35]."','".$data[36]."','".$randnum."','".$error."','".$data[20]."')");
	}
	$pid_product=mysql_insert_id();
	
$error=0;
}


$i=$i+1;
}
fclose($handle); 
//$content.= "<div class='success' id='message'> CSV File Imported, $tot records added </div>";
$_SESSION['sessionMsg']="Products have been inserted";
	header("Location:upload_seller_product.php?insertid=$randnum");


//}// end no error
}//close if isset upfile


?>