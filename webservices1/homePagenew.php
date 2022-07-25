<?php
	header("Content-Type: application/json");
	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();
		$user_id=$_REQUEST['user_id'];
		$cartid=$_REQUEST['cartid'];

 $bannerRes=mysql_query("SELECT * FROM shopurneeds_banners WHERE bposition='Mobile Banner' and displayflag='1' ORDER BY sortid ASC LIMIT 25 ") or die(mysql_error());
if(mysql_num_rows($bannerRes)>0){
	  while($rowsa=mysql_fetch_array($bannerRes)){
	     $currentday=date("l");
	     $currenttime=date("H:i:s");
	       if($rowsa['uploadimage']!='') { 
                  $imageurl = "https://localhost/project/shopurneeds/uploads/bannerimages/".$rowsa['uploadimage'];
            			} else { 
            			    $imageurl = "";
            			}
            			
            		    $sss[] =array("imageurl"=>$imageurl,"externalLink"=>$rowsa['externallink']);
                }
	        }
	        
	         
	
	    $response["topBanners"]=$sss;
	  
	  $bannerRes=mysql_query("SELECT * FROM shopurneeds_banners WHERE bposition='Second Banner' and displayflag='1' ORDER BY sortid ASC LIMIT 1 ") or die(mysql_error());
if(mysql_num_rows($bannerRes)>0){
	  while($rowsa=mysql_fetch_array($bannerRes)){
	     $currentday=date("l");
	     $currenttime=date("H:i:s");
	       if($rowsa['uploadimage']!='') { 
                  $imageurl = "https://localhost/project/shopurneeds/uploads/bannerimages/".$rowsa['uploadimage'];
            			} else { 
            			    $imageurl = "";
            			}
            			
            		    $sss1[] =array("imageurl"=>$imageurl,"externalLink"=>$rowsa['externallink']);
                }
	        }
	        
	         
	
	    $response["secondBanners"]=$sss1;  
	   
	    
	   
	    
	    
	    // top ad banner
		
	
		$CategorySql=mysql_query("SELECT * FROM shopurneeds_category where parent='0' and displayflag='1' order by sortid asc") or die(mysql_error());
		$categoryNumRow=mysql_num_rows($CategorySql);
		
		if($categoryNumRow>0){
			while($CategoryRows=mysql_fetch_assoc($CategorySql))
			{ 
			    
			  if($CategoryRows["uploadimage1"]!=""){
			      
			      $catimgurl="https://localhost/project/shopurneeds/uploads/categoryimages/".$CategoryRows['uploadimage1'];
			  }else{
			      $catimgurl="https://localhost/project/shopurneeds/uploads/categoryimages/no-image-available.jpg";
			  }
		      $catList[]=array("catid"=>$CategoryRows['cat_id'],"categoryname"=>$CategoryRows['categoryname'],"imagename"=>$catimgurl);
		    }
		}
					
		$response['catlist']=$catList;


//////////////////Product Slab/////////////////////////
	 
	 $sql_slab=mysql_query("select * from shopurneeds_product_slab where displayflag='1'  ");
        $num_slab=mysql_num_rows($sql_slab); 
        if($num_slab > 0)
        { 
        	$j = 0;
            while($rows_slab=mysql_fetch_assoc($sql_slab))
            {
                $slab_name = $rows_slab['title'];
                $bannerurl  = "https://localhost/project/shopurneeds/uploads/stripbannerimages/".$rows_slab['bannerimage'];
                $url = $rows_slab['url'];
            	$skuids = explode(",",$rows_slab['sku_ids']);
            	$skuids = implode("','",$skuids); 
        		$sqlrece=mysql_query("select * from shopurneeds_product where displayflag='1' and master_sku IN ('".$skuids."') and vartype=''   limit 0,10"); 
		while($productrows = mysql_fetch_assoc($sqlrece)) {
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
               
        		$newarriaval[] = array("stripname"=>$slab_name,"stripbanner"=>$bannerurl,"cat_id"=>$url,"Productdetails"=>$prodetails); 
         	    $response["product_slab"]=$newarriaval;  
              $skuids=""; 
            }
        
        }
	 
	 
	 ///////////////////Product Slab///////////////////////
	    
	 
	    
	    $response["status"] = "200";
	$response["msg"] = "Success"; 
	    
	echo json_encode($response); 
	die;
?>