<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	 $seller_id = $_REQUEST['seller_id'];
	 $bid = $_REQUEST['cartid'];
	 $qty = "1";
	 	 $size = "1";

	 $user_id = $_REQUEST['user_id'];
	 $msg = $_REQUEST['msg'];
    $file=$_FILES['imagepro']['name'];

	 
$userchec=mysql_num_rows(mysql_query("select * from shopurneeds_user_registration where id='".$user_id."' and displayflag='0'"));
if($userchec==0)
{
	if($file) 
    { 
        $filename1 = $_FILES['imagepro']['name']; 
        $size=filesize($_FILES['imagepro']['tmp_name']); 
        $photo_namecatalog=$filename1;
        $newname1="../withoutproimages/".$photo_namecatalog;		
        $move=move_uploaded_file($_FILES['imagepro']['tmp_name'],$newname1); 
         
           
        
    }
				
				if(($bid=='0')||($bid=='')){
				$sbasket=mysql_query("select `bid` from `shopurneeds_basketid` order by bid desc");
					if($row=mysql_fetch_array($sbasket))
					{
						$bid=$row['bid']+1;
					}
					else
					{
						$bid=1;
					}
						mysql_query("insert into `shopurneeds_basketid`(`bid`,`adddate`) values ('".$bid."', '".date('Y-m-d')."')") or die(mysql_error());
				}else{
				$bid = $bid;
				}	
					
			$userinfo = mysql_fetch_array(mysql_query("select * from shopurneeds_user_registration where id='".$user_id."'limit 1"));
			
			$insbasket = mysql_query("insert into `shopurneeds_basket`(`productid`,`size`,`bid`,`seller_id`,`cat_id`,`productname`, `productimage`, `slug`,  `sellingprice`, `costprice`, `brand`, `shipprice`, `subtotal`, `quantity`, `offername`, `displayflag`, `adddate`, `editdate`, `basket_status`, `sku`, `barcode`, `pweight`, `totalweight`, `monthly`, `vatvalue`, `vat`,cashcoin,userid,emailid,usermsg,is_withoutpro)values ('".$productId."','".$size."', '".$bid."','".$seller_id."','','Image', '".$photo_namecatalog."', '',  '', '', '', '', '', '".$qty."', '', '1', '".date("Y-m-d")."', '".date("Y-m-d")."', 'New Order', '', '' , '".$product['pweight']."', '','', '', '','','".$userinfo['emailid']."','".$userinfo['emailid']."','".$msg."','1')") or die(mysql_error());
			
			
	$sqlcarttotal=mysql_query("select sum(quantity) from shopurneeds_basket where  bid='".$bid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		
			$response["status"] = "200";
			$response["msg"] = "Product added in cart successfully";
			$response["bid"] = $bid;
			$response["totalcartqty"]=$totalcartqty;
			$response["cartqty"] = "1";

			echo json_encode($response);
	
	}	

else
{
    $response["status"] = "400";
			$response["msg"] = "No record found!";
			echo json_encode($response);
}
?>