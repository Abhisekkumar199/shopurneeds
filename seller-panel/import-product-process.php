<?php 
include("include/configurationadmin.php");

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
 
     if(($data[0]=="")||($data[1]=="")||($data[3]=="")||($data[4]=="")||($data[10]=="")||($data[11]=="")||($data[12]==""))
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
  $brrows = mysqli_fetch_array($brandid);
   $brandidrows=$brrows['bid'];
   $sellerid = mysqli_query($conn,"select id from ".$sufix."suppliers where suppliername='".$data[0]."'");
   $srrows = mysqli_fetch_array($sellerid);
   $selleridrows=$srrows['id'];
   
   
  if($data[0]!="")
  {
       
        mysqli_query($conn,"INSERT INTO `shopurneeds_product_dummy` (`sku`, `maincategory_id`, `category_ids`, `gst`, `vendor_code`, `product_title`, `short_description`, `long_description`, `size`, `colour_code`, `mrp`, `price`, `searchkeyword`, `brand_name`, `status`, `meta_description`, `meta_title`, `meta_keyword`,  `vendor_id`,  `images1`, `images2`, `images3`, `images4`, `images5`,`images6`, `insertid`,uploaderror,hsn_code,qty,bundle_total_unit,bundle_price) VALUES ('".$data[2]."', '".$data[6]."','".$data[7]."','".$data[13]."','".$data[3]."','".mysqli_real_escape_string($conn,$data[4])."','','".mysqli_real_escape_string($conn,$data[5])."','".$data[10]."','".$data[9]."','".$data[11]."','".$data[12]."','".mysqli_real_escape_string($conn,$data[8])."','".$brandidrows."','0','".mysqli_real_escape_string($conn,$data[17])."','".mysqli_real_escape_string($conn,$data[16])."','".mysqli_real_escape_string($conn,$data[18])."','".$data[0]."','".$data[19]."','".$data[20]."','".$data[21]."','".$data[22]."','".$data[23]."','".$data[24]."','".$randnum."','".$error."','".$data[15]."','".$data[14]."','".$data[25]."','".$data[26]."')");
    }
	$pid_product=mysqli_insert_id($conn); 
$error=0;
}


$i=$i+1;
}
fclose($handle); 
    $_SESSION['sessionMsg']="Products have been inserted"; 
    ?>
       <script>window.location.href='https://localhost/project/shopurneeds/seller-panel/import-product?insertid=<?php echo $randnum; ?>';</script>  
<?php  }  ?>