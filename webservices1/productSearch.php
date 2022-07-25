<?php
    header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions(); 
	$catid = $_REQUEST['catid'];
		$user_id = $_REQUEST['user_id'];

		//$brand = $_REQUEST['brand'];
		//$page = $_REQUEST['page'];
		$ksearch = $_REQUEST['ksearch']; 
		//$minrice = $_REQUEST['minrice']; 
		//$maxprice = $_REQUEST['maxprice']; 
		//$price = $minrice.' and '.$maxprice;
				$cartid = $_REQUEST['cartid'];
	$sellerId = $_REQUEST["sellerId"];
		 $start=$_REQUEST['startid'];
	$sortby = $_REQUEST["sortby"];

		if($catid!='')
		{
		    function get_categories($parent = 0)
{
    $html = '';
    $query = mysql_query("SELECT * FROM `shopurneeds_category` WHERE `parent` = '$parent'");
    while($row = mysql_fetch_assoc($query))
    {
        $current_id = $row['cat_id'];
        $html .= $row['cat_id'].',';
        $has_sub = NULL; 
        $has_sub = mysql_num_rows(mysql_query("SELECT COUNT(`parent`) FROM `shopurneeds_category` WHERE `parent` = '$current_id'"));
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
$sqlcatd=mysql_query("select * from shopurneeds_category where cat_id='".$catid."'");
$rowcatid=mysql_fetch_array($sqlcatd);
$catename33=$rowcatid['categoryname'];
$catbanner12=$rowcatid['uploadimage'];



		}
		else
		{
		    $catid1="";
		}
		
		if($sellerId!='')
		{
		   $sellerids= "and seller_id=".$sellerId;
		}
		else
		{
		    		   $sellerids= "";

		}
		
	//	$catid1 = (!empty($catid)) ? " and cat_id='".$catid."'" : "";
    //  $brand1 = (!empty($brand)) ? " and bid='".$brand."'" : ""; 
       $ksearch1 = (!empty($ksearch)) ? " and productname like '%".$ksearch."%'" : "";
    //    $sellingprice = (!empty($sellingprice)) ? " and sellingprice between '".$price."' " : "";
        $lk = $page;
        $ed = $lk*100;
        $st = $ed-100;
        if($page!='') { 
         $limit = " limit $st,100"; 
            }
    
    if($sortby=="")
    {
        $sortby1= "order by productname asc";
    }
    else
    {
                $sortby1= "order by ".$sortby;

    }
    if($ksearch1=="")
    {
    $result222 = mysql_query("select * from shopurneeds_product where displayflag='1' {$catid1} {$sellingprice}  {$sellerids} $sortby1") or die(mysql_error());
    $totlsas=mysql_num_rows($result222);
    
	$result = mysql_query("select * from shopurneeds_product where displayflag='1' {$catid1} {$sellingprice} {$ksearch1}  {$sellerids} $sortby1 limit $start ,20") or die(mysql_error());
    }
    else
    {
            $result222 = mysql_query("select * from shopurneeds_product where displayflag='1'  {$sellingprice} {$ksearch1}   $sortby1") or die(mysql_error());
            $totlsas=mysql_num_rows($result222);
    
	$result = mysql_query("select * from shopurneeds_product where displayflag='1' {$sellingprice} {$ksearch1}  {$sellerids} $sortby1 limit $start ,20") or die(mysql_error());

    }
    
	
     $no_of_rows = mysql_num_rows($result);
      if($no_of_rows>0)
            {
              $ddds="1";  
                
            }
            else
            {
                              $ddds="0";  

                
            }
            
     	$response["showresult"] = $ddds;
          $response["totalrecord"] = $totlsas;
     
     $no_of_rows = mysql_num_rows($result);
      if ($no_of_rows > 0) {
    	$response["status"] = "200";
		$response["msg"] = "Success";
       
		$response["catid"] = $catid;
		$response["categoryname"] = $catename33;
		$response["catbanner"] = "https://localhost/project/shopurneeds/uploads/categoryimages/".$catbanner12;
		while($productrows = mysql_fetch_assoc($result)) {
		        $sqlfav=mysql_query("SELECT * FROM `shopurneeds_favorite_product` where user_id='".$user_id."' and product_id='".$productrows['id']."'");
		    $numfav=mysql_num_rows($sqlfav);
		    if($numfav>0)
		    {
		        $favoflg="1";
		    }
		    else
		    {
		        		        $favoflg="0";

		    }
		        
		    	$resultvariant = mysql_query("select * from shopurneeds_product_size where product_id='".$productrows['id']."'  order by id asc");
		    			    if(mysql_num_rows($resultvariant)>0){

		    			while($variantrows = mysql_fetch_assoc($resultvariant)) {
		$pervalue222=100-(($variantrows['product_sellingprice']*100)/$variantrows['product_mrp']);
		    			    $sqlcartcar=mysql_query("select quantity from shopurneeds_basket where productid='".$productrows['id']."' and bid='".$cartid."' and size='".$variantrows['product_size']."'");
		    			    $numcartvar=mysql_num_rows($sqlcartcar);
		    			    if($numcartvar>0)
		    			    {
		    			        
		    			        $varcartqty=mysql_result($sqlcartcar,0);
		    			        
		    			    }
		    			    else
		    			    {
		    			       $varcartqty='0'; 
		    			    }
		    			    $variantdetails[] =array("productname"=>trim($productrows['productname']),
		    			    	 "costprice"=>$variantrows['product_mrp'], 
		    			    	 "saleqty"=>$variantrows['qty'], 
			                     "sellingprice"=>$variantrows['product_sellingprice'], 
			                     "size"=>$variantrows['product_size'],
								 "pid"=>$productrows['id'],
								 "sizeid"=>$variantrows['id'],
								 "discount"=>number_format($pervalue222,0),
								 "pvid"=>$productrows['id'].'-'.$variantrows['id'],
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
		$proimagesql = mysql_query("select `productimage` from `shopurneeds_imageupload` where pid='".$productrows['id']."' limit 1");
		$proimagerows = mysql_fetch_assoc($proimagesql);
		$sqlcartain=mysql_query("select quantity from shopurneeds_basket where productid='".$productrows['id']."' and bid='".$cartid."'");
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
			                     "costprice"=>$productrows['mrp'],
			                     "favoritecheck"=>$favoflg,
								 "imageurl"=>"https://localhost/project/shopurneeds/uploads/productimage/thumb/".$proimagerows['productimage'],
								  "imageurllarge"=>"https://localhost/project/shopurneeds/uploads/productimage/".$proimagerows['productimage'],
								 "pid"=>$productrows['id'],
								 "productType"=>$productrows['vegnonveg'],
								 "productDescription"=>strip_tags(substr($productrows['shortdescription'],0,145)),
								 "discount"=>number_format($pervalue,0),"cartqty"=>$maincartqty,"variantdetails"=>$variantdetails,"variant_type"=>$variant_type); 
							     $variantdetails="";
		}
		$response["productdetails"]=$prodetails;
				$sqlcarttotal=mysql_query("select sum(quantity) from shopurneeds_basket where  bid='".$cartid."'");
                $totalcartqty=mysql_result($sqlcarttotal,0);
        		$response["totalcartqty"]=$totalcartqty;
        
			echo json_encode($response);
		}
		 else {
			$response["status"] = "400";
			$response["msg"] = "Coming Soon...";
		$response["productdetails"]=[];
			echo json_encode($response);
		}
	 
	?>