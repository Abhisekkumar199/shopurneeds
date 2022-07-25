<?php  
include("include/configurationadmin.php");  

function get_file_extension($file_name) 
{  
	return explode('.',$file_name);
} 

function substrword5($text, $maxchar, $end='') 
{
	if (strlen($text) > $maxchar || $text == '') 
	{
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
	else
	{
		$output = $text;
	}
	return $output;
}

function errors($error)
{
	if (!empty($error))
	{
		$i = 0;
		while ($i < count($error))
		{
			$showError.= '<div class="msg-error">'.$error[$i].'</div>';
			$i ++; 
		}
		return $showError;
	} 
} 
 
 

ini_set('auto_detect_line_endings', true);


if (isset($_POST['upfile']))
{
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
    while (($data = fgetcsv($handle,0, ",")) !== FALSE) 
    { 
        if($i!='1') 
        { 
             
            if(($data[0]=="")||($data[1]=="")||($data[3]=="")||($data[4]=="")||($data[16]=="")||($data[17]=="")||($data[18]=="")||($data[19]==""))
            {
                $error="1";
            }
 
            $sqlcat1=mysql_query("select * from ".$sufix."category where cat_id='".$data[3]."'");
            $numcat1=mysql_num_rows($sqlcat1);
            if($numcat1==0)
            {
                $error="3";
            }
             
       
            if($data[6] != '')
            {
                
                $sql_insert = mysqli_query($conn,"INSERT INTO `".$sufix."product_dummy` (`sku`,`hsn_code`, `maincategory_id`, `category_ids`, `brand_name`, `vendor_id`, `vendor_code`, `product_title`, `mrp`, `price`, `gst`, `size`, `colour_code`, `short_description`, `long_description`, `meta_description`, `meta_title`, `meta_keyword`, `searchkeyword`, `measurements`, `composition`, `disclaimer`, `sla`, `inventory_type`, `cod`, `product_warranty`, `status`, `images1`, `images2`, `images3`, `images4`, `images5`, `images6`, `images7`, `images8`, `images9`, `images10`, `attribute1`, `attribute2`, `attribute3`, `attribute4`, `attribute5`, `attribute6`, `attribute7`, `attribute8`, `attribute9`, `attribute10`, `insertid`,`uploaderror`) VALUES ('".$data[0]."', '".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".mysqli_real_escape_string($conn,$data[5])."','".mysqli_real_escape_string($conn,$data[6])."','".mysqli_real_escape_string($conn,$data[7])."','".$data[8]."','".$data[9]."','".$data[10]."','".$data[11]."','".$data[12]."','".mysqli_real_escape_string($conn,$data[13])."','".mysqli_real_escape_string($conn,$data[14])."','".mysqli_real_escape_string($conn,$data[15])."','".mysqli_real_escape_string($conn,$data[16])."','".mysqli_real_escape_string($conn,$data[17])."','".$data[18]."','".$data[19]."','".mysqli_real_escape_string($conn,$data[20])."','".mysqli_real_escape_string($conn,$data[21])."','".mysqli_real_escape_string($conn,$data[22])."','".$data[23]."','".mysqli_real_escape_string($conn,$data[24])."','".mysqli_real_escape_string($conn,$data[25])."','".mysqli_real_escape_string($conn,$data[26])."','".$data[27]."','".$data[28]."','".$data[29]."','".$data[30]."','".$data[31]."','".$data[32]."','".$data[33]."','".$data[34]."','".$data[35]."','".$data[36]."','".$data[37]."','".$data[38]."','".$data[39]."','".$data[40]."','".$data[41]."','".$data[42]."','".$data[43]."','".$data[44]."','".$data[45]."','".$data[46]."','".$randnum."','".$error."')");
            }
            $pid_product=mysqli_insert_id($conn); 
            $error=0;
        } 
        $i=$i+1;
    } 
    fclose($handle); 
    $_SESSION['sessionMsg']="Products have been inserted"; 
    ?>
       <script>window.location.href='https://localhost/project/shopurneeds/admin-panel/import-product?insertid=<?php echo $randnum; ?>';</script>  
<?php  }  ?>