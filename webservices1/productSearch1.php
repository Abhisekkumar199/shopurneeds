<?php
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$catid = $_REQUEST['catid'];
		$brand = $_REQUEST['brand'];
		$page = $_REQUEST['page'];
		$ksearch = $_REQUEST['ksearch']; 
		$minrice = $_REQUEST['minrice']; 
		$maxprice = $_REQUEST['maxprice']; 
		$price = $minrice.' and '.$maxprice;
				$cartid = $_REQUEST['cartid'];

		if($catid!='')
		{
		    function get_categories($parent = 0)
{
    $html = '';
    $query = mysql_query("SELECT * FROM `buyde_category` WHERE `parent` = '$parent'");
    while($row = mysql_fetch_assoc($query))
    {
        $current_id = $row['cat_id'];
        $html .= $row['cat_id'].',';
        $has_sub = NULL; 
        $has_sub = mysql_num_rows(mysql_query("SELECT COUNT(`parent`) FROM `buyde_category` WHERE `parent` = '$current_id'"));
        if($has_sub)
        {
            $html .= get_categories($current_id);
        }
        $html .= '';
    }
    $html .= '';
    return $html; 
}
$catlistcomma= get_categories($catid);
$catlistfinal=$catlistcomma.''.$catid;
 $catid1= "and cat_id in (".$catlistfinal.")";
$sqlcatd=mysql_query("select categoryname from buyde_category where cat_id='".$catid."'");
$catename33=mysql_result($sqlcatd,0);
		}
		else
		{
		    $catid1="";
		}
	//	$catid1 = (!empty($catid)) ? " and cat_id='".$catid."'" : "";
        $brand1 = (!empty($brand)) ? " and bid='".$brand."'" : ""; 
        $ksearch1 = (!empty($ksearch)) ? " and MATCH(productname) AGAINST ('".$ksearch."' IN BOOLEAN MODE)" : "";
        $sellingprice = (!empty($sellingprice)) ? " and sellingprice between '".$price."' " : "";
        $lk = $page;
        $ed = $lk*100;
        $st = $ed-100;
        if($page!='') { 
         $limit = " limit $st,100"; 
            }
	$result = mysql_query("select * from buyde_product where displayflag='1'  {$ksearch1} {$catid1} {$brand1}{$sellingprice} {$limit}");
     $no_of_rows = mysql_num_rows($result);
      if ($no_of_rows > 0) {
    	$response["status"] = "200";
		$response["msg"] = "Success";
       
		$response["catid"] = $catid;
		$response["categoryname"] = $catename33;	
		while($productrows = mysql_fetch_assoc($result)) {
		    if($productrows['vartype']!=""){
		        
		    	$resultvariant = mysql_query("select * from buyde_product where mainpro_id='".$productrows['id']."' order by pweight asc");
		    	
		    			while($variantrows = mysql_fetch_assoc($resultvariant)) {
		    			    $sqlcartcar=mysql_query("select quantity from buyde_basket where productid='".$variantrows['id']."' and bid='".$cartid."'");
		    			    $numcartvar=mysql_num_rows($sqlcartcar);
		    			    if($numcartvar>0)
		    			    {
		    			        
		    			        $varcartqty=mysql_result($sqlcartcar,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $varcartqty='0'; 
		    			    }
		    			    $variantdetails[] =array("productname"=>$variantrows['productname'],
			                     "sellingprice"=>$variantrows['sellingprice'], 
			                     "size"=>$variantrows['size'],
								 "pid"=>$variantrows['id'],
								 "cartqty"=>$varcartqty); 
		    			}
		    					$variant_type= '1';	

		    }
		    else 
		    {
		        		    				$variant_type = '0';	

		     $variantdetails[]= new stdClass();  

		    }
 
		$pervalue=100-(($productrows['sellingprice']*100)/$productrows['costprice']);
		$proimagesql = mysql_query("select `productimage` from `buyde_imageupload` where pid='".$productrows['id']."' limit 1");
		$proimagerows = mysql_fetch_assoc($proimagesql);
		$sqlcartain=mysql_query("select quantity from buyde_basket where productid='".$productrows['id']."' and bid='".$cartid."'");
		    			    $nummainvar=mysql_num_rows($sqlcartain);
		    			    if($nummainvar>0)
		    			    {
		    			        
		    			        $maincartqty=mysql_result($sqlcartain,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $maincartqty='0'; 
		    			    }
			$prodetails[] =array("productname"=>$productrows['productname'],
			                     "sellingprice"=>$productrows['sellingprice'],
								 "imageurl"=>"https://buydebest.com/productimage/small/".$proimagerows['productimage'],
								 "pid"=>$productrows['id'],
								 "costprice"=>$productrows['costprice'],
								 "discount"=>$pervalue,"cartqty"=>$maincartqty,"variantdetails"=>$variantdetails,"variant_type"=>$variant_type); 
							     $variantdetails=""; 
		}
		$response["productdetails"]=$prodetails;
				$sqlcarttotal=mysql_query("select sum(quantity) from buyde_basket where  bid='".$cartid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		$response["totalcartqty"]=$totalcartqty;
        
			echo json_encode($response);
		}
		 else {
			$response["status"] = "400";
			$response["msg"] = "Coming Soon...";
			echo json_encode($response);
		}
	 
	?>