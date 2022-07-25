<?php 
session_start();
include("includes/configuration.php"); 		
include("includes/con_inc.php");
include('includes/currency_display.php');
 
     
    $productsid = $_REQUEST['productid'];
     
        $sql=mysqli_query($conn,"select * from ".$sufix."product where displayflag='1' and id='".$productsid."'") ;
    	$numproduct2= mysqli_num_rows($sql);
    	if($numproduct2 > 0 )
    	{
    		 $rowproduct = mysqli_fetch_array($sql);									
    		   $sellingprice=$rowproduct['sellingprice']; 
                $mrpprice = $rowproduct['mrp'];  
    		    
    			$sqlimage=mysqli_query($conn,"select * from ".$sufix."imageupload where pid='".$_REQUEST['productid']."' and mainimage='1'"); 
    			$rowimage=mysqli_fetch_array($sqlimage);	
    			
    			
            	$bid=$rowproduct['bid'];
            	$queryBrand = mysqli_fetch_assoc(mysqli_query($conn,"select * from `".$sufix."brand`   where bid='".$bid."'")); 
    	} 									
     
			
?>
     
    
     
					 
	<div class="col-sm-5 product-img" style="padding:30px ;">
        <ul class="product-main-image no-zoom" id="mainProductImg">
            <li class="product-main-image__item active ">
                <a href="<?php echo URL; ?>/<?php echo $rowproduct['slug']; ?>"> <img src="<?php echo $cdnurl;?>/uploads/productimage/thumb/<?php $product->productimage($sufix,$rowproduct['id']) ; ?>" style="width:100%;"></a> 
            </li>
        </ul>
    </div>
    <div class="pb-right-column col-xs-6 col-sm-6 right-prod" style="padding:30px; margin-bottom:0;">
    	    <div class="right-prod_1">
             
              <div class="prod-name"><a class="font_medium" href="<?php echo URL; ?>/<?php echo $rowproduct['slug']; ?>"><span style="font-size: 22px;" class="ng-binding"><?php echo $rowproduct['productname'];?></span></a></div>
              <!-- ngIf: product.products.discount>0 -->
              <div class="prod-price ng-scope newprice" ng-if="product.products.discount>0"> 
                  
                <?php
				$pro_id = $_REQUEST['productid'];	
		 		$date = date('Y-m-d');
		 	 	$sqlcoupan=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$pro_id%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='0' order by codeid desc");
				
				$sqlcoupan2=mysqli_query($conn,"select * from ".$sufix."discountcodes where product like '%$pro_id%' and displayflag='1' and  validto>= '".$date."' and validfrom <= '".$date."' and autoapply='2' order by codeid desc");
				$cashbacknum = mysqli_num_rows($sqlcoupan2);
				
				if(mysqli_num_rows($sqlcoupan)>0) 
            	{
            		$rowcoupan = mysqli_fetch_assoc($sqlcoupan);
            		$rowcoupanvalue1 = ($sellingprice*$rowcoupan['discountvalue'])/100;
            				
            		if($rowcoupanvalue1>0) 
            		{
            			$sellprice2 = ($sellingprice-$rowcoupanvalue1);
                        echo   $price = '<a class="text_overline"><span class="ng-binding oldprice">'.Currency.' '.number_format(floor($sellingprice*$_SESSION['conratio'])).'</span></a>';
                        
                        if($sellingprice>$sellprice2) 
                        { 
                            $pervalue=100-(($sellprice2*100)/$sellingprice);
                         echo   $price .=  '<span class="discount ng-binding">'.$pervalue.'</span>';
                        }  
            		} 
            		else 
            		{ 
            		   echo $price = '<a class="font_big"> <span>'.Currency.'</span><span class="ng-binding ">'.number_format(floor($sellingprice*$_SESSION['conratio'])).'</span></a><a class="small_font">Inclusive all taxes</a> ';
            	    } 
            	} 
            	else if($cashbacknum>0) 
            	{
            		$rowcoupan = mysqli_fetch_assoc($sqlcoupan2);
            		$rowcoupanvalue1 = ($sellingprice*$rowcoupan['discountvalue'])/100; 
            	    echo	$price = '<a class="font_big"> <span>'.Currency.'</span><span class="ng-binding ">'.number_format(floor($sellingprice*$_SESSION['conratio'])).'</span></a><span class="discount ng-binding">'.$rowcoupan['discountvalue'].'% Cash Back</span><a class="small_font">Inclusive all taxes</a> ';
            	} 
            	else 
            	{ 
            	    $pervalue = $mrpprice - $sellingprice;
            	    $percentage = round($pervalue*100/$mrpprice);
    	            echo  $price = '<a class="text_overline"><span class="ng-binding oldprice">'.Currency.' '.number_format(floor($mrpprice*$_SESSION['conratio'])).'</span></a>';
    	            echo $price =  '<span class="discount ng-binding"> '.$percentage.' % off </span>';
            	    echo $price = '<a class="font_big"><span>'.Currency.'</span><span class="ng-binding ">'.number_format(floor($sellingprice*$_SESSION['conratio'])).'</span></a><a class="small_font">Inclusive all taxes</a> ';
            	} 
		 	    ?> 
    		 	 
                </div>  
            </div>	
            <div class="clearfix"></div>     
      
            <div class="product-desc">
                <p class="form-option-title"><strong>Features:</strong></p>
                <b>Brand</b> : <?php echo $queryBrand['brandname'];?><br> 
                <b>Color</b> : <?php echo $rowproduct['color'];?><br>
                <b>Material</b> : <?php echo $rowproduct['material'];?>
            </div>
		    <div class="clearfix"></div> 
            <div class="form-option"> 
            <form name="basket" action="https://localhost/project/shopurneeds/basket/cart" method="post" id="basket" onsubmit="return validationForm();" style="width:100%; float:left">
            <div class="attributes pull-left" style="padding-top:2px;">
          
            <div class="attribute-list Product_size_pdp"> <div class="right-prod_2">
                <div class="img-Sizes" style="width:100%;">
                    <p class="p_size"> Available Colors :</p>  
                    <?php
                    $sqlVariant = mysqli_query($conn,"select * from `".$sufix."product` where mainpro_id='".$rowproduct['mainpro_id']."' and displayflag='1'");
                    while($rowvariant = mysqli_fetch_assoc($sqlVariant))
                    {
                        $sqlImage=mysqli_fetch_assoc(mysqli_query($conn,"select * from ".$sufix."imageupload where displayflag='1' and pid='".$rowvariant['id']."' and mainimage='1'"));
                    ?>
                    <a   class="ng-scope <?php if($rowvariant['color'] == $rowproduct['color']){ echo "active";} ?>" href="<?php echo URL; ?>/<?php echo $rowvariant['slug']; ?>"> 
                        <img   alt="Black" class="color_size" width="80px" height="80px"   src="<?php echo URL; ?>/uploads/productimage/small/<?php echo $sqlImage['productimage'];  ?>"> 
                    </a> 
                    <?php } ?> 
                </div>
                <div class="clearfix"></div>   
            <div class="product_size" style="width:100%;">
                <p class="p_size padd_bottom"><span>Choose your Size :</span></p>
                <div class="size-details btn-group sizechartclick sizeresponse">  
                    <?php
                    $sqlsizorde=mysqli_query($conn,"select sizename from shopurneeds_size");
                    while($roesizode=mysqli_fetch_array($sqlsizorde))
                    {
                      $dddszeor .= "'".$roesizode['sizename']."',";

                    }
                    $ordesussa=substr($dddszeor,0,-1);
                    $sqlsize=mysqli_query($conn,"select * from ".$sufix."product_size  where  product_id='".$productsid."' ORDER BY FIELD(product_size, $ordesussa)") or die('query failed'); 
                    if(mysqli_num_rows($sqlsize)>0)
                    { 
                        $i=1;
                        while($rows=mysqli_fetch_array($sqlsize))
                        {?>
                        <?php if($rows['qty']>0) { ?> 
                        <span    ><a id="Productsize_2"   href="javascript:void(0)" productsize123="<?php echo $rows['product_size'];?>" productsid="<?php echo $rowproduct['id'];?>" ><?php echo $rows['product_size']?></a></span>
                      
                        <?php } else { ?>
                        <span   ><a  href="javascript:void(0)" class="red-tooltip hidden_text_"  title="Out of Stock" ><?php echo $rows['product_size']?></a></span>
                       
                        <?php } ?>
                    <?php $i++; } } ?> 
                    <input type="hidden" name="rsize" class="selectsize" value="">
                    <input class="form-control input-number " id="Quantity" maxlength="2" name="pquantity" onkeypress="return isNumberKey(event)" type="hidden" value="1">
                   <br> <label for="ProductSizeId" class="error sizeError active"></label> 
                </div>

               

               <!-- <a href="https://shopurneeds.travkut.com/solid-poly-crepe-long-skirt-shopurneeds4586742#sizeChart2" class="size-link" ng-click="product.gotosizechart()">Size Chart</a>-->
                <p class="p_size padd_bottom"> <span class="err-size" style="color:Red;"></span> </p>
            </div>
           
		</div> </div>
            
          </div>
          
          <div class="clearfix"></div>
            <div class="form-action">
            <div class="button-group">
              <button type="button" class="btn-add-cart" addtocardpid="<?php echo $productsid; ?>" onClick="addtocartbutton1('<?php echo intval($rowproduct['id']); ?>')"  >Add to cart</button>
              <button type="button" class="btn-buy-now" addtocardbuynowpid="<?php echo $productsid; ?>" onClick="addtocartbuttonbuynow('<?php echo intval($rowproduct['id']); ?>')"  > Buy Now </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    
    <style>
        
        #quickView1 .modal-dialog.container{ width: 980px;}
        
        #quickView1{ top:0 !important;}
       #quickView1 button.close{top:0;}
        </style>